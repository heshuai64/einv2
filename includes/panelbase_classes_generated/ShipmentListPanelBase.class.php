<?php
	/**
	 * This is the abstract Panel class for the List All functionality
	 * of the Shipment class.  This code-generated class
	 * contains a datagrid to display an HTML page that can
	 * list a collection of Shipment objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new QPanel which extends this ShipmentListPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class ShipmentListPanelBase extends QPanel {
		public $dtgShipment;
		public $btnCreateNew;

		// Callback Method Names
		protected $strSetEditPanelMethod;
		protected $strCloseEditPanelMethod;
		
		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colShipmentId;
		protected $colShipmentNumber;
		protected $colTransactionId;
		protected $colFromCompanyId;
		protected $colFromContactId;
		protected $colFromAddressId;
		protected $colToCompanyId;
		protected $colToContactId;
		protected $colToAddressId;
		protected $colCourierId;
		protected $colTrackingNumber;
		protected $colShipDate;
		protected $colShippedFlag;
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
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgShipment_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colShipmentId = new QDataGridColumn(QApplication::Translate('Shipment Id'), '<?= $_ITEM->ShipmentId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Shipment()->ShipmentId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Shipment()->ShipmentId, false)));
			$this->colShipmentNumber = new QDataGridColumn(QApplication::Translate('Shipment Number'), '<?= QString::Truncate($_ITEM->ShipmentNumber, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Shipment()->ShipmentNumber), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Shipment()->ShipmentNumber, false)));
			$this->colTransactionId = new QDataGridColumn(QApplication::Translate('Transaction Id'), '<?= $_CONTROL->ParentControl->dtgShipment_Transaction_Render($_ITEM); ?>');
			$this->colFromCompanyId = new QDataGridColumn(QApplication::Translate('From Company Id'), '<?= $_CONTROL->ParentControl->dtgShipment_FromCompany_Render($_ITEM); ?>');
			$this->colFromContactId = new QDataGridColumn(QApplication::Translate('From Contact Id'), '<?= $_CONTROL->ParentControl->dtgShipment_FromContact_Render($_ITEM); ?>');
			$this->colFromAddressId = new QDataGridColumn(QApplication::Translate('From Address Id'), '<?= $_CONTROL->ParentControl->dtgShipment_FromAddress_Render($_ITEM); ?>');
			$this->colToCompanyId = new QDataGridColumn(QApplication::Translate('To Company Id'), '<?= $_CONTROL->ParentControl->dtgShipment_ToCompany_Render($_ITEM); ?>');
			$this->colToContactId = new QDataGridColumn(QApplication::Translate('To Contact Id'), '<?= $_CONTROL->ParentControl->dtgShipment_ToContact_Render($_ITEM); ?>');
			$this->colToAddressId = new QDataGridColumn(QApplication::Translate('To Address Id'), '<?= $_CONTROL->ParentControl->dtgShipment_ToAddress_Render($_ITEM); ?>');
			$this->colCourierId = new QDataGridColumn(QApplication::Translate('Courier Id'), '<?= $_CONTROL->ParentControl->dtgShipment_Courier_Render($_ITEM); ?>');
			$this->colTrackingNumber = new QDataGridColumn(QApplication::Translate('Tracking Number'), '<?= QString::Truncate($_ITEM->TrackingNumber, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Shipment()->TrackingNumber), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Shipment()->TrackingNumber, false)));
			$this->colShipDate = new QDataGridColumn(QApplication::Translate('Ship Date'), '<?= $_CONTROL->ParentControl->dtgShipment_ShipDate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Shipment()->ShipDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Shipment()->ShipDate, false)));
			$this->colShippedFlag = new QDataGridColumn(QApplication::Translate('Shipped Flag'), '<?= ($_ITEM->ShippedFlag) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::Shipment()->ShippedFlag), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Shipment()->ShippedFlag, false)));
			$this->colCreatedBy = new QDataGridColumn(QApplication::Translate('Created By'), '<?= $_CONTROL->ParentControl->dtgShipment_CreatedByObject_Render($_ITEM); ?>');
			$this->colCreationDate = new QDataGridColumn(QApplication::Translate('Creation Date'), '<?= $_CONTROL->ParentControl->dtgShipment_CreationDate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Shipment()->CreationDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Shipment()->CreationDate, false)));
			$this->colModifiedBy = new QDataGridColumn(QApplication::Translate('Modified By'), '<?= $_CONTROL->ParentControl->dtgShipment_ModifiedByObject_Render($_ITEM); ?>');
			$this->colModifiedDate = new QDataGridColumn(QApplication::Translate('Modified Date'), '<?= QString::Truncate($_ITEM->ModifiedDate, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Shipment()->ModifiedDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Shipment()->ModifiedDate, false)));

			// Setup DataGrid
			$this->dtgShipment = new QDataGrid($this);
			$this->dtgShipment->CellSpacing = 0;
			$this->dtgShipment->CellPadding = 4;
			$this->dtgShipment->BorderStyle = QBorderStyle::Solid;
			$this->dtgShipment->BorderWidth = 1;
			$this->dtgShipment->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgShipment->Paginator = new QPaginator($this->dtgShipment);
			$this->dtgShipment->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgShipment->UseAjax = true;

			// Specify the local databind method this datagrid will use
			$this->dtgShipment->SetDataBinder('dtgShipment_Bind', $this);

			$this->dtgShipment->AddColumn($this->colEditLinkColumn);
			$this->dtgShipment->AddColumn($this->colShipmentId);
			$this->dtgShipment->AddColumn($this->colShipmentNumber);
			$this->dtgShipment->AddColumn($this->colTransactionId);
			$this->dtgShipment->AddColumn($this->colFromCompanyId);
			$this->dtgShipment->AddColumn($this->colFromContactId);
			$this->dtgShipment->AddColumn($this->colFromAddressId);
			$this->dtgShipment->AddColumn($this->colToCompanyId);
			$this->dtgShipment->AddColumn($this->colToContactId);
			$this->dtgShipment->AddColumn($this->colToAddressId);
			$this->dtgShipment->AddColumn($this->colCourierId);
			$this->dtgShipment->AddColumn($this->colTrackingNumber);
			$this->dtgShipment->AddColumn($this->colShipDate);
			$this->dtgShipment->AddColumn($this->colShippedFlag);
			$this->dtgShipment->AddColumn($this->colCreatedBy);
			$this->dtgShipment->AddColumn($this->colCreationDate);
			$this->dtgShipment->AddColumn($this->colModifiedBy);
			$this->dtgShipment->AddColumn($this->colModifiedDate);

			// Setup the Create New button
			$this->btnCreateNew = new QButton($this);
			$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('Shipment');
			$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
		}

		public function dtgShipment_EditLinkColumn_Render(Shipment $objShipment) {
			$strControlId = 'btnEdit' . $this->dtgShipment->CurrentRowIndex;

			$btnEdit = $this->objForm->GetControl($strControlId);
			if (!$btnEdit) {
				$btnEdit = new QButton($this->dtgShipment, $strControlId);
				$btnEdit->Text = QApplication::Translate('Edit');
				$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
			}

			$btnEdit->ActionParameter = $objShipment->ShipmentId;
			return $btnEdit->Render(false);
		}

		public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
			$strParameterArray = explode(',', $strParameter);
			$objShipment = Shipment::Load($strParameterArray[0]);

			$objEditPanel = new ShipmentEditPanel($this, $this->strCloseEditPanelMethod, $objShipment);
			
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
			$objEditPanel = new ShipmentEditPanel($this, $this->strCloseEditPanelMethod, null);
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function dtgShipment_Transaction_Render(Shipment $objShipment) {
			if (!is_null($objShipment->Transaction))
				return $objShipment->Transaction->__toString();
			else
				return null;
		}

		public function dtgShipment_FromCompany_Render(Shipment $objShipment) {
			if (!is_null($objShipment->FromCompany))
				return $objShipment->FromCompany->__toString();
			else
				return null;
		}

		public function dtgShipment_FromContact_Render(Shipment $objShipment) {
			if (!is_null($objShipment->FromContact))
				return $objShipment->FromContact->__toString();
			else
				return null;
		}

		public function dtgShipment_FromAddress_Render(Shipment $objShipment) {
			if (!is_null($objShipment->FromAddress))
				return $objShipment->FromAddress->__toString();
			else
				return null;
		}

		public function dtgShipment_ToCompany_Render(Shipment $objShipment) {
			if (!is_null($objShipment->ToCompany))
				return $objShipment->ToCompany->__toString();
			else
				return null;
		}

		public function dtgShipment_ToContact_Render(Shipment $objShipment) {
			if (!is_null($objShipment->ToContact))
				return $objShipment->ToContact->__toString();
			else
				return null;
		}

		public function dtgShipment_ToAddress_Render(Shipment $objShipment) {
			if (!is_null($objShipment->ToAddress))
				return $objShipment->ToAddress->__toString();
			else
				return null;
		}

		public function dtgShipment_Courier_Render(Shipment $objShipment) {
			if (!is_null($objShipment->Courier))
				return $objShipment->Courier->__toString();
			else
				return null;
		}

		public function dtgShipment_ShipDate_Render(Shipment $objShipment) {
			if (!is_null($objShipment->ShipDate))
				return $objShipment->ShipDate->__toString(QDateTime::FormatDisplayDate);
			else
				return null;
		}

		public function dtgShipment_CreatedByObject_Render(Shipment $objShipment) {
			if (!is_null($objShipment->CreatedByObject))
				return $objShipment->CreatedByObject->__toString();
			else
				return null;
		}

		public function dtgShipment_CreationDate_Render(Shipment $objShipment) {
			if (!is_null($objShipment->CreationDate))
				return $objShipment->CreationDate->__toString(QDateTime::FormatDisplayDateTime);
			else
				return null;
		}

		public function dtgShipment_ModifiedByObject_Render(Shipment $objShipment) {
			if (!is_null($objShipment->ModifiedByObject))
				return $objShipment->ModifiedByObject->__toString();
			else
				return null;
		}


		public function dtgShipment_Bind() {
			// Get Total Count b/c of Pagination
			$this->dtgShipment->TotalItemCount = Shipment::CountAll();

			$objClauses = array();
			if ($objClause = $this->dtgShipment->OrderByClause)
				array_push($objClauses, $objClause);
			if ($objClause = $this->dtgShipment->LimitClause)
				array_push($objClauses, $objClause);
			$this->dtgShipment->DataSource = Shipment::LoadAll($objClauses);
		}
	}
?>