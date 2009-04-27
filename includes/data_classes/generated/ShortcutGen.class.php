<?php
	/**
	 * The abstract ShortcutGen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the Shortcut subclass which
	 * extends this ShortcutGen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the Shortcut class.
	 * 
	 * @package My Application
	 * @subpackage GeneratedDataObjects
	 * 
	 */
	class ShortcutGen extends QBaseClass {
		///////////////////////////////
		// COMMON LOAD METHODS
		///////////////////////////////

		/**
		 * Load a Shortcut from PK Info
		 * @param integer $intShortcutId
		 * @return Shortcut
		 */
		public static function Load($intShortcutId) {
			// Use QuerySingle to Perform the Query
			return Shortcut::QuerySingle(
				QQ::Equal(QQN::Shortcut()->ShortcutId, $intShortcutId)
			);
		}

		/**
		 * Load all Shortcuts
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Shortcut[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			// Call Shortcut::QueryArray to perform the LoadAll query
			try {
				return Shortcut::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all Shortcuts
		 * @return int
		 */
		public static function CountAll() {
			// Call Shortcut::QueryCount to perform the CountAll query
			return Shortcut::QueryCount(QQ::All());
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
			$objDatabase = Shortcut::GetDatabase();

			// Create/Build out the QueryBuilder object with Shortcut-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, 'shortcut');
			Shortcut::GetSelectFields($objQueryBuilder);
			$objQueryBuilder->AddFromItem('`shortcut` AS `shortcut`');

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
		 * Static Qcodo Query method to query for a single Shortcut object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return Shortcut the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Shortcut::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query, Get the First Row, and Instantiate a new Shortcut object
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return Shortcut::InstantiateDbRow($objDbResult->GetNextRow());
		}

		/**
		 * Static Qcodo Query method to query for an array of Shortcut objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return Shortcut[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Shortcut::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return Shortcut::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
		}

		/**
		 * Static Qcodo Query method to query for a count of Shortcut objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Shortcut::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
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
			$objDatabase = Shortcut::GetDatabase();

			// Lookup the QCache for This Query Statement
			$objCache = new QCache('query', 'shortcut_' . serialize($strConditions));
			if (!($strQuery = $objCache->GetData())) {
				// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with Shortcut-specific fields
				$objQueryBuilder = new QQueryBuilder($objDatabase);
				Shortcut::GetSelectFields($objQueryBuilder);
				Shortcut::GetFromFields($objQueryBuilder);

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
			return Shortcut::InstantiateDbResult($objDbResult);
		}*/

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this Shortcut
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null) {
			if ($strPrefix) {
				$strTableName = '`' . $strPrefix . '`';
				$strAliasPrefix = '`' . $strPrefix . '__';
			} else {
				$strTableName = '`shortcut`';
				$strAliasPrefix = '`';
			}

			$objBuilder->AddSelectItem($strTableName . '.`shortcut_id` AS ' . $strAliasPrefix . 'shortcut_id`');
			$objBuilder->AddSelectItem($strTableName . '.`module_id` AS ' . $strAliasPrefix . 'module_id`');
			$objBuilder->AddSelectItem($strTableName . '.`authorization_id` AS ' . $strAliasPrefix . 'authorization_id`');
			$objBuilder->AddSelectItem($strTableName . '.`short_description` AS ' . $strAliasPrefix . 'short_description`');
			$objBuilder->AddSelectItem($strTableName . '.`link` AS ' . $strAliasPrefix . 'link`');
			$objBuilder->AddSelectItem($strTableName . '.`image_path` AS ' . $strAliasPrefix . 'image_path`');
			$objBuilder->AddSelectItem($strTableName . '.`entity_qtype_id` AS ' . $strAliasPrefix . 'entity_qtype_id`');
			$objBuilder->AddSelectItem($strTableName . '.`create_flag` AS ' . $strAliasPrefix . 'create_flag`');
		}



		///////////////////////////////
		// INSTANTIATION-RELATED METHODS
		///////////////////////////////

		/**
		 * Instantiate a Shortcut from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this Shortcut::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param DatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @return Shortcut
		*/
		public static function InstantiateDbRow($objDbRow, $strAliasPrefix = null, $strExpandAsArrayNodes = null, $objPreviousItem = null) {
			// If blank row, return null
			if (!$objDbRow)
				return null;


			// Create a new instance of the Shortcut object
			$objToReturn = new Shortcut();
			$objToReturn->__blnRestored = true;

			$objToReturn->intShortcutId = $objDbRow->GetColumn($strAliasPrefix . 'shortcut_id', 'Integer');
			$objToReturn->intModuleId = $objDbRow->GetColumn($strAliasPrefix . 'module_id', 'Integer');
			$objToReturn->intAuthorizationId = $objDbRow->GetColumn($strAliasPrefix . 'authorization_id', 'Integer');
			$objToReturn->strShortDescription = $objDbRow->GetColumn($strAliasPrefix . 'short_description', 'VarChar');
			$objToReturn->strLink = $objDbRow->GetColumn($strAliasPrefix . 'link', 'VarChar');
			$objToReturn->strImagePath = $objDbRow->GetColumn($strAliasPrefix . 'image_path', 'VarChar');
			$objToReturn->intEntityQtypeId = $objDbRow->GetColumn($strAliasPrefix . 'entity_qtype_id', 'Integer');
			$objToReturn->blnCreateFlag = $objDbRow->GetColumn($strAliasPrefix . 'create_flag', 'Bit');

			// Instantiate Virtual Attributes
			foreach ($objDbRow->GetColumnNameArray() as $strColumnName => $mixValue) {
				$strVirtualPrefix = $strAliasPrefix . '__';
				$strVirtualPrefixLength = strlen($strVirtualPrefix);
				if (substr($strColumnName, 0, $strVirtualPrefixLength) == $strVirtualPrefix)
					$objToReturn->__strVirtualAttributeArray[substr($strColumnName, $strVirtualPrefixLength)] = $mixValue;
			}

			// Prepare to Check for Early/Virtual Binding
			if (!$strAliasPrefix)
				$strAliasPrefix = 'shortcut__';

			// Check for Module Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'module_id__module_id')))
				$objToReturn->objModule = Module::InstantiateDbRow($objDbRow, $strAliasPrefix . 'module_id__', $strExpandAsArrayNodes);

			// Check for Authorization Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'authorization_id__authorization_id')))
				$objToReturn->objAuthorization = Authorization::InstantiateDbRow($objDbRow, $strAliasPrefix . 'authorization_id__', $strExpandAsArrayNodes);




			return $objToReturn;
		}

		/**
		 * Instantiate an array of Shortcuts from a Database Result
		 * @param DatabaseResultBase $objDbResult
		 * @return Shortcut[]
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
					$objItem = Shortcut::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
					if ($objItem) {
						array_push($objToReturn, $objItem);
						$objLastRowItem = $objItem;
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					array_push($objToReturn, Shortcut::InstantiateDbRow($objDbRow));
			}

			return $objToReturn;
		}



		///////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Single Load and Array)
		///////////////////////////////////////////////////
			
		/**
		 * Load a single Shortcut object,
		 * by ShortcutId Index(es)
		 * @param integer $intShortcutId
		 * @return Shortcut
		*/
		public static function LoadByShortcutId($intShortcutId) {
			return Shortcut::QuerySingle(
				QQ::Equal(QQN::Shortcut()->ShortcutId, $intShortcutId)
			);
		}
			
		/**
		 * Load an array of Shortcut objects,
		 * by ModuleId Index(es)
		 * @param integer $intModuleId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Shortcut[]
		*/
		public static function LoadArrayByModuleId($intModuleId, $objOptionalClauses = null) {
			// Call Shortcut::QueryArray to perform the LoadArrayByModuleId query
			try {
				return Shortcut::QueryArray(
					QQ::Equal(QQN::Shortcut()->ModuleId, $intModuleId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count Shortcuts
		 * by ModuleId Index(es)
		 * @param integer $intModuleId
		 * @return int
		*/
		public static function CountByModuleId($intModuleId) {
			// Call Shortcut::QueryCount to perform the CountByModuleId query
			return Shortcut::QueryCount(
				QQ::Equal(QQN::Shortcut()->ModuleId, $intModuleId)
			);
		}
			
		/**
		 * Load an array of Shortcut objects,
		 * by AuthorizationId Index(es)
		 * @param integer $intAuthorizationId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Shortcut[]
		*/
		public static function LoadArrayByAuthorizationId($intAuthorizationId, $objOptionalClauses = null) {
			// Call Shortcut::QueryArray to perform the LoadArrayByAuthorizationId query
			try {
				return Shortcut::QueryArray(
					QQ::Equal(QQN::Shortcut()->AuthorizationId, $intAuthorizationId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count Shortcuts
		 * by AuthorizationId Index(es)
		 * @param integer $intAuthorizationId
		 * @return int
		*/
		public static function CountByAuthorizationId($intAuthorizationId) {
			// Call Shortcut::QueryCount to perform the CountByAuthorizationId query
			return Shortcut::QueryCount(
				QQ::Equal(QQN::Shortcut()->AuthorizationId, $intAuthorizationId)
			);
		}
			
		/**
		 * Load an array of Shortcut objects,
		 * by EntityQtypeId Index(es)
		 * @param integer $intEntityQtypeId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Shortcut[]
		*/
		public static function LoadArrayByEntityQtypeId($intEntityQtypeId, $objOptionalClauses = null) {
			// Call Shortcut::QueryArray to perform the LoadArrayByEntityQtypeId query
			try {
				return Shortcut::QueryArray(
					QQ::Equal(QQN::Shortcut()->EntityQtypeId, $intEntityQtypeId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count Shortcuts
		 * by EntityQtypeId Index(es)
		 * @param integer $intEntityQtypeId
		 * @return int
		*/
		public static function CountByEntityQtypeId($intEntityQtypeId) {
			// Call Shortcut::QueryCount to perform the CountByEntityQtypeId query
			return Shortcut::QueryCount(
				QQ::Equal(QQN::Shortcut()->EntityQtypeId, $intEntityQtypeId)
			);
		}



		////////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Array via Many to Many)
		////////////////////////////////////////////////////



		//////////////////
		// SAVE AND DELETE
		//////////////////

		/**
		 * Save this Shortcut
		 * @param bool $blnForceInsert
		 * @param bool $blnForceUpdate
		 * @return int
		*/
		public function Save($blnForceInsert = false, $blnForceUpdate = false) {
			// Get the Database Object for this Class
			$objDatabase = Shortcut::GetDatabase();

			$mixToReturn = null;

			try {
				if ((!$this->__blnRestored) || ($blnForceInsert)) {
					// Perform an INSERT query
					$objDatabase->NonQuery('
						INSERT INTO `shortcut` (
							`module_id`,
							`authorization_id`,
							`short_description`,
							`link`,
							`image_path`,
							`entity_qtype_id`,
							`create_flag`
						) VALUES (
							' . $objDatabase->SqlVariable($this->intModuleId) . ',
							' . $objDatabase->SqlVariable($this->intAuthorizationId) . ',
							' . $objDatabase->SqlVariable($this->strShortDescription) . ',
							' . $objDatabase->SqlVariable($this->strLink) . ',
							' . $objDatabase->SqlVariable($this->strImagePath) . ',
							' . $objDatabase->SqlVariable($this->intEntityQtypeId) . ',
							' . $objDatabase->SqlVariable($this->blnCreateFlag) . '
						)
					');

					// Update Identity column and return its value
					$mixToReturn = $this->intShortcutId = $objDatabase->InsertId('shortcut', 'shortcut_id');
				} else {
					// Perform an UPDATE query

					// First checking for Optimistic Locking constraints (if applicable)

					// Perform the UPDATE query
					$objDatabase->NonQuery('
						UPDATE
							`shortcut`
						SET
							`module_id` = ' . $objDatabase->SqlVariable($this->intModuleId) . ',
							`authorization_id` = ' . $objDatabase->SqlVariable($this->intAuthorizationId) . ',
							`short_description` = ' . $objDatabase->SqlVariable($this->strShortDescription) . ',
							`link` = ' . $objDatabase->SqlVariable($this->strLink) . ',
							`image_path` = ' . $objDatabase->SqlVariable($this->strImagePath) . ',
							`entity_qtype_id` = ' . $objDatabase->SqlVariable($this->intEntityQtypeId) . ',
							`create_flag` = ' . $objDatabase->SqlVariable($this->blnCreateFlag) . '
						WHERE
							`shortcut_id` = ' . $objDatabase->SqlVariable($this->intShortcutId) . '
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
		 * Delete this Shortcut
		 * @return void
		*/
		public function Delete() {
			if ((is_null($this->intShortcutId)))
				throw new QUndefinedPrimaryKeyException('Cannot delete this Shortcut with an unset primary key.');

			// Get the Database Object for this Class
			$objDatabase = Shortcut::GetDatabase();


			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`shortcut`
				WHERE
					`shortcut_id` = ' . $objDatabase->SqlVariable($this->intShortcutId) . '');
		}

		/**
		 * Delete all Shortcuts
		 * @return void
		*/
		public static function DeleteAll() {
			// Get the Database Object for this Class
			$objDatabase = Shortcut::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				DELETE FROM
					`shortcut`');
		}

		/**
		 * Truncate shortcut table
		 * @return void
		*/
		public static function Truncate() {
			// Get the Database Object for this Class
			$objDatabase = Shortcut::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				TRUNCATE `shortcut`');
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
				case 'ShortcutId':
					/**
					 * Gets the value for intShortcutId (Read-Only PK)
					 * @return integer
					 */
					return $this->intShortcutId;

				case 'ModuleId':
					/**
					 * Gets the value for intModuleId (Not Null)
					 * @return integer
					 */
					return $this->intModuleId;

				case 'AuthorizationId':
					/**
					 * Gets the value for intAuthorizationId 
					 * @return integer
					 */
					return $this->intAuthorizationId;

				case 'ShortDescription':
					/**
					 * Gets the value for strShortDescription (Not Null)
					 * @return string
					 */
					return $this->strShortDescription;

				case 'Link':
					/**
					 * Gets the value for strLink (Not Null)
					 * @return string
					 */
					return $this->strLink;

				case 'ImagePath':
					/**
					 * Gets the value for strImagePath 
					 * @return string
					 */
					return $this->strImagePath;

				case 'EntityQtypeId':
					/**
					 * Gets the value for intEntityQtypeId (Not Null)
					 * @return integer
					 */
					return $this->intEntityQtypeId;

				case 'CreateFlag':
					/**
					 * Gets the value for blnCreateFlag (Not Null)
					 * @return boolean
					 */
					return $this->blnCreateFlag;


				///////////////////
				// Member Objects
				///////////////////
				case 'Module':
					/**
					 * Gets the value for the Module object referenced by intModuleId (Not Null)
					 * @return Module
					 */
					try {
						if ((!$this->objModule) && (!is_null($this->intModuleId)))
							$this->objModule = Module::Load($this->intModuleId);
						return $this->objModule;
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Authorization':
					/**
					 * Gets the value for the Authorization object referenced by intAuthorizationId 
					 * @return Authorization
					 */
					try {
						if ((!$this->objAuthorization) && (!is_null($this->intAuthorizationId)))
							$this->objAuthorization = Authorization::Load($this->intAuthorizationId);
						return $this->objAuthorization;
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
				case 'ModuleId':
					/**
					 * Sets the value for intModuleId (Not Null)
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						$this->objModule = null;
						return ($this->intModuleId = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'AuthorizationId':
					/**
					 * Sets the value for intAuthorizationId 
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						$this->objAuthorization = null;
						return ($this->intAuthorizationId = QType::Cast($mixValue, QType::Integer));
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

				case 'Link':
					/**
					 * Sets the value for strLink (Not Null)
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strLink = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'ImagePath':
					/**
					 * Sets the value for strImagePath 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strImagePath = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'EntityQtypeId':
					/**
					 * Sets the value for intEntityQtypeId (Not Null)
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						return ($this->intEntityQtypeId = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'CreateFlag':
					/**
					 * Sets the value for blnCreateFlag (Not Null)
					 * @param boolean $mixValue
					 * @return boolean
					 */
					try {
						return ($this->blnCreateFlag = QType::Cast($mixValue, QType::Boolean));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}


				///////////////////
				// Member Objects
				///////////////////
				case 'Module':
					/**
					 * Sets the value for the Module object referenced by intModuleId (Not Null)
					 * @param Module $mixValue
					 * @return Module
					 */
					if (is_null($mixValue)) {
						$this->intModuleId = null;
						$this->objModule = null;
						return null;
					} else {
						// Make sure $mixValue actually is a Module object
						try {
							$mixValue = QType::Cast($mixValue, 'Module');
						} catch (QInvalidCastException $objExc) {
							$objExc->IncrementOffset();
							throw $objExc;
						} 

						// Make sure $mixValue is a SAVED Module object
						if (is_null($mixValue->ModuleId))
							throw new QCallerException('Unable to set an unsaved Module for this Shortcut');

						// Update Local Member Variables
						$this->objModule = $mixValue;
						$this->intModuleId = $mixValue->ModuleId;

						// Return $mixValue
						return $mixValue;
					}
					break;

				case 'Authorization':
					/**
					 * Sets the value for the Authorization object referenced by intAuthorizationId 
					 * @param Authorization $mixValue
					 * @return Authorization
					 */
					if (is_null($mixValue)) {
						$this->intAuthorizationId = null;
						$this->objAuthorization = null;
						return null;
					} else {
						// Make sure $mixValue actually is a Authorization object
						try {
							$mixValue = QType::Cast($mixValue, 'Authorization');
						} catch (QInvalidCastException $objExc) {
							$objExc->IncrementOffset();
							throw $objExc;
						} 

						// Make sure $mixValue is a SAVED Authorization object
						if (is_null($mixValue->AuthorizationId))
							throw new QCallerException('Unable to set an unsaved Authorization for this Shortcut');

						// Update Local Member Variables
						$this->objAuthorization = $mixValue;
						$this->intAuthorizationId = $mixValue->AuthorizationId;

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
		 * Protected member variable that maps to the database PK Identity column shortcut.shortcut_id
		 * @var integer intShortcutId
		 */
		protected $intShortcutId;
		const ShortcutIdDefault = null;


		/**
		 * Protected member variable that maps to the database column shortcut.module_id
		 * @var integer intModuleId
		 */
		protected $intModuleId;
		const ModuleIdDefault = null;


		/**
		 * Protected member variable that maps to the database column shortcut.authorization_id
		 * @var integer intAuthorizationId
		 */
		protected $intAuthorizationId;
		const AuthorizationIdDefault = null;


		/**
		 * Protected member variable that maps to the database column shortcut.short_description
		 * @var string strShortDescription
		 */
		protected $strShortDescription;
		const ShortDescriptionMaxLength = 255;
		const ShortDescriptionDefault = null;


		/**
		 * Protected member variable that maps to the database column shortcut.link
		 * @var string strLink
		 */
		protected $strLink;
		const LinkMaxLength = 255;
		const LinkDefault = null;


		/**
		 * Protected member variable that maps to the database column shortcut.image_path
		 * @var string strImagePath
		 */
		protected $strImagePath;
		const ImagePathMaxLength = 255;
		const ImagePathDefault = null;


		/**
		 * Protected member variable that maps to the database column shortcut.entity_qtype_id
		 * @var integer intEntityQtypeId
		 */
		protected $intEntityQtypeId;
		const EntityQtypeIdDefault = null;


		/**
		 * Protected member variable that maps to the database column shortcut.create_flag
		 * @var boolean blnCreateFlag
		 */
		protected $blnCreateFlag;
		const CreateFlagDefault = null;


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
		 * in the database column shortcut.module_id.
		 *
		 * NOTE: Always use the Module property getter to correctly retrieve this Module object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var Module objModule
		 */
		protected $objModule;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column shortcut.authorization_id.
		 *
		 * NOTE: Always use the Authorization property getter to correctly retrieve this Authorization object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var Authorization objAuthorization
		 */
		protected $objAuthorization;






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
				$objQueryExpansion = new QQueryExpansion('Shortcut', 'shortcut', $objExpansionMap);
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
				$objQueryExpansion->AddFromItem(sprintf('LEFT JOIN `shortcut` AS `%s__%s` ON `%s`.`%s` = `%s__%s`.`shortcut_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias, $strParentAlias, $strAlias));

				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`shortcut_id` AS `%s__%s__shortcut_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`module_id` AS `%s__%s__module_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`authorization_id` AS `%s__%s__authorization_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`short_description` AS `%s__%s__short_description`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`link` AS `%s__%s__link`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`image_path` AS `%s__%s__image_path`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`entity_qtype_id` AS `%s__%s__entity_qtype_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`create_flag` AS `%s__%s__create_flag`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));

				$strParentAlias = $strParentAlias . '__' . $strAlias;
			}

			if (is_array($objExpansionMap))
				foreach ($objExpansionMap as $strKey=>$objValue) {
					switch ($strKey) {
						case 'module_id':
							try {
								Module::ExpandQuery($strParentAlias, $strKey, $objValue, $objQueryExpansion);
								break;
							} catch (QCallerException $objExc) {
								$objExc->IncrementOffset();
								throw $objExc;
							}
						case 'authorization_id':
							try {
								Authorization::ExpandQuery($strParentAlias, $strKey, $objValue, $objQueryExpansion);
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
		const ExpandModule = 'module_id';
		const ExpandAuthorization = 'authorization_id';




		////////////////////////////////////////
		// METHODS for WEB SERVICES
		////////////////////////////////////////

		public static function GetSoapComplexTypeXml() {
			$strToReturn = '<complexType name="Shortcut"><sequence>';
			$strToReturn .= '<element name="ShortcutId" type="xsd:int"/>';
			$strToReturn .= '<element name="Module" type="xsd1:Module"/>';
			$strToReturn .= '<element name="Authorization" type="xsd1:Authorization"/>';
			$strToReturn .= '<element name="ShortDescription" type="xsd:string"/>';
			$strToReturn .= '<element name="Link" type="xsd:string"/>';
			$strToReturn .= '<element name="ImagePath" type="xsd:string"/>';
			$strToReturn .= '<element name="EntityQtypeId" type="xsd:int"/>';
			$strToReturn .= '<element name="CreateFlag" type="xsd:boolean"/>';
			$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
			$strToReturn .= '</sequence></complexType>';
			return $strToReturn;
		}

		public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
			if (!array_key_exists('Shortcut', $strComplexTypeArray)) {
				$strComplexTypeArray['Shortcut'] = Shortcut::GetSoapComplexTypeXml();
				Module::AlterSoapComplexTypeArray($strComplexTypeArray);
				Authorization::AlterSoapComplexTypeArray($strComplexTypeArray);
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, Shortcut::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new Shortcut();
			if (property_exists($objSoapObject, 'ShortcutId'))
				$objToReturn->intShortcutId = $objSoapObject->ShortcutId;
			if ((property_exists($objSoapObject, 'Module')) &&
				($objSoapObject->Module))
				$objToReturn->Module = Module::GetObjectFromSoapObject($objSoapObject->Module);
			if ((property_exists($objSoapObject, 'Authorization')) &&
				($objSoapObject->Authorization))
				$objToReturn->Authorization = Authorization::GetObjectFromSoapObject($objSoapObject->Authorization);
			if (property_exists($objSoapObject, 'ShortDescription'))
				$objToReturn->strShortDescription = $objSoapObject->ShortDescription;
			if (property_exists($objSoapObject, 'Link'))
				$objToReturn->strLink = $objSoapObject->Link;
			if (property_exists($objSoapObject, 'ImagePath'))
				$objToReturn->strImagePath = $objSoapObject->ImagePath;
			if (property_exists($objSoapObject, 'EntityQtypeId'))
				$objToReturn->intEntityQtypeId = $objSoapObject->EntityQtypeId;
			if (property_exists($objSoapObject, 'CreateFlag'))
				$objToReturn->blnCreateFlag = $objSoapObject->CreateFlag;
			if (property_exists($objSoapObject, '__blnRestored'))
				$objToReturn->__blnRestored = $objSoapObject->__blnRestored;
			return $objToReturn;
		}

		public static function GetSoapArrayFromArray($objArray) {
			if (!$objArray)
				return null;

			$objArrayToReturn = array();

			foreach ($objArray as $objObject)
				array_push($objArrayToReturn, Shortcut::GetSoapObjectFromObject($objObject, true));

			return unserialize(serialize($objArrayToReturn));
		}

		public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
			if ($objObject->objModule)
				$objObject->objModule = Module::GetSoapObjectFromObject($objObject->objModule, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intModuleId = null;
			if ($objObject->objAuthorization)
				$objObject->objAuthorization = Authorization::GetSoapObjectFromObject($objObject->objAuthorization, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intAuthorizationId = null;
			return $objObject;
		}
	}





	/////////////////////////////////////
	// ADDITIONAL CLASSES for QCODO QUERY
	/////////////////////////////////////

	class QQNodeShortcut extends QQNode {
		protected $strTableName = 'shortcut';
		protected $strPrimaryKey = 'shortcut_id';
		protected $strClassName = 'Shortcut';
		public function __get($strName) {
			switch ($strName) {
				case 'ShortcutId':
					return new QQNode('shortcut_id', 'integer', $this);
				case 'ModuleId':
					return new QQNode('module_id', 'integer', $this);
				case 'Module':
					return new QQNodeModule('module_id', 'integer', $this);
				case 'AuthorizationId':
					return new QQNode('authorization_id', 'integer', $this);
				case 'Authorization':
					return new QQNodeAuthorization('authorization_id', 'integer', $this);
				case 'ShortDescription':
					return new QQNode('short_description', 'string', $this);
				case 'Link':
					return new QQNode('link', 'string', $this);
				case 'ImagePath':
					return new QQNode('image_path', 'string', $this);
				case 'EntityQtypeId':
					return new QQNode('entity_qtype_id', 'integer', $this);
				case 'CreateFlag':
					return new QQNode('create_flag', 'boolean', $this);

				case '_PrimaryKeyNode':
					return new QQNode('shortcut_id', 'integer', $this);
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

	class QQReverseReferenceNodeShortcut extends QQReverseReferenceNode {
		protected $strTableName = 'shortcut';
		protected $strPrimaryKey = 'shortcut_id';
		protected $strClassName = 'Shortcut';
		public function __get($strName) {
			switch ($strName) {
				case 'ShortcutId':
					return new QQNode('shortcut_id', 'integer', $this);
				case 'ModuleId':
					return new QQNode('module_id', 'integer', $this);
				case 'Module':
					return new QQNodeModule('module_id', 'integer', $this);
				case 'AuthorizationId':
					return new QQNode('authorization_id', 'integer', $this);
				case 'Authorization':
					return new QQNodeAuthorization('authorization_id', 'integer', $this);
				case 'ShortDescription':
					return new QQNode('short_description', 'string', $this);
				case 'Link':
					return new QQNode('link', 'string', $this);
				case 'ImagePath':
					return new QQNode('image_path', 'string', $this);
				case 'EntityQtypeId':
					return new QQNode('entity_qtype_id', 'integer', $this);
				case 'CreateFlag':
					return new QQNode('create_flag', 'boolean', $this);

				case '_PrimaryKeyNode':
					return new QQNode('shortcut_id', 'integer', $this);
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