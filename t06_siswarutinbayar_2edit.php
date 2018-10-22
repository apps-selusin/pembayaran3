<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg13.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql13.php") ?>
<?php include_once "phpfn13.php" ?>
<?php include_once "t06_siswarutinbayar_2info.php" ?>
<?php include_once "t03_siswainfo.php" ?>
<?php include_once "t96_employeesinfo.php" ?>
<?php include_once "userfn13.php" ?>
<?php

//
// Page class
//

$t06_siswarutinbayar_2_edit = NULL; // Initialize page object first

class ct06_siswarutinbayar_2_edit extends ct06_siswarutinbayar_2 {

	// Page ID
	var $PageID = 'edit';

	// Project ID
	var $ProjectID = "{9A296957-6EE4-4785-AB71-310FFD71D6FE}";

	// Table name
	var $TableName = 't06_siswarutinbayar_2';

	// Page object name
	var $PageObjName = 't06_siswarutinbayar_2_edit';

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

		// Table object (t06_siswarutinbayar_2)
		if (!isset($GLOBALS["t06_siswarutinbayar_2"]) || get_class($GLOBALS["t06_siswarutinbayar_2"]) == "ct06_siswarutinbayar_2") {
			$GLOBALS["t06_siswarutinbayar_2"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t06_siswarutinbayar_2"];
		}

		// Table object (t03_siswa)
		if (!isset($GLOBALS['t03_siswa'])) $GLOBALS['t03_siswa'] = new ct03_siswa();

		// Table object (t96_employees)
		if (!isset($GLOBALS['t96_employees'])) $GLOBALS['t96_employees'] = new ct96_employees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 't06_siswarutinbayar_2', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("t06_siswarutinbayar_2list.php"));
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
		$this->siswa_id->SetVisibility();
		$this->Siswa_Nomor_Induk->SetVisibility();
		$this->Siswa_Nama->SetVisibility();
		$this->rutin_id->SetVisibility();
		$this->siswarutin_id->SetVisibility();
		$this->siswarutin2_id->SetVisibility();
		$this->Bayar_Jumlah->SetVisibility();

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
		global $EW_EXPORT, $t06_siswarutinbayar_2;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($t06_siswarutinbayar_2);
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

		// Set up master detail parameters
		$this->SetUpMasterParms();

		// Load recordset
		$this->StartRec = 1; // Initialize start position
		if ($this->Recordset = $this->LoadRecordset()) // Load records
			$this->TotalRecs = $this->Recordset->RecordCount(); // Get record count
		if ($this->TotalRecs <= 0) { // No record found
			if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
				$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
			$this->Page_Terminate("t06_siswarutinbayar_2list.php"); // Return to list page
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
					$this->Page_Terminate("t06_siswarutinbayar_2list.php"); // Return to list page
				} else {
					$this->LoadRowValues($this->Recordset); // Load row values
				}
				break;
			Case "U": // Update
				$sReturnUrl = $this->getReturnUrl();
				if (ew_GetPageName($sReturnUrl) == "t06_siswarutinbayar_2list.php")
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
		if (!$this->siswa_id->FldIsDetailKey) {
			$this->siswa_id->setFormValue($objForm->GetValue("x_siswa_id"));
		}
		if (!$this->Siswa_Nomor_Induk->FldIsDetailKey) {
			$this->Siswa_Nomor_Induk->setFormValue($objForm->GetValue("x_Siswa_Nomor_Induk"));
		}
		if (!$this->Siswa_Nama->FldIsDetailKey) {
			$this->Siswa_Nama->setFormValue($objForm->GetValue("x_Siswa_Nama"));
		}
		if (!$this->rutin_id->FldIsDetailKey) {
			$this->rutin_id->setFormValue($objForm->GetValue("x_rutin_id"));
		}
		if (!$this->siswarutin_id->FldIsDetailKey) {
			$this->siswarutin_id->setFormValue($objForm->GetValue("x_siswarutin_id"));
		}
		if (!$this->siswarutin2_id->FldIsDetailKey) {
			$this->siswarutin2_id->setFormValue($objForm->GetValue("x_siswarutin2_id"));
		}
		if (!$this->Bayar_Jumlah->FldIsDetailKey) {
			$this->Bayar_Jumlah->setFormValue($objForm->GetValue("x_Bayar_Jumlah"));
		}
		if (!$this->id->FldIsDetailKey)
			$this->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->LoadRow();
		$this->id->CurrentValue = $this->id->FormValue;
		$this->siswa_id->CurrentValue = $this->siswa_id->FormValue;
		$this->Siswa_Nomor_Induk->CurrentValue = $this->Siswa_Nomor_Induk->FormValue;
		$this->Siswa_Nama->CurrentValue = $this->Siswa_Nama->FormValue;
		$this->rutin_id->CurrentValue = $this->rutin_id->FormValue;
		$this->siswarutin_id->CurrentValue = $this->siswarutin_id->FormValue;
		$this->siswarutin2_id->CurrentValue = $this->siswarutin2_id->FormValue;
		$this->Bayar_Jumlah->CurrentValue = $this->Bayar_Jumlah->FormValue;
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
		$this->siswa_id->setDbValue($rs->fields('siswa_id'));
		$this->Siswa_Nomor_Induk->setDbValue($rs->fields('Siswa_Nomor_Induk'));
		$this->Siswa_Nama->setDbValue($rs->fields('Siswa_Nama'));
		$this->rutin_id->setDbValue($rs->fields('rutin_id'));
		$this->siswarutin_id->setDbValue($rs->fields('siswarutin_id'));
		$this->siswarutin2_id->setDbValue($rs->fields('siswarutin2_id'));
		$this->Bayar_Tgl->setDbValue($rs->fields('Bayar_Tgl'));
		$this->Bayar_Jumlah->setDbValue($rs->fields('Bayar_Jumlah'));
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->siswa_id->DbValue = $row['siswa_id'];
		$this->Siswa_Nomor_Induk->DbValue = $row['Siswa_Nomor_Induk'];
		$this->Siswa_Nama->DbValue = $row['Siswa_Nama'];
		$this->rutin_id->DbValue = $row['rutin_id'];
		$this->siswarutin_id->DbValue = $row['siswarutin_id'];
		$this->siswarutin2_id->DbValue = $row['siswarutin2_id'];
		$this->Bayar_Tgl->DbValue = $row['Bayar_Tgl'];
		$this->Bayar_Jumlah->DbValue = $row['Bayar_Jumlah'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Convert decimal values if posted back

		if ($this->Bayar_Jumlah->FormValue == $this->Bayar_Jumlah->CurrentValue && is_numeric(ew_StrToFloat($this->Bayar_Jumlah->CurrentValue)))
			$this->Bayar_Jumlah->CurrentValue = ew_StrToFloat($this->Bayar_Jumlah->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// id
		// siswa_id
		// Siswa_Nomor_Induk
		// Siswa_Nama
		// rutin_id
		// siswarutin_id
		// siswarutin2_id
		// Bayar_Tgl
		// Bayar_Jumlah

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// siswa_id
		$this->siswa_id->ViewValue = $this->siswa_id->CurrentValue;
		if (strval($this->siswa_id->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->siswa_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `Nomor_Induk` AS `DispFld`, `Nama` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t03_siswa`";
		$sWhereWrk = "";
		$this->siswa_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->siswa_id, $sWhereWrk); // Call Lookup selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$arwrk[2] = $rswrk->fields('Disp2Fld');
				$this->siswa_id->ViewValue = $this->siswa_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->siswa_id->ViewValue = $this->siswa_id->CurrentValue;
			}
		} else {
			$this->siswa_id->ViewValue = NULL;
		}
		$this->siswa_id->ViewCustomAttributes = "";

		// Siswa_Nomor_Induk
		$this->Siswa_Nomor_Induk->ViewValue = $this->Siswa_Nomor_Induk->CurrentValue;
		$this->Siswa_Nomor_Induk->ViewCustomAttributes = "";

		// Siswa_Nama
		$this->Siswa_Nama->ViewValue = $this->Siswa_Nama->CurrentValue;
		$this->Siswa_Nama->ViewCustomAttributes = "";

		// rutin_id
		$this->rutin_id->ViewValue = $this->rutin_id->CurrentValue;
		if (strval($this->rutin_id->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->rutin_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `Nama` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t04_rutin`";
		$sWhereWrk = "";
		$this->rutin_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->rutin_id, $sWhereWrk); // Call Lookup selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->rutin_id->ViewValue = $this->rutin_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->rutin_id->ViewValue = $this->rutin_id->CurrentValue;
			}
		} else {
			$this->rutin_id->ViewValue = NULL;
		}
		$this->rutin_id->ViewCustomAttributes = "";

		// siswarutin_id
		if (strval($this->siswarutin_id->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->siswarutin_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `Bulan` AS `DispFld`, `Tahun` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t06_siswarutinbayar`";
		$sWhereWrk = "";
		$this->siswarutin_id->LookupFilters = array();
		$lookuptblfilter = (strval(CurrentPage()->siswa_id->CurrentValue) <> "" and strval(CurrentPage()->rutin_id->CurrentValue) <> "") ? 
  " `Bayar_Tgl` is null and `siswa_id` = " . CurrentPage()->siswa_id->CurrentValue . " and `rutin_id` = " . CurrentPage()->rutin_id->CurrentValue
: 
  " `Bayar_Tgl` is null ";
		ew_AddFilter($sWhereWrk, $lookuptblfilter);
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->siswarutin_id, $sWhereWrk); // Call Lookup selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$arwrk[2] = $rswrk->fields('Disp2Fld');
				$this->siswarutin_id->ViewValue = $this->siswarutin_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->siswarutin_id->ViewValue = $this->siswarutin_id->CurrentValue;
			}
		} else {
			$this->siswarutin_id->ViewValue = NULL;
		}
		$this->siswarutin_id->ViewCustomAttributes = "";

		// siswarutin2_id
		if (strval($this->siswarutin2_id->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->siswarutin2_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `Bulan` AS `DispFld`, `Tahun` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t06_siswarutinbayar`";
		$sWhereWrk = "";
		$this->siswarutin2_id->LookupFilters = array();
		$lookuptblfilter = (strval(CurrentPage()->siswa_id->CurrentValue) <> "" and strval(CurrentPage()->rutin_id->CurrentValue) <> "") ? 
  " `Bayar_Tgl` is null and `siswa_id` = " . CurrentPage()->siswa_id->CurrentValue . " and `rutin_id` = " . CurrentPage()->rutin_id->CurrentValue
: 
  " `Bayar_Tgl` is null ";
		ew_AddFilter($sWhereWrk, $lookuptblfilter);
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->siswarutin2_id, $sWhereWrk); // Call Lookup selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$arwrk[2] = $rswrk->fields('Disp2Fld');
				$this->siswarutin2_id->ViewValue = $this->siswarutin2_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->siswarutin2_id->ViewValue = $this->siswarutin2_id->CurrentValue;
			}
		} else {
			$this->siswarutin2_id->ViewValue = NULL;
		}
		$this->siswarutin2_id->ViewCustomAttributes = "";

		// Bayar_Tgl
		$this->Bayar_Tgl->ViewValue = $this->Bayar_Tgl->CurrentValue;
		$this->Bayar_Tgl->ViewValue = ew_FormatDateTime($this->Bayar_Tgl->ViewValue, 0);
		$this->Bayar_Tgl->ViewCustomAttributes = "";

		// Bayar_Jumlah
		$this->Bayar_Jumlah->ViewValue = $this->Bayar_Jumlah->CurrentValue;
		$this->Bayar_Jumlah->ViewCustomAttributes = "";

			// siswa_id
			$this->siswa_id->LinkCustomAttributes = "";
			$this->siswa_id->HrefValue = "";
			$this->siswa_id->TooltipValue = "";

			// Siswa_Nomor_Induk
			$this->Siswa_Nomor_Induk->LinkCustomAttributes = "";
			$this->Siswa_Nomor_Induk->HrefValue = "";
			$this->Siswa_Nomor_Induk->TooltipValue = "";

			// Siswa_Nama
			$this->Siswa_Nama->LinkCustomAttributes = "";
			$this->Siswa_Nama->HrefValue = "";
			$this->Siswa_Nama->TooltipValue = "";

			// rutin_id
			$this->rutin_id->LinkCustomAttributes = "";
			$this->rutin_id->HrefValue = "";
			$this->rutin_id->TooltipValue = "";

			// siswarutin_id
			$this->siswarutin_id->LinkCustomAttributes = "";
			$this->siswarutin_id->HrefValue = "";
			$this->siswarutin_id->TooltipValue = "";

			// siswarutin2_id
			$this->siswarutin2_id->LinkCustomAttributes = "";
			$this->siswarutin2_id->HrefValue = "";
			$this->siswarutin2_id->TooltipValue = "";

			// Bayar_Jumlah
			$this->Bayar_Jumlah->LinkCustomAttributes = "";
			$this->Bayar_Jumlah->HrefValue = "";
			$this->Bayar_Jumlah->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// siswa_id
			$this->siswa_id->EditAttrs["class"] = "form-control";
			$this->siswa_id->EditCustomAttributes = "";
			$this->siswa_id->EditValue = $this->siswa_id->CurrentValue;
			if (strval($this->siswa_id->CurrentValue) <> "") {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->siswa_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			$sSqlWrk = "SELECT `id`, `Nomor_Induk` AS `DispFld`, `Nama` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t03_siswa`";
			$sWhereWrk = "";
			$this->siswa_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->siswa_id, $sWhereWrk); // Call Lookup selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = Conn()->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = $rswrk->fields('DispFld');
					$arwrk[2] = $rswrk->fields('Disp2Fld');
					$this->siswa_id->EditValue = $this->siswa_id->DisplayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->siswa_id->EditValue = $this->siswa_id->CurrentValue;
				}
			} else {
				$this->siswa_id->EditValue = NULL;
			}
			$this->siswa_id->ViewCustomAttributes = "";

			// Siswa_Nomor_Induk
			$this->Siswa_Nomor_Induk->EditAttrs["class"] = "form-control";
			$this->Siswa_Nomor_Induk->EditCustomAttributes = "";
			$this->Siswa_Nomor_Induk->EditValue = $this->Siswa_Nomor_Induk->CurrentValue;
			$this->Siswa_Nomor_Induk->ViewCustomAttributes = "";

			// Siswa_Nama
			$this->Siswa_Nama->EditAttrs["class"] = "form-control";
			$this->Siswa_Nama->EditCustomAttributes = "";
			$this->Siswa_Nama->EditValue = $this->Siswa_Nama->CurrentValue;
			$this->Siswa_Nama->ViewCustomAttributes = "";

			// rutin_id
			$this->rutin_id->EditAttrs["class"] = "form-control";
			$this->rutin_id->EditCustomAttributes = "";
			$this->rutin_id->EditValue = $this->rutin_id->CurrentValue;
			if (strval($this->rutin_id->CurrentValue) <> "") {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->rutin_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			$sSqlWrk = "SELECT `id`, `Nama` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t04_rutin`";
			$sWhereWrk = "";
			$this->rutin_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->rutin_id, $sWhereWrk); // Call Lookup selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = Conn()->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = $rswrk->fields('DispFld');
					$this->rutin_id->EditValue = $this->rutin_id->DisplayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->rutin_id->EditValue = $this->rutin_id->CurrentValue;
				}
			} else {
				$this->rutin_id->EditValue = NULL;
			}
			$this->rutin_id->ViewCustomAttributes = "";

			// siswarutin_id
			$this->siswarutin_id->EditAttrs["class"] = "form-control";
			$this->siswarutin_id->EditCustomAttributes = "";
			if (trim(strval($this->siswarutin_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->siswarutin_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `id`, `Bulan` AS `DispFld`, `Tahun` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `t06_siswarutinbayar`";
			$sWhereWrk = "";
			$this->siswarutin_id->LookupFilters = array();
			$lookuptblfilter = (strval(CurrentPage()->siswa_id->CurrentValue) <> "" and strval(CurrentPage()->rutin_id->CurrentValue) <> "") ? 
  " `Bayar_Tgl` is null and `siswa_id` = " . CurrentPage()->siswa_id->CurrentValue . " and `rutin_id` = " . CurrentPage()->rutin_id->CurrentValue
: 
  " `Bayar_Tgl` is null ";
			ew_AddFilter($sWhereWrk, $lookuptblfilter);
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->siswarutin_id, $sWhereWrk); // Call Lookup selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->siswarutin_id->EditValue = $arwrk;

			// siswarutin2_id
			$this->siswarutin2_id->EditAttrs["class"] = "form-control";
			$this->siswarutin2_id->EditCustomAttributes = "";
			if (trim(strval($this->siswarutin2_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->siswarutin2_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `id`, `Bulan` AS `DispFld`, `Tahun` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `t06_siswarutinbayar`";
			$sWhereWrk = "";
			$this->siswarutin2_id->LookupFilters = array();
			$lookuptblfilter = (strval(CurrentPage()->siswa_id->CurrentValue) <> "" and strval(CurrentPage()->rutin_id->CurrentValue) <> "") ? 
  " `Bayar_Tgl` is null and `siswa_id` = " . CurrentPage()->siswa_id->CurrentValue . " and `rutin_id` = " . CurrentPage()->rutin_id->CurrentValue
: 
  " `Bayar_Tgl` is null ";
			ew_AddFilter($sWhereWrk, $lookuptblfilter);
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->siswarutin2_id, $sWhereWrk); // Call Lookup selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->siswarutin2_id->EditValue = $arwrk;

			// Bayar_Jumlah
			$this->Bayar_Jumlah->EditAttrs["class"] = "form-control";
			$this->Bayar_Jumlah->EditCustomAttributes = "";
			$this->Bayar_Jumlah->EditValue = ew_HtmlEncode($this->Bayar_Jumlah->CurrentValue);
			$this->Bayar_Jumlah->PlaceHolder = ew_RemoveHtml($this->Bayar_Jumlah->FldCaption());
			if (strval($this->Bayar_Jumlah->EditValue) <> "" && is_numeric($this->Bayar_Jumlah->EditValue)) $this->Bayar_Jumlah->EditValue = ew_FormatNumber($this->Bayar_Jumlah->EditValue, -2, -1, -2, 0);

			// Edit refer script
			// siswa_id

			$this->siswa_id->LinkCustomAttributes = "";
			$this->siswa_id->HrefValue = "";
			$this->siswa_id->TooltipValue = "";

			// Siswa_Nomor_Induk
			$this->Siswa_Nomor_Induk->LinkCustomAttributes = "";
			$this->Siswa_Nomor_Induk->HrefValue = "";
			$this->Siswa_Nomor_Induk->TooltipValue = "";

			// Siswa_Nama
			$this->Siswa_Nama->LinkCustomAttributes = "";
			$this->Siswa_Nama->HrefValue = "";
			$this->Siswa_Nama->TooltipValue = "";

			// rutin_id
			$this->rutin_id->LinkCustomAttributes = "";
			$this->rutin_id->HrefValue = "";
			$this->rutin_id->TooltipValue = "";

			// siswarutin_id
			$this->siswarutin_id->LinkCustomAttributes = "";
			$this->siswarutin_id->HrefValue = "";

			// siswarutin2_id
			$this->siswarutin2_id->LinkCustomAttributes = "";
			$this->siswarutin2_id->HrefValue = "";

			// Bayar_Jumlah
			$this->Bayar_Jumlah->LinkCustomAttributes = "";
			$this->Bayar_Jumlah->HrefValue = "";
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
		if (!$this->siswarutin_id->FldIsDetailKey && !is_null($this->siswarutin_id->FormValue) && $this->siswarutin_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->siswarutin_id->FldCaption(), $this->siswarutin_id->ReqErrMsg));
		}
		if (!$this->siswarutin2_id->FldIsDetailKey && !is_null($this->siswarutin2_id->FormValue) && $this->siswarutin2_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->siswarutin2_id->FldCaption(), $this->siswarutin2_id->ReqErrMsg));
		}
		if (!ew_CheckNumber($this->Bayar_Jumlah->FormValue)) {
			ew_AddMessage($gsFormError, $this->Bayar_Jumlah->FldErrMsg());
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

			// Save old values
			$rsold = &$rs->fields;
			$this->LoadDbValues($rsold);
			$rsnew = array();

			// siswarutin_id
			$this->siswarutin_id->SetDbValueDef($rsnew, $this->siswarutin_id->CurrentValue, 0, $this->siswarutin_id->ReadOnly);

			// siswarutin2_id
			$this->siswarutin2_id->SetDbValueDef($rsnew, $this->siswarutin2_id->CurrentValue, 0, $this->siswarutin2_id->ReadOnly);

			// Bayar_Jumlah
			$this->Bayar_Jumlah->SetDbValueDef($rsnew, $this->Bayar_Jumlah->CurrentValue, NULL, $this->Bayar_Jumlah->ReadOnly);

			// Check referential integrity for master table 't03_siswa'
			$bValidMasterRecord = TRUE;
			$sMasterFilter = $this->SqlMasterFilter_t03_siswa();
			$KeyValue = isset($rsnew['siswa_id']) ? $rsnew['siswa_id'] : $rsold['siswa_id'];
			if (strval($KeyValue) <> "") {
				$sMasterFilter = str_replace("@id@", ew_AdjustSql($KeyValue), $sMasterFilter);
			} else {
				$bValidMasterRecord = FALSE;
			}
			if ($bValidMasterRecord) {
				if (!isset($GLOBALS["t03_siswa"])) $GLOBALS["t03_siswa"] = new ct03_siswa();
				$rsmaster = $GLOBALS["t03_siswa"]->LoadRs($sMasterFilter);
				$bValidMasterRecord = ($rsmaster && !$rsmaster->EOF);
				$rsmaster->Close();
			}
			if (!$bValidMasterRecord) {
				$sRelatedRecordMsg = str_replace("%t", "t03_siswa", $Language->Phrase("RelatedRecordRequired"));
				$this->setFailureMessage($sRelatedRecordMsg);
				$rs->Close();
				return FALSE;
			}

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

	// Set up master/detail based on QueryString
	function SetUpMasterParms() {
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (isset($_GET[EW_TABLE_SHOW_MASTER])) {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($sMasterTblVar == "t03_siswa") {
				$bValidMaster = TRUE;
				if (@$_GET["fk_id"] <> "") {
					$GLOBALS["t03_siswa"]->id->setQueryStringValue($_GET["fk_id"]);
					$this->siswa_id->setQueryStringValue($GLOBALS["t03_siswa"]->id->QueryStringValue);
					$this->siswa_id->setSessionValue($this->siswa_id->QueryStringValue);
					if (!is_numeric($GLOBALS["t03_siswa"]->id->QueryStringValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
			}
		} elseif (isset($_POST[EW_TABLE_SHOW_MASTER])) {
			$sMasterTblVar = $_POST[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($sMasterTblVar == "t03_siswa") {
				$bValidMaster = TRUE;
				if (@$_POST["fk_id"] <> "") {
					$GLOBALS["t03_siswa"]->id->setFormValue($_POST["fk_id"]);
					$this->siswa_id->setFormValue($GLOBALS["t03_siswa"]->id->FormValue);
					$this->siswa_id->setSessionValue($this->siswa_id->FormValue);
					if (!is_numeric($GLOBALS["t03_siswa"]->id->FormValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$this->setCurrentMasterTable($sMasterTblVar);
			$this->setSessionWhere($this->GetDetailFilter());

			// Reset start record counter (new master key)
			$this->StartRec = 1;
			$this->setStartRecordNumber($this->StartRec);

			// Clear previous master key from Session
			if ($sMasterTblVar <> "t03_siswa") {
				if ($this->siswa_id->CurrentValue == "") $this->siswa_id->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $this->GetMasterFilter(); // Get master filter
		$this->DbDetailFilter = $this->GetDetailFilter(); // Get detail filter
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("t06_siswarutinbayar_2list.php"), "", $this->TableVar, TRUE);
		$PageId = "edit";
		$Breadcrumb->Add("edit", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_siswarutin_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id` AS `LinkFld`, `Bulan` AS `DispFld`, `Tahun` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t06_siswarutinbayar`";
			$sWhereWrk = "";
			$this->siswarutin_id->LookupFilters = array();
			$lookuptblfilter = (strval(CurrentPage()->siswa_id->CurrentValue) <> "" and strval(CurrentPage()->rutin_id->CurrentValue) <> "") ? 
  " `Bayar_Tgl` is null and `siswa_id` = " . CurrentPage()->siswa_id->CurrentValue . " and `rutin_id` = " . CurrentPage()->rutin_id->CurrentValue
: 
  " `Bayar_Tgl` is null ";
			ew_AddFilter($sWhereWrk, $lookuptblfilter);
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` = {filter_value}', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->siswarutin_id, $sWhereWrk); // Call Lookup selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_siswarutin2_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id` AS `LinkFld`, `Bulan` AS `DispFld`, `Tahun` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t06_siswarutinbayar`";
			$sWhereWrk = "";
			$this->siswarutin2_id->LookupFilters = array();
			$lookuptblfilter = (strval(CurrentPage()->siswa_id->CurrentValue) <> "" and strval(CurrentPage()->rutin_id->CurrentValue) <> "") ? 
  " `Bayar_Tgl` is null and `siswa_id` = " . CurrentPage()->siswa_id->CurrentValue . " and `rutin_id` = " . CurrentPage()->rutin_id->CurrentValue
: 
  " `Bayar_Tgl` is null ";
			ew_AddFilter($sWhereWrk, $lookuptblfilter);
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` = {filter_value}', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->siswarutin2_id, $sWhereWrk); // Call Lookup selecting
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
if (!isset($t06_siswarutinbayar_2_edit)) $t06_siswarutinbayar_2_edit = new ct06_siswarutinbayar_2_edit();

// Page init
$t06_siswarutinbayar_2_edit->Page_Init();

// Page main
$t06_siswarutinbayar_2_edit->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t06_siswarutinbayar_2_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "edit";
var CurrentForm = ft06_siswarutinbayar_2edit = new ew_Form("ft06_siswarutinbayar_2edit", "edit");

// Validate form
ft06_siswarutinbayar_2edit.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_siswarutin_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t06_siswarutinbayar_2->siswarutin_id->FldCaption(), $t06_siswarutinbayar_2->siswarutin_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_siswarutin2_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t06_siswarutinbayar_2->siswarutin2_id->FldCaption(), $t06_siswarutinbayar_2->siswarutin2_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Bayar_Jumlah");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t06_siswarutinbayar_2->Bayar_Jumlah->FldErrMsg()) ?>");

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
ft06_siswarutinbayar_2edit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft06_siswarutinbayar_2edit.ValidateRequired = true;
<?php } else { ?>
ft06_siswarutinbayar_2edit.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
ft06_siswarutinbayar_2edit.Lists["x_siswa_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Nomor_Induk","x_Nama","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t03_siswa"};
ft06_siswarutinbayar_2edit.Lists["x_rutin_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Nama","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t04_rutin"};
ft06_siswarutinbayar_2edit.Lists["x_siswarutin_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Bulan","x_Tahun","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t06_siswarutinbayar"};
ft06_siswarutinbayar_2edit.Lists["x_siswarutin2_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Bulan","x_Tahun","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t06_siswarutinbayar"};

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php if (!$t06_siswarutinbayar_2_edit->IsModal) { ?>
<div class="ewToolbar">
<?php $Breadcrumb->Render(); ?>
<?php echo $Language->SelectionForm(); ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $t06_siswarutinbayar_2_edit->ShowPageHeader(); ?>
<?php
$t06_siswarutinbayar_2_edit->ShowMessage();
?>
<?php if (!$t06_siswarutinbayar_2_edit->IsModal) { ?>
<form name="ewPagerForm" class="form-horizontal ewForm ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($t06_siswarutinbayar_2_edit->Pager)) $t06_siswarutinbayar_2_edit->Pager = new cPrevNextPager($t06_siswarutinbayar_2_edit->StartRec, $t06_siswarutinbayar_2_edit->DisplayRecs, $t06_siswarutinbayar_2_edit->TotalRecs) ?>
<?php if ($t06_siswarutinbayar_2_edit->Pager->RecordCount > 0 && $t06_siswarutinbayar_2_edit->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($t06_siswarutinbayar_2_edit->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $t06_siswarutinbayar_2_edit->PageUrl() ?>start=<?php echo $t06_siswarutinbayar_2_edit->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($t06_siswarutinbayar_2_edit->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $t06_siswarutinbayar_2_edit->PageUrl() ?>start=<?php echo $t06_siswarutinbayar_2_edit->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $t06_siswarutinbayar_2_edit->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($t06_siswarutinbayar_2_edit->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $t06_siswarutinbayar_2_edit->PageUrl() ?>start=<?php echo $t06_siswarutinbayar_2_edit->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($t06_siswarutinbayar_2_edit->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $t06_siswarutinbayar_2_edit->PageUrl() ?>start=<?php echo $t06_siswarutinbayar_2_edit->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $t06_siswarutinbayar_2_edit->Pager->PageCount ?></span>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="ft06_siswarutinbayar_2edit" id="ft06_siswarutinbayar_2edit" class="<?php echo $t06_siswarutinbayar_2_edit->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($t06_siswarutinbayar_2_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $t06_siswarutinbayar_2_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t06_siswarutinbayar_2">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<?php if ($t06_siswarutinbayar_2_edit->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<?php if ($t06_siswarutinbayar_2->getCurrentMasterTable() == "t03_siswa") { ?>
<input type="hidden" name="<?php echo EW_TABLE_SHOW_MASTER ?>" value="t03_siswa">
<input type="hidden" name="fk_id" value="<?php echo $t06_siswarutinbayar_2->siswa_id->getSessionValue() ?>">
<?php } ?>
<div>
<?php if ($t06_siswarutinbayar_2->siswa_id->Visible) { // siswa_id ?>
	<div id="r_siswa_id" class="form-group">
		<label id="elh_t06_siswarutinbayar_2_siswa_id" class="col-sm-2 control-label ewLabel"><?php echo $t06_siswarutinbayar_2->siswa_id->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t06_siswarutinbayar_2->siswa_id->CellAttributes() ?>>
<span id="el_t06_siswarutinbayar_2_siswa_id">
<span<?php echo $t06_siswarutinbayar_2->siswa_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t06_siswarutinbayar_2->siswa_id->EditValue ?></p></span>
</span>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_siswa_id" name="x_siswa_id" id="x_siswa_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->siswa_id->CurrentValue) ?>">
<?php echo $t06_siswarutinbayar_2->siswa_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t06_siswarutinbayar_2->Siswa_Nomor_Induk->Visible) { // Siswa_Nomor_Induk ?>
	<div id="r_Siswa_Nomor_Induk" class="form-group">
		<label id="elh_t06_siswarutinbayar_2_Siswa_Nomor_Induk" for="x_Siswa_Nomor_Induk" class="col-sm-2 control-label ewLabel"><?php echo $t06_siswarutinbayar_2->Siswa_Nomor_Induk->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t06_siswarutinbayar_2->Siswa_Nomor_Induk->CellAttributes() ?>>
<span id="el_t06_siswarutinbayar_2_Siswa_Nomor_Induk">
<span<?php echo $t06_siswarutinbayar_2->Siswa_Nomor_Induk->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t06_siswarutinbayar_2->Siswa_Nomor_Induk->EditValue ?></p></span>
</span>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Siswa_Nomor_Induk" name="x_Siswa_Nomor_Induk" id="x_Siswa_Nomor_Induk" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Siswa_Nomor_Induk->CurrentValue) ?>">
<?php echo $t06_siswarutinbayar_2->Siswa_Nomor_Induk->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t06_siswarutinbayar_2->Siswa_Nama->Visible) { // Siswa_Nama ?>
	<div id="r_Siswa_Nama" class="form-group">
		<label id="elh_t06_siswarutinbayar_2_Siswa_Nama" for="x_Siswa_Nama" class="col-sm-2 control-label ewLabel"><?php echo $t06_siswarutinbayar_2->Siswa_Nama->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t06_siswarutinbayar_2->Siswa_Nama->CellAttributes() ?>>
<span id="el_t06_siswarutinbayar_2_Siswa_Nama">
<span<?php echo $t06_siswarutinbayar_2->Siswa_Nama->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t06_siswarutinbayar_2->Siswa_Nama->EditValue ?></p></span>
</span>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Siswa_Nama" name="x_Siswa_Nama" id="x_Siswa_Nama" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Siswa_Nama->CurrentValue) ?>">
<?php echo $t06_siswarutinbayar_2->Siswa_Nama->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t06_siswarutinbayar_2->rutin_id->Visible) { // rutin_id ?>
	<div id="r_rutin_id" class="form-group">
		<label id="elh_t06_siswarutinbayar_2_rutin_id" class="col-sm-2 control-label ewLabel"><?php echo $t06_siswarutinbayar_2->rutin_id->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t06_siswarutinbayar_2->rutin_id->CellAttributes() ?>>
<span id="el_t06_siswarutinbayar_2_rutin_id">
<span<?php echo $t06_siswarutinbayar_2->rutin_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t06_siswarutinbayar_2->rutin_id->EditValue ?></p></span>
</span>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_rutin_id" name="x_rutin_id" id="x_rutin_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->rutin_id->CurrentValue) ?>">
<?php echo $t06_siswarutinbayar_2->rutin_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t06_siswarutinbayar_2->siswarutin_id->Visible) { // siswarutin_id ?>
	<div id="r_siswarutin_id" class="form-group">
		<label id="elh_t06_siswarutinbayar_2_siswarutin_id" for="x_siswarutin_id" class="col-sm-2 control-label ewLabel"><?php echo $t06_siswarutinbayar_2->siswarutin_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t06_siswarutinbayar_2->siswarutin_id->CellAttributes() ?>>
<span id="el_t06_siswarutinbayar_2_siswarutin_id">
<select data-table="t06_siswarutinbayar_2" data-field="x_siswarutin_id" data-value-separator="<?php echo $t06_siswarutinbayar_2->siswarutin_id->DisplayValueSeparatorAttribute() ?>" id="x_siswarutin_id" name="x_siswarutin_id"<?php echo $t06_siswarutinbayar_2->siswarutin_id->EditAttributes() ?>>
<?php echo $t06_siswarutinbayar_2->siswarutin_id->SelectOptionListHtml("x_siswarutin_id") ?>
</select>
<input type="hidden" name="s_x_siswarutin_id" id="s_x_siswarutin_id" value="<?php echo $t06_siswarutinbayar_2->siswarutin_id->LookupFilterQuery() ?>">
</span>
<?php echo $t06_siswarutinbayar_2->siswarutin_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t06_siswarutinbayar_2->siswarutin2_id->Visible) { // siswarutin2_id ?>
	<div id="r_siswarutin2_id" class="form-group">
		<label id="elh_t06_siswarutinbayar_2_siswarutin2_id" for="x_siswarutin2_id" class="col-sm-2 control-label ewLabel"><?php echo $t06_siswarutinbayar_2->siswarutin2_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t06_siswarutinbayar_2->siswarutin2_id->CellAttributes() ?>>
<span id="el_t06_siswarutinbayar_2_siswarutin2_id">
<select data-table="t06_siswarutinbayar_2" data-field="x_siswarutin2_id" data-value-separator="<?php echo $t06_siswarutinbayar_2->siswarutin2_id->DisplayValueSeparatorAttribute() ?>" id="x_siswarutin2_id" name="x_siswarutin2_id"<?php echo $t06_siswarutinbayar_2->siswarutin2_id->EditAttributes() ?>>
<?php echo $t06_siswarutinbayar_2->siswarutin2_id->SelectOptionListHtml("x_siswarutin2_id") ?>
</select>
<input type="hidden" name="s_x_siswarutin2_id" id="s_x_siswarutin2_id" value="<?php echo $t06_siswarutinbayar_2->siswarutin2_id->LookupFilterQuery() ?>">
</span>
<?php echo $t06_siswarutinbayar_2->siswarutin2_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t06_siswarutinbayar_2->Bayar_Jumlah->Visible) { // Bayar_Jumlah ?>
	<div id="r_Bayar_Jumlah" class="form-group">
		<label id="elh_t06_siswarutinbayar_2_Bayar_Jumlah" for="x_Bayar_Jumlah" class="col-sm-2 control-label ewLabel"><?php echo $t06_siswarutinbayar_2->Bayar_Jumlah->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t06_siswarutinbayar_2->Bayar_Jumlah->CellAttributes() ?>>
<span id="el_t06_siswarutinbayar_2_Bayar_Jumlah">
<input type="text" data-table="t06_siswarutinbayar_2" data-field="x_Bayar_Jumlah" name="x_Bayar_Jumlah" id="x_Bayar_Jumlah" size="30" placeholder="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Bayar_Jumlah->getPlaceHolder()) ?>" value="<?php echo $t06_siswarutinbayar_2->Bayar_Jumlah->EditValue ?>"<?php echo $t06_siswarutinbayar_2->Bayar_Jumlah->EditAttributes() ?>>
</span>
<?php echo $t06_siswarutinbayar_2->Bayar_Jumlah->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_id" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->id->CurrentValue) ?>">
<?php if (!$t06_siswarutinbayar_2_edit->IsModal) { ?>
<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $t06_siswarutinbayar_2_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div>
</div>
<?php } ?>
</form>
<script type="text/javascript">
ft06_siswarutinbayar_2edit.Init();
</script>
<?php
$t06_siswarutinbayar_2_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$t06_siswarutinbayar_2_edit->Page_Terminate();
?>
