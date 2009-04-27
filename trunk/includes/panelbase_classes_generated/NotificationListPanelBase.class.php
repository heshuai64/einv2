<?php
	/**
	 * This is the abstract Panel class for the List All functionality
	 * of the Notification class.  This code-generated class
	 * contains a datagrid to display an HTML page that can
	 * list a collection of Notification objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new QPanel which extends this NotificationListPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class NotificationListPanelBase extends QPanel {
		public $dtgNotification;
		public $btnCreateNew;

		// Callback Method Names
		protected $strSetEditPanelMethod;
		protected $strCloseEditPanelMethod;
		
		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colNotificationId;
		protected $colShortDescription;
		protected $colLongDescription;
		protected $colCriteria;
		protected $colFrequency;
		protected $colEnabledFlag;
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
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgNotification_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colNotificationId = new QDataGridColumn(QApplication::Translate('Notification Id'), '<?= $_ITEM->NotificationId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Notification()->NotificationId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Notification()->NotificationId, false)));
			$this->colShortDescription = new QDataGridColumn(QApplication::Translate('Short Description'), '<?= QString::Truncate($_ITEM->ShortDescription, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Notification()->ShortDescription), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Notification()->ShortDescription, false)));
			$this->colLongDescription = new QDataGridColumn(QApplication::Translate('Long Description'), '<?= QString::Truncate($_ITEM->LongDescription, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Notification()->LongDescription), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Notification()->LongDescription, false)));
			$this->colCriteria = new QDataGridColumn(QApplication::Translate('Criteria'), '<?= QString::Truncate($_ITEM->Criteria, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Notification()->Criteria), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Notification()->Criteria, false)));
			$this->colFrequency = new QDataGridColumn(QApplication::Translate('Frequency'), '<?= QString::Truncate($_ITEM->Frequency, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Notification()->Frequency), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Notification()->Frequency, false)));
			$this->colEnabledFlag = new QDataGridColumn(QApplication::Translate('Enabled Flag'), '<?= ($_ITEM->EnabledFlag) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::Notification()->EnabledFlag), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Notification()->EnabledFlag, false)));
			$this->colCreatedBy = new QDataGridColumn(QApplication::Translate('Created By'), '<?= $_CONTROL->ParentControl->dtgNotification_CreatedByObject_Render($_ITEM); ?>');
			$this->colCreationDate = new QDataGridColumn(QApplication::Translate('Creation Date'), '<?= $_CONTROL->ParentControl->dtgNotification_CreationDate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Notification()->CreationDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Notification()->CreationDate, false)));
			$this->colModifiedBy = new QDataGridColumn(QApplication::Translate('Modified By'), '<?= $_CONTROL->ParentControl->dtgNotification_ModifiedByObject_Render($_ITEM); ?>');
			$this->colModifiedDate = new QDataGridColumn(QApplication::Translate('Modified Date'), '<?= QString::Truncate($_ITEM->ModifiedDate, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Notification()->ModifiedDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Notification()->ModifiedDate, false)));

			// Setup DataGrid
			$this->dtgNotification = new QDataGrid($this);
			$this->dtgNotification->CellSpacing = 0;
			$this->dtgNotification->CellPadding = 4;
			$this->dtgNotification->BorderStyle = QBorderStyle::Solid;
			$this->dtgNotification->BorderWidth = 1;
			$this->dtgNotification->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgNotification->Paginator = new QPaginator($this->dtgNotification);
			$this->dtgNotification->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgNotification->UseAjax = true;

			// Specify the local databind method this datagrid will use
			$this->dtgNotification->SetDataBinder('dtgNotification_Bind', $this);

			$this->dtgNotification->AddColumn($this->colEditLinkColumn);
			$this->dtgNotification->AddColumn($this->colNotificationId);
			$this->dtgNotification->AddColumn($this->colShortDescription);
			$this->dtgNotification->AddColumn($this->colLongDescription);
			$this->dtgNotification->AddColumn($this->colCriteria);
			$this->dtgNotification->AddColumn($this->colFrequency);
			$this->dtgNotification->AddColumn($this->colEnabledFlag);
			$this->dtgNotification->AddColumn($this->colCreatedBy);
			$this->dtgNotification->AddColumn($this->colCreationDate);
			$this->dtgNotification->AddColumn($this->colModifiedBy);
			$this->dtgNotification->AddColumn($this->colModifiedDate);

			// Setup the Create New button
			$this->btnCreateNew = new QButton($this);
			$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('Notification');
			$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
		}

		public function dtgNotification_EditLinkColumn_Render(Notification $objNotification) {
			$strControlId = 'btnEdit' . $this->dtgNotification->CurrentRowIndex;

			$btnEdit = $this->objForm->GetControl($strControlId);
			if (!$btnEdit) {
				$btnEdit = new QButton($this->dtgNotification, $strControlId);
				$btnEdit->Text = QApplication::Translate('Edit');
				$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
			}

			$btnEdit->ActionParameter = $objNotification->NotificationId;
			return $btnEdit->Render(false);
		}

		public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
			$strParameterArray = explode(',', $strParameter);
			$objNotification = Notification::Load($strParameterArray[0]);

			$objEditPanel = new NotificationEditPanel($this, $this->strCloseEditPanelMethod, $objNotification);
			
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
			$objEditPanel = new NotificationEditPanel($this, $this->strCloseEditPanelMethod, null);
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function dtgNotification_CreatedByObject_Render(Notification $objNotification) {
			if (!is_null($objNotification->CreatedByObject))
				return $objNotification->CreatedByObject->__toString();
			else
				return null;
		}

		public function dtgNotification_CreationDate_Render(Notification $objNotification) {
			if (!is_null($objNotification->CreationDate))
				return $objNotification->CreationDate->__toString(QDateTime::FormatDisplayDateTime);
			else
				return null;
		}

		public function dtgNotification_ModifiedByObject_Render(Notification $objNotification) {
			if (!is_null($objNotification->ModifiedByObject))
				return $objNotification->ModifiedByObject->__toString();
			else
				return null;
		}


		public function dtgNotification_Bind() {
			// Get Total Count b/c of Pagination
			$this->dtgNotification->TotalItemCount = Notification::CountAll();

			$objClauses = array();
			if ($objClause = $this->dtgNotification->OrderByClause)
				array_push($objClauses, $objClause);
			if ($objClause = $this->dtgNotification->LimitClause)
				array_push($objClauses, $objClause);
			$this->dtgNotification->DataSource = Notification::LoadAll($objClauses);
		}
	}
?>