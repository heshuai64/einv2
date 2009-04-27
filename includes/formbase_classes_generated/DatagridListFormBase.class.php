<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the Datagrid class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of Datagrid objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this DatagridListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class DatagridListFormBase extends QForm {
		protected $dtgDatagrid;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colDatagridId;
		protected $colShortDescription;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgDatagrid_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colDatagridId = new QDataGridColumn(QApplication::Translate('Datagrid Id'), '<?= $_ITEM->DatagridId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Datagrid()->DatagridId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Datagrid()->DatagridId, false)));
			$this->colShortDescription = new QDataGridColumn(QApplication::Translate('Short Description'), '<?= QString::Truncate($_ITEM->ShortDescription, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Datagrid()->ShortDescription), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Datagrid()->ShortDescription, false)));

			// Setup DataGrid
			$this->dtgDatagrid = new QDataGrid($this);
			$this->dtgDatagrid->CellSpacing = 0;
			$this->dtgDatagrid->CellPadding = 4;
			$this->dtgDatagrid->BorderStyle = QBorderStyle::Solid;
			$this->dtgDatagrid->BorderWidth = 1;
			$this->dtgDatagrid->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgDatagrid->Paginator = new QPaginator($this->dtgDatagrid);
			$this->dtgDatagrid->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgDatagrid->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgDatagrid->SetDataBinder('dtgDatagrid_Bind');

			$this->dtgDatagrid->AddColumn($this->colEditLinkColumn);
			$this->dtgDatagrid->AddColumn($this->colDatagridId);
			$this->dtgDatagrid->AddColumn($this->colShortDescription);
		}
		
		public function dtgDatagrid_EditLinkColumn_Render(Datagrid $objDatagrid) {
			return sprintf('<a href="datagrid_edit.php?intDatagridId=%s">%s</a>',
				$objDatagrid->DatagridId, 
				QApplication::Translate('Edit'));
		}


		protected function dtgDatagrid_Bind() {
			// Because we want to enable pagination AND sorting, we need to setup the $objClauses array to send to LoadAll()

			// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
			$this->dtgDatagrid->TotalItemCount = Datagrid::CountAll();

			// Setup the $objClauses Array
			$objClauses = array();

			// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
			// the OrderByClause to the $objClauses array
			if ($objClause = $this->dtgDatagrid->OrderByClause)
				array_push($objClauses, $objClause);

			// Add the LimitClause information, as well
			if ($objClause = $this->dtgDatagrid->LimitClause)
				array_push($objClauses, $objClause);

			// Set the DataSource to be the array of all Datagrid objects, given the clauses above
			$this->dtgDatagrid->DataSource = Datagrid::LoadAll($objClauses);
		}
	}
?>