<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the StateProvince class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of StateProvince objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this StateProvinceListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class StateProvinceListFormBase extends QForm {
		protected $dtgStateProvince;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colStateProvinceId;
		protected $colCountryId;
		protected $colShortDescription;
		protected $colAbbreviation;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgStateProvince_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colStateProvinceId = new QDataGridColumn(QApplication::Translate('State Province Id'), '<?= $_ITEM->StateProvinceId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::StateProvince()->StateProvinceId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::StateProvince()->StateProvinceId, false)));
			$this->colCountryId = new QDataGridColumn(QApplication::Translate('Country Id'), '<?= $_FORM->dtgStateProvince_Country_Render($_ITEM); ?>');
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
			$this->dtgStateProvince->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgStateProvince->SetDataBinder('dtgStateProvince_Bind');

			$this->dtgStateProvince->AddColumn($this->colEditLinkColumn);
			$this->dtgStateProvince->AddColumn($this->colStateProvinceId);
			$this->dtgStateProvince->AddColumn($this->colCountryId);
			$this->dtgStateProvince->AddColumn($this->colShortDescription);
			$this->dtgStateProvince->AddColumn($this->colAbbreviation);
		}
		
		public function dtgStateProvince_EditLinkColumn_Render(StateProvince $objStateProvince) {
			return sprintf('<a href="state_province_edit.php?intStateProvinceId=%s">%s</a>',
				$objStateProvince->StateProvinceId, 
				QApplication::Translate('Edit'));
		}

		public function dtgStateProvince_Country_Render(StateProvince $objStateProvince) {
			if (!is_null($objStateProvince->Country))
				return $objStateProvince->Country->__toString();
			else
				return null;
		}


		protected function dtgStateProvince_Bind() {
			// Because we want to enable pagination AND sorting, we need to setup the $objClauses array to send to LoadAll()

			// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
			$this->dtgStateProvince->TotalItemCount = StateProvince::CountAll();

			// Setup the $objClauses Array
			$objClauses = array();

			// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
			// the OrderByClause to the $objClauses array
			if ($objClause = $this->dtgStateProvince->OrderByClause)
				array_push($objClauses, $objClause);

			// Add the LimitClause information, as well
			if ($objClause = $this->dtgStateProvince->LimitClause)
				array_push($objClauses, $objClause);

			// Set the DataSource to be the array of all StateProvince objects, given the clauses above
			$this->dtgStateProvince->DataSource = StateProvince::LoadAll($objClauses);
		}
	}
?>