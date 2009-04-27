<?php
	/**
	 * This is the abstract Panel class for the List All functionality
	 * of the StateProvince class.  This code-generated class
	 * contains a datagrid to display an HTML page that can
	 * list a collection of StateProvince objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new QPanel which extends this StateProvinceListPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class StateProvinceListPanelBase extends QPanel {
		public $dtgStateProvince;
		public $btnCreateNew;

		// Callback Method Names
		protected $strSetEditPanelMethod;
		protected $strCloseEditPanelMethod;
		
		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colStateProvinceId;
		protected $colCountryId;
		protected $colShortDescription;
		protected $colAbbreviation;

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
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgStateProvince_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colStateProvinceId = new QDataGridColumn(QApplication::Translate('State Province Id'), '<?= $_ITEM->StateProvinceId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::StateProvince()->StateProvinceId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::StateProvince()->StateProvinceId, false)));
			$this->colCountryId = new QDataGridColumn(QApplication::Translate('Country Id'), '<?= $_CONTROL->ParentControl->dtgStateProvince_Country_Render($_ITEM); ?>');
			$this->colShortDescription = new QDataGridColumn(QApplication::Translate('Short Description'), '<?= QString::Truncate($_ITEM->ShortDescription, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::StateProvince()->ShortDescription), 'ReverseOrderByClause' => QQ::OrderBy(QQN::StateProvince()->ShortDescription, false)));
			$this->colAbbreviation = new QDataGridColumn(QApplication::Translate('Abbreviation'), '<?= QString::Truncate($_ITEM->Abbreviation, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::StateProvince()->Abbreviation), 'ReverseOrderByClause' => QQ::OrderBy(QQN::StateProvince()->Abbreviation, false)));

			// Setup DataGrid
			$this->dtgStateProvince = new QDataGrid($this);
			$this->dtgStateProvince->CellSpacing = 0;
			$this->dtgStateProvince->CellPadding = 4;
			$this->dtgStateProvince->BorderStyle = QBorderStyle::Solid;
			$this->dtgStateProvince->BorderWidth = 1;
			$this->dtgStateProvince->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgStateProvince->Paginator = new QPaginator($this->dtgStateProvince);
			$this->dtgStateProvince->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgStateProvince->UseAjax = true;

			// Specify the local databind method this datagrid will use
			$this->dtgStateProvince->SetDataBinder('dtgStateProvince_Bind', $this);

			$this->dtgStateProvince->AddColumn($this->colEditLinkColumn);
			$this->dtgStateProvince->AddColumn($this->colStateProvinceId);
			$this->dtgStateProvince->AddColumn($this->colCountryId);
			$this->dtgStateProvince->AddColumn($this->colShortDescription);
			$this->dtgStateProvince->AddColumn($this->colAbbreviation);

			// Setup the Create New button
			$this->btnCreateNew = new QButton($this);
			$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('StateProvince');
			$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
		}

		public function dtgStateProvince_EditLinkColumn_Render(StateProvince $objStateProvince) {
			$strControlId = 'btnEdit' . $this->dtgStateProvince->CurrentRowIndex;

			$btnEdit = $this->objForm->GetControl($strControlId);
			if (!$btnEdit) {
				$btnEdit = new QButton($this->dtgStateProvince, $strControlId);
				$btnEdit->Text = QApplication::Translate('Edit');
				$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
			}

			$btnEdit->ActionParameter = $objStateProvince->StateProvinceId;
			return $btnEdit->Render(false);
		}

		public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
			$strParameterArray = explode(',', $strParameter);
			$objStateProvince = StateProvince::Load($strParameterArray[0]);

			$objEditPanel = new StateProvinceEditPanel($this, $this->strCloseEditPanelMethod, $objStateProvince);
			
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
			$objEditPanel = new StateProvinceEditPanel($this, $this->strCloseEditPanelMethod, null);
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function dtgStateProvince_Country_Render(StateProvince $objStateProvince) {
			if (!is_null($objStateProvince->Country))
				return $objStateProvince->Country->__toString();
			else
				return null;
		}


		public function dtgStateProvince_Bind() {
			// Get Total Count b/c of Pagination
			$this->dtgStateProvince->TotalItemCount = StateProvince::CountAll();

			$objClauses = array();
			if ($objClause = $this->dtgStateProvince->OrderByClause)
				array_push($objClauses, $objClause);
			if ($objClause = $this->dtgStateProvince->LimitClause)
				array_push($objClauses, $objClause);
			$this->dtgStateProvince->DataSource = StateProvince::LoadAll($objClauses);
		}
	}
?>