<?php
	/**
	 * This is the abstract Panel class for the List All functionality
	 * of the Shortcut class.  This code-generated class
	 * contains a datagrid to display an HTML page that can
	 * list a collection of Shortcut objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new QPanel which extends this ShortcutListPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class ShortcutListPanelBase extends QPanel {
		public $dtgShortcut;
		public $btnCreateNew;

		// Callback Method Names
		protected $strSetEditPanelMethod;
		protected $strCloseEditPanelMethod;
		
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
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgShortcut_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colShortcutId = new QDataGridColumn(QApplication::Translate('Shortcut Id'), '<?= $_ITEM->ShortcutId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Shortcut()->ShortcutId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Shortcut()->ShortcutId, false)));
			$this->colModuleId = new QDataGridColumn(QApplication::Translate('Module Id'), '<?= $_CONTROL->ParentControl->dtgShortcut_Module_Render($_ITEM); ?>');
			$this->colAuthorizationId = new QDataGridColumn(QApplication::Translate('Authorization Id'), '<?= $_CONTROL->ParentControl->dtgShortcut_Authorization_Render($_ITEM); ?>');
			$this->colShortDescription = new QDataGridColumn(QApplication::Translate('Short Description'), '<?= QString::Truncate($_ITEM->ShortDescription, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Shortcut()->ShortDescription), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Shortcut()->ShortDescription, false)));
			$this->colLink = new QDataGridColumn(QApplication::Translate('Link'), '<?= QString::Truncate($_ITEM->Link, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Shortcut()->Link), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Shortcut()->Link, false)));
			$this->colImagePath = new QDataGridColumn(QApplication::Translate('Image Path'), '<?= QString::Truncate($_ITEM->ImagePath, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Shortcut()->ImagePath), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Shortcut()->ImagePath, false)));
			$this->colEntityQtypeId = new QDataGridColumn(QApplication::Translate('Entity Qtype'), '<?= $_CONTROL->ParentControl->dtgShortcut_EntityQtypeId_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Shortcut()->EntityQtypeId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Shortcut()->EntityQtypeId, false)));
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
			$this->dtgShortcut->UseAjax = true;

			// Specify the local databind method this datagrid will use
			$this->dtgShortcut->SetDataBinder('dtgShortcut_Bind', $this);

			$this->dtgShortcut->AddColumn($this->colEditLinkColumn);
			$this->dtgShortcut->AddColumn($this->colShortcutId);
			$this->dtgShortcut->AddColumn($this->colModuleId);
			$this->dtgShortcut->AddColumn($this->colAuthorizationId);
			$this->dtgShortcut->AddColumn($this->colShortDescription);
			$this->dtgShortcut->AddColumn($this->colLink);
			$this->dtgShortcut->AddColumn($this->colImagePath);
			$this->dtgShortcut->AddColumn($this->colEntityQtypeId);
			$this->dtgShortcut->AddColumn($this->colCreateFlag);

			// Setup the Create New button
			$this->btnCreateNew = new QButton($this);
			$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('Shortcut');
			$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
		}

		public function dtgShortcut_EditLinkColumn_Render(Shortcut $objShortcut) {
			$strControlId = 'btnEdit' . $this->dtgShortcut->CurrentRowIndex;

			$btnEdit = $this->objForm->GetControl($strControlId);
			if (!$btnEdit) {
				$btnEdit = new QButton($this->dtgShortcut, $strControlId);
				$btnEdit->Text = QApplication::Translate('Edit');
				$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
			}

			$btnEdit->ActionParameter = $objShortcut->ShortcutId;
			return $btnEdit->Render(false);
		}

		public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
			$strParameterArray = explode(',', $strParameter);
			$objShortcut = Shortcut::Load($strParameterArray[0]);

			$objEditPanel = new ShortcutEditPanel($this, $this->strCloseEditPanelMethod, $objShortcut);
			
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
			$objEditPanel = new ShortcutEditPanel($this, $this->strCloseEditPanelMethod, null);
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
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


		public function dtgShortcut_Bind() {
			// Get Total Count b/c of Pagination
			$this->dtgShortcut->TotalItemCount = Shortcut::CountAll();

			$objClauses = array();
			if ($objClause = $this->dtgShortcut->OrderByClause)
				array_push($objClauses, $objClause);
			if ($objClause = $this->dtgShortcut->LimitClause)
				array_push($objClauses, $objClause);
			$this->dtgShortcut->DataSource = Shortcut::LoadAll($objClauses);
		}
	}
?>