<?php include_once "t96_employeesinfo.php" ?>
<?php

// Create page object
if (!isset($t06_siswarutinbayar_2_grid)) $t06_siswarutinbayar_2_grid = new ct06_siswarutinbayar_2_grid();

// Page init
$t06_siswarutinbayar_2_grid->Page_Init();

// Page main
$t06_siswarutinbayar_2_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t06_siswarutinbayar_2_grid->Page_Render();
?>
<?php if ($t06_siswarutinbayar_2->Export == "") { ?>
<script type="text/javascript">

// Form object
var ft06_siswarutinbayar_2grid = new ew_Form("ft06_siswarutinbayar_2grid", "grid");
ft06_siswarutinbayar_2grid.FormKeyCountName = '<?php echo $t06_siswarutinbayar_2_grid->FormKeyCountName ?>';

// Validate form
ft06_siswarutinbayar_2grid.Validate = function() {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.GetForm(), $fobj = $(fobj);
	if ($fobj.find("#a_confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.FormKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = $fobj.find("#a_list").val() == "gridinsert";
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
		var checkrow = (gridinsert) ? !this.EmptyRow(infix) : true;
		if (checkrow) {
			addcnt++;
			elm = this.GetElements("x" + infix + "_siswa_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t06_siswarutinbayar_2->siswa_id->FldCaption(), $t06_siswarutinbayar_2->siswa_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_rutin_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t06_siswarutinbayar_2->rutin_id->FldCaption(), $t06_siswarutinbayar_2->rutin_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_periode_awal");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t06_siswarutinbayar_2->periode_awal->FldCaption(), $t06_siswarutinbayar_2->periode_awal->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_periode_akhir");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t06_siswarutinbayar_2->periode_akhir->FldCaption(), $t06_siswarutinbayar_2->periode_akhir->ReqErrMsg)) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
ft06_siswarutinbayar_2grid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "siswa_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Siswa_Nomor_Induk", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Siswa_Nama", false)) return false;
	if (ew_ValueChanged(fobj, infix, "rutin_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "periode_awal", false)) return false;
	if (ew_ValueChanged(fobj, infix, "periode_akhir", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Bayar_Jumlah", false)) return false;
	return true;
}

// Form_CustomValidate event
ft06_siswarutinbayar_2grid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft06_siswarutinbayar_2grid.ValidateRequired = true;
<?php } else { ?>
ft06_siswarutinbayar_2grid.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
ft06_siswarutinbayar_2grid.Lists["x_siswa_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Nomor_Induk","x_Nama","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t03_siswa"};
ft06_siswarutinbayar_2grid.Lists["x_rutin_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Nama","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t04_rutin"};
ft06_siswarutinbayar_2grid.Lists["x_periode_awal"] = {"LinkField":"x_Periode","Ajax":true,"AutoFill":false,"DisplayFields":["x_Periode2","x_id","x_Bayar_Jumlah",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"v02_siswarutinbayar"};
ft06_siswarutinbayar_2grid.Lists["x_periode_akhir"] = {"LinkField":"x_Periode","Ajax":true,"AutoFill":false,"DisplayFields":["x_Periode2","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"v02_siswarutinbayar"};

// Form object for search
</script>
<?php } ?>
<?php
if ($t06_siswarutinbayar_2->CurrentAction == "gridadd") {
	if ($t06_siswarutinbayar_2->CurrentMode == "copy") {
		$bSelectLimit = $t06_siswarutinbayar_2_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$t06_siswarutinbayar_2_grid->TotalRecs = $t06_siswarutinbayar_2->SelectRecordCount();
			$t06_siswarutinbayar_2_grid->Recordset = $t06_siswarutinbayar_2_grid->LoadRecordset($t06_siswarutinbayar_2_grid->StartRec-1, $t06_siswarutinbayar_2_grid->DisplayRecs);
		} else {
			if ($t06_siswarutinbayar_2_grid->Recordset = $t06_siswarutinbayar_2_grid->LoadRecordset())
				$t06_siswarutinbayar_2_grid->TotalRecs = $t06_siswarutinbayar_2_grid->Recordset->RecordCount();
		}
		$t06_siswarutinbayar_2_grid->StartRec = 1;
		$t06_siswarutinbayar_2_grid->DisplayRecs = $t06_siswarutinbayar_2_grid->TotalRecs;
	} else {
		$t06_siswarutinbayar_2->CurrentFilter = "0=1";
		$t06_siswarutinbayar_2_grid->StartRec = 1;
		$t06_siswarutinbayar_2_grid->DisplayRecs = $t06_siswarutinbayar_2->GridAddRowCount;
	}
	$t06_siswarutinbayar_2_grid->TotalRecs = $t06_siswarutinbayar_2_grid->DisplayRecs;
	$t06_siswarutinbayar_2_grid->StopRec = $t06_siswarutinbayar_2_grid->DisplayRecs;
} else {
	$bSelectLimit = $t06_siswarutinbayar_2_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($t06_siswarutinbayar_2_grid->TotalRecs <= 0)
			$t06_siswarutinbayar_2_grid->TotalRecs = $t06_siswarutinbayar_2->SelectRecordCount();
	} else {
		if (!$t06_siswarutinbayar_2_grid->Recordset && ($t06_siswarutinbayar_2_grid->Recordset = $t06_siswarutinbayar_2_grid->LoadRecordset()))
			$t06_siswarutinbayar_2_grid->TotalRecs = $t06_siswarutinbayar_2_grid->Recordset->RecordCount();
	}
	$t06_siswarutinbayar_2_grid->StartRec = 1;
	$t06_siswarutinbayar_2_grid->DisplayRecs = $t06_siswarutinbayar_2_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$t06_siswarutinbayar_2_grid->Recordset = $t06_siswarutinbayar_2_grid->LoadRecordset($t06_siswarutinbayar_2_grid->StartRec-1, $t06_siswarutinbayar_2_grid->DisplayRecs);

	// Set no record found message
	if ($t06_siswarutinbayar_2->CurrentAction == "" && $t06_siswarutinbayar_2_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$t06_siswarutinbayar_2_grid->setWarningMessage(ew_DeniedMsg());
		if ($t06_siswarutinbayar_2_grid->SearchWhere == "0=101")
			$t06_siswarutinbayar_2_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$t06_siswarutinbayar_2_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$t06_siswarutinbayar_2_grid->RenderOtherOptions();
?>
<?php $t06_siswarutinbayar_2_grid->ShowPageHeader(); ?>
<?php
$t06_siswarutinbayar_2_grid->ShowMessage();
?>
<?php if ($t06_siswarutinbayar_2_grid->TotalRecs > 0 || $t06_siswarutinbayar_2->CurrentAction <> "") { ?>
<div class="panel panel-default ewGrid t06_siswarutinbayar_2">
<div id="ft06_siswarutinbayar_2grid" class="ewForm form-inline">
<?php if ($t06_siswarutinbayar_2_grid->ShowOtherOptions) { ?>
<div class="panel-heading ewGridUpperPanel">
<?php
	foreach ($t06_siswarutinbayar_2_grid->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="gmp_t06_siswarutinbayar_2" class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<table id="tbl_t06_siswarutinbayar_2grid" class="table ewTable">
<?php echo $t06_siswarutinbayar_2->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Header row
$t06_siswarutinbayar_2_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$t06_siswarutinbayar_2_grid->RenderListOptions();

// Render list options (header, left)
$t06_siswarutinbayar_2_grid->ListOptions->Render("header", "left");
?>
<?php if ($t06_siswarutinbayar_2->siswa_id->Visible) { // siswa_id ?>
	<?php if ($t06_siswarutinbayar_2->SortUrl($t06_siswarutinbayar_2->siswa_id) == "") { ?>
		<th data-name="siswa_id"><div id="elh_t06_siswarutinbayar_2_siswa_id" class="t06_siswarutinbayar_2_siswa_id"><div class="ewTableHeaderCaption"><?php echo $t06_siswarutinbayar_2->siswa_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="siswa_id"><div><div id="elh_t06_siswarutinbayar_2_siswa_id" class="t06_siswarutinbayar_2_siswa_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t06_siswarutinbayar_2->siswa_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t06_siswarutinbayar_2->siswa_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t06_siswarutinbayar_2->siswa_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t06_siswarutinbayar_2->Siswa_Nomor_Induk->Visible) { // Siswa_Nomor_Induk ?>
	<?php if ($t06_siswarutinbayar_2->SortUrl($t06_siswarutinbayar_2->Siswa_Nomor_Induk) == "") { ?>
		<th data-name="Siswa_Nomor_Induk"><div id="elh_t06_siswarutinbayar_2_Siswa_Nomor_Induk" class="t06_siswarutinbayar_2_Siswa_Nomor_Induk"><div class="ewTableHeaderCaption"><?php echo $t06_siswarutinbayar_2->Siswa_Nomor_Induk->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Siswa_Nomor_Induk"><div><div id="elh_t06_siswarutinbayar_2_Siswa_Nomor_Induk" class="t06_siswarutinbayar_2_Siswa_Nomor_Induk">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t06_siswarutinbayar_2->Siswa_Nomor_Induk->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t06_siswarutinbayar_2->Siswa_Nomor_Induk->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t06_siswarutinbayar_2->Siswa_Nomor_Induk->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t06_siswarutinbayar_2->Siswa_Nama->Visible) { // Siswa_Nama ?>
	<?php if ($t06_siswarutinbayar_2->SortUrl($t06_siswarutinbayar_2->Siswa_Nama) == "") { ?>
		<th data-name="Siswa_Nama"><div id="elh_t06_siswarutinbayar_2_Siswa_Nama" class="t06_siswarutinbayar_2_Siswa_Nama"><div class="ewTableHeaderCaption"><?php echo $t06_siswarutinbayar_2->Siswa_Nama->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Siswa_Nama"><div><div id="elh_t06_siswarutinbayar_2_Siswa_Nama" class="t06_siswarutinbayar_2_Siswa_Nama">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t06_siswarutinbayar_2->Siswa_Nama->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t06_siswarutinbayar_2->Siswa_Nama->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t06_siswarutinbayar_2->Siswa_Nama->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t06_siswarutinbayar_2->rutin_id->Visible) { // rutin_id ?>
	<?php if ($t06_siswarutinbayar_2->SortUrl($t06_siswarutinbayar_2->rutin_id) == "") { ?>
		<th data-name="rutin_id"><div id="elh_t06_siswarutinbayar_2_rutin_id" class="t06_siswarutinbayar_2_rutin_id"><div class="ewTableHeaderCaption"><?php echo $t06_siswarutinbayar_2->rutin_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="rutin_id"><div><div id="elh_t06_siswarutinbayar_2_rutin_id" class="t06_siswarutinbayar_2_rutin_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t06_siswarutinbayar_2->rutin_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t06_siswarutinbayar_2->rutin_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t06_siswarutinbayar_2->rutin_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t06_siswarutinbayar_2->periode_awal->Visible) { // periode_awal ?>
	<?php if ($t06_siswarutinbayar_2->SortUrl($t06_siswarutinbayar_2->periode_awal) == "") { ?>
		<th data-name="periode_awal"><div id="elh_t06_siswarutinbayar_2_periode_awal" class="t06_siswarutinbayar_2_periode_awal"><div class="ewTableHeaderCaption"><?php echo $t06_siswarutinbayar_2->periode_awal->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="periode_awal"><div><div id="elh_t06_siswarutinbayar_2_periode_awal" class="t06_siswarutinbayar_2_periode_awal">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t06_siswarutinbayar_2->periode_awal->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t06_siswarutinbayar_2->periode_awal->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t06_siswarutinbayar_2->periode_awal->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t06_siswarutinbayar_2->periode_akhir->Visible) { // periode_akhir ?>
	<?php if ($t06_siswarutinbayar_2->SortUrl($t06_siswarutinbayar_2->periode_akhir) == "") { ?>
		<th data-name="periode_akhir"><div id="elh_t06_siswarutinbayar_2_periode_akhir" class="t06_siswarutinbayar_2_periode_akhir"><div class="ewTableHeaderCaption"><?php echo $t06_siswarutinbayar_2->periode_akhir->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="periode_akhir"><div><div id="elh_t06_siswarutinbayar_2_periode_akhir" class="t06_siswarutinbayar_2_periode_akhir">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t06_siswarutinbayar_2->periode_akhir->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t06_siswarutinbayar_2->periode_akhir->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t06_siswarutinbayar_2->periode_akhir->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t06_siswarutinbayar_2->Bayar_Jumlah->Visible) { // Bayar_Jumlah ?>
	<?php if ($t06_siswarutinbayar_2->SortUrl($t06_siswarutinbayar_2->Bayar_Jumlah) == "") { ?>
		<th data-name="Bayar_Jumlah"><div id="elh_t06_siswarutinbayar_2_Bayar_Jumlah" class="t06_siswarutinbayar_2_Bayar_Jumlah"><div class="ewTableHeaderCaption"><?php echo $t06_siswarutinbayar_2->Bayar_Jumlah->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Bayar_Jumlah"><div><div id="elh_t06_siswarutinbayar_2_Bayar_Jumlah" class="t06_siswarutinbayar_2_Bayar_Jumlah">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t06_siswarutinbayar_2->Bayar_Jumlah->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t06_siswarutinbayar_2->Bayar_Jumlah->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t06_siswarutinbayar_2->Bayar_Jumlah->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$t06_siswarutinbayar_2_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$t06_siswarutinbayar_2_grid->StartRec = 1;
$t06_siswarutinbayar_2_grid->StopRec = $t06_siswarutinbayar_2_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($t06_siswarutinbayar_2_grid->FormKeyCountName) && ($t06_siswarutinbayar_2->CurrentAction == "gridadd" || $t06_siswarutinbayar_2->CurrentAction == "gridedit" || $t06_siswarutinbayar_2->CurrentAction == "F")) {
		$t06_siswarutinbayar_2_grid->KeyCount = $objForm->GetValue($t06_siswarutinbayar_2_grid->FormKeyCountName);
		$t06_siswarutinbayar_2_grid->StopRec = $t06_siswarutinbayar_2_grid->StartRec + $t06_siswarutinbayar_2_grid->KeyCount - 1;
	}
}
$t06_siswarutinbayar_2_grid->RecCnt = $t06_siswarutinbayar_2_grid->StartRec - 1;
if ($t06_siswarutinbayar_2_grid->Recordset && !$t06_siswarutinbayar_2_grid->Recordset->EOF) {
	$t06_siswarutinbayar_2_grid->Recordset->MoveFirst();
	$bSelectLimit = $t06_siswarutinbayar_2_grid->UseSelectLimit;
	if (!$bSelectLimit && $t06_siswarutinbayar_2_grid->StartRec > 1)
		$t06_siswarutinbayar_2_grid->Recordset->Move($t06_siswarutinbayar_2_grid->StartRec - 1);
} elseif (!$t06_siswarutinbayar_2->AllowAddDeleteRow && $t06_siswarutinbayar_2_grid->StopRec == 0) {
	$t06_siswarutinbayar_2_grid->StopRec = $t06_siswarutinbayar_2->GridAddRowCount;
}

// Initialize aggregate
$t06_siswarutinbayar_2->RowType = EW_ROWTYPE_AGGREGATEINIT;
$t06_siswarutinbayar_2->ResetAttrs();
$t06_siswarutinbayar_2_grid->RenderRow();
if ($t06_siswarutinbayar_2->CurrentAction == "gridadd")
	$t06_siswarutinbayar_2_grid->RowIndex = 0;
if ($t06_siswarutinbayar_2->CurrentAction == "gridedit")
	$t06_siswarutinbayar_2_grid->RowIndex = 0;
while ($t06_siswarutinbayar_2_grid->RecCnt < $t06_siswarutinbayar_2_grid->StopRec) {
	$t06_siswarutinbayar_2_grid->RecCnt++;
	if (intval($t06_siswarutinbayar_2_grid->RecCnt) >= intval($t06_siswarutinbayar_2_grid->StartRec)) {
		$t06_siswarutinbayar_2_grid->RowCnt++;
		if ($t06_siswarutinbayar_2->CurrentAction == "gridadd" || $t06_siswarutinbayar_2->CurrentAction == "gridedit" || $t06_siswarutinbayar_2->CurrentAction == "F") {
			$t06_siswarutinbayar_2_grid->RowIndex++;
			$objForm->Index = $t06_siswarutinbayar_2_grid->RowIndex;
			if ($objForm->HasValue($t06_siswarutinbayar_2_grid->FormActionName))
				$t06_siswarutinbayar_2_grid->RowAction = strval($objForm->GetValue($t06_siswarutinbayar_2_grid->FormActionName));
			elseif ($t06_siswarutinbayar_2->CurrentAction == "gridadd")
				$t06_siswarutinbayar_2_grid->RowAction = "insert";
			else
				$t06_siswarutinbayar_2_grid->RowAction = "";
		}

		// Set up key count
		$t06_siswarutinbayar_2_grid->KeyCount = $t06_siswarutinbayar_2_grid->RowIndex;

		// Init row class and style
		$t06_siswarutinbayar_2->ResetAttrs();
		$t06_siswarutinbayar_2->CssClass = "";
		if ($t06_siswarutinbayar_2->CurrentAction == "gridadd") {
			if ($t06_siswarutinbayar_2->CurrentMode == "copy") {
				$t06_siswarutinbayar_2_grid->LoadRowValues($t06_siswarutinbayar_2_grid->Recordset); // Load row values
				$t06_siswarutinbayar_2_grid->SetRecordKey($t06_siswarutinbayar_2_grid->RowOldKey, $t06_siswarutinbayar_2_grid->Recordset); // Set old record key
			} else {
				$t06_siswarutinbayar_2_grid->LoadDefaultValues(); // Load default values
				$t06_siswarutinbayar_2_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$t06_siswarutinbayar_2_grid->LoadRowValues($t06_siswarutinbayar_2_grid->Recordset); // Load row values
		}
		$t06_siswarutinbayar_2->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($t06_siswarutinbayar_2->CurrentAction == "gridadd") // Grid add
			$t06_siswarutinbayar_2->RowType = EW_ROWTYPE_ADD; // Render add
		if ($t06_siswarutinbayar_2->CurrentAction == "gridadd" && $t06_siswarutinbayar_2->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$t06_siswarutinbayar_2_grid->RestoreCurrentRowFormValues($t06_siswarutinbayar_2_grid->RowIndex); // Restore form values
		if ($t06_siswarutinbayar_2->CurrentAction == "gridedit") { // Grid edit
			if ($t06_siswarutinbayar_2->EventCancelled) {
				$t06_siswarutinbayar_2_grid->RestoreCurrentRowFormValues($t06_siswarutinbayar_2_grid->RowIndex); // Restore form values
			}
			if ($t06_siswarutinbayar_2_grid->RowAction == "insert")
				$t06_siswarutinbayar_2->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$t06_siswarutinbayar_2->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($t06_siswarutinbayar_2->CurrentAction == "gridedit" && ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_EDIT || $t06_siswarutinbayar_2->RowType == EW_ROWTYPE_ADD) && $t06_siswarutinbayar_2->EventCancelled) // Update failed
			$t06_siswarutinbayar_2_grid->RestoreCurrentRowFormValues($t06_siswarutinbayar_2_grid->RowIndex); // Restore form values
		if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_EDIT) // Edit row
			$t06_siswarutinbayar_2_grid->EditRowCnt++;
		if ($t06_siswarutinbayar_2->CurrentAction == "F") // Confirm row
			$t06_siswarutinbayar_2_grid->RestoreCurrentRowFormValues($t06_siswarutinbayar_2_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$t06_siswarutinbayar_2->RowAttrs = array_merge($t06_siswarutinbayar_2->RowAttrs, array('data-rowindex'=>$t06_siswarutinbayar_2_grid->RowCnt, 'id'=>'r' . $t06_siswarutinbayar_2_grid->RowCnt . '_t06_siswarutinbayar_2', 'data-rowtype'=>$t06_siswarutinbayar_2->RowType));

		// Render row
		$t06_siswarutinbayar_2_grid->RenderRow();

		// Render list options
		$t06_siswarutinbayar_2_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t06_siswarutinbayar_2_grid->RowAction <> "delete" && $t06_siswarutinbayar_2_grid->RowAction <> "insertdelete" && !($t06_siswarutinbayar_2_grid->RowAction == "insert" && $t06_siswarutinbayar_2->CurrentAction == "F" && $t06_siswarutinbayar_2_grid->EmptyRow())) {
?>
	<tr<?php echo $t06_siswarutinbayar_2->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t06_siswarutinbayar_2_grid->ListOptions->Render("body", "left", $t06_siswarutinbayar_2_grid->RowCnt);
?>
	<?php if ($t06_siswarutinbayar_2->siswa_id->Visible) { // siswa_id ?>
		<td data-name="siswa_id"<?php echo $t06_siswarutinbayar_2->siswa_id->CellAttributes() ?>>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($t06_siswarutinbayar_2->siswa_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $t06_siswarutinbayar_2_grid->RowCnt ?>_t06_siswarutinbayar_2_siswa_id" class="form-group t06_siswarutinbayar_2_siswa_id">
<span<?php echo $t06_siswarutinbayar_2->siswa_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t06_siswarutinbayar_2->siswa_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_siswa_id" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_siswa_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->siswa_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t06_siswarutinbayar_2_grid->RowCnt ?>_t06_siswarutinbayar_2_siswa_id" class="form-group t06_siswarutinbayar_2_siswa_id">
<?php
$wrkonchange = trim(" " . @$t06_siswarutinbayar_2->siswa_id->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$t06_siswarutinbayar_2->siswa_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_siswa_id" style="white-space: nowrap; z-index: <?php echo (9000 - $t06_siswarutinbayar_2_grid->RowCnt * 10) ?>">
	<input type="text" name="sv_x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_siswa_id" id="sv_x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_siswa_id" value="<?php echo $t06_siswarutinbayar_2->siswa_id->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->siswa_id->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->siswa_id->getPlaceHolder()) ?>"<?php echo $t06_siswarutinbayar_2->siswa_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_siswa_id" data-value-separator="<?php echo $t06_siswarutinbayar_2->siswa_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_siswa_id" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_siswa_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->siswa_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<input type="hidden" name="q_x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_siswa_id" id="q_x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_siswa_id" value="<?php echo $t06_siswarutinbayar_2->siswa_id->LookupFilterQuery(true) ?>">
<script type="text/javascript">
ft06_siswarutinbayar_2grid.CreateAutoSuggest({"id":"x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_siswa_id","forceSelect":false});
</script>
</span>
<?php } ?>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_siswa_id" name="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_siswa_id" id="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_siswa_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->siswa_id->OldValue) ?>">
<?php } ?>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t06_siswarutinbayar_2_grid->RowCnt ?>_t06_siswarutinbayar_2_siswa_id" class="form-group t06_siswarutinbayar_2_siswa_id">
<span<?php echo $t06_siswarutinbayar_2->siswa_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t06_siswarutinbayar_2->siswa_id->EditValue ?></p></span>
</span>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_siswa_id" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_siswa_id" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_siswa_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->siswa_id->CurrentValue) ?>">
<?php } ?>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t06_siswarutinbayar_2_grid->RowCnt ?>_t06_siswarutinbayar_2_siswa_id" class="t06_siswarutinbayar_2_siswa_id">
<span<?php echo $t06_siswarutinbayar_2->siswa_id->ViewAttributes() ?>>
<?php echo $t06_siswarutinbayar_2->siswa_id->ListViewValue() ?></span>
</span>
<?php if ($t06_siswarutinbayar_2->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_siswa_id" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_siswa_id" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_siswa_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->siswa_id->FormValue) ?>">
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_siswa_id" name="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_siswa_id" id="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_siswa_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->siswa_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_siswa_id" name="ft06_siswarutinbayar_2grid$x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_siswa_id" id="ft06_siswarutinbayar_2grid$x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_siswa_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->siswa_id->FormValue) ?>">
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_siswa_id" name="ft06_siswarutinbayar_2grid$o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_siswa_id" id="ft06_siswarutinbayar_2grid$o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_siswa_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->siswa_id->OldValue) ?>">
<?php } ?>
<?php } ?>
<a id="<?php echo $t06_siswarutinbayar_2_grid->PageObjName . "_row_" . $t06_siswarutinbayar_2_grid->RowCnt ?>"></a></td>
	<?php } ?>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_id" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_id" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->id->CurrentValue) ?>">
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_id" name="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_id" id="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->id->OldValue) ?>">
<?php } ?>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_EDIT || $t06_siswarutinbayar_2->CurrentMode == "edit") { ?>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_id" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_id" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($t06_siswarutinbayar_2->Siswa_Nomor_Induk->Visible) { // Siswa_Nomor_Induk ?>
		<td data-name="Siswa_Nomor_Induk"<?php echo $t06_siswarutinbayar_2->Siswa_Nomor_Induk->CellAttributes() ?>>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t06_siswarutinbayar_2_grid->RowCnt ?>_t06_siswarutinbayar_2_Siswa_Nomor_Induk" class="form-group t06_siswarutinbayar_2_Siswa_Nomor_Induk">
<input type="text" data-table="t06_siswarutinbayar_2" data-field="x_Siswa_Nomor_Induk" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Siswa_Nomor_Induk" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Siswa_Nomor_Induk" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Siswa_Nomor_Induk->getPlaceHolder()) ?>" value="<?php echo $t06_siswarutinbayar_2->Siswa_Nomor_Induk->EditValue ?>"<?php echo $t06_siswarutinbayar_2->Siswa_Nomor_Induk->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Siswa_Nomor_Induk" name="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Siswa_Nomor_Induk" id="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Siswa_Nomor_Induk" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Siswa_Nomor_Induk->OldValue) ?>">
<?php } ?>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t06_siswarutinbayar_2_grid->RowCnt ?>_t06_siswarutinbayar_2_Siswa_Nomor_Induk" class="form-group t06_siswarutinbayar_2_Siswa_Nomor_Induk">
<span<?php echo $t06_siswarutinbayar_2->Siswa_Nomor_Induk->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t06_siswarutinbayar_2->Siswa_Nomor_Induk->EditValue ?></p></span>
</span>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Siswa_Nomor_Induk" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Siswa_Nomor_Induk" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Siswa_Nomor_Induk" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Siswa_Nomor_Induk->CurrentValue) ?>">
<?php } ?>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t06_siswarutinbayar_2_grid->RowCnt ?>_t06_siswarutinbayar_2_Siswa_Nomor_Induk" class="t06_siswarutinbayar_2_Siswa_Nomor_Induk">
<span<?php echo $t06_siswarutinbayar_2->Siswa_Nomor_Induk->ViewAttributes() ?>>
<?php echo $t06_siswarutinbayar_2->Siswa_Nomor_Induk->ListViewValue() ?></span>
</span>
<?php if ($t06_siswarutinbayar_2->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Siswa_Nomor_Induk" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Siswa_Nomor_Induk" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Siswa_Nomor_Induk" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Siswa_Nomor_Induk->FormValue) ?>">
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Siswa_Nomor_Induk" name="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Siswa_Nomor_Induk" id="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Siswa_Nomor_Induk" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Siswa_Nomor_Induk->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Siswa_Nomor_Induk" name="ft06_siswarutinbayar_2grid$x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Siswa_Nomor_Induk" id="ft06_siswarutinbayar_2grid$x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Siswa_Nomor_Induk" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Siswa_Nomor_Induk->FormValue) ?>">
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Siswa_Nomor_Induk" name="ft06_siswarutinbayar_2grid$o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Siswa_Nomor_Induk" id="ft06_siswarutinbayar_2grid$o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Siswa_Nomor_Induk" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Siswa_Nomor_Induk->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t06_siswarutinbayar_2->Siswa_Nama->Visible) { // Siswa_Nama ?>
		<td data-name="Siswa_Nama"<?php echo $t06_siswarutinbayar_2->Siswa_Nama->CellAttributes() ?>>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t06_siswarutinbayar_2_grid->RowCnt ?>_t06_siswarutinbayar_2_Siswa_Nama" class="form-group t06_siswarutinbayar_2_Siswa_Nama">
<input type="text" data-table="t06_siswarutinbayar_2" data-field="x_Siswa_Nama" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Siswa_Nama" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Siswa_Nama" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Siswa_Nama->getPlaceHolder()) ?>" value="<?php echo $t06_siswarutinbayar_2->Siswa_Nama->EditValue ?>"<?php echo $t06_siswarutinbayar_2->Siswa_Nama->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Siswa_Nama" name="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Siswa_Nama" id="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Siswa_Nama" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Siswa_Nama->OldValue) ?>">
<?php } ?>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t06_siswarutinbayar_2_grid->RowCnt ?>_t06_siswarutinbayar_2_Siswa_Nama" class="form-group t06_siswarutinbayar_2_Siswa_Nama">
<span<?php echo $t06_siswarutinbayar_2->Siswa_Nama->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t06_siswarutinbayar_2->Siswa_Nama->EditValue ?></p></span>
</span>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Siswa_Nama" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Siswa_Nama" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Siswa_Nama" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Siswa_Nama->CurrentValue) ?>">
<?php } ?>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t06_siswarutinbayar_2_grid->RowCnt ?>_t06_siswarutinbayar_2_Siswa_Nama" class="t06_siswarutinbayar_2_Siswa_Nama">
<span<?php echo $t06_siswarutinbayar_2->Siswa_Nama->ViewAttributes() ?>>
<?php echo $t06_siswarutinbayar_2->Siswa_Nama->ListViewValue() ?></span>
</span>
<?php if ($t06_siswarutinbayar_2->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Siswa_Nama" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Siswa_Nama" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Siswa_Nama" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Siswa_Nama->FormValue) ?>">
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Siswa_Nama" name="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Siswa_Nama" id="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Siswa_Nama" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Siswa_Nama->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Siswa_Nama" name="ft06_siswarutinbayar_2grid$x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Siswa_Nama" id="ft06_siswarutinbayar_2grid$x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Siswa_Nama" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Siswa_Nama->FormValue) ?>">
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Siswa_Nama" name="ft06_siswarutinbayar_2grid$o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Siswa_Nama" id="ft06_siswarutinbayar_2grid$o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Siswa_Nama" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Siswa_Nama->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t06_siswarutinbayar_2->rutin_id->Visible) { // rutin_id ?>
		<td data-name="rutin_id"<?php echo $t06_siswarutinbayar_2->rutin_id->CellAttributes() ?>>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t06_siswarutinbayar_2_grid->RowCnt ?>_t06_siswarutinbayar_2_rutin_id" class="form-group t06_siswarutinbayar_2_rutin_id">
<?php
$wrkonchange = trim(" " . @$t06_siswarutinbayar_2->rutin_id->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$t06_siswarutinbayar_2->rutin_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_rutin_id" style="white-space: nowrap; z-index: <?php echo (9000 - $t06_siswarutinbayar_2_grid->RowCnt * 10) ?>">
	<input type="text" name="sv_x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_rutin_id" id="sv_x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_rutin_id" value="<?php echo $t06_siswarutinbayar_2->rutin_id->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->rutin_id->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->rutin_id->getPlaceHolder()) ?>"<?php echo $t06_siswarutinbayar_2->rutin_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_rutin_id" data-value-separator="<?php echo $t06_siswarutinbayar_2->rutin_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_rutin_id" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_rutin_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->rutin_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<input type="hidden" name="q_x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_rutin_id" id="q_x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_rutin_id" value="<?php echo $t06_siswarutinbayar_2->rutin_id->LookupFilterQuery(true) ?>">
<script type="text/javascript">
ft06_siswarutinbayar_2grid.CreateAutoSuggest({"id":"x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_rutin_id","forceSelect":false});
</script>
</span>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_rutin_id" name="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_rutin_id" id="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_rutin_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->rutin_id->OldValue) ?>">
<?php } ?>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t06_siswarutinbayar_2_grid->RowCnt ?>_t06_siswarutinbayar_2_rutin_id" class="form-group t06_siswarutinbayar_2_rutin_id">
<span<?php echo $t06_siswarutinbayar_2->rutin_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t06_siswarutinbayar_2->rutin_id->EditValue ?></p></span>
</span>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_rutin_id" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_rutin_id" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_rutin_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->rutin_id->CurrentValue) ?>">
<?php } ?>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t06_siswarutinbayar_2_grid->RowCnt ?>_t06_siswarutinbayar_2_rutin_id" class="t06_siswarutinbayar_2_rutin_id">
<span<?php echo $t06_siswarutinbayar_2->rutin_id->ViewAttributes() ?>>
<?php echo $t06_siswarutinbayar_2->rutin_id->ListViewValue() ?></span>
</span>
<?php if ($t06_siswarutinbayar_2->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_rutin_id" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_rutin_id" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_rutin_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->rutin_id->FormValue) ?>">
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_rutin_id" name="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_rutin_id" id="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_rutin_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->rutin_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_rutin_id" name="ft06_siswarutinbayar_2grid$x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_rutin_id" id="ft06_siswarutinbayar_2grid$x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_rutin_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->rutin_id->FormValue) ?>">
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_rutin_id" name="ft06_siswarutinbayar_2grid$o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_rutin_id" id="ft06_siswarutinbayar_2grid$o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_rutin_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->rutin_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t06_siswarutinbayar_2->periode_awal->Visible) { // periode_awal ?>
		<td data-name="periode_awal"<?php echo $t06_siswarutinbayar_2->periode_awal->CellAttributes() ?>>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t06_siswarutinbayar_2_grid->RowCnt ?>_t06_siswarutinbayar_2_periode_awal" class="form-group t06_siswarutinbayar_2_periode_awal">
<select data-table="t06_siswarutinbayar_2" data-field="x_periode_awal" data-value-separator="<?php echo $t06_siswarutinbayar_2->periode_awal->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_periode_awal" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_periode_awal"<?php echo $t06_siswarutinbayar_2->periode_awal->EditAttributes() ?>>
<?php echo $t06_siswarutinbayar_2->periode_awal->SelectOptionListHtml("x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_periode_awal") ?>
</select>
<input type="hidden" name="s_x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_periode_awal" id="s_x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_periode_awal" value="<?php echo $t06_siswarutinbayar_2->periode_awal->LookupFilterQuery() ?>">
</span>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_periode_awal" name="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_periode_awal" id="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_periode_awal" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->periode_awal->OldValue) ?>">
<?php } ?>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t06_siswarutinbayar_2_grid->RowCnt ?>_t06_siswarutinbayar_2_periode_awal" class="form-group t06_siswarutinbayar_2_periode_awal">
<select data-table="t06_siswarutinbayar_2" data-field="x_periode_awal" data-value-separator="<?php echo $t06_siswarutinbayar_2->periode_awal->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_periode_awal" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_periode_awal"<?php echo $t06_siswarutinbayar_2->periode_awal->EditAttributes() ?>>
<?php echo $t06_siswarutinbayar_2->periode_awal->SelectOptionListHtml("x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_periode_awal") ?>
</select>
<input type="hidden" name="s_x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_periode_awal" id="s_x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_periode_awal" value="<?php echo $t06_siswarutinbayar_2->periode_awal->LookupFilterQuery() ?>">
</span>
<?php } ?>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t06_siswarutinbayar_2_grid->RowCnt ?>_t06_siswarutinbayar_2_periode_awal" class="t06_siswarutinbayar_2_periode_awal">
<span<?php echo $t06_siswarutinbayar_2->periode_awal->ViewAttributes() ?>>
<?php echo $t06_siswarutinbayar_2->periode_awal->ListViewValue() ?></span>
</span>
<?php if ($t06_siswarutinbayar_2->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_periode_awal" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_periode_awal" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_periode_awal" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->periode_awal->FormValue) ?>">
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_periode_awal" name="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_periode_awal" id="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_periode_awal" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->periode_awal->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_periode_awal" name="ft06_siswarutinbayar_2grid$x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_periode_awal" id="ft06_siswarutinbayar_2grid$x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_periode_awal" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->periode_awal->FormValue) ?>">
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_periode_awal" name="ft06_siswarutinbayar_2grid$o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_periode_awal" id="ft06_siswarutinbayar_2grid$o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_periode_awal" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->periode_awal->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t06_siswarutinbayar_2->periode_akhir->Visible) { // periode_akhir ?>
		<td data-name="periode_akhir"<?php echo $t06_siswarutinbayar_2->periode_akhir->CellAttributes() ?>>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t06_siswarutinbayar_2_grid->RowCnt ?>_t06_siswarutinbayar_2_periode_akhir" class="form-group t06_siswarutinbayar_2_periode_akhir">
<select data-table="t06_siswarutinbayar_2" data-field="x_periode_akhir" data-value-separator="<?php echo $t06_siswarutinbayar_2->periode_akhir->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_periode_akhir" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_periode_akhir"<?php echo $t06_siswarutinbayar_2->periode_akhir->EditAttributes() ?>>
<?php echo $t06_siswarutinbayar_2->periode_akhir->SelectOptionListHtml("x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_periode_akhir") ?>
</select>
<input type="hidden" name="s_x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_periode_akhir" id="s_x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_periode_akhir" value="<?php echo $t06_siswarutinbayar_2->periode_akhir->LookupFilterQuery() ?>">
</span>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_periode_akhir" name="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_periode_akhir" id="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_periode_akhir" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->periode_akhir->OldValue) ?>">
<?php } ?>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t06_siswarutinbayar_2_grid->RowCnt ?>_t06_siswarutinbayar_2_periode_akhir" class="form-group t06_siswarutinbayar_2_periode_akhir">
<select data-table="t06_siswarutinbayar_2" data-field="x_periode_akhir" data-value-separator="<?php echo $t06_siswarutinbayar_2->periode_akhir->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_periode_akhir" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_periode_akhir"<?php echo $t06_siswarutinbayar_2->periode_akhir->EditAttributes() ?>>
<?php echo $t06_siswarutinbayar_2->periode_akhir->SelectOptionListHtml("x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_periode_akhir") ?>
</select>
<input type="hidden" name="s_x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_periode_akhir" id="s_x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_periode_akhir" value="<?php echo $t06_siswarutinbayar_2->periode_akhir->LookupFilterQuery() ?>">
</span>
<?php } ?>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t06_siswarutinbayar_2_grid->RowCnt ?>_t06_siswarutinbayar_2_periode_akhir" class="t06_siswarutinbayar_2_periode_akhir">
<span<?php echo $t06_siswarutinbayar_2->periode_akhir->ViewAttributes() ?>>
<?php echo $t06_siswarutinbayar_2->periode_akhir->ListViewValue() ?></span>
</span>
<?php if ($t06_siswarutinbayar_2->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_periode_akhir" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_periode_akhir" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_periode_akhir" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->periode_akhir->FormValue) ?>">
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_periode_akhir" name="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_periode_akhir" id="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_periode_akhir" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->periode_akhir->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_periode_akhir" name="ft06_siswarutinbayar_2grid$x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_periode_akhir" id="ft06_siswarutinbayar_2grid$x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_periode_akhir" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->periode_akhir->FormValue) ?>">
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_periode_akhir" name="ft06_siswarutinbayar_2grid$o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_periode_akhir" id="ft06_siswarutinbayar_2grid$o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_periode_akhir" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->periode_akhir->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t06_siswarutinbayar_2->Bayar_Jumlah->Visible) { // Bayar_Jumlah ?>
		<td data-name="Bayar_Jumlah"<?php echo $t06_siswarutinbayar_2->Bayar_Jumlah->CellAttributes() ?>>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t06_siswarutinbayar_2_grid->RowCnt ?>_t06_siswarutinbayar_2_Bayar_Jumlah" class="form-group t06_siswarutinbayar_2_Bayar_Jumlah">
<input type="text" data-table="t06_siswarutinbayar_2" data-field="x_Bayar_Jumlah" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Bayar_Jumlah" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Bayar_Jumlah" size="30" placeholder="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Bayar_Jumlah->getPlaceHolder()) ?>" value="<?php echo $t06_siswarutinbayar_2->Bayar_Jumlah->EditValue ?>"<?php echo $t06_siswarutinbayar_2->Bayar_Jumlah->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Bayar_Jumlah" name="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Bayar_Jumlah" id="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Bayar_Jumlah" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Bayar_Jumlah->OldValue) ?>">
<?php } ?>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t06_siswarutinbayar_2_grid->RowCnt ?>_t06_siswarutinbayar_2_Bayar_Jumlah" class="form-group t06_siswarutinbayar_2_Bayar_Jumlah">
<span<?php echo $t06_siswarutinbayar_2->Bayar_Jumlah->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t06_siswarutinbayar_2->Bayar_Jumlah->EditValue ?></p></span>
</span>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Bayar_Jumlah" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Bayar_Jumlah" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Bayar_Jumlah" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Bayar_Jumlah->CurrentValue) ?>">
<?php } ?>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t06_siswarutinbayar_2_grid->RowCnt ?>_t06_siswarutinbayar_2_Bayar_Jumlah" class="t06_siswarutinbayar_2_Bayar_Jumlah">
<span<?php echo $t06_siswarutinbayar_2->Bayar_Jumlah->ViewAttributes() ?>>
<?php echo $t06_siswarutinbayar_2->Bayar_Jumlah->ListViewValue() ?></span>
</span>
<?php if ($t06_siswarutinbayar_2->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Bayar_Jumlah" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Bayar_Jumlah" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Bayar_Jumlah" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Bayar_Jumlah->FormValue) ?>">
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Bayar_Jumlah" name="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Bayar_Jumlah" id="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Bayar_Jumlah" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Bayar_Jumlah->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Bayar_Jumlah" name="ft06_siswarutinbayar_2grid$x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Bayar_Jumlah" id="ft06_siswarutinbayar_2grid$x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Bayar_Jumlah" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Bayar_Jumlah->FormValue) ?>">
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Bayar_Jumlah" name="ft06_siswarutinbayar_2grid$o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Bayar_Jumlah" id="ft06_siswarutinbayar_2grid$o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Bayar_Jumlah" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Bayar_Jumlah->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t06_siswarutinbayar_2_grid->ListOptions->Render("body", "right", $t06_siswarutinbayar_2_grid->RowCnt);
?>
	</tr>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_ADD || $t06_siswarutinbayar_2->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
ft06_siswarutinbayar_2grid.UpdateOpts(<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($t06_siswarutinbayar_2->CurrentAction <> "gridadd" || $t06_siswarutinbayar_2->CurrentMode == "copy")
		if (!$t06_siswarutinbayar_2_grid->Recordset->EOF) $t06_siswarutinbayar_2_grid->Recordset->MoveNext();
}
?>
<?php
	if ($t06_siswarutinbayar_2->CurrentMode == "add" || $t06_siswarutinbayar_2->CurrentMode == "copy" || $t06_siswarutinbayar_2->CurrentMode == "edit") {
		$t06_siswarutinbayar_2_grid->RowIndex = '$rowindex$';
		$t06_siswarutinbayar_2_grid->LoadDefaultValues();

		// Set row properties
		$t06_siswarutinbayar_2->ResetAttrs();
		$t06_siswarutinbayar_2->RowAttrs = array_merge($t06_siswarutinbayar_2->RowAttrs, array('data-rowindex'=>$t06_siswarutinbayar_2_grid->RowIndex, 'id'=>'r0_t06_siswarutinbayar_2', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($t06_siswarutinbayar_2->RowAttrs["class"], "ewTemplate");
		$t06_siswarutinbayar_2->RowType = EW_ROWTYPE_ADD;

		// Render row
		$t06_siswarutinbayar_2_grid->RenderRow();

		// Render list options
		$t06_siswarutinbayar_2_grid->RenderListOptions();
		$t06_siswarutinbayar_2_grid->StartRowCnt = 0;
?>
	<tr<?php echo $t06_siswarutinbayar_2->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t06_siswarutinbayar_2_grid->ListOptions->Render("body", "left", $t06_siswarutinbayar_2_grid->RowIndex);
?>
	<?php if ($t06_siswarutinbayar_2->siswa_id->Visible) { // siswa_id ?>
		<td data-name="siswa_id">
<?php if ($t06_siswarutinbayar_2->CurrentAction <> "F") { ?>
<?php if ($t06_siswarutinbayar_2->siswa_id->getSessionValue() <> "") { ?>
<span id="el$rowindex$_t06_siswarutinbayar_2_siswa_id" class="form-group t06_siswarutinbayar_2_siswa_id">
<span<?php echo $t06_siswarutinbayar_2->siswa_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t06_siswarutinbayar_2->siswa_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_siswa_id" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_siswa_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->siswa_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_t06_siswarutinbayar_2_siswa_id" class="form-group t06_siswarutinbayar_2_siswa_id">
<?php
$wrkonchange = trim(" " . @$t06_siswarutinbayar_2->siswa_id->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$t06_siswarutinbayar_2->siswa_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_siswa_id" style="white-space: nowrap; z-index: <?php echo (9000 - $t06_siswarutinbayar_2_grid->RowCnt * 10) ?>">
	<input type="text" name="sv_x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_siswa_id" id="sv_x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_siswa_id" value="<?php echo $t06_siswarutinbayar_2->siswa_id->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->siswa_id->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->siswa_id->getPlaceHolder()) ?>"<?php echo $t06_siswarutinbayar_2->siswa_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_siswa_id" data-value-separator="<?php echo $t06_siswarutinbayar_2->siswa_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_siswa_id" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_siswa_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->siswa_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<input type="hidden" name="q_x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_siswa_id" id="q_x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_siswa_id" value="<?php echo $t06_siswarutinbayar_2->siswa_id->LookupFilterQuery(true) ?>">
<script type="text/javascript">
ft06_siswarutinbayar_2grid.CreateAutoSuggest({"id":"x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_siswa_id","forceSelect":false});
</script>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_t06_siswarutinbayar_2_siswa_id" class="form-group t06_siswarutinbayar_2_siswa_id">
<span<?php echo $t06_siswarutinbayar_2->siswa_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t06_siswarutinbayar_2->siswa_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_siswa_id" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_siswa_id" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_siswa_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->siswa_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_siswa_id" name="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_siswa_id" id="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_siswa_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->siswa_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t06_siswarutinbayar_2->Siswa_Nomor_Induk->Visible) { // Siswa_Nomor_Induk ?>
		<td data-name="Siswa_Nomor_Induk">
<?php if ($t06_siswarutinbayar_2->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t06_siswarutinbayar_2_Siswa_Nomor_Induk" class="form-group t06_siswarutinbayar_2_Siswa_Nomor_Induk">
<input type="text" data-table="t06_siswarutinbayar_2" data-field="x_Siswa_Nomor_Induk" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Siswa_Nomor_Induk" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Siswa_Nomor_Induk" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Siswa_Nomor_Induk->getPlaceHolder()) ?>" value="<?php echo $t06_siswarutinbayar_2->Siswa_Nomor_Induk->EditValue ?>"<?php echo $t06_siswarutinbayar_2->Siswa_Nomor_Induk->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t06_siswarutinbayar_2_Siswa_Nomor_Induk" class="form-group t06_siswarutinbayar_2_Siswa_Nomor_Induk">
<span<?php echo $t06_siswarutinbayar_2->Siswa_Nomor_Induk->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t06_siswarutinbayar_2->Siswa_Nomor_Induk->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Siswa_Nomor_Induk" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Siswa_Nomor_Induk" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Siswa_Nomor_Induk" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Siswa_Nomor_Induk->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Siswa_Nomor_Induk" name="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Siswa_Nomor_Induk" id="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Siswa_Nomor_Induk" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Siswa_Nomor_Induk->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t06_siswarutinbayar_2->Siswa_Nama->Visible) { // Siswa_Nama ?>
		<td data-name="Siswa_Nama">
<?php if ($t06_siswarutinbayar_2->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t06_siswarutinbayar_2_Siswa_Nama" class="form-group t06_siswarutinbayar_2_Siswa_Nama">
<input type="text" data-table="t06_siswarutinbayar_2" data-field="x_Siswa_Nama" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Siswa_Nama" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Siswa_Nama" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Siswa_Nama->getPlaceHolder()) ?>" value="<?php echo $t06_siswarutinbayar_2->Siswa_Nama->EditValue ?>"<?php echo $t06_siswarutinbayar_2->Siswa_Nama->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t06_siswarutinbayar_2_Siswa_Nama" class="form-group t06_siswarutinbayar_2_Siswa_Nama">
<span<?php echo $t06_siswarutinbayar_2->Siswa_Nama->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t06_siswarutinbayar_2->Siswa_Nama->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Siswa_Nama" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Siswa_Nama" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Siswa_Nama" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Siswa_Nama->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Siswa_Nama" name="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Siswa_Nama" id="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Siswa_Nama" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Siswa_Nama->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t06_siswarutinbayar_2->rutin_id->Visible) { // rutin_id ?>
		<td data-name="rutin_id">
<?php if ($t06_siswarutinbayar_2->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t06_siswarutinbayar_2_rutin_id" class="form-group t06_siswarutinbayar_2_rutin_id">
<?php
$wrkonchange = trim(" " . @$t06_siswarutinbayar_2->rutin_id->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$t06_siswarutinbayar_2->rutin_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_rutin_id" style="white-space: nowrap; z-index: <?php echo (9000 - $t06_siswarutinbayar_2_grid->RowCnt * 10) ?>">
	<input type="text" name="sv_x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_rutin_id" id="sv_x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_rutin_id" value="<?php echo $t06_siswarutinbayar_2->rutin_id->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->rutin_id->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->rutin_id->getPlaceHolder()) ?>"<?php echo $t06_siswarutinbayar_2->rutin_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_rutin_id" data-value-separator="<?php echo $t06_siswarutinbayar_2->rutin_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_rutin_id" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_rutin_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->rutin_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<input type="hidden" name="q_x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_rutin_id" id="q_x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_rutin_id" value="<?php echo $t06_siswarutinbayar_2->rutin_id->LookupFilterQuery(true) ?>">
<script type="text/javascript">
ft06_siswarutinbayar_2grid.CreateAutoSuggest({"id":"x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_rutin_id","forceSelect":false});
</script>
</span>
<?php } else { ?>
<span id="el$rowindex$_t06_siswarutinbayar_2_rutin_id" class="form-group t06_siswarutinbayar_2_rutin_id">
<span<?php echo $t06_siswarutinbayar_2->rutin_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t06_siswarutinbayar_2->rutin_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_rutin_id" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_rutin_id" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_rutin_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->rutin_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_rutin_id" name="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_rutin_id" id="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_rutin_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->rutin_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t06_siswarutinbayar_2->periode_awal->Visible) { // periode_awal ?>
		<td data-name="periode_awal">
<?php if ($t06_siswarutinbayar_2->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t06_siswarutinbayar_2_periode_awal" class="form-group t06_siswarutinbayar_2_periode_awal">
<select data-table="t06_siswarutinbayar_2" data-field="x_periode_awal" data-value-separator="<?php echo $t06_siswarutinbayar_2->periode_awal->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_periode_awal" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_periode_awal"<?php echo $t06_siswarutinbayar_2->periode_awal->EditAttributes() ?>>
<?php echo $t06_siswarutinbayar_2->periode_awal->SelectOptionListHtml("x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_periode_awal") ?>
</select>
<input type="hidden" name="s_x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_periode_awal" id="s_x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_periode_awal" value="<?php echo $t06_siswarutinbayar_2->periode_awal->LookupFilterQuery() ?>">
</span>
<?php } else { ?>
<span id="el$rowindex$_t06_siswarutinbayar_2_periode_awal" class="form-group t06_siswarutinbayar_2_periode_awal">
<span<?php echo $t06_siswarutinbayar_2->periode_awal->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t06_siswarutinbayar_2->periode_awal->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_periode_awal" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_periode_awal" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_periode_awal" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->periode_awal->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_periode_awal" name="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_periode_awal" id="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_periode_awal" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->periode_awal->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t06_siswarutinbayar_2->periode_akhir->Visible) { // periode_akhir ?>
		<td data-name="periode_akhir">
<?php if ($t06_siswarutinbayar_2->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t06_siswarutinbayar_2_periode_akhir" class="form-group t06_siswarutinbayar_2_periode_akhir">
<select data-table="t06_siswarutinbayar_2" data-field="x_periode_akhir" data-value-separator="<?php echo $t06_siswarutinbayar_2->periode_akhir->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_periode_akhir" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_periode_akhir"<?php echo $t06_siswarutinbayar_2->periode_akhir->EditAttributes() ?>>
<?php echo $t06_siswarutinbayar_2->periode_akhir->SelectOptionListHtml("x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_periode_akhir") ?>
</select>
<input type="hidden" name="s_x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_periode_akhir" id="s_x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_periode_akhir" value="<?php echo $t06_siswarutinbayar_2->periode_akhir->LookupFilterQuery() ?>">
</span>
<?php } else { ?>
<span id="el$rowindex$_t06_siswarutinbayar_2_periode_akhir" class="form-group t06_siswarutinbayar_2_periode_akhir">
<span<?php echo $t06_siswarutinbayar_2->periode_akhir->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t06_siswarutinbayar_2->periode_akhir->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_periode_akhir" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_periode_akhir" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_periode_akhir" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->periode_akhir->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_periode_akhir" name="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_periode_akhir" id="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_periode_akhir" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->periode_akhir->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t06_siswarutinbayar_2->Bayar_Jumlah->Visible) { // Bayar_Jumlah ?>
		<td data-name="Bayar_Jumlah">
<?php if ($t06_siswarutinbayar_2->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t06_siswarutinbayar_2_Bayar_Jumlah" class="form-group t06_siswarutinbayar_2_Bayar_Jumlah">
<input type="text" data-table="t06_siswarutinbayar_2" data-field="x_Bayar_Jumlah" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Bayar_Jumlah" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Bayar_Jumlah" size="30" placeholder="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Bayar_Jumlah->getPlaceHolder()) ?>" value="<?php echo $t06_siswarutinbayar_2->Bayar_Jumlah->EditValue ?>"<?php echo $t06_siswarutinbayar_2->Bayar_Jumlah->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t06_siswarutinbayar_2_Bayar_Jumlah" class="form-group t06_siswarutinbayar_2_Bayar_Jumlah">
<span<?php echo $t06_siswarutinbayar_2->Bayar_Jumlah->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t06_siswarutinbayar_2->Bayar_Jumlah->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Bayar_Jumlah" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Bayar_Jumlah" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Bayar_Jumlah" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Bayar_Jumlah->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Bayar_Jumlah" name="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Bayar_Jumlah" id="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Bayar_Jumlah" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Bayar_Jumlah->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t06_siswarutinbayar_2_grid->ListOptions->Render("body", "right", $t06_siswarutinbayar_2_grid->RowCnt);
?>
<script type="text/javascript">
ft06_siswarutinbayar_2grid.UpdateOpts(<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($t06_siswarutinbayar_2->CurrentMode == "add" || $t06_siswarutinbayar_2->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $t06_siswarutinbayar_2_grid->FormKeyCountName ?>" id="<?php echo $t06_siswarutinbayar_2_grid->FormKeyCountName ?>" value="<?php echo $t06_siswarutinbayar_2_grid->KeyCount ?>">
<?php echo $t06_siswarutinbayar_2_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t06_siswarutinbayar_2->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $t06_siswarutinbayar_2_grid->FormKeyCountName ?>" id="<?php echo $t06_siswarutinbayar_2_grid->FormKeyCountName ?>" value="<?php echo $t06_siswarutinbayar_2_grid->KeyCount ?>">
<?php echo $t06_siswarutinbayar_2_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t06_siswarutinbayar_2->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ft06_siswarutinbayar_2grid">
</div>
<?php

// Close recordset
if ($t06_siswarutinbayar_2_grid->Recordset)
	$t06_siswarutinbayar_2_grid->Recordset->Close();
?>
</div>
</div>
<?php } ?>
<?php if ($t06_siswarutinbayar_2_grid->TotalRecs == 0 && $t06_siswarutinbayar_2->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t06_siswarutinbayar_2_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($t06_siswarutinbayar_2->Export == "") { ?>
<script type="text/javascript">
ft06_siswarutinbayar_2grid.Init();
</script>
<?php } ?>
<?php
$t06_siswarutinbayar_2_grid->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
$t06_siswarutinbayar_2_grid->Page_Terminate();
?>
