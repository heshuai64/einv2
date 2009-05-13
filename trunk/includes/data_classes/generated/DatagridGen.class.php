<?php
	/**
	 * The abstract DatagridGen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the Datagrid subclass which
	 * extends this DatagridGen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the Datagrid class.
	 * 
	 * @package My Application
	 * @subpackage GeneratedDataObjects
	 * 
	 */
	class DatagridGen extends QBaseClass {
		///////////////////////////////
		// COMMON LOAD METHODS
		///////////////////////////////

		/**
		 * Load a Datagrid from PK Info
		 * @param integer $intDatagridId
		 * @return Datagrid
		 */
		public static function Load($intDatagridId) {
			// Use QuerySingle to Perform the Query
			return Datagrid::QuerySingle(
				QQ::Equal(QQN::Datagrid()->DatagridId, $intDatagridId)
			);
		}

		/**
		 * Load all Datagrids
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Datagrid[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			// Call Datagrid::QueryArray to perform the LoadAll query
			try {
				return Datagrid::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all Datagrids
		 * @return int
		 */
		public static function CountAll() {
			// Call Datagrid::QueryCount to perform the CountAll query
			return Datagrid::QueryCount(QQ::All());
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
			$objDatabase = Datagrid::GetDatabase();

			// Create/Build out the QueryBuilder object with Datagrid-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, 'datagrid');
			Datagrid::GetSelectFields($objQueryBuilder);
			$objQueryBuilder->AddFromItem('`datagrid` AS `datagrid`');

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
		 * Static Qcodo Query method to query for a single Datagrid object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return Datagrid the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Datagrid::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query, Get the First Row, and Instantiate a new Datagrid object
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return Datagrid::InstantiateDbRow($objDbResult->GetNextRow());
		}

		/**
		 * Static Qcodo Query method to query for an array of Datagrid objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return Datagrid[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Datagrid::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return Datagrid::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
		}

		/**
		 * Static Qcodo Query method to query for a count of Datagrid objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Datagrid::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
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
			$objDatabase = Datagrid::GetDatabase();

			// Lookup the QCache for This Query Statement
			$objCache = new QCache('query', 'datagrid_' . serialize($strConditions));
			if (!($strQuery = $objCache->GetData())) {
				// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with Datagrid-specific fields
				$objQueryBuilder = new QQueryBuilder($objDatabase);
				Datagrid::GetSelectFields($objQueryBuilder);
				Datagrid::GetFromFields($objQueryBuilder);

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
			return Datagrid::InstantiateDbResult($objDbResult);
		}*/

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this Datagrid
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null) {
			if ($strPrefix) {
				$strTableName = '`' . $strPrefix . '`';
				$strAliasPrefix = '`' . $strPrefix . '__';
			} else {
				$strTableName = '`datagrid`';
				$strAliasPrefix = '`';
			}

			$objBuilder->AddSelectItem($strTableName . '.`datagrid_id` AS ' . $strAliasPrefix . 'datagrid_id`');
			$objBuilder->AddSelectItem($strTableName . '.`short_description` AS ' . $strAliasPrefix . 'short_description`');
		}



		///////////////////////////////
		// INSTANTIATION-RELATED METHODS
		///////////////////////////////

		/**
		 * Instantiate a Datagrid from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this Datagrid::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param DatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @return Datagrid
		*/
		public static function InstantiateDbRow($objDbRow, $strAliasPrefix = null, $strExpandAsArrayNodes = null, $objPreviousItem = null) {
			// If blank row, return null
			if (!$objDbRow)
				return null;

			// See if we're doing an array expansion on the previous item
			if (($strExpandAsArrayNodes) && ($objPreviousItem) &&
				($objPreviousItem->intDatagridId == $objDbRow->GetColumn($strAliasPrefix . 'datagrid_id', 'Integer'))) {

				// We are.  Now, prepare to check for ExpandAsArray clauses
				$blnExpandedViaArray = false;
				if (!$strAliasPrefix)
					$strAliasPrefix = 'datagrid__';


				if ((array_key_exists($strAliasPrefix . 'datagridcolumnpreference__datagrid_column_preference_id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'datagridcolumnpreference__datagrid_column_preference_id')))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objDatagridColumnPreferenceArray)) {
						$objPreviousChildItem = $objPreviousItem->_objDatagridColumnPreferenceArray[$intPreviousChildItemCount - 1];
						$objChildItem = DatagridColumnPreference::InstantiateDbRow($objDbRow, $strAliasPrefix . 'datagridcolumnpreference__', $strExpandAsArrayNodes, $objPreviousChildItem);
						if ($objChildItem)
							array_push($objPreviousItem->_objDatagridColumnPreferenceArray, $objChildItem);
					} else
						array_push($objPreviousItem->_objDatagridColumnPreferenceArray, DatagridColumnPreference::InstantiateDbRow($objDbRow, $strAliasPrefix . 'datagridcolumnpreference__', $strExpandAsArrayNodes));
					$blnExpandedViaArray = true;
				}

				// Either return false to signal array expansion, or check-to-reset the Alias prefix and move on
				if ($blnExpandedViaArray)
					return false;
				else if ($strAliasPrefix == 'datagrid__')
					$strAliasPrefix = null;
			}

			// Create a new instance of the Datagrid object
			$objToReturn = new Datagrid();
			$objToReturn->__blnRestored = true;

			$objToReturn->intDatagridId = $objDbRow->GetColumn($strAliasPrefix . 'datagrid_id', 'Integer');
			$objToReturn->strShortDescription = $objDbRow->GetColumn($strAliasPrefix . 'short_description', 'VarChar');

			// Instantiate Virtual Attributes
			foreach ($objDbRow->GetColumnNameArray() as $strColumnName => $mixValue) {
				$strVirtualPrefix = $strAliasPrefix . '__';
				$strVirtualPrefixLength = strlen($strVirtualPrefix);
				if (substr($strColumnName, 0, $strVirtualPrefixLength) == $strVirtualPrefix)
					$objToReturn->__strVirtualAttributeArray[substr($strColumnName, $strVirtualPrefixLength)] = $mixValue;
			}

			// Prepare to Check for Early/Virtual Binding
			if (!$strAliasPrefix)
				$strAliasPrefix = 'datagrid__';




			// Check for DatagridColumnPreference Virtual Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'datagridcolumnpreference__datagrid_column_preference_id'))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'datagridcolumnpreference__datagrid_column_preference_id', $strExpandAsArrayNodes)))
					array_push($objToReturn->_objDatagridColumnPreferenceArray, DatagridColumnPreference::InstantiateDbRow($objDbRow, $strAliasPrefix . 'datagridcolumnpreference__', $strExpandAsArrayNodes));
				else
					$objToReturn->_objDatagridColumnPreference = DatagridColumnPreference::InstantiateDbRow($objDbRow, $strAliasPrefix . 'datagridcolumnpreference__', $strExpandAsArrayNodes);
			}

			return $objToReturn;
		}

		/**
		 * Instantiate an array of Datagrids from a Database Result
		 * @param DatabaseResultBase $objDbResult
		 * @return Datagrid[]
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
					$objItem = Datagrid::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
					if ($objItem) {
						array_push($objToReturn, $objItem);
						$objLastRowItem = $objItem;
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					array_push($objToReturn, Datagrid::InstantiateDbRow($objDbRow));
			}

			return $objToReturn;
		}



		///////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Single Load and Array)
		///////////////////////////////////////////////////
			
		/**
		 * Load a single Datagrid object,
		 * by DatagridId Index(es)
		 * @param integer $intDatagridId
		 * @return Datagrid
		*/
		public static function LoadByDatagridId($intDatagridId) {
			return Datagrid::QuerySingle(
				QQ::Equal(QQN::Datagrid()->DatagridId, $intDatagridId)
			);
		}
			
		/**
		 * Load a single Datagrid object,
		 * by ShortDescription Index(es)
		 * @param string $strShortDescription
		 * @return Datagrid
		*/
		public static function LoadByShortDescription($strShortDescription) {
			return Datagrid::QuerySingle(
				QQ::Equal(QQN::Datagrid()->ShortDescription, $strShortDescription)
			);
		}



		////////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Array via Many to Many)
		////////////////////////////////////////////////////



		//////////////////
		// SAVE AND DELETE
		//////////////////

		/**
		 * Save this Datagrid
		 * @param bool $blnForceInsert
		 * @param bool $blnForceUpdate
		 * @return int
		*/
		public function Save($blnForceInsert = false, $blnForceUpdate = false) {
			// Get the Database Object for this Class
			$objDatabase = Datagrid::GetDatabase();

			$mixToReturn = null;

			try {
				if ((!$this->__blnRestored) || ($blnForceInsert)) {
					// Perform an INSERT query
					$objDatabase->NonQuery('
						INSERT INTO `datagrid` (
							`short_description`
						) VALUES (
							' . $objDatabase->SqlVariable($this->strShortDescription) . '
						)
					');

					// Update Identity column and return its value
					$mixToReturn = $this->intDatagridId = $objDatabase->InsertId('datagrid', 'datagrid_id');
				} else {
					// Perform an UPDATE query

					// First checking for Optimistic Locking constraints (if applicable)

					// Perform the UPDATE query
					$objDatabase->NonQuery('
						UPDATE
							`datagrid`
						SET
							`short_description` = ' . $objDatabase->SqlVariable($this->strShortDescription) . '
						WHERE
							`datagrid_id` = ' . $objDatabase->SqlVariable($this->intDatagridId) . '
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
		 * Delete this Datagrid
		 * @return void
		*/
		public function Delete() {
			if ((is_null($this->intDatagridId)))
				throw new QUndefinedPrimaryKeyException('Cannot delete this Datagrid with an unset primary key.');

			// Get the Database Object for this Class
			$objDatabase = Datagrid::GetDatabase();


			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`datagrid`
				WHERE
					`datagrid_id` = ' . $objDatabase->SqlVariable($this->intDatagridId) . '');
		}

		/**
		 * Delete all Datagrids
		 * @return void
		*/
		public static function DeleteAll() {
			// Get the Database Object for this Class
			$objDatabase = Datagrid::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				DELETE FROM
					`datagrid`');
		}

		/**
		 * Truncate datagrid table
		 * @return void
		*/
		public static function Truncate() {
			// Get the Database Object for this Class
			$objDatabase = Datagrid::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				TRUNCATE `datagrid`');
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
				case 'DatagridId':
					/**
					 * Gets the value for intDatagridId (Read-Only PK)
					 * @return integer
					 */
					return $this->intDatagridId;

				case 'ShortDescription':
					/**
					 * Gets the value for strShortDescription (Unique)
					 * @return string
					 */
					return $this->strShortDescription;


				///////////////////
				// Member Objects
				///////////////////

				////////////////////////////
				// Virtual Object References (Many to Many and Reverse References)
				// (If restored via a "Many-to" expansion)
				////////////////////////////

				case '_DatagridColumnPreference':
					/**
					 * Gets the value for the private _objDatagridColumnPreference (Read-Only)
					 * if set due to an expansion on the datagrid_column_preference.datagrid_id reverse relationship
					 * @return DatagridColumnPreference
					 */
					return $this->_objDatagridColumnPreference;

				case '_DatagridColumnPreferenceArray':
					/**
					 * Gets the value for the private _objDatagridColumnPreferenceArray (Read-Only)
					 * if set due to an ExpandAsArray on the datagrid_column_preference.datagrid_id reverse relationship
					 * @return DatagridColumnPreference[]
					 */
					return (array) $this->_objDatagridColumnPreferenceArray;

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

			
		
		// Related Objects' Methods for DatagridColumnPreference
		//-------------------------------------------------------------------

		/**
		 * Gets all associated DatagridColumnPreferences as an array of DatagridColumnPreference objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return DatagridColumnPreference[]
		*/ 
		public function GetDatagridColumnPreferenceArray($objOptionalClauses = null) {
			if ((is_null($this->intDatagridId)))
				return array();

			try {
				return DatagridColumnPreference::LoadArrayByDatagridId($this->intDatagridId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated DatagridColumnPreferences
		 * @return int
		*/ 
		public function CountDatagridColumnPreferences() {
			if ((is_null($this->intDatagridId)))
				return 0;

			return DatagridColumnPreference::CountByDatagridId($this->intDatagridId);
		}

		/**
		 * Associates a DatagridColumnPreference
		 * @param DatagridColumnPreference $objDatagridColumnPreference
		 * @return void
		*/ 
		public function AssociateDatagridColumnPreference(DatagridColumnPreference $objDatagridColumnPreference) {
			if ((is_null($this->intDatagridId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateDatagridColumnPreference on this unsaved Datagrid.');
			if ((is_null($objDatagridColumnPreference->DatagridColumnPreferenceId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateDatagridColumnPreference on this Datagrid with an unsaved DatagridColumnPreference.');

			// Get the Database Object for this Class
			$objDatabase = Datagrid::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`datagrid_column_preference`
				SET
					`datagrid_id` = ' . $objDatabase->SqlVariable($this->intDatagridId) . '
				WHERE
					`datagrid_column_preference_id` = ' . $objDatabase->SqlVariable($objDatagridColumnPreference->DatagridColumnPreferenceId) . '
			');
		}

		/**
		 * Unassociates a DatagridColumnPreference
		 * @param DatagridColumnPreference $objDatagridColumnPreference
		 * @return void
		*/ 
		public function UnassociateDatagridColumnPreference(DatagridColumnPreference $objDatagridColumnPreference) {
			if ((is_null($this->intDatagridId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateDatagridColumnPreference on this unsaved Datagrid.');
			if ((is_null($objDatagridColumnPreference->DatagridColumnPreferenceId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateDatagridColumnPreference on this Datagrid with an unsaved DatagridColumnPreference.');

			// Get the Database Object for this Class
			$objDatabase = Datagrid::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`datagrid_column_preference`
				SET
					`datagrid_id` = null
				WHERE
					`datagrid_column_preference_id` = ' . $objDatabase->SqlVariable($objDatagridColumnPreference->DatagridColumnPreferenceId) . ' AND
					`datagrid_id` = ' . $objDatabase->SqlVariable($this->intDatagridId) . '
			');
		}

		/**
		 * Unassociates all DatagridColumnPreferences
		 * @return void
		*/ 
		public function UnassociateAllDatagridColumnPreferences() {
			if ((is_null($this->intDatagridId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateDatagridColumnPreference on this unsaved Datagrid.');

			// Get the Database Object for this Class
			$objDatabase = Datagrid::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`datagrid_column_preference`
				SET
					`datagrid_id` = null
				WHERE
					`datagrid_id` = ' . $objDatabase->SqlVariable($this->intDatagridId) . '
			');
		}

		/**
		 * Deletes an associated DatagridColumnPreference
		 * @param DatagridColumnPreference $objDatagridColumnPreference
		 * @return void
		*/ 
		public function DeleteAssociatedDatagridColumnPreference(DatagridColumnPreference $objDatagridColumnPreference) {
			if ((is_null($this->intDatagridId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateDatagridColumnPreference on this unsaved Datagrid.');
			if ((is_null($objDatagridColumnPreference->DatagridColumnPreferenceId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateDatagridColumnPreference on this Datagrid with an unsaved DatagridColumnPreference.');

			// Get the Database Object for this Class
			$objDatabase = Datagrid::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`datagrid_column_preference`
				WHERE
					`datagrid_column_preference_id` = ' . $objDatabase->SqlVariable($objDatagridColumnPreference->DatagridColumnPreferenceId) . ' AND
					`datagrid_id` = ' . $objDatabase->SqlVariable($this->intDatagridId) . '
			');
		}

		/**
		 * Deletes all associated DatagridColumnPreferences
		 * @return void
		*/ 
		public function DeleteAllDatagridColumnPreferences() {
			if ((is_null($this->intDatagridId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateDatagridColumnPreference on this unsaved Datagrid.');

			// Get the Database Object for this Class
			$objDatabase = Datagrid::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`datagrid_column_preference`
				WHERE
					`datagrid_id` = ' . $objDatabase->SqlVariable($this->intDatagridId) . '
			');
		}




		///////////////////////////////////////////////////////////////////////
		// PROTECTED MEMBER VARIABLES and TEXT FIELD MAXLENGTHS (if applicable)
		///////////////////////////////////////////////////////////////////////
		
		/**
		 * Protected member variable that maps to the database PK Identity column datagrid.datagrid_id
		 * @var integer intDatagridId
		 */
		protected $intDatagridId;
		const DatagridIdDefault = null;


		/**
		 * Protected member variable that maps to the database column datagrid.short_description
		 * @var string strShortDescription
		 */
		protected $strShortDescription;
		const ShortDescriptionMaxLength = 255;
		const ShortDescriptionDefault = null;


		/**
		 * Private member variable that stores a reference to a single DatagridColumnPreference object
		 * (of type DatagridColumnPreference), if this Datagrid object was restored with
		 * an expansion on the datagrid_column_preference association table.
		 * @var DatagridColumnPreference _objDatagridColumnPreference;
		 */
		private $_objDatagridColumnPreference;

		/**
		 * Private member variable that stores a reference to an array of DatagridColumnPreference objects
		 * (of type DatagridColumnPreference[]), if this Datagrid object was restored with
		 * an ExpandAsArray on the datagrid_column_preference association table.
		 * @var DatagridColumnPreference[] _objDatagridColumnPreferenceArray;
		 */
		private $_objDatagridColumnPreferenceArray = array();

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
				$objQueryExpansion = new QQueryExpansion('Datagrid', 'datagrid', $objExpansionMap);
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
				$objQueryExpansion->AddFromItem(sprintf('LEFT JOIN `datagrid` AS `%s__%s` ON `%s`.`%s` = `%s__%s`.`datagrid_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias, $strParentAlias, $strAlias));

				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`datagrid_id` AS `%s__%s__datagrid_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`short_description` AS `%s__%s__short_description`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));

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
			$strToReturn = '<complexType name="Datagrid"><sequence>';
			$strToReturn .= '<element name="DatagridId" type="xsd:int"/>';
			$strToReturn .= '<element name="ShortDescription" type="xsd:string"/>';
			$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
			$strToReturn .= '</sequence></complexType>';
			return $strToReturn;
		}

		public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
			if (!array_key_exists('Datagrid', $strComplexTypeArray)) {
				$strComplexTypeArray['Datagrid'] = Datagrid::GetSoapComplexTypeXml();
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, Datagrid::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new Datagrid();
			if (property_exists($objSoapObject, 'DatagridId'))
				$objToReturn->intDatagridId = $objSoapObject->DatagridId;
			if (property_exists($objSoapObject, 'ShortDescription'))
				$objToReturn->strShortDescription = $objSoapObject->ShortDescription;
			if (property_exists($objSoapObject, '__blnRestored'))
				$objToReturn->__blnRestored = $objSoapObject->__blnRestored;
			return $objToReturn;
		}

		public static function GetSoapArrayFromArray($objArray) {
			if (!$objArray)
				return null;

			$objArrayToReturn = array();

			foreach ($objArray as $objObject)
				array_push($objArrayToReturn, Datagrid::GetSoapObjectFromObject($objObject, true));

			return unserialize(serialize($objArrayToReturn));
		}

		public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
			return $objObject;
		}
	}





	/////////////////////////////////////
	// ADDITIONAL CLASSES for QCODO QUERY
	/////////////////////////////////////

	class QQNodeDatagrid extends QQNode {
		protected $strTableName = 'datagrid';
		protected $strPrimaryKey = 'datagrid_id';
		protected $strClassName = 'Datagrid';
		public function __get($strName) {
			switch ($strName) {
				case 'DatagridId':
					return new QQNode('datagrid_id', 'integer', $this);
				case 'ShortDescription':
					return new QQNode('short_description', 'string', $this);
				case 'DatagridColumnPreference':
					return new QQReverseReferenceNodeDatagridColumnPreference($this, 'datagridcolumnpreference', 'reverse_reference', 'datagrid_id');

				case '_PrimaryKeyNode':
					return new QQNode('datagrid_id', 'integer', $this);
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

	class QQReverseReferenceNodeDatagrid extends QQReverseReferenceNode {
		protected $strTableName = 'datagrid';
		protected $strPrimaryKey = 'datagrid_id';
		protected $strClassName = 'Datagrid';
		public function __get($strName) {
			switch ($strName) {
				case 'DatagridId':
					return new QQNode('datagrid_id', 'integer', $this);
				case 'ShortDescription':
					return new QQNode('short_description', 'string', $this);
				case 'DatagridColumnPreference':
					return new QQReverseReferenceNodeDatagridColumnPreference($this, 'datagridcolumnpreference', 'reverse_reference', 'datagrid_id');

				case '_PrimaryKeyNode':
					return new QQNode('datagrid_id', 'integer', $this);
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