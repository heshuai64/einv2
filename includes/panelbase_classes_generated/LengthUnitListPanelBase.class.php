<?php
	/**
	 * This is the abstract Panel class for the List All functionality
	 * of the LengthUnit class.  This code-generated class
	 * contains a datagrid to display an HTML page that can
	 * list a collection of LengthUnit objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new QPanel which extends this LengthUnitListPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class LengthUnitListPanelBase extends QPanel {
		public $dtgLengthUnit;
		public $btnCreateNew;

		// Callback Method Names
		protected $strSetEditPanelMethod;
		protected $strCloseEditPanelMethod;
		
		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colLengthUnitId;
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
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgLengthUnit_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colLengthUnitId = new QDataGridColumn(QApplication::Translate('Length Unit Id'), '<?= $_ITEM->LengthUnitId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::LengthUnit()->LengthUnitId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::LengthUnit()->LengthUnitId, false)));
			$this->colShortDescription = new QDataGridColumn(QApplication::Translate('Short Description'), '<?= QString::Truncate($_ITEM->ShortDescription, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::LengthUnit()->ShortDescription), 'ReverseOrderByClause' => QQ::OrderBy(QQN::LengthUnit()->ShortDescription, false)));

			// Setup DataGrid
			$this->dtgLengthUnit = new QDataGrid($this);
			$this->dtgLengthUnit->CellSpacing = 0;
			$this->dtgLengthUnit->CellPadding = 4;
			$this->dtgLengthUnit->BorderStyle = QBorderStyle::Solid;
			$this->dtgLengthUnit->BorderWidth = 1;
			$this->dtgLengthUnit->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgLengthUnit->Paginator = new QPaginator($this->dtgLengthUnit);
			$this->dtgLengthUnit->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgLengthUnit->UseAjax = true;

			// Specify the local databind method this datagrid will use
			$this->dtgLengthUnit->SetDataBinder('dtgLengthUnit_Bind', $this);

			$this->dtgLengthUnit->AddColumn($this->colEditLinkColumn);
			$this->dtgLengthUnit->AddColumn($this->colLengthUnitId);
			$this->dtgLengthUnit->AddColumn($this->colShortDescription);

			// Setup the Create New button
			$this->btnCreateNew = new QButton($this);
			$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('LengthUnit');
			$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
		}

		public function dtgLengthUnit_EditLinkColumn_Render(LengthUnit $objLengthUnit) {
			$strControlId = 'btnEdit' . $this->dtgLengthUnit->CurrentRowIndex;

			$btnEdit = $this->objForm->GetControl($strControlId);
			if (!$btnEdit) {
				$btnEdit = new QButton($this->dtgLengthUnit, $strControlId);
				$btnEdit->Text = QApplication::Translate('Edit');
				$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
			}

			$btnEdit->ActionParameter = $objLengthUnit->LengthUnitId;
			return $btnEdit->Render(false);
		}

		public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
			$strParameterArray = explode(',', $strParameter);
			$objLengthUnit = LengthUnit::Load($strParameterArray[0]);

			$objEditPanel = new LengthUnitEditPanel($this, $this->strCloseEditPanelMethod, $objLengthUnit);
			
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
			$objEditPanel = new LengthUnitEditPanel($this, $this->strCloseEditPanelMethod, null);
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}


		public function dtgLengthUnit_Bind() {
			// Get Total Count b/c of Pagination
			$this->dtgLengthUnit->TotalItemCount = LengthUnit::CountAll();

			$objClauses = array();
			if ($objClause = $this->dtgLengthUnit->OrderByClause)
				array_push($objClauses, $objClause);
			if ($objClause = $this->dtgLengthUnit->LimitClause)
				array_push($objClauses, $objClause);
			$this->dtgLengthUnit->DataSource = LengthUnit::LoadAll($objClauses);
		}
	}
?>