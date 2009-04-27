<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the LengthUnit class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of LengthUnit objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this LengthUnitListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class LengthUnitListFormBase extends QForm {
		protected $dtgLengthUnit;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colLengthUnitId;
		protected $colShortDescription;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgLengthUnit_EditLinkColumn_Render($_ITEM) ?>');
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
			$this->dtgLengthUnit->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgLengthUnit->SetDataBinder('dtgLengthUnit_Bind');

			$this->dtgLengthUnit->AddColumn($this->colEditLinkColumn);
			$this->dtgLengthUnit->AddColumn($this->colLengthUnitId);
			$this->dtgLengthUnit->AddColumn($this->colShortDescription);
		}
		
		public function dtgLengthUnit_EditLinkColumn_Render(LengthUnit $objLengthUnit) {
			return sprintf('<a href="length_unit_edit.php?intLengthUnitId=%s">%s</a>',
				$objLengthUnit->LengthUnitId, 
				QApplication::Translate('Edit'));
		}


		protected function dtgLengthUnit_Bind() {
			// Because we want to enable pagination AND sorting, we need to setup the $objClauses array to send to LoadAll()

			// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
			$this->dtgLengthUnit->TotalItemCount = LengthUnit::CountAll();

			// Setup the $objClauses Array
			$objClauses = array();

			// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
			// the OrderByClause to the $objClauses array
			if ($objClause = $this->dtgLengthUnit->OrderByClause)
				array_push($objClauses, $objClause);

			// Add the LimitClause information, as well
			if ($objClause = $this->dtgLengthUnit->LimitClause)
				array_push($objClauses, $objClause);

			// Set the DataSource to be the array of all LengthUnit objects, given the clauses above
			$this->dtgLengthUnit->DataSource = LengthUnit::LoadAll($objClauses);
		}
	}
?>