<?php
	/**
	 * The abstract CustomFieldSelectionGen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the CustomFieldSelection subclass which
	 * extends this CustomFieldSelectionGen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the CustomFieldSelection class.
	 * 
	 * @package My Application
	 * @subpackage GeneratedDataObjects
	 * 
	 */
	class CustomFieldSelectionGen extends QBaseClass {
		///////////////////////////////
		// COMMON LOAD METHODS
		///////////////////////////////

		/**
		 * Load a CustomFieldSelection from PK Info
		 * @param integer $intCustomFieldSelectionId
		 * @return CustomFieldSelection
		 */
		public static function Load($intCustomFieldSelectionId) {
			// Use QuerySingle to Perform the Query
			return CustomFieldSelection::QuerySingle(
				QQ::Equal(QQN::CustomFieldSelection()->CustomFieldSelectionId, $intCustomFieldSelectionId)
			);
		}

		/**
		 * Load all CustomFieldSelections
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return CustomFieldSelection[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			// Call CustomFieldSelection::QueryArray to perform the LoadAll query
			try {
				return CustomFieldSelection::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all CustomFieldSelections
		 * @return int
		 */
		public static function CountAll() {
			// Call CustomFieldSelection::QueryCount to perform the CountAll query
			return CustomFieldSelection::QueryCount(QQ::All());
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
			$objDatabase = CustomFieldSelection::GetDatabase();

			// Create/Build out the QueryBuilder object with CustomFieldSelection-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, 'custom_field_selection');
			CustomFieldSelection::GetSelectFields($objQueryBuilder);
			$objQueryBuilder->AddFromItem('`custom_field_selection` AS `custom_field_selection`');

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
		 * Static Qcodo Query method to query for a single CustomFieldSelection object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return CustomFieldSelection the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = CustomFieldSelection::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query, Get the First Row, and Instantiate a new CustomFieldSelection object
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return CustomFieldSelection::InstantiateDbRow($objDbResult->GetNextRow());
		}

		/**
		 * Static Qcodo Query method to query for an array of CustomFieldSelection objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return CustomFieldSelection[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = CustomFieldSelection::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return CustomFieldSelection::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
		}

		/**
		 * Static Qcodo Query method to query for a count of CustomFieldSelection objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = CustomFieldSelection::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
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
			$objDatabase = CustomFieldSelection::GetDatabase();

			// Lookup the QCache for This Query Statement
			$objCache = new QCache('query', 'custom_field_selection_' . serialize($strConditions));
			if (!($strQuery = $objCache->GetData())) {
				// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with CustomFieldSelection-specific fields
				$objQueryBuilder = new QQueryBuilder($objDatabase);
				CustomFieldSelection::GetSelectFields($objQueryBuilder);
				CustomFieldSelection::GetFromFields($objQueryBuilder);

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
			return CustomFieldSelection::InstantiateDbResult($objDbResult);
		}*/

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this CustomFieldSelection
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null) {
			if ($strPrefix) {
				$strTableName = '`' . $strPrefix . '`';
				$strAliasPrefix = '`' . $strPrefix . '__';
			} else {
				$strTableName = '`custom_field_selection`';
				$strAliasPrefix = '`';
			}

			$objBuilder->AddSelectItem($strTableName . '.`custom_field_selection_id` AS ' . $strAliasPrefix . 'custom_field_selection_id`');
			$objBuilder->AddSelectItem($strTableName . '.`custom_field_value_id` AS ' . $strAliasPrefix . 'custom_field_value_id`');
			$objBuilder->AddSelectItem($strTableName . '.`entity_qtype_id` AS ' . $strAliasPrefix . 'entity_qtype_id`');
			$objBuilder->AddSelectItem($strTableName . '.`entity_id` AS ' . $strAliasPrefix . 'entity_id`');
		}



		///////////////////////////////
		// INSTANTIATION-RELATED METHODS
		///////////////////////////////

		/**
		 * Instantiate a CustomFieldSelection from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this CustomFieldSelection::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param DatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @return CustomFieldSelection
		*/
		public static function InstantiateDbRow($objDbRow, $strAliasPrefix = null, $strExpandAsArrayNodes = null, $objPreviousItem = null) {
			// If blank row, return null
			if (!$objDbRow)
				return null;


			// Create a new instance of the CustomFieldSelection object
			$objToReturn = new CustomFieldSelection();
			$objToReturn->__blnRestored = true;

			$objToReturn->intCustomFieldSelectionId = $objDbRow->GetColumn($strAliasPrefix . 'custom_field_selection_id', 'Integer');
			$objToReturn->intCustomFieldValueId = $objDbRow->GetColumn($strAliasPrefix . 'custom_field_value_id', 'Integer');
			$objToReturn->intEntityQtypeId = $objDbRow->GetColumn($strAliasPrefix . 'entity_qtype_id', 'Integer');
			$objToReturn->intEntityId = $objDbRow->GetColumn($strAliasPrefix . 'entity_id', 'Integer');

			// Instantiate Virtual Attributes
			foreach ($objDbRow->GetColumnNameArray() as $strColumnName => $mixValue) {
				$strVirtualPrefix = $strAliasPrefix . '__';
				$strVirtualPrefixLength = strlen($strVirtualPrefix);
				if (substr($strColumnName, 0, $strVirtualPrefixLength) == $strVirtualPrefix)
					$objToReturn->__strVirtualAttributeArray[substr($strColumnName, $strVirtualPrefixLength)] = $mixValue;
			}

			// Prepare to Check for Early/Virtual Binding
			if (!$strAliasPrefix)
				$strAliasPrefix = 'custom_field_selection__';

			// Check for CustomFieldValue Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'custom_field_value_id__custom_field_value_id')))
				$objToReturn->objCustomFieldValue = CustomFieldValue::InstantiateDbRow($objDbRow, $strAliasPrefix . 'custom_field_value_id__', $strExpandAsArrayNodes);




			return $objToReturn;
		}

		/**
		 * Instantiate an array of CustomFieldSelections from a Database Result
		 * @param DatabaseResultBase $objDbResult
		 * @return CustomFieldSelection[]
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
					$objItem = CustomFieldSelection::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
					if ($objItem) {
						array_push($objToReturn, $objItem);
						$objLastRowItem = $objItem;
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					array_push($objToReturn, CustomFieldSelection::InstantiateDbRow($objDbRow));
			}

			return $objToReturn;
		}



		///////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Single Load and Array)
		///////////////////////////////////////////////////
			
		/**
		 * Load a single CustomFieldSelection object,
		 * by CustomFieldSelectionId Index(es)
		 * @param integer $intCustomFieldSelectionId
		 * @return CustomFieldSelection
		*/
		public static function LoadByCustomFieldSelectionId($intCustomFieldSelectionId) {
			return CustomFieldSelection::QuerySingle(
				QQ::Equal(QQN::CustomFieldSelection()->CustomFieldSelectionId, $intCustomFieldSelectionId)
			);
		}
			
		/**
		 * Load an array of CustomFieldSelection objects,
		 * by EntityQtypeId Index(es)
		 * @param integer $intEntityQtypeId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return CustomFieldSelection[]
		*/
		public static function LoadArrayByEntityQtypeId($intEntityQtypeId, $objOptionalClauses = null) {
			// Call CustomFieldSelection::QueryArray to perform the LoadArrayByEntityQtypeId query
			try {
				return CustomFieldSelection::QueryArray(
					QQ::Equal(QQN::CustomFieldSelection()->EntityQtypeId, $intEntityQtypeId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count CustomFieldSelections
		 * by EntityQtypeId Index(es)
		 * @param integer $intEntityQtypeId
		 * @return int
		*/
		public static function CountByEntityQtypeId($intEntityQtypeId) {
			// Call CustomFieldSelection::QueryCount to perform the CountByEntityQtypeId query
			return CustomFieldSelection::QueryCount(
				QQ::Equal(QQN::CustomFieldSelection()->EntityQtypeId, $intEntityQtypeId)
			);
		}
			
		/**
		 * Load an array of CustomFieldSelection objects,
		 * by CustomFieldValueId Index(es)
		 * @param integer $intCustomFieldValueId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return CustomFieldSelection[]
		*/
		public static function LoadArrayByCustomFieldValueId($intCustomFieldValueId, $objOptionalClauses = null) {
			// Call CustomFieldSelection::QueryArray to perform the LoadArrayByCustomFieldValueId query
			try {
				return CustomFieldSelection::QueryArray(
					QQ::Equal(QQN::CustomFieldSelection()->CustomFieldValueId, $intCustomFieldValueId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count CustomFieldSelections
		 * by CustomFieldValueId Index(es)
		 * @param integer $intCustomFieldValueId
		 * @return int
		*/
		public static function CountByCustomFieldValueId($intCustomFieldValueId) {
			// Call CustomFieldSelection::QueryCount to perform the CountByCustomFieldValueId query
			return CustomFieldSelection::QueryCount(
				QQ::Equal(QQN::CustomFieldSelection()->CustomFieldValueId, $intCustomFieldValueId)
			);
		}
			
		/**
		 * Load an array of CustomFieldSelection objects,
		 * by EntityId Index(es)
		 * @param integer $intEntityId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return CustomFieldSelection[]
		*/
		public static function LoadArrayByEntityId($intEntityId, $objOptionalClauses = null) {
			// Call CustomFieldSelection::QueryArray to perform the LoadArrayByEntityId query
			try {
				return CustomFieldSelection::QueryArray(
					QQ::Equal(QQN::CustomFieldSelection()->EntityId, $intEntityId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count CustomFieldSelections
		 * by EntityId Index(es)
		 * @param integer $intEntityId
		 * @return int
		*/
		public static function CountByEntityId($intEntityId) {
			// Call CustomFieldSelection::QueryCount to perform the CountByEntityId query
			return CustomFieldSelection::QueryCount(
				QQ::Equal(QQN::CustomFieldSelection()->EntityId, $intEntityId)
			);
		}



		////////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Array via Many to Many)
		////////////////////////////////////////////////////



		//////////////////
		// SAVE AND DELETE
		//////////////////

		/**
		 * Save this CustomFieldSelection
		 * @param bool $blnForceInsert
		 * @param bool $blnForceUpdate
		 * @return int
		*/
		public function Save($blnForceInsert = false, $blnForceUpdate = false) {
			// Get the Database Object for this Class
			$objDatabase = CustomFieldSelection::GetDatabase();

			$mixToReturn = null;

			try {
				if ((!$this->__blnRestored) || ($blnForceInsert)) {
					// Perform an INSERT query
					$objDatabase->NonQuery('
						INSERT INTO `custom_field_selection` (
							`custom_field_value_id`,
							`entity_qtype_id`,
							`entity_id`
						) VALUES (
							' . $objDatabase->SqlVariable($this->intCustomFieldValueId) . ',
							' . $objDatabase->SqlVariable($this->intEntityQtypeId) . ',
							' . $objDatabase->SqlVariable($this->intEntityId) . '
						)
					');

					// Update Identity column and return its value
					$mixToReturn = $this->intCustomFieldSelectionId = $objDatabase->InsertId('custom_field_selection', 'custom_field_selection_id');
				} else {
					// Perform an UPDATE query

					// First checking for Optimistic Locking constraints (if applicable)

					// Perform the UPDATE query
					$objDatabase->NonQuery('
						UPDATE
							`custom_field_selection`
						SET
							`custom_field_value_id` = ' . $objDatabase->SqlVariable($this->intCustomFieldValueId) . ',
							`entity_qtype_id` = ' . $objDatabase->SqlVariable($this->intEntityQtypeId) . ',
							`entity_id` = ' . $objDatabase->SqlVariable($this->intEntityId) . '
						WHERE
							`custom_field_selection_id` = ' . $objDatabase->SqlVariable($this->intCustomFieldSelectionId) . '
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
		 * Delete this CustomFieldSelection
		 * @return void
		*/
		public function Delete() {
			if ((is_null($this->intCustomFieldSelectionId)))
				throw new QUndefinedPrimaryKeyException('Cannot delete this CustomFieldSelection with an unset primary key.');

			// Get the Database Object for this Class
			$objDatabase = CustomFieldSelection::GetDatabase();


			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`custom_field_selection`
				WHERE
					`custom_field_selection_id` = ' . $objDatabase->SqlVariable($this->intCustomFieldSelectionId) . '');
		}

		/**
		 * Delete all CustomFieldSelections
		 * @return void
		*/
		public static function DeleteAll() {
			// Get the Database Object for this Class
			$objDatabase = CustomFieldSelection::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				DELETE FROM
					`custom_field_selection`');
		}

		/**
		 * Truncate custom_field_selection table
		 * @return void
		*/
		public static function Truncate() {
			// Get the Database Object for this Class
			$objDatabase = CustomFieldSelection::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				TRUNCATE `custom_field_selection`');
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
				case 'CustomFieldSelectionId':
					/**
					 * Gets the value for intCustomFieldSelectionId (Read-Only PK)
					 * @return integer
					 */
					return $this->intCustomFieldSelectionId;

				case 'CustomFieldValueId':
					/**
					 * Gets the value for intCustomFieldValueId (Not Null)
					 * @return integer
					 */
					return $this->intCustomFieldValueId;

				case 'EntityQtypeId':
					/**
					 * Gets the value for intEntityQtypeId (Not Null)
					 * @return integer
					 */
					return $this->intEntityQtypeId;

				case 'EntityId':
					/**
					 * Gets the value for intEntityId (Not Null)
					 * @return integer
					 */
					return $this->intEntityId;


				///////////////////
				// Member Objects
				///////////////////
				case 'CustomFieldValue':
					/**
					 * Gets the value for the CustomFieldValue object referenced by intCustomFieldValueId (Not Null)
					 * @return CustomFieldValue
					 */
					try {
						if ((!$this->objCustomFieldValue) && (!is_null($this->intCustomFieldValueId)))
							$this->objCustomFieldValue = CustomFieldValue::Load($this->intCustomFieldValueId);
						return $this->objCustomFieldValue;
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
				case 'CustomFieldValueId':
					/**
					 * Sets the value for intCustomFieldValueId (Not Null)
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						$this->objCustomFieldValue = null;
						return ($this->intCustomFieldValueId = QType::Cast($mixValue, QType::Integer));
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

				case 'EntityId':
					/**
					 * Sets the value for intEntityId (Not Null)
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						return ($this->intEntityId = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}


				///////////////////
				// Member Objects
				///////////////////
				case 'CustomFieldValue':
					/**
					 * Sets the value for the CustomFieldValue object referenced by intCustomFieldValueId (Not Null)
					 * @param CustomFieldValue $mixValue
					 * @return CustomFieldValue
					 */
					if (is_null($mixValue)) {
						$this->intCustomFieldValueId = null;
						$this->objCustomFieldValue = null;
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
							throw new QCallerException('Unable to set an unsaved CustomFieldValue for this CustomFieldSelection');

						// Update Local Member Variables
						$this->objCustomFieldValue = $mixValue;
						$this->intCustomFieldValueId = $mixValue->CustomFieldValueId;

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
		 * Protected member variable that maps to the database PK Identity column custom_field_selection.custom_field_selection_id
		 * @var integer intCustomFieldSelectionId
		 */
		protected $intCustomFieldSelectionId;
		const CustomFieldSelectionIdDefault = null;


		/**
		 * Protected member variable that maps to the database column custom_field_selection.custom_field_value_id
		 * @var integer intCustomFieldValueId
		 */
		protected $intCustomFieldValueId;
		const CustomFieldValueIdDefault = null;


		/**
		 * Protected member variable that maps to the database column custom_field_selection.entity_qtype_id
		 * @var integer intEntityQtypeId
		 */
		protected $intEntityQtypeId;
		const EntityQtypeIdDefault = null;


		/**
		 * Protected member variable that maps to the database column custom_field_selection.entity_id
		 * @var integer intEntityId
		 */
		protected $intEntityId;
		const EntityIdDefault = null;


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
		 * in the database column custom_field_selection.custom_field_value_id.
		 *
		 * NOTE: Always use the CustomFieldValue property getter to correctly retrieve this CustomFieldValue object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var CustomFieldValue objCustomFieldValue
		 */
		protected $objCustomFieldValue;






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
				$objQueryExpansion = new QQueryExpansion('CustomFieldSelection', 'custom_field_selection', $objExpansionMap);
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
				$objQueryExpansion->AddFromItem(sprintf('LEFT JOIN `custom_field_selection` AS `%s__%s` ON `%s`.`%s` = `%s__%s`.`custom_field_selection_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias, $strParentAlias, $strAlias));

				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`custom_field_selection_id` AS `%s__%s__custom_field_selection_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`custom_field_value_id` AS `%s__%s__custom_field_value_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`entity_qtype_id` AS `%s__%s__entity_qtype_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`entity_id` AS `%s__%s__entity_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));

				$strParentAlias = $strParentAlias . '__' . $strAlias;
			}

			if (is_array($objExpansionMap))
				foreach ($objExpansionMap as $strKey=>$objValue) {
					switch ($strKey) {
						case 'custom_field_value_id':
							try {
								CustomFieldValue::ExpandQuery($strParentAlias, $strKey, $objValue, $objQueryExpansion);
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
		const ExpandCustomFieldValue = 'custom_field_value_id';




		////////////////////////////////////////
		// METHODS for WEB SERVICES
		////////////////////////////////////////

		public static function GetSoapComplexTypeXml() {
			$strToReturn = '<complexType name="CustomFieldSelection"><sequence>';
			$strToReturn .= '<element name="CustomFieldSelectionId" type="xsd:int"/>';
			$strToReturn .= '<element name="CustomFieldValue" type="xsd1:CustomFieldValue"/>';
			$strToReturn .= '<element name="EntityQtypeId" type="xsd:int"/>';
			$strToReturn .= '<element name="EntityId" type="xsd:int"/>';
			$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
			$strToReturn .= '</sequence></complexType>';
			return $strToReturn;
		}

		public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
			if (!array_key_exists('CustomFieldSelection', $strComplexTypeArray)) {
				$strComplexTypeArray['CustomFieldSelection'] = CustomFieldSelection::GetSoapComplexTypeXml();
				CustomFieldValue::AlterSoapComplexTypeArray($strComplexTypeArray);
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, CustomFieldSelection::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new CustomFieldSelection();
			if (property_exists($objSoapObject, 'CustomFieldSelectionId'))
				$objToReturn->intCustomFieldSelectionId = $objSoapObject->CustomFieldSelectionId;
			if ((property_exists($objSoapObject, 'CustomFieldValue')) &&
				($objSoapObject->CustomFieldValue))
				$objToReturn->CustomFieldValue = CustomFieldValue::GetObjectFromSoapObject($objSoapObject->CustomFieldValue);
			if (property_exists($objSoapObject, 'EntityQtypeId'))
				$objToReturn->intEntityQtypeId = $objSoapObject->EntityQtypeId;
			if (property_exists($objSoapObject, 'EntityId'))
				$objToReturn->intEntityId = $objSoapObject->EntityId;
			if (property_exists($objSoapObject, '__blnRestored'))
				$objToReturn->__blnRestored = $objSoapObject->__blnRestored;
			return $objToReturn;
		}

		public static function GetSoapArrayFromArray($objArray) {
			if (!$objArray)
				return null;

			$objArrayToReturn = array();

			foreach ($objArray as $objObject)
				array_push($objArrayToReturn, CustomFieldSelection::GetSoapObjectFromObject($objObject, true));

			return unserialize(serialize($objArrayToReturn));
		}

		public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
			if ($objObject->objCustomFieldValue)
				$objObject->objCustomFieldValue = CustomFieldValue::GetSoapObjectFromObject($objObject->objCustomFieldValue, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intCustomFieldValueId = null;
			return $objObject;
		}
	}





	/////////////////////////////////////
	// ADDITIONAL CLASSES for QCODO QUERY
	/////////////////////////////////////

	class QQNodeCustomFieldSelection extends QQNode {
		protected $strTableName = 'custom_field_selection';
		protected $strPrimaryKey = 'custom_field_selection_id';
		protected $strClassName = 'CustomFieldSelection';
		public function __get($strName) {
			switch ($strName) {
				case 'CustomFieldSelectionId':
					return new QQNode('custom_field_selection_id', 'integer', $this);
				case 'CustomFieldValueId':
					return new QQNode('custom_field_value_id', 'integer', $this);
				case 'CustomFieldValue':
					return new QQNodeCustomFieldValue('custom_field_value_id', 'integer', $this);
				case 'EntityQtypeId':
					return new QQNode('entity_qtype_id', 'integer', $this);
				case 'EntityId':
					return new QQNode('entity_id', 'integer', $this);

				case '_PrimaryKeyNode':
					return new QQNode('custom_field_selection_id', 'integer', $this);
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

	class QQReverseReferenceNodeCustomFieldSelection extends QQReverseReferenceNode {
		protected $strTableName = 'custom_field_selection';
		protected $strPrimaryKey = 'custom_field_selection_id';
		protected $strClassName = 'CustomFieldSelection';
		public function __get($strName) {
			switch ($strName) {
				case 'CustomFieldSelectionId':
					return new QQNode('custom_field_selection_id', 'integer', $this);
				case 'CustomFieldValueId':
					return new QQNode('custom_field_value_id', 'integer', $this);
				case 'CustomFieldValue':
					return new QQNodeCustomFieldValue('custom_field_value_id', 'integer', $this);
				case 'EntityQtypeId':
					return new QQNode('entity_qtype_id', 'integer', $this);
				case 'EntityId':
					return new QQNode('entity_id', 'integer', $this);

				case '_PrimaryKeyNode':
					return new QQNode('custom_field_selection_id', 'integer', $this);
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