<?php
	/**
	 * This is the abstract Panel class for the List All functionality
	 * of the Category class.  This code-generated class
	 * contains a datagrid to display an HTML page that can
	 * list a collection of Category objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new QPanel which extends this CategoryListPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class CategoryListPanelBase extends QPanel {
		public $dtgCategory;
		public $btnCreateNew;

		// Callback Method Names
		protected $strSetEditPanelMethod;
		protected $strCloseEditPanelMethod;
		
		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colCategoryId;
		protected $colShortDescription;
		protected $colLongDescription;
		protected $colImagePath;
		protected $colAssetFlag;
		protected $colInventoryFlag;
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
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgCategory_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colCategoryId = new QDataGridColumn(QApplication::Translate('Category Id'), '<?= $_ITEM->CategoryId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Category()->CategoryId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Category()->CategoryId, false)));
			$this->colShortDescription = new QDataGridColumn(QApplication::Translate('Short Description'), '<?= QString::Truncate($_ITEM->ShortDescription, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Category()->ShortDescription), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Category()->ShortDescription, false)));
			$this->colLongDescription = new QDataGridColumn(QApplication::Translate('Long Description'), '<?= QString::Truncate($_ITEM->LongDescription, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Category()->LongDescription), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Category()->LongDescription, false)));
			$this->colImagePath = new QDataGridColumn(QApplication::Translate('Image Path'), '<?= QString::Truncate($_ITEM->ImagePath, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Category()->ImagePath), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Category()->ImagePath, false)));
			$this->colAssetFlag = new QDataGridColumn(QApplication::Translate('Asset Flag'), '<?= ($_ITEM->AssetFlag) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::Category()->AssetFlag), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Category()->AssetFlag, false)));
			$this->colInventoryFlag = new QDataGridColumn(QApplication::Translate('Inventory Flag'), '<?= ($_ITEM->InventoryFlag) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::Category()->InventoryFlag), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Category()->InventoryFlag, false)));
			$this->colCreatedBy = new QDataGridColumn(QApplication::Translate('Created By'), '<?= $_CONTROL->ParentControl->dtgCategory_CreatedByObject_Render($_ITEM); ?>');
			$this->colCreationDate = new QDataGridColumn(QApplication::Translate('Creation Date'), '<?= $_CONTROL->ParentControl->dtgCategory_CreationDate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Category()->CreationDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Category()->CreationDate, false)));
			$this->colModifiedBy = new QDataGridColumn(QApplication::Translate('Modified By'), '<?= $_CONTROL->ParentControl->dtgCategory_ModifiedByObject_Render($_ITEM); ?>');
			$this->colModifiedDate = new QDataGridColumn(QApplication::Translate('Modified Date'), '<?= QString::Truncate($_ITEM->ModifiedDate, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Category()->ModifiedDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Category()->ModifiedDate, false)));

			// Setup DataGrid
			$this->dtgCategory = new QDataGrid($this);
			$this->dtgCategory->CellSpacing = 0;
			$this->dtgCategory->CellPadding = 4;
			$this->dtgCategory->BorderStyle = QBorderStyle::Solid;
			$this->dtgCategory->BorderWidth = 1;
			$this->dtgCategory->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgCategory->Paginator = new QPaginator($this->dtgCategory);
			$this->dtgCategory->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgCategory->UseAjax = true;

			// Specify the local databind method this datagrid will use
			$this->dtgCategory->SetDataBinder('dtgCategory_Bind', $this);

			$this->dtgCategory->AddColumn($this->colEditLinkColumn);
			$this->dtgCategory->AddColumn($this->colCategoryId);
			$this->dtgCategory->AddColumn($this->colShortDescription);
			$this->dtgCategory->AddColumn($this->colLongDescription);
			$this->dtgCategory->AddColumn($this->colImagePath);
			$this->dtgCategory->AddColumn($this->colAssetFlag);
			$this->dtgCategory->AddColumn($this->colInventoryFlag);
			$this->dtgCategory->AddColumn($this->colCreatedBy);
			$this->dtgCategory->AddColumn($this->colCreationDate);
			$this->dtgCategory->AddColumn($this->colModifiedBy);
			$this->dtgCategory->AddColumn($this->colModifiedDate);

			// Setup the Create New button
			$this->btnCreateNew = new QButton($this);
			$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('Category');
			$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
		}

		public function dtgCategory_EditLinkColumn_Render(Category $objCategory) {
			$strControlId = 'btnEdit' . $this->dtgCategory->CurrentRowIndex;

			$btnEdit = $this->objForm->GetControl($strControlId);
			if (!$btnEdit) {
				$btnEdit = new QButton($this->dtgCategory, $strControlId);
				$btnEdit->Text = QApplication::Translate('Edit');
				$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
			}

			$btnEdit->ActionParameter = $objCategory->CategoryId;
			return $btnEdit->Render(false);
		}

		public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
			$strParameterArray = explode(',', $strParameter);
			$objCategory = Category::Load($strParameterArray[0]);

			$objEditPanel = new CategoryEditPanel($this, $this->strCloseEditPanelMethod, $objCategory);
			
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
			$objEditPanel = new CategoryEditPanel($this, $this->strCloseEditPanelMethod, null);
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function dtgCategory_CreatedByObject_Render(Category $objCategory) {
			if (!is_null($objCategory->CreatedByObject))
				return $objCategory->CreatedByObject->__toString();
			else
				return null;
		}

		public function dtgCategory_CreationDate_Render(Category $objCategory) {
			if (!is_null($objCategory->CreationDate))
				return $objCategory->CreationDate->__toString(QDateTime::FormatDisplayDateTime);
			else
				return null;
		}

		public function dtgCategory_ModifiedByObject_Render(Category $objCategory) {
			if (!is_null($objCategory->ModifiedByObject))
				return $objCategory->ModifiedByObject->__toString();
			else
				return null;
		}


		public function dtgCategory_Bind() {
			// Get Total Count b/c of Pagination
			$this->dtgCategory->TotalItemCount = Category::CountAll();

			$objClauses = array();
			if ($objClause = $this->dtgCategory->OrderByClause)
				array_push($objClauses, $objClause);
			if ($objClause = $this->dtgCategory->LimitClause)
				array_push($objClauses, $objClause);
			$this->dtgCategory->DataSource = Category::LoadAll($objClauses);
		}
	}
?>