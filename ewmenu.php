<!-- Begin Main Menu -->
<?php $RootMenu = new cMenu(EW_MENUBAR_ID) ?>
<?php

// Generate all menu items
$RootMenu->IsRoot = TRUE;
$RootMenu->AddMenuItem(4, "mi_cf01_home_php", $Language->MenuPhrase("4", "MenuText"), "cf01_home.php", -1, "", AllowListMenu('{9A296957-6EE4-4785-AB71-310FFD71D6FE}cf01_home.php'), FALSE, TRUE);
$RootMenu->AddMenuItem(28, "mci_Pembayaran", $Language->MenuPhrase("28", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE);
$RootMenu->AddMenuItem(20, "mi_t06_siswarutinbayar", $Language->MenuPhrase("20", "MenuText"), "t06_siswarutinbayarlist.php", 28, "", AllowListMenu('{9A296957-6EE4-4785-AB71-310FFD71D6FE}t06_siswarutinbayar'), FALSE, FALSE);
$RootMenu->AddMenuItem(33, "mi_t06_siswarutinbayar_2", $Language->MenuPhrase("33", "MenuText"), "t06_siswarutinbayar_2list.php", 28, "", AllowListMenu('{9A296957-6EE4-4785-AB71-310FFD71D6FE}t06_siswarutinbayar_2'), FALSE, FALSE);
$RootMenu->AddMenuItem(32, "mi_v01_siswanonrutin", $Language->MenuPhrase("32", "MenuText"), "v01_siswanonrutinlist.php", 28, "", AllowListMenu('{9A296957-6EE4-4785-AB71-310FFD71D6FE}v01_siswanonrutin'), FALSE, FALSE);
$RootMenu->AddMenuItem(6, "mci_Setup", $Language->MenuPhrase("6", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE);
$RootMenu->AddMenuItem(8, "mi_t00_tahunajaran", $Language->MenuPhrase("8", "MenuText"), "t00_tahunajaranlist.php", 6, "", AllowListMenu('{9A296957-6EE4-4785-AB71-310FFD71D6FE}t00_tahunajaran'), FALSE, FALSE);
$RootMenu->AddMenuItem(9, "mi_t01_sekolah", $Language->MenuPhrase("9", "MenuText"), "t01_sekolahlist.php", 6, "", AllowListMenu('{9A296957-6EE4-4785-AB71-310FFD71D6FE}t01_sekolah'), FALSE, FALSE);
$RootMenu->AddMenuItem(10, "mi_t02_kelas", $Language->MenuPhrase("10", "MenuText"), "t02_kelaslist.php", 6, "", AllowListMenu('{9A296957-6EE4-4785-AB71-310FFD71D6FE}t02_kelas'), FALSE, FALSE);
$RootMenu->AddMenuItem(18, "mci_Jenis_Pembayaran", $Language->MenuPhrase("18", "MenuText"), "", 6, "", IsLoggedIn(), FALSE, TRUE);
$RootMenu->AddMenuItem(12, "mi_t04_rutin", $Language->MenuPhrase("12", "MenuText"), "t04_rutinlist.php", 18, "", AllowListMenu('{9A296957-6EE4-4785-AB71-310FFD71D6FE}t04_rutin'), FALSE, FALSE);
$RootMenu->AddMenuItem(29, "mi_t07_nonrutin", $Language->MenuPhrase("29", "MenuText"), "t07_nonrutinlist.php", 18, "", AllowListMenu('{9A296957-6EE4-4785-AB71-310FFD71D6FE}t07_nonrutin'), FALSE, FALSE);
$RootMenu->AddMenuItem(11, "mi_t03_siswa", $Language->MenuPhrase("11", "MenuText"), "t03_siswalist.php", 6, "", AllowListMenu('{9A296957-6EE4-4785-AB71-310FFD71D6FE}t03_siswa'), FALSE, FALSE);
$RootMenu->AddMenuItem(1, "mi_t96_employees", $Language->MenuPhrase("1", "MenuText"), "t96_employeeslist.php", 6, "", AllowListMenu('{9A296957-6EE4-4785-AB71-310FFD71D6FE}t96_employees'), FALSE, FALSE);
$RootMenu->AddMenuItem(2, "mi_t97_userlevels", $Language->MenuPhrase("2", "MenuText"), "t97_userlevelslist.php", 6, "", (@$_SESSION[EW_SESSION_USER_LEVEL] & EW_ALLOW_ADMIN) == EW_ALLOW_ADMIN, FALSE, FALSE);
$RootMenu->AddMenuItem(7, "mci_List", $Language->MenuPhrase("7", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE);
$RootMenu->AddMenuItem(5, "mi_t99_audittrail", $Language->MenuPhrase("5", "MenuText"), "t99_audittraillist.php", -1, "", AllowListMenu('{9A296957-6EE4-4785-AB71-310FFD71D6FE}t99_audittrail'), FALSE, FALSE);
$RootMenu->AddMenuItem(-2, "mi_changepwd", $Language->Phrase("ChangePwd"), "changepwd.php", -1, "", IsLoggedIn() && !IsSysAdmin());
$RootMenu->AddMenuItem(-1, "mi_logout", $Language->Phrase("Logout"), "logout.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(-1, "mi_login", $Language->Phrase("Login"), "login.php", -1, "", !IsLoggedIn() && substr(@$_SERVER["URL"], -1 * strlen("login.php")) <> "login.php");
$RootMenu->Render();
?>
<!-- End Main Menu -->
