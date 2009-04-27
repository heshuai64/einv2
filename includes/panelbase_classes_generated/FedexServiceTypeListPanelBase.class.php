<?php
	/**
	 * This is the abstract Panel class for the List All functionality
	 * of the FedexServiceType class.  This code-generated class
	 * contains a datagrid to display an HTML page that can
	 * list a collection of FedexServiceType objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new QPanel which extends this FedexServiceTypeListPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class FedexServiceTypeListPanelBase extends QPanel {
		public $dtgFedexServiceType;
		public $btnCreateNew;

		// Callback Method Names
		protected $strSetEditPanelMethod;
		protected $strCloseEditPanelMethod;
		
		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colFedexServiceTypeId;
		protected $colShortDescription;
		protected $colValue;

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
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgFedexServiceType_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colFedexServiceTypeId = new QDataGridColumn(QApplication::Translate('Fedex Service Type Id'), '<?= $_ITEM->FedexServiceTypeId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::FedexServiceType()->FedexServiceTypeId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FedexServiceType()->FedexServiceTypeId, false)));
			$this->colShortDescription = new QDataGridColumn(QApplication::Translate('Short Description'), '<?= QString::Truncate($_ITEM->ShortDescription, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::FedexServiceType()->ShortDescription), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FedexServiceType()->ShortDescription, false)));
			$this->colValue = new QDataGridColumn(QApplication::Translate('Value'), '<?= QString::Truncate($_ITEM->Value, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::FedexServiceType()->Value), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FedexServiceType()->Value, false)));

			// Setup DataGrid
			$this->dtgFedexServiceType = new QDataGrid($this);
			$this->dtgFedexServiceType->CellSpacing = 0;
			$this->dtgFedexServiceType->CellPadding = 4;
			$this->dtgFedexServiceType->BorderStyle = QBorderStyle::Solid;
			$this->dtgFedexServiceType->BorderWidth = 1;
			$this->dtgFedexServiceType->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgFedexServiceType->Paginator = new QPaginator($this->dtgFedexServiceType);
			$this->dtgFedexServiceType->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgFedexServiceType->UseAjax = true;

			// Specify the local databind method this datagrid will use
			$this->dtgFedexServiceType->SetDataBinder('dtgFedexServiceType_Bind', $this);

			$this->dtgFedexServiceType->AddColumn($this->colEditLinkColumn);
			$this->dtgFedexServiceType->AddColumn($this->colFedexServiceTypeId);
			$this->dtgFedexServiceType->AddColumn($this->colShortDescription);
			$this->dtgFedexServiceType->AddColumn($this->colValue);

			// Setup the Create New button
			$this->btnCreateNew = new QButton($this);
			$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('FedexServiceType');
			$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
		}

		public function dtgFedexServiceType_EditLinkColumn_Render(FedexServiceType $objFedexServiceType) {
			$strControlId = 'btnEdit' . $this->dtgFedexServiceType->CurrentRowIndex;

			$btnEdit = $this->objForm->GetControl($strControlId);
			if (!$btnEdit) {
				$btnEdit = new QButton($this->dtgFedexServiceType, $strControlId);
				$btnEdit->Text = QApplication::Translate('Edit');
				$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
			}

			$btnEdit->ActionParameter = $objFedexServiceType->FedexServiceTypeId;
			return $btnEdit->Render(false);
		}

		public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
			$strParameterArray = explode(',', $strParameter);
			$objFedexServiceType = FedexServiceType::Load($strParameterArray[0]);

			$objEditPanel = new FedexServiceTypeEditPanel($this, $this->strCloseEditPanelMethod, $objFedexServiceType);
			
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
			$objEditPanel = new FedexServiceTypeEditPanel($this, $this->strCloseEditPanelMethod, null);
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}


		public function dtgFedexServiceType_Bind() {
			// Get Total Count b/c of Pagination
			$this->dtgFedexServiceType->TotalItemCount = FedexServiceType::CountAll();

			$objClauses = array();
			if ($objClause = $this->dtgFedexServiceType->OrderByClause)
				array_push($objClauses, $objClause);
			if ($objClause = $this->dtgFedexServiceType->LimitClause)
				array_push($objClauses, $objClause);
			$this->dtgFedexServiceType->DataSource = FedexServiceType::LoadAll($objClauses);
		}
	}
?>