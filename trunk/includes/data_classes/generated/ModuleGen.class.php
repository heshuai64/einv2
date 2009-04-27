<?php
	/**
	 * The abstract ModuleGen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the Module subclass which
	 * extends this ModuleGen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the Module class.
	 * 
	 * @package My Application
	 * @subpackage GeneratedDataObjects
	 * 
	 */
	class ModuleGen extends QBaseClass {
		///////////////////////////////
		// COMMON LOAD METHODS
		///////////////////////////////

		/**
		 * Load a Module from PK Info
		 * @param integer $intModuleId
		 * @return Module
		 */
		public static function Load($intModuleId) {
			// Use QuerySingle to Perform the Query
			return Module::QuerySingle(
				QQ::Equal(QQN::Module()->ModuleId, $intModuleId)
			);
		}

		/**
		 * Load all Modules
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Module[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			// Call Module::QueryArray to perform the LoadAll query
			try {
				return Module::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all Modules
		 * @return int
		 */
		public static function CountAll() {
			// Call Module::QueryCount to perform the CountAll query
			return Module::QueryCount(QQ::All());
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
			$objDatabase = Module::GetDatabase();

			// Create/Build out the QueryBuilder object with Module-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, 'module');
			Module::GetSelectFields($objQueryBuilder);
			$objQueryBuilder->AddFromItem('`module` AS `module`');

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
		 * Static Qcodo Query method to query for a single Module object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return Module the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Module::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query, Get the First Row, and Instantiate a new Module object
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return Module::InstantiateDbRow($objDbResult->GetNextRow());
		}

		/**
		 * Static Qcodo Query method to query for an array of Module objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return Module[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Module::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return Module::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
		}

		/**
		 * Static Qcodo Query method to query for a count of Module objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Module::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
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
			$objDatabase = Module::GetDatabase();

			// Lookup the QCache for This Query Statement
			$objCache = new QCache('query', 'module_' . serialize($strConditions));
			if (!($strQuery = $objCache->GetData())) {
				// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with Module-specific fields
				$objQueryBuilder = new QQueryBuilder($objDatabase);
				Module::GetSelectFields($objQueryBuilder);
				Module::GetFromFields($objQueryBuilder);

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
			return Module::InstantiateDbResult($objDbResult);
		}*/

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this Module
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null) {
			if ($strPrefix) {
				$strTableName = '`' . $strPrefix . '`';
				$strAliasPrefix = '`' . $strPrefix . '__';
			} else {
				$strTableName = '`module`';
				$strAliasPrefix = '`';
			}

			$objBuilder->AddSelectItem($strTableName . '.`module_id` AS ' . $strAliasPrefix . 'module_id`');
			$objBuilder->AddSelectItem($strTableName . '.`short_description` AS ' . $strAliasPrefix . 'short_description`');
		}



		///////////////////////////////
		// INSTANTIATION-RELATED METHODS
		///////////////////////////////

		/**
		 * Instantiate a Module from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this Module::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param DatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @return Module
		*/
		public static function InstantiateDbRow($objDbRow, $strAliasPrefix = null, $strExpandAsArrayNodes = null, $objPreviousItem = null) {
			// If blank row, return null
			if (!$objDbRow)
				return null;

			// See if we're doing an array expansion on the previous item
			if (($strExpandAsArrayNodes) && ($objPreviousItem) &&
				($objPreviousItem->intModuleId == $objDbRow->GetColumn($strAliasPrefix . 'module_id', 'Integer'))) {

				// We are.  Now, prepare to check for ExpandAsArray clauses
				$blnExpandedViaArray = false;
				if (!$strAliasPrefix)
					$strAliasPrefix = 'module__';


				if ((array_key_exists($strAliasPrefix . 'rolemodule__role_module_id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'rolemodule__role_module_id')))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objRoleModuleArray)) {
						$objPreviousChildItem = $objPreviousItem->_objRoleModuleArray[$intPreviousChildItemCount - 1];
						$objChildItem = RoleModule::InstantiateDbRow($objDbRow, $strAliasPrefix . 'rolemodule__', $strExpandAsArrayNodes, $objPreviousChildItem);
						if ($objChildItem)
							array_push($objPreviousItem->_objRoleModuleArray, $objChildItem);
					} else
						array_push($objPreviousItem->_objRoleModuleArray, RoleModule::InstantiateDbRow($objDbRow, $strAliasPrefix . 'rolemodule__', $strExpandAsArrayNodes));
					$blnExpandedViaArray = true;
				}

				if ((array_key_exists($strAliasPrefix . 'shortcut__shortcut_id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'shortcut__shortcut_id')))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objShortcutArray)) {
						$objPreviousChildItem = $objPreviousItem->_objShortcutArray[$intPreviousChildItemCount - 1];
						$objChildItem = Shortcut::InstantiateDbRow($objDbRow, $strAliasPrefix . 'shortcut__', $strExpandAsArrayNodes, $objPreviousChildItem);
						if ($objChildItem)
							array_push($objPreviousItem->_objShortcutArray, $objChildItem);
					} else
						array_push($objPreviousItem->_objShortcutArray, Shortcut::InstantiateDbRow($objDbRow, $strAliasPrefix . 'shortcut__', $strExpandAsArrayNodes));
					$blnExpandedViaArray = true;
				}

				// Either return false to signal array expansion, or check-to-reset the Alias prefix and move on
				if ($blnExpandedViaArray)
					return false;
				else if ($strAliasPrefix == 'module__')
					$strAliasPrefix = null;
			}

			// Create a new instance of the Module object
			$objToReturn = new Module();
			$objToReturn->__blnRestored = true;

			$objToReturn->intModuleId = $objDbRow->GetColumn($strAliasPrefix . 'module_id', 'Integer');
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
				$strAliasPrefix = 'module__';




			// Check for RoleModule Virtual Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'rolemodule__role_module_id'))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'rolemodule__role_module_id', $strExpandAsArrayNodes)))
					array_push($objToReturn->_objRoleModuleArray, RoleModule::InstantiateDbRow($objDbRow, $strAliasPrefix . 'rolemodule__', $strExpandAsArrayNodes));
				else
					$objToReturn->_objRoleModule = RoleModule::InstantiateDbRow($objDbRow, $strAliasPrefix . 'rolemodule__', $strExpandAsArrayNodes);
			}

			// Check for Shortcut Virtual Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'shortcut__shortcut_id'))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'shortcut__shortcut_id', $strExpandAsArrayNodes)))
					array_push($objToReturn->_objShortcutArray, Shortcut::InstantiateDbRow($objDbRow, $strAliasPrefix . 'shortcut__', $strExpandAsArrayNodes));
				else
					$objToReturn->_objShortcut = Shortcut::InstantiateDbRow($objDbRow, $strAliasPrefix . 'shortcut__', $strExpandAsArrayNodes);
			}

			return $objToReturn;
		}

		/**
		 * Instantiate an array of Modules from a Database Result
		 * @param DatabaseResultBase $objDbResult
		 * @return Module[]
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
					$objItem = Module::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
					if ($objItem) {
						array_push($objToReturn, $objItem);
						$objLastRowItem = $objItem;
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					array_push($objToReturn, Module::InstantiateDbRow($objDbRow));
			}

			return $objToReturn;
		}



		///////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Single Load and Array)
		///////////////////////////////////////////////////
			
		/**
		 * Load a single Module object,
		 * by ModuleId Index(es)
		 * @param integer $intModuleId
		 * @return Module
		*/
		public static function LoadByModuleId($intModuleId) {
			return Module::QuerySingle(
				QQ::Equal(QQN::Module()->ModuleId, $intModuleId)
			);
		}



		////////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Array via Many to Many)
		////////////////////////////////////////////////////



		//////////////////
		// SAVE AND DELETE
		//////////////////

		/**
		 * Save this Module
		 * @param bool $blnForceInsert
		 * @param bool $blnForceUpdate
		 * @return int
		*/
		public function Save($blnForceInsert = false, $blnForceUpdate = false) {
			// Get the Database Object for this Class
			$objDatabase = Module::GetDatabase();

			$mixToReturn = null;

			try {
				if ((!$this->__blnRestored) || ($blnForceInsert)) {
					// Perform an INSERT query
					$objDatabase->NonQuery('
						INSERT INTO `module` (
							`short_description`
						) VALUES (
							' . $objDatabase->SqlVariable($this->strShortDescription) . '
						)
					');

					// Update Identity column and return its value
					$mixToReturn = $this->intModuleId = $objDatabase->InsertId('module', 'module_id');
				} else {
					// Perform an UPDATE query

					// First checking for Optimistic Locking constraints (if applicable)

					// Perform the UPDATE query
					$objDatabase->NonQuery('
						UPDATE
							`module`
						SET
							`short_description` = ' . $objDatabase->SqlVariable($this->strShortDescription) . '
						WHERE
							`module_id` = ' . $objDatabase->SqlVariable($this->intModuleId) . '
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
		 * Delete this Module
		 * @return void
		*/
		public function Delete() {
			if ((is_null($this->intModuleId)))
				throw new QUndefinedPrimaryKeyException('Cannot delete this Module with an unset primary key.');

			// Get the Database Object for this Class
			$objDatabase = Module::GetDatabase();


			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`module`
				WHERE
					`module_id` = ' . $objDatabase->SqlVariable($this->intModuleId) . '');
		}

		/**
		 * Delete all Modules
		 * @return void
		*/
		public static function DeleteAll() {
			// Get the Database Object for this Class
			$objDatabase = Module::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				DELETE FROM
					`module`');
		}

		/**
		 * Truncate module table
		 * @return void
		*/
		public static function Truncate() {
			// Get the Database Object for this Class
			$objDatabase = Module::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				TRUNCATE `module`');
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
				case 'ModuleId':
					/**
					 * Gets the value for intModuleId (Read-Only PK)
					 * @return integer
					 */
					return $this->intModuleId;

				case 'ShortDescription':
					/**
					 * Gets the value for strShortDescription 
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

				case '_RoleModule':
					/**
					 * Gets the value for the private _objRoleModule (Read-Only)
					 * if set due to an expansion on the role_module.module_id reverse relationship
					 * @return RoleModule
					 */
					return $this->_objRoleModule;

				case '_RoleModuleArray':
					/**
					 * Gets the value for the private _objRoleModuleArray (Read-Only)
					 * if set due to an ExpandAsArray on the role_module.module_id reverse relationship
					 * @return RoleModule[]
					 */
					return (array) $this->_objRoleModuleArray;

				case '_Shortcut':
					/**
					 * Gets the value for the private _objShortcut (Read-Only)
					 * if set due to an expansion on the shortcut.module_id reverse relationship
					 * @return Shortcut
					 */
					return $this->_objShortcut;

				case '_ShortcutArray':
					/**
					 * Gets the value for the private _objShortcutArray (Read-Only)
					 * if set due to an ExpandAsArray on the shortcut.module_id reverse relationship
					 * @return Shortcut[]
					 */
					return (array) $this->_objShortcutArray;

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

			
		
		// Related Objects' Methods for RoleModule
		//-------------------------------------------------------------------

		/**
		 * Gets all associated RoleModules as an array of RoleModule objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return RoleModule[]
		*/ 
		public function GetRoleModuleArray($objOptionalClauses = null) {
			if ((is_null($this->intModuleId)))
				return array();

			try {
				return RoleModule::LoadArrayByModuleId($this->intModuleId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated RoleModules
		 * @return int
		*/ 
		public function CountRoleModules() {
			if ((is_null($this->intModuleId)))
				return 0;

			return RoleModule::CountByModuleId($this->intModuleId);
		}

		/**
		 * Associates a RoleModule
		 * @param RoleModule $objRoleModule
		 * @return void
		*/ 
		public function AssociateRoleModule(RoleModule $objRoleModule) {
			if ((is_null($this->intModuleId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateRoleModule on this unsaved Module.');
			if ((is_null($objRoleModule->RoleModuleId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateRoleModule on this Module with an unsaved RoleModule.');

			// Get the Database Object for this Class
			$objDatabase = Module::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`role_module`
				SET
					`module_id` = ' . $objDatabase->SqlVariable($this->intModuleId) . '
				WHERE
					`role_module_id` = ' . $objDatabase->SqlVariable($objRoleModule->RoleModuleId) . '
			');
		}

		/**
		 * Unassociates a RoleModule
		 * @param RoleModule $objRoleModule
		 * @return void
		*/ 
		public function UnassociateRoleModule(RoleModule $objRoleModule) {
			if ((is_null($this->intModuleId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateRoleModule on this unsaved Module.');
			if ((is_null($objRoleModule->RoleModuleId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateRoleModule on this Module with an unsaved RoleModule.');

			// Get the Database Object for this Class
			$objDatabase = Module::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`role_module`
				SET
					`module_id` = null
				WHERE
					`role_module_id` = ' . $objDatabase->SqlVariable($objRoleModule->RoleModuleId) . ' AND
					`module_id` = ' . $objDatabase->SqlVariable($this->intModuleId) . '
			');
		}

		/**
		 * Unassociates all RoleModules
		 * @return void
		*/ 
		public function UnassociateAllRoleModules() {
			if ((is_null($this->intModuleId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateRoleModule on this unsaved Module.');

			// Get the Database Object for this Class
			$objDatabase = Module::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`role_module`
				SET
					`module_id` = null
				WHERE
					`module_id` = ' . $objDatabase->SqlVariable($this->intModuleId) . '
			');
		}

		/**
		 * Deletes an associated RoleModule
		 * @param RoleModule $objRoleModule
		 * @return void
		*/ 
		public function DeleteAssociatedRoleModule(RoleModule $objRoleModule) {
			if ((is_null($this->intModuleId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateRoleModule on this unsaved Module.');
			if ((is_null($objRoleModule->RoleModuleId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateRoleModule on this Module with an unsaved RoleModule.');

			// Get the Database Object for this Class
			$objDatabase = Module::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`role_module`
				WHERE
					`role_module_id` = ' . $objDatabase->SqlVariable($objRoleModule->RoleModuleId) . ' AND
					`module_id` = ' . $objDatabase->SqlVariable($this->intModuleId) . '
			');
		}

		/**
		 * Deletes all associated RoleModules
		 * @return void
		*/ 
		public function DeleteAllRoleModules() {
			if ((is_null($this->intModuleId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateRoleModule on this unsaved Module.');

			// Get the Database Object for this Class
			$objDatabase = Module::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`role_module`
				WHERE
					`module_id` = ' . $objDatabase->SqlVariable($this->intModuleId) . '
			');
		}

			
		
		// Related Objects' Methods for Shortcut
		//-------------------------------------------------------------------

		/**
		 * Gets all associated Shortcuts as an array of Shortcut objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Shortcut[]
		*/ 
		public function GetShortcutArray($objOptionalClauses = null) {
			if ((is_null($this->intModuleId)))
				return array();

			try {
				return Shortcut::LoadArrayByModuleId($this->intModuleId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated Shortcuts
		 * @return int
		*/ 
		public function CountShortcuts() {
			if ((is_null($this->intModuleId)))
				return 0;

			return Shortcut::CountByModuleId($this->intModuleId);
		}

		/**
		 * Associates a Shortcut
		 * @param Shortcut $objShortcut
		 * @return void
		*/ 
		public function AssociateShortcut(Shortcut $objShortcut) {
			if ((is_null($this->intModuleId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateShortcut on this unsaved Module.');
			if ((is_null($objShortcut->ShortcutId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateShortcut on this Module with an unsaved Shortcut.');

			// Get the Database Object for this Class
			$objDatabase = Module::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`shortcut`
				SET
					`module_id` = ' . $objDatabase->SqlVariable($this->intModuleId) . '
				WHERE
					`shortcut_id` = ' . $objDatabase->SqlVariable($objShortcut->ShortcutId) . '
			');
		}

		/**
		 * Unassociates a Shortcut
		 * @param Shortcut $objShortcut
		 * @return void
		*/ 
		public function UnassociateShortcut(Shortcut $objShortcut) {
			if ((is_null($this->intModuleId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateShortcut on this unsaved Module.');
			if ((is_null($objShortcut->ShortcutId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateShortcut on this Module with an unsaved Shortcut.');

			// Get the Database Object for this Class
			$objDatabase = Module::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`shortcut`
				SET
					`module_id` = null
				WHERE
					`shortcut_id` = ' . $objDatabase->SqlVariable($objShortcut->ShortcutId) . ' AND
					`module_id` = ' . $objDatabase->SqlVariable($this->intModuleId) . '
			');
		}

		/**
		 * Unassociates all Shortcuts
		 * @return void
		*/ 
		public function UnassociateAllShortcuts() {
			if ((is_null($this->intModuleId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateShortcut on this unsaved Module.');

			// Get the Database Object for this Class
			$objDatabase = Module::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`shortcut`
				SET
					`module_id` = null
				WHERE
					`module_id` = ' . $objDatabase->SqlVariable($this->intModuleId) . '
			');
		}

		/**
		 * Deletes an associated Shortcut
		 * @param Shortcut $objShortcut
		 * @return void
		*/ 
		public function DeleteAssociatedShortcut(Shortcut $objShortcut) {
			if ((is_null($this->intModuleId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateShortcut on this unsaved Module.');
			if ((is_null($objShortcut->ShortcutId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateShortcut on this Module with an unsaved Shortcut.');

			// Get the Database Object for this Class
			$objDatabase = Module::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`shortcut`
				WHERE
					`shortcut_id` = ' . $objDatabase->SqlVariable($objShortcut->ShortcutId) . ' AND
					`module_id` = ' . $objDatabase->SqlVariable($this->intModuleId) . '
			');
		}

		/**
		 * Deletes all associated Shortcuts
		 * @return void
		*/ 
		public function DeleteAllShortcuts() {
			if ((is_null($this->intModuleId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateShortcut on this unsaved Module.');

			// Get the Database Object for this Class
			$objDatabase = Module::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`shortcut`
				WHERE
					`module_id` = ' . $objDatabase->SqlVariable($this->intModuleId) . '
			');
		}




		///////////////////////////////////////////////////////////////////////
		// PROTECTED MEMBER VARIABLES and TEXT FIELD MAXLENGTHS (if applicable)
		///////////////////////////////////////////////////////////////////////
		
		/**
		 * Protected member variable that maps to the database PK Identity column module.module_id
		 * @var integer intModuleId
		 */
		protected $intModuleId;
		const ModuleIdDefault = null;


		/**
		 * Protected member variable that maps to the database column module.short_description
		 * @var string strShortDescription
		 */
		protected $strShortDescription;
		const ShortDescriptionMaxLength = 255;
		const ShortDescriptionDefault = null;


		/**
		 * Private member variable that stores a reference to a single RoleModule object
		 * (of type RoleModule), if this Module object was restored with
		 * an expansion on the role_module association table.
		 * @var RoleModule _objRoleModule;
		 */
		private $_objRoleModule;

		/**
		 * Private member variable that stores a reference to an array of RoleModule objects
		 * (of type RoleModule[]), if this Module object was restored with
		 * an ExpandAsArray on the role_module association table.
		 * @var RoleModule[] _objRoleModuleArray;
		 */
		private $_objRoleModuleArray = array();

		/**
		 * Private member variable that stores a reference to a single Shortcut object
		 * (of type Shortcut), if this Module object was restored with
		 * an expansion on the shortcut association table.
		 * @var Shortcut _objShortcut;
		 */
		private $_objShortcut;

		/**
		 * Private member variable that stores a reference to an array of Shortcut objects
		 * (of type Shortcut[]), if this Module object was restored with
		 * an ExpandAsArray on the shortcut association table.
		 * @var Shortcut[] _objShortcutArray;
		 */
		private $_objShortcutArray = array();

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
				$objQueryExpansion = new QQueryExpansion('Module', 'module', $objExpansionMap);
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
				$objQueryExpansion->AddFromItem(sprintf('LEFT JOIN `module` AS `%s__%s` ON `%s`.`%s` = `%s__%s`.`module_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias, $strParentAlias, $strAlias));

				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`module_id` AS `%s__%s__module_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
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
			$strToReturn = '<complexType name="Module"><sequence>';
			$strToReturn .= '<element name="ModuleId" type="xsd:int"/>';
			$strToReturn .= '<element name="ShortDescription" type="xsd:string"/>';
			$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
			$strToReturn .= '</sequence></complexType>';
			return $strToReturn;
		}

		public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
			if (!array_key_exists('Module', $strComplexTypeArray)) {
				$strComplexTypeArray['Module'] = Module::GetSoapComplexTypeXml();
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, Module::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new Module();
			if (property_exists($objSoapObject, 'ModuleId'))
				$objToReturn->intModuleId = $objSoapObject->ModuleId;
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
				array_push($objArrayToReturn, Module::GetSoapObjectFromObject($objObject, true));

			return unserialize(serialize($objArrayToReturn));
		}

		public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
			return $objObject;
		}
	}





	/////////////////////////////////////
	// ADDITIONAL CLASSES for QCODO QUERY
	/////////////////////////////////////

	class QQNodeModule extends QQNode {
		protected $strTableName = 'module';
		protected $strPrimaryKey = 'module_id';
		protected $strClassName = 'Module';
		public function __get($strName) {
			switch ($strName) {
				case 'ModuleId':
					return new QQNode('module_id', 'integer', $this);
				case 'ShortDescription':
					return new QQNode('short_description', 'string', $this);
				case 'RoleModule':
					return new QQReverseReferenceNodeRoleModule($this, 'rolemodule', 'reverse_reference', 'module_id');
				case 'Shortcut':
					return new QQReverseReferenceNodeShortcut($this, 'shortcut', 'reverse_reference', 'module_id');

				case '_PrimaryKeyNode':
					return new QQNode('module_id', 'integer', $this);
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

	class QQReverseReferenceNodeModule extends QQReverseReferenceNode {
		protected $strTableName = 'module';
		protected $strPrimaryKey = 'module_id';
		protected $strClassName = 'Module';
		public function __get($strName) {
			switch ($strName) {
				case 'ModuleId':
					return new QQNode('module_id', 'integer', $this);
				case 'ShortDescription':
					return new QQNode('short_description', 'string', $this);
				case 'RoleModule':
					return new QQReverseReferenceNodeRoleModule($this, 'rolemodule', 'reverse_reference', 'module_id');
				case 'Shortcut':
					return new QQReverseReferenceNodeShortcut($this, 'shortcut', 'reverse_reference', 'module_id');

				case '_PrimaryKeyNode':
					return new QQNode('module_id', 'integer', $this);
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