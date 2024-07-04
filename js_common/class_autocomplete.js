
class Autocomplete {

  static autocomplet_id = 7843392;
  act_autocomplet_id;
  target_div_el;
  target_el;
  last_filter = "init_with_something_else_so_that_is_not_empty";
  param;
  results;
  ddm_cont_div;
  debounce_timeout_id;
  is_backspace_clear_all = false;

  static init_autocomplete(target_div_el) {
    target_div_el.querySelectorAll('[autocomplete-table]').forEach((div_el) => {
      var input_el = div_el.querySelector("input");
      var param = {
        liInnerHTML: (value) => {
          return value[1];
        },
        onChange: () => {
          input_el.removeAttribute("row_id");
        },
        displayValue: (value) => {
          input_el.setAttribute("row_id", value[0]);
          if (div_el.hasAttribute("value_processing")) {
            return window[div_el.getAttribute("value_processing")](value[1]);
          }
          return value[1];
        }
      };
      param.allow_new_value = div_el.hasAttribute("allow_new_value");
      if (window[div_el.id + "_filter"] !== undefined) {
        param.filter = window[div_el.id + "_filter"];
      }
      new Autocomplete(div_el, param);
    });
  }

  constructor(target_div_el, param) {
    this.target_div_el = target_div_el;
    this.target_el = target_div_el.querySelector("input");
    this.param = param;

    this.target_div_el.addEventListener('keydown', this.div_keydown_handler.bind(this));
    this.target_el.addEventListener('click', this.input_click_handler.bind(this));
    this.target_el.addEventListener('keyup', this.input_keyup_handler.bind(this));
    this.target_el.setAttribute("autocomplete", "one-time-code");

    this.outsideClickHandler_bind = this.outsideClickHandler.bind(this);
    this.ddm_pos_bind = this.ddm_pos.bind(this);
  }

  div_keydown_handler(event) {
    if (this.target_el.readOnly) {
      return;
    }
    switch (event.key) {
      case "Tab":
      case "Escape":
        this.is_backspace_clear_all = false;
        this.close();
        break;
      case "Backspace":
        if (this.is_backspace_clear_all) {
          this.target_el.value = "";
        }
        this.target_el.removeAttribute("row_id");
        this.is_backspace_clear_all = false;
        break;
      default:
        this.is_backspace_clear_all = false;
        return;
    }
  }

  input_keyup_handler(event) {
    if (this.target_el.readOnly) {
      return;
    }
    var allowedPattern = /^[a-zA-Z0-9!@#$%^&*()_+{}\[\]:;<>,.?~\-=\\\/|'"` ]$|^Backspace$/;
    var e_key = event.key;
    // Check if the pressed key is a special key or not allowed
    if (e_key === 'Enter') {
      if (this.ddm_cont_div !== undefined) {
        var elements = this.ddm_cont_div.querySelectorAll(".szaif-autocomplete-item");
        if (elements.length === 1 && elements[0].hasAttribute("res_id")) {
          this.is_backspace_clear_all = true;
          this.ddm_click_handler({target: elements[0]});
        } else {
          if (!this.param.allow_new_value) {
            updateMDBInput(this.target_el, "");
          } else {
            this.target_div_el.dispatchEvent(new CustomEvent("newValue.autocomplete"));
          }
          this.close();
        }
      }
    }
    if (!allowedPattern.test(e_key)) {
      return;
    }
    if (this.debounce_timeout_id) {
      clearTimeout(this.debounce_timeout_id);
    }

    this.debounce_timeout_id = setTimeout(() => {
      if (this.last_filter !== this.target_el.value) {
        this.last_filter = this.target_el.value;
        if (this.param.onChange !== undefined) {
          this.param.onChange();
        }
        if (this.target_div_el.hasAttribute("dependent")) {
          updateMDBInput(document.getElementById(this.target_div_el.getAttribute("dependent")), "");
          document.getElementById(this.target_div_el.getAttribute("dependent")).removeAttribute("row_id");
        }
        this.target_div_el.dispatchEvent(new CustomEvent("filterChange.autocomplete"));
      }
      this.ddm_handler();
    }, 300);
  }

  input_click_handler() {
    if (this.target_el.readOnly) {
      return;
    }
    if (this.ddm_cont_div !== undefined) {
      this.close();
      return;
    }
    this.target_el.select();
    this.ddm_handler();
  }

  ddm_handler() {
    if (this.ddm_cont_div === undefined && !this.target_el.readOnly) {
      this.ddm_append();
      this.ddm_pos();
      this.add_listener();
    }
    if (this.param.filter !== undefined) {
      this.param.filter(this.target_el.value)
              .then((results) => this.ddm_fill(results))
              .catch(err => {
                showToast('Warning', err);
              });
    } else {
      this.filter(this.target_el.value)
              .then((results) => this.ddm_fill(results))
              .catch(err => {
                showToast('Warning', err);
              });
    }
  }

  async filter(filter) {
    var obj = new Object();
    obj.controller = "DDMController";
    obj.methode = this.target_div_el.getAttribute("autocomplete-table");
    obj.filter = this.target_el.value;
    const resp = await fetch_handler('index.php', obj);
    if (resp.hasOwnProperty("results")) {
      return resp.results;
    }
    return [];
  }

  add_listener() {
    document.addEventListener('click', this.outsideClickHandler_bind);
    window.addEventListener('resize', this.ddm_pos_bind);
    this.ddm_cont_div.addEventListener('click', this.ddm_click_handler.bind(this));
  }

  ddm_click_handler(event) {
    var ddm_target_el = event.target;
    if (ddm_target_el.tagName === 'LI' && ddm_target_el.hasAttribute("res_id")) {
      var target_value = this.param.displayValue(this.results[parseInt(ddm_target_el.getAttribute("res_id"))]);
      updateMDBInput(this.target_el, target_value);
      this.close();
      if (this.target_div_el.hasAttribute("dependent")) {
        updateMDBInput(document.getElementById(this.target_div_el.getAttribute("dependent")), "");
        document.getElementById(this.target_div_el.getAttribute("dependent")).removeAttribute("row_id");
      }
      this.target_div_el.dispatchEvent(new CustomEvent("itemSelect.autocomplete"));
      this.last_filter = "init_with_something_else_so_that_is_not_empty";
    }
  }

  outsideClickHandler(event) {
    const isInput = this.target_div_el && this.target_div_el.contains(event.target);
    const isDropdown = this.ddm_cont_div === event.target;
    const isDropdownContent = this.ddm_cont_div && this.ddm_cont_div.contains(event.target);

    if (!isInput && !isDropdown && !isDropdownContent) {
      this.close();
    }
  }

  close() {
    if (this.ddm_cont_div === undefined) {
      return;
    }
    document.removeEventListener('click', this.outsideClickHandler_bind);
    window.removeEventListener('resize', this.ddm_pos_bind);
    document.body.removeChild(this.ddm_cont_div);
    this.ddm_cont_div = undefined;
    if (this.target_el.hasAttribute("row_id") || this.param.allow_new_value) {
      return;
    }
    this.target_div_el.dispatchEvent(new CustomEvent("not_selected_close.autocomplete"));
    updateMDBInput(this.target_el, "");
  }

  ddm_pos() {
    this.ddm_cont_div.style.width = this.target_div_el.offsetWidth + 'px';
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    const scrollLeft = window.pageXOffset || document.documentElement.scrollLeft;
    const targetRect = this.target_div_el.getBoundingClientRect();
    this.ddm_cont_div.style.transform = `translate(${scrollLeft + targetRect.left}px,${scrollTop + targetRect.bottom}px)`;
    this.ddm_cont_div.style.position = 'absolute';
    this.ddm_cont_div.style.inset = '0px auto auto 0px';

  }

  ddm_append() {
    this.act_autocomplet_id = Autocomplete.autocomplet_id++;
    this.ddm_cont_div = document.createElement('div');
    this.ddm_cont_div.id = "szaif_autocomplete_" + this.act_autocomplet_id;
    this.ddm_cont_div.className = "autocomplete-dropdown-container overflow-auto";
    document.body.appendChild(this.ddm_cont_div);
  }

  async ddm_fill(results) {
    this.results = results;
    if (this.ddm_cont_div !== undefined) {
      this.ddm_cont_div.innerHTML = "";
      var ddm_ul = document.createElement('ul');
      ddm_ul.className = "autocomplete-items-list overflow-auto";
      if (results.length === 0) {
        var li = document.createElement('li');
        li.className = "szaif-autocomplete-item";
        li.innerHTML = trl.dict("No result!");
        ddm_ul.appendChild(li);
      }
      for (var i = 0; i < results.length; i++) {
        var result = results[i];
        var li = document.createElement('li');
        li.className = "szaif-autocomplete-item";
        li.innerHTML = this.param.liInnerHTML(result);
        li.setAttribute("res_id", i);
        ddm_ul.appendChild(li);
      }
      var ddm_div = document.createElement('div');
      ddm_div.className = "autocomplete-dropdown open";
      ddm_div.appendChild(ddm_ul);
      this.ddm_cont_div.appendChild(ddm_div);
    }
  }
}