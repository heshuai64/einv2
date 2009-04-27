<?php
	/**
	 * This is the abstract Panel class for the List All functionality
	 * of the Module class.  This code-generated class
	 * contains a datagrid to display an HTML page that can
	 * list a collection of Module objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new QPanel which extends this ModuleListPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class ModuleListPanelBase extends QPanel {
		public $dtgModule;
		public $btnCreateNew;

		// Callback Method Names
		protected $strSetEditPanelMethod;
		protected $strCloseEditPanelMethod;
		
		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colModuleId;
		protected $colShortDescription;

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
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgModule_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colModuleId = new QDataGridColumn(QApplication::Translate('Module Id'), '<?= $_ITEM->ModuleId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Module()->ModuleId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Module()->ModuleId, false)));
			$this->colShortDescription = new QDataGridColumn(QApplication::Translate('Short Description'), '<?= QString::Truncate($_ITEM->ShortDescription, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Module()->ShortDescription), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Module()->ShortDescription, false)));

			// Setup DataGrid
			$this->dtgModule = new QDataGrid($this);
			$this->dtgModule->CellSpacing = 0;
			$this->dtgModule->CellPadding = 4;
			$this->dtgModule->BorderStyle = QBorderStyle::Solid;
			$this->dtgModule->BorderWidth = 1;
			$this->dtgModule->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgModule->Paginator = new QPaginator($this->dtgModule);
			$this->dtgModule->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgModule->UseAjax = true;

			// Specify the local databind method this datagrid will use
			$this->dtgModule->SetDataBinder('dtgModule_Bind', $this);

			$this->dtgModule->AddColumn($this->colEditLinkColumn);
			$this->dtgModule->AddColumn($this->colModuleId);
			$this->dtgModule->AddColumn($this->colShortDescription);

			// Setup the Create New button
			$this->btnCreateNew = new QButton($this);
			$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('Module');
			$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
		}

		public function dtgModule_EditLinkColumn_Render(Module $objModule) {
			$strControlId = 'btnEdit' . $this->dtgModule->CurrentRowIndex;

			$btnEdit = $this->objForm->GetControl($strControlId);
			if (!$btnEdit) {
				$btnEdit = new QButton($this->dtgModule, $strControlId);
				$btnEdit->Text = QApplication::Translate('Edit');
				$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
			}

			$btnEdit->ActionParameter = $objModule->ModuleId;
			return $btnEdit->Render(false);
		}

		public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
			$strParameterArray = explode(',', $strParameter);
			$objModule = Module::Load($strParameterArray[0]);

			$objEditPanel = new ModuleEditPanel($this, $this->strCloseEditPanelMethod, $objModule);
			
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
			$objEditPanel = new ModuleEditPanel($this, $this->strCloseEditPanelMethod, null);
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}


		public function dtgModule_Bind() {
			// Get Total Count b/c of Pagination
			$this->dtgModule->TotalItemCount = Module::CountAll();

			$objClauses = array();
			if ($objClause = $this->dtgModule->OrderByClause)
				array_push($objClauses, $objClause);
			if ($objClause = $this->dtgModule->LimitClause)
				array_push($objClauses, $objClause);
			$this->dtgModule->DataSource = Module::LoadAll($objClauses);
		}
	}
?>