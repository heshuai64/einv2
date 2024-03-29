<?php
	/**
	 * The abstract DatagridColumnPreferenceGen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the DatagridColumnPreference subclass which
	 * extends this DatagridColumnPreferenceGen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the DatagridColumnPreference class.
	 * 
	 * @package My Application
	 * @subpackage GeneratedDataObjects
	 * 
	 */
	class DatagridColumnPreferenceGen extends QBaseClass {
		///////////////////////////////
		// COMMON LOAD METHODS
		///////////////////////////////

		/**
		 * Load a DatagridColumnPreference from PK Info
		 * @param integer $intDatagridColumnPreferenceId
		 * @return DatagridColumnPreference
		 */
		public static function Load($intDatagridColumnPreferenceId) {
			// Use QuerySingle to Perform the Query
			return DatagridColumnPreference::QuerySingle(
				QQ::Equal(QQN::DatagridColumnPreference()->DatagridColumnPreferenceId, $intDatagridColumnPreferenceId)
			);
		}

		/**
		 * Load all DatagridColumnPreferences
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return DatagridColumnPreference[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			// Call DatagridColumnPreference::QueryArray to perform the LoadAll query
			try {
				return DatagridColumnPreference::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all DatagridColumnPreferences
		 * @return int
		 */
		public static function CountAll() {
			// Call DatagridColumnPreference::QueryCount to perform the CountAll query
			return DatagridColumnPreference::QueryCount(QQ::All());
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
			$objDatabase = DatagridColumnPreference::GetDatabase();

			// Create/Build out the QueryBuilder object with DatagridColumnPreference-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, 'datagrid_column_preference');
			DatagridColumnPreference::GetSelectFields($objQueryBuilder);
			$objQueryBuilder->AddFromItem('`datagrid_column_preference` AS `datagrid_column_preference`');

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
		 * Static Qcodo Query method to query for a single DatagridColumnPreference object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return DatagridColumnPreference the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = DatagridColumnPreference::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query, Get the First Row, and Instantiate a new DatagridColumnPreference object
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return DatagridColumnPreference::InstantiateDbRow($objDbResult->GetNextRow());
		}

		/**
		 * Static Qcodo Query method to query for an array of DatagridColumnPreference objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return DatagridColumnPreference[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = DatagridColumnPreference::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return DatagridColumnPreference::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
		}

		/**
		 * Static Qcodo Query method to query for a count of DatagridColumnPreference objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = DatagridColumnPreference::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
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
			$objDatabase = DatagridColumnPreference::GetDatabase();

			// Lookup the QCache for This Query Statement
			$objCache = new QCache('query', 'datagrid_column_preference_' . serialize($strConditions));
			if (!($strQuery = $objCache->GetData())) {
				// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with DatagridColumnPreference-specific fields
				$objQueryBuilder = new QQueryBuilder($objDatabase);
				DatagridColumnPreference::GetSelectFields($objQueryBuilder);
				DatagridColumnPreference::GetFromFields($objQueryBuilder);

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
			return DatagridColumnPreference::InstantiateDbResult($objDbResult);
		}*/

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this DatagridColumnPreference
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null) {
			if ($strPrefix) {
				$strTableName = '`' . $strPrefix . '`';
				$strAliasPrefix = '`' . $strPrefix . '__';
			} else {
				$strTableName = '`datagrid_column_preference`';
				$strAliasPrefix = '`';
			}

			$objBuilder->AddSelectItem($strTableName . '.`datagrid_column_preference_id` AS ' . $strAliasPrefix . 'datagrid_column_preference_id`');
			$objBuilder->AddSelectItem($strTableName . '.`datagrid_id` AS ' . $strAliasPrefix . 'datagrid_id`');
			$objBuilder->AddSelectItem($strTableName . '.`column_name` AS ' . $strAliasPrefix . 'column_name`');
			$objBuilder->AddSelectItem($strTableName . '.`user_account_id` AS ' . $strAliasPrefix . 'user_account_id`');
			$objBuilder->AddSelectItem($strTableName . '.`display_flag` AS ' . $strAliasPrefix . 'display_flag`');
		}



		///////////////////////////////
		// INSTANTIATION-RELATED METHODS
		///////////////////////////////

		/**
		 * Instantiate a DatagridColumnPreference from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this DatagridColumnPreference::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param DatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @return DatagridColumnPreference
		*/
		public static function InstantiateDbRow($objDbRow, $strAliasPrefix = null, $strExpandAsArrayNodes = null, $objPreviousItem = null) {
			// If blank row, return null
			if (!$objDbRow)
				return null;


			// Create a new instance of the DatagridColumnPreference object
			$objToReturn = new DatagridColumnPreference();
			$objToReturn->__blnRestored = true;

			$objToReturn->intDatagridColumnPreferenceId = $objDbRow->GetColumn($strAliasPrefix . 'datagrid_column_preference_id', 'Integer');
			$objToReturn->intDatagridId = $objDbRow->GetColumn($strAliasPrefix . 'datagrid_id', 'Integer');
			$objToReturn->strColumnName = $objDbRow->GetColumn($strAliasPrefix . 'column_name', 'VarChar');
			$objToReturn->intUserAccountId = $objDbRow->GetColumn($strAliasPrefix . 'user_account_id', 'Integer');
			$objToReturn->blnDisplayFlag = $objDbRow->GetColumn($strAliasPrefix . 'display_flag', 'Bit');

			// Instantiate Virtual Attributes
			foreach ($objDbRow->GetColumnNameArray() as $strColumnName => $mixValue) {
				$strVirtualPrefix = $strAliasPrefix . '__';
				$strVirtualPrefixLength = strlen($strVirtualPrefix);
				if (substr($strColumnName, 0, $strVirtualPrefixLength) == $strVirtualPrefix)
					$objToReturn->__strVirtualAttributeArray[substr($strColumnName, $strVirtualPrefixLength)] = $mixValue;
			}

			// Prepare to Check for Early/Virtual Binding
			if (!$strAliasPrefix)
				$strAliasPrefix = 'datagrid_column_preference__';

			// Check for Datagrid Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'datagrid_id__datagrid_id')))
				$objToReturn->objDatagrid = Datagrid::InstantiateDbRow($objDbRow, $strAliasPrefix . 'datagrid_id__', $strExpandAsArrayNodes);

			// Check for UserAccount Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'user_account_id__user_account_id')))
				$objToReturn->objUserAccount = UserAccount::InstantiateDbRow($objDbRow, $strAliasPrefix . 'user_account_id__', $strExpandAsArrayNodes);




			return $objToReturn;
		}

		/**
		 * Instantiate an array of DatagridColumnPreferences from a Database Result
		 * @param DatabaseResultBase $objDbResult
		 * @return DatagridColumnPreference[]
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
					$objItem = DatagridColumnPreference::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
					if ($objItem) {
						array_push($objToReturn, $objItem);
						$objLastRowItem = $objItem;
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					array_push($objToReturn, DatagridColumnPreference::InstantiateDbRow($objDbRow));
			}

			return $objToReturn;
		}



		///////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Single Load and Array)
		///////////////////////////////////////////////////
			
		/**
		 * Load a single DatagridColumnPreference object,
		 * by DatagridColumnPreferenceId Index(es)
		 * @param integer $intDatagridColumnPreferenceId
		 * @return DatagridColumnPreference
		*/
		public static function LoadByDatagridColumnPreferenceId($intDatagridColumnPreferenceId) {
			return DatagridColumnPreference::QuerySingle(
				QQ::Equal(QQN::DatagridColumnPreference()->DatagridColumnPreferenceId, $intDatagridColumnPreferenceId)
			);
		}
			
		/**
		 * Load a single DatagridColumnPreference object,
		 * by DatagridId, ColumnName, UserAccountId Index(es)
		 * @param integer $intDatagridId
		 * @param string $strColumnName
		 * @param integer $intUserAccountId
		 * @return DatagridColumnPreference
		*/
		public static function LoadByDatagridIdColumnNameUserAccountId($intDatagridId, $strColumnName, $intUserAccountId) {
			return DatagridColumnPreference::QuerySingle(
				QQ::AndCondition(
				QQ::Equal(QQN::DatagridColumnPreference()->DatagridId, $intDatagridId),
				QQ::Equal(QQN::DatagridColumnPreference()->ColumnName, $strColumnName),
				QQ::Equal(QQN::DatagridColumnPreference()->UserAccountId, $intUserAccountId)
				)
			);
		}
			
		/**
		 * Load an array of DatagridColumnPreference objects,
		 * by DatagridId Index(es)
		 * @param integer $intDatagridId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return DatagridColumnPreference[]
		*/
		public static function LoadArrayByDatagridId($intDatagridId, $objOptionalClauses = null) {
			// Call DatagridColumnPreference::QueryArray to perform the LoadArrayByDatagridId query
			try {
				return DatagridColumnPreference::QueryArray(
					QQ::Equal(QQN::DatagridColumnPreference()->DatagridId, $intDatagridId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count DatagridColumnPreferences
		 * by DatagridId Index(es)
		 * @param integer $intDatagridId
		 * @return int
		*/
		public static function CountByDatagridId($intDatagridId) {
			// Call DatagridColumnPreference::QueryCount to perform the CountByDatagridId query
			return DatagridColumnPreference::QueryCount(
				QQ::Equal(QQN::DatagridColumnPreference()->DatagridId, $intDatagridId)
			);
		}
			
		/**
		 * Load an array of DatagridColumnPreference objects,
		 * by UserAccountId Index(es)
		 * @param integer $intUserAccountId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return DatagridColumnPreference[]
		*/
		public static function LoadArrayByUserAccountId($intUserAccountId, $objOptionalClauses = null) {
			// Call DatagridColumnPreference::QueryArray to perform the LoadArrayByUserAccountId query
			try {
				return DatagridColumnPreference::QueryArray(
					QQ::Equal(QQN::DatagridColumnPreference()->UserAccountId, $intUserAccountId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count DatagridColumnPreferences
		 * by UserAccountId Index(es)
		 * @param integer $intUserAccountId
		 * @return int
		*/
		public static function CountByUserAccountId($intUserAccountId) {
			// Call DatagridColumnPreference::QueryCount to perform the CountByUserAccountId query
			return DatagridColumnPreference::QueryCount(
				QQ::Equal(QQN::DatagridColumnPreference()->UserAccountId, $intUserAccountId)
			);
		}



		////////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Array via Many to Many)
		////////////////////////////////////////////////////



		//////////////////
		// SAVE AND DELETE
		//////////////////

		/**
		 * Save this DatagridColumnPreference
		 * @param bool $blnForceInsert
		 * @param bool $blnForceUpdate
		 * @return int
		*/
		public function Save($blnForceInsert = false, $blnForceUpdate = false) {
			// Get the Database Object for this Class
			$objDatabase = DatagridColumnPreference::GetDatabase();

			$mixToReturn = null;

			try {
				if ((!$this->__blnRestored) || ($blnForceInsert)) {
					// Perform an INSERT query
					$objDatabase->NonQuery('
						INSERT INTO `datagrid_column_preference` (
							`datagrid_id`,
							`column_name`,
							`user_account_id`,
							`display_flag`
						) VALUES (
							' . $objDatabase->SqlVariable($this->intDatagridId) . ',
							' . $objDatabase->SqlVariable($this->strColumnName) . ',
							' . $objDatabase->SqlVariable($this->intUserAccountId) . ',
							' . $objDatabase->SqlVariable($this->blnDisplayFlag) . '
						)
					');

					// Update Identity column and return its value
					$mixToReturn = $this->intDatagridColumnPreferenceId = $objDatabase->InsertId('datagrid_column_preference', 'datagrid_column_preference_id');
				} else {
					// Perform an UPDATE query

					// First checking for Optimistic Locking constraints (if applicable)

					// Perform the UPDATE query
					$objDatabase->NonQuery('
						UPDATE
							`datagrid_column_preference`
						SET
							`datagrid_id` = ' . $objDatabase->SqlVariable($this->intDatagridId) . ',
							`column_name` = ' . $objDatabase->SqlVariable($this->strColumnName) . ',
							`user_account_id` = ' . $objDatabase->SqlVariable($this->intUserAccountId) . ',
							`display_flag` = ' . $objDatabase->SqlVariable($this->blnDisplayFlag) . '
						WHERE
							`datagrid_column_preference_id` = ' . $objDatabase->SqlVariable($this->intDatagridColumnPreferenceId) . '
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
		 * Delete this DatagridColumnPreference
		 * @return void
		*/
		public function Delete() {
			if ((is_null($this->intDatagridColumnPreferenceId)))
				throw new QUndefinedPrimaryKeyException('Cannot delete this DatagridColumnPreference with an unset primary key.');

			// Get the Database Object for this Class
			$objDatabase = DatagridColumnPreference::GetDatabase();


			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`datagrid_column_preference`
				WHERE
					`datagrid_column_preference_id` = ' . $objDatabase->SqlVariable($this->intDatagridColumnPreferenceId) . '');
		}

		/**
		 * Delete all DatagridColumnPreferences
		 * @return void
		*/
		public static function DeleteAll() {
			// Get the Database Object for this Class
			$objDatabase = DatagridColumnPreference::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				DELETE FROM
					`datagrid_column_preference`');
		}

		/**
		 * Truncate datagrid_column_preference table
		 * @return void
		*/
		public static function Truncate() {
			// Get the Database Object for this Class
			$objDatabase = DatagridColumnPreference::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				TRUNCATE `datagrid_column_preference`');
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
				case 'DatagridColumnPreferenceId':
					/**
					 * Gets the value for intDatagridColumnPreferenceId (Read-Only PK)
					 * @return integer
					 */
					return $this->intDatagridColumnPreferenceId;

				case 'DatagridId':
					/**
					 * Gets the value for intDatagridId (Not Null)
					 * @return integer
					 */
					return $this->intDatagridId;

				case 'ColumnName':
					/**
					 * Gets the value for strColumnName (Not Null)
					 * @return string
					 */
					return $this->strColumnName;

				case 'UserAccountId':
					/**
					 * Gets the value for intUserAccountId (Not Null)
					 * @return integer
					 */
					return $this->intUserAccountId;

				case 'DisplayFlag':
					/**
					 * Gets the value for blnDisplayFlag (Not Null)
					 * @return boolean
					 */
					return $this->blnDisplayFlag;


				///////////////////
				// Member Objects
				///////////////////
				case 'Datagrid':
					/**
					 * Gets the value for the Datagrid object referenced by intDatagridId (Not Null)
					 * @return Datagrid
					 */
					try {
						if ((!$this->objDatagrid) && (!is_null($this->intDatagridId)))
							$this->objDatagrid = Datagrid::Load($this->intDatagridId);
						return $this->objDatagrid;
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'UserAccount':
					/**
					 * Gets the value for the UserAccount object referenced by intUserAccountId (Not Null)
					 * @return UserAccount
					 */
					try {
						if ((!$this->objUserAccount) && (!is_null($this->intUserAccountId)))
							$this->objUserAccount = UserAccount::Load($this->intUserAccountId);
						return $this->objUserAccount;
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
				case 'DatagridId':
					/**
					 * Sets the value for intDatagridId (Not Null)
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						$this->objDatagrid = null;
						return ($this->intDatagridId = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'ColumnName':
					/**
					 * Sets the value for strColumnName (Not Null)
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strColumnName = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'UserAccountId':
					/**
					 * Sets the value for intUserAccountId (Not Null)
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						$this->objUserAccount = null;
						return ($this->intUserAccountId = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'DisplayFlag':
					/**
					 * Sets the value for blnDisplayFlag (Not Null)
					 * @param boolean $mixValue
					 * @return boolean
					 */
					try {
						return ($this->blnDisplayFlag = QType::Cast($mixValue, QType::Boolean));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}


				///////////////////
				// Member Objects
				///////////////////
				case 'Datagrid':
					/**
					 * Sets the value for the Datagrid object referenced by intDatagridId (Not Null)
					 * @param Datagrid $mixValue
					 * @return Datagrid
					 */
					if (is_null($mixValue)) {
						$this->intDatagridId = null;
						$this->objDatagrid = null;
						return null;
					} else {
						// Make sure $mixValue actually is a Datagrid object
						try {
							$mixValue = QType::Cast($mixValue, 'Datagrid');
						} catch (QInvalidCastException $objExc) {
							$objExc->IncrementOffset();
							throw $objExc;
						} 

						// Make sure $mixValue is a SAVED Datagrid object
						if (is_null($mixValue->DatagridId))
							throw new QCallerException('Unable to set an unsaved Datagrid for this DatagridColumnPreference');

						// Update Local Member Variables
						$this->objDatagrid = $mixValue;
						$this->intDatagridId = $mixValue->DatagridId;

						// Return $mixValue
						return $mixValue;
					}
					break;

				case 'UserAccount':
					/**
					 * Sets the value for the UserAccount object referenced by intUserAccountId (Not Null)
					 * @param UserAccount $mixValue
					 * @return UserAccount
					 */
					if (is_null($mixValue)) {
						$this->intUserAccountId = null;
						$this->objUserAccount = null;
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
							throw new QCallerException('Unable to set an unsaved UserAccount for this DatagridColumnPreference');

						// Update Local Member Variables
						$this->objUserAccount = $mixValue;
						$this->intUserAccountId = $mixValue->UserAccountId;

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
		 * Protected member variable that maps to the database PK Identity column datagrid_column_preference.datagrid_column_preference_id
		 * @var integer intDatagridColumnPreferenceId
		 */
		protected $intDatagridColumnPreferenceId;
		const DatagridColumnPreferenceIdDefault = null;


		/**
		 * Protected member variable that maps to the database column datagrid_column_preference.datagrid_id
		 * @var integer intDatagridId
		 */
		protected $intDatagridId;
		const DatagridIdDefault = null;


		/**
		 * Protected member variable that maps to the database column datagrid_column_preference.column_name
		 * @var string strColumnName
		 */
		protected $strColumnName;
		const ColumnNameMaxLength = 255;
		const ColumnNameDefault = null;


		/**
		 * Protected member variable that maps to the database column datagrid_column_preference.user_account_id
		 * @var integer intUserAccountId
		 */
		protected $intUserAccountId;
		const UserAccountIdDefault = null;


		/**
		 * Protected member variable that maps to the database column datagrid_column_preference.display_flag
		 * @var boolean blnDisplayFlag
		 */
		protected $blnDisplayFlag;
		const DisplayFlagDefault = null;


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
		 * in the database column datagrid_column_preference.datagrid_id.
		 *
		 * NOTE: Always use the Datagrid property getter to correctly retrieve this Datagrid object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var Datagrid objDatagrid
		 */
		protected $objDatagrid;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column datagrid_column_preference.user_account_id.
		 *
		 * NOTE: Always use the UserAccount property getter to correctly retrieve this UserAccount object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var UserAccount objUserAccount
		 */
		protected $objUserAccount;






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
				$objQueryExpansion = new QQueryExpansion('DatagridColumnPreference', 'datagrid_column_preference', $objExpansionMap);
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
				$objQueryExpansion->AddFromItem(sprintf('LEFT JOIN `datagrid_column_preference` AS `%s__%s` ON `%s`.`%s` = `%s__%s`.`datagrid_column_preference_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias, $strParentAlias, $strAlias));

				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`datagrid_column_preference_id` AS `%s__%s__datagrid_column_preference_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`datagrid_id` AS `%s__%s__datagrid_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`column_name` AS `%s__%s__column_name`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`user_account_id` AS `%s__%s__user_account_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`display_flag` AS `%s__%s__display_flag`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));

				$strParentAlias = $strParentAlias . '__' . $strAlias;
			}

			if (is_array($objExpansionMap))
				foreach ($objExpansionMap as $strKey=>$objValue) {
					switch ($strKey) {
						case 'datagrid_id':
							try {
								Datagrid::ExpandQuery($strParentAlias, $strKey, $objValue, $objQueryExpansion);
								break;
							} catch (QCallerException $objExc) {
								$objExc->IncrementOffset();
								throw $objExc;
							}
						case 'user_account_id':
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
		const ExpandDatagrid = 'datagrid_id';
		const ExpandUserAccount = 'user_account_id';




		////////////////////////////////////////
		// METHODS for WEB SERVICES
		////////////////////////////////////////

		public static function GetSoapComplexTypeXml() {
			$strToReturn = '<complexType name="DatagridColumnPreference"><sequence>';
			$strToReturn .= '<element name="DatagridColumnPreferenceId" type="xsd:int"/>';
			$strToReturn .= '<element name="Datagrid" type="xsd1:Datagrid"/>';
			$strToReturn .= '<element name="ColumnName" type="xsd:string"/>';
			$strToReturn .= '<element name="UserAccount" type="xsd1:UserAccount"/>';
			$strToReturn .= '<element name="DisplayFlag" type="xsd:boolean"/>';
			$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
			$strToReturn .= '</sequence></complexType>';
			return $strToReturn;
		}

		public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
			if (!array_key_exists('DatagridColumnPreference', $strComplexTypeArray)) {
				$strComplexTypeArray['DatagridColumnPreference'] = DatagridColumnPreference::GetSoapComplexTypeXml();
				Datagrid::AlterSoapComplexTypeArray($strComplexTypeArray);
				UserAccount::AlterSoapComplexTypeArray($strComplexTypeArray);
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, DatagridColumnPreference::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new DatagridColumnPreference();
			if (property_exists($objSoapObject, 'DatagridColumnPreferenceId'))
				$objToReturn->intDatagridColumnPreferenceId = $objSoapObject->DatagridColumnPreferenceId;
			if ((property_exists($objSoapObject, 'Datagrid')) &&
				($objSoapObject->Datagrid))
				$objToReturn->Datagrid = Datagrid::GetObjectFromSoapObject($objSoapObject->Datagrid);
			if (property_exists($objSoapObject, 'ColumnName'))
				$objToReturn->strColumnName = $objSoapObject->ColumnName;
			if ((property_exists($objSoapObject, 'UserAccount')) &&
				($objSoapObject->UserAccount))
				$objToReturn->UserAccount = UserAccount::GetObjectFromSoapObject($objSoapObject->UserAccount);
			if (property_exists($objSoapObject, 'DisplayFlag'))
				$objToReturn->blnDisplayFlag = $objSoapObject->DisplayFlag;
			if (property_exists($objSoapObject, '__blnRestored'))
				$objToReturn->__blnRestored = $objSoapObject->__blnRestored;
			return $objToReturn;
		}

		public static function GetSoapArrayFromArray($objArray) {
			if (!$objArray)
				return null;

			$objArrayToReturn = array();

			foreach ($objArray as $objObject)
				array_push($objArrayToReturn, DatagridColumnPreference::GetSoapObjectFromObject($objObject, true));

			return unserialize(serialize($objArrayToReturn));
		}

		public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
			if ($objObject->objDatagrid)
				$objObject->objDatagrid = Datagrid::GetSoapObjectFromObject($objObject->objDatagrid, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intDatagridId = null;
			if ($objObject->objUserAccount)
				$objObject->objUserAccount = UserAccount::GetSoapObjectFromObject($objObject->objUserAccount, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intUserAccountId = null;
			return $objObject;
		}
	}





	/////////////////////////////////////
	// ADDITIONAL CLASSES for QCODO QUERY
	/////////////////////////////////////

	class QQNodeDatagridColumnPreference extends QQNode {
		protected $strTableName = 'datagrid_column_preference';
		protected $strPrimaryKey = 'datagrid_column_preference_id';
		protected $strClassName = 'DatagridColumnPreference';
		public function __get($strName) {
			switch ($strName) {
				case 'DatagridColumnPreferenceId':
					return new QQNode('datagrid_column_preference_id', 'integer', $this);
				case 'DatagridId':
					return new QQNode('datagrid_id', 'integer', $this);
				case 'Datagrid':
					return new QQNodeDatagrid('datagrid_id', 'integer', $this);
				case 'ColumnName':
					return new QQNode('column_name', 'string', $this);
				case 'UserAccountId':
					return new QQNode('user_account_id', 'integer', $this);
				case 'UserAccount':
					return new QQNodeUserAccount('user_account_id', 'integer', $this);
				case 'DisplayFlag':
					return new QQNode('display_flag', 'boolean', $this);

				case '_PrimaryKeyNode':
					return new QQNode('datagrid_column_preference_id', 'integer', $this);
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

	class QQReverseReferenceNodeDatagridColumnPreference extends QQReverseReferenceNode {
		protected $strTableName = 'datagrid_column_preference';
		protected $strPrimaryKey = 'datagrid_column_preference_id';
		protected $strClassName = 'DatagridColumnPreference';
		public function __get($strName) {
			switch ($strName) {
				case 'DatagridColumnPreferenceId':
					return new QQNode('datagrid_column_preference_id', 'integer', $this);
				case 'DatagridId':
					return new QQNode('datagrid_id', 'integer', $this);
				case 'Datagrid':
					return new QQNodeDatagrid('datagrid_id', 'integer', $this);
				case 'ColumnName':
					return new QQNode('column_name', 'string', $this);
				case 'UserAccountId':
					return new QQNode('user_account_id', 'integer', $this);
				case 'UserAccount':
					return new QQNodeUserAccount('user_account_id', 'integer', $this);
				case 'DisplayFlag':
					return new QQNode('display_flag', 'boolean', $this);

				case '_PrimaryKeyNode':
					return new QQNode('datagrid_column_preference_id', 'integer', $this);
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