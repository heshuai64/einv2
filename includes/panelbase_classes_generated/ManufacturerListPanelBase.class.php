<?php
	/**
	 * This is the abstract Panel class for the List All functionality
	 * of the Manufacturer class.  This code-generated class
	 * contains a datagrid to display an HTML page that can
	 * list a collection of Manufacturer objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new QPanel which extends this ManufacturerListPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class ManufacturerListPanelBase extends QPanel {
		public $dtgManufacturer;
		public $btnCreateNew;

		// Callback Method Names
		protected $strSetEditPanelMethod;
		protected $strCloseEditPanelMethod;
		
		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colManufacturerId;
		protected $colShortDescription;
		protected $colLongDescription;
		protected $colImagePath;
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
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgManufacturer_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colManufacturerId = new QDataGridColumn(QApplication::Translate('Manufacturer Id'), '<?= $_ITEM->ManufacturerId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Manufacturer()->ManufacturerId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Manufacturer()->ManufacturerId, false)));
			$this->colShortDescription = new QDataGridColumn(QApplication::Translate('Short Description'), '<?= QString::Truncate($_ITEM->ShortDescription, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Manufacturer()->ShortDescription), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Manufacturer()->ShortDescription, false)));
			$this->colLongDescription = new QDataGridColumn(QApplication::Translate('Long Description'), '<?= QString::Truncate($_ITEM->LongDescription, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Manufacturer()->LongDescription), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Manufacturer()->LongDescription, false)));
			$this->colImagePath = new QDataGridColumn(QApplication::Translate('Image Path'), '<?= QString::Truncate($_ITEM->ImagePath, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Manufacturer()->ImagePath), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Manufacturer()->ImagePath, false)));
			$this->colCreatedBy = new QDataGridColumn(QApplication::Translate('Created By'), '<?= $_CONTROL->ParentControl->dtgManufacturer_CreatedByObject_Render($_ITEM); ?>');
			$this->colCreationDate = new QDataGridColumn(QApplication::Translate('Creation Date'), '<?= $_CONTROL->ParentControl->dtgManufacturer_CreationDate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Manufacturer()->CreationDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Manufacturer()->CreationDate, false)));
			$this->colModifiedBy = new QDataGridColumn(QApplication::Translate('Modified By'), '<?= $_CONTROL->ParentControl->dtgManufacturer_ModifiedByObject_Render($_ITEM); ?>');
			$this->colModifiedDate = new QDataGridColumn(QApplication::Translate('Modified Date'), '<?= QString::Truncate($_ITEM->ModifiedDate, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Manufacturer()->ModifiedDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Manufacturer()->ModifiedDate, false)));

			// Setup DataGrid
			$this->dtgManufacturer = new QDataGrid($this);
			$this->dtgManufacturer->CellSpacing = 0;
			$this->dtgManufacturer->CellPadding = 4;
			$this->dtgManufacturer->BorderStyle = QBorderStyle::Solid;
			$this->dtgManufacturer->BorderWidth = 1;
			$this->dtgManufacturer->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgManufacturer->Paginator = new QPaginator($this->dtgManufacturer);
			$this->dtgManufacturer->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgManufacturer->UseAjax = true;

			// Specify the local databind method this datagrid will use
			$this->dtgManufacturer->SetDataBinder('dtgManufacturer_Bind', $this);

			$this->dtgManufacturer->AddColumn($this->colEditLinkColumn);
			$this->dtgManufacturer->AddColumn($this->colManufacturerId);
			$this->dtgManufacturer->AddColumn($this->colShortDescription);
			$this->dtgManufacturer->AddColumn($this->colLongDescription);
			$this->dtgManufacturer->AddColumn($this->colImagePath);
			$this->dtgManufacturer->AddColumn($this->colCreatedBy);
			$this->dtgManufacturer->AddColumn($this->colCreationDate);
			$this->dtgManufacturer->AddColumn($this->colModifiedBy);
			$this->dtgManufacturer->AddColumn($this->colModifiedDate);

			// Setup the Create New button
			$this->btnCreateNew = new QButton($this);
			$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('Manufacturer');
			$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
		}

		public function dtgManufacturer_EditLinkColumn_Render(Manufacturer $objManufacturer) {
			$strControlId = 'btnEdit' . $this->dtgManufacturer->CurrentRowIndex;

			$btnEdit = $this->objForm->GetControl($strControlId);
			if (!$btnEdit) {
				$btnEdit = new QButton($this->dtgManufacturer, $strControlId);
				$btnEdit->Text = QApplication::Translate('Edit');
				$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
			}

			$btnEdit->ActionParameter = $objManufacturer->ManufacturerId;
			return $btnEdit->Render(false);
		}

		public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
			$strParameterArray = explode(',', $strParameter);
			$objManufacturer = Manufacturer::Load($strParameterArray[0]);

			$objEditPanel = new ManufacturerEditPanel($this, $this->strCloseEditPanelMethod, $objManufacturer);
			
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
			$objEditPanel = new ManufacturerEditPanel($this, $this->strCloseEditPanelMethod, null);
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function dtgManufacturer_CreatedByObject_Render(Manufacturer $objManufacturer) {
			if (!is_null($objManufacturer->CreatedByObject))
				return $objManufacturer->CreatedByObject->__toString();
			else
				return null;
		}

		public function dtgManufacturer_CreationDate_Render(Manufacturer $objManufacturer) {
			if (!is_null($objManufacturer->CreationDate))
				return $objManufacturer->CreationDate->__toString(QDateTime::FormatDisplayDateTime);
			else
				return null;
		}

		public function dtgManufacturer_ModifiedByObject_Render(Manufacturer $objManufacturer) {
			if (!is_null($objManufacturer->ModifiedByObject))
				return $objManufacturer->ModifiedByObject->__toString();
			else
				return null;
		}


		public function dtgManufacturer_Bind() {
			// Get Total Count b/c of Pagination
			$this->dtgManufacturer->TotalItemCount = Manufacturer::CountAll();

			$objClauses = array();
			if ($objClause = $this->dtgManufacturer->OrderByClause)
				array_push($objClauses, $objClause);
			if ($objClause = $this->dtgManufacturer->LimitClause)
				array_push($objClauses, $objClause);
			$this->dtgManufacturer->DataSource = Manufacturer::LoadAll($objClauses);
		}
	}
?>