<!-- Begin Main Menu -->
<?php

// Generate all menu items
$RootMenu->IsRoot = TRUE;
$RootMenu->AddMenuItem(4, "mmi_cf01_home_php", $Language->MenuPhrase("4", "MenuText"), "cf01_home.php", -1, "", AllowListMenu('{9A296957-6EE4-4785-AB71-310FFD71D6FE}cf01_home.php'), FALSE, TRUE);
$RootMenu->AddMenuItem(28, "mmci_Pembayaran", $Language->MenuPhrase("28", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE);
$RootMenu->AddMenuItem(20, "mmi_t06_siswarutinbayar", $Language->MenuPhrase("20", "MenuText"), "t06_siswarutinbayarlist.php?cmd=resetall", 28, "", AllowListMenu('{9A296957-6EE4-4785-AB71-310FFD71D6FE}t06_siswarutinbayar'), FALSE, FALSE);
$RootMenu->AddMenuItem(31, "mmi_t09_siswanonrutinbayar", $Language->MenuPhrase("31", "MenuText"), "t09_siswanonrutinbayarlist.php?cmd=resetall", 28, "", AllowListMenu('{9A296957-6EE4-4785-AB71-310FFD71D6FE}t09_siswanonrutinbayar'), FALSE, FALSE);
$RootMenu->AddMenuItem(6, "mmci_Setup", $Language->MenuPhrase("6", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE);
$RootMenu->AddMenuItem(8, "mmi_t00_tahunajaran", $Language->MenuPhrase("8", "MenuText"), "t00_tahunajaranlist.php", 6, "", AllowListMenu('{9A296957-6EE4-4785-AB71-310FFD71D6FE}t00_tahunajaran'), FALSE, FALSE);
$RootMenu->AddMenuItem(9, "mmi_t01_sekolah", $Language->MenuPhrase("9", "MenuText"), "t01_sekolahlist.php", 6, "", AllowListMenu('{9A296957-6EE4-4785-AB71-310FFD71D6FE}t01_sekolah'), FALSE, FALSE);
$RootMenu->AddMenuItem(10, "mmi_t02_kelas", $Language->MenuPhrase("10", "MenuText"), "t02_kelaslist.php", 6, "", AllowListMenu('{9A296957-6EE4-4785-AB71-310FFD71D6FE}t02_kelas'), FALSE, FALSE);
$RootMenu->AddMenuItem(18, "mmci_Jenis_Pembayaran", $Language->MenuPhrase("18", "MenuText"), "", 6, "", IsLoggedIn(), FALSE, TRUE);
$RootMenu->AddMenuItem(12, "mmi_t04_rutin", $Language->MenuPhrase("12", "MenuText"), "t04_rutinlist.php", 18, "", AllowListMenu('{9A296957-6EE4-4785-AB71-310FFD71D6FE}t04_rutin'), FALSE, FALSE);
$RootMenu->AddMenuItem(29, "mmi_t07_nonrutin", $Language->MenuPhrase("29", "MenuText"), "t07_nonrutinlist.php", 18, "", AllowListMenu('{9A296957-6EE4-4785-AB71-310FFD71D6FE}t07_nonrutin'), FALSE, FALSE);
$RootMenu->AddMenuItem(11, "mmi_t03_siswa", $Language->MenuPhrase("11", "MenuText"), "t03_siswalist.php", 6, "", AllowListMenu('{9A296957-6EE4-4785-AB71-310FFD71D6FE}t03_siswa'), FALSE, FALSE);
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
