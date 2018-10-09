<!-- Begin Main Menu -->
<?php

// Generate all menu items
$RootMenu->IsRoot = TRUE;
$RootMenu->AddMenuItem(4, "mmi_cf01_home_php", $Language->MenuPhrase("4", "MenuText"), "cf01_home.php", -1, "", AllowListMenu('{9A296957-6EE4-4785-AB71-310FFD71D6FE}cf01_home.php'), FALSE, TRUE);
$RootMenu->AddMenuItem(6, "mmci_Setup", $Language->MenuPhrase("6", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE);
$RootMenu->AddMenuItem(8, "mmi_t00_tahunajaran", $Language->MenuPhrase("8", "MenuText"), "t00_tahunajaranlist.php", 6, "", AllowListMenu('{9A296957-6EE4-4785-AB71-310FFD71D6FE}t00_tahunajaran'), FALSE, FALSE);
$RootMenu->AddMenuItem(1, "mmi_t96_employees", $Language->MenuPhrase("1", "MenuText"), "t96_employeeslist.php", 6, "", AllowListMenu('{9A296957-6EE4-4785-AB71-310FFD71D6FE}t96_employees'), FALSE, FALSE);
$RootMenu->AddMenuItem(2, "mmi_t97_userlevels", $Language->MenuPhrase("2", "MenuText"), "t97_userlevelslist.php", 6, "", (@$_SESSION[EW_SESSION_USER_LEVEL] & EW_ALLOW_ADMIN) == EW_ALLOW_ADMIN, FALSE, FALSE);
$RootMenu->AddMenuItem(7, "mmci_List", $Language->MenuPhrase("7", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE);
$RootMenu->AddMenuItem(5, "mmi_t99_audittrail", $Language->MenuPhrase("5", "MenuText"), "t99_audittraillist.php", -1, "", AllowListMenu('{9A296957-6EE4-4785-AB71-310FFD71D6FE}t99_audittrail'), FALSE, FALSE);
$RootMenu->AddMenuItem(-2, "mmi_changepwd", $Language->Phrase("ChangePwd"), "changepwd.php", -1, "", IsLoggedIn() && !IsSysAdmin());
$RootMenu->AddMenuItem(-1, "mmi_logout", $Language->Phrase("Logout"), "logout.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(-1, "mmi_login", $Language->Phrase("Login"), "login.php", -1, "", !IsLoggedIn() && substr(@$_SERVER["URL"], -1 * strlen("login.php")) <> "login.php");
$RootMenu->Render();
?>
<!-- End Main Menu -->
