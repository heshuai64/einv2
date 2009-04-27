<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the Module class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of Module objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this ModuleListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class ModuleListFormBase extends QForm {
		protected $dtgModule;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colModuleId;
		protected $colShortDescription;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgModule_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colModuleId = new QDataGridColumn(QApplication::Translate('Module Id'), '<?= $_ITEM->ModuleId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Module()->ModuleId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Module()->ModuleId, false)));
			$this->colShortDescription = new QDataGridColumn(QApplication::Translate('Short Description'), '<?= QString::Truncate($_ITEM->ShortDescription, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Module()->ShortDescription), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Module()->ShortDescription, false)));

			// Setup DataGrid
			$this->dtgModule = new QDataGrid($this);
			$this->dtgModule->CellSpacing = 0;
			$this->dtgModule->CellPadding = 4;
			$this->dtgModule->BorderStyle = QBorderStyle::Solid;
			$this->dtgModule->BorderWidth = 1;
			$this->dtgModule->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgModule->Paginator = new QPaginator($this->dtgModule);
			$this->dtgModule->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgModule->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgModule->SetDataBinder('dtgModule_Bind');

			$this->dtgModule->AddColumn($this->colEditLinkColumn);
			$this->dtgModule->AddColumn($this->colModuleId);
			$this->dtgModule->AddColumn($this->colShortDescription);
		}
		
		public function dtgModule_EditLinkColumn_Render(Module $objModule) {
			return sprintf('<a href="module_edit.php?intModuleId=%s">%s</a>',
				$objModule->ModuleId, 
				QApplication::Translate('Edit'));
		}


		protected function dtgModule_Bind() {
			// Because we want to enable pagination AND sorting, we need to setup the $objClauses array to send to LoadAll()

			// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
			$this->dtgModule->TotalItemCount = Module::CountAll();

			// Setup the $objClauses Array
			$objClauses = array();

			// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
			// the OrderByClause to the $objClauses array
			if ($objClause = $this->dtgModule->OrderByClause)
				array_push($objClauses, $objClause);

			// Add the LimitClause information, as well
			if ($objClause = $this->dtgModule->LimitClause)
				array_push($objClauses, $objClause);

			// Set the DataSource to be the array of all Module objects, given the clauses above
			$this->dtgModule->DataSource = Module::LoadAll($objClauses);
		}
	}
?>