<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the PackageType class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of PackageType objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this PackageTypeListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class PackageTypeListFormBase extends QForm {
		protected $dtgPackageType;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colPackageTypeId;
		protected $colShortDescription;
		protected $colCourierId;
		protected $colValue;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgPackageType_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colPackageTypeId = new QDataGridColumn(QApplication::Translate('Package Type Id'), '<?= $_ITEM->PackageTypeId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::PackageType()->PackageTypeId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::PackageType()->PackageTypeId, false)));
			$this->colShortDescription = new QDataGridColumn(QApplication::Translate('Short Description'), '<?= QString::Truncate($_ITEM->ShortDescription, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::PackageType()->ShortDescription), 'ReverseOrderByClause' => QQ::OrderBy(QQN::PackageType()->ShortDescription, false)));
			$this->colCourierId = new QDataGridColumn(QApplication::Translate('Courier Id'), '<?= $_FORM->dtgPackageType_Courier_Render($_ITEM); ?>');
			$this->colValue = new QDataGridColumn(QApplication::Translate('Value'), '<?= QString::Truncate($_ITEM->Value, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::PackageType()->Value), 'ReverseOrderByClause' => QQ::OrderBy(QQN::PackageType()->Value, false)));

			// Setup DataGrid
			$this->dtgPackageType = new QDataGrid($this);
			$this->dtgPackageType->CellSpacing = 0;
			$this->dtgPackageType->CellPadding = 4;
			$this->dtgPackageType->BorderStyle = QBorderStyle::Solid;
			$this->dtgPackageType->BorderWidth = 1;
			$this->dtgPackageType->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgPackageType->Paginator = new QPaginator($this->dtgPackageType);
			$this->dtgPackageType->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgPackageType->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgPackageType->SetDataBinder('dtgPackageType_Bind');

			$this->dtgPackageType->AddColumn($this->colEditLinkColumn);
			$this->dtgPackageType->AddColumn($this->colPackageTypeId);
			$this->dtgPackageType->AddColumn($this->colShortDescription);
			$this->dtgPackageType->AddColumn($this->colCourierId);
			$this->dtgPackageType->AddColumn($this->colValue);
		}
		
		public function dtgPackageType_EditLinkColumn_Render(PackageType $objPackageType) {
			return sprintf('<a href="package_type_edit.php?intPackageTypeId=%s">%s</a>',
				$objPackageType->PackageTypeId, 
				QApplication::Translate('Edit'));
		}

		public function dtgPackageType_Courier_Render(PackageType $objPackageType) {
			if (!is_null($objPackageType->Courier))
				return $objPackageType->Courier->__toString();
			else
				return null;
		}


		protected function dtgPackageType_Bind() {
			// Because we want to enable pagination AND sorting, we need to setup the $objClauses array to send to LoadAll()

			// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
			$this->dtgPackageType->TotalItemCount = PackageType::CountAll();

			// Setup the $objClauses Array
			$objClauses = array();

			// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
			// the OrderByClause to the $objClauses array
			if ($objClause = $this->dtgPackageType->OrderByClause)
				array_push($objClauses, $objClause);

			// Add the LimitClause information, as well
			if ($objClause = $this->dtgPackageType->LimitClause)
				array_push($objClauses, $objClause);

			// Set the DataSource to be the array of all PackageType objects, given the clauses above
			$this->dtgPackageType->DataSource = PackageType::LoadAll($objClauses);
		}
	}
?>