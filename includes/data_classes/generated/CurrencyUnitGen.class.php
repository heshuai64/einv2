<?php
	/**
	 * The abstract CurrencyUnitGen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the CurrencyUnit subclass which
	 * extends this CurrencyUnitGen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the CurrencyUnit class.
	 * 
	 * @package My Application
	 * @subpackage GeneratedDataObjects
	 * 
	 */
	class CurrencyUnitGen extends QBaseClass {
		///////////////////////////////
		// COMMON LOAD METHODS
		///////////////////////////////

		/**
		 * Load a CurrencyUnit from PK Info
		 * @param integer $intCurrencyUnitId
		 * @return CurrencyUnit
		 */
		public static function Load($intCurrencyUnitId) {
			// Use QuerySingle to Perform the Query
			return CurrencyUnit::QuerySingle(
				QQ::Equal(QQN::CurrencyUnit()->CurrencyUnitId, $intCurrencyUnitId)
			);
		}

		/**
		 * Load all CurrencyUnits
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return CurrencyUnit[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			// Call CurrencyUnit::QueryArray to perform the LoadAll query
			try {
				return CurrencyUnit::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all CurrencyUnits
		 * @return int
		 */
		public static function CountAll() {
			// Call CurrencyUnit::QueryCount to perform the CountAll query
			return CurrencyUnit::QueryCount(QQ::All());
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
			$objDatabase = CurrencyUnit::GetDatabase();

			// Create/Build out the QueryBuilder object with CurrencyUnit-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, 'currency_unit');
			CurrencyUnit::GetSelectFields($objQueryBuilder);
			$objQueryBuilder->AddFromItem('`currency_unit` AS `currency_unit`');

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
		 * Static Qcodo Query method to query for a single CurrencyUnit object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return CurrencyUnit the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = CurrencyUnit::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query, Get the First Row, and Instantiate a new CurrencyUnit object
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return CurrencyUnit::InstantiateDbRow($objDbResult->GetNextRow());
		}

		/**
		 * Static Qcodo Query method to query for an array of CurrencyUnit objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return CurrencyUnit[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = CurrencyUnit::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return CurrencyUnit::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
		}

		/**
		 * Static Qcodo Query method to query for a count of CurrencyUnit objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = CurrencyUnit::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
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
			$objDatabase = CurrencyUnit::GetDatabase();

			// Lookup the QCache for This Query Statement
			$objCache = new QCache('query', 'currency_unit_' . serialize($strConditions));
			if (!($strQuery = $objCache->GetData())) {
				// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with CurrencyUnit-specific fields
				$objQueryBuilder = new QQueryBuilder($objDatabase);
				CurrencyUnit::GetSelectFields($objQueryBuilder);
				CurrencyUnit::GetFromFields($objQueryBuilder);

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
			return CurrencyUnit::InstantiateDbResult($objDbResult);
		}*/

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this CurrencyUnit
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null) {
			if ($strPrefix) {
				$strTableName = '`' . $strPrefix . '`';
				$strAliasPrefix = '`' . $strPrefix . '__';
			} else {
				$strTableName = '`currency_unit`';
				$strAliasPrefix = '`';
			}

			$objBuilder->AddSelectItem($strTableName . '.`currency_unit_id` AS ' . $strAliasPrefix . 'currency_unit_id`');
			$objBuilder->AddSelectItem($strTableName . '.`short_description` AS ' . $strAliasPrefix . 'short_description`');
			$objBuilder->AddSelectItem($strTableName . '.`symbol` AS ' . $strAliasPrefix . 'symbol`');
		}



		///////////////////////////////
		// INSTANTIATION-RELATED METHODS
		///////////////////////////////

		/**
		 * Instantiate a CurrencyUnit from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this CurrencyUnit::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param DatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @return CurrencyUnit
		*/
		public static function InstantiateDbRow($objDbRow, $strAliasPrefix = null, $strExpandAsArrayNodes = null, $objPreviousItem = null) {
			// If blank row, return null
			if (!$objDbRow)
				return null;

			// See if we're doing an array expansion on the previous item
			if (($strExpandAsArrayNodes) && ($objPreviousItem) &&
				($objPreviousItem->intCurrencyUnitId == $objDbRow->GetColumn($strAliasPrefix . 'currency_unit_id', 'Integer'))) {

				// We are.  Now, prepare to check for ExpandAsArray clauses
				$blnExpandedViaArray = false;
				if (!$strAliasPrefix)
					$strAliasPrefix = 'currency_unit__';


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
				else if ($strAliasPrefix == 'currency_unit__')
					$strAliasPrefix = null;
			}

			// Create a new instance of the CurrencyUnit object
			$objToReturn = new CurrencyUnit();
			$objToReturn->__blnRestored = true;

			$objToReturn->intCurrencyUnitId = $objDbRow->GetColumn($strAliasPrefix . 'currency_unit_id', 'Integer');
			$objToReturn->strShortDescription = $objDbRow->GetColumn($strAliasPrefix . 'short_description', 'VarChar');
			$objToReturn->strSymbol = $objDbRow->GetColumn($strAliasPrefix . 'symbol', 'VarChar');

			// Instantiate Virtual Attributes
			foreach ($objDbRow->GetColumnNameArray() as $strColumnName => $mixValue) {
				$strVirtualPrefix = $strAliasPrefix . '__';
				$strVirtualPrefixLength = strlen($strVirtualPrefix);
				if (substr($strColumnName, 0, $strVirtualPrefixLength) == $strVirtualPrefix)
					$objToReturn->__strVirtualAttributeArray[substr($strColumnName, $strVirtualPrefixLength)] = $mixValue;
			}

			// Prepare to Check for Early/Virtual Binding
			if (!$strAliasPrefix)
				$strAliasPrefix = 'currency_unit__';




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
		 * Instantiate an array of CurrencyUnits from a Database Result
		 * @param DatabaseResultBase $objDbResult
		 * @return CurrencyUnit[]
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
					$objItem = CurrencyUnit::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
					if ($objItem) {
						array_push($objToReturn, $objItem);
						$objLastRowItem = $objItem;
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					array_push($objToReturn, CurrencyUnit::InstantiateDbRow($objDbRow));
			}

			return $objToReturn;
		}



		///////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Single Load and Array)
		///////////////////////////////////////////////////
			
		/**
		 * Load a single CurrencyUnit object,
		 * by CurrencyUnitId Index(es)
		 * @param integer $intCurrencyUnitId
		 * @return CurrencyUnit
		*/
		public static function LoadByCurrencyUnitId($intCurrencyUnitId) {
			return CurrencyUnit::QuerySingle(
				QQ::Equal(QQN::CurrencyUnit()->CurrencyUnitId, $intCurrencyUnitId)
			);
		}



		////////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Array via Many to Many)
		////////////////////////////////////////////////////



		//////////////////
		// SAVE AND DELETE
		//////////////////

		/**
		 * Save this CurrencyUnit
		 * @param bool $blnForceInsert
		 * @param bool $blnForceUpdate
		 * @return int
		*/
		public function Save($blnForceInsert = false, $blnForceUpdate = false) {
			// Get the Database Object for this Class
			$objDatabase = CurrencyUnit::GetDatabase();

			$mixToReturn = null;

			try {
				if ((!$this->__blnRestored) || ($blnForceInsert)) {
					// Perform an INSERT query
					$objDatabase->NonQuery('
						INSERT INTO `currency_unit` (
							`short_description`,
							`symbol`
						) VALUES (
							' . $objDatabase->SqlVariable($this->strShortDescription) . ',
							' . $objDatabase->SqlVariable($this->strSymbol) . '
						)
					');

					// Update Identity column and return its value
					$mixToReturn = $this->intCurrencyUnitId = $objDatabase->InsertId('currency_unit', 'currency_unit_id');
				} else {
					// Perform an UPDATE query

					// First checking for Optimistic Locking constraints (if applicable)

					// Perform the UPDATE query
					$objDatabase->NonQuery('
						UPDATE
							`currency_unit`
						SET
							`short_description` = ' . $objDatabase->SqlVariable($this->strShortDescription) . ',
							`symbol` = ' . $objDatabase->SqlVariable($this->strSymbol) . '
						WHERE
							`currency_unit_id` = ' . $objDatabase->SqlVariable($this->intCurrencyUnitId) . '
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
		 * Delete this CurrencyUnit
		 * @return void
		*/
		public function Delete() {
			if ((is_null($this->intCurrencyUnitId)))
				throw new QUndefinedPrimaryKeyException('Cannot delete this CurrencyUnit with an unset primary key.');

			// Get the Database Object for this Class
			$objDatabase = CurrencyUnit::GetDatabase();


			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`currency_unit`
				WHERE
					`currency_unit_id` = ' . $objDatabase->SqlVariable($this->intCurrencyUnitId) . '');
		}

		/**
		 * Delete all CurrencyUnits
		 * @return void
		*/
		public static function DeleteAll() {
			// Get the Database Object for this Class
			$objDatabase = CurrencyUnit::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				DELETE FROM
					`currency_unit`');
		}

		/**
		 * Truncate currency_unit table
		 * @return void
		*/
		public static function Truncate() {
			// Get the Database Object for this Class
			$objDatabase = CurrencyUnit::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				TRUNCATE `currency_unit`');
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
				case 'CurrencyUnitId':
					/**
					 * Gets the value for intCurrencyUnitId (Read-Only PK)
					 * @return integer
					 */
					return $this->intCurrencyUnitId;

				case 'ShortDescription':
					/**
					 * Gets the value for strShortDescription 
					 * @return string
					 */
					return $this->strShortDescription;

				case 'Symbol':
					/**
					 * Gets the value for strSymbol 
					 * @return string
					 */
					return $this->strSymbol;


				///////////////////
				// Member Objects
				///////////////////

				////////////////////////////
				// Virtual Object References (Many to Many and Reverse References)
				// (If restored via a "Many-to" expansion)
				////////////////////////////

				case '_FedexShipment':
					/**
					 * Gets the value for the private _objFedexShipment (Read-Only)
					 * if set due to an expansion on the fedex_shipment.currency_unit_id reverse relationship
					 * @return FedexShipment
					 */
					return $this->_objFedexShipment;

				case '_FedexShipmentArray':
					/**
					 * Gets the value for the private _objFedexShipmentArray (Read-Only)
					 * if set due to an ExpandAsArray on the fedex_shipment.currency_unit_id reverse relationship
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
				case 'ShortDescription':
					/**
					 * Sets the value for strShortDescription 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strShortDescription = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Symbol':
					/**
					 * Sets the value for strSymbol 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strSymbol = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}


				///////////////////
				// Member Objects
				///////////////////
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
			if ((is_null($this->intCurrencyUnitId)))
				return array();

			try {
				return FedexShipment::LoadArrayByCurrencyUnitId($this->intCurrencyUnitId, $objOptionalClauses);
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
			if ((is_null($this->intCurrencyUnitId)))
				return 0;

			return FedexShipment::CountByCurrencyUnitId($this->intCurrencyUnitId);
		}

		/**
		 * Associates a FedexShipment
		 * @param FedexShipment $objFedexShipment
		 * @return void
		*/ 
		public function AssociateFedexShipment(FedexShipment $objFedexShipment) {
			if ((is_null($this->intCurrencyUnitId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateFedexShipment on this unsaved CurrencyUnit.');
			if ((is_null($objFedexShipment->FedexShipmentId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateFedexShipment on this CurrencyUnit with an unsaved FedexShipment.');

			// Get the Database Object for this Class
			$objDatabase = CurrencyUnit::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`fedex_shipment`
				SET
					`currency_unit_id` = ' . $objDatabase->SqlVariable($this->intCurrencyUnitId) . '
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
			if ((is_null($this->intCurrencyUnitId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateFedexShipment on this unsaved CurrencyUnit.');
			if ((is_null($objFedexShipment->FedexShipmentId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateFedexShipment on this CurrencyUnit with an unsaved FedexShipment.');

			// Get the Database Object for this Class
			$objDatabase = CurrencyUnit::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`fedex_shipment`
				SET
					`currency_unit_id` = null
				WHERE
					`fedex_shipment_id` = ' . $objDatabase->SqlVariable($objFedexShipment->FedexShipmentId) . ' AND
					`currency_unit_id` = ' . $objDatabase->SqlVariable($this->intCurrencyUnitId) . '
			');
		}

		/**
		 * Unassociates all FedexShipments
		 * @return void
		*/ 
		public function UnassociateAllFedexShipments() {
			if ((is_null($this->intCurrencyUnitId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateFedexShipment on this unsaved CurrencyUnit.');

			// Get the Database Object for this Class
			$objDatabase = CurrencyUnit::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`fedex_shipment`
				SET
					`currency_unit_id` = null
				WHERE
					`currency_unit_id` = ' . $objDatabase->SqlVariable($this->intCurrencyUnitId) . '
			');
		}

		/**
		 * Deletes an associated FedexShipment
		 * @param FedexShipment $objFedexShipment
		 * @return void
		*/ 
		public function DeleteAssociatedFedexShipment(FedexShipment $objFedexShipment) {
			if ((is_null($this->intCurrencyUnitId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateFedexShipment on this unsaved CurrencyUnit.');
			if ((is_null($objFedexShipment->FedexShipmentId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateFedexShipment on this CurrencyUnit with an unsaved FedexShipment.');

			// Get the Database Object for this Class
			$objDatabase = CurrencyUnit::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`fedex_shipment`
				WHERE
					`fedex_shipment_id` = ' . $objDatabase->SqlVariable($objFedexShipment->FedexShipmentId) . ' AND
					`currency_unit_id` = ' . $objDatabase->SqlVariable($this->intCurrencyUnitId) . '
			');
		}

		/**
		 * Deletes all associated FedexShipments
		 * @return void
		*/ 
		public function DeleteAllFedexShipments() {
			if ((is_null($this->intCurrencyUnitId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateFedexShipment on this unsaved CurrencyUnit.');

			// Get the Database Object for this Class
			$objDatabase = CurrencyUnit::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`fedex_shipment`
				WHERE
					`currency_unit_id` = ' . $objDatabase->SqlVariable($this->intCurrencyUnitId) . '
			');
		}




		///////////////////////////////////////////////////////////////////////
		// PROTECTED MEMBER VARIABLES and TEXT FIELD MAXLENGTHS (if applicable)
		///////////////////////////////////////////////////////////////////////
		
		/**
		 * Protected member variable that maps to the database PK Identity column currency_unit.currency_unit_id
		 * @var integer intCurrencyUnitId
		 */
		protected $intCurrencyUnitId;
		const CurrencyUnitIdDefault = null;


		/**
		 * Protected member variable that maps to the database column currency_unit.short_description
		 * @var string strShortDescription
		 */
		protected $strShortDescription;
		const ShortDescriptionMaxLength = 255;
		const ShortDescriptionDefault = null;


		/**
		 * Protected member variable that maps to the database column currency_unit.symbol
		 * @var string strSymbol
		 */
		protected $strSymbol;
		const SymbolMaxLength = 6;
		const SymbolDefault = null;


		/**
		 * Private member variable that stores a reference to a single FedexShipment object
		 * (of type FedexShipment), if this CurrencyUnit object was restored with
		 * an expansion on the fedex_shipment association table.
		 * @var FedexShipment _objFedexShipment;
		 */
		private $_objFedexShipment;

		/**
		 * Private member variable that stores a reference to an array of FedexShipment objects
		 * (of type FedexShipment[]), if this CurrencyUnit object was restored with
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
				$objQueryExpansion = new QQueryExpansion('CurrencyUnit', 'currency_unit', $objExpansionMap);
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
				$objQueryExpansion->AddFromItem(sprintf('LEFT JOIN `currency_unit` AS `%s__%s` ON `%s`.`%s` = `%s__%s`.`currency_unit_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias, $strParentAlias, $strAlias));

				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`currency_unit_id` AS `%s__%s__currency_unit_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`short_description` AS `%s__%s__short_description`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`symbol` AS `%s__%s__symbol`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));

				$strParentAlias = $strParentAlias . '__' . $strAlias;
			}

			if (is_array($objExpansionMap))
				foreach ($objExpansionMap as $strKey=>$objValue) {
					switch ($strKey) {
						default:
							throw new QCallerException(sprintf('Unknown Object to Expand in %s: %s', $strParentAlias, $strKey));
					}
				}
		}




		////////////////////////////////////////
		// COLUMN CONSTANTS for OBJECT EXPANSION
		////////////////////////////////////////




		////////////////////////////////////////
		// METHODS for WEB SERVICES
		////////////////////////////////////////

		public static function GetSoapComplexTypeXml() {
			$strToReturn = '<complexType name="CurrencyUnit"><sequence>';
			$strToReturn .= '<element name="CurrencyUnitId" type="xsd:int"/>';
			$strToReturn .= '<element name="ShortDescription" type="xsd:string"/>';
			$strToReturn .= '<element name="Symbol" type="xsd:string"/>';
			$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
			$strToReturn .= '</sequence></complexType>';
			return $strToReturn;
		}

		public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
			if (!array_key_exists('CurrencyUnit', $strComplexTypeArray)) {
				$strComplexTypeArray['CurrencyUnit'] = CurrencyUnit::GetSoapComplexTypeXml();
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, CurrencyUnit::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new CurrencyUnit();
			if (property_exists($objSoapObject, 'CurrencyUnitId'))
				$objToReturn->intCurrencyUnitId = $objSoapObject->CurrencyUnitId;
			if (property_exists($objSoapObject, 'ShortDescription'))
				$objToReturn->strShortDescription = $objSoapObject->ShortDescription;
			if (property_exists($objSoapObject, 'Symbol'))
				$objToReturn->strSymbol = $objSoapObject->Symbol;
			if (property_exists($objSoapObject, '__blnRestored'))
				$objToReturn->__blnRestored = $objSoapObject->__blnRestored;
			return $objToReturn;
		}

		public static function GetSoapArrayFromArray($objArray) {
			if (!$objArray)
				return null;

			$objArrayToReturn = array();

			foreach ($objArray as $objObject)
				array_push($objArrayToReturn, CurrencyUnit::GetSoapObjectFromObject($objObject, true));

			return unserialize(serialize($objArrayToReturn));
		}

		public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
			return $objObject;
		}
	}





	/////////////////////////////////////
	// ADDITIONAL CLASSES for QCODO QUERY
	/////////////////////////////////////

	class QQNodeCurrencyUnit extends QQNode {
		protected $strTableName = 'currency_unit';
		protected $strPrimaryKey = 'currency_unit_id';
		protected $strClassName = 'CurrencyUnit';
		public function __get($strName) {
			switch ($strName) {
				case 'CurrencyUnitId':
					return new QQNode('currency_unit_id', 'integer', $this);
				case 'ShortDescription':
					return new QQNode('short_description', 'string', $this);
				case 'Symbol':
					return new QQNode('symbol', 'string', $this);
				case 'FedexShipment':
					return new QQReverseReferenceNodeFedexShipment($this, 'fedexshipment', 'reverse_reference', 'currency_unit_id');

				case '_PrimaryKeyNode':
					return new QQNode('currency_unit_id', 'integer', $this);
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

	class QQReverseReferenceNodeCurrencyUnit extends QQReverseReferenceNode {
		protected $strTableName = 'currency_unit';
		protected $strPrimaryKey = 'currency_unit_id';
		protected $strClassName = 'CurrencyUnit';
		public function __get($strName) {
			switch ($strName) {
				case 'CurrencyUnitId':
					return new QQNode('currency_unit_id', 'integer', $this);
				case 'ShortDescription':
					return new QQNode('short_description', 'string', $this);
				case 'Symbol':
					return new QQNode('symbol', 'string', $this);
				case 'FedexShipment':
					return new QQReverseReferenceNodeFedexShipment($this, 'fedexshipment', 'reverse_reference', 'currency_unit_id');

				case '_PrimaryKeyNode':
					return new QQNode('currency_unit_id', 'integer', $this);
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