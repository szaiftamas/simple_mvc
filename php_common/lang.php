<?php

function lng($text) {
  echo dictionary($text);
}

function dictionary($text) {
  if (!isset($_SESSION[$GLOBALS["site"]])) {
    return $text . "-";
  }
  switch ($_SESSION[$GLOBALS["site"]]["lang"]) {
    case "ENG":
      return $text;

    case "HU":
      switch ($text) {
        case '':
          return "";
        case 'This handling is already open on another station!':
          return "Ez az alapanyag kezelés már nyitva van egy másik állomáson!";
        case 'Unlock':
          return "Feloldás";
        case 'Filter Out':
          return "Szűrés";
        case 'Raw Material Aux History':
          return "Egyéb Tétel Történet";
        case '!!! Preview Report !!!':
          return "!!! Előnézeti Riport !!!";
        case 'Closing date must be after then the last closing date! ':
          return "A záró dátumnak, az utolsó záró dátum után kell lennie! ";
        case 'Date of close:':
          return "Zárás Dátuma:";
        case 'This handling number is not in the database!':
          return "Ez az alapanyag kezelés szám nem található az adatbázisban!";
        case 'Ledger Posting - Invoice':
          return "Főkönyvi Feladás - Számlák";
        case 'Dated:':
          return "Készült:";
        case 'End of period:':
          return "Időszak vége:";
        case 'Beginning of period:':
          return "Időszak kezdete:";
        case 'Print Report':
          return "Riport Nyomtatása";
        case 'Get Report':
          return "Riport Készítése";
        case 'Ledger Posting':
          return "Főkönyvi Feladás";
        case 'Report Maker:':
          return "Riportot készítő:";
        case 'Stock balance total:':
          return "Főkönyvi feladás összesen:";
        case 'Stock decreasing total:':
          return "Készlet csökkentő összesen:";
        case 'Stock increasing total:':
          return "Készlet növelő összesen:";
        case 'This invoice violates this monthly close -> ':
          return "Ez a számla sérti ezt a havi zárást -> ";
        case 'Raw Material status is wrong for replacing label!':
          return "Az alapanyag státusza nem megfelelő a címke pótlásához!";
        case 'Raw Material must be in the Warehouse for splitting!':
          return "A megosztáshoz az alapanyagnak a Raktárban kell lennie!";
        case 'Receipt Number':
          return "Bizonylat Száma";
        case 'Unit Price in FC':
          return "Egységár Devizában";
        case 'Unit Amount':
          return "Mennyiségi Egység";
        case 'Change In Warehouse':
          return "Változás Raktárban";
        case 'Description':
          return "Megnevezés";
        case 'Raw Material PN':
          return "Anyagtörzsszám";
        case 'Stock Decreasing Total':
          return "Készlet Csökkentő Összesen";
        case 'Stock Increasing Total':
          return "Készlet Növelő Összesen";
        case 'Qty chg ':
          return "Menny vált ";
        case 'Location Group':
          return "Lokáció Csoport";
        case 'Missing Identifier':
          return "Hiányzó Azonosító";
        case 'Can not change contractor, if handling is closed!':
          return "Nem cserélhető a kapcsolat, ha már le lett zárva!";
        case 'This is an already closed handling can not do this action!':
          return "Ez már egy lezárt mozgatás, ez a művelet nem elérhető!";
        case 'Monthly Close Unlocking':
          return "Havi Zárás Feloldása";
        case 'Monthly Close Comment':
          return "Havi Zárás Megjegyzés";
        case 'Generating Preview':
          return "Előnézet Generálás";
        case 'Month Opening':
          return "Hónap Megnyitása";
        case 'Month Closing':
          return "Hónap Zárása";
        case 'Monthly Close Date (yyyy-mm-dd)':
          return "Havi Zárás Dátuma (yyyy-mm-dd)";
        case 'Monthly Close':
          return "Havi Zárás";
        case 'Selected Unique Id.':
          return "Kiválasztott Egyedi Azonosító";
        case 'There is not enough material in parent!':
          return "Nincs elegendő alapanyag a szülőn!";
        case 'This Raw Material status is wrong for label confirm!':
          return "Ennek az alapanyagnak a státusza nem megfelelő a címke visszaellenőrzéshez!";
        case ' handling violates this monthly close -> ':
          return " számú alapanyag kezelés sérti ezt a havi zárást -> ";
        case 'Confirm':
          return "Megerősít";
        case 'There is an active assignment from this auxiliary to':
          return "Van aktív hozzárendelés ehhez a lokációhoz ";
        case 'Identify Raw Material':
          return "Alapanyag Beazonosítás";
        case 'Split Raw Material':
          return "Alapanyag Megosztása";
        case 'Handover':
          return "Átadó";
        case 'Can not change location, if handling is closed!':
          return "Nem cserélhető a lokáció, ha már le lett zárva!";
        case 'This Raw Material has on a different location!':
          return "Ez az alapanyag egy másik lokáción van!";
        case 'There is no enough auxiliary material on location!':
          return "Nincs elég segédanyag a lokáción!";
        case 'There is no enough auxiliary material in the warehouse!':
          return "Nincs elég segédanyag a raktárban!";
        case 'Get Riport':
          return "Riport Készítése";
        case 'Invoice':
          return "Esedékesség";
        case 'Invoice Date':
          return "Esedékesség időpontja";
        case 'Accounting Records #':
          return "Bizonylat Száma";
        case 'Contractor must be specified for the invoice!':
          return "A szálma kiállítóját meg kell adni!";
        case 'Not enough quantity In Warehouse!':
          return "Nincs elegendő mennyiség a raktárban!";
        case 'This handling has been closed before, can not change the content!':
          return "Ezt az alapanyg kezelést korábban már lezárták, tartalmát nem lehet megváltoztatni!";
        case 'Raw Material status must be Scrapped!':
          return "Az alapanyag státuszának Selejtezve-nek kell lennie!";
        case 'Raw Material status must be Released!':
          return "Az alapanyag státuszának Kiadva-nak kell lennie!";
        case 'Raw Material status must be In Warehouse!':
          return "Az alapanyag státuszának Raktárban-nak kell lennie!";
        case 'Distributor must be selected!':
          return "Disztribútort meg kell adni!";
        case 'You can open it on the Handling station!':
          return "Anyag kezelési oldalon tudod megnyitni!";
        case 'You can open it on the Incoming station!':
          return "Bevételezési oldalon tudod megnyitni!";
        case 'This handling invoice date violates this monthly closer -> ':
          return "Ennek az anyag kezelésnek a dátuma sérti ezt a havi zárást -> ";
        case 'This new date violates this monthly closer -> ':
          return "Ez az új dátum sérti ezt a havi zárást -> ";
        case 'There is no any incoming for this invoice in the database!':
          return "Nincs ehhez a számlához bevételezés rendelve!";
        case 'There is no any incoming for this order in the database!':
          return "Nincs ehhez a megrendeléshez bevételezés rendelve!";
        case 'This raw material changes failed, because the linked handling violates this monthly close -> ':
          return "Ez az alapanyag változtatás a hozzá kapcsolt anyagkezelésen keresztül sérti ezt a havi zárást -> ";
        case 'This raw material aux changes failed, because the linked handling violates this monthly close -> ':
          return "Ez az egyéb tétel változtatás a hozzá kapcsolt anyagkezelésen keresztül sérti ezt a havi zárást -> ";
        case 'This raw material changes failed, because the linked invoice violates this monthly close -> ':
          return "Ez az alapanyag változtatás a hozzá kapcsolt számlán keresztül sérti ezt a havi zárást -> ";
        case 'This raw material aux changes failed, because the linked invoice violates this monthly close -> ':
          return "Ez az egyéb tétel változtatás a hozzá kapcsolt számlán keresztül sérti ezt a havi zárást -> ";
        case 'This delivery note number is not found in the database!':
          return "Ez a szállító szám nem található az adatbázisban!";
        case 'This is not an Incoming Number!':
          return "Ez nem egy bevételezési szám!";
        case 'This handling number is not found in the database!':
          return "Ez az alapanyag kezelési szám nem található az adatbázisban!";
        case 'Dated':
          return "Kelt";
        case 'Receipt of Raw Material':
          return "Alapanyag bevételezési bizonylat";
        case 'Handling History':
          return "Anyagkezelés történet";
        case 'Contractor':
          return "Kapcsolat";
        case 'There is an active Handling on this station!':
          return "Ezen az állomáson van egy aktív anyag kezelés!";
        case 'There is an active Incoming on this station!':
          return "Ezen az állomáson van egy aktív bevételezés!";
        case 'There is an active handling on this workstation, please reload the page!':
          return "Már van egy aktív anyag kezelés, kérlek töltsd újra az oldalt!";
        case 'Raw Material Order ID must be set!':
          return "Anyagrendelés azonosítóját meg kell adni!";
        case 'Invoice Date must be a valid format (YYYY-mm-dd)!':
          return "Esedékesség dátumának megfelelő formátumúnak kell lennie (YYYY-mm-dd)";
        case 'Movement Date must be a valid format (YYYY-mm-dd)!':
          return "Anyag mozgás dátumának megfelelő formátumúnak kell lennie (YYYY-mm-dd)";
        case 'Movement Date must be set!':
          return "Anyag mozgás dátumát meg kell adni!";
        case 'Raw Material Target Location Group ID must be set!':
          return "Alapanyag mozgatás céljának azonosítóját meg kell adni";
        case 'Raw Material Handling Reason ID must be set!':
          return "Alapanyag mozgatás azonosítóját meg kell adni!";
        case 'Leave Handling':
          return "Mozgatás Elhagyása";
        case 'Raw Material Add To Handling':
          return "Alapanyag hozzáadása a mozgatáshoz";
        case 'Raw Material Refund':
          return "Alapanyag Visszaküldés";
        case 'Raw Material Selling':
          return "Alapanyag Eladás";
        case 'Save Changes':
          return "Változtatások Mentése";
        case 'Handling Number':
          return "Mozgatás Azonosítója";
        case 'Destroy Handling':
          return "Mozgatás Megszüntetése";
        case 'Close Handling':
          return "Mozgatás Zárása";
        case 'Open Handling':
          return "Mozgatás Megnyitása";
        case 'Start New Handling':
          return "Új Mozgatás Kezdése";
        case 'Reason of Handling':
          return "Anyag Mozgatás Oka";
        case 'Raw Material Handling':
          return "Anyag Mozgatás";
        case 'This invoice date is before then the last monthly closer date ':
          return "A megadott dátum korábbi, mint a legutolsó hónap zárási dátuma ";
        case 'Movement':
          return "Mozgás";
        case 'Movement Date':
          return "Mozgás Dátuma";
        case 'Invoice Date':
          return "Teljesítés Dátuma";
        case 'Action Date':
          return "Akció Dátuma";
        case 'Modify Date':
          return "Dátum Módosítása";
        case 'Invoice Date (yyyy-mm-dd)':
          return "Teljesítés Dátuma (yyyy-mm-dd)";
        case 'Movement Date (yyyy-mm-dd)':
          return "Mozgás Dátuma (yyyy-mm-dd)";
        case 'Are you sure want to break link?':
          return "Biztossan meg akarod szüntetni a kapcsolatot?";
        case 'Break Link':
          return "Kapcsolat Bontása";
        case 'This raw material is not in the warehouse!':
          return "Ez az alapanyag nincs a raktárban!";
        case 'There is a duplication in database of ':
          return "Az adatbázisban már szerepel a(z) ";
        case 'This income is active on another workstation!':
          return "Ez a bevételezés aktív egy másik munkaállomáson!";
        case 'Delivery note number must be set and min. length at least 1 chars!':
          return "A szállítólevél számát meg kall adni és hossza minimum 1 karakter!";
        case 'Contractor Id must be set!':
          return "Beszállítót meg kell adni!";
        case 'Order number must be set and min. length at least 5 chars!':
          return "Megrendelés számot meg kell adni és hossza minimum 5 karakter!";
        case 'Can not found any income with this parameter!':
          return "Nem található bevételezés ezzel a paraméterrel!";
        case ' is not in the warehouse!':
          return " nincs a raktárban!";
        case 'Workstation ID must be set!':
          return "Munkaállomást be kell állítani!";
        case 'Return Invoice number must be set and min. length at least 1 chars!':
          return "Kimensző számla számot meg kell adni!";
        case 'Quantity changed ':
          return "Mennyiség változott ";
        case 'Scrap Other Cost':
          return "Egyéb Tétel Selejtezése";
        case 'Show Scrapped':
          return "Selejtezettek mutatása";
        case 'Create OGInv Report':
          return "Visszaküldési Riport Készítés";
        case 'This Raw Material Outgoing Raw Material Assign is not in the system!':
          return "Ez az alapanyag hozzárendelés nem létezik az adatbázisban!";
        case 'Qty Act.':
          return "Aktuális mennyiség";
        case 'Assign Raw Material':
          return "Alapanyag Hozzárendelése";
        case 'Raw Material Assign':
          return "Alapanyag Hozzárendelés";
        case 'Raw Material Assign to Outgoing':
          return "Alapanyag Hozzárendelés a Visszaküldéshez";
        case 'Outgoing must be created before!':
          return "A kimenő számlát először létre kell hozni!";
        case 'This outgoing is active on ':
          return "Ez a kimenő számla már aktív ezen a munkaállomáson ";
        case 'This Raw Material Outgoing is not in the system!':
          return "Ez a kimenő számla nem található a rendszerben!";
        case 'Close Outgoing Invoice':
          return "Kimenő Számla Zárása";
        case 'Open Existing Outgoing Invoice':
          return "Kimenő Számla Visszanyitása";
        case 'Add Inovice Other Cost':
          return "Egyéb Tétel Hozzáadása";
        case 'Add Raw Material':
          return "Alapanyag Hozzáadása";
        case 'Create/Save Outgoing':
          return "Kimenő számla Létrehozás / Mentés";
        case 'Raw Material Outgoing Number':
          return "Kimenő számla száma";
        case 'This other cost qty is only ':
          return "Ennek az egyéb tételnek a mennyisége csak ";
        case 'This invoice other cost is not in database!':
          return "Ez az egyéb tétel nem található az adatbázisban!";
        case 'Assign Aux':
          return "Egyéb Tétel Hozzárendelése";
        case 'Assign Qty.':
          return "Hozzárendelendő Mennyiség";
        case 'Selected AUX ID':
          return "Választott Sor Azonosító";
        case 'Raw Material Outgoing':
          return "Alapanyag Visszaküldés";
        case 'Return quantity must be equal or smaller!':
          return "A visszavett anyagmennyiség nem lehet több mint a hozzárendelés!";
        case 'This Assigned Invoice Other Cost is not found in the database!':
          return "Ez az alapanyag hozzárendelés nem található az adatbázisban!";
        case 'Handled qty must be a positive number!':
          return "A mozgatott mennyiségnek pozitív számnak kell lennie!";
        case 'There is an active assignment from this other cost to plant unit!':
          return "Ebből az egyéb tételből aktív hozzárendelés van legalább egy üzemegységhez!";
        case 'This Raw Material is not in a scrap status!':
          return "Ennek az alapanyagnak az állapota nem selejt!";
        case 'Remove Scrap Status':
          return "Selejtezés Visszavonása";
        case 'Scrap Raw Material':
          return "Alapanyag Selejtezése";
        case 'Scrap Reason':
          return "Selejtezés Oka";
        case 'Raw Material Scrapping':
          return "Alapanyag Selejtezés";
        case 'Raw Material Revoke Scrap':
          return "Selejtezés Visszavonása";
        case 'Invoice History':
          return "Számla Története";
        case 'Raw Material History':
          return "Alapanyag Története";
        case 'This release has already been closed!':
          return "Ez a kiadás már korábban le lett zárva!";
        case 'This item is already assigned!':
          return "Ez a tétel már korábban hozzá lett rendelve!";
        case 'Return Date (yyyy-mm-dd)':
          return "Visszavételezés Dátuma (éééé-hh-nn)";
        case 'Scrapping Date (yyyy-mm-dd)':
          return "Selejtezés Dátuma (éééé-hh-nn)";
        case 'Assign Date (yyyy-mm-dd)':
          return "Hozzárendelés Dátuma (éééé-hh-nn)";
        case 'Volume In Warehouse':
          return "Mennyiség Raktárban";
        case 'Show Assigned':
          return "Hozzárendeltek Mutatása";
        case 'Get Movement':
          return "Mozgások Lekérdezése";
        case 'End Date (yyyy-mm-dd)':
          return "Záró Dátum (éééé-hh-nn)";
        case 'Start Date (yyyy-mm-dd)':
          return "Kezdő Dátum (éééé-hh-nn)";
        case 'Raw Material Movements':
          return "Alapanyag mozgások";
        case 'Moved quantity must be a positive number!':
          return "A mennyiség csak pozitív szám lehet!";
        case 'Moved quantity must be equal or smaller!':
          return "A mennyiség nem lehet nagyobb!";
        case 'Invoice Filter':
          return "Invoice Filter";
        case 'Invoice Other Cost Return':
          return "Számla Egyéb Tétel Visszavétele";
        case 'Invoice Other Cost Assign':
          return "Számla Egyéb Tétel Hozzárendelés";
        case 'Raw Material Aux Assign to Handling':
          return "Egyéb Tétel Hozzárendelése a Mozgatáshoz";
        case 'Invoice Other Cost Scrap':
          return "Számla Egyéb Tétel Selejtezés";
        case 'Recipient':
          return "Átvevő";
        case 'Raw Material status is wrong!':
          return "Nem megfelelő az alapanyag státusza!";
        case 'There have been no releases on this workstation yet!':
          return "Még nem volt alapanyag kiadás ezen a munkaállomáson!";
        case 'This Raw Material Release is active on another workstation!':
          return "Ez az alapanyag kiadás aktív egy másik munkaállomáson!";
        case 'There is active income, please reload the page!':
          return "Már van egy aktív bevételezés, kérlek töltsd újra az oldalt!";
        case 'Clear Set':
          return "Beállítás Törlése";
        case 'Set':
          return "Beállítás";
        case 'Set Station':
          return "Munkaállomás Beállítás";
        case 'Workstation':
          return "Munkaállomás";
        case 'Action Log':
          return "Akció Történet";
        case 'Header':
          return "Fejléc";
        case 'Incoming History':
          return "Bevételezés Története";
        case 'URL':
          return "URL";
        case 'Raw Material must be select from the list!':
          return "Az alapanyagot a listából kell kiválasztani!";
        case 'Old RM Number':
          return "Hiányzó címke egyedi azonosítója";
        case 'This Raw Material is not in the warehouse according to the system!':
          return "Ez az anyag nincs a raktárban a rendszer szerint!";
        case 'List of Raw Material':
          return "Szűrésnek Megfelelő Alapanyagok";
        case 'Lost Identifier':
          return "Hiányzó azonosító";
        case 'Select a Printer!':
          return "Válassz Nyomtatót!";
        case 'Destroy':
          return "Megszüntetés";
        case 'Are you sure want to destroy?':
          return "Biztosan meg akarod szüntetni?";
        case 'Destroy Confirm':
          return "Megszüntetés Megerősítése";
        case 'Destroy Release':
          return "Kiadás Megszüntetése";
        case 'Last Recorded Volume':
          return "Utoljára rögzített mennyiség";
        case 'Reset':
          return "Visszaállítás";
        case 'Raw Material Location':
          return "Alapanyag Elhelyezkedése";
        case 'Take Back':
          return "Visszavételezés";
        case 'Remaining Volume':
          return "Megmaradt Mennyiség";
        case 'Raw Material Identify':
          return "Alapanyag Azonosítás";
        case 'Raw Material Take Back':
          return "Alapanyag Visszavételezés";
        case 'It must have a special character: [!, @, #, $, %, ^, &, *]':
          return "Tartalmazni kell legalább 1 speciális karaktert: [!, @, #, $, %, ^, &, *]";
        case 'It must have a small alphabet: [a to z]':
          return "Tartalmaznia kell legalább 1 kisbetűt: [a-tól z-ig]";
        case 'It must have a capital alphabet: [A to Z]':
          return "Tartalmaznia kell legalább 1 nagy betűt: [A-tól Z-ig]";
        case 'It must have a number: [0 to 9]':
          return "Tartalmaznia kell legalább 1 számot: [0-tól 9-ig]";
        case 'It should be at least 8 characters long: ********':
          return "Minimum 8 karakter hosszúnak kell lennie: ********";
        case 'ZPL':
          return "ZPL";
        case 'New':
          return "Új";
        case 'Add new invoice':
          return "Új számla hozzáadása";
        case 'In Warehouse':
          return "Raktárban";
        case 'Pcs.':
          return "Darabszám";
        case 'Report':
          return "Riport";
        case 'Other Cost Sets To InActive':
          return "Egyéb tétel inaktiválása";
        case 'Control Input':
          return "Ellenőrző mező";
        case 'Control Number':
          return "Ellenőrző szám";
        case 'Set to InActive':
          return "Inaktívra változtatás";
        case 'Raw Material Aux Set To Inactive':
          return "Egyéb Tétel Inaktiválása";
        case 'Raw Material Status Change':
          return "Alapanyag Státuszának Megváltoztatása";
        case 'Raw Material Status':
          return "Alapanyag Státusz";
        case 'Change Status':
          return "Státusz megváltoztatása";
        case 'Raw Material Aux Property Change':
          return "Egyéb tétel tulajdonságok változtatása";
        case 'Raw Material Property Change':
          return "Alapanyag tulajdonságok változtatása";
        case 'Raw Material Property Change':
          return "Alapanyag tulajdonságok változtatása";
        case 'Add New Invoice':
          return "Új számla hozzáadása";
        case 'Distributor must be set!':
          return "Beszállítót meg kel adni!";
        case 'Income Id must be set!':
          return "Bevételezés azonosítóját meg kel adni!";
        case 'Order Id must be set!':
          return "Megrendelés azonosítóját meg kell adni!";
        case 'Payment Date must be a valid format (YYYY-mm-dd)!':
          return "A fizetési határidőt megfelelő formában kell magadni(YYYY-mm-dd)!";
        case 'Payment Date must be set!':
          return "A fizetési határidőt meg kell adni!";
        case 'Exchange Rate must be set!':
          return "Az átváltási árfolyamot meg kell adni!";
        case 'Currency Type must be set!':
          return "A pénznemet meg kell adni!";
        case 'Invoice Number must be set!':
          return "A számla számot meg kell adni!";
        case 'Daily':
          return "Napi Feladatok";
        case 'Restore':
          return "Visszaállítás";
        case 'Incoming Date':
          return "Bevételezés Időpontja";
        case 'Incomer User':
          return "Bevételezést Végző";
        case 'Raw Material Release Modify':
          return "Alapanyag Kiadás Módosítása";
        case 'Incoming Modify':
          return "Bevételezés Módosítás";
        case 'Incoming Property':
          return "Bevételezés Tulajdonsága";
        case 'PartNumber':
          return "Termékszám";
        case 'PN':
          return "Termékszám";
        case 'Family':
          return "Család";
        case 'Owner':
          return "Tulajdonos";
        case 'Product':
          return "Termék";
        case 'General Label Printer':
          return "Címke Nyomtató";
        case 'Label Printer':
          return "Címke Nyomtató";
        case 'General':
          return "Általános";
        case 'Show InActive Content':
          return "Inaktív Tartalom Mutatása";
        case 'ZPL Template':
          return "ZPL Sablon Tartalom";
        case 'ZPL Base':
          return "ZPL Sablon";
        case 'ZPL Base Content':
          return "ZPL Sablon Tartalma";
        case 'ZPL Base List':
          return "ZPL Sablon Lista";
        case 'General ZPL Base':
          return "ZPL Sablon Beállítás";
        case 'The state of the Raw Material does not allow to split!':
          return "Az alapanyag ezen státuszában nem lehetséges a megosztás!";
        case 'This Raw Material is already added to release!':
          return "Ez az anyagszám már hozzá lett adva a kiadáshoz!";
        case 'This Raw Material Distributor is not in the system!':
          return "Ez a beszállító nem található a rendszerben!";
        case 'This Raw Material PN is not in the system!':
          return "Ez az anyagtörzsszám nem található a rendszerben!";
        case 'This Raw Material is not in the system!':
          return "Ez az alapanyagszám nem található a rendszerben!";
        case 'This Raw Material is inactive in the system!':
          return "Ez az anyagszám nem aktív a rendszerben!";
        case 'This Raw Material Release number is not in the database!':
          return "Ez a kiadási szám nem szerepel az adatbázisban!";
        case 'Make Split':
          return "Megosztás";
        case 'Splitted Quantity':
          return "Leválasztandó Mennyiség";
        case 'Actual Quantity':
          return "Aktuális Mennyiség";
        case 'Main Raw Material Number':
          return "Megosztandó Alapanyag Egyedi Azonosítója";
        case 'Raw Material Split':
          return "Alapanyag Megosztása";
        case 'Raw Material Unique Id':
          return "Alapanyag Egyedi Azonosítója";
        case 'Get Release Riport':
          return "Kiadási Riport";
        case 'Raw Material Release Content':
          return "Alapanyag Kiadás Tartalma";
        case 'Open Last Release':
          return "Utolsó Kiadás Megnyitása";
        case 'Open Release':
          return "Kiadás Megnyitása";
        case 'Close Release':
          return "Kiadás Lezárása";
        case 'Release Number':
          return "Kiadás Száma";
        case 'Start Release':
          return "Kiadás Kezdése";
        case 'Plant Unit':
          return "Gyártó Egység";
        case 'Raw Material Release Property':
          return "Alapanyag Kiadás Tulajdonság";
        case 'Raw Material Release':
          return "Alapanyag Kiadás";
        case 'Are you sure, you are going to drop the last printed label?':
          return "Biztosan eldobod az utoljára nyomtatott címkét?";
        case 'Open':
          return "Megnyitás";
        case 'Add Other Cost':
          return "Egyéb Tétel Hozzáadása";
        case 'Are You Sure?':
          return "Biztos vagy benne?";
        case 'Leave':
          return "Elhagy";
        case 'Close':
          return "Bezárás";
        case 'Total Cost':
          return "Teljes Költség (HUF)";
        case 'Total':
          return "Teljes";
        case 'Invoice Other Cost':
          return "Számla Egyéb Tétel";
        case 'Exchange Rate':
          return "Árfolyam";
        case 'Print failed, Response: ':
          return "Nyomtatási hiba, válasz: ";
        case 'Print succeeded!':
          return "Sikeres nyomtatás!";
        case 'Failed ...':
          return "Hiba ...";
        case 'Message sent to printer':
          return "Az üzenet el lett küldve a nyomtatóra";
        case 'New Raw Material entry created':
          return "Új alapanyag bejegyzés létrehozva";
        case 'Generated number: ':
          return "Következő szám: ";
        case 'Set the correct ZPL for Incoming_RM!':
          return "Az Incoming_RM ZPL-t megfelelően kell beállítani!";
        case 'Set the correct label printer URL for ':
          return "A printerhez megfelelő URL-t kell beállítani ";
        case 'Get Incoming Riport':
          return "Bevételezési Riport Készítés";
        case 'Show Group Item':
          return "Összegzett Sorok Mutatása";
        case 'Show Unique Item':
          return "Egyedi Tételek Mutatása";
        case 'Incoming Content':
          return "Bevételezés Tartalma";
        case 'Printing Log':
          return "Nyomtatási Történet";
        case 'Confirm of Label':
          return "Címke Visszaellenőrzés";
        case 'Clear LP Inputs':
          return "Beviteli mező ürítés";
        case 'Label Print':
          return "Címke Nyomtatás";
        case 'Comment':
          return "Megjegyzés";
        case 'DateCode':
          return "SARZS";
        case 'Total Price':
          return "Végösszeg";
        case 'Total Price in LC':
          return "Teljes Ár Forintban";
        case 'Unit Price in LC':
          return "Egységár Forintban";
        case 'Unit Price':
          return "Egységár";
        case 'Unit Quantity':
          return "Mennyiség";
        case 'Unit Qty.':
          return "Mennyiség";
        case 'Label Printing':
          return "Címke nyomtatás";
        case 'Status of Identify':
          return "Azonosítás Állapota";
        case 'Identify Finished':
          return "Azonosítás Befejezése";
        case 'Raw Material PN Number':
          return "Anyagtörzs Szám";
        case 'Raw Material Description':
          return "Anyagtörzs Megnevezés";
        case 'Raw Material Identify':
          return "Anyagtörzs Azonosítás";
        case 'New Raw Material Property':
          return "Új Azonosítás Kezdése";
        case 'Raw Material Manufacturer Description':
          return "Alapanyag Gyártói Megnevezés";
        case 'Raw Material Manufacturer PN Link':
          return "Anyagtörzs Alapanyag Link";
        case 'Raw Material Manufacturer PN':
          return "Alapanyag Gyártói Azonosító";
        case 'Raw Material Manufacturer':
          return "Alapanyag Gyártó";
        case 'Raw Material Property':
          return "Alapanyag Tulajdonság";
        case 'Close Incoming':
          return "Bevételezés Elhagyása";
        case 'Open Incoming':
          return "Bevételezés Megnyitása";
        case 'Incoming Number':
          return "Bevételezés száma";
        case 'Leave Incoming':
          return "Bevételezés Elhagyása";
        case 'Start Incoming':
          return "Bevételezés Indítása";
        case 'Delivery Date (yyyy-mm-dd)':
          return "Bevételezés dátuma (yyyy-mm-dd)";
        case 'Payment Date (yyyy-mm-dd)':
          return "Teljesítési dátum (yyyy-mm-dd)";
        case 'Invoice Number':
          return "Számla száma";
        case 'Delivery Note Number':
          return "Szállítólevélszám";
        case 'Raw Material Distributor':
          return "Alapanyag Beszállító";
        case 'Distributor':
          return "Beszállító";
        case 'Currency':
          return "Pénznem";
        case 'Currency Type':
          return "Pénznem";
        case 'Order Number':
          return "Megrendelésszám";
        case 'Shipment Identify':
          return "Szállítmány Azonosítás";
        case 'Add subordinate to':
          return "Beosztott hozzáadása";
        case 'E-mail':
          return "E-mail";
        case 'User to modify':
          return "Módosítandó felhasználó";
        case 'User to modify':
          return "Módosítandó felhasználó";
        case 'Modify':
          return "Módosítás";
        case 'Raw Material Incoming':
          return "Alapanyag Bevételezés";
        case 'Workstations':
          return "Munkaállomások";
        case 'BOM Description':
          return "BOM Meghatározás";
        case 'Raw Material List Description':
          return "Anyagtörzs Meghatározás";
        case 'Raw Material List PN':
          return "Anyagtörzs Szám";
        case 'BOM Row Identifier':
          return "BOM Sor Azonosító";
        case 'BOM Row Identify':
          return "BOM Sor Azonosítás";
        case 'Process BOM':
          return "BOM Feldolgozása";
        case 'Raw Material PN':
          return "Anyagtörzs Szám";
        case 'List':
          return "Anyagtörzs";
        case 'Unit Type':
          return "Mértékegység";
        case 'Description':
          return "AT Megnevezés";
        case 'Number':
          return "AT Szám";
        case 'Unit':
          return "Mértékegység";
        case 'Type':
          return "Típus";
        case 'Type of Unit':
          return "Mennyiség Típusa";
        case 'Revision':
          return "Revízió";
        case 'Product PN':
          return "Termékszám";
        case 'Product Family':
          return "Termék Család";
        case 'Product Owner':
          return "Termék Tulajdonos";
        case 'Self-managent is not possibe!':
          return "Nem lehetsz saját magad vezetője!";
        case 'Change Manager':
          return "Vezető váltás";
        case 'Drag and drop a file here or click':
          return "Dobj ide egy fájt vagy klikkelj";
        case 'Header Identify':
          return "Fejléc azonosítása";
        case 'Row# of Header':
          return "Fejléc sorának száma";
        case 'BOM Uploader':
          return "BOM Feltöltő";
        case 'Address':
          return "Cím";
        case 'Phone Number':
          return "Telefonszám";
        case 'Value to Filter':
          return "Érték a szűréshez";
        case 'Group':
          return "Csoport";
        case 'Raw Material PN':
          return "Alapanyag Azonosító";
        case 'Add Raw Material PN':
          return "Alapanyag Azonosító Hozzáadása";
        case 'Raw Material Group':
          return "Anyagtörzs Csoport";
        case 'Add Raw Material Group':
          return "Alapanyag Csoport Hozzáadása";
        case 'Add Raw Material Manufacturer':
          return "Alapanyag Gyártó Hozzáadás";
        case 'Manufacturer':
          return "Gyártó";
        case 'Raw Material':
          return "Alapanyag";
        case 'Setup':
          return "Beállítás";
        case 'Are you sure want to Save?':
          return "Biztosan menteni akarod?";
        case 'Save':
          return "Mentés";
        case 'Are you sure want to delete?':
          return "Biztosan törölni akarod?";
        case 'Del Confirm':
          return "Törlés megerősítése";
        case 'Are you sure want to Unlock?':
          return "Biztosan fel akarod oldani?";
        case 'Are you sure want to Close?':
          return "Biztosan be akarod zárni?";
        case 'Are you sure want to Leave?':
          return "Biztosan el akarod hagyni?";
        case 'Wrong password!':
          return "Hibás jelszó!";
        case 'New password':
          return "Új jelszó";
        case 'Old password':
          return "Régi jelszó";
        case 'Change Password':
          return "Jelszó változtatás";
        case 'Change':
          return "Csere";
        case 'Manager':
          return "Vezető";
        case 'Chg. Manager':
          return "Vezető váltás";
        case 'Logout':
          return "Kijelentkezés";
        case 'Yes':
          return "Igen";
        case 'No':
          return "Nem";
        case 'Del':
          return "Törlés";
        case 'Cancel':
          return "Mégsem";
        case 'Delete':
          return "Törlés";
        case 'Are you sure?':
          return "Biztos vagy benne?";
        case 'Rename':
          return "Átnevezés";
        case 'Active':
          return "Aktív";
        case 'Reset Password':
          return "Jelszó Visszaállítás";
        case 'Save Changes':
          return "Változtatások Mentése";
        case 'Add New':
          return "Új hozzáadása";
        case 'Value to':
          return "Érték, hogy";
        case 'Delete App Group':
          return "Szoftver Csoport Törlése";
        case 'Rename App Group':
          return "Szoftver Csoport Átnevezése";
        case 'Add App Group':
          return "Szoftver Csoport Hozzáadás";
        case 'Filter':
          return "Szűrő";
        case 'Language':
          return "Nyelv";
        case 'Contact Name':
          return "Kapcsolattartó Neve";
        case 'Name':
          return "Név";
        case 'Last Name':
          return "Vezeték Név";
        case 'First Name':
          return "Kereszt Név";
        case 'Add New':
          return "Új hozzáadása";
        case 'Unique Id.':
          return "Egyedi Azonosító";
        case 'Users':
          return "Felhasználók";
        case 'Users Hierarchy':
          return "Felhasználói hierarchia";
        case 'User Group':
          return "Felhasználói csoport";
        case 'App Privileges':
          return "Program hozzáférések";
        case 'You have no privileges to this page!':
          return "Nincs jogosultsága ehhez az oldalhoz!";
        case 'You have no privileges to this action!':
          return "Nincs jogosultsága ehhez a művelethez!";
        case 'Bad Request -> function is missing!':
          return "Hibás hívás -> function hiányzik!";
        case 'Are you sure you want to log out?':
          return "Biztosan ki akarsz lépni?";
        case 'Session is over, please relogin!':
          return "Munkamenet lejárt, jelentkezz be újra!";

        default:
          return "!-" . $text . "-!";
      }
    default:
      return $text;
  }
}
