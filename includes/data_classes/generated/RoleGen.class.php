<?php
	/**
	 * The abstract RoleGen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the Role subclass which
	 * extends this RoleGen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the Role class.
	 * 
	 * @package My Application
	 * @subpackage GeneratedDataObjects
	 * 
	 */
	class RoleGen extends QBaseClass {
		///////////////////////////////
		// COMMON LOAD METHODS
		///////////////////////////////

		/**
		 * Load a Role from PK Info
		 * @param integer $intRoleId
		 * @return Role
		 */
		public static function Load($intRoleId) {
			// Use QuerySingle to Perform the Query
			return Role::QuerySingle(
				QQ::Equal(QQN::Role()->RoleId, $intRoleId)
			);
		}

		/**
		 * Load all Roles
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Role[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			// Call Role::QueryArray to perform the LoadAll query
			try {
				return Role::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all Roles
		 * @return int
		 */
		public static function CountAll() {
			// Call Role::QueryCount to perform the CountAll query
			return Role::QueryCount(QQ::All());
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
			$objDatabase = Role::GetDatabase();

			// Create/Build out the QueryBuilder object with Role-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, 'role');
			Role::GetSelectFields($objQueryBuilder);
			$objQueryBuilder->AddFromItem('`role` AS `role`');

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
		 * Static Qcodo Query method to query for a single Role object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return Role the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Role::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query, Get the First Row, and Instantiate a new Role object
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return Role::InstantiateDbRow($objDbResult->GetNextRow());
		}

		/**
		 * Static Qcodo Query method to query for an array of Role objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return Role[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Role::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return Role::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
		}

		/**
		 * Static Qcodo Query method to query for a count of Role objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Role::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
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
			$objDatabase = Role::GetDatabase();

			// Lookup the QCache for This Query Statement
			$objCache = new QCache('query', 'role_' . serialize($strConditions));
			if (!($strQuery = $objCache->GetData())) {
				// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with Role-specific fields
				$objQueryBuilder = new QQueryBuilder($objDatabase);
				Role::GetSelectFields($objQueryBuilder);
				Role::GetFromFields($objQueryBuilder);

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
			return Role::InstantiateDbResult($objDbResult);
		}*/

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this Role
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null) {
			if ($strPrefix) {
				$strTableName = '`' . $strPrefix . '`';
				$strAliasPrefix = '`' . $strPrefix . '__';
			} else {
				$strTableName = '`role`';
				$strAliasPrefix = '`';
			}

			$objBuilder->AddSelectItem($strTableName . '.`role_id` AS ' . $strAliasPrefix . 'role_id`');
			$objBuilder->AddSelectItem($strTableName . '.`short_description` AS ' . $strAliasPrefix . 'short_description`');
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
		 * Instantiate a Role from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this Role::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param DatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @return Role
		*/
		public static function InstantiateDbRow($objDbRow, $strAliasPrefix = null, $strExpandAsArrayNodes = null, $objPreviousItem = null) {
			// If blank row, return null
			if (!$objDbRow)
				return null;

			// See if we're doing an array expansion on the previous item
			if (($strExpandAsArrayNodes) && ($objPreviousItem) &&
				($objPreviousItem->intRoleId == $objDbRow->GetColumn($strAliasPrefix . 'role_id', 'Integer'))) {

				// We are.  Now, prepare to check for ExpandAsArray clauses
				$blnExpandedViaArray = false;
				if (!$strAliasPrefix)
					$strAliasPrefix = 'role__';


				if ((array_key_exists($strAliasPrefix . 'roleentityqtypebuiltinauthorization__role_entity_built_in_id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'roleentityqtypebuiltinauthorization__role_entity_built_in_id')))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objRoleEntityQtypeBuiltInAuthorizationArray)) {
						$objPreviousChildItem = $objPreviousItem->_objRoleEntityQtypeBuiltInAuthorizationArray[$intPreviousChildItemCount - 1];
						$objChildItem = RoleEntityQtypeBuiltInAuthorization::InstantiateDbRow($objDbRow, $strAliasPrefix . 'roleentityqtypebuiltinauthorization__', $strExpandAsArrayNodes, $objPreviousChildItem);
						if ($objChildItem)
							array_push($objPreviousItem->_objRoleEntityQtypeBuiltInAuthorizationArray, $objChildItem);
					} else
						array_push($objPreviousItem->_objRoleEntityQtypeBuiltInAuthorizationArray, RoleEntityQtypeBuiltInAuthorization::InstantiateDbRow($objDbRow, $strAliasPrefix . 'roleentityqtypebuiltinauthorization__', $strExpandAsArrayNodes));
					$blnExpandedViaArray = true;
				}

				if ((array_key_exists($strAliasPrefix . 'roleentityqtypecustomfieldauthorization__role_entity_qtype_custom_field_authorization_id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'roleentityqtypecustomfieldauthorization__role_entity_qtype_custom_field_authorization_id')))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objRoleEntityQtypeCustomFieldAuthorizationArray)) {
						$objPreviousChildItem = $objPreviousItem->_objRoleEntityQtypeCustomFieldAuthorizationArray[$intPreviousChildItemCount - 1];
						$objChildItem = RoleEntityQtypeCustomFieldAuthorization::InstantiateDbRow($objDbRow, $strAliasPrefix . 'roleentityqtypecustomfieldauthorization__', $strExpandAsArrayNodes, $objPreviousChildItem);
						if ($objChildItem)
							array_push($objPreviousItem->_objRoleEntityQtypeCustomFieldAuthorizationArray, $objChildItem);
					} else
						array_push($objPreviousItem->_objRoleEntityQtypeCustomFieldAuthorizationArray, RoleEntityQtypeCustomFieldAuthorization::InstantiateDbRow($objDbRow, $strAliasPrefix . 'roleentityqtypecustomfieldauthorization__', $strExpandAsArrayNodes));
					$blnExpandedViaArray = true;
				}

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

				if ((array_key_exists($strAliasPrefix . 'useraccount__user_account_id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'useraccount__user_account_id')))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objUserAccountArray)) {
						$objPreviousChildItem = $objPreviousItem->_objUserAccountArray[$intPreviousChildItemCount - 1];
						$objChildItem = UserAccount::InstantiateDbRow($objDbRow, $strAliasPrefix . 'useraccount__', $strExpandAsArrayNodes, $objPreviousChildItem);
						if ($objChildItem)
							array_push($objPreviousItem->_objUserAccountArray, $objChildItem);
					} else
						array_push($objPreviousItem->_objUserAccountArray, UserAccount::InstantiateDbRow($objDbRow, $strAliasPrefix . 'useraccount__', $strExpandAsArrayNodes));
					$blnExpandedViaArray = true;
				}

				// Either return false to signal array expansion, or check-to-reset the Alias prefix and move on
				if ($blnExpandedViaArray)
					return false;
				else if ($strAliasPrefix == 'role__')
					$strAliasPrefix = null;
			}

			// Create a new instance of the Role object
			$objToReturn = new Role();
			$objToReturn->__blnRestored = true;

			$objToReturn->intRoleId = $objDbRow->GetColumn($strAliasPrefix . 'role_id', 'Integer');
			$objToReturn->strShortDescription = $objDbRow->GetColumn($strAliasPrefix . 'short_description', 'VarChar');
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
				$strAliasPrefix = 'role__';

			// Check for CreatedByObject Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'created_by__user_account_id')))
				$objToReturn->objCreatedByObject = UserAccount::InstantiateDbRow($objDbRow, $strAliasPrefix . 'created_by__', $strExpandAsArrayNodes);

			// Check for ModifiedByObject Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'modified_by__user_account_id')))
				$objToReturn->objModifiedByObject = UserAccount::InstantiateDbRow($objDbRow, $strAliasPrefix . 'modified_by__', $strExpandAsArrayNodes);




			// Check for RoleEntityQtypeBuiltInAuthorization Virtual Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'roleentityqtypebuiltinauthorization__role_entity_built_in_id'))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'roleentityqtypebuiltinauthorization__role_entity_built_in_id', $strExpandAsArrayNodes)))
					array_push($objToReturn->_objRoleEntityQtypeBuiltInAuthorizationArray, RoleEntityQtypeBuiltInAuthorization::InstantiateDbRow($objDbRow, $strAliasPrefix . 'roleentityqtypebuiltinauthorization__', $strExpandAsArrayNodes));
				else
					$objToReturn->_objRoleEntityQtypeBuiltInAuthorization = RoleEntityQtypeBuiltInAuthorization::InstantiateDbRow($objDbRow, $strAliasPrefix . 'roleentityqtypebuiltinauthorization__', $strExpandAsArrayNodes);
			}

			// Check for RoleEntityQtypeCustomFieldAuthorization Virtual Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'roleentityqtypecustomfieldauthorization__role_entity_qtype_custom_field_authorization_id'))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'roleentityqtypecustomfieldauthorization__role_entity_qtype_custom_field_authorization_id', $strExpandAsArrayNodes)))
					array_push($objToReturn->_objRoleEntityQtypeCustomFieldAuthorizationArray, RoleEntityQtypeCustomFieldAuthorization::InstantiateDbRow($objDbRow, $strAliasPrefix . 'roleentityqtypecustomfieldauthorization__', $strExpandAsArrayNodes));
				else
					$objToReturn->_objRoleEntityQtypeCustomFieldAuthorization = RoleEntityQtypeCustomFieldAuthorization::InstantiateDbRow($objDbRow, $strAliasPrefix . 'roleentityqtypecustomfieldauthorization__', $strExpandAsArrayNodes);
			}

			// Check for RoleModule Virtual Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'rolemodule__role_module_id'))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'rolemodule__role_module_id', $strExpandAsArrayNodes)))
					array_push($objToReturn->_objRoleModuleArray, RoleModule::InstantiateDbRow($objDbRow, $strAliasPrefix . 'rolemodule__', $strExpandAsArrayNodes));
				else
					$objToReturn->_objRoleModule = RoleModule::InstantiateDbRow($objDbRow, $strAliasPrefix . 'rolemodule__', $strExpandAsArrayNodes);
			}

			// Check for UserAccount Virtual Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'useraccount__user_account_id'))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'useraccount__user_account_id', $strExpandAsArrayNodes)))
					array_push($objToReturn->_objUserAccountArray, UserAccount::InstantiateDbRow($objDbRow, $strAliasPrefix . 'useraccount__', $strExpandAsArrayNodes));
				else
					$objToReturn->_objUserAccount = UserAccount::InstantiateDbRow($objDbRow, $strAliasPrefix . 'useraccount__', $strExpandAsArrayNodes);
			}

			return $objToReturn;
		}

		/**
		 * Instantiate an array of Roles from a Database Result
		 * @param DatabaseResultBase $objDbResult
		 * @return Role[]
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
					$objItem = Role::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
					if ($objItem) {
						array_push($objToReturn, $objItem);
						$objLastRowItem = $objItem;
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					array_push($objToReturn, Role::InstantiateDbRow($objDbRow));
			}

			return $objToReturn;
		}



		///////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Single Load and Array)
		///////////////////////////////////////////////////
			
		/**
		 * Load a single Role object,
		 * by RoleId Index(es)
		 * @param integer $intRoleId
		 * @return Role
		*/
		public static function LoadByRoleId($intRoleId) {
			return Role::QuerySingle(
				QQ::Equal(QQN::Role()->RoleId, $intRoleId)
			);
		}
			
		/**
		 * Load an array of Role objects,
		 * by CreatedBy Index(es)
		 * @param integer $intCreatedBy
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Role[]
		*/
		public static function LoadArrayByCreatedBy($intCreatedBy, $objOptionalClauses = null) {
			// Call Role::QueryArray to perform the LoadArrayByCreatedBy query
			try {
				return Role::QueryArray(
					QQ::Equal(QQN::Role()->CreatedBy, $intCreatedBy),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count Roles
		 * by CreatedBy Index(es)
		 * @param integer $intCreatedBy
		 * @return int
		*/
		public static function CountByCreatedBy($intCreatedBy) {
			// Call Role::QueryCount to perform the CountByCreatedBy query
			return Role::QueryCount(
				QQ::Equal(QQN::Role()->CreatedBy, $intCreatedBy)
			);
		}
			
		/**
		 * Load an array of Role objects,
		 * by ModifiedBy Index(es)
		 * @param integer $intModifiedBy
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Role[]
		*/
		public static function LoadArrayByModifiedBy($intModifiedBy, $objOptionalClauses = null) {
			// Call Role::QueryArray to perform the LoadArrayByModifiedBy query
			try {
				return Role::QueryArray(
					QQ::Equal(QQN::Role()->ModifiedBy, $intModifiedBy),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count Roles
		 * by ModifiedBy Index(es)
		 * @param integer $intModifiedBy
		 * @return int
		*/
		public static function CountByModifiedBy($intModifiedBy) {
			// Call Role::QueryCount to perform the CountByModifiedBy query
			return Role::QueryCount(
				QQ::Equal(QQN::Role()->ModifiedBy, $intModifiedBy)
			);
		}



		////////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Array via Many to Many)
		////////////////////////////////////////////////////



		//////////////////
		// SAVE AND DELETE
		//////////////////

		/**
		 * Save this Role
		 * @param bool $blnForceInsert
		 * @param bool $blnForceUpdate
		 * @return int
		*/
		public function Save($blnForceInsert = false, $blnForceUpdate = false) {
			// Get the Database Object for this Class
			$objDatabase = Role::GetDatabase();

			$mixToReturn = null;

			try {
				if ((!$this->__blnRestored) || ($blnForceInsert)) {
					// Perform an INSERT query
					$objDatabase->NonQuery('
						INSERT INTO `role` (
							`short_description`,
							`long_description`,
							`created_by`,
							`creation_date`,
							`modified_by`
						) VALUES (
							' . $objDatabase->SqlVariable($this->strShortDescription) . ',
							' . $objDatabase->SqlVariable($this->strLongDescription) . ',
							' . $objDatabase->SqlVariable($this->intCreatedBy) . ',
							' . $objDatabase->SqlVariable($this->dttCreationDate) . ',
							' . $objDatabase->SqlVariable($this->intModifiedBy) . '
						)
					');

					// Update Identity column and return its value
					$mixToReturn = $this->intRoleId = $objDatabase->InsertId('role', 'role_id');
				} else {
					// Perform an UPDATE query

					// First checking for Optimistic Locking constraints (if applicable)
					if (!$blnForceUpdate) {
						// Perform the Optimistic Locking check
						$objResult = $objDatabase->Query('
							SELECT
								`modified_date`
							FROM
								`role`
							WHERE
								`role_id` = ' . $objDatabase->SqlVariable($this->intRoleId) . '
						');
						
						$objRow = $objResult->FetchArray();
						if ($objRow[0] != $this->strModifiedDate)
							throw new QExtendedOptimisticLockingException('Role', $this->intRoleId);
					}

					// Perform the UPDATE query
					$objDatabase->NonQuery('
						UPDATE
							`role`
						SET
							`short_description` = ' . $objDatabase->SqlVariable($this->strShortDescription) . ',
							`long_description` = ' . $objDatabase->SqlVariable($this->strLongDescription) . ',
							`created_by` = ' . $objDatabase->SqlVariable($this->intCreatedBy) . ',
							`creation_date` = ' . $objDatabase->SqlVariable($this->dttCreationDate) . ',
							`modified_by` = ' . $objDatabase->SqlVariable($this->intModifiedBy) . '
						WHERE
							`role_id` = ' . $objDatabase->SqlVariable($this->intRoleId) . '
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
					`role`
				WHERE
					`role_id` = ' . $objDatabase->SqlVariable($this->intRoleId) . '
			');
						
			$objRow = $objResult->FetchArray();
			$this->strModifiedDate = $objRow[0];

			// Return 
			return $mixToReturn;
		}

				/**
		 * Delete this Role
		 * @return void
		*/
		public function Delete() {
			if ((is_null($this->intRoleId)))
				throw new QUndefinedPrimaryKeyException('Cannot delete this Role with an unset primary key.');

			// Get the Database Object for this Class
			$objDatabase = Role::GetDatabase();


			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`role`
				WHERE
					`role_id` = ' . $objDatabase->SqlVariable($this->intRoleId) . '');
		}

		/**
		 * Delete all Roles
		 * @return void
		*/
		public static function DeleteAll() {
			// Get the Database Object for this Class
			$objDatabase = Role::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				DELETE FROM
					`role`');
		}

		/**
		 * Truncate role table
		 * @return void
		*/
		public static function Truncate() {
			// Get the Database Object for this Class
			$objDatabase = Role::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				TRUNCATE `role`');
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
				case 'RoleId':
					/**
					 * Gets the value for intRoleId (Read-Only PK)
					 * @return integer
					 */
					return $this->intRoleId;

				case 'ShortDescription':
					/**
					 * Gets the value for strShortDescription (Not Null)
					 * @return string
					 */
					return $this->strShortDescription;

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

				case '_RoleEntityQtypeBuiltInAuthorization':
					/**
					 * Gets the value for the private _objRoleEntityQtypeBuiltInAuthorization (Read-Only)
					 * if set due to an expansion on the role_entity_qtype_built_in_authorization.role_id reverse relationship
					 * @return RoleEntityQtypeBuiltInAuthorization
					 */
					return $this->_objRoleEntityQtypeBuiltInAuthorization;

				case '_RoleEntityQtypeBuiltInAuthorizationArray':
					/**
					 * Gets the value for the private _objRoleEntityQtypeBuiltInAuthorizationArray (Read-Only)
					 * if set due to an ExpandAsArray on the role_entity_qtype_built_in_authorization.role_id reverse relationship
					 * @return RoleEntityQtypeBuiltInAuthorization[]
					 */
					return (array) $this->_objRoleEntityQtypeBuiltInAuthorizationArray;

				case '_RoleEntityQtypeCustomFieldAuthorization':
					/**
					 * Gets the value for the private _objRoleEntityQtypeCustomFieldAuthorization (Read-Only)
					 * if set due to an expansion on the role_entity_qtype_custom_field_authorization.role_id reverse relationship
					 * @return RoleEntityQtypeCustomFieldAuthorization
					 */
					return $this->_objRoleEntityQtypeCustomFieldAuthorization;

				case '_RoleEntityQtypeCustomFieldAuthorizationArray':
					/**
					 * Gets the value for the private _objRoleEntityQtypeCustomFieldAuthorizationArray (Read-Only)
					 * if set due to an ExpandAsArray on the role_entity_qtype_custom_field_authorization.role_id reverse relationship
					 * @return RoleEntityQtypeCustomFieldAuthorization[]
					 */
					return (array) $this->_objRoleEntityQtypeCustomFieldAuthorizationArray;

				case '_RoleModule':
					/**
					 * Gets the value for the private _objRoleModule (Read-Only)
					 * if set due to an expansion on the role_module.role_id reverse relationship
					 * @return RoleModule
					 */
					return $this->_objRoleModule;

				case '_RoleModuleArray':
					/**
					 * Gets the value for the private _objRoleModuleArray (Read-Only)
					 * if set due to an ExpandAsArray on the role_module.role_id reverse relationship
					 * @return RoleModule[]
					 */
					return (array) $this->_objRoleModuleArray;

				case '_UserAccount':
					/**
					 * Gets the value for the private _objUserAccount (Read-Only)
					 * if set due to an expansion on the user_account.role_id reverse relationship
					 * @return UserAccount
					 */
					return $this->_objUserAccount;

				case '_UserAccountArray':
					/**
					 * Gets the value for the private _objUserAccountArray (Read-Only)
					 * if set due to an ExpandAsArray on the user_account.role_id reverse relationship
					 * @return UserAccount[]
					 */
					return (array) $this->_objUserAccountArray;

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
							throw new QCallerException('Unable to set an unsaved CreatedByObject for this Role');

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
							throw new QCallerException('Unable to set an unsaved ModifiedByObject for this Role');

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

			
		
		// Related Objects' Methods for RoleEntityQtypeBuiltInAuthorization
		//-------------------------------------------------------------------

		/**
		 * Gets all associated RoleEntityQtypeBuiltInAuthorizations as an array of RoleEntityQtypeBuiltInAuthorization objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return RoleEntityQtypeBuiltInAuthorization[]
		*/ 
		public function GetRoleEntityQtypeBuiltInAuthorizationArray($objOptionalClauses = null) {
			if ((is_null($this->intRoleId)))
				return array();

			try {
				return RoleEntityQtypeBuiltInAuthorization::LoadArrayByRoleId($this->intRoleId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated RoleEntityQtypeBuiltInAuthorizations
		 * @return int
		*/ 
		public function CountRoleEntityQtypeBuiltInAuthorizations() {
			if ((is_null($this->intRoleId)))
				return 0;

			return RoleEntityQtypeBuiltInAuthorization::CountByRoleId($this->intRoleId);
		}

		/**
		 * Associates a RoleEntityQtypeBuiltInAuthorization
		 * @param RoleEntityQtypeBuiltInAuthorization $objRoleEntityQtypeBuiltInAuthorization
		 * @return void
		*/ 
		public function AssociateRoleEntityQtypeBuiltInAuthorization(RoleEntityQtypeBuiltInAuthorization $objRoleEntityQtypeBuiltInAuthorization) {
			if ((is_null($this->intRoleId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateRoleEntityQtypeBuiltInAuthorization on this unsaved Role.');
			if ((is_null($objRoleEntityQtypeBuiltInAuthorization->RoleEntityBuiltInId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateRoleEntityQtypeBuiltInAuthorization on this Role with an unsaved RoleEntityQtypeBuiltInAuthorization.');

			// Get the Database Object for this Class
			$objDatabase = Role::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`role_entity_qtype_built_in_authorization`
				SET
					`role_id` = ' . $objDatabase->SqlVariable($this->intRoleId) . '
				WHERE
					`role_entity_built_in_id` = ' . $objDatabase->SqlVariable($objRoleEntityQtypeBuiltInAuthorization->RoleEntityBuiltInId) . '
			');
		}

		/**
		 * Unassociates a RoleEntityQtypeBuiltInAuthorization
		 * @param RoleEntityQtypeBuiltInAuthorization $objRoleEntityQtypeBuiltInAuthorization
		 * @return void
		*/ 
		public function UnassociateRoleEntityQtypeBuiltInAuthorization(RoleEntityQtypeBuiltInAuthorization $objRoleEntityQtypeBuiltInAuthorization) {
			if ((is_null($this->intRoleId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateRoleEntityQtypeBuiltInAuthorization on this unsaved Role.');
			if ((is_null($objRoleEntityQtypeBuiltInAuthorization->RoleEntityBuiltInId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateRoleEntityQtypeBuiltInAuthorization on this Role with an unsaved RoleEntityQtypeBuiltInAuthorization.');

			// Get the Database Object for this Class
			$objDatabase = Role::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`role_entity_qtype_built_in_authorization`
				SET
					`role_id` = null
				WHERE
					`role_entity_built_in_id` = ' . $objDatabase->SqlVariable($objRoleEntityQtypeBuiltInAuthorization->RoleEntityBuiltInId) . ' AND
					`role_id` = ' . $objDatabase->SqlVariable($this->intRoleId) . '
			');
		}

		/**
		 * Unassociates all RoleEntityQtypeBuiltInAuthorizations
		 * @return void
		*/ 
		public function UnassociateAllRoleEntityQtypeBuiltInAuthorizations() {
			if ((is_null($this->intRoleId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateRoleEntityQtypeBuiltInAuthorization on this unsaved Role.');

			// Get the Database Object for this Class
			$objDatabase = Role::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`role_entity_qtype_built_in_authorization`
				SET
					`role_id` = null
				WHERE
					`role_id` = ' . $objDatabase->SqlVariable($this->intRoleId) . '
			');
		}

		/**
		 * Deletes an associated RoleEntityQtypeBuiltInAuthorization
		 * @param RoleEntityQtypeBuiltInAuthorization $objRoleEntityQtypeBuiltInAuthorization
		 * @return void
		*/ 
		public function DeleteAssociatedRoleEntityQtypeBuiltInAuthorization(RoleEntityQtypeBuiltInAuthorization $objRoleEntityQtypeBuiltInAuthorization) {
			if ((is_null($this->intRoleId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateRoleEntityQtypeBuiltInAuthorization on this unsaved Role.');
			if ((is_null($objRoleEntityQtypeBuiltInAuthorization->RoleEntityBuiltInId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateRoleEntityQtypeBuiltInAuthorization on this Role with an unsaved RoleEntityQtypeBuiltInAuthorization.');

			// Get the Database Object for this Class
			$objDatabase = Role::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`role_entity_qtype_built_in_authorization`
				WHERE
					`role_entity_built_in_id` = ' . $objDatabase->SqlVariable($objRoleEntityQtypeBuiltInAuthorization->RoleEntityBuiltInId) . ' AND
					`role_id` = ' . $objDatabase->SqlVariable($this->intRoleId) . '
			');
		}

		/**
		 * Deletes all associated RoleEntityQtypeBuiltInAuthorizations
		 * @return void
		*/ 
		public function DeleteAllRoleEntityQtypeBuiltInAuthorizations() {
			if ((is_null($this->intRoleId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateRoleEntityQtypeBuiltInAuthorization on this unsaved Role.');

			// Get the Database Object for this Class
			$objDatabase = Role::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`role_entity_qtype_built_in_authorization`
				WHERE
					`role_id` = ' . $objDatabase->SqlVariable($this->intRoleId) . '
			');
		}

			
		
		// Related Objects' Methods for RoleEntityQtypeCustomFieldAuthorization
		//-------------------------------------------------------------------

		/**
		 * Gets all associated RoleEntityQtypeCustomFieldAuthorizations as an array of RoleEntityQtypeCustomFieldAuthorization objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return RoleEntityQtypeCustomFieldAuthorization[]
		*/ 
		public function GetRoleEntityQtypeCustomFieldAuthorizationArray($objOptionalClauses = null) {
			if ((is_null($this->intRoleId)))
				return array();

			try {
				return RoleEntityQtypeCustomFieldAuthorization::LoadArrayByRoleId($this->intRoleId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated RoleEntityQtypeCustomFieldAuthorizations
		 * @return int
		*/ 
		public function CountRoleEntityQtypeCustomFieldAuthorizations() {
			if ((is_null($this->intRoleId)))
				return 0;

			return RoleEntityQtypeCustomFieldAuthorization::CountByRoleId($this->intRoleId);
		}

		/**
		 * Associates a RoleEntityQtypeCustomFieldAuthorization
		 * @param RoleEntityQtypeCustomFieldAuthorization $objRoleEntityQtypeCustomFieldAuthorization
		 * @return void
		*/ 
		public function AssociateRoleEntityQtypeCustomFieldAuthorization(RoleEntityQtypeCustomFieldAuthorization $objRoleEntityQtypeCustomFieldAuthorization) {
			if ((is_null($this->intRoleId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateRoleEntityQtypeCustomFieldAuthorization on this unsaved Role.');
			if ((is_null($objRoleEntityQtypeCustomFieldAuthorization->RoleEntityQtypeCustomFieldAuthorizationId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateRoleEntityQtypeCustomFieldAuthorization on this Role with an unsaved RoleEntityQtypeCustomFieldAuthorization.');

			// Get the Database Object for this Class
			$objDatabase = Role::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`role_entity_qtype_custom_field_authorization`
				SET
					`role_id` = ' . $objDatabase->SqlVariable($this->intRoleId) . '
				WHERE
					`role_entity_qtype_custom_field_authorization_id` = ' . $objDatabase->SqlVariable($objRoleEntityQtypeCustomFieldAuthorization->RoleEntityQtypeCustomFieldAuthorizationId) . '
			');
		}

		/**
		 * Unassociates a RoleEntityQtypeCustomFieldAuthorization
		 * @param RoleEntityQtypeCustomFieldAuthorization $objRoleEntityQtypeCustomFieldAuthorization
		 * @return void
		*/ 
		public function UnassociateRoleEntityQtypeCustomFieldAuthorization(RoleEntityQtypeCustomFieldAuthorization $objRoleEntityQtypeCustomFieldAuthorization) {
			if ((is_null($this->intRoleId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateRoleEntityQtypeCustomFieldAuthorization on this unsaved Role.');
			if ((is_null($objRoleEntityQtypeCustomFieldAuthorization->RoleEntityQtypeCustomFieldAuthorizationId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateRoleEntityQtypeCustomFieldAuthorization on this Role with an unsaved RoleEntityQtypeCustomFieldAuthorization.');

			// Get the Database Object for this Class
			$objDatabase = Role::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`role_entity_qtype_custom_field_authorization`
				SET
					`role_id` = null
				WHERE
					`role_entity_qtype_custom_field_authorization_id` = ' . $objDatabase->SqlVariable($objRoleEntityQtypeCustomFieldAuthorization->RoleEntityQtypeCustomFieldAuthorizationId) . ' AND
					`role_id` = ' . $objDatabase->SqlVariable($this->intRoleId) . '
			');
		}

		/**
		 * Unassociates all RoleEntityQtypeCustomFieldAuthorizations
		 * @return void
		*/ 
		public function UnassociateAllRoleEntityQtypeCustomFieldAuthorizations() {
			if ((is_null($this->intRoleId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateRoleEntityQtypeCustomFieldAuthorization on this unsaved Role.');

			// Get the Database Object for this Class
			$objDatabase = Role::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`role_entity_qtype_custom_field_authorization`
				SET
					`role_id` = null
				WHERE
					`role_id` = ' . $objDatabase->SqlVariable($this->intRoleId) . '
			');
		}

		/**
		 * Deletes an associated RoleEntityQtypeCustomFieldAuthorization
		 * @param RoleEntityQtypeCustomFieldAuthorization $objRoleEntityQtypeCustomFieldAuthorization
		 * @return void
		*/ 
		public function DeleteAssociatedRoleEntityQtypeCustomFieldAuthorization(RoleEntityQtypeCustomFieldAuthorization $objRoleEntityQtypeCustomFieldAuthorization) {
			if ((is_null($this->intRoleId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateRoleEntityQtypeCustomFieldAuthorization on this unsaved Role.');
			if ((is_null($objRoleEntityQtypeCustomFieldAuthorization->RoleEntityQtypeCustomFieldAuthorizationId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateRoleEntityQtypeCustomFieldAuthorization on this Role with an unsaved RoleEntityQtypeCustomFieldAuthorization.');

			// Get the Database Object for this Class
			$objDatabase = Role::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`role_entity_qtype_custom_field_authorization`
				WHERE
					`role_entity_qtype_custom_field_authorization_id` = ' . $objDatabase->SqlVariable($objRoleEntityQtypeCustomFieldAuthorization->RoleEntityQtypeCustomFieldAuthorizationId) . ' AND
					`role_id` = ' . $objDatabase->SqlVariable($this->intRoleId) . '
			');
		}

		/**
		 * Deletes all associated RoleEntityQtypeCustomFieldAuthorizations
		 * @return void
		*/ 
		public function DeleteAllRoleEntityQtypeCustomFieldAuthorizations() {
			if ((is_null($this->intRoleId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateRoleEntityQtypeCustomFieldAuthorization on this unsaved Role.');

			// Get the Database Object for this Class
			$objDatabase = Role::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`role_entity_qtype_custom_field_authorization`
				WHERE
					`role_id` = ' . $objDatabase->SqlVariable($this->intRoleId) . '
			');
		}

			
		
		// Related Objects' Methods for RoleModule
		//-------------------------------------------------------------------

		/**
		 * Gets all associated RoleModules as an array of RoleModule objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return RoleModule[]
		*/ 
		public function GetRoleModuleArray($objOptionalClauses = null) {
			if ((is_null($this->intRoleId)))
				return array();

			try {
				return RoleModule::LoadArrayByRoleId($this->intRoleId, $objOptionalClauses);
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
			if ((is_null($this->intRoleId)))
				return 0;

			return RoleModule::CountByRoleId($this->intRoleId);
		}

		/**
		 * Associates a RoleModule
		 * @param RoleModule $objRoleModule
		 * @return void
		*/ 
		public function AssociateRoleModule(RoleModule $objRoleModule) {
			if ((is_null($this->intRoleId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateRoleModule on this unsaved Role.');
			if ((is_null($objRoleModule->RoleModuleId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateRoleModule on this Role with an unsaved RoleModule.');

			// Get the Database Object for this Class
			$objDatabase = Role::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`role_module`
				SET
					`role_id` = ' . $objDatabase->SqlVariable($this->intRoleId) . '
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
			if ((is_null($this->intRoleId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateRoleModule on this unsaved Role.');
			if ((is_null($objRoleModule->RoleModuleId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateRoleModule on this Role with an unsaved RoleModule.');

			// Get the Database Object for this Class
			$objDatabase = Role::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`role_module`
				SET
					`role_id` = null
				WHERE
					`role_module_id` = ' . $objDatabase->SqlVariable($objRoleModule->RoleModuleId) . ' AND
					`role_id` = ' . $objDatabase->SqlVariable($this->intRoleId) . '
			');
		}

		/**
		 * Unassociates all RoleModules
		 * @return void
		*/ 
		public function UnassociateAllRoleModules() {
			if ((is_null($this->intRoleId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateRoleModule on this unsaved Role.');

			// Get the Database Object for this Class
			$objDatabase = Role::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`role_module`
				SET
					`role_id` = null
				WHERE
					`role_id` = ' . $objDatabase->SqlVariable($this->intRoleId) . '
			');
		}

		/**
		 * Deletes an associated RoleModule
		 * @param RoleModule $objRoleModule
		 * @return void
		*/ 
		public function DeleteAssociatedRoleModule(RoleModule $objRoleModule) {
			if ((is_null($this->intRoleId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateRoleModule on this unsaved Role.');
			if ((is_null($objRoleModule->RoleModuleId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateRoleModule on this Role with an unsaved RoleModule.');

			// Get the Database Object for this Class
			$objDatabase = Role::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`role_module`
				WHERE
					`role_module_id` = ' . $objDatabase->SqlVariable($objRoleModule->RoleModuleId) . ' AND
					`role_id` = ' . $objDatabase->SqlVariable($this->intRoleId) . '
			');
		}

		/**
		 * Deletes all associated RoleModules
		 * @return void
		*/ 
		public function DeleteAllRoleModules() {
			if ((is_null($this->intRoleId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateRoleModule on this unsaved Role.');

			// Get the Database Object for this Class
			$objDatabase = Role::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`role_module`
				WHERE
					`role_id` = ' . $objDatabase->SqlVariable($this->intRoleId) . '
			');
		}

			
		
		// Related Objects' Methods for UserAccount
		//-------------------------------------------------------------------

		/**
		 * Gets all associated UserAccounts as an array of UserAccount objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return UserAccount[]
		*/ 
		public function GetUserAccountArray($objOptionalClauses = null) {
			if ((is_null($this->intRoleId)))
				return array();

			try {
				return UserAccount::LoadArrayByRoleId($this->intRoleId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated UserAccounts
		 * @return int
		*/ 
		public function CountUserAccounts() {
			if ((is_null($this->intRoleId)))
				return 0;

			return UserAccount::CountByRoleId($this->intRoleId);
		}

		/**
		 * Associates a UserAccount
		 * @param UserAccount $objUserAccount
		 * @return void
		*/ 
		public function AssociateUserAccount(UserAccount $objUserAccount) {
			if ((is_null($this->intRoleId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateUserAccount on this unsaved Role.');
			if ((is_null($objUserAccount->UserAccountId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateUserAccount on this Role with an unsaved UserAccount.');

			// Get the Database Object for this Class
			$objDatabase = Role::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`user_account`
				SET
					`role_id` = ' . $objDatabase->SqlVariable($this->intRoleId) . '
				WHERE
					`user_account_id` = ' . $objDatabase->SqlVariable($objUserAccount->UserAccountId) . '
			');
		}

		/**
		 * Unassociates a UserAccount
		 * @param UserAccount $objUserAccount
		 * @return void
		*/ 
		public function UnassociateUserAccount(UserAccount $objUserAccount) {
			if ((is_null($this->intRoleId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateUserAccount on this unsaved Role.');
			if ((is_null($objUserAccount->UserAccountId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateUserAccount on this Role with an unsaved UserAccount.');

			// Get the Database Object for this Class
			$objDatabase = Role::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`user_account`
				SET
					`role_id` = null
				WHERE
					`user_account_id` = ' . $objDatabase->SqlVariable($objUserAccount->UserAccountId) . ' AND
					`role_id` = ' . $objDatabase->SqlVariable($this->intRoleId) . '
			');
		}

		/**
		 * Unassociates all UserAccounts
		 * @return void
		*/ 
		public function UnassociateAllUserAccounts() {
			if ((is_null($this->intRoleId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateUserAccount on this unsaved Role.');

			// Get the Database Object for this Class
			$objDatabase = Role::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`user_account`
				SET
					`role_id` = null
				WHERE
					`role_id` = ' . $objDatabase->SqlVariable($this->intRoleId) . '
			');
		}

		/**
		 * Deletes an associated UserAccount
		 * @param UserAccount $objUserAccount
		 * @return void
		*/ 
		public function DeleteAssociatedUserAccount(UserAccount $objUserAccount) {
			if ((is_null($this->intRoleId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateUserAccount on this unsaved Role.');
			if ((is_null($objUserAccount->UserAccountId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateUserAccount on this Role with an unsaved UserAccount.');

			// Get the Database Object for this Class
			$objDatabase = Role::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`user_account`
				WHERE
					`user_account_id` = ' . $objDatabase->SqlVariable($objUserAccount->UserAccountId) . ' AND
					`role_id` = ' . $objDatabase->SqlVariable($this->intRoleId) . '
			');
		}

		/**
		 * Deletes all associated UserAccounts
		 * @return void
		*/ 
		public function DeleteAllUserAccounts() {
			if ((is_null($this->intRoleId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateUserAccount on this unsaved Role.');

			// Get the Database Object for this Class
			$objDatabase = Role::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`user_account`
				WHERE
					`role_id` = ' . $objDatabase->SqlVariable($this->intRoleId) . '
			');
		}




		///////////////////////////////////////////////////////////////////////
		// PROTECTED MEMBER VARIABLES and TEXT FIELD MAXLENGTHS (if applicable)
		///////////////////////////////////////////////////////////////////////
		
		/**
		 * Protected member variable that maps to the database PK Identity column role.role_id
		 * @var integer intRoleId
		 */
		protected $intRoleId;
		const RoleIdDefault = null;


		/**
		 * Protected member variable that maps to the database column role.short_description
		 * @var string strShortDescription
		 */
		protected $strShortDescription;
		const ShortDescriptionMaxLength = 255;
		const ShortDescriptionDefault = null;


		/**
		 * Protected member variable that maps to the database column role.long_description
		 * @var string strLongDescription
		 */
		protected $strLongDescription;
		const LongDescriptionDefault = null;


		/**
		 * Protected member variable that maps to the database column role.created_by
		 * @var integer intCreatedBy
		 */
		protected $intCreatedBy;
		const CreatedByDefault = null;


		/**
		 * Protected member variable that maps to the database column role.creation_date
		 * @var QDateTime dttCreationDate
		 */
		protected $dttCreationDate;
		const CreationDateDefault = null;


		/**
		 * Protected member variable that maps to the database column role.modified_by
		 * @var integer intModifiedBy
		 */
		protected $intModifiedBy;
		const ModifiedByDefault = null;


		/**
		 * Protected member variable that maps to the database column role.modified_date
		 * @var string strModifiedDate
		 */
		protected $strModifiedDate;
		const ModifiedDateDefault = null;


		/**
		 * Private member variable that stores a reference to a single RoleEntityQtypeBuiltInAuthorization object
		 * (of type RoleEntityQtypeBuiltInAuthorization), if this Role object was restored with
		 * an expansion on the role_entity_qtype_built_in_authorization association table.
		 * @var RoleEntityQtypeBuiltInAuthorization _objRoleEntityQtypeBuiltInAuthorization;
		 */
		private $_objRoleEntityQtypeBuiltInAuthorization;

		/**
		 * Private member variable that stores a reference to an array of RoleEntityQtypeBuiltInAuthorization objects
		 * (of type RoleEntityQtypeBuiltInAuthorization[]), if this Role object was restored with
		 * an ExpandAsArray on the role_entity_qtype_built_in_authorization association table.
		 * @var RoleEntityQtypeBuiltInAuthorization[] _objRoleEntityQtypeBuiltInAuthorizationArray;
		 */
		private $_objRoleEntityQtypeBuiltInAuthorizationArray = array();

		/**
		 * Private member variable that stores a reference to a single RoleEntityQtypeCustomFieldAuthorization object
		 * (of type RoleEntityQtypeCustomFieldAuthorization), if this Role object was restored with
		 * an expansion on the role_entity_qtype_custom_field_authorization association table.
		 * @var RoleEntityQtypeCustomFieldAuthorization _objRoleEntityQtypeCustomFieldAuthorization;
		 */
		private $_objRoleEntityQtypeCustomFieldAuthorization;

		/**
		 * Private member variable that stores a reference to an array of RoleEntityQtypeCustomFieldAuthorization objects
		 * (of type RoleEntityQtypeCustomFieldAuthorization[]), if this Role object was restored with
		 * an ExpandAsArray on the role_entity_qtype_custom_field_authorization association table.
		 * @var RoleEntityQtypeCustomFieldAuthorization[] _objRoleEntityQtypeCustomFieldAuthorizationArray;
		 */
		private $_objRoleEntityQtypeCustomFieldAuthorizationArray = array();

		/**
		 * Private member variable that stores a reference to a single RoleModule object
		 * (of type RoleModule), if this Role object was restored with
		 * an expansion on the role_module association table.
		 * @var RoleModule _objRoleModule;
		 */
		private $_objRoleModule;

		/**
		 * Private member variable that stores a reference to an array of RoleModule objects
		 * (of type RoleModule[]), if this Role object was restored with
		 * an ExpandAsArray on the role_module association table.
		 * @var RoleModule[] _objRoleModuleArray;
		 */
		private $_objRoleModuleArray = array();

		/**
		 * Private member variable that stores a reference to a single UserAccount object
		 * (of type UserAccount), if this Role object was restored with
		 * an expansion on the user_account association table.
		 * @var UserAccount _objUserAccount;
		 */
		private $_objUserAccount;

		/**
		 * Private member variable that stores a reference to an array of UserAccount objects
		 * (of type UserAccount[]), if this Role object was restored with
		 * an ExpandAsArray on the user_account association table.
		 * @var UserAccount[] _objUserAccountArray;
		 */
		private $_objUserAccountArray = array();

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
		 * in the database column role.created_by.
		 *
		 * NOTE: Always use the CreatedByObject property getter to correctly retrieve this UserAccount object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var UserAccount objCreatedByObject
		 */
		protected $objCreatedByObject;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column role.modified_by.
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
				$objQueryExpansion = new QQueryExpansion('Role', 'role', $objExpansionMap);
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
				$objQueryExpansion->AddFromItem(sprintf('LEFT JOIN `role` AS `%s__%s` ON `%s`.`%s` = `%s__%s`.`role_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias, $strParentAlias, $strAlias));

				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`role_id` AS `%s__%s__role_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`short_description` AS `%s__%s__short_description`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
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
		const ExpandCreatedByObject = 'created_by';
		const ExpandModifiedByObject = 'modified_by';




		////////////////////////////////////////
		// METHODS for WEB SERVICES
		////////////////////////////////////////

		public static function GetSoapComplexTypeXml() {
			$strToReturn = '<complexType name="Role"><sequence>';
			$strToReturn .= '<element name="RoleId" type="xsd:int"/>';
			$strToReturn .= '<element name="ShortDescription" type="xsd:string"/>';
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
			if (!array_key_exists('Role', $strComplexTypeArray)) {
				$strComplexTypeArray['Role'] = Role::GetSoapComplexTypeXml();
				UserAccount::AlterSoapComplexTypeArray($strComplexTypeArray);
				UserAccount::AlterSoapComplexTypeArray($strComplexTypeArray);
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, Role::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new Role();
			if (property_exists($objSoapObject, 'RoleId'))
				$objToReturn->intRoleId = $objSoapObject->RoleId;
			if (property_exists($objSoapObject, 'ShortDescription'))
				$objToReturn->strShortDescription = $objSoapObject->ShortDescription;
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
				array_push($objArrayToReturn, Role::GetSoapObjectFromObject($objObject, true));

			return unserialize(serialize($objArrayToReturn));
		}

		public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
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

	class QQNodeRole extends QQNode {
		protected $strTableName = 'role';
		protected $strPrimaryKey = 'role_id';
		protected $strClassName = 'Role';
		public function __get($strName) {
			switch ($strName) {
				case 'RoleId':
					return new QQNode('role_id', 'integer', $this);
				case 'ShortDescription':
					return new QQNode('short_description', 'string', $this);
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
				case 'RoleEntityQtypeBuiltInAuthorization':
					return new QQReverseReferenceNodeRoleEntityQtypeBuiltInAuthorization($this, 'roleentityqtypebuiltinauthorization', 'reverse_reference', 'role_id');
				case 'RoleEntityQtypeCustomFieldAuthorization':
					return new QQReverseReferenceNodeRoleEntityQtypeCustomFieldAuthorization($this, 'roleentityqtypecustomfieldauthorization', 'reverse_reference', 'role_id');
				case 'RoleModule':
					return new QQReverseReferenceNodeRoleModule($this, 'rolemodule', 'reverse_reference', 'role_id');
				case 'UserAccount':
					return new QQReverseReferenceNodeUserAccount($this, 'useraccount', 'reverse_reference', 'role_id');

				case '_PrimaryKeyNode':
					return new QQNode('role_id', 'integer', $this);
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

	class QQReverseReferenceNodeRole extends QQReverseReferenceNode {
		protected $strTableName = 'role';
		protected $strPrimaryKey = 'role_id';
		protected $strClassName = 'Role';
		public function __get($strName) {
			switch ($strName) {
				case 'RoleId':
					return new QQNode('role_id', 'integer', $this);
				case 'ShortDescription':
					return new QQNode('short_description', 'string', $this);
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
				case 'RoleEntityQtypeBuiltInAuthorization':
					return new QQReverseReferenceNodeRoleEntityQtypeBuiltInAuthorization($this, 'roleentityqtypebuiltinauthorization', 'reverse_reference', 'role_id');
				case 'RoleEntityQtypeCustomFieldAuthorization':
					return new QQReverseReferenceNodeRoleEntityQtypeCustomFieldAuthorization($this, 'roleentityqtypecustomfieldauthorization', 'reverse_reference', 'role_id');
				case 'RoleModule':
					return new QQReverseReferenceNodeRoleModule($this, 'rolemodule', 'reverse_reference', 'role_id');
				case 'UserAccount':
					return new QQReverseReferenceNodeUserAccount($this, 'useraccount', 'reverse_reference', 'role_id');

				case '_PrimaryKeyNode':
					return new QQNode('role_id', 'integer', $this);
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