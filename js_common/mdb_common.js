/* global mdb */

function updateMDBInput(el, val) {
  if (el === undefined || !(el.tagName === 'INPUT' || el.tagName === 'TEXTAREA')) {
    return;
  }
  if (val === null) {
    val = "";
  }
  el.value = val;
  const formOutline = el.closest('.form-outline');
  new mdb.Input(formOutline).update();
  if (val.length === 0) {
    new mdb.Input(formOutline).forceInactive();
  }
}

class MDBInputClass {
  static updateMDBInput(el, val) {
    if (val === null) {
      val = "";
    }
    el.value = val;
    const formOutline = el.closest('.form-outline');
    new mdb.Input(formOutline).update();
    if (val.length === 0) {
      new mdb.Input(formOutline).forceInactive();
    }
  }
}