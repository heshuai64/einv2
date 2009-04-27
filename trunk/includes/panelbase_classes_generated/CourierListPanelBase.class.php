<?php
	/**
	 * This is the abstract Panel class for the List All functionality
	 * of the Courier class.  This code-generated class
	 * contains a datagrid to display an HTML page that can
	 * list a collection of Courier objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new QPanel which extends this CourierListPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class CourierListPanelBase extends QPanel {
		public $dtgCourier;
		public $btnCreateNew;

		// Callback Method Names
		protected $strSetEditPanelMethod;
		protected $strCloseEditPanelMethod;
		
		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colCourierId;
		protected $colShortDescription;
		protected $colActiveFlag;

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
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgCourier_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colCourierId = new QDataGridColumn(QApplication::Translate('Courier Id'), '<?= $_ITEM->CourierId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Courier()->CourierId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Courier()->CourierId, false)));
			$this->colShortDescription = new QDataGridColumn(QApplication::Translate('Short Description'), '<?= QString::Truncate($_ITEM->ShortDescription, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Courier()->ShortDescription), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Courier()->ShortDescription, false)));
			$this->colActiveFlag = new QDataGridColumn(QApplication::Translate('Active Flag'), '<?= ($_ITEM->ActiveFlag) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::Courier()->ActiveFlag), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Courier()->ActiveFlag, false)));

			// Setup DataGrid
			$this->dtgCourier = new QDataGrid($this);
			$this->dtgCourier->CellSpacing = 0;
			$this->dtgCourier->CellPadding = 4;
			$this->dtgCourier->BorderStyle = QBorderStyle::Solid;
			$this->dtgCourier->BorderWidth = 1;
			$this->dtgCourier->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgCourier->Paginator = new QPaginator($this->dtgCourier);
			$this->dtgCourier->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgCourier->UseAjax = true;

			// Specify the local databind method this datagrid will use
			$this->dtgCourier->SetDataBinder('dtgCourier_Bind', $this);

			$this->dtgCourier->AddColumn($this->colEditLinkColumn);
			$this->dtgCourier->AddColumn($this->colCourierId);
			$this->dtgCourier->AddColumn($this->colShortDescription);
			$this->dtgCourier->AddColumn($this->colActiveFlag);

			// Setup the Create New button
			$this->btnCreateNew = new QButton($this);
			$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('Courier');
			$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
		}

		public function dtgCourier_EditLinkColumn_Render(Courier $objCourier) {
			$strControlId = 'btnEdit' . $this->dtgCourier->CurrentRowIndex;

			$btnEdit = $this->objForm->GetControl($strControlId);
			if (!$btnEdit) {
				$btnEdit = new QButton($this->dtgCourier, $strControlId);
				$btnEdit->Text = QApplication::Translate('Edit');
				$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
			}

			$btnEdit->ActionParameter = $objCourier->CourierId;
			return $btnEdit->Render(false);
		}

		public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
			$strParameterArray = explode(',', $strParameter);
			$objCourier = Courier::Load($strParameterArray[0]);

			$objEditPanel = new CourierEditPanel($this, $this->strCloseEditPanelMethod, $objCourier);
			
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
			$objEditPanel = new CourierEditPanel($this, $this->strCloseEditPanelMethod, null);
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}


		public function dtgCourier_Bind() {
			// Get Total Count b/c of Pagination
			$this->dtgCourier->TotalItemCount = Courier::CountAll();

			$objClauses = array();
			if ($objClause = $this->dtgCourier->OrderByClause)
				array_push($objClauses, $objClause);
			if ($objClause = $this->dtgCourier->LimitClause)
				array_push($objClauses, $objClause);
			$this->dtgCourier->DataSource = Courier::LoadAll($objClauses);
		}
	}
?>