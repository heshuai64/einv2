<?php
	/**
	 * The abstract RoleModuleGen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the RoleModule subclass which
	 * extends this RoleModuleGen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the RoleModule class.
	 * 
	 * @package My Application
	 * @subpackage GeneratedDataObjects
	 * 
	 */
	class RoleModuleGen extends QBaseClass {
		///////////////////////////////
		// COMMON LOAD METHODS
		///////////////////////////////

		/**
		 * Load a RoleModule from PK Info
		 * @param integer $intRoleModuleId
		 * @return RoleModule
		 */
		public static function Load($intRoleModuleId) {
			// Use QuerySingle to Perform the Query
			return RoleModule::QuerySingle(
				QQ::Equal(QQN::RoleModule()->RoleModuleId, $intRoleModuleId)
			);
		}

		/**
		 * Load all RoleModules
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return RoleModule[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			// Call RoleModule::QueryArray to perform the LoadAll query
			try {
				return RoleModule::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all RoleModules
		 * @return int
		 */
		public static function CountAll() {
			// Call RoleModule::QueryCount to perform the CountAll query
			return RoleModule::QueryCount(QQ::All());
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
			$objDatabase = RoleModule::GetDatabase();

			// Create/Build out the QueryBuilder object with RoleModule-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, 'role_module');
			RoleModule::GetSelectFields($objQueryBuilder);
			$objQueryBuilder->AddFromItem('`role_module` AS `role_module`');

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
		 * Static Qcodo Query method to query for a single RoleModule object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return RoleModule the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = RoleModule::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query, Get the First Row, and Instantiate a new RoleModule object
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return RoleModule::InstantiateDbRow($objDbResult->GetNextRow());
		}

		/**
		 * Static Qcodo Query method to query for an array of RoleModule objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return RoleModule[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = RoleModule::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return RoleModule::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
		}

		/**
		 * Static Qcodo Query method to query for a count of RoleModule objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = RoleModule::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
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
			$objDatabase = RoleModule::GetDatabase();

			// Lookup the QCache for This Query Statement
			$objCache = new QCache('query', 'role_module_' . serialize($strConditions));
			if (!($strQuery = $objCache->GetData())) {
				// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with RoleModule-specific fields
				$objQueryBuilder = new QQueryBuilder($objDatabase);
				RoleModule::GetSelectFields($objQueryBuilder);
				RoleModule::GetFromFields($objQueryBuilder);

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
			return RoleModule::InstantiateDbResult($objDbResult);
		}*/

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this RoleModule
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null) {
			if ($strPrefix) {
				$strTableName = '`' . $strPrefix . '`';
				$strAliasPrefix = '`' . $strPrefix . '__';
			} else {
				$strTableName = '`role_module`';
				$strAliasPrefix = '`';
			}

			$objBuilder->AddSelectItem($strTableName . '.`role_module_id` AS ' . $strAliasPrefix . 'role_module_id`');
			$objBuilder->AddSelectItem($strTableName . '.`role_id` AS ' . $strAliasPrefix . 'role_id`');
			$objBuilder->AddSelectItem($strTableName . '.`module_id` AS ' . $strAliasPrefix . 'module_id`');
			$objBuilder->AddSelectItem($strTableName . '.`access_flag` AS ' . $strAliasPrefix . 'access_flag`');
			$objBuilder->AddSelectItem($strTableName . '.`created_by` AS ' . $strAliasPrefix . 'created_by`');
			$objBuilder->AddSelectItem($strTableName . '.`creation_date` AS ' . $strAliasPrefix . 'creation_date`');
			$objBuilder->AddSelectItem($strTableName . '.`modified_by` AS ' . $strAliasPrefix . 'modified_by`');
			$objBuilder->AddSelectItem($strTableName . '.`modified_date` AS ' . $strAliasPrefix . 'modified_date`');
		}



		///////////////////////////////
		// INSTANTIATION-RELATED METHODS
		///////////////////////////////

		/**
		 * Instantiate a RoleModule from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this RoleModule::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param DatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @return RoleModule
		*/
		public static function InstantiateDbRow($objDbRow, $strAliasPrefix = null, $strExpandAsArrayNodes = null, $objPreviousItem = null) {
			// If blank row, return null
			if (!$objDbRow)
				return null;

			// See if we're doing an array expansion on the previous item
			if (($strExpandAsArrayNodes) && ($objPreviousItem) &&
				($objPreviousItem->intRoleModuleId == $objDbRow->GetColumn($strAliasPrefix . 'role_module_id', 'Integer'))) {

				// We are.  Now, prepare to check for ExpandAsArray clauses
				$blnExpandedViaArray = false;
				if (!$strAliasPrefix)
					$strAliasPrefix = 'role_module__';


				if ((array_key_exists($strAliasPrefix . 'rolemoduleauthorization__role_module_authorization_id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'rolemoduleauthorization__role_module_authorization_id')))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objRoleModuleAuthorizationArray)) {
						$objPreviousChildItem = $objPreviousItem->_objRoleModuleAuthorizationArray[$intPreviousChildItemCount - 1];
						$objChildItem = RoleModuleAuthorization::InstantiateDbRow($objDbRow, $strAliasPrefix . 'rolemoduleauthorization__', $strExpandAsArrayNodes, $objPreviousChildItem);
						if ($objChildItem)
							array_push($objPreviousItem->_objRoleModuleAuthorizationArray, $objChildItem);
					} else
						array_push($objPreviousItem->_objRoleModuleAuthorizationArray, RoleModuleAuthorization::InstantiateDbRow($objDbRow, $strAliasPrefix . 'rolemoduleauthorization__', $strExpandAsArrayNodes));
					$blnExpandedViaArray = true;
				}

				// Either return false to signal array expansion, or check-to-reset the Alias prefix and move on
				if ($blnExpandedViaArray)
					return false;
				else if ($strAliasPrefix == 'role_module__')
					$strAliasPrefix = null;
			}

			// Create a new instance of the RoleModule object
			$objToReturn = new RoleModule();
			$objToReturn->__blnRestored = true;

			$objToReturn->intRoleModuleId = $objDbRow->GetColumn($strAliasPrefix . 'role_module_id', 'Integer');
			$objToReturn->intRoleId = $objDbRow->GetColumn($strAliasPrefix . 'role_id', 'Integer');
			$objToReturn->intModuleId = $objDbRow->GetColumn($strAliasPrefix . 'module_id', 'Integer');
			$objToReturn->blnAccessFlag = $objDbRow->GetColumn($strAliasPrefix . 'access_flag', 'Bit');
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
				$strAliasPrefix = 'role_module__';

			// Check for Role Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'role_id__role_id')))
				$objToReturn->objRole = Role::InstantiateDbRow($objDbRow, $strAliasPrefix . 'role_id__', $strExpandAsArrayNodes);

			// Check for Module Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'module_id__module_id')))
				$objToReturn->objModule = Module::InstantiateDbRow($objDbRow, $strAliasPrefix . 'module_id__', $strExpandAsArrayNodes);

			// Check for CreatedByObject Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'created_by__user_account_id')))
				$objToReturn->objCreatedByObject = UserAccount::InstantiateDbRow($objDbRow, $strAliasPrefix . 'created_by__', $strExpandAsArrayNodes);

			// Check for ModifiedByObject Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'modified_by__user_account_id')))
				$objToReturn->objModifiedByObject = UserAccount::InstantiateDbRow($objDbRow, $strAliasPrefix . 'modified_by__', $strExpandAsArrayNodes);




			// Check for RoleModuleAuthorization Virtual Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'rolemoduleauthorization__role_module_authorization_id'))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'rolemoduleauthorization__role_module_authorization_id', $strExpandAsArrayNodes)))
					array_push($objToReturn->_objRoleModuleAuthorizationArray, RoleModuleAuthorization::InstantiateDbRow($objDbRow, $strAliasPrefix . 'rolemoduleauthorization__', $strExpandAsArrayNodes));
				else
					$objToReturn->_objRoleModuleAuthorization = RoleModuleAuthorization::InstantiateDbRow($objDbRow, $strAliasPrefix . 'rolemoduleauthorization__', $strExpandAsArrayNodes);
			}

			return $objToReturn;
		}

		/**
		 * Instantiate an array of RoleModules from a Database Result
		 * @param DatabaseResultBase $objDbResult
		 * @return RoleModule[]
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
					$objItem = RoleModule::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
					if ($objItem) {
						array_push($objToReturn, $objItem);
						$objLastRowItem = $objItem;
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					array_push($objToReturn, RoleModule::InstantiateDbRow($objDbRow));
			}

			return $objToReturn;
		}



		///////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Single Load and Array)
		///////////////////////////////////////////////////
			
		/**
		 * Load a single RoleModule object,
		 * by RoleModuleId Index(es)
		 * @param integer $intRoleModuleId
		 * @return RoleModule
		*/
		public static function LoadByRoleModuleId($intRoleModuleId) {
			return RoleModule::QuerySingle(
				QQ::Equal(QQN::RoleModule()->RoleModuleId, $intRoleModuleId)
			);
		}
			
		/**
		 * Load an array of RoleModule objects,
		 * by RoleId Index(es)
		 * @param integer $intRoleId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return RoleModule[]
		*/
		public static function LoadArrayByRoleId($intRoleId, $objOptionalClauses = null) {
			// Call RoleModule::QueryArray to perform the LoadArrayByRoleId query
			try {
				return RoleModule::QueryArray(
					QQ::Equal(QQN::RoleModule()->RoleId, $intRoleId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count RoleModules
		 * by RoleId Index(es)
		 * @param integer $intRoleId
		 * @return int
		*/
		public static function CountByRoleId($intRoleId) {
			// Call RoleModule::QueryCount to perform the CountByRoleId query
			return RoleModule::QueryCount(
				QQ::Equal(QQN::RoleModule()->RoleId, $intRoleId)
			);
		}
			
		/**
		 * Load an array of RoleModule objects,
		 * by ModuleId Index(es)
		 * @param integer $intModuleId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return RoleModule[]
		*/
		public static function LoadArrayByModuleId($intModuleId, $objOptionalClauses = null) {
			// Call RoleModule::QueryArray to perform the LoadArrayByModuleId query
			try {
				return RoleModule::QueryArray(
					QQ::Equal(QQN::RoleModule()->ModuleId, $intModuleId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count RoleModules
		 * by ModuleId Index(es)
		 * @param integer $intModuleId
		 * @return int
		*/
		public static function CountByModuleId($intModuleId) {
			// Call RoleModule::QueryCount to perform the CountByModuleId query
			return RoleModule::QueryCount(
				QQ::Equal(QQN::RoleModule()->ModuleId, $intModuleId)
			);
		}
			
		/**
		 * Load an array of RoleModule objects,
		 * by CreatedBy Index(es)
		 * @param integer $intCreatedBy
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return RoleModule[]
		*/
		public static function LoadArrayByCreatedBy($intCreatedBy, $objOptionalClauses = null) {
			// Call RoleModule::QueryArray to perform the LoadArrayByCreatedBy query
			try {
				return RoleModule::QueryArray(
					QQ::Equal(QQN::RoleModule()->CreatedBy, $intCreatedBy),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count RoleModules
		 * by CreatedBy Index(es)
		 * @param integer $intCreatedBy
		 * @return int
		*/
		public static function CountByCreatedBy($intCreatedBy) {
			// Call RoleModule::QueryCount to perform the CountByCreatedBy query
			return RoleModule::QueryCount(
				QQ::Equal(QQN::RoleModule()->CreatedBy, $intCreatedBy)
			);
		}
			
		/**
		 * Load an array of RoleModule objects,
		 * by ModifiedBy Index(es)
		 * @param integer $intModifiedBy
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return RoleModule[]
		*/
		public static function LoadArrayByModifiedBy($intModifiedBy, $objOptionalClauses = null) {
			// Call RoleModule::QueryArray to perform the LoadArrayByModifiedBy query
			try {
				return RoleModule::QueryArray(
					QQ::Equal(QQN::RoleModule()->ModifiedBy, $intModifiedBy),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count RoleModules
		 * by ModifiedBy Index(es)
		 * @param integer $intModifiedBy
		 * @return int
		*/
		public static function CountByModifiedBy($intModifiedBy) {
			// Call RoleModule::QueryCount to perform the CountByModifiedBy query
			return RoleModule::QueryCount(
				QQ::Equal(QQN::RoleModule()->ModifiedBy, $intModifiedBy)
			);
		}



		////////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Array via Many to Many)
		////////////////////////////////////////////////////



		//////////////////
		// SAVE AND DELETE
		//////////////////

		/**
		 * Save this RoleModule
		 * @param bool $blnForceInsert
		 * @param bool $blnForceUpdate
		 * @return int
		*/
		public function Save($blnForceInsert = false, $blnForceUpdate = false) {
			// Get the Database Object for this Class
			$objDatabase = RoleModule::GetDatabase();

			$mixToReturn = null;

			try {
				if ((!$this->__blnRestored) || ($blnForceInsert)) {
					// Perform an INSERT query
					$objDatabase->NonQuery('
						INSERT INTO `role_module` (
							`role_id`,
							`module_id`,
							`access_flag`,
							`created_by`,
							`creation_date`,
							`modified_by`
						) VALUES (
							' . $objDatabase->SqlVariable($this->intRoleId) . ',
							' . $objDatabase->SqlVariable($this->intModuleId) . ',
							' . $objDatabase->SqlVariable($this->blnAccessFlag) . ',
							' . $objDatabase->SqlVariable($this->intCreatedBy) . ',
							' . $objDatabase->SqlVariable($this->dttCreationDate) . ',
							' . $objDatabase->SqlVariable($this->intModifiedBy) . '
						)
					');

					// Update Identity column and return its value
					$mixToReturn = $this->intRoleModuleId = $objDatabase->InsertId('role_module', 'role_module_id');
				} else {
					// Perform an UPDATE query

					// First checking for Optimistic Locking constraints (if applicable)
					if (!$blnForceUpdate) {
						// Perform the Optimistic Locking check
						$objResult = $objDatabase->Query('
							SELECT
								`modified_date`
							FROM
								`role_module`
							WHERE
								`role_module_id` = ' . $objDatabase->SqlVariable($this->intRoleModuleId) . '
						');
						
						$objRow = $objResult->FetchArray();
						if ($objRow[0] != $this->strModifiedDate)
							throw new QExtendedOptimisticLockingException('RoleModule', $this->intRoleModuleId);
					}

					// Perform the UPDATE query
					$objDatabase->NonQuery('
						UPDATE
							`role_module`
						SET
							`role_id` = ' . $objDatabase->SqlVariable($this->intRoleId) . ',
							`module_id` = ' . $objDatabase->SqlVariable($this->intModuleId) . ',
							`access_flag` = ' . $objDatabase->SqlVariable($this->blnAccessFlag) . ',
							`created_by` = ' . $objDatabase->SqlVariable($this->intCreatedBy) . ',
							`creation_date` = ' . $objDatabase->SqlVariable($this->dttCreationDate) . ',
							`modified_by` = ' . $objDatabase->SqlVariable($this->intModifiedBy) . '
						WHERE
							`role_module_id` = ' . $objDatabase->SqlVariable($this->intRoleModuleId) . '
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
					`role_module`
				WHERE
					`role_module_id` = ' . $objDatabase->SqlVariable($this->intRoleModuleId) . '
			');
						
			$objRow = $objResult->FetchArray();
			$this->strModifiedDate = $objRow[0];

			// Return 
			return $mixToReturn;
		}

				/**
		 * Delete this RoleModule
		 * @return void
		*/
		public function Delete() {
			if ((is_null($this->intRoleModuleId)))
				throw new QUndefinedPrimaryKeyException('Cannot delete this RoleModule with an unset primary key.');

			// Get the Database Object for this Class
			$objDatabase = RoleModule::GetDatabase();


			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`role_module`
				WHERE
					`role_module_id` = ' . $objDatabase->SqlVariable($this->intRoleModuleId) . '');
		}

		/**
		 * Delete all RoleModules
		 * @return void
		*/
		public static function DeleteAll() {
			// Get the Database Object for this Class
			$objDatabase = RoleModule::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				DELETE FROM
					`role_module`');
		}

		/**
		 * Truncate role_module table
		 * @return void
		*/
		public static function Truncate() {
			// Get the Database Object for this Class
			$objDatabase = RoleModule::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				TRUNCATE `role_module`');
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
				case 'RoleModuleId':
					/**
					 * Gets the value for intRoleModuleId (Read-Only PK)
					 * @return integer
					 */
					return $this->intRoleModuleId;

				case 'RoleId':
					/**
					 * Gets the value for intRoleId (Not Null)
					 * @return integer
					 */
					return $this->intRoleId;

				case 'ModuleId':
					/**
					 * Gets the value for intModuleId (Not Null)
					 * @return integer
					 */
					return $this->intModuleId;

				case 'AccessFlag':
					/**
					 * Gets the value for blnAccessFlag (Not Null)
					 * @return boolean
					 */
					return $this->blnAccessFlag;

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
				case 'Role':
					/**
					 * Gets the value for the Role object referenced by intRoleId (Not Null)
					 * @return Role
					 */
					try {
						if ((!$this->objRole) && (!is_null($this->intRoleId)))
							$this->objRole = Role::Load($this->intRoleId);
						return $this->objRole;
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

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

				case '_RoleModuleAuthorization':
					/**
					 * Gets the value for the private _objRoleModuleAuthorization (Read-Only)
					 * if set due to an expansion on the role_module_authorization.role_module_id reverse relationship
					 * @return RoleModuleAuthorization
					 */
					return $this->_objRoleModuleAuthorization;

				case '_RoleModuleAuthorizationArray':
					/**
					 * Gets the value for the private _objRoleModuleAuthorizationArray (Read-Only)
					 * if set due to an ExpandAsArray on the role_module_authorization.role_module_id reverse relationship
					 * @return RoleModuleAuthorization[]
					 */
					return (array) $this->_objRoleModuleAuthorizationArray;

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
				case 'RoleId':
					/**
					 * Sets the value for intRoleId (Not Null)
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						$this->objRole = null;
						return ($this->intRoleId = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

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

				case 'AccessFlag':
					/**
					 * Sets the value for blnAccessFlag (Not Null)
					 * @param boolean $mixValue
					 * @return boolean
					 */
					try {
						return ($this->blnAccessFlag = QType::Cast($mixValue, QType::Boolean));
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
				case 'Role':
					/**
					 * Sets the value for the Role object referenced by intRoleId (Not Null)
					 * @param Role $mixValue
					 * @return Role
					 */
					if (is_null($mixValue)) {
						$this->intRoleId = null;
						$this->objRole = null;
						return null;
					} else {
						// Make sure $mixValue actually is a Role object
						try {
							$mixValue = QType::Cast($mixValue, 'Role');
						} catch (QInvalidCastException $objExc) {
							$objExc->IncrementOffset();
							throw $objExc;
						} 

						// Make sure $mixValue is a SAVED Role object
						if (is_null($mixValue->RoleId))
							throw new QCallerException('Unable to set an unsaved Role for this RoleModule');

						// Update Local Member Variables
						$this->objRole = $mixValue;
						$this->intRoleId = $mixValue->RoleId;

						// Return $mixValue
						return $mixValue;
					}
					break;

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
							throw new QCallerException('Unable to set an unsaved Module for this RoleModule');

						// Update Local Member Variables
						$this->objModule = $mixValue;
						$this->intModuleId = $mixValue->ModuleId;

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
							throw new QCallerException('Unable to set an unsaved CreatedByObject for this RoleModule');

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
							throw new QCallerException('Unable to set an unsaved ModifiedByObject for this RoleModule');

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

			
		
		// Related Objects' Methods for RoleModuleAuthorization
		//-------------------------------------------------------------------

		/**
		 * Gets all associated RoleModuleAuthorizations as an array of RoleModuleAuthorization objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return RoleModuleAuthorization[]
		*/ 
		public function GetRoleModuleAuthorizationArray($objOptionalClauses = null) {
			if ((is_null($this->intRoleModuleId)))
				return array();

			try {
				return RoleModuleAuthorization::LoadArrayByRoleModuleId($this->intRoleModuleId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated RoleModuleAuthorizations
		 * @return int
		*/ 
		public function CountRoleModuleAuthorizations() {
			if ((is_null($this->intRoleModuleId)))
				return 0;

			return RoleModuleAuthorization::CountByRoleModuleId($this->intRoleModuleId);
		}

		/**
		 * Associates a RoleModuleAuthorization
		 * @param RoleModuleAuthorization $objRoleModuleAuthorization
		 * @return void
		*/ 
		public function AssociateRoleModuleAuthorization(RoleModuleAuthorization $objRoleModuleAuthorization) {
			if ((is_null($this->intRoleModuleId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateRoleModuleAuthorization on this unsaved RoleModule.');
			if ((is_null($objRoleModuleAuthorization->RoleModuleAuthorizationId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateRoleModuleAuthorization on this RoleModule with an unsaved RoleModuleAuthorization.');

			// Get the Database Object for this Class
			$objDatabase = RoleModule::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`role_module_authorization`
				SET
					`role_module_id` = ' . $objDatabase->SqlVariable($this->intRoleModuleId) . '
				WHERE
					`role_module_authorization_id` = ' . $objDatabase->SqlVariable($objRoleModuleAuthorization->RoleModuleAuthorizationId) . '
			');
		}

		/**
		 * Unassociates a RoleModuleAuthorization
		 * @param RoleModuleAuthorization $objRoleModuleAuthorization
		 * @return void
		*/ 
		public function UnassociateRoleModuleAuthorization(RoleModuleAuthorization $objRoleModuleAuthorization) {
			if ((is_null($this->intRoleModuleId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateRoleModuleAuthorization on this unsaved RoleModule.');
			if ((is_null($objRoleModuleAuthorization->RoleModuleAuthorizationId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateRoleModuleAuthorization on this RoleModule with an unsaved RoleModuleAuthorization.');

			// Get the Database Object for this Class
			$objDatabase = RoleModule::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`role_module_authorization`
				SET
					`role_module_id` = null
				WHERE
					`role_module_authorization_id` = ' . $objDatabase->SqlVariable($objRoleModuleAuthorization->RoleModuleAuthorizationId) . ' AND
					`role_module_id` = ' . $objDatabase->SqlVariable($this->intRoleModuleId) . '
			');
		}

		/**
		 * Unassociates all RoleModuleAuthorizations
		 * @return void
		*/ 
		public function UnassociateAllRoleModuleAuthorizations() {
			if ((is_null($this->intRoleModuleId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateRoleModuleAuthorization on this unsaved RoleModule.');

			// Get the Database Object for this Class
			$objDatabase = RoleModule::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`role_module_authorization`
				SET
					`role_module_id` = null
				WHERE
					`role_module_id` = ' . $objDatabase->SqlVariable($this->intRoleModuleId) . '
			');
		}

		/**
		 * Deletes an associated RoleModuleAuthorization
		 * @param RoleModuleAuthorization $objRoleModuleAuthorization
		 * @return void
		*/ 
		public function DeleteAssociatedRoleModuleAuthorization(RoleModuleAuthorization $objRoleModuleAuthorization) {
			if ((is_null($this->intRoleModuleId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateRoleModuleAuthorization on this unsaved RoleModule.');
			if ((is_null($objRoleModuleAuthorization->RoleModuleAuthorizationId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateRoleModuleAuthorization on this RoleModule with an unsaved RoleModuleAuthorization.');

			// Get the Database Object for this Class
			$objDatabase = RoleModule::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`role_module_authorization`
				WHERE
					`role_module_authorization_id` = ' . $objDatabase->SqlVariable($objRoleModuleAuthorization->RoleModuleAuthorizationId) . ' AND
					`role_module_id` = ' . $objDatabase->SqlVariable($this->intRoleModuleId) . '
			');
		}

		/**
		 * Deletes all associated RoleModuleAuthorizations
		 * @return void
		*/ 
		public function DeleteAllRoleModuleAuthorizations() {
			if ((is_null($this->intRoleModuleId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateRoleModuleAuthorization on this unsaved RoleModule.');

			// Get the Database Object for this Class
			$objDatabase = RoleModule::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`role_module_authorization`
				WHERE
					`role_module_id` = ' . $objDatabase->SqlVariable($this->intRoleModuleId) . '
			');
		}




		///////////////////////////////////////////////////////////////////////
		// PROTECTED MEMBER VARIABLES and TEXT FIELD MAXLENGTHS (if applicable)
		///////////////////////////////////////////////////////////////////////
		
		/**
		 * Protected member variable that maps to the database PK Identity column role_module.role_module_id
		 * @var integer intRoleModuleId
		 */
		protected $intRoleModuleId;
		const RoleModuleIdDefault = null;


		/**
		 * Protected member variable that maps to the database column role_module.role_id
		 * @var integer intRoleId
		 */
		protected $intRoleId;
		const RoleIdDefault = null;


		/**
		 * Protected member variable that maps to the database column role_module.module_id
		 * @var integer intModuleId
		 */
		protected $intModuleId;
		const ModuleIdDefault = null;


		/**
		 * Protected member variable that maps to the database column role_module.access_flag
		 * @var boolean blnAccessFlag
		 */
		protected $blnAccessFlag;
		const AccessFlagDefault = null;


		/**
		 * Protected member variable that maps to the database column role_module.created_by
		 * @var integer intCreatedBy
		 */
		protected $intCreatedBy;
		const CreatedByDefault = null;


		/**
		 * Protected member variable that maps to the database column role_module.creation_date
		 * @var QDateTime dttCreationDate
		 */
		protected $dttCreationDate;
		const CreationDateDefault = null;


		/**
		 * Protected member variable that maps to the database column role_module.modified_by
		 * @var integer intModifiedBy
		 */
		protected $intModifiedBy;
		const ModifiedByDefault = null;


		/**
		 * Protected member variable that maps to the database column role_module.modified_date
		 * @var string strModifiedDate
		 */
		protected $strModifiedDate;
		const ModifiedDateDefault = null;


		/**
		 * Private member variable that stores a reference to a single RoleModuleAuthorization object
		 * (of type RoleModuleAuthorization), if this RoleModule object was restored with
		 * an expansion on the role_module_authorization association table.
		 * @var RoleModuleAuthorization _objRoleModuleAuthorization;
		 */
		private $_objRoleModuleAuthorization;

		/**
		 * Private member variable that stores a reference to an array of RoleModuleAuthorization objects
		 * (of type RoleModuleAuthorization[]), if this RoleModule object was restored with
		 * an ExpandAsArray on the role_module_authorization association table.
		 * @var RoleModuleAuthorization[] _objRoleModuleAuthorizationArray;
		 */
		private $_objRoleModuleAuthorizationArray = array();

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
		 * in the database column role_module.role_id.
		 *
		 * NOTE: Always use the Role property getter to correctly retrieve this Role object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var Role objRole
		 */
		protected $objRole;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column role_module.module_id.
		 *
		 * NOTE: Always use the Module property getter to correctly retrieve this Module object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var Module objModule
		 */
		protected $objModule;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column role_module.created_by.
		 *
		 * NOTE: Always use the CreatedByObject property getter to correctly retrieve this UserAccount object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var UserAccount objCreatedByObject
		 */
		protected $objCreatedByObject;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column role_module.modified_by.
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
				$objQueryExpansion = new QQueryExpansion('RoleModule', 'role_module', $objExpansionMap);
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
				$objQueryExpansion->AddFromItem(sprintf('LEFT JOIN `role_module` AS `%s__%s` ON `%s`.`%s` = `%s__%s`.`role_module_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias, $strParentAlias, $strAlias));

				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`role_module_id` AS `%s__%s__role_module_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`role_id` AS `%s__%s__role_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`module_id` AS `%s__%s__module_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`access_flag` AS `%s__%s__access_flag`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`created_by` AS `%s__%s__created_by`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`creation_date` AS `%s__%s__creation_date`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`modified_by` AS `%s__%s__modified_by`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`modified_date` AS `%s__%s__modified_date`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));

				$strParentAlias = $strParentAlias . '__' . $strAlias;
			}

			if (is_array($objExpansionMap))
				foreach ($objExpansionMap as $strKey=>$objValue) {
					switch ($strKey) {
						case 'role_id':
							try {
								Role::ExpandQuery($strParentAlias, $strKey, $objValue, $objQueryExpansion);
								break;
							} catch (QCallerException $objExc) {
								$objExc->IncrementOffset();
								throw $objExc;
							}
						case 'module_id':
							try {
								Module::ExpandQuery($strParentAlias, $strKey, $objValue, $objQueryExpansion);
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
		const ExpandRole = 'role_id';
		const ExpandModule = 'module_id';
		const ExpandCreatedByObject = 'created_by';
		const ExpandModifiedByObject = 'modified_by';




		////////////////////////////////////////
		// METHODS for WEB SERVICES
		////////////////////////////////////////

		public static function GetSoapComplexTypeXml() {
			$strToReturn = '<complexType name="RoleModule"><sequence>';
			$strToReturn .= '<element name="RoleModuleId" type="xsd:int"/>';
			$strToReturn .= '<element name="Role" type="xsd1:Role"/>';
			$strToReturn .= '<element name="Module" type="xsd1:Module"/>';
			$strToReturn .= '<element name="AccessFlag" type="xsd:boolean"/>';
			$strToReturn .= '<element name="CreatedByObject" type="xsd1:UserAccount"/>';
			$strToReturn .= '<element name="CreationDate" type="xsd:dateTime"/>';
			$strToReturn .= '<element name="ModifiedByObject" type="xsd1:UserAccount"/>';
			$strToReturn .= '<element name="ModifiedDate" type="xsd:string"/>';
			$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
			$strToReturn .= '</sequence></complexType>';
			return $strToReturn;
		}

		public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
			if (!array_key_exists('RoleModule', $strComplexTypeArray)) {
				$strComplexTypeArray['RoleModule'] = RoleModule::GetSoapComplexTypeXml();
				Role::AlterSoapComplexTypeArray($strComplexTypeArray);
				Module::AlterSoapComplexTypeArray($strComplexTypeArray);
				UserAccount::AlterSoapComplexTypeArray($strComplexTypeArray);
				UserAccount::AlterSoapComplexTypeArray($strComplexTypeArray);
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, RoleModule::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new RoleModule();
			if (property_exists($objSoapObject, 'RoleModuleId'))
				$objToReturn->intRoleModuleId = $objSoapObject->RoleModuleId;
			if ((property_exists($objSoapObject, 'Role')) &&
				($objSoapObject->Role))
				$objToReturn->Role = Role::GetObjectFromSoapObject($objSoapObject->Role);
			if ((property_exists($objSoapObject, 'Module')) &&
				($objSoapObject->Module))
				$objToReturn->Module = Module::GetObjectFromSoapObject($objSoapObject->Module);
			if (property_exists($objSoapObject, 'AccessFlag'))
				$objToReturn->blnAccessFlag = $objSoapObject->AccessFlag;
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
				array_push($objArrayToReturn, RoleModule::GetSoapObjectFromObject($objObject, true));

			return unserialize(serialize($objArrayToReturn));
		}

		public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
			if ($objObject->objRole)
				$objObject->objRole = Role::GetSoapObjectFromObject($objObject->objRole, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intRoleId = null;
			if ($objObject->objModule)
				$objObject->objModule = Module::GetSoapObjectFromObject($objObject->objModule, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intModuleId = null;
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

	class QQNodeRoleModule extends QQNode {
		protected $strTableName = 'role_module';
		protected $strPrimaryKey = 'role_module_id';
		protected $strClassName = 'RoleModule';
		public function __get($strName) {
			switch ($strName) {
				case 'RoleModuleId':
					return new QQNode('role_module_id', 'integer', $this);
				case 'RoleId':
					return new QQNode('role_id', 'integer', $this);
				case 'Role':
					return new QQNodeRole('role_id', 'integer', $this);
				case 'ModuleId':
					return new QQNode('module_id', 'integer', $this);
				case 'Module':
					return new QQNodeModule('module_id', 'integer', $this);
				case 'AccessFlag':
					return new QQNode('access_flag', 'boolean', $this);
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
				case 'RoleModuleAuthorization':
					return new QQReverseReferenceNodeRoleModuleAuthorization($this, 'rolemoduleauthorization', 'reverse_reference', 'role_module_id');

				case '_PrimaryKeyNode':
					return new QQNode('role_module_id', 'integer', $this);
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

	class QQReverseReferenceNodeRoleModule extends QQReverseReferenceNode {
		protected $strTableName = 'role_module';
		protected $strPrimaryKey = 'role_module_id';
		protected $strClassName = 'RoleModule';
		public function __get($strName) {
			switch ($strName) {
				case 'RoleModuleId':
					return new QQNode('role_module_id', 'integer', $this);
				case 'RoleId':
					return new QQNode('role_id', 'integer', $this);
				case 'Role':
					return new QQNodeRole('role_id', 'integer', $this);
				case 'ModuleId':
					return new QQNode('module_id', 'integer', $this);
				case 'Module':
					return new QQNodeModule('module_id', 'integer', $this);
				case 'AccessFlag':
					return new QQNode('access_flag', 'boolean', $this);
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
				case 'RoleModuleAuthorization':
					return new QQReverseReferenceNodeRoleModuleAuthorization($this, 'rolemoduleauthorization', 'reverse_reference', 'role_module_id');

				case '_PrimaryKeyNode':
					return new QQNode('role_module_id', 'integer', $this);
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