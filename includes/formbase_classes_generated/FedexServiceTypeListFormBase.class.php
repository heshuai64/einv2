<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the FedexServiceType class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of FedexServiceType objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this FedexServiceTypeListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class FedexServiceTypeListFormBase extends QForm {
		protected $dtgFedexServiceType;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colFedexServiceTypeId;
		protected $colShortDescription;
		protected $colValue;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgFedexServiceType_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colFedexServiceTypeId = new QDataGridColumn(QApplication::Translate('Fedex Service Type Id'), '<?= $_ITEM->FedexServiceTypeId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::FedexServiceType()->FedexServiceTypeId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FedexServiceType()->FedexServiceTypeId, false)));
			$this->colShortDescription = new QDataGridColumn(QApplication::Translate('Short Description'), '<?= QString::Truncate($_ITEM->ShortDescription, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::FedexServiceType()->ShortDescription), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FedexServiceType()->ShortDescription, false)));
			$this->colValue = new QDataGridColumn(QApplication::Translate('Value'), '<?= QString::Truncate($_ITEM->Value, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::FedexServiceType()->Value), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FedexServiceType()->Value, false)));

			// Setup DataGrid
			$this->dtgFedexServiceType = new QDataGrid($this);
			$this->dtgFedexServiceType->CellSpacing = 0;
			$this->dtgFedexServiceType->CellPadding = 4;
			$this->dtgFedexServiceType->BorderStyle = QBorderStyle::Solid;
			$this->dtgFedexServiceType->BorderWidth = 1;
			$this->dtgFedexServiceType->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgFedexServiceType->Paginator = new QPaginator($this->dtgFedexServiceType);
			$this->dtgFedexServiceType->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgFedexServiceType->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgFedexServiceType->SetDataBinder('dtgFedexServiceType_Bind');

			$this->dtgFedexServiceType->AddColumn($this->colEditLinkColumn);
			$this->dtgFedexServiceType->AddColumn($this->colFedexServiceTypeId);
			$this->dtgFedexServiceType->AddColumn($this->colShortDescription);
			$this->dtgFedexServiceType->AddColumn($this->colValue);
		}
		
		public function dtgFedexServiceType_EditLinkColumn_Render(FedexServiceType $objFedexServiceType) {
			return sprintf('<a href="fedex_service_type_edit.php?intFedexServiceTypeId=%s">%s</a>',
				$objFedexServiceType->FedexServiceTypeId, 
				QApplication::Translate('Edit'));
		}


		protected function dtgFedexServiceType_Bind() {
			// Because we want to enable pagination AND sorting, we need to setup the $objClauses array to send to LoadAll()

			// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
			$this->dtgFedexServiceType->TotalItemCount = FedexServiceType::CountAll();

			// Setup the $objClauses Array
			$objClauses = array();

			// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
			// the OrderByClause to the $objClauses array
			if ($objClause = $this->dtgFedexServiceType->OrderByClause)
				array_push($objClauses, $objClause);

			// Add the LimitClause information, as well
			if ($objClause = $this->dtgFedexServiceType->LimitClause)
				array_push($objClauses, $objClause);

			// Set the DataSource to be the array of all FedexServiceType objects, given the clauses above
			$this->dtgFedexServiceType->DataSource = FedexServiceType::LoadAll($objClauses);
		}
	}
?>