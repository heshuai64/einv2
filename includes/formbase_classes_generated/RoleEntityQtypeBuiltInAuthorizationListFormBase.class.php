<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the RoleEntityQtypeBuiltInAuthorization class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of RoleEntityQtypeBuiltInAuthorization objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this RoleEntityQtypeBuiltInAuthorizationListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class RoleEntityQtypeBuiltInAuthorizationListFormBase extends QForm {
		protected $dtgRoleEntityQtypeBuiltInAuthorization;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colRoleEntityBuiltInId;
		protected $colRoleId;
		protected $colEntityQtypeId;
		protected $colAuthorizationId;
		protected $colAuthorizedFlag;
		protected $colCreatedBy;
		protected $colCreationDate;
		protected $colModifiedBy;
		protected $colModifiedDate;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgRoleEntityQtypeBuiltInAuthorization_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colRoleEntityBuiltInId = new QDataGridColumn(QApplication::Translate('Role Entity Built In Id'), '<?= $_ITEM->RoleEntityBuiltInId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::RoleEntityQtypeBuiltInAuthorization()->RoleEntityBuiltInId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::RoleEntityQtypeBuiltInAuthorization()->RoleEntityBuiltInId, false)));
			$this->colRoleId = new QDataGridColumn(QApplication::Translate('Role Id'), '<?= $_FORM->dtgRoleEntityQtypeBuiltInAuthorization_Role_Render($_ITEM); ?>');
			$this->colEntityQtypeId = new QDataGridColumn(QApplication::Translate('Entity Qtype'), '<?= $_FORM->dtgRoleEntityQtypeBuiltInAuthorization_EntityQtypeId_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::RoleEntityQtypeBuiltInAuthorization()->EntityQtypeId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::RoleEntityQtypeBuiltInAuthorization()->EntityQtypeId, false)));
			$this->colAuthorizationId = new QDataGridColumn(QApplication::Translate('Authorization Id'), '<?= $_FORM->dtgRoleEntityQtypeBuiltInAuthorization_Authorization_Render($_ITEM); ?>');
			$this->colAuthorizedFlag = new QDataGridColumn(QApplication::Translate('Authorized Flag'), '<?= ($_ITEM->AuthorizedFlag) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::RoleEntityQtypeBuiltInAuthorization()->AuthorizedFlag), 'ReverseOrderByClause' => QQ::OrderBy(QQN::RoleEntityQtypeBuiltInAuthorization()->AuthorizedFlag, false)));
			$this->colCreatedBy = new QDataGridColumn(QApplication::Translate('Created By'), '<?= $_FORM->dtgRoleEntityQtypeBuiltInAuthorization_CreatedByObject_Render($_ITEM); ?>');
			$this->colCreationDate = new QDataGridColumn(QApplication::Translate('Creation Date'), '<?= $_FORM->dtgRoleEntityQtypeBuiltInAuthorization_CreationDate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::RoleEntityQtypeBuiltInAuthorization()->CreationDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::RoleEntityQtypeBuiltInAuthorization()->CreationDate, false)));
			$this->colModifiedBy = new QDataGridColumn(QApplication::Translate('Modified By'), '<?= $_FORM->dtgRoleEntityQtypeBuiltInAuthorization_ModifiedByObject_Render($_ITEM); ?>');
			$this->colModifiedDate = new QDataGridColumn(QApplication::Translate('Modified Date'), '<?= QString::Truncate($_ITEM->ModifiedDate, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::RoleEntityQtypeBuiltInAuthorization()->ModifiedDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::RoleEntityQtypeBuiltInAuthorization()->ModifiedDate, false)));

			// Setup DataGrid
			$this->dtgRoleEntityQtypeBuiltInAuthorization = new QDataGrid($this);
			$this->dtgRoleEntityQtypeBuiltInAuthorization->CellSpacing = 0;
			$this->dtgRoleEntityQtypeBuiltInAuthorization->CellPadding = 4;
			$this->dtgRoleEntityQtypeBuiltInAuthorization->BorderStyle = QBorderStyle::Solid;
			$this->dtgRoleEntityQtypeBuiltInAuthorization->BorderWidth = 1;
			$this->dtgRoleEntityQtypeBuiltInAuthorization->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgRoleEntityQtypeBuiltInAuthorization->Paginator = new QPaginator($this->dtgRoleEntityQtypeBuiltInAuthorization);
			$this->dtgRoleEntityQtypeBuiltInAuthorization->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgRoleEntityQtypeBuiltInAuthorization->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgRoleEntityQtypeBuiltInAuthorization->SetDataBinder('dtgRoleEntityQtypeBuiltInAuthorization_Bind');

			$this->dtgRoleEntityQtypeBuiltInAuthorization->AddColumn($this->colEditLinkColumn);
			$this->dtgRoleEntityQtypeBuiltInAuthorization->AddColumn($this->colRoleEntityBuiltInId);
			$this->dtgRoleEntityQtypeBuiltInAuthorization->AddColumn($this->colRoleId);
			$this->dtgRoleEntityQtypeBuiltInAuthorization->AddColumn($this->colEntityQtypeId);
			$this->dtgRoleEntityQtypeBuiltInAuthorization->AddColumn($this->colAuthorizationId);
			$this->dtgRoleEntityQtypeBuiltInAuthorization->AddColumn($this->colAuthorizedFlag);
			$this->dtgRoleEntityQtypeBuiltInAuthorization->AddColumn($this->colCreatedBy);
			$this->dtgRoleEntityQtypeBuiltInAuthorization->AddColumn($this->colCreationDate);
			$this->dtgRoleEntityQtypeBuiltInAuthorization->AddColumn($this->colModifiedBy);
			$this->dtgRoleEntityQtypeBuiltInAuthorization->AddColumn($this->colModifiedDate);
		}
		
		public function dtgRoleEntityQtypeBuiltInAuthorization_EditLinkColumn_Render(RoleEntityQtypeBuiltInAuthorization $objRoleEntityQtypeBuiltInAuthorization) {
			return sprintf('<a href="role_entity_qtype_built_in_authorization_edit.php?intRoleEntityBuiltInId=%s">%s</a>',
				$objRoleEntityQtypeBuiltInAuthorization->RoleEntityBuiltInId, 
				QApplication::Translate('Edit'));
		}

		public function dtgRoleEntityQtypeBuiltInAuthorization_Role_Render(RoleEntityQtypeBuiltInAuthorization $objRoleEntityQtypeBuiltInAuthorization) {
			if (!is_null($objRoleEntityQtypeBuiltInAuthorization->Role))
				return $objRoleEntityQtypeBuiltInAuthorization->Role->__toString();
			else
				return null;
		}

		public function dtgRoleEntityQtypeBuiltInAuthorization_EntityQtypeId_Render(RoleEntityQtypeBuiltInAuthorization $objRoleEntityQtypeBuiltInAuthorization) {
			if (!is_null($objRoleEntityQtypeBuiltInAuthorization->EntityQtypeId))
				return EntityQtype::ToString($objRoleEntityQtypeBuiltInAuthorization->EntityQtypeId);
			else
				return null;
		}

		public function dtgRoleEntityQtypeBuiltInAuthorization_Authorization_Render(RoleEntityQtypeBuiltInAuthorization $objRoleEntityQtypeBuiltInAuthorization) {
			if (!is_null($objRoleEntityQtypeBuiltInAuthorization->Authorization))
				return $objRoleEntityQtypeBuiltInAuthorization->Authorization->__toString();
			else
				return null;
		}

		public function dtgRoleEntityQtypeBuiltInAuthorization_CreatedByObject_Render(RoleEntityQtypeBuiltInAuthorization $objRoleEntityQtypeBuiltInAuthorization) {
			if (!is_null($objRoleEntityQtypeBuiltInAuthorization->CreatedByObject))
				return $objRoleEntityQtypeBuiltInAuthorization->CreatedByObject->__toString();
			else
				return null;
		}

		public function dtgRoleEntityQtypeBuiltInAuthorization_CreationDate_Render(RoleEntityQtypeBuiltInAuthorization $objRoleEntityQtypeBuiltInAuthorization) {
			if (!is_null($objRoleEntityQtypeBuiltInAuthorization->CreationDate))
				return $objRoleEntityQtypeBuiltInAuthorization->CreationDate->__toString(QDateTime::FormatDisplayDateTime);
			else
				return null;
		}

		public function dtgRoleEntityQtypeBuiltInAuthorization_ModifiedByObject_Render(RoleEntityQtypeBuiltInAuthorization $objRoleEntityQtypeBuiltInAuthorization) {
			if (!is_null($objRoleEntityQtypeBuiltInAuthorization->ModifiedByObject))
				return $objRoleEntityQtypeBuiltInAuthorization->ModifiedByObject->__toString();
			else
				return null;
		}


		protected function dtgRoleEntityQtypeBuiltInAuthorization_Bind() {
			// Because we want to enable pagination AND sorting, we need to setup the $objClauses array to send to LoadAll()

			// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
			$this->dtgRoleEntityQtypeBuiltInAuthorization->TotalItemCount = RoleEntityQtypeBuiltInAuthorization::CountAll();

			// Setup the $objClauses Array
			$objClauses = array();

			// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
			// the OrderByClause to the $objClauses array
			if ($objClause = $this->dtgRoleEntityQtypeBuiltInAuthorization->OrderByClause)
				array_push($objClauses, $objClause);

			// Add the LimitClause information, as well
			if ($objClause = $this->dtgRoleEntityQtypeBuiltInAuthorization->LimitClause)
				array_push($objClauses, $objClause);

			// Set the DataSource to be the array of all RoleEntityQtypeBuiltInAuthorization objects, given the clauses above
			$this->dtgRoleEntityQtypeBuiltInAuthorization->DataSource = RoleEntityQtypeBuiltInAuthorization::LoadAll($objClauses);
		}
	}
?>