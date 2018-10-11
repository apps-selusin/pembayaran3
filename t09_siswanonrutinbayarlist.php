<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg13.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql13.php") ?>
<?php include_once "phpfn13.php" ?>
<?php include_once "t09_siswanonrutinbayarinfo.php" ?>
<?php include_once "t03_siswainfo.php" ?>
<?php include_once "t96_employeesinfo.php" ?>
<?php include_once "userfn13.php" ?>
<?php

//
// Page class
//

$t09_siswanonrutinbayar_list = NULL; // Initialize page object first

class ct09_siswanonrutinbayar_list extends ct09_siswanonrutinbayar {

	// Page ID
	var $PageID = 'list';

	// Project ID
	var $ProjectID = "{9A296957-6EE4-4785-AB71-310FFD71D6FE}";

	// Table name
	var $TableName = 't09_siswanonrutinbayar';

	// Page object name
	var $PageObjName = 't09_siswanonrutinbayar_list';

	// Grid form hidden field names
	var $FormName = 'ft09_siswanonrutinbayarlist';
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

		// Table object (t09_siswanonrutinbayar)
		if (!isset($GLOBALS["t09_siswanonrutinbayar"]) || get_class($GLOBALS["t09_siswanonrutinbayar"]) == "ct09_siswanonrutinbayar") {
			$GLOBALS["t09_siswanonrutinbayar"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t09_siswanonrutinbayar"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "t09_siswanonrutinbayaradd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "t09_siswanonrutinbayardelete.php";
		$this->MultiUpdateUrl = "t09_siswanonrutinbayarupdate.php";

		// Table object (t03_siswa)
		if (!isset($GLOBALS['t03_siswa'])) $GLOBALS['t03_siswa'] = new ct03_siswa();

		// Table object (t96_employees)
		if (!isset($GLOBALS['t96_employees'])) $GLOBALS['t96_employees'] = new ct96_employees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 't09_siswanonrutinbayar', TRUE);

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
		$this->FilterOptions->TagClassName = "ewFilterOption ft09_siswanonrutinbayarlistsrch";

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
		$this->Siswa_Nomor_Induk->SetVisibility();
		$this->Siswa_Nama->SetVisibility();
		$this->nonrutin_id->SetVisibility();
		$this->Bayar_Tgl->SetVisibility();
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
		global $EW_EXPORT, $t09_siswanonrutinbayar;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($t09_siswanonrutinbayar);
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

				// Switch to inline add mode
				if ($this->CurrentAction == "add" || $this->CurrentAction == "copy")
					$this->InlineAddMode();
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

					// Insert Inline
					if ($this->CurrentAction == "insert" && @$_SESSION[EW_SESSION_INLINE_MODE] == "add")
						$this->InlineInsert();
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
		if ($sFilter == "") {
			$sFilter = "0=101";
			$this->SearchWhere = $sFilter;
		}

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

	// Switch to Inline Add mode
	function InlineAddMode() {
		global $Security, $Language;
		if (!$Security->CanAdd())
			$this->Page_Terminate("login.php"); // Return to login page
		$this->CurrentAction = "add";
		$_SESSION[EW_SESSION_INLINE_MODE] = "add"; // Enable inline add
	}

	// Perform update to Inline Add/Copy record
	function InlineInsert() {
		global $Language, $objForm, $gsFormError;
		$this->LoadOldRecord(); // Load old recordset
		$objForm->Index = 0;
		$this->LoadFormValues(); // Get form values

		// Validate form
		if (!$this->ValidateForm()) {
			$this->setFailureMessage($gsFormError); // Set validation error message
			$this->EventCancelled = TRUE; // Set event cancelled
			$this->CurrentAction = "add"; // Stay in add mode
			return;
		}
		$this->SendEmail = TRUE; // Send email on add success
		if ($this->AddRow($this->OldRecordset)) { // Add record
			if ($this->getSuccessMessage() == "")
				$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up add success message
			$this->ClearInlineMode(); // Clear inline add mode
		} else { // Add failed
			$this->EventCancelled = TRUE; // Set event cancelled
			$this->CurrentAction = "add"; // Stay in add mode
		}
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
		if ($objForm->HasValue("x_Siswa_Nomor_Induk") && $objForm->HasValue("o_Siswa_Nomor_Induk") && $this->Siswa_Nomor_Induk->CurrentValue <> $this->Siswa_Nomor_Induk->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_Siswa_Nama") && $objForm->HasValue("o_Siswa_Nama") && $this->Siswa_Nama->CurrentValue <> $this->Siswa_Nama->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_nonrutin_id") && $objForm->HasValue("o_nonrutin_id") && $this->nonrutin_id->CurrentValue <> $this->nonrutin_id->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_Bayar_Tgl") && $objForm->HasValue("o_Bayar_Tgl") && $this->Bayar_Tgl->CurrentValue <> $this->Bayar_Tgl->OldValue)
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
			$this->UpdateSort($this->Siswa_Nomor_Induk, $bCtrl); // Siswa_Nomor_Induk
			$this->UpdateSort($this->Siswa_Nama, $bCtrl); // Siswa_Nama
			$this->UpdateSort($this->nonrutin_id, $bCtrl); // nonrutin_id
			$this->UpdateSort($this->Bayar_Tgl, $bCtrl); // Bayar_Tgl
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
				$this->Siswa_Nomor_Induk->setSort("");
				$this->Siswa_Nama->setSort("");
				$this->nonrutin_id->setSort("");
				$this->Bayar_Tgl->setSort("");
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

		// "edit"
		$item = &$this->ListOptions->Add("edit");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanEdit();
		$item->OnLeft = TRUE;

		// "copy"
		$item = &$this->ListOptions->Add("copy");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanAdd() && ($this->CurrentAction == "add");
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

		// "copy"
		$oListOpt = &$this->ListOptions->Items["copy"];
		if (($this->CurrentAction == "add" || $this->CurrentAction == "copy") && $this->RowType == EW_ROWTYPE_ADD) { // Inline Add/Copy
			$this->ListOptions->CustomItem = "copy"; // Show copy column only
			$cancelurl = $this->AddMasterUrl($this->PageUrl() . "a=cancel");
			$oListOpt->Body = "<div" . (($oListOpt->OnLeft) ? " style=\"text-align: right\"" : "") . ">" .
				"<a class=\"ewGridLink ewInlineInsert\" title=\"" . ew_HtmlTitle($Language->Phrase("InsertLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("InsertLink")) . "\" href=\"\" onclick=\"return ewForms(this).Submit('" . $this->PageName() . "');\">" . $Language->Phrase("InsertLink") . "</a>&nbsp;" .
				"<a class=\"ewGridLink ewInlineCancel\" title=\"" . ew_HtmlTitle($Language->Phrase("CancelLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("CancelLink")) . "\" href=\"" . $cancelurl . "\">" . $Language->Phrase("CancelLink") . "</a>" .
				"<input type=\"hidden\" name=\"a_list\" id=\"a_list\" value=\"insert\"></div>";
			return;
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
		$option = $options["addedit"];

		// Add
		$item = &$option->Add("add");
		$addcaption = ew_HtmlTitle($Language->Phrase("AddLink"));
		$item->Body = "<a class=\"ewAddEdit ewAdd\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . ew_HtmlEncode($this->AddUrl) . "\">" . $Language->Phrase("AddLink") . "</a>";
		$item->Visible = ($this->AddUrl <> "" && $Security->CanAdd());

		// Inline Add
		$item = &$option->Add("inlineadd");
		$item->Body = "<a class=\"ewAddEdit ewInlineAdd\" title=\"" . ew_HtmlTitle($Language->Phrase("InlineAddLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("InlineAddLink")) . "\" href=\"" . ew_HtmlEncode($this->InlineAddUrl) . "\">" .$Language->Phrase("InlineAddLink") . "</a>";
		$item->Visible = ($this->InlineAddUrl <> "" && $Security->CanAdd());

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
		$item->Body = "<a class=\"ewSaveFilter\" data-form=\"ft09_siswanonrutinbayarlistsrch\" href=\"#\">" . $Language->Phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = FALSE;
		$item = &$this->FilterOptions->Add("deletefilter");
		$item->Body = "<a class=\"ewDeleteFilter\" data-form=\"ft09_siswanonrutinbayarlistsrch\" href=\"#\">" . $Language->Phrase("DeleteFilter") . "</a>";
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
					$item->Body = "<a class=\"ewAction ewListAction\" title=\"" . ew_HtmlEncode($caption) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({f:document.ft09_siswanonrutinbayarlist}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . "</a>";
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
					$item->Visible = $Security->CanAdd();
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
		$this->Siswa_Nomor_Induk->CurrentValue = NULL;
		$this->Siswa_Nomor_Induk->OldValue = $this->Siswa_Nomor_Induk->CurrentValue;
		$this->Siswa_Nama->CurrentValue = NULL;
		$this->Siswa_Nama->OldValue = $this->Siswa_Nama->CurrentValue;
		$this->nonrutin_id->CurrentValue = NULL;
		$this->nonrutin_id->OldValue = $this->nonrutin_id->CurrentValue;
		$this->Bayar_Tgl->CurrentValue = NULL;
		$this->Bayar_Tgl->OldValue = $this->Bayar_Tgl->CurrentValue;
		$this->Bayar_Jumlah->CurrentValue = 0.00;
		$this->Bayar_Jumlah->OldValue = $this->Bayar_Jumlah->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->Siswa_Nomor_Induk->FldIsDetailKey) {
			$this->Siswa_Nomor_Induk->setFormValue($objForm->GetValue("x_Siswa_Nomor_Induk"));
		}
		if (!$this->Siswa_Nama->FldIsDetailKey) {
			$this->Siswa_Nama->setFormValue($objForm->GetValue("x_Siswa_Nama"));
		}
		if (!$this->nonrutin_id->FldIsDetailKey) {
			$this->nonrutin_id->setFormValue($objForm->GetValue("x_nonrutin_id"));
		}
		if (!$this->Bayar_Tgl->FldIsDetailKey) {
			$this->Bayar_Tgl->setFormValue($objForm->GetValue("x_Bayar_Tgl"));
			$this->Bayar_Tgl->CurrentValue = ew_UnFormatDateTime($this->Bayar_Tgl->CurrentValue, 5);
		}
		if (!$this->Bayar_Jumlah->FldIsDetailKey) {
			$this->Bayar_Jumlah->setFormValue($objForm->GetValue("x_Bayar_Jumlah"));
		}
		if (!$this->id->FldIsDetailKey && $this->CurrentAction <> "gridadd" && $this->CurrentAction <> "add")
			$this->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		if ($this->CurrentAction <> "gridadd" && $this->CurrentAction <> "add")
			$this->id->CurrentValue = $this->id->FormValue;
		$this->Siswa_Nomor_Induk->CurrentValue = $this->Siswa_Nomor_Induk->FormValue;
		$this->Siswa_Nama->CurrentValue = $this->Siswa_Nama->FormValue;
		$this->nonrutin_id->CurrentValue = $this->nonrutin_id->FormValue;
		$this->Bayar_Tgl->CurrentValue = $this->Bayar_Tgl->FormValue;
		$this->Bayar_Tgl->CurrentValue = ew_UnFormatDateTime($this->Bayar_Tgl->CurrentValue, 5);
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
		$this->nonrutin_id->setDbValue($rs->fields('nonrutin_id'));
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
		$this->nonrutin_id->DbValue = $row['nonrutin_id'];
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
		// Siswa_Nomor_Induk
		// Siswa_Nama
		// nonrutin_id
		// Bayar_Tgl
		// Bayar_Jumlah

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// siswa_id
		$this->siswa_id->ViewValue = $this->siswa_id->CurrentValue;
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

		// Bayar_Tgl
		$this->Bayar_Tgl->ViewValue = $this->Bayar_Tgl->CurrentValue;
		$this->Bayar_Tgl->ViewValue = ew_FormatDateTime($this->Bayar_Tgl->ViewValue, 5);
		$this->Bayar_Tgl->ViewCustomAttributes = "";

		// Bayar_Jumlah
		$this->Bayar_Jumlah->ViewValue = $this->Bayar_Jumlah->CurrentValue;
		$this->Bayar_Jumlah->ViewValue = ew_FormatNumber($this->Bayar_Jumlah->ViewValue, 2, -2, -2, -2);
		$this->Bayar_Jumlah->CellCssStyle .= "text-align: right;";
		$this->Bayar_Jumlah->ViewCustomAttributes = "";

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

			// Bayar_Tgl
			$this->Bayar_Tgl->LinkCustomAttributes = "";
			$this->Bayar_Tgl->HrefValue = "";
			$this->Bayar_Tgl->TooltipValue = "";

			// Bayar_Jumlah
			$this->Bayar_Jumlah->LinkCustomAttributes = "";
			$this->Bayar_Jumlah->HrefValue = "";
			$this->Bayar_Jumlah->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// Siswa_Nomor_Induk
			$this->Siswa_Nomor_Induk->EditAttrs["class"] = "form-control";
			$this->Siswa_Nomor_Induk->EditCustomAttributes = "";
			$this->Siswa_Nomor_Induk->EditValue = ew_HtmlEncode($this->Siswa_Nomor_Induk->CurrentValue);
			$this->Siswa_Nomor_Induk->PlaceHolder = ew_RemoveHtml($this->Siswa_Nomor_Induk->FldCaption());

			// Siswa_Nama
			$this->Siswa_Nama->EditAttrs["class"] = "form-control";
			$this->Siswa_Nama->EditCustomAttributes = "";
			$this->Siswa_Nama->EditValue = ew_HtmlEncode($this->Siswa_Nama->CurrentValue);
			$this->Siswa_Nama->PlaceHolder = ew_RemoveHtml($this->Siswa_Nama->FldCaption());

			// nonrutin_id
			$this->nonrutin_id->EditAttrs["class"] = "form-control";
			$this->nonrutin_id->EditCustomAttributes = "";
			$this->nonrutin_id->EditValue = ew_HtmlEncode($this->nonrutin_id->CurrentValue);
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
					$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
					$this->nonrutin_id->EditValue = $this->nonrutin_id->DisplayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->nonrutin_id->EditValue = ew_HtmlEncode($this->nonrutin_id->CurrentValue);
				}
			} else {
				$this->nonrutin_id->EditValue = NULL;
			}
			$this->nonrutin_id->PlaceHolder = ew_RemoveHtml($this->nonrutin_id->FldCaption());

			// Bayar_Tgl
			$this->Bayar_Tgl->EditAttrs["class"] = "form-control";
			$this->Bayar_Tgl->EditCustomAttributes = "";
			$this->Bayar_Tgl->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->Bayar_Tgl->CurrentValue, 5));
			$this->Bayar_Tgl->PlaceHolder = ew_RemoveHtml($this->Bayar_Tgl->FldCaption());

			// Bayar_Jumlah
			$this->Bayar_Jumlah->EditAttrs["class"] = "form-control";
			$this->Bayar_Jumlah->EditCustomAttributes = "";
			$this->Bayar_Jumlah->EditValue = ew_HtmlEncode($this->Bayar_Jumlah->CurrentValue);
			$this->Bayar_Jumlah->PlaceHolder = ew_RemoveHtml($this->Bayar_Jumlah->FldCaption());
			if (strval($this->Bayar_Jumlah->EditValue) <> "" && is_numeric($this->Bayar_Jumlah->EditValue)) $this->Bayar_Jumlah->EditValue = ew_FormatNumber($this->Bayar_Jumlah->EditValue, -2, -2, -2, -2);

			// Add refer script
			// Siswa_Nomor_Induk

			$this->Siswa_Nomor_Induk->LinkCustomAttributes = "";
			$this->Siswa_Nomor_Induk->HrefValue = "";

			// Siswa_Nama
			$this->Siswa_Nama->LinkCustomAttributes = "";
			$this->Siswa_Nama->HrefValue = "";

			// nonrutin_id
			$this->nonrutin_id->LinkCustomAttributes = "";
			$this->nonrutin_id->HrefValue = "";

			// Bayar_Tgl
			$this->Bayar_Tgl->LinkCustomAttributes = "";
			$this->Bayar_Tgl->HrefValue = "";

			// Bayar_Jumlah
			$this->Bayar_Jumlah->LinkCustomAttributes = "";
			$this->Bayar_Jumlah->HrefValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// Siswa_Nomor_Induk
			$this->Siswa_Nomor_Induk->EditAttrs["class"] = "form-control";
			$this->Siswa_Nomor_Induk->EditCustomAttributes = "";
			$this->Siswa_Nomor_Induk->EditValue = ew_HtmlEncode($this->Siswa_Nomor_Induk->CurrentValue);
			$this->Siswa_Nomor_Induk->PlaceHolder = ew_RemoveHtml($this->Siswa_Nomor_Induk->FldCaption());

			// Siswa_Nama
			$this->Siswa_Nama->EditAttrs["class"] = "form-control";
			$this->Siswa_Nama->EditCustomAttributes = "";
			$this->Siswa_Nama->EditValue = ew_HtmlEncode($this->Siswa_Nama->CurrentValue);
			$this->Siswa_Nama->PlaceHolder = ew_RemoveHtml($this->Siswa_Nama->FldCaption());

			// nonrutin_id
			$this->nonrutin_id->EditAttrs["class"] = "form-control";
			$this->nonrutin_id->EditCustomAttributes = "";
			$this->nonrutin_id->EditValue = ew_HtmlEncode($this->nonrutin_id->CurrentValue);
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
					$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
					$this->nonrutin_id->EditValue = $this->nonrutin_id->DisplayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->nonrutin_id->EditValue = ew_HtmlEncode($this->nonrutin_id->CurrentValue);
				}
			} else {
				$this->nonrutin_id->EditValue = NULL;
			}
			$this->nonrutin_id->PlaceHolder = ew_RemoveHtml($this->nonrutin_id->FldCaption());

			// Bayar_Tgl
			$this->Bayar_Tgl->EditAttrs["class"] = "form-control";
			$this->Bayar_Tgl->EditCustomAttributes = "";
			$this->Bayar_Tgl->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->Bayar_Tgl->CurrentValue, 5));
			$this->Bayar_Tgl->PlaceHolder = ew_RemoveHtml($this->Bayar_Tgl->FldCaption());

			// Bayar_Jumlah
			$this->Bayar_Jumlah->EditAttrs["class"] = "form-control";
			$this->Bayar_Jumlah->EditCustomAttributes = "";
			$this->Bayar_Jumlah->EditValue = ew_HtmlEncode($this->Bayar_Jumlah->CurrentValue);
			$this->Bayar_Jumlah->PlaceHolder = ew_RemoveHtml($this->Bayar_Jumlah->FldCaption());
			if (strval($this->Bayar_Jumlah->EditValue) <> "" && is_numeric($this->Bayar_Jumlah->EditValue)) $this->Bayar_Jumlah->EditValue = ew_FormatNumber($this->Bayar_Jumlah->EditValue, -2, -2, -2, -2);

			// Edit refer script
			// Siswa_Nomor_Induk

			$this->Siswa_Nomor_Induk->LinkCustomAttributes = "";
			$this->Siswa_Nomor_Induk->HrefValue = "";

			// Siswa_Nama
			$this->Siswa_Nama->LinkCustomAttributes = "";
			$this->Siswa_Nama->HrefValue = "";

			// nonrutin_id
			$this->nonrutin_id->LinkCustomAttributes = "";
			$this->nonrutin_id->HrefValue = "";

			// Bayar_Tgl
			$this->Bayar_Tgl->LinkCustomAttributes = "";
			$this->Bayar_Tgl->HrefValue = "";

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
		if (!$this->nonrutin_id->FldIsDetailKey && !is_null($this->nonrutin_id->FormValue) && $this->nonrutin_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->nonrutin_id->FldCaption(), $this->nonrutin_id->ReqErrMsg));
		}
		if (!ew_CheckInteger($this->nonrutin_id->FormValue)) {
			ew_AddMessage($gsFormError, $this->nonrutin_id->FldErrMsg());
		}
		if (!ew_CheckDate($this->Bayar_Tgl->FormValue)) {
			ew_AddMessage($gsFormError, $this->Bayar_Tgl->FldErrMsg());
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

			// Siswa_Nomor_Induk
			$this->Siswa_Nomor_Induk->SetDbValueDef($rsnew, $this->Siswa_Nomor_Induk->CurrentValue, NULL, $this->Siswa_Nomor_Induk->ReadOnly);

			// Siswa_Nama
			$this->Siswa_Nama->SetDbValueDef($rsnew, $this->Siswa_Nama->CurrentValue, NULL, $this->Siswa_Nama->ReadOnly);

			// nonrutin_id
			$this->nonrutin_id->SetDbValueDef($rsnew, $this->nonrutin_id->CurrentValue, 0, $this->nonrutin_id->ReadOnly);

			// Bayar_Tgl
			$this->Bayar_Tgl->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->Bayar_Tgl->CurrentValue, 5), NULL, $this->Bayar_Tgl->ReadOnly);

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
		if ($this->siswa_id->getSessionValue() <> "") {
			$sMasterFilter = str_replace("@id@", ew_AdjustSql($this->siswa_id->getSessionValue(), "DB"), $sMasterFilter);
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

		// Siswa_Nomor_Induk
		$this->Siswa_Nomor_Induk->SetDbValueDef($rsnew, $this->Siswa_Nomor_Induk->CurrentValue, NULL, FALSE);

		// Siswa_Nama
		$this->Siswa_Nama->SetDbValueDef($rsnew, $this->Siswa_Nama->CurrentValue, NULL, FALSE);

		// nonrutin_id
		$this->nonrutin_id->SetDbValueDef($rsnew, $this->nonrutin_id->CurrentValue, 0, FALSE);

		// Bayar_Tgl
		$this->Bayar_Tgl->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->Bayar_Tgl->CurrentValue, 5), NULL, FALSE);

		// Bayar_Jumlah
		$this->Bayar_Jumlah->SetDbValueDef($rsnew, $this->Bayar_Jumlah->CurrentValue, NULL, strval($this->Bayar_Jumlah->CurrentValue) == "");

		// siswa_id
		if ($this->siswa_id->getSessionValue() <> "") {
			$rsnew['siswa_id'] = $this->siswa_id->getSessionValue();
		}

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
		case "x_nonrutin_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id` AS `LinkFld`, `Nama` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t07_nonrutin`";
			$sWhereWrk = "{filter}";
			$this->nonrutin_id->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` = {filter_value}', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->nonrutin_id, $sWhereWrk); // Call Lookup selecting
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
		case "x_nonrutin_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id`, `Nama` AS `DispFld` FROM `t07_nonrutin`";
			$sWhereWrk = "`Nama` LIKE '{query_value}%'";
			$this->nonrutin_id->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->nonrutin_id, $sWhereWrk); // Call Lookup selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " LIMIT " . EW_AUTO_SUGGEST_MAX_ENTRIES;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
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
if (!isset($t09_siswanonrutinbayar_list)) $t09_siswanonrutinbayar_list = new ct09_siswanonrutinbayar_list();

// Page init
$t09_siswanonrutinbayar_list->Page_Init();

// Page main
$t09_siswanonrutinbayar_list->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t09_siswanonrutinbayar_list->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "list";
var CurrentForm = ft09_siswanonrutinbayarlist = new ew_Form("ft09_siswanonrutinbayarlist", "list");
ft09_siswanonrutinbayarlist.FormKeyCountName = '<?php echo $t09_siswanonrutinbayar_list->FormKeyCountName ?>';

// Validate form
ft09_siswanonrutinbayarlist.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_nonrutin_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t09_siswanonrutinbayar->nonrutin_id->FldCaption(), $t09_siswanonrutinbayar->nonrutin_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_nonrutin_id");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t09_siswanonrutinbayar->nonrutin_id->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Bayar_Tgl");
			if (elm && !ew_CheckDate(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t09_siswanonrutinbayar->Bayar_Tgl->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Bayar_Jumlah");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t09_siswanonrutinbayar->Bayar_Jumlah->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
ft09_siswanonrutinbayarlist.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft09_siswanonrutinbayarlist.ValidateRequired = true;
<?php } else { ?>
ft09_siswanonrutinbayarlist.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
ft09_siswanonrutinbayarlist.Lists["x_nonrutin_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Nama","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t07_nonrutin"};

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<div class="ewToolbar">
<?php $Breadcrumb->Render(); ?>
<?php if ($t09_siswanonrutinbayar_list->TotalRecs > 0 && $t09_siswanonrutinbayar_list->ExportOptions->Visible()) { ?>
<?php $t09_siswanonrutinbayar_list->ExportOptions->Render("body") ?>
<?php } ?>
<?php echo $Language->SelectionForm(); ?>
<div class="clearfix"></div>
</div>
<?php if (($t09_siswanonrutinbayar->Export == "") || (EW_EXPORT_MASTER_RECORD && $t09_siswanonrutinbayar->Export == "print")) { ?>
<?php
if ($t09_siswanonrutinbayar_list->DbMasterFilter <> "" && $t09_siswanonrutinbayar->getCurrentMasterTable() == "t03_siswa") {
	if ($t09_siswanonrutinbayar_list->MasterRecordExists) {
?>
<?php include_once "t03_siswamaster.php" ?>
<?php
	}
}
?>
<?php } ?>
<?php
	$bSelectLimit = $t09_siswanonrutinbayar_list->UseSelectLimit;
	if ($bSelectLimit) {
		if ($t09_siswanonrutinbayar_list->TotalRecs <= 0)
			$t09_siswanonrutinbayar_list->TotalRecs = $t09_siswanonrutinbayar->SelectRecordCount();
	} else {
		if (!$t09_siswanonrutinbayar_list->Recordset && ($t09_siswanonrutinbayar_list->Recordset = $t09_siswanonrutinbayar_list->LoadRecordset()))
			$t09_siswanonrutinbayar_list->TotalRecs = $t09_siswanonrutinbayar_list->Recordset->RecordCount();
	}
	$t09_siswanonrutinbayar_list->StartRec = 1;
	if ($t09_siswanonrutinbayar_list->DisplayRecs <= 0 || ($t09_siswanonrutinbayar->Export <> "" && $t09_siswanonrutinbayar->ExportAll)) // Display all records
		$t09_siswanonrutinbayar_list->DisplayRecs = $t09_siswanonrutinbayar_list->TotalRecs;
	if (!($t09_siswanonrutinbayar->Export <> "" && $t09_siswanonrutinbayar->ExportAll))
		$t09_siswanonrutinbayar_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$t09_siswanonrutinbayar_list->Recordset = $t09_siswanonrutinbayar_list->LoadRecordset($t09_siswanonrutinbayar_list->StartRec-1, $t09_siswanonrutinbayar_list->DisplayRecs);

	// Set no record found message
	if ($t09_siswanonrutinbayar->CurrentAction == "" && $t09_siswanonrutinbayar_list->TotalRecs == 0) {
		if (!$Security->CanList())
			$t09_siswanonrutinbayar_list->setWarningMessage(ew_DeniedMsg());
		if ($t09_siswanonrutinbayar_list->SearchWhere == "0=101")
			$t09_siswanonrutinbayar_list->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$t09_siswanonrutinbayar_list->setWarningMessage($Language->Phrase("NoRecord"));
	}
$t09_siswanonrutinbayar_list->RenderOtherOptions();
?>
<?php $t09_siswanonrutinbayar_list->ShowPageHeader(); ?>
<?php
$t09_siswanonrutinbayar_list->ShowMessage();
?>
<?php if ($t09_siswanonrutinbayar_list->TotalRecs > 0 || $t09_siswanonrutinbayar->CurrentAction <> "") { ?>
<div class="panel panel-default ewGrid t09_siswanonrutinbayar">
<div class="panel-heading ewGridUpperPanel">
<?php if ($t09_siswanonrutinbayar->CurrentAction <> "gridadd" && $t09_siswanonrutinbayar->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="form-inline ewForm ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($t09_siswanonrutinbayar_list->Pager)) $t09_siswanonrutinbayar_list->Pager = new cPrevNextPager($t09_siswanonrutinbayar_list->StartRec, $t09_siswanonrutinbayar_list->DisplayRecs, $t09_siswanonrutinbayar_list->TotalRecs) ?>
<?php if ($t09_siswanonrutinbayar_list->Pager->RecordCount > 0 && $t09_siswanonrutinbayar_list->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($t09_siswanonrutinbayar_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $t09_siswanonrutinbayar_list->PageUrl() ?>start=<?php echo $t09_siswanonrutinbayar_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($t09_siswanonrutinbayar_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $t09_siswanonrutinbayar_list->PageUrl() ?>start=<?php echo $t09_siswanonrutinbayar_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $t09_siswanonrutinbayar_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($t09_siswanonrutinbayar_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $t09_siswanonrutinbayar_list->PageUrl() ?>start=<?php echo $t09_siswanonrutinbayar_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($t09_siswanonrutinbayar_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $t09_siswanonrutinbayar_list->PageUrl() ?>start=<?php echo $t09_siswanonrutinbayar_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $t09_siswanonrutinbayar_list->Pager->PageCount ?></span>
</div>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $t09_siswanonrutinbayar_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $t09_siswanonrutinbayar_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $t09_siswanonrutinbayar_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t09_siswanonrutinbayar_list->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
</div>
<form name="ft09_siswanonrutinbayarlist" id="ft09_siswanonrutinbayarlist" class="form-inline ewForm ewListForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($t09_siswanonrutinbayar_list->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $t09_siswanonrutinbayar_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t09_siswanonrutinbayar">
<?php if ($t09_siswanonrutinbayar->getCurrentMasterTable() == "t03_siswa" && $t09_siswanonrutinbayar->CurrentAction <> "") { ?>
<input type="hidden" name="<?php echo EW_TABLE_SHOW_MASTER ?>" value="t03_siswa">
<input type="hidden" name="fk_id" value="<?php echo $t09_siswanonrutinbayar->siswa_id->getSessionValue() ?>">
<?php } ?>
<div id="gmp_t09_siswanonrutinbayar" class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<?php if ($t09_siswanonrutinbayar_list->TotalRecs > 0 || $t09_siswanonrutinbayar->CurrentAction == "add" || $t09_siswanonrutinbayar->CurrentAction == "copy" || $t09_siswanonrutinbayar->CurrentAction == "gridedit") { ?>
<table id="tbl_t09_siswanonrutinbayarlist" class="table ewTable">
<?php echo $t09_siswanonrutinbayar->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Header row
$t09_siswanonrutinbayar_list->RowType = EW_ROWTYPE_HEADER;

// Render list options
$t09_siswanonrutinbayar_list->RenderListOptions();

// Render list options (header, left)
$t09_siswanonrutinbayar_list->ListOptions->Render("header", "left");
?>
<?php if ($t09_siswanonrutinbayar->Siswa_Nomor_Induk->Visible) { // Siswa_Nomor_Induk ?>
	<?php if ($t09_siswanonrutinbayar->SortUrl($t09_siswanonrutinbayar->Siswa_Nomor_Induk) == "") { ?>
		<th data-name="Siswa_Nomor_Induk"><div id="elh_t09_siswanonrutinbayar_Siswa_Nomor_Induk" class="t09_siswanonrutinbayar_Siswa_Nomor_Induk"><div class="ewTableHeaderCaption"><?php echo $t09_siswanonrutinbayar->Siswa_Nomor_Induk->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Siswa_Nomor_Induk"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t09_siswanonrutinbayar->SortUrl($t09_siswanonrutinbayar->Siswa_Nomor_Induk) ?>',2);"><div id="elh_t09_siswanonrutinbayar_Siswa_Nomor_Induk" class="t09_siswanonrutinbayar_Siswa_Nomor_Induk">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t09_siswanonrutinbayar->Siswa_Nomor_Induk->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t09_siswanonrutinbayar->Siswa_Nomor_Induk->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t09_siswanonrutinbayar->Siswa_Nomor_Induk->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t09_siswanonrutinbayar->Siswa_Nama->Visible) { // Siswa_Nama ?>
	<?php if ($t09_siswanonrutinbayar->SortUrl($t09_siswanonrutinbayar->Siswa_Nama) == "") { ?>
		<th data-name="Siswa_Nama"><div id="elh_t09_siswanonrutinbayar_Siswa_Nama" class="t09_siswanonrutinbayar_Siswa_Nama"><div class="ewTableHeaderCaption"><?php echo $t09_siswanonrutinbayar->Siswa_Nama->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Siswa_Nama"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t09_siswanonrutinbayar->SortUrl($t09_siswanonrutinbayar->Siswa_Nama) ?>',2);"><div id="elh_t09_siswanonrutinbayar_Siswa_Nama" class="t09_siswanonrutinbayar_Siswa_Nama">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t09_siswanonrutinbayar->Siswa_Nama->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t09_siswanonrutinbayar->Siswa_Nama->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t09_siswanonrutinbayar->Siswa_Nama->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t09_siswanonrutinbayar->nonrutin_id->Visible) { // nonrutin_id ?>
	<?php if ($t09_siswanonrutinbayar->SortUrl($t09_siswanonrutinbayar->nonrutin_id) == "") { ?>
		<th data-name="nonrutin_id"><div id="elh_t09_siswanonrutinbayar_nonrutin_id" class="t09_siswanonrutinbayar_nonrutin_id"><div class="ewTableHeaderCaption"><?php echo $t09_siswanonrutinbayar->nonrutin_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nonrutin_id"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t09_siswanonrutinbayar->SortUrl($t09_siswanonrutinbayar->nonrutin_id) ?>',2);"><div id="elh_t09_siswanonrutinbayar_nonrutin_id" class="t09_siswanonrutinbayar_nonrutin_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t09_siswanonrutinbayar->nonrutin_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t09_siswanonrutinbayar->nonrutin_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t09_siswanonrutinbayar->nonrutin_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t09_siswanonrutinbayar->Bayar_Tgl->Visible) { // Bayar_Tgl ?>
	<?php if ($t09_siswanonrutinbayar->SortUrl($t09_siswanonrutinbayar->Bayar_Tgl) == "") { ?>
		<th data-name="Bayar_Tgl"><div id="elh_t09_siswanonrutinbayar_Bayar_Tgl" class="t09_siswanonrutinbayar_Bayar_Tgl"><div class="ewTableHeaderCaption"><?php echo $t09_siswanonrutinbayar->Bayar_Tgl->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Bayar_Tgl"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t09_siswanonrutinbayar->SortUrl($t09_siswanonrutinbayar->Bayar_Tgl) ?>',2);"><div id="elh_t09_siswanonrutinbayar_Bayar_Tgl" class="t09_siswanonrutinbayar_Bayar_Tgl">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t09_siswanonrutinbayar->Bayar_Tgl->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t09_siswanonrutinbayar->Bayar_Tgl->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t09_siswanonrutinbayar->Bayar_Tgl->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t09_siswanonrutinbayar->Bayar_Jumlah->Visible) { // Bayar_Jumlah ?>
	<?php if ($t09_siswanonrutinbayar->SortUrl($t09_siswanonrutinbayar->Bayar_Jumlah) == "") { ?>
		<th data-name="Bayar_Jumlah"><div id="elh_t09_siswanonrutinbayar_Bayar_Jumlah" class="t09_siswanonrutinbayar_Bayar_Jumlah"><div class="ewTableHeaderCaption"><?php echo $t09_siswanonrutinbayar->Bayar_Jumlah->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Bayar_Jumlah"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $t09_siswanonrutinbayar->SortUrl($t09_siswanonrutinbayar->Bayar_Jumlah) ?>',2);"><div id="elh_t09_siswanonrutinbayar_Bayar_Jumlah" class="t09_siswanonrutinbayar_Bayar_Jumlah">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t09_siswanonrutinbayar->Bayar_Jumlah->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t09_siswanonrutinbayar->Bayar_Jumlah->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t09_siswanonrutinbayar->Bayar_Jumlah->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$t09_siswanonrutinbayar_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($t09_siswanonrutinbayar->CurrentAction == "add" || $t09_siswanonrutinbayar->CurrentAction == "copy") {
		$t09_siswanonrutinbayar_list->RowIndex = 0;
		$t09_siswanonrutinbayar_list->KeyCount = $t09_siswanonrutinbayar_list->RowIndex;
		if ($t09_siswanonrutinbayar->CurrentAction == "add")
			$t09_siswanonrutinbayar_list->LoadDefaultValues();
		if ($t09_siswanonrutinbayar->EventCancelled) // Insert failed
			$t09_siswanonrutinbayar_list->RestoreFormValues(); // Restore form values

		// Set row properties
		$t09_siswanonrutinbayar->ResetAttrs();
		$t09_siswanonrutinbayar->RowAttrs = array_merge($t09_siswanonrutinbayar->RowAttrs, array('data-rowindex'=>0, 'id'=>'r0_t09_siswanonrutinbayar', 'data-rowtype'=>EW_ROWTYPE_ADD));
		$t09_siswanonrutinbayar->RowType = EW_ROWTYPE_ADD;

		// Render row
		$t09_siswanonrutinbayar_list->RenderRow();

		// Render list options
		$t09_siswanonrutinbayar_list->RenderListOptions();
		$t09_siswanonrutinbayar_list->StartRowCnt = 0;
?>
	<tr<?php echo $t09_siswanonrutinbayar->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t09_siswanonrutinbayar_list->ListOptions->Render("body", "left", $t09_siswanonrutinbayar_list->RowCnt);
?>
	<?php if ($t09_siswanonrutinbayar->Siswa_Nomor_Induk->Visible) { // Siswa_Nomor_Induk ?>
		<td data-name="Siswa_Nomor_Induk">
<span id="el<?php echo $t09_siswanonrutinbayar_list->RowCnt ?>_t09_siswanonrutinbayar_Siswa_Nomor_Induk" class="form-group t09_siswanonrutinbayar_Siswa_Nomor_Induk">
<input type="text" data-table="t09_siswanonrutinbayar" data-field="x_Siswa_Nomor_Induk" name="x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_Siswa_Nomor_Induk" id="x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_Siswa_Nomor_Induk" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->Siswa_Nomor_Induk->getPlaceHolder()) ?>" value="<?php echo $t09_siswanonrutinbayar->Siswa_Nomor_Induk->EditValue ?>"<?php echo $t09_siswanonrutinbayar->Siswa_Nomor_Induk->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t09_siswanonrutinbayar" data-field="x_Siswa_Nomor_Induk" name="o<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_Siswa_Nomor_Induk" id="o<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_Siswa_Nomor_Induk" value="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->Siswa_Nomor_Induk->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t09_siswanonrutinbayar->Siswa_Nama->Visible) { // Siswa_Nama ?>
		<td data-name="Siswa_Nama">
<span id="el<?php echo $t09_siswanonrutinbayar_list->RowCnt ?>_t09_siswanonrutinbayar_Siswa_Nama" class="form-group t09_siswanonrutinbayar_Siswa_Nama">
<input type="text" data-table="t09_siswanonrutinbayar" data-field="x_Siswa_Nama" name="x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_Siswa_Nama" id="x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_Siswa_Nama" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->Siswa_Nama->getPlaceHolder()) ?>" value="<?php echo $t09_siswanonrutinbayar->Siswa_Nama->EditValue ?>"<?php echo $t09_siswanonrutinbayar->Siswa_Nama->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t09_siswanonrutinbayar" data-field="x_Siswa_Nama" name="o<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_Siswa_Nama" id="o<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_Siswa_Nama" value="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->Siswa_Nama->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t09_siswanonrutinbayar->nonrutin_id->Visible) { // nonrutin_id ?>
		<td data-name="nonrutin_id">
<span id="el<?php echo $t09_siswanonrutinbayar_list->RowCnt ?>_t09_siswanonrutinbayar_nonrutin_id" class="form-group t09_siswanonrutinbayar_nonrutin_id">
<?php
$wrkonchange = trim(" " . @$t09_siswanonrutinbayar->nonrutin_id->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$t09_siswanonrutinbayar->nonrutin_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_nonrutin_id" style="white-space: nowrap; z-index: <?php echo (9000 - $t09_siswanonrutinbayar_list->RowCnt * 10) ?>">
	<input type="text" name="sv_x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_nonrutin_id" id="sv_x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_nonrutin_id" value="<?php echo $t09_siswanonrutinbayar->nonrutin_id->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->nonrutin_id->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->nonrutin_id->getPlaceHolder()) ?>"<?php echo $t09_siswanonrutinbayar->nonrutin_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t09_siswanonrutinbayar" data-field="x_nonrutin_id" data-value-separator="<?php echo $t09_siswanonrutinbayar->nonrutin_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_nonrutin_id" id="x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_nonrutin_id" value="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->nonrutin_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<input type="hidden" name="q_x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_nonrutin_id" id="q_x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_nonrutin_id" value="<?php echo $t09_siswanonrutinbayar->nonrutin_id->LookupFilterQuery(true) ?>">
<script type="text/javascript">
ft09_siswanonrutinbayarlist.CreateAutoSuggest({"id":"x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_nonrutin_id","forceSelect":false});
</script>
</span>
<input type="hidden" data-table="t09_siswanonrutinbayar" data-field="x_nonrutin_id" name="o<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_nonrutin_id" id="o<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_nonrutin_id" value="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->nonrutin_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t09_siswanonrutinbayar->Bayar_Tgl->Visible) { // Bayar_Tgl ?>
		<td data-name="Bayar_Tgl">
<span id="el<?php echo $t09_siswanonrutinbayar_list->RowCnt ?>_t09_siswanonrutinbayar_Bayar_Tgl" class="form-group t09_siswanonrutinbayar_Bayar_Tgl">
<input type="text" data-table="t09_siswanonrutinbayar" data-field="x_Bayar_Tgl" data-format="5" name="x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_Bayar_Tgl" id="x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_Bayar_Tgl" placeholder="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->Bayar_Tgl->getPlaceHolder()) ?>" value="<?php echo $t09_siswanonrutinbayar->Bayar_Tgl->EditValue ?>"<?php echo $t09_siswanonrutinbayar->Bayar_Tgl->EditAttributes() ?>>
<?php if (!$t09_siswanonrutinbayar->Bayar_Tgl->ReadOnly && !$t09_siswanonrutinbayar->Bayar_Tgl->Disabled && !isset($t09_siswanonrutinbayar->Bayar_Tgl->EditAttrs["readonly"]) && !isset($t09_siswanonrutinbayar->Bayar_Tgl->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateCalendar("ft09_siswanonrutinbayarlist", "x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_Bayar_Tgl", 5);
</script>
<?php } ?>
</span>
<input type="hidden" data-table="t09_siswanonrutinbayar" data-field="x_Bayar_Tgl" name="o<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_Bayar_Tgl" id="o<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_Bayar_Tgl" value="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->Bayar_Tgl->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t09_siswanonrutinbayar->Bayar_Jumlah->Visible) { // Bayar_Jumlah ?>
		<td data-name="Bayar_Jumlah">
<span id="el<?php echo $t09_siswanonrutinbayar_list->RowCnt ?>_t09_siswanonrutinbayar_Bayar_Jumlah" class="form-group t09_siswanonrutinbayar_Bayar_Jumlah">
<input type="text" data-table="t09_siswanonrutinbayar" data-field="x_Bayar_Jumlah" name="x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_Bayar_Jumlah" id="x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_Bayar_Jumlah" size="30" placeholder="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->Bayar_Jumlah->getPlaceHolder()) ?>" value="<?php echo $t09_siswanonrutinbayar->Bayar_Jumlah->EditValue ?>"<?php echo $t09_siswanonrutinbayar->Bayar_Jumlah->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t09_siswanonrutinbayar" data-field="x_Bayar_Jumlah" name="o<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_Bayar_Jumlah" id="o<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_Bayar_Jumlah" value="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->Bayar_Jumlah->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t09_siswanonrutinbayar_list->ListOptions->Render("body", "right", $t09_siswanonrutinbayar_list->RowCnt);
?>
<script type="text/javascript">
ft09_siswanonrutinbayarlist.UpdateOpts(<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
<?php
if ($t09_siswanonrutinbayar->ExportAll && $t09_siswanonrutinbayar->Export <> "") {
	$t09_siswanonrutinbayar_list->StopRec = $t09_siswanonrutinbayar_list->TotalRecs;
} else {

	// Set the last record to display
	if ($t09_siswanonrutinbayar_list->TotalRecs > $t09_siswanonrutinbayar_list->StartRec + $t09_siswanonrutinbayar_list->DisplayRecs - 1)
		$t09_siswanonrutinbayar_list->StopRec = $t09_siswanonrutinbayar_list->StartRec + $t09_siswanonrutinbayar_list->DisplayRecs - 1;
	else
		$t09_siswanonrutinbayar_list->StopRec = $t09_siswanonrutinbayar_list->TotalRecs;
}

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($t09_siswanonrutinbayar_list->FormKeyCountName) && ($t09_siswanonrutinbayar->CurrentAction == "gridadd" || $t09_siswanonrutinbayar->CurrentAction == "gridedit" || $t09_siswanonrutinbayar->CurrentAction == "F")) {
		$t09_siswanonrutinbayar_list->KeyCount = $objForm->GetValue($t09_siswanonrutinbayar_list->FormKeyCountName);
		$t09_siswanonrutinbayar_list->StopRec = $t09_siswanonrutinbayar_list->StartRec + $t09_siswanonrutinbayar_list->KeyCount - 1;
	}
}
$t09_siswanonrutinbayar_list->RecCnt = $t09_siswanonrutinbayar_list->StartRec - 1;
if ($t09_siswanonrutinbayar_list->Recordset && !$t09_siswanonrutinbayar_list->Recordset->EOF) {
	$t09_siswanonrutinbayar_list->Recordset->MoveFirst();
	$bSelectLimit = $t09_siswanonrutinbayar_list->UseSelectLimit;
	if (!$bSelectLimit && $t09_siswanonrutinbayar_list->StartRec > 1)
		$t09_siswanonrutinbayar_list->Recordset->Move($t09_siswanonrutinbayar_list->StartRec - 1);
} elseif (!$t09_siswanonrutinbayar->AllowAddDeleteRow && $t09_siswanonrutinbayar_list->StopRec == 0) {
	$t09_siswanonrutinbayar_list->StopRec = $t09_siswanonrutinbayar->GridAddRowCount;
}

// Initialize aggregate
$t09_siswanonrutinbayar->RowType = EW_ROWTYPE_AGGREGATEINIT;
$t09_siswanonrutinbayar->ResetAttrs();
$t09_siswanonrutinbayar_list->RenderRow();
$t09_siswanonrutinbayar_list->EditRowCnt = 0;
if ($t09_siswanonrutinbayar->CurrentAction == "edit")
	$t09_siswanonrutinbayar_list->RowIndex = 1;
if ($t09_siswanonrutinbayar->CurrentAction == "gridedit")
	$t09_siswanonrutinbayar_list->RowIndex = 0;
while ($t09_siswanonrutinbayar_list->RecCnt < $t09_siswanonrutinbayar_list->StopRec) {
	$t09_siswanonrutinbayar_list->RecCnt++;
	if (intval($t09_siswanonrutinbayar_list->RecCnt) >= intval($t09_siswanonrutinbayar_list->StartRec)) {
		$t09_siswanonrutinbayar_list->RowCnt++;
		if ($t09_siswanonrutinbayar->CurrentAction == "gridadd" || $t09_siswanonrutinbayar->CurrentAction == "gridedit" || $t09_siswanonrutinbayar->CurrentAction == "F") {
			$t09_siswanonrutinbayar_list->RowIndex++;
			$objForm->Index = $t09_siswanonrutinbayar_list->RowIndex;
			if ($objForm->HasValue($t09_siswanonrutinbayar_list->FormActionName))
				$t09_siswanonrutinbayar_list->RowAction = strval($objForm->GetValue($t09_siswanonrutinbayar_list->FormActionName));
			elseif ($t09_siswanonrutinbayar->CurrentAction == "gridadd")
				$t09_siswanonrutinbayar_list->RowAction = "insert";
			else
				$t09_siswanonrutinbayar_list->RowAction = "";
		}

		// Set up key count
		$t09_siswanonrutinbayar_list->KeyCount = $t09_siswanonrutinbayar_list->RowIndex;

		// Init row class and style
		$t09_siswanonrutinbayar->ResetAttrs();
		$t09_siswanonrutinbayar->CssClass = "";
		if ($t09_siswanonrutinbayar->CurrentAction == "gridadd") {
			$t09_siswanonrutinbayar_list->LoadDefaultValues(); // Load default values
		} else {
			$t09_siswanonrutinbayar_list->LoadRowValues($t09_siswanonrutinbayar_list->Recordset); // Load row values
		}
		$t09_siswanonrutinbayar->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($t09_siswanonrutinbayar->CurrentAction == "edit") {
			if ($t09_siswanonrutinbayar_list->CheckInlineEditKey() && $t09_siswanonrutinbayar_list->EditRowCnt == 0) { // Inline edit
				$t09_siswanonrutinbayar->RowType = EW_ROWTYPE_EDIT; // Render edit
			}
		}
		if ($t09_siswanonrutinbayar->CurrentAction == "gridedit") { // Grid edit
			if ($t09_siswanonrutinbayar->EventCancelled) {
				$t09_siswanonrutinbayar_list->RestoreCurrentRowFormValues($t09_siswanonrutinbayar_list->RowIndex); // Restore form values
			}
			if ($t09_siswanonrutinbayar_list->RowAction == "insert")
				$t09_siswanonrutinbayar->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$t09_siswanonrutinbayar->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($t09_siswanonrutinbayar->CurrentAction == "edit" && $t09_siswanonrutinbayar->RowType == EW_ROWTYPE_EDIT && $t09_siswanonrutinbayar->EventCancelled) { // Update failed
			$objForm->Index = 1;
			$t09_siswanonrutinbayar_list->RestoreFormValues(); // Restore form values
		}
		if ($t09_siswanonrutinbayar->CurrentAction == "gridedit" && ($t09_siswanonrutinbayar->RowType == EW_ROWTYPE_EDIT || $t09_siswanonrutinbayar->RowType == EW_ROWTYPE_ADD) && $t09_siswanonrutinbayar->EventCancelled) // Update failed
			$t09_siswanonrutinbayar_list->RestoreCurrentRowFormValues($t09_siswanonrutinbayar_list->RowIndex); // Restore form values
		if ($t09_siswanonrutinbayar->RowType == EW_ROWTYPE_EDIT) // Edit row
			$t09_siswanonrutinbayar_list->EditRowCnt++;

		// Set up row id / data-rowindex
		$t09_siswanonrutinbayar->RowAttrs = array_merge($t09_siswanonrutinbayar->RowAttrs, array('data-rowindex'=>$t09_siswanonrutinbayar_list->RowCnt, 'id'=>'r' . $t09_siswanonrutinbayar_list->RowCnt . '_t09_siswanonrutinbayar', 'data-rowtype'=>$t09_siswanonrutinbayar->RowType));

		// Render row
		$t09_siswanonrutinbayar_list->RenderRow();

		// Render list options
		$t09_siswanonrutinbayar_list->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t09_siswanonrutinbayar_list->RowAction <> "delete" && $t09_siswanonrutinbayar_list->RowAction <> "insertdelete" && !($t09_siswanonrutinbayar_list->RowAction == "insert" && $t09_siswanonrutinbayar->CurrentAction == "F" && $t09_siswanonrutinbayar_list->EmptyRow())) {
?>
	<tr<?php echo $t09_siswanonrutinbayar->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t09_siswanonrutinbayar_list->ListOptions->Render("body", "left", $t09_siswanonrutinbayar_list->RowCnt);
?>
	<?php if ($t09_siswanonrutinbayar->Siswa_Nomor_Induk->Visible) { // Siswa_Nomor_Induk ?>
		<td data-name="Siswa_Nomor_Induk"<?php echo $t09_siswanonrutinbayar->Siswa_Nomor_Induk->CellAttributes() ?>>
<?php if ($t09_siswanonrutinbayar->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t09_siswanonrutinbayar_list->RowCnt ?>_t09_siswanonrutinbayar_Siswa_Nomor_Induk" class="form-group t09_siswanonrutinbayar_Siswa_Nomor_Induk">
<input type="text" data-table="t09_siswanonrutinbayar" data-field="x_Siswa_Nomor_Induk" name="x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_Siswa_Nomor_Induk" id="x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_Siswa_Nomor_Induk" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->Siswa_Nomor_Induk->getPlaceHolder()) ?>" value="<?php echo $t09_siswanonrutinbayar->Siswa_Nomor_Induk->EditValue ?>"<?php echo $t09_siswanonrutinbayar->Siswa_Nomor_Induk->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t09_siswanonrutinbayar" data-field="x_Siswa_Nomor_Induk" name="o<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_Siswa_Nomor_Induk" id="o<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_Siswa_Nomor_Induk" value="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->Siswa_Nomor_Induk->OldValue) ?>">
<?php } ?>
<?php if ($t09_siswanonrutinbayar->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t09_siswanonrutinbayar_list->RowCnt ?>_t09_siswanonrutinbayar_Siswa_Nomor_Induk" class="form-group t09_siswanonrutinbayar_Siswa_Nomor_Induk">
<input type="text" data-table="t09_siswanonrutinbayar" data-field="x_Siswa_Nomor_Induk" name="x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_Siswa_Nomor_Induk" id="x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_Siswa_Nomor_Induk" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->Siswa_Nomor_Induk->getPlaceHolder()) ?>" value="<?php echo $t09_siswanonrutinbayar->Siswa_Nomor_Induk->EditValue ?>"<?php echo $t09_siswanonrutinbayar->Siswa_Nomor_Induk->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t09_siswanonrutinbayar->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t09_siswanonrutinbayar_list->RowCnt ?>_t09_siswanonrutinbayar_Siswa_Nomor_Induk" class="t09_siswanonrutinbayar_Siswa_Nomor_Induk">
<span<?php echo $t09_siswanonrutinbayar->Siswa_Nomor_Induk->ViewAttributes() ?>>
<?php echo $t09_siswanonrutinbayar->Siswa_Nomor_Induk->ListViewValue() ?></span>
</span>
<?php } ?>
<a id="<?php echo $t09_siswanonrutinbayar_list->PageObjName . "_row_" . $t09_siswanonrutinbayar_list->RowCnt ?>"></a></td>
	<?php } ?>
<?php if ($t09_siswanonrutinbayar->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="t09_siswanonrutinbayar" data-field="x_id" name="x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_id" id="x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->id->CurrentValue) ?>">
<input type="hidden" data-table="t09_siswanonrutinbayar" data-field="x_id" name="o<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_id" id="o<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->id->OldValue) ?>">
<?php } ?>
<?php if ($t09_siswanonrutinbayar->RowType == EW_ROWTYPE_EDIT || $t09_siswanonrutinbayar->CurrentMode == "edit") { ?>
<input type="hidden" data-table="t09_siswanonrutinbayar" data-field="x_id" name="x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_id" id="x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($t09_siswanonrutinbayar->Siswa_Nama->Visible) { // Siswa_Nama ?>
		<td data-name="Siswa_Nama"<?php echo $t09_siswanonrutinbayar->Siswa_Nama->CellAttributes() ?>>
<?php if ($t09_siswanonrutinbayar->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t09_siswanonrutinbayar_list->RowCnt ?>_t09_siswanonrutinbayar_Siswa_Nama" class="form-group t09_siswanonrutinbayar_Siswa_Nama">
<input type="text" data-table="t09_siswanonrutinbayar" data-field="x_Siswa_Nama" name="x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_Siswa_Nama" id="x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_Siswa_Nama" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->Siswa_Nama->getPlaceHolder()) ?>" value="<?php echo $t09_siswanonrutinbayar->Siswa_Nama->EditValue ?>"<?php echo $t09_siswanonrutinbayar->Siswa_Nama->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t09_siswanonrutinbayar" data-field="x_Siswa_Nama" name="o<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_Siswa_Nama" id="o<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_Siswa_Nama" value="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->Siswa_Nama->OldValue) ?>">
<?php } ?>
<?php if ($t09_siswanonrutinbayar->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t09_siswanonrutinbayar_list->RowCnt ?>_t09_siswanonrutinbayar_Siswa_Nama" class="form-group t09_siswanonrutinbayar_Siswa_Nama">
<input type="text" data-table="t09_siswanonrutinbayar" data-field="x_Siswa_Nama" name="x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_Siswa_Nama" id="x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_Siswa_Nama" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->Siswa_Nama->getPlaceHolder()) ?>" value="<?php echo $t09_siswanonrutinbayar->Siswa_Nama->EditValue ?>"<?php echo $t09_siswanonrutinbayar->Siswa_Nama->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t09_siswanonrutinbayar->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t09_siswanonrutinbayar_list->RowCnt ?>_t09_siswanonrutinbayar_Siswa_Nama" class="t09_siswanonrutinbayar_Siswa_Nama">
<span<?php echo $t09_siswanonrutinbayar->Siswa_Nama->ViewAttributes() ?>>
<?php echo $t09_siswanonrutinbayar->Siswa_Nama->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t09_siswanonrutinbayar->nonrutin_id->Visible) { // nonrutin_id ?>
		<td data-name="nonrutin_id"<?php echo $t09_siswanonrutinbayar->nonrutin_id->CellAttributes() ?>>
<?php if ($t09_siswanonrutinbayar->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t09_siswanonrutinbayar_list->RowCnt ?>_t09_siswanonrutinbayar_nonrutin_id" class="form-group t09_siswanonrutinbayar_nonrutin_id">
<?php
$wrkonchange = trim(" " . @$t09_siswanonrutinbayar->nonrutin_id->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$t09_siswanonrutinbayar->nonrutin_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_nonrutin_id" style="white-space: nowrap; z-index: <?php echo (9000 - $t09_siswanonrutinbayar_list->RowCnt * 10) ?>">
	<input type="text" name="sv_x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_nonrutin_id" id="sv_x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_nonrutin_id" value="<?php echo $t09_siswanonrutinbayar->nonrutin_id->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->nonrutin_id->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->nonrutin_id->getPlaceHolder()) ?>"<?php echo $t09_siswanonrutinbayar->nonrutin_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t09_siswanonrutinbayar" data-field="x_nonrutin_id" data-value-separator="<?php echo $t09_siswanonrutinbayar->nonrutin_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_nonrutin_id" id="x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_nonrutin_id" value="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->nonrutin_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<input type="hidden" name="q_x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_nonrutin_id" id="q_x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_nonrutin_id" value="<?php echo $t09_siswanonrutinbayar->nonrutin_id->LookupFilterQuery(true) ?>">
<script type="text/javascript">
ft09_siswanonrutinbayarlist.CreateAutoSuggest({"id":"x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_nonrutin_id","forceSelect":false});
</script>
</span>
<input type="hidden" data-table="t09_siswanonrutinbayar" data-field="x_nonrutin_id" name="o<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_nonrutin_id" id="o<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_nonrutin_id" value="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->nonrutin_id->OldValue) ?>">
<?php } ?>
<?php if ($t09_siswanonrutinbayar->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t09_siswanonrutinbayar_list->RowCnt ?>_t09_siswanonrutinbayar_nonrutin_id" class="form-group t09_siswanonrutinbayar_nonrutin_id">
<?php
$wrkonchange = trim(" " . @$t09_siswanonrutinbayar->nonrutin_id->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$t09_siswanonrutinbayar->nonrutin_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_nonrutin_id" style="white-space: nowrap; z-index: <?php echo (9000 - $t09_siswanonrutinbayar_list->RowCnt * 10) ?>">
	<input type="text" name="sv_x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_nonrutin_id" id="sv_x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_nonrutin_id" value="<?php echo $t09_siswanonrutinbayar->nonrutin_id->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->nonrutin_id->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->nonrutin_id->getPlaceHolder()) ?>"<?php echo $t09_siswanonrutinbayar->nonrutin_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t09_siswanonrutinbayar" data-field="x_nonrutin_id" data-value-separator="<?php echo $t09_siswanonrutinbayar->nonrutin_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_nonrutin_id" id="x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_nonrutin_id" value="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->nonrutin_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<input type="hidden" name="q_x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_nonrutin_id" id="q_x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_nonrutin_id" value="<?php echo $t09_siswanonrutinbayar->nonrutin_id->LookupFilterQuery(true) ?>">
<script type="text/javascript">
ft09_siswanonrutinbayarlist.CreateAutoSuggest({"id":"x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_nonrutin_id","forceSelect":false});
</script>
</span>
<?php } ?>
<?php if ($t09_siswanonrutinbayar->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t09_siswanonrutinbayar_list->RowCnt ?>_t09_siswanonrutinbayar_nonrutin_id" class="t09_siswanonrutinbayar_nonrutin_id">
<span<?php echo $t09_siswanonrutinbayar->nonrutin_id->ViewAttributes() ?>>
<?php echo $t09_siswanonrutinbayar->nonrutin_id->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t09_siswanonrutinbayar->Bayar_Tgl->Visible) { // Bayar_Tgl ?>
		<td data-name="Bayar_Tgl"<?php echo $t09_siswanonrutinbayar->Bayar_Tgl->CellAttributes() ?>>
<?php if ($t09_siswanonrutinbayar->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t09_siswanonrutinbayar_list->RowCnt ?>_t09_siswanonrutinbayar_Bayar_Tgl" class="form-group t09_siswanonrutinbayar_Bayar_Tgl">
<input type="text" data-table="t09_siswanonrutinbayar" data-field="x_Bayar_Tgl" data-format="5" name="x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_Bayar_Tgl" id="x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_Bayar_Tgl" placeholder="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->Bayar_Tgl->getPlaceHolder()) ?>" value="<?php echo $t09_siswanonrutinbayar->Bayar_Tgl->EditValue ?>"<?php echo $t09_siswanonrutinbayar->Bayar_Tgl->EditAttributes() ?>>
<?php if (!$t09_siswanonrutinbayar->Bayar_Tgl->ReadOnly && !$t09_siswanonrutinbayar->Bayar_Tgl->Disabled && !isset($t09_siswanonrutinbayar->Bayar_Tgl->EditAttrs["readonly"]) && !isset($t09_siswanonrutinbayar->Bayar_Tgl->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateCalendar("ft09_siswanonrutinbayarlist", "x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_Bayar_Tgl", 5);
</script>
<?php } ?>
</span>
<input type="hidden" data-table="t09_siswanonrutinbayar" data-field="x_Bayar_Tgl" name="o<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_Bayar_Tgl" id="o<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_Bayar_Tgl" value="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->Bayar_Tgl->OldValue) ?>">
<?php } ?>
<?php if ($t09_siswanonrutinbayar->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t09_siswanonrutinbayar_list->RowCnt ?>_t09_siswanonrutinbayar_Bayar_Tgl" class="form-group t09_siswanonrutinbayar_Bayar_Tgl">
<input type="text" data-table="t09_siswanonrutinbayar" data-field="x_Bayar_Tgl" data-format="5" name="x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_Bayar_Tgl" id="x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_Bayar_Tgl" placeholder="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->Bayar_Tgl->getPlaceHolder()) ?>" value="<?php echo $t09_siswanonrutinbayar->Bayar_Tgl->EditValue ?>"<?php echo $t09_siswanonrutinbayar->Bayar_Tgl->EditAttributes() ?>>
<?php if (!$t09_siswanonrutinbayar->Bayar_Tgl->ReadOnly && !$t09_siswanonrutinbayar->Bayar_Tgl->Disabled && !isset($t09_siswanonrutinbayar->Bayar_Tgl->EditAttrs["readonly"]) && !isset($t09_siswanonrutinbayar->Bayar_Tgl->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateCalendar("ft09_siswanonrutinbayarlist", "x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_Bayar_Tgl", 5);
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($t09_siswanonrutinbayar->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t09_siswanonrutinbayar_list->RowCnt ?>_t09_siswanonrutinbayar_Bayar_Tgl" class="t09_siswanonrutinbayar_Bayar_Tgl">
<span<?php echo $t09_siswanonrutinbayar->Bayar_Tgl->ViewAttributes() ?>>
<?php echo $t09_siswanonrutinbayar->Bayar_Tgl->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t09_siswanonrutinbayar->Bayar_Jumlah->Visible) { // Bayar_Jumlah ?>
		<td data-name="Bayar_Jumlah"<?php echo $t09_siswanonrutinbayar->Bayar_Jumlah->CellAttributes() ?>>
<?php if ($t09_siswanonrutinbayar->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t09_siswanonrutinbayar_list->RowCnt ?>_t09_siswanonrutinbayar_Bayar_Jumlah" class="form-group t09_siswanonrutinbayar_Bayar_Jumlah">
<input type="text" data-table="t09_siswanonrutinbayar" data-field="x_Bayar_Jumlah" name="x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_Bayar_Jumlah" id="x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_Bayar_Jumlah" size="30" placeholder="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->Bayar_Jumlah->getPlaceHolder()) ?>" value="<?php echo $t09_siswanonrutinbayar->Bayar_Jumlah->EditValue ?>"<?php echo $t09_siswanonrutinbayar->Bayar_Jumlah->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t09_siswanonrutinbayar" data-field="x_Bayar_Jumlah" name="o<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_Bayar_Jumlah" id="o<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_Bayar_Jumlah" value="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->Bayar_Jumlah->OldValue) ?>">
<?php } ?>
<?php if ($t09_siswanonrutinbayar->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t09_siswanonrutinbayar_list->RowCnt ?>_t09_siswanonrutinbayar_Bayar_Jumlah" class="form-group t09_siswanonrutinbayar_Bayar_Jumlah">
<input type="text" data-table="t09_siswanonrutinbayar" data-field="x_Bayar_Jumlah" name="x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_Bayar_Jumlah" id="x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_Bayar_Jumlah" size="30" placeholder="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->Bayar_Jumlah->getPlaceHolder()) ?>" value="<?php echo $t09_siswanonrutinbayar->Bayar_Jumlah->EditValue ?>"<?php echo $t09_siswanonrutinbayar->Bayar_Jumlah->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t09_siswanonrutinbayar->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t09_siswanonrutinbayar_list->RowCnt ?>_t09_siswanonrutinbayar_Bayar_Jumlah" class="t09_siswanonrutinbayar_Bayar_Jumlah">
<span<?php echo $t09_siswanonrutinbayar->Bayar_Jumlah->ViewAttributes() ?>>
<?php echo $t09_siswanonrutinbayar->Bayar_Jumlah->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t09_siswanonrutinbayar_list->ListOptions->Render("body", "right", $t09_siswanonrutinbayar_list->RowCnt);
?>
	</tr>
<?php if ($t09_siswanonrutinbayar->RowType == EW_ROWTYPE_ADD || $t09_siswanonrutinbayar->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
ft09_siswanonrutinbayarlist.UpdateOpts(<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($t09_siswanonrutinbayar->CurrentAction <> "gridadd")
		if (!$t09_siswanonrutinbayar_list->Recordset->EOF) $t09_siswanonrutinbayar_list->Recordset->MoveNext();
}
?>
<?php
	if ($t09_siswanonrutinbayar->CurrentAction == "gridadd" || $t09_siswanonrutinbayar->CurrentAction == "gridedit") {
		$t09_siswanonrutinbayar_list->RowIndex = '$rowindex$';
		$t09_siswanonrutinbayar_list->LoadDefaultValues();

		// Set row properties
		$t09_siswanonrutinbayar->ResetAttrs();
		$t09_siswanonrutinbayar->RowAttrs = array_merge($t09_siswanonrutinbayar->RowAttrs, array('data-rowindex'=>$t09_siswanonrutinbayar_list->RowIndex, 'id'=>'r0_t09_siswanonrutinbayar', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($t09_siswanonrutinbayar->RowAttrs["class"], "ewTemplate");
		$t09_siswanonrutinbayar->RowType = EW_ROWTYPE_ADD;

		// Render row
		$t09_siswanonrutinbayar_list->RenderRow();

		// Render list options
		$t09_siswanonrutinbayar_list->RenderListOptions();
		$t09_siswanonrutinbayar_list->StartRowCnt = 0;
?>
	<tr<?php echo $t09_siswanonrutinbayar->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t09_siswanonrutinbayar_list->ListOptions->Render("body", "left", $t09_siswanonrutinbayar_list->RowIndex);
?>
	<?php if ($t09_siswanonrutinbayar->Siswa_Nomor_Induk->Visible) { // Siswa_Nomor_Induk ?>
		<td data-name="Siswa_Nomor_Induk">
<span id="el$rowindex$_t09_siswanonrutinbayar_Siswa_Nomor_Induk" class="form-group t09_siswanonrutinbayar_Siswa_Nomor_Induk">
<input type="text" data-table="t09_siswanonrutinbayar" data-field="x_Siswa_Nomor_Induk" name="x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_Siswa_Nomor_Induk" id="x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_Siswa_Nomor_Induk" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->Siswa_Nomor_Induk->getPlaceHolder()) ?>" value="<?php echo $t09_siswanonrutinbayar->Siswa_Nomor_Induk->EditValue ?>"<?php echo $t09_siswanonrutinbayar->Siswa_Nomor_Induk->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t09_siswanonrutinbayar" data-field="x_Siswa_Nomor_Induk" name="o<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_Siswa_Nomor_Induk" id="o<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_Siswa_Nomor_Induk" value="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->Siswa_Nomor_Induk->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t09_siswanonrutinbayar->Siswa_Nama->Visible) { // Siswa_Nama ?>
		<td data-name="Siswa_Nama">
<span id="el$rowindex$_t09_siswanonrutinbayar_Siswa_Nama" class="form-group t09_siswanonrutinbayar_Siswa_Nama">
<input type="text" data-table="t09_siswanonrutinbayar" data-field="x_Siswa_Nama" name="x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_Siswa_Nama" id="x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_Siswa_Nama" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->Siswa_Nama->getPlaceHolder()) ?>" value="<?php echo $t09_siswanonrutinbayar->Siswa_Nama->EditValue ?>"<?php echo $t09_siswanonrutinbayar->Siswa_Nama->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t09_siswanonrutinbayar" data-field="x_Siswa_Nama" name="o<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_Siswa_Nama" id="o<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_Siswa_Nama" value="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->Siswa_Nama->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t09_siswanonrutinbayar->nonrutin_id->Visible) { // nonrutin_id ?>
		<td data-name="nonrutin_id">
<span id="el$rowindex$_t09_siswanonrutinbayar_nonrutin_id" class="form-group t09_siswanonrutinbayar_nonrutin_id">
<?php
$wrkonchange = trim(" " . @$t09_siswanonrutinbayar->nonrutin_id->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$t09_siswanonrutinbayar->nonrutin_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_nonrutin_id" style="white-space: nowrap; z-index: <?php echo (9000 - $t09_siswanonrutinbayar_list->RowCnt * 10) ?>">
	<input type="text" name="sv_x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_nonrutin_id" id="sv_x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_nonrutin_id" value="<?php echo $t09_siswanonrutinbayar->nonrutin_id->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->nonrutin_id->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->nonrutin_id->getPlaceHolder()) ?>"<?php echo $t09_siswanonrutinbayar->nonrutin_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t09_siswanonrutinbayar" data-field="x_nonrutin_id" data-value-separator="<?php echo $t09_siswanonrutinbayar->nonrutin_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_nonrutin_id" id="x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_nonrutin_id" value="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->nonrutin_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<input type="hidden" name="q_x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_nonrutin_id" id="q_x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_nonrutin_id" value="<?php echo $t09_siswanonrutinbayar->nonrutin_id->LookupFilterQuery(true) ?>">
<script type="text/javascript">
ft09_siswanonrutinbayarlist.CreateAutoSuggest({"id":"x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_nonrutin_id","forceSelect":false});
</script>
</span>
<input type="hidden" data-table="t09_siswanonrutinbayar" data-field="x_nonrutin_id" name="o<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_nonrutin_id" id="o<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_nonrutin_id" value="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->nonrutin_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t09_siswanonrutinbayar->Bayar_Tgl->Visible) { // Bayar_Tgl ?>
		<td data-name="Bayar_Tgl">
<span id="el$rowindex$_t09_siswanonrutinbayar_Bayar_Tgl" class="form-group t09_siswanonrutinbayar_Bayar_Tgl">
<input type="text" data-table="t09_siswanonrutinbayar" data-field="x_Bayar_Tgl" data-format="5" name="x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_Bayar_Tgl" id="x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_Bayar_Tgl" placeholder="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->Bayar_Tgl->getPlaceHolder()) ?>" value="<?php echo $t09_siswanonrutinbayar->Bayar_Tgl->EditValue ?>"<?php echo $t09_siswanonrutinbayar->Bayar_Tgl->EditAttributes() ?>>
<?php if (!$t09_siswanonrutinbayar->Bayar_Tgl->ReadOnly && !$t09_siswanonrutinbayar->Bayar_Tgl->Disabled && !isset($t09_siswanonrutinbayar->Bayar_Tgl->EditAttrs["readonly"]) && !isset($t09_siswanonrutinbayar->Bayar_Tgl->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateCalendar("ft09_siswanonrutinbayarlist", "x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_Bayar_Tgl", 5);
</script>
<?php } ?>
</span>
<input type="hidden" data-table="t09_siswanonrutinbayar" data-field="x_Bayar_Tgl" name="o<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_Bayar_Tgl" id="o<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_Bayar_Tgl" value="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->Bayar_Tgl->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t09_siswanonrutinbayar->Bayar_Jumlah->Visible) { // Bayar_Jumlah ?>
		<td data-name="Bayar_Jumlah">
<span id="el$rowindex$_t09_siswanonrutinbayar_Bayar_Jumlah" class="form-group t09_siswanonrutinbayar_Bayar_Jumlah">
<input type="text" data-table="t09_siswanonrutinbayar" data-field="x_Bayar_Jumlah" name="x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_Bayar_Jumlah" id="x<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_Bayar_Jumlah" size="30" placeholder="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->Bayar_Jumlah->getPlaceHolder()) ?>" value="<?php echo $t09_siswanonrutinbayar->Bayar_Jumlah->EditValue ?>"<?php echo $t09_siswanonrutinbayar->Bayar_Jumlah->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t09_siswanonrutinbayar" data-field="x_Bayar_Jumlah" name="o<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_Bayar_Jumlah" id="o<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>_Bayar_Jumlah" value="<?php echo ew_HtmlEncode($t09_siswanonrutinbayar->Bayar_Jumlah->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t09_siswanonrutinbayar_list->ListOptions->Render("body", "right", $t09_siswanonrutinbayar_list->RowCnt);
?>
<script type="text/javascript">
ft09_siswanonrutinbayarlist.UpdateOpts(<?php echo $t09_siswanonrutinbayar_list->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($t09_siswanonrutinbayar->CurrentAction == "add" || $t09_siswanonrutinbayar->CurrentAction == "copy") { ?>
<input type="hidden" name="<?php echo $t09_siswanonrutinbayar_list->FormKeyCountName ?>" id="<?php echo $t09_siswanonrutinbayar_list->FormKeyCountName ?>" value="<?php echo $t09_siswanonrutinbayar_list->KeyCount ?>">
<?php } ?>
<?php if ($t09_siswanonrutinbayar->CurrentAction == "edit") { ?>
<input type="hidden" name="<?php echo $t09_siswanonrutinbayar_list->FormKeyCountName ?>" id="<?php echo $t09_siswanonrutinbayar_list->FormKeyCountName ?>" value="<?php echo $t09_siswanonrutinbayar_list->KeyCount ?>">
<?php } ?>
<?php if ($t09_siswanonrutinbayar->CurrentAction == "gridedit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $t09_siswanonrutinbayar_list->FormKeyCountName ?>" id="<?php echo $t09_siswanonrutinbayar_list->FormKeyCountName ?>" value="<?php echo $t09_siswanonrutinbayar_list->KeyCount ?>">
<?php echo $t09_siswanonrutinbayar_list->MultiSelectKey ?>
<?php } ?>
<?php if ($t09_siswanonrutinbayar->CurrentAction == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($t09_siswanonrutinbayar_list->Recordset)
	$t09_siswanonrutinbayar_list->Recordset->Close();
?>
</div>
<?php } ?>
<?php if ($t09_siswanonrutinbayar_list->TotalRecs == 0 && $t09_siswanonrutinbayar->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t09_siswanonrutinbayar_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<script type="text/javascript">
ft09_siswanonrutinbayarlist.Init();
</script>
<?php
$t09_siswanonrutinbayar_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$t09_siswanonrutinbayar_list->Page_Terminate();
?>
