<?php
	/**
	 * This is the abstract Panel class for the List All functionality
	 * of the AssetModel class.  This code-generated class
	 * contains a datagrid to display an HTML page that can
	 * list a collection of AssetModel objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new QPanel which extends this AssetModelListPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class AssetModelListPanelBase extends QPanel {
		public $dtgAssetModel;
		public $btnCreateNew;

		// Callback Method Names
		protected $strSetEditPanelMethod;
		protected $strCloseEditPanelMethod;
		
		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colAssetModelId;
		protected $colCategoryId;
		protected $colManufacturerId;
		protected $colAssetModelCode;
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
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgAssetModel_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colAssetModelId = new QDataGridColumn(QApplication::Translate('Asset Model Id'), '<?= $_ITEM->AssetModelId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::AssetModel()->AssetModelId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::AssetModel()->AssetModelId, false)));
			$this->colCategoryId = new QDataGridColumn(QApplication::Translate('Category Id'), '<?= $_CONTROL->ParentControl->dtgAssetModel_Category_Render($_ITEM); ?>');
			$this->colManufacturerId = new QDataGridColumn(QApplication::Translate('Manufacturer Id'), '<?= $_CONTROL->ParentControl->dtgAssetModel_Manufacturer_Render($_ITEM); ?>');
			$this->colAssetModelCode = new QDataGridColumn(QApplication::Translate('Asset Model Code'), '<?= QString::Truncate($_ITEM->AssetModelCode, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::AssetModel()->AssetModelCode), 'ReverseOrderByClause' => QQ::OrderBy(QQN::AssetModel()->AssetModelCode, false)));
			$this->colShortDescription = new QDataGridColumn(QApplication::Translate('Short Description'), '<?= QString::Truncate($_ITEM->ShortDescription, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::AssetModel()->ShortDescription), 'ReverseOrderByClause' => QQ::OrderBy(QQN::AssetModel()->ShortDescription, false)));
			$this->colLongDescription = new QDataGridColumn(QApplication::Translate('Long Description'), '<?= QString::Truncate($_ITEM->LongDescription, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::AssetModel()->LongDescription), 'ReverseOrderByClause' => QQ::OrderBy(QQN::AssetModel()->LongDescription, false)));
			$this->colImagePath = new QDataGridColumn(QApplication::Translate('Image Path'), '<?= QString::Truncate($_ITEM->ImagePath, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::AssetModel()->ImagePath), 'ReverseOrderByClause' => QQ::OrderBy(QQN::AssetModel()->ImagePath, false)));
			$this->colCreatedBy = new QDataGridColumn(QApplication::Translate('Created By'), '<?= $_CONTROL->ParentControl->dtgAssetModel_CreatedByObject_Render($_ITEM); ?>');
			$this->colCreationDate = new QDataGridColumn(QApplication::Translate('Creation Date'), '<?= $_CONTROL->ParentControl->dtgAssetModel_CreationDate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::AssetModel()->CreationDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::AssetModel()->CreationDate, false)));
			$this->colModifiedBy = new QDataGridColumn(QApplication::Translate('Modified By'), '<?= $_CONTROL->ParentControl->dtgAssetModel_ModifiedByObject_Render($_ITEM); ?>');
			$this->colModifiedDate = new QDataGridColumn(QApplication::Translate('Modified Date'), '<?= QString::Truncate($_ITEM->ModifiedDate, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::AssetModel()->ModifiedDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::AssetModel()->ModifiedDate, false)));

			// Setup DataGrid
			$this->dtgAssetModel = new QDataGrid($this);
			$this->dtgAssetModel->CellSpacing = 0;
			$this->dtgAssetModel->CellPadding = 4;
			$this->dtgAssetModel->BorderStyle = QBorderStyle::Solid;
			$this->dtgAssetModel->BorderWidth = 1;
			$this->dtgAssetModel->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgAssetModel->Paginator = new QPaginator($this->dtgAssetModel);
			$this->dtgAssetModel->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgAssetModel->UseAjax = true;

			// Specify the local databind method this datagrid will use
			$this->dtgAssetModel->SetDataBinder('dtgAssetModel_Bind', $this);

			$this->dtgAssetModel->AddColumn($this->colEditLinkColumn);
			$this->dtgAssetModel->AddColumn($this->colAssetModelId);
			$this->dtgAssetModel->AddColumn($this->colCategoryId);
			$this->dtgAssetModel->AddColumn($this->colManufacturerId);
			$this->dtgAssetModel->AddColumn($this->colAssetModelCode);
			$this->dtgAssetModel->AddColumn($this->colShortDescription);
			$this->dtgAssetModel->AddColumn($this->colLongDescription);
			$this->dtgAssetModel->AddColumn($this->colImagePath);
			$this->dtgAssetModel->AddColumn($this->colCreatedBy);
			$this->dtgAssetModel->AddColumn($this->colCreationDate);
			$this->dtgAssetModel->AddColumn($this->colModifiedBy);
			$this->dtgAssetModel->AddColumn($this->colModifiedDate);

			// Setup the Create New button
			$this->btnCreateNew = new QButton($this);
			$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('AssetModel');
			$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
		}

		public function dtgAssetModel_EditLinkColumn_Render(AssetModel $objAssetModel) {
			$strControlId = 'btnEdit' . $this->dtgAssetModel->CurrentRowIndex;

			$btnEdit = $this->objForm->GetControl($strControlId);
			if (!$btnEdit) {
				$btnEdit = new QButton($this->dtgAssetModel, $strControlId);
				$btnEdit->Text = QApplication::Translate('Edit');
				$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
			}

			$btnEdit->ActionParameter = $objAssetModel->AssetModelId;
			return $btnEdit->Render(false);
		}

		public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
			$strParameterArray = explode(',', $strParameter);
			$objAssetModel = AssetModel::Load($strParameterArray[0]);

			$objEditPanel = new AssetModelEditPanel($this, $this->strCloseEditPanelMethod, $objAssetModel);
			
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
			$objEditPanel = new AssetModelEditPanel($this, $this->strCloseEditPanelMethod, null);
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function dtgAssetModel_Category_Render(AssetModel $objAssetModel) {
			if (!is_null($objAssetModel->Category))
				return $objAssetModel->Category->__toString();
			else
				return null;
		}

		public function dtgAssetModel_Manufacturer_Render(AssetModel $objAssetModel) {
			if (!is_null($objAssetModel->Manufacturer))
				return $objAssetModel->Manufacturer->__toString();
			else
				return null;
		}

		public function dtgAssetModel_CreatedByObject_Render(AssetModel $objAssetModel) {
			if (!is_null($objAssetModel->CreatedByObject))
				return $objAssetModel->CreatedByObject->__toString();
			else
				return null;
		}

		public function dtgAssetModel_CreationDate_Render(AssetModel $objAssetModel) {
			if (!is_null($objAssetModel->CreationDate))
				return $objAssetModel->CreationDate->__toString(QDateTime::FormatDisplayDateTime);
			else
				return null;
		}

		public function dtgAssetModel_ModifiedByObject_Render(AssetModel $objAssetModel) {
			if (!is_null($objAssetModel->ModifiedByObject))
				return $objAssetModel->ModifiedByObject->__toString();
			else
				return null;
		}


		public function dtgAssetModel_Bind() {
			// Get Total Count b/c of Pagination
			$this->dtgAssetModel->TotalItemCount = AssetModel::CountAll();

			$objClauses = array();
			if ($objClause = $this->dtgAssetModel->OrderByClause)
				array_push($objClauses, $objClause);
			if ($objClause = $this->dtgAssetModel->LimitClause)
				array_push($objClauses, $objClause);
			$this->dtgAssetModel->DataSource = AssetModel::LoadAll($objClauses);
		}
	}
?>