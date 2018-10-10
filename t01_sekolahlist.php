<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg13.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql13.php") ?>
<?php include_once "phpfn13.php" ?>
<?php include_once "t01_sekolahinfo.php" ?>
<?php include_once "t96_employeesinfo.php" ?>
<?php include_once "userfn13.php" ?>
<?php

//
// Page class
//

$t01_sekolah_list = NULL; // Initialize page object first

class ct01_sekolah_list extends ct01_sekolah {

	// Page ID
	var $PageID = 'list';

	// Project ID
	var $ProjectID = "{9A296957-6EE4-4785-AB71-310FFD71D6FE}";

	// Table name
	var $TableName = 't01_sekolah';

	// Page object name
	var $PageObjName = 't01_sekolah_list';

	// Grid form hidden field names
	var $FormName = 'ft01_sekolahlist';
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

		// Table object (t01_sekolah)
		if (!isset($GLOBALS["t01_sekolah"]) || get_class($GLOBALS["t01_sekolah"]) == "ct01_sekolah") {
			$GLOBALS["t01_sekolah"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t01_sekolah"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "t01_sekolahadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "t01_sekolahdelete.php";
		$this->MultiUpdateUrl = "t01_sekolahupdate.php";

		// Table object (t96_employees)
		if (!isset($GLOBALS['t96_employees'])) $GLOBALS['t96_employees'] = new ct96_employees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 't01_sekolah', TRUE);

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
		$this->FilterOptions->TagClassName = "ewFilterOption ft01_sekolahlistsrch";

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
		$this->NIS->SetVisibility();
		$this->Nama->SetVisibility();
		$this->Alamat->SetVisibility();
		$this->NoTelpHp->SetVisibility();
		$this->TTD1Nama->SetVisibility();
		$this->TTD1Jabatan->SetVisibility();
		$this->TTD2Nama->SetVisibility();
		$this->TTD2Jabatan->SetVisibility();
		$this->Logo->SetVisibility();

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
		global $EW_EXPORT, $t01_sekolah;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($t01_sekolah);
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

				// Switch to inline edit mode
				if ($this->CurrentAction == "edit")
					$this->InlineEditMode();
			} else {
				if (@$_POST["a_list"] <> "") {
					$this->CurrentAction = $_POST["a_list"]; // Get action

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
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

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
		$this->LastAction = $this->CurrentAction; // Save last action
		$this->CurrentAction = ""; // Clear action
		$_SESSION[EW_SESSION_INLINE_MODE] = ""; // Clear inline mode
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

	// Set up sort parameters
	function SetUpSortOrder() {

		// Check for Ctrl pressed
		$bCtrl = (@$_GET["ctrl"] <> "");

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$this->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$this->CurrentOrderType = @$_GET["ordertype"];
			$this->UpdateSort($this->NIS, $bCtrl); // NIS
			$this->UpdateSort($this->Nama, $bCtrl); // Nama
			$this->UpdateSort($this->Alamat, $bCtrl); // Alamat
			$this->UpdateSort($this->NoTelpHp, $bCtrl); // NoTelpHp
			$this->UpdateSort($this->TTD1Nama, $bCtrl); // TTD1Nama
			$this->UpdateSort($this->TTD1Jabatan, $bCtrl); // TTD1Jabatan
			$this->UpdateSort($this->TTD2Nama, $bCtrl); // TTD2Nama
			$this->UpdateSort($this->TTD2Jabatan, $bCtrl); // TTD2Jabatan
			$this->UpdateSort($this->Logo, $bCtrl); // Logo
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

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$sOrderBy = "";
				$this->setSessionOrderBy($sOrderBy);
				$this->NIS->setSort("");
				$this->Nama->setSort("");
				$this->Alamat->setSort("");
				$this->NoTelpHp->setSort("");
				$this->TTD1Nama->setSort("");
				$this->TTD1Jabatan->setSort("");
				$this->TTD2Nama->setSort("");
				$this->TTD2Jabatan->setSort("");
				$this->Logo->setSort("");
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

		// "edit"
		$oListOpt = &$this->ListOptions->Items["edit"];
		$editcaption = ew_HtmlTitle($Language->Phrase("EditLink"));
		if ($Security->CanEdit()) {
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
		$item->Body = "<a class=\"ewSaveFilter\" data-form=\"ft01_sekolahlistsrch\" href=\"#\">" . $Language->Phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = FALSE;
		$item = &$this->FilterOptions->Add("deletefilter");
		$item->Body = "<a class=\"ewDeleteFilter\" data-form=\"ft01_sekolahlistsrch\" href=\"#\">" . $Language->Phrase("DeleteFilter") . "</a>";
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
			$option = &$options["action"];

			// Set up list action buttons
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == EW_ACTION_MULTIPLE) {
					$item = &$option->Add("custom_" . $listaction->Action);
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon <> "") ? "<span class=\"" . ew_HtmlEncode($listaction->Icon) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\"></span> " : $caption;
					$item->Body = "<a class=\"ewAction ewListAction\" title=\"" . ew_HtmlEncode($caption) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({f:document.ft01_sekolahlist}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . "</a>";
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
		$this->NIS->CurrentValue = NULL;
		$this->NIS->OldValue = $this->NIS->CurrentValue;
		$this->Nama->CurrentValue = NULL;
		$this->Nama->OldValue = $this->Nama->CurrentValue;
		$this->Alamat->CurrentValue = NULL;
		$this->Alamat->OldValue = $this->Alamat->CurrentValue;
		$this->NoTelpHp->CurrentValue = NULL;
		$this->NoTelpHp->OldValue = $this->NoTelpHp->CurrentValue;
		$this->TTD1Nama->CurrentValue = NULL;
		$this->TTD1Nama->OldValue = $this->TTD1Nama->CurrentValue;
		$this->TTD1Jabatan->CurrentValue = NULL;
		$this->TTD1Jabatan->OldValue = $this->TTD1Jabatan->CurrentValue;
		$this->TTD2Nama->CurrentValue = NULL;
		$this->TTD2Nama->OldValue = $this->TTD2Nama->CurrentValue;
		$this->TTD2Jabatan->CurrentValue = NULL;
		$this->TTD2Jabatan->OldValue = $this->TTD2Jabatan->CurrentValue;
		$this->Logo->CurrentValue = NULL;
		$this->Logo->OldValue = $this->Logo->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->NIS->FldIsDetailKey) {
			$this->NIS->setFormValue($objForm->GetValue("x_NIS"));
		}
		if (!$this->Nama->FldIsDetailKey) {
			$this->Nama->setFormValue($objForm->GetValue("x_Nama"));
		}
		if (!$this->Alamat->FldIsDetailKey) {
			$this->Alamat->setFormValue($objForm->GetValue("x_Alamat"));
		}
		if (!$this->NoTelpHp->FldIsDetailKey) {
			$this->NoTelpHp->setFormValue($objForm->GetValue("x_NoTelpHp"));
		}
		if (!$this->TTD1Nama->FldIsDetailKey) {
			$this->TTD1Nama->setFormValue($objForm->GetValue("x_TTD1Nama"));
		}
		if (!$this->TTD1Jabatan->FldIsDetailKey) {
			$this->TTD1Jabatan->setFormValue($objForm->GetValue("x_TTD1Jabatan"));
		}
		if (!$this->TTD2Nama->FldIsDetailKey) {
			$this->TTD2Nama->setFormValue($objForm->GetValue("x_TTD2Nama"));
		}
		if (!$this->TTD2Jabatan->FldIsDetailKey) {
			$this->TTD2Jabatan->setFormValue($objForm->GetValue("x_TTD2Jabatan"));
		}
		if (!$this->Logo->FldIsDetailKey) {
			$this->Logo->setFormValue($objForm->GetValue("x_Logo"));
		}
		if (!$this->id->FldIsDetailKey && $this->CurrentAction <> "gridadd" && $this->CurrentAction <> "add")
			$this->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		if ($this->CurrentAction <> "gridadd" && $this->CurrentAction <> "add")
			$this->id->CurrentValue = $this->id->FormValue;
		$this->NIS->CurrentValue = $this->NIS->FormValue;
		$this->Nama->CurrentValue = $this->Nama->FormValue;
		$this->Alamat->CurrentValue = $this->Alamat->FormValue;
		$this->NoTelpHp->CurrentValue = $this->NoTelpHp->FormValue;
		$this->TTD1Nama->CurrentValue = $this->TTD1Nama->FormValue;
		$this->TTD1Jabatan->CurrentValue = $this->TTD1Jabatan->FormValue;
		$this->TTD2Nama->CurrentValue = $this->TTD2Nama->FormValue;
		$this->TTD2Jabatan->CurrentValue = $this->TTD2Jabatan->FormValue;
		$this->Logo->CurrentValue = $this->Logo->FormValue;
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
		$this->NIS->setDbValue($rs->fields('NIS'));
		$this->Nama->setDbValue($rs->fields('Nama'));
		$this->Alamat->setDbValue($rs->fields('Alamat'));
		$this->NoTelpHp->setDbValue($rs->fields('NoTelpHp'));
		$this->TTD1Nama->setDbValue($rs->fields('TTD1Nama'));
		$this->TTD1Jabatan->setDbValue($rs->fields('TTD1Jabatan'));
		$this->TTD2Nama->setDbValue($rs->fields('TTD2Nama'));
		$this->TTD2Jabatan->setDbValue($rs->fields('TTD2Jabatan'));
		$this->Logo->setDbValue($rs->fields('Logo'));
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->NIS->DbValue = $row['NIS'];
		$this->Nama->DbValue = $row['Nama'];
		$this->Alamat->DbValue = $row['Alamat'];
		$this->NoTelpHp->DbValue = $row['NoTelpHp'];
		$this->TTD1Nama->DbValue = $row['TTD1Nama'];
		$this->TTD1Jabatan->DbValue = $row['TTD1Jabatan'];
		$this->TTD2Nama->DbValue = $row['TTD2Nama'];
		$this->TTD2Jabatan->DbValue = $row['TTD2Jabatan'];
		$this->Logo->DbValue = $row['Logo'];
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

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// id
		// NIS
		// Nama
		// Alamat
		// NoTelpHp
		// TTD1Nama
		// TTD1Jabatan
		// TTD2Nama
		// TTD2Jabatan
		// Logo

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// NIS
		$this->NIS->ViewValue = $this->NIS->CurrentValue;
		$this->NIS->ViewCustomAttributes = "";

		// Nama
		$this->Nama->ViewValue = $this->Nama->CurrentValue;
		$this->Nama->ViewCustomAttributes = "";

		// Alamat
		$this->Alamat->ViewValue = $this->Alamat->CurrentValue;
		$this->Alamat->ViewCustomAttributes = "";

		// NoTelpHp
		$this->NoTelpHp->ViewValue = $this->NoTelpHp->CurrentValue;
		$this->NoTelpHp->ViewCustomAttributes = "";

		// TTD1Nama
		$this->TTD1Nama->ViewValue = $this->TTD1Nama->CurrentValue;
		$this->TTD1Nama->ViewCustomAttributes = "";

		// TTD1Jabatan
		$this->TTD1Jabatan->ViewValue = $this->TTD1Jabatan->CurrentValue;
		$this->TTD1Jabatan->ViewCustomAttributes = "";

		// TTD2Nama
		$this->TTD2Nama->ViewValue = $this->TTD2Nama->CurrentValue;
		$this->TTD2Nama->ViewCustomAttributes = "";

		// TTD2Jabatan
		$this->TTD2Jabatan->ViewValue = $this->TTD2Jabatan->CurrentValue;
		$this->TTD2Jabatan->ViewCustomAttributes = "";

		// Logo
		$this->Logo->ViewValue = $this->Logo->CurrentValue;
		$this->Logo->ViewCustomAttributes = "";

			// NIS
			$this->NIS->LinkCustomAttributes = "";
			$this->NIS->HrefValue = "";
			$this->NIS->TooltipValue = "";

			// Nama
			$this->Nama->LinkCustomAttributes = "";
			$this->Nama->HrefValue = "";
			$this->Nama->TooltipValue = "";

			// Alamat
			$this->Alamat->LinkCustomAttributes = "";
			$this->Alamat->HrefValue = "";
			$this->Alamat->TooltipValue = "";

			// NoTelpHp
			$this->NoTelpHp->LinkCustomAttributes = "";
			$this->NoTelpHp->HrefValue = "";
			$this->NoTelpHp->TooltipValue = "";

			// TTD1Nama
			$this->TTD1Nama->LinkCustomAttributes = "";
			$this->TTD1Nama->HrefValue = "";
			$this->TTD1Nama->TooltipValue = "";

			// TTD1Jabatan
			$this->TTD1Jabatan->LinkCustomAttributes = "";
			$this->TTD1Jabatan->HrefValue = "";
			$this->TTD1Jabatan->TooltipValue = "";

			// TTD2Nama
			$this->TTD2Nama->LinkCustomAttributes = "";
			$this->TTD2Nama->HrefValue = "";
			$this->TTD2Nama->TooltipValue = "";

			// TTD2Jabatan
			$this->TTD2Jabatan->LinkCustomAttributes = "";
			$this->TTD2Jabatan->HrefValue = "";
			$this->TTD2Jabatan->TooltipValue = "";

			// Logo
			$this->Logo->LinkCustomAttributes = "";
			$this->Logo->HrefValue = "";
			$this->Logo->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// NIS
			$this->NIS->EditAttrs["class"] = "form-control";
			$this->NIS->EditCustomAttributes = "";
			$this->NIS->EditValue = ew_HtmlEncode($this->NIS->CurrentValue);
			$this->NIS->PlaceHolder = ew_RemoveHtml($this->NIS->FldCaption());

			// Nama
			$this->Nama->EditAttrs["class"] = "form-control";
			$this->Nama->EditCustomAttributes = "";
			$this->Nama->EditValue = ew_HtmlEncode($this->Nama->CurrentValue);
			$this->Nama->PlaceHolder = ew_RemoveHtml($this->Nama->FldCaption());

			// Alamat
			$this->Alamat->EditAttrs["class"] = "form-control";
			$this->Alamat->EditCustomAttributes = "";
			$this->Alamat->EditValue = ew_HtmlEncode($this->Alamat->CurrentValue);
			$this->Alamat->PlaceHolder = ew_RemoveHtml($this->Alamat->FldCaption());

			// NoTelpHp
			$this->NoTelpHp->EditAttrs["class"] = "form-control";
			$this->NoTelpHp->EditCustomAttributes = "";
			$this->NoTelpHp->EditValue = ew_HtmlEncode($this->NoTelpHp->CurrentValue);
			$this->NoTelpHp->PlaceHolder = ew_RemoveHtml($this->NoTelpHp->FldCaption());

			// TTD1Nama
			$this->TTD1Nama->EditAttrs["class"] = "form-control";
			$this->TTD1Nama->EditCustomAttributes = "";
			$this->TTD1Nama->EditValue = ew_HtmlEncode($this->TTD1Nama->CurrentValue);
			$this->TTD1Nama->PlaceHolder = ew_RemoveHtml($this->TTD1Nama->FldCaption());

			// TTD1Jabatan
			$this->TTD1Jabatan->EditAttrs["class"] = "form-control";
			$this->TTD1Jabatan->EditCustomAttributes = "";
			$this->TTD1Jabatan->EditValue = ew_HtmlEncode($this->TTD1Jabatan->CurrentValue);
			$this->TTD1Jabatan->PlaceHolder = ew_RemoveHtml($this->TTD1Jabatan->FldCaption());

			// TTD2Nama
			$this->TTD2Nama->EditAttrs["class"] = "form-control";
			$this->TTD2Nama->EditCustomAttributes = "";
			$this->TTD2Nama->EditValue = ew_HtmlEncode($this->TTD2Nama->CurrentValue);
			$this->TTD2Nama->PlaceHolder = ew_RemoveHtml($this->TTD2Nama->FldCaption());

			// TTD2Jabatan
			$this->TTD2Jabatan->EditAttrs["class"] = "form-control";
			$this->TTD2Jabatan->EditCustomAttributes = "";
			$this->TTD2Jabatan->EditValue = ew_HtmlEncode($this->TTD2Jabatan->CurrentValue);
			$this->TTD2Jabatan->PlaceHolder = ew_RemoveHtml($this->TTD2Jabatan->FldCaption());

			// Logo
			$this->Logo->EditAttrs["class"] = "form-control";
			$this->Logo->EditCustomAttributes = "";
			$this->Logo->EditValue = ew_HtmlEncode($this->Logo->CurrentValue);
			$this->Logo->PlaceHolder = ew_RemoveHtml($this->Logo->FldCaption());

			// Add refer script
			// NIS

			$this->NIS->LinkCustomAttributes = "";
			$this->NIS->HrefValue = "";

			// Nama
			$this->Nama->LinkCustomAttributes = "";
			$this->Nama->HrefValue = "";

			// Alamat
			$this->Alamat->LinkCustomAttributes = "";
			$this->Alamat->HrefValue = "";

			// NoTelpHp
			$this->NoTelpHp->LinkCustomAttributes = "";
			$this->NoTelpHp->HrefValue = "";

			// TTD1Nama
			$this->TTD1Nama->LinkCustomAttributes = "";
			$this->TTD1Nama->HrefValue = "";

			// TTD1Jabatan
			$this->TTD1Jabatan->LinkCustomAttributes = "";
			$this->TTD1Jabatan->HrefValue = "";

			// TTD2Nama
			$this->TTD2Nama->LinkCustomAttributes = "";
			$this->TTD2Nama->HrefValue = "";

			// TTD2Jabatan
			$this->TTD2Jabatan->LinkCustomAttributes = "";
			$this->TTD2Jabatan->HrefValue = "";

			// Logo
			$this->Logo->LinkCustomAttributes = "";
			$this->Logo->HrefValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// NIS
			$this->NIS->EditAttrs["class"] = "form-control";
			$this->NIS->EditCustomAttributes = "";
			$this->NIS->EditValue = ew_HtmlEncode($this->NIS->CurrentValue);
			$this->NIS->PlaceHolder = ew_RemoveHtml($this->NIS->FldCaption());

			// Nama
			$this->Nama->EditAttrs["class"] = "form-control";
			$this->Nama->EditCustomAttributes = "";
			$this->Nama->EditValue = ew_HtmlEncode($this->Nama->CurrentValue);
			$this->Nama->PlaceHolder = ew_RemoveHtml($this->Nama->FldCaption());

			// Alamat
			$this->Alamat->EditAttrs["class"] = "form-control";
			$this->Alamat->EditCustomAttributes = "";
			$this->Alamat->EditValue = ew_HtmlEncode($this->Alamat->CurrentValue);
			$this->Alamat->PlaceHolder = ew_RemoveHtml($this->Alamat->FldCaption());

			// NoTelpHp
			$this->NoTelpHp->EditAttrs["class"] = "form-control";
			$this->NoTelpHp->EditCustomAttributes = "";
			$this->NoTelpHp->EditValue = ew_HtmlEncode($this->NoTelpHp->CurrentValue);
			$this->NoTelpHp->PlaceHolder = ew_RemoveHtml($this->NoTelpHp->FldCaption());

			// TTD1Nama
			$this->TTD1Nama->EditAttrs["class"] = "form-control";
			$this->TTD1Nama->EditCustomAttributes = "";
			$this->TTD1Nama->EditValue = ew_HtmlEncode($this->TTD1Nama->CurrentValue);
			$this->TTD1Nama->PlaceHolder = ew_RemoveHtml($this->TTD1Nama->FldCaption());

			// TTD1Jabatan
			$this->TTD1Jabatan->EditAttrs["class"] = "form-control";
			$this->TTD1Jabatan->EditCustomAttributes = "";
			$this->TTD1Jabatan->EditValue = ew_HtmlEncode($this->TTD1Jabatan->CurrentValue);
			$this->TTD1Jabatan->PlaceHolder = ew_RemoveHtml($this->TTD1Jabatan->FldCaption());

			// TTD2Nama
			$this->TTD2Nama->EditAttrs["class"] = "form-control";
			$this->TTD2Nama->EditCustomAttributes = "";
			$this->TTD2Nama->EditValue = ew_HtmlEncode($this->TTD2Nama->CurrentValue);
			$this->TTD2Nama->PlaceHolder = ew_RemoveHtml($this->TTD2Nama->FldCaption());

			// TTD2Jabatan
			$this->TTD2Jabatan->EditAttrs["class"] = "form-control";
			$this->TTD2Jabatan->EditCustomAttributes = "";
			$this->TTD2Jabatan->EditValue = ew_HtmlEncode($this->TTD2Jabatan->CurrentValue);
			$this->TTD2Jabatan->PlaceHolder = ew_RemoveHtml($this->TTD2Jabatan->FldCaption());

			// Logo
			$this->Logo->EditAttrs["class"] = "form-control";
			$this->Logo->EditCustomAttributes = "";
			$this->Logo->EditValue = ew_HtmlEncode($this->Logo->CurrentValue);
			$this->Logo->PlaceHolder = ew_RemoveHtml($this->Logo->FldCaption());

			// Edit refer script
			// NIS

			$this->NIS->LinkCustomAttributes = "";
			$this->NIS->HrefValue = "";

			// Nama
			$this->Nama->LinkCustomAttributes = "";
			$this->Nama->HrefValue = "";

			// Alamat
			$this->Alamat->LinkCustomAttributes = "";
			$this->Alamat->HrefValue = "";

			// NoTelpHp
			$this->NoTelpHp->LinkCustomAttributes = "";
			$this->NoTelpHp->HrefValue = "";

			// TTD1Nama
			$this->TTD1Nama->LinkCustomAttributes = "";
			$this->TTD1Nama->HrefValue = "";

			// TTD1Jabatan
			$this->TTD1Jabatan->LinkCustomAttributes = "";
			$this->TTD1Jabatan->HrefValue = "";

			// TTD2Nama
			$this->TTD2Nama->LinkCustomAttributes = "";
			$this->TTD2Nama->HrefValue = "";

			// TTD2Jabatan
			$this->TTD2Jabatan->LinkCustomAttributes = "";
			$this->TTD2Jabatan->HrefValue = "";

			// Logo
			$this->Logo->LinkCustomAttributes = "";
			$this->Logo->HrefValue = "";
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
		if (!$this->NIS->FldIsDetailKey && !is_null($this->NIS->FormValue) && $this->NIS->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->NIS->FldCaption(), $this->NIS->ReqErrMsg));
		}
		if (!$this->Nama->FldIsDetailKey && !is_null($this->Nama->FormValue) && $this->Nama->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Nama->FldCaption(), $this->Nama->ReqErrMsg));
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

			// NIS
			$this->NIS->SetDbValueDef($rsnew, $this->NIS->CurrentValue, "", $this->NIS->ReadOnly);

			// Nama
			$this->Nama->SetDbValueDef($rsnew, $this->Nama->CurrentValue, "", $this->Nama->ReadOnly);

			// Alamat
			$this->Alamat->SetDbValueDef($rsnew, $this->Alamat->CurrentValue, NULL, $this->Alamat->ReadOnly);

			// NoTelpHp
			$this->NoTelpHp->SetDbValueDef($rsnew, $this->NoTelpHp->CurrentValue, NULL, $this->NoTelpHp->ReadOnly);

			// TTD1Nama
			$this->TTD1Nama->SetDbValueDef($rsnew, $this->TTD1Nama->CurrentValue, NULL, $this->TTD1Nama->ReadOnly);

			// TTD1Jabatan
			$this->TTD1Jabatan->SetDbValueDef($rsnew, $this->TTD1Jabatan->CurrentValue, NULL, $this->TTD1Jabatan->ReadOnly);

			// TTD2Nama
			$this->TTD2Nama->SetDbValueDef($rsnew, $this->TTD2Nama->CurrentValue, NULL, $this->TTD2Nama->ReadOnly);

			// TTD2Jabatan
			$this->TTD2Jabatan->SetDbValueDef($rsnew, $this->TTD2Jabatan->CurrentValue, NULL, $this->TTD2Jabatan->ReadOnly);

			// Logo
			$this->Logo->SetDbValueDef($rsnew, $this->Logo->CurrentValue, NULL, $this->Logo->ReadOnly);

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
		$conn = &$this->Connection();

		// Load db values from rsold
		if ($rsold) {
			$this->LoadDbValues($rsold);
		}
		$rsnew = array();

		// NIS
		$this->NIS->SetDbValueDef($rsnew, $this->NIS->CurrentValue, "", FALSE);

		// Nama
		$this->Nama->SetDbValueDef($rsnew, $this->Nama->CurrentValue, "", FALSE);

		// Alamat
		$this->Alamat->SetDbValueDef($rsnew, $this->Alamat->CurrentValue, NULL, FALSE);

		// NoTelpHp
		$this->NoTelpHp->SetDbValueDef($rsnew, $this->NoTelpHp->CurrentValue, NULL, FALSE);

		// TTD1Nama
		$this->TTD1Nama->SetDbValueDef($rsnew, $this->TTD1Nama->CurrentValue, NULL, FALSE);

		// TTD1Jabatan
		$this->TTD1Jabatan->SetDbValueDef($rsnew, $this->TTD1Jabatan->CurrentValue, NULL, FALSE);

		// TTD2Nama
		$this->TTD2Nama->SetDbValueDef($rsnew, $this->TTD2Nama->CurrentValue, NULL, FALSE);

		// TTD2Jabatan
		$this->TTD2Jabatan->SetDbValueDef($rsnew, $this->TTD2Jabatan->CurrentValue, NULL, FALSE);

		// Logo
		$this->Logo->SetDbValueDef($rsnew, $this->Logo->CurrentValue, NULL, FALSE);

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
if (!isset($t01_sekolah_list)) $t01_sekolah_list = new ct01_sekolah_list();

// Page init
$t01_sekolah_list->Page_Init();

// Page main
$t01_sekolah_list->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t01_sekolah_list->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "list";
var CurrentForm = ft01_sekolahlist = new ew_Form("ft01_sekolahlist", "list");
ft01_sekolahlist.FormKeyCountName = '<?php echo $t01_sekolah_list->FormKeyCountName ?>';

// Validate form
ft01_sekolahlist.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_NIS");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t01_sekolah->NIS->FldCaption(), $t01_sekolah->NIS->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Nama");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t01_sekolah->Nama->FldCaption(), $t01_sekolah->Nama->ReqErrMsg)) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
ft01_sekolahlist.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft01_sekolahlist.ValidateRequired = true;
<?php } else { ?>
ft01_sekolahlist.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
// Form object for search

</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<div class="ewToolbar">
<?php $Breadcrumb->Render(); ?>
<?php if ($t01_sekolah_list->TotalRecs > 0 && $t01_sekolah_list->ExportOptions->Visible()) { ?>
<?php $t01_sekolah_list->ExportOptions->Render("body") ?>
<?php } ?>
<?php echo $Language->SelectionForm(); ?>
<div class="clearfix"></div>
</div>
<?php
	$bSelectLimit = $t01_sekolah_list->UseSelectLimit;
	if ($bSelectLimit) {
		if ($t01_sekolah_list->TotalRecs <= 0)
			$t01_sekolah_list->TotalRecs = $t01_sekolah->SelectRecordCount();
	} else {
		if (!$t01_sekolah_list->Recordset && ($t01_sekolah_list->Recordset = $t01_sekolah_list->LoadRecordset()))
			$t01_sekolah_list->TotalRecs = $t01_sekolah_list->Recordset->RecordCount();
	}
	$t01_sekolah_list->StartRec = 1;
	if ($t01_sekolah_list->DisplayRecs <= 0 || ($t01_sekolah->Export <> "" && $t01_sekolah->ExportAll)) // Display all records
		$t01_sekolah_list->DisplayRecs = $t01_sekolah_list->TotalRecs;
	if (!($t01_sekolah->Export <> "" && $t01_sekolah->ExportAll))
		$t01_sekolah_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$t01_sekolah_list->Recordset = $t01_sekolah_list->LoadRecordset($t01_sekolah_list->StartRec-1, $t01_sekolah_list->DisplayRecs);

	// Set no record found message
	if ($t01_sekolah->CurrentAction == "" && $t01_sekolah_list->TotalRecs == 0) {
		if (!$Security->CanList())
			$t01_sekolah_list->setWarningMessage(ew_DeniedMsg());
		if ($t01_sekolah_list->SearchWhere == "0=101")
			$t01_sekolah_list->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$t01_sekolah_list->setWarningMessage($Language->Phrase("NoRecord"));
	}
$t01_sekolah_list->RenderOtherOptions();
?>
<?php $t01_sekolah_list->ShowPageHeader(); ?>
<?php
$t01_sekolah_list->ShowMessage();
?>
<?php if ($t01_sekolah_list->TotalRecs > 0 || $t01_sekolah->CurrentAction <> "") { ?>
<div class="panel panel-default ewGrid t01_sekolah">
<div class="panel-heading ewGridUpperPanel">
<?php if ($t01_sekolah->CurrentAction <> "gridadd" && $t01_sekolah->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="form-inline ewForm ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($t01_sekolah_list->Pager)) $t01_sekolah_list->Pager = new cPrevNextPager($t01_sekolah_list->StartRec, $t01_sekolah_list->DisplayRecs, $t01_sekolah_list->TotalRecs) ?>
<?php if ($t01_sekolah_list->Pager->RecordCount > 0 && $t01_sekolah_list->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($t01_sekolah_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $t01_sekolah_list->PageUrl() ?>start=<?php echo $t01_sekolah_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($t01_sekolah_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $t01_sekolah_list->PageUrl() ?>start=<?php echo $t01_sekolah_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $t01_sekolah_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($t01_sekolah_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $t01_sekolah_list->PageUrl() ?>start=<?php echo $t01_sekolah_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($t01_sekolah_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $t01_sekolah_list->PageUrl() ?>start=<?php echo $t01_sekolah_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $t01_sekolah_list->Pager->PageCount ?></span>
</div>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $t01_sekolah_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $t01_sekolah_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $t01_sekolah_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t01_sekolah_list->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
</div>
<form name="ft01_sekolahlist" id="ft01_sekolahlist" class="form-inline ewForm ewListForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($t01_sekolah_list->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $t01_sekolah_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t01_sekolah">
<div id="gmp_t01_sekolah" class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<?php if ($t01_sekolah_list->TotalRecs > 0 || $t01_sekolah->CurrentAction == "gridedit") { ?>
<table id="tbl_t01_sekolahlist" class="table ewTable">
<?php echo $t01_sekolah->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Header row
$t01_sekolah_list->RowType = EW_ROWTYPE_HEADER;

// Render list options
$t01_sekolah_list->RenderListOptions();

// Render list options (header, left)
$t01_sekolah_list->ListOptions->Render("header", "left");
?>
<?php if ($t01_sekolah->NIS->Visible) { // NIS ?>
	<?php if ($t01_sekolah->SortUrl($t01_sekolah->NIS) == "") { ?>
		<th data-name="NIS"><div id="elh_t01_sekolah_NIS" class="t01_sekolah_NIS"><div class="ewTableHeaderCaption"><?php echo $t01_sekolah->NIS->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NIS"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t01_sekolah->SortUrl($t01_sekolah->NIS) ?>',2);"><div id="elh_t01_sekolah_NIS" class="t01_sekolah_NIS">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t01_sekolah->NIS->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t01_sekolah->NIS->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t01_sekolah->NIS->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t01_sekolah->Nama->Visible) { // Nama ?>
	<?php if ($t01_sekolah->SortUrl($t01_sekolah->Nama) == "") { ?>
		<th data-name="Nama"><div id="elh_t01_sekolah_Nama" class="t01_sekolah_Nama"><div class="ewTableHeaderCaption"><?php echo $t01_sekolah->Nama->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Nama"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t01_sekolah->SortUrl($t01_sekolah->Nama) ?>',2);"><div id="elh_t01_sekolah_Nama" class="t01_sekolah_Nama">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t01_sekolah->Nama->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t01_sekolah->Nama->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t01_sekolah->Nama->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t01_sekolah->Alamat->Visible) { // Alamat ?>
	<?php if ($t01_sekolah->SortUrl($t01_sekolah->Alamat) == "") { ?>
		<th data-name="Alamat"><div id="elh_t01_sekolah_Alamat" class="t01_sekolah_Alamat"><div class="ewTableHeaderCaption"><?php echo $t01_sekolah->Alamat->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Alamat"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t01_sekolah->SortUrl($t01_sekolah->Alamat) ?>',2);"><div id="elh_t01_sekolah_Alamat" class="t01_sekolah_Alamat">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t01_sekolah->Alamat->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t01_sekolah->Alamat->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t01_sekolah->Alamat->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t01_sekolah->NoTelpHp->Visible) { // NoTelpHp ?>
	<?php if ($t01_sekolah->SortUrl($t01_sekolah->NoTelpHp) == "") { ?>
		<th data-name="NoTelpHp"><div id="elh_t01_sekolah_NoTelpHp" class="t01_sekolah_NoTelpHp"><div class="ewTableHeaderCaption"><?php echo $t01_sekolah->NoTelpHp->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NoTelpHp"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t01_sekolah->SortUrl($t01_sekolah->NoTelpHp) ?>',2);"><div id="elh_t01_sekolah_NoTelpHp" class="t01_sekolah_NoTelpHp">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t01_sekolah->NoTelpHp->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t01_sekolah->NoTelpHp->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t01_sekolah->NoTelpHp->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t01_sekolah->TTD1Nama->Visible) { // TTD1Nama ?>
	<?php if ($t01_sekolah->SortUrl($t01_sekolah->TTD1Nama) == "") { ?>
		<th data-name="TTD1Nama"><div id="elh_t01_sekolah_TTD1Nama" class="t01_sekolah_TTD1Nama"><div class="ewTableHeaderCaption"><?php echo $t01_sekolah->TTD1Nama->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TTD1Nama"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t01_sekolah->SortUrl($t01_sekolah->TTD1Nama) ?>',2);"><div id="elh_t01_sekolah_TTD1Nama" class="t01_sekolah_TTD1Nama">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t01_sekolah->TTD1Nama->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t01_sekolah->TTD1Nama->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t01_sekolah->TTD1Nama->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t01_sekolah->TTD1Jabatan->Visible) { // TTD1Jabatan ?>
	<?php if ($t01_sekolah->SortUrl($t01_sekolah->TTD1Jabatan) == "") { ?>
		<th data-name="TTD1Jabatan"><div id="elh_t01_sekolah_TTD1Jabatan" class="t01_sekolah_TTD1Jabatan"><div class="ewTableHeaderCaption"><?php echo $t01_sekolah->TTD1Jabatan->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TTD1Jabatan"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t01_sekolah->SortUrl($t01_sekolah->TTD1Jabatan) ?>',2);"><div id="elh_t01_sekolah_TTD1Jabatan" class="t01_sekolah_TTD1Jabatan">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t01_sekolah->TTD1Jabatan->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t01_sekolah->TTD1Jabatan->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t01_sekolah->TTD1Jabatan->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t01_sekolah->TTD2Nama->Visible) { // TTD2Nama ?>
	<?php if ($t01_sekolah->SortUrl($t01_sekolah->TTD2Nama) == "") { ?>
		<th data-name="TTD2Nama"><div id="elh_t01_sekolah_TTD2Nama" class="t01_sekolah_TTD2Nama"><div class="ewTableHeaderCaption"><?php echo $t01_sekolah->TTD2Nama->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TTD2Nama"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t01_sekolah->SortUrl($t01_sekolah->TTD2Nama) ?>',2);"><div id="elh_t01_sekolah_TTD2Nama" class="t01_sekolah_TTD2Nama">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t01_sekolah->TTD2Nama->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t01_sekolah->TTD2Nama->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t01_sekolah->TTD2Nama->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t01_sekolah->TTD2Jabatan->Visible) { // TTD2Jabatan ?>
	<?php if ($t01_sekolah->SortUrl($t01_sekolah->TTD2Jabatan) == "") { ?>
		<th data-name="TTD2Jabatan"><div id="elh_t01_sekolah_TTD2Jabatan" class="t01_sekolah_TTD2Jabatan"><div class="ewTableHeaderCaption"><?php echo $t01_sekolah->TTD2Jabatan->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TTD2Jabatan"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t01_sekolah->SortUrl($t01_sekolah->TTD2Jabatan) ?>',2);"><div id="elh_t01_sekolah_TTD2Jabatan" class="t01_sekolah_TTD2Jabatan">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t01_sekolah->TTD2Jabatan->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t01_sekolah->TTD2Jabatan->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t01_sekolah->TTD2Jabatan->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t01_sekolah->Logo->Visible) { // Logo ?>
	<?php if ($t01_sekolah->SortUrl($t01_sekolah->Logo) == "") { ?>
		<th data-name="Logo"><div id="elh_t01_sekolah_Logo" class="t01_sekolah_Logo"><div class="ewTableHeaderCaption"><?php echo $t01_sekolah->Logo->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Logo"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t01_sekolah->SortUrl($t01_sekolah->Logo) ?>',2);"><div id="elh_t01_sekolah_Logo" class="t01_sekolah_Logo">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t01_sekolah->Logo->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t01_sekolah->Logo->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t01_sekolah->Logo->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$t01_sekolah_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($t01_sekolah->ExportAll && $t01_sekolah->Export <> "") {
	$t01_sekolah_list->StopRec = $t01_sekolah_list->TotalRecs;
} else {

	// Set the last record to display
	if ($t01_sekolah_list->TotalRecs > $t01_sekolah_list->StartRec + $t01_sekolah_list->DisplayRecs - 1)
		$t01_sekolah_list->StopRec = $t01_sekolah_list->StartRec + $t01_sekolah_list->DisplayRecs - 1;
	else
		$t01_sekolah_list->StopRec = $t01_sekolah_list->TotalRecs;
}

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($t01_sekolah_list->FormKeyCountName) && ($t01_sekolah->CurrentAction == "gridadd" || $t01_sekolah->CurrentAction == "gridedit" || $t01_sekolah->CurrentAction == "F")) {
		$t01_sekolah_list->KeyCount = $objForm->GetValue($t01_sekolah_list->FormKeyCountName);
		$t01_sekolah_list->StopRec = $t01_sekolah_list->StartRec + $t01_sekolah_list->KeyCount - 1;
	}
}
$t01_sekolah_list->RecCnt = $t01_sekolah_list->StartRec - 1;
if ($t01_sekolah_list->Recordset && !$t01_sekolah_list->Recordset->EOF) {
	$t01_sekolah_list->Recordset->MoveFirst();
	$bSelectLimit = $t01_sekolah_list->UseSelectLimit;
	if (!$bSelectLimit && $t01_sekolah_list->StartRec > 1)
		$t01_sekolah_list->Recordset->Move($t01_sekolah_list->StartRec - 1);
} elseif (!$t01_sekolah->AllowAddDeleteRow && $t01_sekolah_list->StopRec == 0) {
	$t01_sekolah_list->StopRec = $t01_sekolah->GridAddRowCount;
}

// Initialize aggregate
$t01_sekolah->RowType = EW_ROWTYPE_AGGREGATEINIT;
$t01_sekolah->ResetAttrs();
$t01_sekolah_list->RenderRow();
$t01_sekolah_list->EditRowCnt = 0;
if ($t01_sekolah->CurrentAction == "edit")
	$t01_sekolah_list->RowIndex = 1;
while ($t01_sekolah_list->RecCnt < $t01_sekolah_list->StopRec) {
	$t01_sekolah_list->RecCnt++;
	if (intval($t01_sekolah_list->RecCnt) >= intval($t01_sekolah_list->StartRec)) {
		$t01_sekolah_list->RowCnt++;

		// Set up key count
		$t01_sekolah_list->KeyCount = $t01_sekolah_list->RowIndex;

		// Init row class and style
		$t01_sekolah->ResetAttrs();
		$t01_sekolah->CssClass = "";
		if ($t01_sekolah->CurrentAction == "gridadd") {
			$t01_sekolah_list->LoadDefaultValues(); // Load default values
		} else {
			$t01_sekolah_list->LoadRowValues($t01_sekolah_list->Recordset); // Load row values
		}
		$t01_sekolah->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($t01_sekolah->CurrentAction == "edit") {
			if ($t01_sekolah_list->CheckInlineEditKey() && $t01_sekolah_list->EditRowCnt == 0) { // Inline edit
				$t01_sekolah->RowType = EW_ROWTYPE_EDIT; // Render edit
			}
		}
		if ($t01_sekolah->CurrentAction == "edit" && $t01_sekolah->RowType == EW_ROWTYPE_EDIT && $t01_sekolah->EventCancelled) { // Update failed
			$objForm->Index = 1;
			$t01_sekolah_list->RestoreFormValues(); // Restore form values
		}
		if ($t01_sekolah->RowType == EW_ROWTYPE_EDIT) // Edit row
			$t01_sekolah_list->EditRowCnt++;

		// Set up row id / data-rowindex
		$t01_sekolah->RowAttrs = array_merge($t01_sekolah->RowAttrs, array('data-rowindex'=>$t01_sekolah_list->RowCnt, 'id'=>'r' . $t01_sekolah_list->RowCnt . '_t01_sekolah', 'data-rowtype'=>$t01_sekolah->RowType));

		// Render row
		$t01_sekolah_list->RenderRow();

		// Render list options
		$t01_sekolah_list->RenderListOptions();
?>
	<tr<?php echo $t01_sekolah->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t01_sekolah_list->ListOptions->Render("body", "left", $t01_sekolah_list->RowCnt);
?>
	<?php if ($t01_sekolah->NIS->Visible) { // NIS ?>
		<td data-name="NIS"<?php echo $t01_sekolah->NIS->CellAttributes() ?>>
<?php if ($t01_sekolah->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t01_sekolah_list->RowCnt ?>_t01_sekolah_NIS" class="form-group t01_sekolah_NIS">
<input type="text" data-table="t01_sekolah" data-field="x_NIS" name="x<?php echo $t01_sekolah_list->RowIndex ?>_NIS" id="x<?php echo $t01_sekolah_list->RowIndex ?>_NIS" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($t01_sekolah->NIS->getPlaceHolder()) ?>" value="<?php echo $t01_sekolah->NIS->EditValue ?>"<?php echo $t01_sekolah->NIS->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t01_sekolah->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t01_sekolah_list->RowCnt ?>_t01_sekolah_NIS" class="t01_sekolah_NIS">
<span<?php echo $t01_sekolah->NIS->ViewAttributes() ?>>
<?php echo $t01_sekolah->NIS->ListViewValue() ?></span>
</span>
<?php } ?>
<a id="<?php echo $t01_sekolah_list->PageObjName . "_row_" . $t01_sekolah_list->RowCnt ?>"></a></td>
	<?php } ?>
<?php if ($t01_sekolah->RowType == EW_ROWTYPE_EDIT || $t01_sekolah->CurrentMode == "edit") { ?>
<input type="hidden" data-table="t01_sekolah" data-field="x_id" name="x<?php echo $t01_sekolah_list->RowIndex ?>_id" id="x<?php echo $t01_sekolah_list->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t01_sekolah->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($t01_sekolah->Nama->Visible) { // Nama ?>
		<td data-name="Nama"<?php echo $t01_sekolah->Nama->CellAttributes() ?>>
<?php if ($t01_sekolah->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t01_sekolah_list->RowCnt ?>_t01_sekolah_Nama" class="form-group t01_sekolah_Nama">
<input type="text" data-table="t01_sekolah" data-field="x_Nama" name="x<?php echo $t01_sekolah_list->RowIndex ?>_Nama" id="x<?php echo $t01_sekolah_list->RowIndex ?>_Nama" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($t01_sekolah->Nama->getPlaceHolder()) ?>" value="<?php echo $t01_sekolah->Nama->EditValue ?>"<?php echo $t01_sekolah->Nama->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t01_sekolah->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t01_sekolah_list->RowCnt ?>_t01_sekolah_Nama" class="t01_sekolah_Nama">
<span<?php echo $t01_sekolah->Nama->ViewAttributes() ?>>
<?php echo $t01_sekolah->Nama->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t01_sekolah->Alamat->Visible) { // Alamat ?>
		<td data-name="Alamat"<?php echo $t01_sekolah->Alamat->CellAttributes() ?>>
<?php if ($t01_sekolah->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t01_sekolah_list->RowCnt ?>_t01_sekolah_Alamat" class="form-group t01_sekolah_Alamat">
<input type="text" data-table="t01_sekolah" data-field="x_Alamat" name="x<?php echo $t01_sekolah_list->RowIndex ?>_Alamat" id="x<?php echo $t01_sekolah_list->RowIndex ?>_Alamat" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($t01_sekolah->Alamat->getPlaceHolder()) ?>" value="<?php echo $t01_sekolah->Alamat->EditValue ?>"<?php echo $t01_sekolah->Alamat->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t01_sekolah->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t01_sekolah_list->RowCnt ?>_t01_sekolah_Alamat" class="t01_sekolah_Alamat">
<span<?php echo $t01_sekolah->Alamat->ViewAttributes() ?>>
<?php echo $t01_sekolah->Alamat->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t01_sekolah->NoTelpHp->Visible) { // NoTelpHp ?>
		<td data-name="NoTelpHp"<?php echo $t01_sekolah->NoTelpHp->CellAttributes() ?>>
<?php if ($t01_sekolah->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t01_sekolah_list->RowCnt ?>_t01_sekolah_NoTelpHp" class="form-group t01_sekolah_NoTelpHp">
<input type="text" data-table="t01_sekolah" data-field="x_NoTelpHp" name="x<?php echo $t01_sekolah_list->RowIndex ?>_NoTelpHp" id="x<?php echo $t01_sekolah_list->RowIndex ?>_NoTelpHp" size="30" maxlength="25" placeholder="<?php echo ew_HtmlEncode($t01_sekolah->NoTelpHp->getPlaceHolder()) ?>" value="<?php echo $t01_sekolah->NoTelpHp->EditValue ?>"<?php echo $t01_sekolah->NoTelpHp->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t01_sekolah->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t01_sekolah_list->RowCnt ?>_t01_sekolah_NoTelpHp" class="t01_sekolah_NoTelpHp">
<span<?php echo $t01_sekolah->NoTelpHp->ViewAttributes() ?>>
<?php echo $t01_sekolah->NoTelpHp->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t01_sekolah->TTD1Nama->Visible) { // TTD1Nama ?>
		<td data-name="TTD1Nama"<?php echo $t01_sekolah->TTD1Nama->CellAttributes() ?>>
<?php if ($t01_sekolah->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t01_sekolah_list->RowCnt ?>_t01_sekolah_TTD1Nama" class="form-group t01_sekolah_TTD1Nama">
<input type="text" data-table="t01_sekolah" data-field="x_TTD1Nama" name="x<?php echo $t01_sekolah_list->RowIndex ?>_TTD1Nama" id="x<?php echo $t01_sekolah_list->RowIndex ?>_TTD1Nama" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($t01_sekolah->TTD1Nama->getPlaceHolder()) ?>" value="<?php echo $t01_sekolah->TTD1Nama->EditValue ?>"<?php echo $t01_sekolah->TTD1Nama->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t01_sekolah->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t01_sekolah_list->RowCnt ?>_t01_sekolah_TTD1Nama" class="t01_sekolah_TTD1Nama">
<span<?php echo $t01_sekolah->TTD1Nama->ViewAttributes() ?>>
<?php echo $t01_sekolah->TTD1Nama->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t01_sekolah->TTD1Jabatan->Visible) { // TTD1Jabatan ?>
		<td data-name="TTD1Jabatan"<?php echo $t01_sekolah->TTD1Jabatan->CellAttributes() ?>>
<?php if ($t01_sekolah->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t01_sekolah_list->RowCnt ?>_t01_sekolah_TTD1Jabatan" class="form-group t01_sekolah_TTD1Jabatan">
<input type="text" data-table="t01_sekolah" data-field="x_TTD1Jabatan" name="x<?php echo $t01_sekolah_list->RowIndex ?>_TTD1Jabatan" id="x<?php echo $t01_sekolah_list->RowIndex ?>_TTD1Jabatan" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($t01_sekolah->TTD1Jabatan->getPlaceHolder()) ?>" value="<?php echo $t01_sekolah->TTD1Jabatan->EditValue ?>"<?php echo $t01_sekolah->TTD1Jabatan->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t01_sekolah->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t01_sekolah_list->RowCnt ?>_t01_sekolah_TTD1Jabatan" class="t01_sekolah_TTD1Jabatan">
<span<?php echo $t01_sekolah->TTD1Jabatan->ViewAttributes() ?>>
<?php echo $t01_sekolah->TTD1Jabatan->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t01_sekolah->TTD2Nama->Visible) { // TTD2Nama ?>
		<td data-name="TTD2Nama"<?php echo $t01_sekolah->TTD2Nama->CellAttributes() ?>>
<?php if ($t01_sekolah->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t01_sekolah_list->RowCnt ?>_t01_sekolah_TTD2Nama" class="form-group t01_sekolah_TTD2Nama">
<input type="text" data-table="t01_sekolah" data-field="x_TTD2Nama" name="x<?php echo $t01_sekolah_list->RowIndex ?>_TTD2Nama" id="x<?php echo $t01_sekolah_list->RowIndex ?>_TTD2Nama" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($t01_sekolah->TTD2Nama->getPlaceHolder()) ?>" value="<?php echo $t01_sekolah->TTD2Nama->EditValue ?>"<?php echo $t01_sekolah->TTD2Nama->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t01_sekolah->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t01_sekolah_list->RowCnt ?>_t01_sekolah_TTD2Nama" class="t01_sekolah_TTD2Nama">
<span<?php echo $t01_sekolah->TTD2Nama->ViewAttributes() ?>>
<?php echo $t01_sekolah->TTD2Nama->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t01_sekolah->TTD2Jabatan->Visible) { // TTD2Jabatan ?>
		<td data-name="TTD2Jabatan"<?php echo $t01_sekolah->TTD2Jabatan->CellAttributes() ?>>
<?php if ($t01_sekolah->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t01_sekolah_list->RowCnt ?>_t01_sekolah_TTD2Jabatan" class="form-group t01_sekolah_TTD2Jabatan">
<input type="text" data-table="t01_sekolah" data-field="x_TTD2Jabatan" name="x<?php echo $t01_sekolah_list->RowIndex ?>_TTD2Jabatan" id="x<?php echo $t01_sekolah_list->RowIndex ?>_TTD2Jabatan" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($t01_sekolah->TTD2Jabatan->getPlaceHolder()) ?>" value="<?php echo $t01_sekolah->TTD2Jabatan->EditValue ?>"<?php echo $t01_sekolah->TTD2Jabatan->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t01_sekolah->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t01_sekolah_list->RowCnt ?>_t01_sekolah_TTD2Jabatan" class="t01_sekolah_TTD2Jabatan">
<span<?php echo $t01_sekolah->TTD2Jabatan->ViewAttributes() ?>>
<?php echo $t01_sekolah->TTD2Jabatan->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t01_sekolah->Logo->Visible) { // Logo ?>
		<td data-name="Logo"<?php echo $t01_sekolah->Logo->CellAttributes() ?>>
<?php if ($t01_sekolah->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t01_sekolah_list->RowCnt ?>_t01_sekolah_Logo" class="form-group t01_sekolah_Logo">
<input type="text" data-table="t01_sekolah" data-field="x_Logo" name="x<?php echo $t01_sekolah_list->RowIndex ?>_Logo" id="x<?php echo $t01_sekolah_list->RowIndex ?>_Logo" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($t01_sekolah->Logo->getPlaceHolder()) ?>" value="<?php echo $t01_sekolah->Logo->EditValue ?>"<?php echo $t01_sekolah->Logo->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t01_sekolah->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t01_sekolah_list->RowCnt ?>_t01_sekolah_Logo" class="t01_sekolah_Logo">
<span<?php echo $t01_sekolah->Logo->ViewAttributes() ?>>
<?php echo $t01_sekolah->Logo->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t01_sekolah_list->ListOptions->Render("body", "right", $t01_sekolah_list->RowCnt);
?>
	</tr>
<?php if ($t01_sekolah->RowType == EW_ROWTYPE_ADD || $t01_sekolah->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
ft01_sekolahlist.UpdateOpts(<?php echo $t01_sekolah_list->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	if ($t01_sekolah->CurrentAction <> "gridadd")
		$t01_sekolah_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($t01_sekolah->CurrentAction == "edit") { ?>
<input type="hidden" name="<?php echo $t01_sekolah_list->FormKeyCountName ?>" id="<?php echo $t01_sekolah_list->FormKeyCountName ?>" value="<?php echo $t01_sekolah_list->KeyCount ?>">
<?php } ?>
<?php if ($t01_sekolah->CurrentAction == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($t01_sekolah_list->Recordset)
	$t01_sekolah_list->Recordset->Close();
?>
</div>
<?php } ?>
<?php if ($t01_sekolah_list->TotalRecs == 0 && $t01_sekolah->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t01_sekolah_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<script type="text/javascript">
ft01_sekolahlist.Init();
</script>
<?php
$t01_sekolah_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$t01_sekolah_list->Page_Terminate();
?>
