<?php
	/**
	 * The abstract EntityQtypeCustomFieldGen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the EntityQtypeCustomField subclass which
	 * extends this EntityQtypeCustomFieldGen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the EntityQtypeCustomField class.
	 * 
	 * @package My Application
	 * @subpackage GeneratedDataObjects
	 * 
	 */
	class EntityQtypeCustomFieldGen extends QBaseClass {
		///////////////////////////////
		// COMMON LOAD METHODS
		///////////////////////////////

		/**
		 * Load a EntityQtypeCustomField from PK Info
		 * @param integer $intEntityQtypeCustomFieldId
		 * @return EntityQtypeCustomField
		 */
		public static function Load($intEntityQtypeCustomFieldId) {
			// Use QuerySingle to Perform the Query
			return EntityQtypeCustomField::QuerySingle(
				QQ::Equal(QQN::EntityQtypeCustomField()->EntityQtypeCustomFieldId, $intEntityQtypeCustomFieldId)
			);
		}

		/**
		 * Load all EntityQtypeCustomFields
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return EntityQtypeCustomField[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			// Call EntityQtypeCustomField::QueryArray to perform the LoadAll query
			try {
				return EntityQtypeCustomField::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all EntityQtypeCustomFields
		 * @return int
		 */
		public static function CountAll() {
			// Call EntityQtypeCustomField::QueryCount to perform the CountAll query
			return EntityQtypeCustomField::QueryCount(QQ::All());
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
			$objDatabase = EntityQtypeCustomField::GetDatabase();

			// Create/Build out the QueryBuilder object with EntityQtypeCustomField-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, 'entity_qtype_custom_field');
			EntityQtypeCustomField::GetSelectFields($objQueryBuilder);
			$objQueryBuilder->AddFromItem('`entity_qtype_custom_field` AS `entity_qtype_custom_field`');

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
		 * Static Qcodo Query method to query for a single EntityQtypeCustomField object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return EntityQtypeCustomField the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = EntityQtypeCustomField::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query, Get the First Row, and Instantiate a new EntityQtypeCustomField object
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return EntityQtypeCustomField::InstantiateDbRow($objDbResult->GetNextRow());
		}

		/**
		 * Static Qcodo Query method to query for an array of EntityQtypeCustomField objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return EntityQtypeCustomField[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = EntityQtypeCustomField::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return EntityQtypeCustomField::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
		}

		/**
		 * Static Qcodo Query method to query for a count of EntityQtypeCustomField objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = EntityQtypeCustomField::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
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
			$objDatabase = EntityQtypeCustomField::GetDatabase();

			// Lookup the QCache for This Query Statement
			$objCache = new QCache('query', 'entity_qtype_custom_field_' . serialize($strConditions));
			if (!($strQuery = $objCache->GetData())) {
				// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with EntityQtypeCustomField-specific fields
				$objQueryBuilder = new QQueryBuilder($objDatabase);
				EntityQtypeCustomField::GetSelectFields($objQueryBuilder);
				EntityQtypeCustomField::GetFromFields($objQueryBuilder);

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
			return EntityQtypeCustomField::InstantiateDbResult($objDbResult);
		}*/

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this EntityQtypeCustomField
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null) {
			if ($strPrefix) {
				$strTableName = '`' . $strPrefix . '`';
				$strAliasPrefix = '`' . $strPrefix . '__';
			} else {
				$strTableName = '`entity_qtype_custom_field`';
				$strAliasPrefix = '`';
			}

			$objBuilder->AddSelectItem($strTableName . '.`entity_qtype_custom_field_id` AS ' . $strAliasPrefix . 'entity_qtype_custom_field_id`');
			$objBuilder->AddSelectItem($strTableName . '.`entity_qtype_id` AS ' . $strAliasPrefix . 'entity_qtype_id`');
			$objBuilder->AddSelectItem($strTableName . '.`custom_field_id` AS ' . $strAliasPrefix . 'custom_field_id`');
		}



		///////////////////////////////
		// INSTANTIATION-RELATED METHODS
		///////////////////////////////

		/**
		 * Instantiate a EntityQtypeCustomField from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this EntityQtypeCustomField::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param DatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @return EntityQtypeCustomField
		*/
		public static function InstantiateDbRow($objDbRow, $strAliasPrefix = null, $strExpandAsArrayNodes = null, $objPreviousItem = null) {
			// If blank row, return null
			if (!$objDbRow)
				return null;

			// See if we're doing an array expansion on the previous item
			if (($strExpandAsArrayNodes) && ($objPreviousItem) &&
				($objPreviousItem->intEntityQtypeCustomFieldId == $objDbRow->GetColumn($strAliasPrefix . 'entity_qtype_custom_field_id', 'Integer'))) {

				// We are.  Now, prepare to check for ExpandAsArray clauses
				$blnExpandedViaArray = false;
				if (!$strAliasPrefix)
					$strAliasPrefix = 'entity_qtype_custom_field__';


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

				// Either return false to signal array expansion, or check-to-reset the Alias prefix and move on
				if ($blnExpandedViaArray)
					return false;
				else if ($strAliasPrefix == 'entity_qtype_custom_field__')
					$strAliasPrefix = null;
			}

			// Create a new instance of the EntityQtypeCustomField object
			$objToReturn = new EntityQtypeCustomField();
			$objToReturn->__blnRestored = true;

			$objToReturn->intEntityQtypeCustomFieldId = $objDbRow->GetColumn($strAliasPrefix . 'entity_qtype_custom_field_id', 'Integer');
			$objToReturn->intEntityQtypeId = $objDbRow->GetColumn($strAliasPrefix . 'entity_qtype_id', 'Integer');
			$objToReturn->intCustomFieldId = $objDbRow->GetColumn($strAliasPrefix . 'custom_field_id', 'Integer');

			// Instantiate Virtual Attributes
			foreach ($objDbRow->GetColumnNameArray() as $strColumnName => $mixValue) {
				$strVirtualPrefix = $strAliasPrefix . '__';
				$strVirtualPrefixLength = strlen($strVirtualPrefix);
				if (substr($strColumnName, 0, $strVirtualPrefixLength) == $strVirtualPrefix)
					$objToReturn->__strVirtualAttributeArray[substr($strColumnName, $strVirtualPrefixLength)] = $mixValue;
			}

			// Prepare to Check for Early/Virtual Binding
			if (!$strAliasPrefix)
				$strAliasPrefix = 'entity_qtype_custom_field__';

			// Check for CustomField Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'custom_field_id__custom_field_id')))
				$objToReturn->objCustomField = CustomField::InstantiateDbRow($objDbRow, $strAliasPrefix . 'custom_field_id__', $strExpandAsArrayNodes);




			// Check for RoleEntityQtypeCustomFieldAuthorization Virtual Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'roleentityqtypecustomfieldauthorization__role_entity_qtype_custom_field_authorization_id'))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'roleentityqtypecustomfieldauthorization__role_entity_qtype_custom_field_authorization_id', $strExpandAsArrayNodes)))
					array_push($objToReturn->_objRoleEntityQtypeCustomFieldAuthorizationArray, RoleEntityQtypeCustomFieldAuthorization::InstantiateDbRow($objDbRow, $strAliasPrefix . 'roleentityqtypecustomfieldauthorization__', $strExpandAsArrayNodes));
				else
					$objToReturn->_objRoleEntityQtypeCustomFieldAuthorization = RoleEntityQtypeCustomFieldAuthorization::InstantiateDbRow($objDbRow, $strAliasPrefix . 'roleentityqtypecustomfieldauthorization__', $strExpandAsArrayNodes);
			}

			return $objToReturn;
		}

		/**
		 * Instantiate an array of EntityQtypeCustomFields from a Database Result
		 * @param DatabaseResultBase $objDbResult
		 * @return EntityQtypeCustomField[]
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
					$objItem = EntityQtypeCustomField::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
					if ($objItem) {
						array_push($objToReturn, $objItem);
						$objLastRowItem = $objItem;
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					array_push($objToReturn, EntityQtypeCustomField::InstantiateDbRow($objDbRow));
			}

			return $objToReturn;
		}



		///////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Single Load and Array)
		///////////////////////////////////////////////////
			
		/**
		 * Load a single EntityQtypeCustomField object,
		 * by EntityQtypeCustomFieldId Index(es)
		 * @param integer $intEntityQtypeCustomFieldId
		 * @return EntityQtypeCustomField
		*/
		public static function LoadByEntityQtypeCustomFieldId($intEntityQtypeCustomFieldId) {
			return EntityQtypeCustomField::QuerySingle(
				QQ::Equal(QQN::EntityQtypeCustomField()->EntityQtypeCustomFieldId, $intEntityQtypeCustomFieldId)
			);
		}
			
		/**
		 * Load an array of EntityQtypeCustomField objects,
		 * by EntityQtypeId Index(es)
		 * @param integer $intEntityQtypeId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return EntityQtypeCustomField[]
		*/
		public static function LoadArrayByEntityQtypeId($intEntityQtypeId, $objOptionalClauses = null) {
			// Call EntityQtypeCustomField::QueryArray to perform the LoadArrayByEntityQtypeId query
			try {
				return EntityQtypeCustomField::QueryArray(
					QQ::Equal(QQN::EntityQtypeCustomField()->EntityQtypeId, $intEntityQtypeId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count EntityQtypeCustomFields
		 * by EntityQtypeId Index(es)
		 * @param integer $intEntityQtypeId
		 * @return int
		*/
		public static function CountByEntityQtypeId($intEntityQtypeId) {
			// Call EntityQtypeCustomField::QueryCount to perform the CountByEntityQtypeId query
			return EntityQtypeCustomField::QueryCount(
				QQ::Equal(QQN::EntityQtypeCustomField()->EntityQtypeId, $intEntityQtypeId)
			);
		}
			
		/**
		 * Load an array of EntityQtypeCustomField objects,
		 * by CustomFieldId Index(es)
		 * @param integer $intCustomFieldId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return EntityQtypeCustomField[]
		*/
		public static function LoadArrayByCustomFieldId($intCustomFieldId, $objOptionalClauses = null) {
			// Call EntityQtypeCustomField::QueryArray to perform the LoadArrayByCustomFieldId query
			try {
				return EntityQtypeCustomField::QueryArray(
					QQ::Equal(QQN::EntityQtypeCustomField()->CustomFieldId, $intCustomFieldId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count EntityQtypeCustomFields
		 * by CustomFieldId Index(es)
		 * @param integer $intCustomFieldId
		 * @return int
		*/
		public static function CountByCustomFieldId($intCustomFieldId) {
			// Call EntityQtypeCustomField::QueryCount to perform the CountByCustomFieldId query
			return EntityQtypeCustomField::QueryCount(
				QQ::Equal(QQN::EntityQtypeCustomField()->CustomFieldId, $intCustomFieldId)
			);
		}



		////////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Array via Many to Many)
		////////////////////////////////////////////////////



		//////////////////
		// SAVE AND DELETE
		//////////////////

		/**
		 * Save this EntityQtypeCustomField
		 * @param bool $blnForceInsert
		 * @param bool $blnForceUpdate
		 * @return int
		*/
		public function Save($blnForceInsert = false, $blnForceUpdate = false) {
			// Get the Database Object for this Class
			$objDatabase = EntityQtypeCustomField::GetDatabase();

			$mixToReturn = null;

			try {
				if ((!$this->__blnRestored) || ($blnForceInsert)) {
					// Perform an INSERT query
					$objDatabase->NonQuery('
						INSERT INTO `entity_qtype_custom_field` (
							`entity_qtype_id`,
							`custom_field_id`
						) VALUES (
							' . $objDatabase->SqlVariable($this->intEntityQtypeId) . ',
							' . $objDatabase->SqlVariable($this->intCustomFieldId) . '
						)
					');

					// Update Identity column and return its value
					$mixToReturn = $this->intEntityQtypeCustomFieldId = $objDatabase->InsertId('entity_qtype_custom_field', 'entity_qtype_custom_field_id');
				} else {
					// Perform an UPDATE query

					// First checking for Optimistic Locking constraints (if applicable)

					// Perform the UPDATE query
					$objDatabase->NonQuery('
						UPDATE
							`entity_qtype_custom_field`
						SET
							`entity_qtype_id` = ' . $objDatabase->SqlVariable($this->intEntityQtypeId) . ',
							`custom_field_id` = ' . $objDatabase->SqlVariable($this->intCustomFieldId) . '
						WHERE
							`entity_qtype_custom_field_id` = ' . $objDatabase->SqlVariable($this->intEntityQtypeCustomFieldId) . '
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
		 * Delete this EntityQtypeCustomField
		 * @return void
		*/
		public function Delete() {
			if ((is_null($this->intEntityQtypeCustomFieldId)))
				throw new QUndefinedPrimaryKeyException('Cannot delete this EntityQtypeCustomField with an unset primary key.');

			// Get the Database Object for this Class
			$objDatabase = EntityQtypeCustomField::GetDatabase();


			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`entity_qtype_custom_field`
				WHERE
					`entity_qtype_custom_field_id` = ' . $objDatabase->SqlVariable($this->intEntityQtypeCustomFieldId) . '');
		}

		/**
		 * Delete all EntityQtypeCustomFields
		 * @return void
		*/
		public static function DeleteAll() {
			// Get the Database Object for this Class
			$objDatabase = EntityQtypeCustomField::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				DELETE FROM
					`entity_qtype_custom_field`');
		}

		/**
		 * Truncate entity_qtype_custom_field table
		 * @return void
		*/
		public static function Truncate() {
			// Get the Database Object for this Class
			$objDatabase = EntityQtypeCustomField::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				TRUNCATE `entity_qtype_custom_field`');
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
				case 'EntityQtypeCustomFieldId':
					/**
					 * Gets the value for intEntityQtypeCustomFieldId (Read-Only PK)
					 * @return integer
					 */
					return $this->intEntityQtypeCustomFieldId;

				case 'EntityQtypeId':
					/**
					 * Gets the value for intEntityQtypeId (Not Null)
					 * @return integer
					 */
					return $this->intEntityQtypeId;

				case 'CustomFieldId':
					/**
					 * Gets the value for intCustomFieldId (Not Null)
					 * @return integer
					 */
					return $this->intCustomFieldId;


				///////////////////
				// Member Objects
				///////////////////
				case 'CustomField':
					/**
					 * Gets the value for the CustomField object referenced by intCustomFieldId (Not Null)
					 * @return CustomField
					 */
					try {
						if ((!$this->objCustomField) && (!is_null($this->intCustomFieldId)))
							$this->objCustomField = CustomField::Load($this->intCustomFieldId);
						return $this->objCustomField;
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}


				////////////////////////////
				// Virtual Object References (Many to Many and Reverse References)
				// (If restored via a "Many-to" expansion)
				////////////////////////////

				case '_RoleEntityQtypeCustomFieldAuthorization':
					/**
					 * Gets the value for the private _objRoleEntityQtypeCustomFieldAuthorization (Read-Only)
					 * if set due to an expansion on the role_entity_qtype_custom_field_authorization.entity_qtype_custom_field_id reverse relationship
					 * @return RoleEntityQtypeCustomFieldAuthorization
					 */
					return $this->_objRoleEntityQtypeCustomFieldAuthorization;

				case '_RoleEntityQtypeCustomFieldAuthorizationArray':
					/**
					 * Gets the value for the private _objRoleEntityQtypeCustomFieldAuthorizationArray (Read-Only)
					 * if set due to an ExpandAsArray on the role_entity_qtype_custom_field_authorization.entity_qtype_custom_field_id reverse relationship
					 * @return RoleEntityQtypeCustomFieldAuthorization[]
					 */
					return (array) $this->_objRoleEntityQtypeCustomFieldAuthorizationArray;

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

				case 'CustomFieldId':
					/**
					 * Sets the value for intCustomFieldId (Not Null)
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						$this->objCustomField = null;
						return ($this->intCustomFieldId = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}


				///////////////////
				// Member Objects
				///////////////////
				case 'CustomField':
					/**
					 * Sets the value for the CustomField object referenced by intCustomFieldId (Not Null)
					 * @param CustomField $mixValue
					 * @return CustomField
					 */
					if (is_null($mixValue)) {
						$this->intCustomFieldId = null;
						$this->objCustomField = null;
						return null;
					} else {
						// Make sure $mixValue actually is a CustomField object
						try {
							$mixValue = QType::Cast($mixValue, 'CustomField');
						} catch (QInvalidCastException $objExc) {
							$objExc->IncrementOffset();
							throw $objExc;
						} 

						// Make sure $mixValue is a SAVED CustomField object
						if (is_null($mixValue->CustomFieldId))
							throw new QCallerException('Unable to set an unsaved CustomField for this EntityQtypeCustomField');

						// Update Local Member Variables
						$this->objCustomField = $mixValue;
						$this->intCustomFieldId = $mixValue->CustomFieldId;

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

			
		
		// Related Objects' Methods for RoleEntityQtypeCustomFieldAuthorization
		//-------------------------------------------------------------------

		/**
		 * Gets all associated RoleEntityQtypeCustomFieldAuthorizations as an array of RoleEntityQtypeCustomFieldAuthorization objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return RoleEntityQtypeCustomFieldAuthorization[]
		*/ 
		public function GetRoleEntityQtypeCustomFieldAuthorizationArray($objOptionalClauses = null) {
			if ((is_null($this->intEntityQtypeCustomFieldId)))
				return array();

			try {
				return RoleEntityQtypeCustomFieldAuthorization::LoadArrayByEntityQtypeCustomFieldId($this->intEntityQtypeCustomFieldId, $objOptionalClauses);
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
			if ((is_null($this->intEntityQtypeCustomFieldId)))
				return 0;

			return RoleEntityQtypeCustomFieldAuthorization::CountByEntityQtypeCustomFieldId($this->intEntityQtypeCustomFieldId);
		}

		/**
		 * Associates a RoleEntityQtypeCustomFieldAuthorization
		 * @param RoleEntityQtypeCustomFieldAuthorization $objRoleEntityQtypeCustomFieldAuthorization
		 * @return void
		*/ 
		public function AssociateRoleEntityQtypeCustomFieldAuthorization(RoleEntityQtypeCustomFieldAuthorization $objRoleEntityQtypeCustomFieldAuthorization) {
			if ((is_null($this->intEntityQtypeCustomFieldId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateRoleEntityQtypeCustomFieldAuthorization on this unsaved EntityQtypeCustomField.');
			if ((is_null($objRoleEntityQtypeCustomFieldAuthorization->RoleEntityQtypeCustomFieldAuthorizationId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateRoleEntityQtypeCustomFieldAuthorization on this EntityQtypeCustomField with an unsaved RoleEntityQtypeCustomFieldAuthorization.');

			// Get the Database Object for this Class
			$objDatabase = EntityQtypeCustomField::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`role_entity_qtype_custom_field_authorization`
				SET
					`entity_qtype_custom_field_id` = ' . $objDatabase->SqlVariable($this->intEntityQtypeCustomFieldId) . '
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
			if ((is_null($this->intEntityQtypeCustomFieldId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateRoleEntityQtypeCustomFieldAuthorization on this unsaved EntityQtypeCustomField.');
			if ((is_null($objRoleEntityQtypeCustomFieldAuthorization->RoleEntityQtypeCustomFieldAuthorizationId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateRoleEntityQtypeCustomFieldAuthorization on this EntityQtypeCustomField with an unsaved RoleEntityQtypeCustomFieldAuthorization.');

			// Get the Database Object for this Class
			$objDatabase = EntityQtypeCustomField::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`role_entity_qtype_custom_field_authorization`
				SET
					`entity_qtype_custom_field_id` = null
				WHERE
					`role_entity_qtype_custom_field_authorization_id` = ' . $objDatabase->SqlVariable($objRoleEntityQtypeCustomFieldAuthorization->RoleEntityQtypeCustomFieldAuthorizationId) . ' AND
					`entity_qtype_custom_field_id` = ' . $objDatabase->SqlVariable($this->intEntityQtypeCustomFieldId) . '
			');
		}

		/**
		 * Unassociates all RoleEntityQtypeCustomFieldAuthorizations
		 * @return void
		*/ 
		public function UnassociateAllRoleEntityQtypeCustomFieldAuthorizations() {
			if ((is_null($this->intEntityQtypeCustomFieldId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateRoleEntityQtypeCustomFieldAuthorization on this unsaved EntityQtypeCustomField.');

			// Get the Database Object for this Class
			$objDatabase = EntityQtypeCustomField::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`role_entity_qtype_custom_field_authorization`
				SET
					`entity_qtype_custom_field_id` = null
				WHERE
					`entity_qtype_custom_field_id` = ' . $objDatabase->SqlVariable($this->intEntityQtypeCustomFieldId) . '
			');
		}

		/**
		 * Deletes an associated RoleEntityQtypeCustomFieldAuthorization
		 * @param RoleEntityQtypeCustomFieldAuthorization $objRoleEntityQtypeCustomFieldAuthorization
		 * @return void
		*/ 
		public function DeleteAssociatedRoleEntityQtypeCustomFieldAuthorization(RoleEntityQtypeCustomFieldAuthorization $objRoleEntityQtypeCustomFieldAuthorization) {
			if ((is_null($this->intEntityQtypeCustomFieldId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateRoleEntityQtypeCustomFieldAuthorization on this unsaved EntityQtypeCustomField.');
			if ((is_null($objRoleEntityQtypeCustomFieldAuthorization->RoleEntityQtypeCustomFieldAuthorizationId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateRoleEntityQtypeCustomFieldAuthorization on this EntityQtypeCustomField with an unsaved RoleEntityQtypeCustomFieldAuthorization.');

			// Get the Database Object for this Class
			$objDatabase = EntityQtypeCustomField::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`role_entity_qtype_custom_field_authorization`
				WHERE
					`role_entity_qtype_custom_field_authorization_id` = ' . $objDatabase->SqlVariable($objRoleEntityQtypeCustomFieldAuthorization->RoleEntityQtypeCustomFieldAuthorizationId) . ' AND
					`entity_qtype_custom_field_id` = ' . $objDatabase->SqlVariable($this->intEntityQtypeCustomFieldId) . '
			');
		}

		/**
		 * Deletes all associated RoleEntityQtypeCustomFieldAuthorizations
		 * @return void
		*/ 
		public function DeleteAllRoleEntityQtypeCustomFieldAuthorizations() {
			if ((is_null($this->intEntityQtypeCustomFieldId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateRoleEntityQtypeCustomFieldAuthorization on this unsaved EntityQtypeCustomField.');

			// Get the Database Object for this Class
			$objDatabase = EntityQtypeCustomField::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`role_entity_qtype_custom_field_authorization`
				WHERE
					`entity_qtype_custom_field_id` = ' . $objDatabase->SqlVariable($this->intEntityQtypeCustomFieldId) . '
			');
		}




		///////////////////////////////////////////////////////////////////////
		// PROTECTED MEMBER VARIABLES and TEXT FIELD MAXLENGTHS (if applicable)
		///////////////////////////////////////////////////////////////////////
		
		/**
		 * Protected member variable that maps to the database PK Identity column entity_qtype_custom_field.entity_qtype_custom_field_id
		 * @var integer intEntityQtypeCustomFieldId
		 */
		protected $intEntityQtypeCustomFieldId;
		const EntityQtypeCustomFieldIdDefault = null;


		/**
		 * Protected member variable that maps to the database column entity_qtype_custom_field.entity_qtype_id
		 * @var integer intEntityQtypeId
		 */
		protected $intEntityQtypeId;
		const EntityQtypeIdDefault = null;


		/**
		 * Protected member variable that maps to the database column entity_qtype_custom_field.custom_field_id
		 * @var integer intCustomFieldId
		 */
		protected $intCustomFieldId;
		const CustomFieldIdDefault = null;


		/**
		 * Private member variable that stores a reference to a single RoleEntityQtypeCustomFieldAuthorization object
		 * (of type RoleEntityQtypeCustomFieldAuthorization), if this EntityQtypeCustomField object was restored with
		 * an expansion on the role_entity_qtype_custom_field_authorization association table.
		 * @var RoleEntityQtypeCustomFieldAuthorization _objRoleEntityQtypeCustomFieldAuthorization;
		 */
		private $_objRoleEntityQtypeCustomFieldAuthorization;

		/**
		 * Private member variable that stores a reference to an array of RoleEntityQtypeCustomFieldAuthorization objects
		 * (of type RoleEntityQtypeCustomFieldAuthorization[]), if this EntityQtypeCustomField object was restored with
		 * an ExpandAsArray on the role_entity_qtype_custom_field_authorization association table.
		 * @var RoleEntityQtypeCustomFieldAuthorization[] _objRoleEntityQtypeCustomFieldAuthorizationArray;
		 */
		private $_objRoleEntityQtypeCustomFieldAuthorizationArray = array();

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
		 * in the database column entity_qtype_custom_field.custom_field_id.
		 *
		 * NOTE: Always use the CustomField property getter to correctly retrieve this CustomField object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var CustomField objCustomField
		 */
		protected $objCustomField;






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
				$objQueryExpansion = new QQueryExpansion('EntityQtypeCustomField', 'entity_qtype_custom_field', $objExpansionMap);
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
				$objQueryExpansion->AddFromItem(sprintf('LEFT JOIN `entity_qtype_custom_field` AS `%s__%s` ON `%s`.`%s` = `%s__%s`.`entity_qtype_custom_field_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias, $strParentAlias, $strAlias));

				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`entity_qtype_custom_field_id` AS `%s__%s__entity_qtype_custom_field_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`entity_qtype_id` AS `%s__%s__entity_qtype_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`custom_field_id` AS `%s__%s__custom_field_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));

				$strParentAlias = $strParentAlias . '__' . $strAlias;
			}

			if (is_array($objExpansionMap))
				foreach ($objExpansionMap as $strKey=>$objValue) {
					switch ($strKey) {
						case 'custom_field_id':
							try {
								CustomField::ExpandQuery($strParentAlias, $strKey, $objValue, $objQueryExpansion);
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
		const ExpandCustomField = 'custom_field_id';




		////////////////////////////////////////
		// METHODS for WEB SERVICES
		////////////////////////////////////////

		public static function GetSoapComplexTypeXml() {
			$strToReturn = '<complexType name="EntityQtypeCustomField"><sequence>';
			$strToReturn .= '<element name="EntityQtypeCustomFieldId" type="xsd:int"/>';
			$strToReturn .= '<element name="EntityQtypeId" type="xsd:int"/>';
			$strToReturn .= '<element name="CustomField" type="xsd1:CustomField"/>';
			$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
			$strToReturn .= '</sequence></complexType>';
			return $strToReturn;
		}

		public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
			if (!array_key_exists('EntityQtypeCustomField', $strComplexTypeArray)) {
				$strComplexTypeArray['EntityQtypeCustomField'] = EntityQtypeCustomField::GetSoapComplexTypeXml();
				CustomField::AlterSoapComplexTypeArray($strComplexTypeArray);
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, EntityQtypeCustomField::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new EntityQtypeCustomField();
			if (property_exists($objSoapObject, 'EntityQtypeCustomFieldId'))
				$objToReturn->intEntityQtypeCustomFieldId = $objSoapObject->EntityQtypeCustomFieldId;
			if (property_exists($objSoapObject, 'EntityQtypeId'))
				$objToReturn->intEntityQtypeId = $objSoapObject->EntityQtypeId;
			if ((property_exists($objSoapObject, 'CustomField')) &&
				($objSoapObject->CustomField))
				$objToReturn->CustomField = CustomField::GetObjectFromSoapObject($objSoapObject->CustomField);
			if (property_exists($objSoapObject, '__blnRestored'))
				$objToReturn->__blnRestored = $objSoapObject->__blnRestored;
			return $objToReturn;
		}

		public static function GetSoapArrayFromArray($objArray) {
			if (!$objArray)
				return null;

			$objArrayToReturn = array();

			foreach ($objArray as $objObject)
				array_push($objArrayToReturn, EntityQtypeCustomField::GetSoapObjectFromObject($objObject, true));

			return unserialize(serialize($objArrayToReturn));
		}

		public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
			if ($objObject->objCustomField)
				$objObject->objCustomField = CustomField::GetSoapObjectFromObject($objObject->objCustomField, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intCustomFieldId = null;
			return $objObject;
		}
	}





	/////////////////////////////////////
	// ADDITIONAL CLASSES for QCODO QUERY
	/////////////////////////////////////

	class QQNodeEntityQtypeCustomField extends QQNode {
		protected $strTableName = 'entity_qtype_custom_field';
		protected $strPrimaryKey = 'entity_qtype_custom_field_id';
		protected $strClassName = 'EntityQtypeCustomField';
		public function __get($strName) {
			switch ($strName) {
				case 'EntityQtypeCustomFieldId':
					return new QQNode('entity_qtype_custom_field_id', 'integer', $this);
				case 'EntityQtypeId':
					return new QQNode('entity_qtype_id', 'integer', $this);
				case 'CustomFieldId':
					return new QQNode('custom_field_id', 'integer', $this);
				case 'CustomField':
					return new QQNodeCustomField('custom_field_id', 'integer', $this);
				case 'RoleEntityQtypeCustomFieldAuthorization':
					return new QQReverseReferenceNodeRoleEntityQtypeCustomFieldAuthorization($this, 'roleentityqtypecustomfieldauthorization', 'reverse_reference', 'entity_qtype_custom_field_id');

				case '_PrimaryKeyNode':
					return new QQNode('entity_qtype_custom_field_id', 'integer', $this);
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

	class QQReverseReferenceNodeEntityQtypeCustomField extends QQReverseReferenceNode {
		protected $strTableName = 'entity_qtype_custom_field';
		protected $strPrimaryKey = 'entity_qtype_custom_field_id';
		protected $strClassName = 'EntityQtypeCustomField';
		public function __get($strName) {
			switch ($strName) {
				case 'EntityQtypeCustomFieldId':
					return new QQNode('entity_qtype_custom_field_id', 'integer', $this);
				case 'EntityQtypeId':
					return new QQNode('entity_qtype_id', 'integer', $this);
				case 'CustomFieldId':
					return new QQNode('custom_field_id', 'integer', $this);
				case 'CustomField':
					return new QQNodeCustomField('custom_field_id', 'integer', $this);
				case 'RoleEntityQtypeCustomFieldAuthorization':
					return new QQReverseReferenceNodeRoleEntityQtypeCustomFieldAuthorization($this, 'roleentityqtypecustomfieldauthorization', 'reverse_reference', 'entity_qtype_custom_field_id');

				case '_PrimaryKeyNode':
					return new QQNode('entity_qtype_custom_field_id', 'integer', $this);
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