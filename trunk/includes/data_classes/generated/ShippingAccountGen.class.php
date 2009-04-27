<?php
	/**
	 * The abstract ShippingAccountGen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the ShippingAccount subclass which
	 * extends this ShippingAccountGen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the ShippingAccount class.
	 * 
	 * @package My Application
	 * @subpackage GeneratedDataObjects
	 * 
	 */
	class ShippingAccountGen extends QBaseClass {
		///////////////////////////////
		// COMMON LOAD METHODS
		///////////////////////////////

		/**
		 * Load a ShippingAccount from PK Info
		 * @param integer $intShippingAccountId
		 * @return ShippingAccount
		 */
		public static function Load($intShippingAccountId) {
			// Use QuerySingle to Perform the Query
			return ShippingAccount::QuerySingle(
				QQ::Equal(QQN::ShippingAccount()->ShippingAccountId, $intShippingAccountId)
			);
		}

		/**
		 * Load all ShippingAccounts
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return ShippingAccount[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			// Call ShippingAccount::QueryArray to perform the LoadAll query
			try {
				return ShippingAccount::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all ShippingAccounts
		 * @return int
		 */
		public static function CountAll() {
			// Call ShippingAccount::QueryCount to perform the CountAll query
			return ShippingAccount::QueryCount(QQ::All());
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
			$objDatabase = ShippingAccount::GetDatabase();

			// Create/Build out the QueryBuilder object with ShippingAccount-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, 'shipping_account');
			ShippingAccount::GetSelectFields($objQueryBuilder);
			$objQueryBuilder->AddFromItem('`shipping_account` AS `shipping_account`');

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
		 * Static Qcodo Query method to query for a single ShippingAccount object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return ShippingAccount the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = ShippingAccount::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query, Get the First Row, and Instantiate a new ShippingAccount object
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return ShippingAccount::InstantiateDbRow($objDbResult->GetNextRow());
		}

		/**
		 * Static Qcodo Query method to query for an array of ShippingAccount objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return ShippingAccount[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = ShippingAccount::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return ShippingAccount::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
		}

		/**
		 * Static Qcodo Query method to query for a count of ShippingAccount objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = ShippingAccount::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
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
			$objDatabase = ShippingAccount::GetDatabase();

			// Lookup the QCache for This Query Statement
			$objCache = new QCache('query', 'shipping_account_' . serialize($strConditions));
			if (!($strQuery = $objCache->GetData())) {
				// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with ShippingAccount-specific fields
				$objQueryBuilder = new QQueryBuilder($objDatabase);
				ShippingAccount::GetSelectFields($objQueryBuilder);
				ShippingAccount::GetFromFields($objQueryBuilder);

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
			return ShippingAccount::InstantiateDbResult($objDbResult);
		}*/

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this ShippingAccount
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null) {
			if ($strPrefix) {
				$strTableName = '`' . $strPrefix . '`';
				$strAliasPrefix = '`' . $strPrefix . '__';
			} else {
				$strTableName = '`shipping_account`';
				$strAliasPrefix = '`';
			}

			$objBuilder->AddSelectItem($strTableName . '.`shipping_account_id` AS ' . $strAliasPrefix . 'shipping_account_id`');
			$objBuilder->AddSelectItem($strTableName . '.`courier_id` AS ' . $strAliasPrefix . 'courier_id`');
			$objBuilder->AddSelectItem($strTableName . '.`short_description` AS ' . $strAliasPrefix . 'short_description`');
			$objBuilder->AddSelectItem($strTableName . '.`access_id` AS ' . $strAliasPrefix . 'access_id`');
			$objBuilder->AddSelectItem($strTableName . '.`access_code` AS ' . $strAliasPrefix . 'access_code`');
			$objBuilder->AddSelectItem($strTableName . '.`created_by` AS ' . $strAliasPrefix . 'created_by`');
			$objBuilder->AddSelectItem($strTableName . '.`creation_date` AS ' . $strAliasPrefix . 'creation_date`');
			$objBuilder->AddSelectItem($strTableName . '.`modified_by` AS ' . $strAliasPrefix . 'modified_by`');
			$objBuilder->AddSelectItem($strTableName . '.`modified_date` AS ' . $strAliasPrefix . 'modified_date`');
		}



		///////////////////////////////
		// INSTANTIATION-RELATED METHODS
		///////////////////////////////

		/**
		 * Instantiate a ShippingAccount from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this ShippingAccount::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param DatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @return ShippingAccount
		*/
		public static function InstantiateDbRow($objDbRow, $strAliasPrefix = null, $strExpandAsArrayNodes = null, $objPreviousItem = null) {
			// If blank row, return null
			if (!$objDbRow)
				return null;

			// See if we're doing an array expansion on the previous item
			if (($strExpandAsArrayNodes) && ($objPreviousItem) &&
				($objPreviousItem->intShippingAccountId == $objDbRow->GetColumn($strAliasPrefix . 'shipping_account_id', 'Integer'))) {

				// We are.  Now, prepare to check for ExpandAsArray clauses
				$blnExpandedViaArray = false;
				if (!$strAliasPrefix)
					$strAliasPrefix = 'shipping_account__';


				if ((array_key_exists($strAliasPrefix . 'fedexshipment__fedex_shipment_id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'fedexshipment__fedex_shipment_id')))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objFedexShipmentArray)) {
						$objPreviousChildItem = $objPreviousItem->_objFedexShipmentArray[$intPreviousChildItemCount - 1];
						$objChildItem = FedexShipment::InstantiateDbRow($objDbRow, $strAliasPrefix . 'fedexshipment__', $strExpandAsArrayNodes, $objPreviousChildItem);
						if ($objChildItem)
							array_push($objPreviousItem->_objFedexShipmentArray, $objChildItem);
					} else
						array_push($objPreviousItem->_objFedexShipmentArray, FedexShipment::InstantiateDbRow($objDbRow, $strAliasPrefix . 'fedexshipment__', $strExpandAsArrayNodes));
					$blnExpandedViaArray = true;
				}

				// Either return false to signal array expansion, or check-to-reset the Alias prefix and move on
				if ($blnExpandedViaArray)
					return false;
				else if ($strAliasPrefix == 'shipping_account__')
					$strAliasPrefix = null;
			}

			// Create a new instance of the ShippingAccount object
			$objToReturn = new ShippingAccount();
			$objToReturn->__blnRestored = true;

			$objToReturn->intShippingAccountId = $objDbRow->GetColumn($strAliasPrefix . 'shipping_account_id', 'Integer');
			$objToReturn->intCourierId = $objDbRow->GetColumn($strAliasPrefix . 'courier_id', 'Integer');
			$objToReturn->strShortDescription = $objDbRow->GetColumn($strAliasPrefix . 'short_description', 'VarChar');
			$objToReturn->strAccessId = $objDbRow->GetColumn($strAliasPrefix . 'access_id', 'VarChar');
			$objToReturn->strAccessCode = $objDbRow->GetColumn($strAliasPrefix . 'access_code', 'VarChar');
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
				$strAliasPrefix = 'shipping_account__';

			// Check for Courier Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'courier_id__courier_id')))
				$objToReturn->objCourier = Courier::InstantiateDbRow($objDbRow, $strAliasPrefix . 'courier_id__', $strExpandAsArrayNodes);

			// Check for CreatedByObject Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'created_by__user_account_id')))
				$objToReturn->objCreatedByObject = UserAccount::InstantiateDbRow($objDbRow, $strAliasPrefix . 'created_by__', $strExpandAsArrayNodes);

			// Check for ModifiedByObject Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'modified_by__user_account_id')))
				$objToReturn->objModifiedByObject = UserAccount::InstantiateDbRow($objDbRow, $strAliasPrefix . 'modified_by__', $strExpandAsArrayNodes);




			// Check for FedexShipment Virtual Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'fedexshipment__fedex_shipment_id'))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'fedexshipment__fedex_shipment_id', $strExpandAsArrayNodes)))
					array_push($objToReturn->_objFedexShipmentArray, FedexShipment::InstantiateDbRow($objDbRow, $strAliasPrefix . 'fedexshipment__', $strExpandAsArrayNodes));
				else
					$objToReturn->_objFedexShipment = FedexShipment::InstantiateDbRow($objDbRow, $strAliasPrefix . 'fedexshipment__', $strExpandAsArrayNodes);
			}

			return $objToReturn;
		}

		/**
		 * Instantiate an array of ShippingAccounts from a Database Result
		 * @param DatabaseResultBase $objDbResult
		 * @return ShippingAccount[]
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
					$objItem = ShippingAccount::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
					if ($objItem) {
						array_push($objToReturn, $objItem);
						$objLastRowItem = $objItem;
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					array_push($objToReturn, ShippingAccount::InstantiateDbRow($objDbRow));
			}

			return $objToReturn;
		}



		///////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Single Load and Array)
		///////////////////////////////////////////////////
			
		/**
		 * Load a single ShippingAccount object,
		 * by ShippingAccountId Index(es)
		 * @param integer $intShippingAccountId
		 * @return ShippingAccount
		*/
		public static function LoadByShippingAccountId($intShippingAccountId) {
			return ShippingAccount::QuerySingle(
				QQ::Equal(QQN::ShippingAccount()->ShippingAccountId, $intShippingAccountId)
			);
		}
			
		/**
		 * Load an array of ShippingAccount objects,
		 * by CourierId Index(es)
		 * @param integer $intCourierId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return ShippingAccount[]
		*/
		public static function LoadArrayByCourierId($intCourierId, $objOptionalClauses = null) {
			// Call ShippingAccount::QueryArray to perform the LoadArrayByCourierId query
			try {
				return ShippingAccount::QueryArray(
					QQ::Equal(QQN::ShippingAccount()->CourierId, $intCourierId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count ShippingAccounts
		 * by CourierId Index(es)
		 * @param integer $intCourierId
		 * @return int
		*/
		public static function CountByCourierId($intCourierId) {
			// Call ShippingAccount::QueryCount to perform the CountByCourierId query
			return ShippingAccount::QueryCount(
				QQ::Equal(QQN::ShippingAccount()->CourierId, $intCourierId)
			);
		}
			
		/**
		 * Load an array of ShippingAccount objects,
		 * by ModifiedBy Index(es)
		 * @param integer $intModifiedBy
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return ShippingAccount[]
		*/
		public static function LoadArrayByModifiedBy($intModifiedBy, $objOptionalClauses = null) {
			// Call ShippingAccount::QueryArray to perform the LoadArrayByModifiedBy query
			try {
				return ShippingAccount::QueryArray(
					QQ::Equal(QQN::ShippingAccount()->ModifiedBy, $intModifiedBy),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count ShippingAccounts
		 * by ModifiedBy Index(es)
		 * @param integer $intModifiedBy
		 * @return int
		*/
		public static function CountByModifiedBy($intModifiedBy) {
			// Call ShippingAccount::QueryCount to perform the CountByModifiedBy query
			return ShippingAccount::QueryCount(
				QQ::Equal(QQN::ShippingAccount()->ModifiedBy, $intModifiedBy)
			);
		}
			
		/**
		 * Load an array of ShippingAccount objects,
		 * by CreatedBy Index(es)
		 * @param integer $intCreatedBy
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return ShippingAccount[]
		*/
		public static function LoadArrayByCreatedBy($intCreatedBy, $objOptionalClauses = null) {
			// Call ShippingAccount::QueryArray to perform the LoadArrayByCreatedBy query
			try {
				return ShippingAccount::QueryArray(
					QQ::Equal(QQN::ShippingAccount()->CreatedBy, $intCreatedBy),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count ShippingAccounts
		 * by CreatedBy Index(es)
		 * @param integer $intCreatedBy
		 * @return int
		*/
		public static function CountByCreatedBy($intCreatedBy) {
			// Call ShippingAccount::QueryCount to perform the CountByCreatedBy query
			return ShippingAccount::QueryCount(
				QQ::Equal(QQN::ShippingAccount()->CreatedBy, $intCreatedBy)
			);
		}



		////////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Array via Many to Many)
		////////////////////////////////////////////////////



		//////////////////
		// SAVE AND DELETE
		//////////////////

		/**
		 * Save this ShippingAccount
		 * @param bool $blnForceInsert
		 * @param bool $blnForceUpdate
		 * @return int
		*/
		public function Save($blnForceInsert = false, $blnForceUpdate = false) {
			// Get the Database Object for this Class
			$objDatabase = ShippingAccount::GetDatabase();

			$mixToReturn = null;

			try {
				if ((!$this->__blnRestored) || ($blnForceInsert)) {
					// Perform an INSERT query
					$objDatabase->NonQuery('
						INSERT INTO `shipping_account` (
							`courier_id`,
							`short_description`,
							`access_id`,
							`access_code`,
							`created_by`,
							`creation_date`,
							`modified_by`
						) VALUES (
							' . $objDatabase->SqlVariable($this->intCourierId) . ',
							' . $objDatabase->SqlVariable($this->strShortDescription) . ',
							' . $objDatabase->SqlVariable($this->strAccessId) . ',
							' . $objDatabase->SqlVariable($this->strAccessCode) . ',
							' . $objDatabase->SqlVariable($this->intCreatedBy) . ',
							' . $objDatabase->SqlVariable($this->dttCreationDate) . ',
							' . $objDatabase->SqlVariable($this->intModifiedBy) . '
						)
					');

					// Update Identity column and return its value
					$mixToReturn = $this->intShippingAccountId = $objDatabase->InsertId('shipping_account', 'shipping_account_id');
				} else {
					// Perform an UPDATE query

					// First checking for Optimistic Locking constraints (if applicable)
					if (!$blnForceUpdate) {
						// Perform the Optimistic Locking check
						$objResult = $objDatabase->Query('
							SELECT
								`modified_date`
							FROM
								`shipping_account`
							WHERE
								`shipping_account_id` = ' . $objDatabase->SqlVariable($this->intShippingAccountId) . '
						');
						
						$objRow = $objResult->FetchArray();
						if ($objRow[0] != $this->strModifiedDate)
							throw new QExtendedOptimisticLockingException('ShippingAccount', $this->intShippingAccountId);
					}

					// Perform the UPDATE query
					$objDatabase->NonQuery('
						UPDATE
							`shipping_account`
						SET
							`courier_id` = ' . $objDatabase->SqlVariable($this->intCourierId) . ',
							`short_description` = ' . $objDatabase->SqlVariable($this->strShortDescription) . ',
							`access_id` = ' . $objDatabase->SqlVariable($this->strAccessId) . ',
							`access_code` = ' . $objDatabase->SqlVariable($this->strAccessCode) . ',
							`created_by` = ' . $objDatabase->SqlVariable($this->intCreatedBy) . ',
							`creation_date` = ' . $objDatabase->SqlVariable($this->dttCreationDate) . ',
							`modified_by` = ' . $objDatabase->SqlVariable($this->intModifiedBy) . '
						WHERE
							`shipping_account_id` = ' . $objDatabase->SqlVariable($this->intShippingAccountId) . '
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
					`shipping_account`
				WHERE
					`shipping_account_id` = ' . $objDatabase->SqlVariable($this->intShippingAccountId) . '
			');
						
			$objRow = $objResult->FetchArray();
			$this->strModifiedDate = $objRow[0];

			// Return 
			return $mixToReturn;
		}

				/**
		 * Delete this ShippingAccount
		 * @return void
		*/
		public function Delete() {
			if ((is_null($this->intShippingAccountId)))
				throw new QUndefinedPrimaryKeyException('Cannot delete this ShippingAccount with an unset primary key.');

			// Get the Database Object for this Class
			$objDatabase = ShippingAccount::GetDatabase();


			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`shipping_account`
				WHERE
					`shipping_account_id` = ' . $objDatabase->SqlVariable($this->intShippingAccountId) . '');
		}

		/**
		 * Delete all ShippingAccounts
		 * @return void
		*/
		public static function DeleteAll() {
			// Get the Database Object for this Class
			$objDatabase = ShippingAccount::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				DELETE FROM
					`shipping_account`');
		}

		/**
		 * Truncate shipping_account table
		 * @return void
		*/
		public static function Truncate() {
			// Get the Database Object for this Class
			$objDatabase = ShippingAccount::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				TRUNCATE `shipping_account`');
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
				case 'ShippingAccountId':
					/**
					 * Gets the value for intShippingAccountId (Read-Only PK)
					 * @return integer
					 */
					return $this->intShippingAccountId;

				case 'CourierId':
					/**
					 * Gets the value for intCourierId (Not Null)
					 * @return integer
					 */
					return $this->intCourierId;

				case 'ShortDescription':
					/**
					 * Gets the value for strShortDescription (Not Null)
					 * @return string
					 */
					return $this->strShortDescription;

				case 'AccessId':
					/**
					 * Gets the value for strAccessId (Not Null)
					 * @return string
					 */
					return $this->strAccessId;

				case 'AccessCode':
					/**
					 * Gets the value for strAccessCode (Not Null)
					 * @return string
					 */
					return $this->strAccessCode;

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
				case 'Courier':
					/**
					 * Gets the value for the Courier object referenced by intCourierId (Not Null)
					 * @return Courier
					 */
					try {
						if ((!$this->objCourier) && (!is_null($this->intCourierId)))
							$this->objCourier = Courier::Load($this->intCourierId);
						return $this->objCourier;
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

				case '_FedexShipment':
					/**
					 * Gets the value for the private _objFedexShipment (Read-Only)
					 * if set due to an expansion on the fedex_shipment.shipping_account_id reverse relationship
					 * @return FedexShipment
					 */
					return $this->_objFedexShipment;

				case '_FedexShipmentArray':
					/**
					 * Gets the value for the private _objFedexShipmentArray (Read-Only)
					 * if set due to an ExpandAsArray on the fedex_shipment.shipping_account_id reverse relationship
					 * @return FedexShipment[]
					 */
					return (array) $this->_objFedexShipmentArray;

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
				case 'CourierId':
					/**
					 * Sets the value for intCourierId (Not Null)
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						$this->objCourier = null;
						return ($this->intCourierId = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'ShortDescription':
					/**
					 * Sets the value for strShortDescription (Not Null)
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strShortDescription = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'AccessId':
					/**
					 * Sets the value for strAccessId (Not Null)
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strAccessId = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'AccessCode':
					/**
					 * Sets the value for strAccessCode (Not Null)
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strAccessCode = QType::Cast($mixValue, QType::String));
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
				case 'Courier':
					/**
					 * Sets the value for the Courier object referenced by intCourierId (Not Null)
					 * @param Courier $mixValue
					 * @return Courier
					 */
					if (is_null($mixValue)) {
						$this->intCourierId = null;
						$this->objCourier = null;
						return null;
					} else {
						// Make sure $mixValue actually is a Courier object
						try {
							$mixValue = QType::Cast($mixValue, 'Courier');
						} catch (QInvalidCastException $objExc) {
							$objExc->IncrementOffset();
							throw $objExc;
						} 

						// Make sure $mixValue is a SAVED Courier object
						if (is_null($mixValue->CourierId))
							throw new QCallerException('Unable to set an unsaved Courier for this ShippingAccount');

						// Update Local Member Variables
						$this->objCourier = $mixValue;
						$this->intCourierId = $mixValue->CourierId;

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
							throw new QCallerException('Unable to set an unsaved CreatedByObject for this ShippingAccount');

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
							throw new QCallerException('Unable to set an unsaved ModifiedByObject for this ShippingAccount');

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

			
		
		// Related Objects' Methods for FedexShipment
		//-------------------------------------------------------------------

		/**
		 * Gets all associated FedexShipments as an array of FedexShipment objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return FedexShipment[]
		*/ 
		public function GetFedexShipmentArray($objOptionalClauses = null) {
			if ((is_null($this->intShippingAccountId)))
				return array();

			try {
				return FedexShipment::LoadArrayByShippingAccountId($this->intShippingAccountId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated FedexShipments
		 * @return int
		*/ 
		public function CountFedexShipments() {
			if ((is_null($this->intShippingAccountId)))
				return 0;

			return FedexShipment::CountByShippingAccountId($this->intShippingAccountId);
		}

		/**
		 * Associates a FedexShipment
		 * @param FedexShipment $objFedexShipment
		 * @return void
		*/ 
		public function AssociateFedexShipment(FedexShipment $objFedexShipment) {
			if ((is_null($this->intShippingAccountId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateFedexShipment on this unsaved ShippingAccount.');
			if ((is_null($objFedexShipment->FedexShipmentId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateFedexShipment on this ShippingAccount with an unsaved FedexShipment.');

			// Get the Database Object for this Class
			$objDatabase = ShippingAccount::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`fedex_shipment`
				SET
					`shipping_account_id` = ' . $objDatabase->SqlVariable($this->intShippingAccountId) . '
				WHERE
					`fedex_shipment_id` = ' . $objDatabase->SqlVariable($objFedexShipment->FedexShipmentId) . '
			');
		}

		/**
		 * Unassociates a FedexShipment
		 * @param FedexShipment $objFedexShipment
		 * @return void
		*/ 
		public function UnassociateFedexShipment(FedexShipment $objFedexShipment) {
			if ((is_null($this->intShippingAccountId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateFedexShipment on this unsaved ShippingAccount.');
			if ((is_null($objFedexShipment->FedexShipmentId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateFedexShipment on this ShippingAccount with an unsaved FedexShipment.');

			// Get the Database Object for this Class
			$objDatabase = ShippingAccount::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`fedex_shipment`
				SET
					`shipping_account_id` = null
				WHERE
					`fedex_shipment_id` = ' . $objDatabase->SqlVariable($objFedexShipment->FedexShipmentId) . ' AND
					`shipping_account_id` = ' . $objDatabase->SqlVariable($this->intShippingAccountId) . '
			');
		}

		/**
		 * Unassociates all FedexShipments
		 * @return void
		*/ 
		public function UnassociateAllFedexShipments() {
			if ((is_null($this->intShippingAccountId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateFedexShipment on this unsaved ShippingAccount.');

			// Get the Database Object for this Class
			$objDatabase = ShippingAccount::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`fedex_shipment`
				SET
					`shipping_account_id` = null
				WHERE
					`shipping_account_id` = ' . $objDatabase->SqlVariable($this->intShippingAccountId) . '
			');
		}

		/**
		 * Deletes an associated FedexShipment
		 * @param FedexShipment $objFedexShipment
		 * @return void
		*/ 
		public function DeleteAssociatedFedexShipment(FedexShipment $objFedexShipment) {
			if ((is_null($this->intShippingAccountId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateFedexShipment on this unsaved ShippingAccount.');
			if ((is_null($objFedexShipment->FedexShipmentId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateFedexShipment on this ShippingAccount with an unsaved FedexShipment.');

			// Get the Database Object for this Class
			$objDatabase = ShippingAccount::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`fedex_shipment`
				WHERE
					`fedex_shipment_id` = ' . $objDatabase->SqlVariable($objFedexShipment->FedexShipmentId) . ' AND
					`shipping_account_id` = ' . $objDatabase->SqlVariable($this->intShippingAccountId) . '
			');
		}

		/**
		 * Deletes all associated FedexShipments
		 * @return void
		*/ 
		public function DeleteAllFedexShipments() {
			if ((is_null($this->intShippingAccountId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateFedexShipment on this unsaved ShippingAccount.');

			// Get the Database Object for this Class
			$objDatabase = ShippingAccount::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`fedex_shipment`
				WHERE
					`shipping_account_id` = ' . $objDatabase->SqlVariable($this->intShippingAccountId) . '
			');
		}




		///////////////////////////////////////////////////////////////////////
		// PROTECTED MEMBER VARIABLES and TEXT FIELD MAXLENGTHS (if applicable)
		///////////////////////////////////////////////////////////////////////
		
		/**
		 * Protected member variable that maps to the database PK Identity column shipping_account.shipping_account_id
		 * @var integer intShippingAccountId
		 */
		protected $intShippingAccountId;
		const ShippingAccountIdDefault = null;


		/**
		 * Protected member variable that maps to the database column shipping_account.courier_id
		 * @var integer intCourierId
		 */
		protected $intCourierId;
		const CourierIdDefault = null;


		/**
		 * Protected member variable that maps to the database column shipping_account.short_description
		 * @var string strShortDescription
		 */
		protected $strShortDescription;
		const ShortDescriptionMaxLength = 255;
		const ShortDescriptionDefault = null;


		/**
		 * Protected member variable that maps to the database column shipping_account.access_id
		 * @var string strAccessId
		 */
		protected $strAccessId;
		const AccessIdMaxLength = 255;
		const AccessIdDefault = null;


		/**
		 * Protected member variable that maps to the database column shipping_account.access_code
		 * @var string strAccessCode
		 */
		protected $strAccessCode;
		const AccessCodeMaxLength = 255;
		const AccessCodeDefault = null;


		/**
		 * Protected member variable that maps to the database column shipping_account.created_by
		 * @var integer intCreatedBy
		 */
		protected $intCreatedBy;
		const CreatedByDefault = null;


		/**
		 * Protected member variable that maps to the database column shipping_account.creation_date
		 * @var QDateTime dttCreationDate
		 */
		protected $dttCreationDate;
		const CreationDateDefault = null;


		/**
		 * Protected member variable that maps to the database column shipping_account.modified_by
		 * @var integer intModifiedBy
		 */
		protected $intModifiedBy;
		const ModifiedByDefault = null;


		/**
		 * Protected member variable that maps to the database column shipping_account.modified_date
		 * @var string strModifiedDate
		 */
		protected $strModifiedDate;
		const ModifiedDateDefault = null;


		/**
		 * Private member variable that stores a reference to a single FedexShipment object
		 * (of type FedexShipment), if this ShippingAccount object was restored with
		 * an expansion on the fedex_shipment association table.
		 * @var FedexShipment _objFedexShipment;
		 */
		private $_objFedexShipment;

		/**
		 * Private member variable that stores a reference to an array of FedexShipment objects
		 * (of type FedexShipment[]), if this ShippingAccount object was restored with
		 * an ExpandAsArray on the fedex_shipment association table.
		 * @var FedexShipment[] _objFedexShipmentArray;
		 */
		private $_objFedexShipmentArray = array();

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
		 * in the database column shipping_account.courier_id.
		 *
		 * NOTE: Always use the Courier property getter to correctly retrieve this Courier object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var Courier objCourier
		 */
		protected $objCourier;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column shipping_account.created_by.
		 *
		 * NOTE: Always use the CreatedByObject property getter to correctly retrieve this UserAccount object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var UserAccount objCreatedByObject
		 */
		protected $objCreatedByObject;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column shipping_account.modified_by.
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
				$objQueryExpansion = new QQueryExpansion('ShippingAccount', 'shipping_account', $objExpansionMap);
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
				$objQueryExpansion->AddFromItem(sprintf('LEFT JOIN `shipping_account` AS `%s__%s` ON `%s`.`%s` = `%s__%s`.`shipping_account_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias, $strParentAlias, $strAlias));

				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`shipping_account_id` AS `%s__%s__shipping_account_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`courier_id` AS `%s__%s__courier_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`short_description` AS `%s__%s__short_description`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`access_id` AS `%s__%s__access_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`access_code` AS `%s__%s__access_code`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`created_by` AS `%s__%s__created_by`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`creation_date` AS `%s__%s__creation_date`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`modified_by` AS `%s__%s__modified_by`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`modified_date` AS `%s__%s__modified_date`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));

				$strParentAlias = $strParentAlias . '__' . $strAlias;
			}

			if (is_array($objExpansionMap))
				foreach ($objExpansionMap as $strKey=>$objValue) {
					switch ($strKey) {
						case 'courier_id':
							try {
								Courier::ExpandQuery($strParentAlias, $strKey, $objValue, $objQueryExpansion);
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
		const ExpandCourier = 'courier_id';
		const ExpandCreatedByObject = 'created_by';
		const ExpandModifiedByObject = 'modified_by';




		////////////////////////////////////////
		// METHODS for WEB SERVICES
		////////////////////////////////////////

		public static function GetSoapComplexTypeXml() {
			$strToReturn = '<complexType name="ShippingAccount"><sequence>';
			$strToReturn .= '<element name="ShippingAccountId" type="xsd:int"/>';
			$strToReturn .= '<element name="Courier" type="xsd1:Courier"/>';
			$strToReturn .= '<element name="ShortDescription" type="xsd:string"/>';
			$strToReturn .= '<element name="AccessId" type="xsd:string"/>';
			$strToReturn .= '<element name="AccessCode" type="xsd:string"/>';
			$strToReturn .= '<element name="CreatedByObject" type="xsd1:UserAccount"/>';
			$strToReturn .= '<element name="CreationDate" type="xsd:dateTime"/>';
			$strToReturn .= '<element name="ModifiedByObject" type="xsd1:UserAccount"/>';
			$strToReturn .= '<element name="ModifiedDate" type="xsd:string"/>';
			$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
			$strToReturn .= '</sequence></complexType>';
			return $strToReturn;
		}

		public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
			if (!array_key_exists('ShippingAccount', $strComplexTypeArray)) {
				$strComplexTypeArray['ShippingAccount'] = ShippingAccount::GetSoapComplexTypeXml();
				Courier::AlterSoapComplexTypeArray($strComplexTypeArray);
				UserAccount::AlterSoapComplexTypeArray($strComplexTypeArray);
				UserAccount::AlterSoapComplexTypeArray($strComplexTypeArray);
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, ShippingAccount::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new ShippingAccount();
			if (property_exists($objSoapObject, 'ShippingAccountId'))
				$objToReturn->intShippingAccountId = $objSoapObject->ShippingAccountId;
			if ((property_exists($objSoapObject, 'Courier')) &&
				($objSoapObject->Courier))
				$objToReturn->Courier = Courier::GetObjectFromSoapObject($objSoapObject->Courier);
			if (property_exists($objSoapObject, 'ShortDescription'))
				$objToReturn->strShortDescription = $objSoapObject->ShortDescription;
			if (property_exists($objSoapObject, 'AccessId'))
				$objToReturn->strAccessId = $objSoapObject->AccessId;
			if (property_exists($objSoapObject, 'AccessCode'))
				$objToReturn->strAccessCode = $objSoapObject->AccessCode;
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
				array_push($objArrayToReturn, ShippingAccount::GetSoapObjectFromObject($objObject, true));

			return unserialize(serialize($objArrayToReturn));
		}

		public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
			if ($objObject->objCourier)
				$objObject->objCourier = Courier::GetSoapObjectFromObject($objObject->objCourier, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intCourierId = null;
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

	class QQNodeShippingAccount extends QQNode {
		protected $strTableName = 'shipping_account';
		protected $strPrimaryKey = 'shipping_account_id';
		protected $strClassName = 'ShippingAccount';
		public function __get($strName) {
			switch ($strName) {
				case 'ShippingAccountId':
					return new QQNode('shipping_account_id', 'integer', $this);
				case 'CourierId':
					return new QQNode('courier_id', 'integer', $this);
				case 'Courier':
					return new QQNodeCourier('courier_id', 'integer', $this);
				case 'ShortDescription':
					return new QQNode('short_description', 'string', $this);
				case 'AccessId':
					return new QQNode('access_id', 'string', $this);
				case 'AccessCode':
					return new QQNode('access_code', 'string', $this);
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
				case 'FedexShipment':
					return new QQReverseReferenceNodeFedexShipment($this, 'fedexshipment', 'reverse_reference', 'shipping_account_id');

				case '_PrimaryKeyNode':
					return new QQNode('shipping_account_id', 'integer', $this);
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

	class QQReverseReferenceNodeShippingAccount extends QQReverseReferenceNode {
		protected $strTableName = 'shipping_account';
		protected $strPrimaryKey = 'shipping_account_id';
		protected $strClassName = 'ShippingAccount';
		public function __get($strName) {
			switch ($strName) {
				case 'ShippingAccountId':
					return new QQNode('shipping_account_id', 'integer', $this);
				case 'CourierId':
					return new QQNode('courier_id', 'integer', $this);
				case 'Courier':
					return new QQNodeCourier('courier_id', 'integer', $this);
				case 'ShortDescription':
					return new QQNode('short_description', 'string', $this);
				case 'AccessId':
					return new QQNode('access_id', 'string', $this);
				case 'AccessCode':
					return new QQNode('access_code', 'string', $this);
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
				case 'FedexShipment':
					return new QQReverseReferenceNodeFedexShipment($this, 'fedexshipment', 'reverse_reference', 'shipping_account_id');

				case '_PrimaryKeyNode':
					return new QQNode('shipping_account_id', 'integer', $this);
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