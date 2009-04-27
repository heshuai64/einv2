<?php
	/**
	 * This is the abstract Panel class for the List All functionality
	 * of the Contact class.  This code-generated class
	 * contains a datagrid to display an HTML page that can
	 * list a collection of Contact objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new QPanel which extends this ContactListPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class ContactListPanelBase extends QPanel {
		public $dtgContact;
		public $btnCreateNew;

		// Callback Method Names
		protected $strSetEditPanelMethod;
		protected $strCloseEditPanelMethod;
		
		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colContactId;
		protected $colCompanyId;
		protected $colAddressId;
		protected $colFirstName;
		protected $colLastName;
		protected $colTitle;
		protected $colEmail;
		protected $colPhoneOffice;
		protected $colPhoneHome;
		protected $colPhoneMobile;
		protected $colFax;
		protected $colDescription;
		protected $colCreatedBy;
		protected $colCreationDate;
		protected $colModifiedBy;
		protected $colModifiedDate;

		public function __construct($objParentObject, $strSetEditPanelMethod, $strCloseEditPanelMethod, $strControlId = null) {
			// Call the Parent
			try {
				parent::__construct($objParentObject, $strControlId);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Record Method Callbacks
			$this->strSetEditPanelMethod = $strSetEditPanelMethod;
			$this->strCloseEditPanelMethod = $strCloseEditPanelMethod;

			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgContact_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colContactId = new QDataGridColumn(QApplication::Translate('Contact Id'), '<?= $_ITEM->ContactId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Contact()->ContactId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Contact()->ContactId, false)));
			$this->colCompanyId = new QDataGridColumn(QApplication::Translate('Company Id'), '<?= $_CONTROL->ParentControl->dtgContact_Company_Render($_ITEM); ?>');
			$this->colAddressId = new QDataGridColumn(QApplication::Translate('Address Id'), '<?= $_CONTROL->ParentControl->dtgContact_Address_Render($_ITEM); ?>');
			$this->colFirstName = new QDataGridColumn(QApplication::Translate('First Name'), '<?= QString::Truncate($_ITEM->FirstName, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Contact()->FirstName), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Contact()->FirstName, false)));
			$this->colLastName = new QDataGridColumn(QApplication::Translate('Last Name'), '<?= QString::Truncate($_ITEM->LastName, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Contact()->LastName), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Contact()->LastName, false)));
			$this->colTitle = new QDataGridColumn(QApplication::Translate('Title'), '<?= QString::Truncate($_ITEM->Title, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Contact()->Title), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Contact()->Title, false)));
			$this->colEmail = new QDataGridColumn(QApplication::Translate('Email'), '<?= QString::Truncate($_ITEM->Email, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Contact()->Email), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Contact()->Email, false)));
			$this->colPhoneOffice = new QDataGridColumn(QApplication::Translate('Phone Office'), '<?= QString::Truncate($_ITEM->PhoneOffice, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Contact()->PhoneOffice), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Contact()->PhoneOffice, false)));
			$this->colPhoneHome = new QDataGridColumn(QApplication::Translate('Phone Home'), '<?= QString::Truncate($_ITEM->PhoneHome, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Contact()->PhoneHome), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Contact()->PhoneHome, false)));
			$this->colPhoneMobile = new QDataGridColumn(QApplication::Translate('Phone Mobile'), '<?= QString::Truncate($_ITEM->PhoneMobile, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Contact()->PhoneMobile), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Contact()->PhoneMobile, false)));
			$this->colFax = new QDataGridColumn(QApplication::Translate('Fax'), '<?= QString::Truncate($_ITEM->Fax, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Contact()->Fax), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Contact()->Fax, false)));
			$this->colDescription = new QDataGridColumn(QApplication::Translate('Description'), '<?= QString::Truncate($_ITEM->Description, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Contact()->Description), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Contact()->Description, false)));
			$this->colCreatedBy = new QDataGridColumn(QApplication::Translate('Created By'), '<?= $_CONTROL->ParentControl->dtgContact_CreatedByObject_Render($_ITEM); ?>');
			$this->colCreationDate = new QDataGridColumn(QApplication::Translate('Creation Date'), '<?= $_CONTROL->ParentControl->dtgContact_CreationDate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Contact()->CreationDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Contact()->CreationDate, false)));
			$this->colModifiedBy = new QDataGridColumn(QApplication::Translate('Modified By'), '<?= $_CONTROL->ParentControl->dtgContact_ModifiedByObject_Render($_ITEM); ?>');
			$this->colModifiedDate = new QDataGridColumn(QApplication::Translate('Modified Date'), '<?= QString::Truncate($_ITEM->ModifiedDate, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Contact()->ModifiedDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Contact()->ModifiedDate, false)));

			// Setup DataGrid
			$this->dtgContact = new QDataGrid($this);
			$this->dtgContact->CellSpacing = 0;
			$this->dtgContact->CellPadding = 4;
			$this->dtgContact->BorderStyle = QBorderStyle::Solid;
			$this->dtgContact->BorderWidth = 1;
			$this->dtgContact->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgContact->Paginator = new QPaginator($this->dtgContact);
			$this->dtgContact->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgContact->UseAjax = true;

			// Specify the local databind method this datagrid will use
			$this->dtgContact->SetDataBinder('dtgContact_Bind', $this);

			$this->dtgContact->AddColumn($this->colEditLinkColumn);
			$this->dtgContact->AddColumn($this->colContactId);
			$this->dtgContact->AddColumn($this->colCompanyId);
			$this->dtgContact->AddColumn($this->colAddressId);
			$this->dtgContact->AddColumn($this->colFirstName);
			$this->dtgContact->AddColumn($this->colLastName);
			$this->dtgContact->AddColumn($this->colTitle);
			$this->dtgContact->AddColumn($this->colEmail);
			$this->dtgContact->AddColumn($this->colPhoneOffice);
			$this->dtgContact->AddColumn($this->colPhoneHome);
			$this->dtgContact->AddColumn($this->colPhoneMobile);
			$this->dtgContact->AddColumn($this->colFax);
			$this->dtgContact->AddColumn($this->colDescription);
			$this->dtgContact->AddColumn($this->colCreatedBy);
			$this->dtgContact->AddColumn($this->colCreationDate);
			$this->dtgContact->AddColumn($this->colModifiedBy);
			$this->dtgContact->AddColumn($this->colModifiedDate);

			// Setup the Create New button
			$this->btnCreateNew = new QButton($this);
			$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('Contact');
			$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
		}

		public function dtgContact_EditLinkColumn_Render(Contact $objContact) {
			$strControlId = 'btnEdit' . $this->dtgContact->CurrentRowIndex;

			$btnEdit = $this->objForm->GetControl($strControlId);
			if (!$btnEdit) {
				$btnEdit = new QButton($this->dtgContact, $strControlId);
				$btnEdit->Text = QApplication::Translate('Edit');
				$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
			}

			$btnEdit->ActionParameter = $objContact->ContactId;
			return $btnEdit->Render(false);
		}

		public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
			$strParameterArray = explode(',', $strParameter);
			$objContact = Contact::Load($strParameterArray[0]);

			$objEditPanel = new ContactEditPanel($this, $this->strCloseEditPanelMethod, $objContact);
			
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
			$objEditPanel = new ContactEditPanel($this, $this->strCloseEditPanelMethod, null);
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function dtgContact_Company_Render(Contact $objContact) {
			if (!is_null($objContact->Company))
				return $objContact->Company->__toString();
			else
				return null;
		}

		public function dtgContact_Address_Render(Contact $objContact) {
			if (!is_null($objContact->Address))
				return $objContact->Address->__toString();
			else
				return null;
		}

		public function dtgContact_CreatedByObject_Render(Contact $objContact) {
			if (!is_null($objContact->CreatedByObject))
				return $objContact->CreatedByObject->__toString();
			else
				return null;
		}

		public function dtgContact_CreationDate_Render(Contact $objContact) {
			if (!is_null($objContact->CreationDate))
				return $objContact->CreationDate->__toString(QDateTime::FormatDisplayDateTime);
			else
				return null;
		}

		public function dtgContact_ModifiedByObject_Render(Contact $objContact) {
			if (!is_null($objContact->ModifiedByObject))
				return $objContact->ModifiedByObject->__toString();
			else
				return null;
		}


		public function dtgContact_Bind() {
			// Get Total Count b/c of Pagination
			$this->dtgContact->TotalItemCount = Contact::CountAll();

			$objClauses = array();
			if ($objClause = $this->dtgContact->OrderByClause)
				array_push($objClauses, $objClause);
			if ($objClause = $this->dtgContact->LimitClause)
				array_push($objClauses, $objClause);
			$this->dtgContact->DataSource = Contact::LoadAll($objClauses);
		}
	}
?>