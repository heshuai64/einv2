<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the WeightUnit class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of WeightUnit objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this WeightUnitListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class WeightUnitListFormBase extends QForm {
		protected $dtgWeightUnit;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colWeightUnitId;
		protected $colShortDescription;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgWeightUnit_EditLinkColumn_Render($_ITEM) ?>');
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
			$this->dtgWeightUnit->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgWeightUnit->SetDataBinder('dtgWeightUnit_Bind');

			$this->dtgWeightUnit->AddColumn($this->colEditLinkColumn);
			$this->dtgWeightUnit->AddColumn($this->colWeightUnitId);
			$this->dtgWeightUnit->AddColumn($this->colShortDescription);
		}
		
		public function dtgWeightUnit_EditLinkColumn_Render(WeightUnit $objWeightUnit) {
			return sprintf('<a href="weight_unit_edit.php?intWeightUnitId=%s">%s</a>',
				$objWeightUnit->WeightUnitId, 
				QApplication::Translate('Edit'));
		}


		protected function dtgWeightUnit_Bind() {
			// Because we want to enable pagination AND sorting, we need to setup the $objClauses array to send to LoadAll()

			// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
			$this->dtgWeightUnit->TotalItemCount = WeightUnit::CountAll();

			// Setup the $objClauses Array
			$objClauses = array();

			// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
			// the OrderByClause to the $objClauses array
			if ($objClause = $this->dtgWeightUnit->OrderByClause)
				array_push($objClauses, $objClause);

			// Add the LimitClause information, as well
			if ($objClause = $this->dtgWeightUnit->LimitClause)
				array_push($objClauses, $objClause);

			// Set the DataSource to be the array of all WeightUnit objects, given the clauses above
			$this->dtgWeightUnit->DataSource = WeightUnit::LoadAll($objClauses);
		}
	}
?>