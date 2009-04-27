<?php
	/**
	 * This is the abstract Panel class for the List All functionality
	 * of the WeightUnit class.  This code-generated class
	 * contains a datagrid to display an HTML page that can
	 * list a collection of WeightUnit objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new QPanel which extends this WeightUnitListPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class WeightUnitListPanelBase extends QPanel {
		public $dtgWeightUnit;
		public $btnCreateNew;

		// Callback Method Names
		protected $strSetEditPanelMethod;
		protected $strCloseEditPanelMethod;
		
		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colWeightUnitId;
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
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgWeightUnit_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colWeightUnitId = new QDataGridColumn(QApplication::Translate('Weight Unit Id'), '<?= $_ITEM->WeightUnitId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::WeightUnit()->WeightUnitId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::WeightUnit()->WeightUnitId, false)));
			$this->colShortDescription = new QDataGridColumn(QApplication::Translate('Short Description'), '<?= QString::Truncate($_ITEM->ShortDescription, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::WeightUnit()->ShortDescription), 'ReverseOrderByClause' => QQ::OrderBy(QQN::WeightUnit()->ShortDescription, false)));

			// Setup DataGrid
			$this->dtgWeightUnit = new QDataGrid($this);
			$this->dtgWeightUnit->CellSpacing = 0;
			$this->dtgWeightUnit->CellPadding = 4;
			$this->dtgWeightUnit->BorderStyle = QBorderStyle::Solid;
			$this->dtgWeightUnit->BorderWidth = 1;
			$this->dtgWeightUnit->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgWeightUnit->Paginator = new QPaginator($this->dtgWeightUnit);
			$this->dtgWeightUnit->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgWeightUnit->UseAjax = true;

			// Specify the local databind method this datagrid will use
			$this->dtgWeightUnit->SetDataBinder('dtgWeightUnit_Bind', $this);

			$this->dtgWeightUnit->AddColumn($this->colEditLinkColumn);
			$this->dtgWeightUnit->AddColumn($this->colWeightUnitId);
			$this->dtgWeightUnit->AddColumn($this->colShortDescription);

			// Setup the Create New button
			$this->btnCreateNew = new QButton($this);
			$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('WeightUnit');
			$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
		}

		public function dtgWeightUnit_EditLinkColumn_Render(WeightUnit $objWeightUnit) {
			$strControlId = 'btnEdit' . $this->dtgWeightUnit->CurrentRowIndex;

			$btnEdit = $this->objForm->GetControl($strControlId);
			if (!$btnEdit) {
				$btnEdit = new QButton($this->dtgWeightUnit, $strControlId);
				$btnEdit->Text = QApplication::Translate('Edit');
				$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
			}

			$btnEdit->ActionParameter = $objWeightUnit->WeightUnitId;
			return $btnEdit->Render(false);
		}

		public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
			$strParameterArray = explode(',', $strParameter);
			$objWeightUnit = WeightUnit::Load($strParameterArray[0]);

			$objEditPanel = new WeightUnitEditPanel($this, $this->strCloseEditPanelMethod, $objWeightUnit);
			
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
			$objEditPanel = new WeightUnitEditPanel($this, $this->strCloseEditPanelMethod, null);
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}


		public function dtgWeightUnit_Bind() {
			// Get Total Count b/c of Pagination
			$this->dtgWeightUnit->TotalItemCount = WeightUnit::CountAll();

			$objClauses = array();
			if ($objClause = $this->dtgWeightUnit->OrderByClause)
				array_push($objClauses, $objClause);
			if ($objClause = $this->dtgWeightUnit->LimitClause)
				array_push($objClauses, $objClause);
			$this->dtgWeightUnit->DataSource = WeightUnit::LoadAll($objClauses);
		}
	}
?>