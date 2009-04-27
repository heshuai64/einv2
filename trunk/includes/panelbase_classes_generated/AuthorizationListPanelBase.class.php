<?php
	/**
	 * This is the abstract Panel class for the List All functionality
	 * of the Authorization class.  This code-generated class
	 * contains a datagrid to display an HTML page that can
	 * list a collection of Authorization objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new QPanel which extends this AuthorizationListPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class AuthorizationListPanelBase extends QPanel {
		public $dtgAuthorization;
		public $btnCreateNew;

		// Callback Method Names
		protected $strSetEditPanelMethod;
		protected $strCloseEditPanelMethod;
		
		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colAuthorizationId;
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
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgAuthorization_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colAuthorizationId = new QDataGridColumn(QApplication::Translate('Authorization Id'), '<?= $_ITEM->AuthorizationId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Authorization()->AuthorizationId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Authorization()->AuthorizationId, false)));
			$this->colShortDescription = new QDataGridColumn(QApplication::Translate('Short Description'), '<?= QString::Truncate($_ITEM->ShortDescription, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Authorization()->ShortDescription), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Authorization()->ShortDescription, false)));

			// Setup DataGrid
			$this->dtgAuthorization = new QDataGrid($this);
			$this->dtgAuthorization->CellSpacing = 0;
			$this->dtgAuthorization->CellPadding = 4;
			$this->dtgAuthorization->BorderStyle = QBorderStyle::Solid;
			$this->dtgAuthorization->BorderWidth = 1;
			$this->dtgAuthorization->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgAuthorization->Paginator = new QPaginator($this->dtgAuthorization);
			$this->dtgAuthorization->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgAuthorization->UseAjax = true;

			// Specify the local databind method this datagrid will use
			$this->dtgAuthorization->SetDataBinder('dtgAuthorization_Bind', $this);

			$this->dtgAuthorization->AddColumn($this->colEditLinkColumn);
			$this->dtgAuthorization->AddColumn($this->colAuthorizationId);
			$this->dtgAuthorization->AddColumn($this->colShortDescription);

			// Setup the Create New button
			$this->btnCreateNew = new QButton($this);
			$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('Authorization');
			$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
		}

		public function dtgAuthorization_EditLinkColumn_Render(Authorization $objAuthorization) {
			$strControlId = 'btnEdit' . $this->dtgAuthorization->CurrentRowIndex;

			$btnEdit = $this->objForm->GetControl($strControlId);
			if (!$btnEdit) {
				$btnEdit = new QButton($this->dtgAuthorization, $strControlId);
				$btnEdit->Text = QApplication::Translate('Edit');
				$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
			}

			$btnEdit->ActionParameter = $objAuthorization->AuthorizationId;
			return $btnEdit->Render(false);
		}

		public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
			$strParameterArray = explode(',', $strParameter);
			$objAuthorization = Authorization::Load($strParameterArray[0]);

			$objEditPanel = new AuthorizationEditPanel($this, $this->strCloseEditPanelMethod, $objAuthorization);
			
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
			$objEditPanel = new AuthorizationEditPanel($this, $this->strCloseEditPanelMethod, null);
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}


		public function dtgAuthorization_Bind() {
			// Get Total Count b/c of Pagination
			$this->dtgAuthorization->TotalItemCount = Authorization::CountAll();

			$objClauses = array();
			if ($objClause = $this->dtgAuthorization->OrderByClause)
				array_push($objClauses, $objClause);
			if ($objClause = $this->dtgAuthorization->LimitClause)
				array_push($objClauses, $objClause);
			$this->dtgAuthorization->DataSource = Authorization::LoadAll($objClauses);
		}
	}
?>