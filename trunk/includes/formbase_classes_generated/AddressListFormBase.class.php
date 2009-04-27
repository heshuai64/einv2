<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the Address class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of Address objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this AddressListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class AddressListFormBase extends QForm {
		protected $dtgAddress;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colAddressId;
		protected $colCompanyId;
		protected $colShortDescription;
		protected $colCountryId;
		protected $colAddress1;
		protected $colAddress2;
		protected $colCity;
		protected $colStateProvinceId;
		protected $colPostalCode;
		protected $colCreatedBy;
		protected $colCreationDate;
		protected $colModifiedBy;
		protected $colModifiedDate;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgAddress_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colAddressId = new QDataGridColumn(QApplication::Translate('Address Id'), '<?= $_ITEM->AddressId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Address()->AddressId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Address()->AddressId, false)));
			$this->colCompanyId = new QDataGridColumn(QApplication::Translate('Company Id'), '<?= $_FORM->dtgAddress_Company_Render($_ITEM); ?>');
			$this->colShortDescription = new QDataGridColumn(QApplication::Translate('Short Description'), '<?= QString::Truncate($_ITEM->ShortDescription, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Address()->ShortDescription), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Address()->ShortDescription, false)));
			$this->colCountryId = new QDataGridColumn(QApplication::Translate('Country Id'), '<?= $_FORM->dtgAddress_Country_Render($_ITEM); ?>');
			$this->colAddress1 = new QDataGridColumn(QApplication::Translate('Address 1'), '<?= QString::Truncate($_ITEM->Address1, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Address()->Address1), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Address()->Address1, false)));
			$this->colAddress2 = new QDataGridColumn(QApplication::Translate('Address 2'), '<?= QString::Truncate($_ITEM->Address2, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Address()->Address2), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Address()->Address2, false)));
			$this->colCity = new QDataGridColumn(QApplication::Translate('City'), '<?= QString::Truncate($_ITEM->City, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Address()->City), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Address()->City, false)));
			$this->colStateProvinceId = new QDataGridColumn(QApplication::Translate('State Province Id'), '<?= $_FORM->dtgAddress_StateProvince_Render($_ITEM); ?>');
			$this->colPostalCode = new QDataGridColumn(QApplication::Translate('Postal Code'), '<?= QString::Truncate($_ITEM->PostalCode, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Address()->PostalCode), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Address()->PostalCode, false)));
			$this->colCreatedBy = new QDataGridColumn(QApplication::Translate('Created By'), '<?= $_FORM->dtgAddress_CreatedByObject_Render($_ITEM); ?>');
			$this->colCreationDate = new QDataGridColumn(QApplication::Translate('Creation Date'), '<?= $_FORM->dtgAddress_CreationDate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Address()->CreationDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Address()->CreationDate, false)));
			$this->colModifiedBy = new QDataGridColumn(QApplication::Translate('Modified By'), '<?= $_FORM->dtgAddress_ModifiedByObject_Render($_ITEM); ?>');
			$this->colModifiedDate = new QDataGridColumn(QApplication::Translate('Modified Date'), '<?= QString::Truncate($_ITEM->ModifiedDate, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Address()->ModifiedDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Address()->ModifiedDate, false)));

			// Setup DataGrid
			$this->dtgAddress = new QDataGrid($this);
			$this->dtgAddress->CellSpacing = 0;
			$this->dtgAddress->CellPadding = 4;
			$this->dtgAddress->BorderStyle = QBorderStyle::Solid;
			$this->dtgAddress->BorderWidth = 1;
			$this->dtgAddress->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgAddress->Paginator = new QPaginator($this->dtgAddress);
			$this->dtgAddress->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgAddress->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgAddress->SetDataBinder('dtgAddress_Bind');

			$this->dtgAddress->AddColumn($this->colEditLinkColumn);
			$this->dtgAddress->AddColumn($this->colAddressId);
			$this->dtgAddress->AddColumn($this->colCompanyId);
			$this->dtgAddress->AddColumn($this->colShortDescription);
			$this->dtgAddress->AddColumn($this->colCountryId);
			$this->dtgAddress->AddColumn($this->colAddress1);
			$this->dtgAddress->AddColumn($this->colAddress2);
			$this->dtgAddress->AddColumn($this->colCity);
			$this->dtgAddress->AddColumn($this->colStateProvinceId);
			$this->dtgAddress->AddColumn($this->colPostalCode);
			$this->dtgAddress->AddColumn($this->colCreatedBy);
			$this->dtgAddress->AddColumn($this->colCreationDate);
			$this->dtgAddress->AddColumn($this->colModifiedBy);
			$this->dtgAddress->AddColumn($this->colModifiedDate);
		}
		
		public function dtgAddress_EditLinkColumn_Render(Address $objAddress) {
			return sprintf('<a href="address_edit.php?intAddressId=%s">%s</a>',
				$objAddress->AddressId, 
				QApplication::Translate('Edit'));
		}

		public function dtgAddress_Company_Render(Address $objAddress) {
			if (!is_null($objAddress->Company))
				return $objAddress->Company->__toString();
			else
				return null;
		}

		public function dtgAddress_Country_Render(Address $objAddress) {
			if (!is_null($objAddress->Country))
				return $objAddress->Country->__toString();
			else
				return null;
		}

		public function dtgAddress_StateProvince_Render(Address $objAddress) {
			if (!is_null($objAddress->StateProvince))
				return $objAddress->StateProvince->__toString();
			else
				return null;
		}

		public function dtgAddress_CreatedByObject_Render(Address $objAddress) {
			if (!is_null($objAddress->CreatedByObject))
				return $objAddress->CreatedByObject->__toString();
			else
				return null;
		}

		public function dtgAddress_CreationDate_Render(Address $objAddress) {
			if (!is_null($objAddress->CreationDate))
				return $objAddress->CreationDate->__toString(QDateTime::FormatDisplayDateTime);
			else
				return null;
		}

		public function dtgAddress_ModifiedByObject_Render(Address $objAddress) {
			if (!is_null($objAddress->ModifiedByObject))
				return $objAddress->ModifiedByObject->__toString();
			else
				return null;
		}


		protected function dtgAddress_Bind() {
			// Because we want to enable pagination AND sorting, we need to setup the $objClauses array to send to LoadAll()

			// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
			$this->dtgAddress->TotalItemCount = Address::CountAll();

			// Setup the $objClauses Array
			$objClauses = array();

			// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
			// the OrderByClause to the $objClauses array
			if ($objClause = $this->dtgAddress->OrderByClause)
				array_push($objClauses, $objClause);

			// Add the LimitClause information, as well
			if ($objClause = $this->dtgAddress->LimitClause)
				array_push($objClauses, $objClause);

			// Set the DataSource to be the array of all Address objects, given the clauses above
			$this->dtgAddress->DataSource = Address::LoadAll($objClauses);
		}
	}
?>