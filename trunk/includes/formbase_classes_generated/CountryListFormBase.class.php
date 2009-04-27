<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the Country class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of Country objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this CountryListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class CountryListFormBase extends QForm {
		protected $dtgCountry;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colCountryId;
		protected $colShortDescription;
		protected $colAbbreviation;
		protected $colStateFlag;
		protected $colProvinceFlag;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgCountry_EditLinkColumn_Render($_ITEM) ?>');
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
			$this->dtgCountry->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgCountry->SetDataBinder('dtgCountry_Bind');

			$this->dtgCountry->AddColumn($this->colEditLinkColumn);
			$this->dtgCountry->AddColumn($this->colCountryId);
			$this->dtgCountry->AddColumn($this->colShortDescription);
			$this->dtgCountry->AddColumn($this->colAbbreviation);
			$this->dtgCountry->AddColumn($this->colStateFlag);
			$this->dtgCountry->AddColumn($this->colProvinceFlag);
		}
		
		public function dtgCountry_EditLinkColumn_Render(Country $objCountry) {
			return sprintf('<a href="country_edit.php?intCountryId=%s">%s</a>',
				$objCountry->CountryId, 
				QApplication::Translate('Edit'));
		}


		protected function dtgCountry_Bind() {
			// Because we want to enable pagination AND sorting, we need to setup the $objClauses array to send to LoadAll()

			// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
			$this->dtgCountry->TotalItemCount = Country::CountAll();

			// Setup the $objClauses Array
			$objClauses = array();

			// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
			// the OrderByClause to the $objClauses array
			if ($objClause = $this->dtgCountry->OrderByClause)
				array_push($objClauses, $objClause);

			// Add the LimitClause information, as well
			if ($objClause = $this->dtgCountry->LimitClause)
				array_push($objClauses, $objClause);

			// Set the DataSource to be the array of all Country objects, given the clauses above
			$this->dtgCountry->DataSource = Country::LoadAll($objClauses);
		}
	}
?>