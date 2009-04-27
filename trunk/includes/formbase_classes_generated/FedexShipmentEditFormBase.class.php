<?php
	/**
	 * This is the abstract Form class for the Create, Edit, and Delete functionality
	 * of the FedexShipment class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML form that can
	 * manipulate a single FedexShipment object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this FedexShipmentEditFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class FedexShipmentEditFormBase extends QForm {
		// General Form Variables
		protected $objFedexShipment;
		protected $strTitleVerb;
		protected $blnEditMode;

		// Controls for FedexShipment's Data Fields
		protected $lblFedexShipmentId;
		protected $lstShipment;
		protected $lstPackageType;
		protected $lstShippingAccount;
		protected $lstFedexServiceType;
		protected $lstCurrencyUnit;
		protected $lstWeightUnit;
		protected $lstLengthUnit;
		protected $txtToPhone;
		protected $txtPayType;
		protected $txtPayerAccountNumber;
		protected $txtPackageWeight;
		protected $txtPackageLength;
		protected $txtPackageWidth;
		protected $txtPackageHeight;
		protected $txtDeclaredValue;
		protected $txtReference;
		protected $chkSaturdayDeliveryFlag;
		protected $txtNotifySenderEmail;
		protected $chkNotifySenderShipFlag;
		protected $chkNotifySenderExceptionFlag;
		protected $chkNotifySenderDeliveryFlag;
		protected $txtNotifyRecipientEmail;
		protected $chkNotifyRecipientShipFlag;
		protected $chkNotifyRecipientExceptionFlag;
		protected $chkNotifyRecipientDeliveryFlag;
		protected $txtNotifyOtherEmail;
		protected $chkNotifyOtherShipFlag;
		protected $chkNotifyOtherExceptionFlag;
		protected $chkNotifyOtherDeliveryFlag;
		protected $chkHoldAtLocationFlag;
		protected $txtHoldAtLocationAddress;
		protected $txtHoldAtLocationCity;
		protected $lstHoldAtLocationStateObject;
		protected $txtHoldAtLocationPostalCode;

		// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Button Actions
		protected $btnSave;
		protected $btnCancel;
		protected $btnDelete;

		protected function SetupFedexShipment() {
			// Lookup Object PK information from Query String (if applicable)
			// Set mode to Edit or New depending on what's found
			$intFedexShipmentId = QApplication::QueryString('intFedexShipmentId');
			if (($intFedexShipmentId)) {
				$this->objFedexShipment = FedexShipment::Load(($intFedexShipmentId));

				if (!$this->objFedexShipment)
					throw new Exception('Could not find a FedexShipment object with PK arguments: ' . $intFedexShipmentId);

				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->objFedexShipment = new FedexShipment();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		protected function Form_Create() {
			// Call SetupFedexShipment to either Load/Edit Existing or Create New
			$this->SetupFedexShipment();

			// Create/Setup Controls for FedexShipment's Data Fields
			$this->lblFedexShipmentId_Create();
			$this->lstShipment_Create();
			$this->lstPackageType_Create();
			$this->lstShippingAccount_Create();
			$this->lstFedexServiceType_Create();
			$this->lstCurrencyUnit_Create();
			$this->lstWeightUnit_Create();
			$this->lstLengthUnit_Create();
			$this->txtToPhone_Create();
			$this->txtPayType_Create();
			$this->txtPayerAccountNumber_Create();
			$this->txtPackageWeight_Create();
			$this->txtPackageLength_Create();
			$this->txtPackageWidth_Create();
			$this->txtPackageHeight_Create();
			$this->txtDeclaredValue_Create();
			$this->txtReference_Create();
			$this->chkSaturdayDeliveryFlag_Create();
			$this->txtNotifySenderEmail_Create();
			$this->chkNotifySenderShipFlag_Create();
			$this->chkNotifySenderExceptionFlag_Create();
			$this->chkNotifySenderDeliveryFlag_Create();
			$this->txtNotifyRecipientEmail_Create();
			$this->chkNotifyRecipientShipFlag_Create();
			$this->chkNotifyRecipientExceptionFlag_Create();
			$this->chkNotifyRecipientDeliveryFlag_Create();
			$this->txtNotifyOtherEmail_Create();
			$this->chkNotifyOtherShipFlag_Create();
			$this->chkNotifyOtherExceptionFlag_Create();
			$this->chkNotifyOtherDeliveryFlag_Create();
			$this->chkHoldAtLocationFlag_Create();
			$this->txtHoldAtLocationAddress_Create();
			$this->txtHoldAtLocationCity_Create();
			$this->lstHoldAtLocationStateObject_Create();
			$this->txtHoldAtLocationPostalCode_Create();

			// Create/Setup ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

			// Create/Setup Button Action controls
			$this->btnSave_Create();
			$this->btnCancel_Create();
			$this->btnDelete_Create();
		}

		// Protected Create Methods
		// Create and Setup lblFedexShipmentId
		protected function lblFedexShipmentId_Create() {
			$this->lblFedexShipmentId = new QLabel($this);
			$this->lblFedexShipmentId->Name = QApplication::Translate('Fedex Shipment Id');
			if ($this->blnEditMode)
				$this->lblFedexShipmentId->Text = $this->objFedexShipment->FedexShipmentId;
			else
				$this->lblFedexShipmentId->Text = 'N/A';
		}

		// Create and Setup lstShipment
		protected function lstShipment_Create() {
			$this->lstShipment = new QListBox($this);
			$this->lstShipment->Name = QApplication::Translate('Shipment');
			$this->lstShipment->Required = true;
			if (!$this->blnEditMode)
				$this->lstShipment->AddItem(QApplication::Translate('- Select One -'), null);
			$objShipmentArray = Shipment::LoadAll();
			if ($objShipmentArray) foreach ($objShipmentArray as $objShipment) {
				$objListItem = new QListItem($objShipment->__toString(), $objShipment->ShipmentId);
				if (($this->objFedexShipment->Shipment) && ($this->objFedexShipment->Shipment->ShipmentId == $objShipment->ShipmentId))
					$objListItem->Selected = true;
				$this->lstShipment->AddItem($objListItem);
			}
		}

		// Create and Setup lstPackageType
		protected function lstPackageType_Create() {
			$this->lstPackageType = new QListBox($this);
			$this->lstPackageType->Name = QApplication::Translate('Package Type');
			$this->lstPackageType->AddItem(QApplication::Translate('- Select One -'), null);
			$objPackageTypeArray = PackageType::LoadAll();
			if ($objPackageTypeArray) foreach ($objPackageTypeArray as $objPackageType) {
				$objListItem = new QListItem($objPackageType->__toString(), $objPackageType->PackageTypeId);
				if (($this->objFedexShipment->PackageType) && ($this->objFedexShipment->PackageType->PackageTypeId == $objPackageType->PackageTypeId))
					$objListItem->Selected = true;
				$this->lstPackageType->AddItem($objListItem);
			}
		}

		// Create and Setup lstShippingAccount
		protected function lstShippingAccount_Create() {
			$this->lstShippingAccount = new QListBox($this);
			$this->lstShippingAccount->Name = QApplication::Translate('Shipping Account');
			$this->lstShippingAccount->AddItem(QApplication::Translate('- Select One -'), null);
			$objShippingAccountArray = ShippingAccount::LoadAll();
			if ($objShippingAccountArray) foreach ($objShippingAccountArray as $objShippingAccount) {
				$objListItem = new QListItem($objShippingAccount->__toString(), $objShippingAccount->ShippingAccountId);
				if (($this->objFedexShipment->ShippingAccount) && ($this->objFedexShipment->ShippingAccount->ShippingAccountId == $objShippingAccount->ShippingAccountId))
					$objListItem->Selected = true;
				$this->lstShippingAccount->AddItem($objListItem);
			}
		}

		// Create and Setup lstFedexServiceType
		protected function lstFedexServiceType_Create() {
			$this->lstFedexServiceType = new QListBox($this);
			$this->lstFedexServiceType->Name = QApplication::Translate('Fedex Service Type');
			$this->lstFedexServiceType->AddItem(QApplication::Translate('- Select One -'), null);
			$objFedexServiceTypeArray = FedexServiceType::LoadAll();
			if ($objFedexServiceTypeArray) foreach ($objFedexServiceTypeArray as $objFedexServiceType) {
				$objListItem = new QListItem($objFedexServiceType->__toString(), $objFedexServiceType->FedexServiceTypeId);
				if (($this->objFedexShipment->FedexServiceType) && ($this->objFedexShipment->FedexServiceType->FedexServiceTypeId == $objFedexServiceType->FedexServiceTypeId))
					$objListItem->Selected = true;
				$this->lstFedexServiceType->AddItem($objListItem);
			}
		}

		// Create and Setup lstCurrencyUnit
		protected function lstCurrencyUnit_Create() {
			$this->lstCurrencyUnit = new QListBox($this);
			$this->lstCurrencyUnit->Name = QApplication::Translate('Currency Unit');
			$this->lstCurrencyUnit->AddItem(QApplication::Translate('- Select One -'), null);
			$objCurrencyUnitArray = CurrencyUnit::LoadAll();
			if ($objCurrencyUnitArray) foreach ($objCurrencyUnitArray as $objCurrencyUnit) {
				$objListItem = new QListItem($objCurrencyUnit->__toString(), $objCurrencyUnit->CurrencyUnitId);
				if (($this->objFedexShipment->CurrencyUnit) && ($this->objFedexShipment->CurrencyUnit->CurrencyUnitId == $objCurrencyUnit->CurrencyUnitId))
					$objListItem->Selected = true;
				$this->lstCurrencyUnit->AddItem($objListItem);
			}
		}

		// Create and Setup lstWeightUnit
		protected function lstWeightUnit_Create() {
			$this->lstWeightUnit = new QListBox($this);
			$this->lstWeightUnit->Name = QApplication::Translate('Weight Unit');
			$this->lstWeightUnit->AddItem(QApplication::Translate('- Select One -'), null);
			$objWeightUnitArray = WeightUnit::LoadAll();
			if ($objWeightUnitArray) foreach ($objWeightUnitArray as $objWeightUnit) {
				$objListItem = new QListItem($objWeightUnit->__toString(), $objWeightUnit->WeightUnitId);
				if (($this->objFedexShipment->WeightUnit) && ($this->objFedexShipment->WeightUnit->WeightUnitId == $objWeightUnit->WeightUnitId))
					$objListItem->Selected = true;
				$this->lstWeightUnit->AddItem($objListItem);
			}
		}

		// Create and Setup lstLengthUnit
		protected function lstLengthUnit_Create() {
			$this->lstLengthUnit = new QListBox($this);
			$this->lstLengthUnit->Name = QApplication::Translate('Length Unit');
			$this->lstLengthUnit->AddItem(QApplication::Translate('- Select One -'), null);
			$objLengthUnitArray = LengthUnit::LoadAll();
			if ($objLengthUnitArray) foreach ($objLengthUnitArray as $objLengthUnit) {
				$objListItem = new QListItem($objLengthUnit->__toString(), $objLengthUnit->LengthUnitId);
				if (($this->objFedexShipment->LengthUnit) && ($this->objFedexShipment->LengthUnit->LengthUnitId == $objLengthUnit->LengthUnitId))
					$objListItem->Selected = true;
				$this->lstLengthUnit->AddItem($objListItem);
			}
		}

		// Create and Setup txtToPhone
		protected function txtToPhone_Create() {
			$this->txtToPhone = new QTextBox($this);
			$this->txtToPhone->Name = QApplication::Translate('To Phone');
			$this->txtToPhone->Text = $this->objFedexShipment->ToPhone;
			$this->txtToPhone->MaxLength = FedexShipment::ToPhoneMaxLength;
		}

		// Create and Setup txtPayType
		protected function txtPayType_Create() {
			$this->txtPayType = new QIntegerTextBox($this);
			$this->txtPayType->Name = QApplication::Translate('Pay Type');
			$this->txtPayType->Text = $this->objFedexShipment->PayType;
		}

		// Create and Setup txtPayerAccountNumber
		protected function txtPayerAccountNumber_Create() {
			$this->txtPayerAccountNumber = new QTextBox($this);
			$this->txtPayerAccountNumber->Name = QApplication::Translate('Payer Account Number');
			$this->txtPayerAccountNumber->Text = $this->objFedexShipment->PayerAccountNumber;
			$this->txtPayerAccountNumber->MaxLength = FedexShipment::PayerAccountNumberMaxLength;
		}

		// Create and Setup txtPackageWeight
		protected function txtPackageWeight_Create() {
			$this->txtPackageWeight = new QFloatTextBox($this);
			$this->txtPackageWeight->Name = QApplication::Translate('Package Weight');
			$this->txtPackageWeight->Text = $this->objFedexShipment->PackageWeight;
		}

		// Create and Setup txtPackageLength
		protected function txtPackageLength_Create() {
			$this->txtPackageLength = new QFloatTextBox($this);
			$this->txtPackageLength->Name = QApplication::Translate('Package Length');
			$this->txtPackageLength->Text = $this->objFedexShipment->PackageLength;
		}

		// Create and Setup txtPackageWidth
		protected function txtPackageWidth_Create() {
			$this->txtPackageWidth = new QFloatTextBox($this);
			$this->txtPackageWidth->Name = QApplication::Translate('Package Width');
			$this->txtPackageWidth->Text = $this->objFedexShipment->PackageWidth;
		}

		// Create and Setup txtPackageHeight
		protected function txtPackageHeight_Create() {
			$this->txtPackageHeight = new QFloatTextBox($this);
			$this->txtPackageHeight->Name = QApplication::Translate('Package Height');
			$this->txtPackageHeight->Text = $this->objFedexShipment->PackageHeight;
		}

		// Create and Setup txtDeclaredValue
		protected function txtDeclaredValue_Create() {
			$this->txtDeclaredValue = new QFloatTextBox($this);
			$this->txtDeclaredValue->Name = QApplication::Translate('Declared Value');
			$this->txtDeclaredValue->Text = $this->objFedexShipment->DeclaredValue;
		}

		// Create and Setup txtReference
		protected function txtReference_Create() {
			$this->txtReference = new QTextBox($this);
			$this->txtReference->Name = QApplication::Translate('Reference');
			$this->txtReference->Text = $this->objFedexShipment->Reference;
			$this->txtReference->TextMode = QTextMode::MultiLine;
		}

		// Create and Setup chkSaturdayDeliveryFlag
		protected function chkSaturdayDeliveryFlag_Create() {
			$this->chkSaturdayDeliveryFlag = new QCheckBox($this);
			$this->chkSaturdayDeliveryFlag->Name = QApplication::Translate('Saturday Delivery Flag');
			$this->chkSaturdayDeliveryFlag->Checked = $this->objFedexShipment->SaturdayDeliveryFlag;
		}

		// Create and Setup txtNotifySenderEmail
		protected function txtNotifySenderEmail_Create() {
			$this->txtNotifySenderEmail = new QTextBox($this);
			$this->txtNotifySenderEmail->Name = QApplication::Translate('Notify Sender Email');
			$this->txtNotifySenderEmail->Text = $this->objFedexShipment->NotifySenderEmail;
			$this->txtNotifySenderEmail->MaxLength = FedexShipment::NotifySenderEmailMaxLength;
		}

		// Create and Setup chkNotifySenderShipFlag
		protected function chkNotifySenderShipFlag_Create() {
			$this->chkNotifySenderShipFlag = new QCheckBox($this);
			$this->chkNotifySenderShipFlag->Name = QApplication::Translate('Notify Sender Ship Flag');
			$this->chkNotifySenderShipFlag->Checked = $this->objFedexShipment->NotifySenderShipFlag;
		}

		// Create and Setup chkNotifySenderExceptionFlag
		protected function chkNotifySenderExceptionFlag_Create() {
			$this->chkNotifySenderExceptionFlag = new QCheckBox($this);
			$this->chkNotifySenderExceptionFlag->Name = QApplication::Translate('Notify Sender Exception Flag');
			$this->chkNotifySenderExceptionFlag->Checked = $this->objFedexShipment->NotifySenderExceptionFlag;
		}

		// Create and Setup chkNotifySenderDeliveryFlag
		protected function chkNotifySenderDeliveryFlag_Create() {
			$this->chkNotifySenderDeliveryFlag = new QCheckBox($this);
			$this->chkNotifySenderDeliveryFlag->Name = QApplication::Translate('Notify Sender Delivery Flag');
			$this->chkNotifySenderDeliveryFlag->Checked = $this->objFedexShipment->NotifySenderDeliveryFlag;
		}

		// Create and Setup txtNotifyRecipientEmail
		protected function txtNotifyRecipientEmail_Create() {
			$this->txtNotifyRecipientEmail = new QTextBox($this);
			$this->txtNotifyRecipientEmail->Name = QApplication::Translate('Notify Recipient Email');
			$this->txtNotifyRecipientEmail->Text = $this->objFedexShipment->NotifyRecipientEmail;
			$this->txtNotifyRecipientEmail->MaxLength = FedexShipment::NotifyRecipientEmailMaxLength;
		}

		// Create and Setup chkNotifyRecipientShipFlag
		protected function chkNotifyRecipientShipFlag_Create() {
			$this->chkNotifyRecipientShipFlag = new QCheckBox($this);
			$this->chkNotifyRecipientShipFlag->Name = QApplication::Translate('Notify Recipient Ship Flag');
			$this->chkNotifyRecipientShipFlag->Checked = $this->objFedexShipment->NotifyRecipientShipFlag;
		}

		// Create and Setup chkNotifyRecipientExceptionFlag
		protected function chkNotifyRecipientExceptionFlag_Create() {
			$this->chkNotifyRecipientExceptionFlag = new QCheckBox($this);
			$this->chkNotifyRecipientExceptionFlag->Name = QApplication::Translate('Notify Recipient Exception Flag');
			$this->chkNotifyRecipientExceptionFlag->Checked = $this->objFedexShipment->NotifyRecipientExceptionFlag;
		}

		// Create and Setup chkNotifyRecipientDeliveryFlag
		protected function chkNotifyRecipientDeliveryFlag_Create() {
			$this->chkNotifyRecipientDeliveryFlag = new QCheckBox($this);
			$this->chkNotifyRecipientDeliveryFlag->Name = QApplication::Translate('Notify Recipient Delivery Flag');
			$this->chkNotifyRecipientDeliveryFlag->Checked = $this->objFedexShipment->NotifyRecipientDeliveryFlag;
		}

		// Create and Setup txtNotifyOtherEmail
		protected function txtNotifyOtherEmail_Create() {
			$this->txtNotifyOtherEmail = new QTextBox($this);
			$this->txtNotifyOtherEmail->Name = QApplication::Translate('Notify Other Email');
			$this->txtNotifyOtherEmail->Text = $this->objFedexShipment->NotifyOtherEmail;
			$this->txtNotifyOtherEmail->MaxLength = FedexShipment::NotifyOtherEmailMaxLength;
		}

		// Create and Setup chkNotifyOtherShipFlag
		protected function chkNotifyOtherShipFlag_Create() {
			$this->chkNotifyOtherShipFlag = new QCheckBox($this);
			$this->chkNotifyOtherShipFlag->Name = QApplication::Translate('Notify Other Ship Flag');
			$this->chkNotifyOtherShipFlag->Checked = $this->objFedexShipment->NotifyOtherShipFlag;
		}

		// Create and Setup chkNotifyOtherExceptionFlag
		protected function chkNotifyOtherExceptionFlag_Create() {
			$this->chkNotifyOtherExceptionFlag = new QCheckBox($this);
			$this->chkNotifyOtherExceptionFlag->Name = QApplication::Translate('Notify Other Exception Flag');
			$this->chkNotifyOtherExceptionFlag->Checked = $this->objFedexShipment->NotifyOtherExceptionFlag;
		}

		// Create and Setup chkNotifyOtherDeliveryFlag
		protected function chkNotifyOtherDeliveryFlag_Create() {
			$this->chkNotifyOtherDeliveryFlag = new QCheckBox($this);
			$this->chkNotifyOtherDeliveryFlag->Name = QApplication::Translate('Notify Other Delivery Flag');
			$this->chkNotifyOtherDeliveryFlag->Checked = $this->objFedexShipment->NotifyOtherDeliveryFlag;
		}

		// Create and Setup chkHoldAtLocationFlag
		protected function chkHoldAtLocationFlag_Create() {
			$this->chkHoldAtLocationFlag = new QCheckBox($this);
			$this->chkHoldAtLocationFlag->Name = QApplication::Translate('Hold At Location Flag');
			$this->chkHoldAtLocationFlag->Checked = $this->objFedexShipment->HoldAtLocationFlag;
		}

		// Create and Setup txtHoldAtLocationAddress
		protected function txtHoldAtLocationAddress_Create() {
			$this->txtHoldAtLocationAddress = new QTextBox($this);
			$this->txtHoldAtLocationAddress->Name = QApplication::Translate('Hold At Location Address');
			$this->txtHoldAtLocationAddress->Text = $this->objFedexShipment->HoldAtLocationAddress;
			$this->txtHoldAtLocationAddress->MaxLength = FedexShipment::HoldAtLocationAddressMaxLength;
		}

		// Create and Setup txtHoldAtLocationCity
		protected function txtHoldAtLocationCity_Create() {
			$this->txtHoldAtLocationCity = new QTextBox($this);
			$this->txtHoldAtLocationCity->Name = QApplication::Translate('Hold At Location City');
			$this->txtHoldAtLocationCity->Text = $this->objFedexShipment->HoldAtLocationCity;
			$this->txtHoldAtLocationCity->MaxLength = FedexShipment::HoldAtLocationCityMaxLength;
		}

		// Create and Setup lstHoldAtLocationStateObject
		protected function lstHoldAtLocationStateObject_Create() {
			$this->lstHoldAtLocationStateObject = new QListBox($this);
			$this->lstHoldAtLocationStateObject->Name = QApplication::Translate('Hold At Location State Object');
			$this->lstHoldAtLocationStateObject->AddItem(QApplication::Translate('- Select One -'), null);
			$objHoldAtLocationStateObjectArray = StateProvince::LoadAll();
			if ($objHoldAtLocationStateObjectArray) foreach ($objHoldAtLocationStateObjectArray as $objHoldAtLocationStateObject) {
				$objListItem = new QListItem($objHoldAtLocationStateObject->__toString(), $objHoldAtLocationStateObject->StateProvinceId);
				if (($this->objFedexShipment->HoldAtLocationStateObject) && ($this->objFedexShipment->HoldAtLocationStateObject->StateProvinceId == $objHoldAtLocationStateObject->StateProvinceId))
					$objListItem->Selected = true;
				$this->lstHoldAtLocationStateObject->AddItem($objListItem);
			}
		}

		// Create and Setup txtHoldAtLocationPostalCode
		protected function txtHoldAtLocationPostalCode_Create() {
			$this->txtHoldAtLocationPostalCode = new QTextBox($this);
			$this->txtHoldAtLocationPostalCode->Name = QApplication::Translate('Hold At Location Postal Code');
			$this->txtHoldAtLocationPostalCode->Text = $this->objFedexShipment->HoldAtLocationPostalCode;
			$this->txtHoldAtLocationPostalCode->MaxLength = FedexShipment::HoldAtLocationPostalCodeMaxLength;
		}


		// Setup btnSave
		protected function btnSave_Create() {
			$this->btnSave = new QButton($this);
			$this->btnSave->Text = QApplication::Translate('Save');
			$this->btnSave->AddAction(new QClickEvent(), new QServerAction('btnSave_Click'));
			$this->btnSave->PrimaryButton = true;
			$this->btnSave->CausesValidation = true;
		}

		// Setup btnCancel
		protected function btnCancel_Create() {
			$this->btnCancel = new QButton($this);
			$this->btnCancel->Text = QApplication::Translate('Cancel');
			$this->btnCancel->AddAction(new QClickEvent(), new QServerAction('btnCancel_Click'));
			$this->btnCancel->CausesValidation = false;
		}

		// Setup btnDelete
		protected function btnDelete_Create() {
			$this->btnDelete = new QButton($this);
			$this->btnDelete->Text = QApplication::Translate('Delete');
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'FedexShipment')));
			$this->btnDelete->AddAction(new QClickEvent(), new QServerAction('btnDelete_Click'));
			$this->btnDelete->CausesValidation = false;
			if (!$this->blnEditMode)
				$this->btnDelete->Visible = false;
		}
		
		// Protected Update Methods
		protected function UpdateFedexShipmentFields() {
			$this->objFedexShipment->ShipmentId = $this->lstShipment->SelectedValue;
			$this->objFedexShipment->PackageTypeId = $this->lstPackageType->SelectedValue;
			$this->objFedexShipment->ShippingAccountId = $this->lstShippingAccount->SelectedValue;
			$this->objFedexShipment->FedexServiceTypeId = $this->lstFedexServiceType->SelectedValue;
			$this->objFedexShipment->CurrencyUnitId = $this->lstCurrencyUnit->SelectedValue;
			$this->objFedexShipment->WeightUnitId = $this->lstWeightUnit->SelectedValue;
			$this->objFedexShipment->LengthUnitId = $this->lstLengthUnit->SelectedValue;
			$this->objFedexShipment->ToPhone = $this->txtToPhone->Text;
			$this->objFedexShipment->PayType = $this->txtPayType->Text;
			$this->objFedexShipment->PayerAccountNumber = $this->txtPayerAccountNumber->Text;
			$this->objFedexShipment->PackageWeight = $this->txtPackageWeight->Text;
			$this->objFedexShipment->PackageLength = $this->txtPackageLength->Text;
			$this->objFedexShipment->PackageWidth = $this->txtPackageWidth->Text;
			$this->objFedexShipment->PackageHeight = $this->txtPackageHeight->Text;
			$this->objFedexShipment->DeclaredValue = $this->txtDeclaredValue->Text;
			$this->objFedexShipment->Reference = $this->txtReference->Text;
			$this->objFedexShipment->SaturdayDeliveryFlag = $this->chkSaturdayDeliveryFlag->Checked;
			$this->objFedexShipment->NotifySenderEmail = $this->txtNotifySenderEmail->Text;
			$this->objFedexShipment->NotifySenderShipFlag = $this->chkNotifySenderShipFlag->Checked;
			$this->objFedexShipment->NotifySenderExceptionFlag = $this->chkNotifySenderExceptionFlag->Checked;
			$this->objFedexShipment->NotifySenderDeliveryFlag = $this->chkNotifySenderDeliveryFlag->Checked;
			$this->objFedexShipment->NotifyRecipientEmail = $this->txtNotifyRecipientEmail->Text;
			$this->objFedexShipment->NotifyRecipientShipFlag = $this->chkNotifyRecipientShipFlag->Checked;
			$this->objFedexShipment->NotifyRecipientExceptionFlag = $this->chkNotifyRecipientExceptionFlag->Checked;
			$this->objFedexShipment->NotifyRecipientDeliveryFlag = $this->chkNotifyRecipientDeliveryFlag->Checked;
			$this->objFedexShipment->NotifyOtherEmail = $this->txtNotifyOtherEmail->Text;
			$this->objFedexShipment->NotifyOtherShipFlag = $this->chkNotifyOtherShipFlag->Checked;
			$this->objFedexShipment->NotifyOtherExceptionFlag = $this->chkNotifyOtherExceptionFlag->Checked;
			$this->objFedexShipment->NotifyOtherDeliveryFlag = $this->chkNotifyOtherDeliveryFlag->Checked;
			$this->objFedexShipment->HoldAtLocationFlag = $this->chkHoldAtLocationFlag->Checked;
			$this->objFedexShipment->HoldAtLocationAddress = $this->txtHoldAtLocationAddress->Text;
			$this->objFedexShipment->HoldAtLocationCity = $this->txtHoldAtLocationCity->Text;
			$this->objFedexShipment->HoldAtLocationState = $this->lstHoldAtLocationStateObject->SelectedValue;
			$this->objFedexShipment->HoldAtLocationPostalCode = $this->txtHoldAtLocationPostalCode->Text;
		}


		// Control ServerActions
		protected function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->UpdateFedexShipmentFields();
			$this->objFedexShipment->Save();


			$this->RedirectToListPage();
		}

		protected function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->RedirectToListPage();
		}

		protected function btnDelete_Click($strFormId, $strControlId, $strParameter) {

			$this->objFedexShipment->Delete();

			$this->RedirectToListPage();
		}
		
		protected function RedirectToListPage() {
			QApplication::Redirect('fedex_shipment_list.php');
		}
	}
?>