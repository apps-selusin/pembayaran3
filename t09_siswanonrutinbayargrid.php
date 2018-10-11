<?php include_once "t96_employeesinfo.php" ?>
<?php

// Create page object
if (!isset($t09_siswanonrutinbayar_grid)) $t09_siswanonrutinbayar_grid = new ct09_siswanonrutinbayar_grid();

// Page init
$t09_siswanonrutinbayar_grid->Page_Init();

// Page main
$t09_siswanonrutinbayar_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t09_siswanonrutinbayar_grid->Page_Render();
?>
<?php if ($t09_siswanonrutinbayar->Export == "") { ?>
<script type="text/javascript">

// Form object
var ft09_siswanonrutinbayargrid = new ew_Form("ft09_siswanonrutinbayargrid", "grid");
ft09_siswanonrutinbayargrid.FormKeyCountName = '<?php echo $t09_siswanonrutinbayar_grid->FormKeyCountName ?>';

// Validate form
ft09_siswanonrutinbayargrid.Validate = function() {
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
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t09_siswanonrutinbayar->siswa_id->FldCaption(), $t09_siswanonrutinbayar->siswa_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_siswa_id");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t09_siswanonrutinbayar->siswa_id->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_nonrutin_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t09_siswanonrutinbayar->nonrutin_id->FldCaption(), $t09_siswanonrutinbayar->nonrutin_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_nonrutin_id");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t09_siswanonrutinbayar->nonrutin_id->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Bayar_Tgl");
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t09_siswanonrutinbayar->Bayar_Tgl->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Bayar_Jumlah");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t09_siswanonrutinbayar->Bayar_Jumlah->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
ft09_siswanonrutinbayargrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "siswa_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "nonrutin_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Bayar_Tgl", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Bayar_Jumlah", false)) return false;
	return true;
}

// Form_CustomValidate event
ft09_siswanonrutinbayargrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft09_siswanonrutinbayargrid.ValidateRequired = true;
<?php } else { ?>
ft09_siswanonrutinbayargrid.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
// Form object for search

</script>
<?php } ?>
<?php
if ($t09_siswanonrutinbayar->CurrentAction == "gridadd") {
	if ($t09_siswanonrutinbayar->CurrentMode == "copy") {
		$bSelectLimit = $t09_siswanonrutinbayar_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$t09_siswanonrutinbayar_grid->TotalRecs = $t09_siswanonrutinbayar->SelectRecordCount();
			$t09_siswanonrutinbayar_grid->Recordset = $t09_siswanonrutinbayar_grid->LoadRecordset($t09_siswanonrutinbayar_grid->StartRec-1, $t09_siswanonrutinbayar_grid->DisplayRecs);
		} else {
			if ($t09_siswanonrutinbayar_grid->Recordset = $t09_siswanonrutinbayar_grid->LoadRecordset())
				$t09_siswanonrutinbayar_grid->TotalRecs = $t09_siswanonrutinbayar_grid->Recordset->RecordCount();
		}
		$t09_siswanonrutinbayar_grid->StartRec = 1;
		$t09_siswanonrutinbayar_grid->DisplayRecs = $t09_siswanonrutinbayar_grid->TotalRecs;
	} else {
		$t09_siswanonrutinbayar->CurrentFilter = "0=1";
		$t09_siswanonrutinbayar_grid->StartRec = 1;
		$t09_siswanonrutinbayar_grid->DisplayRecs = $t09_siswanonrutinbayar->GridAddRowCount;
	}
	$t09_siswanonrutinbayar_grid->TotalRecs = $t09_siswanonrutinbayar_grid->DisplayRecs;
	$t09_siswanonrutinbayar_grid->StopRec = $t09_siswanonrutinbayar_grid->DisplayRecs;
} else {
	$bSelectLimit = $t09_siswanonrutinbayar_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($t09_siswanonrutinbayar_grid->TotalRecs <= 0)
			$t09_siswanonrutinbayar_grid->TotalRecs = $t09_siswanonrutinbayar->SelectRecordCount();
	} else {
		if (!$t09_siswanonrutinbayar_grid->Recordset && ($t09_siswanonrutinbayar_grid->Recordset = $t09_siswanonrutinbayar_grid->LoadRecordset()))
			$t09_siswanonrutinbayar_grid->TotalRecs = $t09_siswanonrutinbayar_grid->Recordset->RecordCount();
	}
	$t09_siswanonrutinbayar_grid->StartRec = 1;
	$t09_siswanonrutinbayar_grid->DisplayRecs = $t09_siswanonrutinbayar_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$t09_siswanonrutinbayar_grid->Recordset = $t09_siswanonrutinbayar_grid->LoadRecordset($t09_siswanonrutinbayar_grid->StartRec-1, $t09_siswanonrutinbayar_grid->DisplayRecs);

	// Set no record found message
	if ($t09_siswanonrutinbayar->CurrentAction == "" && $t09_siswanonrutinbayar_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$t09_siswanonrutinbayar_grid->setWarningMessage(ew_DeniedMsg());
		if ($t09_siswanonrutinbayar_grid->SearchWhere == "0=101")
			$t09_siswanonrutinbayar_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$t09_siswanonrutinbayar_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$t09_siswanonrutinbayar_grid->RenderOtherOptions();
?>
<?php $t09_siswanonrutinbayar_grid->ShowPageHeader(); ?>
<?php
$t09_siswanonrutinbayar_grid->ShowMessage();
?>
<?php if ($t09_siswanonrutinbayar_grid->TotalRecs > 0 || $t09_siswanonrutinbayar->CurrentAction <> "") { ?>
<div class="panel panel-default ewGrid t09_siswanonrutinbayar">
<div id="ft09_siswanonrutinbayargrid" class="ewForm form-inline">
<?php if ($t09_siswanonrutinbayar_grid->ShowOtherOptions) { ?>
<div class="panel-heading ewGridUpperPanel">
<?php
	foreach ($t09_siswanonrutinbayar_grid->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="gmp_t09_siswanonrutinbayar" class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<table id="tbl_t09_siswanonrutinbayargrid" class="table ewTable">
<?php echo $t09_siswanonrutinbayar->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Header row
$t09_siswanonrutinbayar_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$t09_siswanonrutinbayar_grid->RenderListOptions();

// Render list options (header, left)
$t09_siswanonrutinbayar_grid->ListOptions->Render("header", "left");
?>
<?php if ($t09_siswanonrutinbayar->siswa_id->Visible) { // siswa_id ?>
	<?php if ($t09_siswanonrutinbayar->SortUrl($t09_siswanonrutinbayar->siswa_id) == "") { ?>
		<th data-name="siswa_id"><div id="elh_t09_siswanonrutinbayar_siswa_id" class="t09_siswanonrutinbayar_siswa_id"><div class="ewTableHeaderCaption"><?php echo $t09_siswanonrutinbayar->siswa_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="siswa_id"><div><div id="elh_t09_siswanonrutinbayar_siswa_id" class="t09_siswanonrutinbayar_siswa_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t09_siswanonrutinbayar->siswa_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t09_siswanonrutinbayar->siswa_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t09_siswanonrutinbayar->siswa_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t09_siswanonrutinbayar->nonrutin_id->Visible) { // nonrutin_id ?>
	<?php if ($t09_siswanonrutinbayar->SortUrl($t09_siswanonrutinbayar->nonrutin_id) == "") { ?>
		<th data-name="nonrutin_id"><div id="elh_t09_siswanonrutinbayar_nonrutin_id" class="t09_siswanonrutinbayar_nonrutin_id"><div class="ewTableHeaderCaption"><?php echo $t09_siswanonrutinbayar->nonrutin_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nonrutin_id"><div><div id="elh_t09_siswanonrutinbayar_nonrutin_id" class="t09_siswanonrutinbayar_nonrutin_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t09_siswanonrutinbayar->nonrutin_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t09_siswanonrutinbayar->nonrutin_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t09_siswanonrutinbayar->nonrutin_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t09_siswanonrutinbayar->Bayar_Tgl->Visible) { // Bayar_Tgl ?>
	<?php if ($t09_siswanonrutinbayar->SortUrl($t09_siswanonrutinbayar->Bayar_Tgl) == "") { ?>
		<th data-name="Bayar_Tgl"><div id="elh_t09_siswanonrutinbayar_Bayar_Tgl" class="t09_siswanonrutinbayar_Bayar_Tgl"><div class="ewTableHeaderCaption"><?php echo $t09_siswanonrutinbayar->Bayar_Tgl->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Bayar_Tgl"><div><div id="elh_t09_siswanonrutinbayar_Bayar_Tgl" class="t09_siswanonrutinbayar_Bayar_Tgl">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t09_siswanonrutinbayar->Bayar_Tgl->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t09_siswanonrutinbayar->Bayar_Tgl->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t09_siswanonrutinbayar->Bayar_Tgl->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t09_siswanonrutinbayar->Bayar_Jumlah->Visible) { // Bayar_Jumlah ?>
	<?php if ($t09_siswanonrutinbayar->SortUrl($t09_siswanonrutinbayar->Bayar_Jumlah) == "") { ?>
		<th data-name="Bayar_Jumlah"><div id="elh_t09_siswanonrutinbayar_Bayar_Jumlah" class="t09_siswanonrutinbayar_Bayar_Jumlah"><div class="ewTableHeaderCaption"><?php echo $t09_siswanonrutinbayar->Bayar_Jumlah->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Bayar_Jumlah"><div><div id="elh_t09_siswanonrutinbayar_Bayar_Jumlah" class="t09_siswanonrutinbayar_Bayar_Jumlah">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t09_siswanonrutinbayar->Bayar_Jumlah->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t09_siswanonrutinbayar->Bayar_Jumlah->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t09_siswanonrutinbayar->Bayar_Jumlah->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$t09_siswanonrutinbayar_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$t09_siswanonrutinbayar_grid->StartRec = 1;
$t09_siswanonrutinbayar_grid->StopRec = $t09_siswanonrutinbayar_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($t09_siswanonrutinbayar_grid->FormKeyCountName) && ($t09_siswanonrutinbayar->CurrentAction == "gridadd" || $t09_siswanonrutinbayar->CurrentAction == "gridedit" || $t09_siswanonrutinbayar->CurrentAction == "F")) {
		$t09_siswanonrutinbayar_grid->KeyCount = $objForm->GetValue($t09_siswanonrutinbayar_grid->FormKeyCountName);
		$t09_siswanonrutinbayar_grid->StopRec = $t09_siswanonrutinbayar_grid->StartRec + $t09_siswanonrutinbayar_grid->KeyCount - 1;
	}
}
$t09_siswanonrutinbayar_grid->RecCnt = $t09_siswanonrutinbayar_grid->StartRec - 1;
if ($t09_siswanonrutinbayar_grid->Recordset && !$t09_siswanonrutinbayar_grid->Recordset->EOF) {
	$t09_siswanonrutinbayar_grid->Recordset->MoveFirst();
	$bSelectLimit = $t09_siswanonrutinbayar_grid->UseSelectLimit;
	if (!$bSelectLimit && $t09_siswanonrutinbayar_grid->StartRec > 1)
		$t09_siswanonrutinbayar_grid->Recordset->Move($t09_siswanonrutinbayar_grid->StartRec - 1);
} elseif (!$t09_siswanonrutinbayar->AllowAddDeleteRow && $t09_siswanonrutinbayar_grid->StopRec == 0) {
	$t09_siswanonrutinbayar_grid->StopRec = $t09_siswanonrutinbayar->GridAddRowCount;
}

// Initialize aggregate
$t09_siswanonrutinbayar->RowType = EW_ROWTYPE_AGGREGATEINIT;
$t09_siswanonrutinbayar->ResetAttrs();
$t09_siswanonrutinbayar_grid->RenderRow();
if ($t09_siswanonrutinbayar->CurrentAction == "gridadd")
	$t09_siswanonrutinbayar_grid->RowIndex = 0;
if ($t09_siswanonrutinbayar->CurrentAction == "gridedit")
	$t09_siswanonrutinbayar_grid->RowIndex = 0;
while ($t09_siswanonrutinbayar_grid->RecCnt < $t09_siswanonrutinbayar_grid->StopRec) {
	$t09_siswanonrutinbayar_grid->RecCnt++;
	if (intval($t09_siswanonrutinbayar_grid->RecCnt) >= intval($t09_siswanonrutinbayar_grid->StartRec)) {
		$t09_siswanonrutinbayar_grid->RowCnt++;
		if ($t09_siswanonrutinbayar->CurrentAction == "gridadd" || $t09_siswanonrutinbayar->CurrentAction == "gridedit" || $t09_siswanonrutinbayar->CurrentAction == "F") {
			$t09_siswanonrutinbayar_grid->RowIndex++;
			$objForm->Index = $t09_siswanonrutinbayar_grid->RowIndex;
			if ($objForm->HasValue($t09_siswanonrutinbayar_grid->FormActionName))
				$t09_siswanonrutinbayar_grid->RowAction = strval($objForm->GetValue($t09_siswanonrutinbayar_grid->FormActionName));
			elseif ($t09_siswanonrutinbayar->CurrentAction == "gridadd")
				$t09_siswanonrutinbayar_grid->RowAction = "insert";
			else
				$t09_siswanonrutinbayar_grid->RowAction = "";
		}

		// Set up key count
		$t09_siswanonrutinbayar_grid->KeyCount = $t09_siswanonrutinbayar_grid->RowIndex;

		// Init row class and style
		$t09_siswanonrutinbayar->ResetAttrs();
		$t09_siswanonrutinbayar->CssClass = "";
		if ($t09_siswanonrutinbayar->CurrentAction == "gridadd") {
			if ($t09_siswanonrutinbayar->CurrentMode == "copy") {
				$t09_siswanonrutinbayar_grid->LoadRowValues($t09_siswanonrutinbayar_grid->Recordset); // Load row values
				$t09_siswanonrutinbayar_grid->SetRecordKey($t09_siswanonrutinbayar_grid->RowOldKey, $t09_siswanonrutinbayar_grid->Recordset); // Set old record key
			} else {
				$t09_siswanonrutinbayar_grid->LoadDefaultValues(); // Load default values
				$t09_siswanonrutinbayar_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$t09_siswanonrutinbayar_grid->LoadRowValues($t09_siswanonrutinbayar_grid->Recordset); // Load row values
		}
		$t09_siswanonrutinbayar->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($t09_siswanonrutinbayar->CurrentAction == "gridadd") // Grid add
			$t09_siswanonrutinbayar->RowType = EW_ROWTYPE_ADD; // Render add
		if ($t09_siswanonrutinbayar->CurrentAction == "gridadd" && $t09_siswanonrutinbayar->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$t09_siswanonrutinbayar_grid->RestoreCurrentRowFormValues($t09_siswanonrutinbayar_grid->RowIndex); // Restore form values
		if ($t09_siswanonrutinbayar->CurrentAction == "gridedit") { // Grid edit
			if ($t09_siswanonrutinbayar->EventCancelled) {
				$t09_siswanonrutinbayar_grid->RestoreCurrentRowFormValues($t09_siswanonrutinbayar_grid->RowIndex); // Restore form values
			}
			if ($t09_siswanonrutinbayar_grid->RowAction == "insert")
				$t09_siswanonrutinbayar->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$t09_siswanonrutinbayar->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($t09_siswanonrutinbayar->CurrentAction == "gridedit" && ($t09_siswanonrutinbayar->RowType == EW_ROWTYPE_EDIT || $t09_siswanonrutinbayar->RowType == EW_ROWTYPE_ADD) && $t09_siswanonrutinbayar->EventCancelled) // Update failed
			$t09_siswanonrutinbayar_grid->RestoreCurrentRowFormValues($t09_siswanonrutinbayar_grid->RowIndex); // Restore form values
		if ($t09_siswanonrutinbayar->RowType == EW_ROWTYPE_EDIT) // Edit row
			$t09_siswanonrutinbayar_grid->EditRowCnt++;
		if ($t09_siswanonrutinbayar->CurrentAction == "F") // Confirm row
			$t09_siswanonrutinbayar_grid->RestoreCurrentRowFormValues($t09_siswanonrutinbayar_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$t09_siswanonrutinbayar->RowAttrs = array_merge($t09_siswanonrutinbayar->RowAttrs, array('data-rowindex'=>$t09_siswanonrutinbayar_grid->RowCnt, 'id'=>'r' . $t09_siswanonrutinbayar_grid->RowCnt . '_t09_siswanonrutinbayar', 'data-rowtype'=>$t09_siswanonrutinbayar->RowType));

		// Render row
		$t09_siswanonrutinbayar_grid->RenderRow();

		// Render list options
		$t09_siswanonrutinbayar_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t09_siswanonrutinbayar_grid->RowAction <> "delete" && $t09_siswanonrutinbayar_grid->RowAction <> "insertdelete" && !($t09_siswanonrutinbayar_grid->RowAction == "insert" && $t09_siswanonrutinbayar->CurrentAction == "F" && $t09_siswanonrutinbayar_grid->EmptyRow())) {
?>
	<tr<?php echo $t09_siswanonrutinbayar->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t09_siswanonrutinbayar_grid->ListOptions->Render("body", "left", $t09_siswanonrutinbayar_grid->RowCnt);
?>
	<?php if ($t09_siswanonrutinbayar->siswa_id->Visible) { // siswa_id ?>
		<td data-name="siswa_id"<?php echo $t09_siswanonrutinbayar->siswa_id->CellAttributes() ?>>
<?php if ($t09_siswanonrutinbayar->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($t09_siswanonrutinbayar->siswa_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $t09_siswanonrutinbayar_grid->RowCnt ?>_t09_siswanonrutinbayar_siswa_id" class="form-group t09_siswanonrutinbayar_siswa_id">
<span<?php echo $t09_siswanonrutinbayar->siswa_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t09_siswanonrutinbayar->siswa_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_siswa_id" name="x<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_siswa_id" value="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->siswa_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t09_siswanonrutinbayar_grid->RowCnt ?>_t09_siswanonrutinbayar_siswa_id" class="form-group t09_siswanonrutinbayar_siswa_id">
<input type="text" data-table="t09_siswanonrutinbayar" data-field="x_siswa_id" name="x<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_siswa_id" id="x<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_siswa_id" size="30" placeholder="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->siswa_id->getPlaceHolder()) ?>" value="<?php echo $t09_siswanonrutinbayar->siswa_id->EditValue ?>"<?php echo $t09_siswanonrutinbayar->siswa_id->EditAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="t09_siswanonrutinbayar" data-field="x_siswa_id" name="o<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_siswa_id" id="o<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_siswa_id" value="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->siswa_id->OldValue) ?>">
<?php } ?>
<?php if ($t09_siswanonrutinbayar->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($t09_siswanonrutinbayar->siswa_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $t09_siswanonrutinbayar_grid->RowCnt ?>_t09_siswanonrutinbayar_siswa_id" class="form-group t09_siswanonrutinbayar_siswa_id">
<span<?php echo $t09_siswanonrutinbayar->siswa_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t09_siswanonrutinbayar->siswa_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_siswa_id" name="x<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_siswa_id" value="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->siswa_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t09_siswanonrutinbayar_grid->RowCnt ?>_t09_siswanonrutinbayar_siswa_id" class="form-group t09_siswanonrutinbayar_siswa_id">
<input type="text" data-table="t09_siswanonrutinbayar" data-field="x_siswa_id" name="x<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_siswa_id" id="x<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_siswa_id" size="30" placeholder="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->siswa_id->getPlaceHolder()) ?>" value="<?php echo $t09_siswanonrutinbayar->siswa_id->EditValue ?>"<?php echo $t09_siswanonrutinbayar->siswa_id->EditAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($t09_siswanonrutinbayar->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t09_siswanonrutinbayar_grid->RowCnt ?>_t09_siswanonrutinbayar_siswa_id" class="t09_siswanonrutinbayar_siswa_id">
<span<?php echo $t09_siswanonrutinbayar->siswa_id->ViewAttributes() ?>>
<?php echo $t09_siswanonrutinbayar->siswa_id->ListViewValue() ?></span>
</span>
<?php if ($t09_siswanonrutinbayar->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t09_siswanonrutinbayar" data-field="x_siswa_id" name="x<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_siswa_id" id="x<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_siswa_id" value="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->siswa_id->FormValue) ?>">
<input type="hidden" data-table="t09_siswanonrutinbayar" data-field="x_siswa_id" name="o<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_siswa_id" id="o<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_siswa_id" value="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->siswa_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t09_siswanonrutinbayar" data-field="x_siswa_id" name="ft09_siswanonrutinbayargrid$x<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_siswa_id" id="ft09_siswanonrutinbayargrid$x<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_siswa_id" value="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->siswa_id->FormValue) ?>">
<input type="hidden" data-table="t09_siswanonrutinbayar" data-field="x_siswa_id" name="ft09_siswanonrutinbayargrid$o<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_siswa_id" id="ft09_siswanonrutinbayargrid$o<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_siswa_id" value="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->siswa_id->OldValue) ?>">
<?php } ?>
<?php } ?>
<a id="<?php echo $t09_siswanonrutinbayar_grid->PageObjName . "_row_" . $t09_siswanonrutinbayar_grid->RowCnt ?>"></a></td>
	<?php } ?>
<?php if ($t09_siswanonrutinbayar->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="t09_siswanonrutinbayar" data-field="x_id" name="x<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_id" id="x<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->id->CurrentValue) ?>">
<input type="hidden" data-table="t09_siswanonrutinbayar" data-field="x_id" name="o<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_id" id="o<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->id->OldValue) ?>">
<?php } ?>
<?php if ($t09_siswanonrutinbayar->RowType == EW_ROWTYPE_EDIT || $t09_siswanonrutinbayar->CurrentMode == "edit") { ?>
<input type="hidden" data-table="t09_siswanonrutinbayar" data-field="x_id" name="x<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_id" id="x<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($t09_siswanonrutinbayar->nonrutin_id->Visible) { // nonrutin_id ?>
		<td data-name="nonrutin_id"<?php echo $t09_siswanonrutinbayar->nonrutin_id->CellAttributes() ?>>
<?php if ($t09_siswanonrutinbayar->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t09_siswanonrutinbayar_grid->RowCnt ?>_t09_siswanonrutinbayar_nonrutin_id" class="form-group t09_siswanonrutinbayar_nonrutin_id">
<input type="text" data-table="t09_siswanonrutinbayar" data-field="x_nonrutin_id" name="x<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_nonrutin_id" id="x<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_nonrutin_id" size="30" placeholder="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->nonrutin_id->getPlaceHolder()) ?>" value="<?php echo $t09_siswanonrutinbayar->nonrutin_id->EditValue ?>"<?php echo $t09_siswanonrutinbayar->nonrutin_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t09_siswanonrutinbayar" data-field="x_nonrutin_id" name="o<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_nonrutin_id" id="o<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_nonrutin_id" value="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->nonrutin_id->OldValue) ?>">
<?php } ?>
<?php if ($t09_siswanonrutinbayar->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t09_siswanonrutinbayar_grid->RowCnt ?>_t09_siswanonrutinbayar_nonrutin_id" class="form-group t09_siswanonrutinbayar_nonrutin_id">
<input type="text" data-table="t09_siswanonrutinbayar" data-field="x_nonrutin_id" name="x<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_nonrutin_id" id="x<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_nonrutin_id" size="30" placeholder="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->nonrutin_id->getPlaceHolder()) ?>" value="<?php echo $t09_siswanonrutinbayar->nonrutin_id->EditValue ?>"<?php echo $t09_siswanonrutinbayar->nonrutin_id->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t09_siswanonrutinbayar->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t09_siswanonrutinbayar_grid->RowCnt ?>_t09_siswanonrutinbayar_nonrutin_id" class="t09_siswanonrutinbayar_nonrutin_id">
<span<?php echo $t09_siswanonrutinbayar->nonrutin_id->ViewAttributes() ?>>
<?php echo $t09_siswanonrutinbayar->nonrutin_id->ListViewValue() ?></span>
</span>
<?php if ($t09_siswanonrutinbayar->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t09_siswanonrutinbayar" data-field="x_nonrutin_id" name="x<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_nonrutin_id" id="x<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_nonrutin_id" value="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->nonrutin_id->FormValue) ?>">
<input type="hidden" data-table="t09_siswanonrutinbayar" data-field="x_nonrutin_id" name="o<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_nonrutin_id" id="o<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_nonrutin_id" value="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->nonrutin_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t09_siswanonrutinbayar" data-field="x_nonrutin_id" name="ft09_siswanonrutinbayargrid$x<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_nonrutin_id" id="ft09_siswanonrutinbayargrid$x<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_nonrutin_id" value="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->nonrutin_id->FormValue) ?>">
<input type="hidden" data-table="t09_siswanonrutinbayar" data-field="x_nonrutin_id" name="ft09_siswanonrutinbayargrid$o<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_nonrutin_id" id="ft09_siswanonrutinbayargrid$o<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_nonrutin_id" value="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->nonrutin_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t09_siswanonrutinbayar->Bayar_Tgl->Visible) { // Bayar_Tgl ?>
		<td data-name="Bayar_Tgl"<?php echo $t09_siswanonrutinbayar->Bayar_Tgl->CellAttributes() ?>>
<?php if ($t09_siswanonrutinbayar->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t09_siswanonrutinbayar_grid->RowCnt ?>_t09_siswanonrutinbayar_Bayar_Tgl" class="form-group t09_siswanonrutinbayar_Bayar_Tgl">
<input type="text" data-table="t09_siswanonrutinbayar" data-field="x_Bayar_Tgl" name="x<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_Bayar_Tgl" id="x<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_Bayar_Tgl" placeholder="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->Bayar_Tgl->getPlaceHolder()) ?>" value="<?php echo $t09_siswanonrutinbayar->Bayar_Tgl->EditValue ?>"<?php echo $t09_siswanonrutinbayar->Bayar_Tgl->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t09_siswanonrutinbayar" data-field="x_Bayar_Tgl" name="o<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_Bayar_Tgl" id="o<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_Bayar_Tgl" value="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->Bayar_Tgl->OldValue) ?>">
<?php } ?>
<?php if ($t09_siswanonrutinbayar->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t09_siswanonrutinbayar_grid->RowCnt ?>_t09_siswanonrutinbayar_Bayar_Tgl" class="form-group t09_siswanonrutinbayar_Bayar_Tgl">
<input type="text" data-table="t09_siswanonrutinbayar" data-field="x_Bayar_Tgl" name="x<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_Bayar_Tgl" id="x<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_Bayar_Tgl" placeholder="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->Bayar_Tgl->getPlaceHolder()) ?>" value="<?php echo $t09_siswanonrutinbayar->Bayar_Tgl->EditValue ?>"<?php echo $t09_siswanonrutinbayar->Bayar_Tgl->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t09_siswanonrutinbayar->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t09_siswanonrutinbayar_grid->RowCnt ?>_t09_siswanonrutinbayar_Bayar_Tgl" class="t09_siswanonrutinbayar_Bayar_Tgl">
<span<?php echo $t09_siswanonrutinbayar->Bayar_Tgl->ViewAttributes() ?>>
<?php echo $t09_siswanonrutinbayar->Bayar_Tgl->ListViewValue() ?></span>
</span>
<?php if ($t09_siswanonrutinbayar->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t09_siswanonrutinbayar" data-field="x_Bayar_Tgl" name="x<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_Bayar_Tgl" id="x<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_Bayar_Tgl" value="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->Bayar_Tgl->FormValue) ?>">
<input type="hidden" data-table="t09_siswanonrutinbayar" data-field="x_Bayar_Tgl" name="o<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_Bayar_Tgl" id="o<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_Bayar_Tgl" value="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->Bayar_Tgl->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t09_siswanonrutinbayar" data-field="x_Bayar_Tgl" name="ft09_siswanonrutinbayargrid$x<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_Bayar_Tgl" id="ft09_siswanonrutinbayargrid$x<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_Bayar_Tgl" value="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->Bayar_Tgl->FormValue) ?>">
<input type="hidden" data-table="t09_siswanonrutinbayar" data-field="x_Bayar_Tgl" name="ft09_siswanonrutinbayargrid$o<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_Bayar_Tgl" id="ft09_siswanonrutinbayargrid$o<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_Bayar_Tgl" value="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->Bayar_Tgl->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t09_siswanonrutinbayar->Bayar_Jumlah->Visible) { // Bayar_Jumlah ?>
		<td data-name="Bayar_Jumlah"<?php echo $t09_siswanonrutinbayar->Bayar_Jumlah->CellAttributes() ?>>
<?php if ($t09_siswanonrutinbayar->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t09_siswanonrutinbayar_grid->RowCnt ?>_t09_siswanonrutinbayar_Bayar_Jumlah" class="form-group t09_siswanonrutinbayar_Bayar_Jumlah">
<input type="text" data-table="t09_siswanonrutinbayar" data-field="x_Bayar_Jumlah" name="x<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_Bayar_Jumlah" id="x<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_Bayar_Jumlah" size="30" placeholder="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->Bayar_Jumlah->getPlaceHolder()) ?>" value="<?php echo $t09_siswanonrutinbayar->Bayar_Jumlah->EditValue ?>"<?php echo $t09_siswanonrutinbayar->Bayar_Jumlah->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t09_siswanonrutinbayar" data-field="x_Bayar_Jumlah" name="o<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_Bayar_Jumlah" id="o<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_Bayar_Jumlah" value="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->Bayar_Jumlah->OldValue) ?>">
<?php } ?>
<?php if ($t09_siswanonrutinbayar->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t09_siswanonrutinbayar_grid->RowCnt ?>_t09_siswanonrutinbayar_Bayar_Jumlah" class="form-group t09_siswanonrutinbayar_Bayar_Jumlah">
<input type="text" data-table="t09_siswanonrutinbayar" data-field="x_Bayar_Jumlah" name="x<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_Bayar_Jumlah" id="x<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_Bayar_Jumlah" size="30" placeholder="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->Bayar_Jumlah->getPlaceHolder()) ?>" value="<?php echo $t09_siswanonrutinbayar->Bayar_Jumlah->EditValue ?>"<?php echo $t09_siswanonrutinbayar->Bayar_Jumlah->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t09_siswanonrutinbayar->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t09_siswanonrutinbayar_grid->RowCnt ?>_t09_siswanonrutinbayar_Bayar_Jumlah" class="t09_siswanonrutinbayar_Bayar_Jumlah">
<span<?php echo $t09_siswanonrutinbayar->Bayar_Jumlah->ViewAttributes() ?>>
<?php echo $t09_siswanonrutinbayar->Bayar_Jumlah->ListViewValue() ?></span>
</span>
<?php if ($t09_siswanonrutinbayar->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t09_siswanonrutinbayar" data-field="x_Bayar_Jumlah" name="x<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_Bayar_Jumlah" id="x<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_Bayar_Jumlah" value="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->Bayar_Jumlah->FormValue) ?>">
<input type="hidden" data-table="t09_siswanonrutinbayar" data-field="x_Bayar_Jumlah" name="o<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_Bayar_Jumlah" id="o<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_Bayar_Jumlah" value="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->Bayar_Jumlah->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t09_siswanonrutinbayar" data-field="x_Bayar_Jumlah" name="ft09_siswanonrutinbayargrid$x<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_Bayar_Jumlah" id="ft09_siswanonrutinbayargrid$x<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_Bayar_Jumlah" value="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->Bayar_Jumlah->FormValue) ?>">
<input type="hidden" data-table="t09_siswanonrutinbayar" data-field="x_Bayar_Jumlah" name="ft09_siswanonrutinbayargrid$o<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_Bayar_Jumlah" id="ft09_siswanonrutinbayargrid$o<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_Bayar_Jumlah" value="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->Bayar_Jumlah->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t09_siswanonrutinbayar_grid->ListOptions->Render("body", "right", $t09_siswanonrutinbayar_grid->RowCnt);
?>
	</tr>
<?php if ($t09_siswanonrutinbayar->RowType == EW_ROWTYPE_ADD || $t09_siswanonrutinbayar->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
ft09_siswanonrutinbayargrid.UpdateOpts(<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($t09_siswanonrutinbayar->CurrentAction <> "gridadd" || $t09_siswanonrutinbayar->CurrentMode == "copy")
		if (!$t09_siswanonrutinbayar_grid->Recordset->EOF) $t09_siswanonrutinbayar_grid->Recordset->MoveNext();
}
?>
<?php
	if ($t09_siswanonrutinbayar->CurrentMode == "add" || $t09_siswanonrutinbayar->CurrentMode == "copy" || $t09_siswanonrutinbayar->CurrentMode == "edit") {
		$t09_siswanonrutinbayar_grid->RowIndex = '$rowindex$';
		$t09_siswanonrutinbayar_grid->LoadDefaultValues();

		// Set row properties
		$t09_siswanonrutinbayar->ResetAttrs();
		$t09_siswanonrutinbayar->RowAttrs = array_merge($t09_siswanonrutinbayar->RowAttrs, array('data-rowindex'=>$t09_siswanonrutinbayar_grid->RowIndex, 'id'=>'r0_t09_siswanonrutinbayar', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($t09_siswanonrutinbayar->RowAttrs["class"], "ewTemplate");
		$t09_siswanonrutinbayar->RowType = EW_ROWTYPE_ADD;

		// Render row
		$t09_siswanonrutinbayar_grid->RenderRow();

		// Render list options
		$t09_siswanonrutinbayar_grid->RenderListOptions();
		$t09_siswanonrutinbayar_grid->StartRowCnt = 0;
?>
	<tr<?php echo $t09_siswanonrutinbayar->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t09_siswanonrutinbayar_grid->ListOptions->Render("body", "left", $t09_siswanonrutinbayar_grid->RowIndex);
?>
	<?php if ($t09_siswanonrutinbayar->siswa_id->Visible) { // siswa_id ?>
		<td data-name="siswa_id">
<?php if ($t09_siswanonrutinbayar->CurrentAction <> "F") { ?>
<?php if ($t09_siswanonrutinbayar->siswa_id->getSessionValue() <> "") { ?>
<span id="el$rowindex$_t09_siswanonrutinbayar_siswa_id" class="form-group t09_siswanonrutinbayar_siswa_id">
<span<?php echo $t09_siswanonrutinbayar->siswa_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t09_siswanonrutinbayar->siswa_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_siswa_id" name="x<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_siswa_id" value="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->siswa_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_t09_siswanonrutinbayar_siswa_id" class="form-group t09_siswanonrutinbayar_siswa_id">
<input type="text" data-table="t09_siswanonrutinbayar" data-field="x_siswa_id" name="x<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_siswa_id" id="x<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_siswa_id" size="30" placeholder="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->siswa_id->getPlaceHolder()) ?>" value="<?php echo $t09_siswanonrutinbayar->siswa_id->EditValue ?>"<?php echo $t09_siswanonrutinbayar->siswa_id->EditAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_t09_siswanonrutinbayar_siswa_id" class="form-group t09_siswanonrutinbayar_siswa_id">
<span<?php echo $t09_siswanonrutinbayar->siswa_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t09_siswanonrutinbayar->siswa_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t09_siswanonrutinbayar" data-field="x_siswa_id" name="x<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_siswa_id" id="x<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_siswa_id" value="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->siswa_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t09_siswanonrutinbayar" data-field="x_siswa_id" name="o<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_siswa_id" id="o<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_siswa_id" value="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->siswa_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t09_siswanonrutinbayar->nonrutin_id->Visible) { // nonrutin_id ?>
		<td data-name="nonrutin_id">
<?php if ($t09_siswanonrutinbayar->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t09_siswanonrutinbayar_nonrutin_id" class="form-group t09_siswanonrutinbayar_nonrutin_id">
<input type="text" data-table="t09_siswanonrutinbayar" data-field="x_nonrutin_id" name="x<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_nonrutin_id" id="x<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_nonrutin_id" size="30" placeholder="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->nonrutin_id->getPlaceHolder()) ?>" value="<?php echo $t09_siswanonrutinbayar->nonrutin_id->EditValue ?>"<?php echo $t09_siswanonrutinbayar->nonrutin_id->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t09_siswanonrutinbayar_nonrutin_id" class="form-group t09_siswanonrutinbayar_nonrutin_id">
<span<?php echo $t09_siswanonrutinbayar->nonrutin_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t09_siswanonrutinbayar->nonrutin_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t09_siswanonrutinbayar" data-field="x_nonrutin_id" name="x<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_nonrutin_id" id="x<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_nonrutin_id" value="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->nonrutin_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t09_siswanonrutinbayar" data-field="x_nonrutin_id" name="o<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_nonrutin_id" id="o<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_nonrutin_id" value="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->nonrutin_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t09_siswanonrutinbayar->Bayar_Tgl->Visible) { // Bayar_Tgl ?>
		<td data-name="Bayar_Tgl">
<?php if ($t09_siswanonrutinbayar->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t09_siswanonrutinbayar_Bayar_Tgl" class="form-group t09_siswanonrutinbayar_Bayar_Tgl">
<input type="text" data-table="t09_siswanonrutinbayar" data-field="x_Bayar_Tgl" name="x<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_Bayar_Tgl" id="x<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_Bayar_Tgl" placeholder="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->Bayar_Tgl->getPlaceHolder()) ?>" value="<?php echo $t09_siswanonrutinbayar->Bayar_Tgl->EditValue ?>"<?php echo $t09_siswanonrutinbayar->Bayar_Tgl->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t09_siswanonrutinbayar_Bayar_Tgl" class="form-group t09_siswanonrutinbayar_Bayar_Tgl">
<span<?php echo $t09_siswanonrutinbayar->Bayar_Tgl->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t09_siswanonrutinbayar->Bayar_Tgl->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t09_siswanonrutinbayar" data-field="x_Bayar_Tgl" name="x<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_Bayar_Tgl" id="x<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_Bayar_Tgl" value="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->Bayar_Tgl->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t09_siswanonrutinbayar" data-field="x_Bayar_Tgl" name="o<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_Bayar_Tgl" id="o<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_Bayar_Tgl" value="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->Bayar_Tgl->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t09_siswanonrutinbayar->Bayar_Jumlah->Visible) { // Bayar_Jumlah ?>
		<td data-name="Bayar_Jumlah">
<?php if ($t09_siswanonrutinbayar->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t09_siswanonrutinbayar_Bayar_Jumlah" class="form-group t09_siswanonrutinbayar_Bayar_Jumlah">
<input type="text" data-table="t09_siswanonrutinbayar" data-field="x_Bayar_Jumlah" name="x<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_Bayar_Jumlah" id="x<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_Bayar_Jumlah" size="30" placeholder="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->Bayar_Jumlah->getPlaceHolder()) ?>" value="<?php echo $t09_siswanonrutinbayar->Bayar_Jumlah->EditValue ?>"<?php echo $t09_siswanonrutinbayar->Bayar_Jumlah->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t09_siswanonrutinbayar_Bayar_Jumlah" class="form-group t09_siswanonrutinbayar_Bayar_Jumlah">
<span<?php echo $t09_siswanonrutinbayar->Bayar_Jumlah->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t09_siswanonrutinbayar->Bayar_Jumlah->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t09_siswanonrutinbayar" data-field="x_Bayar_Jumlah" name="x<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_Bayar_Jumlah" id="x<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_Bayar_Jumlah" value="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->Bayar_Jumlah->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t09_siswanonrutinbayar" data-field="x_Bayar_Jumlah" name="o<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_Bayar_Jumlah" id="o<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>_Bayar_Jumlah" value="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->Bayar_Jumlah->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t09_siswanonrutinbayar_grid->ListOptions->Render("body", "right", $t09_siswanonrutinbayar_grid->RowCnt);
?>
<script type="text/javascript">
ft09_siswanonrutinbayargrid.UpdateOpts(<?php echo $t09_siswanonrutinbayar_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($t09_siswanonrutinbayar->CurrentMode == "add" || $t09_siswanonrutinbayar->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $t09_siswanonrutinbayar_grid->FormKeyCountName ?>" id="<?php echo $t09_siswanonrutinbayar_grid->FormKeyCountName ?>" value="<?php echo $t09_siswanonrutinbayar_grid->KeyCount ?>">
<?php echo $t09_siswanonrutinbayar_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t09_siswanonrutinbayar->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $t09_siswanonrutinbayar_grid->FormKeyCountName ?>" id="<?php echo $t09_siswanonrutinbayar_grid->FormKeyCountName ?>" value="<?php echo $t09_siswanonrutinbayar_grid->KeyCount ?>">
<?php echo $t09_siswanonrutinbayar_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t09_siswanonrutinbayar->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ft09_siswanonrutinbayargrid">
</div>
<?php

// Close recordset
if ($t09_siswanonrutinbayar_grid->Recordset)
	$t09_siswanonrutinbayar_grid->Recordset->Close();
?>
</div>
</div>
<?php } ?>
<?php if ($t09_siswanonrutinbayar_grid->TotalRecs == 0 && $t09_siswanonrutinbayar->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t09_siswanonrutinbayar_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($t09_siswanonrutinbayar->Export == "") { ?>
<script type="text/javascript">
ft09_siswanonrutinbayargrid.Init();
</script>
<?php } ?>
<?php
$t09_siswanonrutinbayar_grid->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
$t09_siswanonrutinbayar_grid->Page_Terminate();
?>
