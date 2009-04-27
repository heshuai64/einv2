<?php
	/**
	 * The abstract RoleEntityQtypeBuiltInAuthorizationGen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the RoleEntityQtypeBuiltInAuthorization subclass which
	 * extends this RoleEntityQtypeBuiltInAuthorizationGen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the RoleEntityQtypeBuiltInAuthorization class.
	 * 
	 * @package My Application
	 * @subpackage GeneratedDataObjects
	 * 
	 */
	class RoleEntityQtypeBuiltInAuthorizationGen extends QBaseClass {
		///////////////////////////////
		// COMMON LOAD METHODS
		///////////////////////////////

		/**
		 * Load a RoleEntityQtypeBuiltInAuthorization from PK Info
		 * @param integer $intRoleEntityBuiltInId
		 * @return RoleEntityQtypeBuiltInAuthorization
		 */
		public static function Load($intRoleEntityBuiltInId) {
			// Use QuerySingle to Perform the Query
			return RoleEntityQtypeBuiltInAuthorization::QuerySingle(
				QQ::Equal(QQN::RoleEntityQtypeBuiltInAuthorization()->RoleEntityBuiltInId, $intRoleEntityBuiltInId)
			);
		}

		/**
		 * Load all RoleEntityQtypeBuiltInAuthorizations
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return RoleEntityQtypeBuiltInAuthorization[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			// Call RoleEntityQtypeBuiltInAuthorization::QueryArray to perform the LoadAll query
			try {
				return RoleEntityQtypeBuiltInAuthorization::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all RoleEntityQtypeBuiltInAuthorizations
		 * @return int
		 */
		public static function CountAll() {
			// Call RoleEntityQtypeBuiltInAuthorization::QueryCount to perform the CountAll query
			return RoleEntityQtypeBuiltInAuthorization::QueryCount(QQ::All());
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
			$objDatabase = RoleEntityQtypeBuiltInAuthorization::GetDatabase();

			// Create/Build out the QueryBuilder object with RoleEntityQtypeBuiltInAuthorization-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, 'role_entity_qtype_built_in_authorization');
			RoleEntityQtypeBuiltInAuthorization::GetSelectFields($objQueryBuilder);
			$objQueryBuilder->AddFromItem('`role_entity_qtype_built_in_authorization` AS `role_entity_qtype_built_in_authorization`');

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
		 * Static Qcodo Query method to query for a single RoleEntityQtypeBuiltInAuthorization object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return RoleEntityQtypeBuiltInAuthorization the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = RoleEntityQtypeBuiltInAuthorization::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query, Get the First Row, and Instantiate a new RoleEntityQtypeBuiltInAuthorization object
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return RoleEntityQtypeBuiltInAuthorization::InstantiateDbRow($objDbResult->GetNextRow());
		}

		/**
		 * Static Qcodo Query method to query for an array of RoleEntityQtypeBuiltInAuthorization objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return RoleEntityQtypeBuiltInAuthorization[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = RoleEntityQtypeBuiltInAuthorization::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return RoleEntityQtypeBuiltInAuthorization::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
		}

		/**
		 * Static Qcodo Query method to query for a count of RoleEntityQtypeBuiltInAuthorization objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = RoleEntityQtypeBuiltInAuthorization::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
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
			$objDatabase = RoleEntityQtypeBuiltInAuthorization::GetDatabase();

			// Lookup the QCache for This Query Statement
			$objCache = new QCache('query', 'role_entity_qtype_built_in_authorization_' . serialize($strConditions));
			if (!($strQuery = $objCache->GetData())) {
				// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with RoleEntityQtypeBuiltInAuthorization-specific fields
				$objQueryBuilder = new QQueryBuilder($objDatabase);
				RoleEntityQtypeBuiltInAuthorization::GetSelectFields($objQueryBuilder);
				RoleEntityQtypeBuiltInAuthorization::GetFromFields($objQueryBuilder);

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
			return RoleEntityQtypeBuiltInAuthorization::InstantiateDbResult($objDbResult);
		}*/

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this RoleEntityQtypeBuiltInAuthorization
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null) {
			if ($strPrefix) {
				$strTableName = '`' . $strPrefix . '`';
				$strAliasPrefix = '`' . $strPrefix . '__';
			} else {
				$strTableName = '`role_entity_qtype_built_in_authorization`';
				$strAliasPrefix = '`';
			}

			$objBuilder->AddSelectItem($strTableName . '.`role_entity_built_in_id` AS ' . $strAliasPrefix . 'role_entity_built_in_id`');
			$objBuilder->AddSelectItem($strTableName . '.`role_id` AS ' . $strAliasPrefix . 'role_id`');
			$objBuilder->AddSelectItem($strTableName . '.`entity_qtype_id` AS ' . $strAliasPrefix . 'entity_qtype_id`');
			$objBuilder->AddSelectItem($strTableName . '.`authorization_id` AS ' . $strAliasPrefix . 'authorization_id`');
			$objBuilder->AddSelectItem($strTableName . '.`authorized_flag` AS ' . $strAliasPrefix . 'authorized_flag`');
			$objBuilder->AddSelectItem($strTableName . '.`created_by` AS ' . $strAliasPrefix . 'created_by`');
			$objBuilder->AddSelectItem($strTableName . '.`creation_date` AS ' . $strAliasPrefix . 'creation_date`');
			$objBuilder->AddSelectItem($strTableName . '.`modified_by` AS ' . $strAliasPrefix . 'modified_by`');
			$objBuilder->AddSelectItem($strTableName . '.`modified_date` AS ' . $strAliasPrefix . 'modified_date`');
		}



		///////////////////////////////
		// INSTANTIATION-RELATED METHODS
		///////////////////////////////

		/**
		 * Instantiate a RoleEntityQtypeBuiltInAuthorization from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this RoleEntityQtypeBuiltInAuthorization::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param DatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @return RoleEntityQtypeBuiltInAuthorization
		*/
		public static function InstantiateDbRow($objDbRow, $strAliasPrefix = null, $strExpandAsArrayNodes = null, $objPreviousItem = null) {
			// If blank row, return null
			if (!$objDbRow)
				return null;


			// Create a new instance of the RoleEntityQtypeBuiltInAuthorization object
			$objToReturn = new RoleEntityQtypeBuiltInAuthorization();
			$objToReturn->__blnRestored = true;

			$objToReturn->intRoleEntityBuiltInId = $objDbRow->GetColumn($strAliasPrefix . 'role_entity_built_in_id', 'Integer');
			$objToReturn->intRoleId = $objDbRow->GetColumn($strAliasPrefix . 'role_id', 'Integer');
			$objToReturn->intEntityQtypeId = $objDbRow->GetColumn($strAliasPrefix . 'entity_qtype_id', 'Integer');
			$objToReturn->intAuthorizationId = $objDbRow->GetColumn($strAliasPrefix . 'authorization_id', 'Integer');
			$objToReturn->blnAuthorizedFlag = $objDbRow->GetColumn($strAliasPrefix . 'authorized_flag', 'Bit');
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
				$strAliasPrefix = 'role_entity_qtype_built_in_authorization__';

			// Check for Role Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'role_id__role_id')))
				$objToReturn->objRole = Role::InstantiateDbRow($objDbRow, $strAliasPrefix . 'role_id__', $strExpandAsArrayNodes);

			// Check for Authorization Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'authorization_id__authorization_id')))
				$objToReturn->objAuthorization = Authorization::InstantiateDbRow($objDbRow, $strAliasPrefix . 'authorization_id__', $strExpandAsArrayNodes);

			// Check for CreatedByObject Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'created_by__user_account_id')))
				$objToReturn->objCreatedByObject = UserAccount::InstantiateDbRow($objDbRow, $strAliasPrefix . 'created_by__', $strExpandAsArrayNodes);

			// Check for ModifiedByObject Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'modified_by__user_account_id')))
				$objToReturn->objModifiedByObject = UserAccount::InstantiateDbRow($objDbRow, $strAliasPrefix . 'modified_by__', $strExpandAsArrayNodes);




			return $objToReturn;
		}

		/**
		 * Instantiate an array of RoleEntityQtypeBuiltInAuthorizations from a Database Result
		 * @param DatabaseResultBase $objDbResult
		 * @return RoleEntityQtypeBuiltInAuthorization[]
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
					$objItem = RoleEntityQtypeBuiltInAuthorization::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
					if ($objItem) {
						array_push($objToReturn, $objItem);
						$objLastRowItem = $objItem;
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					array_push($objToReturn, RoleEntityQtypeBuiltInAuthorization::InstantiateDbRow($objDbRow));
			}

			return $objToReturn;
		}



		///////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Single Load and Array)
		///////////////////////////////////////////////////
			
		/**
		 * Load a single RoleEntityQtypeBuiltInAuthorization object,
		 * by RoleEntityBuiltInId Index(es)
		 * @param integer $intRoleEntityBuiltInId
		 * @return RoleEntityQtypeBuiltInAuthorization
		*/
		public static function LoadByRoleEntityBuiltInId($intRoleEntityBuiltInId) {
			return RoleEntityQtypeBuiltInAuthorization::QuerySingle(
				QQ::Equal(QQN::RoleEntityQtypeBuiltInAuthorization()->RoleEntityBuiltInId, $intRoleEntityBuiltInId)
			);
		}
			
		/**
		 * Load a single RoleEntityQtypeBuiltInAuthorization object,
		 * by RoleId, EntityQtypeId, AuthorizationId Index(es)
		 * @param integer $intRoleId
		 * @param integer $intEntityQtypeId
		 * @param integer $intAuthorizationId
		 * @return RoleEntityQtypeBuiltInAuthorization
		*/
		public static function LoadByRoleIdEntityQtypeIdAuthorizationId($intRoleId, $intEntityQtypeId, $intAuthorizationId) {
			return RoleEntityQtypeBuiltInAuthorization::QuerySingle(
				QQ::AndCondition(
				QQ::Equal(QQN::RoleEntityQtypeBuiltInAuthorization()->RoleId, $intRoleId),
				QQ::Equal(QQN::RoleEntityQtypeBuiltInAuthorization()->EntityQtypeId, $intEntityQtypeId),
				QQ::Equal(QQN::RoleEntityQtypeBuiltInAuthorization()->AuthorizationId, $intAuthorizationId)
				)
			);
		}
			
		/**
		 * Load an array of RoleEntityQtypeBuiltInAuthorization objects,
		 * by RoleId Index(es)
		 * @param integer $intRoleId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return RoleEntityQtypeBuiltInAuthorization[]
		*/
		public static function LoadArrayByRoleId($intRoleId, $objOptionalClauses = null) {
			// Call RoleEntityQtypeBuiltInAuthorization::QueryArray to perform the LoadArrayByRoleId query
			try {
				return RoleEntityQtypeBuiltInAuthorization::QueryArray(
					QQ::Equal(QQN::RoleEntityQtypeBuiltInAuthorization()->RoleId, $intRoleId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count RoleEntityQtypeBuiltInAuthorizations
		 * by RoleId Index(es)
		 * @param integer $intRoleId
		 * @return int
		*/
		public static function CountByRoleId($intRoleId) {
			// Call RoleEntityQtypeBuiltInAuthorization::QueryCount to perform the CountByRoleId query
			return RoleEntityQtypeBuiltInAuthorization::QueryCount(
				QQ::Equal(QQN::RoleEntityQtypeBuiltInAuthorization()->RoleId, $intRoleId)
			);
		}
			
		/**
		 * Load an array of RoleEntityQtypeBuiltInAuthorization objects,
		 * by EntityQtypeId Index(es)
		 * @param integer $intEntityQtypeId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return RoleEntityQtypeBuiltInAuthorization[]
		*/
		public static function LoadArrayByEntityQtypeId($intEntityQtypeId, $objOptionalClauses = null) {
			// Call RoleEntityQtypeBuiltInAuthorization::QueryArray to perform the LoadArrayByEntityQtypeId query
			try {
				return RoleEntityQtypeBuiltInAuthorization::QueryArray(
					QQ::Equal(QQN::RoleEntityQtypeBuiltInAuthorization()->EntityQtypeId, $intEntityQtypeId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count RoleEntityQtypeBuiltInAuthorizations
		 * by EntityQtypeId Index(es)
		 * @param integer $intEntityQtypeId
		 * @return int
		*/
		public static function CountByEntityQtypeId($intEntityQtypeId) {
			// Call RoleEntityQtypeBuiltInAuthorization::QueryCount to perform the CountByEntityQtypeId query
			return RoleEntityQtypeBuiltInAuthorization::QueryCount(
				QQ::Equal(QQN::RoleEntityQtypeBuiltInAuthorization()->EntityQtypeId, $intEntityQtypeId)
			);
		}
			
		/**
		 * Load an array of RoleEntityQtypeBuiltInAuthorization objects,
		 * by AuthorizationId Index(es)
		 * @param integer $intAuthorizationId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return RoleEntityQtypeBuiltInAuthorization[]
		*/
		public static function LoadArrayByAuthorizationId($intAuthorizationId, $objOptionalClauses = null) {
			// Call RoleEntityQtypeBuiltInAuthorization::QueryArray to perform the LoadArrayByAuthorizationId query
			try {
				return RoleEntityQtypeBuiltInAuthorization::QueryArray(
					QQ::Equal(QQN::RoleEntityQtypeBuiltInAuthorization()->AuthorizationId, $intAuthorizationId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count RoleEntityQtypeBuiltInAuthorizations
		 * by AuthorizationId Index(es)
		 * @param integer $intAuthorizationId
		 * @return int
		*/
		public static function CountByAuthorizationId($intAuthorizationId) {
			// Call RoleEntityQtypeBuiltInAuthorization::QueryCount to perform the CountByAuthorizationId query
			return RoleEntityQtypeBuiltInAuthorization::QueryCount(
				QQ::Equal(QQN::RoleEntityQtypeBuiltInAuthorization()->AuthorizationId, $intAuthorizationId)
			);
		}
			
		/**
		 * Load an array of RoleEntityQtypeBuiltInAuthorization objects,
		 * by CreatedBy Index(es)
		 * @param integer $intCreatedBy
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return RoleEntityQtypeBuiltInAuthorization[]
		*/
		public static function LoadArrayByCreatedBy($intCreatedBy, $objOptionalClauses = null) {
			// Call RoleEntityQtypeBuiltInAuthorization::QueryArray to perform the LoadArrayByCreatedBy query
			try {
				return RoleEntityQtypeBuiltInAuthorization::QueryArray(
					QQ::Equal(QQN::RoleEntityQtypeBuiltInAuthorization()->CreatedBy, $intCreatedBy),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count RoleEntityQtypeBuiltInAuthorizations
		 * by CreatedBy Index(es)
		 * @param integer $intCreatedBy
		 * @return int
		*/
		public static function CountByCreatedBy($intCreatedBy) {
			// Call RoleEntityQtypeBuiltInAuthorization::QueryCount to perform the CountByCreatedBy query
			return RoleEntityQtypeBuiltInAuthorization::QueryCount(
				QQ::Equal(QQN::RoleEntityQtypeBuiltInAuthorization()->CreatedBy, $intCreatedBy)
			);
		}
			
		/**
		 * Load an array of RoleEntityQtypeBuiltInAuthorization objects,
		 * by ModifiedBy Index(es)
		 * @param integer $intModifiedBy
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return RoleEntityQtypeBuiltInAuthorization[]
		*/
		public static function LoadArrayByModifiedBy($intModifiedBy, $objOptionalClauses = null) {
			// Call RoleEntityQtypeBuiltInAuthorization::QueryArray to perform the LoadArrayByModifiedBy query
			try {
				return RoleEntityQtypeBuiltInAuthorization::QueryArray(
					QQ::Equal(QQN::RoleEntityQtypeBuiltInAuthorization()->ModifiedBy, $intModifiedBy),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count RoleEntityQtypeBuiltInAuthorizations
		 * by ModifiedBy Index(es)
		 * @param integer $intModifiedBy
		 * @return int
		*/
		public static function CountByModifiedBy($intModifiedBy) {
			// Call RoleEntityQtypeBuiltInAuthorization::QueryCount to perform the CountByModifiedBy query
			return RoleEntityQtypeBuiltInAuthorization::QueryCount(
				QQ::Equal(QQN::RoleEntityQtypeBuiltInAuthorization()->ModifiedBy, $intModifiedBy)
			);
		}



		////////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Array via Many to Many)
		////////////////////////////////////////////////////



		//////////////////
		// SAVE AND DELETE
		//////////////////

		/**
		 * Save this RoleEntityQtypeBuiltInAuthorization
		 * @param bool $blnForceInsert
		 * @param bool $blnForceUpdate
		 * @return int
		*/
		public function Save($blnForceInsert = false, $blnForceUpdate = false) {
			// Get the Database Object for this Class
			$objDatabase = RoleEntityQtypeBuiltInAuthorization::GetDatabase();

			$mixToReturn = null;

			try {
				if ((!$this->__blnRestored) || ($blnForceInsert)) {
					// Perform an INSERT query
					$objDatabase->NonQuery('
						INSERT INTO `role_entity_qtype_built_in_authorization` (
							`role_id`,
							`entity_qtype_id`,
							`authorization_id`,
							`authorized_flag`,
							`created_by`,
							`creation_date`,
							`modified_by`
						) VALUES (
							' . $objDatabase->SqlVariable($this->intRoleId) . ',
							' . $objDatabase->SqlVariable($this->intEntityQtypeId) . ',
							' . $objDatabase->SqlVariable($this->intAuthorizationId) . ',
							' . $objDatabase->SqlVariable($this->blnAuthorizedFlag) . ',
							' . $objDatabase->SqlVariable($this->intCreatedBy) . ',
							' . $objDatabase->SqlVariable($this->dttCreationDate) . ',
							' . $objDatabase->SqlVariable($this->intModifiedBy) . '
						)
					');

					// Update Identity column and return its value
					$mixToReturn = $this->intRoleEntityBuiltInId = $objDatabase->InsertId('role_entity_qtype_built_in_authorization', 'role_entity_built_in_id');
				} else {
					// Perform an UPDATE query

					// First checking for Optimistic Locking constraints (if applicable)
					if (!$blnForceUpdate) {
						// Perform the Optimistic Locking check
						$objResult = $objDatabase->Query('
							SELECT
								`modified_date`
							FROM
								`role_entity_qtype_built_in_authorization`
							WHERE
								`role_entity_built_in_id` = ' . $objDatabase->SqlVariable($this->intRoleEntityBuiltInId) . '
						');
						
						$objRow = $objResult->FetchArray();
						if ($objRow[0] != $this->strModifiedDate)
							throw new QExtendedOptimisticLockingException('RoleEntityQtypeBuiltInAuthorization', $this->intRoleEntityBuiltInId);
					}

					// Perform the UPDATE query
					$objDatabase->NonQuery('
						UPDATE
							`role_entity_qtype_built_in_authorization`
						SET
							`role_id` = ' . $objDatabase->SqlVariable($this->intRoleId) . ',
							`entity_qtype_id` = ' . $objDatabase->SqlVariable($this->intEntityQtypeId) . ',
							`authorization_id` = ' . $objDatabase->SqlVariable($this->intAuthorizationId) . ',
							`authorized_flag` = ' . $objDatabase->SqlVariable($this->blnAuthorizedFlag) . ',
							`created_by` = ' . $objDatabase->SqlVariable($this->intCreatedBy) . ',
							`creation_date` = ' . $objDatabase->SqlVariable($this->dttCreationDate) . ',
							`modified_by` = ' . $objDatabase->SqlVariable($this->intModifiedBy) . '
						WHERE
							`role_entity_built_in_id` = ' . $objDatabase->SqlVariable($this->intRoleEntityBuiltInId) . '
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
					`role_entity_qtype_built_in_authorization`
				WHERE
					`role_entity_built_in_id` = ' . $objDatabase->SqlVariable($this->intRoleEntityBuiltInId) . '
			');
						
			$objRow = $objResult->FetchArray();
			$this->strModifiedDate = $objRow[0];

			// Return 
			return $mixToReturn;
		}

				/**
		 * Delete this RoleEntityQtypeBuiltInAuthorization
		 * @return void
		*/
		public function Delete() {
			if ((is_null($this->intRoleEntityBuiltInId)))
				throw new QUndefinedPrimaryKeyException('Cannot delete this RoleEntityQtypeBuiltInAuthorization with an unset primary key.');

			// Get the Database Object for this Class
			$objDatabase = RoleEntityQtypeBuiltInAuthorization::GetDatabase();


			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`role_entity_qtype_built_in_authorization`
				WHERE
					`role_entity_built_in_id` = ' . $objDatabase->SqlVariable($this->intRoleEntityBuiltInId) . '');
		}

		/**
		 * Delete all RoleEntityQtypeBuiltInAuthorizations
		 * @return void
		*/
		public static function DeleteAll() {
			// Get the Database Object for this Class
			$objDatabase = RoleEntityQtypeBuiltInAuthorization::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				DELETE FROM
					`role_entity_qtype_built_in_authorization`');
		}

		/**
		 * Truncate role_entity_qtype_built_in_authorization table
		 * @return void
		*/
		public static function Truncate() {
			// Get the Database Object for this Class
			$objDatabase = RoleEntityQtypeBuiltInAuthorization::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				TRUNCATE `role_entity_qtype_built_in_authorization`');
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
				case 'RoleEntityBuiltInId':
					/**
					 * Gets the value for intRoleEntityBuiltInId (Read-Only PK)
					 * @return integer
					 */
					return $this->intRoleEntityBuiltInId;

				case 'RoleId':
					/**
					 * Gets the value for intRoleId (Not Null)
					 * @return integer
					 */
					return $this->intRoleId;

				case 'EntityQtypeId':
					/**
					 * Gets the value for intEntityQtypeId (Not Null)
					 * @return integer
					 */
					return $this->intEntityQtypeId;

				case 'AuthorizationId':
					/**
					 * Gets the value for intAuthorizationId (Not Null)
					 * @return integer
					 */
					return $this->intAuthorizationId;

				case 'AuthorizedFlag':
					/**
					 * Gets the value for blnAuthorizedFlag (Not Null)
					 * @return boolean
					 */
					return $this->blnAuthorizedFlag;

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

				case 'Authorization':
					/**
					 * Gets the value for the Authorization object referenced by intAuthorizationId (Not Null)
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

				case 'AuthorizationId':
					/**
					 * Sets the value for intAuthorizationId (Not Null)
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

				case 'AuthorizedFlag':
					/**
					 * Sets the value for blnAuthorizedFlag (Not Null)
					 * @param boolean $mixValue
					 * @return boolean
					 */
					try {
						return ($this->blnAuthorizedFlag = QType::Cast($mixValue, QType::Boolean));
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
							throw new QCallerException('Unable to set an unsaved Role for this RoleEntityQtypeBuiltInAuthorization');

						// Update Local Member Variables
						$this->objRole = $mixValue;
						$this->intRoleId = $mixValue->RoleId;

						// Return $mixValue
						return $mixValue;
					}
					break;

				case 'Authorization':
					/**
					 * Sets the value for the Authorization object referenced by intAuthorizationId (Not Null)
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
							throw new QCallerException('Unable to set an unsaved Authorization for this RoleEntityQtypeBuiltInAuthorization');

						// Update Local Member Variables
						$this->objAuthorization = $mixValue;
						$this->intAuthorizationId = $mixValue->AuthorizationId;

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
							throw new QCallerException('Unable to set an unsaved CreatedByObject for this RoleEntityQtypeBuiltInAuthorization');

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
							throw new QCallerException('Unable to set an unsaved ModifiedByObject for this RoleEntityQtypeBuiltInAuthorization');

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




		///////////////////////////////////////////////////////////////////////
		// PROTECTED MEMBER VARIABLES and TEXT FIELD MAXLENGTHS (if applicable)
		///////////////////////////////////////////////////////////////////////
		
		/**
		 * Protected member variable that maps to the database PK Identity column role_entity_qtype_built_in_authorization.role_entity_built_in_id
		 * @var integer intRoleEntityBuiltInId
		 */
		protected $intRoleEntityBuiltInId;
		const RoleEntityBuiltInIdDefault = null;


		/**
		 * Protected member variable that maps to the database column role_entity_qtype_built_in_authorization.role_id
		 * @var integer intRoleId
		 */
		protected $intRoleId;
		const RoleIdDefault = null;


		/**
		 * Protected member variable that maps to the database column role_entity_qtype_built_in_authorization.entity_qtype_id
		 * @var integer intEntityQtypeId
		 */
		protected $intEntityQtypeId;
		const EntityQtypeIdDefault = null;


		/**
		 * Protected member variable that maps to the database column role_entity_qtype_built_in_authorization.authorization_id
		 * @var integer intAuthorizationId
		 */
		protected $intAuthorizationId;
		const AuthorizationIdDefault = null;


		/**
		 * Protected member variable that maps to the database column role_entity_qtype_built_in_authorization.authorized_flag
		 * @var boolean blnAuthorizedFlag
		 */
		protected $blnAuthorizedFlag;
		const AuthorizedFlagDefault = null;


		/**
		 * Protected member variable that maps to the database column role_entity_qtype_built_in_authorization.created_by
		 * @var integer intCreatedBy
		 */
		protected $intCreatedBy;
		const CreatedByDefault = null;


		/**
		 * Protected member variable that maps to the database column role_entity_qtype_built_in_authorization.creation_date
		 * @var QDateTime dttCreationDate
		 */
		protected $dttCreationDate;
		const CreationDateDefault = null;


		/**
		 * Protected member variable that maps to the database column role_entity_qtype_built_in_authorization.modified_by
		 * @var integer intModifiedBy
		 */
		protected $intModifiedBy;
		const ModifiedByDefault = null;


		/**
		 * Protected member variable that maps to the database column role_entity_qtype_built_in_authorization.modified_date
		 * @var string strModifiedDate
		 */
		protected $strModifiedDate;
		const ModifiedDateDefault = null;


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
		 * in the database column role_entity_qtype_built_in_authorization.role_id.
		 *
		 * NOTE: Always use the Role property getter to correctly retrieve this Role object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var Role objRole
		 */
		protected $objRole;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column role_entity_qtype_built_in_authorization.authorization_id.
		 *
		 * NOTE: Always use the Authorization property getter to correctly retrieve this Authorization object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var Authorization objAuthorization
		 */
		protected $objAuthorization;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column role_entity_qtype_built_in_authorization.created_by.
		 *
		 * NOTE: Always use the CreatedByObject property getter to correctly retrieve this UserAccount object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var UserAccount objCreatedByObject
		 */
		protected $objCreatedByObject;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column role_entity_qtype_built_in_authorization.modified_by.
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
				$objQueryExpansion = new QQueryExpansion('RoleEntityQtypeBuiltInAuthorization', 'role_entity_qtype_built_in_authorization', $objExpansionMap);
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
				$objQueryExpansion->AddFromItem(sprintf('LEFT JOIN `role_entity_qtype_built_in_authorization` AS `%s__%s` ON `%s`.`%s` = `%s__%s`.`role_entity_built_in_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias, $strParentAlias, $strAlias));

				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`role_entity_built_in_id` AS `%s__%s__role_entity_built_in_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`role_id` AS `%s__%s__role_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`entity_qtype_id` AS `%s__%s__entity_qtype_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`authorization_id` AS `%s__%s__authorization_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`authorized_flag` AS `%s__%s__authorized_flag`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
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
						case 'authorization_id':
							try {
								Authorization::ExpandQuery($strParentAlias, $strKey, $objValue, $objQueryExpansion);
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
		const ExpandAuthorization = 'authorization_id';
		const ExpandCreatedByObject = 'created_by';
		const ExpandModifiedByObject = 'modified_by';




		////////////////////////////////////////
		// METHODS for WEB SERVICES
		////////////////////////////////////////

		public static function GetSoapComplexTypeXml() {
			$strToReturn = '<complexType name="RoleEntityQtypeBuiltInAuthorization"><sequence>';
			$strToReturn .= '<element name="RoleEntityBuiltInId" type="xsd:int"/>';
			$strToReturn .= '<element name="Role" type="xsd1:Role"/>';
			$strToReturn .= '<element name="EntityQtypeId" type="xsd:int"/>';
			$strToReturn .= '<element name="Authorization" type="xsd1:Authorization"/>';
			$strToReturn .= '<element name="AuthorizedFlag" type="xsd:boolean"/>';
			$strToReturn .= '<element name="CreatedByObject" type="xsd1:UserAccount"/>';
			$strToReturn .= '<element name="CreationDate" type="xsd:dateTime"/>';
			$strToReturn .= '<element name="ModifiedByObject" type="xsd1:UserAccount"/>';
			$strToReturn .= '<element name="ModifiedDate" type="xsd:string"/>';
			$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
			$strToReturn .= '</sequence></complexType>';
			return $strToReturn;
		}

		public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
			if (!array_key_exists('RoleEntityQtypeBuiltInAuthorization', $strComplexTypeArray)) {
				$strComplexTypeArray['RoleEntityQtypeBuiltInAuthorization'] = RoleEntityQtypeBuiltInAuthorization::GetSoapComplexTypeXml();
				Role::AlterSoapComplexTypeArray($strComplexTypeArray);
				Authorization::AlterSoapComplexTypeArray($strComplexTypeArray);
				UserAccount::AlterSoapComplexTypeArray($strComplexTypeArray);
				UserAccount::AlterSoapComplexTypeArray($strComplexTypeArray);
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, RoleEntityQtypeBuiltInAuthorization::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new RoleEntityQtypeBuiltInAuthorization();
			if (property_exists($objSoapObject, 'RoleEntityBuiltInId'))
				$objToReturn->intRoleEntityBuiltInId = $objSoapObject->RoleEntityBuiltInId;
			if ((property_exists($objSoapObject, 'Role')) &&
				($objSoapObject->Role))
				$objToReturn->Role = Role::GetObjectFromSoapObject($objSoapObject->Role);
			if (property_exists($objSoapObject, 'EntityQtypeId'))
				$objToReturn->intEntityQtypeId = $objSoapObject->EntityQtypeId;
			if ((property_exists($objSoapObject, 'Authorization')) &&
				($objSoapObject->Authorization))
				$objToReturn->Authorization = Authorization::GetObjectFromSoapObject($objSoapObject->Authorization);
			if (property_exists($objSoapObject, 'AuthorizedFlag'))
				$objToReturn->blnAuthorizedFlag = $objSoapObject->AuthorizedFlag;
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
				array_push($objArrayToReturn, RoleEntityQtypeBuiltInAuthorization::GetSoapObjectFromObject($objObject, true));

			return unserialize(serialize($objArrayToReturn));
		}

		public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
			if ($objObject->objRole)
				$objObject->objRole = Role::GetSoapObjectFromObject($objObject->objRole, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intRoleId = null;
			if ($objObject->objAuthorization)
				$objObject->objAuthorization = Authorization::GetSoapObjectFromObject($objObject->objAuthorization, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intAuthorizationId = null;
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

	class QQNodeRoleEntityQtypeBuiltInAuthorization extends QQNode {
		protected $strTableName = 'role_entity_qtype_built_in_authorization';
		protected $strPrimaryKey = 'role_entity_built_in_id';
		protected $strClassName = 'RoleEntityQtypeBuiltInAuthorization';
		public function __get($strName) {
			switch ($strName) {
				case 'RoleEntityBuiltInId':
					return new QQNode('role_entity_built_in_id', 'integer', $this);
				case 'RoleId':
					return new QQNode('role_id', 'integer', $this);
				case 'Role':
					return new QQNodeRole('role_id', 'integer', $this);
				case 'EntityQtypeId':
					return new QQNode('entity_qtype_id', 'integer', $this);
				case 'AuthorizationId':
					return new QQNode('authorization_id', 'integer', $this);
				case 'Authorization':
					return new QQNodeAuthorization('authorization_id', 'integer', $this);
				case 'AuthorizedFlag':
					return new QQNode('authorized_flag', 'boolean', $this);
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

				case '_PrimaryKeyNode':
					return new QQNode('role_entity_built_in_id', 'integer', $this);
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

	class QQReverseReferenceNodeRoleEntityQtypeBuiltInAuthorization extends QQReverseReferenceNode {
		protected $strTableName = 'role_entity_qtype_built_in_authorization';
		protected $strPrimaryKey = 'role_entity_built_in_id';
		protected $strClassName = 'RoleEntityQtypeBuiltInAuthorization';
		public function __get($strName) {
			switch ($strName) {
				case 'RoleEntityBuiltInId':
					return new QQNode('role_entity_built_in_id', 'integer', $this);
				case 'RoleId':
					return new QQNode('role_id', 'integer', $this);
				case 'Role':
					return new QQNodeRole('role_id', 'integer', $this);
				case 'EntityQtypeId':
					return new QQNode('entity_qtype_id', 'integer', $this);
				case 'AuthorizationId':
					return new QQNode('authorization_id', 'integer', $this);
				case 'Authorization':
					return new QQNodeAuthorization('authorization_id', 'integer', $this);
				case 'AuthorizedFlag':
					return new QQNode('authorized_flag', 'boolean', $this);
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

				case '_PrimaryKeyNode':
					return new QQNode('role_entity_built_in_id', 'integer', $this);
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