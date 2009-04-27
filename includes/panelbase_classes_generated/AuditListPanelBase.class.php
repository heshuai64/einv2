<?php
	/**
	 * This is the abstract Panel class for the List All functionality
	 * of the Audit class.  This code-generated class
	 * contains a datagrid to display an HTML page that can
	 * list a collection of Audit objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new QPanel which extends this AuditListPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class AuditListPanelBase extends QPanel {
		public $dtgAudit;
		public $btnCreateNew;

		// Callback Method Names
		protected $strSetEditPanelMethod;
		protected $strCloseEditPanelMethod;
		
		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colAuditId;
		protected $colEntityQtypeId;
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
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgAudit_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colAuditId = new QDataGridColumn(QApplication::Translate('Audit Id'), '<?= $_ITEM->AuditId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Audit()->AuditId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Audit()->AuditId, false)));
			$this->colEntityQtypeId = new QDataGridColumn(QApplication::Translate('Entity Qtype'), '<?= $_CONTROL->ParentControl->dtgAudit_EntityQtypeId_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Audit()->EntityQtypeId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Audit()->EntityQtypeId, false)));
			$this->colCreatedBy = new QDataGridColumn(QApplication::Translate('Created By'), '<?= $_CONTROL->ParentControl->dtgAudit_CreatedByObject_Render($_ITEM); ?>');
			$this->colCreationDate = new QDataGridColumn(QApplication::Translate('Creation Date'), '<?= $_CONTROL->ParentControl->dtgAudit_CreationDate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Audit()->CreationDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Audit()->CreationDate, false)));
			$this->colModifiedBy = new QDataGridColumn(QApplication::Translate('Modified By'), '<?= $_CONTROL->ParentControl->dtgAudit_ModifiedByObject_Render($_ITEM); ?>');
			$this->colModifiedDate = new QDataGridColumn(QApplication::Translate('Modified Date'), '<?= QString::Truncate($_ITEM->ModifiedDate, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Audit()->ModifiedDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Audit()->ModifiedDate, false)));

			// Setup DataGrid
			$this->dtgAudit = new QDataGrid($this);
			$this->dtgAudit->CellSpacing = 0;
			$this->dtgAudit->CellPadding = 4;
			$this->dtgAudit->BorderStyle = QBorderStyle::Solid;
			$this->dtgAudit->BorderWidth = 1;
			$this->dtgAudit->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgAudit->Paginator = new QPaginator($this->dtgAudit);
			$this->dtgAudit->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgAudit->UseAjax = true;

			// Specify the local databind method this datagrid will use
			$this->dtgAudit->SetDataBinder('dtgAudit_Bind', $this);

			$this->dtgAudit->AddColumn($this->colEditLinkColumn);
			$this->dtgAudit->AddColumn($this->colAuditId);
			$this->dtgAudit->AddColumn($this->colEntityQtypeId);
			$this->dtgAudit->AddColumn($this->colCreatedBy);
			$this->dtgAudit->AddColumn($this->colCreationDate);
			$this->dtgAudit->AddColumn($this->colModifiedBy);
			$this->dtgAudit->AddColumn($this->colModifiedDate);

			// Setup the Create New button
			$this->btnCreateNew = new QButton($this);
			$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('Audit');
			$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
		}

		public function dtgAudit_EditLinkColumn_Render(Audit $objAudit) {
			$strControlId = 'btnEdit' . $this->dtgAudit->CurrentRowIndex;

			$btnEdit = $this->objForm->GetControl($strControlId);
			if (!$btnEdit) {
				$btnEdit = new QButton($this->dtgAudit, $strControlId);
				$btnEdit->Text = QApplication::Translate('Edit');
				$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
			}

			$btnEdit->ActionParameter = $objAudit->AuditId;
			return $btnEdit->Render(false);
		}

		public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
			$strParameterArray = explode(',', $strParameter);
			$objAudit = Audit::Load($strParameterArray[0]);

			$objEditPanel = new AuditEditPanel($this, $this->strCloseEditPanelMethod, $objAudit);
			
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
			$objEditPanel = new AuditEditPanel($this, $this->strCloseEditPanelMethod, null);
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function dtgAudit_EntityQtypeId_Render(Audit $objAudit) {
			if (!is_null($objAudit->EntityQtypeId))
				return EntityQtype::ToString($objAudit->EntityQtypeId);
			else
				return null;
		}

		public function dtgAudit_CreatedByObject_Render(Audit $objAudit) {
			if (!is_null($objAudit->CreatedByObject))
				return $objAudit->CreatedByObject->__toString();
			else
				return null;
		}

		public function dtgAudit_CreationDate_Render(Audit $objAudit) {
			if (!is_null($objAudit->CreationDate))
				return $objAudit->CreationDate->__toString(QDateTime::FormatDisplayDateTime);
			else
				return null;
		}

		public function dtgAudit_ModifiedByObject_Render(Audit $objAudit) {
			if (!is_null($objAudit->ModifiedByObject))
				return $objAudit->ModifiedByObject->__toString();
			else
				return null;
		}


		public function dtgAudit_Bind() {
			// Get Total Count b/c of Pagination
			$this->dtgAudit->TotalItemCount = Audit::CountAll();

			$objClauses = array();
			if ($objClause = $this->dtgAudit->OrderByClause)
				array_push($objClauses, $objClause);
			if ($objClause = $this->dtgAudit->LimitClause)
				array_push($objClauses, $objClause);
			$this->dtgAudit->DataSource = Audit::LoadAll($objClauses);
		}
	}
?>