<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the FedexShipment class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of FedexShipment objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this FedexShipmentListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class FedexShipmentListFormBase extends QForm {
		protected $dtgFedexShipment;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colFedexShipmentId;
		protected $colShipmentId;
		protected $colPackageTypeId;
		protected $colShippingAccountId;
		protected $colFedexServiceTypeId;
		protected $colCurrencyUnitId;
		protected $colWeightUnitId;
		protected $colLengthUnitId;
		protected $colToPhone;
		protected $colPayType;
		protected $colPayerAccountNumber;
		protected $colPackageWeight;
		protected $colPackageLength;
		protected $colPackageWidth;
		protected $colPackageHeight;
		protected $colDeclaredValue;
		protected $colReference;
		protected $colSaturdayDeliveryFlag;
		protected $colNotifySenderEmail;
		protected $colNotifySenderShipFlag;
		protected $colNotifySenderExceptionFlag;
		protected $colNotifySenderDeliveryFlag;
		protected $colNotifyRecipientEmail;
		protected $colNotifyRecipientShipFlag;
		protected $colNotifyRecipientExceptionFlag;
		protected $colNotifyRecipientDeliveryFlag;
		protected $colNotifyOtherEmail;
		protected $colNotifyOtherShipFlag;
		protected $colNotifyOtherExceptionFlag;
		protected $colNotifyOtherDeliveryFlag;
		protected $colHoldAtLocationFlag;
		protected $colHoldAtLocationAddress;
		protected $colHoldAtLocationCity;
		protected $colHoldAtLocationState;
		protected $colHoldAtLocationPostalCode;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgFedexShipment_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colFedexShipmentId = new QDataGridColumn(QApplication::Translate('Fedex Shipment Id'), '<?= $_ITEM->FedexShipmentId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::FedexShipment()->FedexShipmentId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FedexShipment()->FedexShipmentId, false)));
			$this->colShipmentId = new QDataGridColumn(QApplication::Translate('Shipment Id'), '<?= $_FORM->dtgFedexShipment_Shipment_Render($_ITEM); ?>');
			$this->colPackageTypeId = new QDataGridColumn(QApplication::Translate('Package Type Id'), '<?= $_FORM->dtgFedexShipment_PackageType_Render($_ITEM); ?>');
			$this->colShippingAccountId = new QDataGridColumn(QApplication::Translate('Shipping Account Id'), '<?= $_FORM->dtgFedexShipment_ShippingAccount_Render($_ITEM); ?>');
			$this->colFedexServiceTypeId = new QDataGridColumn(QApplication::Translate('Fedex Service Type Id'), '<?= $_FORM->dtgFedexShipment_FedexServiceType_Render($_ITEM); ?>');
			$this->colCurrencyUnitId = new QDataGridColumn(QApplication::Translate('Currency Unit Id'), '<?= $_FORM->dtgFedexShipment_CurrencyUnit_Render($_ITEM); ?>');
			$this->colWeightUnitId = new QDataGridColumn(QApplication::Translate('Weight Unit Id'), '<?= $_FORM->dtgFedexShipment_WeightUnit_Render($_ITEM); ?>');
			$this->colLengthUnitId = new QDataGridColumn(QApplication::Translate('Length Unit Id'), '<?= $_FORM->dtgFedexShipment_LengthUnit_Render($_ITEM); ?>');
			$this->colToPhone = new QDataGridColumn(QApplication::Translate('To Phone'), '<?= QString::Truncate($_ITEM->ToPhone, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::FedexShipment()->ToPhone), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FedexShipment()->ToPhone, false)));
			$this->colPayType = new QDataGridColumn(QApplication::Translate('Pay Type'), '<?= $_ITEM->PayType; ?>', array('OrderByClause' => QQ::OrderBy(QQN::FedexShipment()->PayType), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FedexShipment()->PayType, false)));
			$this->colPayerAccountNumber = new QDataGridColumn(QApplication::Translate('Payer Account Number'), '<?= QString::Truncate($_ITEM->PayerAccountNumber, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::FedexShipment()->PayerAccountNumber), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FedexShipment()->PayerAccountNumber, false)));
			$this->colPackageWeight = new QDataGridColumn(QApplication::Translate('Package Weight'), '<?= $_ITEM->PackageWeight; ?>', array('OrderByClause' => QQ::OrderBy(QQN::FedexShipment()->PackageWeight), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FedexShipment()->PackageWeight, false)));
			$this->colPackageLength = new QDataGridColumn(QApplication::Translate('Package Length'), '<?= $_ITEM->PackageLength; ?>', array('OrderByClause' => QQ::OrderBy(QQN::FedexShipment()->PackageLength), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FedexShipment()->PackageLength, false)));
			$this->colPackageWidth = new QDataGridColumn(QApplication::Translate('Package Width'), '<?= $_ITEM->PackageWidth; ?>', array('OrderByClause' => QQ::OrderBy(QQN::FedexShipment()->PackageWidth), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FedexShipment()->PackageWidth, false)));
			$this->colPackageHeight = new QDataGridColumn(QApplication::Translate('Package Height'), '<?= $_ITEM->PackageHeight; ?>', array('OrderByClause' => QQ::OrderBy(QQN::FedexShipment()->PackageHeight), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FedexShipment()->PackageHeight, false)));
			$this->colDeclaredValue = new QDataGridColumn(QApplication::Translate('Declared Value'), '<?= $_ITEM->DeclaredValue; ?>', array('OrderByClause' => QQ::OrderBy(QQN::FedexShipment()->DeclaredValue), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FedexShipment()->DeclaredValue, false)));
			$this->colReference = new QDataGridColumn(QApplication::Translate('Reference'), '<?= QString::Truncate($_ITEM->Reference, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::FedexShipment()->Reference), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FedexShipment()->Reference, false)));
			$this->colSaturdayDeliveryFlag = new QDataGridColumn(QApplication::Translate('Saturday Delivery Flag'), '<?= ($_ITEM->SaturdayDeliveryFlag) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::FedexShipment()->SaturdayDeliveryFlag), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FedexShipment()->SaturdayDeliveryFlag, false)));
			$this->colNotifySenderEmail = new QDataGridColumn(QApplication::Translate('Notify Sender Email'), '<?= QString::Truncate($_ITEM->NotifySenderEmail, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::FedexShipment()->NotifySenderEmail), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FedexShipment()->NotifySenderEmail, false)));
			$this->colNotifySenderShipFlag = new QDataGridColumn(QApplication::Translate('Notify Sender Ship Flag'), '<?= ($_ITEM->NotifySenderShipFlag) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::FedexShipment()->NotifySenderShipFlag), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FedexShipment()->NotifySenderShipFlag, false)));
			$this->colNotifySenderExceptionFlag = new QDataGridColumn(QApplication::Translate('Notify Sender Exception Flag'), '<?= ($_ITEM->NotifySenderExceptionFlag) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::FedexShipment()->NotifySenderExceptionFlag), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FedexShipment()->NotifySenderExceptionFlag, false)));
			$this->colNotifySenderDeliveryFlag = new QDataGridColumn(QApplication::Translate('Notify Sender Delivery Flag'), '<?= ($_ITEM->NotifySenderDeliveryFlag) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::FedexShipment()->NotifySenderDeliveryFlag), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FedexShipment()->NotifySenderDeliveryFlag, false)));
			$this->colNotifyRecipientEmail = new QDataGridColumn(QApplication::Translate('Notify Recipient Email'), '<?= QString::Truncate($_ITEM->NotifyRecipientEmail, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::FedexShipment()->NotifyRecipientEmail), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FedexShipment()->NotifyRecipientEmail, false)));
			$this->colNotifyRecipientShipFlag = new QDataGridColumn(QApplication::Translate('Notify Recipient Ship Flag'), '<?= ($_ITEM->NotifyRecipientShipFlag) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::FedexShipment()->NotifyRecipientShipFlag), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FedexShipment()->NotifyRecipientShipFlag, false)));
			$this->colNotifyRecipientExceptionFlag = new QDataGridColumn(QApplication::Translate('Notify Recipient Exception Flag'), '<?= ($_ITEM->NotifyRecipientExceptionFlag) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::FedexShipment()->NotifyRecipientExceptionFlag), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FedexShipment()->NotifyRecipientExceptionFlag, false)));
			$this->colNotifyRecipientDeliveryFlag = new QDataGridColumn(QApplication::Translate('Notify Recipient Delivery Flag'), '<?= ($_ITEM->NotifyRecipientDeliveryFlag) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::FedexShipment()->NotifyRecipientDeliveryFlag), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FedexShipment()->NotifyRecipientDeliveryFlag, false)));
			$this->colNotifyOtherEmail = new QDataGridColumn(QApplication::Translate('Notify Other Email'), '<?= QString::Truncate($_ITEM->NotifyOtherEmail, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::FedexShipment()->NotifyOtherEmail), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FedexShipment()->NotifyOtherEmail, false)));
			$this->colNotifyOtherShipFlag = new QDataGridColumn(QApplication::Translate('Notify Other Ship Flag'), '<?= ($_ITEM->NotifyOtherShipFlag) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::FedexShipment()->NotifyOtherShipFlag), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FedexShipment()->NotifyOtherShipFlag, false)));
			$this->colNotifyOtherExceptionFlag = new QDataGridColumn(QApplication::Translate('Notify Other Exception Flag'), '<?= ($_ITEM->NotifyOtherExceptionFlag) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::FedexShipment()->NotifyOtherExceptionFlag), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FedexShipment()->NotifyOtherExceptionFlag, false)));
			$this->colNotifyOtherDeliveryFlag = new QDataGridColumn(QApplication::Translate('Notify Other Delivery Flag'), '<?= ($_ITEM->NotifyOtherDeliveryFlag) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::FedexShipment()->NotifyOtherDeliveryFlag), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FedexShipment()->NotifyOtherDeliveryFlag, false)));
			$this->colHoldAtLocationFlag = new QDataGridColumn(QApplication::Translate('Hold At Location Flag'), '<?= ($_ITEM->HoldAtLocationFlag) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::FedexShipment()->HoldAtLocationFlag), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FedexShipment()->HoldAtLocationFlag, false)));
			$this->colHoldAtLocationAddress = new QDataGridColumn(QApplication::Translate('Hold At Location Address'), '<?= QString::Truncate($_ITEM->HoldAtLocationAddress, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::FedexShipment()->HoldAtLocationAddress), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FedexShipment()->HoldAtLocationAddress, false)));
			$this->colHoldAtLocationCity = new QDataGridColumn(QApplication::Translate('Hold At Location City'), '<?= QString::Truncate($_ITEM->HoldAtLocationCity, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::FedexShipment()->HoldAtLocationCity), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FedexShipment()->HoldAtLocationCity, false)));
			$this->colHoldAtLocationState = new QDataGridColumn(QApplication::Translate('Hold At Location State'), '<?= $_FORM->dtgFedexShipment_HoldAtLocationStateObject_Render($_ITEM); ?>');
			$this->colHoldAtLocationPostalCode = new QDataGridColumn(QApplication::Translate('Hold At Location Postal Code'), '<?= QString::Truncate($_ITEM->HoldAtLocationPostalCode, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::FedexShipment()->HoldAtLocationPostalCode), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FedexShipment()->HoldAtLocationPostalCode, false)));

			// Setup DataGrid
			$this->dtgFedexShipment = new QDataGrid($this);
			$this->dtgFedexShipment->CellSpacing = 0;
			$this->dtgFedexShipment->CellPadding = 4;
			$this->dtgFedexShipment->BorderStyle = QBorderStyle::Solid;
			$this->dtgFedexShipment->BorderWidth = 1;
			$this->dtgFedexShipment->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgFedexShipment->Paginator = new QPaginator($this->dtgFedexShipment);
			$this->dtgFedexShipment->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgFedexShipment->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgFedexShipment->SetDataBinder('dtgFedexShipment_Bind');

			$this->dtgFedexShipment->AddColumn($this->colEditLinkColumn);
			$this->dtgFedexShipment->AddColumn($this->colFedexShipmentId);
			$this->dtgFedexShipment->AddColumn($this->colShipmentId);
			$this->dtgFedexShipment->AddColumn($this->colPackageTypeId);
			$this->dtgFedexShipment->AddColumn($this->colShippingAccountId);
			$this->dtgFedexShipment->AddColumn($this->colFedexServiceTypeId);
			$this->dtgFedexShipment->AddColumn($this->colCurrencyUnitId);
			$this->dtgFedexShipment->AddColumn($this->colWeightUnitId);
			$this->dtgFedexShipment->AddColumn($this->colLengthUnitId);
			$this->dtgFedexShipment->AddColumn($this->colToPhone);
			$this->dtgFedexShipment->AddColumn($this->colPayType);
			$this->dtgFedexShipment->AddColumn($this->colPayerAccountNumber);
			$this->dtgFedexShipment->AddColumn($this->colPackageWeight);
			$this->dtgFedexShipment->AddColumn($this->colPackageLength);
			$this->dtgFedexShipment->AddColumn($this->colPackageWidth);
			$this->dtgFedexShipment->AddColumn($this->colPackageHeight);
			$this->dtgFedexShipment->AddColumn($this->colDeclaredValue);
			$this->dtgFedexShipment->AddColumn($this->colReference);
			$this->dtgFedexShipment->AddColumn($this->colSaturdayDeliveryFlag);
			$this->dtgFedexShipment->AddColumn($this->colNotifySenderEmail);
			$this->dtgFedexShipment->AddColumn($this->colNotifySenderShipFlag);
			$this->dtgFedexShipment->AddColumn($this->colNotifySenderExceptionFlag);
			$this->dtgFedexShipment->AddColumn($this->colNotifySenderDeliveryFlag);
			$this->dtgFedexShipment->AddColumn($this->colNotifyRecipientEmail);
			$this->dtgFedexShipment->AddColumn($this->colNotifyRecipientShipFlag);
			$this->dtgFedexShipment->AddColumn($this->colNotifyRecipientExceptionFlag);
			$this->dtgFedexShipment->AddColumn($this->colNotifyRecipientDeliveryFlag);
			$this->dtgFedexShipment->AddColumn($this->colNotifyOtherEmail);
			$this->dtgFedexShipment->AddColumn($this->colNotifyOtherShipFlag);
			$this->dtgFedexShipment->AddColumn($this->colNotifyOtherExceptionFlag);
			$this->dtgFedexShipment->AddColumn($this->colNotifyOtherDeliveryFlag);
			$this->dtgFedexShipment->AddColumn($this->colHoldAtLocationFlag);
			$this->dtgFedexShipment->AddColumn($this->colHoldAtLocationAddress);
			$this->dtgFedexShipment->AddColumn($this->colHoldAtLocationCity);
			$this->dtgFedexShipment->AddColumn($this->colHoldAtLocationState);
			$this->dtgFedexShipment->AddColumn($this->colHoldAtLocationPostalCode);
		}
		
		public function dtgFedexShipment_EditLinkColumn_Render(FedexShipment $objFedexShipment) {
			return sprintf('<a href="fedex_shipment_edit.php?intFedexShipmentId=%s">%s</a>',
				$objFedexShipment->FedexShipmentId, 
				QApplication::Translate('Edit'));
		}

		public function dtgFedexShipment_Shipment_Render(FedexShipment $objFedexShipment) {
			if (!is_null($objFedexShipment->Shipment))
				return $objFedexShipment->Shipment->__toString();
			else
				return null;
		}

		public function dtgFedexShipment_PackageType_Render(FedexShipment $objFedexShipment) {
			if (!is_null($objFedexShipment->PackageType))
				return $objFedexShipment->PackageType->__toString();
			else
				return null;
		}

		public function dtgFedexShipment_ShippingAccount_Render(FedexShipment $objFedexShipment) {
			if (!is_null($objFedexShipment->ShippingAccount))
				return $objFedexShipment->ShippingAccount->__toString();
			else
				return null;
		}

		public function dtgFedexShipment_FedexServiceType_Render(FedexShipment $objFedexShipment) {
			if (!is_null($objFedexShipment->FedexServiceType))
				return $objFedexShipment->FedexServiceType->__toString();
			else
				return null;
		}

		public function dtgFedexShipment_CurrencyUnit_Render(FedexShipment $objFedexShipment) {
			if (!is_null($objFedexShipment->CurrencyUnit))
				return $objFedexShipment->CurrencyUnit->__toString();
			else
				return null;
		}

		public function dtgFedexShipment_WeightUnit_Render(FedexShipment $objFedexShipment) {
			if (!is_null($objFedexShipment->WeightUnit))
				return $objFedexShipment->WeightUnit->__toString();
			else
				return null;
		}

		public function dtgFedexShipment_LengthUnit_Render(FedexShipment $objFedexShipment) {
			if (!is_null($objFedexShipment->LengthUnit))
				return $objFedexShipment->LengthUnit->__toString();
			else
				return null;
		}

		public function dtgFedexShipment_HoldAtLocationStateObject_Render(FedexShipment $objFedexShipment) {
			if (!is_null($objFedexShipment->HoldAtLocationStateObject))
				return $objFedexShipment->HoldAtLocationStateObject->__toString();
			else
				return null;
		}


		protected function dtgFedexShipment_Bind() {
			// Because we want to enable pagination AND sorting, we need to setup the $objClauses array to send to LoadAll()

			// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
			$this->dtgFedexShipment->TotalItemCount = FedexShipment::CountAll();

			// Setup the $objClauses Array
			$objClauses = array();

			// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
			// the OrderByClause to the $objClauses array
			if ($objClause = $this->dtgFedexShipment->OrderByClause)
				array_push($objClauses, $objClause);

			// Add the LimitClause information, as well
			if ($objClause = $this->dtgFedexShipment->LimitClause)
				array_push($objClauses, $objClause);

			// Set the DataSource to be the array of all FedexShipment objects, given the clauses above
			$this->dtgFedexShipment->DataSource = FedexShipment::LoadAll($objClauses);
		}
	}
?>