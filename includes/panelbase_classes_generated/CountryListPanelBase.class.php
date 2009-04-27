<?php
	/**
	 * This is the abstract Panel class for the List All functionality
	 * of the Country class.  This code-generated class
	 * contains a datagrid to display an HTML page that can
	 * list a collection of Country objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new QPanel which extends this CountryListPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class CountryListPanelBase extends QPanel {
		public $dtgCountry;
		public $btnCreateNew;

		// Callback Method Names
		protected $strSetEditPanelMethod;
		protected $strCloseEditPanelMethod;
		
		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colCountryId;
		protected $colShortDescription;
		protected $colAbbreviation;
		protected $colStateFlag;
		protected $colProvinceFlag;

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
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgCountry_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colCountryId = new QDataGridColumn(QApplication::Translate('Country Id'), '<?= $_ITEM->CountryId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Country()->CountryId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Country()->CountryId, false)));
			$this->colShortDescription = new QDataGridColumn(QApplication::Translate('Short Description'), '<?= QString::Truncate($_ITEM->ShortDescription, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Country()->ShortDescription), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Country()->ShortDescription, false)));
			$this->colAbbreviation = new QDataGridColumn(QApplication::Translate('Abbreviation'), '<?= QString::Truncate($_ITEM->Abbreviation, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Country()->Abbreviation), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Country()->Abbreviation, false)));
			$this->colStateFlag = new QDataGridColumn(QApplication::Translate('State Flag'), '<?= ($_ITEM->StateFlag) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::Country()->StateFlag), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Country()->StateFlag, false)));
			$this->colProvinceFlag = new QDataGridColumn(QApplication::Translate('Province Flag'), '<?= ($_ITEM->ProvinceFlag) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::Country()->ProvinceFlag), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Country()->ProvinceFlag, false)));

			// Setup DataGrid
			$this->dtgCountry = new QDataGrid($this);
			$this->dtgCountry->CellSpacing = 0;
			$this->dtgCountry->CellPadding = 4;
			$this->dtgCountry->BorderStyle = QBorderStyle::Solid;
			$this->dtgCountry->BorderWidth = 1;
			$this->dtgCountry->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgCountry->Paginator = new QPaginator($this->dtgCountry);
			$this->dtgCountry->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgCountry->UseAjax = true;

			// Specify the local databind method this datagrid will use
			$this->dtgCountry->SetDataBinder('dtgCountry_Bind', $this);

			$this->dtgCountry->AddColumn($this->colEditLinkColumn);
			$this->dtgCountry->AddColumn($this->colCountryId);
			$this->dtgCountry->AddColumn($this->colShortDescription);
			$this->dtgCountry->AddColumn($this->colAbbreviation);
			$this->dtgCountry->AddColumn($this->colStateFlag);
			$this->dtgCountry->AddColumn($this->colProvinceFlag);

			// Setup the Create New button
			$this->btnCreateNew = new QButton($this);
			$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('Country');
			$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
		}

		public function dtgCountry_EditLinkColumn_Render(Country $objCountry) {
			$strControlId = 'btnEdit' . $this->dtgCountry->CurrentRowIndex;

			$btnEdit = $this->objForm->GetControl($strControlId);
			if (!$btnEdit) {
				$btnEdit = new QButton($this->dtgCountry, $strControlId);
				$btnEdit->Text = QApplication::Translate('Edit');
				$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
			}

			$btnEdit->ActionParameter = $objCountry->CountryId;
			return $btnEdit->Render(false);
		}

		public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
			$strParameterArray = explode(',', $strParameter);
			$objCountry = Country::Load($strParameterArray[0]);

			$objEditPanel = new CountryEditPanel($this, $this->strCloseEditPanelMethod, $objCountry);
			
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
			$objEditPanel = new CountryEditPanel($this, $this->strCloseEditPanelMethod, null);
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}


		public function dtgCountry_Bind() {
			// Get Total Count b/c of Pagination
			$this->dtgCountry->TotalItemCount = Country::CountAll();

			$objClauses = array();
			if ($objClause = $this->dtgCountry->OrderByClause)
				array_push($objClauses, $objClause);
			if ($objClause = $this->dtgCountry->LimitClause)
				array_push($objClauses, $objClause);
			$this->dtgCountry->DataSource = Country::LoadAll($objClauses);
		}
	}
?>