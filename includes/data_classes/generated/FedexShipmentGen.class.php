<?php
	/**
	 * The abstract FedexShipmentGen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the FedexShipment subclass which
	 * extends this FedexShipmentGen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the FedexShipment class.
	 * 
	 * @package My Application
	 * @subpackage GeneratedDataObjects
	 * 
	 */
	class FedexShipmentGen extends QBaseClass {
		///////////////////////////////
		// COMMON LOAD METHODS
		///////////////////////////////

		/**
		 * Load a FedexShipment from PK Info
		 * @param integer $intFedexShipmentId
		 * @return FedexShipment
		 */
		public static function Load($intFedexShipmentId) {
			// Use QuerySingle to Perform the Query
			return FedexShipment::QuerySingle(
				QQ::Equal(QQN::FedexShipment()->FedexShipmentId, $intFedexShipmentId)
			);
		}

		/**
		 * Load all FedexShipments
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return FedexShipment[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			// Call FedexShipment::QueryArray to perform the LoadAll query
			try {
				return FedexShipment::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all FedexShipments
		 * @return int
		 */
		public static function CountAll() {
			// Call FedexShipment::QueryCount to perform the CountAll query
			return FedexShipment::QueryCount(QQ::All());
		}



		///////////////////////////////
		// QCODO QUERY-RELATED METHODS
		///////////////////////////////

		/**
		 * Static method to retrieve the Database object that owns this class.
		 * @return QDatabaseBase reference to the Database object that can query this class
		 */
		public static function GetDatabase() {
			return QApplication::$Database[1];
		}

		/**
		 * Internally called method to assist with calling Qcodo Query for this class
		 * on load methods.
		 * @param QQueryBuilder &$objQueryBuilder the QueryBuilder object that will be created
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with (sending in null will skip the PrepareStatement step)
		 * @param boolean $blnCountOnly only select a rowcount
		 * @return string the query statement
		 */
		protected static function BuildQueryStatement(&$objQueryBuilder, QQCondition $objConditions, $objOptionalClauses, $mixParameterArray, $blnCountOnly) {
			// Get the Database Object for this Class
			$objDatabase = FedexShipment::GetDatabase();

			// Create/Build out the QueryBuilder object with FedexShipment-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, 'fedex_shipment');
			FedexShipment::GetSelectFields($objQueryBuilder);
			$objQueryBuilder->AddFromItem('`fedex_shipment` AS `fedex_shipment`');

			// Set "CountOnly" option (if applicable)
			if ($blnCountOnly)
				$objQueryBuilder->SetCountOnlyFlag();

			// Apply Any Conditions
			if ($objConditions)
				$objConditions->UpdateQueryBuilder($objQueryBuilder);

			// Iterate through all the Optional Clauses (if any) and perform accordingly
			if ($objOptionalClauses) {
				if (!is_array($objOptionalClauses))
					throw new QCallerException('Optional Clauses must be a QQ::Clause() or an array of QQClause objects');
				foreach ($objOptionalClauses as $objClause)
					$objClause->UpdateQueryBuilder($objQueryBuilder);
			}

			// Get the SQL Statement
			$strQuery = $objQueryBuilder->GetStatement();

			// Prepare the Statement with the Query Parameters (if applicable)
			if ($mixParameterArray) {
				if (is_array($mixParameterArray)) {
					if (count($mixParameterArray))
						$strQuery = $objDatabase->PrepareStatement($strQuery, $mixParameterArray);

					// Ensure that there are no other Unresolved Named Parameters
					if (strpos($strQuery, chr(QQNamedValue::DelimiterCode) . '{') !== false)
						throw new QCallerException('Unresolved named parameters in the query');
				} else
					throw new QCallerException('Parameter Array must be an array of name-value parameter pairs');
			}

			// Return the Objects
			return $strQuery;
		}

		/**
		 * Static Qcodo Query method to query for a single FedexShipment object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return FedexShipment the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = FedexShipment::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query, Get the First Row, and Instantiate a new FedexShipment object
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return FedexShipment::InstantiateDbRow($objDbResult->GetNextRow());
		}

		/**
		 * Static Qcodo Query method to query for an array of FedexShipment objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return FedexShipment[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = FedexShipment::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return FedexShipment::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
		}

		/**
		 * Static Qcodo Query method to query for a count of FedexShipment objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = FedexShipment::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and return the row_count
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);

			// Figure out if the query is using GroupBy
			$blnGrouped = false;

			if ($objOptionalClauses) foreach ($objOptionalClauses as $objClause) {
				if ($objClause instanceof QQGroupBy) {
					$blnGrouped = true;
					break;
				}
			}

			if ($blnGrouped)
				// Groups in this query - return the count of Groups (which is the count of all rows)
				return $objDbResult->CountRows();
			else {
				// No Groups - return the sql-calculated count(*) value
				$strDbRow = $objDbResult->FetchRow();
				return QType::Cast($strDbRow[0], QType::Integer);
			}
		}

/*		public static function QueryArrayCached($strConditions, $mixParameterArray = null) {
			// Get the Database Object for this Class
			$objDatabase = FedexShipment::GetDatabase();

			// Lookup the QCache for This Query Statement
			$objCache = new QCache('query', 'fedex_shipment_' . serialize($strConditions));
			if (!($strQuery = $objCache->GetData())) {
				// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with FedexShipment-specific fields
				$objQueryBuilder = new QQueryBuilder($objDatabase);
				FedexShipment::GetSelectFields($objQueryBuilder);
				FedexShipment::GetFromFields($objQueryBuilder);

				// Ensure the Passed-in Conditions is a string
				try {
					$strConditions = QType::Cast($strConditions, QType::String);
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

				// Create the Conditions object, and apply it
				$objConditions = eval('return ' . $strConditions . ';');

				// Apply Any Conditions
				if ($objConditions)
					$objConditions->UpdateQueryBuilder($objQueryBuilder);

				// Get the SQL Statement
				$strQuery = $objQueryBuilder->GetStatement();

				// Save the SQL Statement in the Cache
				$objCache->SaveData($strQuery);
			}

			// Prepare the Statement with the Parameters
			if ($mixParameterArray)
				$strQuery = $objDatabase->PrepareStatement($strQuery, $mixParameterArray);

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objDatabase->Query($strQuery);
			return FedexShipment::InstantiateDbResult($objDbResult);
		}*/

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this FedexShipment
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null) {
			if ($strPrefix) {
				$strTableName = '`' . $strPrefix . '`';
				$strAliasPrefix = '`' . $strPrefix . '__';
			} else {
				$strTableName = '`fedex_shipment`';
				$strAliasPrefix = '`';
			}

			$objBuilder->AddSelectItem($strTableName . '.`fedex_shipment_id` AS ' . $strAliasPrefix . 'fedex_shipment_id`');
			$objBuilder->AddSelectItem($strTableName . '.`shipment_id` AS ' . $strAliasPrefix . 'shipment_id`');
			$objBuilder->AddSelectItem($strTableName . '.`package_type_id` AS ' . $strAliasPrefix . 'package_type_id`');
			$objBuilder->AddSelectItem($strTableName . '.`shipping_account_id` AS ' . $strAliasPrefix . 'shipping_account_id`');
			$objBuilder->AddSelectItem($strTableName . '.`fedex_service_type_id` AS ' . $strAliasPrefix . 'fedex_service_type_id`');
			$objBuilder->AddSelectItem($strTableName . '.`currency_unit_id` AS ' . $strAliasPrefix . 'currency_unit_id`');
			$objBuilder->AddSelectItem($strTableName . '.`weight_unit_id` AS ' . $strAliasPrefix . 'weight_unit_id`');
			$objBuilder->AddSelectItem($strTableName . '.`length_unit_id` AS ' . $strAliasPrefix . 'length_unit_id`');
			$objBuilder->AddSelectItem($strTableName . '.`to_phone` AS ' . $strAliasPrefix . 'to_phone`');
			$objBuilder->AddSelectItem($strTableName . '.`pay_type` AS ' . $strAliasPrefix . 'pay_type`');
			$objBuilder->AddSelectItem($strTableName . '.`payer_account_number` AS ' . $strAliasPrefix . 'payer_account_number`');
			$objBuilder->AddSelectItem($strTableName . '.`package_weight` AS ' . $strAliasPrefix . 'package_weight`');
			$objBuilder->AddSelectItem($strTableName . '.`package_length` AS ' . $strAliasPrefix . 'package_length`');
			$objBuilder->AddSelectItem($strTableName . '.`package_width` AS ' . $strAliasPrefix . 'package_width`');
			$objBuilder->AddSelectItem($strTableName . '.`package_height` AS ' . $strAliasPrefix . 'package_height`');
			$objBuilder->AddSelectItem($strTableName . '.`declared_value` AS ' . $strAliasPrefix . 'declared_value`');
			$objBuilder->AddSelectItem($strTableName . '.`reference` AS ' . $strAliasPrefix . 'reference`');
			$objBuilder->AddSelectItem($strTableName . '.`saturday_delivery_flag` AS ' . $strAliasPrefix . 'saturday_delivery_flag`');
			$objBuilder->AddSelectItem($strTableName . '.`notify_sender_email` AS ' . $strAliasPrefix . 'notify_sender_email`');
			$objBuilder->AddSelectItem($strTableName . '.`notify_sender_ship_flag` AS ' . $strAliasPrefix . 'notify_sender_ship_flag`');
			$objBuilder->AddSelectItem($strTableName . '.`notify_sender_exception_flag` AS ' . $strAliasPrefix . 'notify_sender_exception_flag`');
			$objBuilder->AddSelectItem($strTableName . '.`notify_sender_delivery_flag` AS ' . $strAliasPrefix . 'notify_sender_delivery_flag`');
			$objBuilder->AddSelectItem($strTableName . '.`notify_recipient_email` AS ' . $strAliasPrefix . 'notify_recipient_email`');
			$objBuilder->AddSelectItem($strTableName . '.`notify_recipient_ship_flag` AS ' . $strAliasPrefix . 'notify_recipient_ship_flag`');
			$objBuilder->AddSelectItem($strTableName . '.`notify_recipient_exception_flag` AS ' . $strAliasPrefix . 'notify_recipient_exception_flag`');
			$objBuilder->AddSelectItem($strTableName . '.`notify_recipient_delivery_flag` AS ' . $strAliasPrefix . 'notify_recipient_delivery_flag`');
			$objBuilder->AddSelectItem($strTableName . '.`notify_other_email` AS ' . $strAliasPrefix . 'notify_other_email`');
			$objBuilder->AddSelectItem($strTableName . '.`notify_other_ship_flag` AS ' . $strAliasPrefix . 'notify_other_ship_flag`');
			$objBuilder->AddSelectItem($strTableName . '.`notify_other_exception_flag` AS ' . $strAliasPrefix . 'notify_other_exception_flag`');
			$objBuilder->AddSelectItem($strTableName . '.`notify_other_delivery_flag` AS ' . $strAliasPrefix . 'notify_other_delivery_flag`');
			$objBuilder->AddSelectItem($strTableName . '.`hold_at_location_flag` AS ' . $strAliasPrefix . 'hold_at_location_flag`');
			$objBuilder->AddSelectItem($strTableName . '.`hold_at_location_address` AS ' . $strAliasPrefix . 'hold_at_location_address`');
			$objBuilder->AddSelectItem($strTableName . '.`hold_at_location_city` AS ' . $strAliasPrefix . 'hold_at_location_city`');
			$objBuilder->AddSelectItem($strTableName . '.`hold_at_location_state` AS ' . $strAliasPrefix . 'hold_at_location_state`');
			$objBuilder->AddSelectItem($strTableName . '.`hold_at_location_postal_code` AS ' . $strAliasPrefix . 'hold_at_location_postal_code`');
		}



		///////////////////////////////
		// INSTANTIATION-RELATED METHODS
		///////////////////////////////

		/**
		 * Instantiate a FedexShipment from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this FedexShipment::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param DatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @return FedexShipment
		*/
		public static function InstantiateDbRow($objDbRow, $strAliasPrefix = null, $strExpandAsArrayNodes = null, $objPreviousItem = null) {
			// If blank row, return null
			if (!$objDbRow)
				return null;


			// Create a new instance of the FedexShipment object
			$objToReturn = new FedexShipment();
			$objToReturn->__blnRestored = true;

			$objToReturn->intFedexShipmentId = $objDbRow->GetColumn($strAliasPrefix . 'fedex_shipment_id', 'Integer');
			$objToReturn->intShipmentId = $objDbRow->GetColumn($strAliasPrefix . 'shipment_id', 'Integer');
			$objToReturn->intPackageTypeId = $objDbRow->GetColumn($strAliasPrefix . 'package_type_id', 'Integer');
			$objToReturn->intShippingAccountId = $objDbRow->GetColumn($strAliasPrefix . 'shipping_account_id', 'Integer');
			$objToReturn->intFedexServiceTypeId = $objDbRow->GetColumn($strAliasPrefix . 'fedex_service_type_id', 'Integer');
			$objToReturn->intCurrencyUnitId = $objDbRow->GetColumn($strAliasPrefix . 'currency_unit_id', 'Integer');
			$objToReturn->intWeightUnitId = $objDbRow->GetColumn($strAliasPrefix . 'weight_unit_id', 'Integer');
			$objToReturn->intLengthUnitId = $objDbRow->GetColumn($strAliasPrefix . 'length_unit_id', 'Integer');
			$objToReturn->strToPhone = $objDbRow->GetColumn($strAliasPrefix . 'to_phone', 'VarChar');
			$objToReturn->intPayType = $objDbRow->GetColumn($strAliasPrefix . 'pay_type', 'Integer');
			$objToReturn->strPayerAccountNumber = $objDbRow->GetColumn($strAliasPrefix . 'payer_account_number', 'VarChar');
			$objToReturn->fltPackageWeight = $objDbRow->GetColumn($strAliasPrefix . 'package_weight', 'Float');
			$objToReturn->fltPackageLength = $objDbRow->GetColumn($strAliasPrefix . 'package_length', 'Float');
			$objToReturn->fltPackageWidth = $objDbRow->GetColumn($strAliasPrefix . 'package_width', 'Float');
			$objToReturn->fltPackageHeight = $objDbRow->GetColumn($strAliasPrefix . 'package_height', 'Float');
			$objToReturn->fltDeclaredValue = $objDbRow->GetColumn($strAliasPrefix . 'declared_value', 'Float');
			$objToReturn->strReference = $objDbRow->GetColumn($strAliasPrefix . 'reference', 'Blob');
			$objToReturn->blnSaturdayDeliveryFlag = $objDbRow->GetColumn($strAliasPrefix . 'saturday_delivery_flag', 'Bit');
			$objToReturn->strNotifySenderEmail = $objDbRow->GetColumn($strAliasPrefix . 'notify_sender_email', 'VarChar');
			$objToReturn->blnNotifySenderShipFlag = $objDbRow->GetColumn($strAliasPrefix . 'notify_sender_ship_flag', 'Bit');
			$objToReturn->blnNotifySenderExceptionFlag = $objDbRow->GetColumn($strAliasPrefix . 'notify_sender_exception_flag', 'Bit');
			$objToReturn->blnNotifySenderDeliveryFlag = $objDbRow->GetColumn($strAliasPrefix . 'notify_sender_delivery_flag', 'Bit');
			$objToReturn->strNotifyRecipientEmail = $objDbRow->GetColumn($strAliasPrefix . 'notify_recipient_email', 'VarChar');
			$objToReturn->blnNotifyRecipientShipFlag = $objDbRow->GetColumn($strAliasPrefix . 'notify_recipient_ship_flag', 'Bit');
			$objToReturn->blnNotifyRecipientExceptionFlag = $objDbRow->GetColumn($strAliasPrefix . 'notify_recipient_exception_flag', 'Bit');
			$objToReturn->blnNotifyRecipientDeliveryFlag = $objDbRow->GetColumn($strAliasPrefix . 'notify_recipient_delivery_flag', 'Bit');
			$objToReturn->strNotifyOtherEmail = $objDbRow->GetColumn($strAliasPrefix . 'notify_other_email', 'VarChar');
			$objToReturn->blnNotifyOtherShipFlag = $objDbRow->GetColumn($strAliasPrefix . 'notify_other_ship_flag', 'Bit');
			$objToReturn->blnNotifyOtherExceptionFlag = $objDbRow->GetColumn($strAliasPrefix . 'notify_other_exception_flag', 'Bit');
			$objToReturn->blnNotifyOtherDeliveryFlag = $objDbRow->GetColumn($strAliasPrefix . 'notify_other_delivery_flag', 'Bit');
			$objToReturn->blnHoldAtLocationFlag = $objDbRow->GetColumn($strAliasPrefix . 'hold_at_location_flag', 'Bit');
			$objToReturn->strHoldAtLocationAddress = $objDbRow->GetColumn($strAliasPrefix . 'hold_at_location_address', 'VarChar');
			$objToReturn->strHoldAtLocationCity = $objDbRow->GetColumn($strAliasPrefix . 'hold_at_location_city', 'VarChar');
			$objToReturn->intHoldAtLocationState = $objDbRow->GetColumn($strAliasPrefix . 'hold_at_location_state', 'Integer');
			$objToReturn->strHoldAtLocationPostalCode = $objDbRow->GetColumn($strAliasPrefix . 'hold_at_location_postal_code', 'VarChar');

			// Instantiate Virtual Attributes
			foreach ($objDbRow->GetColumnNameArray() as $strColumnName => $mixValue) {
				$strVirtualPrefix = $strAliasPrefix . '__';
				$strVirtualPrefixLength = strlen($strVirtualPrefix);
				if (substr($strColumnName, 0, $strVirtualPrefixLength) == $strVirtualPrefix)
					$objToReturn->__strVirtualAttributeArray[substr($strColumnName, $strVirtualPrefixLength)] = $mixValue;
			}

			// Prepare to Check for Early/Virtual Binding
			if (!$strAliasPrefix)
				$strAliasPrefix = 'fedex_shipment__';

			// Check for Shipment Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'shipment_id__shipment_id')))
				$objToReturn->objShipment = Shipment::InstantiateDbRow($objDbRow, $strAliasPrefix . 'shipment_id__', $strExpandAsArrayNodes);

			// Check for PackageType Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'package_type_id__package_type_id')))
				$objToReturn->objPackageType = PackageType::InstantiateDbRow($objDbRow, $strAliasPrefix . 'package_type_id__', $strExpandAsArrayNodes);

			// Check for ShippingAccount Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'shipping_account_id__shipping_account_id')))
				$objToReturn->objShippingAccount = ShippingAccount::InstantiateDbRow($objDbRow, $strAliasPrefix . 'shipping_account_id__', $strExpandAsArrayNodes);

			// Check for FedexServiceType Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'fedex_service_type_id__fedex_service_type_id')))
				$objToReturn->objFedexServiceType = FedexServiceType::InstantiateDbRow($objDbRow, $strAliasPrefix . 'fedex_service_type_id__', $strExpandAsArrayNodes);

			// Check for CurrencyUnit Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'currency_unit_id__currency_unit_id')))
				$objToReturn->objCurrencyUnit = CurrencyUnit::InstantiateDbRow($objDbRow, $strAliasPrefix . 'currency_unit_id__', $strExpandAsArrayNodes);

			// Check for WeightUnit Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'weight_unit_id__weight_unit_id')))
				$objToReturn->objWeightUnit = WeightUnit::InstantiateDbRow($objDbRow, $strAliasPrefix . 'weight_unit_id__', $strExpandAsArrayNodes);

			// Check for LengthUnit Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'length_unit_id__length_unit_id')))
				$objToReturn->objLengthUnit = LengthUnit::InstantiateDbRow($objDbRow, $strAliasPrefix . 'length_unit_id__', $strExpandAsArrayNodes);

			// Check for HoldAtLocationStateObject Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'hold_at_location_state__state_province_id')))
				$objToReturn->objHoldAtLocationStateObject = StateProvince::InstantiateDbRow($objDbRow, $strAliasPrefix . 'hold_at_location_state__', $strExpandAsArrayNodes);




			return $objToReturn;
		}

		/**
		 * Instantiate an array of FedexShipments from a Database Result
		 * @param DatabaseResultBase $objDbResult
		 * @return FedexShipment[]
		 */
		public static function InstantiateDbResult(QDatabaseResultBase $objDbResult, $strExpandAsArrayNodes = null) {
			$objToReturn = array();

			// If blank resultset, then return empty array
			if (!$objDbResult)
				return $objToReturn;

			// Load up the return array with each row
			if ($strExpandAsArrayNodes) {
				$objLastRowItem = null;
				while ($objDbRow = $objDbResult->GetNextRow()) {
					$objItem = FedexShipment::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
					if ($objItem) {
						array_push($objToReturn, $objItem);
						$objLastRowItem = $objItem;
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					array_push($objToReturn, FedexShipment::InstantiateDbRow($objDbRow));
			}

			return $objToReturn;
		}



		///////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Single Load and Array)
		///////////////////////////////////////////////////
			
		/**
		 * Load a single FedexShipment object,
		 * by FedexShipmentId Index(es)
		 * @param integer $intFedexShipmentId
		 * @return FedexShipment
		*/
		public static function LoadByFedexShipmentId($intFedexShipmentId) {
			return FedexShipment::QuerySingle(
				QQ::Equal(QQN::FedexShipment()->FedexShipmentId, $intFedexShipmentId)
			);
		}
			
		/**
		 * Load an array of FedexShipment objects,
		 * by ShippingAccountId Index(es)
		 * @param integer $intShippingAccountId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return FedexShipment[]
		*/
		public static function LoadArrayByShippingAccountId($intShippingAccountId, $objOptionalClauses = null) {
			// Call FedexShipment::QueryArray to perform the LoadArrayByShippingAccountId query
			try {
				return FedexShipment::QueryArray(
					QQ::Equal(QQN::FedexShipment()->ShippingAccountId, $intShippingAccountId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count FedexShipments
		 * by ShippingAccountId Index(es)
		 * @param integer $intShippingAccountId
		 * @return int
		*/
		public static function CountByShippingAccountId($intShippingAccountId) {
			// Call FedexShipment::QueryCount to perform the CountByShippingAccountId query
			return FedexShipment::QueryCount(
				QQ::Equal(QQN::FedexShipment()->ShippingAccountId, $intShippingAccountId)
			);
		}
			
		/**
		 * Load an array of FedexShipment objects,
		 * by ShipmentId Index(es)
		 * @param integer $intShipmentId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return FedexShipment[]
		*/
		public static function LoadArrayByShipmentId($intShipmentId, $objOptionalClauses = null) {
			// Call FedexShipment::QueryArray to perform the LoadArrayByShipmentId query
			try {
				return FedexShipment::QueryArray(
					QQ::Equal(QQN::FedexShipment()->ShipmentId, $intShipmentId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count FedexShipments
		 * by ShipmentId Index(es)
		 * @param integer $intShipmentId
		 * @return int
		*/
		public static function CountByShipmentId($intShipmentId) {
			// Call FedexShipment::QueryCount to perform the CountByShipmentId query
			return FedexShipment::QueryCount(
				QQ::Equal(QQN::FedexShipment()->ShipmentId, $intShipmentId)
			);
		}
			
		/**
		 * Load an array of FedexShipment objects,
		 * by FedexServiceTypeId Index(es)
		 * @param integer $intFedexServiceTypeId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return FedexShipment[]
		*/
		public static function LoadArrayByFedexServiceTypeId($intFedexServiceTypeId, $objOptionalClauses = null) {
			// Call FedexShipment::QueryArray to perform the LoadArrayByFedexServiceTypeId query
			try {
				return FedexShipment::QueryArray(
					QQ::Equal(QQN::FedexShipment()->FedexServiceTypeId, $intFedexServiceTypeId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count FedexShipments
		 * by FedexServiceTypeId Index(es)
		 * @param integer $intFedexServiceTypeId
		 * @return int
		*/
		public static function CountByFedexServiceTypeId($intFedexServiceTypeId) {
			// Call FedexShipment::QueryCount to perform the CountByFedexServiceTypeId query
			return FedexShipment::QueryCount(
				QQ::Equal(QQN::FedexShipment()->FedexServiceTypeId, $intFedexServiceTypeId)
			);
		}
			
		/**
		 * Load an array of FedexShipment objects,
		 * by LengthUnitId Index(es)
		 * @param integer $intLengthUnitId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return FedexShipment[]
		*/
		public static function LoadArrayByLengthUnitId($intLengthUnitId, $objOptionalClauses = null) {
			// Call FedexShipment::QueryArray to perform the LoadArrayByLengthUnitId query
			try {
				return FedexShipment::QueryArray(
					QQ::Equal(QQN::FedexShipment()->LengthUnitId, $intLengthUnitId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count FedexShipments
		 * by LengthUnitId Index(es)
		 * @param integer $intLengthUnitId
		 * @return int
		*/
		public static function CountByLengthUnitId($intLengthUnitId) {
			// Call FedexShipment::QueryCount to perform the CountByLengthUnitId query
			return FedexShipment::QueryCount(
				QQ::Equal(QQN::FedexShipment()->LengthUnitId, $intLengthUnitId)
			);
		}
			
		/**
		 * Load an array of FedexShipment objects,
		 * by WeightUnitId Index(es)
		 * @param integer $intWeightUnitId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return FedexShipment[]
		*/
		public static function LoadArrayByWeightUnitId($intWeightUnitId, $objOptionalClauses = null) {
			// Call FedexShipment::QueryArray to perform the LoadArrayByWeightUnitId query
			try {
				return FedexShipment::QueryArray(
					QQ::Equal(QQN::FedexShipment()->WeightUnitId, $intWeightUnitId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count FedexShipments
		 * by WeightUnitId Index(es)
		 * @param integer $intWeightUnitId
		 * @return int
		*/
		public static function CountByWeightUnitId($intWeightUnitId) {
			// Call FedexShipment::QueryCount to perform the CountByWeightUnitId query
			return FedexShipment::QueryCount(
				QQ::Equal(QQN::FedexShipment()->WeightUnitId, $intWeightUnitId)
			);
		}
			
		/**
		 * Load an array of FedexShipment objects,
		 * by CurrencyUnitId Index(es)
		 * @param integer $intCurrencyUnitId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return FedexShipment[]
		*/
		public static function LoadArrayByCurrencyUnitId($intCurrencyUnitId, $objOptionalClauses = null) {
			// Call FedexShipment::QueryArray to perform the LoadArrayByCurrencyUnitId query
			try {
				return FedexShipment::QueryArray(
					QQ::Equal(QQN::FedexShipment()->CurrencyUnitId, $intCurrencyUnitId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count FedexShipments
		 * by CurrencyUnitId Index(es)
		 * @param integer $intCurrencyUnitId
		 * @return int
		*/
		public static function CountByCurrencyUnitId($intCurrencyUnitId) {
			// Call FedexShipment::QueryCount to perform the CountByCurrencyUnitId query
			return FedexShipment::QueryCount(
				QQ::Equal(QQN::FedexShipment()->CurrencyUnitId, $intCurrencyUnitId)
			);
		}
			
		/**
		 * Load an array of FedexShipment objects,
		 * by PackageTypeId Index(es)
		 * @param integer $intPackageTypeId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return FedexShipment[]
		*/
		public static function LoadArrayByPackageTypeId($intPackageTypeId, $objOptionalClauses = null) {
			// Call FedexShipment::QueryArray to perform the LoadArrayByPackageTypeId query
			try {
				return FedexShipment::QueryArray(
					QQ::Equal(QQN::FedexShipment()->PackageTypeId, $intPackageTypeId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count FedexShipments
		 * by PackageTypeId Index(es)
		 * @param integer $intPackageTypeId
		 * @return int
		*/
		public static function CountByPackageTypeId($intPackageTypeId) {
			// Call FedexShipment::QueryCount to perform the CountByPackageTypeId query
			return FedexShipment::QueryCount(
				QQ::Equal(QQN::FedexShipment()->PackageTypeId, $intPackageTypeId)
			);
		}
			
		/**
		 * Load an array of FedexShipment objects,
		 * by HoldAtLocationState Index(es)
		 * @param integer $intHoldAtLocationState
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return FedexShipment[]
		*/
		public static function LoadArrayByHoldAtLocationState($intHoldAtLocationState, $objOptionalClauses = null) {
			// Call FedexShipment::QueryArray to perform the LoadArrayByHoldAtLocationState query
			try {
				return FedexShipment::QueryArray(
					QQ::Equal(QQN::FedexShipment()->HoldAtLocationState, $intHoldAtLocationState),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count FedexShipments
		 * by HoldAtLocationState Index(es)
		 * @param integer $intHoldAtLocationState
		 * @return int
		*/
		public static function CountByHoldAtLocationState($intHoldAtLocationState) {
			// Call FedexShipment::QueryCount to perform the CountByHoldAtLocationState query
			return FedexShipment::QueryCount(
				QQ::Equal(QQN::FedexShipment()->HoldAtLocationState, $intHoldAtLocationState)
			);
		}



		////////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Array via Many to Many)
		////////////////////////////////////////////////////



		//////////////////
		// SAVE AND DELETE
		//////////////////

		/**
		 * Save this FedexShipment
		 * @param bool $blnForceInsert
		 * @param bool $blnForceUpdate
		 * @return int
		*/
		public function Save($blnForceInsert = false, $blnForceUpdate = false) {
			// Get the Database Object for this Class
			$objDatabase = FedexShipment::GetDatabase();

			$mixToReturn = null;

			try {
				if ((!$this->__blnRestored) || ($blnForceInsert)) {
					// Perform an INSERT query
					$objDatabase->NonQuery('
						INSERT INTO `fedex_shipment` (
							`shipment_id`,
							`package_type_id`,
							`shipping_account_id`,
							`fedex_service_type_id`,
							`currency_unit_id`,
							`weight_unit_id`,
							`length_unit_id`,
							`to_phone`,
							`pay_type`,
							`payer_account_number`,
							`package_weight`,
							`package_length`,
							`package_width`,
							`package_height`,
							`declared_value`,
							`reference`,
							`saturday_delivery_flag`,
							`notify_sender_email`,
							`notify_sender_ship_flag`,
							`notify_sender_exception_flag`,
							`notify_sender_delivery_flag`,
							`notify_recipient_email`,
							`notify_recipient_ship_flag`,
							`notify_recipient_exception_flag`,
							`notify_recipient_delivery_flag`,
							`notify_other_email`,
							`notify_other_ship_flag`,
							`notify_other_exception_flag`,
							`notify_other_delivery_flag`,
							`hold_at_location_flag`,
							`hold_at_location_address`,
							`hold_at_location_city`,
							`hold_at_location_state`,
							`hold_at_location_postal_code`
						) VALUES (
							' . $objDatabase->SqlVariable($this->intShipmentId) . ',
							' . $objDatabase->SqlVariable($this->intPackageTypeId) . ',
							' . $objDatabase->SqlVariable($this->intShippingAccountId) . ',
							' . $objDatabase->SqlVariable($this->intFedexServiceTypeId) . ',
							' . $objDatabase->SqlVariable($this->intCurrencyUnitId) . ',
							' . $objDatabase->SqlVariable($this->intWeightUnitId) . ',
							' . $objDatabase->SqlVariable($this->intLengthUnitId) . ',
							' . $objDatabase->SqlVariable($this->strToPhone) . ',
							' . $objDatabase->SqlVariable($this->intPayType) . ',
							' . $objDatabase->SqlVariable($this->strPayerAccountNumber) . ',
							' . $objDatabase->SqlVariable($this->fltPackageWeight) . ',
							' . $objDatabase->SqlVariable($this->fltPackageLength) . ',
							' . $objDatabase->SqlVariable($this->fltPackageWidth) . ',
							' . $objDatabase->SqlVariable($this->fltPackageHeight) . ',
							' . $objDatabase->SqlVariable($this->fltDeclaredValue) . ',
							' . $objDatabase->SqlVariable($this->strReference) . ',
							' . $objDatabase->SqlVariable($this->blnSaturdayDeliveryFlag) . ',
							' . $objDatabase->SqlVariable($this->strNotifySenderEmail) . ',
							' . $objDatabase->SqlVariable($this->blnNotifySenderShipFlag) . ',
							' . $objDatabase->SqlVariable($this->blnNotifySenderExceptionFlag) . ',
							' . $objDatabase->SqlVariable($this->blnNotifySenderDeliveryFlag) . ',
							' . $objDatabase->SqlVariable($this->strNotifyRecipientEmail) . ',
							' . $objDatabase->SqlVariable($this->blnNotifyRecipientShipFlag) . ',
							' . $objDatabase->SqlVariable($this->blnNotifyRecipientExceptionFlag) . ',
							' . $objDatabase->SqlVariable($this->blnNotifyRecipientDeliveryFlag) . ',
							' . $objDatabase->SqlVariable($this->strNotifyOtherEmail) . ',
							' . $objDatabase->SqlVariable($this->blnNotifyOtherShipFlag) . ',
							' . $objDatabase->SqlVariable($this->blnNotifyOtherExceptionFlag) . ',
							' . $objDatabase->SqlVariable($this->blnNotifyOtherDeliveryFlag) . ',
							' . $objDatabase->SqlVariable($this->blnHoldAtLocationFlag) . ',
							' . $objDatabase->SqlVariable($this->strHoldAtLocationAddress) . ',
							' . $objDatabase->SqlVariable($this->strHoldAtLocationCity) . ',
							' . $objDatabase->SqlVariable($this->intHoldAtLocationState) . ',
							' . $objDatabase->SqlVariable($this->strHoldAtLocationPostalCode) . '
						)
					');

					// Update Identity column and return its value
					$mixToReturn = $this->intFedexShipmentId = $objDatabase->InsertId('fedex_shipment', 'fedex_shipment_id');
				} else {
					// Perform an UPDATE query

					// First checking for Optimistic Locking constraints (if applicable)

					// Perform the UPDATE query
					$objDatabase->NonQuery('
						UPDATE
							`fedex_shipment`
						SET
							`shipment_id` = ' . $objDatabase->SqlVariable($this->intShipmentId) . ',
							`package_type_id` = ' . $objDatabase->SqlVariable($this->intPackageTypeId) . ',
							`shipping_account_id` = ' . $objDatabase->SqlVariable($this->intShippingAccountId) . ',
							`fedex_service_type_id` = ' . $objDatabase->SqlVariable($this->intFedexServiceTypeId) . ',
							`currency_unit_id` = ' . $objDatabase->SqlVariable($this->intCurrencyUnitId) . ',
							`weight_unit_id` = ' . $objDatabase->SqlVariable($this->intWeightUnitId) . ',
							`length_unit_id` = ' . $objDatabase->SqlVariable($this->intLengthUnitId) . ',
							`to_phone` = ' . $objDatabase->SqlVariable($this->strToPhone) . ',
							`pay_type` = ' . $objDatabase->SqlVariable($this->intPayType) . ',
							`payer_account_number` = ' . $objDatabase->SqlVariable($this->strPayerAccountNumber) . ',
							`package_weight` = ' . $objDatabase->SqlVariable($this->fltPackageWeight) . ',
							`package_length` = ' . $objDatabase->SqlVariable($this->fltPackageLength) . ',
							`package_width` = ' . $objDatabase->SqlVariable($this->fltPackageWidth) . ',
							`package_height` = ' . $objDatabase->SqlVariable($this->fltPackageHeight) . ',
							`declared_value` = ' . $objDatabase->SqlVariable($this->fltDeclaredValue) . ',
							`reference` = ' . $objDatabase->SqlVariable($this->strReference) . ',
							`saturday_delivery_flag` = ' . $objDatabase->SqlVariable($this->blnSaturdayDeliveryFlag) . ',
							`notify_sender_email` = ' . $objDatabase->SqlVariable($this->strNotifySenderEmail) . ',
							`notify_sender_ship_flag` = ' . $objDatabase->SqlVariable($this->blnNotifySenderShipFlag) . ',
							`notify_sender_exception_flag` = ' . $objDatabase->SqlVariable($this->blnNotifySenderExceptionFlag) . ',
							`notify_sender_delivery_flag` = ' . $objDatabase->SqlVariable($this->blnNotifySenderDeliveryFlag) . ',
							`notify_recipient_email` = ' . $objDatabase->SqlVariable($this->strNotifyRecipientEmail) . ',
							`notify_recipient_ship_flag` = ' . $objDatabase->SqlVariable($this->blnNotifyRecipientShipFlag) . ',
							`notify_recipient_exception_flag` = ' . $objDatabase->SqlVariable($this->blnNotifyRecipientExceptionFlag) . ',
							`notify_recipient_delivery_flag` = ' . $objDatabase->SqlVariable($this->blnNotifyRecipientDeliveryFlag) . ',
							`notify_other_email` = ' . $objDatabase->SqlVariable($this->strNotifyOtherEmail) . ',
							`notify_other_ship_flag` = ' . $objDatabase->SqlVariable($this->blnNotifyOtherShipFlag) . ',
							`notify_other_exception_flag` = ' . $objDatabase->SqlVariable($this->blnNotifyOtherExceptionFlag) . ',
							`notify_other_delivery_flag` = ' . $objDatabase->SqlVariable($this->blnNotifyOtherDeliveryFlag) . ',
							`hold_at_location_flag` = ' . $objDatabase->SqlVariable($this->blnHoldAtLocationFlag) . ',
							`hold_at_location_address` = ' . $objDatabase->SqlVariable($this->strHoldAtLocationAddress) . ',
							`hold_at_location_city` = ' . $objDatabase->SqlVariable($this->strHoldAtLocationCity) . ',
							`hold_at_location_state` = ' . $objDatabase->SqlVariable($this->intHoldAtLocationState) . ',
							`hold_at_location_postal_code` = ' . $objDatabase->SqlVariable($this->strHoldAtLocationPostalCode) . '
						WHERE
							`fedex_shipment_id` = ' . $objDatabase->SqlVariable($this->intFedexShipmentId) . '
					');
				}

			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Update __blnRestored
			$this->__blnRestored = true;


			// Return 
			return $mixToReturn;
		}

				/**
		 * Delete this FedexShipment
		 * @return void
		*/
		public function Delete() {
			if ((is_null($this->intFedexShipmentId)))
				throw new QUndefinedPrimaryKeyException('Cannot delete this FedexShipment with an unset primary key.');

			// Get the Database Object for this Class
			$objDatabase = FedexShipment::GetDatabase();


			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`fedex_shipment`
				WHERE
					`fedex_shipment_id` = ' . $objDatabase->SqlVariable($this->intFedexShipmentId) . '');
		}

		/**
		 * Delete all FedexShipments
		 * @return void
		*/
		public static function DeleteAll() {
			// Get the Database Object for this Class
			$objDatabase = FedexShipment::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				DELETE FROM
					`fedex_shipment`');
		}

		/**
		 * Truncate fedex_shipment table
		 * @return void
		*/
		public static function Truncate() {
			// Get the Database Object for this Class
			$objDatabase = FedexShipment::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				TRUNCATE `fedex_shipment`');
		}



		////////////////////
		// PUBLIC OVERRIDERS
		////////////////////

				/**
		 * Override method to perform a property "Get"
		 * This will get the value of $strName
		 *
		 * @param string $strName Name of the property to get
		 * @return mixed
		 */
		public function __get($strName) {
			switch ($strName) {
				///////////////////
				// Member Variables
				///////////////////
				case 'FedexShipmentId':
					/**
					 * Gets the value for intFedexShipmentId (Read-Only PK)
					 * @return integer
					 */
					return $this->intFedexShipmentId;

				case 'ShipmentId':
					/**
					 * Gets the value for intShipmentId (Not Null)
					 * @return integer
					 */
					return $this->intShipmentId;

				case 'PackageTypeId':
					/**
					 * Gets the value for intPackageTypeId 
					 * @return integer
					 */
					return $this->intPackageTypeId;

				case 'ShippingAccountId':
					/**
					 * Gets the value for intShippingAccountId 
					 * @return integer
					 */
					return $this->intShippingAccountId;

				case 'FedexServiceTypeId':
					/**
					 * Gets the value for intFedexServiceTypeId 
					 * @return integer
					 */
					return $this->intFedexServiceTypeId;

				case 'CurrencyUnitId':
					/**
					 * Gets the value for intCurrencyUnitId 
					 * @return integer
					 */
					return $this->intCurrencyUnitId;

				case 'WeightUnitId':
					/**
					 * Gets the value for intWeightUnitId 
					 * @return integer
					 */
					return $this->intWeightUnitId;

				case 'LengthUnitId':
					/**
					 * Gets the value for intLengthUnitId 
					 * @return integer
					 */
					return $this->intLengthUnitId;

				case 'ToPhone':
					/**
					 * Gets the value for strToPhone 
					 * @return string
					 */
					return $this->strToPhone;

				case 'PayType':
					/**
					 * Gets the value for intPayType 
					 * @return integer
					 */
					return $this->intPayType;

				case 'PayerAccountNumber':
					/**
					 * Gets the value for strPayerAccountNumber 
					 * @return string
					 */
					return $this->strPayerAccountNumber;

				case 'PackageWeight':
					/**
					 * Gets the value for fltPackageWeight 
					 * @return double
					 */
					return $this->fltPackageWeight;

				case 'PackageLength':
					/**
					 * Gets the value for fltPackageLength 
					 * @return double
					 */
					return $this->fltPackageLength;

				case 'PackageWidth':
					/**
					 * Gets the value for fltPackageWidth 
					 * @return double
					 */
					return $this->fltPackageWidth;

				case 'PackageHeight':
					/**
					 * Gets the value for fltPackageHeight 
					 * @return double
					 */
					return $this->fltPackageHeight;

				case 'DeclaredValue':
					/**
					 * Gets the value for fltDeclaredValue 
					 * @return double
					 */
					return $this->fltDeclaredValue;

				case 'Reference':
					/**
					 * Gets the value for strReference 
					 * @return string
					 */
					return $this->strReference;

				case 'SaturdayDeliveryFlag':
					/**
					 * Gets the value for blnSaturdayDeliveryFlag 
					 * @return boolean
					 */
					return $this->blnSaturdayDeliveryFlag;

				case 'NotifySenderEmail':
					/**
					 * Gets the value for strNotifySenderEmail 
					 * @return string
					 */
					return $this->strNotifySenderEmail;

				case 'NotifySenderShipFlag':
					/**
					 * Gets the value for blnNotifySenderShipFlag 
					 * @return boolean
					 */
					return $this->blnNotifySenderShipFlag;

				case 'NotifySenderExceptionFlag':
					/**
					 * Gets the value for blnNotifySenderExceptionFlag 
					 * @return boolean
					 */
					return $this->blnNotifySenderExceptionFlag;

				case 'NotifySenderDeliveryFlag':
					/**
					 * Gets the value for blnNotifySenderDeliveryFlag 
					 * @return boolean
					 */
					return $this->blnNotifySenderDeliveryFlag;

				case 'NotifyRecipientEmail':
					/**
					 * Gets the value for strNotifyRecipientEmail 
					 * @return string
					 */
					return $this->strNotifyRecipientEmail;

				case 'NotifyRecipientShipFlag':
					/**
					 * Gets the value for blnNotifyRecipientShipFlag 
					 * @return boolean
					 */
					return $this->blnNotifyRecipientShipFlag;

				case 'NotifyRecipientExceptionFlag':
					/**
					 * Gets the value for blnNotifyRecipientExceptionFlag 
					 * @return boolean
					 */
					return $this->blnNotifyRecipientExceptionFlag;

				case 'NotifyRecipientDeliveryFlag':
					/**
					 * Gets the value for blnNotifyRecipientDeliveryFlag 
					 * @return boolean
					 */
					return $this->blnNotifyRecipientDeliveryFlag;

				case 'NotifyOtherEmail':
					/**
					 * Gets the value for strNotifyOtherEmail 
					 * @return string
					 */
					return $this->strNotifyOtherEmail;

				case 'NotifyOtherShipFlag':
					/**
					 * Gets the value for blnNotifyOtherShipFlag 
					 * @return boolean
					 */
					return $this->blnNotifyOtherShipFlag;

				case 'NotifyOtherExceptionFlag':
					/**
					 * Gets the value for blnNotifyOtherExceptionFlag 
					 * @return boolean
					 */
					return $this->blnNotifyOtherExceptionFlag;

				case 'NotifyOtherDeliveryFlag':
					/**
					 * Gets the value for blnNotifyOtherDeliveryFlag 
					 * @return boolean
					 */
					return $this->blnNotifyOtherDeliveryFlag;

				case 'HoldAtLocationFlag':
					/**
					 * Gets the value for blnHoldAtLocationFlag 
					 * @return boolean
					 */
					return $this->blnHoldAtLocationFlag;

				case 'HoldAtLocationAddress':
					/**
					 * Gets the value for strHoldAtLocationAddress 
					 * @return string
					 */
					return $this->strHoldAtLocationAddress;

				case 'HoldAtLocationCity':
					/**
					 * Gets the value for strHoldAtLocationCity 
					 * @return string
					 */
					return $this->strHoldAtLocationCity;

				case 'HoldAtLocationState':
					/**
					 * Gets the value for intHoldAtLocationState 
					 * @return integer
					 */
					return $this->intHoldAtLocationState;

				case 'HoldAtLocationPostalCode':
					/**
					 * Gets the value for strHoldAtLocationPostalCode 
					 * @return string
					 */
					return $this->strHoldAtLocationPostalCode;


				///////////////////
				// Member Objects
				///////////////////
				case 'Shipment':
					/**
					 * Gets the value for the Shipment object referenced by intShipmentId (Not Null)
					 * @return Shipment
					 */
					try {
						if ((!$this->objShipment) && (!is_null($this->intShipmentId)))
							$this->objShipment = Shipment::Load($this->intShipmentId);
						return $this->objShipment;
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'PackageType':
					/**
					 * Gets the value for the PackageType object referenced by intPackageTypeId 
					 * @return PackageType
					 */
					try {
						if ((!$this->objPackageType) && (!is_null($this->intPackageTypeId)))
							$this->objPackageType = PackageType::Load($this->intPackageTypeId);
						return $this->objPackageType;
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'ShippingAccount':
					/**
					 * Gets the value for the ShippingAccount object referenced by intShippingAccountId 
					 * @return ShippingAccount
					 */
					try {
						if ((!$this->objShippingAccount) && (!is_null($this->intShippingAccountId)))
							$this->objShippingAccount = ShippingAccount::Load($this->intShippingAccountId);
						return $this->objShippingAccount;
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'FedexServiceType':
					/**
					 * Gets the value for the FedexServiceType object referenced by intFedexServiceTypeId 
					 * @return FedexServiceType
					 */
					try {
						if ((!$this->objFedexServiceType) && (!is_null($this->intFedexServiceTypeId)))
							$this->objFedexServiceType = FedexServiceType::Load($this->intFedexServiceTypeId);
						return $this->objFedexServiceType;
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'CurrencyUnit':
					/**
					 * Gets the value for the CurrencyUnit object referenced by intCurrencyUnitId 
					 * @return CurrencyUnit
					 */
					try {
						if ((!$this->objCurrencyUnit) && (!is_null($this->intCurrencyUnitId)))
							$this->objCurrencyUnit = CurrencyUnit::Load($this->intCurrencyUnitId);
						return $this->objCurrencyUnit;
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'WeightUnit':
					/**
					 * Gets the value for the WeightUnit object referenced by intWeightUnitId 
					 * @return WeightUnit
					 */
					try {
						if ((!$this->objWeightUnit) && (!is_null($this->intWeightUnitId)))
							$this->objWeightUnit = WeightUnit::Load($this->intWeightUnitId);
						return $this->objWeightUnit;
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'LengthUnit':
					/**
					 * Gets the value for the LengthUnit object referenced by intLengthUnitId 
					 * @return LengthUnit
					 */
					try {
						if ((!$this->objLengthUnit) && (!is_null($this->intLengthUnitId)))
							$this->objLengthUnit = LengthUnit::Load($this->intLengthUnitId);
						return $this->objLengthUnit;
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'HoldAtLocationStateObject':
					/**
					 * Gets the value for the StateProvince object referenced by intHoldAtLocationState 
					 * @return StateProvince
					 */
					try {
						if ((!$this->objHoldAtLocationStateObject) && (!is_null($this->intHoldAtLocationState)))
							$this->objHoldAtLocationStateObject = StateProvince::Load($this->intHoldAtLocationState);
						return $this->objHoldAtLocationStateObject;
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}


				////////////////////////////
				// Virtual Object References (Many to Many and Reverse References)
				// (If restored via a "Many-to" expansion)
				////////////////////////////

				default:
					try {
						return parent::__get($strName);
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}

				/**
		 * Override method to perform a property "Set"
		 * This will set the property $strName to be $mixValue
		 *
		 * @param string $strName Name of the property to set
		 * @param string $mixValue New value of the property
		 * @return mixed
		 */
		public function __set($strName, $mixValue) {
			switch ($strName) {
				///////////////////
				// Member Variables
				///////////////////
				case 'ShipmentId':
					/**
					 * Sets the value for intShipmentId (Not Null)
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						$this->objShipment = null;
						return ($this->intShipmentId = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'PackageTypeId':
					/**
					 * Sets the value for intPackageTypeId 
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						$this->objPackageType = null;
						return ($this->intPackageTypeId = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'ShippingAccountId':
					/**
					 * Sets the value for intShippingAccountId 
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						$this->objShippingAccount = null;
						return ($this->intShippingAccountId = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'FedexServiceTypeId':
					/**
					 * Sets the value for intFedexServiceTypeId 
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						$this->objFedexServiceType = null;
						return ($this->intFedexServiceTypeId = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'CurrencyUnitId':
					/**
					 * Sets the value for intCurrencyUnitId 
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						$this->objCurrencyUnit = null;
						return ($this->intCurrencyUnitId = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'WeightUnitId':
					/**
					 * Sets the value for intWeightUnitId 
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						$this->objWeightUnit = null;
						return ($this->intWeightUnitId = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'LengthUnitId':
					/**
					 * Sets the value for intLengthUnitId 
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						$this->objLengthUnit = null;
						return ($this->intLengthUnitId = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'ToPhone':
					/**
					 * Sets the value for strToPhone 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strToPhone = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'PayType':
					/**
					 * Sets the value for intPayType 
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						return ($this->intPayType = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'PayerAccountNumber':
					/**
					 * Sets the value for strPayerAccountNumber 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strPayerAccountNumber = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'PackageWeight':
					/**
					 * Sets the value for fltPackageWeight 
					 * @param double $mixValue
					 * @return double
					 */
					try {
						return ($this->fltPackageWeight = QType::Cast($mixValue, QType::Float));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'PackageLength':
					/**
					 * Sets the value for fltPackageLength 
					 * @param double $mixValue
					 * @return double
					 */
					try {
						return ($this->fltPackageLength = QType::Cast($mixValue, QType::Float));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'PackageWidth':
					/**
					 * Sets the value for fltPackageWidth 
					 * @param double $mixValue
					 * @return double
					 */
					try {
						return ($this->fltPackageWidth = QType::Cast($mixValue, QType::Float));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'PackageHeight':
					/**
					 * Sets the value for fltPackageHeight 
					 * @param double $mixValue
					 * @return double
					 */
					try {
						return ($this->fltPackageHeight = QType::Cast($mixValue, QType::Float));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'DeclaredValue':
					/**
					 * Sets the value for fltDeclaredValue 
					 * @param double $mixValue
					 * @return double
					 */
					try {
						return ($this->fltDeclaredValue = QType::Cast($mixValue, QType::Float));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Reference':
					/**
					 * Sets the value for strReference 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strReference = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'SaturdayDeliveryFlag':
					/**
					 * Sets the value for blnSaturdayDeliveryFlag 
					 * @param boolean $mixValue
					 * @return boolean
					 */
					try {
						return ($this->blnSaturdayDeliveryFlag = QType::Cast($mixValue, QType::Boolean));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'NotifySenderEmail':
					/**
					 * Sets the value for strNotifySenderEmail 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strNotifySenderEmail = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'NotifySenderShipFlag':
					/**
					 * Sets the value for blnNotifySenderShipFlag 
					 * @param boolean $mixValue
					 * @return boolean
					 */
					try {
						return ($this->blnNotifySenderShipFlag = QType::Cast($mixValue, QType::Boolean));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'NotifySenderExceptionFlag':
					/**
					 * Sets the value for blnNotifySenderExceptionFlag 
					 * @param boolean $mixValue
					 * @return boolean
					 */
					try {
						return ($this->blnNotifySenderExceptionFlag = QType::Cast($mixValue, QType::Boolean));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'NotifySenderDeliveryFlag':
					/**
					 * Sets the value for blnNotifySenderDeliveryFlag 
					 * @param boolean $mixValue
					 * @return boolean
					 */
					try {
						return ($this->blnNotifySenderDeliveryFlag = QType::Cast($mixValue, QType::Boolean));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'NotifyRecipientEmail':
					/**
					 * Sets the value for strNotifyRecipientEmail 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strNotifyRecipientEmail = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'NotifyRecipientShipFlag':
					/**
					 * Sets the value for blnNotifyRecipientShipFlag 
					 * @param boolean $mixValue
					 * @return boolean
					 */
					try {
						return ($this->blnNotifyRecipientShipFlag = QType::Cast($mixValue, QType::Boolean));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'NotifyRecipientExceptionFlag':
					/**
					 * Sets the value for blnNotifyRecipientExceptionFlag 
					 * @param boolean $mixValue
					 * @return boolean
					 */
					try {
						return ($this->blnNotifyRecipientExceptionFlag = QType::Cast($mixValue, QType::Boolean));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'NotifyRecipientDeliveryFlag':
					/**
					 * Sets the value for blnNotifyRecipientDeliveryFlag 
					 * @param boolean $mixValue
					 * @return boolean
					 */
					try {
						return ($this->blnNotifyRecipientDeliveryFlag = QType::Cast($mixValue, QType::Boolean));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'NotifyOtherEmail':
					/**
					 * Sets the value for strNotifyOtherEmail 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strNotifyOtherEmail = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'NotifyOtherShipFlag':
					/**
					 * Sets the value for blnNotifyOtherShipFlag 
					 * @param boolean $mixValue
					 * @return boolean
					 */
					try {
						return ($this->blnNotifyOtherShipFlag = QType::Cast($mixValue, QType::Boolean));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'NotifyOtherExceptionFlag':
					/**
					 * Sets the value for blnNotifyOtherExceptionFlag 
					 * @param boolean $mixValue
					 * @return boolean
					 */
					try {
						return ($this->blnNotifyOtherExceptionFlag = QType::Cast($mixValue, QType::Boolean));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'NotifyOtherDeliveryFlag':
					/**
					 * Sets the value for blnNotifyOtherDeliveryFlag 
					 * @param boolean $mixValue
					 * @return boolean
					 */
					try {
						return ($this->blnNotifyOtherDeliveryFlag = QType::Cast($mixValue, QType::Boolean));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'HoldAtLocationFlag':
					/**
					 * Sets the value for blnHoldAtLocationFlag 
					 * @param boolean $mixValue
					 * @return boolean
					 */
					try {
						return ($this->blnHoldAtLocationFlag = QType::Cast($mixValue, QType::Boolean));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'HoldAtLocationAddress':
					/**
					 * Sets the value for strHoldAtLocationAddress 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strHoldAtLocationAddress = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'HoldAtLocationCity':
					/**
					 * Sets the value for strHoldAtLocationCity 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strHoldAtLocationCity = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'HoldAtLocationState':
					/**
					 * Sets the value for intHoldAtLocationState 
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						$this->objHoldAtLocationStateObject = null;
						return ($this->intHoldAtLocationState = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'HoldAtLocationPostalCode':
					/**
					 * Sets the value for strHoldAtLocationPostalCode 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strHoldAtLocationPostalCode = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}


				///////////////////
				// Member Objects
				///////////////////
				case 'Shipment':
					/**
					 * Sets the value for the Shipment object referenced by intShipmentId (Not Null)
					 * @param Shipment $mixValue
					 * @return Shipment
					 */
					if (is_null($mixValue)) {
						$this->intShipmentId = null;
						$this->objShipment = null;
						return null;
					} else {
						// Make sure $mixValue actually is a Shipment object
						try {
							$mixValue = QType::Cast($mixValue, 'Shipment');
						} catch (QInvalidCastException $objExc) {
							$objExc->IncrementOffset();
							throw $objExc;
						} 

						// Make sure $mixValue is a SAVED Shipment object
						if (is_null($mixValue->ShipmentId))
							throw new QCallerException('Unable to set an unsaved Shipment for this FedexShipment');

						// Update Local Member Variables
						$this->objShipment = $mixValue;
						$this->intShipmentId = $mixValue->ShipmentId;

						// Return $mixValue
						return $mixValue;
					}
					break;

				case 'PackageType':
					/**
					 * Sets the value for the PackageType object referenced by intPackageTypeId 
					 * @param PackageType $mixValue
					 * @return PackageType
					 */
					if (is_null($mixValue)) {
						$this->intPackageTypeId = null;
						$this->objPackageType = null;
						return null;
					} else {
						// Make sure $mixValue actually is a PackageType object
						try {
							$mixValue = QType::Cast($mixValue, 'PackageType');
						} catch (QInvalidCastException $objExc) {
							$objExc->IncrementOffset();
							throw $objExc;
						} 

						// Make sure $mixValue is a SAVED PackageType object
						if (is_null($mixValue->PackageTypeId))
							throw new QCallerException('Unable to set an unsaved PackageType for this FedexShipment');

						// Update Local Member Variables
						$this->objPackageType = $mixValue;
						$this->intPackageTypeId = $mixValue->PackageTypeId;

						// Return $mixValue
						return $mixValue;
					}
					break;

				case 'ShippingAccount':
					/**
					 * Sets the value for the ShippingAccount object referenced by intShippingAccountId 
					 * @param ShippingAccount $mixValue
					 * @return ShippingAccount
					 */
					if (is_null($mixValue)) {
						$this->intShippingAccountId = null;
						$this->objShippingAccount = null;
						return null;
					} else {
						// Make sure $mixValue actually is a ShippingAccount object
						try {
							$mixValue = QType::Cast($mixValue, 'ShippingAccount');
						} catch (QInvalidCastException $objExc) {
							$objExc->IncrementOffset();
							throw $objExc;
						} 

						// Make sure $mixValue is a SAVED ShippingAccount object
						if (is_null($mixValue->ShippingAccountId))
							throw new QCallerException('Unable to set an unsaved ShippingAccount for this FedexShipment');

						// Update Local Member Variables
						$this->objShippingAccount = $mixValue;
						$this->intShippingAccountId = $mixValue->ShippingAccountId;

						// Return $mixValue
						return $mixValue;
					}
					break;

				case 'FedexServiceType':
					/**
					 * Sets the value for the FedexServiceType object referenced by intFedexServiceTypeId 
					 * @param FedexServiceType $mixValue
					 * @return FedexServiceType
					 */
					if (is_null($mixValue)) {
						$this->intFedexServiceTypeId = null;
						$this->objFedexServiceType = null;
						return null;
					} else {
						// Make sure $mixValue actually is a FedexServiceType object
						try {
							$mixValue = QType::Cast($mixValue, 'FedexServiceType');
						} catch (QInvalidCastException $objExc) {
							$objExc->IncrementOffset();
							throw $objExc;
						} 

						// Make sure $mixValue is a SAVED FedexServiceType object
						if (is_null($mixValue->FedexServiceTypeId))
							throw new QCallerException('Unable to set an unsaved FedexServiceType for this FedexShipment');

						// Update Local Member Variables
						$this->objFedexServiceType = $mixValue;
						$this->intFedexServiceTypeId = $mixValue->FedexServiceTypeId;

						// Return $mixValue
						return $mixValue;
					}
					break;

				case 'CurrencyUnit':
					/**
					 * Sets the value for the CurrencyUnit object referenced by intCurrencyUnitId 
					 * @param CurrencyUnit $mixValue
					 * @return CurrencyUnit
					 */
					if (is_null($mixValue)) {
						$this->intCurrencyUnitId = null;
						$this->objCurrencyUnit = null;
						return null;
					} else {
						// Make sure $mixValue actually is a CurrencyUnit object
						try {
							$mixValue = QType::Cast($mixValue, 'CurrencyUnit');
						} catch (QInvalidCastException $objExc) {
							$objExc->IncrementOffset();
							throw $objExc;
						} 

						// Make sure $mixValue is a SAVED CurrencyUnit object
						if (is_null($mixValue->CurrencyUnitId))
							throw new QCallerException('Unable to set an unsaved CurrencyUnit for this FedexShipment');

						// Update Local Member Variables
						$this->objCurrencyUnit = $mixValue;
						$this->intCurrencyUnitId = $mixValue->CurrencyUnitId;

						// Return $mixValue
						return $mixValue;
					}
					break;

				case 'WeightUnit':
					/**
					 * Sets the value for the WeightUnit object referenced by intWeightUnitId 
					 * @param WeightUnit $mixValue
					 * @return WeightUnit
					 */
					if (is_null($mixValue)) {
						$this->intWeightUnitId = null;
						$this->objWeightUnit = null;
						return null;
					} else {
						// Make sure $mixValue actually is a WeightUnit object
						try {
							$mixValue = QType::Cast($mixValue, 'WeightUnit');
						} catch (QInvalidCastException $objExc) {
							$objExc->IncrementOffset();
							throw $objExc;
						} 

						// Make sure $mixValue is a SAVED WeightUnit object
						if (is_null($mixValue->WeightUnitId))
							throw new QCallerException('Unable to set an unsaved WeightUnit for this FedexShipment');

						// Update Local Member Variables
						$this->objWeightUnit = $mixValue;
						$this->intWeightUnitId = $mixValue->WeightUnitId;

						// Return $mixValue
						return $mixValue;
					}
					break;

				case 'LengthUnit':
					/**
					 * Sets the value for the LengthUnit object referenced by intLengthUnitId 
					 * @param LengthUnit $mixValue
					 * @return LengthUnit
					 */
					if (is_null($mixValue)) {
						$this->intLengthUnitId = null;
						$this->objLengthUnit = null;
						return null;
					} else {
						// Make sure $mixValue actually is a LengthUnit object
						try {
							$mixValue = QType::Cast($mixValue, 'LengthUnit');
						} catch (QInvalidCastException $objExc) {
							$objExc->IncrementOffset();
							throw $objExc;
						} 

						// Make sure $mixValue is a SAVED LengthUnit object
						if (is_null($mixValue->LengthUnitId))
							throw new QCallerException('Unable to set an unsaved LengthUnit for this FedexShipment');

						// Update Local Member Variables
						$this->objLengthUnit = $mixValue;
						$this->intLengthUnitId = $mixValue->LengthUnitId;

						// Return $mixValue
						return $mixValue;
					}
					break;

				case 'HoldAtLocationStateObject':
					/**
					 * Sets the value for the StateProvince object referenced by intHoldAtLocationState 
					 * @param StateProvince $mixValue
					 * @return StateProvince
					 */
					if (is_null($mixValue)) {
						$this->intHoldAtLocationState = null;
						$this->objHoldAtLocationStateObject = null;
						return null;
					} else {
						// Make sure $mixValue actually is a StateProvince object
						try {
							$mixValue = QType::Cast($mixValue, 'StateProvince');
						} catch (QInvalidCastException $objExc) {
							$objExc->IncrementOffset();
							throw $objExc;
						} 

						// Make sure $mixValue is a SAVED StateProvince object
						if (is_null($mixValue->StateProvinceId))
							throw new QCallerException('Unable to set an unsaved HoldAtLocationStateObject for this FedexShipment');

						// Update Local Member Variables
						$this->objHoldAtLocationStateObject = $mixValue;
						$this->intHoldAtLocationState = $mixValue->StateProvinceId;

						// Return $mixValue
						return $mixValue;
					}
					break;

				default:
					try {
						return parent::__set($strName, $mixValue);
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}

		/**
		 * Lookup a VirtualAttribute value (if applicable).  Returns NULL if none found.
		 * @param string $strName
		 * @return string
		 */
		public function GetVirtualAttribute($strName) {
			if (array_key_exists($strName, $this->__strVirtualAttributeArray))
				return $this->__strVirtualAttributeArray[$strName];
			return null;
		}



		///////////////////////////////
		// ASSOCIATED OBJECTS
		///////////////////////////////




		///////////////////////////////////////////////////////////////////////
		// PROTECTED MEMBER VARIABLES and TEXT FIELD MAXLENGTHS (if applicable)
		///////////////////////////////////////////////////////////////////////
		
		/**
		 * Protected member variable that maps to the database PK Identity column fedex_shipment.fedex_shipment_id
		 * @var integer intFedexShipmentId
		 */
		protected $intFedexShipmentId;
		const FedexShipmentIdDefault = null;


		/**
		 * Protected member variable that maps to the database column fedex_shipment.shipment_id
		 * @var integer intShipmentId
		 */
		protected $intShipmentId;
		const ShipmentIdDefault = null;


		/**
		 * Protected member variable that maps to the database column fedex_shipment.package_type_id
		 * @var integer intPackageTypeId
		 */
		protected $intPackageTypeId;
		const PackageTypeIdDefault = null;


		/**
		 * Protected member variable that maps to the database column fedex_shipment.shipping_account_id
		 * @var integer intShippingAccountId
		 */
		protected $intShippingAccountId;
		const ShippingAccountIdDefault = null;


		/**
		 * Protected member variable that maps to the database column fedex_shipment.fedex_service_type_id
		 * @var integer intFedexServiceTypeId
		 */
		protected $intFedexServiceTypeId;
		const FedexServiceTypeIdDefault = null;


		/**
		 * Protected member variable that maps to the database column fedex_shipment.currency_unit_id
		 * @var integer intCurrencyUnitId
		 */
		protected $intCurrencyUnitId;
		const CurrencyUnitIdDefault = null;


		/**
		 * Protected member variable that maps to the database column fedex_shipment.weight_unit_id
		 * @var integer intWeightUnitId
		 */
		protected $intWeightUnitId;
		const WeightUnitIdDefault = null;


		/**
		 * Protected member variable that maps to the database column fedex_shipment.length_unit_id
		 * @var integer intLengthUnitId
		 */
		protected $intLengthUnitId;
		const LengthUnitIdDefault = null;


		/**
		 * Protected member variable that maps to the database column fedex_shipment.to_phone
		 * @var string strToPhone
		 */
		protected $strToPhone;
		const ToPhoneMaxLength = 25;
		const ToPhoneDefault = null;


		/**
		 * Protected member variable that maps to the database column fedex_shipment.pay_type
		 * @var integer intPayType
		 */
		protected $intPayType;
		const PayTypeDefault = null;


		/**
		 * Protected member variable that maps to the database column fedex_shipment.payer_account_number
		 * @var string strPayerAccountNumber
		 */
		protected $strPayerAccountNumber;
		const PayerAccountNumberMaxLength = 12;
		const PayerAccountNumberDefault = null;


		/**
		 * Protected member variable that maps to the database column fedex_shipment.package_weight
		 * @var double fltPackageWeight
		 */
		protected $fltPackageWeight;
		const PackageWeightDefault = null;


		/**
		 * Protected member variable that maps to the database column fedex_shipment.package_length
		 * @var double fltPackageLength
		 */
		protected $fltPackageLength;
		const PackageLengthDefault = null;


		/**
		 * Protected member variable that maps to the database column fedex_shipment.package_width
		 * @var double fltPackageWidth
		 */
		protected $fltPackageWidth;
		const PackageWidthDefault = null;


		/**
		 * Protected member variable that maps to the database column fedex_shipment.package_height
		 * @var double fltPackageHeight
		 */
		protected $fltPackageHeight;
		const PackageHeightDefault = null;


		/**
		 * Protected member variable that maps to the database column fedex_shipment.declared_value
		 * @var double fltDeclaredValue
		 */
		protected $fltDeclaredValue;
		const DeclaredValueDefault = null;


		/**
		 * Protected member variable that maps to the database column fedex_shipment.reference
		 * @var string strReference
		 */
		protected $strReference;
		const ReferenceDefault = null;


		/**
		 * Protected member variable that maps to the database column fedex_shipment.saturday_delivery_flag
		 * @var boolean blnSaturdayDeliveryFlag
		 */
		protected $blnSaturdayDeliveryFlag;
		const SaturdayDeliveryFlagDefault = null;


		/**
		 * Protected member variable that maps to the database column fedex_shipment.notify_sender_email
		 * @var string strNotifySenderEmail
		 */
		protected $strNotifySenderEmail;
		const NotifySenderEmailMaxLength = 50;
		const NotifySenderEmailDefault = null;


		/**
		 * Protected member variable that maps to the database column fedex_shipment.notify_sender_ship_flag
		 * @var boolean blnNotifySenderShipFlag
		 */
		protected $blnNotifySenderShipFlag;
		const NotifySenderShipFlagDefault = null;


		/**
		 * Protected member variable that maps to the database column fedex_shipment.notify_sender_exception_flag
		 * @var boolean blnNotifySenderExceptionFlag
		 */
		protected $blnNotifySenderExceptionFlag;
		const NotifySenderExceptionFlagDefault = null;


		/**
		 * Protected member variable that maps to the database column fedex_shipment.notify_sender_delivery_flag
		 * @var boolean blnNotifySenderDeliveryFlag
		 */
		protected $blnNotifySenderDeliveryFlag;
		const NotifySenderDeliveryFlagDefault = null;


		/**
		 * Protected member variable that maps to the database column fedex_shipment.notify_recipient_email
		 * @var string strNotifyRecipientEmail
		 */
		protected $strNotifyRecipientEmail;
		const NotifyRecipientEmailMaxLength = 50;
		const NotifyRecipientEmailDefault = null;


		/**
		 * Protected member variable that maps to the database column fedex_shipment.notify_recipient_ship_flag
		 * @var boolean blnNotifyRecipientShipFlag
		 */
		protected $blnNotifyRecipientShipFlag;
		const NotifyRecipientShipFlagDefault = null;


		/**
		 * Protected member variable that maps to the database column fedex_shipment.notify_recipient_exception_flag
		 * @var boolean blnNotifyRecipientExceptionFlag
		 */
		protected $blnNotifyRecipientExceptionFlag;
		const NotifyRecipientExceptionFlagDefault = null;


		/**
		 * Protected member variable that maps to the database column fedex_shipment.notify_recipient_delivery_flag
		 * @var boolean blnNotifyRecipientDeliveryFlag
		 */
		protected $blnNotifyRecipientDeliveryFlag;
		const NotifyRecipientDeliveryFlagDefault = null;


		/**
		 * Protected member variable that maps to the database column fedex_shipment.notify_other_email
		 * @var string strNotifyOtherEmail
		 */
		protected $strNotifyOtherEmail;
		const NotifyOtherEmailMaxLength = 50;
		const NotifyOtherEmailDefault = null;


		/**
		 * Protected member variable that maps to the database column fedex_shipment.notify_other_ship_flag
		 * @var boolean blnNotifyOtherShipFlag
		 */
		protected $blnNotifyOtherShipFlag;
		const NotifyOtherShipFlagDefault = null;


		/**
		 * Protected member variable that maps to the database column fedex_shipment.notify_other_exception_flag
		 * @var boolean blnNotifyOtherExceptionFlag
		 */
		protected $blnNotifyOtherExceptionFlag;
		const NotifyOtherExceptionFlagDefault = null;


		/**
		 * Protected member variable that maps to the database column fedex_shipment.notify_other_delivery_flag
		 * @var boolean blnNotifyOtherDeliveryFlag
		 */
		protected $blnNotifyOtherDeliveryFlag;
		const NotifyOtherDeliveryFlagDefault = null;


		/**
		 * Protected member variable that maps to the database column fedex_shipment.hold_at_location_flag
		 * @var boolean blnHoldAtLocationFlag
		 */
		protected $blnHoldAtLocationFlag;
		const HoldAtLocationFlagDefault = null;


		/**
		 * Protected member variable that maps to the database column fedex_shipment.hold_at_location_address
		 * @var string strHoldAtLocationAddress
		 */
		protected $strHoldAtLocationAddress;
		const HoldAtLocationAddressMaxLength = 255;
		const HoldAtLocationAddressDefault = null;


		/**
		 * Protected member variable that maps to the database column fedex_shipment.hold_at_location_city
		 * @var string strHoldAtLocationCity
		 */
		protected $strHoldAtLocationCity;
		const HoldAtLocationCityMaxLength = 50;
		const HoldAtLocationCityDefault = null;


		/**
		 * Protected member variable that maps to the database column fedex_shipment.hold_at_location_state
		 * @var integer intHoldAtLocationState
		 */
		protected $intHoldAtLocationState;
		const HoldAtLocationStateDefault = null;


		/**
		 * Protected member variable that maps to the database column fedex_shipment.hold_at_location_postal_code
		 * @var string strHoldAtLocationPostalCode
		 */
		protected $strHoldAtLocationPostalCode;
		const HoldAtLocationPostalCodeMaxLength = 50;
		const HoldAtLocationPostalCodeDefault = null;


		/**
		 * Protected array of virtual attributes for this object (e.g. extra/other calculated and/or non-object bound
		 * columns from the run-time database query result for this object).  Used by InstantiateDbRow and
		 * GetVirtualAttribute.
		 * @var string[] $__strVirtualAttributeArray
		 */
		protected $__strVirtualAttributeArray = array();

		/**
		 * Protected internal member variable that specifies whether or not this object is Restored from the database.
		 * Used by Save() to determine if Save() should perform a db UPDATE or INSERT.
		 * @var bool __blnRestored;
		 */
		protected $__blnRestored;



		///////////////////////////////
		// PROTECTED MEMBER OBJECTS
		///////////////////////////////

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column fedex_shipment.shipment_id.
		 *
		 * NOTE: Always use the Shipment property getter to correctly retrieve this Shipment object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var Shipment objShipment
		 */
		protected $objShipment;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column fedex_shipment.package_type_id.
		 *
		 * NOTE: Always use the PackageType property getter to correctly retrieve this PackageType object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var PackageType objPackageType
		 */
		protected $objPackageType;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column fedex_shipment.shipping_account_id.
		 *
		 * NOTE: Always use the ShippingAccount property getter to correctly retrieve this ShippingAccount object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var ShippingAccount objShippingAccount
		 */
		protected $objShippingAccount;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column fedex_shipment.fedex_service_type_id.
		 *
		 * NOTE: Always use the FedexServiceType property getter to correctly retrieve this FedexServiceType object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var FedexServiceType objFedexServiceType
		 */
		protected $objFedexServiceType;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column fedex_shipment.currency_unit_id.
		 *
		 * NOTE: Always use the CurrencyUnit property getter to correctly retrieve this CurrencyUnit object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var CurrencyUnit objCurrencyUnit
		 */
		protected $objCurrencyUnit;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column fedex_shipment.weight_unit_id.
		 *
		 * NOTE: Always use the WeightUnit property getter to correctly retrieve this WeightUnit object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var WeightUnit objWeightUnit
		 */
		protected $objWeightUnit;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column fedex_shipment.length_unit_id.
		 *
		 * NOTE: Always use the LengthUnit property getter to correctly retrieve this LengthUnit object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var LengthUnit objLengthUnit
		 */
		protected $objLengthUnit;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column fedex_shipment.hold_at_location_state.
		 *
		 * NOTE: Always use the HoldAtLocationStateObject property getter to correctly retrieve this StateProvince object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var StateProvince objHoldAtLocationStateObject
		 */
		protected $objHoldAtLocationStateObject;






		////////////////////////////////////////////////////////
		// METHODS for MANUAL QUERY SUPPORT (aka Beta 2 Queries)
		////////////////////////////////////////////////////////

		/**
		 * Internally called method to assist with SQL Query options/preferences for single row loaders.
		 * Any Load (single row) method can use this method to get the Database object.
		 * @param string $objDatabase reference to the Database object to be queried
		 */
		protected static function QueryHelper(&$objDatabase) {
			// Get the Database
			$objDatabase = QApplication::$Database[1];
		}



		/**
		 * Internally called method to assist with SQL Query options/preferences for array loaders.
		 * Any LoadAll or LoadArray method can use this method to setup SQL Query Clauses that deal
		 * with OrderBy, Limit, and Object Expansion.  Strings that contain SQL Query Clauses are
		 * passed in by reference.
		 * @param string $strOrderBy reference to the Order By as passed in to the LoadArray method
		 * @param string $strLimit the Limit as passed in to the LoadArray method
		 * @param string $strLimitPrefix reference to the Limit Prefix to be used in the SQL
		 * @param string $strLimitSuffix reference to the Limit Suffix to be used in the SQL
		 * @param string $strExpandSelect reference to the Expand Select to be used in the SQL
		 * @param string $strExpandFrom reference to the Expand From to be used in the SQL
		 * @param array $objExpansionMap map of referenced columns to be immediately expanded via early-binding
		 * @param string $objDatabase reference to the Database object to be queried
		 */
		protected static function ArrayQueryHelper(&$strOrderBy, $strLimit, &$strLimitPrefix, &$strLimitSuffix, &$strExpandSelect, &$strExpandFrom, $objExpansionMap, &$objDatabase) {
			// Get the Database
			$objDatabase = QApplication::$Database[1];

			// Setup OrderBy and Limit Information (if applicable)
			$strOrderBy = $objDatabase->SqlSortByVariable($strOrderBy);
			$strLimitPrefix = $objDatabase->SqlLimitVariablePrefix($strLimit);
			$strLimitSuffix = $objDatabase->SqlLimitVariableSuffix($strLimit);

			// Setup QueryExpansion (if applicable)
			if ($objExpansionMap) {
				$objQueryExpansion = new QQueryExpansion('FedexShipment', 'fedex_shipment', $objExpansionMap);
				$strExpandSelect = $objQueryExpansion->GetSelectSql();
				$strExpandFrom = $objQueryExpansion->GetFromSql();
			} else {
				$strExpandSelect = null;
				$strExpandFrom = null;
			}
		}



		/**
		 * Internally called method to assist with early binding of objects
		 * on load methods.  Can only early-bind references that this class owns in the database.
		 * @param string $strParentAlias the alias of the parent (if any)
		 * @param string $strAlias the alias of this object
		 * @param array $objExpansionMap map of referenced columns to be immediately expanded via early-binding
		 * @param QueryExpansion an already instantiated QueryExpansion object (used as a utility object to assist with object expansion)
		 */
		public static function ExpandQuery($strParentAlias, $strAlias, $objExpansionMap, QQueryExpansion $objQueryExpansion) {
			if ($strAlias) {
				$objQueryExpansion->AddFromItem(sprintf('LEFT JOIN `fedex_shipment` AS `%s__%s` ON `%s`.`%s` = `%s__%s`.`fedex_shipment_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias, $strParentAlias, $strAlias));

				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`fedex_shipment_id` AS `%s__%s__fedex_shipment_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`shipment_id` AS `%s__%s__shipment_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`package_type_id` AS `%s__%s__package_type_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`shipping_account_id` AS `%s__%s__shipping_account_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`fedex_service_type_id` AS `%s__%s__fedex_service_type_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`currency_unit_id` AS `%s__%s__currency_unit_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`weight_unit_id` AS `%s__%s__weight_unit_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`length_unit_id` AS `%s__%s__length_unit_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`to_phone` AS `%s__%s__to_phone`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`pay_type` AS `%s__%s__pay_type`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`payer_account_number` AS `%s__%s__payer_account_number`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`package_weight` AS `%s__%s__package_weight`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`package_length` AS `%s__%s__package_length`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`package_width` AS `%s__%s__package_width`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`package_height` AS `%s__%s__package_height`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`declared_value` AS `%s__%s__declared_value`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`reference` AS `%s__%s__reference`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`saturday_delivery_flag` AS `%s__%s__saturday_delivery_flag`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`notify_sender_email` AS `%s__%s__notify_sender_email`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`notify_sender_ship_flag` AS `%s__%s__notify_sender_ship_flag`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`notify_sender_exception_flag` AS `%s__%s__notify_sender_exception_flag`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`notify_sender_delivery_flag` AS `%s__%s__notify_sender_delivery_flag`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`notify_recipient_email` AS `%s__%s__notify_recipient_email`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`notify_recipient_ship_flag` AS `%s__%s__notify_recipient_ship_flag`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`notify_recipient_exception_flag` AS `%s__%s__notify_recipient_exception_flag`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`notify_recipient_delivery_flag` AS `%s__%s__notify_recipient_delivery_flag`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`notify_other_email` AS `%s__%s__notify_other_email`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`notify_other_ship_flag` AS `%s__%s__notify_other_ship_flag`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`notify_other_exception_flag` AS `%s__%s__notify_other_exception_flag`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`notify_other_delivery_flag` AS `%s__%s__notify_other_delivery_flag`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`hold_at_location_flag` AS `%s__%s__hold_at_location_flag`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`hold_at_location_address` AS `%s__%s__hold_at_location_address`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`hold_at_location_city` AS `%s__%s__hold_at_location_city`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`hold_at_location_state` AS `%s__%s__hold_at_location_state`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`hold_at_location_postal_code` AS `%s__%s__hold_at_location_postal_code`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));

				$strParentAlias = $strParentAlias . '__' . $strAlias;
			}

			if (is_array($objExpansionMap))
				foreach ($objExpansionMap as $strKey=>$objValue) {
					switch ($strKey) {
						case 'shipment_id':
							try {
								Shipment::ExpandQuery($strParentAlias, $strKey, $objValue, $objQueryExpansion);
								break;
							} catch (QCallerException $objExc) {
								$objExc->IncrementOffset();
								throw $objExc;
							}
						case 'package_type_id':
							try {
								PackageType::ExpandQuery($strParentAlias, $strKey, $objValue, $objQueryExpansion);
								break;
							} catch (QCallerException $objExc) {
								$objExc->IncrementOffset();
								throw $objExc;
							}
						case 'shipping_account_id':
							try {
								ShippingAccount::ExpandQuery($strParentAlias, $strKey, $objValue, $objQueryExpansion);
								break;
							} catch (QCallerException $objExc) {
								$objExc->IncrementOffset();
								throw $objExc;
							}
						case 'fedex_service_type_id':
							try {
								FedexServiceType::ExpandQuery($strParentAlias, $strKey, $objValue, $objQueryExpansion);
								break;
							} catch (QCallerException $objExc) {
								$objExc->IncrementOffset();
								throw $objExc;
							}
						case 'currency_unit_id':
							try {
								CurrencyUnit::ExpandQuery($strParentAlias, $strKey, $objValue, $objQueryExpansion);
								break;
							} catch (QCallerException $objExc) {
								$objExc->IncrementOffset();
								throw $objExc;
							}
						case 'weight_unit_id':
							try {
								WeightUnit::ExpandQuery($strParentAlias, $strKey, $objValue, $objQueryExpansion);
								break;
							} catch (QCallerException $objExc) {
								$objExc->IncrementOffset();
								throw $objExc;
							}
						case 'length_unit_id':
							try {
								LengthUnit::ExpandQuery($strParentAlias, $strKey, $objValue, $objQueryExpansion);
								break;
							} catch (QCallerException $objExc) {
								$objExc->IncrementOffset();
								throw $objExc;
							}
						case 'hold_at_location_state':
							try {
								StateProvince::ExpandQuery($strParentAlias, $strKey, $objValue, $objQueryExpansion);
								break;
							} catch (QCallerException $objExc) {
								$objExc->IncrementOffset();
								throw $objExc;
							}
						default:
							throw new QCallerException(sprintf('Unknown Object to Expand in %s: %s', $strParentAlias, $strKey));
					}
				}
		}




		////////////////////////////////////////
		// COLUMN CONSTANTS for OBJECT EXPANSION
		////////////////////////////////////////
		const ExpandShipment = 'shipment_id';
		const ExpandPackageType = 'package_type_id';
		const ExpandShippingAccount = 'shipping_account_id';
		const ExpandFedexServiceType = 'fedex_service_type_id';
		const ExpandCurrencyUnit = 'currency_unit_id';
		const ExpandWeightUnit = 'weight_unit_id';
		const ExpandLengthUnit = 'length_unit_id';
		const ExpandHoldAtLocationStateObject = 'hold_at_location_state';




		////////////////////////////////////////
		// METHODS for WEB SERVICES
		////////////////////////////////////////

		public static function GetSoapComplexTypeXml() {
			$strToReturn = '<complexType name="FedexShipment"><sequence>';
			$strToReturn .= '<element name="FedexShipmentId" type="xsd:int"/>';
			$strToReturn .= '<element name="Shipment" type="xsd1:Shipment"/>';
			$strToReturn .= '<element name="PackageType" type="xsd1:PackageType"/>';
			$strToReturn .= '<element name="ShippingAccount" type="xsd1:ShippingAccount"/>';
			$strToReturn .= '<element name="FedexServiceType" type="xsd1:FedexServiceType"/>';
			$strToReturn .= '<element name="CurrencyUnit" type="xsd1:CurrencyUnit"/>';
			$strToReturn .= '<element name="WeightUnit" type="xsd1:WeightUnit"/>';
			$strToReturn .= '<element name="LengthUnit" type="xsd1:LengthUnit"/>';
			$strToReturn .= '<element name="ToPhone" type="xsd:string"/>';
			$strToReturn .= '<element name="PayType" type="xsd:int"/>';
			$strToReturn .= '<element name="PayerAccountNumber" type="xsd:string"/>';
			$strToReturn .= '<element name="PackageWeight" type="xsd:float"/>';
			$strToReturn .= '<element name="PackageLength" type="xsd:float"/>';
			$strToReturn .= '<element name="PackageWidth" type="xsd:float"/>';
			$strToReturn .= '<element name="PackageHeight" type="xsd:float"/>';
			$strToReturn .= '<element name="DeclaredValue" type="xsd:float"/>';
			$strToReturn .= '<element name="Reference" type="xsd:string"/>';
			$strToReturn .= '<element name="SaturdayDeliveryFlag" type="xsd:boolean"/>';
			$strToReturn .= '<element name="NotifySenderEmail" type="xsd:string"/>';
			$strToReturn .= '<element name="NotifySenderShipFlag" type="xsd:boolean"/>';
			$strToReturn .= '<element name="NotifySenderExceptionFlag" type="xsd:boolean"/>';
			$strToReturn .= '<element name="NotifySenderDeliveryFlag" type="xsd:boolean"/>';
			$strToReturn .= '<element name="NotifyRecipientEmail" type="xsd:string"/>';
			$strToReturn .= '<element name="NotifyRecipientShipFlag" type="xsd:boolean"/>';
			$strToReturn .= '<element name="NotifyRecipientExceptionFlag" type="xsd:boolean"/>';
			$strToReturn .= '<element name="NotifyRecipientDeliveryFlag" type="xsd:boolean"/>';
			$strToReturn .= '<element name="NotifyOtherEmail" type="xsd:string"/>';
			$strToReturn .= '<element name="NotifyOtherShipFlag" type="xsd:boolean"/>';
			$strToReturn .= '<element name="NotifyOtherExceptionFlag" type="xsd:boolean"/>';
			$strToReturn .= '<element name="NotifyOtherDeliveryFlag" type="xsd:boolean"/>';
			$strToReturn .= '<element name="HoldAtLocationFlag" type="xsd:boolean"/>';
			$strToReturn .= '<element name="HoldAtLocationAddress" type="xsd:string"/>';
			$strToReturn .= '<element name="HoldAtLocationCity" type="xsd:string"/>';
			$strToReturn .= '<element name="HoldAtLocationStateObject" type="xsd1:StateProvince"/>';
			$strToReturn .= '<element name="HoldAtLocationPostalCode" type="xsd:string"/>';
			$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
			$strToReturn .= '</sequence></complexType>';
			return $strToReturn;
		}

		public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
			if (!array_key_exists('FedexShipment', $strComplexTypeArray)) {
				$strComplexTypeArray['FedexShipment'] = FedexShipment::GetSoapComplexTypeXml();
				Shipment::AlterSoapComplexTypeArray($strComplexTypeArray);
				PackageType::AlterSoapComplexTypeArray($strComplexTypeArray);
				ShippingAccount::AlterSoapComplexTypeArray($strComplexTypeArray);
				FedexServiceType::AlterSoapComplexTypeArray($strComplexTypeArray);
				CurrencyUnit::AlterSoapComplexTypeArray($strComplexTypeArray);
				WeightUnit::AlterSoapComplexTypeArray($strComplexTypeArray);
				LengthUnit::AlterSoapComplexTypeArray($strComplexTypeArray);
				StateProvince::AlterSoapComplexTypeArray($strComplexTypeArray);
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, FedexShipment::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new FedexShipment();
			if (property_exists($objSoapObject, 'FedexShipmentId'))
				$objToReturn->intFedexShipmentId = $objSoapObject->FedexShipmentId;
			if ((property_exists($objSoapObject, 'Shipment')) &&
				($objSoapObject->Shipment))
				$objToReturn->Shipment = Shipment::GetObjectFromSoapObject($objSoapObject->Shipment);
			if ((property_exists($objSoapObject, 'PackageType')) &&
				($objSoapObject->PackageType))
				$objToReturn->PackageType = PackageType::GetObjectFromSoapObject($objSoapObject->PackageType);
			if ((property_exists($objSoapObject, 'ShippingAccount')) &&
				($objSoapObject->ShippingAccount))
				$objToReturn->ShippingAccount = ShippingAccount::GetObjectFromSoapObject($objSoapObject->ShippingAccount);
			if ((property_exists($objSoapObject, 'FedexServiceType')) &&
				($objSoapObject->FedexServiceType))
				$objToReturn->FedexServiceType = FedexServiceType::GetObjectFromSoapObject($objSoapObject->FedexServiceType);
			if ((property_exists($objSoapObject, 'CurrencyUnit')) &&
				($objSoapObject->CurrencyUnit))
				$objToReturn->CurrencyUnit = CurrencyUnit::GetObjectFromSoapObject($objSoapObject->CurrencyUnit);
			if ((property_exists($objSoapObject, 'WeightUnit')) &&
				($objSoapObject->WeightUnit))
				$objToReturn->WeightUnit = WeightUnit::GetObjectFromSoapObject($objSoapObject->WeightUnit);
			if ((property_exists($objSoapObject, 'LengthUnit')) &&
				($objSoapObject->LengthUnit))
				$objToReturn->LengthUnit = LengthUnit::GetObjectFromSoapObject($objSoapObject->LengthUnit);
			if (property_exists($objSoapObject, 'ToPhone'))
				$objToReturn->strToPhone = $objSoapObject->ToPhone;
			if (property_exists($objSoapObject, 'PayType'))
				$objToReturn->intPayType = $objSoapObject->PayType;
			if (property_exists($objSoapObject, 'PayerAccountNumber'))
				$objToReturn->strPayerAccountNumber = $objSoapObject->PayerAccountNumber;
			if (property_exists($objSoapObject, 'PackageWeight'))
				$objToReturn->fltPackageWeight = $objSoapObject->PackageWeight;
			if (property_exists($objSoapObject, 'PackageLength'))
				$objToReturn->fltPackageLength = $objSoapObject->PackageLength;
			if (property_exists($objSoapObject, 'PackageWidth'))
				$objToReturn->fltPackageWidth = $objSoapObject->PackageWidth;
			if (property_exists($objSoapObject, 'PackageHeight'))
				$objToReturn->fltPackageHeight = $objSoapObject->PackageHeight;
			if (property_exists($objSoapObject, 'DeclaredValue'))
				$objToReturn->fltDeclaredValue = $objSoapObject->DeclaredValue;
			if (property_exists($objSoapObject, 'Reference'))
				$objToReturn->strReference = $objSoapObject->Reference;
			if (property_exists($objSoapObject, 'SaturdayDeliveryFlag'))
				$objToReturn->blnSaturdayDeliveryFlag = $objSoapObject->SaturdayDeliveryFlag;
			if (property_exists($objSoapObject, 'NotifySenderEmail'))
				$objToReturn->strNotifySenderEmail = $objSoapObject->NotifySenderEmail;
			if (property_exists($objSoapObject, 'NotifySenderShipFlag'))
				$objToReturn->blnNotifySenderShipFlag = $objSoapObject->NotifySenderShipFlag;
			if (property_exists($objSoapObject, 'NotifySenderExceptionFlag'))
				$objToReturn->blnNotifySenderExceptionFlag = $objSoapObject->NotifySenderExceptionFlag;
			if (property_exists($objSoapObject, 'NotifySenderDeliveryFlag'))
				$objToReturn->blnNotifySenderDeliveryFlag = $objSoapObject->NotifySenderDeliveryFlag;
			if (property_exists($objSoapObject, 'NotifyRecipientEmail'))
				$objToReturn->strNotifyRecipientEmail = $objSoapObject->NotifyRecipientEmail;
			if (property_exists($objSoapObject, 'NotifyRecipientShipFlag'))
				$objToReturn->blnNotifyRecipientShipFlag = $objSoapObject->NotifyRecipientShipFlag;
			if (property_exists($objSoapObject, 'NotifyRecipientExceptionFlag'))
				$objToReturn->blnNotifyRecipientExceptionFlag = $objSoapObject->NotifyRecipientExceptionFlag;
			if (property_exists($objSoapObject, 'NotifyRecipientDeliveryFlag'))
				$objToReturn->blnNotifyRecipientDeliveryFlag = $objSoapObject->NotifyRecipientDeliveryFlag;
			if (property_exists($objSoapObject, 'NotifyOtherEmail'))
				$objToReturn->strNotifyOtherEmail = $objSoapObject->NotifyOtherEmail;
			if (property_exists($objSoapObject, 'NotifyOtherShipFlag'))
				$objToReturn->blnNotifyOtherShipFlag = $objSoapObject->NotifyOtherShipFlag;
			if (property_exists($objSoapObject, 'NotifyOtherExceptionFlag'))
				$objToReturn->blnNotifyOtherExceptionFlag = $objSoapObject->NotifyOtherExceptionFlag;
			if (property_exists($objSoapObject, 'NotifyOtherDeliveryFlag'))
				$objToReturn->blnNotifyOtherDeliveryFlag = $objSoapObject->NotifyOtherDeliveryFlag;
			if (property_exists($objSoapObject, 'HoldAtLocationFlag'))
				$objToReturn->blnHoldAtLocationFlag = $objSoapObject->HoldAtLocationFlag;
			if (property_exists($objSoapObject, 'HoldAtLocationAddress'))
				$objToReturn->strHoldAtLocationAddress = $objSoapObject->HoldAtLocationAddress;
			if (property_exists($objSoapObject, 'HoldAtLocationCity'))
				$objToReturn->strHoldAtLocationCity = $objSoapObject->HoldAtLocationCity;
			if ((property_exists($objSoapObject, 'HoldAtLocationStateObject')) &&
				($objSoapObject->HoldAtLocationStateObject))
				$objToReturn->HoldAtLocationStateObject = StateProvince::GetObjectFromSoapObject($objSoapObject->HoldAtLocationStateObject);
			if (property_exists($objSoapObject, 'HoldAtLocationPostalCode'))
				$objToReturn->strHoldAtLocationPostalCode = $objSoapObject->HoldAtLocationPostalCode;
			if (property_exists($objSoapObject, '__blnRestored'))
				$objToReturn->__blnRestored = $objSoapObject->__blnRestored;
			return $objToReturn;
		}

		public static function GetSoapArrayFromArray($objArray) {
			if (!$objArray)
				return null;

			$objArrayToReturn = array();

			foreach ($objArray as $objObject)
				array_push($objArrayToReturn, FedexShipment::GetSoapObjectFromObject($objObject, true));

			return unserialize(serialize($objArrayToReturn));
		}

		public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
			if ($objObject->objShipment)
				$objObject->objShipment = Shipment::GetSoapObjectFromObject($objObject->objShipment, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intShipmentId = null;
			if ($objObject->objPackageType)
				$objObject->objPackageType = PackageType::GetSoapObjectFromObject($objObject->objPackageType, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intPackageTypeId = null;
			if ($objObject->objShippingAccount)
				$objObject->objShippingAccount = ShippingAccount::GetSoapObjectFromObject($objObject->objShippingAccount, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intShippingAccountId = null;
			if ($objObject->objFedexServiceType)
				$objObject->objFedexServiceType = FedexServiceType::GetSoapObjectFromObject($objObject->objFedexServiceType, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intFedexServiceTypeId = null;
			if ($objObject->objCurrencyUnit)
				$objObject->objCurrencyUnit = CurrencyUnit::GetSoapObjectFromObject($objObject->objCurrencyUnit, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intCurrencyUnitId = null;
			if ($objObject->objWeightUnit)
				$objObject->objWeightUnit = WeightUnit::GetSoapObjectFromObject($objObject->objWeightUnit, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intWeightUnitId = null;
			if ($objObject->objLengthUnit)
				$objObject->objLengthUnit = LengthUnit::GetSoapObjectFromObject($objObject->objLengthUnit, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intLengthUnitId = null;
			if ($objObject->objHoldAtLocationStateObject)
				$objObject->objHoldAtLocationStateObject = StateProvince::GetSoapObjectFromObject($objObject->objHoldAtLocationStateObject, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intHoldAtLocationState = null;
			return $objObject;
		}
	}





	/////////////////////////////////////
	// ADDITIONAL CLASSES for QCODO QUERY
	/////////////////////////////////////

	class QQNodeFedexShipment extends QQNode {
		protected $strTableName = 'fedex_shipment';
		protected $strPrimaryKey = 'fedex_shipment_id';
		protected $strClassName = 'FedexShipment';
		public function __get($strName) {
			switch ($strName) {
				case 'FedexShipmentId':
					return new QQNode('fedex_shipment_id', 'integer', $this);
				case 'ShipmentId':
					return new QQNode('shipment_id', 'integer', $this);
				case 'Shipment':
					return new QQNodeShipment('shipment_id', 'integer', $this);
				case 'PackageTypeId':
					return new QQNode('package_type_id', 'integer', $this);
				case 'PackageType':
					return new QQNodePackageType('package_type_id', 'integer', $this);
				case 'ShippingAccountId':
					return new QQNode('shipping_account_id', 'integer', $this);
				case 'ShippingAccount':
					return new QQNodeShippingAccount('shipping_account_id', 'integer', $this);
				case 'FedexServiceTypeId':
					return new QQNode('fedex_service_type_id', 'integer', $this);
				case 'FedexServiceType':
					return new QQNodeFedexServiceType('fedex_service_type_id', 'integer', $this);
				case 'CurrencyUnitId':
					return new QQNode('currency_unit_id', 'integer', $this);
				case 'CurrencyUnit':
					return new QQNodeCurrencyUnit('currency_unit_id', 'integer', $this);
				case 'WeightUnitId':
					return new QQNode('weight_unit_id', 'integer', $this);
				case 'WeightUnit':
					return new QQNodeWeightUnit('weight_unit_id', 'integer', $this);
				case 'LengthUnitId':
					return new QQNode('length_unit_id', 'integer', $this);
				case 'LengthUnit':
					return new QQNodeLengthUnit('length_unit_id', 'integer', $this);
				case 'ToPhone':
					return new QQNode('to_phone', 'string', $this);
				case 'PayType':
					return new QQNode('pay_type', 'integer', $this);
				case 'PayerAccountNumber':
					return new QQNode('payer_account_number', 'string', $this);
				case 'PackageWeight':
					return new QQNode('package_weight', 'double', $this);
				case 'PackageLength':
					return new QQNode('package_length', 'double', $this);
				case 'PackageWidth':
					return new QQNode('package_width', 'double', $this);
				case 'PackageHeight':
					return new QQNode('package_height', 'double', $this);
				case 'DeclaredValue':
					return new QQNode('declared_value', 'double', $this);
				case 'Reference':
					return new QQNode('reference', 'string', $this);
				case 'SaturdayDeliveryFlag':
					return new QQNode('saturday_delivery_flag', 'boolean', $this);
				case 'NotifySenderEmail':
					return new QQNode('notify_sender_email', 'string', $this);
				case 'NotifySenderShipFlag':
					return new QQNode('notify_sender_ship_flag', 'boolean', $this);
				case 'NotifySenderExceptionFlag':
					return new QQNode('notify_sender_exception_flag', 'boolean', $this);
				case 'NotifySenderDeliveryFlag':
					return new QQNode('notify_sender_delivery_flag', 'boolean', $this);
				case 'NotifyRecipientEmail':
					return new QQNode('notify_recipient_email', 'string', $this);
				case 'NotifyRecipientShipFlag':
					return new QQNode('notify_recipient_ship_flag', 'boolean', $this);
				case 'NotifyRecipientExceptionFlag':
					return new QQNode('notify_recipient_exception_flag', 'boolean', $this);
				case 'NotifyRecipientDeliveryFlag':
					return new QQNode('notify_recipient_delivery_flag', 'boolean', $this);
				case 'NotifyOtherEmail':
					return new QQNode('notify_other_email', 'string', $this);
				case 'NotifyOtherShipFlag':
					return new QQNode('notify_other_ship_flag', 'boolean', $this);
				case 'NotifyOtherExceptionFlag':
					return new QQNode('notify_other_exception_flag', 'boolean', $this);
				case 'NotifyOtherDeliveryFlag':
					return new QQNode('notify_other_delivery_flag', 'boolean', $this);
				case 'HoldAtLocationFlag':
					return new QQNode('hold_at_location_flag', 'boolean', $this);
				case 'HoldAtLocationAddress':
					return new QQNode('hold_at_location_address', 'string', $this);
				case 'HoldAtLocationCity':
					return new QQNode('hold_at_location_city', 'string', $this);
				case 'HoldAtLocationState':
					return new QQNode('hold_at_location_state', 'integer', $this);
				case 'HoldAtLocationStateObject':
					return new QQNodeStateProvince('hold_at_location_state', 'integer', $this);
				case 'HoldAtLocationPostalCode':
					return new QQNode('hold_at_location_postal_code', 'string', $this);

				case '_PrimaryKeyNode':
					return new QQNode('fedex_shipment_id', 'integer', $this);
				default:
					try {
						return parent::__get($strName);
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}
	}

	class QQReverseReferenceNodeFedexShipment extends QQReverseReferenceNode {
		protected $strTableName = 'fedex_shipment';
		protected $strPrimaryKey = 'fedex_shipment_id';
		protected $strClassName = 'FedexShipment';
		public function __get($strName) {
			switch ($strName) {
				case 'FedexShipmentId':
					return new QQNode('fedex_shipment_id', 'integer', $this);
				case 'ShipmentId':
					return new QQNode('shipment_id', 'integer', $this);
				case 'Shipment':
					return new QQNodeShipment('shipment_id', 'integer', $this);
				case 'PackageTypeId':
					return new QQNode('package_type_id', 'integer', $this);
				case 'PackageType':
					return new QQNodePackageType('package_type_id', 'integer', $this);
				case 'ShippingAccountId':
					return new QQNode('shipping_account_id', 'integer', $this);
				case 'ShippingAccount':
					return new QQNodeShippingAccount('shipping_account_id', 'integer', $this);
				case 'FedexServiceTypeId':
					return new QQNode('fedex_service_type_id', 'integer', $this);
				case 'FedexServiceType':
					return new QQNodeFedexServiceType('fedex_service_type_id', 'integer', $this);
				case 'CurrencyUnitId':
					return new QQNode('currency_unit_id', 'integer', $this);
				case 'CurrencyUnit':
					return new QQNodeCurrencyUnit('currency_unit_id', 'integer', $this);
				case 'WeightUnitId':
					return new QQNode('weight_unit_id', 'integer', $this);
				case 'WeightUnit':
					return new QQNodeWeightUnit('weight_unit_id', 'integer', $this);
				case 'LengthUnitId':
					return new QQNode('length_unit_id', 'integer', $this);
				case 'LengthUnit':
					return new QQNodeLengthUnit('length_unit_id', 'integer', $this);
				case 'ToPhone':
					return new QQNode('to_phone', 'string', $this);
				case 'PayType':
					return new QQNode('pay_type', 'integer', $this);
				case 'PayerAccountNumber':
					return new QQNode('payer_account_number', 'string', $this);
				case 'PackageWeight':
					return new QQNode('package_weight', 'double', $this);
				case 'PackageLength':
					return new QQNode('package_length', 'double', $this);
				case 'PackageWidth':
					return new QQNode('package_width', 'double', $this);
				case 'PackageHeight':
					return new QQNode('package_height', 'double', $this);
				case 'DeclaredValue':
					return new QQNode('declared_value', 'double', $this);
				case 'Reference':
					return new QQNode('reference', 'string', $this);
				case 'SaturdayDeliveryFlag':
					return new QQNode('saturday_delivery_flag', 'boolean', $this);
				case 'NotifySenderEmail':
					return new QQNode('notify_sender_email', 'string', $this);
				case 'NotifySenderShipFlag':
					return new QQNode('notify_sender_ship_flag', 'boolean', $this);
				case 'NotifySenderExceptionFlag':
					return new QQNode('notify_sender_exception_flag', 'boolean', $this);
				case 'NotifySenderDeliveryFlag':
					return new QQNode('notify_sender_delivery_flag', 'boolean', $this);
				case 'NotifyRecipientEmail':
					return new QQNode('notify_recipient_email', 'string', $this);
				case 'NotifyRecipientShipFlag':
					return new QQNode('notify_recipient_ship_flag', 'boolean', $this);
				case 'NotifyRecipientExceptionFlag':
					return new QQNode('notify_recipient_exception_flag', 'boolean', $this);
				case 'NotifyRecipientDeliveryFlag':
					return new QQNode('notify_recipient_delivery_flag', 'boolean', $this);
				case 'NotifyOtherEmail':
					return new QQNode('notify_other_email', 'string', $this);
				case 'NotifyOtherShipFlag':
					return new QQNode('notify_other_ship_flag', 'boolean', $this);
				case 'NotifyOtherExceptionFlag':
					return new QQNode('notify_other_exception_flag', 'boolean', $this);
				case 'NotifyOtherDeliveryFlag':
					return new QQNode('notify_other_delivery_flag', 'boolean', $this);
				case 'HoldAtLocationFlag':
					return new QQNode('hold_at_location_flag', 'boolean', $this);
				case 'HoldAtLocationAddress':
					return new QQNode('hold_at_location_address', 'string', $this);
				case 'HoldAtLocationCity':
					return new QQNode('hold_at_location_city', 'string', $this);
				case 'HoldAtLocationState':
					return new QQNode('hold_at_location_state', 'integer', $this);
				case 'HoldAtLocationStateObject':
					return new QQNodeStateProvince('hold_at_location_state', 'integer', $this);
				case 'HoldAtLocationPostalCode':
					return new QQNode('hold_at_location_postal_code', 'string', $this);

				case '_PrimaryKeyNode':
					return new QQNode('fedex_shipment_id', 'integer', $this);
				default:
					try {
						return parent::__get($strName);
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}
	}
?>