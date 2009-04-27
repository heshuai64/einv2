<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the RoleModuleAuthorization class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of RoleModuleAuthorization objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this RoleModuleAuthorizationListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class RoleModuleAuthorizationListFormBase extends QForm {
		protected $dtgRoleModuleAuthorization;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colRoleModuleAuthorizationId;
		protected $colRoleModuleId;
		protected $colAuthorizationId;
		protected $colAuthorizationLevelId;
		protected $colCreatedBy;
		protected $colCreationDate;
		protected $colModifiedBy;
		protected $colModifiedDate;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgRoleModuleAuthorization_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colRoleModuleAuthorizationId = new QDataGridColumn(QApplication::Translate('Role Module Authorization Id'), '<?= $_ITEM->RoleModuleAuthorizationId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::RoleModuleAuthorization()->RoleModuleAuthorizationId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::RoleModuleAuthorization()->RoleModuleAuthorizationId, false)));
			$this->colRoleModuleId = new QDataGridColumn(QApplication::Translate('Role Module Id'), '<?= $_FORM->dtgRoleModuleAuthorization_RoleModule_Render($_ITEM); ?>');
			$this->colAuthorizationId = new QDataGridColumn(QApplication::Translate('Authorization Id'), '<?= $_FORM->dtgRoleModuleAuthorization_Authorization_Render($_ITEM); ?>');
			$this->colAuthorizationLevelId = new QDataGridColumn(QApplication::Translate('Authorization Level Id'), '<?= $_FORM->dtgRoleModuleAuthorization_AuthorizationLevel_Render($_ITEM); ?>');
			$this->colCreatedBy = new QDataGridColumn(QApplication::Translate('Created By'), '<?= $_FORM->dtgRoleModuleAuthorization_CreatedByObject_Render($_ITEM); ?>');
			$this->colCreationDate = new QDataGridColumn(QApplication::Translate('Creation Date'), '<?= $_FORM->dtgRoleModuleAuthorization_CreationDate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::RoleModuleAuthorization()->CreationDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::RoleModuleAuthorization()->CreationDate, false)));
			$this->colModifiedBy = new QDataGridColumn(QApplication::Translate('Modified By'), '<?= $_FORM->dtgRoleModuleAuthorization_ModifiedByObject_Render($_ITEM); ?>');
			$this->colModifiedDate = new QDataGridColumn(QApplication::Translate('Modified Date'), '<?= QString::Truncate($_ITEM->ModifiedDate, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::RoleModuleAuthorization()->ModifiedDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::RoleModuleAuthorization()->ModifiedDate, false)));

			// Setup DataGrid
			$this->dtgRoleModuleAuthorization = new QDataGrid($this);
			$this->dtgRoleModuleAuthorization->CellSpacing = 0;
			$this->dtgRoleModuleAuthorization->CellPadding = 4;
			$this->dtgRoleModuleAuthorization->BorderStyle = QBorderStyle::Solid;
			$this->dtgRoleModuleAuthorization->BorderWidth = 1;
			$this->dtgRoleModuleAuthorization->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgRoleModuleAuthorization->Paginator = new QPaginator($this->dtgRoleModuleAuthorization);
			$this->dtgRoleModuleAuthorization->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgRoleModuleAuthorization->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgRoleModuleAuthorization->SetDataBinder('dtgRoleModuleAuthorization_Bind');

			$this->dtgRoleModuleAuthorization->AddColumn($this->colEditLinkColumn);
			$this->dtgRoleModuleAuthorization->AddColumn($this->colRoleModuleAuthorizationId);
			$this->dtgRoleModuleAuthorization->AddColumn($this->colRoleModuleId);
			$this->dtgRoleModuleAuthorization->AddColumn($this->colAuthorizationId);
			$this->dtgRoleModuleAuthorization->AddColumn($this->colAuthorizationLevelId);
			$this->dtgRoleModuleAuthorization->AddColumn($this->colCreatedBy);
			$this->dtgRoleModuleAuthorization->AddColumn($this->colCreationDate);
			$this->dtgRoleModuleAuthorization->AddColumn($this->colModifiedBy);
			$this->dtgRoleModuleAuthorization->AddColumn($this->colModifiedDate);
		}
		
		public function dtgRoleModuleAuthorization_EditLinkColumn_Render(RoleModuleAuthorization $objRoleModuleAuthorization) {
			return sprintf('<a href="role_module_authorization_edit.php?intRoleModuleAuthorizationId=%s">%s</a>',
				$objRoleModuleAuthorization->RoleModuleAuthorizationId, 
				QApplication::Translate('Edit'));
		}

		public function dtgRoleModuleAuthorization_RoleModule_Render(RoleModuleAuthorization $objRoleModuleAuthorization) {
			if (!is_null($objRoleModuleAuthorization->RoleModule))
				return $objRoleModuleAuthorization->RoleModule->__toString();
			else
				return null;
		}

		public function dtgRoleModuleAuthorization_Authorization_Render(RoleModuleAuthorization $objRoleModuleAuthorization) {
			if (!is_null($objRoleModuleAuthorization->Authorization))
				return $objRoleModuleAuthorization->Authorization->__toString();
			else
				return null;
		}

		public function dtgRoleModuleAuthorization_AuthorizationLevel_Render(RoleModuleAuthorization $objRoleModuleAuthorization) {
			if (!is_null($objRoleModuleAuthorization->AuthorizationLevel))
				return $objRoleModuleAuthorization->AuthorizationLevel->__toString();
			else
				return null;
		}

		public function dtgRoleModuleAuthorization_CreatedByObject_Render(RoleModuleAuthorization $objRoleModuleAuthorization) {
			if (!is_null($objRoleModuleAuthorization->CreatedByObject))
				return $objRoleModuleAuthorization->CreatedByObject->__toString();
			else
				return null;
		}

		public function dtgRoleModuleAuthorization_CreationDate_Render(RoleModuleAuthorization $objRoleModuleAuthorization) {
			if (!is_null($objRoleModuleAuthorization->CreationDate))
				return $objRoleModuleAuthorization->CreationDate->__toString(QDateTime::FormatDisplayDateTime);
			else
				return null;
		}

		public function dtgRoleModuleAuthorization_ModifiedByObject_Render(RoleModuleAuthorization $objRoleModuleAuthorization) {
			if (!is_null($objRoleModuleAuthorization->ModifiedByObject))
				return $objRoleModuleAuthorization->ModifiedByObject->__toString();
			else
				return null;
		}


		protected function dtgRoleModuleAuthorization_Bind() {
			// Because we want to enable pagination AND sorting, we need to setup the $objClauses array to send to LoadAll()

			// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
			$this->dtgRoleModuleAuthorization->TotalItemCount = RoleModuleAuthorization::CountAll();

			// Setup the $objClauses Array
			$objClauses = array();

			// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
			// the OrderByClause to the $objClauses array
			if ($objClause = $this->dtgRoleModuleAuthorization->OrderByClause)
				array_push($objClauses, $objClause);

			// Add the LimitClause information, as well
			if ($objClause = $this->dtgRoleModuleAuthorization->LimitClause)
				array_push($objClauses, $objClause);

			// Set the DataSource to be the array of all RoleModuleAuthorization objects, given the clauses above
			$this->dtgRoleModuleAuthorization->DataSource = RoleModuleAuthorization::LoadAll($objClauses);
		}
	}
?>