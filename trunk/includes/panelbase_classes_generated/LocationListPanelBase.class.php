<?php
	/**
	 * This is the abstract Panel class for the List All functionality
	 * of the Location class.  This code-generated class
	 * contains a datagrid to display an HTML page that can
	 * list a collection of Location objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new QPanel which extends this LocationListPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class LocationListPanelBase extends QPanel {
		public $dtgLocation;
		public $btnCreateNew;

		// Callback Method Names
		protected $strSetEditPanelMethod;
		protected $strCloseEditPanelMethod;
		
		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colLocationId;
		protected $colShortDescription;
		protected $colLongDescription;
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
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgLocation_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colLocationId = new QDataGridColumn(QApplication::Translate('Location Id'), '<?= $_ITEM->LocationId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Location()->LocationId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Location()->LocationId, false)));
			$this->colShortDescription = new QDataGridColumn(QApplication::Translate('Short Description'), '<?= QString::Truncate($_ITEM->ShortDescription, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Location()->ShortDescription), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Location()->ShortDescription, false)));
			$this->colLongDescription = new QDataGridColumn(QApplication::Translate('Long Description'), '<?= QString::Truncate($_ITEM->LongDescription, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Location()->LongDescription), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Location()->LongDescription, false)));
			$this->colCreatedBy = new QDataGridColumn(QApplication::Translate('Created By'), '<?= $_CONTROL->ParentControl->dtgLocation_CreatedByObject_Render($_ITEM); ?>');
			$this->colCreationDate = new QDataGridColumn(QApplication::Translate('Creation Date'), '<?= $_CONTROL->ParentControl->dtgLocation_CreationDate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Location()->CreationDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Location()->CreationDate, false)));
			$this->colModifiedBy = new QDataGridColumn(QApplication::Translate('Modified By'), '<?= $_CONTROL->ParentControl->dtgLocation_ModifiedByObject_Render($_ITEM); ?>');
			$this->colModifiedDate = new QDataGridColumn(QApplication::Translate('Modified Date'), '<?= QString::Truncate($_ITEM->ModifiedDate, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Location()->ModifiedDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Location()->ModifiedDate, false)));

			// Setup DataGrid
			$this->dtgLocation = new QDataGrid($this);
			$this->dtgLocation->CellSpacing = 0;
			$this->dtgLocation->CellPadding = 4;
			$this->dtgLocation->BorderStyle = QBorderStyle::Solid;
			$this->dtgLocation->BorderWidth = 1;
			$this->dtgLocation->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgLocation->Paginator = new QPaginator($this->dtgLocation);
			$this->dtgLocation->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgLocation->UseAjax = true;

			// Specify the local databind method this datagrid will use
			$this->dtgLocation->SetDataBinder('dtgLocation_Bind', $this);

			$this->dtgLocation->AddColumn($this->colEditLinkColumn);
			$this->dtgLocation->AddColumn($this->colLocationId);
			$this->dtgLocation->AddColumn($this->colShortDescription);
			$this->dtgLocation->AddColumn($this->colLongDescription);
			$this->dtgLocation->AddColumn($this->colCreatedBy);
			$this->dtgLocation->AddColumn($this->colCreationDate);
			$this->dtgLocation->AddColumn($this->colModifiedBy);
			$this->dtgLocation->AddColumn($this->colModifiedDate);

			// Setup the Create New button
			$this->btnCreateNew = new QButton($this);
			$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('Location');
			$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
		}

		public function dtgLocation_EditLinkColumn_Render(Location $objLocation) {
			$strControlId = 'btnEdit' . $this->dtgLocation->CurrentRowIndex;

			$btnEdit = $this->objForm->GetControl($strControlId);
			if (!$btnEdit) {
				$btnEdit = new QButton($this->dtgLocation, $strControlId);
				$btnEdit->Text = QApplication::Translate('Edit');
				$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
			}

			$btnEdit->ActionParameter = $objLocation->LocationId;
			return $btnEdit->Render(false);
		}

		public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
			$strParameterArray = explode(',', $strParameter);
			$objLocation = Location::Load($strParameterArray[0]);

			$objEditPanel = new LocationEditPanel($this, $this->strCloseEditPanelMethod, $objLocation);
			
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
			$objEditPanel = new LocationEditPanel($this, $this->strCloseEditPanelMethod, null);
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function dtgLocation_CreatedByObject_Render(Location $objLocation) {
			if (!is_null($objLocation->CreatedByObject))
				return $objLocation->CreatedByObject->__toString();
			else
				return null;
		}

		public function dtgLocation_CreationDate_Render(Location $objLocation) {
			if (!is_null($objLocation->CreationDate))
				return $objLocation->CreationDate->__toString(QDateTime::FormatDisplayDateTime);
			else
				return null;
		}

		public function dtgLocation_ModifiedByObject_Render(Location $objLocation) {
			if (!is_null($objLocation->ModifiedByObject))
				return $objLocation->ModifiedByObject->__toString();
			else
				return null;
		}


		public function dtgLocation_Bind() {
			// Get Total Count b/c of Pagination
			$this->dtgLocation->TotalItemCount = Location::CountAll();

			$objClauses = array();
			if ($objClause = $this->dtgLocation->OrderByClause)
				array_push($objClauses, $objClause);
			if ($objClause = $this->dtgLocation->LimitClause)
				array_push($objClauses, $objClause);
			$this->dtgLocation->DataSource = Location::LoadAll($objClauses);
		}
	}
?>