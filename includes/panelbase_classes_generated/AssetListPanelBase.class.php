<?php
	/**
	 * This is the abstract Panel class for the List All functionality
	 * of the Asset class.  This code-generated class
	 * contains a datagrid to display an HTML page that can
	 * list a collection of Asset objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new QPanel which extends this AssetListPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class AssetListPanelBase extends QPanel {
		public $dtgAsset;
		public $btnCreateNew;

		// Callback Method Names
		protected $strSetEditPanelMethod;
		protected $strCloseEditPanelMethod;
		
		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colAssetId;
		protected $colAssetModelId;
		protected $colLocationId;
		protected $colAssetCode;
		protected $colImagePath;
		protected $colCheckedOutFlag;
		protected $colReservedFlag;
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
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgAsset_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colAssetId = new QDataGridColumn(QApplication::Translate('Asset Id'), '<?= $_ITEM->AssetId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Asset()->AssetId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Asset()->AssetId, false)));
			$this->colAssetModelId = new QDataGridColumn(QApplication::Translate('Asset Model Id'), '<?= $_CONTROL->ParentControl->dtgAsset_AssetModel_Render($_ITEM); ?>');
			$this->colLocationId = new QDataGridColumn(QApplication::Translate('Location Id'), '<?= $_CONTROL->ParentControl->dtgAsset_Location_Render($_ITEM); ?>');
			$this->colAssetCode = new QDataGridColumn(QApplication::Translate('Asset Code'), '<?= QString::Truncate($_ITEM->AssetCode, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Asset()->AssetCode), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Asset()->AssetCode, false)));
			$this->colImagePath = new QDataGridColumn(QApplication::Translate('Image Path'), '<?= QString::Truncate($_ITEM->ImagePath, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Asset()->ImagePath), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Asset()->ImagePath, false)));
			$this->colCheckedOutFlag = new QDataGridColumn(QApplication::Translate('Checked Out Flag'), '<?= ($_ITEM->CheckedOutFlag) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::Asset()->CheckedOutFlag), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Asset()->CheckedOutFlag, false)));
			$this->colReservedFlag = new QDataGridColumn(QApplication::Translate('Reserved Flag'), '<?= ($_ITEM->ReservedFlag) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::Asset()->ReservedFlag), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Asset()->ReservedFlag, false)));
			$this->colCreatedBy = new QDataGridColumn(QApplication::Translate('Created By'), '<?= $_CONTROL->ParentControl->dtgAsset_CreatedByObject_Render($_ITEM); ?>');
			$this->colCreationDate = new QDataGridColumn(QApplication::Translate('Creation Date'), '<?= $_CONTROL->ParentControl->dtgAsset_CreationDate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Asset()->CreationDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Asset()->CreationDate, false)));
			$this->colModifiedBy = new QDataGridColumn(QApplication::Translate('Modified By'), '<?= $_CONTROL->ParentControl->dtgAsset_ModifiedByObject_Render($_ITEM); ?>');
			$this->colModifiedDate = new QDataGridColumn(QApplication::Translate('Modified Date'), '<?= QString::Truncate($_ITEM->ModifiedDate, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Asset()->ModifiedDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Asset()->ModifiedDate, false)));

			// Setup DataGrid
			$this->dtgAsset = new QDataGrid($this);
			$this->dtgAsset->CellSpacing = 0;
			$this->dtgAsset->CellPadding = 4;
			$this->dtgAsset->BorderStyle = QBorderStyle::Solid;
			$this->dtgAsset->BorderWidth = 1;
			$this->dtgAsset->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgAsset->Paginator = new QPaginator($this->dtgAsset);
			$this->dtgAsset->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgAsset->UseAjax = true;

			// Specify the local databind method this datagrid will use
			$this->dtgAsset->SetDataBinder('dtgAsset_Bind', $this);

			$this->dtgAsset->AddColumn($this->colEditLinkColumn);
			$this->dtgAsset->AddColumn($this->colAssetId);
			$this->dtgAsset->AddColumn($this->colAssetModelId);
			$this->dtgAsset->AddColumn($this->colLocationId);
			$this->dtgAsset->AddColumn($this->colAssetCode);
			$this->dtgAsset->AddColumn($this->colImagePath);
			$this->dtgAsset->AddColumn($this->colCheckedOutFlag);
			$this->dtgAsset->AddColumn($this->colReservedFlag);
			$this->dtgAsset->AddColumn($this->colCreatedBy);
			$this->dtgAsset->AddColumn($this->colCreationDate);
			$this->dtgAsset->AddColumn($this->colModifiedBy);
			$this->dtgAsset->AddColumn($this->colModifiedDate);

			// Setup the Create New button
			$this->btnCreateNew = new QButton($this);
			$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('Asset');
			$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
		}

		public function dtgAsset_EditLinkColumn_Render(Asset $objAsset) {
			$strControlId = 'btnEdit' . $this->dtgAsset->CurrentRowIndex;

			$btnEdit = $this->objForm->GetControl($strControlId);
			if (!$btnEdit) {
				$btnEdit = new QButton($this->dtgAsset, $strControlId);
				$btnEdit->Text = QApplication::Translate('Edit');
				$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
			}

			$btnEdit->ActionParameter = $objAsset->AssetId;
			return $btnEdit->Render(false);
		}

		public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
			$strParameterArray = explode(',', $strParameter);
			$objAsset = Asset::Load($strParameterArray[0]);

			$objEditPanel = new AssetEditPanel($this, $this->strCloseEditPanelMethod, $objAsset);
			
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
			$objEditPanel = new AssetEditPanel($this, $this->strCloseEditPanelMethod, null);
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function dtgAsset_AssetModel_Render(Asset $objAsset) {
			if (!is_null($objAsset->AssetModel))
				return $objAsset->AssetModel->__toString();
			else
				return null;
		}

		public function dtgAsset_Location_Render(Asset $objAsset) {
			if (!is_null($objAsset->Location))
				return $objAsset->Location->__toString();
			else
				return null;
		}

		public function dtgAsset_CreatedByObject_Render(Asset $objAsset) {
			if (!is_null($objAsset->CreatedByObject))
				return $objAsset->CreatedByObject->__toString();
			else
				return null;
		}

		public function dtgAsset_CreationDate_Render(Asset $objAsset) {
			if (!is_null($objAsset->CreationDate))
				return $objAsset->CreationDate->__toString(QDateTime::FormatDisplayDateTime);
			else
				return null;
		}

		public function dtgAsset_ModifiedByObject_Render(Asset $objAsset) {
			if (!is_null($objAsset->ModifiedByObject))
				return $objAsset->ModifiedByObject->__toString();
			else
				return null;
		}


		public function dtgAsset_Bind() {
			// Get Total Count b/c of Pagination
			$this->dtgAsset->TotalItemCount = Asset::CountAll();

			$objClauses = array();
			if ($objClause = $this->dtgAsset->OrderByClause)
				array_push($objClauses, $objClause);
			if ($objClause = $this->dtgAsset->LimitClause)
				array_push($objClauses, $objClause);
			$this->dtgAsset->DataSource = Asset::LoadAll($objClauses);
		}
	}
?>