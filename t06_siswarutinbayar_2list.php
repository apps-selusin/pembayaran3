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

$t06_siswarutinbayar_2_list = NULL; // Initialize page object first

class ct06_siswarutinbayar_2_list extends ct06_siswarutinbayar_2 {

	// Page ID
	var $PageID = 'list';

	// Project ID
	var $ProjectID = "{9A296957-6EE4-4785-AB71-310FFD71D6FE}";

	// Table name
	var $TableName = 't06_siswarutinbayar_2';

	// Page object name
	var $PageObjName = 't06_siswarutinbayar_2_list';

	// Grid form hidden field names
	var $FormName = 'ft06_siswarutinbayar_2list';
	var $FormActionName = 'k_action';
	var $FormKeyName = 'k_key';
	var $FormOldKeyName = 'k_oldkey';
	var $FormBlankRowName = 'k_blankrow';
	var $FormKeyCountName = 'key_count';

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

	// Page URLs
	var $AddUrl;
	var $EditUrl;
	var $CopyUrl;
	var $DeleteUrl;
	var $ViewUrl;
	var $ListUrl;

	// Export URLs
	var $ExportPrintUrl;
	var $ExportHtmlUrl;
	var $ExportExcelUrl;
	var $ExportWordUrl;
	var $ExportXmlUrl;
	var $ExportCsvUrl;
	var $ExportPdfUrl;

	// Custom export
	var $ExportExcelCustom = FALSE;
	var $ExportWordCustom = FALSE;
	var $ExportPdfCustom = FALSE;
	var $ExportEmailCustom = FALSE;

	// Update URLs
	var $InlineAddUrl;
	var $InlineCopyUrl;
	var $InlineEditUrl;
	var $GridAddUrl;
	var $GridEditUrl;
	var $MultiDeleteUrl;
	var $MultiUpdateUrl;

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

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "t06_siswarutinbayar_2add.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "t06_siswarutinbayar_2delete.php";
		$this->MultiUpdateUrl = "t06_siswarutinbayar_2update.php";

		// Table object (t03_siswa)
		if (!isset($GLOBALS['t03_siswa'])) $GLOBALS['t03_siswa'] = new ct03_siswa();

		// Table object (t96_employees)
		if (!isset($GLOBALS['t96_employees'])) $GLOBALS['t96_employees'] = new ct96_employees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

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

		// List options
		$this->ListOptions = new cListOptions();
		$this->ListOptions->TableVar = $this->TableVar;

		// Export options
		$this->ExportOptions = new cListOptions();
		$this->ExportOptions->Tag = "div";
		$this->ExportOptions->TagClassName = "ewExportOption";

		// Other options
		$this->OtherOptions['addedit'] = new cListOptions();
		$this->OtherOptions['addedit']->Tag = "div";
		$this->OtherOptions['addedit']->TagClassName = "ewAddEditOption";
		$this->OtherOptions['detail'] = new cListOptions();
		$this->OtherOptions['detail']->Tag = "div";
		$this->OtherOptions['detail']->TagClassName = "ewDetailOption";
		$this->OtherOptions['action'] = new cListOptions();
		$this->OtherOptions['action']->Tag = "div";
		$this->OtherOptions['action']->TagClassName = "ewActionOption";

		// Filter options
		$this->FilterOptions = new cListOptions();
		$this->FilterOptions->Tag = "div";
		$this->FilterOptions->TagClassName = "ewFilterOption ft06_siswarutinbayar_2listsrch";

		// List actions
		$this->ListActions = new cListActions();
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
		if (!$Security->CanList()) {
			$Security->SaveLastUrl();
			$this->setFailureMessage(ew_DeniedMsg()); // Set no permission
			$this->Page_Terminate(ew_GetUrl("index.php"));
		}
		if ($Security->IsLoggedIn()) {
			$Security->UserID_Loading();
			$Security->LoadUserID();
			$Security->UserID_Loaded();
		}

		// Create form object
		$objForm = new cFormObj();
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$this->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->SetupListOptions();
		$this->id->SetVisibility();
		$this->id->Visible = !$this->IsAdd() && !$this->IsCopy() && !$this->IsGridAdd();
		$this->siswa_id->SetVisibility();
		$this->rutin_id->SetVisibility();
		$this->Bulan->SetVisibility();
		$this->Tahun->SetVisibility();
		$this->Bulan2->SetVisibility();
		$this->Tahun2->SetVisibility();
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

		// Set up master detail parameters
		$this->SetUpMasterParms();

		// Setup other options
		$this->SetupOtherOptions();

		// Set up custom action (compatible with old version)
		foreach ($this->CustomActions as $name => $action)
			$this->ListActions->Add($name, $action);

		// Show checkbox column if multiple action
		foreach ($this->ListActions->Items as $listaction) {
			if ($listaction->Select == EW_ACTION_MULTIPLE && $listaction->Allow) {
				$this->ListOptions->Items["checkbox"]->Visible = TRUE;
				break;
			}
		}
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
			header("Location: " . $url);
		}
		exit();
	}

	// Class variables
	var $ListOptions; // List options
	var $ExportOptions; // Export options
	var $SearchOptions; // Search options
	var $OtherOptions = array(); // Other options
	var $FilterOptions; // Filter options
	var $ListActions; // List actions
	var $SelectedCount = 0;
	var $SelectedIndex = 0;
	var $DisplayRecs = 50;
	var $StartRec;
	var $StopRec;
	var $TotalRecs = 0;
	var $RecRange = 10;
	var $Pager;
	var $DefaultSearchWhere = ""; // Default search WHERE clause
	var $SearchWhere = ""; // Search WHERE clause
	var $RecCnt = 0; // Record count
	var $EditRowCnt;
	var $StartRowCnt = 1;
	var $RowCnt = 0;
	var $Attrs = array(); // Row attributes and cell attributes
	var $RowIndex = 0; // Row index
	var $KeyCount = 0; // Key count
	var $RowAction = ""; // Row action
	var $RowOldKey = ""; // Row old key (for copy)
	var $RecPerRow = 0;
	var $MultiColumnClass;
	var $MultiColumnEditClass = "col-sm-12";
	var $MultiColumnCnt = 12;
	var $MultiColumnEditCnt = 12;
	var $GridCnt = 0;
	var $ColCnt = 0;
	var $DbMasterFilter = ""; // Master filter
	var $DbDetailFilter = ""; // Detail filter
	var $MasterRecordExists;	
	var $MultiSelectKey;
	var $Command;
	var $RestoreSearch = FALSE;
	var $DetailPages;
	var $Recordset;
	var $OldRecordset;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";

		// Get command
		$this->Command = strtolower(@$_GET["cmd"]);
		if ($this->IsPageRequest()) { // Validate request

			// Process list action first
			if ($this->ProcessListAction()) // Ajax request
				$this->Page_Terminate();

			// Handle reset command
			$this->ResetCmd();

			// Set up Breadcrumb
			if ($this->Export == "")
				$this->SetupBreadcrumb();

			// Check QueryString parameters
			if (@$_GET["a"] <> "") {
				$this->CurrentAction = $_GET["a"];

				// Clear inline mode
				if ($this->CurrentAction == "cancel")
					$this->ClearInlineMode();

				// Switch to grid edit mode
				if ($this->CurrentAction == "gridedit")
					$this->GridEditMode();

				// Switch to inline edit mode
				if ($this->CurrentAction == "edit")
					$this->InlineEditMode();
			} else {
				if (@$_POST["a_list"] <> "") {
					$this->CurrentAction = $_POST["a_list"]; // Get action

					// Grid Update
					if (($this->CurrentAction == "gridupdate" || $this->CurrentAction == "gridoverwrite") && @$_SESSION[EW_SESSION_INLINE_MODE] == "gridedit") {
						if ($this->ValidateGridForm()) {
							$bGridUpdate = $this->GridUpdate();
						} else {
							$bGridUpdate = FALSE;
							$this->setFailureMessage($gsFormError);
						}
						if (!$bGridUpdate) {
							$this->EventCancelled = TRUE;
							$this->CurrentAction = "gridedit"; // Stay in Grid Edit mode
						}
					}

					// Inline Update
					if (($this->CurrentAction == "update" || $this->CurrentAction == "overwrite") && @$_SESSION[EW_SESSION_INLINE_MODE] == "edit")
						$this->InlineUpdate();
				}
			}

			// Hide list options
			if ($this->Export <> "") {
				$this->ListOptions->HideAllOptions(array("sequence"));
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			} elseif ($this->CurrentAction == "gridadd" || $this->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			}

			// Hide options
			if ($this->Export <> "" || $this->CurrentAction <> "") {
				$this->ExportOptions->HideAllOptions();
				$this->FilterOptions->HideAllOptions();
			}

			// Hide other options
			if ($this->Export <> "") {
				foreach ($this->OtherOptions as &$option)
					$option->HideAllOptions();
			}

			// Show grid delete link for grid add / grid edit
			if ($this->AllowAddDeleteRow) {
				if ($this->CurrentAction == "gridadd" || $this->CurrentAction == "gridedit") {
					$item = $this->ListOptions->GetItem("griddelete");
					if ($item) $item->Visible = TRUE;
				}
			}

			// Set up sorting order
			$this->SetUpSortOrder();
		}

		// Restore display records
		if ($this->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $this->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 50; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records

		// Restore master/detail filter
		$this->DbMasterFilter = $this->GetMasterFilter(); // Restore master filter
		$this->DbDetailFilter = $this->GetDetailFilter(); // Restore detail filter
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Load master record
		if ($this->CurrentMode <> "add" && $this->GetMasterFilter() <> "" && $this->getCurrentMasterTable() == "t03_siswa") {
			global $t03_siswa;
			$rsmaster = $t03_siswa->LoadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate("t03_siswalist.php"); // Return to master page
			} else {
				$t03_siswa->LoadListRowValues($rsmaster);
				$t03_siswa->RowType = EW_ROWTYPE_MASTER; // Master row
				$t03_siswa->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in session
		$this->setSessionWhere($sFilter);
		$this->CurrentFilter = "";

		// Load record count first
		if (!$this->IsAddOrEdit()) {
			$bSelectLimit = $this->UseSelectLimit;
			if ($bSelectLimit) {
				$this->TotalRecs = $this->SelectRecordCount();
			} else {
				if ($this->Recordset = $this->LoadRecordset())
					$this->TotalRecs = $this->Recordset->RecordCount();
			}
		}

		// Search options
		$this->SetupSearchOptions();
	}

	//  Exit inline mode
	function ClearInlineMode() {
		$this->setKey("id", ""); // Clear inline edit key
		$this->Bayar_Jumlah->FormValue = ""; // Clear form value
		$this->LastAction = $this->CurrentAction; // Save last action
		$this->CurrentAction = ""; // Clear action
		$_SESSION[EW_SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Grid Edit mode
	function GridEditMode() {
		$_SESSION[EW_SESSION_INLINE_MODE] = "gridedit"; // Enable grid edit
	}

	// Switch to Inline Edit mode
	function InlineEditMode() {
		global $Security, $Language;
		if (!$Security->CanEdit())
			$this->Page_Terminate("login.php"); // Go to login page
		$bInlineEdit = TRUE;
		if (@$_GET["id"] <> "") {
			$this->id->setQueryStringValue($_GET["id"]);
		} else {
			$bInlineEdit = FALSE;
		}
		if ($bInlineEdit) {
			if ($this->LoadRow()) {
				$this->setKey("id", $this->id->CurrentValue); // Set up inline edit key
				$_SESSION[EW_SESSION_INLINE_MODE] = "edit"; // Enable inline edit
			}
		}
	}

	// Perform update to Inline Edit record
	function InlineUpdate() {
		global $Language, $objForm, $gsFormError;
		$objForm->Index = 1; 
		$this->LoadFormValues(); // Get form values

		// Validate form
		$bInlineUpdate = TRUE;
		if (!$this->ValidateForm()) {	
			$bInlineUpdate = FALSE; // Form error, reset action
			$this->setFailureMessage($gsFormError);
		} else {
			$bInlineUpdate = FALSE;
			$rowkey = strval($objForm->GetValue($this->FormKeyName));
			if ($this->SetupKeyValues($rowkey)) { // Set up key values
				if ($this->CheckInlineEditKey()) { // Check key
					$this->SendEmail = TRUE; // Send email on update success
					$bInlineUpdate = $this->EditRow(); // Update record
				} else {
					$bInlineUpdate = FALSE;
				}
			}
		}
		if ($bInlineUpdate) { // Update success
			if ($this->getSuccessMessage() == "")
				$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Set up success message
			$this->ClearInlineMode(); // Clear inline edit mode
		} else {
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->Phrase("UpdateFailed")); // Set update failed message
			$this->EventCancelled = TRUE; // Cancel event
			$this->CurrentAction = "edit"; // Stay in edit mode
		}
	}

	// Check Inline Edit key
	function CheckInlineEditKey() {

		//CheckInlineEditKey = True
		if (strval($this->getKey("id")) <> strval($this->id->CurrentValue))
			return FALSE;
		return TRUE;
	}

	// Perform update to grid
	function GridUpdate() {
		global $Language, $objForm, $gsFormError;
		$bGridUpdate = TRUE;

		// Get old recordset
		$this->CurrentFilter = $this->BuildKeyFilter();
		if ($this->CurrentFilter == "")
			$this->CurrentFilter = "0=1";
		$sSql = $this->SQL();
		$conn = &$this->Connection();
		if ($rs = $conn->Execute($sSql)) {
			$rsold = $rs->GetRows();
			$rs->Close();
		}

		// Call Grid Updating event
		if (!$this->Grid_Updating($rsold)) {
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->Phrase("GridEditCancelled")); // Set grid edit cancelled message
			return FALSE;
		}

		// Begin transaction
		$conn->BeginTrans();
		if ($this->AuditTrailOnEdit) $this->WriteAuditTrailDummy($Language->Phrase("BatchUpdateBegin")); // Batch update begin
		$sKey = "";

		// Update row index and get row key
		$objForm->Index = -1;
		$rowcnt = strval($objForm->GetValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Update all rows based on key
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {
			$objForm->Index = $rowindex;
			$rowkey = strval($objForm->GetValue($this->FormKeyName));
			$rowaction = strval($objForm->GetValue($this->FormActionName));

			// Load all values and keys
			if ($rowaction <> "insertdelete") { // Skip insert then deleted rows
				$this->LoadFormValues(); // Get form values
				if ($rowaction == "" || $rowaction == "edit" || $rowaction == "delete") {
					$bGridUpdate = $this->SetupKeyValues($rowkey); // Set up key values
				} else {
					$bGridUpdate = TRUE;
				}

				// Skip empty row
				if ($rowaction == "insert" && $this->EmptyRow()) {

					// No action required
				// Validate form and insert/update/delete record

				} elseif ($bGridUpdate) {
					if ($rowaction == "delete") {
						$this->CurrentFilter = $this->KeyFilter();
						$bGridUpdate = $this->DeleteRows(); // Delete this row
					} else if (!$this->ValidateForm()) {
						$bGridUpdate = FALSE; // Form error, reset action
						$this->setFailureMessage($gsFormError);
					} else {
						if ($rowaction == "insert") {
							$bGridUpdate = $this->AddRow(); // Insert this row
						} else {
							if ($rowkey <> "") {
								$this->SendEmail = FALSE; // Do not send email on update success
								$bGridUpdate = $this->EditRow(); // Update this row
							}
						} // End update
					}
				}
				if ($bGridUpdate) {
					if ($sKey <> "") $sKey .= ", ";
					$sKey .= $rowkey;
				} else {
					break;
				}
			}
		}
		if ($bGridUpdate) {
			$conn->CommitTrans(); // Commit transaction

			// Get new recordset
			if ($rs = $conn->Execute($sSql)) {
				$rsnew = $rs->GetRows();
				$rs->Close();
			}

			// Call Grid_Updated event
			$this->Grid_Updated($rsold, $rsnew);
			if ($this->AuditTrailOnEdit) $this->WriteAuditTrailDummy($Language->Phrase("BatchUpdateSuccess")); // Batch update success
			if ($this->getSuccessMessage() == "")
				$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Set up update success message
			$this->ClearInlineMode(); // Clear inline edit mode
		} else {
			$conn->RollbackTrans(); // Rollback transaction
			if ($this->AuditTrailOnEdit) $this->WriteAuditTrailDummy($Language->Phrase("BatchUpdateRollback")); // Batch update rollback
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->Phrase("UpdateFailed")); // Set update failed message
		}
		return $bGridUpdate;
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $objForm;
		$sWrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$objForm->Index = $rowindex;
		$sThisKey = strval($objForm->GetValue($this->FormKeyName));
		while ($sThisKey <> "") {
			if ($this->SetupKeyValues($sThisKey)) {
				$sFilter = $this->KeyFilter();
				if ($sWrkFilter <> "") $sWrkFilter .= " OR ";
				$sWrkFilter .= $sFilter;
			} else {
				$sWrkFilter = "0=1";
				break;
			}

			// Update row index and get row key
			$rowindex++; // Next row
			$objForm->Index = $rowindex;
			$sThisKey = strval($objForm->GetValue($this->FormKeyName));
		}
		return $sWrkFilter;
	}

	// Set up key values
	function SetupKeyValues($key) {
		$arrKeyFlds = explode($GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"], $key);
		if (count($arrKeyFlds) >= 1) {
			$this->id->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($this->id->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Check if empty row
	function EmptyRow() {
		global $objForm;
		if ($objForm->HasValue("x_siswa_id") && $objForm->HasValue("o_siswa_id") && $this->siswa_id->CurrentValue <> $this->siswa_id->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_rutin_id") && $objForm->HasValue("o_rutin_id") && $this->rutin_id->CurrentValue <> $this->rutin_id->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_Bulan") && $objForm->HasValue("o_Bulan") && $this->Bulan->CurrentValue <> $this->Bulan->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_Tahun") && $objForm->HasValue("o_Tahun") && $this->Tahun->CurrentValue <> $this->Tahun->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_Bulan2") && $objForm->HasValue("o_Bulan2") && $this->Bulan2->CurrentValue <> $this->Bulan2->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_Tahun2") && $objForm->HasValue("o_Tahun2") && $this->Tahun2->CurrentValue <> $this->Tahun2->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_Bayar_Jumlah") && $objForm->HasValue("o_Bayar_Jumlah") && $this->Bayar_Jumlah->CurrentValue <> $this->Bayar_Jumlah->OldValue)
			return FALSE;
		return TRUE;
	}

	// Validate grid form
	function ValidateGridForm() {
		global $objForm;

		// Get row count
		$objForm->Index = -1;
		$rowcnt = strval($objForm->GetValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Validate all records
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$objForm->Index = $rowindex;
			$rowaction = strval($objForm->GetValue($this->FormActionName));
			if ($rowaction <> "delete" && $rowaction <> "insertdelete") {
				$this->LoadFormValues(); // Get form values
				if ($rowaction == "insert" && $this->EmptyRow()) {

					// Ignore
				} else if (!$this->ValidateForm()) {
					return FALSE;
				}
			}
		}
		return TRUE;
	}

	// Get all form values of the grid
	function GetGridFormValues() {
		global $objForm;

		// Get row count
		$objForm->Index = -1;
		$rowcnt = strval($objForm->GetValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;
		$rows = array();

		// Loop through all records
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$objForm->Index = $rowindex;
			$rowaction = strval($objForm->GetValue($this->FormActionName));
			if ($rowaction <> "delete" && $rowaction <> "insertdelete") {
				$this->LoadFormValues(); // Get form values
				if ($rowaction == "insert" && $this->EmptyRow()) {

					// Ignore
				} else {
					$rows[] = $this->GetFieldValues("FormValue"); // Return row as array
				}
			}
		}
		return $rows; // Return as array of array
	}

	// Restore form values for current row
	function RestoreCurrentRowFormValues($idx) {
		global $objForm;

		// Get row based on current index
		$objForm->Index = $idx;
		$this->LoadFormValues(); // Load form values
	}

	// Set up sort parameters
	function SetUpSortOrder() {

		// Check for Ctrl pressed
		$bCtrl = (@$_GET["ctrl"] <> "");

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$this->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$this->CurrentOrderType = @$_GET["ordertype"];
			$this->UpdateSort($this->id, $bCtrl); // id
			$this->UpdateSort($this->siswa_id, $bCtrl); // siswa_id
			$this->UpdateSort($this->rutin_id, $bCtrl); // rutin_id
			$this->UpdateSort($this->Bulan, $bCtrl); // Bulan
			$this->UpdateSort($this->Tahun, $bCtrl); // Tahun
			$this->UpdateSort($this->Bulan2, $bCtrl); // Bulan2
			$this->UpdateSort($this->Tahun2, $bCtrl); // Tahun2
			$this->UpdateSort($this->Bayar_Jumlah, $bCtrl); // Bayar_Jumlah
			$this->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		$sOrderBy = $this->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($this->getSqlOrderBy() <> "") {
				$sOrderBy = $this->getSqlOrderBy();
				$this->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// - cmd=reset (Reset search parameters)
	// - cmd=resetall (Reset search and master/detail parameters)
	// - cmd=resetsort (Reset sort parameters)
	function ResetCmd() {

		// Check if reset command
		if (substr($this->Command,0,5) == "reset") {

			// Reset master/detail keys
			if ($this->Command == "resetall") {
				$this->setCurrentMasterTable(""); // Clear master table
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
				$this->siswa_id->setSessionValue("");
			}

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$sOrderBy = "";
				$this->setSessionOrderBy($sOrderBy);
				$this->id->setSort("");
				$this->siswa_id->setSort("");
				$this->rutin_id->setSort("");
				$this->Bulan->setSort("");
				$this->Tahun->setSort("");
				$this->Bulan2->setSort("");
				$this->Tahun2->setSort("");
				$this->Bayar_Jumlah->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language;

		// "griddelete"
		if ($this->AllowAddDeleteRow) {
			$item = &$this->ListOptions->Add("griddelete");
			$item->CssStyle = "white-space: nowrap;";
			$item->OnLeft = TRUE;
			$item->Visible = FALSE; // Default hidden
		}

		// Add group option item
		$item = &$this->ListOptions->Add($this->ListOptions->GroupOptionName);
		$item->Body = "";
		$item->OnLeft = TRUE;
		$item->Visible = FALSE;

		// "view"
		$item = &$this->ListOptions->Add("view");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanView();
		$item->OnLeft = TRUE;

		// "edit"
		$item = &$this->ListOptions->Add("edit");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanEdit();
		$item->OnLeft = TRUE;

		// List actions
		$item = &$this->ListOptions->Add("listactions");
		$item->CssStyle = "white-space: nowrap;";
		$item->OnLeft = TRUE;
		$item->Visible = FALSE;
		$item->ShowInButtonGroup = FALSE;
		$item->ShowInDropDown = FALSE;

		// "checkbox"
		$item = &$this->ListOptions->Add("checkbox");
		$item->Visible = FALSE;
		$item->OnLeft = TRUE;
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" onclick=\"ew_SelectAllKey(this);\">";
		$item->MoveTo(0);
		$item->ShowInDropDown = FALSE;
		$item->ShowInButtonGroup = FALSE;

		// "sequence"
		$item = &$this->ListOptions->Add("sequence");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = TRUE;
		$item->OnLeft = TRUE; // Always on left
		$item->ShowInDropDown = FALSE;
		$item->ShowInButtonGroup = FALSE;

		// Drop down button for ListOptions
		$this->ListOptions->UseImageAndText = TRUE;
		$this->ListOptions->UseDropDownButton = FALSE;
		$this->ListOptions->DropDownButtonPhrase = $Language->Phrase("ButtonListOptions");
		$this->ListOptions->UseButtonGroup = FALSE;
		if ($this->ListOptions->UseButtonGroup && ew_IsMobile())
			$this->ListOptions->UseDropDownButton = TRUE;
		$this->ListOptions->ButtonClass = "btn-sm"; // Class for button group

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		$this->SetupListOptionsExt();
		$item = &$this->ListOptions->GetItem($this->ListOptions->GroupOptionName);
		$item->Visible = $this->ListOptions->GroupOptionVisible();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $objForm;
		$this->ListOptions->LoadDefault();

		// Set up row action and key
		if (is_numeric($this->RowIndex) && $this->CurrentMode <> "view") {
			$objForm->Index = $this->RowIndex;
			$ActionName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormActionName);
			$OldKeyName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormOldKeyName);
			$KeyName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormKeyName);
			$BlankRowName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormBlankRowName);
			if ($this->RowAction <> "")
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $ActionName . "\" id=\"" . $ActionName . "\" value=\"" . $this->RowAction . "\">";
			if ($this->RowAction == "delete") {
				$rowkey = $objForm->GetValue($this->FormKeyName);
				$this->SetupKeyValues($rowkey);
			}
			if ($this->RowAction == "insert" && $this->CurrentAction == "F" && $this->EmptyRow())
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $BlankRowName . "\" id=\"" . $BlankRowName . "\" value=\"1\">";
		}

		// "delete"
		if ($this->AllowAddDeleteRow) {
			if ($this->CurrentAction == "gridadd" || $this->CurrentAction == "gridedit") {
				$option = &$this->ListOptions;
				$option->UseButtonGroup = TRUE; // Use button group for grid delete button
				$option->UseImageAndText = TRUE; // Use image and text for grid delete button
				$oListOpt = &$option->Items["griddelete"];
				if (is_numeric($this->RowIndex) && ($this->RowAction == "" || $this->RowAction == "edit")) { // Do not allow delete existing record
					$oListOpt->Body = "&nbsp;";
				} else {
					$oListOpt->Body = "<a class=\"ewGridLink ewGridDelete\" title=\"" . ew_HtmlTitle($Language->Phrase("DeleteLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("DeleteLink")) . "\" onclick=\"return ew_DeleteGridRow(this, " . $this->RowIndex . ");\">" . $Language->Phrase("DeleteLink") . "</a>";
				}
			}
		}

		// "sequence"
		$oListOpt = &$this->ListOptions->Items["sequence"];
		$oListOpt->Body = ew_FormatSeqNo($this->RecCnt);

		// "edit"
		$oListOpt = &$this->ListOptions->Items["edit"];
		if ($this->CurrentAction == "edit" && $this->RowType == EW_ROWTYPE_EDIT) { // Inline-Edit
			$this->ListOptions->CustomItem = "edit"; // Show edit column only
			$cancelurl = $this->AddMasterUrl($this->PageUrl() . "a=cancel");
				$oListOpt->Body = "<div" . (($oListOpt->OnLeft) ? " style=\"text-align: right\"" : "") . ">" .
					"<a class=\"ewGridLink ewInlineUpdate\" title=\"" . ew_HtmlTitle($Language->Phrase("UpdateLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("UpdateLink")) . "\" href=\"\" onclick=\"return ewForms(this).Submit('" . ew_GetHashUrl($this->PageName(), $this->PageObjName . "_row_" . $this->RowCnt) . "');\">" . $Language->Phrase("UpdateLink") . "</a>&nbsp;" .
					"<a class=\"ewGridLink ewInlineCancel\" title=\"" . ew_HtmlTitle($Language->Phrase("CancelLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("CancelLink")) . "\" href=\"" . $cancelurl . "\">" . $Language->Phrase("CancelLink") . "</a>" .
					"<input type=\"hidden\" name=\"a_list\" id=\"a_list\" value=\"update\"></div>";
			$oListOpt->Body .= "<input type=\"hidden\" name=\"k" . $this->RowIndex . "_key\" id=\"k" . $this->RowIndex . "_key\" value=\"" . ew_HtmlEncode($this->id->CurrentValue) . "\">";
			return;
		}

		// "view"
		$oListOpt = &$this->ListOptions->Items["view"];
		$viewcaption = ew_HtmlTitle($Language->Phrase("ViewLink"));
		if ($Security->CanView()) {
			$oListOpt->Body = "<a class=\"ewRowLink ewView\" title=\"" . $viewcaption . "\" data-caption=\"" . $viewcaption . "\" href=\"" . ew_HtmlEncode($this->ViewUrl) . "\">" . $Language->Phrase("ViewLink") . "</a>";
		} else {
			$oListOpt->Body = "";
		}

		// "edit"
		$oListOpt = &$this->ListOptions->Items["edit"];
		$editcaption = ew_HtmlTitle($Language->Phrase("EditLink"));
		if ($Security->CanEdit()) {
			$oListOpt->Body = "<a class=\"ewRowLink ewEdit\" title=\"" . ew_HtmlTitle($Language->Phrase("EditLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("EditLink")) . "\" href=\"" . ew_HtmlEncode($this->EditUrl) . "\">" . $Language->Phrase("EditLink") . "</a>";
			$oListOpt->Body .= "<a class=\"ewRowLink ewInlineEdit\" title=\"" . ew_HtmlTitle($Language->Phrase("InlineEditLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("InlineEditLink")) . "\" href=\"" . ew_HtmlEncode(ew_GetHashUrl($this->InlineEditUrl, $this->PageObjName . "_row_" . $this->RowCnt)) . "\">" . $Language->Phrase("InlineEditLink") . "</a>";
		} else {
			$oListOpt->Body = "";
		}

		// Set up list action buttons
		$oListOpt = &$this->ListOptions->GetItem("listactions");
		if ($oListOpt && $this->Export == "" && $this->CurrentAction == "") {
			$body = "";
			$links = array();
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == EW_ACTION_SINGLE && $listaction->Allow) {
					$action = $listaction->Action;
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon <> "") ? "<span class=\"" . ew_HtmlEncode(str_replace(" ewIcon", "", $listaction->Icon)) . "\" data-caption=\"" . ew_HtmlTitle($caption) . "\"></span> " : "";
					$links[] = "<li><a class=\"ewAction ewListAction\" data-action=\"" . ew_HtmlEncode($action) . "\" data-caption=\"" . ew_HtmlTitle($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({key:" . $this->KeyToJson() . "}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . $listaction->Caption . "</a></li>";
					if (count($links) == 1) // Single button
						$body = "<a class=\"ewAction ewListAction\" data-action=\"" . ew_HtmlEncode($action) . "\" title=\"" . ew_HtmlTitle($caption) . "\" data-caption=\"" . ew_HtmlTitle($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({key:" . $this->KeyToJson() . "}," . $listaction->ToJson(TRUE) . "));return false;\">" . $Language->Phrase("ListActionButton") . "</a>";
				}
			}
			if (count($links) > 1) { // More than one buttons, use dropdown
				$body = "<button class=\"dropdown-toggle btn btn-default btn-sm ewActions\" title=\"" . ew_HtmlTitle($Language->Phrase("ListActionButton")) . "\" data-toggle=\"dropdown\">" . $Language->Phrase("ListActionButton") . "<b class=\"caret\"></b></button>";
				$content = "";
				foreach ($links as $link)
					$content .= "<li>" . $link . "</li>";
				$body .= "<ul class=\"dropdown-menu" . ($oListOpt->OnLeft ? "" : " dropdown-menu-right") . "\">". $content . "</ul>";
				$body = "<div class=\"btn-group\">" . $body . "</div>";
			}
			if (count($links) > 0) {
				$oListOpt->Body = $body;
				$oListOpt->Visible = TRUE;
			}
		}

		// "checkbox"
		$oListOpt = &$this->ListOptions->Items["checkbox"];
		$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" value=\"" . ew_HtmlEncode($this->id->CurrentValue) . "\" onclick='ew_ClickMultiCheckbox(event);'>";
		if ($this->CurrentAction == "gridedit" && is_numeric($this->RowIndex)) {
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $KeyName . "\" id=\"" . $KeyName . "\" value=\"" . $this->id->CurrentValue . "\">";
		}
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set up other options
	function SetupOtherOptions() {
		global $Language, $Security;
		$options = &$this->OtherOptions;

		// Add grid edit
		$option = $options["addedit"];
		$item = &$option->Add("gridedit");
		$item->Body = "<a class=\"ewAddEdit ewGridEdit\" title=\"" . ew_HtmlTitle($Language->Phrase("GridEditLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("GridEditLink")) . "\" href=\"" . ew_HtmlEncode($this->GridEditUrl) . "\">" . $Language->Phrase("GridEditLink") . "</a>";
		$item->Visible = ($this->GridEditUrl <> "" && $Security->CanEdit());
		$option = $options["action"];

		// Set up options default
		foreach ($options as &$option) {
			$option->UseImageAndText = TRUE;
			$option->UseDropDownButton = FALSE;
			$option->UseButtonGroup = TRUE;
			$option->ButtonClass = "btn-sm"; // Class for button group
			$item = &$option->Add($option->GroupOptionName);
			$item->Body = "";
			$item->Visible = FALSE;
		}
		$options["addedit"]->DropDownButtonPhrase = $Language->Phrase("ButtonAddEdit");
		$options["detail"]->DropDownButtonPhrase = $Language->Phrase("ButtonDetails");
		$options["action"]->DropDownButtonPhrase = $Language->Phrase("ButtonActions");

		// Filter button
		$item = &$this->FilterOptions->Add("savecurrentfilter");
		$item->Body = "<a class=\"ewSaveFilter\" data-form=\"ft06_siswarutinbayar_2listsrch\" href=\"#\">" . $Language->Phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = FALSE;
		$item = &$this->FilterOptions->Add("deletefilter");
		$item->Body = "<a class=\"ewDeleteFilter\" data-form=\"ft06_siswarutinbayar_2listsrch\" href=\"#\">" . $Language->Phrase("DeleteFilter") . "</a>";
		$item->Visible = FALSE;
		$this->FilterOptions->UseDropDownButton = TRUE;
		$this->FilterOptions->UseButtonGroup = !$this->FilterOptions->UseDropDownButton;
		$this->FilterOptions->DropDownButtonPhrase = $Language->Phrase("Filters");

		// Add group option item
		$item = &$this->FilterOptions->Add($this->FilterOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

	// Render other options
	function RenderOtherOptions() {
		global $Language, $Security;
		$options = &$this->OtherOptions;
		if ($this->CurrentAction <> "gridadd" && $this->CurrentAction <> "gridedit") { // Not grid add/edit mode
			$option = &$options["action"];

			// Set up list action buttons
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == EW_ACTION_MULTIPLE) {
					$item = &$option->Add("custom_" . $listaction->Action);
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon <> "") ? "<span class=\"" . ew_HtmlEncode($listaction->Icon) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\"></span> " : $caption;
					$item->Body = "<a class=\"ewAction ewListAction\" title=\"" . ew_HtmlEncode($caption) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({f:document.ft06_siswarutinbayar_2list}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . "</a>";
					$item->Visible = $listaction->Allow;
				}
			}

			// Hide grid edit and other options
			if ($this->TotalRecs <= 0) {
				$option = &$options["addedit"];
				$item = &$option->GetItem("gridedit");
				if ($item) $item->Visible = FALSE;
				$option = &$options["action"];
				$option->HideAllOptions();
			}
		} else { // Grid add/edit mode

			// Hide all options first
			foreach ($options as &$option)
				$option->HideAllOptions();
			if ($this->CurrentAction == "gridedit") {
				if ($this->AllowAddDeleteRow) {

					// Add add blank row
					$option = &$options["addedit"];
					$option->UseDropDownButton = FALSE;
					$option->UseImageAndText = TRUE;
					$item = &$option->Add("addblankrow");
					$item->Body = "<a class=\"ewAddEdit ewAddBlankRow\" title=\"" . ew_HtmlTitle($Language->Phrase("AddBlankRow")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("AddBlankRow")) . "\" href=\"javascript:void(0);\" onclick=\"ew_AddGridRow(this);\">" . $Language->Phrase("AddBlankRow") . "</a>";
					$item->Visible = FALSE;
				}
				$option = &$options["action"];
				$option->UseDropDownButton = FALSE;
				$option->UseImageAndText = TRUE;
					$item = &$option->Add("gridsave");
					$item->Body = "<a class=\"ewAction ewGridSave\" title=\"" . ew_HtmlTitle($Language->Phrase("GridSaveLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("GridSaveLink")) . "\" href=\"\" onclick=\"return ewForms(this).Submit('" . $this->PageName() . "');\">" . $Language->Phrase("GridSaveLink") . "</a>";
					$item = &$option->Add("gridcancel");
					$cancelurl = $this->AddMasterUrl($this->PageUrl() . "a=cancel");
					$item->Body = "<a class=\"ewAction ewGridCancel\" title=\"" . ew_HtmlTitle($Language->Phrase("GridCancelLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("GridCancelLink")) . "\" href=\"" . $cancelurl . "\">" . $Language->Phrase("GridCancelLink") . "</a>";
			}
		}
	}

	// Process list action
	function ProcessListAction() {
		global $Language, $Security;
		$userlist = "";
		$user = "";
		$sFilter = $this->GetKeyFilter();
		$UserAction = @$_POST["useraction"];
		if ($sFilter <> "" && $UserAction <> "") {

			// Check permission first
			$ActionCaption = $UserAction;
			if (array_key_exists($UserAction, $this->ListActions->Items)) {
				$ActionCaption = $this->ListActions->Items[$UserAction]->Caption;
				if (!$this->ListActions->Items[$UserAction]->Allow) {
					$errmsg = str_replace('%s', $ActionCaption, $Language->Phrase("CustomActionNotAllowed"));
					if (@$_POST["ajax"] == $UserAction) // Ajax
						echo "<p class=\"text-danger\">" . $errmsg . "</p>";
					else
						$this->setFailureMessage($errmsg);
					return FALSE;
				}
			}
			$this->CurrentFilter = $sFilter;
			$sSql = $this->SQL();
			$conn = &$this->Connection();
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			$rs = $conn->Execute($sSql);
			$conn->raiseErrorFn = '';
			$this->CurrentAction = $UserAction;

			// Call row action event
			if ($rs && !$rs->EOF) {
				$conn->BeginTrans();
				$this->SelectedCount = $rs->RecordCount();
				$this->SelectedIndex = 0;
				while (!$rs->EOF) {
					$this->SelectedIndex++;
					$row = $rs->fields;
					$Processed = $this->Row_CustomAction($UserAction, $row);
					if (!$Processed) break;
					$rs->MoveNext();
				}
				if ($Processed) {
					$conn->CommitTrans(); // Commit the changes
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage(str_replace('%s', $ActionCaption, $Language->Phrase("CustomActionCompleted"))); // Set up success message
				} else {
					$conn->RollbackTrans(); // Rollback changes

					// Set up error message
					if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

						// Use the message, do nothing
					} elseif ($this->CancelMessage <> "") {
						$this->setFailureMessage($this->CancelMessage);
						$this->CancelMessage = "";
					} else {
						$this->setFailureMessage(str_replace('%s', $ActionCaption, $Language->Phrase("CustomActionFailed")));
					}
				}
			}
			if ($rs)
				$rs->Close();
			$this->CurrentAction = ""; // Clear action
			if (@$_POST["ajax"] == $UserAction) { // Ajax
				if ($this->getSuccessMessage() <> "") {
					echo "<p class=\"text-success\">" . $this->getSuccessMessage() . "</p>";
					$this->ClearSuccessMessage(); // Clear message
				}
				if ($this->getFailureMessage() <> "") {
					echo "<p class=\"text-danger\">" . $this->getFailureMessage() . "</p>";
					$this->ClearFailureMessage(); // Clear message
				}
				return TRUE;
			}
		}
		return FALSE; // Not ajax request
	}

	// Set up search options
	function SetupSearchOptions() {
		global $Language;
		$this->SearchOptions = new cListOptions();
		$this->SearchOptions->Tag = "div";
		$this->SearchOptions->TagClassName = "ewSearchOption";

		// Button group for search
		$this->SearchOptions->UseDropDownButton = FALSE;
		$this->SearchOptions->UseImageAndText = TRUE;
		$this->SearchOptions->UseButtonGroup = TRUE;
		$this->SearchOptions->DropDownButtonPhrase = $Language->Phrase("ButtonSearch");

		// Add group option item
		$item = &$this->SearchOptions->Add($this->SearchOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Hide search options
		if ($this->Export <> "" || $this->CurrentAction <> "")
			$this->SearchOptions->HideAllOptions();
		global $Security;
		if (!$Security->CanSearch()) {
			$this->SearchOptions->HideAllOptions();
			$this->FilterOptions->HideAllOptions();
		}
	}

	function SetupListOptionsExt() {
		global $Security, $Language;
	}

	function RenderListOptionsExt() {
		global $Security, $Language;
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

	// Load default values
	function LoadDefaultValues() {
		$this->id->CurrentValue = NULL;
		$this->id->OldValue = $this->id->CurrentValue;
		$this->siswa_id->CurrentValue = NULL;
		$this->siswa_id->OldValue = $this->siswa_id->CurrentValue;
		$this->rutin_id->CurrentValue = NULL;
		$this->rutin_id->OldValue = $this->rutin_id->CurrentValue;
		$this->Bulan->CurrentValue = NULL;
		$this->Bulan->OldValue = $this->Bulan->CurrentValue;
		$this->Tahun->CurrentValue = NULL;
		$this->Tahun->OldValue = $this->Tahun->CurrentValue;
		$this->Bulan2->CurrentValue = NULL;
		$this->Bulan2->OldValue = $this->Bulan2->CurrentValue;
		$this->Tahun2->CurrentValue = NULL;
		$this->Tahun2->OldValue = $this->Tahun2->CurrentValue;
		$this->Bayar_Jumlah->CurrentValue = 0.00;
		$this->Bayar_Jumlah->OldValue = $this->Bayar_Jumlah->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->id->FldIsDetailKey && $this->CurrentAction <> "gridadd" && $this->CurrentAction <> "add")
			$this->id->setFormValue($objForm->GetValue("x_id"));
		if (!$this->siswa_id->FldIsDetailKey) {
			$this->siswa_id->setFormValue($objForm->GetValue("x_siswa_id"));
		}
		if (!$this->rutin_id->FldIsDetailKey) {
			$this->rutin_id->setFormValue($objForm->GetValue("x_rutin_id"));
		}
		if (!$this->Bulan->FldIsDetailKey) {
			$this->Bulan->setFormValue($objForm->GetValue("x_Bulan"));
		}
		if (!$this->Tahun->FldIsDetailKey) {
			$this->Tahun->setFormValue($objForm->GetValue("x_Tahun"));
		}
		if (!$this->Bulan2->FldIsDetailKey) {
			$this->Bulan2->setFormValue($objForm->GetValue("x_Bulan2"));
		}
		if (!$this->Tahun2->FldIsDetailKey) {
			$this->Tahun2->setFormValue($objForm->GetValue("x_Tahun2"));
		}
		if (!$this->Bayar_Jumlah->FldIsDetailKey) {
			$this->Bayar_Jumlah->setFormValue($objForm->GetValue("x_Bayar_Jumlah"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		if ($this->CurrentAction <> "gridadd" && $this->CurrentAction <> "add")
			$this->id->CurrentValue = $this->id->FormValue;
		$this->siswa_id->CurrentValue = $this->siswa_id->FormValue;
		$this->rutin_id->CurrentValue = $this->rutin_id->FormValue;
		$this->Bulan->CurrentValue = $this->Bulan->FormValue;
		$this->Tahun->CurrentValue = $this->Tahun->FormValue;
		$this->Bulan2->CurrentValue = $this->Bulan2->FormValue;
		$this->Tahun2->CurrentValue = $this->Tahun2->FormValue;
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
		$this->rutin_id->setDbValue($rs->fields('rutin_id'));
		$this->Bulan->setDbValue($rs->fields('Bulan'));
		$this->Tahun->setDbValue($rs->fields('Tahun'));
		$this->Bulan2->setDbValue($rs->fields('Bulan2'));
		$this->Tahun2->setDbValue($rs->fields('Tahun2'));
		$this->Bayar_Tgl->setDbValue($rs->fields('Bayar_Tgl'));
		$this->Bayar_Jumlah->setDbValue($rs->fields('Bayar_Jumlah'));
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->siswa_id->DbValue = $row['siswa_id'];
		$this->rutin_id->DbValue = $row['rutin_id'];
		$this->Bulan->DbValue = $row['Bulan'];
		$this->Tahun->DbValue = $row['Tahun'];
		$this->Bulan2->DbValue = $row['Bulan2'];
		$this->Tahun2->DbValue = $row['Tahun2'];
		$this->Bayar_Tgl->DbValue = $row['Bayar_Tgl'];
		$this->Bayar_Jumlah->DbValue = $row['Bayar_Jumlah'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("id")) <> "")
			$this->id->CurrentValue = $this->getKey("id"); // id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$this->CurrentFilter = $this->KeyFilter();
			$sSql = $this->SQL();
			$conn = &$this->Connection();
			$this->OldRecordset = ew_LoadRecordset($sSql, $conn);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		$this->ViewUrl = $this->GetViewUrl();
		$this->EditUrl = $this->GetEditUrl();
		$this->InlineEditUrl = $this->GetInlineEditUrl();
		$this->CopyUrl = $this->GetCopyUrl();
		$this->InlineCopyUrl = $this->GetInlineCopyUrl();
		$this->DeleteUrl = $this->GetDeleteUrl();

		// Convert decimal values if posted back
		if ($this->Bayar_Jumlah->FormValue == $this->Bayar_Jumlah->CurrentValue && is_numeric(ew_StrToFloat($this->Bayar_Jumlah->CurrentValue)))
			$this->Bayar_Jumlah->CurrentValue = ew_StrToFloat($this->Bayar_Jumlah->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// id
		// siswa_id
		// rutin_id
		// Bulan
		// Tahun
		// Bulan2
		// Tahun2
		// Bayar_Tgl
		// Bayar_Jumlah

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// siswa_id
		$this->siswa_id->ViewValue = $this->siswa_id->CurrentValue;
		$this->siswa_id->ViewCustomAttributes = "";

		// rutin_id
		$this->rutin_id->ViewValue = $this->rutin_id->CurrentValue;
		$this->rutin_id->ViewCustomAttributes = "";

		// Bulan
		$this->Bulan->ViewValue = $this->Bulan->CurrentValue;
		$this->Bulan->ViewCustomAttributes = "";

		// Tahun
		$this->Tahun->ViewValue = $this->Tahun->CurrentValue;
		$this->Tahun->ViewCustomAttributes = "";

		// Bulan2
		$this->Bulan2->ViewValue = $this->Bulan2->CurrentValue;
		$this->Bulan2->ViewCustomAttributes = "";

		// Tahun2
		$this->Tahun2->ViewValue = $this->Tahun2->CurrentValue;
		$this->Tahun2->ViewCustomAttributes = "";

		// Bayar_Tgl
		$this->Bayar_Tgl->ViewValue = $this->Bayar_Tgl->CurrentValue;
		$this->Bayar_Tgl->ViewValue = ew_FormatDateTime($this->Bayar_Tgl->ViewValue, 0);
		$this->Bayar_Tgl->ViewCustomAttributes = "";

		// Bayar_Jumlah
		$this->Bayar_Jumlah->ViewValue = $this->Bayar_Jumlah->CurrentValue;
		$this->Bayar_Jumlah->ViewCustomAttributes = "";

			// id
			$this->id->LinkCustomAttributes = "";
			$this->id->HrefValue = "";
			$this->id->TooltipValue = "";

			// siswa_id
			$this->siswa_id->LinkCustomAttributes = "";
			$this->siswa_id->HrefValue = "";
			$this->siswa_id->TooltipValue = "";

			// rutin_id
			$this->rutin_id->LinkCustomAttributes = "";
			$this->rutin_id->HrefValue = "";
			$this->rutin_id->TooltipValue = "";

			// Bulan
			$this->Bulan->LinkCustomAttributes = "";
			$this->Bulan->HrefValue = "";
			$this->Bulan->TooltipValue = "";

			// Tahun
			$this->Tahun->LinkCustomAttributes = "";
			$this->Tahun->HrefValue = "";
			$this->Tahun->TooltipValue = "";

			// Bulan2
			$this->Bulan2->LinkCustomAttributes = "";
			$this->Bulan2->HrefValue = "";
			$this->Bulan2->TooltipValue = "";

			// Tahun2
			$this->Tahun2->LinkCustomAttributes = "";
			$this->Tahun2->HrefValue = "";
			$this->Tahun2->TooltipValue = "";

			// Bayar_Jumlah
			$this->Bayar_Jumlah->LinkCustomAttributes = "";
			$this->Bayar_Jumlah->HrefValue = "";
			$this->Bayar_Jumlah->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// id
			// siswa_id

			$this->siswa_id->EditAttrs["class"] = "form-control";
			$this->siswa_id->EditCustomAttributes = "";
			if ($this->siswa_id->getSessionValue() <> "") {
				$this->siswa_id->CurrentValue = $this->siswa_id->getSessionValue();
			$this->siswa_id->ViewValue = $this->siswa_id->CurrentValue;
			$this->siswa_id->ViewCustomAttributes = "";
			} else {
			$this->siswa_id->EditValue = ew_HtmlEncode($this->siswa_id->CurrentValue);
			$this->siswa_id->PlaceHolder = ew_RemoveHtml($this->siswa_id->FldCaption());
			}

			// rutin_id
			$this->rutin_id->EditAttrs["class"] = "form-control";
			$this->rutin_id->EditCustomAttributes = "";
			$this->rutin_id->EditValue = ew_HtmlEncode($this->rutin_id->CurrentValue);
			$this->rutin_id->PlaceHolder = ew_RemoveHtml($this->rutin_id->FldCaption());

			// Bulan
			$this->Bulan->EditAttrs["class"] = "form-control";
			$this->Bulan->EditCustomAttributes = "";
			$this->Bulan->EditValue = ew_HtmlEncode($this->Bulan->CurrentValue);
			$this->Bulan->PlaceHolder = ew_RemoveHtml($this->Bulan->FldCaption());

			// Tahun
			$this->Tahun->EditAttrs["class"] = "form-control";
			$this->Tahun->EditCustomAttributes = "";
			$this->Tahun->EditValue = ew_HtmlEncode($this->Tahun->CurrentValue);
			$this->Tahun->PlaceHolder = ew_RemoveHtml($this->Tahun->FldCaption());

			// Bulan2
			$this->Bulan2->EditAttrs["class"] = "form-control";
			$this->Bulan2->EditCustomAttributes = "";
			$this->Bulan2->EditValue = ew_HtmlEncode($this->Bulan2->CurrentValue);
			$this->Bulan2->PlaceHolder = ew_RemoveHtml($this->Bulan2->FldCaption());

			// Tahun2
			$this->Tahun2->EditAttrs["class"] = "form-control";
			$this->Tahun2->EditCustomAttributes = "";
			$this->Tahun2->EditValue = ew_HtmlEncode($this->Tahun2->CurrentValue);
			$this->Tahun2->PlaceHolder = ew_RemoveHtml($this->Tahun2->FldCaption());

			// Bayar_Jumlah
			$this->Bayar_Jumlah->EditAttrs["class"] = "form-control";
			$this->Bayar_Jumlah->EditCustomAttributes = "";
			$this->Bayar_Jumlah->EditValue = ew_HtmlEncode($this->Bayar_Jumlah->CurrentValue);
			$this->Bayar_Jumlah->PlaceHolder = ew_RemoveHtml($this->Bayar_Jumlah->FldCaption());
			if (strval($this->Bayar_Jumlah->EditValue) <> "" && is_numeric($this->Bayar_Jumlah->EditValue)) $this->Bayar_Jumlah->EditValue = ew_FormatNumber($this->Bayar_Jumlah->EditValue, -2, -1, -2, 0);

			// Add refer script
			// id

			$this->id->LinkCustomAttributes = "";
			$this->id->HrefValue = "";

			// siswa_id
			$this->siswa_id->LinkCustomAttributes = "";
			$this->siswa_id->HrefValue = "";

			// rutin_id
			$this->rutin_id->LinkCustomAttributes = "";
			$this->rutin_id->HrefValue = "";

			// Bulan
			$this->Bulan->LinkCustomAttributes = "";
			$this->Bulan->HrefValue = "";

			// Tahun
			$this->Tahun->LinkCustomAttributes = "";
			$this->Tahun->HrefValue = "";

			// Bulan2
			$this->Bulan2->LinkCustomAttributes = "";
			$this->Bulan2->HrefValue = "";

			// Tahun2
			$this->Tahun2->LinkCustomAttributes = "";
			$this->Tahun2->HrefValue = "";

			// Bayar_Jumlah
			$this->Bayar_Jumlah->LinkCustomAttributes = "";
			$this->Bayar_Jumlah->HrefValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$this->id->EditAttrs["class"] = "form-control";
			$this->id->EditCustomAttributes = "";
			$this->id->EditValue = $this->id->CurrentValue;
			$this->id->ViewCustomAttributes = "";

			// siswa_id
			$this->siswa_id->EditAttrs["class"] = "form-control";
			$this->siswa_id->EditCustomAttributes = "";
			if ($this->siswa_id->getSessionValue() <> "") {
				$this->siswa_id->CurrentValue = $this->siswa_id->getSessionValue();
			$this->siswa_id->ViewValue = $this->siswa_id->CurrentValue;
			$this->siswa_id->ViewCustomAttributes = "";
			} else {
			$this->siswa_id->EditValue = ew_HtmlEncode($this->siswa_id->CurrentValue);
			$this->siswa_id->PlaceHolder = ew_RemoveHtml($this->siswa_id->FldCaption());
			}

			// rutin_id
			$this->rutin_id->EditAttrs["class"] = "form-control";
			$this->rutin_id->EditCustomAttributes = "";
			$this->rutin_id->EditValue = ew_HtmlEncode($this->rutin_id->CurrentValue);
			$this->rutin_id->PlaceHolder = ew_RemoveHtml($this->rutin_id->FldCaption());

			// Bulan
			$this->Bulan->EditAttrs["class"] = "form-control";
			$this->Bulan->EditCustomAttributes = "";
			$this->Bulan->EditValue = ew_HtmlEncode($this->Bulan->CurrentValue);
			$this->Bulan->PlaceHolder = ew_RemoveHtml($this->Bulan->FldCaption());

			// Tahun
			$this->Tahun->EditAttrs["class"] = "form-control";
			$this->Tahun->EditCustomAttributes = "";
			$this->Tahun->EditValue = ew_HtmlEncode($this->Tahun->CurrentValue);
			$this->Tahun->PlaceHolder = ew_RemoveHtml($this->Tahun->FldCaption());

			// Bulan2
			$this->Bulan2->EditAttrs["class"] = "form-control";
			$this->Bulan2->EditCustomAttributes = "";
			$this->Bulan2->EditValue = ew_HtmlEncode($this->Bulan2->CurrentValue);
			$this->Bulan2->PlaceHolder = ew_RemoveHtml($this->Bulan2->FldCaption());

			// Tahun2
			$this->Tahun2->EditAttrs["class"] = "form-control";
			$this->Tahun2->EditCustomAttributes = "";
			$this->Tahun2->EditValue = ew_HtmlEncode($this->Tahun2->CurrentValue);
			$this->Tahun2->PlaceHolder = ew_RemoveHtml($this->Tahun2->FldCaption());

			// Bayar_Jumlah
			$this->Bayar_Jumlah->EditAttrs["class"] = "form-control";
			$this->Bayar_Jumlah->EditCustomAttributes = "";
			$this->Bayar_Jumlah->EditValue = ew_HtmlEncode($this->Bayar_Jumlah->CurrentValue);
			$this->Bayar_Jumlah->PlaceHolder = ew_RemoveHtml($this->Bayar_Jumlah->FldCaption());
			if (strval($this->Bayar_Jumlah->EditValue) <> "" && is_numeric($this->Bayar_Jumlah->EditValue)) $this->Bayar_Jumlah->EditValue = ew_FormatNumber($this->Bayar_Jumlah->EditValue, -2, -1, -2, 0);

			// Edit refer script
			// id

			$this->id->LinkCustomAttributes = "";
			$this->id->HrefValue = "";

			// siswa_id
			$this->siswa_id->LinkCustomAttributes = "";
			$this->siswa_id->HrefValue = "";

			// rutin_id
			$this->rutin_id->LinkCustomAttributes = "";
			$this->rutin_id->HrefValue = "";

			// Bulan
			$this->Bulan->LinkCustomAttributes = "";
			$this->Bulan->HrefValue = "";

			// Tahun
			$this->Tahun->LinkCustomAttributes = "";
			$this->Tahun->HrefValue = "";

			// Bulan2
			$this->Bulan2->LinkCustomAttributes = "";
			$this->Bulan2->HrefValue = "";

			// Tahun2
			$this->Tahun2->LinkCustomAttributes = "";
			$this->Tahun2->HrefValue = "";

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
		if (!$this->siswa_id->FldIsDetailKey && !is_null($this->siswa_id->FormValue) && $this->siswa_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->siswa_id->FldCaption(), $this->siswa_id->ReqErrMsg));
		}
		if (!ew_CheckInteger($this->siswa_id->FormValue)) {
			ew_AddMessage($gsFormError, $this->siswa_id->FldErrMsg());
		}
		if (!$this->rutin_id->FldIsDetailKey && !is_null($this->rutin_id->FormValue) && $this->rutin_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->rutin_id->FldCaption(), $this->rutin_id->ReqErrMsg));
		}
		if (!ew_CheckInteger($this->rutin_id->FormValue)) {
			ew_AddMessage($gsFormError, $this->rutin_id->FldErrMsg());
		}
		if (!$this->Bulan->FldIsDetailKey && !is_null($this->Bulan->FormValue) && $this->Bulan->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Bulan->FldCaption(), $this->Bulan->ReqErrMsg));
		}
		if (!ew_CheckInteger($this->Bulan->FormValue)) {
			ew_AddMessage($gsFormError, $this->Bulan->FldErrMsg());
		}
		if (!$this->Tahun->FldIsDetailKey && !is_null($this->Tahun->FormValue) && $this->Tahun->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Tahun->FldCaption(), $this->Tahun->ReqErrMsg));
		}
		if (!ew_CheckInteger($this->Tahun->FormValue)) {
			ew_AddMessage($gsFormError, $this->Tahun->FldErrMsg());
		}
		if (!$this->Bulan2->FldIsDetailKey && !is_null($this->Bulan2->FormValue) && $this->Bulan2->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Bulan2->FldCaption(), $this->Bulan2->ReqErrMsg));
		}
		if (!ew_CheckInteger($this->Bulan2->FormValue)) {
			ew_AddMessage($gsFormError, $this->Bulan2->FldErrMsg());
		}
		if (!$this->Tahun2->FldIsDetailKey && !is_null($this->Tahun2->FormValue) && $this->Tahun2->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Tahun2->FldCaption(), $this->Tahun2->ReqErrMsg));
		}
		if (!ew_CheckInteger($this->Tahun2->FormValue)) {
			ew_AddMessage($gsFormError, $this->Tahun2->FldErrMsg());
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

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $Language, $Security;
		if (!$Security->CanDelete()) {
			$this->setFailureMessage($Language->Phrase("NoDeletePermission")); // No delete permission
			return FALSE;
		}
		$DeleteRows = TRUE;
		$sSql = $this->SQL();
		$conn = &$this->Connection();
		$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
			$rs->Close();
			return FALSE;

		//} else {
		//	$this->LoadRowValues($rs); // Load row values

		}
		$rows = ($rs) ? $rs->GetRows() : array();
		if ($this->AuditTrailOnDelete) $this->WriteAuditTrailDummy($Language->Phrase("BatchDeleteBegin")); // Batch delete begin

		// Clone old rows
		$rsold = $rows;
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $this->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
				$sThisKey .= $row['id'];
				$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
				$DeleteRows = $this->Delete($row); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
			if ($this->AuditTrailOnDelete) $this->WriteAuditTrailDummy($Language->Phrase("BatchDeleteSuccess")); // Batch delete success
		} else {
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$this->Row_Deleted($row);
			}
		}
		return $DeleteRows;
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

			// siswa_id
			$this->siswa_id->SetDbValueDef($rsnew, $this->siswa_id->CurrentValue, 0, $this->siswa_id->ReadOnly);

			// rutin_id
			$this->rutin_id->SetDbValueDef($rsnew, $this->rutin_id->CurrentValue, 0, $this->rutin_id->ReadOnly);

			// Bulan
			$this->Bulan->SetDbValueDef($rsnew, $this->Bulan->CurrentValue, 0, $this->Bulan->ReadOnly);

			// Tahun
			$this->Tahun->SetDbValueDef($rsnew, $this->Tahun->CurrentValue, 0, $this->Tahun->ReadOnly);

			// Bulan2
			$this->Bulan2->SetDbValueDef($rsnew, $this->Bulan2->CurrentValue, 0, $this->Bulan2->ReadOnly);

			// Tahun2
			$this->Tahun2->SetDbValueDef($rsnew, $this->Tahun2->CurrentValue, 0, $this->Tahun2->ReadOnly);

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

	// Add record
	function AddRow($rsold = NULL) {
		global $Language, $Security;

		// Check referential integrity for master table 't03_siswa'
		$bValidMasterRecord = TRUE;
		$sMasterFilter = $this->SqlMasterFilter_t03_siswa();
		if (strval($this->siswa_id->CurrentValue) <> "") {
			$sMasterFilter = str_replace("@id@", ew_AdjustSql($this->siswa_id->CurrentValue, "DB"), $sMasterFilter);
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
			return FALSE;
		}
		$conn = &$this->Connection();

		// Load db values from rsold
		if ($rsold) {
			$this->LoadDbValues($rsold);
		}
		$rsnew = array();

		// siswa_id
		$this->siswa_id->SetDbValueDef($rsnew, $this->siswa_id->CurrentValue, 0, FALSE);

		// rutin_id
		$this->rutin_id->SetDbValueDef($rsnew, $this->rutin_id->CurrentValue, 0, FALSE);

		// Bulan
		$this->Bulan->SetDbValueDef($rsnew, $this->Bulan->CurrentValue, 0, FALSE);

		// Tahun
		$this->Tahun->SetDbValueDef($rsnew, $this->Tahun->CurrentValue, 0, FALSE);

		// Bulan2
		$this->Bulan2->SetDbValueDef($rsnew, $this->Bulan2->CurrentValue, 0, FALSE);

		// Tahun2
		$this->Tahun2->SetDbValueDef($rsnew, $this->Tahun2->CurrentValue, 0, FALSE);

		// Bayar_Jumlah
		$this->Bayar_Jumlah->SetDbValueDef($rsnew, $this->Bayar_Jumlah->CurrentValue, NULL, strval($this->Bayar_Jumlah->CurrentValue) == "");

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $this->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			$AddRow = $this->Insert($rsnew);
			$conn->raiseErrorFn = '';
			if ($AddRow) {
			}
		} else {
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$this->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
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

			// Update URL
			$this->AddUrl = $this->AddMasterUrl($this->AddUrl);
			$this->InlineAddUrl = $this->AddMasterUrl($this->InlineAddUrl);
			$this->GridAddUrl = $this->AddMasterUrl($this->GridAddUrl);
			$this->GridEditUrl = $this->AddMasterUrl($this->GridEditUrl);

			// Save current master table
			$this->setCurrentMasterTable($sMasterTblVar);

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
		$url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
		$Breadcrumb->Add("list", $this->TableVar, $url, "", $this->TableVar, TRUE);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
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

	// ListOptions Load event
	function ListOptions_Load() {

		// Example:
		//$opt = &$this->ListOptions->Add("new");
		//$opt->Header = "xxx";
		//$opt->OnLeft = TRUE; // Link on left
		//$opt->MoveTo(0); // Move to first column

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example: 
		//$this->ListOptions->Items["new"]->Body = "xxx";

	}

	// Row Custom Action event
	function Row_CustomAction($action, $row) {

		// Return FALSE to abort
		return TRUE;
	}

	// Page Exporting event
	// $this->ExportDoc = export document object
	function Page_Exporting() {

		//$this->ExportDoc->Text = "my header"; // Export header
		//return FALSE; // Return FALSE to skip default export and use Row_Export event

		return TRUE; // Return TRUE to use default export and skip Row_Export event
	}

	// Row Export event
	// $this->ExportDoc = export document object
	function Row_Export($rs) {

		//$this->ExportDoc->Text .= "my content"; // Build HTML with field value: $rs["MyField"] or $this->MyField->ViewValue
	}

	// Page Exported event
	// $this->ExportDoc = export document object
	function Page_Exported() {

		//$this->ExportDoc->Text .= "my footer"; // Export footer
		//echo $this->ExportDoc->Text;

	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($t06_siswarutinbayar_2_list)) $t06_siswarutinbayar_2_list = new ct06_siswarutinbayar_2_list();

// Page init
$t06_siswarutinbayar_2_list->Page_Init();

// Page main
$t06_siswarutinbayar_2_list->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t06_siswarutinbayar_2_list->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "list";
var CurrentForm = ft06_siswarutinbayar_2list = new ew_Form("ft06_siswarutinbayar_2list", "list");
ft06_siswarutinbayar_2list.FormKeyCountName = '<?php echo $t06_siswarutinbayar_2_list->FormKeyCountName ?>';

// Validate form
ft06_siswarutinbayar_2list.Validate = function() {
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
	}
	return true;
}

// Form_CustomValidate event
ft06_siswarutinbayar_2list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft06_siswarutinbayar_2list.ValidateRequired = true;
<?php } else { ?>
ft06_siswarutinbayar_2list.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
// Form object for search

</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<div class="ewToolbar">
<?php $Breadcrumb->Render(); ?>
<?php if ($t06_siswarutinbayar_2_list->TotalRecs > 0 && $t06_siswarutinbayar_2_list->ExportOptions->Visible()) { ?>
<?php $t06_siswarutinbayar_2_list->ExportOptions->Render("body") ?>
<?php } ?>
<?php echo $Language->SelectionForm(); ?>
<div class="clearfix"></div>
</div>
<?php if (($t06_siswarutinbayar_2->Export == "") || (EW_EXPORT_MASTER_RECORD && $t06_siswarutinbayar_2->Export == "print")) { ?>
<?php
if ($t06_siswarutinbayar_2_list->DbMasterFilter <> "" && $t06_siswarutinbayar_2->getCurrentMasterTable() == "t03_siswa") {
	if ($t06_siswarutinbayar_2_list->MasterRecordExists) {
?>
<?php include_once "t03_siswamaster.php" ?>
<?php
	}
}
?>
<?php } ?>
<?php
	$bSelectLimit = $t06_siswarutinbayar_2_list->UseSelectLimit;
	if ($bSelectLimit) {
		if ($t06_siswarutinbayar_2_list->TotalRecs <= 0)
			$t06_siswarutinbayar_2_list->TotalRecs = $t06_siswarutinbayar_2->SelectRecordCount();
	} else {
		if (!$t06_siswarutinbayar_2_list->Recordset && ($t06_siswarutinbayar_2_list->Recordset = $t06_siswarutinbayar_2_list->LoadRecordset()))
			$t06_siswarutinbayar_2_list->TotalRecs = $t06_siswarutinbayar_2_list->Recordset->RecordCount();
	}
	$t06_siswarutinbayar_2_list->StartRec = 1;
	if ($t06_siswarutinbayar_2_list->DisplayRecs <= 0 || ($t06_siswarutinbayar_2->Export <> "" && $t06_siswarutinbayar_2->ExportAll)) // Display all records
		$t06_siswarutinbayar_2_list->DisplayRecs = $t06_siswarutinbayar_2_list->TotalRecs;
	if (!($t06_siswarutinbayar_2->Export <> "" && $t06_siswarutinbayar_2->ExportAll))
		$t06_siswarutinbayar_2_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$t06_siswarutinbayar_2_list->Recordset = $t06_siswarutinbayar_2_list->LoadRecordset($t06_siswarutinbayar_2_list->StartRec-1, $t06_siswarutinbayar_2_list->DisplayRecs);

	// Set no record found message
	if ($t06_siswarutinbayar_2->CurrentAction == "" && $t06_siswarutinbayar_2_list->TotalRecs == 0) {
		if (!$Security->CanList())
			$t06_siswarutinbayar_2_list->setWarningMessage(ew_DeniedMsg());
		if ($t06_siswarutinbayar_2_list->SearchWhere == "0=101")
			$t06_siswarutinbayar_2_list->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$t06_siswarutinbayar_2_list->setWarningMessage($Language->Phrase("NoRecord"));
	}
$t06_siswarutinbayar_2_list->RenderOtherOptions();
?>
<?php $t06_siswarutinbayar_2_list->ShowPageHeader(); ?>
<?php
$t06_siswarutinbayar_2_list->ShowMessage();
?>
<?php if ($t06_siswarutinbayar_2_list->TotalRecs > 0 || $t06_siswarutinbayar_2->CurrentAction <> "") { ?>
<div class="panel panel-default ewGrid t06_siswarutinbayar_2">
<div class="panel-heading ewGridUpperPanel">
<?php if ($t06_siswarutinbayar_2->CurrentAction <> "gridadd" && $t06_siswarutinbayar_2->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="form-inline ewForm ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($t06_siswarutinbayar_2_list->Pager)) $t06_siswarutinbayar_2_list->Pager = new cPrevNextPager($t06_siswarutinbayar_2_list->StartRec, $t06_siswarutinbayar_2_list->DisplayRecs, $t06_siswarutinbayar_2_list->TotalRecs) ?>
<?php if ($t06_siswarutinbayar_2_list->Pager->RecordCount > 0 && $t06_siswarutinbayar_2_list->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($t06_siswarutinbayar_2_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $t06_siswarutinbayar_2_list->PageUrl() ?>start=<?php echo $t06_siswarutinbayar_2_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($t06_siswarutinbayar_2_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $t06_siswarutinbayar_2_list->PageUrl() ?>start=<?php echo $t06_siswarutinbayar_2_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $t06_siswarutinbayar_2_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($t06_siswarutinbayar_2_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $t06_siswarutinbayar_2_list->PageUrl() ?>start=<?php echo $t06_siswarutinbayar_2_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($t06_siswarutinbayar_2_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $t06_siswarutinbayar_2_list->PageUrl() ?>start=<?php echo $t06_siswarutinbayar_2_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $t06_siswarutinbayar_2_list->Pager->PageCount ?></span>
</div>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $t06_siswarutinbayar_2_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $t06_siswarutinbayar_2_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $t06_siswarutinbayar_2_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t06_siswarutinbayar_2_list->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
</div>
<form name="ft06_siswarutinbayar_2list" id="ft06_siswarutinbayar_2list" class="form-inline ewForm ewListForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($t06_siswarutinbayar_2_list->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $t06_siswarutinbayar_2_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t06_siswarutinbayar_2">
<?php if ($t06_siswarutinbayar_2->getCurrentMasterTable() == "t03_siswa" && $t06_siswarutinbayar_2->CurrentAction <> "") { ?>
<input type="hidden" name="<?php echo EW_TABLE_SHOW_MASTER ?>" value="t03_siswa">
<input type="hidden" name="fk_id" value="<?php echo $t06_siswarutinbayar_2->siswa_id->getSessionValue() ?>">
<?php } ?>
<div id="gmp_t06_siswarutinbayar_2" class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<?php if ($t06_siswarutinbayar_2_list->TotalRecs > 0 || $t06_siswarutinbayar_2->CurrentAction == "gridedit") { ?>
<table id="tbl_t06_siswarutinbayar_2list" class="table ewTable">
<?php echo $t06_siswarutinbayar_2->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Header row
$t06_siswarutinbayar_2_list->RowType = EW_ROWTYPE_HEADER;

// Render list options
$t06_siswarutinbayar_2_list->RenderListOptions();

// Render list options (header, left)
$t06_siswarutinbayar_2_list->ListOptions->Render("header", "left");
?>
<?php if ($t06_siswarutinbayar_2->id->Visible) { // id ?>
	<?php if ($t06_siswarutinbayar_2->SortUrl($t06_siswarutinbayar_2->id) == "") { ?>
		<th data-name="id"><div id="elh_t06_siswarutinbayar_2_id" class="t06_siswarutinbayar_2_id"><div class="ewTableHeaderCaption"><?php echo $t06_siswarutinbayar_2->id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t06_siswarutinbayar_2->SortUrl($t06_siswarutinbayar_2->id) ?>',2);"><div id="elh_t06_siswarutinbayar_2_id" class="t06_siswarutinbayar_2_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t06_siswarutinbayar_2->id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t06_siswarutinbayar_2->id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t06_siswarutinbayar_2->id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t06_siswarutinbayar_2->siswa_id->Visible) { // siswa_id ?>
	<?php if ($t06_siswarutinbayar_2->SortUrl($t06_siswarutinbayar_2->siswa_id) == "") { ?>
		<th data-name="siswa_id"><div id="elh_t06_siswarutinbayar_2_siswa_id" class="t06_siswarutinbayar_2_siswa_id"><div class="ewTableHeaderCaption"><?php echo $t06_siswarutinbayar_2->siswa_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="siswa_id"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t06_siswarutinbayar_2->SortUrl($t06_siswarutinbayar_2->siswa_id) ?>',2);"><div id="elh_t06_siswarutinbayar_2_siswa_id" class="t06_siswarutinbayar_2_siswa_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t06_siswarutinbayar_2->siswa_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t06_siswarutinbayar_2->siswa_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t06_siswarutinbayar_2->siswa_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t06_siswarutinbayar_2->rutin_id->Visible) { // rutin_id ?>
	<?php if ($t06_siswarutinbayar_2->SortUrl($t06_siswarutinbayar_2->rutin_id) == "") { ?>
		<th data-name="rutin_id"><div id="elh_t06_siswarutinbayar_2_rutin_id" class="t06_siswarutinbayar_2_rutin_id"><div class="ewTableHeaderCaption"><?php echo $t06_siswarutinbayar_2->rutin_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="rutin_id"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t06_siswarutinbayar_2->SortUrl($t06_siswarutinbayar_2->rutin_id) ?>',2);"><div id="elh_t06_siswarutinbayar_2_rutin_id" class="t06_siswarutinbayar_2_rutin_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t06_siswarutinbayar_2->rutin_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t06_siswarutinbayar_2->rutin_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t06_siswarutinbayar_2->rutin_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t06_siswarutinbayar_2->Bulan->Visible) { // Bulan ?>
	<?php if ($t06_siswarutinbayar_2->SortUrl($t06_siswarutinbayar_2->Bulan) == "") { ?>
		<th data-name="Bulan"><div id="elh_t06_siswarutinbayar_2_Bulan" class="t06_siswarutinbayar_2_Bulan"><div class="ewTableHeaderCaption"><?php echo $t06_siswarutinbayar_2->Bulan->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Bulan"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t06_siswarutinbayar_2->SortUrl($t06_siswarutinbayar_2->Bulan) ?>',2);"><div id="elh_t06_siswarutinbayar_2_Bulan" class="t06_siswarutinbayar_2_Bulan">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t06_siswarutinbayar_2->Bulan->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t06_siswarutinbayar_2->Bulan->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t06_siswarutinbayar_2->Bulan->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t06_siswarutinbayar_2->Tahun->Visible) { // Tahun ?>
	<?php if ($t06_siswarutinbayar_2->SortUrl($t06_siswarutinbayar_2->Tahun) == "") { ?>
		<th data-name="Tahun"><div id="elh_t06_siswarutinbayar_2_Tahun" class="t06_siswarutinbayar_2_Tahun"><div class="ewTableHeaderCaption"><?php echo $t06_siswarutinbayar_2->Tahun->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Tahun"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t06_siswarutinbayar_2->SortUrl($t06_siswarutinbayar_2->Tahun) ?>',2);"><div id="elh_t06_siswarutinbayar_2_Tahun" class="t06_siswarutinbayar_2_Tahun">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t06_siswarutinbayar_2->Tahun->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t06_siswarutinbayar_2->Tahun->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t06_siswarutinbayar_2->Tahun->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t06_siswarutinbayar_2->Bulan2->Visible) { // Bulan2 ?>
	<?php if ($t06_siswarutinbayar_2->SortUrl($t06_siswarutinbayar_2->Bulan2) == "") { ?>
		<th data-name="Bulan2"><div id="elh_t06_siswarutinbayar_2_Bulan2" class="t06_siswarutinbayar_2_Bulan2"><div class="ewTableHeaderCaption"><?php echo $t06_siswarutinbayar_2->Bulan2->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Bulan2"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t06_siswarutinbayar_2->SortUrl($t06_siswarutinbayar_2->Bulan2) ?>',2);"><div id="elh_t06_siswarutinbayar_2_Bulan2" class="t06_siswarutinbayar_2_Bulan2">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t06_siswarutinbayar_2->Bulan2->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t06_siswarutinbayar_2->Bulan2->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t06_siswarutinbayar_2->Bulan2->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t06_siswarutinbayar_2->Tahun2->Visible) { // Tahun2 ?>
	<?php if ($t06_siswarutinbayar_2->SortUrl($t06_siswarutinbayar_2->Tahun2) == "") { ?>
		<th data-name="Tahun2"><div id="elh_t06_siswarutinbayar_2_Tahun2" class="t06_siswarutinbayar_2_Tahun2"><div class="ewTableHeaderCaption"><?php echo $t06_siswarutinbayar_2->Tahun2->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Tahun2"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t06_siswarutinbayar_2->SortUrl($t06_siswarutinbayar_2->Tahun2) ?>',2);"><div id="elh_t06_siswarutinbayar_2_Tahun2" class="t06_siswarutinbayar_2_Tahun2">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t06_siswarutinbayar_2->Tahun2->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t06_siswarutinbayar_2->Tahun2->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t06_siswarutinbayar_2->Tahun2->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t06_siswarutinbayar_2->Bayar_Jumlah->Visible) { // Bayar_Jumlah ?>
	<?php if ($t06_siswarutinbayar_2->SortUrl($t06_siswarutinbayar_2->Bayar_Jumlah) == "") { ?>
		<th data-name="Bayar_Jumlah"><div id="elh_t06_siswarutinbayar_2_Bayar_Jumlah" class="t06_siswarutinbayar_2_Bayar_Jumlah"><div class="ewTableHeaderCaption"><?php echo $t06_siswarutinbayar_2->Bayar_Jumlah->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Bayar_Jumlah"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t06_siswarutinbayar_2->SortUrl($t06_siswarutinbayar_2->Bayar_Jumlah) ?>',2);"><div id="elh_t06_siswarutinbayar_2_Bayar_Jumlah" class="t06_siswarutinbayar_2_Bayar_Jumlah">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t06_siswarutinbayar_2->Bayar_Jumlah->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t06_siswarutinbayar_2->Bayar_Jumlah->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t06_siswarutinbayar_2->Bayar_Jumlah->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$t06_siswarutinbayar_2_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t06_siswarutinbayar_2->ExportAll && $t06_siswarutinbayar_2->Export <> "") {
	$t06_siswarutinbayar_2_list->StopRec = $t06_siswarutinbayar_2_list->TotalRecs;
} else {

	// Set the last record to display
	if ($t06_siswarutinbayar_2_list->TotalRecs > $t06_siswarutinbayar_2_list->StartRec + $t06_siswarutinbayar_2_list->DisplayRecs - 1)
		$t06_siswarutinbayar_2_list->StopRec = $t06_siswarutinbayar_2_list->StartRec + $t06_siswarutinbayar_2_list->DisplayRecs - 1;
	else
		$t06_siswarutinbayar_2_list->StopRec = $t06_siswarutinbayar_2_list->TotalRecs;
}

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($t06_siswarutinbayar_2_list->FormKeyCountName) && ($t06_siswarutinbayar_2->CurrentAction == "gridadd" || $t06_siswarutinbayar_2->CurrentAction == "gridedit" || $t06_siswarutinbayar_2->CurrentAction == "F")) {
		$t06_siswarutinbayar_2_list->KeyCount = $objForm->GetValue($t06_siswarutinbayar_2_list->FormKeyCountName);
		$t06_siswarutinbayar_2_list->StopRec = $t06_siswarutinbayar_2_list->StartRec + $t06_siswarutinbayar_2_list->KeyCount - 1;
	}
}
$t06_siswarutinbayar_2_list->RecCnt = $t06_siswarutinbayar_2_list->StartRec - 1;
if ($t06_siswarutinbayar_2_list->Recordset && !$t06_siswarutinbayar_2_list->Recordset->EOF) {
	$t06_siswarutinbayar_2_list->Recordset->MoveFirst();
	$bSelectLimit = $t06_siswarutinbayar_2_list->UseSelectLimit;
	if (!$bSelectLimit && $t06_siswarutinbayar_2_list->StartRec > 1)
		$t06_siswarutinbayar_2_list->Recordset->Move($t06_siswarutinbayar_2_list->StartRec - 1);
} elseif (!$t06_siswarutinbayar_2->AllowAddDeleteRow && $t06_siswarutinbayar_2_list->StopRec == 0) {
	$t06_siswarutinbayar_2_list->StopRec = $t06_siswarutinbayar_2->GridAddRowCount;
}

// Initialize aggregate
$t06_siswarutinbayar_2->RowType = EW_ROWTYPE_AGGREGATEINIT;
$t06_siswarutinbayar_2->ResetAttrs();
$t06_siswarutinbayar_2_list->RenderRow();
$t06_siswarutinbayar_2_list->EditRowCnt = 0;
if ($t06_siswarutinbayar_2->CurrentAction == "edit")
	$t06_siswarutinbayar_2_list->RowIndex = 1;
if ($t06_siswarutinbayar_2->CurrentAction == "gridedit")
	$t06_siswarutinbayar_2_list->RowIndex = 0;
while ($t06_siswarutinbayar_2_list->RecCnt < $t06_siswarutinbayar_2_list->StopRec) {
	$t06_siswarutinbayar_2_list->RecCnt++;
	if (intval($t06_siswarutinbayar_2_list->RecCnt) >= intval($t06_siswarutinbayar_2_list->StartRec)) {
		$t06_siswarutinbayar_2_list->RowCnt++;
		if ($t06_siswarutinbayar_2->CurrentAction == "gridadd" || $t06_siswarutinbayar_2->CurrentAction == "gridedit" || $t06_siswarutinbayar_2->CurrentAction == "F") {
			$t06_siswarutinbayar_2_list->RowIndex++;
			$objForm->Index = $t06_siswarutinbayar_2_list->RowIndex;
			if ($objForm->HasValue($t06_siswarutinbayar_2_list->FormActionName))
				$t06_siswarutinbayar_2_list->RowAction = strval($objForm->GetValue($t06_siswarutinbayar_2_list->FormActionName));
			elseif ($t06_siswarutinbayar_2->CurrentAction == "gridadd")
				$t06_siswarutinbayar_2_list->RowAction = "insert";
			else
				$t06_siswarutinbayar_2_list->RowAction = "";
		}

		// Set up key count
		$t06_siswarutinbayar_2_list->KeyCount = $t06_siswarutinbayar_2_list->RowIndex;

		// Init row class and style
		$t06_siswarutinbayar_2->ResetAttrs();
		$t06_siswarutinbayar_2->CssClass = "";
		if ($t06_siswarutinbayar_2->CurrentAction == "gridadd") {
			$t06_siswarutinbayar_2_list->LoadDefaultValues(); // Load default values
		} else {
			$t06_siswarutinbayar_2_list->LoadRowValues($t06_siswarutinbayar_2_list->Recordset); // Load row values
		}
		$t06_siswarutinbayar_2->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($t06_siswarutinbayar_2->CurrentAction == "edit") {
			if ($t06_siswarutinbayar_2_list->CheckInlineEditKey() && $t06_siswarutinbayar_2_list->EditRowCnt == 0) { // Inline edit
				$t06_siswarutinbayar_2->RowType = EW_ROWTYPE_EDIT; // Render edit
			}
		}
		if ($t06_siswarutinbayar_2->CurrentAction == "gridedit") { // Grid edit
			if ($t06_siswarutinbayar_2->EventCancelled) {
				$t06_siswarutinbayar_2_list->RestoreCurrentRowFormValues($t06_siswarutinbayar_2_list->RowIndex); // Restore form values
			}
			if ($t06_siswarutinbayar_2_list->RowAction == "insert")
				$t06_siswarutinbayar_2->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$t06_siswarutinbayar_2->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($t06_siswarutinbayar_2->CurrentAction == "edit" && $t06_siswarutinbayar_2->RowType == EW_ROWTYPE_EDIT && $t06_siswarutinbayar_2->EventCancelled) { // Update failed
			$objForm->Index = 1;
			$t06_siswarutinbayar_2_list->RestoreFormValues(); // Restore form values
		}
		if ($t06_siswarutinbayar_2->CurrentAction == "gridedit" && ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_EDIT || $t06_siswarutinbayar_2->RowType == EW_ROWTYPE_ADD) && $t06_siswarutinbayar_2->EventCancelled) // Update failed
			$t06_siswarutinbayar_2_list->RestoreCurrentRowFormValues($t06_siswarutinbayar_2_list->RowIndex); // Restore form values
		if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_EDIT) // Edit row
			$t06_siswarutinbayar_2_list->EditRowCnt++;

		// Set up row id / data-rowindex
		$t06_siswarutinbayar_2->RowAttrs = array_merge($t06_siswarutinbayar_2->RowAttrs, array('data-rowindex'=>$t06_siswarutinbayar_2_list->RowCnt, 'id'=>'r' . $t06_siswarutinbayar_2_list->RowCnt . '_t06_siswarutinbayar_2', 'data-rowtype'=>$t06_siswarutinbayar_2->RowType));

		// Render row
		$t06_siswarutinbayar_2_list->RenderRow();

		// Render list options
		$t06_siswarutinbayar_2_list->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t06_siswarutinbayar_2_list->RowAction <> "delete" && $t06_siswarutinbayar_2_list->RowAction <> "insertdelete" && !($t06_siswarutinbayar_2_list->RowAction == "insert" && $t06_siswarutinbayar_2->CurrentAction == "F" && $t06_siswarutinbayar_2_list->EmptyRow())) {
?>
	<tr<?php echo $t06_siswarutinbayar_2->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t06_siswarutinbayar_2_list->ListOptions->Render("body", "left", $t06_siswarutinbayar_2_list->RowCnt);
?>
	<?php if ($t06_siswarutinbayar_2->id->Visible) { // id ?>
		<td data-name="id"<?php echo $t06_siswarutinbayar_2->id->CellAttributes() ?>>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_id" name="o<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_id" id="o<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->id->OldValue) ?>">
<?php } ?>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t06_siswarutinbayar_2_list->RowCnt ?>_t06_siswarutinbayar_2_id" class="form-group t06_siswarutinbayar_2_id">
<span<?php echo $t06_siswarutinbayar_2->id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t06_siswarutinbayar_2->id->EditValue ?></p></span>
</span>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_id" name="x<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_id" id="x<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->id->CurrentValue) ?>">
<?php } ?>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t06_siswarutinbayar_2_list->RowCnt ?>_t06_siswarutinbayar_2_id" class="t06_siswarutinbayar_2_id">
<span<?php echo $t06_siswarutinbayar_2->id->ViewAttributes() ?>>
<?php echo $t06_siswarutinbayar_2->id->ListViewValue() ?></span>
</span>
<?php } ?>
<a id="<?php echo $t06_siswarutinbayar_2_list->PageObjName . "_row_" . $t06_siswarutinbayar_2_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($t06_siswarutinbayar_2->siswa_id->Visible) { // siswa_id ?>
		<td data-name="siswa_id"<?php echo $t06_siswarutinbayar_2->siswa_id->CellAttributes() ?>>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($t06_siswarutinbayar_2->siswa_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $t06_siswarutinbayar_2_list->RowCnt ?>_t06_siswarutinbayar_2_siswa_id" class="form-group t06_siswarutinbayar_2_siswa_id">
<span<?php echo $t06_siswarutinbayar_2->siswa_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t06_siswarutinbayar_2->siswa_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_siswa_id" name="x<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_siswa_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->siswa_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t06_siswarutinbayar_2_list->RowCnt ?>_t06_siswarutinbayar_2_siswa_id" class="form-group t06_siswarutinbayar_2_siswa_id">
<input type="text" data-table="t06_siswarutinbayar_2" data-field="x_siswa_id" name="x<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_siswa_id" id="x<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_siswa_id" size="30" placeholder="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->siswa_id->getPlaceHolder()) ?>" value="<?php echo $t06_siswarutinbayar_2->siswa_id->EditValue ?>"<?php echo $t06_siswarutinbayar_2->siswa_id->EditAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_siswa_id" name="o<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_siswa_id" id="o<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_siswa_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->siswa_id->OldValue) ?>">
<?php } ?>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($t06_siswarutinbayar_2->siswa_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $t06_siswarutinbayar_2_list->RowCnt ?>_t06_siswarutinbayar_2_siswa_id" class="form-group t06_siswarutinbayar_2_siswa_id">
<span<?php echo $t06_siswarutinbayar_2->siswa_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t06_siswarutinbayar_2->siswa_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_siswa_id" name="x<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_siswa_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->siswa_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t06_siswarutinbayar_2_list->RowCnt ?>_t06_siswarutinbayar_2_siswa_id" class="form-group t06_siswarutinbayar_2_siswa_id">
<input type="text" data-table="t06_siswarutinbayar_2" data-field="x_siswa_id" name="x<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_siswa_id" id="x<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_siswa_id" size="30" placeholder="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->siswa_id->getPlaceHolder()) ?>" value="<?php echo $t06_siswarutinbayar_2->siswa_id->EditValue ?>"<?php echo $t06_siswarutinbayar_2->siswa_id->EditAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t06_siswarutinbayar_2_list->RowCnt ?>_t06_siswarutinbayar_2_siswa_id" class="t06_siswarutinbayar_2_siswa_id">
<span<?php echo $t06_siswarutinbayar_2->siswa_id->ViewAttributes() ?>>
<?php echo $t06_siswarutinbayar_2->siswa_id->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t06_siswarutinbayar_2->rutin_id->Visible) { // rutin_id ?>
		<td data-name="rutin_id"<?php echo $t06_siswarutinbayar_2->rutin_id->CellAttributes() ?>>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t06_siswarutinbayar_2_list->RowCnt ?>_t06_siswarutinbayar_2_rutin_id" class="form-group t06_siswarutinbayar_2_rutin_id">
<input type="text" data-table="t06_siswarutinbayar_2" data-field="x_rutin_id" name="x<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_rutin_id" id="x<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_rutin_id" size="30" placeholder="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->rutin_id->getPlaceHolder()) ?>" value="<?php echo $t06_siswarutinbayar_2->rutin_id->EditValue ?>"<?php echo $t06_siswarutinbayar_2->rutin_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_rutin_id" name="o<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_rutin_id" id="o<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_rutin_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->rutin_id->OldValue) ?>">
<?php } ?>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t06_siswarutinbayar_2_list->RowCnt ?>_t06_siswarutinbayar_2_rutin_id" class="form-group t06_siswarutinbayar_2_rutin_id">
<input type="text" data-table="t06_siswarutinbayar_2" data-field="x_rutin_id" name="x<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_rutin_id" id="x<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_rutin_id" size="30" placeholder="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->rutin_id->getPlaceHolder()) ?>" value="<?php echo $t06_siswarutinbayar_2->rutin_id->EditValue ?>"<?php echo $t06_siswarutinbayar_2->rutin_id->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t06_siswarutinbayar_2_list->RowCnt ?>_t06_siswarutinbayar_2_rutin_id" class="t06_siswarutinbayar_2_rutin_id">
<span<?php echo $t06_siswarutinbayar_2->rutin_id->ViewAttributes() ?>>
<?php echo $t06_siswarutinbayar_2->rutin_id->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t06_siswarutinbayar_2->Bulan->Visible) { // Bulan ?>
		<td data-name="Bulan"<?php echo $t06_siswarutinbayar_2->Bulan->CellAttributes() ?>>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t06_siswarutinbayar_2_list->RowCnt ?>_t06_siswarutinbayar_2_Bulan" class="form-group t06_siswarutinbayar_2_Bulan">
<input type="text" data-table="t06_siswarutinbayar_2" data-field="x_Bulan" name="x<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_Bulan" id="x<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_Bulan" size="30" placeholder="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Bulan->getPlaceHolder()) ?>" value="<?php echo $t06_siswarutinbayar_2->Bulan->EditValue ?>"<?php echo $t06_siswarutinbayar_2->Bulan->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Bulan" name="o<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_Bulan" id="o<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_Bulan" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Bulan->OldValue) ?>">
<?php } ?>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t06_siswarutinbayar_2_list->RowCnt ?>_t06_siswarutinbayar_2_Bulan" class="form-group t06_siswarutinbayar_2_Bulan">
<input type="text" data-table="t06_siswarutinbayar_2" data-field="x_Bulan" name="x<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_Bulan" id="x<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_Bulan" size="30" placeholder="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Bulan->getPlaceHolder()) ?>" value="<?php echo $t06_siswarutinbayar_2->Bulan->EditValue ?>"<?php echo $t06_siswarutinbayar_2->Bulan->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t06_siswarutinbayar_2_list->RowCnt ?>_t06_siswarutinbayar_2_Bulan" class="t06_siswarutinbayar_2_Bulan">
<span<?php echo $t06_siswarutinbayar_2->Bulan->ViewAttributes() ?>>
<?php echo $t06_siswarutinbayar_2->Bulan->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t06_siswarutinbayar_2->Tahun->Visible) { // Tahun ?>
		<td data-name="Tahun"<?php echo $t06_siswarutinbayar_2->Tahun->CellAttributes() ?>>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t06_siswarutinbayar_2_list->RowCnt ?>_t06_siswarutinbayar_2_Tahun" class="form-group t06_siswarutinbayar_2_Tahun">
<input type="text" data-table="t06_siswarutinbayar_2" data-field="x_Tahun" name="x<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_Tahun" id="x<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_Tahun" size="30" placeholder="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Tahun->getPlaceHolder()) ?>" value="<?php echo $t06_siswarutinbayar_2->Tahun->EditValue ?>"<?php echo $t06_siswarutinbayar_2->Tahun->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Tahun" name="o<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_Tahun" id="o<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_Tahun" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Tahun->OldValue) ?>">
<?php } ?>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t06_siswarutinbayar_2_list->RowCnt ?>_t06_siswarutinbayar_2_Tahun" class="form-group t06_siswarutinbayar_2_Tahun">
<input type="text" data-table="t06_siswarutinbayar_2" data-field="x_Tahun" name="x<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_Tahun" id="x<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_Tahun" size="30" placeholder="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Tahun->getPlaceHolder()) ?>" value="<?php echo $t06_siswarutinbayar_2->Tahun->EditValue ?>"<?php echo $t06_siswarutinbayar_2->Tahun->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t06_siswarutinbayar_2_list->RowCnt ?>_t06_siswarutinbayar_2_Tahun" class="t06_siswarutinbayar_2_Tahun">
<span<?php echo $t06_siswarutinbayar_2->Tahun->ViewAttributes() ?>>
<?php echo $t06_siswarutinbayar_2->Tahun->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t06_siswarutinbayar_2->Bulan2->Visible) { // Bulan2 ?>
		<td data-name="Bulan2"<?php echo $t06_siswarutinbayar_2->Bulan2->CellAttributes() ?>>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t06_siswarutinbayar_2_list->RowCnt ?>_t06_siswarutinbayar_2_Bulan2" class="form-group t06_siswarutinbayar_2_Bulan2">
<input type="text" data-table="t06_siswarutinbayar_2" data-field="x_Bulan2" name="x<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_Bulan2" id="x<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_Bulan2" size="30" placeholder="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Bulan2->getPlaceHolder()) ?>" value="<?php echo $t06_siswarutinbayar_2->Bulan2->EditValue ?>"<?php echo $t06_siswarutinbayar_2->Bulan2->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Bulan2" name="o<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_Bulan2" id="o<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_Bulan2" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Bulan2->OldValue) ?>">
<?php } ?>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t06_siswarutinbayar_2_list->RowCnt ?>_t06_siswarutinbayar_2_Bulan2" class="form-group t06_siswarutinbayar_2_Bulan2">
<input type="text" data-table="t06_siswarutinbayar_2" data-field="x_Bulan2" name="x<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_Bulan2" id="x<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_Bulan2" size="30" placeholder="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Bulan2->getPlaceHolder()) ?>" value="<?php echo $t06_siswarutinbayar_2->Bulan2->EditValue ?>"<?php echo $t06_siswarutinbayar_2->Bulan2->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t06_siswarutinbayar_2_list->RowCnt ?>_t06_siswarutinbayar_2_Bulan2" class="t06_siswarutinbayar_2_Bulan2">
<span<?php echo $t06_siswarutinbayar_2->Bulan2->ViewAttributes() ?>>
<?php echo $t06_siswarutinbayar_2->Bulan2->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t06_siswarutinbayar_2->Tahun2->Visible) { // Tahun2 ?>
		<td data-name="Tahun2"<?php echo $t06_siswarutinbayar_2->Tahun2->CellAttributes() ?>>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t06_siswarutinbayar_2_list->RowCnt ?>_t06_siswarutinbayar_2_Tahun2" class="form-group t06_siswarutinbayar_2_Tahun2">
<input type="text" data-table="t06_siswarutinbayar_2" data-field="x_Tahun2" name="x<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_Tahun2" id="x<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_Tahun2" size="30" placeholder="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Tahun2->getPlaceHolder()) ?>" value="<?php echo $t06_siswarutinbayar_2->Tahun2->EditValue ?>"<?php echo $t06_siswarutinbayar_2->Tahun2->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Tahun2" name="o<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_Tahun2" id="o<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_Tahun2" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Tahun2->OldValue) ?>">
<?php } ?>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t06_siswarutinbayar_2_list->RowCnt ?>_t06_siswarutinbayar_2_Tahun2" class="form-group t06_siswarutinbayar_2_Tahun2">
<input type="text" data-table="t06_siswarutinbayar_2" data-field="x_Tahun2" name="x<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_Tahun2" id="x<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_Tahun2" size="30" placeholder="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Tahun2->getPlaceHolder()) ?>" value="<?php echo $t06_siswarutinbayar_2->Tahun2->EditValue ?>"<?php echo $t06_siswarutinbayar_2->Tahun2->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t06_siswarutinbayar_2_list->RowCnt ?>_t06_siswarutinbayar_2_Tahun2" class="t06_siswarutinbayar_2_Tahun2">
<span<?php echo $t06_siswarutinbayar_2->Tahun2->ViewAttributes() ?>>
<?php echo $t06_siswarutinbayar_2->Tahun2->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t06_siswarutinbayar_2->Bayar_Jumlah->Visible) { // Bayar_Jumlah ?>
		<td data-name="Bayar_Jumlah"<?php echo $t06_siswarutinbayar_2->Bayar_Jumlah->CellAttributes() ?>>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t06_siswarutinbayar_2_list->RowCnt ?>_t06_siswarutinbayar_2_Bayar_Jumlah" class="form-group t06_siswarutinbayar_2_Bayar_Jumlah">
<input type="text" data-table="t06_siswarutinbayar_2" data-field="x_Bayar_Jumlah" name="x<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_Bayar_Jumlah" id="x<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_Bayar_Jumlah" size="30" placeholder="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Bayar_Jumlah->getPlaceHolder()) ?>" value="<?php echo $t06_siswarutinbayar_2->Bayar_Jumlah->EditValue ?>"<?php echo $t06_siswarutinbayar_2->Bayar_Jumlah->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Bayar_Jumlah" name="o<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_Bayar_Jumlah" id="o<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_Bayar_Jumlah" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Bayar_Jumlah->OldValue) ?>">
<?php } ?>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t06_siswarutinbayar_2_list->RowCnt ?>_t06_siswarutinbayar_2_Bayar_Jumlah" class="form-group t06_siswarutinbayar_2_Bayar_Jumlah">
<input type="text" data-table="t06_siswarutinbayar_2" data-field="x_Bayar_Jumlah" name="x<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_Bayar_Jumlah" id="x<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_Bayar_Jumlah" size="30" placeholder="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Bayar_Jumlah->getPlaceHolder()) ?>" value="<?php echo $t06_siswarutinbayar_2->Bayar_Jumlah->EditValue ?>"<?php echo $t06_siswarutinbayar_2->Bayar_Jumlah->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t06_siswarutinbayar_2_list->RowCnt ?>_t06_siswarutinbayar_2_Bayar_Jumlah" class="t06_siswarutinbayar_2_Bayar_Jumlah">
<span<?php echo $t06_siswarutinbayar_2->Bayar_Jumlah->ViewAttributes() ?>>
<?php echo $t06_siswarutinbayar_2->Bayar_Jumlah->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t06_siswarutinbayar_2_list->ListOptions->Render("body", "right", $t06_siswarutinbayar_2_list->RowCnt);
?>
	</tr>
<?php if ($t06_siswarutinbayar_2->RowType == EW_ROWTYPE_ADD || $t06_siswarutinbayar_2->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
ft06_siswarutinbayar_2list.UpdateOpts(<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($t06_siswarutinbayar_2->CurrentAction <> "gridadd")
		if (!$t06_siswarutinbayar_2_list->Recordset->EOF) $t06_siswarutinbayar_2_list->Recordset->MoveNext();
}
?>
<?php
	if ($t06_siswarutinbayar_2->CurrentAction == "gridadd" || $t06_siswarutinbayar_2->CurrentAction == "gridedit") {
		$t06_siswarutinbayar_2_list->RowIndex = '$rowindex$';
		$t06_siswarutinbayar_2_list->LoadDefaultValues();

		// Set row properties
		$t06_siswarutinbayar_2->ResetAttrs();
		$t06_siswarutinbayar_2->RowAttrs = array_merge($t06_siswarutinbayar_2->RowAttrs, array('data-rowindex'=>$t06_siswarutinbayar_2_list->RowIndex, 'id'=>'r0_t06_siswarutinbayar_2', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($t06_siswarutinbayar_2->RowAttrs["class"], "ewTemplate");
		$t06_siswarutinbayar_2->RowType = EW_ROWTYPE_ADD;

		// Render row
		$t06_siswarutinbayar_2_list->RenderRow();

		// Render list options
		$t06_siswarutinbayar_2_list->RenderListOptions();
		$t06_siswarutinbayar_2_list->StartRowCnt = 0;
?>
	<tr<?php echo $t06_siswarutinbayar_2->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t06_siswarutinbayar_2_list->ListOptions->Render("body", "left", $t06_siswarutinbayar_2_list->RowIndex);
?>
	<?php if ($t06_siswarutinbayar_2->id->Visible) { // id ?>
		<td data-name="id">
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_id" name="o<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_id" id="o<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t06_siswarutinbayar_2->siswa_id->Visible) { // siswa_id ?>
		<td data-name="siswa_id">
<?php if ($t06_siswarutinbayar_2->siswa_id->getSessionValue() <> "") { ?>
<span id="el$rowindex$_t06_siswarutinbayar_2_siswa_id" class="form-group t06_siswarutinbayar_2_siswa_id">
<span<?php echo $t06_siswarutinbayar_2->siswa_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t06_siswarutinbayar_2->siswa_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_siswa_id" name="x<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_siswa_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->siswa_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_t06_siswarutinbayar_2_siswa_id" class="form-group t06_siswarutinbayar_2_siswa_id">
<input type="text" data-table="t06_siswarutinbayar_2" data-field="x_siswa_id" name="x<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_siswa_id" id="x<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_siswa_id" size="30" placeholder="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->siswa_id->getPlaceHolder()) ?>" value="<?php echo $t06_siswarutinbayar_2->siswa_id->EditValue ?>"<?php echo $t06_siswarutinbayar_2->siswa_id->EditAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_siswa_id" name="o<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_siswa_id" id="o<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_siswa_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->siswa_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t06_siswarutinbayar_2->rutin_id->Visible) { // rutin_id ?>
		<td data-name="rutin_id">
<span id="el$rowindex$_t06_siswarutinbayar_2_rutin_id" class="form-group t06_siswarutinbayar_2_rutin_id">
<input type="text" data-table="t06_siswarutinbayar_2" data-field="x_rutin_id" name="x<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_rutin_id" id="x<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_rutin_id" size="30" placeholder="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->rutin_id->getPlaceHolder()) ?>" value="<?php echo $t06_siswarutinbayar_2->rutin_id->EditValue ?>"<?php echo $t06_siswarutinbayar_2->rutin_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_rutin_id" name="o<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_rutin_id" id="o<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_rutin_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->rutin_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t06_siswarutinbayar_2->Bulan->Visible) { // Bulan ?>
		<td data-name="Bulan">
<span id="el$rowindex$_t06_siswarutinbayar_2_Bulan" class="form-group t06_siswarutinbayar_2_Bulan">
<input type="text" data-table="t06_siswarutinbayar_2" data-field="x_Bulan" name="x<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_Bulan" id="x<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_Bulan" size="30" placeholder="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Bulan->getPlaceHolder()) ?>" value="<?php echo $t06_siswarutinbayar_2->Bulan->EditValue ?>"<?php echo $t06_siswarutinbayar_2->Bulan->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Bulan" name="o<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_Bulan" id="o<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_Bulan" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Bulan->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t06_siswarutinbayar_2->Tahun->Visible) { // Tahun ?>
		<td data-name="Tahun">
<span id="el$rowindex$_t06_siswarutinbayar_2_Tahun" class="form-group t06_siswarutinbayar_2_Tahun">
<input type="text" data-table="t06_siswarutinbayar_2" data-field="x_Tahun" name="x<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_Tahun" id="x<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_Tahun" size="30" placeholder="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Tahun->getPlaceHolder()) ?>" value="<?php echo $t06_siswarutinbayar_2->Tahun->EditValue ?>"<?php echo $t06_siswarutinbayar_2->Tahun->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Tahun" name="o<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_Tahun" id="o<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_Tahun" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Tahun->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t06_siswarutinbayar_2->Bulan2->Visible) { // Bulan2 ?>
		<td data-name="Bulan2">
<span id="el$rowindex$_t06_siswarutinbayar_2_Bulan2" class="form-group t06_siswarutinbayar_2_Bulan2">
<input type="text" data-table="t06_siswarutinbayar_2" data-field="x_Bulan2" name="x<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_Bulan2" id="x<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_Bulan2" size="30" placeholder="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Bulan2->getPlaceHolder()) ?>" value="<?php echo $t06_siswarutinbayar_2->Bulan2->EditValue ?>"<?php echo $t06_siswarutinbayar_2->Bulan2->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Bulan2" name="o<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_Bulan2" id="o<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_Bulan2" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Bulan2->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t06_siswarutinbayar_2->Tahun2->Visible) { // Tahun2 ?>
		<td data-name="Tahun2">
<span id="el$rowindex$_t06_siswarutinbayar_2_Tahun2" class="form-group t06_siswarutinbayar_2_Tahun2">
<input type="text" data-table="t06_siswarutinbayar_2" data-field="x_Tahun2" name="x<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_Tahun2" id="x<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_Tahun2" size="30" placeholder="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Tahun2->getPlaceHolder()) ?>" value="<?php echo $t06_siswarutinbayar_2->Tahun2->EditValue ?>"<?php echo $t06_siswarutinbayar_2->Tahun2->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Tahun2" name="o<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_Tahun2" id="o<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_Tahun2" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Tahun2->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t06_siswarutinbayar_2->Bayar_Jumlah->Visible) { // Bayar_Jumlah ?>
		<td data-name="Bayar_Jumlah">
<span id="el$rowindex$_t06_siswarutinbayar_2_Bayar_Jumlah" class="form-group t06_siswarutinbayar_2_Bayar_Jumlah">
<input type="text" data-table="t06_siswarutinbayar_2" data-field="x_Bayar_Jumlah" name="x<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_Bayar_Jumlah" id="x<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_Bayar_Jumlah" size="30" placeholder="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Bayar_Jumlah->getPlaceHolder()) ?>" value="<?php echo $t06_siswarutinbayar_2->Bayar_Jumlah->EditValue ?>"<?php echo $t06_siswarutinbayar_2->Bayar_Jumlah->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t06_siswarutinbayar_2" data-field="x_Bayar_Jumlah" name="o<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_Bayar_Jumlah" id="o<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>_Bayar_Jumlah" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar_2->Bayar_Jumlah->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t06_siswarutinbayar_2_list->ListOptions->Render("body", "right", $t06_siswarutinbayar_2_list->RowCnt);
?>
<script type="text/javascript">
ft06_siswarutinbayar_2list.UpdateOpts(<?php echo $t06_siswarutinbayar_2_list->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($t06_siswarutinbayar_2->CurrentAction == "edit") { ?>
<input type="hidden" name="<?php echo $t06_siswarutinbayar_2_list->FormKeyCountName ?>" id="<?php echo $t06_siswarutinbayar_2_list->FormKeyCountName ?>" value="<?php echo $t06_siswarutinbayar_2_list->KeyCount ?>">
<?php } ?>
<?php if ($t06_siswarutinbayar_2->CurrentAction == "gridedit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $t06_siswarutinbayar_2_list->FormKeyCountName ?>" id="<?php echo $t06_siswarutinbayar_2_list->FormKeyCountName ?>" value="<?php echo $t06_siswarutinbayar_2_list->KeyCount ?>">
<?php echo $t06_siswarutinbayar_2_list->MultiSelectKey ?>
<?php } ?>
<?php if ($t06_siswarutinbayar_2->CurrentAction == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($t06_siswarutinbayar_2_list->Recordset)
	$t06_siswarutinbayar_2_list->Recordset->Close();
?>
</div>
<?php } ?>
<?php if ($t06_siswarutinbayar_2_list->TotalRecs == 0 && $t06_siswarutinbayar_2->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t06_siswarutinbayar_2_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<script type="text/javascript">
ft06_siswarutinbayar_2list.Init();
</script>
<?php
$t06_siswarutinbayar_2_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$t06_siswarutinbayar_2_list->Page_Terminate();
?>