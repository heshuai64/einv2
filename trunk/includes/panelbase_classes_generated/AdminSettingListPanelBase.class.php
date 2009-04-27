<?php
	/**
	 * This is the abstract Panel class for the List All functionality
	 * of the AdminSetting class.  This code-generated class
	 * contains a datagrid to display an HTML page that can
	 * list a collection of AdminSetting objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new QPanel which extends this AdminSettingListPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class AdminSettingListPanelBase extends QPanel {
		public $dtgAdminSetting;
		public $btnCreateNew;

		// Callback Method Names
		protected $strSetEditPanelMethod;
		protected $strCloseEditPanelMethod;
		
		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colSettingId;
		protected $colShortDescription;
		protected $colValue;

		public function __construct($objParentObject, $strSetEditPanelMethod, $strCloseEditPanelMethod, $strControlId = null) {
			// Call the Parent
			try {
				parent::__construct($objParentObject, $strControlId);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Record Method Callbacks
			$this->strSetEditPanelMethod = $strSetEditPanelMethod;
			$this->strCloseEditPanelMethod = $strCloseEditPanelMethod;

			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgAdminSetting_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colSettingId = new QDataGridColumn(QApplication::Translate('Setting Id'), '<?= $_ITEM->SettingId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::AdminSetting()->SettingId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::AdminSetting()->SettingId, false)));
			$this->colShortDescription = new QDataGridColumn(QApplication::Translate('Short Description'), '<?= QString::Truncate($_ITEM->ShortDescription, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::AdminSetting()->ShortDescription), 'ReverseOrderByClause' => QQ::OrderBy(QQN::AdminSetting()->ShortDescription, false)));
			$this->colValue = new QDataGridColumn(QApplication::Translate('Value'), '<?= QString::Truncate($_ITEM->Value, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::AdminSetting()->Value), 'ReverseOrderByClause' => QQ::OrderBy(QQN::AdminSetting()->Value, false)));

			// Setup DataGrid
			$this->dtgAdminSetting = new QDataGrid($this);
			$this->dtgAdminSetting->CellSpacing = 0;
			$this->dtgAdminSetting->CellPadding = 4;
			$this->dtgAdminSetting->BorderStyle = QBorderStyle::Solid;
			$this->dtgAdminSetting->BorderWidth = 1;
			$this->dtgAdminSetting->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgAdminSetting->Paginator = new QPaginator($this->dtgAdminSetting);
			$this->dtgAdminSetting->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgAdminSetting->UseAjax = true;

			// Specify the local databind method this datagrid will use
			$this->dtgAdminSetting->SetDataBinder('dtgAdminSetting_Bind', $this);

			$this->dtgAdminSetting->AddColumn($this->colEditLinkColumn);
			$this->dtgAdminSetting->AddColumn($this->colSettingId);
			$this->dtgAdminSetting->AddColumn($this->colShortDescription);
			$this->dtgAdminSetting->AddColumn($this->colValue);

			// Setup the Create New button
			$this->btnCreateNew = new QButton($this);
			$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('AdminSetting');
			$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
		}

		public function dtgAdminSetting_EditLinkColumn_Render(AdminSetting $objAdminSetting) {
			$strControlId = 'btnEdit' . $this->dtgAdminSetting->CurrentRowIndex;

			$btnEdit = $this->objForm->GetControl($strControlId);
			if (!$btnEdit) {
				$btnEdit = new QButton($this->dtgAdminSetting, $strControlId);
				$btnEdit->Text = QApplication::Translate('Edit');
				$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
			}

			$btnEdit->ActionParameter = $objAdminSetting->SettingId;
			return $btnEdit->Render(false);
		}

		public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
			$strParameterArray = explode(',', $strParameter);
			$objAdminSetting = AdminSetting::Load($strParameterArray[0]);

			$objEditPanel = new AdminSettingEditPanel($this, $this->strCloseEditPanelMethod, $objAdminSetting);
			
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
			$objEditPanel = new AdminSettingEditPanel($this, $this->strCloseEditPanelMethod, null);
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}


		public function dtgAdminSetting_Bind() {
			// Get Total Count b/c of Pagination
			$this->dtgAdminSetting->TotalItemCount = AdminSetting::CountAll();

			$objClauses = array();
			if ($objClause = $this->dtgAdminSetting->OrderByClause)
				array_push($objClauses, $objClause);
			if ($objClause = $this->dtgAdminSetting->LimitClause)
				array_push($objClauses, $objClause);
			$this->dtgAdminSetting->DataSource = AdminSetting::LoadAll($objClauses);
		}
	}
?>