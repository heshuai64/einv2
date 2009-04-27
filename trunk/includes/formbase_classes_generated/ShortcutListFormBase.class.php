<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the Shortcut class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of Shortcut objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this ShortcutListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class ShortcutListFormBase extends QForm {
		protected $dtgShortcut;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colShortcutId;
		protected $colModuleId;
		protected $colAuthorizationId;
		protected $colShortDescription;
		protected $colLink;
		protected $colImagePath;
		protected $colEntityQtypeId;
		protected $colCreateFlag;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgShortcut_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colShortcutId = new QDataGridColumn(QApplication::Translate('Shortcut Id'), '<?= $_ITEM->ShortcutId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Shortcut()->ShortcutId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Shortcut()->ShortcutId, false)));
			$this->colModuleId = new QDataGridColumn(QApplication::Translate('Module Id'), '<?= $_FORM->dtgShortcut_Module_Render($_ITEM); ?>');
			$this->colAuthorizationId = new QDataGridColumn(QApplication::Translate('Authorization Id'), '<?= $_FORM->dtgShortcut_Authorization_Render($_ITEM); ?>');
			$this->colShortDescription = new QDataGridColumn(QApplication::Translate('Short Description'), '<?= QString::Truncate($_ITEM->ShortDescription, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Shortcut()->ShortDescription), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Shortcut()->ShortDescription, false)));
			$this->colLink = new QDataGridColumn(QApplication::Translate('Link'), '<?= QString::Truncate($_ITEM->Link, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Shortcut()->Link), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Shortcut()->Link, false)));
			$this->colImagePath = new QDataGridColumn(QApplication::Translate('Image Path'), '<?= QString::Truncate($_ITEM->ImagePath, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Shortcut()->ImagePath), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Shortcut()->ImagePath, false)));
			$this->colEntityQtypeId = new QDataGridColumn(QApplication::Translate('Entity Qtype'), '<?= $_FORM->dtgShortcut_EntityQtypeId_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Shortcut()->EntityQtypeId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Shortcut()->EntityQtypeId, false)));
			$this->colCreateFlag = new QDataGridColumn(QApplication::Translate('Create Flag'), '<?= ($_ITEM->CreateFlag) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::Shortcut()->CreateFlag), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Shortcut()->CreateFlag, false)));

			// Setup DataGrid
			$this->dtgShortcut = new QDataGrid($this);
			$this->dtgShortcut->CellSpacing = 0;
			$this->dtgShortcut->CellPadding = 4;
			$this->dtgShortcut->BorderStyle = QBorderStyle::Solid;
			$this->dtgShortcut->BorderWidth = 1;
			$this->dtgShortcut->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgShortcut->Paginator = new QPaginator($this->dtgShortcut);
			$this->dtgShortcut->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgShortcut->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgShortcut->SetDataBinder('dtgShortcut_Bind');

			$this->dtgShortcut->AddColumn($this->colEditLinkColumn);
			$this->dtgShortcut->AddColumn($this->colShortcutId);
			$this->dtgShortcut->AddColumn($this->colModuleId);
			$this->dtgShortcut->AddColumn($this->colAuthorizationId);
			$this->dtgShortcut->AddColumn($this->colShortDescription);
			$this->dtgShortcut->AddColumn($this->colLink);
			$this->dtgShortcut->AddColumn($this->colImagePath);
			$this->dtgShortcut->AddColumn($this->colEntityQtypeId);
			$this->dtgShortcut->AddColumn($this->colCreateFlag);
		}
		
		public function dtgShortcut_EditLinkColumn_Render(Shortcut $objShortcut) {
			return sprintf('<a href="shortcut_edit.php?intShortcutId=%s">%s</a>',
				$objShortcut->ShortcutId, 
				QApplication::Translate('Edit'));
		}

		public function dtgShortcut_Module_Render(Shortcut $objShortcut) {
			if (!is_null($objShortcut->Module))
				return $objShortcut->Module->__toString();
			else
				return null;
		}

		public function dtgShortcut_Authorization_Render(Shortcut $objShortcut) {
			if (!is_null($objShortcut->Authorization))
				return $objShortcut->Authorization->__toString();
			else
				return null;
		}

		public function dtgShortcut_EntityQtypeId_Render(Shortcut $objShortcut) {
			if (!is_null($objShortcut->EntityQtypeId))
				return EntityQtype::ToString($objShortcut->EntityQtypeId);
			else
				return null;
		}


		protected function dtgShortcut_Bind() {
			// Because we want to enable pagination AND sorting, we need to setup the $objClauses array to send to LoadAll()

			// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
			$this->dtgShortcut->TotalItemCount = Shortcut::CountAll();

			// Setup the $objClauses Array
			$objClauses = array();

			// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
			// the OrderByClause to the $objClauses array
			if ($objClause = $this->dtgShortcut->OrderByClause)
				array_push($objClauses, $objClause);

			// Add the LimitClause information, as well
			if ($objClause = $this->dtgShortcut->LimitClause)
				array_push($objClauses, $objClause);

			// Set the DataSource to be the array of all Shortcut objects, given the clauses above
			$this->dtgShortcut->DataSource = Shortcut::LoadAll($objClauses);
		}
	}
?>