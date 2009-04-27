<?php
	/**
	 * The abstract FedexServiceTypeGen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the FedexServiceType subclass which
	 * extends this FedexServiceTypeGen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the FedexServiceType class.
	 * 
	 * @package My Application
	 * @subpackage GeneratedDataObjects
	 * 
	 */
	class FedexServiceTypeGen extends QBaseClass {
		///////////////////////////////
		// COMMON LOAD METHODS
		///////////////////////////////

		/**
		 * Load a FedexServiceType from PK Info
		 * @param integer $intFedexServiceTypeId
		 * @return FedexServiceType
		 */
		public static function Load($intFedexServiceTypeId) {
			// Use QuerySingle to Perform the Query
			return FedexServiceType::QuerySingle(
				QQ::Equal(QQN::FedexServiceType()->FedexServiceTypeId, $intFedexServiceTypeId)
			);
		}

		/**
		 * Load all FedexServiceTypes
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return FedexServiceType[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			// Call FedexServiceType::QueryArray to perform the LoadAll query
			try {
				return FedexServiceType::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all FedexServiceTypes
		 * @return int
		 */
		public static function CountAll() {
			// Call FedexServiceType::QueryCount to perform the CountAll query
			return FedexServiceType::QueryCount(QQ::All());
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
			$objDatabase = FedexServiceType::GetDatabase();

			// Create/Build out the QueryBuilder object with FedexServiceType-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, 'fedex_service_type');
			FedexServiceType::GetSelectFields($objQueryBuilder);
			$objQueryBuilder->AddFromItem('`fedex_service_type` AS `fedex_service_type`');

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
		 * Static Qcodo Query method to query for a single FedexServiceType object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return FedexServiceType the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = FedexServiceType::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query, Get the First Row, and Instantiate a new FedexServiceType object
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return FedexServiceType::InstantiateDbRow($objDbResult->GetNextRow());
		}

		/**
		 * Static Qcodo Query method to query for an array of FedexServiceType objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return FedexServiceType[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = FedexServiceType::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return FedexServiceType::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
		}

		/**
		 * Static Qcodo Query method to query for a count of FedexServiceType objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = FedexServiceType::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
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
			$objDatabase = FedexServiceType::GetDatabase();

			// Lookup the QCache for This Query Statement
			$objCache = new QCache('query', 'fedex_service_type_' . serialize($strConditions));
			if (!($strQuery = $objCache->GetData())) {
				// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with FedexServiceType-specific fields
				$objQueryBuilder = new QQueryBuilder($objDatabase);
				FedexServiceType::GetSelectFields($objQueryBuilder);
				FedexServiceType::GetFromFields($objQueryBuilder);

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
			return FedexServiceType::InstantiateDbResult($objDbResult);
		}*/

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this FedexServiceType
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null) {
			if ($strPrefix) {
				$strTableName = '`' . $strPrefix . '`';
				$strAliasPrefix = '`' . $strPrefix . '__';
			} else {
				$strTableName = '`fedex_service_type`';
				$strAliasPrefix = '`';
			}

			$objBuilder->AddSelectItem($strTableName . '.`fedex_service_type_id` AS ' . $strAliasPrefix . 'fedex_service_type_id`');
			$objBuilder->AddSelectItem($strTableName . '.`short_description` AS ' . $strAliasPrefix . 'short_description`');
			$objBuilder->AddSelectItem($strTableName . '.`VALUE` AS ' . $strAliasPrefix . 'VALUE`');
		}



		///////////////////////////////
		// INSTANTIATION-RELATED METHODS
		///////////////////////////////

		/**
		 * Instantiate a FedexServiceType from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this FedexServiceType::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param DatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @return FedexServiceType
		*/
		public static function InstantiateDbRow($objDbRow, $strAliasPrefix = null, $strExpandAsArrayNodes = null, $objPreviousItem = null) {
			// If blank row, return null
			if (!$objDbRow)
				return null;

			// See if we're doing an array expansion on the previous item
			if (($strExpandAsArrayNodes) && ($objPreviousItem) &&
				($objPreviousItem->intFedexServiceTypeId == $objDbRow->GetColumn($strAliasPrefix . 'fedex_service_type_id', 'Integer'))) {

				// We are.  Now, prepare to check for ExpandAsArray clauses
				$blnExpandedViaArray = false;
				if (!$strAliasPrefix)
					$strAliasPrefix = 'fedex_service_type__';


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
				else if ($strAliasPrefix == 'fedex_service_type__')
					$strAliasPrefix = null;
			}

			// Create a new instance of the FedexServiceType object
			$objToReturn = new FedexServiceType();
			$objToReturn->__blnRestored = true;

			$objToReturn->intFedexServiceTypeId = $objDbRow->GetColumn($strAliasPrefix . 'fedex_service_type_id', 'Integer');
			$objToReturn->strShortDescription = $objDbRow->GetColumn($strAliasPrefix . 'short_description', 'VarChar');
			$objToReturn->strValue = $objDbRow->GetColumn($strAliasPrefix . 'VALUE', 'VarChar');

			// Instantiate Virtual Attributes
			foreach ($objDbRow->GetColumnNameArray() as $strColumnName => $mixValue) {
				$strVirtualPrefix = $strAliasPrefix . '__';
				$strVirtualPrefixLength = strlen($strVirtualPrefix);
				if (substr($strColumnName, 0, $strVirtualPrefixLength) == $strVirtualPrefix)
					$objToReturn->__strVirtualAttributeArray[substr($strColumnName, $strVirtualPrefixLength)] = $mixValue;
			}

			// Prepare to Check for Early/Virtual Binding
			if (!$strAliasPrefix)
				$strAliasPrefix = 'fedex_service_type__';




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
		 * Instantiate an array of FedexServiceTypes from a Database Result
		 * @param DatabaseResultBase $objDbResult
		 * @return FedexServiceType[]
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
					$objItem = FedexServiceType::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
					if ($objItem) {
						array_push($objToReturn, $objItem);
						$objLastRowItem = $objItem;
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					array_push($objToReturn, FedexServiceType::InstantiateDbRow($objDbRow));
			}

			return $objToReturn;
		}



		///////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Single Load and Array)
		///////////////////////////////////////////////////
			
		/**
		 * Load a single FedexServiceType object,
		 * by FedexServiceTypeId Index(es)
		 * @param integer $intFedexServiceTypeId
		 * @return FedexServiceType
		*/
		public static function LoadByFedexServiceTypeId($intFedexServiceTypeId) {
			return FedexServiceType::QuerySingle(
				QQ::Equal(QQN::FedexServiceType()->FedexServiceTypeId, $intFedexServiceTypeId)
			);
		}
			
		/**
		 * Load a single FedexServiceType object,
		 * by Value Index(es)
		 * @param string $strValue
		 * @return FedexServiceType
		*/
		public static function LoadByValue($strValue) {
			return FedexServiceType::QuerySingle(
				QQ::Equal(QQN::FedexServiceType()->Value, $strValue)
			);
		}



		////////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Array via Many to Many)
		////////////////////////////////////////////////////



		//////////////////
		// SAVE AND DELETE
		//////////////////

		/**
		 * Save this FedexServiceType
		 * @param bool $blnForceInsert
		 * @param bool $blnForceUpdate
		 * @return int
		*/
		public function Save($blnForceInsert = false, $blnForceUpdate = false) {
			// Get the Database Object for this Class
			$objDatabase = FedexServiceType::GetDatabase();

			$mixToReturn = null;

			try {
				if ((!$this->__blnRestored) || ($blnForceInsert)) {
					// Perform an INSERT query
					$objDatabase->NonQuery('
						INSERT INTO `fedex_service_type` (
							`short_description`,
							`VALUE`
						) VALUES (
							' . $objDatabase->SqlVariable($this->strShortDescription) . ',
							' . $objDatabase->SqlVariable($this->strValue) . '
						)
					');

					// Update Identity column and return its value
					$mixToReturn = $this->intFedexServiceTypeId = $objDatabase->InsertId('fedex_service_type', 'fedex_service_type_id');
				} else {
					// Perform an UPDATE query

					// First checking for Optimistic Locking constraints (if applicable)

					// Perform the UPDATE query
					$objDatabase->NonQuery('
						UPDATE
							`fedex_service_type`
						SET
							`short_description` = ' . $objDatabase->SqlVariable($this->strShortDescription) . ',
							`VALUE` = ' . $objDatabase->SqlVariable($this->strValue) . '
						WHERE
							`fedex_service_type_id` = ' . $objDatabase->SqlVariable($this->intFedexServiceTypeId) . '
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
		 * Delete this FedexServiceType
		 * @return void
		*/
		public function Delete() {
			if ((is_null($this->intFedexServiceTypeId)))
				throw new QUndefinedPrimaryKeyException('Cannot delete this FedexServiceType with an unset primary key.');

			// Get the Database Object for this Class
			$objDatabase = FedexServiceType::GetDatabase();


			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`fedex_service_type`
				WHERE
					`fedex_service_type_id` = ' . $objDatabase->SqlVariable($this->intFedexServiceTypeId) . '');
		}

		/**
		 * Delete all FedexServiceTypes
		 * @return void
		*/
		public static function DeleteAll() {
			// Get the Database Object for this Class
			$objDatabase = FedexServiceType::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				DELETE FROM
					`fedex_service_type`');
		}

		/**
		 * Truncate fedex_service_type table
		 * @return void
		*/
		public static function Truncate() {
			// Get the Database Object for this Class
			$objDatabase = FedexServiceType::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				TRUNCATE `fedex_service_type`');
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
				case 'FedexServiceTypeId':
					/**
					 * Gets the value for intFedexServiceTypeId (Read-Only PK)
					 * @return integer
					 */
					return $this->intFedexServiceTypeId;

				case 'ShortDescription':
					/**
					 * Gets the value for strShortDescription (Not Null)
					 * @return string
					 */
					return $this->strShortDescription;

				case 'Value':
					/**
					 * Gets the value for strValue (Unique)
					 * @return string
					 */
					return $this->strValue;


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
					 * if set due to an expansion on the fedex_shipment.fedex_service_type_id reverse relationship
					 * @return FedexShipment
					 */
					return $this->_objFedexShipment;

				case '_FedexShipmentArray':
					/**
					 * Gets the value for the private _objFedexShipmentArray (Read-Only)
					 * if set due to an ExpandAsArray on the fedex_shipment.fedex_service_type_id reverse relationship
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

				case 'Value':
					/**
					 * Sets the value for strValue (Unique)
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strValue = QType::Cast($mixValue, QType::String));
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
			if ((is_null($this->intFedexServiceTypeId)))
				return array();

			try {
				return FedexShipment::LoadArrayByFedexServiceTypeId($this->intFedexServiceTypeId, $objOptionalClauses);
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
			if ((is_null($this->intFedexServiceTypeId)))
				return 0;

			return FedexShipment::CountByFedexServiceTypeId($this->intFedexServiceTypeId);
		}

		/**
		 * Associates a FedexShipment
		 * @param FedexShipment $objFedexShipment
		 * @return void
		*/ 
		public function AssociateFedexShipment(FedexShipment $objFedexShipment) {
			if ((is_null($this->intFedexServiceTypeId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateFedexShipment on this unsaved FedexServiceType.');
			if ((is_null($objFedexShipment->FedexShipmentId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateFedexShipment on this FedexServiceType with an unsaved FedexShipment.');

			// Get the Database Object for this Class
			$objDatabase = FedexServiceType::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`fedex_shipment`
				SET
					`fedex_service_type_id` = ' . $objDatabase->SqlVariable($this->intFedexServiceTypeId) . '
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
			if ((is_null($this->intFedexServiceTypeId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateFedexShipment on this unsaved FedexServiceType.');
			if ((is_null($objFedexShipment->FedexShipmentId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateFedexShipment on this FedexServiceType with an unsaved FedexShipment.');

			// Get the Database Object for this Class
			$objDatabase = FedexServiceType::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`fedex_shipment`
				SET
					`fedex_service_type_id` = null
				WHERE
					`fedex_shipment_id` = ' . $objDatabase->SqlVariable($objFedexShipment->FedexShipmentId) . ' AND
					`fedex_service_type_id` = ' . $objDatabase->SqlVariable($this->intFedexServiceTypeId) . '
			');
		}

		/**
		 * Unassociates all FedexShipments
		 * @return void
		*/ 
		public function UnassociateAllFedexShipments() {
			if ((is_null($this->intFedexServiceTypeId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateFedexShipment on this unsaved FedexServiceType.');

			// Get the Database Object for this Class
			$objDatabase = FedexServiceType::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`fedex_shipment`
				SET
					`fedex_service_type_id` = null
				WHERE
					`fedex_service_type_id` = ' . $objDatabase->SqlVariable($this->intFedexServiceTypeId) . '
			');
		}

		/**
		 * Deletes an associated FedexShipment
		 * @param FedexShipment $objFedexShipment
		 * @return void
		*/ 
		public function DeleteAssociatedFedexShipment(FedexShipment $objFedexShipment) {
			if ((is_null($this->intFedexServiceTypeId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateFedexShipment on this unsaved FedexServiceType.');
			if ((is_null($objFedexShipment->FedexShipmentId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateFedexShipment on this FedexServiceType with an unsaved FedexShipment.');

			// Get the Database Object for this Class
			$objDatabase = FedexServiceType::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`fedex_shipment`
				WHERE
					`fedex_shipment_id` = ' . $objDatabase->SqlVariable($objFedexShipment->FedexShipmentId) . ' AND
					`fedex_service_type_id` = ' . $objDatabase->SqlVariable($this->intFedexServiceTypeId) . '
			');
		}

		/**
		 * Deletes all associated FedexShipments
		 * @return void
		*/ 
		public function DeleteAllFedexShipments() {
			if ((is_null($this->intFedexServiceTypeId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateFedexShipment on this unsaved FedexServiceType.');

			// Get the Database Object for this Class
			$objDatabase = FedexServiceType::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`fedex_shipment`
				WHERE
					`fedex_service_type_id` = ' . $objDatabase->SqlVariable($this->intFedexServiceTypeId) . '
			');
		}




		///////////////////////////////////////////////////////////////////////
		// PROTECTED MEMBER VARIABLES and TEXT FIELD MAXLENGTHS (if applicable)
		///////////////////////////////////////////////////////////////////////
		
		/**
		 * Protected member variable that maps to the database PK Identity column fedex_service_type.fedex_service_type_id
		 * @var integer intFedexServiceTypeId
		 */
		protected $intFedexServiceTypeId;
		const FedexServiceTypeIdDefault = null;


		/**
		 * Protected member variable that maps to the database column fedex_service_type.short_description
		 * @var string strShortDescription
		 */
		protected $strShortDescription;
		const ShortDescriptionMaxLength = 255;
		const ShortDescriptionDefault = null;


		/**
		 * Protected member variable that maps to the database column fedex_service_type.VALUE
		 * @var string strValue
		 */
		protected $strValue;
		const ValueMaxLength = 50;
		const ValueDefault = null;


		/**
		 * Private member variable that stores a reference to a single FedexShipment object
		 * (of type FedexShipment), if this FedexServiceType object was restored with
		 * an expansion on the fedex_shipment association table.
		 * @var FedexShipment _objFedexShipment;
		 */
		private $_objFedexShipment;

		/**
		 * Private member variable that stores a reference to an array of FedexShipment objects
		 * (of type FedexShipment[]), if this FedexServiceType object was restored with
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
				$objQueryExpansion = new QQueryExpansion('FedexServiceType', 'fedex_service_type', $objExpansionMap);
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
				$objQueryExpansion->AddFromItem(sprintf('LEFT JOIN `fedex_service_type` AS `%s__%s` ON `%s`.`%s` = `%s__%s`.`fedex_service_type_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias, $strParentAlias, $strAlias));

				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`fedex_service_type_id` AS `%s__%s__fedex_service_type_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`short_description` AS `%s__%s__short_description`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`VALUE` AS `%s__%s__VALUE`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));

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
			$strToReturn = '<complexType name="FedexServiceType"><sequence>';
			$strToReturn .= '<element name="FedexServiceTypeId" type="xsd:int"/>';
			$strToReturn .= '<element name="ShortDescription" type="xsd:string"/>';
			$strToReturn .= '<element name="Value" type="xsd:string"/>';
			$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
			$strToReturn .= '</sequence></complexType>';
			return $strToReturn;
		}

		public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
			if (!array_key_exists('FedexServiceType', $strComplexTypeArray)) {
				$strComplexTypeArray['FedexServiceType'] = FedexServiceType::GetSoapComplexTypeXml();
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, FedexServiceType::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new FedexServiceType();
			if (property_exists($objSoapObject, 'FedexServiceTypeId'))
				$objToReturn->intFedexServiceTypeId = $objSoapObject->FedexServiceTypeId;
			if (property_exists($objSoapObject, 'ShortDescription'))
				$objToReturn->strShortDescription = $objSoapObject->ShortDescription;
			if (property_exists($objSoapObject, 'Value'))
				$objToReturn->strValue = $objSoapObject->Value;
			if (property_exists($objSoapObject, '__blnRestored'))
				$objToReturn->__blnRestored = $objSoapObject->__blnRestored;
			return $objToReturn;
		}

		public static function GetSoapArrayFromArray($objArray) {
			if (!$objArray)
				return null;

			$objArrayToReturn = array();

			foreach ($objArray as $objObject)
				array_push($objArrayToReturn, FedexServiceType::GetSoapObjectFromObject($objObject, true));

			return unserialize(serialize($objArrayToReturn));
		}

		public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
			return $objObject;
		}
	}





	/////////////////////////////////////
	// ADDITIONAL CLASSES for QCODO QUERY
	/////////////////////////////////////

	class QQNodeFedexServiceType extends QQNode {
		protected $strTableName = 'fedex_service_type';
		protected $strPrimaryKey = 'fedex_service_type_id';
		protected $strClassName = 'FedexServiceType';
		public function __get($strName) {
			switch ($strName) {
				case 'FedexServiceTypeId':
					return new QQNode('fedex_service_type_id', 'integer', $this);
				case 'ShortDescription':
					return new QQNode('short_description', 'string', $this);
				case 'Value':
					return new QQNode('VALUE', 'string', $this);
				case 'FedexShipment':
					return new QQReverseReferenceNodeFedexShipment($this, 'fedexshipment', 'reverse_reference', 'fedex_service_type_id');

				case '_PrimaryKeyNode':
					return new QQNode('fedex_service_type_id', 'integer', $this);
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

	class QQReverseReferenceNodeFedexServiceType extends QQReverseReferenceNode {
		protected $strTableName = 'fedex_service_type';
		protected $strPrimaryKey = 'fedex_service_type_id';
		protected $strClassName = 'FedexServiceType';
		public function __get($strName) {
			switch ($strName) {
				case 'FedexServiceTypeId':
					return new QQNode('fedex_service_type_id', 'integer', $this);
				case 'ShortDescription':
					return new QQNode('short_description', 'string', $this);
				case 'Value':
					return new QQNode('VALUE', 'string', $this);
				case 'FedexShipment':
					return new QQReverseReferenceNodeFedexShipment($this, 'fedexshipment', 'reverse_reference', 'fedex_service_type_id');

				case '_PrimaryKeyNode':
					return new QQNode('fedex_service_type_id', 'integer', $this);
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