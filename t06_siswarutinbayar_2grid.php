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
			elm = this.GetElements("x" + infix + "_siswa_id");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t06_siswarutinbayar_2->siswa_id->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_rutin_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t06_siswarutinbayar_2->rutin_id->FldCaption(), $t06_siswarutinbayar_2->rutin_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_rutin_id");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t06_siswarutinbayar_2->rutin_id->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Bulan");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t06_siswarutinbayar_2->Bulan->FldCaption(), $t06_siswarutinbayar_2->Bulan->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Bulan");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t06_siswarutinbayar_2->Bulan->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Tahun");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t06_siswarutinbayar_2->Tahun->FldCaption(), $t06_siswarutinbayar_2->Tahun->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Tahun");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t06_siswarutinbayar_2->Tahun->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Bulan2");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t06_siswarutinbayar_2->Bulan2->FldCaption(), $t06_siswarutinbayar_2->Bulan2->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Bulan2");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t06_siswarutinbayar_2->Bulan2->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Tahun2");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t06_siswarutinbayar_2->Tahun2->FldCaption(), $t06_siswarutinbayar_2->Tahun2->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Tahun2");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t06_siswarutinbayar_2->Tahun2->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Bayar_Jumlah");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t06_siswarutinbayar_2->Bayar_Jumlah->FldErrMsg()) ?>");

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
	if (ew_ValueChanged(fobj, infix, "rutin_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Bulan", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Tahun", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Bulan2", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Tahun2", false)) return false;
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
<?php if ($t06_siswarutinbayar_2->id->Visible) { // id ?>
	<?php if ($t06_siswarutinbayar_2->SortUrl($t06_siswarutinbayar_2->id) == "") { ?>
		<th data-name="id"><div id="elh_t06_siswarutinbayar_2_id" class="t06_siswarutinbayar_2_id"><div class="ewTableHeaderCaption"><?php echo $t06_siswarutinbayar_2->id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id"><div><div id="elh_t06_siswarutinbayar_2_id" class="t06_siswarutinbayar_2_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t06_siswarutinbayar_2->id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t06_siswarutinbayar_2->id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t06_siswarutinbayar_2->id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t06_siswarutinbayar_2->siswa_id->Visible) { // siswa_id ?>
	<?php if ($t06_siswarutinbayar_2->SortUrl($t06_siswarutinbayar_2->siswa_id) == "") { ?>
		<th data-name="siswa_id"><div id="elh_t06_siswarutinbayar_2_siswa_id" class="t06_siswarutinbayar_2_siswa_id"><div class="ewTableHeaderCaption"><?php echo $t06_siswarutinbayar_2->siswa_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="siswa_id"><div><div id="elh_t06_siswarutinbayar_2_siswa_id" class="t06_siswarutinbayar_2_siswa_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t06_siswarutinbayar_2->siswa_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t06_siswarutinbayar_2->siswa_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t06_siswarutinbayar_2->siswa_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
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
<?php if ($t06_siswarutinbayar_2->Bulan->Visible) { // Bulan ?>
	<?php if ($t06_siswarutinbayar_2->SortUrl($t06_siswarutinbayar_2->Bulan) == "") { ?>
		<th data-name="Bulan"><div id="elh_t06_siswarutinbayar_2_Bulan" class="t06_siswarutinbayar_2_Bulan"><div class="ewTableHeaderCaption"><?php echo $t06_siswarutinbayar_2->Bulan->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Bulan"><div><div id="elh_t06_siswarutinbayar_2_Bulan" class="t06_siswarutinbayar_2_Bulan">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t06_siswarutinbayar_2->Bulan->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t06_siswarutinbayar_2->Bulan->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t06_siswarutinbayar_2->Bulan->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t06_siswarutinbayar_2->Tahun->Visible) { // Tahun ?>
	<?php if ($t06_siswarutinbayar_2->SortUrl($t06_siswarutinbayar_2->Tahun) == "") { ?>
		<th data-name="Tahun"><div id="elh_t06_siswarutinbayar_2_Tahun" class="t06_siswarutinbayar_2_Tahun"><div class="ewTableHeaderCaption"><?php echo $t06_siswarutinbayar_2->Tahun->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Tahun"><div><div id="elh_t06_siswarutinbayar_2_Tahun" class="t06_siswarutinbayar_2_Tahun">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t06_siswarutinbayar_2->Tahun->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t06_siswarutinbayar_2->Tahun->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t06_siswarutinbayar_2->Tahun->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t06_siswarutinbayar_2->Bulan2->Visible) { // Bulan2 ?>
	<?php if ($t06_siswarutinbayar_2->SortUrl($t06_siswarutinbayar_2->Bulan2) == "") { ?>
		<th data-name="Bulan2"><div id="elh_t06_siswarutinbayar_2_Bulan2" class="t06_siswarutinbayar_2_Bulan2"><div class="ewTableHeaderCaption"><?php echo $t06_siswarutinbayar_2->Bulan2->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Bulan2"><div><div id="elh_t06_siswarutinbayar_2_Bulan2" class="t06_siswarutinbayar_2_Bulan2">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t06_siswarutinbayar_2->Bulan2->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t06_siswarutinbayar_2->Bulan2->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t06_siswarutinbayar_2->Bulan2->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t06_siswarutinbayar_2->Tahun2->Visible) { // Tahun2 ?>
	<?php if ($t06_siswarutinbayar_2->SortUrl($t06_siswarutinbayar_2->Tahun2) == "") { ?>
		<th data-name="Tahun2"><div id="elh_t06_siswarutinbayar_2_Tahun2" class="t06_siswarutinbayar_2_Tahun2"><div class="ewTableHeaderCaption"><?php echo $t06_siswarutinbayar_2->Tahun2->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Tahun2"><div><div id="elh_t06_siswarutinbayar_2_Tahun2" class="t06_siswarutinbayar_2_Tahun2">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t06_siswarutinbayar_2->Tahun2->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t06_siswarutinbayar_2->Tahun2->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t06_siswarutinbayar_2->Tahun2->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
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
	<?php if ($t06_siswarutinbayar_2->id->Visible) { // id ?>
		<td data-name="id"<?php echo $t06_siswarutinbayar_2->id->CellAttributes() ?>>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_id" name="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_id" id="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->id->OldValue) ?>">
<?php } ?>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t06_siswarutinbayar_2_grid->RowCnt ?>_t06_siswarutinbayar_2_id" class="form-group t06_siswarutinbayar_2_id">
<span<?php echo $t06_siswarutinbayar_2->id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t06_siswarutinbayar_2->id->EditValue ?></p></span>
</span>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_id" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_id" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->id->CurrentValue) ?>">
<?php } ?>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t06_siswarutinbayar_2_grid->RowCnt ?>_t06_siswarutinbayar_2_id" class="t06_siswarutinbayar_2_id">
<span<?php echo $t06_siswarutinbayar_2->id->ViewAttributes() ?>>
<?php echo $t06_siswarutinbayar_2->id->ListViewValue() ?></span>
</span>
<?php if ($t06_siswarutinbayar_2->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_id" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_id" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->id->FormValue) ?>">
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_id" name="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_id" id="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_id" name="ft06_siswarutinbayar_2grid$x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_id" id="ft06_siswarutinbayar_2grid$x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->id->FormValue) ?>">
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_id" name="ft06_siswarutinbayar_2grid$o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_id" id="ft06_siswarutinbayar_2grid$o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->id->OldValue) ?>">
<?php } ?>
<?php } ?>
<a id="<?php echo $t06_siswarutinbayar_2_grid->PageObjName . "_row_" . $t06_siswarutinbayar_2_grid->RowCnt ?>"></a></td>
	<?php } ?>
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
<input type="text" data-table="t06_siswarutinbayar_2" data-field="x_siswa_id" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_siswa_id" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_siswa_id" size="30" placeholder="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->siswa_id->getPlaceHolder()) ?>" value="<?php echo $t06_siswarutinbayar_2->siswa_id->EditValue ?>"<?php echo $t06_siswarutinbayar_2->siswa_id->EditAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_siswa_id" name="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_siswa_id" id="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_siswa_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->siswa_id->OldValue) ?>">
<?php } ?>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($t06_siswarutinbayar_2->siswa_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $t06_siswarutinbayar_2_grid->RowCnt ?>_t06_siswarutinbayar_2_siswa_id" class="form-group t06_siswarutinbayar_2_siswa_id">
<span<?php echo $t06_siswarutinbayar_2->siswa_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t06_siswarutinbayar_2->siswa_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_siswa_id" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_siswa_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->siswa_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t06_siswarutinbayar_2_grid->RowCnt ?>_t06_siswarutinbayar_2_siswa_id" class="form-group t06_siswarutinbayar_2_siswa_id">
<input type="text" data-table="t06_siswarutinbayar_2" data-field="x_siswa_id" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_siswa_id" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_siswa_id" size="30" placeholder="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->siswa_id->getPlaceHolder()) ?>" value="<?php echo $t06_siswarutinbayar_2->siswa_id->EditValue ?>"<?php echo $t06_siswarutinbayar_2->siswa_id->EditAttributes() ?>>
</span>
<?php } ?>
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
</td>
	<?php } ?>
	<?php if ($t06_siswarutinbayar_2->rutin_id->Visible) { // rutin_id ?>
		<td data-name="rutin_id"<?php echo $t06_siswarutinbayar_2->rutin_id->CellAttributes() ?>>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t06_siswarutinbayar_2_grid->RowCnt ?>_t06_siswarutinbayar_2_rutin_id" class="form-group t06_siswarutinbayar_2_rutin_id">
<input type="text" data-table="t06_siswarutinbayar_2" data-field="x_rutin_id" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_rutin_id" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_rutin_id" size="30" placeholder="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->rutin_id->getPlaceHolder()) ?>" value="<?php echo $t06_siswarutinbayar_2->rutin_id->EditValue ?>"<?php echo $t06_siswarutinbayar_2->rutin_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_rutin_id" name="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_rutin_id" id="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_rutin_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->rutin_id->OldValue) ?>">
<?php } ?>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t06_siswarutinbayar_2_grid->RowCnt ?>_t06_siswarutinbayar_2_rutin_id" class="form-group t06_siswarutinbayar_2_rutin_id">
<input type="text" data-table="t06_siswarutinbayar_2" data-field="x_rutin_id" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_rutin_id" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_rutin_id" size="30" placeholder="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->rutin_id->getPlaceHolder()) ?>" value="<?php echo $t06_siswarutinbayar_2->rutin_id->EditValue ?>"<?php echo $t06_siswarutinbayar_2->rutin_id->EditAttributes() ?>>
</span>
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
	<?php if ($t06_siswarutinbayar_2->Bulan->Visible) { // Bulan ?>
		<td data-name="Bulan"<?php echo $t06_siswarutinbayar_2->Bulan->CellAttributes() ?>>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t06_siswarutinbayar_2_grid->RowCnt ?>_t06_siswarutinbayar_2_Bulan" class="form-group t06_siswarutinbayar_2_Bulan">
<input type="text" data-table="t06_siswarutinbayar_2" data-field="x_Bulan" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Bulan" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Bulan" size="30" placeholder="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Bulan->getPlaceHolder()) ?>" value="<?php echo $t06_siswarutinbayar_2->Bulan->EditValue ?>"<?php echo $t06_siswarutinbayar_2->Bulan->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Bulan" name="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Bulan" id="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Bulan" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Bulan->OldValue) ?>">
<?php } ?>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t06_siswarutinbayar_2_grid->RowCnt ?>_t06_siswarutinbayar_2_Bulan" class="form-group t06_siswarutinbayar_2_Bulan">
<input type="text" data-table="t06_siswarutinbayar_2" data-field="x_Bulan" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Bulan" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Bulan" size="30" placeholder="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Bulan->getPlaceHolder()) ?>" value="<?php echo $t06_siswarutinbayar_2->Bulan->EditValue ?>"<?php echo $t06_siswarutinbayar_2->Bulan->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t06_siswarutinbayar_2_grid->RowCnt ?>_t06_siswarutinbayar_2_Bulan" class="t06_siswarutinbayar_2_Bulan">
<span<?php echo $t06_siswarutinbayar_2->Bulan->ViewAttributes() ?>>
<?php echo $t06_siswarutinbayar_2->Bulan->ListViewValue() ?></span>
</span>
<?php if ($t06_siswarutinbayar_2->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Bulan" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Bulan" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Bulan" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Bulan->FormValue) ?>">
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Bulan" name="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Bulan" id="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Bulan" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Bulan->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Bulan" name="ft06_siswarutinbayar_2grid$x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Bulan" id="ft06_siswarutinbayar_2grid$x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Bulan" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Bulan->FormValue) ?>">
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Bulan" name="ft06_siswarutinbayar_2grid$o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Bulan" id="ft06_siswarutinbayar_2grid$o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Bulan" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Bulan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t06_siswarutinbayar_2->Tahun->Visible) { // Tahun ?>
		<td data-name="Tahun"<?php echo $t06_siswarutinbayar_2->Tahun->CellAttributes() ?>>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t06_siswarutinbayar_2_grid->RowCnt ?>_t06_siswarutinbayar_2_Tahun" class="form-group t06_siswarutinbayar_2_Tahun">
<input type="text" data-table="t06_siswarutinbayar_2" data-field="x_Tahun" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Tahun" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Tahun" size="30" placeholder="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Tahun->getPlaceHolder()) ?>" value="<?php echo $t06_siswarutinbayar_2->Tahun->EditValue ?>"<?php echo $t06_siswarutinbayar_2->Tahun->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Tahun" name="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Tahun" id="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Tahun" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Tahun->OldValue) ?>">
<?php } ?>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t06_siswarutinbayar_2_grid->RowCnt ?>_t06_siswarutinbayar_2_Tahun" class="form-group t06_siswarutinbayar_2_Tahun">
<input type="text" data-table="t06_siswarutinbayar_2" data-field="x_Tahun" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Tahun" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Tahun" size="30" placeholder="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Tahun->getPlaceHolder()) ?>" value="<?php echo $t06_siswarutinbayar_2->Tahun->EditValue ?>"<?php echo $t06_siswarutinbayar_2->Tahun->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t06_siswarutinbayar_2_grid->RowCnt ?>_t06_siswarutinbayar_2_Tahun" class="t06_siswarutinbayar_2_Tahun">
<span<?php echo $t06_siswarutinbayar_2->Tahun->ViewAttributes() ?>>
<?php echo $t06_siswarutinbayar_2->Tahun->ListViewValue() ?></span>
</span>
<?php if ($t06_siswarutinbayar_2->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Tahun" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Tahun" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Tahun" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Tahun->FormValue) ?>">
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Tahun" name="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Tahun" id="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Tahun" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Tahun->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Tahun" name="ft06_siswarutinbayar_2grid$x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Tahun" id="ft06_siswarutinbayar_2grid$x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Tahun" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Tahun->FormValue) ?>">
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Tahun" name="ft06_siswarutinbayar_2grid$o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Tahun" id="ft06_siswarutinbayar_2grid$o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Tahun" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Tahun->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t06_siswarutinbayar_2->Bulan2->Visible) { // Bulan2 ?>
		<td data-name="Bulan2"<?php echo $t06_siswarutinbayar_2->Bulan2->CellAttributes() ?>>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t06_siswarutinbayar_2_grid->RowCnt ?>_t06_siswarutinbayar_2_Bulan2" class="form-group t06_siswarutinbayar_2_Bulan2">
<input type="text" data-table="t06_siswarutinbayar_2" data-field="x_Bulan2" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Bulan2" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Bulan2" size="30" placeholder="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Bulan2->getPlaceHolder()) ?>" value="<?php echo $t06_siswarutinbayar_2->Bulan2->EditValue ?>"<?php echo $t06_siswarutinbayar_2->Bulan2->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Bulan2" name="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Bulan2" id="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Bulan2" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Bulan2->OldValue) ?>">
<?php } ?>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t06_siswarutinbayar_2_grid->RowCnt ?>_t06_siswarutinbayar_2_Bulan2" class="form-group t06_siswarutinbayar_2_Bulan2">
<input type="text" data-table="t06_siswarutinbayar_2" data-field="x_Bulan2" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Bulan2" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Bulan2" size="30" placeholder="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Bulan2->getPlaceHolder()) ?>" value="<?php echo $t06_siswarutinbayar_2->Bulan2->EditValue ?>"<?php echo $t06_siswarutinbayar_2->Bulan2->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t06_siswarutinbayar_2_grid->RowCnt ?>_t06_siswarutinbayar_2_Bulan2" class="t06_siswarutinbayar_2_Bulan2">
<span<?php echo $t06_siswarutinbayar_2->Bulan2->ViewAttributes() ?>>
<?php echo $t06_siswarutinbayar_2->Bulan2->ListViewValue() ?></span>
</span>
<?php if ($t06_siswarutinbayar_2->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Bulan2" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Bulan2" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Bulan2" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Bulan2->FormValue) ?>">
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Bulan2" name="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Bulan2" id="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Bulan2" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Bulan2->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Bulan2" name="ft06_siswarutinbayar_2grid$x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Bulan2" id="ft06_siswarutinbayar_2grid$x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Bulan2" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Bulan2->FormValue) ?>">
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Bulan2" name="ft06_siswarutinbayar_2grid$o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Bulan2" id="ft06_siswarutinbayar_2grid$o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Bulan2" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Bulan2->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t06_siswarutinbayar_2->Tahun2->Visible) { // Tahun2 ?>
		<td data-name="Tahun2"<?php echo $t06_siswarutinbayar_2->Tahun2->CellAttributes() ?>>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t06_siswarutinbayar_2_grid->RowCnt ?>_t06_siswarutinbayar_2_Tahun2" class="form-group t06_siswarutinbayar_2_Tahun2">
<input type="text" data-table="t06_siswarutinbayar_2" data-field="x_Tahun2" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Tahun2" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Tahun2" size="30" placeholder="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Tahun2->getPlaceHolder()) ?>" value="<?php echo $t06_siswarutinbayar_2->Tahun2->EditValue ?>"<?php echo $t06_siswarutinbayar_2->Tahun2->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Tahun2" name="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Tahun2" id="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Tahun2" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Tahun2->OldValue) ?>">
<?php } ?>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t06_siswarutinbayar_2_grid->RowCnt ?>_t06_siswarutinbayar_2_Tahun2" class="form-group t06_siswarutinbayar_2_Tahun2">
<input type="text" data-table="t06_siswarutinbayar_2" data-field="x_Tahun2" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Tahun2" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Tahun2" size="30" placeholder="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Tahun2->getPlaceHolder()) ?>" value="<?php echo $t06_siswarutinbayar_2->Tahun2->EditValue ?>"<?php echo $t06_siswarutinbayar_2->Tahun2->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t06_siswarutinbayar_2_grid->RowCnt ?>_t06_siswarutinbayar_2_Tahun2" class="t06_siswarutinbayar_2_Tahun2">
<span<?php echo $t06_siswarutinbayar_2->Tahun2->ViewAttributes() ?>>
<?php echo $t06_siswarutinbayar_2->Tahun2->ListViewValue() ?></span>
</span>
<?php if ($t06_siswarutinbayar_2->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Tahun2" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Tahun2" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Tahun2" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Tahun2->FormValue) ?>">
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Tahun2" name="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Tahun2" id="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Tahun2" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Tahun2->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Tahun2" name="ft06_siswarutinbayar_2grid$x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Tahun2" id="ft06_siswarutinbayar_2grid$x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Tahun2" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Tahun2->FormValue) ?>">
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Tahun2" name="ft06_siswarutinbayar_2grid$o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Tahun2" id="ft06_siswarutinbayar_2grid$o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Tahun2" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Tahun2->OldValue) ?>">
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
<input type="text" data-table="t06_siswarutinbayar_2" data-field="x_Bayar_Jumlah" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Bayar_Jumlah" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Bayar_Jumlah" size="30" placeholder="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Bayar_Jumlah->getPlaceHolder()) ?>" value="<?php echo $t06_siswarutinbayar_2->Bayar_Jumlah->EditValue ?>"<?php echo $t06_siswarutinbayar_2->Bayar_Jumlah->EditAttributes() ?>>
</span>
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
	<?php if ($t06_siswarutinbayar_2->id->Visible) { // id ?>
		<td data-name="id">
<?php if ($t06_siswarutinbayar_2->CurrentAction <> "F") { ?>
<?php } else { ?>
<span id="el$rowindex$_t06_siswarutinbayar_2_id" class="form-group t06_siswarutinbayar_2_id">
<span<?php echo $t06_siswarutinbayar_2->id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t06_siswarutinbayar_2->id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_id" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_id" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_id" name="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_id" id="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->id->OldValue) ?>">
</td>
	<?php } ?>
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
<input type="text" data-table="t06_siswarutinbayar_2" data-field="x_siswa_id" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_siswa_id" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_siswa_id" size="30" placeholder="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->siswa_id->getPlaceHolder()) ?>" value="<?php echo $t06_siswarutinbayar_2->siswa_id->EditValue ?>"<?php echo $t06_siswarutinbayar_2->siswa_id->EditAttributes() ?>>
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
	<?php if ($t06_siswarutinbayar_2->rutin_id->Visible) { // rutin_id ?>
		<td data-name="rutin_id">
<?php if ($t06_siswarutinbayar_2->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t06_siswarutinbayar_2_rutin_id" class="form-group t06_siswarutinbayar_2_rutin_id">
<input type="text" data-table="t06_siswarutinbayar_2" data-field="x_rutin_id" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_rutin_id" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_rutin_id" size="30" placeholder="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->rutin_id->getPlaceHolder()) ?>" value="<?php echo $t06_siswarutinbayar_2->rutin_id->EditValue ?>"<?php echo $t06_siswarutinbayar_2->rutin_id->EditAttributes() ?>>
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
	<?php if ($t06_siswarutinbayar_2->Bulan->Visible) { // Bulan ?>
		<td data-name="Bulan">
<?php if ($t06_siswarutinbayar_2->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t06_siswarutinbayar_2_Bulan" class="form-group t06_siswarutinbayar_2_Bulan">
<input type="text" data-table="t06_siswarutinbayar_2" data-field="x_Bulan" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Bulan" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Bulan" size="30" placeholder="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Bulan->getPlaceHolder()) ?>" value="<?php echo $t06_siswarutinbayar_2->Bulan->EditValue ?>"<?php echo $t06_siswarutinbayar_2->Bulan->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t06_siswarutinbayar_2_Bulan" class="form-group t06_siswarutinbayar_2_Bulan">
<span<?php echo $t06_siswarutinbayar_2->Bulan->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t06_siswarutinbayar_2->Bulan->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Bulan" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Bulan" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Bulan" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Bulan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Bulan" name="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Bulan" id="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Bulan" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Bulan->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t06_siswarutinbayar_2->Tahun->Visible) { // Tahun ?>
		<td data-name="Tahun">
<?php if ($t06_siswarutinbayar_2->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t06_siswarutinbayar_2_Tahun" class="form-group t06_siswarutinbayar_2_Tahun">
<input type="text" data-table="t06_siswarutinbayar_2" data-field="x_Tahun" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Tahun" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Tahun" size="30" placeholder="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Tahun->getPlaceHolder()) ?>" value="<?php echo $t06_siswarutinbayar_2->Tahun->EditValue ?>"<?php echo $t06_siswarutinbayar_2->Tahun->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t06_siswarutinbayar_2_Tahun" class="form-group t06_siswarutinbayar_2_Tahun">
<span<?php echo $t06_siswarutinbayar_2->Tahun->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t06_siswarutinbayar_2->Tahun->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Tahun" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Tahun" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Tahun" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Tahun->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Tahun" name="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Tahun" id="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Tahun" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Tahun->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t06_siswarutinbayar_2->Bulan2->Visible) { // Bulan2 ?>
		<td data-name="Bulan2">
<?php if ($t06_siswarutinbayar_2->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t06_siswarutinbayar_2_Bulan2" class="form-group t06_siswarutinbayar_2_Bulan2">
<input type="text" data-table="t06_siswarutinbayar_2" data-field="x_Bulan2" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Bulan2" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Bulan2" size="30" placeholder="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Bulan2->getPlaceHolder()) ?>" value="<?php echo $t06_siswarutinbayar_2->Bulan2->EditValue ?>"<?php echo $t06_siswarutinbayar_2->Bulan2->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t06_siswarutinbayar_2_Bulan2" class="form-group t06_siswarutinbayar_2_Bulan2">
<span<?php echo $t06_siswarutinbayar_2->Bulan2->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t06_siswarutinbayar_2->Bulan2->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Bulan2" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Bulan2" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Bulan2" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Bulan2->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Bulan2" name="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Bulan2" id="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Bulan2" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Bulan2->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t06_siswarutinbayar_2->Tahun2->Visible) { // Tahun2 ?>
		<td data-name="Tahun2">
<?php if ($t06_siswarutinbayar_2->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t06_siswarutinbayar_2_Tahun2" class="form-group t06_siswarutinbayar_2_Tahun2">
<input type="text" data-table="t06_siswarutinbayar_2" data-field="x_Tahun2" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Tahun2" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Tahun2" size="30" placeholder="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Tahun2->getPlaceHolder()) ?>" value="<?php echo $t06_siswarutinbayar_2->Tahun2->EditValue ?>"<?php echo $t06_siswarutinbayar_2->Tahun2->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t06_siswarutinbayar_2_Tahun2" class="form-group t06_siswarutinbayar_2_Tahun2">
<span<?php echo $t06_siswarutinbayar_2->Tahun2->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t06_siswarutinbayar_2->Tahun2->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Tahun2" name="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Tahun2" id="x<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Tahun2" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Tahun2->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Tahun2" name="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Tahun2" id="o<?php echo $t06_siswarutinbayar_2_grid->RowIndex ?>_Tahun2" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Tahun2->OldValue) ?>">
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