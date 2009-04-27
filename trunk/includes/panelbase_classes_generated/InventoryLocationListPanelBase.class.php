<?php
	/**
	 * This is the abstract Panel class for the List All functionality
	 * of the InventoryLocation class.  This code-generated class
	 * contains a datagrid to display an HTML page that can
	 * list a collection of InventoryLocation objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new QPanel which extends this InventoryLocationListPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class InventoryLocationListPanelBase extends QPanel {
		public $dtgInventoryLocation;
		public $btnCreateNew;

		// Callback Method Names
		protected $strSetEditPanelMethod;
		protected $strCloseEditPanelMethod;
		
		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colInventoryLocationId;
		protected $colInventoryModelId;
		protected $colLocationId;
		protected $colQuantity;
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
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgInventoryLocation_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colInventoryLocationId = new QDataGridColumn(QApplication::Translate('Inventory Location Id'), '<?= $_ITEM->InventoryLocationId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::InventoryLocation()->InventoryLocationId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::InventoryLocation()->InventoryLocationId, false)));
			$this->colInventoryModelId = new QDataGridColumn(QApplication::Translate('Inventory Model Id'), '<?= $_CONTROL->ParentControl->dtgInventoryLocation_InventoryModel_Render($_ITEM); ?>');
			$this->colLocationId = new QDataGridColumn(QApplication::Translate('Location Id'), '<?= $_CONTROL->ParentControl->dtgInventoryLocation_Location_Render($_ITEM); ?>');
			$this->colQuantity = new QDataGridColumn(QApplication::Translate('Quantity'), '<?= $_ITEM->Quantity; ?>', array('OrderByClause' => QQ::OrderBy(QQN::InventoryLocation()->Quantity), 'ReverseOrderByClause' => QQ::OrderBy(QQN::InventoryLocation()->Quantity, false)));
			$this->colCreatedBy = new QDataGridColumn(QApplication::Translate('Created By'), '<?= $_CONTROL->ParentControl->dtgInventoryLocation_CreatedByObject_Render($_ITEM); ?>');
			$this->colCreationDate = new QDataGridColumn(QApplication::Translate('Creation Date'), '<?= $_CONTROL->ParentControl->dtgInventoryLocation_CreationDate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::InventoryLocation()->CreationDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::InventoryLocation()->CreationDate, false)));
			$this->colModifiedBy = new QDataGridColumn(QApplication::Translate('Modified By'), '<?= $_CONTROL->ParentControl->dtgInventoryLocation_ModifiedByObject_Render($_ITEM); ?>');
			$this->colModifiedDate = new QDataGridColumn(QApplication::Translate('Modified Date'), '<?= QString::Truncate($_ITEM->ModifiedDate, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::InventoryLocation()->ModifiedDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::InventoryLocation()->ModifiedDate, false)));

			// Setup DataGrid
			$this->dtgInventoryLocation = new QDataGrid($this);
			$this->dtgInventoryLocation->CellSpacing = 0;
			$this->dtgInventoryLocation->CellPadding = 4;
			$this->dtgInventoryLocation->BorderStyle = QBorderStyle::Solid;
			$this->dtgInventoryLocation->BorderWidth = 1;
			$this->dtgInventoryLocation->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgInventoryLocation->Paginator = new QPaginator($this->dtgInventoryLocation);
			$this->dtgInventoryLocation->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgInventoryLocation->UseAjax = true;

			// Specify the local databind method this datagrid will use
			$this->dtgInventoryLocation->SetDataBinder('dtgInventoryLocation_Bind', $this);

			$this->dtgInventoryLocation->AddColumn($this->colEditLinkColumn);
			$this->dtgInventoryLocation->AddColumn($this->colInventoryLocationId);
			$this->dtgInventoryLocation->AddColumn($this->colInventoryModelId);
			$this->dtgInventoryLocation->AddColumn($this->colLocationId);
			$this->dtgInventoryLocation->AddColumn($this->colQuantity);
			$this->dtgInventoryLocation->AddColumn($this->colCreatedBy);
			$this->dtgInventoryLocation->AddColumn($this->colCreationDate);
			$this->dtgInventoryLocation->AddColumn($this->colModifiedBy);
			$this->dtgInventoryLocation->AddColumn($this->colModifiedDate);

			// Setup the Create New button
			$this->btnCreateNew = new QButton($this);
			$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('InventoryLocation');
			$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
		}

		public function dtgInventoryLocation_EditLinkColumn_Render(InventoryLocation $objInventoryLocation) {
			$strControlId = 'btnEdit' . $this->dtgInventoryLocation->CurrentRowIndex;

			$btnEdit = $this->objForm->GetControl($strControlId);
			if (!$btnEdit) {
				$btnEdit = new QButton($this->dtgInventoryLocation, $strControlId);
				$btnEdit->Text = QApplication::Translate('Edit');
				$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
			}

			$btnEdit->ActionParameter = $objInventoryLocation->InventoryLocationId;
			return $btnEdit->Render(false);
		}

		public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
			$strParameterArray = explode(',', $strParameter);
			$objInventoryLocation = InventoryLocation::Load($strParameterArray[0]);

			$objEditPanel = new InventoryLocationEditPanel($this, $this->strCloseEditPanelMethod, $objInventoryLocation);
			
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
			$objEditPanel = new InventoryLocationEditPanel($this, $this->strCloseEditPanelMethod, null);
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function dtgInventoryLocation_InventoryModel_Render(InventoryLocation $objInventoryLocation) {
			if (!is_null($objInventoryLocation->InventoryModel))
				return $objInventoryLocation->InventoryModel->__toString();
			else
				return null;
		}

		public function dtgInventoryLocation_Location_Render(InventoryLocation $objInventoryLocation) {
			if (!is_null($objInventoryLocation->Location))
				return $objInventoryLocation->Location->__toString();
			else
				return null;
		}

		public function dtgInventoryLocation_CreatedByObject_Render(InventoryLocation $objInventoryLocation) {
			if (!is_null($objInventoryLocation->CreatedByObject))
				return $objInventoryLocation->CreatedByObject->__toString();
			else
				return null;
		}

		public function dtgInventoryLocation_CreationDate_Render(InventoryLocation $objInventoryLocation) {
			if (!is_null($objInventoryLocation->CreationDate))
				return $objInventoryLocation->CreationDate->__toString(QDateTime::FormatDisplayDateTime);
			else
				return null;
		}

		public function dtgInventoryLocation_ModifiedByObject_Render(InventoryLocation $objInventoryLocation) {
			if (!is_null($objInventoryLocation->ModifiedByObject))
				return $objInventoryLocation->ModifiedByObject->__toString();
			else
				return null;
		}


		public function dtgInventoryLocation_Bind() {
			// Get Total Count b/c of Pagination
			$this->dtgInventoryLocation->TotalItemCount = InventoryLocation::CountAll();

			$objClauses = array();
			if ($objClause = $this->dtgInventoryLocation->OrderByClause)
				array_push($objClauses, $objClause);
			if ($objClause = $this->dtgInventoryLocation->LimitClause)
				array_push($objClauses, $objClause);
			$this->dtgInventoryLocation->DataSource = InventoryLocation::LoadAll($objClauses);
		}
	}
?>