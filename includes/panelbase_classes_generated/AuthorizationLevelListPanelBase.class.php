<?php
	/**
	 * This is the abstract Panel class for the List All functionality
	 * of the AuthorizationLevel class.  This code-generated class
	 * contains a datagrid to display an HTML page that can
	 * list a collection of AuthorizationLevel objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new QPanel which extends this AuthorizationLevelListPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class AuthorizationLevelListPanelBase extends QPanel {
		public $dtgAuthorizationLevel;
		public $btnCreateNew;

		// Callback Method Names
		protected $strSetEditPanelMethod;
		protected $strCloseEditPanelMethod;
		
		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colAuthorizationLevelId;
		protected $colShortDescription;

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
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgAuthorizationLevel_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colAuthorizationLevelId = new QDataGridColumn(QApplication::Translate('Authorization Level Id'), '<?= $_ITEM->AuthorizationLevelId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::AuthorizationLevel()->AuthorizationLevelId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::AuthorizationLevel()->AuthorizationLevelId, false)));
			$this->colShortDescription = new QDataGridColumn(QApplication::Translate('Short Description'), '<?= QString::Truncate($_ITEM->ShortDescription, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::AuthorizationLevel()->ShortDescription), 'ReverseOrderByClause' => QQ::OrderBy(QQN::AuthorizationLevel()->ShortDescription, false)));

			// Setup DataGrid
			$this->dtgAuthorizationLevel = new QDataGrid($this);
			$this->dtgAuthorizationLevel->CellSpacing = 0;
			$this->dtgAuthorizationLevel->CellPadding = 4;
			$this->dtgAuthorizationLevel->BorderStyle = QBorderStyle::Solid;
			$this->dtgAuthorizationLevel->BorderWidth = 1;
			$this->dtgAuthorizationLevel->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgAuthorizationLevel->Paginator = new QPaginator($this->dtgAuthorizationLevel);
			$this->dtgAuthorizationLevel->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgAuthorizationLevel->UseAjax = true;

			// Specify the local databind method this datagrid will use
			$this->dtgAuthorizationLevel->SetDataBinder('dtgAuthorizationLevel_Bind', $this);

			$this->dtgAuthorizationLevel->AddColumn($this->colEditLinkColumn);
			$this->dtgAuthorizationLevel->AddColumn($this->colAuthorizationLevelId);
			$this->dtgAuthorizationLevel->AddColumn($this->colShortDescription);

			// Setup the Create New button
			$this->btnCreateNew = new QButton($this);
			$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('AuthorizationLevel');
			$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
		}

		public function dtgAuthorizationLevel_EditLinkColumn_Render(AuthorizationLevel $objAuthorizationLevel) {
			$strControlId = 'btnEdit' . $this->dtgAuthorizationLevel->CurrentRowIndex;

			$btnEdit = $this->objForm->GetControl($strControlId);
			if (!$btnEdit) {
				$btnEdit = new QButton($this->dtgAuthorizationLevel, $strControlId);
				$btnEdit->Text = QApplication::Translate('Edit');
				$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
			}

			$btnEdit->ActionParameter = $objAuthorizationLevel->AuthorizationLevelId;
			return $btnEdit->Render(false);
		}

		public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
			$strParameterArray = explode(',', $strParameter);
			$objAuthorizationLevel = AuthorizationLevel::Load($strParameterArray[0]);

			$objEditPanel = new AuthorizationLevelEditPanel($this, $this->strCloseEditPanelMethod, $objAuthorizationLevel);
			
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
			$objEditPanel = new AuthorizationLevelEditPanel($this, $this->strCloseEditPanelMethod, null);
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}


		public function dtgAuthorizationLevel_Bind() {
			// Get Total Count b/c of Pagination
			$this->dtgAuthorizationLevel->TotalItemCount = AuthorizationLevel::CountAll();

			$objClauses = array();
			if ($objClause = $this->dtgAuthorizationLevel->OrderByClause)
				array_push($objClauses, $objClause);
			if ($objClause = $this->dtgAuthorizationLevel->LimitClause)
				array_push($objClauses, $objClause);
			$this->dtgAuthorizationLevel->DataSource = AuthorizationLevel::LoadAll($objClauses);
		}
	}
?>