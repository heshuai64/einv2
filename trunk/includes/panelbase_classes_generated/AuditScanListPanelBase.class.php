<?php
	/**
	 * This is the abstract Panel class for the List All functionality
	 * of the AuditScan class.  This code-generated class
	 * contains a datagrid to display an HTML page that can
	 * list a collection of AuditScan objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new QPanel which extends this AuditScanListPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class AuditScanListPanelBase extends QPanel {
		public $dtgAuditScan;
		public $btnCreateNew;

		// Callback Method Names
		protected $strSetEditPanelMethod;
		protected $strCloseEditPanelMethod;
		
		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colAuditScanId;
		protected $colAuditId;
		protected $colLocationId;
		protected $colEntityId;
		protected $colCount;
		protected $colSystemCount;

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
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgAuditScan_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colAuditScanId = new QDataGridColumn(QApplication::Translate('Audit Scan Id'), '<?= $_ITEM->AuditScanId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::AuditScan()->AuditScanId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::AuditScan()->AuditScanId, false)));
			$this->colAuditId = new QDataGridColumn(QApplication::Translate('Audit Id'), '<?= $_CONTROL->ParentControl->dtgAuditScan_Audit_Render($_ITEM); ?>');
			$this->colLocationId = new QDataGridColumn(QApplication::Translate('Location Id'), '<?= $_CONTROL->ParentControl->dtgAuditScan_Location_Render($_ITEM); ?>');
			$this->colEntityId = new QDataGridColumn(QApplication::Translate('Entity Id'), '<?= $_ITEM->EntityId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::AuditScan()->EntityId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::AuditScan()->EntityId, false)));
			$this->colCount = new QDataGridColumn(QApplication::Translate('Count'), '<?= $_ITEM->Count; ?>', array('OrderByClause' => QQ::OrderBy(QQN::AuditScan()->Count), 'ReverseOrderByClause' => QQ::OrderBy(QQN::AuditScan()->Count, false)));
			$this->colSystemCount = new QDataGridColumn(QApplication::Translate('System Count'), '<?= $_ITEM->SystemCount; ?>', array('OrderByClause' => QQ::OrderBy(QQN::AuditScan()->SystemCount), 'ReverseOrderByClause' => QQ::OrderBy(QQN::AuditScan()->SystemCount, false)));

			// Setup DataGrid
			$this->dtgAuditScan = new QDataGrid($this);
			$this->dtgAuditScan->CellSpacing = 0;
			$this->dtgAuditScan->CellPadding = 4;
			$this->dtgAuditScan->BorderStyle = QBorderStyle::Solid;
			$this->dtgAuditScan->BorderWidth = 1;
			$this->dtgAuditScan->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgAuditScan->Paginator = new QPaginator($this->dtgAuditScan);
			$this->dtgAuditScan->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgAuditScan->UseAjax = true;

			// Specify the local databind method this datagrid will use
			$this->dtgAuditScan->SetDataBinder('dtgAuditScan_Bind', $this);

			$this->dtgAuditScan->AddColumn($this->colEditLinkColumn);
			$this->dtgAuditScan->AddColumn($this->colAuditScanId);
			$this->dtgAuditScan->AddColumn($this->colAuditId);
			$this->dtgAuditScan->AddColumn($this->colLocationId);
			$this->dtgAuditScan->AddColumn($this->colEntityId);
			$this->dtgAuditScan->AddColumn($this->colCount);
			$this->dtgAuditScan->AddColumn($this->colSystemCount);

			// Setup the Create New button
			$this->btnCreateNew = new QButton($this);
			$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('AuditScan');
			$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
		}

		public function dtgAuditScan_EditLinkColumn_Render(AuditScan $objAuditScan) {
			$strControlId = 'btnEdit' . $this->dtgAuditScan->CurrentRowIndex;

			$btnEdit = $this->objForm->GetControl($strControlId);
			if (!$btnEdit) {
				$btnEdit = new QButton($this->dtgAuditScan, $strControlId);
				$btnEdit->Text = QApplication::Translate('Edit');
				$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
			}

			$btnEdit->ActionParameter = $objAuditScan->AuditScanId;
			return $btnEdit->Render(false);
		}

		public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
			$strParameterArray = explode(',', $strParameter);
			$objAuditScan = AuditScan::Load($strParameterArray[0]);

			$objEditPanel = new AuditScanEditPanel($this, $this->strCloseEditPanelMethod, $objAuditScan);
			
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
			$objEditPanel = new AuditScanEditPanel($this, $this->strCloseEditPanelMethod, null);
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function dtgAuditScan_Audit_Render(AuditScan $objAuditScan) {
			if (!is_null($objAuditScan->Audit))
				return $objAuditScan->Audit->__toString();
			else
				return null;
		}

		public function dtgAuditScan_Location_Render(AuditScan $objAuditScan) {
			if (!is_null($objAuditScan->Location))
				return $objAuditScan->Location->__toString();
			else
				return null;
		}


		public function dtgAuditScan_Bind() {
			// Get Total Count b/c of Pagination
			$this->dtgAuditScan->TotalItemCount = AuditScan::CountAll();

			$objClauses = array();
			if ($objClause = $this->dtgAuditScan->OrderByClause)
				array_push($objClauses, $objClause);
			if ($objClause = $this->dtgAuditScan->LimitClause)
				array_push($objClauses, $objClause);
			$this->dtgAuditScan->DataSource = AuditScan::LoadAll($objClauses);
		}
	}
?>