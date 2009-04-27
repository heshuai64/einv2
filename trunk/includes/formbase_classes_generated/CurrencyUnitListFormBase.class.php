<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the CurrencyUnit class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of CurrencyUnit objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this CurrencyUnitListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class CurrencyUnitListFormBase extends QForm {
		protected $dtgCurrencyUnit;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colCurrencyUnitId;
		protected $colShortDescription;
		protected $colSymbol;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgCurrencyUnit_EditLinkColumn_Render($_ITEM) ?>');
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
			$this->dtgCurrencyUnit->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgCurrencyUnit->SetDataBinder('dtgCurrencyUnit_Bind');

			$this->dtgCurrencyUnit->AddColumn($this->colEditLinkColumn);
			$this->dtgCurrencyUnit->AddColumn($this->colCurrencyUnitId);
			$this->dtgCurrencyUnit->AddColumn($this->colShortDescription);
			$this->dtgCurrencyUnit->AddColumn($this->colSymbol);
		}
		
		public function dtgCurrencyUnit_EditLinkColumn_Render(CurrencyUnit $objCurrencyUnit) {
			return sprintf('<a href="currency_unit_edit.php?intCurrencyUnitId=%s">%s</a>',
				$objCurrencyUnit->CurrencyUnitId, 
				QApplication::Translate('Edit'));
		}


		protected function dtgCurrencyUnit_Bind() {
			// Because we want to enable pagination AND sorting, we need to setup the $objClauses array to send to LoadAll()

			// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
			$this->dtgCurrencyUnit->TotalItemCount = CurrencyUnit::CountAll();

			// Setup the $objClauses Array
			$objClauses = array();

			// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
			// the OrderByClause to the $objClauses array
			if ($objClause = $this->dtgCurrencyUnit->OrderByClause)
				array_push($objClauses, $objClause);

			// Add the LimitClause information, as well
			if ($objClause = $this->dtgCurrencyUnit->LimitClause)
				array_push($objClauses, $objClause);

			// Set the DataSource to be the array of all CurrencyUnit objects, given the clauses above
			$this->dtgCurrencyUnit->DataSource = CurrencyUnit::LoadAll($objClauses);
		}
	}
?>