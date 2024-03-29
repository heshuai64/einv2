<?php
	/**
	 * The abstract CustomFieldGen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the CustomField subclass which
	 * extends this CustomFieldGen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the CustomField class.
	 * 
	 * @package My Application
	 * @subpackage GeneratedDataObjects
	 * 
	 */
	class CustomFieldGen extends QBaseClass {
		///////////////////////////////
		// COMMON LOAD METHODS
		///////////////////////////////

		/**
		 * Load a CustomField from PK Info
		 * @param integer $intCustomFieldId
		 * @return CustomField
		 */
		public static function Load($intCustomFieldId) {
			// Use QuerySingle to Perform the Query
			return CustomField::QuerySingle(
				QQ::Equal(QQN::CustomField()->CustomFieldId, $intCustomFieldId)
			);
		}

		/**
		 * Load all CustomFields
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return CustomField[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			// Call CustomField::QueryArray to perform the LoadAll query
			try {
				return CustomField::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all CustomFields
		 * @return int
		 */
		public static function CountAll() {
			// Call CustomField::QueryCount to perform the CountAll query
			return CustomField::QueryCount(QQ::All());
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
			$objDatabase = CustomField::GetDatabase();

			// Create/Build out the QueryBuilder object with CustomField-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, 'custom_field');
			CustomField::GetSelectFields($objQueryBuilder);
			$objQueryBuilder->AddFromItem('`custom_field` AS `custom_field`');

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
		 * Static Qcodo Query method to query for a single CustomField object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return CustomField the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = CustomField::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query, Get the First Row, and Instantiate a new CustomField object
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return CustomField::InstantiateDbRow($objDbResult->GetNextRow());
		}

		/**
		 * Static Qcodo Query method to query for an array of CustomField objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return CustomField[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = CustomField::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return CustomField::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
		}

		/**
		 * Static Qcodo Query method to query for a count of CustomField objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = CustomField::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
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
			$objDatabase = CustomField::GetDatabase();

			// Lookup the QCache for This Query Statement
			$objCache = new QCache('query', 'custom_field_' . serialize($strConditions));
			if (!($strQuery = $objCache->GetData())) {
				// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with CustomField-specific fields
				$objQueryBuilder = new QQueryBuilder($objDatabase);
				CustomField::GetSelectFields($objQueryBuilder);
				CustomField::GetFromFields($objQueryBuilder);

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
			return CustomField::InstantiateDbResult($objDbResult);
		}*/

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this CustomField
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null) {
			if ($strPrefix) {
				$strTableName = '`' . $strPrefix . '`';
				$strAliasPrefix = '`' . $strPrefix . '__';
			} else {
				$strTableName = '`custom_field`';
				$strAliasPrefix = '`';
			}

			$objBuilder->AddSelectItem($strTableName . '.`custom_field_id` AS ' . $strAliasPrefix . 'custom_field_id`');
			$objBuilder->AddSelectItem($strTableName . '.`custom_field_qtype_id` AS ' . $strAliasPrefix . 'custom_field_qtype_id`');
			$objBuilder->AddSelectItem($strTableName . '.`default_custom_field_value_id` AS ' . $strAliasPrefix . 'default_custom_field_value_id`');
			$objBuilder->AddSelectItem($strTableName . '.`short_description` AS ' . $strAliasPrefix . 'short_description`');
			$objBuilder->AddSelectItem($strTableName . '.`active_flag` AS ' . $strAliasPrefix . 'active_flag`');
			$objBuilder->AddSelectItem($strTableName . '.`required_flag` AS ' . $strAliasPrefix . 'required_flag`');
			$objBuilder->AddSelectItem($strTableName . '.`created_by` AS ' . $strAliasPrefix . 'created_by`');
			$objBuilder->AddSelectItem($strTableName . '.`creation_date` AS ' . $strAliasPrefix . 'creation_date`');
			$objBuilder->AddSelectItem($strTableName . '.`modified_by` AS ' . $strAliasPrefix . 'modified_by`');
			$objBuilder->AddSelectItem($strTableName . '.`modified_date` AS ' . $strAliasPrefix . 'modified_date`');
		}



		///////////////////////////////
		// INSTANTIATION-RELATED METHODS
		///////////////////////////////

		/**
		 * Instantiate a CustomField from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this CustomField::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param DatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @return CustomField
		*/
		public static function InstantiateDbRow($objDbRow, $strAliasPrefix = null, $strExpandAsArrayNodes = null, $objPreviousItem = null) {
			// If blank row, return null
			if (!$objDbRow)
				return null;

			// See if we're doing an array expansion on the previous item
			if (($strExpandAsArrayNodes) && ($objPreviousItem) &&
				($objPreviousItem->intCustomFieldId == $objDbRow->GetColumn($strAliasPrefix . 'custom_field_id', 'Integer'))) {

				// We are.  Now, prepare to check for ExpandAsArray clauses
				$blnExpandedViaArray = false;
				if (!$strAliasPrefix)
					$strAliasPrefix = 'custom_field__';


				if ((array_key_exists($strAliasPrefix . 'customfieldvalue__custom_field_value_id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'customfieldvalue__custom_field_value_id')))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objCustomFieldValueArray)) {
						$objPreviousChildItem = $objPreviousItem->_objCustomFieldValueArray[$intPreviousChildItemCount - 1];
						$objChildItem = CustomFieldValue::InstantiateDbRow($objDbRow, $strAliasPrefix . 'customfieldvalue__', $strExpandAsArrayNodes, $objPreviousChildItem);
						if ($objChildItem)
							array_push($objPreviousItem->_objCustomFieldValueArray, $objChildItem);
					} else
						array_push($objPreviousItem->_objCustomFieldValueArray, CustomFieldValue::InstantiateDbRow($objDbRow, $strAliasPrefix . 'customfieldvalue__', $strExpandAsArrayNodes));
					$blnExpandedViaArray = true;
				}

				if ((array_key_exists($strAliasPrefix . 'entityqtypecustomfield__entity_qtype_custom_field_id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'entityqtypecustomfield__entity_qtype_custom_field_id')))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objEntityQtypeCustomFieldArray)) {
						$objPreviousChildItem = $objPreviousItem->_objEntityQtypeCustomFieldArray[$intPreviousChildItemCount - 1];
						$objChildItem = EntityQtypeCustomField::InstantiateDbRow($objDbRow, $strAliasPrefix . 'entityqtypecustomfield__', $strExpandAsArrayNodes, $objPreviousChildItem);
						if ($objChildItem)
							array_push($objPreviousItem->_objEntityQtypeCustomFieldArray, $objChildItem);
					} else
						array_push($objPreviousItem->_objEntityQtypeCustomFieldArray, EntityQtypeCustomField::InstantiateDbRow($objDbRow, $strAliasPrefix . 'entityqtypecustomfield__', $strExpandAsArrayNodes));
					$blnExpandedViaArray = true;
				}

				// Either return false to signal array expansion, or check-to-reset the Alias prefix and move on
				if ($blnExpandedViaArray)
					return false;
				else if ($strAliasPrefix == 'custom_field__')
					$strAliasPrefix = null;
			}

			// Create a new instance of the CustomField object
			$objToReturn = new CustomField();
			$objToReturn->__blnRestored = true;

			$objToReturn->intCustomFieldId = $objDbRow->GetColumn($strAliasPrefix . 'custom_field_id', 'Integer');
			$objToReturn->intCustomFieldQtypeId = $objDbRow->GetColumn($strAliasPrefix . 'custom_field_qtype_id', 'Integer');
			$objToReturn->intDefaultCustomFieldValueId = $objDbRow->GetColumn($strAliasPrefix . 'default_custom_field_value_id', 'Integer');
			$objToReturn->strShortDescription = $objDbRow->GetColumn($strAliasPrefix . 'short_description', 'VarChar');
			$objToReturn->blnActiveFlag = $objDbRow->GetColumn($strAliasPrefix . 'active_flag', 'Bit');
			$objToReturn->blnRequiredFlag = $objDbRow->GetColumn($strAliasPrefix . 'required_flag', 'Bit');
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
				$strAliasPrefix = 'custom_field__';

			// Check for DefaultCustomFieldValue Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'default_custom_field_value_id__custom_field_value_id')))
				$objToReturn->objDefaultCustomFieldValue = CustomFieldValue::InstantiateDbRow($objDbRow, $strAliasPrefix . 'default_custom_field_value_id__', $strExpandAsArrayNodes);

			// Check for CreatedByObject Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'created_by__user_account_id')))
				$objToReturn->objCreatedByObject = UserAccount::InstantiateDbRow($objDbRow, $strAliasPrefix . 'created_by__', $strExpandAsArrayNodes);

			// Check for ModifiedByObject Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'modified_by__user_account_id')))
				$objToReturn->objModifiedByObject = UserAccount::InstantiateDbRow($objDbRow, $strAliasPrefix . 'modified_by__', $strExpandAsArrayNodes);




			// Check for CustomFieldValue Virtual Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'customfieldvalue__custom_field_value_id'))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'customfieldvalue__custom_field_value_id', $strExpandAsArrayNodes)))
					array_push($objToReturn->_objCustomFieldValueArray, CustomFieldValue::InstantiateDbRow($objDbRow, $strAliasPrefix . 'customfieldvalue__', $strExpandAsArrayNodes));
				else
					$objToReturn->_objCustomFieldValue = CustomFieldValue::InstantiateDbRow($objDbRow, $strAliasPrefix . 'customfieldvalue__', $strExpandAsArrayNodes);
			}

			// Check for EntityQtypeCustomField Virtual Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'entityqtypecustomfield__entity_qtype_custom_field_id'))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'entityqtypecustomfield__entity_qtype_custom_field_id', $strExpandAsArrayNodes)))
					array_push($objToReturn->_objEntityQtypeCustomFieldArray, EntityQtypeCustomField::InstantiateDbRow($objDbRow, $strAliasPrefix . 'entityqtypecustomfield__', $strExpandAsArrayNodes));
				else
					$objToReturn->_objEntityQtypeCustomField = EntityQtypeCustomField::InstantiateDbRow($objDbRow, $strAliasPrefix . 'entityqtypecustomfield__', $strExpandAsArrayNodes);
			}

			return $objToReturn;
		}

		/**
		 * Instantiate an array of CustomFields from a Database Result
		 * @param DatabaseResultBase $objDbResult
		 * @return CustomField[]
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
					$objItem = CustomField::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
					if ($objItem) {
						array_push($objToReturn, $objItem);
						$objLastRowItem = $objItem;
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					array_push($objToReturn, CustomField::InstantiateDbRow($objDbRow));
			}

			return $objToReturn;
		}



		///////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Single Load and Array)
		///////////////////////////////////////////////////
			
		/**
		 * Load a single CustomField object,
		 * by CustomFieldId Index(es)
		 * @param integer $intCustomFieldId
		 * @return CustomField
		*/
		public static function LoadByCustomFieldId($intCustomFieldId) {
			return CustomField::QuerySingle(
				QQ::Equal(QQN::CustomField()->CustomFieldId, $intCustomFieldId)
			);
		}
			
		/**
		 * Load an array of CustomField objects,
		 * by ModifiedBy Index(es)
		 * @param integer $intModifiedBy
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return CustomField[]
		*/
		public static function LoadArrayByModifiedBy($intModifiedBy, $objOptionalClauses = null) {
			// Call CustomField::QueryArray to perform the LoadArrayByModifiedBy query
			try {
				return CustomField::QueryArray(
					QQ::Equal(QQN::CustomField()->ModifiedBy, $intModifiedBy),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count CustomFields
		 * by ModifiedBy Index(es)
		 * @param integer $intModifiedBy
		 * @return int
		*/
		public static function CountByModifiedBy($intModifiedBy) {
			// Call CustomField::QueryCount to perform the CountByModifiedBy query
			return CustomField::QueryCount(
				QQ::Equal(QQN::CustomField()->ModifiedBy, $intModifiedBy)
			);
		}
			
		/**
		 * Load an array of CustomField objects,
		 * by CreatedBy Index(es)
		 * @param integer $intCreatedBy
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return CustomField[]
		*/
		public static function LoadArrayByCreatedBy($intCreatedBy, $objOptionalClauses = null) {
			// Call CustomField::QueryArray to perform the LoadArrayByCreatedBy query
			try {
				return CustomField::QueryArray(
					QQ::Equal(QQN::CustomField()->CreatedBy, $intCreatedBy),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count CustomFields
		 * by CreatedBy Index(es)
		 * @param integer $intCreatedBy
		 * @return int
		*/
		public static function CountByCreatedBy($intCreatedBy) {
			// Call CustomField::QueryCount to perform the CountByCreatedBy query
			return CustomField::QueryCount(
				QQ::Equal(QQN::CustomField()->CreatedBy, $intCreatedBy)
			);
		}
			
		/**
		 * Load an array of CustomField objects,
		 * by CustomFieldQtypeId Index(es)
		 * @param integer $intCustomFieldQtypeId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return CustomField[]
		*/
		public static function LoadArrayByCustomFieldQtypeId($intCustomFieldQtypeId, $objOptionalClauses = null) {
			// Call CustomField::QueryArray to perform the LoadArrayByCustomFieldQtypeId query
			try {
				return CustomField::QueryArray(
					QQ::Equal(QQN::CustomField()->CustomFieldQtypeId, $intCustomFieldQtypeId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count CustomFields
		 * by CustomFieldQtypeId Index(es)
		 * @param integer $intCustomFieldQtypeId
		 * @return int
		*/
		public static function CountByCustomFieldQtypeId($intCustomFieldQtypeId) {
			// Call CustomField::QueryCount to perform the CountByCustomFieldQtypeId query
			return CustomField::QueryCount(
				QQ::Equal(QQN::CustomField()->CustomFieldQtypeId, $intCustomFieldQtypeId)
			);
		}
			
		/**
		 * Load an array of CustomField objects,
		 * by DefaultCustomFieldValueId Index(es)
		 * @param integer $intDefaultCustomFieldValueId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return CustomField[]
		*/
		public static function LoadArrayByDefaultCustomFieldValueId($intDefaultCustomFieldValueId, $objOptionalClauses = null) {
			// Call CustomField::QueryArray to perform the LoadArrayByDefaultCustomFieldValueId query
			try {
				return CustomField::QueryArray(
					QQ::Equal(QQN::CustomField()->DefaultCustomFieldValueId, $intDefaultCustomFieldValueId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count CustomFields
		 * by DefaultCustomFieldValueId Index(es)
		 * @param integer $intDefaultCustomFieldValueId
		 * @return int
		*/
		public static function CountByDefaultCustomFieldValueId($intDefaultCustomFieldValueId) {
			// Call CustomField::QueryCount to perform the CountByDefaultCustomFieldValueId query
			return CustomField::QueryCount(
				QQ::Equal(QQN::CustomField()->DefaultCustomFieldValueId, $intDefaultCustomFieldValueId)
			);
		}



		////////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Array via Many to Many)
		////////////////////////////////////////////////////



		//////////////////
		// SAVE AND DELETE
		//////////////////

		/**
		 * Save this CustomField
		 * @param bool $blnForceInsert
		 * @param bool $blnForceUpdate
		 * @return int
		*/
		public function Save($blnForceInsert = false, $blnForceUpdate = false) {
			// Get the Database Object for this Class
			$objDatabase = CustomField::GetDatabase();

			$mixToReturn = null;

			try {
				if ((!$this->__blnRestored) || ($blnForceInsert)) {
					// Perform an INSERT query
					$objDatabase->NonQuery('
						INSERT INTO `custom_field` (
							`custom_field_qtype_id`,
							`default_custom_field_value_id`,
							`short_description`,
							`active_flag`,
							`required_flag`,
							`created_by`,
							`creation_date`,
							`modified_by`
						) VALUES (
							' . $objDatabase->SqlVariable($this->intCustomFieldQtypeId) . ',
							' . $objDatabase->SqlVariable($this->intDefaultCustomFieldValueId) . ',
							' . $objDatabase->SqlVariable($this->strShortDescription) . ',
							' . $objDatabase->SqlVariable($this->blnActiveFlag) . ',
							' . $objDatabase->SqlVariable($this->blnRequiredFlag) . ',
							' . $objDatabase->SqlVariable($this->intCreatedBy) . ',
							' . $objDatabase->SqlVariable($this->dttCreationDate) . ',
							' . $objDatabase->SqlVariable($this->intModifiedBy) . '
						)
					');

					// Update Identity column and return its value
					$mixToReturn = $this->intCustomFieldId = $objDatabase->InsertId('custom_field', 'custom_field_id');
				} else {
					// Perform an UPDATE query

					// First checking for Optimistic Locking constraints (if applicable)
					if (!$blnForceUpdate) {
						// Perform the Optimistic Locking check
						$objResult = $objDatabase->Query('
							SELECT
								`modified_date`
							FROM
								`custom_field`
							WHERE
								`custom_field_id` = ' . $objDatabase->SqlVariable($this->intCustomFieldId) . '
						');
						
						$objRow = $objResult->FetchArray();
						if ($objRow[0] != $this->strModifiedDate)
							throw new QExtendedOptimisticLockingException('CustomField', $this->intCustomFieldId);
					}

					// Perform the UPDATE query
					$objDatabase->NonQuery('
						UPDATE
							`custom_field`
						SET
							`custom_field_qtype_id` = ' . $objDatabase->SqlVariable($this->intCustomFieldQtypeId) . ',
							`default_custom_field_value_id` = ' . $objDatabase->SqlVariable($this->intDefaultCustomFieldValueId) . ',
							`short_description` = ' . $objDatabase->SqlVariable($this->strShortDescription) . ',
							`active_flag` = ' . $objDatabase->SqlVariable($this->blnActiveFlag) . ',
							`required_flag` = ' . $objDatabase->SqlVariable($this->blnRequiredFlag) . ',
							`created_by` = ' . $objDatabase->SqlVariable($this->intCreatedBy) . ',
							`creation_date` = ' . $objDatabase->SqlVariable($this->dttCreationDate) . ',
							`modified_by` = ' . $objDatabase->SqlVariable($this->intModifiedBy) . '
						WHERE
							`custom_field_id` = ' . $objDatabase->SqlVariable($this->intCustomFieldId) . '
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
					`custom_field`
				WHERE
					`custom_field_id` = ' . $objDatabase->SqlVariable($this->intCustomFieldId) . '
			');
						
			$objRow = $objResult->FetchArray();
			$this->strModifiedDate = $objRow[0];

			// Return 
			return $mixToReturn;
		}

				/**
		 * Delete this CustomField
		 * @return void
		*/
		public function Delete() {
			if ((is_null($this->intCustomFieldId)))
				throw new QUndefinedPrimaryKeyException('Cannot delete this CustomField with an unset primary key.');

			// Get the Database Object for this Class
			$objDatabase = CustomField::GetDatabase();


			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`custom_field`
				WHERE
					`custom_field_id` = ' . $objDatabase->SqlVariable($this->intCustomFieldId) . '');
		}

		/**
		 * Delete all CustomFields
		 * @return void
		*/
		public static function DeleteAll() {
			// Get the Database Object for this Class
			$objDatabase = CustomField::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				DELETE FROM
					`custom_field`');
		}

		/**
		 * Truncate custom_field table
		 * @return void
		*/
		public static function Truncate() {
			// Get the Database Object for this Class
			$objDatabase = CustomField::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				TRUNCATE `custom_field`');
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
				case 'CustomFieldId':
					/**
					 * Gets the value for intCustomFieldId (Read-Only PK)
					 * @return integer
					 */
					return $this->intCustomFieldId;

				case 'CustomFieldQtypeId':
					/**
					 * Gets the value for intCustomFieldQtypeId (Not Null)
					 * @return integer
					 */
					return $this->intCustomFieldQtypeId;

				case 'DefaultCustomFieldValueId':
					/**
					 * Gets the value for intDefaultCustomFieldValueId 
					 * @return integer
					 */
					return $this->intDefaultCustomFieldValueId;

				case 'ShortDescription':
					/**
					 * Gets the value for strShortDescription (Not Null)
					 * @return string
					 */
					return $this->strShortDescription;

				case 'ActiveFlag':
					/**
					 * Gets the value for blnActiveFlag 
					 * @return boolean
					 */
					return $this->blnActiveFlag;

				case 'RequiredFlag':
					/**
					 * Gets the value for blnRequiredFlag 
					 * @return boolean
					 */
					return $this->blnRequiredFlag;

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
				case 'DefaultCustomFieldValue':
					/**
					 * Gets the value for the CustomFieldValue object referenced by intDefaultCustomFieldValueId 
					 * @return CustomFieldValue
					 */
					try {
						if ((!$this->objDefaultCustomFieldValue) && (!is_null($this->intDefaultCustomFieldValueId)))
							$this->objDefaultCustomFieldValue = CustomFieldValue::Load($this->intDefaultCustomFieldValueId);
						return $this->objDefaultCustomFieldValue;
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

				case '_CustomFieldValue':
					/**
					 * Gets the value for the private _objCustomFieldValue (Read-Only)
					 * if set due to an expansion on the custom_field_value.custom_field_id reverse relationship
					 * @return CustomFieldValue
					 */
					return $this->_objCustomFieldValue;

				case '_CustomFieldValueArray':
					/**
					 * Gets the value for the private _objCustomFieldValueArray (Read-Only)
					 * if set due to an ExpandAsArray on the custom_field_value.custom_field_id reverse relationship
					 * @return CustomFieldValue[]
					 */
					return (array) $this->_objCustomFieldValueArray;

				case '_EntityQtypeCustomField':
					/**
					 * Gets the value for the private _objEntityQtypeCustomField (Read-Only)
					 * if set due to an expansion on the entity_qtype_custom_field.custom_field_id reverse relationship
					 * @return EntityQtypeCustomField
					 */
					return $this->_objEntityQtypeCustomField;

				case '_EntityQtypeCustomFieldArray':
					/**
					 * Gets the value for the private _objEntityQtypeCustomFieldArray (Read-Only)
					 * if set due to an ExpandAsArray on the entity_qtype_custom_field.custom_field_id reverse relationship
					 * @return EntityQtypeCustomField[]
					 */
					return (array) $this->_objEntityQtypeCustomFieldArray;

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
				case 'CustomFieldQtypeId':
					/**
					 * Sets the value for intCustomFieldQtypeId (Not Null)
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						return ($this->intCustomFieldQtypeId = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'DefaultCustomFieldValueId':
					/**
					 * Sets the value for intDefaultCustomFieldValueId 
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						$this->objDefaultCustomFieldValue = null;
						return ($this->intDefaultCustomFieldValueId = QType::Cast($mixValue, QType::Integer));
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

				case 'ActiveFlag':
					/**
					 * Sets the value for blnActiveFlag 
					 * @param boolean $mixValue
					 * @return boolean
					 */
					try {
						return ($this->blnActiveFlag = QType::Cast($mixValue, QType::Boolean));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'RequiredFlag':
					/**
					 * Sets the value for blnRequiredFlag 
					 * @param boolean $mixValue
					 * @return boolean
					 */
					try {
						return ($this->blnRequiredFlag = QType::Cast($mixValue, QType::Boolean));
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
				case 'DefaultCustomFieldValue':
					/**
					 * Sets the value for the CustomFieldValue object referenced by intDefaultCustomFieldValueId 
					 * @param CustomFieldValue $mixValue
					 * @return CustomFieldValue
					 */
					if (is_null($mixValue)) {
						$this->intDefaultCustomFieldValueId = null;
						$this->objDefaultCustomFieldValue = null;
						return null;
					} else {
						// Make sure $mixValue actually is a CustomFieldValue object
						try {
							$mixValue = QType::Cast($mixValue, 'CustomFieldValue');
						} catch (QInvalidCastException $objExc) {
							$objExc->IncrementOffset();
							throw $objExc;
						} 

						// Make sure $mixValue is a SAVED CustomFieldValue object
						if (is_null($mixValue->CustomFieldValueId))
							throw new QCallerException('Unable to set an unsaved DefaultCustomFieldValue for this CustomField');

						// Update Local Member Variables
						$this->objDefaultCustomFieldValue = $mixValue;
						$this->intDefaultCustomFieldValueId = $mixValue->CustomFieldValueId;

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
							throw new QCallerException('Unable to set an unsaved CreatedByObject for this CustomField');

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
							throw new QCallerException('Unable to set an unsaved ModifiedByObject for this CustomField');

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

			
		
		// Related Objects' Methods for CustomFieldValue
		//-------------------------------------------------------------------

		/**
		 * Gets all associated CustomFieldValues as an array of CustomFieldValue objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return CustomFieldValue[]
		*/ 
		public function GetCustomFieldValueArray($objOptionalClauses = null) {
			if ((is_null($this->intCustomFieldId)))
				return array();

			try {
				return CustomFieldValue::LoadArrayByCustomFieldId($this->intCustomFieldId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated CustomFieldValues
		 * @return int
		*/ 
		public function CountCustomFieldValues() {
			if ((is_null($this->intCustomFieldId)))
				return 0;

			return CustomFieldValue::CountByCustomFieldId($this->intCustomFieldId);
		}

		/**
		 * Associates a CustomFieldValue
		 * @param CustomFieldValue $objCustomFieldValue
		 * @return void
		*/ 
		public function AssociateCustomFieldValue(CustomFieldValue $objCustomFieldValue) {
			if ((is_null($this->intCustomFieldId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateCustomFieldValue on this unsaved CustomField.');
			if ((is_null($objCustomFieldValue->CustomFieldValueId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateCustomFieldValue on this CustomField with an unsaved CustomFieldValue.');

			// Get the Database Object for this Class
			$objDatabase = CustomField::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`custom_field_value`
				SET
					`custom_field_id` = ' . $objDatabase->SqlVariable($this->intCustomFieldId) . '
				WHERE
					`custom_field_value_id` = ' . $objDatabase->SqlVariable($objCustomFieldValue->CustomFieldValueId) . '
			');
		}

		/**
		 * Unassociates a CustomFieldValue
		 * @param CustomFieldValue $objCustomFieldValue
		 * @return void
		*/ 
		public function UnassociateCustomFieldValue(CustomFieldValue $objCustomFieldValue) {
			if ((is_null($this->intCustomFieldId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateCustomFieldValue on this unsaved CustomField.');
			if ((is_null($objCustomFieldValue->CustomFieldValueId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateCustomFieldValue on this CustomField with an unsaved CustomFieldValue.');

			// Get the Database Object for this Class
			$objDatabase = CustomField::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`custom_field_value`
				SET
					`custom_field_id` = null
				WHERE
					`custom_field_value_id` = ' . $objDatabase->SqlVariable($objCustomFieldValue->CustomFieldValueId) . ' AND
					`custom_field_id` = ' . $objDatabase->SqlVariable($this->intCustomFieldId) . '
			');
		}

		/**
		 * Unassociates all CustomFieldValues
		 * @return void
		*/ 
		public function UnassociateAllCustomFieldValues() {
			if ((is_null($this->intCustomFieldId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateCustomFieldValue on this unsaved CustomField.');

			// Get the Database Object for this Class
			$objDatabase = CustomField::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`custom_field_value`
				SET
					`custom_field_id` = null
				WHERE
					`custom_field_id` = ' . $objDatabase->SqlVariable($this->intCustomFieldId) . '
			');
		}

		/**
		 * Deletes an associated CustomFieldValue
		 * @param CustomFieldValue $objCustomFieldValue
		 * @return void
		*/ 
		public function DeleteAssociatedCustomFieldValue(CustomFieldValue $objCustomFieldValue) {
			if ((is_null($this->intCustomFieldId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateCustomFieldValue on this unsaved CustomField.');
			if ((is_null($objCustomFieldValue->CustomFieldValueId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateCustomFieldValue on this CustomField with an unsaved CustomFieldValue.');

			// Get the Database Object for this Class
			$objDatabase = CustomField::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`custom_field_value`
				WHERE
					`custom_field_value_id` = ' . $objDatabase->SqlVariable($objCustomFieldValue->CustomFieldValueId) . ' AND
					`custom_field_id` = ' . $objDatabase->SqlVariable($this->intCustomFieldId) . '
			');
		}

		/**
		 * Deletes all associated CustomFieldValues
		 * @return void
		*/ 
		public function DeleteAllCustomFieldValues() {
			if ((is_null($this->intCustomFieldId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateCustomFieldValue on this unsaved CustomField.');

			// Get the Database Object for this Class
			$objDatabase = CustomField::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`custom_field_value`
				WHERE
					`custom_field_id` = ' . $objDatabase->SqlVariable($this->intCustomFieldId) . '
			');
		}

			
		
		// Related Objects' Methods for EntityQtypeCustomField
		//-------------------------------------------------------------------

		/**
		 * Gets all associated EntityQtypeCustomFields as an array of EntityQtypeCustomField objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return EntityQtypeCustomField[]
		*/ 
		public function GetEntityQtypeCustomFieldArray($objOptionalClauses = null) {
			if ((is_null($this->intCustomFieldId)))
				return array();

			try {
				return EntityQtypeCustomField::LoadArrayByCustomFieldId($this->intCustomFieldId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated EntityQtypeCustomFields
		 * @return int
		*/ 
		public function CountEntityQtypeCustomFields() {
			if ((is_null($this->intCustomFieldId)))
				return 0;

			return EntityQtypeCustomField::CountByCustomFieldId($this->intCustomFieldId);
		}

		/**
		 * Associates a EntityQtypeCustomField
		 * @param EntityQtypeCustomField $objEntityQtypeCustomField
		 * @return void
		*/ 
		public function AssociateEntityQtypeCustomField(EntityQtypeCustomField $objEntityQtypeCustomField) {
			if ((is_null($this->intCustomFieldId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateEntityQtypeCustomField on this unsaved CustomField.');
			if ((is_null($objEntityQtypeCustomField->EntityQtypeCustomFieldId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateEntityQtypeCustomField on this CustomField with an unsaved EntityQtypeCustomField.');

			// Get the Database Object for this Class
			$objDatabase = CustomField::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`entity_qtype_custom_field`
				SET
					`custom_field_id` = ' . $objDatabase->SqlVariable($this->intCustomFieldId) . '
				WHERE
					`entity_qtype_custom_field_id` = ' . $objDatabase->SqlVariable($objEntityQtypeCustomField->EntityQtypeCustomFieldId) . '
			');
		}

		/**
		 * Unassociates a EntityQtypeCustomField
		 * @param EntityQtypeCustomField $objEntityQtypeCustomField
		 * @return void
		*/ 
		public function UnassociateEntityQtypeCustomField(EntityQtypeCustomField $objEntityQtypeCustomField) {
			if ((is_null($this->intCustomFieldId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateEntityQtypeCustomField on this unsaved CustomField.');
			if ((is_null($objEntityQtypeCustomField->EntityQtypeCustomFieldId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateEntityQtypeCustomField on this CustomField with an unsaved EntityQtypeCustomField.');

			// Get the Database Object for this Class
			$objDatabase = CustomField::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`entity_qtype_custom_field`
				SET
					`custom_field_id` = null
				WHERE
					`entity_qtype_custom_field_id` = ' . $objDatabase->SqlVariable($objEntityQtypeCustomField->EntityQtypeCustomFieldId) . ' AND
					`custom_field_id` = ' . $objDatabase->SqlVariable($this->intCustomFieldId) . '
			');
		}

		/**
		 * Unassociates all EntityQtypeCustomFields
		 * @return void
		*/ 
		public function UnassociateAllEntityQtypeCustomFields() {
			if ((is_null($this->intCustomFieldId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateEntityQtypeCustomField on this unsaved CustomField.');

			// Get the Database Object for this Class
			$objDatabase = CustomField::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`entity_qtype_custom_field`
				SET
					`custom_field_id` = null
				WHERE
					`custom_field_id` = ' . $objDatabase->SqlVariable($this->intCustomFieldId) . '
			');
		}

		/**
		 * Deletes an associated EntityQtypeCustomField
		 * @param EntityQtypeCustomField $objEntityQtypeCustomField
		 * @return void
		*/ 
		public function DeleteAssociatedEntityQtypeCustomField(EntityQtypeCustomField $objEntityQtypeCustomField) {
			if ((is_null($this->intCustomFieldId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateEntityQtypeCustomField on this unsaved CustomField.');
			if ((is_null($objEntityQtypeCustomField->EntityQtypeCustomFieldId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateEntityQtypeCustomField on this CustomField with an unsaved EntityQtypeCustomField.');

			// Get the Database Object for this Class
			$objDatabase = CustomField::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`entity_qtype_custom_field`
				WHERE
					`entity_qtype_custom_field_id` = ' . $objDatabase->SqlVariable($objEntityQtypeCustomField->EntityQtypeCustomFieldId) . ' AND
					`custom_field_id` = ' . $objDatabase->SqlVariable($this->intCustomFieldId) . '
			');
		}

		/**
		 * Deletes all associated EntityQtypeCustomFields
		 * @return void
		*/ 
		public function DeleteAllEntityQtypeCustomFields() {
			if ((is_null($this->intCustomFieldId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateEntityQtypeCustomField on this unsaved CustomField.');

			// Get the Database Object for this Class
			$objDatabase = CustomField::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`entity_qtype_custom_field`
				WHERE
					`custom_field_id` = ' . $objDatabase->SqlVariable($this->intCustomFieldId) . '
			');
		}




		///////////////////////////////////////////////////////////////////////
		// PROTECTED MEMBER VARIABLES and TEXT FIELD MAXLENGTHS (if applicable)
		///////////////////////////////////////////////////////////////////////
		
		/**
		 * Protected member variable that maps to the database PK Identity column custom_field.custom_field_id
		 * @var integer intCustomFieldId
		 */
		protected $intCustomFieldId;
		const CustomFieldIdDefault = null;


		/**
		 * Protected member variable that maps to the database column custom_field.custom_field_qtype_id
		 * @var integer intCustomFieldQtypeId
		 */
		protected $intCustomFieldQtypeId;
		const CustomFieldQtypeIdDefault = null;


		/**
		 * Protected member variable that maps to the database column custom_field.default_custom_field_value_id
		 * @var integer intDefaultCustomFieldValueId
		 */
		protected $intDefaultCustomFieldValueId;
		const DefaultCustomFieldValueIdDefault = null;


		/**
		 * Protected member variable that maps to the database column custom_field.short_description
		 * @var string strShortDescription
		 */
		protected $strShortDescription;
		const ShortDescriptionMaxLength = 255;
		const ShortDescriptionDefault = null;


		/**
		 * Protected member variable that maps to the database column custom_field.active_flag
		 * @var boolean blnActiveFlag
		 */
		protected $blnActiveFlag;
		const ActiveFlagDefault = null;


		/**
		 * Protected member variable that maps to the database column custom_field.required_flag
		 * @var boolean blnRequiredFlag
		 */
		protected $blnRequiredFlag;
		const RequiredFlagDefault = null;


		/**
		 * Protected member variable that maps to the database column custom_field.created_by
		 * @var integer intCreatedBy
		 */
		protected $intCreatedBy;
		const CreatedByDefault = null;


		/**
		 * Protected member variable that maps to the database column custom_field.creation_date
		 * @var QDateTime dttCreationDate
		 */
		protected $dttCreationDate;
		const CreationDateDefault = null;


		/**
		 * Protected member variable that maps to the database column custom_field.modified_by
		 * @var integer intModifiedBy
		 */
		protected $intModifiedBy;
		const ModifiedByDefault = null;


		/**
		 * Protected member variable that maps to the database column custom_field.modified_date
		 * @var string strModifiedDate
		 */
		protected $strModifiedDate;
		const ModifiedDateDefault = null;


		/**
		 * Private member variable that stores a reference to a single CustomFieldValue object
		 * (of type CustomFieldValue), if this CustomField object was restored with
		 * an expansion on the custom_field_value association table.
		 * @var CustomFieldValue _objCustomFieldValue;
		 */
		private $_objCustomFieldValue;

		/**
		 * Private member variable that stores a reference to an array of CustomFieldValue objects
		 * (of type CustomFieldValue[]), if this CustomField object was restored with
		 * an ExpandAsArray on the custom_field_value association table.
		 * @var CustomFieldValue[] _objCustomFieldValueArray;
		 */
		private $_objCustomFieldValueArray = array();

		/**
		 * Private member variable that stores a reference to a single EntityQtypeCustomField object
		 * (of type EntityQtypeCustomField), if this CustomField object was restored with
		 * an expansion on the entity_qtype_custom_field association table.
		 * @var EntityQtypeCustomField _objEntityQtypeCustomField;
		 */
		private $_objEntityQtypeCustomField;

		/**
		 * Private member variable that stores a reference to an array of EntityQtypeCustomField objects
		 * (of type EntityQtypeCustomField[]), if this CustomField object was restored with
		 * an ExpandAsArray on the entity_qtype_custom_field association table.
		 * @var EntityQtypeCustomField[] _objEntityQtypeCustomFieldArray;
		 */
		private $_objEntityQtypeCustomFieldArray = array();

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
		 * in the database column custom_field.default_custom_field_value_id.
		 *
		 * NOTE: Always use the DefaultCustomFieldValue property getter to correctly retrieve this CustomFieldValue object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var CustomFieldValue objDefaultCustomFieldValue
		 */
		protected $objDefaultCustomFieldValue;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column custom_field.created_by.
		 *
		 * NOTE: Always use the CreatedByObject property getter to correctly retrieve this UserAccount object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var UserAccount objCreatedByObject
		 */
		protected $objCreatedByObject;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column custom_field.modified_by.
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
				$objQueryExpansion = new QQueryExpansion('CustomField', 'custom_field', $objExpansionMap);
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
				$objQueryExpansion->AddFromItem(sprintf('LEFT JOIN `custom_field` AS `%s__%s` ON `%s`.`%s` = `%s__%s`.`custom_field_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias, $strParentAlias, $strAlias));

				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`custom_field_id` AS `%s__%s__custom_field_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`custom_field_qtype_id` AS `%s__%s__custom_field_qtype_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`default_custom_field_value_id` AS `%s__%s__default_custom_field_value_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`short_description` AS `%s__%s__short_description`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`active_flag` AS `%s__%s__active_flag`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`required_flag` AS `%s__%s__required_flag`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`created_by` AS `%s__%s__created_by`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`creation_date` AS `%s__%s__creation_date`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`modified_by` AS `%s__%s__modified_by`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`modified_date` AS `%s__%s__modified_date`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));

				$strParentAlias = $strParentAlias . '__' . $strAlias;
			}

			if (is_array($objExpansionMap))
				foreach ($objExpansionMap as $strKey=>$objValue) {
					switch ($strKey) {
						case 'default_custom_field_value_id':
							try {
								CustomFieldValue::ExpandQuery($strParentAlias, $strKey, $objValue, $objQueryExpansion);
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
		const ExpandDefaultCustomFieldValue = 'default_custom_field_value_id';
		const ExpandCreatedByObject = 'created_by';
		const ExpandModifiedByObject = 'modified_by';




		////////////////////////////////////////
		// METHODS for WEB SERVICES
		////////////////////////////////////////

		public static function GetSoapComplexTypeXml() {
			$strToReturn = '<complexType name="CustomField"><sequence>';
			$strToReturn .= '<element name="CustomFieldId" type="xsd:int"/>';
			$strToReturn .= '<element name="CustomFieldQtypeId" type="xsd:int"/>';
			$strToReturn .= '<element name="DefaultCustomFieldValue" type="xsd1:CustomFieldValue"/>';
			$strToReturn .= '<element name="ShortDescription" type="xsd:string"/>';
			$strToReturn .= '<element name="ActiveFlag" type="xsd:boolean"/>';
			$strToReturn .= '<element name="RequiredFlag" type="xsd:boolean"/>';
			$strToReturn .= '<element name="CreatedByObject" type="xsd1:UserAccount"/>';
			$strToReturn .= '<element name="CreationDate" type="xsd:dateTime"/>';
			$strToReturn .= '<element name="ModifiedByObject" type="xsd1:UserAccount"/>';
			$strToReturn .= '<element name="ModifiedDate" type="xsd:string"/>';
			$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
			$strToReturn .= '</sequence></complexType>';
			return $strToReturn;
		}

		public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
			if (!array_key_exists('CustomField', $strComplexTypeArray)) {
				$strComplexTypeArray['CustomField'] = CustomField::GetSoapComplexTypeXml();
				CustomFieldValue::AlterSoapComplexTypeArray($strComplexTypeArray);
				UserAccount::AlterSoapComplexTypeArray($strComplexTypeArray);
				UserAccount::AlterSoapComplexTypeArray($strComplexTypeArray);
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, CustomField::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new CustomField();
			if (property_exists($objSoapObject, 'CustomFieldId'))
				$objToReturn->intCustomFieldId = $objSoapObject->CustomFieldId;
			if (property_exists($objSoapObject, 'CustomFieldQtypeId'))
				$objToReturn->intCustomFieldQtypeId = $objSoapObject->CustomFieldQtypeId;
			if ((property_exists($objSoapObject, 'DefaultCustomFieldValue')) &&
				($objSoapObject->DefaultCustomFieldValue))
				$objToReturn->DefaultCustomFieldValue = CustomFieldValue::GetObjectFromSoapObject($objSoapObject->DefaultCustomFieldValue);
			if (property_exists($objSoapObject, 'ShortDescription'))
				$objToReturn->strShortDescription = $objSoapObject->ShortDescription;
			if (property_exists($objSoapObject, 'ActiveFlag'))
				$objToReturn->blnActiveFlag = $objSoapObject->ActiveFlag;
			if (property_exists($objSoapObject, 'RequiredFlag'))
				$objToReturn->blnRequiredFlag = $objSoapObject->RequiredFlag;
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
				array_push($objArrayToReturn, CustomField::GetSoapObjectFromObject($objObject, true));

			return unserialize(serialize($objArrayToReturn));
		}

		public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
			if ($objObject->objDefaultCustomFieldValue)
				$objObject->objDefaultCustomFieldValue = CustomFieldValue::GetSoapObjectFromObject($objObject->objDefaultCustomFieldValue, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intDefaultCustomFieldValueId = null;
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

	class QQNodeCustomField extends QQNode {
		protected $strTableName = 'custom_field';
		protected $strPrimaryKey = 'custom_field_id';
		protected $strClassName = 'CustomField';
		public function __get($strName) {
			switch ($strName) {
				case 'CustomFieldId':
					return new QQNode('custom_field_id', 'integer', $this);
				case 'CustomFieldQtypeId':
					return new QQNode('custom_field_qtype_id', 'integer', $this);
				case 'DefaultCustomFieldValueId':
					return new QQNode('default_custom_field_value_id', 'integer', $this);
				case 'DefaultCustomFieldValue':
					return new QQNodeCustomFieldValue('default_custom_field_value_id', 'integer', $this);
				case 'ShortDescription':
					return new QQNode('short_description', 'string', $this);
				case 'ActiveFlag':
					return new QQNode('active_flag', 'boolean', $this);
				case 'RequiredFlag':
					return new QQNode('required_flag', 'boolean', $this);
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
				case 'CustomFieldValue':
					return new QQReverseReferenceNodeCustomFieldValue($this, 'customfieldvalue', 'reverse_reference', 'custom_field_id');
				case 'EntityQtypeCustomField':
					return new QQReverseReferenceNodeEntityQtypeCustomField($this, 'entityqtypecustomfield', 'reverse_reference', 'custom_field_id');

				case '_PrimaryKeyNode':
					return new QQNode('custom_field_id', 'integer', $this);
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

	class QQReverseReferenceNodeCustomField extends QQReverseReferenceNode {
		protected $strTableName = 'custom_field';
		protected $strPrimaryKey = 'custom_field_id';
		protected $strClassName = 'CustomField';
		public function __get($strName) {
			switch ($strName) {
				case 'CustomFieldId':
					return new QQNode('custom_field_id', 'integer', $this);
				case 'CustomFieldQtypeId':
					return new QQNode('custom_field_qtype_id', 'integer', $this);
				case 'DefaultCustomFieldValueId':
					return new QQNode('default_custom_field_value_id', 'integer', $this);
				case 'DefaultCustomFieldValue':
					return new QQNodeCustomFieldValue('default_custom_field_value_id', 'integer', $this);
				case 'ShortDescription':
					return new QQNode('short_description', 'string', $this);
				case 'ActiveFlag':
					return new QQNode('active_flag', 'boolean', $this);
				case 'RequiredFlag':
					return new QQNode('required_flag', 'boolean', $this);
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
				case 'CustomFieldValue':
					return new QQReverseReferenceNodeCustomFieldValue($this, 'customfieldvalue', 'reverse_reference', 'custom_field_id');
				case 'EntityQtypeCustomField':
					return new QQReverseReferenceNodeEntityQtypeCustomField($this, 'entityqtypecustomfield', 'reverse_reference', 'custom_field_id');

				case '_PrimaryKeyNode':
					return new QQNode('custom_field_id', 'integer', $this);
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