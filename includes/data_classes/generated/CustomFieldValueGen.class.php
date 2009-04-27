<?php
	/**
	 * The abstract CustomFieldValueGen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the CustomFieldValue subclass which
	 * extends this CustomFieldValueGen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the CustomFieldValue class.
	 * 
	 * @package My Application
	 * @subpackage GeneratedDataObjects
	 * 
	 */
	class CustomFieldValueGen extends QBaseClass {
		///////////////////////////////
		// COMMON LOAD METHODS
		///////////////////////////////

		/**
		 * Load a CustomFieldValue from PK Info
		 * @param integer $intCustomFieldValueId
		 * @return CustomFieldValue
		 */
		public static function Load($intCustomFieldValueId) {
			// Use QuerySingle to Perform the Query
			return CustomFieldValue::QuerySingle(
				QQ::Equal(QQN::CustomFieldValue()->CustomFieldValueId, $intCustomFieldValueId)
			);
		}

		/**
		 * Load all CustomFieldValues
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return CustomFieldValue[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			// Call CustomFieldValue::QueryArray to perform the LoadAll query
			try {
				return CustomFieldValue::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all CustomFieldValues
		 * @return int
		 */
		public static function CountAll() {
			// Call CustomFieldValue::QueryCount to perform the CountAll query
			return CustomFieldValue::QueryCount(QQ::All());
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
			$objDatabase = CustomFieldValue::GetDatabase();

			// Create/Build out the QueryBuilder object with CustomFieldValue-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, 'custom_field_value');
			CustomFieldValue::GetSelectFields($objQueryBuilder);
			$objQueryBuilder->AddFromItem('`custom_field_value` AS `custom_field_value`');

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
		 * Static Qcodo Query method to query for a single CustomFieldValue object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return CustomFieldValue the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = CustomFieldValue::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query, Get the First Row, and Instantiate a new CustomFieldValue object
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return CustomFieldValue::InstantiateDbRow($objDbResult->GetNextRow());
		}

		/**
		 * Static Qcodo Query method to query for an array of CustomFieldValue objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return CustomFieldValue[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = CustomFieldValue::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return CustomFieldValue::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
		}

		/**
		 * Static Qcodo Query method to query for a count of CustomFieldValue objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = CustomFieldValue::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
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
			$objDatabase = CustomFieldValue::GetDatabase();

			// Lookup the QCache for This Query Statement
			$objCache = new QCache('query', 'custom_field_value_' . serialize($strConditions));
			if (!($strQuery = $objCache->GetData())) {
				// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with CustomFieldValue-specific fields
				$objQueryBuilder = new QQueryBuilder($objDatabase);
				CustomFieldValue::GetSelectFields($objQueryBuilder);
				CustomFieldValue::GetFromFields($objQueryBuilder);

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
			return CustomFieldValue::InstantiateDbResult($objDbResult);
		}*/

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this CustomFieldValue
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null) {
			if ($strPrefix) {
				$strTableName = '`' . $strPrefix . '`';
				$strAliasPrefix = '`' . $strPrefix . '__';
			} else {
				$strTableName = '`custom_field_value`';
				$strAliasPrefix = '`';
			}

			$objBuilder->AddSelectItem($strTableName . '.`custom_field_value_id` AS ' . $strAliasPrefix . 'custom_field_value_id`');
			$objBuilder->AddSelectItem($strTableName . '.`custom_field_id` AS ' . $strAliasPrefix . 'custom_field_id`');
			$objBuilder->AddSelectItem($strTableName . '.`short_description` AS ' . $strAliasPrefix . 'short_description`');
			$objBuilder->AddSelectItem($strTableName . '.`created_by` AS ' . $strAliasPrefix . 'created_by`');
			$objBuilder->AddSelectItem($strTableName . '.`creation_date` AS ' . $strAliasPrefix . 'creation_date`');
			$objBuilder->AddSelectItem($strTableName . '.`modified_by` AS ' . $strAliasPrefix . 'modified_by`');
			$objBuilder->AddSelectItem($strTableName . '.`modified_date` AS ' . $strAliasPrefix . 'modified_date`');
		}



		///////////////////////////////
		// INSTANTIATION-RELATED METHODS
		///////////////////////////////

		/**
		 * Instantiate a CustomFieldValue from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this CustomFieldValue::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param DatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @return CustomFieldValue
		*/
		public static function InstantiateDbRow($objDbRow, $strAliasPrefix = null, $strExpandAsArrayNodes = null, $objPreviousItem = null) {
			// If blank row, return null
			if (!$objDbRow)
				return null;

			// See if we're doing an array expansion on the previous item
			if (($strExpandAsArrayNodes) && ($objPreviousItem) &&
				($objPreviousItem->intCustomFieldValueId == $objDbRow->GetColumn($strAliasPrefix . 'custom_field_value_id', 'Integer'))) {

				// We are.  Now, prepare to check for ExpandAsArray clauses
				$blnExpandedViaArray = false;
				if (!$strAliasPrefix)
					$strAliasPrefix = 'custom_field_value__';


				if ((array_key_exists($strAliasPrefix . 'customfieldasdefault__custom_field_id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'customfieldasdefault__custom_field_id')))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objCustomFieldAsDefaultArray)) {
						$objPreviousChildItem = $objPreviousItem->_objCustomFieldAsDefaultArray[$intPreviousChildItemCount - 1];
						$objChildItem = CustomField::InstantiateDbRow($objDbRow, $strAliasPrefix . 'customfieldasdefault__', $strExpandAsArrayNodes, $objPreviousChildItem);
						if ($objChildItem)
							array_push($objPreviousItem->_objCustomFieldAsDefaultArray, $objChildItem);
					} else
						array_push($objPreviousItem->_objCustomFieldAsDefaultArray, CustomField::InstantiateDbRow($objDbRow, $strAliasPrefix . 'customfieldasdefault__', $strExpandAsArrayNodes));
					$blnExpandedViaArray = true;
				}

				if ((array_key_exists($strAliasPrefix . 'customfieldselection__custom_field_selection_id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'customfieldselection__custom_field_selection_id')))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objCustomFieldSelectionArray)) {
						$objPreviousChildItem = $objPreviousItem->_objCustomFieldSelectionArray[$intPreviousChildItemCount - 1];
						$objChildItem = CustomFieldSelection::InstantiateDbRow($objDbRow, $strAliasPrefix . 'customfieldselection__', $strExpandAsArrayNodes, $objPreviousChildItem);
						if ($objChildItem)
							array_push($objPreviousItem->_objCustomFieldSelectionArray, $objChildItem);
					} else
						array_push($objPreviousItem->_objCustomFieldSelectionArray, CustomFieldSelection::InstantiateDbRow($objDbRow, $strAliasPrefix . 'customfieldselection__', $strExpandAsArrayNodes));
					$blnExpandedViaArray = true;
				}

				// Either return false to signal array expansion, or check-to-reset the Alias prefix and move on
				if ($blnExpandedViaArray)
					return false;
				else if ($strAliasPrefix == 'custom_field_value__')
					$strAliasPrefix = null;
			}

			// Create a new instance of the CustomFieldValue object
			$objToReturn = new CustomFieldValue();
			$objToReturn->__blnRestored = true;

			$objToReturn->intCustomFieldValueId = $objDbRow->GetColumn($strAliasPrefix . 'custom_field_value_id', 'Integer');
			$objToReturn->intCustomFieldId = $objDbRow->GetColumn($strAliasPrefix . 'custom_field_id', 'Integer');
			$objToReturn->strShortDescription = $objDbRow->GetColumn($strAliasPrefix . 'short_description', 'Blob');
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
				$strAliasPrefix = 'custom_field_value__';

			// Check for CustomField Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'custom_field_id__custom_field_id')))
				$objToReturn->objCustomField = CustomField::InstantiateDbRow($objDbRow, $strAliasPrefix . 'custom_field_id__', $strExpandAsArrayNodes);

			// Check for CreatedByObject Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'created_by__user_account_id')))
				$objToReturn->objCreatedByObject = UserAccount::InstantiateDbRow($objDbRow, $strAliasPrefix . 'created_by__', $strExpandAsArrayNodes);

			// Check for ModifiedByObject Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'modified_by__user_account_id')))
				$objToReturn->objModifiedByObject = UserAccount::InstantiateDbRow($objDbRow, $strAliasPrefix . 'modified_by__', $strExpandAsArrayNodes);




			// Check for CustomFieldAsDefault Virtual Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'customfieldasdefault__custom_field_id'))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'customfieldasdefault__custom_field_id', $strExpandAsArrayNodes)))
					array_push($objToReturn->_objCustomFieldAsDefaultArray, CustomField::InstantiateDbRow($objDbRow, $strAliasPrefix . 'customfieldasdefault__', $strExpandAsArrayNodes));
				else
					$objToReturn->_objCustomFieldAsDefault = CustomField::InstantiateDbRow($objDbRow, $strAliasPrefix . 'customfieldasdefault__', $strExpandAsArrayNodes);
			}

			// Check for CustomFieldSelection Virtual Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'customfieldselection__custom_field_selection_id'))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'customfieldselection__custom_field_selection_id', $strExpandAsArrayNodes)))
					array_push($objToReturn->_objCustomFieldSelectionArray, CustomFieldSelection::InstantiateDbRow($objDbRow, $strAliasPrefix . 'customfieldselection__', $strExpandAsArrayNodes));
				else
					$objToReturn->_objCustomFieldSelection = CustomFieldSelection::InstantiateDbRow($objDbRow, $strAliasPrefix . 'customfieldselection__', $strExpandAsArrayNodes);
			}

			return $objToReturn;
		}

		/**
		 * Instantiate an array of CustomFieldValues from a Database Result
		 * @param DatabaseResultBase $objDbResult
		 * @return CustomFieldValue[]
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
					$objItem = CustomFieldValue::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
					if ($objItem) {
						array_push($objToReturn, $objItem);
						$objLastRowItem = $objItem;
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					array_push($objToReturn, CustomFieldValue::InstantiateDbRow($objDbRow));
			}

			return $objToReturn;
		}



		///////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Single Load and Array)
		///////////////////////////////////////////////////
			
		/**
		 * Load a single CustomFieldValue object,
		 * by CustomFieldValueId Index(es)
		 * @param integer $intCustomFieldValueId
		 * @return CustomFieldValue
		*/
		public static function LoadByCustomFieldValueId($intCustomFieldValueId) {
			return CustomFieldValue::QuerySingle(
				QQ::Equal(QQN::CustomFieldValue()->CustomFieldValueId, $intCustomFieldValueId)
			);
		}
			
		/**
		 * Load an array of CustomFieldValue objects,
		 * by CreatedBy Index(es)
		 * @param integer $intCreatedBy
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return CustomFieldValue[]
		*/
		public static function LoadArrayByCreatedBy($intCreatedBy, $objOptionalClauses = null) {
			// Call CustomFieldValue::QueryArray to perform the LoadArrayByCreatedBy query
			try {
				return CustomFieldValue::QueryArray(
					QQ::Equal(QQN::CustomFieldValue()->CreatedBy, $intCreatedBy),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count CustomFieldValues
		 * by CreatedBy Index(es)
		 * @param integer $intCreatedBy
		 * @return int
		*/
		public static function CountByCreatedBy($intCreatedBy) {
			// Call CustomFieldValue::QueryCount to perform the CountByCreatedBy query
			return CustomFieldValue::QueryCount(
				QQ::Equal(QQN::CustomFieldValue()->CreatedBy, $intCreatedBy)
			);
		}
			
		/**
		 * Load an array of CustomFieldValue objects,
		 * by ModifiedBy Index(es)
		 * @param integer $intModifiedBy
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return CustomFieldValue[]
		*/
		public static function LoadArrayByModifiedBy($intModifiedBy, $objOptionalClauses = null) {
			// Call CustomFieldValue::QueryArray to perform the LoadArrayByModifiedBy query
			try {
				return CustomFieldValue::QueryArray(
					QQ::Equal(QQN::CustomFieldValue()->ModifiedBy, $intModifiedBy),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count CustomFieldValues
		 * by ModifiedBy Index(es)
		 * @param integer $intModifiedBy
		 * @return int
		*/
		public static function CountByModifiedBy($intModifiedBy) {
			// Call CustomFieldValue::QueryCount to perform the CountByModifiedBy query
			return CustomFieldValue::QueryCount(
				QQ::Equal(QQN::CustomFieldValue()->ModifiedBy, $intModifiedBy)
			);
		}
			
		/**
		 * Load an array of CustomFieldValue objects,
		 * by CustomFieldId Index(es)
		 * @param integer $intCustomFieldId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return CustomFieldValue[]
		*/
		public static function LoadArrayByCustomFieldId($intCustomFieldId, $objOptionalClauses = null) {
			// Call CustomFieldValue::QueryArray to perform the LoadArrayByCustomFieldId query
			try {
				return CustomFieldValue::QueryArray(
					QQ::Equal(QQN::CustomFieldValue()->CustomFieldId, $intCustomFieldId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count CustomFieldValues
		 * by CustomFieldId Index(es)
		 * @param integer $intCustomFieldId
		 * @return int
		*/
		public static function CountByCustomFieldId($intCustomFieldId) {
			// Call CustomFieldValue::QueryCount to perform the CountByCustomFieldId query
			return CustomFieldValue::QueryCount(
				QQ::Equal(QQN::CustomFieldValue()->CustomFieldId, $intCustomFieldId)
			);
		}



		////////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Array via Many to Many)
		////////////////////////////////////////////////////



		//////////////////
		// SAVE AND DELETE
		//////////////////

		/**
		 * Save this CustomFieldValue
		 * @param bool $blnForceInsert
		 * @param bool $blnForceUpdate
		 * @return int
		*/
		public function Save($blnForceInsert = false, $blnForceUpdate = false) {
			// Get the Database Object for this Class
			$objDatabase = CustomFieldValue::GetDatabase();

			$mixToReturn = null;

			try {
				if ((!$this->__blnRestored) || ($blnForceInsert)) {
					// Perform an INSERT query
					$objDatabase->NonQuery('
						INSERT INTO `custom_field_value` (
							`custom_field_id`,
							`short_description`,
							`created_by`,
							`creation_date`,
							`modified_by`
						) VALUES (
							' . $objDatabase->SqlVariable($this->intCustomFieldId) . ',
							' . $objDatabase->SqlVariable($this->strShortDescription) . ',
							' . $objDatabase->SqlVariable($this->intCreatedBy) . ',
							' . $objDatabase->SqlVariable($this->dttCreationDate) . ',
							' . $objDatabase->SqlVariable($this->intModifiedBy) . '
						)
					');

					// Update Identity column and return its value
					$mixToReturn = $this->intCustomFieldValueId = $objDatabase->InsertId('custom_field_value', 'custom_field_value_id');
				} else {
					// Perform an UPDATE query

					// First checking for Optimistic Locking constraints (if applicable)
					if (!$blnForceUpdate) {
						// Perform the Optimistic Locking check
						$objResult = $objDatabase->Query('
							SELECT
								`modified_date`
							FROM
								`custom_field_value`
							WHERE
								`custom_field_value_id` = ' . $objDatabase->SqlVariable($this->intCustomFieldValueId) . '
						');
						
						$objRow = $objResult->FetchArray();
						if ($objRow[0] != $this->strModifiedDate)
							throw new QExtendedOptimisticLockingException('CustomFieldValue', $this->intCustomFieldValueId);
					}

					// Perform the UPDATE query
					$objDatabase->NonQuery('
						UPDATE
							`custom_field_value`
						SET
							`custom_field_id` = ' . $objDatabase->SqlVariable($this->intCustomFieldId) . ',
							`short_description` = ' . $objDatabase->SqlVariable($this->strShortDescription) . ',
							`created_by` = ' . $objDatabase->SqlVariable($this->intCreatedBy) . ',
							`creation_date` = ' . $objDatabase->SqlVariable($this->dttCreationDate) . ',
							`modified_by` = ' . $objDatabase->SqlVariable($this->intModifiedBy) . '
						WHERE
							`custom_field_value_id` = ' . $objDatabase->SqlVariable($this->intCustomFieldValueId) . '
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
					`custom_field_value`
				WHERE
					`custom_field_value_id` = ' . $objDatabase->SqlVariable($this->intCustomFieldValueId) . '
			');
						
			$objRow = $objResult->FetchArray();
			$this->strModifiedDate = $objRow[0];

			// Return 
			return $mixToReturn;
		}

				/**
		 * Delete this CustomFieldValue
		 * @return void
		*/
		public function Delete() {
			if ((is_null($this->intCustomFieldValueId)))
				throw new QUndefinedPrimaryKeyException('Cannot delete this CustomFieldValue with an unset primary key.');

			// Get the Database Object for this Class
			$objDatabase = CustomFieldValue::GetDatabase();


			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`custom_field_value`
				WHERE
					`custom_field_value_id` = ' . $objDatabase->SqlVariable($this->intCustomFieldValueId) . '');
		}

		/**
		 * Delete all CustomFieldValues
		 * @return void
		*/
		public static function DeleteAll() {
			// Get the Database Object for this Class
			$objDatabase = CustomFieldValue::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				DELETE FROM
					`custom_field_value`');
		}

		/**
		 * Truncate custom_field_value table
		 * @return void
		*/
		public static function Truncate() {
			// Get the Database Object for this Class
			$objDatabase = CustomFieldValue::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				TRUNCATE `custom_field_value`');
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
				case 'CustomFieldValueId':
					/**
					 * Gets the value for intCustomFieldValueId (Read-Only PK)
					 * @return integer
					 */
					return $this->intCustomFieldValueId;

				case 'CustomFieldId':
					/**
					 * Gets the value for intCustomFieldId (Not Null)
					 * @return integer
					 */
					return $this->intCustomFieldId;

				case 'ShortDescription':
					/**
					 * Gets the value for strShortDescription 
					 * @return string
					 */
					return $this->strShortDescription;

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

				case '_CustomFieldAsDefault':
					/**
					 * Gets the value for the private _objCustomFieldAsDefault (Read-Only)
					 * if set due to an expansion on the custom_field.default_custom_field_value_id reverse relationship
					 * @return CustomField
					 */
					return $this->_objCustomFieldAsDefault;

				case '_CustomFieldAsDefaultArray':
					/**
					 * Gets the value for the private _objCustomFieldAsDefaultArray (Read-Only)
					 * if set due to an ExpandAsArray on the custom_field.default_custom_field_value_id reverse relationship
					 * @return CustomField[]
					 */
					return (array) $this->_objCustomFieldAsDefaultArray;

				case '_CustomFieldSelection':
					/**
					 * Gets the value for the private _objCustomFieldSelection (Read-Only)
					 * if set due to an expansion on the custom_field_selection.custom_field_value_id reverse relationship
					 * @return CustomFieldSelection
					 */
					return $this->_objCustomFieldSelection;

				case '_CustomFieldSelectionArray':
					/**
					 * Gets the value for the private _objCustomFieldSelectionArray (Read-Only)
					 * if set due to an ExpandAsArray on the custom_field_selection.custom_field_value_id reverse relationship
					 * @return CustomFieldSelection[]
					 */
					return (array) $this->_objCustomFieldSelectionArray;

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
							throw new QCallerException('Unable to set an unsaved CustomField for this CustomFieldValue');

						// Update Local Member Variables
						$this->objCustomField = $mixValue;
						$this->intCustomFieldId = $mixValue->CustomFieldId;

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
							throw new QCallerException('Unable to set an unsaved CreatedByObject for this CustomFieldValue');

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
							throw new QCallerException('Unable to set an unsaved ModifiedByObject for this CustomFieldValue');

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

			
		
		// Related Objects' Methods for CustomFieldAsDefault
		//-------------------------------------------------------------------

		/**
		 * Gets all associated CustomFieldsAsDefault as an array of CustomField objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return CustomField[]
		*/ 
		public function GetCustomFieldAsDefaultArray($objOptionalClauses = null) {
			if ((is_null($this->intCustomFieldValueId)))
				return array();

			try {
				return CustomField::LoadArrayByDefaultCustomFieldValueId($this->intCustomFieldValueId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated CustomFieldsAsDefault
		 * @return int
		*/ 
		public function CountCustomFieldsAsDefault() {
			if ((is_null($this->intCustomFieldValueId)))
				return 0;

			return CustomField::CountByDefaultCustomFieldValueId($this->intCustomFieldValueId);
		}

		/**
		 * Associates a CustomFieldAsDefault
		 * @param CustomField $objCustomField
		 * @return void
		*/ 
		public function AssociateCustomFieldAsDefault(CustomField $objCustomField) {
			if ((is_null($this->intCustomFieldValueId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateCustomFieldAsDefault on this unsaved CustomFieldValue.');
			if ((is_null($objCustomField->CustomFieldId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateCustomFieldAsDefault on this CustomFieldValue with an unsaved CustomField.');

			// Get the Database Object for this Class
			$objDatabase = CustomFieldValue::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`custom_field`
				SET
					`default_custom_field_value_id` = ' . $objDatabase->SqlVariable($this->intCustomFieldValueId) . '
				WHERE
					`custom_field_id` = ' . $objDatabase->SqlVariable($objCustomField->CustomFieldId) . '
			');
		}

		/**
		 * Unassociates a CustomFieldAsDefault
		 * @param CustomField $objCustomField
		 * @return void
		*/ 
		public function UnassociateCustomFieldAsDefault(CustomField $objCustomField) {
			if ((is_null($this->intCustomFieldValueId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateCustomFieldAsDefault on this unsaved CustomFieldValue.');
			if ((is_null($objCustomField->CustomFieldId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateCustomFieldAsDefault on this CustomFieldValue with an unsaved CustomField.');

			// Get the Database Object for this Class
			$objDatabase = CustomFieldValue::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`custom_field`
				SET
					`default_custom_field_value_id` = null
				WHERE
					`custom_field_id` = ' . $objDatabase->SqlVariable($objCustomField->CustomFieldId) . ' AND
					`default_custom_field_value_id` = ' . $objDatabase->SqlVariable($this->intCustomFieldValueId) . '
			');
		}

		/**
		 * Unassociates all CustomFieldsAsDefault
		 * @return void
		*/ 
		public function UnassociateAllCustomFieldsAsDefault() {
			if ((is_null($this->intCustomFieldValueId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateCustomFieldAsDefault on this unsaved CustomFieldValue.');

			// Get the Database Object for this Class
			$objDatabase = CustomFieldValue::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`custom_field`
				SET
					`default_custom_field_value_id` = null
				WHERE
					`default_custom_field_value_id` = ' . $objDatabase->SqlVariable($this->intCustomFieldValueId) . '
			');
		}

		/**
		 * Deletes an associated CustomFieldAsDefault
		 * @param CustomField $objCustomField
		 * @return void
		*/ 
		public function DeleteAssociatedCustomFieldAsDefault(CustomField $objCustomField) {
			if ((is_null($this->intCustomFieldValueId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateCustomFieldAsDefault on this unsaved CustomFieldValue.');
			if ((is_null($objCustomField->CustomFieldId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateCustomFieldAsDefault on this CustomFieldValue with an unsaved CustomField.');

			// Get the Database Object for this Class
			$objDatabase = CustomFieldValue::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`custom_field`
				WHERE
					`custom_field_id` = ' . $objDatabase->SqlVariable($objCustomField->CustomFieldId) . ' AND
					`default_custom_field_value_id` = ' . $objDatabase->SqlVariable($this->intCustomFieldValueId) . '
			');
		}

		/**
		 * Deletes all associated CustomFieldsAsDefault
		 * @return void
		*/ 
		public function DeleteAllCustomFieldsAsDefault() {
			if ((is_null($this->intCustomFieldValueId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateCustomFieldAsDefault on this unsaved CustomFieldValue.');

			// Get the Database Object for this Class
			$objDatabase = CustomFieldValue::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`custom_field`
				WHERE
					`default_custom_field_value_id` = ' . $objDatabase->SqlVariable($this->intCustomFieldValueId) . '
			');
		}

			
		
		// Related Objects' Methods for CustomFieldSelection
		//-------------------------------------------------------------------

		/**
		 * Gets all associated CustomFieldSelections as an array of CustomFieldSelection objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return CustomFieldSelection[]
		*/ 
		public function GetCustomFieldSelectionArray($objOptionalClauses = null) {
			if ((is_null($this->intCustomFieldValueId)))
				return array();

			try {
				return CustomFieldSelection::LoadArrayByCustomFieldValueId($this->intCustomFieldValueId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated CustomFieldSelections
		 * @return int
		*/ 
		public function CountCustomFieldSelections() {
			if ((is_null($this->intCustomFieldValueId)))
				return 0;

			return CustomFieldSelection::CountByCustomFieldValueId($this->intCustomFieldValueId);
		}

		/**
		 * Associates a CustomFieldSelection
		 * @param CustomFieldSelection $objCustomFieldSelection
		 * @return void
		*/ 
		public function AssociateCustomFieldSelection(CustomFieldSelection $objCustomFieldSelection) {
			if ((is_null($this->intCustomFieldValueId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateCustomFieldSelection on this unsaved CustomFieldValue.');
			if ((is_null($objCustomFieldSelection->CustomFieldSelectionId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateCustomFieldSelection on this CustomFieldValue with an unsaved CustomFieldSelection.');

			// Get the Database Object for this Class
			$objDatabase = CustomFieldValue::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`custom_field_selection`
				SET
					`custom_field_value_id` = ' . $objDatabase->SqlVariable($this->intCustomFieldValueId) . '
				WHERE
					`custom_field_selection_id` = ' . $objDatabase->SqlVariable($objCustomFieldSelection->CustomFieldSelectionId) . '
			');
		}

		/**
		 * Unassociates a CustomFieldSelection
		 * @param CustomFieldSelection $objCustomFieldSelection
		 * @return void
		*/ 
		public function UnassociateCustomFieldSelection(CustomFieldSelection $objCustomFieldSelection) {
			if ((is_null($this->intCustomFieldValueId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateCustomFieldSelection on this unsaved CustomFieldValue.');
			if ((is_null($objCustomFieldSelection->CustomFieldSelectionId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateCustomFieldSelection on this CustomFieldValue with an unsaved CustomFieldSelection.');

			// Get the Database Object for this Class
			$objDatabase = CustomFieldValue::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`custom_field_selection`
				SET
					`custom_field_value_id` = null
				WHERE
					`custom_field_selection_id` = ' . $objDatabase->SqlVariable($objCustomFieldSelection->CustomFieldSelectionId) . ' AND
					`custom_field_value_id` = ' . $objDatabase->SqlVariable($this->intCustomFieldValueId) . '
			');
		}

		/**
		 * Unassociates all CustomFieldSelections
		 * @return void
		*/ 
		public function UnassociateAllCustomFieldSelections() {
			if ((is_null($this->intCustomFieldValueId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateCustomFieldSelection on this unsaved CustomFieldValue.');

			// Get the Database Object for this Class
			$objDatabase = CustomFieldValue::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`custom_field_selection`
				SET
					`custom_field_value_id` = null
				WHERE
					`custom_field_value_id` = ' . $objDatabase->SqlVariable($this->intCustomFieldValueId) . '
			');
		}

		/**
		 * Deletes an associated CustomFieldSelection
		 * @param CustomFieldSelection $objCustomFieldSelection
		 * @return void
		*/ 
		public function DeleteAssociatedCustomFieldSelection(CustomFieldSelection $objCustomFieldSelection) {
			if ((is_null($this->intCustomFieldValueId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateCustomFieldSelection on this unsaved CustomFieldValue.');
			if ((is_null($objCustomFieldSelection->CustomFieldSelectionId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateCustomFieldSelection on this CustomFieldValue with an unsaved CustomFieldSelection.');

			// Get the Database Object for this Class
			$objDatabase = CustomFieldValue::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`custom_field_selection`
				WHERE
					`custom_field_selection_id` = ' . $objDatabase->SqlVariable($objCustomFieldSelection->CustomFieldSelectionId) . ' AND
					`custom_field_value_id` = ' . $objDatabase->SqlVariable($this->intCustomFieldValueId) . '
			');
		}

		/**
		 * Deletes all associated CustomFieldSelections
		 * @return void
		*/ 
		public function DeleteAllCustomFieldSelections() {
			if ((is_null($this->intCustomFieldValueId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateCustomFieldSelection on this unsaved CustomFieldValue.');

			// Get the Database Object for this Class
			$objDatabase = CustomFieldValue::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`custom_field_selection`
				WHERE
					`custom_field_value_id` = ' . $objDatabase->SqlVariable($this->intCustomFieldValueId) . '
			');
		}




		///////////////////////////////////////////////////////////////////////
		// PROTECTED MEMBER VARIABLES and TEXT FIELD MAXLENGTHS (if applicable)
		///////////////////////////////////////////////////////////////////////
		
		/**
		 * Protected member variable that maps to the database PK Identity column custom_field_value.custom_field_value_id
		 * @var integer intCustomFieldValueId
		 */
		protected $intCustomFieldValueId;
		const CustomFieldValueIdDefault = null;


		/**
		 * Protected member variable that maps to the database column custom_field_value.custom_field_id
		 * @var integer intCustomFieldId
		 */
		protected $intCustomFieldId;
		const CustomFieldIdDefault = null;


		/**
		 * Protected member variable that maps to the database column custom_field_value.short_description
		 * @var string strShortDescription
		 */
		protected $strShortDescription;
		const ShortDescriptionDefault = null;


		/**
		 * Protected member variable that maps to the database column custom_field_value.created_by
		 * @var integer intCreatedBy
		 */
		protected $intCreatedBy;
		const CreatedByDefault = null;


		/**
		 * Protected member variable that maps to the database column custom_field_value.creation_date
		 * @var QDateTime dttCreationDate
		 */
		protected $dttCreationDate;
		const CreationDateDefault = null;


		/**
		 * Protected member variable that maps to the database column custom_field_value.modified_by
		 * @var integer intModifiedBy
		 */
		protected $intModifiedBy;
		const ModifiedByDefault = null;


		/**
		 * Protected member variable that maps to the database column custom_field_value.modified_date
		 * @var string strModifiedDate
		 */
		protected $strModifiedDate;
		const ModifiedDateDefault = null;


		/**
		 * Private member variable that stores a reference to a single CustomFieldAsDefault object
		 * (of type CustomField), if this CustomFieldValue object was restored with
		 * an expansion on the custom_field association table.
		 * @var CustomField _objCustomFieldAsDefault;
		 */
		private $_objCustomFieldAsDefault;

		/**
		 * Private member variable that stores a reference to an array of CustomFieldAsDefault objects
		 * (of type CustomField[]), if this CustomFieldValue object was restored with
		 * an ExpandAsArray on the custom_field association table.
		 * @var CustomField[] _objCustomFieldAsDefaultArray;
		 */
		private $_objCustomFieldAsDefaultArray = array();

		/**
		 * Private member variable that stores a reference to a single CustomFieldSelection object
		 * (of type CustomFieldSelection), if this CustomFieldValue object was restored with
		 * an expansion on the custom_field_selection association table.
		 * @var CustomFieldSelection _objCustomFieldSelection;
		 */
		private $_objCustomFieldSelection;

		/**
		 * Private member variable that stores a reference to an array of CustomFieldSelection objects
		 * (of type CustomFieldSelection[]), if this CustomFieldValue object was restored with
		 * an ExpandAsArray on the custom_field_selection association table.
		 * @var CustomFieldSelection[] _objCustomFieldSelectionArray;
		 */
		private $_objCustomFieldSelectionArray = array();

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
		 * in the database column custom_field_value.custom_field_id.
		 *
		 * NOTE: Always use the CustomField property getter to correctly retrieve this CustomField object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var CustomField objCustomField
		 */
		protected $objCustomField;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column custom_field_value.created_by.
		 *
		 * NOTE: Always use the CreatedByObject property getter to correctly retrieve this UserAccount object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var UserAccount objCreatedByObject
		 */
		protected $objCreatedByObject;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column custom_field_value.modified_by.
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
				$objQueryExpansion = new QQueryExpansion('CustomFieldValue', 'custom_field_value', $objExpansionMap);
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
				$objQueryExpansion->AddFromItem(sprintf('LEFT JOIN `custom_field_value` AS `%s__%s` ON `%s`.`%s` = `%s__%s`.`custom_field_value_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias, $strParentAlias, $strAlias));

				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`custom_field_value_id` AS `%s__%s__custom_field_value_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`custom_field_id` AS `%s__%s__custom_field_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`short_description` AS `%s__%s__short_description`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`created_by` AS `%s__%s__created_by`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`creation_date` AS `%s__%s__creation_date`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`modified_by` AS `%s__%s__modified_by`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`modified_date` AS `%s__%s__modified_date`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));

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
		const ExpandCustomField = 'custom_field_id';
		const ExpandCreatedByObject = 'created_by';
		const ExpandModifiedByObject = 'modified_by';




		////////////////////////////////////////
		// METHODS for WEB SERVICES
		////////////////////////////////////////

		public static function GetSoapComplexTypeXml() {
			$strToReturn = '<complexType name="CustomFieldValue"><sequence>';
			$strToReturn .= '<element name="CustomFieldValueId" type="xsd:int"/>';
			$strToReturn .= '<element name="CustomField" type="xsd1:CustomField"/>';
			$strToReturn .= '<element name="ShortDescription" type="xsd:string"/>';
			$strToReturn .= '<element name="CreatedByObject" type="xsd1:UserAccount"/>';
			$strToReturn .= '<element name="CreationDate" type="xsd:dateTime"/>';
			$strToReturn .= '<element name="ModifiedByObject" type="xsd1:UserAccount"/>';
			$strToReturn .= '<element name="ModifiedDate" type="xsd:string"/>';
			$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
			$strToReturn .= '</sequence></complexType>';
			return $strToReturn;
		}

		public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
			if (!array_key_exists('CustomFieldValue', $strComplexTypeArray)) {
				$strComplexTypeArray['CustomFieldValue'] = CustomFieldValue::GetSoapComplexTypeXml();
				CustomField::AlterSoapComplexTypeArray($strComplexTypeArray);
				UserAccount::AlterSoapComplexTypeArray($strComplexTypeArray);
				UserAccount::AlterSoapComplexTypeArray($strComplexTypeArray);
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, CustomFieldValue::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new CustomFieldValue();
			if (property_exists($objSoapObject, 'CustomFieldValueId'))
				$objToReturn->intCustomFieldValueId = $objSoapObject->CustomFieldValueId;
			if ((property_exists($objSoapObject, 'CustomField')) &&
				($objSoapObject->CustomField))
				$objToReturn->CustomField = CustomField::GetObjectFromSoapObject($objSoapObject->CustomField);
			if (property_exists($objSoapObject, 'ShortDescription'))
				$objToReturn->strShortDescription = $objSoapObject->ShortDescription;
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
				array_push($objArrayToReturn, CustomFieldValue::GetSoapObjectFromObject($objObject, true));

			return unserialize(serialize($objArrayToReturn));
		}

		public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
			if ($objObject->objCustomField)
				$objObject->objCustomField = CustomField::GetSoapObjectFromObject($objObject->objCustomField, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intCustomFieldId = null;
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

	class QQNodeCustomFieldValue extends QQNode {
		protected $strTableName = 'custom_field_value';
		protected $strPrimaryKey = 'custom_field_value_id';
		protected $strClassName = 'CustomFieldValue';
		public function __get($strName) {
			switch ($strName) {
				case 'CustomFieldValueId':
					return new QQNode('custom_field_value_id', 'integer', $this);
				case 'CustomFieldId':
					return new QQNode('custom_field_id', 'integer', $this);
				case 'CustomField':
					return new QQNodeCustomField('custom_field_id', 'integer', $this);
				case 'ShortDescription':
					return new QQNode('short_description', 'string', $this);
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
				case 'CustomFieldAsDefault':
					return new QQReverseReferenceNodeCustomField($this, 'customfieldasdefault', 'reverse_reference', 'default_custom_field_value_id');
				case 'CustomFieldSelection':
					return new QQReverseReferenceNodeCustomFieldSelection($this, 'customfieldselection', 'reverse_reference', 'custom_field_value_id');

				case '_PrimaryKeyNode':
					return new QQNode('custom_field_value_id', 'integer', $this);
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

	class QQReverseReferenceNodeCustomFieldValue extends QQReverseReferenceNode {
		protected $strTableName = 'custom_field_value';
		protected $strPrimaryKey = 'custom_field_value_id';
		protected $strClassName = 'CustomFieldValue';
		public function __get($strName) {
			switch ($strName) {
				case 'CustomFieldValueId':
					return new QQNode('custom_field_value_id', 'integer', $this);
				case 'CustomFieldId':
					return new QQNode('custom_field_id', 'integer', $this);
				case 'CustomField':
					return new QQNodeCustomField('custom_field_id', 'integer', $this);
				case 'ShortDescription':
					return new QQNode('short_description', 'string', $this);
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
				case 'CustomFieldAsDefault':
					return new QQReverseReferenceNodeCustomField($this, 'customfieldasdefault', 'reverse_reference', 'default_custom_field_value_id');
				case 'CustomFieldSelection':
					return new QQReverseReferenceNodeCustomFieldSelection($this, 'customfieldselection', 'reverse_reference', 'custom_field_value_id');

				case '_PrimaryKeyNode':
					return new QQNode('custom_field_value_id', 'integer', $this);
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