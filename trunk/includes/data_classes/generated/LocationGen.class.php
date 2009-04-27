<?php
	/**
	 * The abstract LocationGen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the Location subclass which
	 * extends this LocationGen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the Location class.
	 * 
	 * @package My Application
	 * @subpackage GeneratedDataObjects
	 * 
	 */
	class LocationGen extends QBaseClass {
		///////////////////////////////
		// COMMON LOAD METHODS
		///////////////////////////////

		/**
		 * Load a Location from PK Info
		 * @param integer $intLocationId
		 * @return Location
		 */
		public static function Load($intLocationId) {
			// Use QuerySingle to Perform the Query
			return Location::QuerySingle(
				QQ::Equal(QQN::Location()->LocationId, $intLocationId)
			);
		}

		/**
		 * Load all Locations
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Location[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			// Call Location::QueryArray to perform the LoadAll query
			try {
				return Location::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all Locations
		 * @return int
		 */
		public static function CountAll() {
			// Call Location::QueryCount to perform the CountAll query
			return Location::QueryCount(QQ::All());
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
			$objDatabase = Location::GetDatabase();

			// Create/Build out the QueryBuilder object with Location-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, 'location');
			Location::GetSelectFields($objQueryBuilder);
			$objQueryBuilder->AddFromItem('`location` AS `location`');

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
		 * Static Qcodo Query method to query for a single Location object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return Location the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Location::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query, Get the First Row, and Instantiate a new Location object
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return Location::InstantiateDbRow($objDbResult->GetNextRow());
		}

		/**
		 * Static Qcodo Query method to query for an array of Location objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return Location[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Location::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return Location::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
		}

		/**
		 * Static Qcodo Query method to query for a count of Location objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Location::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
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
			$objDatabase = Location::GetDatabase();

			// Lookup the QCache for This Query Statement
			$objCache = new QCache('query', 'location_' . serialize($strConditions));
			if (!($strQuery = $objCache->GetData())) {
				// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with Location-specific fields
				$objQueryBuilder = new QQueryBuilder($objDatabase);
				Location::GetSelectFields($objQueryBuilder);
				Location::GetFromFields($objQueryBuilder);

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
			return Location::InstantiateDbResult($objDbResult);
		}*/

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this Location
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null) {
			if ($strPrefix) {
				$strTableName = '`' . $strPrefix . '`';
				$strAliasPrefix = '`' . $strPrefix . '__';
			} else {
				$strTableName = '`location`';
				$strAliasPrefix = '`';
			}

			$objBuilder->AddSelectItem($strTableName . '.`location_id` AS ' . $strAliasPrefix . 'location_id`');
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
		 * Instantiate a Location from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this Location::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param DatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @return Location
		*/
		public static function InstantiateDbRow($objDbRow, $strAliasPrefix = null, $strExpandAsArrayNodes = null, $objPreviousItem = null) {
			// If blank row, return null
			if (!$objDbRow)
				return null;

			// See if we're doing an array expansion on the previous item
			if (($strExpandAsArrayNodes) && ($objPreviousItem) &&
				($objPreviousItem->intLocationId == $objDbRow->GetColumn($strAliasPrefix . 'location_id', 'Integer'))) {

				// We are.  Now, prepare to check for ExpandAsArray clauses
				$blnExpandedViaArray = false;
				if (!$strAliasPrefix)
					$strAliasPrefix = 'location__';


				if ((array_key_exists($strAliasPrefix . 'asset__asset_id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'asset__asset_id')))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objAssetArray)) {
						$objPreviousChildItem = $objPreviousItem->_objAssetArray[$intPreviousChildItemCount - 1];
						$objChildItem = Asset::InstantiateDbRow($objDbRow, $strAliasPrefix . 'asset__', $strExpandAsArrayNodes, $objPreviousChildItem);
						if ($objChildItem)
							array_push($objPreviousItem->_objAssetArray, $objChildItem);
					} else
						array_push($objPreviousItem->_objAssetArray, Asset::InstantiateDbRow($objDbRow, $strAliasPrefix . 'asset__', $strExpandAsArrayNodes));
					$blnExpandedViaArray = true;
				}

				if ((array_key_exists($strAliasPrefix . 'assettransactionassource__asset_transaction_id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'assettransactionassource__asset_transaction_id')))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objAssetTransactionAsSourceArray)) {
						$objPreviousChildItem = $objPreviousItem->_objAssetTransactionAsSourceArray[$intPreviousChildItemCount - 1];
						$objChildItem = AssetTransaction::InstantiateDbRow($objDbRow, $strAliasPrefix . 'assettransactionassource__', $strExpandAsArrayNodes, $objPreviousChildItem);
						if ($objChildItem)
							array_push($objPreviousItem->_objAssetTransactionAsSourceArray, $objChildItem);
					} else
						array_push($objPreviousItem->_objAssetTransactionAsSourceArray, AssetTransaction::InstantiateDbRow($objDbRow, $strAliasPrefix . 'assettransactionassource__', $strExpandAsArrayNodes));
					$blnExpandedViaArray = true;
				}

				if ((array_key_exists($strAliasPrefix . 'assettransactionasdestination__asset_transaction_id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'assettransactionasdestination__asset_transaction_id')))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objAssetTransactionAsDestinationArray)) {
						$objPreviousChildItem = $objPreviousItem->_objAssetTransactionAsDestinationArray[$intPreviousChildItemCount - 1];
						$objChildItem = AssetTransaction::InstantiateDbRow($objDbRow, $strAliasPrefix . 'assettransactionasdestination__', $strExpandAsArrayNodes, $objPreviousChildItem);
						if ($objChildItem)
							array_push($objPreviousItem->_objAssetTransactionAsDestinationArray, $objChildItem);
					} else
						array_push($objPreviousItem->_objAssetTransactionAsDestinationArray, AssetTransaction::InstantiateDbRow($objDbRow, $strAliasPrefix . 'assettransactionasdestination__', $strExpandAsArrayNodes));
					$blnExpandedViaArray = true;
				}

				if ((array_key_exists($strAliasPrefix . 'auditscan__audit_scan_id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'auditscan__audit_scan_id')))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objAuditScanArray)) {
						$objPreviousChildItem = $objPreviousItem->_objAuditScanArray[$intPreviousChildItemCount - 1];
						$objChildItem = AuditScan::InstantiateDbRow($objDbRow, $strAliasPrefix . 'auditscan__', $strExpandAsArrayNodes, $objPreviousChildItem);
						if ($objChildItem)
							array_push($objPreviousItem->_objAuditScanArray, $objChildItem);
					} else
						array_push($objPreviousItem->_objAuditScanArray, AuditScan::InstantiateDbRow($objDbRow, $strAliasPrefix . 'auditscan__', $strExpandAsArrayNodes));
					$blnExpandedViaArray = true;
				}

				if ((array_key_exists($strAliasPrefix . 'inventorylocation__inventory_location_id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'inventorylocation__inventory_location_id')))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objInventoryLocationArray)) {
						$objPreviousChildItem = $objPreviousItem->_objInventoryLocationArray[$intPreviousChildItemCount - 1];
						$objChildItem = InventoryLocation::InstantiateDbRow($objDbRow, $strAliasPrefix . 'inventorylocation__', $strExpandAsArrayNodes, $objPreviousChildItem);
						if ($objChildItem)
							array_push($objPreviousItem->_objInventoryLocationArray, $objChildItem);
					} else
						array_push($objPreviousItem->_objInventoryLocationArray, InventoryLocation::InstantiateDbRow($objDbRow, $strAliasPrefix . 'inventorylocation__', $strExpandAsArrayNodes));
					$blnExpandedViaArray = true;
				}

				if ((array_key_exists($strAliasPrefix . 'inventorytransactionassource__inventory_transaction_id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'inventorytransactionassource__inventory_transaction_id')))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objInventoryTransactionAsSourceArray)) {
						$objPreviousChildItem = $objPreviousItem->_objInventoryTransactionAsSourceArray[$intPreviousChildItemCount - 1];
						$objChildItem = InventoryTransaction::InstantiateDbRow($objDbRow, $strAliasPrefix . 'inventorytransactionassource__', $strExpandAsArrayNodes, $objPreviousChildItem);
						if ($objChildItem)
							array_push($objPreviousItem->_objInventoryTransactionAsSourceArray, $objChildItem);
					} else
						array_push($objPreviousItem->_objInventoryTransactionAsSourceArray, InventoryTransaction::InstantiateDbRow($objDbRow, $strAliasPrefix . 'inventorytransactionassource__', $strExpandAsArrayNodes));
					$blnExpandedViaArray = true;
				}

				if ((array_key_exists($strAliasPrefix . 'inventorytransactionasdestination__inventory_transaction_id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'inventorytransactionasdestination__inventory_transaction_id')))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objInventoryTransactionAsDestinationArray)) {
						$objPreviousChildItem = $objPreviousItem->_objInventoryTransactionAsDestinationArray[$intPreviousChildItemCount - 1];
						$objChildItem = InventoryTransaction::InstantiateDbRow($objDbRow, $strAliasPrefix . 'inventorytransactionasdestination__', $strExpandAsArrayNodes, $objPreviousChildItem);
						if ($objChildItem)
							array_push($objPreviousItem->_objInventoryTransactionAsDestinationArray, $objChildItem);
					} else
						array_push($objPreviousItem->_objInventoryTransactionAsDestinationArray, InventoryTransaction::InstantiateDbRow($objDbRow, $strAliasPrefix . 'inventorytransactionasdestination__', $strExpandAsArrayNodes));
					$blnExpandedViaArray = true;
				}

				// Either return false to signal array expansion, or check-to-reset the Alias prefix and move on
				if ($blnExpandedViaArray)
					return false;
				else if ($strAliasPrefix == 'location__')
					$strAliasPrefix = null;
			}

			// Create a new instance of the Location object
			$objToReturn = new Location();
			$objToReturn->__blnRestored = true;

			$objToReturn->intLocationId = $objDbRow->GetColumn($strAliasPrefix . 'location_id', 'Integer');
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
				$strAliasPrefix = 'location__';

			// Check for CreatedByObject Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'created_by__user_account_id')))
				$objToReturn->objCreatedByObject = UserAccount::InstantiateDbRow($objDbRow, $strAliasPrefix . 'created_by__', $strExpandAsArrayNodes);

			// Check for ModifiedByObject Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'modified_by__user_account_id')))
				$objToReturn->objModifiedByObject = UserAccount::InstantiateDbRow($objDbRow, $strAliasPrefix . 'modified_by__', $strExpandAsArrayNodes);




			// Check for Asset Virtual Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'asset__asset_id'))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'asset__asset_id', $strExpandAsArrayNodes)))
					array_push($objToReturn->_objAssetArray, Asset::InstantiateDbRow($objDbRow, $strAliasPrefix . 'asset__', $strExpandAsArrayNodes));
				else
					$objToReturn->_objAsset = Asset::InstantiateDbRow($objDbRow, $strAliasPrefix . 'asset__', $strExpandAsArrayNodes);
			}

			// Check for AssetTransactionAsSource Virtual Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'assettransactionassource__asset_transaction_id'))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'assettransactionassource__asset_transaction_id', $strExpandAsArrayNodes)))
					array_push($objToReturn->_objAssetTransactionAsSourceArray, AssetTransaction::InstantiateDbRow($objDbRow, $strAliasPrefix . 'assettransactionassource__', $strExpandAsArrayNodes));
				else
					$objToReturn->_objAssetTransactionAsSource = AssetTransaction::InstantiateDbRow($objDbRow, $strAliasPrefix . 'assettransactionassource__', $strExpandAsArrayNodes);
			}

			// Check for AssetTransactionAsDestination Virtual Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'assettransactionasdestination__asset_transaction_id'))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'assettransactionasdestination__asset_transaction_id', $strExpandAsArrayNodes)))
					array_push($objToReturn->_objAssetTransactionAsDestinationArray, AssetTransaction::InstantiateDbRow($objDbRow, $strAliasPrefix . 'assettransactionasdestination__', $strExpandAsArrayNodes));
				else
					$objToReturn->_objAssetTransactionAsDestination = AssetTransaction::InstantiateDbRow($objDbRow, $strAliasPrefix . 'assettransactionasdestination__', $strExpandAsArrayNodes);
			}

			// Check for AuditScan Virtual Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'auditscan__audit_scan_id'))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'auditscan__audit_scan_id', $strExpandAsArrayNodes)))
					array_push($objToReturn->_objAuditScanArray, AuditScan::InstantiateDbRow($objDbRow, $strAliasPrefix . 'auditscan__', $strExpandAsArrayNodes));
				else
					$objToReturn->_objAuditScan = AuditScan::InstantiateDbRow($objDbRow, $strAliasPrefix . 'auditscan__', $strExpandAsArrayNodes);
			}

			// Check for InventoryLocation Virtual Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'inventorylocation__inventory_location_id'))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'inventorylocation__inventory_location_id', $strExpandAsArrayNodes)))
					array_push($objToReturn->_objInventoryLocationArray, InventoryLocation::InstantiateDbRow($objDbRow, $strAliasPrefix . 'inventorylocation__', $strExpandAsArrayNodes));
				else
					$objToReturn->_objInventoryLocation = InventoryLocation::InstantiateDbRow($objDbRow, $strAliasPrefix . 'inventorylocation__', $strExpandAsArrayNodes);
			}

			// Check for InventoryTransactionAsSource Virtual Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'inventorytransactionassource__inventory_transaction_id'))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'inventorytransactionassource__inventory_transaction_id', $strExpandAsArrayNodes)))
					array_push($objToReturn->_objInventoryTransactionAsSourceArray, InventoryTransaction::InstantiateDbRow($objDbRow, $strAliasPrefix . 'inventorytransactionassource__', $strExpandAsArrayNodes));
				else
					$objToReturn->_objInventoryTransactionAsSource = InventoryTransaction::InstantiateDbRow($objDbRow, $strAliasPrefix . 'inventorytransactionassource__', $strExpandAsArrayNodes);
			}

			// Check for InventoryTransactionAsDestination Virtual Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'inventorytransactionasdestination__inventory_transaction_id'))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'inventorytransactionasdestination__inventory_transaction_id', $strExpandAsArrayNodes)))
					array_push($objToReturn->_objInventoryTransactionAsDestinationArray, InventoryTransaction::InstantiateDbRow($objDbRow, $strAliasPrefix . 'inventorytransactionasdestination__', $strExpandAsArrayNodes));
				else
					$objToReturn->_objInventoryTransactionAsDestination = InventoryTransaction::InstantiateDbRow($objDbRow, $strAliasPrefix . 'inventorytransactionasdestination__', $strExpandAsArrayNodes);
			}

			return $objToReturn;
		}

		/**
		 * Instantiate an array of Locations from a Database Result
		 * @param DatabaseResultBase $objDbResult
		 * @return Location[]
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
					$objItem = Location::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
					if ($objItem) {
						array_push($objToReturn, $objItem);
						$objLastRowItem = $objItem;
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					array_push($objToReturn, Location::InstantiateDbRow($objDbRow));
			}

			return $objToReturn;
		}



		///////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Single Load and Array)
		///////////////////////////////////////////////////
			
		/**
		 * Load a single Location object,
		 * by LocationId Index(es)
		 * @param integer $intLocationId
		 * @return Location
		*/
		public static function LoadByLocationId($intLocationId) {
			return Location::QuerySingle(
				QQ::Equal(QQN::Location()->LocationId, $intLocationId)
			);
		}
			
		/**
		 * Load a single Location object,
		 * by ShortDescription Index(es)
		 * @param string $strShortDescription
		 * @return Location
		*/
		public static function LoadByShortDescription($strShortDescription) {
			return Location::QuerySingle(
				QQ::Equal(QQN::Location()->ShortDescription, $strShortDescription)
			);
		}
			
		/**
		 * Load an array of Location objects,
		 * by CreatedBy Index(es)
		 * @param integer $intCreatedBy
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Location[]
		*/
		public static function LoadArrayByCreatedBy($intCreatedBy, $objOptionalClauses = null) {
			// Call Location::QueryArray to perform the LoadArrayByCreatedBy query
			try {
				return Location::QueryArray(
					QQ::Equal(QQN::Location()->CreatedBy, $intCreatedBy),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count Locations
		 * by CreatedBy Index(es)
		 * @param integer $intCreatedBy
		 * @return int
		*/
		public static function CountByCreatedBy($intCreatedBy) {
			// Call Location::QueryCount to perform the CountByCreatedBy query
			return Location::QueryCount(
				QQ::Equal(QQN::Location()->CreatedBy, $intCreatedBy)
			);
		}
			
		/**
		 * Load an array of Location objects,
		 * by ModifiedBy Index(es)
		 * @param integer $intModifiedBy
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Location[]
		*/
		public static function LoadArrayByModifiedBy($intModifiedBy, $objOptionalClauses = null) {
			// Call Location::QueryArray to perform the LoadArrayByModifiedBy query
			try {
				return Location::QueryArray(
					QQ::Equal(QQN::Location()->ModifiedBy, $intModifiedBy),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count Locations
		 * by ModifiedBy Index(es)
		 * @param integer $intModifiedBy
		 * @return int
		*/
		public static function CountByModifiedBy($intModifiedBy) {
			// Call Location::QueryCount to perform the CountByModifiedBy query
			return Location::QueryCount(
				QQ::Equal(QQN::Location()->ModifiedBy, $intModifiedBy)
			);
		}



		////////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Array via Many to Many)
		////////////////////////////////////////////////////



		//////////////////
		// SAVE AND DELETE
		//////////////////

		/**
		 * Save this Location
		 * @param bool $blnForceInsert
		 * @param bool $blnForceUpdate
		 * @return int
		*/
		public function Save($blnForceInsert = false, $blnForceUpdate = false) {
			// Get the Database Object for this Class
			$objDatabase = Location::GetDatabase();

			$mixToReturn = null;

			try {
				if ((!$this->__blnRestored) || ($blnForceInsert)) {
					// Perform an INSERT query
					$objDatabase->NonQuery('
						INSERT INTO `location` (
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
					$mixToReturn = $this->intLocationId = $objDatabase->InsertId('location', 'location_id');
				} else {
					// Perform an UPDATE query

					// First checking for Optimistic Locking constraints (if applicable)
					if (!$blnForceUpdate) {
						// Perform the Optimistic Locking check
						$objResult = $objDatabase->Query('
							SELECT
								`modified_date`
							FROM
								`location`
							WHERE
								`location_id` = ' . $objDatabase->SqlVariable($this->intLocationId) . '
						');
						
						$objRow = $objResult->FetchArray();
						if ($objRow[0] != $this->strModifiedDate)
							throw new QExtendedOptimisticLockingException('Location', $this->intLocationId);
					}

					// Perform the UPDATE query
					$objDatabase->NonQuery('
						UPDATE
							`location`
						SET
							`short_description` = ' . $objDatabase->SqlVariable($this->strShortDescription) . ',
							`long_description` = ' . $objDatabase->SqlVariable($this->strLongDescription) . ',
							`created_by` = ' . $objDatabase->SqlVariable($this->intCreatedBy) . ',
							`creation_date` = ' . $objDatabase->SqlVariable($this->dttCreationDate) . ',
							`modified_by` = ' . $objDatabase->SqlVariable($this->intModifiedBy) . '
						WHERE
							`location_id` = ' . $objDatabase->SqlVariable($this->intLocationId) . '
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
					`location`
				WHERE
					`location_id` = ' . $objDatabase->SqlVariable($this->intLocationId) . '
			');
						
			$objRow = $objResult->FetchArray();
			$this->strModifiedDate = $objRow[0];

			// Return 
			return $mixToReturn;
		}

				/**
		 * Delete this Location
		 * @return void
		*/
		public function Delete() {
			if ((is_null($this->intLocationId)))
				throw new QUndefinedPrimaryKeyException('Cannot delete this Location with an unset primary key.');

			// Get the Database Object for this Class
			$objDatabase = Location::GetDatabase();


			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`location`
				WHERE
					`location_id` = ' . $objDatabase->SqlVariable($this->intLocationId) . '');
		}

		/**
		 * Delete all Locations
		 * @return void
		*/
		public static function DeleteAll() {
			// Get the Database Object for this Class
			$objDatabase = Location::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				DELETE FROM
					`location`');
		}

		/**
		 * Truncate location table
		 * @return void
		*/
		public static function Truncate() {
			// Get the Database Object for this Class
			$objDatabase = Location::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				TRUNCATE `location`');
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
				case 'LocationId':
					/**
					 * Gets the value for intLocationId (Read-Only PK)
					 * @return integer
					 */
					return $this->intLocationId;

				case 'ShortDescription':
					/**
					 * Gets the value for strShortDescription (Unique)
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

				case '_Asset':
					/**
					 * Gets the value for the private _objAsset (Read-Only)
					 * if set due to an expansion on the asset.location_id reverse relationship
					 * @return Asset
					 */
					return $this->_objAsset;

				case '_AssetArray':
					/**
					 * Gets the value for the private _objAssetArray (Read-Only)
					 * if set due to an ExpandAsArray on the asset.location_id reverse relationship
					 * @return Asset[]
					 */
					return (array) $this->_objAssetArray;

				case '_AssetTransactionAsSource':
					/**
					 * Gets the value for the private _objAssetTransactionAsSource (Read-Only)
					 * if set due to an expansion on the asset_transaction.source_location_id reverse relationship
					 * @return AssetTransaction
					 */
					return $this->_objAssetTransactionAsSource;

				case '_AssetTransactionAsSourceArray':
					/**
					 * Gets the value for the private _objAssetTransactionAsSourceArray (Read-Only)
					 * if set due to an ExpandAsArray on the asset_transaction.source_location_id reverse relationship
					 * @return AssetTransaction[]
					 */
					return (array) $this->_objAssetTransactionAsSourceArray;

				case '_AssetTransactionAsDestination':
					/**
					 * Gets the value for the private _objAssetTransactionAsDestination (Read-Only)
					 * if set due to an expansion on the asset_transaction.destination_location_id reverse relationship
					 * @return AssetTransaction
					 */
					return $this->_objAssetTransactionAsDestination;

				case '_AssetTransactionAsDestinationArray':
					/**
					 * Gets the value for the private _objAssetTransactionAsDestinationArray (Read-Only)
					 * if set due to an ExpandAsArray on the asset_transaction.destination_location_id reverse relationship
					 * @return AssetTransaction[]
					 */
					return (array) $this->_objAssetTransactionAsDestinationArray;

				case '_AuditScan':
					/**
					 * Gets the value for the private _objAuditScan (Read-Only)
					 * if set due to an expansion on the audit_scan.location_id reverse relationship
					 * @return AuditScan
					 */
					return $this->_objAuditScan;

				case '_AuditScanArray':
					/**
					 * Gets the value for the private _objAuditScanArray (Read-Only)
					 * if set due to an ExpandAsArray on the audit_scan.location_id reverse relationship
					 * @return AuditScan[]
					 */
					return (array) $this->_objAuditScanArray;

				case '_InventoryLocation':
					/**
					 * Gets the value for the private _objInventoryLocation (Read-Only)
					 * if set due to an expansion on the inventory_location.location_id reverse relationship
					 * @return InventoryLocation
					 */
					return $this->_objInventoryLocation;

				case '_InventoryLocationArray':
					/**
					 * Gets the value for the private _objInventoryLocationArray (Read-Only)
					 * if set due to an ExpandAsArray on the inventory_location.location_id reverse relationship
					 * @return InventoryLocation[]
					 */
					return (array) $this->_objInventoryLocationArray;

				case '_InventoryTransactionAsSource':
					/**
					 * Gets the value for the private _objInventoryTransactionAsSource (Read-Only)
					 * if set due to an expansion on the inventory_transaction.source_location_id reverse relationship
					 * @return InventoryTransaction
					 */
					return $this->_objInventoryTransactionAsSource;

				case '_InventoryTransactionAsSourceArray':
					/**
					 * Gets the value for the private _objInventoryTransactionAsSourceArray (Read-Only)
					 * if set due to an ExpandAsArray on the inventory_transaction.source_location_id reverse relationship
					 * @return InventoryTransaction[]
					 */
					return (array) $this->_objInventoryTransactionAsSourceArray;

				case '_InventoryTransactionAsDestination':
					/**
					 * Gets the value for the private _objInventoryTransactionAsDestination (Read-Only)
					 * if set due to an expansion on the inventory_transaction.destination_location_id reverse relationship
					 * @return InventoryTransaction
					 */
					return $this->_objInventoryTransactionAsDestination;

				case '_InventoryTransactionAsDestinationArray':
					/**
					 * Gets the value for the private _objInventoryTransactionAsDestinationArray (Read-Only)
					 * if set due to an ExpandAsArray on the inventory_transaction.destination_location_id reverse relationship
					 * @return InventoryTransaction[]
					 */
					return (array) $this->_objInventoryTransactionAsDestinationArray;

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
					 * Sets the value for strShortDescription (Unique)
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
							throw new QCallerException('Unable to set an unsaved CreatedByObject for this Location');

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
							throw new QCallerException('Unable to set an unsaved ModifiedByObject for this Location');

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

			
		
		// Related Objects' Methods for Asset
		//-------------------------------------------------------------------

		/**
		 * Gets all associated Assets as an array of Asset objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Asset[]
		*/ 
		public function GetAssetArray($objOptionalClauses = null) {
			if ((is_null($this->intLocationId)))
				return array();

			try {
				return Asset::LoadArrayByLocationId($this->intLocationId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated Assets
		 * @return int
		*/ 
		public function CountAssets() {
			if ((is_null($this->intLocationId)))
				return 0;

			return Asset::CountByLocationId($this->intLocationId);
		}

		/**
		 * Associates a Asset
		 * @param Asset $objAsset
		 * @return void
		*/ 
		public function AssociateAsset(Asset $objAsset) {
			if ((is_null($this->intLocationId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateAsset on this unsaved Location.');
			if ((is_null($objAsset->AssetId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateAsset on this Location with an unsaved Asset.');

			// Get the Database Object for this Class
			$objDatabase = Location::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`asset`
				SET
					`location_id` = ' . $objDatabase->SqlVariable($this->intLocationId) . '
				WHERE
					`asset_id` = ' . $objDatabase->SqlVariable($objAsset->AssetId) . '
			');
		}

		/**
		 * Unassociates a Asset
		 * @param Asset $objAsset
		 * @return void
		*/ 
		public function UnassociateAsset(Asset $objAsset) {
			if ((is_null($this->intLocationId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateAsset on this unsaved Location.');
			if ((is_null($objAsset->AssetId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateAsset on this Location with an unsaved Asset.');

			// Get the Database Object for this Class
			$objDatabase = Location::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`asset`
				SET
					`location_id` = null
				WHERE
					`asset_id` = ' . $objDatabase->SqlVariable($objAsset->AssetId) . ' AND
					`location_id` = ' . $objDatabase->SqlVariable($this->intLocationId) . '
			');
		}

		/**
		 * Unassociates all Assets
		 * @return void
		*/ 
		public function UnassociateAllAssets() {
			if ((is_null($this->intLocationId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateAsset on this unsaved Location.');

			// Get the Database Object for this Class
			$objDatabase = Location::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`asset`
				SET
					`location_id` = null
				WHERE
					`location_id` = ' . $objDatabase->SqlVariable($this->intLocationId) . '
			');
		}

		/**
		 * Deletes an associated Asset
		 * @param Asset $objAsset
		 * @return void
		*/ 
		public function DeleteAssociatedAsset(Asset $objAsset) {
			if ((is_null($this->intLocationId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateAsset on this unsaved Location.');
			if ((is_null($objAsset->AssetId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateAsset on this Location with an unsaved Asset.');

			// Get the Database Object for this Class
			$objDatabase = Location::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`asset`
				WHERE
					`asset_id` = ' . $objDatabase->SqlVariable($objAsset->AssetId) . ' AND
					`location_id` = ' . $objDatabase->SqlVariable($this->intLocationId) . '
			');
		}

		/**
		 * Deletes all associated Assets
		 * @return void
		*/ 
		public function DeleteAllAssets() {
			if ((is_null($this->intLocationId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateAsset on this unsaved Location.');

			// Get the Database Object for this Class
			$objDatabase = Location::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`asset`
				WHERE
					`location_id` = ' . $objDatabase->SqlVariable($this->intLocationId) . '
			');
		}

			
		
		// Related Objects' Methods for AssetTransactionAsSource
		//-------------------------------------------------------------------

		/**
		 * Gets all associated AssetTransactionsAsSource as an array of AssetTransaction objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return AssetTransaction[]
		*/ 
		public function GetAssetTransactionAsSourceArray($objOptionalClauses = null) {
			if ((is_null($this->intLocationId)))
				return array();

			try {
				return AssetTransaction::LoadArrayBySourceLocationId($this->intLocationId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated AssetTransactionsAsSource
		 * @return int
		*/ 
		public function CountAssetTransactionsAsSource() {
			if ((is_null($this->intLocationId)))
				return 0;

			return AssetTransaction::CountBySourceLocationId($this->intLocationId);
		}

		/**
		 * Associates a AssetTransactionAsSource
		 * @param AssetTransaction $objAssetTransaction
		 * @return void
		*/ 
		public function AssociateAssetTransactionAsSource(AssetTransaction $objAssetTransaction) {
			if ((is_null($this->intLocationId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateAssetTransactionAsSource on this unsaved Location.');
			if ((is_null($objAssetTransaction->AssetTransactionId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateAssetTransactionAsSource on this Location with an unsaved AssetTransaction.');

			// Get the Database Object for this Class
			$objDatabase = Location::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`asset_transaction`
				SET
					`source_location_id` = ' . $objDatabase->SqlVariable($this->intLocationId) . '
				WHERE
					`asset_transaction_id` = ' . $objDatabase->SqlVariable($objAssetTransaction->AssetTransactionId) . '
			');
		}

		/**
		 * Unassociates a AssetTransactionAsSource
		 * @param AssetTransaction $objAssetTransaction
		 * @return void
		*/ 
		public function UnassociateAssetTransactionAsSource(AssetTransaction $objAssetTransaction) {
			if ((is_null($this->intLocationId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateAssetTransactionAsSource on this unsaved Location.');
			if ((is_null($objAssetTransaction->AssetTransactionId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateAssetTransactionAsSource on this Location with an unsaved AssetTransaction.');

			// Get the Database Object for this Class
			$objDatabase = Location::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`asset_transaction`
				SET
					`source_location_id` = null
				WHERE
					`asset_transaction_id` = ' . $objDatabase->SqlVariable($objAssetTransaction->AssetTransactionId) . ' AND
					`source_location_id` = ' . $objDatabase->SqlVariable($this->intLocationId) . '
			');
		}

		/**
		 * Unassociates all AssetTransactionsAsSource
		 * @return void
		*/ 
		public function UnassociateAllAssetTransactionsAsSource() {
			if ((is_null($this->intLocationId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateAssetTransactionAsSource on this unsaved Location.');

			// Get the Database Object for this Class
			$objDatabase = Location::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`asset_transaction`
				SET
					`source_location_id` = null
				WHERE
					`source_location_id` = ' . $objDatabase->SqlVariable($this->intLocationId) . '
			');
		}

		/**
		 * Deletes an associated AssetTransactionAsSource
		 * @param AssetTransaction $objAssetTransaction
		 * @return void
		*/ 
		public function DeleteAssociatedAssetTransactionAsSource(AssetTransaction $objAssetTransaction) {
			if ((is_null($this->intLocationId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateAssetTransactionAsSource on this unsaved Location.');
			if ((is_null($objAssetTransaction->AssetTransactionId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateAssetTransactionAsSource on this Location with an unsaved AssetTransaction.');

			// Get the Database Object for this Class
			$objDatabase = Location::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`asset_transaction`
				WHERE
					`asset_transaction_id` = ' . $objDatabase->SqlVariable($objAssetTransaction->AssetTransactionId) . ' AND
					`source_location_id` = ' . $objDatabase->SqlVariable($this->intLocationId) . '
			');
		}

		/**
		 * Deletes all associated AssetTransactionsAsSource
		 * @return void
		*/ 
		public function DeleteAllAssetTransactionsAsSource() {
			if ((is_null($this->intLocationId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateAssetTransactionAsSource on this unsaved Location.');

			// Get the Database Object for this Class
			$objDatabase = Location::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`asset_transaction`
				WHERE
					`source_location_id` = ' . $objDatabase->SqlVariable($this->intLocationId) . '
			');
		}

			
		
		// Related Objects' Methods for AssetTransactionAsDestination
		//-------------------------------------------------------------------

		/**
		 * Gets all associated AssetTransactionsAsDestination as an array of AssetTransaction objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return AssetTransaction[]
		*/ 
		public function GetAssetTransactionAsDestinationArray($objOptionalClauses = null) {
			if ((is_null($this->intLocationId)))
				return array();

			try {
				return AssetTransaction::LoadArrayByDestinationLocationId($this->intLocationId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated AssetTransactionsAsDestination
		 * @return int
		*/ 
		public function CountAssetTransactionsAsDestination() {
			if ((is_null($this->intLocationId)))
				return 0;

			return AssetTransaction::CountByDestinationLocationId($this->intLocationId);
		}

		/**
		 * Associates a AssetTransactionAsDestination
		 * @param AssetTransaction $objAssetTransaction
		 * @return void
		*/ 
		public function AssociateAssetTransactionAsDestination(AssetTransaction $objAssetTransaction) {
			if ((is_null($this->intLocationId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateAssetTransactionAsDestination on this unsaved Location.');
			if ((is_null($objAssetTransaction->AssetTransactionId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateAssetTransactionAsDestination on this Location with an unsaved AssetTransaction.');

			// Get the Database Object for this Class
			$objDatabase = Location::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`asset_transaction`
				SET
					`destination_location_id` = ' . $objDatabase->SqlVariable($this->intLocationId) . '
				WHERE
					`asset_transaction_id` = ' . $objDatabase->SqlVariable($objAssetTransaction->AssetTransactionId) . '
			');
		}

		/**
		 * Unassociates a AssetTransactionAsDestination
		 * @param AssetTransaction $objAssetTransaction
		 * @return void
		*/ 
		public function UnassociateAssetTransactionAsDestination(AssetTransaction $objAssetTransaction) {
			if ((is_null($this->intLocationId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateAssetTransactionAsDestination on this unsaved Location.');
			if ((is_null($objAssetTransaction->AssetTransactionId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateAssetTransactionAsDestination on this Location with an unsaved AssetTransaction.');

			// Get the Database Object for this Class
			$objDatabase = Location::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`asset_transaction`
				SET
					`destination_location_id` = null
				WHERE
					`asset_transaction_id` = ' . $objDatabase->SqlVariable($objAssetTransaction->AssetTransactionId) . ' AND
					`destination_location_id` = ' . $objDatabase->SqlVariable($this->intLocationId) . '
			');
		}

		/**
		 * Unassociates all AssetTransactionsAsDestination
		 * @return void
		*/ 
		public function UnassociateAllAssetTransactionsAsDestination() {
			if ((is_null($this->intLocationId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateAssetTransactionAsDestination on this unsaved Location.');

			// Get the Database Object for this Class
			$objDatabase = Location::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`asset_transaction`
				SET
					`destination_location_id` = null
				WHERE
					`destination_location_id` = ' . $objDatabase->SqlVariable($this->intLocationId) . '
			');
		}

		/**
		 * Deletes an associated AssetTransactionAsDestination
		 * @param AssetTransaction $objAssetTransaction
		 * @return void
		*/ 
		public function DeleteAssociatedAssetTransactionAsDestination(AssetTransaction $objAssetTransaction) {
			if ((is_null($this->intLocationId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateAssetTransactionAsDestination on this unsaved Location.');
			if ((is_null($objAssetTransaction->AssetTransactionId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateAssetTransactionAsDestination on this Location with an unsaved AssetTransaction.');

			// Get the Database Object for this Class
			$objDatabase = Location::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`asset_transaction`
				WHERE
					`asset_transaction_id` = ' . $objDatabase->SqlVariable($objAssetTransaction->AssetTransactionId) . ' AND
					`destination_location_id` = ' . $objDatabase->SqlVariable($this->intLocationId) . '
			');
		}

		/**
		 * Deletes all associated AssetTransactionsAsDestination
		 * @return void
		*/ 
		public function DeleteAllAssetTransactionsAsDestination() {
			if ((is_null($this->intLocationId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateAssetTransactionAsDestination on this unsaved Location.');

			// Get the Database Object for this Class
			$objDatabase = Location::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`asset_transaction`
				WHERE
					`destination_location_id` = ' . $objDatabase->SqlVariable($this->intLocationId) . '
			');
		}

			
		
		// Related Objects' Methods for AuditScan
		//-------------------------------------------------------------------

		/**
		 * Gets all associated AuditScans as an array of AuditScan objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return AuditScan[]
		*/ 
		public function GetAuditScanArray($objOptionalClauses = null) {
			if ((is_null($this->intLocationId)))
				return array();

			try {
				return AuditScan::LoadArrayByLocationId($this->intLocationId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated AuditScans
		 * @return int
		*/ 
		public function CountAuditScans() {
			if ((is_null($this->intLocationId)))
				return 0;

			return AuditScan::CountByLocationId($this->intLocationId);
		}

		/**
		 * Associates a AuditScan
		 * @param AuditScan $objAuditScan
		 * @return void
		*/ 
		public function AssociateAuditScan(AuditScan $objAuditScan) {
			if ((is_null($this->intLocationId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateAuditScan on this unsaved Location.');
			if ((is_null($objAuditScan->AuditScanId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateAuditScan on this Location with an unsaved AuditScan.');

			// Get the Database Object for this Class
			$objDatabase = Location::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`audit_scan`
				SET
					`location_id` = ' . $objDatabase->SqlVariable($this->intLocationId) . '
				WHERE
					`audit_scan_id` = ' . $objDatabase->SqlVariable($objAuditScan->AuditScanId) . '
			');
		}

		/**
		 * Unassociates a AuditScan
		 * @param AuditScan $objAuditScan
		 * @return void
		*/ 
		public function UnassociateAuditScan(AuditScan $objAuditScan) {
			if ((is_null($this->intLocationId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateAuditScan on this unsaved Location.');
			if ((is_null($objAuditScan->AuditScanId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateAuditScan on this Location with an unsaved AuditScan.');

			// Get the Database Object for this Class
			$objDatabase = Location::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`audit_scan`
				SET
					`location_id` = null
				WHERE
					`audit_scan_id` = ' . $objDatabase->SqlVariable($objAuditScan->AuditScanId) . ' AND
					`location_id` = ' . $objDatabase->SqlVariable($this->intLocationId) . '
			');
		}

		/**
		 * Unassociates all AuditScans
		 * @return void
		*/ 
		public function UnassociateAllAuditScans() {
			if ((is_null($this->intLocationId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateAuditScan on this unsaved Location.');

			// Get the Database Object for this Class
			$objDatabase = Location::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`audit_scan`
				SET
					`location_id` = null
				WHERE
					`location_id` = ' . $objDatabase->SqlVariable($this->intLocationId) . '
			');
		}

		/**
		 * Deletes an associated AuditScan
		 * @param AuditScan $objAuditScan
		 * @return void
		*/ 
		public function DeleteAssociatedAuditScan(AuditScan $objAuditScan) {
			if ((is_null($this->intLocationId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateAuditScan on this unsaved Location.');
			if ((is_null($objAuditScan->AuditScanId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateAuditScan on this Location with an unsaved AuditScan.');

			// Get the Database Object for this Class
			$objDatabase = Location::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`audit_scan`
				WHERE
					`audit_scan_id` = ' . $objDatabase->SqlVariable($objAuditScan->AuditScanId) . ' AND
					`location_id` = ' . $objDatabase->SqlVariable($this->intLocationId) . '
			');
		}

		/**
		 * Deletes all associated AuditScans
		 * @return void
		*/ 
		public function DeleteAllAuditScans() {
			if ((is_null($this->intLocationId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateAuditScan on this unsaved Location.');

			// Get the Database Object for this Class
			$objDatabase = Location::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`audit_scan`
				WHERE
					`location_id` = ' . $objDatabase->SqlVariable($this->intLocationId) . '
			');
		}

			
		
		// Related Objects' Methods for InventoryLocation
		//-------------------------------------------------------------------

		/**
		 * Gets all associated InventoryLocations as an array of InventoryLocation objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return InventoryLocation[]
		*/ 
		public function GetInventoryLocationArray($objOptionalClauses = null) {
			if ((is_null($this->intLocationId)))
				return array();

			try {
				return InventoryLocation::LoadArrayByLocationId($this->intLocationId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated InventoryLocations
		 * @return int
		*/ 
		public function CountInventoryLocations() {
			if ((is_null($this->intLocationId)))
				return 0;

			return InventoryLocation::CountByLocationId($this->intLocationId);
		}

		/**
		 * Associates a InventoryLocation
		 * @param InventoryLocation $objInventoryLocation
		 * @return void
		*/ 
		public function AssociateInventoryLocation(InventoryLocation $objInventoryLocation) {
			if ((is_null($this->intLocationId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateInventoryLocation on this unsaved Location.');
			if ((is_null($objInventoryLocation->InventoryLocationId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateInventoryLocation on this Location with an unsaved InventoryLocation.');

			// Get the Database Object for this Class
			$objDatabase = Location::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`inventory_location`
				SET
					`location_id` = ' . $objDatabase->SqlVariable($this->intLocationId) . '
				WHERE
					`inventory_location_id` = ' . $objDatabase->SqlVariable($objInventoryLocation->InventoryLocationId) . '
			');
		}

		/**
		 * Unassociates a InventoryLocation
		 * @param InventoryLocation $objInventoryLocation
		 * @return void
		*/ 
		public function UnassociateInventoryLocation(InventoryLocation $objInventoryLocation) {
			if ((is_null($this->intLocationId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateInventoryLocation on this unsaved Location.');
			if ((is_null($objInventoryLocation->InventoryLocationId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateInventoryLocation on this Location with an unsaved InventoryLocation.');

			// Get the Database Object for this Class
			$objDatabase = Location::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`inventory_location`
				SET
					`location_id` = null
				WHERE
					`inventory_location_id` = ' . $objDatabase->SqlVariable($objInventoryLocation->InventoryLocationId) . ' AND
					`location_id` = ' . $objDatabase->SqlVariable($this->intLocationId) . '
			');
		}

		/**
		 * Unassociates all InventoryLocations
		 * @return void
		*/ 
		public function UnassociateAllInventoryLocations() {
			if ((is_null($this->intLocationId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateInventoryLocation on this unsaved Location.');

			// Get the Database Object for this Class
			$objDatabase = Location::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`inventory_location`
				SET
					`location_id` = null
				WHERE
					`location_id` = ' . $objDatabase->SqlVariable($this->intLocationId) . '
			');
		}

		/**
		 * Deletes an associated InventoryLocation
		 * @param InventoryLocation $objInventoryLocation
		 * @return void
		*/ 
		public function DeleteAssociatedInventoryLocation(InventoryLocation $objInventoryLocation) {
			if ((is_null($this->intLocationId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateInventoryLocation on this unsaved Location.');
			if ((is_null($objInventoryLocation->InventoryLocationId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateInventoryLocation on this Location with an unsaved InventoryLocation.');

			// Get the Database Object for this Class
			$objDatabase = Location::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`inventory_location`
				WHERE
					`inventory_location_id` = ' . $objDatabase->SqlVariable($objInventoryLocation->InventoryLocationId) . ' AND
					`location_id` = ' . $objDatabase->SqlVariable($this->intLocationId) . '
			');
		}

		/**
		 * Deletes all associated InventoryLocations
		 * @return void
		*/ 
		public function DeleteAllInventoryLocations() {
			if ((is_null($this->intLocationId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateInventoryLocation on this unsaved Location.');

			// Get the Database Object for this Class
			$objDatabase = Location::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`inventory_location`
				WHERE
					`location_id` = ' . $objDatabase->SqlVariable($this->intLocationId) . '
			');
		}

			
		
		// Related Objects' Methods for InventoryTransactionAsSource
		//-------------------------------------------------------------------

		/**
		 * Gets all associated InventoryTransactionsAsSource as an array of InventoryTransaction objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return InventoryTransaction[]
		*/ 
		public function GetInventoryTransactionAsSourceArray($objOptionalClauses = null) {
			if ((is_null($this->intLocationId)))
				return array();

			try {
				return InventoryTransaction::LoadArrayBySourceLocationId($this->intLocationId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated InventoryTransactionsAsSource
		 * @return int
		*/ 
		public function CountInventoryTransactionsAsSource() {
			if ((is_null($this->intLocationId)))
				return 0;

			return InventoryTransaction::CountBySourceLocationId($this->intLocationId);
		}

		/**
		 * Associates a InventoryTransactionAsSource
		 * @param InventoryTransaction $objInventoryTransaction
		 * @return void
		*/ 
		public function AssociateInventoryTransactionAsSource(InventoryTransaction $objInventoryTransaction) {
			if ((is_null($this->intLocationId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateInventoryTransactionAsSource on this unsaved Location.');
			if ((is_null($objInventoryTransaction->InventoryTransactionId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateInventoryTransactionAsSource on this Location with an unsaved InventoryTransaction.');

			// Get the Database Object for this Class
			$objDatabase = Location::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`inventory_transaction`
				SET
					`source_location_id` = ' . $objDatabase->SqlVariable($this->intLocationId) . '
				WHERE
					`inventory_transaction_id` = ' . $objDatabase->SqlVariable($objInventoryTransaction->InventoryTransactionId) . '
			');
		}

		/**
		 * Unassociates a InventoryTransactionAsSource
		 * @param InventoryTransaction $objInventoryTransaction
		 * @return void
		*/ 
		public function UnassociateInventoryTransactionAsSource(InventoryTransaction $objInventoryTransaction) {
			if ((is_null($this->intLocationId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateInventoryTransactionAsSource on this unsaved Location.');
			if ((is_null($objInventoryTransaction->InventoryTransactionId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateInventoryTransactionAsSource on this Location with an unsaved InventoryTransaction.');

			// Get the Database Object for this Class
			$objDatabase = Location::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`inventory_transaction`
				SET
					`source_location_id` = null
				WHERE
					`inventory_transaction_id` = ' . $objDatabase->SqlVariable($objInventoryTransaction->InventoryTransactionId) . ' AND
					`source_location_id` = ' . $objDatabase->SqlVariable($this->intLocationId) . '
			');
		}

		/**
		 * Unassociates all InventoryTransactionsAsSource
		 * @return void
		*/ 
		public function UnassociateAllInventoryTransactionsAsSource() {
			if ((is_null($this->intLocationId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateInventoryTransactionAsSource on this unsaved Location.');

			// Get the Database Object for this Class
			$objDatabase = Location::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`inventory_transaction`
				SET
					`source_location_id` = null
				WHERE
					`source_location_id` = ' . $objDatabase->SqlVariable($this->intLocationId) . '
			');
		}

		/**
		 * Deletes an associated InventoryTransactionAsSource
		 * @param InventoryTransaction $objInventoryTransaction
		 * @return void
		*/ 
		public function DeleteAssociatedInventoryTransactionAsSource(InventoryTransaction $objInventoryTransaction) {
			if ((is_null($this->intLocationId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateInventoryTransactionAsSource on this unsaved Location.');
			if ((is_null($objInventoryTransaction->InventoryTransactionId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateInventoryTransactionAsSource on this Location with an unsaved InventoryTransaction.');

			// Get the Database Object for this Class
			$objDatabase = Location::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`inventory_transaction`
				WHERE
					`inventory_transaction_id` = ' . $objDatabase->SqlVariable($objInventoryTransaction->InventoryTransactionId) . ' AND
					`source_location_id` = ' . $objDatabase->SqlVariable($this->intLocationId) . '
			');
		}

		/**
		 * Deletes all associated InventoryTransactionsAsSource
		 * @return void
		*/ 
		public function DeleteAllInventoryTransactionsAsSource() {
			if ((is_null($this->intLocationId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateInventoryTransactionAsSource on this unsaved Location.');

			// Get the Database Object for this Class
			$objDatabase = Location::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`inventory_transaction`
				WHERE
					`source_location_id` = ' . $objDatabase->SqlVariable($this->intLocationId) . '
			');
		}

			
		
		// Related Objects' Methods for InventoryTransactionAsDestination
		//-------------------------------------------------------------------

		/**
		 * Gets all associated InventoryTransactionsAsDestination as an array of InventoryTransaction objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return InventoryTransaction[]
		*/ 
		public function GetInventoryTransactionAsDestinationArray($objOptionalClauses = null) {
			if ((is_null($this->intLocationId)))
				return array();

			try {
				return InventoryTransaction::LoadArrayByDestinationLocationId($this->intLocationId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated InventoryTransactionsAsDestination
		 * @return int
		*/ 
		public function CountInventoryTransactionsAsDestination() {
			if ((is_null($this->intLocationId)))
				return 0;

			return InventoryTransaction::CountByDestinationLocationId($this->intLocationId);
		}

		/**
		 * Associates a InventoryTransactionAsDestination
		 * @param InventoryTransaction $objInventoryTransaction
		 * @return void
		*/ 
		public function AssociateInventoryTransactionAsDestination(InventoryTransaction $objInventoryTransaction) {
			if ((is_null($this->intLocationId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateInventoryTransactionAsDestination on this unsaved Location.');
			if ((is_null($objInventoryTransaction->InventoryTransactionId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateInventoryTransactionAsDestination on this Location with an unsaved InventoryTransaction.');

			// Get the Database Object for this Class
			$objDatabase = Location::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`inventory_transaction`
				SET
					`destination_location_id` = ' . $objDatabase->SqlVariable($this->intLocationId) . '
				WHERE
					`inventory_transaction_id` = ' . $objDatabase->SqlVariable($objInventoryTransaction->InventoryTransactionId) . '
			');
		}

		/**
		 * Unassociates a InventoryTransactionAsDestination
		 * @param InventoryTransaction $objInventoryTransaction
		 * @return void
		*/ 
		public function UnassociateInventoryTransactionAsDestination(InventoryTransaction $objInventoryTransaction) {
			if ((is_null($this->intLocationId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateInventoryTransactionAsDestination on this unsaved Location.');
			if ((is_null($objInventoryTransaction->InventoryTransactionId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateInventoryTransactionAsDestination on this Location with an unsaved InventoryTransaction.');

			// Get the Database Object for this Class
			$objDatabase = Location::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`inventory_transaction`
				SET
					`destination_location_id` = null
				WHERE
					`inventory_transaction_id` = ' . $objDatabase->SqlVariable($objInventoryTransaction->InventoryTransactionId) . ' AND
					`destination_location_id` = ' . $objDatabase->SqlVariable($this->intLocationId) . '
			');
		}

		/**
		 * Unassociates all InventoryTransactionsAsDestination
		 * @return void
		*/ 
		public function UnassociateAllInventoryTransactionsAsDestination() {
			if ((is_null($this->intLocationId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateInventoryTransactionAsDestination on this unsaved Location.');

			// Get the Database Object for this Class
			$objDatabase = Location::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`inventory_transaction`
				SET
					`destination_location_id` = null
				WHERE
					`destination_location_id` = ' . $objDatabase->SqlVariable($this->intLocationId) . '
			');
		}

		/**
		 * Deletes an associated InventoryTransactionAsDestination
		 * @param InventoryTransaction $objInventoryTransaction
		 * @return void
		*/ 
		public function DeleteAssociatedInventoryTransactionAsDestination(InventoryTransaction $objInventoryTransaction) {
			if ((is_null($this->intLocationId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateInventoryTransactionAsDestination on this unsaved Location.');
			if ((is_null($objInventoryTransaction->InventoryTransactionId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateInventoryTransactionAsDestination on this Location with an unsaved InventoryTransaction.');

			// Get the Database Object for this Class
			$objDatabase = Location::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`inventory_transaction`
				WHERE
					`inventory_transaction_id` = ' . $objDatabase->SqlVariable($objInventoryTransaction->InventoryTransactionId) . ' AND
					`destination_location_id` = ' . $objDatabase->SqlVariable($this->intLocationId) . '
			');
		}

		/**
		 * Deletes all associated InventoryTransactionsAsDestination
		 * @return void
		*/ 
		public function DeleteAllInventoryTransactionsAsDestination() {
			if ((is_null($this->intLocationId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateInventoryTransactionAsDestination on this unsaved Location.');

			// Get the Database Object for this Class
			$objDatabase = Location::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`inventory_transaction`
				WHERE
					`destination_location_id` = ' . $objDatabase->SqlVariable($this->intLocationId) . '
			');
		}




		///////////////////////////////////////////////////////////////////////
		// PROTECTED MEMBER VARIABLES and TEXT FIELD MAXLENGTHS (if applicable)
		///////////////////////////////////////////////////////////////////////
		
		/**
		 * Protected member variable that maps to the database PK Identity column location.location_id
		 * @var integer intLocationId
		 */
		protected $intLocationId;
		const LocationIdDefault = null;


		/**
		 * Protected member variable that maps to the database column location.short_description
		 * @var string strShortDescription
		 */
		protected $strShortDescription;
		const ShortDescriptionMaxLength = 255;
		const ShortDescriptionDefault = null;


		/**
		 * Protected member variable that maps to the database column location.long_description
		 * @var string strLongDescription
		 */
		protected $strLongDescription;
		const LongDescriptionDefault = null;


		/**
		 * Protected member variable that maps to the database column location.created_by
		 * @var integer intCreatedBy
		 */
		protected $intCreatedBy;
		const CreatedByDefault = null;


		/**
		 * Protected member variable that maps to the database column location.creation_date
		 * @var QDateTime dttCreationDate
		 */
		protected $dttCreationDate;
		const CreationDateDefault = null;


		/**
		 * Protected member variable that maps to the database column location.modified_by
		 * @var integer intModifiedBy
		 */
		protected $intModifiedBy;
		const ModifiedByDefault = null;


		/**
		 * Protected member variable that maps to the database column location.modified_date
		 * @var string strModifiedDate
		 */
		protected $strModifiedDate;
		const ModifiedDateDefault = null;


		/**
		 * Private member variable that stores a reference to a single Asset object
		 * (of type Asset), if this Location object was restored with
		 * an expansion on the asset association table.
		 * @var Asset _objAsset;
		 */
		private $_objAsset;

		/**
		 * Private member variable that stores a reference to an array of Asset objects
		 * (of type Asset[]), if this Location object was restored with
		 * an ExpandAsArray on the asset association table.
		 * @var Asset[] _objAssetArray;
		 */
		private $_objAssetArray = array();

		/**
		 * Private member variable that stores a reference to a single AssetTransactionAsSource object
		 * (of type AssetTransaction), if this Location object was restored with
		 * an expansion on the asset_transaction association table.
		 * @var AssetTransaction _objAssetTransactionAsSource;
		 */
		private $_objAssetTransactionAsSource;

		/**
		 * Private member variable that stores a reference to an array of AssetTransactionAsSource objects
		 * (of type AssetTransaction[]), if this Location object was restored with
		 * an ExpandAsArray on the asset_transaction association table.
		 * @var AssetTransaction[] _objAssetTransactionAsSourceArray;
		 */
		private $_objAssetTransactionAsSourceArray = array();

		/**
		 * Private member variable that stores a reference to a single AssetTransactionAsDestination object
		 * (of type AssetTransaction), if this Location object was restored with
		 * an expansion on the asset_transaction association table.
		 * @var AssetTransaction _objAssetTransactionAsDestination;
		 */
		private $_objAssetTransactionAsDestination;

		/**
		 * Private member variable that stores a reference to an array of AssetTransactionAsDestination objects
		 * (of type AssetTransaction[]), if this Location object was restored with
		 * an ExpandAsArray on the asset_transaction association table.
		 * @var AssetTransaction[] _objAssetTransactionAsDestinationArray;
		 */
		private $_objAssetTransactionAsDestinationArray = array();

		/**
		 * Private member variable that stores a reference to a single AuditScan object
		 * (of type AuditScan), if this Location object was restored with
		 * an expansion on the audit_scan association table.
		 * @var AuditScan _objAuditScan;
		 */
		private $_objAuditScan;

		/**
		 * Private member variable that stores a reference to an array of AuditScan objects
		 * (of type AuditScan[]), if this Location object was restored with
		 * an ExpandAsArray on the audit_scan association table.
		 * @var AuditScan[] _objAuditScanArray;
		 */
		private $_objAuditScanArray = array();

		/**
		 * Private member variable that stores a reference to a single InventoryLocation object
		 * (of type InventoryLocation), if this Location object was restored with
		 * an expansion on the inventory_location association table.
		 * @var InventoryLocation _objInventoryLocation;
		 */
		private $_objInventoryLocation;

		/**
		 * Private member variable that stores a reference to an array of InventoryLocation objects
		 * (of type InventoryLocation[]), if this Location object was restored with
		 * an ExpandAsArray on the inventory_location association table.
		 * @var InventoryLocation[] _objInventoryLocationArray;
		 */
		private $_objInventoryLocationArray = array();

		/**
		 * Private member variable that stores a reference to a single InventoryTransactionAsSource object
		 * (of type InventoryTransaction), if this Location object was restored with
		 * an expansion on the inventory_transaction association table.
		 * @var InventoryTransaction _objInventoryTransactionAsSource;
		 */
		private $_objInventoryTransactionAsSource;

		/**
		 * Private member variable that stores a reference to an array of InventoryTransactionAsSource objects
		 * (of type InventoryTransaction[]), if this Location object was restored with
		 * an ExpandAsArray on the inventory_transaction association table.
		 * @var InventoryTransaction[] _objInventoryTransactionAsSourceArray;
		 */
		private $_objInventoryTransactionAsSourceArray = array();

		/**
		 * Private member variable that stores a reference to a single InventoryTransactionAsDestination object
		 * (of type InventoryTransaction), if this Location object was restored with
		 * an expansion on the inventory_transaction association table.
		 * @var InventoryTransaction _objInventoryTransactionAsDestination;
		 */
		private $_objInventoryTransactionAsDestination;

		/**
		 * Private member variable that stores a reference to an array of InventoryTransactionAsDestination objects
		 * (of type InventoryTransaction[]), if this Location object was restored with
		 * an ExpandAsArray on the inventory_transaction association table.
		 * @var InventoryTransaction[] _objInventoryTransactionAsDestinationArray;
		 */
		private $_objInventoryTransactionAsDestinationArray = array();

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
		 * in the database column location.created_by.
		 *
		 * NOTE: Always use the CreatedByObject property getter to correctly retrieve this UserAccount object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var UserAccount objCreatedByObject
		 */
		protected $objCreatedByObject;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column location.modified_by.
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
				$objQueryExpansion = new QQueryExpansion('Location', 'location', $objExpansionMap);
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
				$objQueryExpansion->AddFromItem(sprintf('LEFT JOIN `location` AS `%s__%s` ON `%s`.`%s` = `%s__%s`.`location_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias, $strParentAlias, $strAlias));

				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`location_id` AS `%s__%s__location_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
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
			$strToReturn = '<complexType name="Location"><sequence>';
			$strToReturn .= '<element name="LocationId" type="xsd:int"/>';
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
			if (!array_key_exists('Location', $strComplexTypeArray)) {
				$strComplexTypeArray['Location'] = Location::GetSoapComplexTypeXml();
				UserAccount::AlterSoapComplexTypeArray($strComplexTypeArray);
				UserAccount::AlterSoapComplexTypeArray($strComplexTypeArray);
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, Location::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new Location();
			if (property_exists($objSoapObject, 'LocationId'))
				$objToReturn->intLocationId = $objSoapObject->LocationId;
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
				array_push($objArrayToReturn, Location::GetSoapObjectFromObject($objObject, true));

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

	class QQNodeLocation extends QQNode {
		protected $strTableName = 'location';
		protected $strPrimaryKey = 'location_id';
		protected $strClassName = 'Location';
		public function __get($strName) {
			switch ($strName) {
				case 'LocationId':
					return new QQNode('location_id', 'integer', $this);
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
				case 'Asset':
					return new QQReverseReferenceNodeAsset($this, 'asset', 'reverse_reference', 'location_id');
				case 'AssetTransactionAsSource':
					return new QQReverseReferenceNodeAssetTransaction($this, 'assettransactionassource', 'reverse_reference', 'source_location_id');
				case 'AssetTransactionAsDestination':
					return new QQReverseReferenceNodeAssetTransaction($this, 'assettransactionasdestination', 'reverse_reference', 'destination_location_id');
				case 'AuditScan':
					return new QQReverseReferenceNodeAuditScan($this, 'auditscan', 'reverse_reference', 'location_id');
				case 'InventoryLocation':
					return new QQReverseReferenceNodeInventoryLocation($this, 'inventorylocation', 'reverse_reference', 'location_id');
				case 'InventoryTransactionAsSource':
					return new QQReverseReferenceNodeInventoryTransaction($this, 'inventorytransactionassource', 'reverse_reference', 'source_location_id');
				case 'InventoryTransactionAsDestination':
					return new QQReverseReferenceNodeInventoryTransaction($this, 'inventorytransactionasdestination', 'reverse_reference', 'destination_location_id');

				case '_PrimaryKeyNode':
					return new QQNode('location_id', 'integer', $this);
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

	class QQReverseReferenceNodeLocation extends QQReverseReferenceNode {
		protected $strTableName = 'location';
		protected $strPrimaryKey = 'location_id';
		protected $strClassName = 'Location';
		public function __get($strName) {
			switch ($strName) {
				case 'LocationId':
					return new QQNode('location_id', 'integer', $this);
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
				case 'Asset':
					return new QQReverseReferenceNodeAsset($this, 'asset', 'reverse_reference', 'location_id');
				case 'AssetTransactionAsSource':
					return new QQReverseReferenceNodeAssetTransaction($this, 'assettransactionassource', 'reverse_reference', 'source_location_id');
				case 'AssetTransactionAsDestination':
					return new QQReverseReferenceNodeAssetTransaction($this, 'assettransactionasdestination', 'reverse_reference', 'destination_location_id');
				case 'AuditScan':
					return new QQReverseReferenceNodeAuditScan($this, 'auditscan', 'reverse_reference', 'location_id');
				case 'InventoryLocation':
					return new QQReverseReferenceNodeInventoryLocation($this, 'inventorylocation', 'reverse_reference', 'location_id');
				case 'InventoryTransactionAsSource':
					return new QQReverseReferenceNodeInventoryTransaction($this, 'inventorytransactionassource', 'reverse_reference', 'source_location_id');
				case 'InventoryTransactionAsDestination':
					return new QQReverseReferenceNodeInventoryTransaction($this, 'inventorytransactionasdestination', 'reverse_reference', 'destination_location_id');

				case '_PrimaryKeyNode':
					return new QQNode('location_id', 'integer', $this);
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