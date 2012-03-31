<?php
	/**
	 * The abstract InventoryLocationGen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the InventoryLocation subclass which
	 * extends this InventoryLocationGen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the InventoryLocation class.
	 * 
	 * @package My Application
	 * @subpackage GeneratedDataObjects
	 * 
	 */
	class SkuDateQtyHistoryGen extends QBaseClass {
		///////////////////////////////
		// COMMON LOAD METHODS
		///////////////////////////////

		/**
		 * Load a InventoryLocation from PK Info
		 * @param integer $intInventoryLocationId
		 * @return InventoryLocation
		 */
		public static function Load($skuDateQtyHistoryId) {
			// Use QuerySingle to Perform the Query
			return SkuDateQtyHistory::QuerySingle(
				QQ::Equal(QQN::SkuDateQtyHistory()->SkuDateQtyHistoryId, $skuDateQtyHistoryId)
			);
		}

		/**
		 * Load all InventoryLocations
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return InventoryLocation[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			// Call InventoryLocation::QueryArray to perform the LoadAll query
			try {
				return SkuDateQtyHistory::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all InventoryLocations
		 * @return int
		 */
		public static function CountAll() {
			// Call InventoryLocation::QueryCount to perform the CountAll query
			return SkuDateQtyHistory::QueryCount(QQ::All());
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
			$objDatabase = SkuDateQtyHistory::GetDatabase();

			// Create/Build out the QueryBuilder object with InventoryLocation-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, 'sku_date_qty_history');
			SkuDateQtyHistory::GetSelectFields($objQueryBuilder);
			$objQueryBuilder->AddFromItem('`sku_date_qty_history` AS `sku_date_qty_history`');

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
			//var_dump($strQuery);
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
		 * Static Qcodo Query method to query for a single InventoryLocation object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return InventoryLocation the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = SkuDateQtyHistory::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query, Get the First Row, and Instantiate a new InventoryLocation object
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return SkuDateQtyHistory::InstantiateDbRow($objDbResult->GetNextRow());
		}

		/**
		 * Static Qcodo Query method to query for an array of InventoryLocation objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return InventoryLocation[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = SkuDateQtyHistory::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return SkuDateQtyHistory::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
		}

		/**
		 * Static Qcodo Query method to query for a count of InventoryLocation objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = SkuDateQtyHistory::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
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

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this InventoryLocation
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null) {
			if ($strPrefix) {
				$strTableName = '`' . $strPrefix . '`';
				$strAliasPrefix = '`' . $strPrefix . '__';
			} else {
				$strTableName = '`sku_date_qty_history`';
				$strAliasPrefix = '`';
			}

			$objBuilder->AddSelectItem($strTableName . '.`sku_date_qty_history_id` AS ' . $strAliasPrefix . 'sku_date_qty_history_id`');
			$objBuilder->AddSelectItem($strTableName . '.`sku` AS ' . $strAliasPrefix . 'sku`');
			$objBuilder->AddSelectItem($strTableName . '.`date` AS ' . $strAliasPrefix . 'date`');
			$objBuilder->AddSelectItem($strTableName . '.`restore_qty` AS ' . $strAliasPrefix . 'restore_qty`');
			$objBuilder->AddSelectItem($strTableName . '.`take_out_qty` AS ' . $strAliasPrefix . 'take_out_qty`');
			$objBuilder->AddSelectItem($strTableName . '.`move_qty` AS ' . $strAliasPrefix . 'move_qty`');
			
		}



		///////////////////////////////
		// INSTANTIATION-RELATED METHODS
		///////////////////////////////

		/**
		 * Instantiate a InventoryLocation from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this InventoryLocation::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param DatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @return InventoryLocation
		*/
		public static function InstantiateDbRow($objDbRow, $strAliasPrefix = null, $strExpandAsArrayNodes = null, $objPreviousItem = null) {
			// If blank row, return null
			if (!$objDbRow)
				return null;
				
			// Create a new instance of the InventoryLocation object
			$objToReturn = new SkuDateQtyHistory();
			$objToReturn->__blnRestored = true;

			$objToReturn->SkuDateQtyHistoryId = $objDbRow->GetColumn($strAliasPrefix . 'sku_date_qty_history_id', 'Integer');
			$objToReturn->Sku = $objDbRow->GetColumn($strAliasPrefix . 'sku', 'VarChar');
			$objToReturn->Date = $objDbRow->GetColumn($strAliasPrefix . 'date', 'VarChar');
			$objToReturn->RestoreQty = $objDbRow->GetColumn($strAliasPrefix . 'restore_qty', 'Integer');
			$objToReturn->TakeOutQty = $objDbRow->GetColumn($strAliasPrefix . 'take_out_qty', 'Integer');
			$objToReturn->MoveQty = $objDbRow->GetColumn($strAliasPrefix . 'move_qty', 'Integer');

			return $objToReturn;
		}

		/**
		 * Instantiate an array of InventoryLocations from a Database Result
		 * @param DatabaseResultBase $objDbResult
		 * @return InventoryLocation[]
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
					$objItem = SkuDateQtyHistory::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
					if ($objItem) {
						array_push($objToReturn, $objItem);
						$objLastRowItem = $objItem;
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					array_push($objToReturn, SkuDateQtyHistory::InstantiateDbRow($objDbRow));
			}

			return $objToReturn;
		}

		public static function LoadArrayBySku($stringSku, $objOptionalClauses = null) {
			try {
				return SkuDateQtyHistory::QueryArray(
					QQ::Equal(QQN::SkuDateQtyHistory()->Sku, $stringSku),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		public static function CountBySku($stringSku) {
			return SkuDateQtyHistory::QueryCount(
				QQ::Equal(QQN::SkuDateQtyHistory()->Sku, $stringSku)
			);
		}

		public function __get($strName) {
			switch ($strName) {
				case 'SkuDateQtyHistoryId':
					return $this->skuDateQtyHistoryId;

				case 'Sku':
					return $this->sku;
				
				case 'Date':
					return $this->date;
					
				case 'RestoreQty':
					return $this->restoreQty;
				
				case 'TakeOutQty':
					return $this->takeOutQty;
				
				case 'MoveQty':
					return $this->moveQty;
					
				default:
					try {
						return parent::__get($strName);
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}

		public function __set($strName, $mixValue) {
			switch ($strName) {
				case 'SkuDateQtyHistoryId':
					try {
						return ($this->skuDateQtyHistoryId = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Sku':
					try {
						return ($this->sku = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Date':
					try {
						return ($this->date = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'RestoreQty':
					try {
						return ($this->restoreQty = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
				
				case 'TakeOutQty':
					try {
						return ($this->takeOutQty = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
					
				case 'MoveQty':
					try {
						return ($this->moveQty = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
					
				default:
					try {
						return parent::__set($strName, $mixValue);
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}

		protected $skuDateQtyHistoryId;
		const SkuDateQtyHistoryId = null;

		protected $sku;
		const Sku = null;

		protected $date;
		const Date = null;

		protected $restoreQty;
		const RestoreQty = null;

		protected $takeOutQty;
		const TakeOutQty = null;

		protected $moveQty;
		const MoveQty = null;
	
		protected $__blnRestored;
		
		protected static function QueryHelper(&$objDatabase) {
			// Get the Database
			$objDatabase = QApplication::$Database[1];
		}


		protected static function ArrayQueryHelper(&$strOrderBy, $strLimit, &$strLimitPrefix, &$strLimitSuffix, &$strExpandSelect, &$strExpandFrom, $objExpansionMap, &$objDatabase) {
			// Get the Database
			$objDatabase = QApplication::$Database[1];

			// Setup OrderBy and Limit Information (if applicable)
			$strOrderBy = $objDatabase->SqlSortByVariable($strOrderBy);
			$strLimitPrefix = $objDatabase->SqlLimitVariablePrefix($strLimit);
			$strLimitSuffix = $objDatabase->SqlLimitVariableSuffix($strLimit);

			// Setup QueryExpansion (if applicable)
			if ($objExpansionMap) {
				$objQueryExpansion = new QQueryExpansion('SkuDateQtyHistory', 'sku_date_qty_history', $objExpansionMap);
				$strExpandSelect = $objQueryExpansion->GetSelectSql();
				$strExpandFrom = $objQueryExpansion->GetFromSql();
			} else {
				$strExpandSelect = null;
				$strExpandFrom = null;
			}
		}



		////////////////////////////////////////
		// METHODS for WEB SERVICES
		////////////////////////////////////////

		public static function GetSoapComplexTypeXml() {
			$strToReturn = '<complexType name="SkuDateQtyHistory"><sequence>';
			$strToReturn .= '<element name="SkuDateQtyHistoryId" type="xsd:int"/>';
			$strToReturn .= '<element name="Sku" type="xsd:string"/>';
			$strToReturn .= '<element name="Date" type="xsd:string"/>';
			$strToReturn .= '<element name="RestoreQty" type="xsd:int"/>';
			$strToReturn .= '<element name="TakeOutQty" type="xsd:int"/>';
			$strToReturn .= '<element name="MoveQty" type="xsd:int"/>';
			$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
			$strToReturn .= '</sequence></complexType>';
			return $strToReturn;
		}

		public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
			if (!array_key_exists('InventoryLocation', $strComplexTypeArray)) {
				$strComplexTypeArray['InventoryLocation'] = InventoryLocation::GetSoapComplexTypeXml();
				InventoryModel::AlterSoapComplexTypeArray($strComplexTypeArray);
				Location::AlterSoapComplexTypeArray($strComplexTypeArray);
				UserAccount::AlterSoapComplexTypeArray($strComplexTypeArray);
				UserAccount::AlterSoapComplexTypeArray($strComplexTypeArray);
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, InventoryLocation::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new InventoryLocation();
			if (property_exists($objSoapObject, 'InventoryLocationId'))
				$objToReturn->intInventoryLocationId = $objSoapObject->InventoryLocationId;
			if ((property_exists($objSoapObject, 'InventoryModel')) &&
				($objSoapObject->InventoryModel))
				$objToReturn->InventoryModel = InventoryModel::GetObjectFromSoapObject($objSoapObject->InventoryModel);
			if ((property_exists($objSoapObject, 'Location')) &&
				($objSoapObject->Location))
				$objToReturn->Location = Location::GetObjectFromSoapObject($objSoapObject->Location);
			if (property_exists($objSoapObject, 'Quantity'))
				$objToReturn->intQuantity = $objSoapObject->Quantity;
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
				array_push($objArrayToReturn, InventoryLocation::GetSoapObjectFromObject($objObject, true));

			return unserialize(serialize($objArrayToReturn));
		}

		public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
			if ($objObject->objInventoryModel)
				$objObject->objInventoryModel = InventoryModel::GetSoapObjectFromObject($objObject->objInventoryModel, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intInventoryModelId = null;
			if ($objObject->objLocation)
				$objObject->objLocation = Location::GetSoapObjectFromObject($objObject->objLocation, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intLocationId = null;
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

	class QQNodeSkuDateQtyHistory extends QQNode {
		protected $strTableName = 'sku_date_qty_history';
		protected $strPrimaryKey = 'sku_date_qty_history_id';
		protected $strClassName = 'SkuDateQtyHistory';
		public function __get($strName) {
			switch ($strName) {
				case 'SkuDateQtyHistoryId':
					return new QQNode('sku_date_qty_history_id', 'integer', $this);
				case 'Sku':
					return new QQNode('sku', 'string', $this);
				case 'Date':
					return new QQNode('date', 'string', $this);
				case 'RestoreQty':
					return new QQNode('restore_qty', 'integer', $this);
				case 'TakeOutQty':
					return new QQNode('take_out_qty', 'integer', $this);
				case 'MoveQty':
					return new QQNode('move_qty', 'integer', $this);	

				case '_PrimaryKeyNode':
					return new QQNode('sku_date_qty_history_id', 'integer', $this);
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

	class QQReverseReferenceNodeSkuDateQtyHistory extends QQReverseReferenceNode {
		protected $strTableName = 'sku_date_qty_history';
		protected $strPrimaryKey = 'sku_date_qty_history_id';
		protected $strClassName = 'SkuDateQtyHistory';
		public function __get($strName) {
			switch ($strName) {
				case 'SkuDateQtyHistoryId':
					return new QQNode('sku_date_qty_history_id', 'integer', $this);
				case 'Sku':
					return new QQNode('sku', 'string', $this);
				case 'Date':
					return new QQNode('date', 'string', $this);
				case 'RestoreQty':
					return new QQNode('restore_qty', 'integer', $this);
				case 'TakeOutQty':
					return new QQNode('take_out_qty', 'integer', $this);
				case 'MoveQty':
					return new QQNode('move_qty', 'integer', $this);	
				case '_PrimaryKeyNode':
					return new QQNode('sku_date_qty_history_id', 'integer', $this);
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