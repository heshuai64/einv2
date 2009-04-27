<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the RoleEntityQtypeCustomFieldAuthorization class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of RoleEntityQtypeCustomFieldAuthorization objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this RoleEntityQtypeCustomFieldAuthorizationListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class RoleEntityQtypeCustomFieldAuthorizationListFormBase extends QForm {
		protected $dtgRoleEntityQtypeCustomFieldAuthorization;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colRoleEntityQtypeCustomFieldAuthorizationId;
		protected $colRoleId;
		protected $colEntityQtypeCustomFieldId;
		protected $colAuthorizationId;
		protected $colAuthorizedFlag;
		protected $colCreatedBy;
		protected $colCreationDate;
		protected $colModifiedBy;
		protected $colModifiedDate;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgRoleEntityQtypeCustomFieldAuthorization_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colRoleEntityQtypeCustomFieldAuthorizationId = new QDataGridColumn(QApplication::Translate('Role Entity Qtype Custom Field Authorization Id'), '<?= $_ITEM->RoleEntityQtypeCustomFieldAuthorizationId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::RoleEntityQtypeCustomFieldAuthorization()->RoleEntityQtypeCustomFieldAuthorizationId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::RoleEntityQtypeCustomFieldAuthorization()->RoleEntityQtypeCustomFieldAuthorizationId, false)));
			$this->colRoleId = new QDataGridColumn(QApplication::Translate('Role Id'), '<?= $_FORM->dtgRoleEntityQtypeCustomFieldAuthorization_Role_Render($_ITEM); ?>');
			$this->colEntityQtypeCustomFieldId = new QDataGridColumn(QApplication::Translate('Entity Qtype Custom Field Id'), '<?= $_FORM->dtgRoleEntityQtypeCustomFieldAuthorization_EntityQtypeCustomField_Render($_ITEM); ?>');
			$this->colAuthorizationId = new QDataGridColumn(QApplication::Translate('Authorization Id'), '<?= $_FORM->dtgRoleEntityQtypeCustomFieldAuthorization_Authorization_Render($_ITEM); ?>');
			$this->colAuthorizedFlag = new QDataGridColumn(QApplication::Translate('Authorized Flag'), '<?= ($_ITEM->AuthorizedFlag) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::RoleEntityQtypeCustomFieldAuthorization()->AuthorizedFlag), 'ReverseOrderByClause' => QQ::OrderBy(QQN::RoleEntityQtypeCustomFieldAuthorization()->AuthorizedFlag, false)));
			$this->colCreatedBy = new QDataGridColumn(QApplication::Translate('Created By'), '<?= $_FORM->dtgRoleEntityQtypeCustomFieldAuthorization_CreatedByObject_Render($_ITEM); ?>');
			$this->colCreationDate = new QDataGridColumn(QApplication::Translate('Creation Date'), '<?= $_FORM->dtgRoleEntityQtypeCustomFieldAuthorization_CreationDate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::RoleEntityQtypeCustomFieldAuthorization()->CreationDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::RoleEntityQtypeCustomFieldAuthorization()->CreationDate, false)));
			$this->colModifiedBy = new QDataGridColumn(QApplication::Translate('Modified By'), '<?= $_FORM->dtgRoleEntityQtypeCustomFieldAuthorization_ModifiedByObject_Render($_ITEM); ?>');
			$this->colModifiedDate = new QDataGridColumn(QApplication::Translate('Modified Date'), '<?= QString::Truncate($_ITEM->ModifiedDate, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::RoleEntityQtypeCustomFieldAuthorization()->ModifiedDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::RoleEntityQtypeCustomFieldAuthorization()->ModifiedDate, false)));

			// Setup DataGrid
			$this->dtgRoleEntityQtypeCustomFieldAuthorization = new QDataGrid($this);
			$this->dtgRoleEntityQtypeCustomFieldAuthorization->CellSpacing = 0;
			$this->dtgRoleEntityQtypeCustomFieldAuthorization->CellPadding = 4;
			$this->dtgRoleEntityQtypeCustomFieldAuthorization->BorderStyle = QBorderStyle::Solid;
			$this->dtgRoleEntityQtypeCustomFieldAuthorization->BorderWidth = 1;
			$this->dtgRoleEntityQtypeCustomFieldAuthorization->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgRoleEntityQtypeCustomFieldAuthorization->Paginator = new QPaginator($this->dtgRoleEntityQtypeCustomFieldAuthorization);
			$this->dtgRoleEntityQtypeCustomFieldAuthorization->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgRoleEntityQtypeCustomFieldAuthorization->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgRoleEntityQtypeCustomFieldAuthorization->SetDataBinder('dtgRoleEntityQtypeCustomFieldAuthorization_Bind');

			$this->dtgRoleEntityQtypeCustomFieldAuthorization->AddColumn($this->colEditLinkColumn);
			$this->dtgRoleEntityQtypeCustomFieldAuthorization->AddColumn($this->colRoleEntityQtypeCustomFieldAuthorizationId);
			$this->dtgRoleEntityQtypeCustomFieldAuthorization->AddColumn($this->colRoleId);
			$this->dtgRoleEntityQtypeCustomFieldAuthorization->AddColumn($this->colEntityQtypeCustomFieldId);
			$this->dtgRoleEntityQtypeCustomFieldAuthorization->AddColumn($this->colAuthorizationId);
			$this->dtgRoleEntityQtypeCustomFieldAuthorization->AddColumn($this->colAuthorizedFlag);
			$this->dtgRoleEntityQtypeCustomFieldAuthorization->AddColumn($this->colCreatedBy);
			$this->dtgRoleEntityQtypeCustomFieldAuthorization->AddColumn($this->colCreationDate);
			$this->dtgRoleEntityQtypeCustomFieldAuthorization->AddColumn($this->colModifiedBy);
			$this->dtgRoleEntityQtypeCustomFieldAuthorization->AddColumn($this->colModifiedDate);
		}
		
		public function dtgRoleEntityQtypeCustomFieldAuthorization_EditLinkColumn_Render(RoleEntityQtypeCustomFieldAuthorization $objRoleEntityQtypeCustomFieldAuthorization) {
			return sprintf('<a href="role_entity_qtype_custom_field_authorization_edit.php?intRoleEntityQtypeCustomFieldAuthorizationId=%s">%s</a>',
				$objRoleEntityQtypeCustomFieldAuthorization->RoleEntityQtypeCustomFieldAuthorizationId, 
				QApplication::Translate('Edit'));
		}

		public function dtgRoleEntityQtypeCustomFieldAuthorization_Role_Render(RoleEntityQtypeCustomFieldAuthorization $objRoleEntityQtypeCustomFieldAuthorization) {
			if (!is_null($objRoleEntityQtypeCustomFieldAuthorization->Role))
				return $objRoleEntityQtypeCustomFieldAuthorization->Role->__toString();
			else
				return null;
		}

		public function dtgRoleEntityQtypeCustomFieldAuthorization_EntityQtypeCustomField_Render(RoleEntityQtypeCustomFieldAuthorization $objRoleEntityQtypeCustomFieldAuthorization) {
			if (!is_null($objRoleEntityQtypeCustomFieldAuthorization->EntityQtypeCustomField))
				return $objRoleEntityQtypeCustomFieldAuthorization->EntityQtypeCustomField->__toString();
			else
				return null;
		}

		public function dtgRoleEntityQtypeCustomFieldAuthorization_Authorization_Render(RoleEntityQtypeCustomFieldAuthorization $objRoleEntityQtypeCustomFieldAuthorization) {
			if (!is_null($objRoleEntityQtypeCustomFieldAuthorization->Authorization))
				return $objRoleEntityQtypeCustomFieldAuthorization->Authorization->__toString();
			else
				return null;
		}

		public function dtgRoleEntityQtypeCustomFieldAuthorization_CreatedByObject_Render(RoleEntityQtypeCustomFieldAuthorization $objRoleEntityQtypeCustomFieldAuthorization) {
			if (!is_null($objRoleEntityQtypeCustomFieldAuthorization->CreatedByObject))
				return $objRoleEntityQtypeCustomFieldAuthorization->CreatedByObject->__toString();
			else
				return null;
		}

		public function dtgRoleEntityQtypeCustomFieldAuthorization_CreationDate_Render(RoleEntityQtypeCustomFieldAuthorization $objRoleEntityQtypeCustomFieldAuthorization) {
			if (!is_null($objRoleEntityQtypeCustomFieldAuthorization->CreationDate))
				return $objRoleEntityQtypeCustomFieldAuthorization->CreationDate->__toString(QDateTime::FormatDisplayDateTime);
			else
				return null;
		}

		public function dtgRoleEntityQtypeCustomFieldAuthorization_ModifiedByObject_Render(RoleEntityQtypeCustomFieldAuthorization $objRoleEntityQtypeCustomFieldAuthorization) {
			if (!is_null($objRoleEntityQtypeCustomFieldAuthorization->ModifiedByObject))
				return $objRoleEntityQtypeCustomFieldAuthorization->ModifiedByObject->__toString();
			else
				return null;
		}


		protected function dtgRoleEntityQtypeCustomFieldAuthorization_Bind() {
			// Because we want to enable pagination AND sorting, we need to setup the $objClauses array to send to LoadAll()

			// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
			$this->dtgRoleEntityQtypeCustomFieldAuthorization->TotalItemCount = RoleEntityQtypeCustomFieldAuthorization::CountAll();

			// Setup the $objClauses Array
			$objClauses = array();

			// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
			// the OrderByClause to the $objClauses array
			if ($objClause = $this->dtgRoleEntityQtypeCustomFieldAuthorization->OrderByClause)
				array_push($objClauses, $objClause);

			// Add the LimitClause information, as well
			if ($objClause = $this->dtgRoleEntityQtypeCustomFieldAuthorization->LimitClause)
				array_push($objClauses, $objClause);

			// Set the DataSource to be the array of all RoleEntityQtypeCustomFieldAuthorization objects, given the clauses above
			$this->dtgRoleEntityQtypeCustomFieldAuthorization->DataSource = RoleEntityQtypeCustomFieldAuthorization::LoadAll($objClauses);
		}
	}
?>