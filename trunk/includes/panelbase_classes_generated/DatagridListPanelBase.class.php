<?php
	/**
	 * This is the abstract Panel class for the List All functionality
	 * of the Datagrid class.  This code-generated class
	 * contains a datagrid to display an HTML page that can
	 * list a collection of Datagrid objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new QPanel which extends this DatagridListPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class DatagridListPanelBase extends QPanel {
		public $dtgDatagrid;
		public $btnCreateNew;

		// Callback Method Names
		protected $strSetEditPanelMethod;
		protected $strCloseEditPanelMethod;
		
		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colDatagridId;
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
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgDatagrid_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colDatagridId = new QDataGridColumn(QApplication::Translate('Datagrid Id'), '<?= $_ITEM->DatagridId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Datagrid()->DatagridId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Datagrid()->DatagridId, false)));
			$this->colShortDescription = new QDataGridColumn(QApplication::Translate('Short Description'), '<?= QString::Truncate($_ITEM->ShortDescription, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Datagrid()->ShortDescription), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Datagrid()->ShortDescription, false)));

			// Setup DataGrid
			$this->dtgDatagrid = new QDataGrid($this);
			$this->dtgDatagrid->CellSpacing = 0;
			$this->dtgDatagrid->CellPadding = 4;
			$this->dtgDatagrid->BorderStyle = QBorderStyle::Solid;
			$this->dtgDatagrid->BorderWidth = 1;
			$this->dtgDatagrid->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgDatagrid->Paginator = new QPaginator($this->dtgDatagrid);
			$this->dtgDatagrid->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgDatagrid->UseAjax = true;

			// Specify the local databind method this datagrid will use
			$this->dtgDatagrid->SetDataBinder('dtgDatagrid_Bind', $this);

			$this->dtgDatagrid->AddColumn($this->colEditLinkColumn);
			$this->dtgDatagrid->AddColumn($this->colDatagridId);
			$this->dtgDatagrid->AddColumn($this->colShortDescription);

			// Setup the Create New button
			$this->btnCreateNew = new QButton($this);
			$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('Datagrid');
			$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
		}

		public function dtgDatagrid_EditLinkColumn_Render(Datagrid $objDatagrid) {
			$strControlId = 'btnEdit' . $this->dtgDatagrid->CurrentRowIndex;

			$btnEdit = $this->objForm->GetControl($strControlId);
			if (!$btnEdit) {
				$btnEdit = new QButton($this->dtgDatagrid, $strControlId);
				$btnEdit->Text = QApplication::Translate('Edit');
				$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
			}

			$btnEdit->ActionParameter = $objDatagrid->DatagridId;
			return $btnEdit->Render(false);
		}

		public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
			$strParameterArray = explode(',', $strParameter);
			$objDatagrid = Datagrid::Load($strParameterArray[0]);

			$objEditPanel = new DatagridEditPanel($this, $this->strCloseEditPanelMethod, $objDatagrid);
			
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
			$objEditPanel = new DatagridEditPanel($this, $this->strCloseEditPanelMethod, null);
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}


		public function dtgDatagrid_Bind() {
			// Get Total Count b/c of Pagination
			$this->dtgDatagrid->TotalItemCount = Datagrid::CountAll();

			$objClauses = array();
			if ($objClause = $this->dtgDatagrid->OrderByClause)
				array_push($objClauses, $objClause);
			if ($objClause = $this->dtgDatagrid->LimitClause)
				array_push($objClauses, $objClause);
			$this->dtgDatagrid->DataSource = Datagrid::LoadAll($objClauses);
		}
	}
?>