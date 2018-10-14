<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg13.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql13.php") ?>
<?php include_once "phpfn13.php" ?>
<?php include_once "v01_siswanonrutininfo.php" ?>
<?php include_once "t96_employeesinfo.php" ?>
<?php include_once "t09_siswanonrutinbayargridcls.php" ?>
<?php include_once "userfn13.php" ?>
<?php

//
// Page class
//

$v01_siswanonrutin_list = NULL; // Initialize page object first

class cv01_siswanonrutin_list extends cv01_siswanonrutin {

	// Page ID
	var $PageID = 'list';

	// Project ID
	var $ProjectID = "{9A296957-6EE4-4785-AB71-310FFD71D6FE}";

	// Table name
	var $TableName = 'v01_siswanonrutin';

	// Page object name
	var $PageObjName = 'v01_siswanonrutin_list';

	// Grid form hidden field names
	var $FormName = 'fv01_siswanonrutinlist';
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

		// Table object (v01_siswanonrutin)
		if (!isset($GLOBALS["v01_siswanonrutin"]) || get_class($GLOBALS["v01_siswanonrutin"]) == "cv01_siswanonrutin") {
			$GLOBALS["v01_siswanonrutin"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["v01_siswanonrutin"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "v01_siswanonrutinadd.php?" . EW_TABLE_SHOW_DETAIL . "=";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "v01_siswanonrutindelete.php";
		$this->MultiUpdateUrl = "v01_siswanonrutinupdate.php";

		// Table object (t96_employees)
		if (!isset($GLOBALS['t96_employees'])) $GLOBALS['t96_employees'] = new ct96_employees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'v01_siswanonrutin', TRUE);

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
		$this->FilterOptions->TagClassName = "ewFilterOption fv01_siswanonrutinlistsrch";

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
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$this->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->SetupListOptions();
		$this->Siswa_Nomor_Induk->SetVisibility();
		$this->Siswa_Nama->SetVisibility();
		$this->nonrutin_id->SetVisibility();
		$this->Nilai->SetVisibility();
		$this->Terbayar->SetVisibility();
		$this->Sisa->SetVisibility();

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

			// Process auto fill for detail table 't09_siswanonrutinbayar'
			if (@$_POST["grid"] == "ft09_siswanonrutinbayargrid") {
				if (!isset($GLOBALS["t09_siswanonrutinbayar_grid"])) $GLOBALS["t09_siswanonrutinbayar_grid"] = new ct09_siswanonrutinbayar_grid;
				$GLOBALS["t09_siswanonrutinbayar_grid"]->Page_Init();
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
		global $EW_EXPORT, $v01_siswanonrutin;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($v01_siswanonrutin);
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

			// Get default search criteria
			ew_AddFilter($this->DefaultSearchWhere, $this->AdvancedSearchWhere(TRUE));

			// Get and validate search values for advanced search
			$this->LoadSearchValues(); // Get search values

			// Process filter list
			$this->ProcessFilterList();
			if (!$this->ValidateSearch())
				$this->setFailureMessage($gsSearchError);

			// Restore search parms from Session if not searching / reset / export
			if (($this->Export <> "" || $this->Command <> "search" && $this->Command <> "reset" && $this->Command <> "resetall") && $this->CheckSearchParms())
				$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$this->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get search criteria for advanced search
			if ($gsSearchError == "")
				$sSrchAdvanced = $this->AdvancedSearchWhere();
		}

		// Restore display records
		if ($this->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $this->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 50; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Load search default if no existing search criteria
		if (!$this->CheckSearchParms()) {

			// Load advanced search from default
			if ($this->LoadAdvancedSearchDefault()) {
				$sSrchAdvanced = $this->AdvancedSearchWhere();
			}
		}

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$this->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->Command == "search" && !$this->RestoreSearch) {
			$this->setSearchWhere($this->SearchWhere); // Save to Session
			$this->StartRec = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRec);
		} else {
			$this->SearchWhere = $this->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);
		if ($sFilter == "") {
			$sFilter = "0=101";
			$this->SearchWhere = $sFilter;
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

	// Get list of filters
	function GetFilterList() {
		global $UserProfile;

		// Load server side filters
		if (EW_SEARCH_FILTER_OPTION == "Server") {
			$sSavedFilterList = isset($UserProfile) ? $UserProfile->GetSearchFilters(CurrentUserName(), "fv01_siswanonrutinlistsrch") : "";
		} else {
			$sSavedFilterList = "";
		}

		// Initialize
		$sFilterList = "";
		$sFilterList = ew_Concat($sFilterList, $this->id->AdvancedSearch->ToJSON(), ","); // Field id
		$sFilterList = ew_Concat($sFilterList, $this->siswa_id->AdvancedSearch->ToJSON(), ","); // Field siswa_id
		$sFilterList = ew_Concat($sFilterList, $this->Siswa_Nomor_Induk->AdvancedSearch->ToJSON(), ","); // Field Siswa_Nomor_Induk
		$sFilterList = ew_Concat($sFilterList, $this->Siswa_Nama->AdvancedSearch->ToJSON(), ","); // Field Siswa_Nama
		$sFilterList = ew_Concat($sFilterList, $this->nonrutin_id->AdvancedSearch->ToJSON(), ","); // Field nonrutin_id
		$sFilterList = ew_Concat($sFilterList, $this->Nilai->AdvancedSearch->ToJSON(), ","); // Field Nilai
		$sFilterList = ew_Concat($sFilterList, $this->Terbayar->AdvancedSearch->ToJSON(), ","); // Field Terbayar
		$sFilterList = ew_Concat($sFilterList, $this->Sisa->AdvancedSearch->ToJSON(), ","); // Field Sisa
		$sFilterList = preg_replace('/,$/', "", $sFilterList);

		// Return filter list in json
		if ($sFilterList <> "")
			$sFilterList = "\"data\":{" . $sFilterList . "}";
		if ($sSavedFilterList <> "") {
			if ($sFilterList <> "")
				$sFilterList .= ",";
			$sFilterList .= "\"filters\":" . $sSavedFilterList;
		}
		return ($sFilterList <> "") ? "{" . $sFilterList . "}" : "null";
	}

	// Process filter list
	function ProcessFilterList() {
		global $UserProfile;
		if (@$_POST["ajax"] == "savefilters") { // Save filter request (Ajax)
			$filters = ew_StripSlashes(@$_POST["filters"]);
			$UserProfile->SetSearchFilters(CurrentUserName(), "fv01_siswanonrutinlistsrch", $filters);

			// Clean output buffer
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			echo ew_ArrayToJson(array(array("success" => TRUE))); // Success
			$this->Page_Terminate();
			exit();
		} elseif (@$_POST["cmd"] == "resetfilter") {
			$this->RestoreFilterList();
		}
	}

	// Restore list of filters
	function RestoreFilterList() {

		// Return if not reset filter
		if (@$_POST["cmd"] <> "resetfilter")
			return FALSE;
		$filter = json_decode(ew_StripSlashes(@$_POST["filter"]), TRUE);
		$this->Command = "search";

		// Field id
		$this->id->AdvancedSearch->SearchValue = @$filter["x_id"];
		$this->id->AdvancedSearch->SearchOperator = @$filter["z_id"];
		$this->id->AdvancedSearch->SearchCondition = @$filter["v_id"];
		$this->id->AdvancedSearch->SearchValue2 = @$filter["y_id"];
		$this->id->AdvancedSearch->SearchOperator2 = @$filter["w_id"];
		$this->id->AdvancedSearch->Save();

		// Field siswa_id
		$this->siswa_id->AdvancedSearch->SearchValue = @$filter["x_siswa_id"];
		$this->siswa_id->AdvancedSearch->SearchOperator = @$filter["z_siswa_id"];
		$this->siswa_id->AdvancedSearch->SearchCondition = @$filter["v_siswa_id"];
		$this->siswa_id->AdvancedSearch->SearchValue2 = @$filter["y_siswa_id"];
		$this->siswa_id->AdvancedSearch->SearchOperator2 = @$filter["w_siswa_id"];
		$this->siswa_id->AdvancedSearch->Save();

		// Field Siswa_Nomor_Induk
		$this->Siswa_Nomor_Induk->AdvancedSearch->SearchValue = @$filter["x_Siswa_Nomor_Induk"];
		$this->Siswa_Nomor_Induk->AdvancedSearch->SearchOperator = @$filter["z_Siswa_Nomor_Induk"];
		$this->Siswa_Nomor_Induk->AdvancedSearch->SearchCondition = @$filter["v_Siswa_Nomor_Induk"];
		$this->Siswa_Nomor_Induk->AdvancedSearch->SearchValue2 = @$filter["y_Siswa_Nomor_Induk"];
		$this->Siswa_Nomor_Induk->AdvancedSearch->SearchOperator2 = @$filter["w_Siswa_Nomor_Induk"];
		$this->Siswa_Nomor_Induk->AdvancedSearch->Save();

		// Field Siswa_Nama
		$this->Siswa_Nama->AdvancedSearch->SearchValue = @$filter["x_Siswa_Nama"];
		$this->Siswa_Nama->AdvancedSearch->SearchOperator = @$filter["z_Siswa_Nama"];
		$this->Siswa_Nama->AdvancedSearch->SearchCondition = @$filter["v_Siswa_Nama"];
		$this->Siswa_Nama->AdvancedSearch->SearchValue2 = @$filter["y_Siswa_Nama"];
		$this->Siswa_Nama->AdvancedSearch->SearchOperator2 = @$filter["w_Siswa_Nama"];
		$this->Siswa_Nama->AdvancedSearch->Save();

		// Field nonrutin_id
		$this->nonrutin_id->AdvancedSearch->SearchValue = @$filter["x_nonrutin_id"];
		$this->nonrutin_id->AdvancedSearch->SearchOperator = @$filter["z_nonrutin_id"];
		$this->nonrutin_id->AdvancedSearch->SearchCondition = @$filter["v_nonrutin_id"];
		$this->nonrutin_id->AdvancedSearch->SearchValue2 = @$filter["y_nonrutin_id"];
		$this->nonrutin_id->AdvancedSearch->SearchOperator2 = @$filter["w_nonrutin_id"];
		$this->nonrutin_id->AdvancedSearch->Save();

		// Field Nilai
		$this->Nilai->AdvancedSearch->SearchValue = @$filter["x_Nilai"];
		$this->Nilai->AdvancedSearch->SearchOperator = @$filter["z_Nilai"];
		$this->Nilai->AdvancedSearch->SearchCondition = @$filter["v_Nilai"];
		$this->Nilai->AdvancedSearch->SearchValue2 = @$filter["y_Nilai"];
		$this->Nilai->AdvancedSearch->SearchOperator2 = @$filter["w_Nilai"];
		$this->Nilai->AdvancedSearch->Save();

		// Field Terbayar
		$this->Terbayar->AdvancedSearch->SearchValue = @$filter["x_Terbayar"];
		$this->Terbayar->AdvancedSearch->SearchOperator = @$filter["z_Terbayar"];
		$this->Terbayar->AdvancedSearch->SearchCondition = @$filter["v_Terbayar"];
		$this->Terbayar->AdvancedSearch->SearchValue2 = @$filter["y_Terbayar"];
		$this->Terbayar->AdvancedSearch->SearchOperator2 = @$filter["w_Terbayar"];
		$this->Terbayar->AdvancedSearch->Save();

		// Field Sisa
		$this->Sisa->AdvancedSearch->SearchValue = @$filter["x_Sisa"];
		$this->Sisa->AdvancedSearch->SearchOperator = @$filter["z_Sisa"];
		$this->Sisa->AdvancedSearch->SearchCondition = @$filter["v_Sisa"];
		$this->Sisa->AdvancedSearch->SearchValue2 = @$filter["y_Sisa"];
		$this->Sisa->AdvancedSearch->SearchOperator2 = @$filter["w_Sisa"];
		$this->Sisa->AdvancedSearch->Save();
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere($Default = FALSE) {
		global $Security;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $this->id, $Default, FALSE); // id
		$this->BuildSearchSql($sWhere, $this->siswa_id, $Default, FALSE); // siswa_id
		$this->BuildSearchSql($sWhere, $this->Siswa_Nomor_Induk, $Default, FALSE); // Siswa_Nomor_Induk
		$this->BuildSearchSql($sWhere, $this->Siswa_Nama, $Default, FALSE); // Siswa_Nama
		$this->BuildSearchSql($sWhere, $this->nonrutin_id, $Default, FALSE); // nonrutin_id
		$this->BuildSearchSql($sWhere, $this->Nilai, $Default, FALSE); // Nilai
		$this->BuildSearchSql($sWhere, $this->Terbayar, $Default, FALSE); // Terbayar
		$this->BuildSearchSql($sWhere, $this->Sisa, $Default, FALSE); // Sisa

		// Set up search parm
		if (!$Default && $sWhere <> "") {
			$this->Command = "search";
		}
		if (!$Default && $this->Command == "search") {
			$this->id->AdvancedSearch->Save(); // id
			$this->siswa_id->AdvancedSearch->Save(); // siswa_id
			$this->Siswa_Nomor_Induk->AdvancedSearch->Save(); // Siswa_Nomor_Induk
			$this->Siswa_Nama->AdvancedSearch->Save(); // Siswa_Nama
			$this->nonrutin_id->AdvancedSearch->Save(); // nonrutin_id
			$this->Nilai->AdvancedSearch->Save(); // Nilai
			$this->Terbayar->AdvancedSearch->Save(); // Terbayar
			$this->Sisa->AdvancedSearch->Save(); // Sisa
		}
		return $sWhere;
	}

	// Build search SQL
	function BuildSearchSql(&$Where, &$Fld, $Default, $MultiValue) {
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = ($Default) ? $Fld->AdvancedSearch->SearchValueDefault : $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldOpr = ($Default) ? $Fld->AdvancedSearch->SearchOperatorDefault : $Fld->AdvancedSearch->SearchOperator; // @$_GET["z_$FldParm"]
		$FldCond = ($Default) ? $Fld->AdvancedSearch->SearchConditionDefault : $Fld->AdvancedSearch->SearchCondition; // @$_GET["v_$FldParm"]
		$FldVal2 = ($Default) ? $Fld->AdvancedSearch->SearchValue2Default : $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldOpr2 = ($Default) ? $Fld->AdvancedSearch->SearchOperator2Default : $Fld->AdvancedSearch->SearchOperator2; // @$_GET["w_$FldParm"]
		$sWrk = "";

		//$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);

		//$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$FldOpr = strtoupper(trim($FldOpr));
		if ($FldOpr == "") $FldOpr = "=";
		$FldOpr2 = strtoupper(trim($FldOpr2));
		if ($FldOpr2 == "") $FldOpr2 = "=";
		if (EW_SEARCH_MULTI_VALUE_OPTION == 1)
			$MultiValue = FALSE;
		if ($MultiValue) {
			$sWrk1 = ($FldVal <> "") ? ew_GetMultiSearchSql($Fld, $FldOpr, $FldVal, $this->DBID) : ""; // Field value 1
			$sWrk2 = ($FldVal2 <> "") ? ew_GetMultiSearchSql($Fld, $FldOpr2, $FldVal2, $this->DBID) : ""; // Field value 2
			$sWrk = $sWrk1; // Build final SQL
			if ($sWrk2 <> "")
				$sWrk = ($sWrk <> "") ? "($sWrk) $FldCond ($sWrk2)" : $sWrk2;
		} else {
			$FldVal = $this->ConvertSearchValue($Fld, $FldVal);
			$FldVal2 = $this->ConvertSearchValue($Fld, $FldVal2);
			$sWrk = ew_GetSearchSql($Fld, $FldVal, $FldOpr, $FldCond, $FldVal2, $FldOpr2, $this->DBID);
		}
		ew_AddFilter($Where, $sWrk);
	}

	// Convert search value
	function ConvertSearchValue(&$Fld, $FldVal) {
		if ($FldVal == EW_NULL_VALUE || $FldVal == EW_NOT_NULL_VALUE)
			return $FldVal;
		$Value = $FldVal;
		if ($Fld->FldDataType == EW_DATATYPE_BOOLEAN) {
			if ($FldVal <> "") $Value = ($FldVal == "1" || strtolower(strval($FldVal)) == "y" || strtolower(strval($FldVal)) == "t") ? $Fld->TrueValue : $Fld->FalseValue;
		} elseif ($Fld->FldDataType == EW_DATATYPE_DATE || $Fld->FldDataType == EW_DATATYPE_TIME) {
			if ($FldVal <> "") $Value = ew_UnFormatDateTime($FldVal, $Fld->FldDateTimeFormat);
		}
		return $Value;
	}

	// Check if search parm exists
	function CheckSearchParms() {
		if ($this->id->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->siswa_id->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->Siswa_Nomor_Induk->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->Siswa_Nama->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->nonrutin_id->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->Nilai->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->Terbayar->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->Sisa->AdvancedSearch->IssetSession())
			return TRUE;
		return FALSE;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$this->setSearchWhere($this->SearchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Load advanced search default values
	function LoadAdvancedSearchDefault() {
		return FALSE;
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		$this->id->AdvancedSearch->UnsetSession();
		$this->siswa_id->AdvancedSearch->UnsetSession();
		$this->Siswa_Nomor_Induk->AdvancedSearch->UnsetSession();
		$this->Siswa_Nama->AdvancedSearch->UnsetSession();
		$this->nonrutin_id->AdvancedSearch->UnsetSession();
		$this->Nilai->AdvancedSearch->UnsetSession();
		$this->Terbayar->AdvancedSearch->UnsetSession();
		$this->Sisa->AdvancedSearch->UnsetSession();
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		$this->RestoreSearch = TRUE;

		// Restore advanced search values
		$this->id->AdvancedSearch->Load();
		$this->siswa_id->AdvancedSearch->Load();
		$this->Siswa_Nomor_Induk->AdvancedSearch->Load();
		$this->Siswa_Nama->AdvancedSearch->Load();
		$this->nonrutin_id->AdvancedSearch->Load();
		$this->Nilai->AdvancedSearch->Load();
		$this->Terbayar->AdvancedSearch->Load();
		$this->Sisa->AdvancedSearch->Load();
	}

	// Set up sort parameters
	function SetUpSortOrder() {

		// Check for Ctrl pressed
		$bCtrl = (@$_GET["ctrl"] <> "");

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$this->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$this->CurrentOrderType = @$_GET["ordertype"];
			$this->UpdateSort($this->Siswa_Nomor_Induk, $bCtrl); // Siswa_Nomor_Induk
			$this->UpdateSort($this->Siswa_Nama, $bCtrl); // Siswa_Nama
			$this->UpdateSort($this->nonrutin_id, $bCtrl); // nonrutin_id
			$this->UpdateSort($this->Nilai, $bCtrl); // Nilai
			$this->UpdateSort($this->Terbayar, $bCtrl); // Terbayar
			$this->UpdateSort($this->Sisa, $bCtrl); // Sisa
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

			// Reset search criteria
			if ($this->Command == "reset" || $this->Command == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$sOrderBy = "";
				$this->setSessionOrderBy($sOrderBy);
				$this->Siswa_Nomor_Induk->setSort("");
				$this->Siswa_Nama->setSort("");
				$this->nonrutin_id->setSort("");
				$this->Nilai->setSort("");
				$this->Terbayar->setSort("");
				$this->Sisa->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language;

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

		// "detail_t09_siswanonrutinbayar"
		$item = &$this->ListOptions->Add("detail_t09_siswanonrutinbayar");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->AllowList(CurrentProjectID() . 't09_siswanonrutinbayar') && !$this->ShowMultipleDetails;
		$item->OnLeft = TRUE;
		$item->ShowInButtonGroup = FALSE;
		if (!isset($GLOBALS["t09_siswanonrutinbayar_grid"])) $GLOBALS["t09_siswanonrutinbayar_grid"] = new ct09_siswanonrutinbayar_grid;

		// Multiple details
		if ($this->ShowMultipleDetails) {
			$item = &$this->ListOptions->Add("details");
			$item->CssStyle = "white-space: nowrap;";
			$item->Visible = $this->ShowMultipleDetails;
			$item->OnLeft = TRUE;
			$item->ShowInButtonGroup = FALSE;
		}

		// Set up detail pages
		$pages = new cSubPages();
		$pages->Add("t09_siswanonrutinbayar");
		$this->DetailPages = $pages;

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

		// "sequence"
		$oListOpt = &$this->ListOptions->Items["sequence"];
		$oListOpt->Body = ew_FormatSeqNo($this->RecCnt);

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
		$DetailViewTblVar = "";
		$DetailCopyTblVar = "";
		$DetailEditTblVar = "";

		// "detail_t09_siswanonrutinbayar"
		$oListOpt = &$this->ListOptions->Items["detail_t09_siswanonrutinbayar"];
		if ($Security->AllowList(CurrentProjectID() . 't09_siswanonrutinbayar')) {
			$body = $Language->Phrase("DetailLink") . $Language->TablePhrase("t09_siswanonrutinbayar", "TblCaption");
			$body = "<a class=\"btn btn-default btn-sm ewRowLink ewDetail\" data-action=\"list\" href=\"" . ew_HtmlEncode("t09_siswanonrutinbayarlist.php?" . EW_TABLE_SHOW_MASTER . "=v01_siswanonrutin&fk_id=" . urlencode(strval($this->id->CurrentValue)) . "") . "\">" . $body . "</a>";
			$links = "";
			if ($GLOBALS["t09_siswanonrutinbayar_grid"]->DetailView && $Security->CanView() && $Security->AllowView(CurrentProjectID() . 't09_siswanonrutinbayar')) {
				$links .= "<li><a class=\"ewRowLink ewDetailView\" data-action=\"view\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("MasterDetailViewLink")) . "\" href=\"" . ew_HtmlEncode($this->GetViewUrl(EW_TABLE_SHOW_DETAIL . "=t09_siswanonrutinbayar")) . "\">" . ew_HtmlImageAndText($Language->Phrase("MasterDetailViewLink")) . "</a></li>";
				if ($DetailViewTblVar <> "") $DetailViewTblVar .= ",";
				$DetailViewTblVar .= "t09_siswanonrutinbayar";
			}
			if ($GLOBALS["t09_siswanonrutinbayar_grid"]->DetailEdit && $Security->CanEdit() && $Security->AllowEdit(CurrentProjectID() . 't09_siswanonrutinbayar')) {
				$links .= "<li><a class=\"ewRowLink ewDetailEdit\" data-action=\"edit\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("MasterDetailEditLink")) . "\" href=\"" . ew_HtmlEncode($this->GetEditUrl(EW_TABLE_SHOW_DETAIL . "=t09_siswanonrutinbayar")) . "\">" . ew_HtmlImageAndText($Language->Phrase("MasterDetailEditLink")) . "</a></li>";
				if ($DetailEditTblVar <> "") $DetailEditTblVar .= ",";
				$DetailEditTblVar .= "t09_siswanonrutinbayar";
			}
			if ($links <> "") {
				$body .= "<button class=\"dropdown-toggle btn btn-default btn-sm ewDetail\" data-toggle=\"dropdown\"><b class=\"caret\"></b></button>";
				$body .= "<ul class=\"dropdown-menu\">". $links . "</ul>";
			}
			$body = "<div class=\"btn-group\">" . $body . "</div>";
			$oListOpt->Body = $body;
			if ($this->ShowMultipleDetails) $oListOpt->Visible = FALSE;
		}
		if ($this->ShowMultipleDetails) {
			$body = $Language->Phrase("MultipleMasterDetails");
			$body = "<div class=\"btn-group\">";
			$links = "";
			if ($DetailViewTblVar <> "") {
				$links .= "<li><a class=\"ewRowLink ewDetailView\" data-action=\"view\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("MasterDetailViewLink")) . "\" href=\"" . ew_HtmlEncode($this->GetViewUrl(EW_TABLE_SHOW_DETAIL . "=" . $DetailViewTblVar)) . "\">" . ew_HtmlImageAndText($Language->Phrase("MasterDetailViewLink")) . "</a></li>";
			}
			if ($DetailEditTblVar <> "") {
				$links .= "<li><a class=\"ewRowLink ewDetailEdit\" data-action=\"edit\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("MasterDetailEditLink")) . "\" href=\"" . ew_HtmlEncode($this->GetEditUrl(EW_TABLE_SHOW_DETAIL . "=" . $DetailEditTblVar)) . "\">" . ew_HtmlImageAndText($Language->Phrase("MasterDetailEditLink")) . "</a></li>";
			}
			if ($DetailCopyTblVar <> "") {
				$links .= "<li><a class=\"ewRowLink ewDetailCopy\" data-action=\"add\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("MasterDetailCopyLink")) . "\" href=\"" . ew_HtmlEncode($this->GetCopyUrl(EW_TABLE_SHOW_DETAIL . "=" . $DetailCopyTblVar)) . "\">" . ew_HtmlImageAndText($Language->Phrase("MasterDetailCopyLink")) . "</a></li>";
			}
			if ($links <> "") {
				$body .= "<button class=\"dropdown-toggle btn btn-default btn-sm ewMasterDetail\" title=\"" . ew_HtmlTitle($Language->Phrase("MultipleMasterDetails")) . "\" data-toggle=\"dropdown\">" . $Language->Phrase("MultipleMasterDetails") . "<b class=\"caret\"></b></button>";
				$body .= "<ul class=\"dropdown-menu ewMenu\">". $links . "</ul>";
			}
			$body .= "</div>";

			// Multiple details
			$oListOpt = &$this->ListOptions->Items["details"];
			$oListOpt->Body = $body;
		}

		// "checkbox"
		$oListOpt = &$this->ListOptions->Items["checkbox"];
		$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" value=\"" . ew_HtmlEncode($this->id->CurrentValue) . "\" onclick='ew_ClickMultiCheckbox(event);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set up other options
	function SetupOtherOptions() {
		global $Language, $Security;
		$options = &$this->OtherOptions;
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
		$item->Body = "<a class=\"ewSaveFilter\" data-form=\"fv01_siswanonrutinlistsrch\" href=\"#\">" . $Language->Phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->Add("deletefilter");
		$item->Body = "<a class=\"ewDeleteFilter\" data-form=\"fv01_siswanonrutinlistsrch\" href=\"#\">" . $Language->Phrase("DeleteFilter") . "</a>";
		$item->Visible = TRUE;
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
			$option = &$options["action"];

			// Set up list action buttons
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == EW_ACTION_MULTIPLE) {
					$item = &$option->Add("custom_" . $listaction->Action);
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon <> "") ? "<span class=\"" . ew_HtmlEncode($listaction->Icon) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\"></span> " : $caption;
					$item->Body = "<a class=\"ewAction ewListAction\" title=\"" . ew_HtmlEncode($caption) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({f:document.fv01_siswanonrutinlist}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . "</a>";
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

		// Search button
		$item = &$this->SearchOptions->Add("searchtoggle");
		$SearchToggleClass = ($this->SearchWhere <> "") ? " active" : " active";
		$item->Body = "<button type=\"button\" class=\"btn btn-default ewSearchToggle" . $SearchToggleClass . "\" title=\"" . $Language->Phrase("SearchPanel") . "\" data-caption=\"" . $Language->Phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fv01_siswanonrutinlistsrch\">" . $Language->Phrase("SearchBtn") . "</button>";
		$item->Visible = TRUE;

		// Show all button
		$item = &$this->SearchOptions->Add("showall");
		$item->Body = "<a class=\"btn btn-default ewShowAll\" title=\"" . $Language->Phrase("ResetSearch") . "\" data-caption=\"" . $Language->Phrase("ResetSearch") . "\" href=\"" . $this->PageUrl() . "cmd=reset\">" . $Language->Phrase("ResetSearchBtn") . "</a>";
		$item->Visible = ($this->SearchWhere <> $this->DefaultSearchWhere && $this->SearchWhere <> "0=101");

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

	// Load search values for validation
	function LoadSearchValues() {
		global $objForm;

		// Load search values
		// id

		$this->id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_id"]);
		if ($this->id->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->id->AdvancedSearch->SearchOperator = @$_GET["z_id"];

		// siswa_id
		$this->siswa_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_siswa_id"]);
		if ($this->siswa_id->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->siswa_id->AdvancedSearch->SearchOperator = @$_GET["z_siswa_id"];

		// Siswa_Nomor_Induk
		$this->Siswa_Nomor_Induk->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Siswa_Nomor_Induk"]);
		if ($this->Siswa_Nomor_Induk->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->Siswa_Nomor_Induk->AdvancedSearch->SearchOperator = @$_GET["z_Siswa_Nomor_Induk"];

		// Siswa_Nama
		$this->Siswa_Nama->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Siswa_Nama"]);
		if ($this->Siswa_Nama->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->Siswa_Nama->AdvancedSearch->SearchOperator = @$_GET["z_Siswa_Nama"];

		// nonrutin_id
		$this->nonrutin_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_nonrutin_id"]);
		if ($this->nonrutin_id->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->nonrutin_id->AdvancedSearch->SearchOperator = @$_GET["z_nonrutin_id"];

		// Nilai
		$this->Nilai->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Nilai"]);
		if ($this->Nilai->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->Nilai->AdvancedSearch->SearchOperator = @$_GET["z_Nilai"];

		// Terbayar
		$this->Terbayar->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Terbayar"]);
		if ($this->Terbayar->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->Terbayar->AdvancedSearch->SearchOperator = @$_GET["z_Terbayar"];

		// Sisa
		$this->Sisa->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Sisa"]);
		if ($this->Sisa->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->Sisa->AdvancedSearch->SearchOperator = @$_GET["z_Sisa"];
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
		$this->nonrutin_id->setDbValue($rs->fields('nonrutin_id'));
		$this->Nilai->setDbValue($rs->fields('Nilai'));
		$this->Terbayar->setDbValue($rs->fields('Terbayar'));
		$this->Sisa->setDbValue($rs->fields('Sisa'));
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->siswa_id->DbValue = $row['siswa_id'];
		$this->Siswa_Nomor_Induk->DbValue = $row['Siswa_Nomor_Induk'];
		$this->Siswa_Nama->DbValue = $row['Siswa_Nama'];
		$this->nonrutin_id->DbValue = $row['nonrutin_id'];
		$this->Nilai->DbValue = $row['Nilai'];
		$this->Terbayar->DbValue = $row['Terbayar'];
		$this->Sisa->DbValue = $row['Sisa'];
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
		if ($this->Nilai->FormValue == $this->Nilai->CurrentValue && is_numeric(ew_StrToFloat($this->Nilai->CurrentValue)))
			$this->Nilai->CurrentValue = ew_StrToFloat($this->Nilai->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Terbayar->FormValue == $this->Terbayar->CurrentValue && is_numeric(ew_StrToFloat($this->Terbayar->CurrentValue)))
			$this->Terbayar->CurrentValue = ew_StrToFloat($this->Terbayar->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Sisa->FormValue == $this->Sisa->CurrentValue && is_numeric(ew_StrToFloat($this->Sisa->CurrentValue)))
			$this->Sisa->CurrentValue = ew_StrToFloat($this->Sisa->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// id
		// siswa_id
		// Siswa_Nomor_Induk
		// Siswa_Nama
		// nonrutin_id
		// Nilai
		// Terbayar
		// Sisa

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

		// nonrutin_id
		$this->nonrutin_id->ViewValue = $this->nonrutin_id->CurrentValue;
		if (strval($this->nonrutin_id->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->nonrutin_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `Nama` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t07_nonrutin`";
		$sWhereWrk = "";
		$this->nonrutin_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->nonrutin_id, $sWhereWrk); // Call Lookup selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->nonrutin_id->ViewValue = $this->nonrutin_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->nonrutin_id->ViewValue = $this->nonrutin_id->CurrentValue;
			}
		} else {
			$this->nonrutin_id->ViewValue = NULL;
		}
		$this->nonrutin_id->ViewCustomAttributes = "";

		// Nilai
		$this->Nilai->ViewValue = $this->Nilai->CurrentValue;
		$this->Nilai->ViewValue = ew_FormatNumber($this->Nilai->ViewValue, 2, -2, -2, -2);
		$this->Nilai->CellCssStyle .= "text-align: right;";
		$this->Nilai->ViewCustomAttributes = "";

		// Terbayar
		$this->Terbayar->ViewValue = $this->Terbayar->CurrentValue;
		$this->Terbayar->ViewValue = ew_FormatNumber($this->Terbayar->ViewValue, 2, -2, -2, -2);
		$this->Terbayar->CellCssStyle .= "text-align: right;";
		$this->Terbayar->ViewCustomAttributes = "";

		// Sisa
		$this->Sisa->ViewValue = $this->Sisa->CurrentValue;
		$this->Sisa->ViewValue = ew_FormatNumber($this->Sisa->ViewValue, 2, -2, -2, -2);
		$this->Sisa->CellCssStyle .= "text-align: right;";
		$this->Sisa->ViewCustomAttributes = "";

			// Siswa_Nomor_Induk
			$this->Siswa_Nomor_Induk->LinkCustomAttributes = "";
			$this->Siswa_Nomor_Induk->HrefValue = "";
			$this->Siswa_Nomor_Induk->TooltipValue = "";

			// Siswa_Nama
			$this->Siswa_Nama->LinkCustomAttributes = "";
			$this->Siswa_Nama->HrefValue = "";
			$this->Siswa_Nama->TooltipValue = "";

			// nonrutin_id
			$this->nonrutin_id->LinkCustomAttributes = "";
			$this->nonrutin_id->HrefValue = "";
			$this->nonrutin_id->TooltipValue = "";

			// Nilai
			$this->Nilai->LinkCustomAttributes = "";
			$this->Nilai->HrefValue = "";
			$this->Nilai->TooltipValue = "";

			// Terbayar
			$this->Terbayar->LinkCustomAttributes = "";
			$this->Terbayar->HrefValue = "";
			$this->Terbayar->TooltipValue = "";

			// Sisa
			$this->Sisa->LinkCustomAttributes = "";
			$this->Sisa->HrefValue = "";
			$this->Sisa->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// Siswa_Nomor_Induk
			$this->Siswa_Nomor_Induk->EditAttrs["class"] = "form-control";
			$this->Siswa_Nomor_Induk->EditCustomAttributes = "";
			$this->Siswa_Nomor_Induk->EditValue = ew_HtmlEncode($this->Siswa_Nomor_Induk->AdvancedSearch->SearchValue);
			$this->Siswa_Nomor_Induk->PlaceHolder = ew_RemoveHtml($this->Siswa_Nomor_Induk->FldCaption());

			// Siswa_Nama
			$this->Siswa_Nama->EditAttrs["class"] = "form-control";
			$this->Siswa_Nama->EditCustomAttributes = "";
			$this->Siswa_Nama->EditValue = ew_HtmlEncode($this->Siswa_Nama->AdvancedSearch->SearchValue);
			$this->Siswa_Nama->PlaceHolder = ew_RemoveHtml($this->Siswa_Nama->FldCaption());

			// nonrutin_id
			$this->nonrutin_id->EditAttrs["class"] = "form-control";
			$this->nonrutin_id->EditCustomAttributes = "";
			$this->nonrutin_id->EditValue = ew_HtmlEncode($this->nonrutin_id->AdvancedSearch->SearchValue);
			$this->nonrutin_id->PlaceHolder = ew_RemoveHtml($this->nonrutin_id->FldCaption());

			// Nilai
			$this->Nilai->EditAttrs["class"] = "form-control";
			$this->Nilai->EditCustomAttributes = "";
			$this->Nilai->EditValue = ew_HtmlEncode($this->Nilai->AdvancedSearch->SearchValue);
			$this->Nilai->PlaceHolder = ew_RemoveHtml($this->Nilai->FldCaption());

			// Terbayar
			$this->Terbayar->EditAttrs["class"] = "form-control";
			$this->Terbayar->EditCustomAttributes = "";
			$this->Terbayar->EditValue = ew_HtmlEncode($this->Terbayar->AdvancedSearch->SearchValue);
			$this->Terbayar->PlaceHolder = ew_RemoveHtml($this->Terbayar->FldCaption());

			// Sisa
			$this->Sisa->EditAttrs["class"] = "form-control";
			$this->Sisa->EditCustomAttributes = "";
			$this->Sisa->EditValue = ew_HtmlEncode($this->Sisa->AdvancedSearch->SearchValue);
			$this->Sisa->PlaceHolder = ew_RemoveHtml($this->Sisa->FldCaption());
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

	// Validate search
	function ValidateSearch() {
		global $gsSearchError;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;

		// Return validate result
		$ValidateSearch = ($gsSearchError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateSearch = $ValidateSearch && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			ew_AddMessage($gsSearchError, $sFormCustomError);
		}
		return $ValidateSearch;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		$this->id->AdvancedSearch->Load();
		$this->siswa_id->AdvancedSearch->Load();
		$this->Siswa_Nomor_Induk->AdvancedSearch->Load();
		$this->Siswa_Nama->AdvancedSearch->Load();
		$this->nonrutin_id->AdvancedSearch->Load();
		$this->Nilai->AdvancedSearch->Load();
		$this->Terbayar->AdvancedSearch->Load();
		$this->Sisa->AdvancedSearch->Load();
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
		if ($pageId == "list") {
			switch ($fld->FldVar) {
			}
		} elseif ($pageId == "extbs") {
			switch ($fld->FldVar) {
			}
		} 
	}

	// Setup AutoSuggest filters of a field
	function SetupAutoSuggestFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		if ($pageId == "list") {
			switch ($fld->FldVar) {
			}
		} elseif ($pageId == "extbs") {
			switch ($fld->FldVar) {
			}
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
		// sembunyikan button edit dan view data master
		// hanya boleh edit dan view link master/detail

		$this->ListOptions->Items["edit"]->Body = "";
		$this->ListOptions->Items["view"]->Body = "";
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
if (!isset($v01_siswanonrutin_list)) $v01_siswanonrutin_list = new cv01_siswanonrutin_list();

// Page init
$v01_siswanonrutin_list->Page_Init();

// Page main
$v01_siswanonrutin_list->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$v01_siswanonrutin_list->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "list";
var CurrentForm = fv01_siswanonrutinlist = new ew_Form("fv01_siswanonrutinlist", "list");
fv01_siswanonrutinlist.FormKeyCountName = '<?php echo $v01_siswanonrutin_list->FormKeyCountName ?>';

// Form_CustomValidate event
fv01_siswanonrutinlist.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fv01_siswanonrutinlist.ValidateRequired = true;
<?php } else { ?>
fv01_siswanonrutinlist.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
fv01_siswanonrutinlist.Lists["x_nonrutin_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Nama","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t07_nonrutin"};

// Form object for search
var CurrentSearchForm = fv01_siswanonrutinlistsrch = new ew_Form("fv01_siswanonrutinlistsrch");

// Validate function for search
fv01_siswanonrutinlistsrch.Validate = function(fobj) {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	fobj = fobj || this.Form;
	var infix = "";

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}

// Form_CustomValidate event
fv01_siswanonrutinlistsrch.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fv01_siswanonrutinlistsrch.ValidateRequired = true; // Use JavaScript validation
<?php } else { ?>
fv01_siswanonrutinlistsrch.ValidateRequired = false; // No JavaScript validation
<?php } ?>

// Dynamic selection lists
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<div class="ewToolbar">
<?php $Breadcrumb->Render(); ?>
<?php if ($v01_siswanonrutin_list->TotalRecs > 0 && $v01_siswanonrutin_list->ExportOptions->Visible()) { ?>
<?php $v01_siswanonrutin_list->ExportOptions->Render("body") ?>
<?php } ?>
<?php if ($v01_siswanonrutin_list->SearchOptions->Visible()) { ?>
<?php $v01_siswanonrutin_list->SearchOptions->Render("body") ?>
<?php } ?>
<?php if ($v01_siswanonrutin_list->FilterOptions->Visible()) { ?>
<?php $v01_siswanonrutin_list->FilterOptions->Render("body") ?>
<?php } ?>
<?php echo $Language->SelectionForm(); ?>
<div class="clearfix"></div>
</div>
<?php
	$bSelectLimit = $v01_siswanonrutin_list->UseSelectLimit;
	if ($bSelectLimit) {
		if ($v01_siswanonrutin_list->TotalRecs <= 0)
			$v01_siswanonrutin_list->TotalRecs = $v01_siswanonrutin->SelectRecordCount();
	} else {
		if (!$v01_siswanonrutin_list->Recordset && ($v01_siswanonrutin_list->Recordset = $v01_siswanonrutin_list->LoadRecordset()))
			$v01_siswanonrutin_list->TotalRecs = $v01_siswanonrutin_list->Recordset->RecordCount();
	}
	$v01_siswanonrutin_list->StartRec = 1;
	if ($v01_siswanonrutin_list->DisplayRecs <= 0 || ($v01_siswanonrutin->Export <> "" && $v01_siswanonrutin->ExportAll)) // Display all records
		$v01_siswanonrutin_list->DisplayRecs = $v01_siswanonrutin_list->TotalRecs;
	if (!($v01_siswanonrutin->Export <> "" && $v01_siswanonrutin->ExportAll))
		$v01_siswanonrutin_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$v01_siswanonrutin_list->Recordset = $v01_siswanonrutin_list->LoadRecordset($v01_siswanonrutin_list->StartRec-1, $v01_siswanonrutin_list->DisplayRecs);

	// Set no record found message
	if ($v01_siswanonrutin->CurrentAction == "" && $v01_siswanonrutin_list->TotalRecs == 0) {
		if (!$Security->CanList())
			$v01_siswanonrutin_list->setWarningMessage(ew_DeniedMsg());
		if ($v01_siswanonrutin_list->SearchWhere == "0=101")
			$v01_siswanonrutin_list->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$v01_siswanonrutin_list->setWarningMessage($Language->Phrase("NoRecord"));
	}

	// Audit trail on search
	if ($v01_siswanonrutin_list->AuditTrailOnSearch && $v01_siswanonrutin_list->Command == "search" && !$v01_siswanonrutin_list->RestoreSearch) {
		$searchparm = ew_ServerVar("QUERY_STRING");
		$searchsql = $v01_siswanonrutin_list->getSessionWhere();
		$v01_siswanonrutin_list->WriteAuditTrailOnSearch($searchparm, $searchsql);
	}
$v01_siswanonrutin_list->RenderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if ($v01_siswanonrutin->Export == "" && $v01_siswanonrutin->CurrentAction == "") { ?>
<form name="fv01_siswanonrutinlistsrch" id="fv01_siswanonrutinlistsrch" class="form-inline ewForm" action="<?php echo ew_CurrentPage() ?>">
<?php $SearchPanelClass = ($v01_siswanonrutin_list->SearchWhere <> "") ? " in" : " in"; ?>
<div id="fv01_siswanonrutinlistsrch_SearchPanel" class="ewSearchPanel collapse<?php echo $SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="v01_siswanonrutin">
	<div class="ewBasicSearch">
<?php
if ($gsSearchError == "")
	$v01_siswanonrutin_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$v01_siswanonrutin->RowType = EW_ROWTYPE_SEARCH;

// Render row
$v01_siswanonrutin->ResetAttrs();
$v01_siswanonrutin_list->RenderRow();
?>
<div id="xsr_1" class="ewRow">
<?php if ($v01_siswanonrutin->Siswa_Nomor_Induk->Visible) { // Siswa_Nomor_Induk ?>
	<div id="xsc_Siswa_Nomor_Induk" class="ewCell form-group">
		<label for="x_Siswa_Nomor_Induk" class="ewSearchCaption ewLabel"><?php echo $v01_siswanonrutin->Siswa_Nomor_Induk->FldCaption() ?></label>
		<span class="ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_Siswa_Nomor_Induk" id="z_Siswa_Nomor_Induk" value="LIKE"></span>
		<span class="ewSearchField">
<input type="text" data-table="v01_siswanonrutin" data-field="x_Siswa_Nomor_Induk" name="x_Siswa_Nomor_Induk" id="x_Siswa_Nomor_Induk" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($v01_siswanonrutin->Siswa_Nomor_Induk->getPlaceHolder()) ?>" value="<?php echo $v01_siswanonrutin->Siswa_Nomor_Induk->EditValue ?>"<?php echo $v01_siswanonrutin->Siswa_Nomor_Induk->EditAttributes() ?>>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_2" class="ewRow">
<?php if ($v01_siswanonrutin->Siswa_Nama->Visible) { // Siswa_Nama ?>
	<div id="xsc_Siswa_Nama" class="ewCell form-group">
		<label for="x_Siswa_Nama" class="ewSearchCaption ewLabel"><?php echo $v01_siswanonrutin->Siswa_Nama->FldCaption() ?></label>
		<span class="ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_Siswa_Nama" id="z_Siswa_Nama" value="LIKE"></span>
		<span class="ewSearchField">
<input type="text" data-table="v01_siswanonrutin" data-field="x_Siswa_Nama" name="x_Siswa_Nama" id="x_Siswa_Nama" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($v01_siswanonrutin->Siswa_Nama->getPlaceHolder()) ?>" value="<?php echo $v01_siswanonrutin->Siswa_Nama->EditValue ?>"<?php echo $v01_siswanonrutin->Siswa_Nama->EditAttributes() ?>>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_3" class="ewRow">
	<button class="btn btn-primary ewButton" name="btnsubmit" id="btnsubmit" type="submit"><?php echo $Language->Phrase("QuickSearchBtn") ?></button>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $v01_siswanonrutin_list->ShowPageHeader(); ?>
<?php
$v01_siswanonrutin_list->ShowMessage();
?>
<?php if ($v01_siswanonrutin_list->TotalRecs > 0 || $v01_siswanonrutin->CurrentAction <> "") { ?>
<div class="panel panel-default ewGrid v01_siswanonrutin">
<div class="panel-heading ewGridUpperPanel">
<?php if ($v01_siswanonrutin->CurrentAction <> "gridadd" && $v01_siswanonrutin->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="form-inline ewForm ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($v01_siswanonrutin_list->Pager)) $v01_siswanonrutin_list->Pager = new cPrevNextPager($v01_siswanonrutin_list->StartRec, $v01_siswanonrutin_list->DisplayRecs, $v01_siswanonrutin_list->TotalRecs) ?>
<?php if ($v01_siswanonrutin_list->Pager->RecordCount > 0 && $v01_siswanonrutin_list->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($v01_siswanonrutin_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $v01_siswanonrutin_list->PageUrl() ?>start=<?php echo $v01_siswanonrutin_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($v01_siswanonrutin_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $v01_siswanonrutin_list->PageUrl() ?>start=<?php echo $v01_siswanonrutin_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $v01_siswanonrutin_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($v01_siswanonrutin_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $v01_siswanonrutin_list->PageUrl() ?>start=<?php echo $v01_siswanonrutin_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($v01_siswanonrutin_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $v01_siswanonrutin_list->PageUrl() ?>start=<?php echo $v01_siswanonrutin_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $v01_siswanonrutin_list->Pager->PageCount ?></span>
</div>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $v01_siswanonrutin_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $v01_siswanonrutin_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $v01_siswanonrutin_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($v01_siswanonrutin_list->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
</div>
<form name="fv01_siswanonrutinlist" id="fv01_siswanonrutinlist" class="form-inline ewForm ewListForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($v01_siswanonrutin_list->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $v01_siswanonrutin_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="v01_siswanonrutin">
<div id="gmp_v01_siswanonrutin" class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<?php if ($v01_siswanonrutin_list->TotalRecs > 0 || $v01_siswanonrutin->CurrentAction == "gridedit") { ?>
<table id="tbl_v01_siswanonrutinlist" class="table ewTable">
<?php echo $v01_siswanonrutin->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Header row
$v01_siswanonrutin_list->RowType = EW_ROWTYPE_HEADER;

// Render list options
$v01_siswanonrutin_list->RenderListOptions();

// Render list options (header, left)
$v01_siswanonrutin_list->ListOptions->Render("header", "left");
?>
<?php if ($v01_siswanonrutin->Siswa_Nomor_Induk->Visible) { // Siswa_Nomor_Induk ?>
	<?php if ($v01_siswanonrutin->SortUrl($v01_siswanonrutin->Siswa_Nomor_Induk) == "") { ?>
		<th data-name="Siswa_Nomor_Induk"><div id="elh_v01_siswanonrutin_Siswa_Nomor_Induk" class="v01_siswanonrutin_Siswa_Nomor_Induk"><div class="ewTableHeaderCaption"><?php echo $v01_siswanonrutin->Siswa_Nomor_Induk->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Siswa_Nomor_Induk"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $v01_siswanonrutin->SortUrl($v01_siswanonrutin->Siswa_Nomor_Induk) ?>',2);"><div id="elh_v01_siswanonrutin_Siswa_Nomor_Induk" class="v01_siswanonrutin_Siswa_Nomor_Induk">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $v01_siswanonrutin->Siswa_Nomor_Induk->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($v01_siswanonrutin->Siswa_Nomor_Induk->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($v01_siswanonrutin->Siswa_Nomor_Induk->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($v01_siswanonrutin->Siswa_Nama->Visible) { // Siswa_Nama ?>
	<?php if ($v01_siswanonrutin->SortUrl($v01_siswanonrutin->Siswa_Nama) == "") { ?>
		<th data-name="Siswa_Nama"><div id="elh_v01_siswanonrutin_Siswa_Nama" class="v01_siswanonrutin_Siswa_Nama"><div class="ewTableHeaderCaption"><?php echo $v01_siswanonrutin->Siswa_Nama->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Siswa_Nama"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $v01_siswanonrutin->SortUrl($v01_siswanonrutin->Siswa_Nama) ?>',2);"><div id="elh_v01_siswanonrutin_Siswa_Nama" class="v01_siswanonrutin_Siswa_Nama">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $v01_siswanonrutin->Siswa_Nama->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($v01_siswanonrutin->Siswa_Nama->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($v01_siswanonrutin->Siswa_Nama->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($v01_siswanonrutin->nonrutin_id->Visible) { // nonrutin_id ?>
	<?php if ($v01_siswanonrutin->SortUrl($v01_siswanonrutin->nonrutin_id) == "") { ?>
		<th data-name="nonrutin_id"><div id="elh_v01_siswanonrutin_nonrutin_id" class="v01_siswanonrutin_nonrutin_id"><div class="ewTableHeaderCaption"><?php echo $v01_siswanonrutin->nonrutin_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nonrutin_id"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $v01_siswanonrutin->SortUrl($v01_siswanonrutin->nonrutin_id) ?>',2);"><div id="elh_v01_siswanonrutin_nonrutin_id" class="v01_siswanonrutin_nonrutin_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $v01_siswanonrutin->nonrutin_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($v01_siswanonrutin->nonrutin_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($v01_siswanonrutin->nonrutin_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($v01_siswanonrutin->Nilai->Visible) { // Nilai ?>
	<?php if ($v01_siswanonrutin->SortUrl($v01_siswanonrutin->Nilai) == "") { ?>
		<th data-name="Nilai"><div id="elh_v01_siswanonrutin_Nilai" class="v01_siswanonrutin_Nilai"><div class="ewTableHeaderCaption"><?php echo $v01_siswanonrutin->Nilai->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Nilai"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $v01_siswanonrutin->SortUrl($v01_siswanonrutin->Nilai) ?>',2);"><div id="elh_v01_siswanonrutin_Nilai" class="v01_siswanonrutin_Nilai">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $v01_siswanonrutin->Nilai->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($v01_siswanonrutin->Nilai->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($v01_siswanonrutin->Nilai->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($v01_siswanonrutin->Terbayar->Visible) { // Terbayar ?>
	<?php if ($v01_siswanonrutin->SortUrl($v01_siswanonrutin->Terbayar) == "") { ?>
		<th data-name="Terbayar"><div id="elh_v01_siswanonrutin_Terbayar" class="v01_siswanonrutin_Terbayar"><div class="ewTableHeaderCaption"><?php echo $v01_siswanonrutin->Terbayar->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Terbayar"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $v01_siswanonrutin->SortUrl($v01_siswanonrutin->Terbayar) ?>',2);"><div id="elh_v01_siswanonrutin_Terbayar" class="v01_siswanonrutin_Terbayar">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $v01_siswanonrutin->Terbayar->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($v01_siswanonrutin->Terbayar->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($v01_siswanonrutin->Terbayar->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($v01_siswanonrutin->Sisa->Visible) { // Sisa ?>
	<?php if ($v01_siswanonrutin->SortUrl($v01_siswanonrutin->Sisa) == "") { ?>
		<th data-name="Sisa"><div id="elh_v01_siswanonrutin_Sisa" class="v01_siswanonrutin_Sisa"><div class="ewTableHeaderCaption"><?php echo $v01_siswanonrutin->Sisa->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Sisa"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $v01_siswanonrutin->SortUrl($v01_siswanonrutin->Sisa) ?>',2);"><div id="elh_v01_siswanonrutin_Sisa" class="v01_siswanonrutin_Sisa">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $v01_siswanonrutin->Sisa->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($v01_siswanonrutin->Sisa->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($v01_siswanonrutin->Sisa->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$v01_siswanonrutin_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($v01_siswanonrutin->ExportAll && $v01_siswanonrutin->Export <> "") {
	$v01_siswanonrutin_list->StopRec = $v01_siswanonrutin_list->TotalRecs;
} else {

	// Set the last record to display
	if ($v01_siswanonrutin_list->TotalRecs > $v01_siswanonrutin_list->StartRec + $v01_siswanonrutin_list->DisplayRecs - 1)
		$v01_siswanonrutin_list->StopRec = $v01_siswanonrutin_list->StartRec + $v01_siswanonrutin_list->DisplayRecs - 1;
	else
		$v01_siswanonrutin_list->StopRec = $v01_siswanonrutin_list->TotalRecs;
}
$v01_siswanonrutin_list->RecCnt = $v01_siswanonrutin_list->StartRec - 1;
if ($v01_siswanonrutin_list->Recordset && !$v01_siswanonrutin_list->Recordset->EOF) {
	$v01_siswanonrutin_list->Recordset->MoveFirst();
	$bSelectLimit = $v01_siswanonrutin_list->UseSelectLimit;
	if (!$bSelectLimit && $v01_siswanonrutin_list->StartRec > 1)
		$v01_siswanonrutin_list->Recordset->Move($v01_siswanonrutin_list->StartRec - 1);
} elseif (!$v01_siswanonrutin->AllowAddDeleteRow && $v01_siswanonrutin_list->StopRec == 0) {
	$v01_siswanonrutin_list->StopRec = $v01_siswanonrutin->GridAddRowCount;
}

// Initialize aggregate
$v01_siswanonrutin->RowType = EW_ROWTYPE_AGGREGATEINIT;
$v01_siswanonrutin->ResetAttrs();
$v01_siswanonrutin_list->RenderRow();
while ($v01_siswanonrutin_list->RecCnt < $v01_siswanonrutin_list->StopRec) {
	$v01_siswanonrutin_list->RecCnt++;
	if (intval($v01_siswanonrutin_list->RecCnt) >= intval($v01_siswanonrutin_list->StartRec)) {
		$v01_siswanonrutin_list->RowCnt++;

		// Set up key count
		$v01_siswanonrutin_list->KeyCount = $v01_siswanonrutin_list->RowIndex;

		// Init row class and style
		$v01_siswanonrutin->ResetAttrs();
		$v01_siswanonrutin->CssClass = "";
		if ($v01_siswanonrutin->CurrentAction == "gridadd") {
		} else {
			$v01_siswanonrutin_list->LoadRowValues($v01_siswanonrutin_list->Recordset); // Load row values
		}
		$v01_siswanonrutin->RowType = EW_ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$v01_siswanonrutin->RowAttrs = array_merge($v01_siswanonrutin->RowAttrs, array('data-rowindex'=>$v01_siswanonrutin_list->RowCnt, 'id'=>'r' . $v01_siswanonrutin_list->RowCnt . '_v01_siswanonrutin', 'data-rowtype'=>$v01_siswanonrutin->RowType));

		// Render row
		$v01_siswanonrutin_list->RenderRow();

		// Render list options
		$v01_siswanonrutin_list->RenderListOptions();
?>
	<tr<?php echo $v01_siswanonrutin->RowAttributes() ?>>
<?php

// Render list options (body, left)
$v01_siswanonrutin_list->ListOptions->Render("body", "left", $v01_siswanonrutin_list->RowCnt);
?>
	<?php if ($v01_siswanonrutin->Siswa_Nomor_Induk->Visible) { // Siswa_Nomor_Induk ?>
		<td data-name="Siswa_Nomor_Induk"<?php echo $v01_siswanonrutin->Siswa_Nomor_Induk->CellAttributes() ?>>
<span id="el<?php echo $v01_siswanonrutin_list->RowCnt ?>_v01_siswanonrutin_Siswa_Nomor_Induk" class="v01_siswanonrutin_Siswa_Nomor_Induk">
<span<?php echo $v01_siswanonrutin->Siswa_Nomor_Induk->ViewAttributes() ?>>
<?php echo $v01_siswanonrutin->Siswa_Nomor_Induk->ListViewValue() ?></span>
</span>
<a id="<?php echo $v01_siswanonrutin_list->PageObjName . "_row_" . $v01_siswanonrutin_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($v01_siswanonrutin->Siswa_Nama->Visible) { // Siswa_Nama ?>
		<td data-name="Siswa_Nama"<?php echo $v01_siswanonrutin->Siswa_Nama->CellAttributes() ?>>
<span id="el<?php echo $v01_siswanonrutin_list->RowCnt ?>_v01_siswanonrutin_Siswa_Nama" class="v01_siswanonrutin_Siswa_Nama">
<span<?php echo $v01_siswanonrutin->Siswa_Nama->ViewAttributes() ?>>
<?php echo $v01_siswanonrutin->Siswa_Nama->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v01_siswanonrutin->nonrutin_id->Visible) { // nonrutin_id ?>
		<td data-name="nonrutin_id"<?php echo $v01_siswanonrutin->nonrutin_id->CellAttributes() ?>>
<span id="el<?php echo $v01_siswanonrutin_list->RowCnt ?>_v01_siswanonrutin_nonrutin_id" class="v01_siswanonrutin_nonrutin_id">
<span<?php echo $v01_siswanonrutin->nonrutin_id->ViewAttributes() ?>>
<?php echo $v01_siswanonrutin->nonrutin_id->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v01_siswanonrutin->Nilai->Visible) { // Nilai ?>
		<td data-name="Nilai"<?php echo $v01_siswanonrutin->Nilai->CellAttributes() ?>>
<span id="el<?php echo $v01_siswanonrutin_list->RowCnt ?>_v01_siswanonrutin_Nilai" class="v01_siswanonrutin_Nilai">
<span<?php echo $v01_siswanonrutin->Nilai->ViewAttributes() ?>>
<?php echo $v01_siswanonrutin->Nilai->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v01_siswanonrutin->Terbayar->Visible) { // Terbayar ?>
		<td data-name="Terbayar"<?php echo $v01_siswanonrutin->Terbayar->CellAttributes() ?>>
<span id="el<?php echo $v01_siswanonrutin_list->RowCnt ?>_v01_siswanonrutin_Terbayar" class="v01_siswanonrutin_Terbayar">
<span<?php echo $v01_siswanonrutin->Terbayar->ViewAttributes() ?>>
<?php echo $v01_siswanonrutin->Terbayar->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v01_siswanonrutin->Sisa->Visible) { // Sisa ?>
		<td data-name="Sisa"<?php echo $v01_siswanonrutin->Sisa->CellAttributes() ?>>
<span id="el<?php echo $v01_siswanonrutin_list->RowCnt ?>_v01_siswanonrutin_Sisa" class="v01_siswanonrutin_Sisa">
<span<?php echo $v01_siswanonrutin->Sisa->ViewAttributes() ?>>
<?php echo $v01_siswanonrutin->Sisa->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$v01_siswanonrutin_list->ListOptions->Render("body", "right", $v01_siswanonrutin_list->RowCnt);
?>
	</tr>
<?php
	}
	if ($v01_siswanonrutin->CurrentAction <> "gridadd")
		$v01_siswanonrutin_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($v01_siswanonrutin->CurrentAction == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($v01_siswanonrutin_list->Recordset)
	$v01_siswanonrutin_list->Recordset->Close();
?>
</div>
<?php } ?>
<?php if ($v01_siswanonrutin_list->TotalRecs == 0 && $v01_siswanonrutin->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($v01_siswanonrutin_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<script type="text/javascript">
fv01_siswanonrutinlistsrch.FilterList = <?php echo $v01_siswanonrutin_list->GetFilterList() ?>;
fv01_siswanonrutinlistsrch.Init();
fv01_siswanonrutinlist.Init();
</script>
<?php
$v01_siswanonrutin_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$v01_siswanonrutin_list->Page_Terminate();
?>
