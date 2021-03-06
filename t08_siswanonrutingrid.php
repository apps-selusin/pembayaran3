<?php include_once "t96_employeesinfo.php" ?>
<?php

// Create page object
if (!isset($t08_siswanonrutin_grid)) $t08_siswanonrutin_grid = new ct08_siswanonrutin_grid();

// Page init
$t08_siswanonrutin_grid->Page_Init();

// Page main
$t08_siswanonrutin_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t08_siswanonrutin_grid->Page_Render();
?>
<?php if ($t08_siswanonrutin->Export == "") { ?>
<script type="text/javascript">

// Form object
var ft08_siswanonrutingrid = new ew_Form("ft08_siswanonrutingrid", "grid");
ft08_siswanonrutingrid.FormKeyCountName = '<?php echo $t08_siswanonrutin_grid->FormKeyCountName ?>';

// Validate form
ft08_siswanonrutingrid.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_Nilai");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t08_siswanonrutin->Nilai->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Terbayar");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t08_siswanonrutin->Terbayar->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Sisa");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t08_siswanonrutin->Sisa->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
ft08_siswanonrutingrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "nonrutin_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Nilai", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Terbayar", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Sisa", false)) return false;
	return true;
}

// Form_CustomValidate event
ft08_siswanonrutingrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft08_siswanonrutingrid.ValidateRequired = true;
<?php } else { ?>
ft08_siswanonrutingrid.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
ft08_siswanonrutingrid.Lists["x_nonrutin_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Nama","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t07_nonrutin"};

// Form object for search
</script>
<?php } ?>
<?php
if ($t08_siswanonrutin->CurrentAction == "gridadd") {
	if ($t08_siswanonrutin->CurrentMode == "copy") {
		$bSelectLimit = $t08_siswanonrutin_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$t08_siswanonrutin_grid->TotalRecs = $t08_siswanonrutin->SelectRecordCount();
			$t08_siswanonrutin_grid->Recordset = $t08_siswanonrutin_grid->LoadRecordset($t08_siswanonrutin_grid->StartRec-1, $t08_siswanonrutin_grid->DisplayRecs);
		} else {
			if ($t08_siswanonrutin_grid->Recordset = $t08_siswanonrutin_grid->LoadRecordset())
				$t08_siswanonrutin_grid->TotalRecs = $t08_siswanonrutin_grid->Recordset->RecordCount();
		}
		$t08_siswanonrutin_grid->StartRec = 1;
		$t08_siswanonrutin_grid->DisplayRecs = $t08_siswanonrutin_grid->TotalRecs;
	} else {
		$t08_siswanonrutin->CurrentFilter = "0=1";
		$t08_siswanonrutin_grid->StartRec = 1;
		$t08_siswanonrutin_grid->DisplayRecs = $t08_siswanonrutin->GridAddRowCount;
	}
	$t08_siswanonrutin_grid->TotalRecs = $t08_siswanonrutin_grid->DisplayRecs;
	$t08_siswanonrutin_grid->StopRec = $t08_siswanonrutin_grid->DisplayRecs;
} else {
	$bSelectLimit = $t08_siswanonrutin_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($t08_siswanonrutin_grid->TotalRecs <= 0)
			$t08_siswanonrutin_grid->TotalRecs = $t08_siswanonrutin->SelectRecordCount();
	} else {
		if (!$t08_siswanonrutin_grid->Recordset && ($t08_siswanonrutin_grid->Recordset = $t08_siswanonrutin_grid->LoadRecordset()))
			$t08_siswanonrutin_grid->TotalRecs = $t08_siswanonrutin_grid->Recordset->RecordCount();
	}
	$t08_siswanonrutin_grid->StartRec = 1;
	$t08_siswanonrutin_grid->DisplayRecs = $t08_siswanonrutin_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$t08_siswanonrutin_grid->Recordset = $t08_siswanonrutin_grid->LoadRecordset($t08_siswanonrutin_grid->StartRec-1, $t08_siswanonrutin_grid->DisplayRecs);

	// Set no record found message
	if ($t08_siswanonrutin->CurrentAction == "" && $t08_siswanonrutin_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$t08_siswanonrutin_grid->setWarningMessage(ew_DeniedMsg());
		if ($t08_siswanonrutin_grid->SearchWhere == "0=101")
			$t08_siswanonrutin_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$t08_siswanonrutin_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$t08_siswanonrutin_grid->RenderOtherOptions();
?>
<?php $t08_siswanonrutin_grid->ShowPageHeader(); ?>
<?php
$t08_siswanonrutin_grid->ShowMessage();
?>
<?php if ($t08_siswanonrutin_grid->TotalRecs > 0 || $t08_siswanonrutin->CurrentAction <> "") { ?>
<div class="panel panel-default ewGrid t08_siswanonrutin">
<div id="ft08_siswanonrutingrid" class="ewForm form-inline">
<?php if ($t08_siswanonrutin_grid->ShowOtherOptions) { ?>
<div class="panel-heading ewGridUpperPanel">
<?php
	foreach ($t08_siswanonrutin_grid->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="gmp_t08_siswanonrutin" class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<table id="tbl_t08_siswanonrutingrid" class="table ewTable">
<?php echo $t08_siswanonrutin->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Header row
$t08_siswanonrutin_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$t08_siswanonrutin_grid->RenderListOptions();

// Render list options (header, left)
$t08_siswanonrutin_grid->ListOptions->Render("header", "left");
?>
<?php if ($t08_siswanonrutin->nonrutin_id->Visible) { // nonrutin_id ?>
	<?php if ($t08_siswanonrutin->SortUrl($t08_siswanonrutin->nonrutin_id) == "") { ?>
		<th data-name="nonrutin_id"><div id="elh_t08_siswanonrutin_nonrutin_id" class="t08_siswanonrutin_nonrutin_id"><div class="ewTableHeaderCaption"><?php echo $t08_siswanonrutin->nonrutin_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nonrutin_id"><div><div id="elh_t08_siswanonrutin_nonrutin_id" class="t08_siswanonrutin_nonrutin_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t08_siswanonrutin->nonrutin_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t08_siswanonrutin->nonrutin_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t08_siswanonrutin->nonrutin_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t08_siswanonrutin->Nilai->Visible) { // Nilai ?>
	<?php if ($t08_siswanonrutin->SortUrl($t08_siswanonrutin->Nilai) == "") { ?>
		<th data-name="Nilai"><div id="elh_t08_siswanonrutin_Nilai" class="t08_siswanonrutin_Nilai"><div class="ewTableHeaderCaption"><?php echo $t08_siswanonrutin->Nilai->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Nilai"><div><div id="elh_t08_siswanonrutin_Nilai" class="t08_siswanonrutin_Nilai">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t08_siswanonrutin->Nilai->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t08_siswanonrutin->Nilai->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t08_siswanonrutin->Nilai->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t08_siswanonrutin->Terbayar->Visible) { // Terbayar ?>
	<?php if ($t08_siswanonrutin->SortUrl($t08_siswanonrutin->Terbayar) == "") { ?>
		<th data-name="Terbayar"><div id="elh_t08_siswanonrutin_Terbayar" class="t08_siswanonrutin_Terbayar"><div class="ewTableHeaderCaption"><?php echo $t08_siswanonrutin->Terbayar->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Terbayar"><div><div id="elh_t08_siswanonrutin_Terbayar" class="t08_siswanonrutin_Terbayar">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t08_siswanonrutin->Terbayar->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t08_siswanonrutin->Terbayar->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t08_siswanonrutin->Terbayar->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t08_siswanonrutin->Sisa->Visible) { // Sisa ?>
	<?php if ($t08_siswanonrutin->SortUrl($t08_siswanonrutin->Sisa) == "") { ?>
		<th data-name="Sisa"><div id="elh_t08_siswanonrutin_Sisa" class="t08_siswanonrutin_Sisa"><div class="ewTableHeaderCaption"><?php echo $t08_siswanonrutin->Sisa->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Sisa"><div><div id="elh_t08_siswanonrutin_Sisa" class="t08_siswanonrutin_Sisa">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t08_siswanonrutin->Sisa->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t08_siswanonrutin->Sisa->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t08_siswanonrutin->Sisa->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$t08_siswanonrutin_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$t08_siswanonrutin_grid->StartRec = 1;
$t08_siswanonrutin_grid->StopRec = $t08_siswanonrutin_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($t08_siswanonrutin_grid->FormKeyCountName) && ($t08_siswanonrutin->CurrentAction == "gridadd" || $t08_siswanonrutin->CurrentAction == "gridedit" || $t08_siswanonrutin->CurrentAction == "F")) {
		$t08_siswanonrutin_grid->KeyCount = $objForm->GetValue($t08_siswanonrutin_grid->FormKeyCountName);
		$t08_siswanonrutin_grid->StopRec = $t08_siswanonrutin_grid->StartRec + $t08_siswanonrutin_grid->KeyCount - 1;
	}
}
$t08_siswanonrutin_grid->RecCnt = $t08_siswanonrutin_grid->StartRec - 1;
if ($t08_siswanonrutin_grid->Recordset && !$t08_siswanonrutin_grid->Recordset->EOF) {
	$t08_siswanonrutin_grid->Recordset->MoveFirst();
	$bSelectLimit = $t08_siswanonrutin_grid->UseSelectLimit;
	if (!$bSelectLimit && $t08_siswanonrutin_grid->StartRec > 1)
		$t08_siswanonrutin_grid->Recordset->Move($t08_siswanonrutin_grid->StartRec - 1);
} elseif (!$t08_siswanonrutin->AllowAddDeleteRow && $t08_siswanonrutin_grid->StopRec == 0) {
	$t08_siswanonrutin_grid->StopRec = $t08_siswanonrutin->GridAddRowCount;
}

// Initialize aggregate
$t08_siswanonrutin->RowType = EW_ROWTYPE_AGGREGATEINIT;
$t08_siswanonrutin->ResetAttrs();
$t08_siswanonrutin_grid->RenderRow();
if ($t08_siswanonrutin->CurrentAction == "gridadd")
	$t08_siswanonrutin_grid->RowIndex = 0;
if ($t08_siswanonrutin->CurrentAction == "gridedit")
	$t08_siswanonrutin_grid->RowIndex = 0;
while ($t08_siswanonrutin_grid->RecCnt < $t08_siswanonrutin_grid->StopRec) {
	$t08_siswanonrutin_grid->RecCnt++;
	if (intval($t08_siswanonrutin_grid->RecCnt) >= intval($t08_siswanonrutin_grid->StartRec)) {
		$t08_siswanonrutin_grid->RowCnt++;
		if ($t08_siswanonrutin->CurrentAction == "gridadd" || $t08_siswanonrutin->CurrentAction == "gridedit" || $t08_siswanonrutin->CurrentAction == "F") {
			$t08_siswanonrutin_grid->RowIndex++;
			$objForm->Index = $t08_siswanonrutin_grid->RowIndex;
			if ($objForm->HasValue($t08_siswanonrutin_grid->FormActionName))
				$t08_siswanonrutin_grid->RowAction = strval($objForm->GetValue($t08_siswanonrutin_grid->FormActionName));
			elseif ($t08_siswanonrutin->CurrentAction == "gridadd")
				$t08_siswanonrutin_grid->RowAction = "insert";
			else
				$t08_siswanonrutin_grid->RowAction = "";
		}

		// Set up key count
		$t08_siswanonrutin_grid->KeyCount = $t08_siswanonrutin_grid->RowIndex;

		// Init row class and style
		$t08_siswanonrutin->ResetAttrs();
		$t08_siswanonrutin->CssClass = "";
		if ($t08_siswanonrutin->CurrentAction == "gridadd") {
			if ($t08_siswanonrutin->CurrentMode == "copy") {
				$t08_siswanonrutin_grid->LoadRowValues($t08_siswanonrutin_grid->Recordset); // Load row values
				$t08_siswanonrutin_grid->SetRecordKey($t08_siswanonrutin_grid->RowOldKey, $t08_siswanonrutin_grid->Recordset); // Set old record key
			} else {
				$t08_siswanonrutin_grid->LoadDefaultValues(); // Load default values
				$t08_siswanonrutin_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$t08_siswanonrutin_grid->LoadRowValues($t08_siswanonrutin_grid->Recordset); // Load row values
		}
		$t08_siswanonrutin->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($t08_siswanonrutin->CurrentAction == "gridadd") // Grid add
			$t08_siswanonrutin->RowType = EW_ROWTYPE_ADD; // Render add
		if ($t08_siswanonrutin->CurrentAction == "gridadd" && $t08_siswanonrutin->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$t08_siswanonrutin_grid->RestoreCurrentRowFormValues($t08_siswanonrutin_grid->RowIndex); // Restore form values
		if ($t08_siswanonrutin->CurrentAction == "gridedit") { // Grid edit
			if ($t08_siswanonrutin->EventCancelled) {
				$t08_siswanonrutin_grid->RestoreCurrentRowFormValues($t08_siswanonrutin_grid->RowIndex); // Restore form values
			}
			if ($t08_siswanonrutin_grid->RowAction == "insert")
				$t08_siswanonrutin->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$t08_siswanonrutin->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($t08_siswanonrutin->CurrentAction == "gridedit" && ($t08_siswanonrutin->RowType == EW_ROWTYPE_EDIT || $t08_siswanonrutin->RowType == EW_ROWTYPE_ADD) && $t08_siswanonrutin->EventCancelled) // Update failed
			$t08_siswanonrutin_grid->RestoreCurrentRowFormValues($t08_siswanonrutin_grid->RowIndex); // Restore form values
		if ($t08_siswanonrutin->RowType == EW_ROWTYPE_EDIT) // Edit row
			$t08_siswanonrutin_grid->EditRowCnt++;
		if ($t08_siswanonrutin->CurrentAction == "F") // Confirm row
			$t08_siswanonrutin_grid->RestoreCurrentRowFormValues($t08_siswanonrutin_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$t08_siswanonrutin->RowAttrs = array_merge($t08_siswanonrutin->RowAttrs, array('data-rowindex'=>$t08_siswanonrutin_grid->RowCnt, 'id'=>'r' . $t08_siswanonrutin_grid->RowCnt . '_t08_siswanonrutin', 'data-rowtype'=>$t08_siswanonrutin->RowType));

		// Render row
		$t08_siswanonrutin_grid->RenderRow();

		// Render list options
		$t08_siswanonrutin_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t08_siswanonrutin_grid->RowAction <> "delete" && $t08_siswanonrutin_grid->RowAction <> "insertdelete" && !($t08_siswanonrutin_grid->RowAction == "insert" && $t08_siswanonrutin->CurrentAction == "F" && $t08_siswanonrutin_grid->EmptyRow())) {
?>
	<tr<?php echo $t08_siswanonrutin->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t08_siswanonrutin_grid->ListOptions->Render("body", "left", $t08_siswanonrutin_grid->RowCnt);
?>
	<?php if ($t08_siswanonrutin->nonrutin_id->Visible) { // nonrutin_id ?>
		<td data-name="nonrutin_id"<?php echo $t08_siswanonrutin->nonrutin_id->CellAttributes() ?>>
<?php if ($t08_siswanonrutin->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t08_siswanonrutin_grid->RowCnt ?>_t08_siswanonrutin_nonrutin_id" class="form-group t08_siswanonrutin_nonrutin_id">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_nonrutin_id"><?php echo (strval($t08_siswanonrutin->nonrutin_id->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $t08_siswanonrutin->nonrutin_id->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t08_siswanonrutin->nonrutin_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_nonrutin_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="t08_siswanonrutin" data-field="x_nonrutin_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t08_siswanonrutin->nonrutin_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_nonrutin_id" id="x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_nonrutin_id" value="<?php echo $t08_siswanonrutin->nonrutin_id->CurrentValue ?>"<?php echo $t08_siswanonrutin->nonrutin_id->EditAttributes() ?>>
<input type="hidden" name="s_x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_nonrutin_id" id="s_x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_nonrutin_id" value="<?php echo $t08_siswanonrutin->nonrutin_id->LookupFilterQuery() ?>">
</span>
<input type="hidden" data-table="t08_siswanonrutin" data-field="x_nonrutin_id" name="o<?php echo $t08_siswanonrutin_grid->RowIndex ?>_nonrutin_id" id="o<?php echo $t08_siswanonrutin_grid->RowIndex ?>_nonrutin_id" value="<?php echo ew_HtmlEncode($t08_siswanonrutin->nonrutin_id->OldValue) ?>">
<?php } ?>
<?php if ($t08_siswanonrutin->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t08_siswanonrutin_grid->RowCnt ?>_t08_siswanonrutin_nonrutin_id" class="form-group t08_siswanonrutin_nonrutin_id">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_nonrutin_id"><?php echo (strval($t08_siswanonrutin->nonrutin_id->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $t08_siswanonrutin->nonrutin_id->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t08_siswanonrutin->nonrutin_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_nonrutin_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="t08_siswanonrutin" data-field="x_nonrutin_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t08_siswanonrutin->nonrutin_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_nonrutin_id" id="x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_nonrutin_id" value="<?php echo $t08_siswanonrutin->nonrutin_id->CurrentValue ?>"<?php echo $t08_siswanonrutin->nonrutin_id->EditAttributes() ?>>
<input type="hidden" name="s_x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_nonrutin_id" id="s_x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_nonrutin_id" value="<?php echo $t08_siswanonrutin->nonrutin_id->LookupFilterQuery() ?>">
</span>
<?php } ?>
<?php if ($t08_siswanonrutin->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t08_siswanonrutin_grid->RowCnt ?>_t08_siswanonrutin_nonrutin_id" class="t08_siswanonrutin_nonrutin_id">
<span<?php echo $t08_siswanonrutin->nonrutin_id->ViewAttributes() ?>>
<?php echo $t08_siswanonrutin->nonrutin_id->ListViewValue() ?></span>
</span>
<?php if ($t08_siswanonrutin->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t08_siswanonrutin" data-field="x_nonrutin_id" name="x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_nonrutin_id" id="x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_nonrutin_id" value="<?php echo ew_HtmlEncode($t08_siswanonrutin->nonrutin_id->FormValue) ?>">
<input type="hidden" data-table="t08_siswanonrutin" data-field="x_nonrutin_id" name="o<?php echo $t08_siswanonrutin_grid->RowIndex ?>_nonrutin_id" id="o<?php echo $t08_siswanonrutin_grid->RowIndex ?>_nonrutin_id" value="<?php echo ew_HtmlEncode($t08_siswanonrutin->nonrutin_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t08_siswanonrutin" data-field="x_nonrutin_id" name="ft08_siswanonrutingrid$x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_nonrutin_id" id="ft08_siswanonrutingrid$x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_nonrutin_id" value="<?php echo ew_HtmlEncode($t08_siswanonrutin->nonrutin_id->FormValue) ?>">
<input type="hidden" data-table="t08_siswanonrutin" data-field="x_nonrutin_id" name="ft08_siswanonrutingrid$o<?php echo $t08_siswanonrutin_grid->RowIndex ?>_nonrutin_id" id="ft08_siswanonrutingrid$o<?php echo $t08_siswanonrutin_grid->RowIndex ?>_nonrutin_id" value="<?php echo ew_HtmlEncode($t08_siswanonrutin->nonrutin_id->OldValue) ?>">
<?php } ?>
<?php } ?>
<a id="<?php echo $t08_siswanonrutin_grid->PageObjName . "_row_" . $t08_siswanonrutin_grid->RowCnt ?>"></a></td>
	<?php } ?>
<?php if ($t08_siswanonrutin->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="t08_siswanonrutin" data-field="x_id" name="x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_id" id="x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t08_siswanonrutin->id->CurrentValue) ?>">
<input type="hidden" data-table="t08_siswanonrutin" data-field="x_id" name="o<?php echo $t08_siswanonrutin_grid->RowIndex ?>_id" id="o<?php echo $t08_siswanonrutin_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t08_siswanonrutin->id->OldValue) ?>">
<?php } ?>
<?php if ($t08_siswanonrutin->RowType == EW_ROWTYPE_EDIT || $t08_siswanonrutin->CurrentMode == "edit") { ?>
<input type="hidden" data-table="t08_siswanonrutin" data-field="x_id" name="x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_id" id="x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t08_siswanonrutin->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($t08_siswanonrutin->Nilai->Visible) { // Nilai ?>
		<td data-name="Nilai"<?php echo $t08_siswanonrutin->Nilai->CellAttributes() ?>>
<?php if ($t08_siswanonrutin->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t08_siswanonrutin_grid->RowCnt ?>_t08_siswanonrutin_Nilai" class="form-group t08_siswanonrutin_Nilai">
<input type="text" data-table="t08_siswanonrutin" data-field="x_Nilai" name="x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_Nilai" id="x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_Nilai" size="30" placeholder="<?php echo ew_HtmlEncode($t08_siswanonrutin->Nilai->getPlaceHolder()) ?>" value="<?php echo $t08_siswanonrutin->Nilai->EditValue ?>"<?php echo $t08_siswanonrutin->Nilai->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t08_siswanonrutin" data-field="x_Nilai" name="o<?php echo $t08_siswanonrutin_grid->RowIndex ?>_Nilai" id="o<?php echo $t08_siswanonrutin_grid->RowIndex ?>_Nilai" value="<?php echo ew_HtmlEncode($t08_siswanonrutin->Nilai->OldValue) ?>">
<?php } ?>
<?php if ($t08_siswanonrutin->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t08_siswanonrutin_grid->RowCnt ?>_t08_siswanonrutin_Nilai" class="form-group t08_siswanonrutin_Nilai">
<input type="text" data-table="t08_siswanonrutin" data-field="x_Nilai" name="x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_Nilai" id="x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_Nilai" size="30" placeholder="<?php echo ew_HtmlEncode($t08_siswanonrutin->Nilai->getPlaceHolder()) ?>" value="<?php echo $t08_siswanonrutin->Nilai->EditValue ?>"<?php echo $t08_siswanonrutin->Nilai->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t08_siswanonrutin->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t08_siswanonrutin_grid->RowCnt ?>_t08_siswanonrutin_Nilai" class="t08_siswanonrutin_Nilai">
<span<?php echo $t08_siswanonrutin->Nilai->ViewAttributes() ?>>
<?php echo $t08_siswanonrutin->Nilai->ListViewValue() ?></span>
</span>
<?php if ($t08_siswanonrutin->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t08_siswanonrutin" data-field="x_Nilai" name="x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_Nilai" id="x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_Nilai" value="<?php echo ew_HtmlEncode($t08_siswanonrutin->Nilai->FormValue) ?>">
<input type="hidden" data-table="t08_siswanonrutin" data-field="x_Nilai" name="o<?php echo $t08_siswanonrutin_grid->RowIndex ?>_Nilai" id="o<?php echo $t08_siswanonrutin_grid->RowIndex ?>_Nilai" value="<?php echo ew_HtmlEncode($t08_siswanonrutin->Nilai->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t08_siswanonrutin" data-field="x_Nilai" name="ft08_siswanonrutingrid$x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_Nilai" id="ft08_siswanonrutingrid$x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_Nilai" value="<?php echo ew_HtmlEncode($t08_siswanonrutin->Nilai->FormValue) ?>">
<input type="hidden" data-table="t08_siswanonrutin" data-field="x_Nilai" name="ft08_siswanonrutingrid$o<?php echo $t08_siswanonrutin_grid->RowIndex ?>_Nilai" id="ft08_siswanonrutingrid$o<?php echo $t08_siswanonrutin_grid->RowIndex ?>_Nilai" value="<?php echo ew_HtmlEncode($t08_siswanonrutin->Nilai->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t08_siswanonrutin->Terbayar->Visible) { // Terbayar ?>
		<td data-name="Terbayar"<?php echo $t08_siswanonrutin->Terbayar->CellAttributes() ?>>
<?php if ($t08_siswanonrutin->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t08_siswanonrutin_grid->RowCnt ?>_t08_siswanonrutin_Terbayar" class="form-group t08_siswanonrutin_Terbayar">
<input type="text" data-table="t08_siswanonrutin" data-field="x_Terbayar" name="x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_Terbayar" id="x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_Terbayar" size="30" placeholder="<?php echo ew_HtmlEncode($t08_siswanonrutin->Terbayar->getPlaceHolder()) ?>" value="<?php echo $t08_siswanonrutin->Terbayar->EditValue ?>"<?php echo $t08_siswanonrutin->Terbayar->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t08_siswanonrutin" data-field="x_Terbayar" name="o<?php echo $t08_siswanonrutin_grid->RowIndex ?>_Terbayar" id="o<?php echo $t08_siswanonrutin_grid->RowIndex ?>_Terbayar" value="<?php echo ew_HtmlEncode($t08_siswanonrutin->Terbayar->OldValue) ?>">
<?php } ?>
<?php if ($t08_siswanonrutin->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t08_siswanonrutin_grid->RowCnt ?>_t08_siswanonrutin_Terbayar" class="form-group t08_siswanonrutin_Terbayar">
<input type="text" data-table="t08_siswanonrutin" data-field="x_Terbayar" name="x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_Terbayar" id="x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_Terbayar" size="30" placeholder="<?php echo ew_HtmlEncode($t08_siswanonrutin->Terbayar->getPlaceHolder()) ?>" value="<?php echo $t08_siswanonrutin->Terbayar->EditValue ?>"<?php echo $t08_siswanonrutin->Terbayar->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t08_siswanonrutin->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t08_siswanonrutin_grid->RowCnt ?>_t08_siswanonrutin_Terbayar" class="t08_siswanonrutin_Terbayar">
<span<?php echo $t08_siswanonrutin->Terbayar->ViewAttributes() ?>>
<?php echo $t08_siswanonrutin->Terbayar->ListViewValue() ?></span>
</span>
<?php if ($t08_siswanonrutin->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t08_siswanonrutin" data-field="x_Terbayar" name="x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_Terbayar" id="x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_Terbayar" value="<?php echo ew_HtmlEncode($t08_siswanonrutin->Terbayar->FormValue) ?>">
<input type="hidden" data-table="t08_siswanonrutin" data-field="x_Terbayar" name="o<?php echo $t08_siswanonrutin_grid->RowIndex ?>_Terbayar" id="o<?php echo $t08_siswanonrutin_grid->RowIndex ?>_Terbayar" value="<?php echo ew_HtmlEncode($t08_siswanonrutin->Terbayar->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t08_siswanonrutin" data-field="x_Terbayar" name="ft08_siswanonrutingrid$x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_Terbayar" id="ft08_siswanonrutingrid$x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_Terbayar" value="<?php echo ew_HtmlEncode($t08_siswanonrutin->Terbayar->FormValue) ?>">
<input type="hidden" data-table="t08_siswanonrutin" data-field="x_Terbayar" name="ft08_siswanonrutingrid$o<?php echo $t08_siswanonrutin_grid->RowIndex ?>_Terbayar" id="ft08_siswanonrutingrid$o<?php echo $t08_siswanonrutin_grid->RowIndex ?>_Terbayar" value="<?php echo ew_HtmlEncode($t08_siswanonrutin->Terbayar->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t08_siswanonrutin->Sisa->Visible) { // Sisa ?>
		<td data-name="Sisa"<?php echo $t08_siswanonrutin->Sisa->CellAttributes() ?>>
<?php if ($t08_siswanonrutin->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t08_siswanonrutin_grid->RowCnt ?>_t08_siswanonrutin_Sisa" class="form-group t08_siswanonrutin_Sisa">
<input type="text" data-table="t08_siswanonrutin" data-field="x_Sisa" name="x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_Sisa" id="x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_Sisa" size="30" placeholder="<?php echo ew_HtmlEncode($t08_siswanonrutin->Sisa->getPlaceHolder()) ?>" value="<?php echo $t08_siswanonrutin->Sisa->EditValue ?>"<?php echo $t08_siswanonrutin->Sisa->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t08_siswanonrutin" data-field="x_Sisa" name="o<?php echo $t08_siswanonrutin_grid->RowIndex ?>_Sisa" id="o<?php echo $t08_siswanonrutin_grid->RowIndex ?>_Sisa" value="<?php echo ew_HtmlEncode($t08_siswanonrutin->Sisa->OldValue) ?>">
<?php } ?>
<?php if ($t08_siswanonrutin->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t08_siswanonrutin_grid->RowCnt ?>_t08_siswanonrutin_Sisa" class="form-group t08_siswanonrutin_Sisa">
<input type="text" data-table="t08_siswanonrutin" data-field="x_Sisa" name="x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_Sisa" id="x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_Sisa" size="30" placeholder="<?php echo ew_HtmlEncode($t08_siswanonrutin->Sisa->getPlaceHolder()) ?>" value="<?php echo $t08_siswanonrutin->Sisa->EditValue ?>"<?php echo $t08_siswanonrutin->Sisa->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t08_siswanonrutin->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t08_siswanonrutin_grid->RowCnt ?>_t08_siswanonrutin_Sisa" class="t08_siswanonrutin_Sisa">
<span<?php echo $t08_siswanonrutin->Sisa->ViewAttributes() ?>>
<?php echo $t08_siswanonrutin->Sisa->ListViewValue() ?></span>
</span>
<?php if ($t08_siswanonrutin->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t08_siswanonrutin" data-field="x_Sisa" name="x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_Sisa" id="x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_Sisa" value="<?php echo ew_HtmlEncode($t08_siswanonrutin->Sisa->FormValue) ?>">
<input type="hidden" data-table="t08_siswanonrutin" data-field="x_Sisa" name="o<?php echo $t08_siswanonrutin_grid->RowIndex ?>_Sisa" id="o<?php echo $t08_siswanonrutin_grid->RowIndex ?>_Sisa" value="<?php echo ew_HtmlEncode($t08_siswanonrutin->Sisa->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t08_siswanonrutin" data-field="x_Sisa" name="ft08_siswanonrutingrid$x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_Sisa" id="ft08_siswanonrutingrid$x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_Sisa" value="<?php echo ew_HtmlEncode($t08_siswanonrutin->Sisa->FormValue) ?>">
<input type="hidden" data-table="t08_siswanonrutin" data-field="x_Sisa" name="ft08_siswanonrutingrid$o<?php echo $t08_siswanonrutin_grid->RowIndex ?>_Sisa" id="ft08_siswanonrutingrid$o<?php echo $t08_siswanonrutin_grid->RowIndex ?>_Sisa" value="<?php echo ew_HtmlEncode($t08_siswanonrutin->Sisa->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t08_siswanonrutin_grid->ListOptions->Render("body", "right", $t08_siswanonrutin_grid->RowCnt);
?>
	</tr>
<?php if ($t08_siswanonrutin->RowType == EW_ROWTYPE_ADD || $t08_siswanonrutin->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
ft08_siswanonrutingrid.UpdateOpts(<?php echo $t08_siswanonrutin_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($t08_siswanonrutin->CurrentAction <> "gridadd" || $t08_siswanonrutin->CurrentMode == "copy")
		if (!$t08_siswanonrutin_grid->Recordset->EOF) $t08_siswanonrutin_grid->Recordset->MoveNext();
}
?>
<?php
	if ($t08_siswanonrutin->CurrentMode == "add" || $t08_siswanonrutin->CurrentMode == "copy" || $t08_siswanonrutin->CurrentMode == "edit") {
		$t08_siswanonrutin_grid->RowIndex = '$rowindex$';
		$t08_siswanonrutin_grid->LoadDefaultValues();

		// Set row properties
		$t08_siswanonrutin->ResetAttrs();
		$t08_siswanonrutin->RowAttrs = array_merge($t08_siswanonrutin->RowAttrs, array('data-rowindex'=>$t08_siswanonrutin_grid->RowIndex, 'id'=>'r0_t08_siswanonrutin', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($t08_siswanonrutin->RowAttrs["class"], "ewTemplate");
		$t08_siswanonrutin->RowType = EW_ROWTYPE_ADD;

		// Render row
		$t08_siswanonrutin_grid->RenderRow();

		// Render list options
		$t08_siswanonrutin_grid->RenderListOptions();
		$t08_siswanonrutin_grid->StartRowCnt = 0;
?>
	<tr<?php echo $t08_siswanonrutin->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t08_siswanonrutin_grid->ListOptions->Render("body", "left", $t08_siswanonrutin_grid->RowIndex);
?>
	<?php if ($t08_siswanonrutin->nonrutin_id->Visible) { // nonrutin_id ?>
		<td data-name="nonrutin_id">
<?php if ($t08_siswanonrutin->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t08_siswanonrutin_nonrutin_id" class="form-group t08_siswanonrutin_nonrutin_id">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_nonrutin_id"><?php echo (strval($t08_siswanonrutin->nonrutin_id->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $t08_siswanonrutin->nonrutin_id->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t08_siswanonrutin->nonrutin_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_nonrutin_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="t08_siswanonrutin" data-field="x_nonrutin_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t08_siswanonrutin->nonrutin_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_nonrutin_id" id="x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_nonrutin_id" value="<?php echo $t08_siswanonrutin->nonrutin_id->CurrentValue ?>"<?php echo $t08_siswanonrutin->nonrutin_id->EditAttributes() ?>>
<input type="hidden" name="s_x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_nonrutin_id" id="s_x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_nonrutin_id" value="<?php echo $t08_siswanonrutin->nonrutin_id->LookupFilterQuery() ?>">
</span>
<?php } else { ?>
<span id="el$rowindex$_t08_siswanonrutin_nonrutin_id" class="form-group t08_siswanonrutin_nonrutin_id">
<span<?php echo $t08_siswanonrutin->nonrutin_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t08_siswanonrutin->nonrutin_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t08_siswanonrutin" data-field="x_nonrutin_id" name="x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_nonrutin_id" id="x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_nonrutin_id" value="<?php echo ew_HtmlEncode($t08_siswanonrutin->nonrutin_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t08_siswanonrutin" data-field="x_nonrutin_id" name="o<?php echo $t08_siswanonrutin_grid->RowIndex ?>_nonrutin_id" id="o<?php echo $t08_siswanonrutin_grid->RowIndex ?>_nonrutin_id" value="<?php echo ew_HtmlEncode($t08_siswanonrutin->nonrutin_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t08_siswanonrutin->Nilai->Visible) { // Nilai ?>
		<td data-name="Nilai">
<?php if ($t08_siswanonrutin->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t08_siswanonrutin_Nilai" class="form-group t08_siswanonrutin_Nilai">
<input type="text" data-table="t08_siswanonrutin" data-field="x_Nilai" name="x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_Nilai" id="x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_Nilai" size="30" placeholder="<?php echo ew_HtmlEncode($t08_siswanonrutin->Nilai->getPlaceHolder()) ?>" value="<?php echo $t08_siswanonrutin->Nilai->EditValue ?>"<?php echo $t08_siswanonrutin->Nilai->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t08_siswanonrutin_Nilai" class="form-group t08_siswanonrutin_Nilai">
<span<?php echo $t08_siswanonrutin->Nilai->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t08_siswanonrutin->Nilai->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t08_siswanonrutin" data-field="x_Nilai" name="x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_Nilai" id="x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_Nilai" value="<?php echo ew_HtmlEncode($t08_siswanonrutin->Nilai->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t08_siswanonrutin" data-field="x_Nilai" name="o<?php echo $t08_siswanonrutin_grid->RowIndex ?>_Nilai" id="o<?php echo $t08_siswanonrutin_grid->RowIndex ?>_Nilai" value="<?php echo ew_HtmlEncode($t08_siswanonrutin->Nilai->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t08_siswanonrutin->Terbayar->Visible) { // Terbayar ?>
		<td data-name="Terbayar">
<?php if ($t08_siswanonrutin->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t08_siswanonrutin_Terbayar" class="form-group t08_siswanonrutin_Terbayar">
<input type="text" data-table="t08_siswanonrutin" data-field="x_Terbayar" name="x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_Terbayar" id="x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_Terbayar" size="30" placeholder="<?php echo ew_HtmlEncode($t08_siswanonrutin->Terbayar->getPlaceHolder()) ?>" value="<?php echo $t08_siswanonrutin->Terbayar->EditValue ?>"<?php echo $t08_siswanonrutin->Terbayar->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t08_siswanonrutin_Terbayar" class="form-group t08_siswanonrutin_Terbayar">
<span<?php echo $t08_siswanonrutin->Terbayar->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t08_siswanonrutin->Terbayar->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t08_siswanonrutin" data-field="x_Terbayar" name="x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_Terbayar" id="x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_Terbayar" value="<?php echo ew_HtmlEncode($t08_siswanonrutin->Terbayar->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t08_siswanonrutin" data-field="x_Terbayar" name="o<?php echo $t08_siswanonrutin_grid->RowIndex ?>_Terbayar" id="o<?php echo $t08_siswanonrutin_grid->RowIndex ?>_Terbayar" value="<?php echo ew_HtmlEncode($t08_siswanonrutin->Terbayar->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t08_siswanonrutin->Sisa->Visible) { // Sisa ?>
		<td data-name="Sisa">
<?php if ($t08_siswanonrutin->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t08_siswanonrutin_Sisa" class="form-group t08_siswanonrutin_Sisa">
<input type="text" data-table="t08_siswanonrutin" data-field="x_Sisa" name="x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_Sisa" id="x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_Sisa" size="30" placeholder="<?php echo ew_HtmlEncode($t08_siswanonrutin->Sisa->getPlaceHolder()) ?>" value="<?php echo $t08_siswanonrutin->Sisa->EditValue ?>"<?php echo $t08_siswanonrutin->Sisa->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t08_siswanonrutin_Sisa" class="form-group t08_siswanonrutin_Sisa">
<span<?php echo $t08_siswanonrutin->Sisa->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t08_siswanonrutin->Sisa->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t08_siswanonrutin" data-field="x_Sisa" name="x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_Sisa" id="x<?php echo $t08_siswanonrutin_grid->RowIndex ?>_Sisa" value="<?php echo ew_HtmlEncode($t08_siswanonrutin->Sisa->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t08_siswanonrutin" data-field="x_Sisa" name="o<?php echo $t08_siswanonrutin_grid->RowIndex ?>_Sisa" id="o<?php echo $t08_siswanonrutin_grid->RowIndex ?>_Sisa" value="<?php echo ew_HtmlEncode($t08_siswanonrutin->Sisa->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t08_siswanonrutin_grid->ListOptions->Render("body", "right", $t08_siswanonrutin_grid->RowCnt);
?>
<script type="text/javascript">
ft08_siswanonrutingrid.UpdateOpts(<?php echo $t08_siswanonrutin_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($t08_siswanonrutin->CurrentMode == "add" || $t08_siswanonrutin->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $t08_siswanonrutin_grid->FormKeyCountName ?>" id="<?php echo $t08_siswanonrutin_grid->FormKeyCountName ?>" value="<?php echo $t08_siswanonrutin_grid->KeyCount ?>">
<?php echo $t08_siswanonrutin_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t08_siswanonrutin->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $t08_siswanonrutin_grid->FormKeyCountName ?>" id="<?php echo $t08_siswanonrutin_grid->FormKeyCountName ?>" value="<?php echo $t08_siswanonrutin_grid->KeyCount ?>">
<?php echo $t08_siswanonrutin_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t08_siswanonrutin->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ft08_siswanonrutingrid">
</div>
<?php

// Close recordset
if ($t08_siswanonrutin_grid->Recordset)
	$t08_siswanonrutin_grid->Recordset->Close();
?>
</div>
</div>
<?php } ?>
<?php if ($t08_siswanonrutin_grid->TotalRecs == 0 && $t08_siswanonrutin->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t08_siswanonrutin_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($t08_siswanonrutin->Export == "") { ?>
<script type="text/javascript">
ft08_siswanonrutingrid.Init();
</script>
<?php } ?>
<?php
$t08_siswanonrutin_grid->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
$t08_siswanonrutin_grid->Page_Terminate();
?>
