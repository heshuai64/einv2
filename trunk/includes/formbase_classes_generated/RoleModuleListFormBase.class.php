<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the RoleModule class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of RoleModule objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this RoleModuleListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class RoleModuleListFormBase extends QForm {
		protected $dtgRoleModule;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colRoleModuleId;
		protected $colRoleId;
		protected $colModuleId;
		protected $colAccessFlag;
		protected $colCreatedBy;
		protected $colCreationDate;
		protected $colModifiedBy;
		protected $colModifiedDate;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgRoleModule_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colRoleModuleId = new QDataGridColumn(QApplication::Translate('Role Module Id'), '<?= $_ITEM->RoleModuleId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::RoleModule()->RoleModuleId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::RoleModule()->RoleModuleId, false)));
			$this->colRoleId = new QDataGridColumn(QApplication::Translate('Role Id'), '<?= $_FORM->dtgRoleModule_Role_Render($_ITEM); ?>');
			$this->colModuleId = new QDataGridColumn(QApplication::Translate('Module Id'), '<?= $_FORM->dtgRoleModule_Module_Render($_ITEM); ?>');
			$this->colAccessFlag = new QDataGridColumn(QApplication::Translate('Access Flag'), '<?= ($_ITEM->AccessFlag) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::RoleModule()->AccessFlag), 'ReverseOrderByClause' => QQ::OrderBy(QQN::RoleModule()->AccessFlag, false)));
			$this->colCreatedBy = new QDataGridColumn(QApplication::Translate('Created By'), '<?= $_FORM->dtgRoleModule_CreatedByObject_Render($_ITEM); ?>');
			$this->colCreationDate = new QDataGridColumn(QApplication::Translate('Creation Date'), '<?= $_FORM->dtgRoleModule_CreationDate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::RoleModule()->CreationDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::RoleModule()->CreationDate, false)));
			$this->colModifiedBy = new QDataGridColumn(QApplication::Translate('Modified By'), '<?= $_FORM->dtgRoleModule_ModifiedByObject_Render($_ITEM); ?>');
			$this->colModifiedDate = new QDataGridColumn(QApplication::Translate('Modified Date'), '<?= QString::Truncate($_ITEM->ModifiedDate, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::RoleModule()->ModifiedDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::RoleModule()->ModifiedDate, false)));

			// Setup DataGrid
			$this->dtgRoleModule = new QDataGrid($this);
			$this->dtgRoleModule->CellSpacing = 0;
			$this->dtgRoleModule->CellPadding = 4;
			$this->dtgRoleModule->BorderStyle = QBorderStyle::Solid;
			$this->dtgRoleModule->BorderWidth = 1;
			$this->dtgRoleModule->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgRoleModule->Paginator = new QPaginator($this->dtgRoleModule);
			$this->dtgRoleModule->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgRoleModule->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgRoleModule->SetDataBinder('dtgRoleModule_Bind');

			$this->dtgRoleModule->AddColumn($this->colEditLinkColumn);
			$this->dtgRoleModule->AddColumn($this->colRoleModuleId);
			$this->dtgRoleModule->AddColumn($this->colRoleId);
			$this->dtgRoleModule->AddColumn($this->colModuleId);
			$this->dtgRoleModule->AddColumn($this->colAccessFlag);
			$this->dtgRoleModule->AddColumn($this->colCreatedBy);
			$this->dtgRoleModule->AddColumn($this->colCreationDate);
			$this->dtgRoleModule->AddColumn($this->colModifiedBy);
			$this->dtgRoleModule->AddColumn($this->colModifiedDate);
		}
		
		public function dtgRoleModule_EditLinkColumn_Render(RoleModule $objRoleModule) {
			return sprintf('<a href="role_module_edit.php?intRoleModuleId=%s">%s</a>',
				$objRoleModule->RoleModuleId, 
				QApplication::Translate('Edit'));
		}

		public function dtgRoleModule_Role_Render(RoleModule $objRoleModule) {
			if (!is_null($objRoleModule->Role))
				return $objRoleModule->Role->__toString();
			else
				return null;
		}

		public function dtgRoleModule_Module_Render(RoleModule $objRoleModule) {
			if (!is_null($objRoleModule->Module))
				return $objRoleModule->Module->__toString();
			else
				return null;
		}

		public function dtgRoleModule_CreatedByObject_Render(RoleModule $objRoleModule) {
			if (!is_null($objRoleModule->CreatedByObject))
				return $objRoleModule->CreatedByObject->__toString();
			else
				return null;
		}

		public function dtgRoleModule_CreationDate_Render(RoleModule $objRoleModule) {
			if (!is_null($objRoleModule->CreationDate))
				return $objRoleModule->CreationDate->__toString(QDateTime::FormatDisplayDateTime);
			else
				return null;
		}

		public function dtgRoleModule_ModifiedByObject_Render(RoleModule $objRoleModule) {
			if (!is_null($objRoleModule->ModifiedByObject))
				return $objRoleModule->ModifiedByObject->__toString();
			else
				return null;
		}


		protected function dtgRoleModule_Bind() {
			// Because we want to enable pagination AND sorting, we need to setup the $objClauses array to send to LoadAll()

			// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
			$this->dtgRoleModule->TotalItemCount = RoleModule::CountAll();

			// Setup the $objClauses Array
			$objClauses = array();

			// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
			// the OrderByClause to the $objClauses array
			if ($objClause = $this->dtgRoleModule->OrderByClause)
				array_push($objClauses, $objClause);

			// Add the LimitClause information, as well
			if ($objClause = $this->dtgRoleModule->LimitClause)
				array_push($objClauses, $objClause);

			// Set the DataSource to be the array of all RoleModule objects, given the clauses above
			$this->dtgRoleModule->DataSource = RoleModule::LoadAll($objClauses);
		}
	}
?>