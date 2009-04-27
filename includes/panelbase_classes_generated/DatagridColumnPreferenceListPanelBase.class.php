<?php
	/**
	 * This is the abstract Panel class for the List All functionality
	 * of the DatagridColumnPreference class.  This code-generated class
	 * contains a datagrid to display an HTML page that can
	 * list a collection of DatagridColumnPreference objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new QPanel which extends this DatagridColumnPreferenceListPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class DatagridColumnPreferenceListPanelBase extends QPanel {
		public $dtgDatagridColumnPreference;
		public $btnCreateNew;

		// Callback Method Names
		protected $strSetEditPanelMethod;
		protected $strCloseEditPanelMethod;
		
		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colDatagridColumnPreferenceId;
		protected $colDatagridId;
		protected $colColumnName;
		protected $colUserAccountId;
		protected $colDisplayFlag;

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
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgDatagridColumnPreference_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colDatagridColumnPreferenceId = new QDataGridColumn(QApplication::Translate('Datagrid Column Preference Id'), '<?= $_ITEM->DatagridColumnPreferenceId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::DatagridColumnPreference()->DatagridColumnPreferenceId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::DatagridColumnPreference()->DatagridColumnPreferenceId, false)));
			$this->colDatagridId = new QDataGridColumn(QApplication::Translate('Datagrid Id'), '<?= $_CONTROL->ParentControl->dtgDatagridColumnPreference_Datagrid_Render($_ITEM); ?>');
			$this->colColumnName = new QDataGridColumn(QApplication::Translate('Column Name'), '<?= QString::Truncate($_ITEM->ColumnName, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::DatagridColumnPreference()->ColumnName), 'ReverseOrderByClause' => QQ::OrderBy(QQN::DatagridColumnPreference()->ColumnName, false)));
			$this->colUserAccountId = new QDataGridColumn(QApplication::Translate('User Account Id'), '<?= $_CONTROL->ParentControl->dtgDatagridColumnPreference_UserAccount_Render($_ITEM); ?>');
			$this->colDisplayFlag = new QDataGridColumn(QApplication::Translate('Display Flag'), '<?= ($_ITEM->DisplayFlag) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::DatagridColumnPreference()->DisplayFlag), 'ReverseOrderByClause' => QQ::OrderBy(QQN::DatagridColumnPreference()->DisplayFlag, false)));

			// Setup DataGrid
			$this->dtgDatagridColumnPreference = new QDataGrid($this);
			$this->dtgDatagridColumnPreference->CellSpacing = 0;
			$this->dtgDatagridColumnPreference->CellPadding = 4;
			$this->dtgDatagridColumnPreference->BorderStyle = QBorderStyle::Solid;
			$this->dtgDatagridColumnPreference->BorderWidth = 1;
			$this->dtgDatagridColumnPreference->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgDatagridColumnPreference->Paginator = new QPaginator($this->dtgDatagridColumnPreference);
			$this->dtgDatagridColumnPreference->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgDatagridColumnPreference->UseAjax = true;

			// Specify the local databind method this datagrid will use
			$this->dtgDatagridColumnPreference->SetDataBinder('dtgDatagridColumnPreference_Bind', $this);

			$this->dtgDatagridColumnPreference->AddColumn($this->colEditLinkColumn);
			$this->dtgDatagridColumnPreference->AddColumn($this->colDatagridColumnPreferenceId);
			$this->dtgDatagridColumnPreference->AddColumn($this->colDatagridId);
			$this->dtgDatagridColumnPreference->AddColumn($this->colColumnName);
			$this->dtgDatagridColumnPreference->AddColumn($this->colUserAccountId);
			$this->dtgDatagridColumnPreference->AddColumn($this->colDisplayFlag);

			// Setup the Create New button
			$this->btnCreateNew = new QButton($this);
			$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('DatagridColumnPreference');
			$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
		}

		public function dtgDatagridColumnPreference_EditLinkColumn_Render(DatagridColumnPreference $objDatagridColumnPreference) {
			$strControlId = 'btnEdit' . $this->dtgDatagridColumnPreference->CurrentRowIndex;

			$btnEdit = $this->objForm->GetControl($strControlId);
			if (!$btnEdit) {
				$btnEdit = new QButton($this->dtgDatagridColumnPreference, $strControlId);
				$btnEdit->Text = QApplication::Translate('Edit');
				$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
			}

			$btnEdit->ActionParameter = $objDatagridColumnPreference->DatagridColumnPreferenceId;
			return $btnEdit->Render(false);
		}

		public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
			$strParameterArray = explode(',', $strParameter);
			$objDatagridColumnPreference = DatagridColumnPreference::Load($strParameterArray[0]);

			$objEditPanel = new DatagridColumnPreferenceEditPanel($this, $this->strCloseEditPanelMethod, $objDatagridColumnPreference);
			
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
			$objEditPanel = new DatagridColumnPreferenceEditPanel($this, $this->strCloseEditPanelMethod, null);
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function dtgDatagridColumnPreference_Datagrid_Render(DatagridColumnPreference $objDatagridColumnPreference) {
			if (!is_null($objDatagridColumnPreference->Datagrid))
				return $objDatagridColumnPreference->Datagrid->__toString();
			else
				return null;
		}

		public function dtgDatagridColumnPreference_UserAccount_Render(DatagridColumnPreference $objDatagridColumnPreference) {
			if (!is_null($objDatagridColumnPreference->UserAccount))
				return $objDatagridColumnPreference->UserAccount->__toString();
			else
				return null;
		}


		public function dtgDatagridColumnPreference_Bind() {
			// Get Total Count b/c of Pagination
			$this->dtgDatagridColumnPreference->TotalItemCount = DatagridColumnPreference::CountAll();

			$objClauses = array();
			if ($objClause = $this->dtgDatagridColumnPreference->OrderByClause)
				array_push($objClauses, $objClause);
			if ($objClause = $this->dtgDatagridColumnPreference->LimitClause)
				array_push($objClauses, $objClause);
			$this->dtgDatagridColumnPreference->DataSource = DatagridColumnPreference::LoadAll($objClauses);
		}
	}
?>