<?php
	/**
	 * This is the abstract Panel class for the List All functionality
	 * of the PackageType class.  This code-generated class
	 * contains a datagrid to display an HTML page that can
	 * list a collection of PackageType objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new QPanel which extends this PackageTypeListPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class PackageTypeListPanelBase extends QPanel {
		public $dtgPackageType;
		public $btnCreateNew;

		// Callback Method Names
		protected $strSetEditPanelMethod;
		protected $strCloseEditPanelMethod;
		
		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colPackageTypeId;
		protected $colShortDescription;
		protected $colCourierId;
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
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgPackageType_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colPackageTypeId = new QDataGridColumn(QApplication::Translate('Package Type Id'), '<?= $_ITEM->PackageTypeId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::PackageType()->PackageTypeId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::PackageType()->PackageTypeId, false)));
			$this->colShortDescription = new QDataGridColumn(QApplication::Translate('Short Description'), '<?= QString::Truncate($_ITEM->ShortDescription, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::PackageType()->ShortDescription), 'ReverseOrderByClause' => QQ::OrderBy(QQN::PackageType()->ShortDescription, false)));
			$this->colCourierId = new QDataGridColumn(QApplication::Translate('Courier Id'), '<?= $_CONTROL->ParentControl->dtgPackageType_Courier_Render($_ITEM); ?>');
			$this->colValue = new QDataGridColumn(QApplication::Translate('Value'), '<?= QString::Truncate($_ITEM->Value, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::PackageType()->Value), 'ReverseOrderByClause' => QQ::OrderBy(QQN::PackageType()->Value, false)));

			// Setup DataGrid
			$this->dtgPackageType = new QDataGrid($this);
			$this->dtgPackageType->CellSpacing = 0;
			$this->dtgPackageType->CellPadding = 4;
			$this->dtgPackageType->BorderStyle = QBorderStyle::Solid;
			$this->dtgPackageType->BorderWidth = 1;
			$this->dtgPackageType->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgPackageType->Paginator = new QPaginator($this->dtgPackageType);
			$this->dtgPackageType->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgPackageType->UseAjax = true;

			// Specify the local databind method this datagrid will use
			$this->dtgPackageType->SetDataBinder('dtgPackageType_Bind', $this);

			$this->dtgPackageType->AddColumn($this->colEditLinkColumn);
			$this->dtgPackageType->AddColumn($this->colPackageTypeId);
			$this->dtgPackageType->AddColumn($this->colShortDescription);
			$this->dtgPackageType->AddColumn($this->colCourierId);
			$this->dtgPackageType->AddColumn($this->colValue);

			// Setup the Create New button
			$this->btnCreateNew = new QButton($this);
			$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('PackageType');
			$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
		}

		public function dtgPackageType_EditLinkColumn_Render(PackageType $objPackageType) {
			$strControlId = 'btnEdit' . $this->dtgPackageType->CurrentRowIndex;

			$btnEdit = $this->objForm->GetControl($strControlId);
			if (!$btnEdit) {
				$btnEdit = new QButton($this->dtgPackageType, $strControlId);
				$btnEdit->Text = QApplication::Translate('Edit');
				$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
			}

			$btnEdit->ActionParameter = $objPackageType->PackageTypeId;
			return $btnEdit->Render(false);
		}

		public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
			$strParameterArray = explode(',', $strParameter);
			$objPackageType = PackageType::Load($strParameterArray[0]);

			$objEditPanel = new PackageTypeEditPanel($this, $this->strCloseEditPanelMethod, $objPackageType);
			
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
			$objEditPanel = new PackageTypeEditPanel($this, $this->strCloseEditPanelMethod, null);
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function dtgPackageType_Courier_Render(PackageType $objPackageType) {
			if (!is_null($objPackageType->Courier))
				return $objPackageType->Courier->__toString();
			else
				return null;
		}


		public function dtgPackageType_Bind() {
			// Get Total Count b/c of Pagination
			$this->dtgPackageType->TotalItemCount = PackageType::CountAll();

			$objClauses = array();
			if ($objClause = $this->dtgPackageType->OrderByClause)
				array_push($objClauses, $objClause);
			if ($objClause = $this->dtgPackageType->LimitClause)
				array_push($objClauses, $objClause);
			$this->dtgPackageType->DataSource = PackageType::LoadAll($objClauses);
		}
	}
?>