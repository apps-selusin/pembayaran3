<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg13.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql13.php") ?>
<?php include_once "phpfn13.php" ?>
<?php include_once "t03_siswainfo.php" ?>
<?php include_once "t96_employeesinfo.php" ?>
<?php include_once "t05_siswarutingridcls.php" ?>
<?php include_once "t06_siswarutinbayargridcls.php" ?>
<?php include_once "t08_siswanonrutingridcls.php" ?>
<?php include_once "userfn13.php" ?>
<?php

//
// Page class
//

$t03_siswa_edit = NULL; // Initialize page object first

class ct03_siswa_edit extends ct03_siswa {

	// Page ID
	var $PageID = 'edit';

	// Project ID
	var $ProjectID = "{9A296957-6EE4-4785-AB71-310FFD71D6FE}";

	// Table name
	var $TableName = 't03_siswa';

	// Page object name
	var $PageObjName = 't03_siswa_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		if ($this->UseTokenInUrl) $PageUrl .= "t=" . $this->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_MESSAGE], $v);
	}

	function getFailureMessage() {
		return @$_SESSION[EW_SESSION_FAILURE_MESSAGE];
	}

	function setFailureMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_FAILURE_MESSAGE], $v);
	}

	function getSuccessMessage() {
		return @$_SESSION[EW_SESSION_SUCCESS_MESSAGE];
	}

	function setSuccessMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_SUCCESS_MESSAGE], $v);
	}

	function getWarningMessage() {
		return @$_SESSION[EW_SESSION_WARNING_MESSAGE];
	}

	function setWarningMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_WARNING_MESSAGE], $v);
	}

	// Methods to clear message
	function ClearMessage() {
		$_SESSION[EW_SESSION_MESSAGE] = "";
	}

	function ClearFailureMessage() {
		$_SESSION[EW_SESSION_FAILURE_MESSAGE] = "";
	}

	function ClearSuccessMessage() {
		$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = "";
	}

	function ClearWarningMessage() {
		$_SESSION[EW_SESSION_WARNING_MESSAGE] = "";
	}

	function ClearMessages() {
		$_SESSION[EW_SESSION_MESSAGE] = "";
		$_SESSION[EW_SESSION_FAILURE_MESSAGE] = "";
		$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = "";
		$_SESSION[EW_SESSION_WARNING_MESSAGE] = "";
	}

	// Show message
	function ShowMessage() {
		$hidden = FALSE;
		$html = "";

		// Message
		$sMessage = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sMessage, "");
		if ($sMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sMessage;
			$html .= "<div class=\"alert alert-info ewInfo\">" . $sMessage . "</div>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$sWarningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sWarningMessage, "warning");
		if ($sWarningMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sWarningMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sWarningMessage;
			$html .= "<div class=\"alert alert-warning ewWarning\">" . $sWarningMessage . "</div>";
			$_SESSION[EW_SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$sSuccessMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sSuccessMessage, "success");
		if ($sSuccessMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sSuccessMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sSuccessMessage;
			$html .= "<div class=\"alert alert-success ewSuccess\">" . $sSuccessMessage . "</div>";
			$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$sErrorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sErrorMessage, "failure");
		if ($sErrorMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sErrorMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sErrorMessage;
			$html .= "<div class=\"alert alert-danger ewError\">" . $sErrorMessage . "</div>";
			$_SESSION[EW_SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo "<div class=\"ewMessageDialog\"" . (($hidden) ? " style=\"display: none;\"" : "") . ">" . $html . "</div>";
	}
	var $PageHeader;
	var $PageFooter;

	// Show Page Header
	function ShowPageHeader() {
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		if ($sHeader <> "") { // Header exists, display
			echo "<p>" . $sHeader . "</p>";
		}
	}

	// Show Page Footer
	function ShowPageFooter() {
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		if ($sFooter <> "") { // Footer exists, display
			echo "<p>" . $sFooter . "</p>";
		}
	}

	// Validate page request
	function IsPageRequest() {
		global $objForm;
		if ($this->UseTokenInUrl) {
			if ($objForm)
				return ($this->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($this->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}
	var $Token = "";
	var $TokenTimeout = 0;
	var $CheckToken = EW_CHECK_TOKEN;
	var $CheckTokenFn = "ew_CheckToken";
	var $CreateTokenFn = "ew_CreateToken";

	// Valid Post
	function ValidPost() {
		if (!$this->CheckToken || !ew_IsHttpPost())
			return TRUE;
		if (!isset($_POST[EW_TOKEN_NAME]))
			return FALSE;
		$fn = $this->CheckTokenFn;
		if (is_callable($fn))
			return $fn($_POST[EW_TOKEN_NAME], $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	function CreateToken() {
		global $gsToken;
		if ($this->CheckToken) {
			$fn = $this->CreateTokenFn;
			if ($this->Token == "" && is_callable($fn)) // Create token
				$this->Token = $fn();
			$gsToken = $this->Token; // Save to global variable
		}
	}

	//
	// Page class constructor
	//
	function __construct() {
		global $conn, $Language;
		global $UserTable, $UserTableConn;
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = ew_SessionTimeoutTime();

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Parent constuctor
		parent::__construct();

		// Table object (t03_siswa)
		if (!isset($GLOBALS["t03_siswa"]) || get_class($GLOBALS["t03_siswa"]) == "ct03_siswa") {
			$GLOBALS["t03_siswa"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t03_siswa"];
		}

		// Table object (t96_employees)
		if (!isset($GLOBALS['t96_employees'])) $GLOBALS['t96_employees'] = new ct96_employees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 't03_siswa', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect($this->DBID);

		// User table object (t96_employees)
		if (!isset($UserTable)) {
			$UserTable = new ct96_employees();
			$UserTableConn = Conn($UserTable->DBID);
		}
	}

	//
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsCustomExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if ($Security->IsLoggedIn()) $Security->TablePermission_Loading();
		$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName);
		if ($Security->IsLoggedIn()) $Security->TablePermission_Loaded();
		if (!$Security->CanEdit()) {
			$Security->SaveLastUrl();
			$this->setFailureMessage(ew_DeniedMsg()); // Set no permission
			if ($Security->CanList())
				$this->Page_Terminate(ew_GetUrl("t03_siswalist.php"));
			else
				$this->Page_Terminate(ew_GetUrl("login.php"));
		}
		if ($Security->IsLoggedIn()) {
			$Security->UserID_Loading();
			$Security->LoadUserID();
			$Security->UserID_Loaded();
		}

		// Create form object
		$objForm = new cFormObj();
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action
		$this->kelas_id->SetVisibility();
		$this->Nomor_Induk->SetVisibility();
		$this->Nama->SetVisibility();

		// Set up detail page object
		$this->SetupDetailPages();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->ValidPost()) {
			echo $Language->Phrase("InvalidPostRequest");
			$this->Page_Terminate();
			exit();
		}

		// Process auto fill
		if (@$_POST["ajax"] == "autofill") {

			// Process auto fill for detail table 't05_siswarutin'
			if (@$_POST["grid"] == "ft05_siswarutingrid") {
				if (!isset($GLOBALS["t05_siswarutin_grid"])) $GLOBALS["t05_siswarutin_grid"] = new ct05_siswarutin_grid;
				$GLOBALS["t05_siswarutin_grid"]->Page_Init();
				$this->Page_Terminate();
				exit();
			}

			// Process auto fill for detail table 't06_siswarutinbayar'
			if (@$_POST["grid"] == "ft06_siswarutinbayargrid") {
				if (!isset($GLOBALS["t06_siswarutinbayar_grid"])) $GLOBALS["t06_siswarutinbayar_grid"] = new ct06_siswarutinbayar_grid;
				$GLOBALS["t06_siswarutinbayar_grid"]->Page_Init();
				$this->Page_Terminate();
				exit();
			}

			// Process auto fill for detail table 't08_siswanonrutin'
			if (@$_POST["grid"] == "ft08_siswanonrutingrid") {
				if (!isset($GLOBALS["t08_siswanonrutin_grid"])) $GLOBALS["t08_siswanonrutin_grid"] = new ct08_siswanonrutin_grid;
				$GLOBALS["t08_siswanonrutin_grid"]->Page_Init();
				$this->Page_Terminate();
				exit();
			}
			$results = $this->GetAutoFill(@$_POST["name"], @$_POST["q"]);
			if ($results) {

				// Clean output buffer
				if (!EW_DEBUG_ENABLED && ob_get_length())
					ob_end_clean();
				echo $results;
				$this->Page_Terminate();
				exit();
			}
		}

		// Create Token
		$this->CreateToken();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $gsExportFile, $gTmpImages;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $EW_EXPORT, $t03_siswa;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($t03_siswa);
				$doc->Text = $sContent;
				if ($this->Export == "email")
					echo $this->ExportEmail($doc->Text);
				else
					$doc->Export();
				ew_DeleteTmpImages(); // Delete temp images
				exit();
			}
		}
		$this->Page_Redirecting($url);

		 // Close connection
		ew_CloseConn();

		// Go to URL if specified
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();

			// Handle modal response
			if ($this->IsModal) {
				$row = array();
				$row["url"] = $url;
				echo ew_ArrayToJson(array($row));
			} else {
				header("Location: " . $url);
			}
		}
		exit();
	}
	var $FormClassName = "form-horizontal ewForm ewEditForm";
	var $IsModal = FALSE;
	var $DbMasterFilter;
	var $DbDetailFilter;
	var $DisplayRecs = 1;
	var $StartRec;
	var $StopRec;
	var $TotalRecs = 0;
	var $RecRange = 10;
	var $Pager;
	var $RecCnt;
	var $RecKey = array();
	var $Recordset;
	var $DetailPages; // Detail pages object

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError;
		global $gbSkipHeaderFooter;

		// Check modal
		$this->IsModal = (@$_GET["modal"] == "1" || @$_POST["modal"] == "1");
		if ($this->IsModal)
			$gbSkipHeaderFooter = TRUE;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;

		// Load key from QueryString
		if (@$_GET["id"] <> "") {
			$this->id->setQueryStringValue($_GET["id"]);
			$this->RecKey["id"] = $this->id->QueryStringValue;
		} else {
			$bLoadCurrentRecord = TRUE;
		}

		// Load recordset
		$this->StartRec = 1; // Initialize start position
		if ($this->Recordset = $this->LoadRecordset()) // Load records
			$this->TotalRecs = $this->Recordset->RecordCount(); // Get record count
		if ($this->TotalRecs <= 0) { // No record found
			if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
				$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
			$this->Page_Terminate("t03_siswalist.php"); // Return to list page
		} elseif ($bLoadCurrentRecord) { // Load current record position
			$this->SetUpStartRec(); // Set up start record position

			// Point to current record
			if (intval($this->StartRec) <= intval($this->TotalRecs)) {
				$bMatchRecord = TRUE;
				$this->Recordset->Move($this->StartRec-1);
			}
		} else { // Match key values
			while (!$this->Recordset->EOF) {
				if (strval($this->id->CurrentValue) == strval($this->Recordset->fields('id'))) {
					$this->setStartRecordNumber($this->StartRec); // Save record position
					$bMatchRecord = TRUE;
					break;
				} else {
					$this->StartRec++;
					$this->Recordset->MoveNext();
				}
			}
		}

		// Process form if post back
		if (@$_POST["a_edit"] <> "") {
			$this->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Set up detail parameters
			$this->SetUpDetailParms();
		} else {
			$this->CurrentAction = "I"; // Default action is display
		}

		// Validate form if post back
		if (@$_POST["a_edit"] <> "") {
			if (!$this->ValidateForm()) {
				$this->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$this->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		}
		switch ($this->CurrentAction) {
			case "I": // Get a record to display
				if (!$bMatchRecord) {
					if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
						$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
					$this->Page_Terminate("t03_siswalist.php"); // Return to list page
				} else {
					$this->LoadRowValues($this->Recordset); // Load row values
				}

				// Set up detail parameters
				$this->SetUpDetailParms();
				break;
			Case "U": // Update
				if ($this->getCurrentDetailTable() <> "") // Master/detail edit
					$sReturnUrl = $this->GetViewUrl(EW_TABLE_SHOW_DETAIL . "=" . $this->getCurrentDetailTable()); // Master/Detail view page
				else
					$sReturnUrl = $this->getReturnUrl();
				if (ew_GetPageName($sReturnUrl) == "t03_siswalist.php")
					$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to list page with correct master key if necessary
				$this->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} elseif ($this->getFailureMessage() == $Language->Phrase("NoRecord")) {
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed

					// Set up detail parameters
					$this->SetUpDetailParms();
				}
		}

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Render the record
		$this->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$this->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$this->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $this->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$this->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $Language;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->kelas_id->FldIsDetailKey) {
			$this->kelas_id->setFormValue($objForm->GetValue("x_kelas_id"));
		}
		if (!$this->Nomor_Induk->FldIsDetailKey) {
			$this->Nomor_Induk->setFormValue($objForm->GetValue("x_Nomor_Induk"));
		}
		if (!$this->Nama->FldIsDetailKey) {
			$this->Nama->setFormValue($objForm->GetValue("x_Nama"));
		}
		if (!$this->id->FldIsDetailKey)
			$this->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->LoadRow();
		$this->id->CurrentValue = $this->id->FormValue;
		$this->kelas_id->CurrentValue = $this->kelas_id->FormValue;
		$this->Nomor_Induk->CurrentValue = $this->Nomor_Induk->FormValue;
		$this->Nama->CurrentValue = $this->Nama->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {

		// Load List page SQL
		$sSql = $this->SelectSQL();
		$conn = &$this->Connection();

		// Load recordset
		$dbtype = ew_GetConnectionType($this->DBID);
		if ($this->UseSelectLimit) {
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			if ($dbtype == "MSSQL") {
				$rs = $conn->SelectLimit($sSql, $rowcnt, $offset, array("_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderBy())));
			} else {
				$rs = $conn->SelectLimit($sSql, $rowcnt, $offset);
			}
			$conn->raiseErrorFn = '';
		} else {
			$rs = ew_LoadRecordset($sSql, $conn);
		}

		// Call Recordset Selected event
		$this->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $Security, $Language;
		$sFilter = $this->KeyFilter();

		// Call Row Selecting event
		$this->Row_Selecting($sFilter);

		// Load SQL based on filter
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		$conn = &$this->Connection();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row = &$rs->fields;
		$this->Row_Selected($row);
		$this->id->setDbValue($rs->fields('id'));
		$this->kelas_id->setDbValue($rs->fields('kelas_id'));
		$this->Nomor_Induk->setDbValue($rs->fields('Nomor_Induk'));
		$this->Nama->setDbValue($rs->fields('Nama'));
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->kelas_id->DbValue = $row['kelas_id'];
		$this->Nomor_Induk->DbValue = $row['Nomor_Induk'];
		$this->Nama->DbValue = $row['Nama'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// id
		// kelas_id
		// Nomor_Induk
		// Nama

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// kelas_id
		if (strval($this->kelas_id->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->kelas_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `Nama` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t02_kelas`";
		$sWhereWrk = "";
		$this->kelas_id->LookupFilters = array("dx1" => '`Nama`');
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->kelas_id, $sWhereWrk); // Call Lookup selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->kelas_id->ViewValue = $this->kelas_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->kelas_id->ViewValue = $this->kelas_id->CurrentValue;
			}
		} else {
			$this->kelas_id->ViewValue = NULL;
		}
		$this->kelas_id->ViewCustomAttributes = "";

		// Nomor_Induk
		$this->Nomor_Induk->ViewValue = $this->Nomor_Induk->CurrentValue;
		$this->Nomor_Induk->ViewCustomAttributes = "";

		// Nama
		$this->Nama->ViewValue = $this->Nama->CurrentValue;
		$this->Nama->ViewCustomAttributes = "";

			// kelas_id
			$this->kelas_id->LinkCustomAttributes = "";
			$this->kelas_id->HrefValue = "";
			$this->kelas_id->TooltipValue = "";

			// Nomor_Induk
			$this->Nomor_Induk->LinkCustomAttributes = "";
			$this->Nomor_Induk->HrefValue = "";
			$this->Nomor_Induk->TooltipValue = "";

			// Nama
			$this->Nama->LinkCustomAttributes = "";
			$this->Nama->HrefValue = "";
			$this->Nama->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// kelas_id
			$this->kelas_id->EditCustomAttributes = "";
			if (trim(strval($this->kelas_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->kelas_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `id`, `Nama` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `t02_kelas`";
			$sWhereWrk = "";
			$this->kelas_id->LookupFilters = array("dx1" => '`Nama`');
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->kelas_id, $sWhereWrk); // Call Lookup selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
				$this->kelas_id->ViewValue = $this->kelas_id->DisplayValue($arwrk);
			} else {
				$this->kelas_id->ViewValue = $Language->Phrase("PleaseSelect");
			}
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->kelas_id->EditValue = $arwrk;

			// Nomor_Induk
			$this->Nomor_Induk->EditAttrs["class"] = "form-control";
			$this->Nomor_Induk->EditCustomAttributes = "";
			$this->Nomor_Induk->EditValue = ew_HtmlEncode($this->Nomor_Induk->CurrentValue);
			$this->Nomor_Induk->PlaceHolder = ew_RemoveHtml($this->Nomor_Induk->FldCaption());

			// Nama
			$this->Nama->EditAttrs["class"] = "form-control";
			$this->Nama->EditCustomAttributes = "";
			$this->Nama->EditValue = ew_HtmlEncode($this->Nama->CurrentValue);
			$this->Nama->PlaceHolder = ew_RemoveHtml($this->Nama->FldCaption());

			// Edit refer script
			// kelas_id

			$this->kelas_id->LinkCustomAttributes = "";
			$this->kelas_id->HrefValue = "";

			// Nomor_Induk
			$this->Nomor_Induk->LinkCustomAttributes = "";
			$this->Nomor_Induk->HrefValue = "";

			// Nama
			$this->Nama->LinkCustomAttributes = "";
			$this->Nama->HrefValue = "";
		}
		if ($this->RowType == EW_ROWTYPE_ADD ||
			$this->RowType == EW_ROWTYPE_EDIT ||
			$this->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$this->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!$this->kelas_id->FldIsDetailKey && !is_null($this->kelas_id->FormValue) && $this->kelas_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->kelas_id->FldCaption(), $this->kelas_id->ReqErrMsg));
		}
		if (!$this->Nomor_Induk->FldIsDetailKey && !is_null($this->Nomor_Induk->FormValue) && $this->Nomor_Induk->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Nomor_Induk->FldCaption(), $this->Nomor_Induk->ReqErrMsg));
		}
		if (!$this->Nama->FldIsDetailKey && !is_null($this->Nama->FormValue) && $this->Nama->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Nama->FldCaption(), $this->Nama->ReqErrMsg));
		}

		// Validate detail grid
		$DetailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("t05_siswarutin", $DetailTblVar) && $GLOBALS["t05_siswarutin"]->DetailEdit) {
			if (!isset($GLOBALS["t05_siswarutin_grid"])) $GLOBALS["t05_siswarutin_grid"] = new ct05_siswarutin_grid(); // get detail page object
			$GLOBALS["t05_siswarutin_grid"]->ValidateGridForm();
		}
		if (in_array("t06_siswarutinbayar", $DetailTblVar) && $GLOBALS["t06_siswarutinbayar"]->DetailEdit) {
			if (!isset($GLOBALS["t06_siswarutinbayar_grid"])) $GLOBALS["t06_siswarutinbayar_grid"] = new ct06_siswarutinbayar_grid(); // get detail page object
			$GLOBALS["t06_siswarutinbayar_grid"]->ValidateGridForm();
		}
		if (in_array("t08_siswanonrutin", $DetailTblVar) && $GLOBALS["t08_siswanonrutin"]->DetailEdit) {
			if (!isset($GLOBALS["t08_siswanonrutin_grid"])) $GLOBALS["t08_siswanonrutin_grid"] = new ct08_siswanonrutin_grid(); // get detail page object
			$GLOBALS["t08_siswanonrutin_grid"]->ValidateGridForm();
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			ew_AddMessage($gsFormError, $sFormCustomError);
		}
		return $ValidateForm;
	}

	// Update record based on key values
	function EditRow() {
		global $Security, $Language;
		$sFilter = $this->KeyFilter();
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$conn = &$this->Connection();
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
			$EditRow = FALSE; // Update Failed
		} else {

			// Begin transaction
			if ($this->getCurrentDetailTable() <> "")
				$conn->BeginTrans();

			// Save old values
			$rsold = &$rs->fields;
			$this->LoadDbValues($rsold);
			$rsnew = array();

			// kelas_id
			$this->kelas_id->SetDbValueDef($rsnew, $this->kelas_id->CurrentValue, 0, $this->kelas_id->ReadOnly);

			// Nomor_Induk
			$this->Nomor_Induk->SetDbValueDef($rsnew, $this->Nomor_Induk->CurrentValue, "", $this->Nomor_Induk->ReadOnly);

			// Nama
			$this->Nama->SetDbValueDef($rsnew, $this->Nama->CurrentValue, "", $this->Nama->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $this->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
				if (count($rsnew) > 0)
					$EditRow = $this->Update($rsnew, "", $rsold);
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
				if ($EditRow) {
				}

				// Update detail records
				$DetailTblVar = explode(",", $this->getCurrentDetailTable());
				if ($EditRow) {
					if (in_array("t05_siswarutin", $DetailTblVar) && $GLOBALS["t05_siswarutin"]->DetailEdit) {
						if (!isset($GLOBALS["t05_siswarutin_grid"])) $GLOBALS["t05_siswarutin_grid"] = new ct05_siswarutin_grid(); // Get detail page object
						$Security->LoadCurrentUserLevel($this->ProjectID . "t05_siswarutin"); // Load user level of detail table
						$EditRow = $GLOBALS["t05_siswarutin_grid"]->GridUpdate();
						$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
					}
				}
				if ($EditRow) {
					if (in_array("t06_siswarutinbayar", $DetailTblVar) && $GLOBALS["t06_siswarutinbayar"]->DetailEdit) {
						if (!isset($GLOBALS["t06_siswarutinbayar_grid"])) $GLOBALS["t06_siswarutinbayar_grid"] = new ct06_siswarutinbayar_grid(); // Get detail page object
						$Security->LoadCurrentUserLevel($this->ProjectID . "t06_siswarutinbayar"); // Load user level of detail table
						$EditRow = $GLOBALS["t06_siswarutinbayar_grid"]->GridUpdate();
						$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
					}
				}
				if ($EditRow) {
					if (in_array("t08_siswanonrutin", $DetailTblVar) && $GLOBALS["t08_siswanonrutin"]->DetailEdit) {
						if (!isset($GLOBALS["t08_siswanonrutin_grid"])) $GLOBALS["t08_siswanonrutin_grid"] = new ct08_siswanonrutin_grid(); // Get detail page object
						$Security->LoadCurrentUserLevel($this->ProjectID . "t08_siswanonrutin"); // Load user level of detail table
						$EditRow = $GLOBALS["t08_siswanonrutin_grid"]->GridUpdate();
						$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
					}
				}

				// Commit/Rollback transaction
				if ($this->getCurrentDetailTable() <> "") {
					if ($EditRow) {
						$conn->CommitTrans(); // Commit transaction
					} else {
						$conn->RollbackTrans(); // Rollback transaction
					}
				}
			} else {
				if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

					// Use the message, do nothing
				} elseif ($this->CancelMessage <> "") {
					$this->setFailureMessage($this->CancelMessage);
					$this->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$this->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Set up detail parms based on QueryString
	function SetUpDetailParms() {

		// Get the keys for master table
		if (isset($_GET[EW_TABLE_SHOW_DETAIL])) {
			$sDetailTblVar = $_GET[EW_TABLE_SHOW_DETAIL];
			$this->setCurrentDetailTable($sDetailTblVar);
		} else {
			$sDetailTblVar = $this->getCurrentDetailTable();
		}
		if ($sDetailTblVar <> "") {
			$DetailTblVar = explode(",", $sDetailTblVar);
			if (in_array("t05_siswarutin", $DetailTblVar)) {
				if (!isset($GLOBALS["t05_siswarutin_grid"]))
					$GLOBALS["t05_siswarutin_grid"] = new ct05_siswarutin_grid;
				if ($GLOBALS["t05_siswarutin_grid"]->DetailEdit) {
					$GLOBALS["t05_siswarutin_grid"]->CurrentMode = "edit";
					$GLOBALS["t05_siswarutin_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["t05_siswarutin_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["t05_siswarutin_grid"]->setStartRecordNumber(1);
					$GLOBALS["t05_siswarutin_grid"]->siswa_id->FldIsDetailKey = TRUE;
					$GLOBALS["t05_siswarutin_grid"]->siswa_id->CurrentValue = $this->id->CurrentValue;
					$GLOBALS["t05_siswarutin_grid"]->siswa_id->setSessionValue($GLOBALS["t05_siswarutin_grid"]->siswa_id->CurrentValue);
				}
			}
			if (in_array("t06_siswarutinbayar", $DetailTblVar)) {
				if (!isset($GLOBALS["t06_siswarutinbayar_grid"]))
					$GLOBALS["t06_siswarutinbayar_grid"] = new ct06_siswarutinbayar_grid;
				if ($GLOBALS["t06_siswarutinbayar_grid"]->DetailEdit) {
					$GLOBALS["t06_siswarutinbayar_grid"]->CurrentMode = "edit";
					$GLOBALS["t06_siswarutinbayar_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["t06_siswarutinbayar_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["t06_siswarutinbayar_grid"]->setStartRecordNumber(1);
					$GLOBALS["t06_siswarutinbayar_grid"]->siswa_id->FldIsDetailKey = TRUE;
					$GLOBALS["t06_siswarutinbayar_grid"]->siswa_id->CurrentValue = $this->id->CurrentValue;
					$GLOBALS["t06_siswarutinbayar_grid"]->siswa_id->setSessionValue($GLOBALS["t06_siswarutinbayar_grid"]->siswa_id->CurrentValue);
				}
			}
			if (in_array("t08_siswanonrutin", $DetailTblVar)) {
				if (!isset($GLOBALS["t08_siswanonrutin_grid"]))
					$GLOBALS["t08_siswanonrutin_grid"] = new ct08_siswanonrutin_grid;
				if ($GLOBALS["t08_siswanonrutin_grid"]->DetailEdit) {
					$GLOBALS["t08_siswanonrutin_grid"]->CurrentMode = "edit";
					$GLOBALS["t08_siswanonrutin_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["t08_siswanonrutin_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["t08_siswanonrutin_grid"]->setStartRecordNumber(1);
					$GLOBALS["t08_siswanonrutin_grid"]->siswa_id->FldIsDetailKey = TRUE;
					$GLOBALS["t08_siswanonrutin_grid"]->siswa_id->CurrentValue = $this->id->CurrentValue;
					$GLOBALS["t08_siswanonrutin_grid"]->siswa_id->setSessionValue($GLOBALS["t08_siswanonrutin_grid"]->siswa_id->CurrentValue);
				}
			}
		}
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("t03_siswalist.php"), "", $this->TableVar, TRUE);
		$PageId = "edit";
		$Breadcrumb->Add("edit", $PageId, $url);
	}

	// Set up detail pages
	function SetupDetailPages() {
		$pages = new cSubPages();
		$pages->Style = "tabs";
		$pages->Add('t05_siswarutin');
		$pages->Add('t06_siswarutinbayar');
		$pages->Add('t08_siswanonrutin');
		$this->DetailPages = $pages;
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_kelas_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id` AS `LinkFld`, `Nama` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t02_kelas`";
			$sWhereWrk = "{filter}";
			$this->kelas_id->LookupFilters = array("dx1" => '`Nama`');
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` = {filter_value}', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->kelas_id, $sWhereWrk); // Call Lookup selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		}
	}

	// Setup AutoSuggest filters of a field
	function SetupAutoSuggestFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($t03_siswa_edit)) $t03_siswa_edit = new ct03_siswa_edit();

// Page init
$t03_siswa_edit->Page_Init();

// Page main
$t03_siswa_edit->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t03_siswa_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "edit";
var CurrentForm = ft03_siswaedit = new ew_Form("ft03_siswaedit", "edit");

// Validate form
ft03_siswaedit.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_kelas_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t03_siswa->kelas_id->FldCaption(), $t03_siswa->kelas_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Nomor_Induk");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t03_siswa->Nomor_Induk->FldCaption(), $t03_siswa->Nomor_Induk->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Nama");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t03_siswa->Nama->FldCaption(), $t03_siswa->Nama->ReqErrMsg)) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}

	// Process detail forms
	var dfs = $fobj.find("input[name='detailpage']").get();
	for (var i = 0; i < dfs.length; i++) {
		var df = dfs[i], val = df.value;
		if (val && ewForms[val])
			if (!ewForms[val].Validate())
				return false;
	}
	return true;
}

// Form_CustomValidate event
ft03_siswaedit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft03_siswaedit.ValidateRequired = true;
<?php } else { ?>
ft03_siswaedit.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
ft03_siswaedit.Lists["x_kelas_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Nama","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t02_kelas"};

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php if (!$t03_siswa_edit->IsModal) { ?>
<div class="ewToolbar">
<?php $Breadcrumb->Render(); ?>
<?php echo $Language->SelectionForm(); ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $t03_siswa_edit->ShowPageHeader(); ?>
<?php
$t03_siswa_edit->ShowMessage();
?>
<?php if (!$t03_siswa_edit->IsModal) { ?>
<form name="ewPagerForm" class="form-horizontal ewForm ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($t03_siswa_edit->Pager)) $t03_siswa_edit->Pager = new cPrevNextPager($t03_siswa_edit->StartRec, $t03_siswa_edit->DisplayRecs, $t03_siswa_edit->TotalRecs) ?>
<?php if ($t03_siswa_edit->Pager->RecordCount > 0 && $t03_siswa_edit->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($t03_siswa_edit->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $t03_siswa_edit->PageUrl() ?>start=<?php echo $t03_siswa_edit->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($t03_siswa_edit->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $t03_siswa_edit->PageUrl() ?>start=<?php echo $t03_siswa_edit->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $t03_siswa_edit->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($t03_siswa_edit->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $t03_siswa_edit->PageUrl() ?>start=<?php echo $t03_siswa_edit->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($t03_siswa_edit->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $t03_siswa_edit->PageUrl() ?>start=<?php echo $t03_siswa_edit->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $t03_siswa_edit->Pager->PageCount ?></span>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="ft03_siswaedit" id="ft03_siswaedit" class="<?php echo $t03_siswa_edit->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($t03_siswa_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $t03_siswa_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t03_siswa">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<?php if ($t03_siswa_edit->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<div>
<?php if ($t03_siswa->kelas_id->Visible) { // kelas_id ?>
	<div id="r_kelas_id" class="form-group">
		<label id="elh_t03_siswa_kelas_id" for="x_kelas_id" class="col-sm-2 control-label ewLabel"><?php echo $t03_siswa->kelas_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t03_siswa->kelas_id->CellAttributes() ?>>
<span id="el_t03_siswa_kelas_id">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_kelas_id"><?php echo (strval($t03_siswa->kelas_id->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $t03_siswa->kelas_id->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t03_siswa->kelas_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_kelas_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="t03_siswa" data-field="x_kelas_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t03_siswa->kelas_id->DisplayValueSeparatorAttribute() ?>" name="x_kelas_id" id="x_kelas_id" value="<?php echo $t03_siswa->kelas_id->CurrentValue ?>"<?php echo $t03_siswa->kelas_id->EditAttributes() ?>>
<input type="hidden" name="s_x_kelas_id" id="s_x_kelas_id" value="<?php echo $t03_siswa->kelas_id->LookupFilterQuery() ?>">
</span>
<?php echo $t03_siswa->kelas_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t03_siswa->Nomor_Induk->Visible) { // Nomor_Induk ?>
	<div id="r_Nomor_Induk" class="form-group">
		<label id="elh_t03_siswa_Nomor_Induk" for="x_Nomor_Induk" class="col-sm-2 control-label ewLabel"><?php echo $t03_siswa->Nomor_Induk->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t03_siswa->Nomor_Induk->CellAttributes() ?>>
<span id="el_t03_siswa_Nomor_Induk">
<input type="text" data-table="t03_siswa" data-field="x_Nomor_Induk" name="x_Nomor_Induk" id="x_Nomor_Induk" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($t03_siswa->Nomor_Induk->getPlaceHolder()) ?>" value="<?php echo $t03_siswa->Nomor_Induk->EditValue ?>"<?php echo $t03_siswa->Nomor_Induk->EditAttributes() ?>>
</span>
<?php echo $t03_siswa->Nomor_Induk->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t03_siswa->Nama->Visible) { // Nama ?>
	<div id="r_Nama" class="form-group">
		<label id="elh_t03_siswa_Nama" for="x_Nama" class="col-sm-2 control-label ewLabel"><?php echo $t03_siswa->Nama->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t03_siswa->Nama->CellAttributes() ?>>
<span id="el_t03_siswa_Nama">
<input type="text" data-table="t03_siswa" data-field="x_Nama" name="x_Nama" id="x_Nama" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($t03_siswa->Nama->getPlaceHolder()) ?>" value="<?php echo $t03_siswa->Nama->EditValue ?>"<?php echo $t03_siswa->Nama->EditAttributes() ?>>
</span>
<?php echo $t03_siswa->Nama->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div>
<input type="hidden" data-table="t03_siswa" data-field="x_id" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($t03_siswa->id->CurrentValue) ?>">
<?php if ($t03_siswa->getCurrentDetailTable() <> "") { ?>
<?php
	$t03_siswa_edit->DetailPages->ValidKeys = explode(",", $t03_siswa->getCurrentDetailTable());
	$FirstActiveDetailTable = $t03_siswa_edit->DetailPages->ActivePageIndex();
?>
<div class="ewDetailPages">
<div class="tabbable" id="t03_siswa_edit_details">
	<ul class="nav<?php echo $t03_siswa_edit->DetailPages->NavStyle() ?>">
<?php
	if (in_array("t05_siswarutin", explode(",", $t03_siswa->getCurrentDetailTable())) && $t05_siswarutin->DetailEdit) {
		if ($FirstActiveDetailTable == "" || $FirstActiveDetailTable == "t05_siswarutin") {
			$FirstActiveDetailTable = "t05_siswarutin";
		}
?>
		<li<?php echo $t03_siswa_edit->DetailPages->TabStyle("t05_siswarutin") ?>><a href="#tab_t05_siswarutin" data-toggle="tab"><?php echo $Language->TablePhrase("t05_siswarutin", "TblCaption") ?></a></li>
<?php
	}
?>
<?php
	if (in_array("t06_siswarutinbayar", explode(",", $t03_siswa->getCurrentDetailTable())) && $t06_siswarutinbayar->DetailEdit) {
		if ($FirstActiveDetailTable == "" || $FirstActiveDetailTable == "t06_siswarutinbayar") {
			$FirstActiveDetailTable = "t06_siswarutinbayar";
		}
?>
		<li<?php echo $t03_siswa_edit->DetailPages->TabStyle("t06_siswarutinbayar") ?>><a href="#tab_t06_siswarutinbayar" data-toggle="tab"><?php echo $Language->TablePhrase("t06_siswarutinbayar", "TblCaption") ?></a></li>
<?php
	}
?>
<?php
	if (in_array("t08_siswanonrutin", explode(",", $t03_siswa->getCurrentDetailTable())) && $t08_siswanonrutin->DetailEdit) {
		if ($FirstActiveDetailTable == "" || $FirstActiveDetailTable == "t08_siswanonrutin") {
			$FirstActiveDetailTable = "t08_siswanonrutin";
		}
?>
		<li<?php echo $t03_siswa_edit->DetailPages->TabStyle("t08_siswanonrutin") ?>><a href="#tab_t08_siswanonrutin" data-toggle="tab"><?php echo $Language->TablePhrase("t08_siswanonrutin", "TblCaption") ?></a></li>
<?php
	}
?>
	</ul>
	<div class="tab-content">
<?php
	if (in_array("t05_siswarutin", explode(",", $t03_siswa->getCurrentDetailTable())) && $t05_siswarutin->DetailEdit) {
		if ($FirstActiveDetailTable == "" || $FirstActiveDetailTable == "t05_siswarutin") {
			$FirstActiveDetailTable = "t05_siswarutin";
		}
?>
		<div class="tab-pane<?php echo $t03_siswa_edit->DetailPages->PageStyle("t05_siswarutin") ?>" id="tab_t05_siswarutin">
<?php include_once "t05_siswarutingrid.php" ?>
		</div>
<?php } ?>
<?php
	if (in_array("t06_siswarutinbayar", explode(",", $t03_siswa->getCurrentDetailTable())) && $t06_siswarutinbayar->DetailEdit) {
		if ($FirstActiveDetailTable == "" || $FirstActiveDetailTable == "t06_siswarutinbayar") {
			$FirstActiveDetailTable = "t06_siswarutinbayar";
		}
?>
		<div class="tab-pane<?php echo $t03_siswa_edit->DetailPages->PageStyle("t06_siswarutinbayar") ?>" id="tab_t06_siswarutinbayar">
<?php include_once "t06_siswarutinbayargrid.php" ?>
		</div>
<?php } ?>
<?php
	if (in_array("t08_siswanonrutin", explode(",", $t03_siswa->getCurrentDetailTable())) && $t08_siswanonrutin->DetailEdit) {
		if ($FirstActiveDetailTable == "" || $FirstActiveDetailTable == "t08_siswanonrutin") {
			$FirstActiveDetailTable = "t08_siswanonrutin";
		}
?>
		<div class="tab-pane<?php echo $t03_siswa_edit->DetailPages->PageStyle("t08_siswanonrutin") ?>" id="tab_t08_siswanonrutin">
<?php include_once "t08_siswanonrutingrid.php" ?>
		</div>
<?php } ?>
	</div>
</div>
</div>
<?php } ?>
<?php if (!$t03_siswa_edit->IsModal) { ?>
<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $t03_siswa_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div>
</div>
<?php } ?>
</form>
<script type="text/javascript">
ft03_siswaedit.Init();
</script>
<?php
$t03_siswa_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$t03_siswa_edit->Page_Terminate();
?>
