<?php
	/**
	 * The abstract ManufacturerGen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the Manufacturer subclass which
	 * extends this ManufacturerGen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the Manufacturer class.
	 * 
	 * @package My Application
	 * @subpackage GeneratedDataObjects
	 * 
	 */
	class ManufacturerGen extends QBaseClass {
		///////////////////////////////
		// COMMON LOAD METHODS
		///////////////////////////////

		/**
		 * Load a Manufacturer from PK Info
		 * @param integer $intManufacturerId
		 * @return Manufacturer
		 */
		public static function Load($intManufacturerId) {
			// Use QuerySingle to Perform the Query
			return Manufacturer::QuerySingle(
				QQ::Equal(QQN::Manufacturer()->ManufacturerId, $intManufacturerId)
			);
		}

		/**
		 * Load all Manufacturers
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Manufacturer[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			// Call Manufacturer::QueryArray to perform the LoadAll query
			try {
				return Manufacturer::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all Manufacturers
		 * @return int
		 */
		public static function CountAll() {
			// Call Manufacturer::QueryCount to perform the CountAll query
			return Manufacturer::QueryCount(QQ::All());
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
			$objDatabase = Manufacturer::GetDatabase();

			// Create/Build out the QueryBuilder object with Manufacturer-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, 'manufacturer');
			Manufacturer::GetSelectFields($objQueryBuilder);
			$objQueryBuilder->AddFromItem('`manufacturer` AS `manufacturer`');

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
		 * Static Qcodo Query method to query for a single Manufacturer object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return Manufacturer the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Manufacturer::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query, Get the First Row, and Instantiate a new Manufacturer object
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return Manufacturer::InstantiateDbRow($objDbResult->GetNextRow());
		}

		/**
		 * Static Qcodo Query method to query for an array of Manufacturer objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return Manufacturer[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Manufacturer::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return Manufacturer::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
		}

		/**
		 * Static Qcodo Query method to query for a count of Manufacturer objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Manufacturer::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
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
			$objDatabase = Manufacturer::GetDatabase();

			// Lookup the QCache for This Query Statement
			$objCache = new QCache('query', 'manufacturer_' . serialize($strConditions));
			if (!($strQuery = $objCache->GetData())) {
				// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with Manufacturer-specific fields
				$objQueryBuilder = new QQueryBuilder($objDatabase);
				Manufacturer::GetSelectFields($objQueryBuilder);
				Manufacturer::GetFromFields($objQueryBuilder);

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
			return Manufacturer::InstantiateDbResult($objDbResult);
		}*/

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this Manufacturer
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null) {
			if ($strPrefix) {
				$strTableName = '`' . $strPrefix . '`';
				$strAliasPrefix = '`' . $strPrefix . '__';
			} else {
				$strTableName = '`manufacturer`';
				$strAliasPrefix = '`';
			}

			$objBuilder->AddSelectItem($strTableName . '.`manufacturer_id` AS ' . $strAliasPrefix . 'manufacturer_id`');
			$objBuilder->AddSelectItem($strTableName . '.`short_description` AS ' . $strAliasPrefix . 'short_description`');
			$objBuilder->AddSelectItem($strTableName . '.`long_description` AS ' . $strAliasPrefix . 'long_description`');
			$objBuilder->AddSelectItem($strTableName . '.`image_path` AS ' . $strAliasPrefix . 'image_path`');
			$objBuilder->AddSelectItem($strTableName . '.`created_by` AS ' . $strAliasPrefix . 'created_by`');
			$objBuilder->AddSelectItem($strTableName . '.`creation_date` AS ' . $strAliasPrefix . 'creation_date`');
			$objBuilder->AddSelectItem($strTableName . '.`modified_by` AS ' . $strAliasPrefix . 'modified_by`');
			$objBuilder->AddSelectItem($strTableName . '.`modified_date` AS ' . $strAliasPrefix . 'modified_date`');
		}



		///////////////////////////////
		// INSTANTIATION-RELATED METHODS
		///////////////////////////////

		/**
		 * Instantiate a Manufacturer from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this Manufacturer::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param DatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @return Manufacturer
		*/
		public static function InstantiateDbRow($objDbRow, $strAliasPrefix = null, $strExpandAsArrayNodes = null, $objPreviousItem = null) {
			// If blank row, return null
			if (!$objDbRow)
				return null;

			// See if we're doing an array expansion on the previous item
			if (($strExpandAsArrayNodes) && ($objPreviousItem) &&
				($objPreviousItem->intManufacturerId == $objDbRow->GetColumn($strAliasPrefix . 'manufacturer_id', 'Integer'))) {

				// We are.  Now, prepare to check for ExpandAsArray clauses
				$blnExpandedViaArray = false;
				if (!$strAliasPrefix)
					$strAliasPrefix = 'manufacturer__';


				if ((array_key_exists($strAliasPrefix . 'assetmodel__asset_model_id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'assetmodel__asset_model_id')))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objAssetModelArray)) {
						$objPreviousChildItem = $objPreviousItem->_objAssetModelArray[$intPreviousChildItemCount - 1];
						$objChildItem = AssetModel::InstantiateDbRow($objDbRow, $strAliasPrefix . 'assetmodel__', $strExpandAsArrayNodes, $objPreviousChildItem);
						if ($objChildItem)
							array_push($objPreviousItem->_objAssetModelArray, $objChildItem);
					} else
						array_push($objPreviousItem->_objAssetModelArray, AssetModel::InstantiateDbRow($objDbRow, $strAliasPrefix . 'assetmodel__', $strExpandAsArrayNodes));
					$blnExpandedViaArray = true;
				}

				if ((array_key_exists($strAliasPrefix . 'inventorymodel__inventory_model_id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'inventorymodel__inventory_model_id')))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objInventoryModelArray)) {
						$objPreviousChildItem = $objPreviousItem->_objInventoryModelArray[$intPreviousChildItemCount - 1];
						$objChildItem = InventoryModel::InstantiateDbRow($objDbRow, $strAliasPrefix . 'inventorymodel__', $strExpandAsArrayNodes, $objPreviousChildItem);
						if ($objChildItem)
							array_push($objPreviousItem->_objInventoryModelArray, $objChildItem);
					} else
						array_push($objPreviousItem->_objInventoryModelArray, InventoryModel::InstantiateDbRow($objDbRow, $strAliasPrefix . 'inventorymodel__', $strExpandAsArrayNodes));
					$blnExpandedViaArray = true;
				}

				// Either return false to signal array expansion, or check-to-reset the Alias prefix and move on
				if ($blnExpandedViaArray)
					return false;
				else if ($strAliasPrefix == 'manufacturer__')
					$strAliasPrefix = null;
			}

			// Create a new instance of the Manufacturer object
			$objToReturn = new Manufacturer();
			$objToReturn->__blnRestored = true;

			$objToReturn->intManufacturerId = $objDbRow->GetColumn($strAliasPrefix . 'manufacturer_id', 'Integer');
			$objToReturn->strShortDescription = $objDbRow->GetColumn($strAliasPrefix . 'short_description', 'VarChar');
			$objToReturn->strLongDescription = $objDbRow->GetColumn($strAliasPrefix . 'long_description', 'Blob');
			$objToReturn->strImagePath = $objDbRow->GetColumn($strAliasPrefix . 'image_path', 'VarChar');
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
				$strAliasPrefix = 'manufacturer__';

			// Check for CreatedByObject Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'created_by__user_account_id')))
				$objToReturn->objCreatedByObject = UserAccount::InstantiateDbRow($objDbRow, $strAliasPrefix . 'created_by__', $strExpandAsArrayNodes);

			// Check for ModifiedByObject Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'modified_by__user_account_id')))
				$objToReturn->objModifiedByObject = UserAccount::InstantiateDbRow($objDbRow, $strAliasPrefix . 'modified_by__', $strExpandAsArrayNodes);




			// Check for AssetModel Virtual Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'assetmodel__asset_model_id'))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'assetmodel__asset_model_id', $strExpandAsArrayNodes)))
					array_push($objToReturn->_objAssetModelArray, AssetModel::InstantiateDbRow($objDbRow, $strAliasPrefix . 'assetmodel__', $strExpandAsArrayNodes));
				else
					$objToReturn->_objAssetModel = AssetModel::InstantiateDbRow($objDbRow, $strAliasPrefix . 'assetmodel__', $strExpandAsArrayNodes);
			}

			// Check for InventoryModel Virtual Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'inventorymodel__inventory_model_id'))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'inventorymodel__inventory_model_id', $strExpandAsArrayNodes)))
					array_push($objToReturn->_objInventoryModelArray, InventoryModel::InstantiateDbRow($objDbRow, $strAliasPrefix . 'inventorymodel__', $strExpandAsArrayNodes));
				else
					$objToReturn->_objInventoryModel = InventoryModel::InstantiateDbRow($objDbRow, $strAliasPrefix . 'inventorymodel__', $strExpandAsArrayNodes);
			}

			return $objToReturn;
		}

		/**
		 * Instantiate an array of Manufacturers from a Database Result
		 * @param DatabaseResultBase $objDbResult
		 * @return Manufacturer[]
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
					$objItem = Manufacturer::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
					if ($objItem) {
						array_push($objToReturn, $objItem);
						$objLastRowItem = $objItem;
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					array_push($objToReturn, Manufacturer::InstantiateDbRow($objDbRow));
			}

			return $objToReturn;
		}



		///////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Single Load and Array)
		///////////////////////////////////////////////////
			
		/**
		 * Load a single Manufacturer object,
		 * by ManufacturerId Index(es)
		 * @param integer $intManufacturerId
		 * @return Manufacturer
		*/
		public static function LoadByManufacturerId($intManufacturerId) {
			return Manufacturer::QuerySingle(
				QQ::Equal(QQN::Manufacturer()->ManufacturerId, $intManufacturerId)
			);
		}
			
		/**
		 * Load an array of Manufacturer objects,
		 * by CreatedBy Index(es)
		 * @param integer $intCreatedBy
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Manufacturer[]
		*/
		public static function LoadArrayByCreatedBy($intCreatedBy, $objOptionalClauses = null) {
			// Call Manufacturer::QueryArray to perform the LoadArrayByCreatedBy query
			try {
				return Manufacturer::QueryArray(
					QQ::Equal(QQN::Manufacturer()->CreatedBy, $intCreatedBy),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count Manufacturers
		 * by CreatedBy Index(es)
		 * @param integer $intCreatedBy
		 * @return int
		*/
		public static function CountByCreatedBy($intCreatedBy) {
			// Call Manufacturer::QueryCount to perform the CountByCreatedBy query
			return Manufacturer::QueryCount(
				QQ::Equal(QQN::Manufacturer()->CreatedBy, $intCreatedBy)
			);
		}
			
		/**
		 * Load an array of Manufacturer objects,
		 * by ModifiedBy Index(es)
		 * @param integer $intModifiedBy
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Manufacturer[]
		*/
		public static function LoadArrayByModifiedBy($intModifiedBy, $objOptionalClauses = null) {
			// Call Manufacturer::QueryArray to perform the LoadArrayByModifiedBy query
			try {
				return Manufacturer::QueryArray(
					QQ::Equal(QQN::Manufacturer()->ModifiedBy, $intModifiedBy),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count Manufacturers
		 * by ModifiedBy Index(es)
		 * @param integer $intModifiedBy
		 * @return int
		*/
		public static function CountByModifiedBy($intModifiedBy) {
			// Call Manufacturer::QueryCount to perform the CountByModifiedBy query
			return Manufacturer::QueryCount(
				QQ::Equal(QQN::Manufacturer()->ModifiedBy, $intModifiedBy)
			);
		}



		////////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Array via Many to Many)
		////////////////////////////////////////////////////



		//////////////////
		// SAVE AND DELETE
		//////////////////

		/**
		 * Save this Manufacturer
		 * @param bool $blnForceInsert
		 * @param bool $blnForceUpdate
		 * @return int
		*/
		public function Save($blnForceInsert = false, $blnForceUpdate = false) {
			// Get the Database Object for this Class
			$objDatabase = Manufacturer::GetDatabase();

			$mixToReturn = null;

			try {
				if ((!$this->__blnRestored) || ($blnForceInsert)) {
					// Perform an INSERT query
					$objDatabase->NonQuery('
						INSERT INTO `manufacturer` (
							`short_description`,
							`long_description`,
							`image_path`,
							`created_by`,
							`creation_date`,
							`modified_by`
						) VALUES (
							' . $objDatabase->SqlVariable($this->strShortDescription) . ',
							' . $objDatabase->SqlVariable($this->strLongDescription) . ',
							' . $objDatabase->SqlVariable($this->strImagePath) . ',
							' . $objDatabase->SqlVariable($this->intCreatedBy) . ',
							' . $objDatabase->SqlVariable($this->dttCreationDate) . ',
							' . $objDatabase->SqlVariable($this->intModifiedBy) . '
						)
					');

					// Update Identity column and return its value
					$mixToReturn = $this->intManufacturerId = $objDatabase->InsertId('manufacturer', 'manufacturer_id');
				} else {
					// Perform an UPDATE query

					// First checking for Optimistic Locking constraints (if applicable)
					if (!$blnForceUpdate) {
						// Perform the Optimistic Locking check
						$objResult = $objDatabase->Query('
							SELECT
								`modified_date`
							FROM
								`manufacturer`
							WHERE
								`manufacturer_id` = ' . $objDatabase->SqlVariable($this->intManufacturerId) . '
						');
						
						$objRow = $objResult->FetchArray();
						if ($objRow[0] != $this->strModifiedDate)
							throw new QExtendedOptimisticLockingException('Manufacturer', $this->intManufacturerId);
					}

					// Perform the UPDATE query
					$objDatabase->NonQuery('
						UPDATE
							`manufacturer`
						SET
							`short_description` = ' . $objDatabase->SqlVariable($this->strShortDescription) . ',
							`long_description` = ' . $objDatabase->SqlVariable($this->strLongDescription) . ',
							`image_path` = ' . $objDatabase->SqlVariable($this->strImagePath) . ',
							`created_by` = ' . $objDatabase->SqlVariable($this->intCreatedBy) . ',
							`creation_date` = ' . $objDatabase->SqlVariable($this->dttCreationDate) . ',
							`modified_by` = ' . $objDatabase->SqlVariable($this->intModifiedBy) . '
						WHERE
							`manufacturer_id` = ' . $objDatabase->SqlVariable($this->intManufacturerId) . '
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
					`manufacturer`
				WHERE
					`manufacturer_id` = ' . $objDatabase->SqlVariable($this->intManufacturerId) . '
			');
						
			$objRow = $objResult->FetchArray();
			$this->strModifiedDate = $objRow[0];

			// Return 
			return $mixToReturn;
		}

				/**
		 * Delete this Manufacturer
		 * @return void
		*/
		public function Delete() {
			if ((is_null($this->intManufacturerId)))
				throw new QUndefinedPrimaryKeyException('Cannot delete this Manufacturer with an unset primary key.');

			// Get the Database Object for this Class
			$objDatabase = Manufacturer::GetDatabase();


			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`manufacturer`
				WHERE
					`manufacturer_id` = ' . $objDatabase->SqlVariable($this->intManufacturerId) . '');
		}

		/**
		 * Delete all Manufacturers
		 * @return void
		*/
		public static function DeleteAll() {
			// Get the Database Object for this Class
			$objDatabase = Manufacturer::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				DELETE FROM
					`manufacturer`');
		}

		/**
		 * Truncate manufacturer table
		 * @return void
		*/
		public static function Truncate() {
			// Get the Database Object for this Class
			$objDatabase = Manufacturer::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				TRUNCATE `manufacturer`');
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
				case 'ManufacturerId':
					/**
					 * Gets the value for intManufacturerId (Read-Only PK)
					 * @return integer
					 */
					return $this->intManufacturerId;

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

				case 'ImagePath':
					/**
					 * Gets the value for strImagePath 
					 * @return string
					 */
					return $this->strImagePath;

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

				case '_AssetModel':
					/**
					 * Gets the value for the private _objAssetModel (Read-Only)
					 * if set due to an expansion on the asset_model.manufacturer_id reverse relationship
					 * @return AssetModel
					 */
					return $this->_objAssetModel;

				case '_AssetModelArray':
					/**
					 * Gets the value for the private _objAssetModelArray (Read-Only)
					 * if set due to an ExpandAsArray on the asset_model.manufacturer_id reverse relationship
					 * @return AssetModel[]
					 */
					return (array) $this->_objAssetModelArray;

				case '_InventoryModel':
					/**
					 * Gets the value for the private _objInventoryModel (Read-Only)
					 * if set due to an expansion on the inventory_model.manufacturer_id reverse relationship
					 * @return InventoryModel
					 */
					return $this->_objInventoryModel;

				case '_InventoryModelArray':
					/**
					 * Gets the value for the private _objInventoryModelArray (Read-Only)
					 * if set due to an ExpandAsArray on the inventory_model.manufacturer_id reverse relationship
					 * @return InventoryModel[]
					 */
					return (array) $this->_objInventoryModelArray;

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
							throw new QCallerException('Unable to set an unsaved CreatedByObject for this Manufacturer');

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
							throw new QCallerException('Unable to set an unsaved ModifiedByObject for this Manufacturer');

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

			
		
		// Related Objects' Methods for AssetModel
		//-------------------------------------------------------------------

		/**
		 * Gets all associated AssetModels as an array of AssetModel objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return AssetModel[]
		*/ 
		public function GetAssetModelArray($objOptionalClauses = null) {
			if ((is_null($this->intManufacturerId)))
				return array();

			try {
				return AssetModel::LoadArrayByManufacturerId($this->intManufacturerId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated AssetModels
		 * @return int
		*/ 
		public function CountAssetModels() {
			if ((is_null($this->intManufacturerId)))
				return 0;

			return AssetModel::CountByManufacturerId($this->intManufacturerId);
		}

		/**
		 * Associates a AssetModel
		 * @param AssetModel $objAssetModel
		 * @return void
		*/ 
		public function AssociateAssetModel(AssetModel $objAssetModel) {
			if ((is_null($this->intManufacturerId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateAssetModel on this unsaved Manufacturer.');
			if ((is_null($objAssetModel->AssetModelId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateAssetModel on this Manufacturer with an unsaved AssetModel.');

			// Get the Database Object for this Class
			$objDatabase = Manufacturer::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`asset_model`
				SET
					`manufacturer_id` = ' . $objDatabase->SqlVariable($this->intManufacturerId) . '
				WHERE
					`asset_model_id` = ' . $objDatabase->SqlVariable($objAssetModel->AssetModelId) . '
			');
		}

		/**
		 * Unassociates a AssetModel
		 * @param AssetModel $objAssetModel
		 * @return void
		*/ 
		public function UnassociateAssetModel(AssetModel $objAssetModel) {
			if ((is_null($this->intManufacturerId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateAssetModel on this unsaved Manufacturer.');
			if ((is_null($objAssetModel->AssetModelId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateAssetModel on this Manufacturer with an unsaved AssetModel.');

			// Get the Database Object for this Class
			$objDatabase = Manufacturer::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`asset_model`
				SET
					`manufacturer_id` = null
				WHERE
					`asset_model_id` = ' . $objDatabase->SqlVariable($objAssetModel->AssetModelId) . ' AND
					`manufacturer_id` = ' . $objDatabase->SqlVariable($this->intManufacturerId) . '
			');
		}

		/**
		 * Unassociates all AssetModels
		 * @return void
		*/ 
		public function UnassociateAllAssetModels() {
			if ((is_null($this->intManufacturerId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateAssetModel on this unsaved Manufacturer.');

			// Get the Database Object for this Class
			$objDatabase = Manufacturer::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`asset_model`
				SET
					`manufacturer_id` = null
				WHERE
					`manufacturer_id` = ' . $objDatabase->SqlVariable($this->intManufacturerId) . '
			');
		}

		/**
		 * Deletes an associated AssetModel
		 * @param AssetModel $objAssetModel
		 * @return void
		*/ 
		public function DeleteAssociatedAssetModel(AssetModel $objAssetModel) {
			if ((is_null($this->intManufacturerId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateAssetModel on this unsaved Manufacturer.');
			if ((is_null($objAssetModel->AssetModelId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateAssetModel on this Manufacturer with an unsaved AssetModel.');

			// Get the Database Object for this Class
			$objDatabase = Manufacturer::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`asset_model`
				WHERE
					`asset_model_id` = ' . $objDatabase->SqlVariable($objAssetModel->AssetModelId) . ' AND
					`manufacturer_id` = ' . $objDatabase->SqlVariable($this->intManufacturerId) . '
			');
		}

		/**
		 * Deletes all associated AssetModels
		 * @return void
		*/ 
		public function DeleteAllAssetModels() {
			if ((is_null($this->intManufacturerId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateAssetModel on this unsaved Manufacturer.');

			// Get the Database Object for this Class
			$objDatabase = Manufacturer::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`asset_model`
				WHERE
					`manufacturer_id` = ' . $objDatabase->SqlVariable($this->intManufacturerId) . '
			');
		}

			
		
		// Related Objects' Methods for InventoryModel
		//-------------------------------------------------------------------

		/**
		 * Gets all associated InventoryModels as an array of InventoryModel objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return InventoryModel[]
		*/ 
		public function GetInventoryModelArray($objOptionalClauses = null) {
			if ((is_null($this->intManufacturerId)))
				return array();

			try {
				return InventoryModel::LoadArrayByManufacturerId($this->intManufacturerId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated InventoryModels
		 * @return int
		*/ 
		public function CountInventoryModels() {
			if ((is_null($this->intManufacturerId)))
				return 0;

			return InventoryModel::CountByManufacturerId($this->intManufacturerId);
		}

		/**
		 * Associates a InventoryModel
		 * @param InventoryModel $objInventoryModel
		 * @return void
		*/ 
		public function AssociateInventoryModel(InventoryModel $objInventoryModel) {
			if ((is_null($this->intManufacturerId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateInventoryModel on this unsaved Manufacturer.');
			if ((is_null($objInventoryModel->InventoryModelId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateInventoryModel on this Manufacturer with an unsaved InventoryModel.');

			// Get the Database Object for this Class
			$objDatabase = Manufacturer::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`inventory_model`
				SET
					`manufacturer_id` = ' . $objDatabase->SqlVariable($this->intManufacturerId) . '
				WHERE
					`inventory_model_id` = ' . $objDatabase->SqlVariable($objInventoryModel->InventoryModelId) . '
			');
		}

		/**
		 * Unassociates a InventoryModel
		 * @param InventoryModel $objInventoryModel
		 * @return void
		*/ 
		public function UnassociateInventoryModel(InventoryModel $objInventoryModel) {
			if ((is_null($this->intManufacturerId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateInventoryModel on this unsaved Manufacturer.');
			if ((is_null($objInventoryModel->InventoryModelId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateInventoryModel on this Manufacturer with an unsaved InventoryModel.');

			// Get the Database Object for this Class
			$objDatabase = Manufacturer::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`inventory_model`
				SET
					`manufacturer_id` = null
				WHERE
					`inventory_model_id` = ' . $objDatabase->SqlVariable($objInventoryModel->InventoryModelId) . ' AND
					`manufacturer_id` = ' . $objDatabase->SqlVariable($this->intManufacturerId) . '
			');
		}

		/**
		 * Unassociates all InventoryModels
		 * @return void
		*/ 
		public function UnassociateAllInventoryModels() {
			if ((is_null($this->intManufacturerId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateInventoryModel on this unsaved Manufacturer.');

			// Get the Database Object for this Class
			$objDatabase = Manufacturer::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`inventory_model`
				SET
					`manufacturer_id` = null
				WHERE
					`manufacturer_id` = ' . $objDatabase->SqlVariable($this->intManufacturerId) . '
			');
		}

		/**
		 * Deletes an associated InventoryModel
		 * @param InventoryModel $objInventoryModel
		 * @return void
		*/ 
		public function DeleteAssociatedInventoryModel(InventoryModel $objInventoryModel) {
			if ((is_null($this->intManufacturerId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateInventoryModel on this unsaved Manufacturer.');
			if ((is_null($objInventoryModel->InventoryModelId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateInventoryModel on this Manufacturer with an unsaved InventoryModel.');

			// Get the Database Object for this Class
			$objDatabase = Manufacturer::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`inventory_model`
				WHERE
					`inventory_model_id` = ' . $objDatabase->SqlVariable($objInventoryModel->InventoryModelId) . ' AND
					`manufacturer_id` = ' . $objDatabase->SqlVariable($this->intManufacturerId) . '
			');
		}

		/**
		 * Deletes all associated InventoryModels
		 * @return void
		*/ 
		public function DeleteAllInventoryModels() {
			if ((is_null($this->intManufacturerId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateInventoryModel on this unsaved Manufacturer.');

			// Get the Database Object for this Class
			$objDatabase = Manufacturer::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`inventory_model`
				WHERE
					`manufacturer_id` = ' . $objDatabase->SqlVariable($this->intManufacturerId) . '
			');
		}




		///////////////////////////////////////////////////////////////////////
		// PROTECTED MEMBER VARIABLES and TEXT FIELD MAXLENGTHS (if applicable)
		///////////////////////////////////////////////////////////////////////
		
		/**
		 * Protected member variable that maps to the database PK Identity column manufacturer.manufacturer_id
		 * @var integer intManufacturerId
		 */
		protected $intManufacturerId;
		const ManufacturerIdDefault = null;


		/**
		 * Protected member variable that maps to the database column manufacturer.short_description
		 * @var string strShortDescription
		 */
		protected $strShortDescription;
		const ShortDescriptionMaxLength = 255;
		const ShortDescriptionDefault = null;


		/**
		 * Protected member variable that maps to the database column manufacturer.long_description
		 * @var string strLongDescription
		 */
		protected $strLongDescription;
		const LongDescriptionDefault = null;


		/**
		 * Protected member variable that maps to the database column manufacturer.image_path
		 * @var string strImagePath
		 */
		protected $strImagePath;
		const ImagePathMaxLength = 255;
		const ImagePathDefault = null;


		/**
		 * Protected member variable that maps to the database column manufacturer.created_by
		 * @var integer intCreatedBy
		 */
		protected $intCreatedBy;
		const CreatedByDefault = null;


		/**
		 * Protected member variable that maps to the database column manufacturer.creation_date
		 * @var QDateTime dttCreationDate
		 */
		protected $dttCreationDate;
		const CreationDateDefault = null;


		/**
		 * Protected member variable that maps to the database column manufacturer.modified_by
		 * @var integer intModifiedBy
		 */
		protected $intModifiedBy;
		const ModifiedByDefault = null;


		/**
		 * Protected member variable that maps to the database column manufacturer.modified_date
		 * @var string strModifiedDate
		 */
		protected $strModifiedDate;
		const ModifiedDateDefault = null;


		/**
		 * Private member variable that stores a reference to a single AssetModel object
		 * (of type AssetModel), if this Manufacturer object was restored with
		 * an expansion on the asset_model association table.
		 * @var AssetModel _objAssetModel;
		 */
		private $_objAssetModel;

		/**
		 * Private member variable that stores a reference to an array of AssetModel objects
		 * (of type AssetModel[]), if this Manufacturer object was restored with
		 * an ExpandAsArray on the asset_model association table.
		 * @var AssetModel[] _objAssetModelArray;
		 */
		private $_objAssetModelArray = array();

		/**
		 * Private member variable that stores a reference to a single InventoryModel object
		 * (of type InventoryModel), if this Manufacturer object was restored with
		 * an expansion on the inventory_model association table.
		 * @var InventoryModel _objInventoryModel;
		 */
		private $_objInventoryModel;

		/**
		 * Private member variable that stores a reference to an array of InventoryModel objects
		 * (of type InventoryModel[]), if this Manufacturer object was restored with
		 * an ExpandAsArray on the inventory_model association table.
		 * @var InventoryModel[] _objInventoryModelArray;
		 */
		private $_objInventoryModelArray = array();

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
		 * in the database column manufacturer.created_by.
		 *
		 * NOTE: Always use the CreatedByObject property getter to correctly retrieve this UserAccount object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var UserAccount objCreatedByObject
		 */
		protected $objCreatedByObject;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column manufacturer.modified_by.
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
				$objQueryExpansion = new QQueryExpansion('Manufacturer', 'manufacturer', $objExpansionMap);
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
				$objQueryExpansion->AddFromItem(sprintf('LEFT JOIN `manufacturer` AS `%s__%s` ON `%s`.`%s` = `%s__%s`.`manufacturer_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias, $strParentAlias, $strAlias));

				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`manufacturer_id` AS `%s__%s__manufacturer_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`short_description` AS `%s__%s__short_description`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`long_description` AS `%s__%s__long_description`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`image_path` AS `%s__%s__image_path`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
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
			$strToReturn = '<complexType name="Manufacturer"><sequence>';
			$strToReturn .= '<element name="ManufacturerId" type="xsd:int"/>';
			$strToReturn .= '<element name="ShortDescription" type="xsd:string"/>';
			$strToReturn .= '<element name="LongDescription" type="xsd:string"/>';
			$strToReturn .= '<element name="ImagePath" type="xsd:string"/>';
			$strToReturn .= '<element name="CreatedByObject" type="xsd1:UserAccount"/>';
			$strToReturn .= '<element name="CreationDate" type="xsd:dateTime"/>';
			$strToReturn .= '<element name="ModifiedByObject" type="xsd1:UserAccount"/>';
			$strToReturn .= '<element name="ModifiedDate" type="xsd:string"/>';
			$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
			$strToReturn .= '</sequence></complexType>';
			return $strToReturn;
		}

		public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
			if (!array_key_exists('Manufacturer', $strComplexTypeArray)) {
				$strComplexTypeArray['Manufacturer'] = Manufacturer::GetSoapComplexTypeXml();
				UserAccount::AlterSoapComplexTypeArray($strComplexTypeArray);
				UserAccount::AlterSoapComplexTypeArray($strComplexTypeArray);
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, Manufacturer::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new Manufacturer();
			if (property_exists($objSoapObject, 'ManufacturerId'))
				$objToReturn->intManufacturerId = $objSoapObject->ManufacturerId;
			if (property_exists($objSoapObject, 'ShortDescription'))
				$objToReturn->strShortDescription = $objSoapObject->ShortDescription;
			if (property_exists($objSoapObject, 'LongDescription'))
				$objToReturn->strLongDescription = $objSoapObject->LongDescription;
			if (property_exists($objSoapObject, 'ImagePath'))
				$objToReturn->strImagePath = $objSoapObject->ImagePath;
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
				array_push($objArrayToReturn, Manufacturer::GetSoapObjectFromObject($objObject, true));

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

	class QQNodeManufacturer extends QQNode {
		protected $strTableName = 'manufacturer';
		protected $strPrimaryKey = 'manufacturer_id';
		protected $strClassName = 'Manufacturer';
		public function __get($strName) {
			switch ($strName) {
				case 'ManufacturerId':
					return new QQNode('manufacturer_id', 'integer', $this);
				case 'ShortDescription':
					return new QQNode('short_description', 'string', $this);
				case 'LongDescription':
					return new QQNode('long_description', 'string', $this);
				case 'ImagePath':
					return new QQNode('image_path', 'string', $this);
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
				case 'AssetModel':
					return new QQReverseReferenceNodeAssetModel($this, 'assetmodel', 'reverse_reference', 'manufacturer_id');
				case 'InventoryModel':
					return new QQReverseReferenceNodeInventoryModel($this, 'inventorymodel', 'reverse_reference', 'manufacturer_id');

				case '_PrimaryKeyNode':
					return new QQNode('manufacturer_id', 'integer', $this);
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

	class QQReverseReferenceNodeManufacturer extends QQReverseReferenceNode {
		protected $strTableName = 'manufacturer';
		protected $strPrimaryKey = 'manufacturer_id';
		protected $strClassName = 'Manufacturer';
		public function __get($strName) {
			switch ($strName) {
				case 'ManufacturerId':
					return new QQNode('manufacturer_id', 'integer', $this);
				case 'ShortDescription':
					return new QQNode('short_description', 'string', $this);
				case 'LongDescription':
					return new QQNode('long_description', 'string', $this);
				case 'ImagePath':
					return new QQNode('image_path', 'string', $this);
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
				case 'AssetModel':
					return new QQReverseReferenceNodeAssetModel($this, 'assetmodel', 'reverse_reference', 'manufacturer_id');
				case 'InventoryModel':
					return new QQReverseReferenceNodeInventoryModel($this, 'inventorymodel', 'reverse_reference', 'manufacturer_id');

				case '_PrimaryKeyNode':
					return new QQNode('manufacturer_id', 'integer', $this);
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