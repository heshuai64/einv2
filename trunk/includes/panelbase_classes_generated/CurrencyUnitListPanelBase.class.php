<?php
	/**
	 * This is the abstract Panel class for the List All functionality
	 * of the CurrencyUnit class.  This code-generated class
	 * contains a datagrid to display an HTML page that can
	 * list a collection of CurrencyUnit objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new QPanel which extends this CurrencyUnitListPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class CurrencyUnitListPanelBase extends QPanel {
		public $dtgCurrencyUnit;
		public $btnCreateNew;

		// Callback Method Names
		protected $strSetEditPanelMethod;
		protected $strCloseEditPanelMethod;
		
		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colCurrencyUnitId;
		protected $colShortDescription;
		protected $colSymbol;

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
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgCurrencyUnit_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colCurrencyUnitId = new QDataGridColumn(QApplication::Translate('Currency Unit Id'), '<?= $_ITEM->CurrencyUnitId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::CurrencyUnit()->CurrencyUnitId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::CurrencyUnit()->CurrencyUnitId, false)));
			$this->colShortDescription = new QDataGridColumn(QApplication::Translate('Short Description'), '<?= QString::Truncate($_ITEM->ShortDescription, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::CurrencyUnit()->ShortDescription), 'ReverseOrderByClause' => QQ::OrderBy(QQN::CurrencyUnit()->ShortDescription, false)));
			$this->colSymbol = new QDataGridColumn(QApplication::Translate('Symbol'), '<?= QString::Truncate($_ITEM->Symbol, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::CurrencyUnit()->Symbol), 'ReverseOrderByClause' => QQ::OrderBy(QQN::CurrencyUnit()->Symbol, false)));

			// Setup DataGrid
			$this->dtgCurrencyUnit = new QDataGrid($this);
			$this->dtgCurrencyUnit->CellSpacing = 0;
			$this->dtgCurrencyUnit->CellPadding = 4;
			$this->dtgCurrencyUnit->BorderStyle = QBorderStyle::Solid;
			$this->dtgCurrencyUnit->BorderWidth = 1;
			$this->dtgCurrencyUnit->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgCurrencyUnit->Paginator = new QPaginator($this->dtgCurrencyUnit);
			$this->dtgCurrencyUnit->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgCurrencyUnit->UseAjax = true;

			// Specify the local databind method this datagrid will use
			$this->dtgCurrencyUnit->SetDataBinder('dtgCurrencyUnit_Bind', $this);

			$this->dtgCurrencyUnit->AddColumn($this->colEditLinkColumn);
			$this->dtgCurrencyUnit->AddColumn($this->colCurrencyUnitId);
			$this->dtgCurrencyUnit->AddColumn($this->colShortDescription);
			$this->dtgCurrencyUnit->AddColumn($this->colSymbol);

			// Setup the Create New button
			$this->btnCreateNew = new QButton($this);
			$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('CurrencyUnit');
			$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
		}

		public function dtgCurrencyUnit_EditLinkColumn_Render(CurrencyUnit $objCurrencyUnit) {
			$strControlId = 'btnEdit' . $this->dtgCurrencyUnit->CurrentRowIndex;

			$btnEdit = $this->objForm->GetControl($strControlId);
			if (!$btnEdit) {
				$btnEdit = new QButton($this->dtgCurrencyUnit, $strControlId);
				$btnEdit->Text = QApplication::Translate('Edit');
				$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
			}

			$btnEdit->ActionParameter = $objCurrencyUnit->CurrencyUnitId;
			return $btnEdit->Render(false);
		}

		public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
			$strParameterArray = explode(',', $strParameter);
			$objCurrencyUnit = CurrencyUnit::Load($strParameterArray[0]);

			$objEditPanel = new CurrencyUnitEditPanel($this, $this->strCloseEditPanelMethod, $objCurrencyUnit);
			
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
			$objEditPanel = new CurrencyUnitEditPanel($this, $this->strCloseEditPanelMethod, null);
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}


		public function dtgCurrencyUnit_Bind() {
			// Get Total Count b/c of Pagination
			$this->dtgCurrencyUnit->TotalItemCount = CurrencyUnit::CountAll();

			$objClauses = array();
			if ($objClause = $this->dtgCurrencyUnit->OrderByClause)
				array_push($objClauses, $objClause);
			if ($objClause = $this->dtgCurrencyUnit->LimitClause)
				array_push($objClauses, $objClause);
			$this->dtgCurrencyUnit->DataSource = CurrencyUnit::LoadAll($objClauses);
		}
	}
?>