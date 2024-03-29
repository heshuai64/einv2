<?php
	/**
	 * The abstract AuditScanGen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the AuditScan subclass which
	 * extends this AuditScanGen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the AuditScan class.
	 * 
	 * @package My Application
	 * @subpackage GeneratedDataObjects
	 * 
	 */
	class AuditScanGen extends QBaseClass {
		///////////////////////////////
		// COMMON LOAD METHODS
		///////////////////////////////

		/**
		 * Load a AuditScan from PK Info
		 * @param integer $intAuditScanId
		 * @return AuditScan
		 */
		public static function Load($intAuditScanId) {
			// Use QuerySingle to Perform the Query
			return AuditScan::QuerySingle(
				QQ::Equal(QQN::AuditScan()->AuditScanId, $intAuditScanId)
			);
		}

		/**
		 * Load all AuditScans
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return AuditScan[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			// Call AuditScan::QueryArray to perform the LoadAll query
			try {
				return AuditScan::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all AuditScans
		 * @return int
		 */
		public static function CountAll() {
			// Call AuditScan::QueryCount to perform the CountAll query
			return AuditScan::QueryCount(QQ::All());
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
			$objDatabase = AuditScan::GetDatabase();

			// Create/Build out the QueryBuilder object with AuditScan-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, 'audit_scan');
			AuditScan::GetSelectFields($objQueryBuilder);
			$objQueryBuilder->AddFromItem('`audit_scan` AS `audit_scan`');

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
		 * Static Qcodo Query method to query for a single AuditScan object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return AuditScan the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = AuditScan::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query, Get the First Row, and Instantiate a new AuditScan object
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return AuditScan::InstantiateDbRow($objDbResult->GetNextRow());
		}

		/**
		 * Static Qcodo Query method to query for an array of AuditScan objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return AuditScan[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = AuditScan::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return AuditScan::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
		}

		/**
		 * Static Qcodo Query method to query for a count of AuditScan objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = AuditScan::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
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
			$objDatabase = AuditScan::GetDatabase();

			// Lookup the QCache for This Query Statement
			$objCache = new QCache('query', 'audit_scan_' . serialize($strConditions));
			if (!($strQuery = $objCache->GetData())) {
				// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with AuditScan-specific fields
				$objQueryBuilder = new QQueryBuilder($objDatabase);
				AuditScan::GetSelectFields($objQueryBuilder);
				AuditScan::GetFromFields($objQueryBuilder);

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
			return AuditScan::InstantiateDbResult($objDbResult);
		}*/

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this AuditScan
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null) {
			if ($strPrefix) {
				$strTableName = '`' . $strPrefix . '`';
				$strAliasPrefix = '`' . $strPrefix . '__';
			} else {
				$strTableName = '`audit_scan`';
				$strAliasPrefix = '`';
			}

			$objBuilder->AddSelectItem($strTableName . '.`audit_scan_id` AS ' . $strAliasPrefix . 'audit_scan_id`');
			$objBuilder->AddSelectItem($strTableName . '.`audit_id` AS ' . $strAliasPrefix . 'audit_id`');
			$objBuilder->AddSelectItem($strTableName . '.`location_id` AS ' . $strAliasPrefix . 'location_id`');
			$objBuilder->AddSelectItem($strTableName . '.`entity_id` AS ' . $strAliasPrefix . 'entity_id`');
			$objBuilder->AddSelectItem($strTableName . '.`COUNT` AS ' . $strAliasPrefix . 'COUNT`');
			$objBuilder->AddSelectItem($strTableName . '.`system_count` AS ' . $strAliasPrefix . 'system_count`');
		}



		///////////////////////////////
		// INSTANTIATION-RELATED METHODS
		///////////////////////////////

		/**
		 * Instantiate a AuditScan from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this AuditScan::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param DatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @return AuditScan
		*/
		public static function InstantiateDbRow($objDbRow, $strAliasPrefix = null, $strExpandAsArrayNodes = null, $objPreviousItem = null) {
			// If blank row, return null
			if (!$objDbRow)
				return null;


			// Create a new instance of the AuditScan object
			$objToReturn = new AuditScan();
			$objToReturn->__blnRestored = true;

			$objToReturn->intAuditScanId = $objDbRow->GetColumn($strAliasPrefix . 'audit_scan_id', 'Integer');
			$objToReturn->intAuditId = $objDbRow->GetColumn($strAliasPrefix . 'audit_id', 'Integer');
			$objToReturn->intLocationId = $objDbRow->GetColumn($strAliasPrefix . 'location_id', 'Integer');
			$objToReturn->intEntityId = $objDbRow->GetColumn($strAliasPrefix . 'entity_id', 'Integer');
			$objToReturn->intCount = $objDbRow->GetColumn($strAliasPrefix . 'COUNT', 'Integer');
			$objToReturn->intSystemCount = $objDbRow->GetColumn($strAliasPrefix . 'system_count', 'Integer');

			// Instantiate Virtual Attributes
			foreach ($objDbRow->GetColumnNameArray() as $strColumnName => $mixValue) {
				$strVirtualPrefix = $strAliasPrefix . '__';
				$strVirtualPrefixLength = strlen($strVirtualPrefix);
				if (substr($strColumnName, 0, $strVirtualPrefixLength) == $strVirtualPrefix)
					$objToReturn->__strVirtualAttributeArray[substr($strColumnName, $strVirtualPrefixLength)] = $mixValue;
			}

			// Prepare to Check for Early/Virtual Binding
			if (!$strAliasPrefix)
				$strAliasPrefix = 'audit_scan__';

			// Check for Audit Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'audit_id__audit_id')))
				$objToReturn->objAudit = Audit::InstantiateDbRow($objDbRow, $strAliasPrefix . 'audit_id__', $strExpandAsArrayNodes);

			// Check for Location Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'location_id__location_id')))
				$objToReturn->objLocation = Location::InstantiateDbRow($objDbRow, $strAliasPrefix . 'location_id__', $strExpandAsArrayNodes);




			return $objToReturn;
		}

		/**
		 * Instantiate an array of AuditScans from a Database Result
		 * @param DatabaseResultBase $objDbResult
		 * @return AuditScan[]
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
					$objItem = AuditScan::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
					if ($objItem) {
						array_push($objToReturn, $objItem);
						$objLastRowItem = $objItem;
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					array_push($objToReturn, AuditScan::InstantiateDbRow($objDbRow));
			}

			return $objToReturn;
		}



		///////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Single Load and Array)
		///////////////////////////////////////////////////
			
		/**
		 * Load a single AuditScan object,
		 * by AuditScanId Index(es)
		 * @param integer $intAuditScanId
		 * @return AuditScan
		*/
		public static function LoadByAuditScanId($intAuditScanId) {
			return AuditScan::QuerySingle(
				QQ::Equal(QQN::AuditScan()->AuditScanId, $intAuditScanId)
			);
		}
			
		/**
		 * Load an array of AuditScan objects,
		 * by AuditId Index(es)
		 * @param integer $intAuditId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return AuditScan[]
		*/
		public static function LoadArrayByAuditId($intAuditId, $objOptionalClauses = null) {
			// Call AuditScan::QueryArray to perform the LoadArrayByAuditId query
			try {
				return AuditScan::QueryArray(
					QQ::Equal(QQN::AuditScan()->AuditId, $intAuditId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count AuditScans
		 * by AuditId Index(es)
		 * @param integer $intAuditId
		 * @return int
		*/
		public static function CountByAuditId($intAuditId) {
			// Call AuditScan::QueryCount to perform the CountByAuditId query
			return AuditScan::QueryCount(
				QQ::Equal(QQN::AuditScan()->AuditId, $intAuditId)
			);
		}
			
		/**
		 * Load an array of AuditScan objects,
		 * by LocationId Index(es)
		 * @param integer $intLocationId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return AuditScan[]
		*/
		public static function LoadArrayByLocationId($intLocationId, $objOptionalClauses = null) {
			// Call AuditScan::QueryArray to perform the LoadArrayByLocationId query
			try {
				return AuditScan::QueryArray(
					QQ::Equal(QQN::AuditScan()->LocationId, $intLocationId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count AuditScans
		 * by LocationId Index(es)
		 * @param integer $intLocationId
		 * @return int
		*/
		public static function CountByLocationId($intLocationId) {
			// Call AuditScan::QueryCount to perform the CountByLocationId query
			return AuditScan::QueryCount(
				QQ::Equal(QQN::AuditScan()->LocationId, $intLocationId)
			);
		}



		////////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Array via Many to Many)
		////////////////////////////////////////////////////



		//////////////////
		// SAVE AND DELETE
		//////////////////

		/**
		 * Save this AuditScan
		 * @param bool $blnForceInsert
		 * @param bool $blnForceUpdate
		 * @return int
		*/
		public function Save($blnForceInsert = false, $blnForceUpdate = false) {
			// Get the Database Object for this Class
			$objDatabase = AuditScan::GetDatabase();

			$mixToReturn = null;

			try {
				if ((!$this->__blnRestored) || ($blnForceInsert)) {
					// Perform an INSERT query
					$objDatabase->NonQuery('
						INSERT INTO `audit_scan` (
							`audit_id`,
							`location_id`,
							`entity_id`,
							`COUNT`,
							`system_count`
						) VALUES (
							' . $objDatabase->SqlVariable($this->intAuditId) . ',
							' . $objDatabase->SqlVariable($this->intLocationId) . ',
							' . $objDatabase->SqlVariable($this->intEntityId) . ',
							' . $objDatabase->SqlVariable($this->intCount) . ',
							' . $objDatabase->SqlVariable($this->intSystemCount) . '
						)
					');

					// Update Identity column and return its value
					$mixToReturn = $this->intAuditScanId = $objDatabase->InsertId('audit_scan', 'audit_scan_id');
				} else {
					// Perform an UPDATE query

					// First checking for Optimistic Locking constraints (if applicable)

					// Perform the UPDATE query
					$objDatabase->NonQuery('
						UPDATE
							`audit_scan`
						SET
							`audit_id` = ' . $objDatabase->SqlVariable($this->intAuditId) . ',
							`location_id` = ' . $objDatabase->SqlVariable($this->intLocationId) . ',
							`entity_id` = ' . $objDatabase->SqlVariable($this->intEntityId) . ',
							`COUNT` = ' . $objDatabase->SqlVariable($this->intCount) . ',
							`system_count` = ' . $objDatabase->SqlVariable($this->intSystemCount) . '
						WHERE
							`audit_scan_id` = ' . $objDatabase->SqlVariable($this->intAuditScanId) . '
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
		 * Delete this AuditScan
		 * @return void
		*/
		public function Delete() {
			if ((is_null($this->intAuditScanId)))
				throw new QUndefinedPrimaryKeyException('Cannot delete this AuditScan with an unset primary key.');

			// Get the Database Object for this Class
			$objDatabase = AuditScan::GetDatabase();


			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`audit_scan`
				WHERE
					`audit_scan_id` = ' . $objDatabase->SqlVariable($this->intAuditScanId) . '');
		}

		/**
		 * Delete all AuditScans
		 * @return void
		*/
		public static function DeleteAll() {
			// Get the Database Object for this Class
			$objDatabase = AuditScan::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				DELETE FROM
					`audit_scan`');
		}

		/**
		 * Truncate audit_scan table
		 * @return void
		*/
		public static function Truncate() {
			// Get the Database Object for this Class
			$objDatabase = AuditScan::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				TRUNCATE `audit_scan`');
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
				case 'AuditScanId':
					/**
					 * Gets the value for intAuditScanId (Read-Only PK)
					 * @return integer
					 */
					return $this->intAuditScanId;

				case 'AuditId':
					/**
					 * Gets the value for intAuditId (Not Null)
					 * @return integer
					 */
					return $this->intAuditId;

				case 'LocationId':
					/**
					 * Gets the value for intLocationId (Not Null)
					 * @return integer
					 */
					return $this->intLocationId;

				case 'EntityId':
					/**
					 * Gets the value for intEntityId 
					 * @return integer
					 */
					return $this->intEntityId;

				case 'Count':
					/**
					 * Gets the value for intCount 
					 * @return integer
					 */
					return $this->intCount;

				case 'SystemCount':
					/**
					 * Gets the value for intSystemCount 
					 * @return integer
					 */
					return $this->intSystemCount;


				///////////////////
				// Member Objects
				///////////////////
				case 'Audit':
					/**
					 * Gets the value for the Audit object referenced by intAuditId (Not Null)
					 * @return Audit
					 */
					try {
						if ((!$this->objAudit) && (!is_null($this->intAuditId)))
							$this->objAudit = Audit::Load($this->intAuditId);
						return $this->objAudit;
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Location':
					/**
					 * Gets the value for the Location object referenced by intLocationId (Not Null)
					 * @return Location
					 */
					try {
						if ((!$this->objLocation) && (!is_null($this->intLocationId)))
							$this->objLocation = Location::Load($this->intLocationId);
						return $this->objLocation;
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
				case 'AuditId':
					/**
					 * Sets the value for intAuditId (Not Null)
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						$this->objAudit = null;
						return ($this->intAuditId = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'LocationId':
					/**
					 * Sets the value for intLocationId (Not Null)
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						$this->objLocation = null;
						return ($this->intLocationId = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'EntityId':
					/**
					 * Sets the value for intEntityId 
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						return ($this->intEntityId = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Count':
					/**
					 * Sets the value for intCount 
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						return ($this->intCount = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'SystemCount':
					/**
					 * Sets the value for intSystemCount 
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						return ($this->intSystemCount = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}


				///////////////////
				// Member Objects
				///////////////////
				case 'Audit':
					/**
					 * Sets the value for the Audit object referenced by intAuditId (Not Null)
					 * @param Audit $mixValue
					 * @return Audit
					 */
					if (is_null($mixValue)) {
						$this->intAuditId = null;
						$this->objAudit = null;
						return null;
					} else {
						// Make sure $mixValue actually is a Audit object
						try {
							$mixValue = QType::Cast($mixValue, 'Audit');
						} catch (QInvalidCastException $objExc) {
							$objExc->IncrementOffset();
							throw $objExc;
						} 

						// Make sure $mixValue is a SAVED Audit object
						if (is_null($mixValue->AuditId))
							throw new QCallerException('Unable to set an unsaved Audit for this AuditScan');

						// Update Local Member Variables
						$this->objAudit = $mixValue;
						$this->intAuditId = $mixValue->AuditId;

						// Return $mixValue
						return $mixValue;
					}
					break;

				case 'Location':
					/**
					 * Sets the value for the Location object referenced by intLocationId (Not Null)
					 * @param Location $mixValue
					 * @return Location
					 */
					if (is_null($mixValue)) {
						$this->intLocationId = null;
						$this->objLocation = null;
						return null;
					} else {
						// Make sure $mixValue actually is a Location object
						try {
							$mixValue = QType::Cast($mixValue, 'Location');
						} catch (QInvalidCastException $objExc) {
							$objExc->IncrementOffset();
							throw $objExc;
						} 

						// Make sure $mixValue is a SAVED Location object
						if (is_null($mixValue->LocationId))
							throw new QCallerException('Unable to set an unsaved Location for this AuditScan');

						// Update Local Member Variables
						$this->objLocation = $mixValue;
						$this->intLocationId = $mixValue->LocationId;

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
		 * Protected member variable that maps to the database PK Identity column audit_scan.audit_scan_id
		 * @var integer intAuditScanId
		 */
		protected $intAuditScanId;
		const AuditScanIdDefault = null;


		/**
		 * Protected member variable that maps to the database column audit_scan.audit_id
		 * @var integer intAuditId
		 */
		protected $intAuditId;
		const AuditIdDefault = null;


		/**
		 * Protected member variable that maps to the database column audit_scan.location_id
		 * @var integer intLocationId
		 */
		protected $intLocationId;
		const LocationIdDefault = null;


		/**
		 * Protected member variable that maps to the database column audit_scan.entity_id
		 * @var integer intEntityId
		 */
		protected $intEntityId;
		const EntityIdDefault = null;


		/**
		 * Protected member variable that maps to the database column audit_scan.COUNT
		 * @var integer intCount
		 */
		protected $intCount;
		const CountDefault = null;


		/**
		 * Protected member variable that maps to the database column audit_scan.system_count
		 * @var integer intSystemCount
		 */
		protected $intSystemCount;
		const SystemCountDefault = null;


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
		 * in the database column audit_scan.audit_id.
		 *
		 * NOTE: Always use the Audit property getter to correctly retrieve this Audit object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var Audit objAudit
		 */
		protected $objAudit;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column audit_scan.location_id.
		 *
		 * NOTE: Always use the Location property getter to correctly retrieve this Location object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var Location objLocation
		 */
		protected $objLocation;






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
				$objQueryExpansion = new QQueryExpansion('AuditScan', 'audit_scan', $objExpansionMap);
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
				$objQueryExpansion->AddFromItem(sprintf('LEFT JOIN `audit_scan` AS `%s__%s` ON `%s`.`%s` = `%s__%s`.`audit_scan_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias, $strParentAlias, $strAlias));

				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`audit_scan_id` AS `%s__%s__audit_scan_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`audit_id` AS `%s__%s__audit_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`location_id` AS `%s__%s__location_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`entity_id` AS `%s__%s__entity_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`COUNT` AS `%s__%s__COUNT`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`system_count` AS `%s__%s__system_count`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));

				$strParentAlias = $strParentAlias . '__' . $strAlias;
			}

			if (is_array($objExpansionMap))
				foreach ($objExpansionMap as $strKey=>$objValue) {
					switch ($strKey) {
						case 'audit_id':
							try {
								Audit::ExpandQuery($strParentAlias, $strKey, $objValue, $objQueryExpansion);
								break;
							} catch (QCallerException $objExc) {
								$objExc->IncrementOffset();
								throw $objExc;
							}
						case 'location_id':
							try {
								Location::ExpandQuery($strParentAlias, $strKey, $objValue, $objQueryExpansion);
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
		const ExpandAudit = 'audit_id';
		const ExpandLocation = 'location_id';




		////////////////////////////////////////
		// METHODS for WEB SERVICES
		////////////////////////////////////////

		public static function GetSoapComplexTypeXml() {
			$strToReturn = '<complexType name="AuditScan"><sequence>';
			$strToReturn .= '<element name="AuditScanId" type="xsd:int"/>';
			$strToReturn .= '<element name="Audit" type="xsd1:Audit"/>';
			$strToReturn .= '<element name="Location" type="xsd1:Location"/>';
			$strToReturn .= '<element name="EntityId" type="xsd:int"/>';
			$strToReturn .= '<element name="Count" type="xsd:int"/>';
			$strToReturn .= '<element name="SystemCount" type="xsd:int"/>';
			$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
			$strToReturn .= '</sequence></complexType>';
			return $strToReturn;
		}

		public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
			if (!array_key_exists('AuditScan', $strComplexTypeArray)) {
				$strComplexTypeArray['AuditScan'] = AuditScan::GetSoapComplexTypeXml();
				Audit::AlterSoapComplexTypeArray($strComplexTypeArray);
				Location::AlterSoapComplexTypeArray($strComplexTypeArray);
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, AuditScan::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new AuditScan();
			if (property_exists($objSoapObject, 'AuditScanId'))
				$objToReturn->intAuditScanId = $objSoapObject->AuditScanId;
			if ((property_exists($objSoapObject, 'Audit')) &&
				($objSoapObject->Audit))
				$objToReturn->Audit = Audit::GetObjectFromSoapObject($objSoapObject->Audit);
			if ((property_exists($objSoapObject, 'Location')) &&
				($objSoapObject->Location))
				$objToReturn->Location = Location::GetObjectFromSoapObject($objSoapObject->Location);
			if (property_exists($objSoapObject, 'EntityId'))
				$objToReturn->intEntityId = $objSoapObject->EntityId;
			if (property_exists($objSoapObject, 'Count'))
				$objToReturn->intCount = $objSoapObject->Count;
			if (property_exists($objSoapObject, 'SystemCount'))
				$objToReturn->intSystemCount = $objSoapObject->SystemCount;
			if (property_exists($objSoapObject, '__blnRestored'))
				$objToReturn->__blnRestored = $objSoapObject->__blnRestored;
			return $objToReturn;
		}

		public static function GetSoapArrayFromArray($objArray) {
			if (!$objArray)
				return null;

			$objArrayToReturn = array();

			foreach ($objArray as $objObject)
				array_push($objArrayToReturn, AuditScan::GetSoapObjectFromObject($objObject, true));

			return unserialize(serialize($objArrayToReturn));
		}

		public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
			if ($objObject->objAudit)
				$objObject->objAudit = Audit::GetSoapObjectFromObject($objObject->objAudit, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intAuditId = null;
			if ($objObject->objLocation)
				$objObject->objLocation = Location::GetSoapObjectFromObject($objObject->objLocation, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intLocationId = null;
			return $objObject;
		}
	}





	/////////////////////////////////////
	// ADDITIONAL CLASSES for QCODO QUERY
	/////////////////////////////////////

	class QQNodeAuditScan extends QQNode {
		protected $strTableName = 'audit_scan';
		protected $strPrimaryKey = 'audit_scan_id';
		protected $strClassName = 'AuditScan';
		public function __get($strName) {
			switch ($strName) {
				case 'AuditScanId':
					return new QQNode('audit_scan_id', 'integer', $this);
				case 'AuditId':
					return new QQNode('audit_id', 'integer', $this);
				case 'Audit':
					return new QQNodeAudit('audit_id', 'integer', $this);
				case 'LocationId':
					return new QQNode('location_id', 'integer', $this);
				case 'Location':
					return new QQNodeLocation('location_id', 'integer', $this);
				case 'EntityId':
					return new QQNode('entity_id', 'integer', $this);
				case 'Count':
					return new QQNode('COUNT', 'integer', $this);
				case 'SystemCount':
					return new QQNode('system_count', 'integer', $this);

				case '_PrimaryKeyNode':
					return new QQNode('audit_scan_id', 'integer', $this);
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

	class QQReverseReferenceNodeAuditScan extends QQReverseReferenceNode {
		protected $strTableName = 'audit_scan';
		protected $strPrimaryKey = 'audit_scan_id';
		protected $strClassName = 'AuditScan';
		public function __get($strName) {
			switch ($strName) {
				case 'AuditScanId':
					return new QQNode('audit_scan_id', 'integer', $this);
				case 'AuditId':
					return new QQNode('audit_id', 'integer', $this);
				case 'Audit':
					return new QQNodeAudit('audit_id', 'integer', $this);
				case 'LocationId':
					return new QQNode('location_id', 'integer', $this);
				case 'Location':
					return new QQNodeLocation('location_id', 'integer', $this);
				case 'EntityId':
					return new QQNode('entity_id', 'integer', $this);
				case 'Count':
					return new QQNode('COUNT', 'integer', $this);
				case 'SystemCount':
					return new QQNode('system_count', 'integer', $this);

				case '_PrimaryKeyNode':
					return new QQNode('audit_scan_id', 'integer', $this);
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