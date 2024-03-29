<?php
	/**
	 * The abstract CompanyGen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the Company subclass which
	 * extends this CompanyGen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the Company class.
	 * 
	 * @package My Application
	 * @subpackage GeneratedDataObjects
	 * 
	 */
	class CompanyGen extends QBaseClass {
		///////////////////////////////
		// COMMON LOAD METHODS
		///////////////////////////////

		/**
		 * Load a Company from PK Info
		 * @param integer $intCompanyId
		 * @return Company
		 */
		public static function Load($intCompanyId) {
			// Use QuerySingle to Perform the Query
			return Company::QuerySingle(
				QQ::Equal(QQN::Company()->CompanyId, $intCompanyId)
			);
		}

		/**
		 * Load all Companies
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Company[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			// Call Company::QueryArray to perform the LoadAll query
			try {
				return Company::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all Companies
		 * @return int
		 */
		public static function CountAll() {
			// Call Company::QueryCount to perform the CountAll query
			return Company::QueryCount(QQ::All());
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
			$objDatabase = Company::GetDatabase();

			// Create/Build out the QueryBuilder object with Company-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, 'company');
			Company::GetSelectFields($objQueryBuilder);
			$objQueryBuilder->AddFromItem('`company` AS `company`');

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
		 * Static Qcodo Query method to query for a single Company object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return Company the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Company::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query, Get the First Row, and Instantiate a new Company object
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return Company::InstantiateDbRow($objDbResult->GetNextRow());
		}

		/**
		 * Static Qcodo Query method to query for an array of Company objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return Company[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Company::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return Company::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
		}

		/**
		 * Static Qcodo Query method to query for a count of Company objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Company::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
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
			$objDatabase = Company::GetDatabase();

			// Lookup the QCache for This Query Statement
			$objCache = new QCache('query', 'company_' . serialize($strConditions));
			if (!($strQuery = $objCache->GetData())) {
				// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with Company-specific fields
				$objQueryBuilder = new QQueryBuilder($objDatabase);
				Company::GetSelectFields($objQueryBuilder);
				Company::GetFromFields($objQueryBuilder);

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
			return Company::InstantiateDbResult($objDbResult);
		}*/

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this Company
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null) {
			if ($strPrefix) {
				$strTableName = '`' . $strPrefix . '`';
				$strAliasPrefix = '`' . $strPrefix . '__';
			} else {
				$strTableName = '`company`';
				$strAliasPrefix = '`';
			}

			$objBuilder->AddSelectItem($strTableName . '.`company_id` AS ' . $strAliasPrefix . 'company_id`');
			$objBuilder->AddSelectItem($strTableName . '.`address_id` AS ' . $strAliasPrefix . 'address_id`');
			$objBuilder->AddSelectItem($strTableName . '.`short_description` AS ' . $strAliasPrefix . 'short_description`');
			$objBuilder->AddSelectItem($strTableName . '.`website` AS ' . $strAliasPrefix . 'website`');
			$objBuilder->AddSelectItem($strTableName . '.`telephone` AS ' . $strAliasPrefix . 'telephone`');
			$objBuilder->AddSelectItem($strTableName . '.`fax` AS ' . $strAliasPrefix . 'fax`');
			$objBuilder->AddSelectItem($strTableName . '.`email` AS ' . $strAliasPrefix . 'email`');
			$objBuilder->AddSelectItem($strTableName . '.`long_description` AS ' . $strAliasPrefix . 'long_description`');
			$objBuilder->AddSelectItem($strTableName . '.`created_by` AS ' . $strAliasPrefix . 'created_by`');
			$objBuilder->AddSelectItem($strTableName . '.`creation_date` AS ' . $strAliasPrefix . 'creation_date`');
			$objBuilder->AddSelectItem($strTableName . '.`modified_by` AS ' . $strAliasPrefix . 'modified_by`');
			$objBuilder->AddSelectItem($strTableName . '.`modified_date` AS ' . $strAliasPrefix . 'modified_date`');
		}



		///////////////////////////////
		// INSTANTIATION-RELATED METHODS
		///////////////////////////////

		/**
		 * Instantiate a Company from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this Company::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param DatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @return Company
		*/
		public static function InstantiateDbRow($objDbRow, $strAliasPrefix = null, $strExpandAsArrayNodes = null, $objPreviousItem = null) {
			// If blank row, return null
			if (!$objDbRow)
				return null;

			// See if we're doing an array expansion on the previous item
			if (($strExpandAsArrayNodes) && ($objPreviousItem) &&
				($objPreviousItem->intCompanyId == $objDbRow->GetColumn($strAliasPrefix . 'company_id', 'Integer'))) {

				// We are.  Now, prepare to check for ExpandAsArray clauses
				$blnExpandedViaArray = false;
				if (!$strAliasPrefix)
					$strAliasPrefix = 'company__';


				if ((array_key_exists($strAliasPrefix . 'address__address_id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'address__address_id')))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objAddressArray)) {
						$objPreviousChildItem = $objPreviousItem->_objAddressArray[$intPreviousChildItemCount - 1];
						$objChildItem = Address::InstantiateDbRow($objDbRow, $strAliasPrefix . 'address__', $strExpandAsArrayNodes, $objPreviousChildItem);
						if ($objChildItem)
							array_push($objPreviousItem->_objAddressArray, $objChildItem);
					} else
						array_push($objPreviousItem->_objAddressArray, Address::InstantiateDbRow($objDbRow, $strAliasPrefix . 'address__', $strExpandAsArrayNodes));
					$blnExpandedViaArray = true;
				}

				if ((array_key_exists($strAliasPrefix . 'contact__contact_id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'contact__contact_id')))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objContactArray)) {
						$objPreviousChildItem = $objPreviousItem->_objContactArray[$intPreviousChildItemCount - 1];
						$objChildItem = Contact::InstantiateDbRow($objDbRow, $strAliasPrefix . 'contact__', $strExpandAsArrayNodes, $objPreviousChildItem);
						if ($objChildItem)
							array_push($objPreviousItem->_objContactArray, $objChildItem);
					} else
						array_push($objPreviousItem->_objContactArray, Contact::InstantiateDbRow($objDbRow, $strAliasPrefix . 'contact__', $strExpandAsArrayNodes));
					$blnExpandedViaArray = true;
				}

				if ((array_key_exists($strAliasPrefix . 'receiptasfrom__receipt_id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'receiptasfrom__receipt_id')))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objReceiptAsFromArray)) {
						$objPreviousChildItem = $objPreviousItem->_objReceiptAsFromArray[$intPreviousChildItemCount - 1];
						$objChildItem = Receipt::InstantiateDbRow($objDbRow, $strAliasPrefix . 'receiptasfrom__', $strExpandAsArrayNodes, $objPreviousChildItem);
						if ($objChildItem)
							array_push($objPreviousItem->_objReceiptAsFromArray, $objChildItem);
					} else
						array_push($objPreviousItem->_objReceiptAsFromArray, Receipt::InstantiateDbRow($objDbRow, $strAliasPrefix . 'receiptasfrom__', $strExpandAsArrayNodes));
					$blnExpandedViaArray = true;
				}

				if ((array_key_exists($strAliasPrefix . 'shipmentasfrom__shipment_id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'shipmentasfrom__shipment_id')))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objShipmentAsFromArray)) {
						$objPreviousChildItem = $objPreviousItem->_objShipmentAsFromArray[$intPreviousChildItemCount - 1];
						$objChildItem = Shipment::InstantiateDbRow($objDbRow, $strAliasPrefix . 'shipmentasfrom__', $strExpandAsArrayNodes, $objPreviousChildItem);
						if ($objChildItem)
							array_push($objPreviousItem->_objShipmentAsFromArray, $objChildItem);
					} else
						array_push($objPreviousItem->_objShipmentAsFromArray, Shipment::InstantiateDbRow($objDbRow, $strAliasPrefix . 'shipmentasfrom__', $strExpandAsArrayNodes));
					$blnExpandedViaArray = true;
				}

				if ((array_key_exists($strAliasPrefix . 'shipmentasto__shipment_id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'shipmentasto__shipment_id')))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objShipmentAsToArray)) {
						$objPreviousChildItem = $objPreviousItem->_objShipmentAsToArray[$intPreviousChildItemCount - 1];
						$objChildItem = Shipment::InstantiateDbRow($objDbRow, $strAliasPrefix . 'shipmentasto__', $strExpandAsArrayNodes, $objPreviousChildItem);
						if ($objChildItem)
							array_push($objPreviousItem->_objShipmentAsToArray, $objChildItem);
					} else
						array_push($objPreviousItem->_objShipmentAsToArray, Shipment::InstantiateDbRow($objDbRow, $strAliasPrefix . 'shipmentasto__', $strExpandAsArrayNodes));
					$blnExpandedViaArray = true;
				}

				// Either return false to signal array expansion, or check-to-reset the Alias prefix and move on
				if ($blnExpandedViaArray)
					return false;
				else if ($strAliasPrefix == 'company__')
					$strAliasPrefix = null;
			}

			// Create a new instance of the Company object
			$objToReturn = new Company();
			$objToReturn->__blnRestored = true;

			$objToReturn->intCompanyId = $objDbRow->GetColumn($strAliasPrefix . 'company_id', 'Integer');
			$objToReturn->intAddressId = $objDbRow->GetColumn($strAliasPrefix . 'address_id', 'Integer');
			$objToReturn->strShortDescription = $objDbRow->GetColumn($strAliasPrefix . 'short_description', 'VarChar');
			$objToReturn->strWebsite = $objDbRow->GetColumn($strAliasPrefix . 'website', 'VarChar');
			$objToReturn->strTelephone = $objDbRow->GetColumn($strAliasPrefix . 'telephone', 'VarChar');
			$objToReturn->strFax = $objDbRow->GetColumn($strAliasPrefix . 'fax', 'VarChar');
			$objToReturn->strEmail = $objDbRow->GetColumn($strAliasPrefix . 'email', 'VarChar');
			$objToReturn->strLongDescription = $objDbRow->GetColumn($strAliasPrefix . 'long_description', 'Blob');
			$objToReturn->intCreatedBy = $objDbRow->GetColumn($strAliasPrefix . 'created_by', 'Integer');
			$objToReturn->dttCreationDate = $objDbRow->GetColumn($strAliasPrefix . 'creation_date', 'DateTime');
			$objToReturn->intModifiedBy = $objDbRow->GetColumn($strAliasPrefix . 'modified_by', 'Integer');
			$objToReturn->strModifiedDate = $objDbRow->GetColumn($strAliasPrefix . 'modified_date', 'VarChar');

			// Instantiate Virtual Attributes
			foreach ($objDbRow->GetColumnNameArray() as $strColumnName => $mixValue) {
				$strVirtualPrefix = $strAliasPrefix . '__';
				$strVirtualPrefixLength = strlen($strVirtualPrefix);
				if (substr($strColumnName, 0, $strVirtualPrefixLength) == $strVirtualPrefix)
					$objToReturn->__strVirtualAttributeArray[substr($strColumnName, $strVirtualPrefixLength)] = $mixValue;
			}

			// Prepare to Check for Early/Virtual Binding
			if (!$strAliasPrefix)
				$strAliasPrefix = 'company__';

			// Check for Address Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'address_id__address_id')))
				$objToReturn->objAddress = Address::InstantiateDbRow($objDbRow, $strAliasPrefix . 'address_id__', $strExpandAsArrayNodes);

			// Check for CreatedByObject Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'created_by__user_account_id')))
				$objToReturn->objCreatedByObject = UserAccount::InstantiateDbRow($objDbRow, $strAliasPrefix . 'created_by__', $strExpandAsArrayNodes);

			// Check for ModifiedByObject Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'modified_by__user_account_id')))
				$objToReturn->objModifiedByObject = UserAccount::InstantiateDbRow($objDbRow, $strAliasPrefix . 'modified_by__', $strExpandAsArrayNodes);




			// Check for Address Virtual Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'address__address_id'))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'address__address_id', $strExpandAsArrayNodes)))
					array_push($objToReturn->_objAddressArray, Address::InstantiateDbRow($objDbRow, $strAliasPrefix . 'address__', $strExpandAsArrayNodes));
				else
					$objToReturn->_objAddress = Address::InstantiateDbRow($objDbRow, $strAliasPrefix . 'address__', $strExpandAsArrayNodes);
			}

			// Check for Contact Virtual Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'contact__contact_id'))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'contact__contact_id', $strExpandAsArrayNodes)))
					array_push($objToReturn->_objContactArray, Contact::InstantiateDbRow($objDbRow, $strAliasPrefix . 'contact__', $strExpandAsArrayNodes));
				else
					$objToReturn->_objContact = Contact::InstantiateDbRow($objDbRow, $strAliasPrefix . 'contact__', $strExpandAsArrayNodes);
			}

			// Check for ReceiptAsFrom Virtual Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'receiptasfrom__receipt_id'))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'receiptasfrom__receipt_id', $strExpandAsArrayNodes)))
					array_push($objToReturn->_objReceiptAsFromArray, Receipt::InstantiateDbRow($objDbRow, $strAliasPrefix . 'receiptasfrom__', $strExpandAsArrayNodes));
				else
					$objToReturn->_objReceiptAsFrom = Receipt::InstantiateDbRow($objDbRow, $strAliasPrefix . 'receiptasfrom__', $strExpandAsArrayNodes);
			}

			// Check for ShipmentAsFrom Virtual Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'shipmentasfrom__shipment_id'))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'shipmentasfrom__shipment_id', $strExpandAsArrayNodes)))
					array_push($objToReturn->_objShipmentAsFromArray, Shipment::InstantiateDbRow($objDbRow, $strAliasPrefix . 'shipmentasfrom__', $strExpandAsArrayNodes));
				else
					$objToReturn->_objShipmentAsFrom = Shipment::InstantiateDbRow($objDbRow, $strAliasPrefix . 'shipmentasfrom__', $strExpandAsArrayNodes);
			}

			// Check for ShipmentAsTo Virtual Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'shipmentasto__shipment_id'))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'shipmentasto__shipment_id', $strExpandAsArrayNodes)))
					array_push($objToReturn->_objShipmentAsToArray, Shipment::InstantiateDbRow($objDbRow, $strAliasPrefix . 'shipmentasto__', $strExpandAsArrayNodes));
				else
					$objToReturn->_objShipmentAsTo = Shipment::InstantiateDbRow($objDbRow, $strAliasPrefix . 'shipmentasto__', $strExpandAsArrayNodes);
			}

			return $objToReturn;
		}

		/**
		 * Instantiate an array of Companies from a Database Result
		 * @param DatabaseResultBase $objDbResult
		 * @return Company[]
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
					$objItem = Company::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
					if ($objItem) {
						array_push($objToReturn, $objItem);
						$objLastRowItem = $objItem;
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					array_push($objToReturn, Company::InstantiateDbRow($objDbRow));
			}

			return $objToReturn;
		}



		///////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Single Load and Array)
		///////////////////////////////////////////////////
			
		/**
		 * Load a single Company object,
		 * by CompanyId Index(es)
		 * @param integer $intCompanyId
		 * @return Company
		*/
		public static function LoadByCompanyId($intCompanyId) {
			return Company::QuerySingle(
				QQ::Equal(QQN::Company()->CompanyId, $intCompanyId)
			);
		}
			
		/**
		 * Load a single Company object,
		 * by ShortDescription Index(es)
		 * @param string $strShortDescription
		 * @return Company
		*/
		public static function LoadByShortDescription($strShortDescription) {
			return Company::QuerySingle(
				QQ::Equal(QQN::Company()->ShortDescription, $strShortDescription)
			);
		}
			
		/**
		 * Load an array of Company objects,
		 * by AddressId Index(es)
		 * @param integer $intAddressId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Company[]
		*/
		public static function LoadArrayByAddressId($intAddressId, $objOptionalClauses = null) {
			// Call Company::QueryArray to perform the LoadArrayByAddressId query
			try {
				return Company::QueryArray(
					QQ::Equal(QQN::Company()->AddressId, $intAddressId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count Companies
		 * by AddressId Index(es)
		 * @param integer $intAddressId
		 * @return int
		*/
		public static function CountByAddressId($intAddressId) {
			// Call Company::QueryCount to perform the CountByAddressId query
			return Company::QueryCount(
				QQ::Equal(QQN::Company()->AddressId, $intAddressId)
			);
		}
			
		/**
		 * Load an array of Company objects,
		 * by CreatedBy Index(es)
		 * @param integer $intCreatedBy
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Company[]
		*/
		public static function LoadArrayByCreatedBy($intCreatedBy, $objOptionalClauses = null) {
			// Call Company::QueryArray to perform the LoadArrayByCreatedBy query
			try {
				return Company::QueryArray(
					QQ::Equal(QQN::Company()->CreatedBy, $intCreatedBy),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count Companies
		 * by CreatedBy Index(es)
		 * @param integer $intCreatedBy
		 * @return int
		*/
		public static function CountByCreatedBy($intCreatedBy) {
			// Call Company::QueryCount to perform the CountByCreatedBy query
			return Company::QueryCount(
				QQ::Equal(QQN::Company()->CreatedBy, $intCreatedBy)
			);
		}
			
		/**
		 * Load an array of Company objects,
		 * by ModifiedBy Index(es)
		 * @param integer $intModifiedBy
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Company[]
		*/
		public static function LoadArrayByModifiedBy($intModifiedBy, $objOptionalClauses = null) {
			// Call Company::QueryArray to perform the LoadArrayByModifiedBy query
			try {
				return Company::QueryArray(
					QQ::Equal(QQN::Company()->ModifiedBy, $intModifiedBy),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count Companies
		 * by ModifiedBy Index(es)
		 * @param integer $intModifiedBy
		 * @return int
		*/
		public static function CountByModifiedBy($intModifiedBy) {
			// Call Company::QueryCount to perform the CountByModifiedBy query
			return Company::QueryCount(
				QQ::Equal(QQN::Company()->ModifiedBy, $intModifiedBy)
			);
		}



		////////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Array via Many to Many)
		////////////////////////////////////////////////////



		//////////////////
		// SAVE AND DELETE
		//////////////////

		/**
		 * Save this Company
		 * @param bool $blnForceInsert
		 * @param bool $blnForceUpdate
		 * @return int
		*/
		public function Save($blnForceInsert = false, $blnForceUpdate = false) {
			// Get the Database Object for this Class
			$objDatabase = Company::GetDatabase();

			$mixToReturn = null;

			try {
				if ((!$this->__blnRestored) || ($blnForceInsert)) {
					// Perform an INSERT query
					$objDatabase->NonQuery('
						INSERT INTO `company` (
							`address_id`,
							`short_description`,
							`website`,
							`telephone`,
							`fax`,
							`email`,
							`long_description`,
							`created_by`,
							`creation_date`,
							`modified_by`
						) VALUES (
							' . $objDatabase->SqlVariable($this->intAddressId) . ',
							' . $objDatabase->SqlVariable($this->strShortDescription) . ',
							' . $objDatabase->SqlVariable($this->strWebsite) . ',
							' . $objDatabase->SqlVariable($this->strTelephone) . ',
							' . $objDatabase->SqlVariable($this->strFax) . ',
							' . $objDatabase->SqlVariable($this->strEmail) . ',
							' . $objDatabase->SqlVariable($this->strLongDescription) . ',
							' . $objDatabase->SqlVariable($this->intCreatedBy) . ',
							' . $objDatabase->SqlVariable($this->dttCreationDate) . ',
							' . $objDatabase->SqlVariable($this->intModifiedBy) . '
						)
					');

					// Update Identity column and return its value
					$mixToReturn = $this->intCompanyId = $objDatabase->InsertId('company', 'company_id');
				} else {
					// Perform an UPDATE query

					// First checking for Optimistic Locking constraints (if applicable)
					if (!$blnForceUpdate) {
						// Perform the Optimistic Locking check
						$objResult = $objDatabase->Query('
							SELECT
								`modified_date`
							FROM
								`company`
							WHERE
								`company_id` = ' . $objDatabase->SqlVariable($this->intCompanyId) . '
						');
						
						$objRow = $objResult->FetchArray();
						if ($objRow[0] != $this->strModifiedDate)
							throw new QExtendedOptimisticLockingException('Company', $this->intCompanyId);
					}

					// Perform the UPDATE query
					$objDatabase->NonQuery('
						UPDATE
							`company`
						SET
							`address_id` = ' . $objDatabase->SqlVariable($this->intAddressId) . ',
							`short_description` = ' . $objDatabase->SqlVariable($this->strShortDescription) . ',
							`website` = ' . $objDatabase->SqlVariable($this->strWebsite) . ',
							`telephone` = ' . $objDatabase->SqlVariable($this->strTelephone) . ',
							`fax` = ' . $objDatabase->SqlVariable($this->strFax) . ',
							`email` = ' . $objDatabase->SqlVariable($this->strEmail) . ',
							`long_description` = ' . $objDatabase->SqlVariable($this->strLongDescription) . ',
							`created_by` = ' . $objDatabase->SqlVariable($this->intCreatedBy) . ',
							`creation_date` = ' . $objDatabase->SqlVariable($this->dttCreationDate) . ',
							`modified_by` = ' . $objDatabase->SqlVariable($this->intModifiedBy) . '
						WHERE
							`company_id` = ' . $objDatabase->SqlVariable($this->intCompanyId) . '
					');
				}

			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Update __blnRestored
			$this->__blnRestored = true;

			// Update Local Timestamp
			$objResult = $objDatabase->Query('
				SELECT
					`modified_date`
				FROM
					`company`
				WHERE
					`company_id` = ' . $objDatabase->SqlVariable($this->intCompanyId) . '
			');
						
			$objRow = $objResult->FetchArray();
			$this->strModifiedDate = $objRow[0];

			// Return 
			return $mixToReturn;
		}

				/**
		 * Delete this Company
		 * @return void
		*/
		public function Delete() {
			if ((is_null($this->intCompanyId)))
				throw new QUndefinedPrimaryKeyException('Cannot delete this Company with an unset primary key.');

			// Get the Database Object for this Class
			$objDatabase = Company::GetDatabase();


			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`company`
				WHERE
					`company_id` = ' . $objDatabase->SqlVariable($this->intCompanyId) . '');
		}

		/**
		 * Delete all Companies
		 * @return void
		*/
		public static function DeleteAll() {
			// Get the Database Object for this Class
			$objDatabase = Company::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				DELETE FROM
					`company`');
		}

		/**
		 * Truncate company table
		 * @return void
		*/
		public static function Truncate() {
			// Get the Database Object for this Class
			$objDatabase = Company::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				TRUNCATE `company`');
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
				case 'CompanyId':
					/**
					 * Gets the value for intCompanyId (Read-Only PK)
					 * @return integer
					 */
					return $this->intCompanyId;

				case 'AddressId':
					/**
					 * Gets the value for intAddressId 
					 * @return integer
					 */
					return $this->intAddressId;

				case 'ShortDescription':
					/**
					 * Gets the value for strShortDescription (Unique)
					 * @return string
					 */
					return $this->strShortDescription;

				case 'Website':
					/**
					 * Gets the value for strWebsite 
					 * @return string
					 */
					return $this->strWebsite;

				case 'Telephone':
					/**
					 * Gets the value for strTelephone 
					 * @return string
					 */
					return $this->strTelephone;

				case 'Fax':
					/**
					 * Gets the value for strFax 
					 * @return string
					 */
					return $this->strFax;

				case 'Email':
					/**
					 * Gets the value for strEmail 
					 * @return string
					 */
					return $this->strEmail;

				case 'LongDescription':
					/**
					 * Gets the value for strLongDescription 
					 * @return string
					 */
					return $this->strLongDescription;

				case 'CreatedBy':
					/**
					 * Gets the value for intCreatedBy 
					 * @return integer
					 */
					return $this->intCreatedBy;

				case 'CreationDate':
					/**
					 * Gets the value for dttCreationDate 
					 * @return QDateTime
					 */
					return $this->dttCreationDate;

				case 'ModifiedBy':
					/**
					 * Gets the value for intModifiedBy 
					 * @return integer
					 */
					return $this->intModifiedBy;

				case 'ModifiedDate':
					/**
					 * Gets the value for strModifiedDate (Read-Only Timestamp)
					 * @return string
					 */
					return $this->strModifiedDate;


				///////////////////
				// Member Objects
				///////////////////
				case 'Address':
					/**
					 * Gets the value for the Address object referenced by intAddressId 
					 * @return Address
					 */
					try {
						if ((!$this->objAddress) && (!is_null($this->intAddressId)))
							$this->objAddress = Address::Load($this->intAddressId);
						return $this->objAddress;
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'CreatedByObject':
					/**
					 * Gets the value for the UserAccount object referenced by intCreatedBy 
					 * @return UserAccount
					 */
					try {
						if ((!$this->objCreatedByObject) && (!is_null($this->intCreatedBy)))
							$this->objCreatedByObject = UserAccount::Load($this->intCreatedBy);
						return $this->objCreatedByObject;
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'ModifiedByObject':
					/**
					 * Gets the value for the UserAccount object referenced by intModifiedBy 
					 * @return UserAccount
					 */
					try {
						if ((!$this->objModifiedByObject) && (!is_null($this->intModifiedBy)))
							$this->objModifiedByObject = UserAccount::Load($this->intModifiedBy);
						return $this->objModifiedByObject;
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}


				////////////////////////////
				// Virtual Object References (Many to Many and Reverse References)
				// (If restored via a "Many-to" expansion)
				////////////////////////////

				case '_Address':
					/**
					 * Gets the value for the private _objAddress (Read-Only)
					 * if set due to an expansion on the address.company_id reverse relationship
					 * @return Address
					 */
					return $this->_objAddress;

				case '_AddressArray':
					/**
					 * Gets the value for the private _objAddressArray (Read-Only)
					 * if set due to an ExpandAsArray on the address.company_id reverse relationship
					 * @return Address[]
					 */
					return (array) $this->_objAddressArray;

				case '_Contact':
					/**
					 * Gets the value for the private _objContact (Read-Only)
					 * if set due to an expansion on the contact.company_id reverse relationship
					 * @return Contact
					 */
					return $this->_objContact;

				case '_ContactArray':
					/**
					 * Gets the value for the private _objContactArray (Read-Only)
					 * if set due to an ExpandAsArray on the contact.company_id reverse relationship
					 * @return Contact[]
					 */
					return (array) $this->_objContactArray;

				case '_ReceiptAsFrom':
					/**
					 * Gets the value for the private _objReceiptAsFrom (Read-Only)
					 * if set due to an expansion on the receipt.from_company_id reverse relationship
					 * @return Receipt
					 */
					return $this->_objReceiptAsFrom;

				case '_ReceiptAsFromArray':
					/**
					 * Gets the value for the private _objReceiptAsFromArray (Read-Only)
					 * if set due to an ExpandAsArray on the receipt.from_company_id reverse relationship
					 * @return Receipt[]
					 */
					return (array) $this->_objReceiptAsFromArray;

				case '_ShipmentAsFrom':
					/**
					 * Gets the value for the private _objShipmentAsFrom (Read-Only)
					 * if set due to an expansion on the shipment.from_company_id reverse relationship
					 * @return Shipment
					 */
					return $this->_objShipmentAsFrom;

				case '_ShipmentAsFromArray':
					/**
					 * Gets the value for the private _objShipmentAsFromArray (Read-Only)
					 * if set due to an ExpandAsArray on the shipment.from_company_id reverse relationship
					 * @return Shipment[]
					 */
					return (array) $this->_objShipmentAsFromArray;

				case '_ShipmentAsTo':
					/**
					 * Gets the value for the private _objShipmentAsTo (Read-Only)
					 * if set due to an expansion on the shipment.to_company_id reverse relationship
					 * @return Shipment
					 */
					return $this->_objShipmentAsTo;

				case '_ShipmentAsToArray':
					/**
					 * Gets the value for the private _objShipmentAsToArray (Read-Only)
					 * if set due to an ExpandAsArray on the shipment.to_company_id reverse relationship
					 * @return Shipment[]
					 */
					return (array) $this->_objShipmentAsToArray;

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
				case 'AddressId':
					/**
					 * Sets the value for intAddressId 
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						$this->objAddress = null;
						return ($this->intAddressId = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'ShortDescription':
					/**
					 * Sets the value for strShortDescription (Unique)
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strShortDescription = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Website':
					/**
					 * Sets the value for strWebsite 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strWebsite = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Telephone':
					/**
					 * Sets the value for strTelephone 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strTelephone = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Fax':
					/**
					 * Sets the value for strFax 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strFax = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Email':
					/**
					 * Sets the value for strEmail 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strEmail = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'LongDescription':
					/**
					 * Sets the value for strLongDescription 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strLongDescription = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'CreatedBy':
					/**
					 * Sets the value for intCreatedBy 
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						$this->objCreatedByObject = null;
						return ($this->intCreatedBy = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'CreationDate':
					/**
					 * Sets the value for dttCreationDate 
					 * @param QDateTime $mixValue
					 * @return QDateTime
					 */
					try {
						return ($this->dttCreationDate = QType::Cast($mixValue, QType::DateTime));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'ModifiedBy':
					/**
					 * Sets the value for intModifiedBy 
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						$this->objModifiedByObject = null;
						return ($this->intModifiedBy = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}


				///////////////////
				// Member Objects
				///////////////////
				case 'Address':
					/**
					 * Sets the value for the Address object referenced by intAddressId 
					 * @param Address $mixValue
					 * @return Address
					 */
					if (is_null($mixValue)) {
						$this->intAddressId = null;
						$this->objAddress = null;
						return null;
					} else {
						// Make sure $mixValue actually is a Address object
						try {
							$mixValue = QType::Cast($mixValue, 'Address');
						} catch (QInvalidCastException $objExc) {
							$objExc->IncrementOffset();
							throw $objExc;
						} 

						// Make sure $mixValue is a SAVED Address object
						if (is_null($mixValue->AddressId))
							throw new QCallerException('Unable to set an unsaved Address for this Company');

						// Update Local Member Variables
						$this->objAddress = $mixValue;
						$this->intAddressId = $mixValue->AddressId;

						// Return $mixValue
						return $mixValue;
					}
					break;

				case 'CreatedByObject':
					/**
					 * Sets the value for the UserAccount object referenced by intCreatedBy 
					 * @param UserAccount $mixValue
					 * @return UserAccount
					 */
					if (is_null($mixValue)) {
						$this->intCreatedBy = null;
						$this->objCreatedByObject = null;
						return null;
					} else {
						// Make sure $mixValue actually is a UserAccount object
						try {
							$mixValue = QType::Cast($mixValue, 'UserAccount');
						} catch (QInvalidCastException $objExc) {
							$objExc->IncrementOffset();
							throw $objExc;
						} 

						// Make sure $mixValue is a SAVED UserAccount object
						if (is_null($mixValue->UserAccountId))
							throw new QCallerException('Unable to set an unsaved CreatedByObject for this Company');

						// Update Local Member Variables
						$this->objCreatedByObject = $mixValue;
						$this->intCreatedBy = $mixValue->UserAccountId;

						// Return $mixValue
						return $mixValue;
					}
					break;

				case 'ModifiedByObject':
					/**
					 * Sets the value for the UserAccount object referenced by intModifiedBy 
					 * @param UserAccount $mixValue
					 * @return UserAccount
					 */
					if (is_null($mixValue)) {
						$this->intModifiedBy = null;
						$this->objModifiedByObject = null;
						return null;
					} else {
						// Make sure $mixValue actually is a UserAccount object
						try {
							$mixValue = QType::Cast($mixValue, 'UserAccount');
						} catch (QInvalidCastException $objExc) {
							$objExc->IncrementOffset();
							throw $objExc;
						} 

						// Make sure $mixValue is a SAVED UserAccount object
						if (is_null($mixValue->UserAccountId))
							throw new QCallerException('Unable to set an unsaved ModifiedByObject for this Company');

						// Update Local Member Variables
						$this->objModifiedByObject = $mixValue;
						$this->intModifiedBy = $mixValue->UserAccountId;

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

			
		
		// Related Objects' Methods for Address
		//-------------------------------------------------------------------

		/**
		 * Gets all associated Addresses as an array of Address objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Address[]
		*/ 
		public function GetAddressArray($objOptionalClauses = null) {
			if ((is_null($this->intCompanyId)))
				return array();

			try {
				return Address::LoadArrayByCompanyId($this->intCompanyId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated Addresses
		 * @return int
		*/ 
		public function CountAddresses() {
			if ((is_null($this->intCompanyId)))
				return 0;

			return Address::CountByCompanyId($this->intCompanyId);
		}

		/**
		 * Associates a Address
		 * @param Address $objAddress
		 * @return void
		*/ 
		public function AssociateAddress(Address $objAddress) {
			if ((is_null($this->intCompanyId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateAddress on this unsaved Company.');
			if ((is_null($objAddress->AddressId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateAddress on this Company with an unsaved Address.');

			// Get the Database Object for this Class
			$objDatabase = Company::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`address`
				SET
					`company_id` = ' . $objDatabase->SqlVariable($this->intCompanyId) . '
				WHERE
					`address_id` = ' . $objDatabase->SqlVariable($objAddress->AddressId) . '
			');
		}

		/**
		 * Unassociates a Address
		 * @param Address $objAddress
		 * @return void
		*/ 
		public function UnassociateAddress(Address $objAddress) {
			if ((is_null($this->intCompanyId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateAddress on this unsaved Company.');
			if ((is_null($objAddress->AddressId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateAddress on this Company with an unsaved Address.');

			// Get the Database Object for this Class
			$objDatabase = Company::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`address`
				SET
					`company_id` = null
				WHERE
					`address_id` = ' . $objDatabase->SqlVariable($objAddress->AddressId) . ' AND
					`company_id` = ' . $objDatabase->SqlVariable($this->intCompanyId) . '
			');
		}

		/**
		 * Unassociates all Addresses
		 * @return void
		*/ 
		public function UnassociateAllAddresses() {
			if ((is_null($this->intCompanyId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateAddress on this unsaved Company.');

			// Get the Database Object for this Class
			$objDatabase = Company::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`address`
				SET
					`company_id` = null
				WHERE
					`company_id` = ' . $objDatabase->SqlVariable($this->intCompanyId) . '
			');
		}

		/**
		 * Deletes an associated Address
		 * @param Address $objAddress
		 * @return void
		*/ 
		public function DeleteAssociatedAddress(Address $objAddress) {
			if ((is_null($this->intCompanyId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateAddress on this unsaved Company.');
			if ((is_null($objAddress->AddressId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateAddress on this Company with an unsaved Address.');

			// Get the Database Object for this Class
			$objDatabase = Company::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`address`
				WHERE
					`address_id` = ' . $objDatabase->SqlVariable($objAddress->AddressId) . ' AND
					`company_id` = ' . $objDatabase->SqlVariable($this->intCompanyId) . '
			');
		}

		/**
		 * Deletes all associated Addresses
		 * @return void
		*/ 
		public function DeleteAllAddresses() {
			if ((is_null($this->intCompanyId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateAddress on this unsaved Company.');

			// Get the Database Object for this Class
			$objDatabase = Company::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`address`
				WHERE
					`company_id` = ' . $objDatabase->SqlVariable($this->intCompanyId) . '
			');
		}

			
		
		// Related Objects' Methods for Contact
		//-------------------------------------------------------------------

		/**
		 * Gets all associated Contacts as an array of Contact objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Contact[]
		*/ 
		public function GetContactArray($objOptionalClauses = null) {
			if ((is_null($this->intCompanyId)))
				return array();

			try {
				return Contact::LoadArrayByCompanyId($this->intCompanyId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated Contacts
		 * @return int
		*/ 
		public function CountContacts() {
			if ((is_null($this->intCompanyId)))
				return 0;

			return Contact::CountByCompanyId($this->intCompanyId);
		}

		/**
		 * Associates a Contact
		 * @param Contact $objContact
		 * @return void
		*/ 
		public function AssociateContact(Contact $objContact) {
			if ((is_null($this->intCompanyId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateContact on this unsaved Company.');
			if ((is_null($objContact->ContactId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateContact on this Company with an unsaved Contact.');

			// Get the Database Object for this Class
			$objDatabase = Company::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`contact`
				SET
					`company_id` = ' . $objDatabase->SqlVariable($this->intCompanyId) . '
				WHERE
					`contact_id` = ' . $objDatabase->SqlVariable($objContact->ContactId) . '
			');
		}

		/**
		 * Unassociates a Contact
		 * @param Contact $objContact
		 * @return void
		*/ 
		public function UnassociateContact(Contact $objContact) {
			if ((is_null($this->intCompanyId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateContact on this unsaved Company.');
			if ((is_null($objContact->ContactId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateContact on this Company with an unsaved Contact.');

			// Get the Database Object for this Class
			$objDatabase = Company::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`contact`
				SET
					`company_id` = null
				WHERE
					`contact_id` = ' . $objDatabase->SqlVariable($objContact->ContactId) . ' AND
					`company_id` = ' . $objDatabase->SqlVariable($this->intCompanyId) . '
			');
		}

		/**
		 * Unassociates all Contacts
		 * @return void
		*/ 
		public function UnassociateAllContacts() {
			if ((is_null($this->intCompanyId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateContact on this unsaved Company.');

			// Get the Database Object for this Class
			$objDatabase = Company::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`contact`
				SET
					`company_id` = null
				WHERE
					`company_id` = ' . $objDatabase->SqlVariable($this->intCompanyId) . '
			');
		}

		/**
		 * Deletes an associated Contact
		 * @param Contact $objContact
		 * @return void
		*/ 
		public function DeleteAssociatedContact(Contact $objContact) {
			if ((is_null($this->intCompanyId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateContact on this unsaved Company.');
			if ((is_null($objContact->ContactId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateContact on this Company with an unsaved Contact.');

			// Get the Database Object for this Class
			$objDatabase = Company::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`contact`
				WHERE
					`contact_id` = ' . $objDatabase->SqlVariable($objContact->ContactId) . ' AND
					`company_id` = ' . $objDatabase->SqlVariable($this->intCompanyId) . '
			');
		}

		/**
		 * Deletes all associated Contacts
		 * @return void
		*/ 
		public function DeleteAllContacts() {
			if ((is_null($this->intCompanyId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateContact on this unsaved Company.');

			// Get the Database Object for this Class
			$objDatabase = Company::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`contact`
				WHERE
					`company_id` = ' . $objDatabase->SqlVariable($this->intCompanyId) . '
			');
		}

			
		
		// Related Objects' Methods for ReceiptAsFrom
		//-------------------------------------------------------------------

		/**
		 * Gets all associated ReceiptsAsFrom as an array of Receipt objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Receipt[]
		*/ 
		public function GetReceiptAsFromArray($objOptionalClauses = null) {
			if ((is_null($this->intCompanyId)))
				return array();

			try {
				return Receipt::LoadArrayByFromCompanyId($this->intCompanyId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated ReceiptsAsFrom
		 * @return int
		*/ 
		public function CountReceiptsAsFrom() {
			if ((is_null($this->intCompanyId)))
				return 0;

			return Receipt::CountByFromCompanyId($this->intCompanyId);
		}

		/**
		 * Associates a ReceiptAsFrom
		 * @param Receipt $objReceipt
		 * @return void
		*/ 
		public function AssociateReceiptAsFrom(Receipt $objReceipt) {
			if ((is_null($this->intCompanyId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateReceiptAsFrom on this unsaved Company.');
			if ((is_null($objReceipt->ReceiptId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateReceiptAsFrom on this Company with an unsaved Receipt.');

			// Get the Database Object for this Class
			$objDatabase = Company::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`receipt`
				SET
					`from_company_id` = ' . $objDatabase->SqlVariable($this->intCompanyId) . '
				WHERE
					`receipt_id` = ' . $objDatabase->SqlVariable($objReceipt->ReceiptId) . '
			');
		}

		/**
		 * Unassociates a ReceiptAsFrom
		 * @param Receipt $objReceipt
		 * @return void
		*/ 
		public function UnassociateReceiptAsFrom(Receipt $objReceipt) {
			if ((is_null($this->intCompanyId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateReceiptAsFrom on this unsaved Company.');
			if ((is_null($objReceipt->ReceiptId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateReceiptAsFrom on this Company with an unsaved Receipt.');

			// Get the Database Object for this Class
			$objDatabase = Company::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`receipt`
				SET
					`from_company_id` = null
				WHERE
					`receipt_id` = ' . $objDatabase->SqlVariable($objReceipt->ReceiptId) . ' AND
					`from_company_id` = ' . $objDatabase->SqlVariable($this->intCompanyId) . '
			');
		}

		/**
		 * Unassociates all ReceiptsAsFrom
		 * @return void
		*/ 
		public function UnassociateAllReceiptsAsFrom() {
			if ((is_null($this->intCompanyId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateReceiptAsFrom on this unsaved Company.');

			// Get the Database Object for this Class
			$objDatabase = Company::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`receipt`
				SET
					`from_company_id` = null
				WHERE
					`from_company_id` = ' . $objDatabase->SqlVariable($this->intCompanyId) . '
			');
		}

		/**
		 * Deletes an associated ReceiptAsFrom
		 * @param Receipt $objReceipt
		 * @return void
		*/ 
		public function DeleteAssociatedReceiptAsFrom(Receipt $objReceipt) {
			if ((is_null($this->intCompanyId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateReceiptAsFrom on this unsaved Company.');
			if ((is_null($objReceipt->ReceiptId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateReceiptAsFrom on this Company with an unsaved Receipt.');

			// Get the Database Object for this Class
			$objDatabase = Company::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`receipt`
				WHERE
					`receipt_id` = ' . $objDatabase->SqlVariable($objReceipt->ReceiptId) . ' AND
					`from_company_id` = ' . $objDatabase->SqlVariable($this->intCompanyId) . '
			');
		}

		/**
		 * Deletes all associated ReceiptsAsFrom
		 * @return void
		*/ 
		public function DeleteAllReceiptsAsFrom() {
			if ((is_null($this->intCompanyId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateReceiptAsFrom on this unsaved Company.');

			// Get the Database Object for this Class
			$objDatabase = Company::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`receipt`
				WHERE
					`from_company_id` = ' . $objDatabase->SqlVariable($this->intCompanyId) . '
			');
		}

			
		
		// Related Objects' Methods for ShipmentAsFrom
		//-------------------------------------------------------------------

		/**
		 * Gets all associated ShipmentsAsFrom as an array of Shipment objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Shipment[]
		*/ 
		public function GetShipmentAsFromArray($objOptionalClauses = null) {
			if ((is_null($this->intCompanyId)))
				return array();

			try {
				return Shipment::LoadArrayByFromCompanyId($this->intCompanyId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated ShipmentsAsFrom
		 * @return int
		*/ 
		public function CountShipmentsAsFrom() {
			if ((is_null($this->intCompanyId)))
				return 0;

			return Shipment::CountByFromCompanyId($this->intCompanyId);
		}

		/**
		 * Associates a ShipmentAsFrom
		 * @param Shipment $objShipment
		 * @return void
		*/ 
		public function AssociateShipmentAsFrom(Shipment $objShipment) {
			if ((is_null($this->intCompanyId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateShipmentAsFrom on this unsaved Company.');
			if ((is_null($objShipment->ShipmentId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateShipmentAsFrom on this Company with an unsaved Shipment.');

			// Get the Database Object for this Class
			$objDatabase = Company::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`shipment`
				SET
					`from_company_id` = ' . $objDatabase->SqlVariable($this->intCompanyId) . '
				WHERE
					`shipment_id` = ' . $objDatabase->SqlVariable($objShipment->ShipmentId) . '
			');
		}

		/**
		 * Unassociates a ShipmentAsFrom
		 * @param Shipment $objShipment
		 * @return void
		*/ 
		public function UnassociateShipmentAsFrom(Shipment $objShipment) {
			if ((is_null($this->intCompanyId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateShipmentAsFrom on this unsaved Company.');
			if ((is_null($objShipment->ShipmentId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateShipmentAsFrom on this Company with an unsaved Shipment.');

			// Get the Database Object for this Class
			$objDatabase = Company::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`shipment`
				SET
					`from_company_id` = null
				WHERE
					`shipment_id` = ' . $objDatabase->SqlVariable($objShipment->ShipmentId) . ' AND
					`from_company_id` = ' . $objDatabase->SqlVariable($this->intCompanyId) . '
			');
		}

		/**
		 * Unassociates all ShipmentsAsFrom
		 * @return void
		*/ 
		public function UnassociateAllShipmentsAsFrom() {
			if ((is_null($this->intCompanyId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateShipmentAsFrom on this unsaved Company.');

			// Get the Database Object for this Class
			$objDatabase = Company::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`shipment`
				SET
					`from_company_id` = null
				WHERE
					`from_company_id` = ' . $objDatabase->SqlVariable($this->intCompanyId) . '
			');
		}

		/**
		 * Deletes an associated ShipmentAsFrom
		 * @param Shipment $objShipment
		 * @return void
		*/ 
		public function DeleteAssociatedShipmentAsFrom(Shipment $objShipment) {
			if ((is_null($this->intCompanyId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateShipmentAsFrom on this unsaved Company.');
			if ((is_null($objShipment->ShipmentId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateShipmentAsFrom on this Company with an unsaved Shipment.');

			// Get the Database Object for this Class
			$objDatabase = Company::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`shipment`
				WHERE
					`shipment_id` = ' . $objDatabase->SqlVariable($objShipment->ShipmentId) . ' AND
					`from_company_id` = ' . $objDatabase->SqlVariable($this->intCompanyId) . '
			');
		}

		/**
		 * Deletes all associated ShipmentsAsFrom
		 * @return void
		*/ 
		public function DeleteAllShipmentsAsFrom() {
			if ((is_null($this->intCompanyId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateShipmentAsFrom on this unsaved Company.');

			// Get the Database Object for this Class
			$objDatabase = Company::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`shipment`
				WHERE
					`from_company_id` = ' . $objDatabase->SqlVariable($this->intCompanyId) . '
			');
		}

			
		
		// Related Objects' Methods for ShipmentAsTo
		//-------------------------------------------------------------------

		/**
		 * Gets all associated ShipmentsAsTo as an array of Shipment objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Shipment[]
		*/ 
		public function GetShipmentAsToArray($objOptionalClauses = null) {
			if ((is_null($this->intCompanyId)))
				return array();

			try {
				return Shipment::LoadArrayByToCompanyId($this->intCompanyId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated ShipmentsAsTo
		 * @return int
		*/ 
		public function CountShipmentsAsTo() {
			if ((is_null($this->intCompanyId)))
				return 0;

			return Shipment::CountByToCompanyId($this->intCompanyId);
		}

		/**
		 * Associates a ShipmentAsTo
		 * @param Shipment $objShipment
		 * @return void
		*/ 
		public function AssociateShipmentAsTo(Shipment $objShipment) {
			if ((is_null($this->intCompanyId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateShipmentAsTo on this unsaved Company.');
			if ((is_null($objShipment->ShipmentId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateShipmentAsTo on this Company with an unsaved Shipment.');

			// Get the Database Object for this Class
			$objDatabase = Company::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`shipment`
				SET
					`to_company_id` = ' . $objDatabase->SqlVariable($this->intCompanyId) . '
				WHERE
					`shipment_id` = ' . $objDatabase->SqlVariable($objShipment->ShipmentId) . '
			');
		}

		/**
		 * Unassociates a ShipmentAsTo
		 * @param Shipment $objShipment
		 * @return void
		*/ 
		public function UnassociateShipmentAsTo(Shipment $objShipment) {
			if ((is_null($this->intCompanyId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateShipmentAsTo on this unsaved Company.');
			if ((is_null($objShipment->ShipmentId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateShipmentAsTo on this Company with an unsaved Shipment.');

			// Get the Database Object for this Class
			$objDatabase = Company::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`shipment`
				SET
					`to_company_id` = null
				WHERE
					`shipment_id` = ' . $objDatabase->SqlVariable($objShipment->ShipmentId) . ' AND
					`to_company_id` = ' . $objDatabase->SqlVariable($this->intCompanyId) . '
			');
		}

		/**
		 * Unassociates all ShipmentsAsTo
		 * @return void
		*/ 
		public function UnassociateAllShipmentsAsTo() {
			if ((is_null($this->intCompanyId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateShipmentAsTo on this unsaved Company.');

			// Get the Database Object for this Class
			$objDatabase = Company::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`shipment`
				SET
					`to_company_id` = null
				WHERE
					`to_company_id` = ' . $objDatabase->SqlVariable($this->intCompanyId) . '
			');
		}

		/**
		 * Deletes an associated ShipmentAsTo
		 * @param Shipment $objShipment
		 * @return void
		*/ 
		public function DeleteAssociatedShipmentAsTo(Shipment $objShipment) {
			if ((is_null($this->intCompanyId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateShipmentAsTo on this unsaved Company.');
			if ((is_null($objShipment->ShipmentId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateShipmentAsTo on this Company with an unsaved Shipment.');

			// Get the Database Object for this Class
			$objDatabase = Company::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`shipment`
				WHERE
					`shipment_id` = ' . $objDatabase->SqlVariable($objShipment->ShipmentId) . ' AND
					`to_company_id` = ' . $objDatabase->SqlVariable($this->intCompanyId) . '
			');
		}

		/**
		 * Deletes all associated ShipmentsAsTo
		 * @return void
		*/ 
		public function DeleteAllShipmentsAsTo() {
			if ((is_null($this->intCompanyId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateShipmentAsTo on this unsaved Company.');

			// Get the Database Object for this Class
			$objDatabase = Company::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`shipment`
				WHERE
					`to_company_id` = ' . $objDatabase->SqlVariable($this->intCompanyId) . '
			');
		}




		///////////////////////////////////////////////////////////////////////
		// PROTECTED MEMBER VARIABLES and TEXT FIELD MAXLENGTHS (if applicable)
		///////////////////////////////////////////////////////////////////////
		
		/**
		 * Protected member variable that maps to the database PK Identity column company.company_id
		 * @var integer intCompanyId
		 */
		protected $intCompanyId;
		const CompanyIdDefault = null;


		/**
		 * Protected member variable that maps to the database column company.address_id
		 * @var integer intAddressId
		 */
		protected $intAddressId;
		const AddressIdDefault = null;


		/**
		 * Protected member variable that maps to the database column company.short_description
		 * @var string strShortDescription
		 */
		protected $strShortDescription;
		const ShortDescriptionMaxLength = 255;
		const ShortDescriptionDefault = null;


		/**
		 * Protected member variable that maps to the database column company.website
		 * @var string strWebsite
		 */
		protected $strWebsite;
		const WebsiteMaxLength = 255;
		const WebsiteDefault = null;


		/**
		 * Protected member variable that maps to the database column company.telephone
		 * @var string strTelephone
		 */
		protected $strTelephone;
		const TelephoneMaxLength = 50;
		const TelephoneDefault = null;


		/**
		 * Protected member variable that maps to the database column company.fax
		 * @var string strFax
		 */
		protected $strFax;
		const FaxMaxLength = 50;
		const FaxDefault = null;


		/**
		 * Protected member variable that maps to the database column company.email
		 * @var string strEmail
		 */
		protected $strEmail;
		const EmailMaxLength = 50;
		const EmailDefault = null;


		/**
		 * Protected member variable that maps to the database column company.long_description
		 * @var string strLongDescription
		 */
		protected $strLongDescription;
		const LongDescriptionDefault = null;


		/**
		 * Protected member variable that maps to the database column company.created_by
		 * @var integer intCreatedBy
		 */
		protected $intCreatedBy;
		const CreatedByDefault = null;


		/**
		 * Protected member variable that maps to the database column company.creation_date
		 * @var QDateTime dttCreationDate
		 */
		protected $dttCreationDate;
		const CreationDateDefault = null;


		/**
		 * Protected member variable that maps to the database column company.modified_by
		 * @var integer intModifiedBy
		 */
		protected $intModifiedBy;
		const ModifiedByDefault = null;


		/**
		 * Protected member variable that maps to the database column company.modified_date
		 * @var string strModifiedDate
		 */
		protected $strModifiedDate;
		const ModifiedDateDefault = null;


		/**
		 * Private member variable that stores a reference to a single Address object
		 * (of type Address), if this Company object was restored with
		 * an expansion on the address association table.
		 * @var Address _objAddress;
		 */
		private $_objAddress;

		/**
		 * Private member variable that stores a reference to an array of Address objects
		 * (of type Address[]), if this Company object was restored with
		 * an ExpandAsArray on the address association table.
		 * @var Address[] _objAddressArray;
		 */
		private $_objAddressArray = array();

		/**
		 * Private member variable that stores a reference to a single Contact object
		 * (of type Contact), if this Company object was restored with
		 * an expansion on the contact association table.
		 * @var Contact _objContact;
		 */
		private $_objContact;

		/**
		 * Private member variable that stores a reference to an array of Contact objects
		 * (of type Contact[]), if this Company object was restored with
		 * an ExpandAsArray on the contact association table.
		 * @var Contact[] _objContactArray;
		 */
		private $_objContactArray = array();

		/**
		 * Private member variable that stores a reference to a single ReceiptAsFrom object
		 * (of type Receipt), if this Company object was restored with
		 * an expansion on the receipt association table.
		 * @var Receipt _objReceiptAsFrom;
		 */
		private $_objReceiptAsFrom;

		/**
		 * Private member variable that stores a reference to an array of ReceiptAsFrom objects
		 * (of type Receipt[]), if this Company object was restored with
		 * an ExpandAsArray on the receipt association table.
		 * @var Receipt[] _objReceiptAsFromArray;
		 */
		private $_objReceiptAsFromArray = array();

		/**
		 * Private member variable that stores a reference to a single ShipmentAsFrom object
		 * (of type Shipment), if this Company object was restored with
		 * an expansion on the shipment association table.
		 * @var Shipment _objShipmentAsFrom;
		 */
		private $_objShipmentAsFrom;

		/**
		 * Private member variable that stores a reference to an array of ShipmentAsFrom objects
		 * (of type Shipment[]), if this Company object was restored with
		 * an ExpandAsArray on the shipment association table.
		 * @var Shipment[] _objShipmentAsFromArray;
		 */
		private $_objShipmentAsFromArray = array();

		/**
		 * Private member variable that stores a reference to a single ShipmentAsTo object
		 * (of type Shipment), if this Company object was restored with
		 * an expansion on the shipment association table.
		 * @var Shipment _objShipmentAsTo;
		 */
		private $_objShipmentAsTo;

		/**
		 * Private member variable that stores a reference to an array of ShipmentAsTo objects
		 * (of type Shipment[]), if this Company object was restored with
		 * an ExpandAsArray on the shipment association table.
		 * @var Shipment[] _objShipmentAsToArray;
		 */
		private $_objShipmentAsToArray = array();

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
		 * in the database column company.address_id.
		 *
		 * NOTE: Always use the Address property getter to correctly retrieve this Address object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var Address objAddress
		 */
		protected $objAddress;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column company.created_by.
		 *
		 * NOTE: Always use the CreatedByObject property getter to correctly retrieve this UserAccount object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var UserAccount objCreatedByObject
		 */
		protected $objCreatedByObject;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column company.modified_by.
		 *
		 * NOTE: Always use the ModifiedByObject property getter to correctly retrieve this UserAccount object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var UserAccount objModifiedByObject
		 */
		protected $objModifiedByObject;






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
				$objQueryExpansion = new QQueryExpansion('Company', 'company', $objExpansionMap);
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
				$objQueryExpansion->AddFromItem(sprintf('LEFT JOIN `company` AS `%s__%s` ON `%s`.`%s` = `%s__%s`.`company_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias, $strParentAlias, $strAlias));

				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`company_id` AS `%s__%s__company_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`address_id` AS `%s__%s__address_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`short_description` AS `%s__%s__short_description`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`website` AS `%s__%s__website`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`telephone` AS `%s__%s__telephone`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`fax` AS `%s__%s__fax`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`email` AS `%s__%s__email`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`long_description` AS `%s__%s__long_description`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`created_by` AS `%s__%s__created_by`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`creation_date` AS `%s__%s__creation_date`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`modified_by` AS `%s__%s__modified_by`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`modified_date` AS `%s__%s__modified_date`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));

				$strParentAlias = $strParentAlias . '__' . $strAlias;
			}

			if (is_array($objExpansionMap))
				foreach ($objExpansionMap as $strKey=>$objValue) {
					switch ($strKey) {
						case 'address_id':
							try {
								Address::ExpandQuery($strParentAlias, $strKey, $objValue, $objQueryExpansion);
								break;
							} catch (QCallerException $objExc) {
								$objExc->IncrementOffset();
								throw $objExc;
							}
						case 'created_by':
							try {
								UserAccount::ExpandQuery($strParentAlias, $strKey, $objValue, $objQueryExpansion);
								break;
							} catch (QCallerException $objExc) {
								$objExc->IncrementOffset();
								throw $objExc;
							}
						case 'modified_by':
							try {
								UserAccount::ExpandQuery($strParentAlias, $strKey, $objValue, $objQueryExpansion);
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
		const ExpandAddress = 'address_id';
		const ExpandCreatedByObject = 'created_by';
		const ExpandModifiedByObject = 'modified_by';




		////////////////////////////////////////
		// METHODS for WEB SERVICES
		////////////////////////////////////////

		public static function GetSoapComplexTypeXml() {
			$strToReturn = '<complexType name="Company"><sequence>';
			$strToReturn .= '<element name="CompanyId" type="xsd:int"/>';
			$strToReturn .= '<element name="Address" type="xsd1:Address"/>';
			$strToReturn .= '<element name="ShortDescription" type="xsd:string"/>';
			$strToReturn .= '<element name="Website" type="xsd:string"/>';
			$strToReturn .= '<element name="Telephone" type="xsd:string"/>';
			$strToReturn .= '<element name="Fax" type="xsd:string"/>';
			$strToReturn .= '<element name="Email" type="xsd:string"/>';
			$strToReturn .= '<element name="LongDescription" type="xsd:string"/>';
			$strToReturn .= '<element name="CreatedByObject" type="xsd1:UserAccount"/>';
			$strToReturn .= '<element name="CreationDate" type="xsd:dateTime"/>';
			$strToReturn .= '<element name="ModifiedByObject" type="xsd1:UserAccount"/>';
			$strToReturn .= '<element name="ModifiedDate" type="xsd:string"/>';
			$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
			$strToReturn .= '</sequence></complexType>';
			return $strToReturn;
		}

		public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
			if (!array_key_exists('Company', $strComplexTypeArray)) {
				$strComplexTypeArray['Company'] = Company::GetSoapComplexTypeXml();
				Address::AlterSoapComplexTypeArray($strComplexTypeArray);
				UserAccount::AlterSoapComplexTypeArray($strComplexTypeArray);
				UserAccount::AlterSoapComplexTypeArray($strComplexTypeArray);
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, Company::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new Company();
			if (property_exists($objSoapObject, 'CompanyId'))
				$objToReturn->intCompanyId = $objSoapObject->CompanyId;
			if ((property_exists($objSoapObject, 'Address')) &&
				($objSoapObject->Address))
				$objToReturn->Address = Address::GetObjectFromSoapObject($objSoapObject->Address);
			if (property_exists($objSoapObject, 'ShortDescription'))
				$objToReturn->strShortDescription = $objSoapObject->ShortDescription;
			if (property_exists($objSoapObject, 'Website'))
				$objToReturn->strWebsite = $objSoapObject->Website;
			if (property_exists($objSoapObject, 'Telephone'))
				$objToReturn->strTelephone = $objSoapObject->Telephone;
			if (property_exists($objSoapObject, 'Fax'))
				$objToReturn->strFax = $objSoapObject->Fax;
			if (property_exists($objSoapObject, 'Email'))
				$objToReturn->strEmail = $objSoapObject->Email;
			if (property_exists($objSoapObject, 'LongDescription'))
				$objToReturn->strLongDescription = $objSoapObject->LongDescription;
			if ((property_exists($objSoapObject, 'CreatedByObject')) &&
				($objSoapObject->CreatedByObject))
				$objToReturn->CreatedByObject = UserAccount::GetObjectFromSoapObject($objSoapObject->CreatedByObject);
			if (property_exists($objSoapObject, 'CreationDate'))
				$objToReturn->dttCreationDate = new QDateTime($objSoapObject->CreationDate);
			if ((property_exists($objSoapObject, 'ModifiedByObject')) &&
				($objSoapObject->ModifiedByObject))
				$objToReturn->ModifiedByObject = UserAccount::GetObjectFromSoapObject($objSoapObject->ModifiedByObject);
			if (property_exists($objSoapObject, 'ModifiedDate'))
				$objToReturn->strModifiedDate = $objSoapObject->ModifiedDate;
			if (property_exists($objSoapObject, '__blnRestored'))
				$objToReturn->__blnRestored = $objSoapObject->__blnRestored;
			return $objToReturn;
		}

		public static function GetSoapArrayFromArray($objArray) {
			if (!$objArray)
				return null;

			$objArrayToReturn = array();

			foreach ($objArray as $objObject)
				array_push($objArrayToReturn, Company::GetSoapObjectFromObject($objObject, true));

			return unserialize(serialize($objArrayToReturn));
		}

		public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
			if ($objObject->objAddress)
				$objObject->objAddress = Address::GetSoapObjectFromObject($objObject->objAddress, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intAddressId = null;
			if ($objObject->objCreatedByObject)
				$objObject->objCreatedByObject = UserAccount::GetSoapObjectFromObject($objObject->objCreatedByObject, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intCreatedBy = null;
			if ($objObject->dttCreationDate)
				$objObject->dttCreationDate = $objObject->dttCreationDate->__toString(QDateTime::FormatSoap);
			if ($objObject->objModifiedByObject)
				$objObject->objModifiedByObject = UserAccount::GetSoapObjectFromObject($objObject->objModifiedByObject, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intModifiedBy = null;
			return $objObject;
		}
	}





	/////////////////////////////////////
	// ADDITIONAL CLASSES for QCODO QUERY
	/////////////////////////////////////

	class QQNodeCompany extends QQNode {
		protected $strTableName = 'company';
		protected $strPrimaryKey = 'company_id';
		protected $strClassName = 'Company';
		public function __get($strName) {
			switch ($strName) {
				case 'CompanyId':
					return new QQNode('company_id', 'integer', $this);
				case 'AddressId':
					return new QQNode('address_id', 'integer', $this);
				case 'Address':
					return new QQNodeAddress('address_id', 'integer', $this);
				case 'ShortDescription':
					return new QQNode('short_description', 'string', $this);
				case 'Website':
					return new QQNode('website', 'string', $this);
				case 'Telephone':
					return new QQNode('telephone', 'string', $this);
				case 'Fax':
					return new QQNode('fax', 'string', $this);
				case 'Email':
					return new QQNode('email', 'string', $this);
				case 'LongDescription':
					return new QQNode('long_description', 'string', $this);
				case 'CreatedBy':
					return new QQNode('created_by', 'integer', $this);
				case 'CreatedByObject':
					return new QQNodeUserAccount('created_by', 'integer', $this);
				case 'CreationDate':
					return new QQNode('creation_date', 'QDateTime', $this);
				case 'ModifiedBy':
					return new QQNode('modified_by', 'integer', $this);
				case 'ModifiedByObject':
					return new QQNodeUserAccount('modified_by', 'integer', $this);
				case 'ModifiedDate':
					return new QQNode('modified_date', 'string', $this);
				case 'Address':
					return new QQReverseReferenceNodeAddress($this, 'address', 'reverse_reference', 'company_id');
				case 'Contact':
					return new QQReverseReferenceNodeContact($this, 'contact', 'reverse_reference', 'company_id');
				case 'ReceiptAsFrom':
					return new QQReverseReferenceNodeReceipt($this, 'receiptasfrom', 'reverse_reference', 'from_company_id');
				case 'ShipmentAsFrom':
					return new QQReverseReferenceNodeShipment($this, 'shipmentasfrom', 'reverse_reference', 'from_company_id');
				case 'ShipmentAsTo':
					return new QQReverseReferenceNodeShipment($this, 'shipmentasto', 'reverse_reference', 'to_company_id');

				case '_PrimaryKeyNode':
					return new QQNode('company_id', 'integer', $this);
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

	class QQReverseReferenceNodeCompany extends QQReverseReferenceNode {
		protected $strTableName = 'company';
		protected $strPrimaryKey = 'company_id';
		protected $strClassName = 'Company';
		public function __get($strName) {
			switch ($strName) {
				case 'CompanyId':
					return new QQNode('company_id', 'integer', $this);
				case 'AddressId':
					return new QQNode('address_id', 'integer', $this);
				case 'Address':
					return new QQNodeAddress('address_id', 'integer', $this);
				case 'ShortDescription':
					return new QQNode('short_description', 'string', $this);
				case 'Website':
					return new QQNode('website', 'string', $this);
				case 'Telephone':
					return new QQNode('telephone', 'string', $this);
				case 'Fax':
					return new QQNode('fax', 'string', $this);
				case 'Email':
					return new QQNode('email', 'string', $this);
				case 'LongDescription':
					return new QQNode('long_description', 'string', $this);
				case 'CreatedBy':
					return new QQNode('created_by', 'integer', $this);
				case 'CreatedByObject':
					return new QQNodeUserAccount('created_by', 'integer', $this);
				case 'CreationDate':
					return new QQNode('creation_date', 'QDateTime', $this);
				case 'ModifiedBy':
					return new QQNode('modified_by', 'integer', $this);
				case 'ModifiedByObject':
					return new QQNodeUserAccount('modified_by', 'integer', $this);
				case 'ModifiedDate':
					return new QQNode('modified_date', 'string', $this);
				case 'Address':
					return new QQReverseReferenceNodeAddress($this, 'address', 'reverse_reference', 'company_id');
				case 'Contact':
					return new QQReverseReferenceNodeContact($this, 'contact', 'reverse_reference', 'company_id');
				case 'ReceiptAsFrom':
					return new QQReverseReferenceNodeReceipt($this, 'receiptasfrom', 'reverse_reference', 'from_company_id');
				case 'ShipmentAsFrom':
					return new QQReverseReferenceNodeShipment($this, 'shipmentasfrom', 'reverse_reference', 'from_company_id');
				case 'ShipmentAsTo':
					return new QQReverseReferenceNodeShipment($this, 'shipmentasto', 'reverse_reference', 'to_company_id');

				case '_PrimaryKeyNode':
					return new QQNode('company_id', 'integer', $this);
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