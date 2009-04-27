<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the Courier class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of Courier objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this CourierListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class CourierListFormBase extends QForm {
		protected $dtgCourier;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colCourierId;
		protected $colShortDescription;
		protected $colActiveFlag;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgCourier_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colCourierId = new QDataGridColumn(QApplication::Translate('Courier Id'), '<?= $_ITEM->CourierId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Courier()->CourierId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Courier()->CourierId, false)));
			$this->colShortDescription = new QDataGridColumn(QApplication::Translate('Short Description'), '<?= QString::Truncate($_ITEM->ShortDescription, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Courier()->ShortDescription), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Courier()->ShortDescription, false)));
			$this->colActiveFlag = new QDataGridColumn(QApplication::Translate('Active Flag'), '<?= ($_ITEM->ActiveFlag) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::Courier()->ActiveFlag), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Courier()->ActiveFlag, false)));

			// Setup DataGrid
			$this->dtgCourier = new QDataGrid($this);
			$this->dtgCourier->CellSpacing = 0;
			$this->dtgCourier->CellPadding = 4;
			$this->dtgCourier->BorderStyle = QBorderStyle::Solid;
			$this->dtgCourier->BorderWidth = 1;
			$this->dtgCourier->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgCourier->Paginator = new QPaginator($this->dtgCourier);
			$this->dtgCourier->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgCourier->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgCourier->SetDataBinder('dtgCourier_Bind');

			$this->dtgCourier->AddColumn($this->colEditLinkColumn);
			$this->dtgCourier->AddColumn($this->colCourierId);
			$this->dtgCourier->AddColumn($this->colShortDescription);
			$this->dtgCourier->AddColumn($this->colActiveFlag);
		}
		
		public function dtgCourier_EditLinkColumn_Render(Courier $objCourier) {
			return sprintf('<a href="courier_edit.php?intCourierId=%s">%s</a>',
				$objCourier->CourierId, 
				QApplication::Translate('Edit'));
		}


		protected function dtgCourier_Bind() {
			// Because we want to enable pagination AND sorting, we need to setup the $objClauses array to send to LoadAll()

			// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
			$this->dtgCourier->TotalItemCount = Courier::CountAll();

			// Setup the $objClauses Array
			$objClauses = array();

			// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
			// the OrderByClause to the $objClauses array
			if ($objClause = $this->dtgCourier->OrderByClause)
				array_push($objClauses, $objClause);

			// Add the LimitClause information, as well
			if ($objClause = $this->dtgCourier->LimitClause)
				array_push($objClauses, $objClause);

			// Set the DataSource to be the array of all Courier objects, given the clauses above
			$this->dtgCourier->DataSource = Courier::LoadAll($objClauses);
		}
	}
?>