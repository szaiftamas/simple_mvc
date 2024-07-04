
class translater {

  dict(value) {
    switch ("HU") {
      case "ENG":
        return value;
        break;

      case "HU":
      switch (value) {
        case "No result!":
          return "Nincs eredmény!";
          break;
        case "Password successfully changed!":
          return "Jelszó sikeresen megváltoztatva!";
          break;
        case "Please change your password!":
          return "Kérem változtasson jelszót!";
          break;
        case "It should be at least 8 characters long: ********":
          return "Minimum 8 karakter hosszú: ********";
          break;
        case "It must have a number: [0 to 9]":
          return "Számot kell tartalmaznia: [0 to 9]";
          break;
        case "It must have a capital alphabet: [A to Z]":
          return "Nagy betűt kell tartalmaznia: [A to Z]";
          break;
        case "It must have a small alphabet: [a to z]":
          return "Kis betűt kell tartalmaznia: [a to z]";
          break;
        case "It must have a special character: [!, @, #, $, %, ^, &, *]":
          return "Kell tartalmaznia egy speciális karaktert: [!, @, #, $, %, ^, &, *]";
          break;
        case "The new password is not enough strong!":
          return "Az új jelszó nem elég erős!";
          break;
        case "User successfully deleted!":
          return "Felhasználó sikeresen törölve!";
          break;
        case "Password is same to the uniqueid!":
          return "A jelszó megegyezik az egyedi azonosítóval!";
          break;
        case "Unique Id. is min. 3 character!":
          return "Egyedi azonosító minimum 3 karakter!";
          break;
        case "Active must be set!":
          return "Aktív nincs beállítva!";
          break;
        case "Can not add node!":
          return "Nem tudsz hozzáadni elemet!";
          break;
        case "Can not add node!":
          return "Nem tudsz hozzáadni elemet!";
          break;
        case "Node is too short!":
          return "Az elem túl rövid!";
          break;
        default:
          return value;
          break;
      }
      default:
        return value;
        break;
    }
  }
}