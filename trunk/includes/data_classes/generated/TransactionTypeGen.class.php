<?php
	/**
	 * The abstract TransactionTypeGen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the TransactionType subclass which
	 * extends this TransactionTypeGen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the TransactionType class.
	 * 
	 * @package My Application
	 * @subpackage GeneratedDataObjects
	 * 
	 */
	class TransactionTypeGen extends QBaseClass {
		///////////////////////////////
		// COMMON LOAD METHODS
		///////////////////////////////

		/**
		 * Load a TransactionType from PK Info
		 * @param integer $intTransactionTypeId
		 * @return TransactionType
		 */
		public static function Load($intTransactionTypeId) {
			// Use QuerySingle to Perform the Query
			return TransactionType::QuerySingle(
				QQ::Equal(QQN::TransactionType()->TransactionTypeId, $intTransactionTypeId)
			);
		}

		/**
		 * Load all TransactionTypes
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return TransactionType[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			// Call TransactionType::QueryArray to perform the LoadAll query
			try {
				return TransactionType::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all TransactionTypes
		 * @return int
		 */
		public static function CountAll() {
			// Call TransactionType::QueryCount to perform the CountAll query
			return TransactionType::QueryCount(QQ::All());
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
			$objDatabase = TransactionType::GetDatabase();

			// Create/Build out the QueryBuilder object with TransactionType-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, 'transaction_type');
			TransactionType::GetSelectFields($objQueryBuilder);
			$objQueryBuilder->AddFromItem('`transaction_type` AS `transaction_type`');

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
		 * Static Qcodo Query method to query for a single TransactionType object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return TransactionType the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = TransactionType::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query, Get the First Row, and Instantiate a new TransactionType object
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return TransactionType::InstantiateDbRow($objDbResult->GetNextRow());
		}

		/**
		 * Static Qcodo Query method to query for an array of TransactionType objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return TransactionType[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = TransactionType::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return TransactionType::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
		}

		/**
		 * Static Qcodo Query method to query for a count of TransactionType objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = TransactionType::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
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
			$objDatabase = TransactionType::GetDatabase();

			// Lookup the QCache for This Query Statement
			$objCache = new QCache('query', 'transaction_type_' . serialize($strConditions));
			if (!($strQuery = $objCache->GetData())) {
				// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with TransactionType-specific fields
				$objQueryBuilder = new QQueryBuilder($objDatabase);
				TransactionType::GetSelectFields($objQueryBuilder);
				TransactionType::GetFromFields($objQueryBuilder);

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
			return TransactionType::InstantiateDbResult($objDbResult);
		}*/

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this TransactionType
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null) {
			if ($strPrefix) {
				$strTableName = '`' . $strPrefix . '`';
				$strAliasPrefix = '`' . $strPrefix . '__';
			} else {
				$strTableName = '`transaction_type`';
				$strAliasPrefix = '`';
			}

			$objBuilder->AddSelectItem($strTableName . '.`transaction_type_id` AS ' . $strAliasPrefix . 'transaction_type_id`');
			$objBuilder->AddSelectItem($strTableName . '.`short_description` AS ' . $strAliasPrefix . 'short_description`');
			$objBuilder->AddSelectItem($strTableName . '.`asset_flag` AS ' . $strAliasPrefix . 'asset_flag`');
			$objBuilder->AddSelectItem($strTableName . '.`inventory_flag` AS ' . $strAliasPrefix . 'inventory_flag`');
		}



		///////////////////////////////
		// INSTANTIATION-RELATED METHODS
		///////////////////////////////

		/**
		 * Instantiate a TransactionType from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this TransactionType::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param DatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @return TransactionType
		*/
		public static function InstantiateDbRow($objDbRow, $strAliasPrefix = null, $strExpandAsArrayNodes = null, $objPreviousItem = null) {
			// If blank row, return null
			if (!$objDbRow)
				return null;

			// See if we're doing an array expansion on the previous item
			if (($strExpandAsArrayNodes) && ($objPreviousItem) &&
				($objPreviousItem->intTransactionTypeId == $objDbRow->GetColumn($strAliasPrefix . 'transaction_type_id', 'Integer'))) {

				// We are.  Now, prepare to check for ExpandAsArray clauses
				$blnExpandedViaArray = false;
				if (!$strAliasPrefix)
					$strAliasPrefix = 'transaction_type__';


				if ((array_key_exists($strAliasPrefix . 'transaction__transaction_id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'transaction__transaction_id')))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objTransactionArray)) {
						$objPreviousChildItem = $objPreviousItem->_objTransactionArray[$intPreviousChildItemCount - 1];
						$objChildItem = Transaction::InstantiateDbRow($objDbRow, $strAliasPrefix . 'transaction__', $strExpandAsArrayNodes, $objPreviousChildItem);
						if ($objChildItem)
							array_push($objPreviousItem->_objTransactionArray, $objChildItem);
					} else
						array_push($objPreviousItem->_objTransactionArray, Transaction::InstantiateDbRow($objDbRow, $strAliasPrefix . 'transaction__', $strExpandAsArrayNodes));
					$blnExpandedViaArray = true;
				}

				// Either return false to signal array expansion, or check-to-reset the Alias prefix and move on
				if ($blnExpandedViaArray)
					return false;
				else if ($strAliasPrefix == 'transaction_type__')
					$strAliasPrefix = null;
			}

			// Create a new instance of the TransactionType object
			$objToReturn = new TransactionType();
			$objToReturn->__blnRestored = true;

			$objToReturn->intTransactionTypeId = $objDbRow->GetColumn($strAliasPrefix . 'transaction_type_id', 'Integer');
			$objToReturn->strShortDescription = $objDbRow->GetColumn($strAliasPrefix . 'short_description', 'VarChar');
			$objToReturn->blnAssetFlag = $objDbRow->GetColumn($strAliasPrefix . 'asset_flag', 'Bit');
			$objToReturn->blnInventoryFlag = $objDbRow->GetColumn($strAliasPrefix . 'inventory_flag', 'Bit');

			// Instantiate Virtual Attributes
			foreach ($objDbRow->GetColumnNameArray() as $strColumnName => $mixValue) {
				$strVirtualPrefix = $strAliasPrefix . '__';
				$strVirtualPrefixLength = strlen($strVirtualPrefix);
				if (substr($strColumnName, 0, $strVirtualPrefixLength) == $strVirtualPrefix)
					$objToReturn->__strVirtualAttributeArray[substr($strColumnName, $strVirtualPrefixLength)] = $mixValue;
			}

			// Prepare to Check for Early/Virtual Binding
			if (!$strAliasPrefix)
				$strAliasPrefix = 'transaction_type__';




			// Check for Transaction Virtual Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'transaction__transaction_id'))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'transaction__transaction_id', $strExpandAsArrayNodes)))
					array_push($objToReturn->_objTransactionArray, Transaction::InstantiateDbRow($objDbRow, $strAliasPrefix . 'transaction__', $strExpandAsArrayNodes));
				else
					$objToReturn->_objTransaction = Transaction::InstantiateDbRow($objDbRow, $strAliasPrefix . 'transaction__', $strExpandAsArrayNodes);
			}

			return $objToReturn;
		}

		/**
		 * Instantiate an array of TransactionTypes from a Database Result
		 * @param DatabaseResultBase $objDbResult
		 * @return TransactionType[]
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
					$objItem = TransactionType::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
					if ($objItem) {
						array_push($objToReturn, $objItem);
						$objLastRowItem = $objItem;
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					array_push($objToReturn, TransactionType::InstantiateDbRow($objDbRow));
			}

			return $objToReturn;
		}



		///////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Single Load and Array)
		///////////////////////////////////////////////////
			
		/**
		 * Load a single TransactionType object,
		 * by TransactionTypeId Index(es)
		 * @param integer $intTransactionTypeId
		 * @return TransactionType
		*/
		public static function LoadByTransactionTypeId($intTransactionTypeId) {
			return TransactionType::QuerySingle(
				QQ::Equal(QQN::TransactionType()->TransactionTypeId, $intTransactionTypeId)
			);
		}
			
		/**
		 * Load a single TransactionType object,
		 * by ShortDescription Index(es)
		 * @param string $strShortDescription
		 * @return TransactionType
		*/
		public static function LoadByShortDescription($strShortDescription) {
			return TransactionType::QuerySingle(
				QQ::Equal(QQN::TransactionType()->ShortDescription, $strShortDescription)
			);
		}



		////////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Array via Many to Many)
		////////////////////////////////////////////////////



		//////////////////
		// SAVE AND DELETE
		//////////////////

		/**
		 * Save this TransactionType
		 * @param bool $blnForceInsert
		 * @param bool $blnForceUpdate
		 * @return int
		*/
		public function Save($blnForceInsert = false, $blnForceUpdate = false) {
			// Get the Database Object for this Class
			$objDatabase = TransactionType::GetDatabase();

			$mixToReturn = null;

			try {
				if ((!$this->__blnRestored) || ($blnForceInsert)) {
					// Perform an INSERT query
					$objDatabase->NonQuery('
						INSERT INTO `transaction_type` (
							`short_description`,
							`asset_flag`,
							`inventory_flag`
						) VALUES (
							' . $objDatabase->SqlVariable($this->strShortDescription) . ',
							' . $objDatabase->SqlVariable($this->blnAssetFlag) . ',
							' . $objDatabase->SqlVariable($this->blnInventoryFlag) . '
						)
					');

					// Update Identity column and return its value
					$mixToReturn = $this->intTransactionTypeId = $objDatabase->InsertId('transaction_type', 'transaction_type_id');
				} else {
					// Perform an UPDATE query

					// First checking for Optimistic Locking constraints (if applicable)

					// Perform the UPDATE query
					$objDatabase->NonQuery('
						UPDATE
							`transaction_type`
						SET
							`short_description` = ' . $objDatabase->SqlVariable($this->strShortDescription) . ',
							`asset_flag` = ' . $objDatabase->SqlVariable($this->blnAssetFlag) . ',
							`inventory_flag` = ' . $objDatabase->SqlVariable($this->blnInventoryFlag) . '
						WHERE
							`transaction_type_id` = ' . $objDatabase->SqlVariable($this->intTransactionTypeId) . '
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
		 * Delete this TransactionType
		 * @return void
		*/
		public function Delete() {
			if ((is_null($this->intTransactionTypeId)))
				throw new QUndefinedPrimaryKeyException('Cannot delete this TransactionType with an unset primary key.');

			// Get the Database Object for this Class
			$objDatabase = TransactionType::GetDatabase();


			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`transaction_type`
				WHERE
					`transaction_type_id` = ' . $objDatabase->SqlVariable($this->intTransactionTypeId) . '');
		}

		/**
		 * Delete all TransactionTypes
		 * @return void
		*/
		public static function DeleteAll() {
			// Get the Database Object for this Class
			$objDatabase = TransactionType::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				DELETE FROM
					`transaction_type`');
		}

		/**
		 * Truncate transaction_type table
		 * @return void
		*/
		public static function Truncate() {
			// Get the Database Object for this Class
			$objDatabase = TransactionType::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				TRUNCATE `transaction_type`');
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
				case 'TransactionTypeId':
					/**
					 * Gets the value for intTransactionTypeId (Read-Only PK)
					 * @return integer
					 */
					return $this->intTransactionTypeId;

				case 'ShortDescription':
					/**
					 * Gets the value for strShortDescription (Unique)
					 * @return string
					 */
					return $this->strShortDescription;

				case 'AssetFlag':
					/**
					 * Gets the value for blnAssetFlag (Not Null)
					 * @return boolean
					 */
					return $this->blnAssetFlag;

				case 'InventoryFlag':
					/**
					 * Gets the value for blnInventoryFlag (Not Null)
					 * @return boolean
					 */
					return $this->blnInventoryFlag;


				///////////////////
				// Member Objects
				///////////////////

				////////////////////////////
				// Virtual Object References (Many to Many and Reverse References)
				// (If restored via a "Many-to" expansion)
				////////////////////////////

				case '_Transaction':
					/**
					 * Gets the value for the private _objTransaction (Read-Only)
					 * if set due to an expansion on the transaction.transaction_type_id reverse relationship
					 * @return Transaction
					 */
					return $this->_objTransaction;

				case '_TransactionArray':
					/**
					 * Gets the value for the private _objTransactionArray (Read-Only)
					 * if set due to an ExpandAsArray on the transaction.transaction_type_id reverse relationship
					 * @return Transaction[]
					 */
					return (array) $this->_objTransactionArray;

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

				case 'AssetFlag':
					/**
					 * Sets the value for blnAssetFlag (Not Null)
					 * @param boolean $mixValue
					 * @return boolean
					 */
					try {
						return ($this->blnAssetFlag = QType::Cast($mixValue, QType::Boolean));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'InventoryFlag':
					/**
					 * Sets the value for blnInventoryFlag (Not Null)
					 * @param boolean $mixValue
					 * @return boolean
					 */
					try {
						return ($this->blnInventoryFlag = QType::Cast($mixValue, QType::Boolean));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}


				///////////////////
				// Member Objects
				///////////////////
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

			
		
		// Related Objects' Methods for Transaction
		//-------------------------------------------------------------------

		/**
		 * Gets all associated Transactions as an array of Transaction objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Transaction[]
		*/ 
		public function GetTransactionArray($objOptionalClauses = null) {
			if ((is_null($this->intTransactionTypeId)))
				return array();

			try {
				return Transaction::LoadArrayByTransactionTypeId($this->intTransactionTypeId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated Transactions
		 * @return int
		*/ 
		public function CountTransactions() {
			if ((is_null($this->intTransactionTypeId)))
				return 0;

			return Transaction::CountByTransactionTypeId($this->intTransactionTypeId);
		}

		/**
		 * Associates a Transaction
		 * @param Transaction $objTransaction
		 * @return void
		*/ 
		public function AssociateTransaction(Transaction $objTransaction) {
			if ((is_null($this->intTransactionTypeId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateTransaction on this unsaved TransactionType.');
			if ((is_null($objTransaction->TransactionId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateTransaction on this TransactionType with an unsaved Transaction.');

			// Get the Database Object for this Class
			$objDatabase = TransactionType::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`transaction`
				SET
					`transaction_type_id` = ' . $objDatabase->SqlVariable($this->intTransactionTypeId) . '
				WHERE
					`transaction_id` = ' . $objDatabase->SqlVariable($objTransaction->TransactionId) . '
			');
		}

		/**
		 * Unassociates a Transaction
		 * @param Transaction $objTransaction
		 * @return void
		*/ 
		public function UnassociateTransaction(Transaction $objTransaction) {
			if ((is_null($this->intTransactionTypeId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateTransaction on this unsaved TransactionType.');
			if ((is_null($objTransaction->TransactionId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateTransaction on this TransactionType with an unsaved Transaction.');

			// Get the Database Object for this Class
			$objDatabase = TransactionType::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`transaction`
				SET
					`transaction_type_id` = null
				WHERE
					`transaction_id` = ' . $objDatabase->SqlVariable($objTransaction->TransactionId) . ' AND
					`transaction_type_id` = ' . $objDatabase->SqlVariable($this->intTransactionTypeId) . '
			');
		}

		/**
		 * Unassociates all Transactions
		 * @return void
		*/ 
		public function UnassociateAllTransactions() {
			if ((is_null($this->intTransactionTypeId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateTransaction on this unsaved TransactionType.');

			// Get the Database Object for this Class
			$objDatabase = TransactionType::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`transaction`
				SET
					`transaction_type_id` = null
				WHERE
					`transaction_type_id` = ' . $objDatabase->SqlVariable($this->intTransactionTypeId) . '
			');
		}

		/**
		 * Deletes an associated Transaction
		 * @param Transaction $objTransaction
		 * @return void
		*/ 
		public function DeleteAssociatedTransaction(Transaction $objTransaction) {
			if ((is_null($this->intTransactionTypeId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateTransaction on this unsaved TransactionType.');
			if ((is_null($objTransaction->TransactionId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateTransaction on this TransactionType with an unsaved Transaction.');

			// Get the Database Object for this Class
			$objDatabase = TransactionType::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`transaction`
				WHERE
					`transaction_id` = ' . $objDatabase->SqlVariable($objTransaction->TransactionId) . ' AND
					`transaction_type_id` = ' . $objDatabase->SqlVariable($this->intTransactionTypeId) . '
			');
		}

		/**
		 * Deletes all associated Transactions
		 * @return void
		*/ 
		public function DeleteAllTransactions() {
			if ((is_null($this->intTransactionTypeId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateTransaction on this unsaved TransactionType.');

			// Get the Database Object for this Class
			$objDatabase = TransactionType::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`transaction`
				WHERE
					`transaction_type_id` = ' . $objDatabase->SqlVariable($this->intTransactionTypeId) . '
			');
		}




		///////////////////////////////////////////////////////////////////////
		// PROTECTED MEMBER VARIABLES and TEXT FIELD MAXLENGTHS (if applicable)
		///////////////////////////////////////////////////////////////////////
		
		/**
		 * Protected member variable that maps to the database PK Identity column transaction_type.transaction_type_id
		 * @var integer intTransactionTypeId
		 */
		protected $intTransactionTypeId;
		const TransactionTypeIdDefault = null;


		/**
		 * Protected member variable that maps to the database column transaction_type.short_description
		 * @var string strShortDescription
		 */
		protected $strShortDescription;
		const ShortDescriptionMaxLength = 50;
		const ShortDescriptionDefault = null;


		/**
		 * Protected member variable that maps to the database column transaction_type.asset_flag
		 * @var boolean blnAssetFlag
		 */
		protected $blnAssetFlag;
		const AssetFlagDefault = null;


		/**
		 * Protected member variable that maps to the database column transaction_type.inventory_flag
		 * @var boolean blnInventoryFlag
		 */
		protected $blnInventoryFlag;
		const InventoryFlagDefault = null;


		/**
		 * Private member variable that stores a reference to a single Transaction object
		 * (of type Transaction), if this TransactionType object was restored with
		 * an expansion on the transaction association table.
		 * @var Transaction _objTransaction;
		 */
		private $_objTransaction;

		/**
		 * Private member variable that stores a reference to an array of Transaction objects
		 * (of type Transaction[]), if this TransactionType object was restored with
		 * an ExpandAsArray on the transaction association table.
		 * @var Transaction[] _objTransactionArray;
		 */
		private $_objTransactionArray = array();

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
				$objQueryExpansion = new QQueryExpansion('TransactionType', 'transaction_type', $objExpansionMap);
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
				$objQueryExpansion->AddFromItem(sprintf('LEFT JOIN `transaction_type` AS `%s__%s` ON `%s`.`%s` = `%s__%s`.`transaction_type_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias, $strParentAlias, $strAlias));

				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`transaction_type_id` AS `%s__%s__transaction_type_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`short_description` AS `%s__%s__short_description`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`asset_flag` AS `%s__%s__asset_flag`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`inventory_flag` AS `%s__%s__inventory_flag`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));

				$strParentAlias = $strParentAlias . '__' . $strAlias;
			}

			if (is_array($objExpansionMap))
				foreach ($objExpansionMap as $strKey=>$objValue) {
					switch ($strKey) {
						default:
							throw new QCallerException(sprintf('Unknown Object to Expand in %s: %s', $strParentAlias, $strKey));
					}
				}
		}




		////////////////////////////////////////
		// COLUMN CONSTANTS for OBJECT EXPANSION
		////////////////////////////////////////




		////////////////////////////////////////
		// METHODS for WEB SERVICES
		////////////////////////////////////////

		public static function GetSoapComplexTypeXml() {
			$strToReturn = '<complexType name="TransactionType"><sequence>';
			$strToReturn .= '<element name="TransactionTypeId" type="xsd:int"/>';
			$strToReturn .= '<element name="ShortDescription" type="xsd:string"/>';
			$strToReturn .= '<element name="AssetFlag" type="xsd:boolean"/>';
			$strToReturn .= '<element name="InventoryFlag" type="xsd:boolean"/>';
			$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
			$strToReturn .= '</sequence></complexType>';
			return $strToReturn;
		}

		public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
			if (!array_key_exists('TransactionType', $strComplexTypeArray)) {
				$strComplexTypeArray['TransactionType'] = TransactionType::GetSoapComplexTypeXml();
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, TransactionType::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new TransactionType();
			if (property_exists($objSoapObject, 'TransactionTypeId'))
				$objToReturn->intTransactionTypeId = $objSoapObject->TransactionTypeId;
			if (property_exists($objSoapObject, 'ShortDescription'))
				$objToReturn->strShortDescription = $objSoapObject->ShortDescription;
			if (property_exists($objSoapObject, 'AssetFlag'))
				$objToReturn->blnAssetFlag = $objSoapObject->AssetFlag;
			if (property_exists($objSoapObject, 'InventoryFlag'))
				$objToReturn->blnInventoryFlag = $objSoapObject->InventoryFlag;
			if (property_exists($objSoapObject, '__blnRestored'))
				$objToReturn->__blnRestored = $objSoapObject->__blnRestored;
			return $objToReturn;
		}

		public static function GetSoapArrayFromArray($objArray) {
			if (!$objArray)
				return null;

			$objArrayToReturn = array();

			foreach ($objArray as $objObject)
				array_push($objArrayToReturn, TransactionType::GetSoapObjectFromObject($objObject, true));

			return unserialize(serialize($objArrayToReturn));
		}

		public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
			return $objObject;
		}
	}





	/////////////////////////////////////
	// ADDITIONAL CLASSES for QCODO QUERY
	/////////////////////////////////////

	class QQNodeTransactionType extends QQNode {
		protected $strTableName = 'transaction_type';
		protected $strPrimaryKey = 'transaction_type_id';
		protected $strClassName = 'TransactionType';
		public function __get($strName) {
			switch ($strName) {
				case 'TransactionTypeId':
					return new QQNode('transaction_type_id', 'integer', $this);
				case 'ShortDescription':
					return new QQNode('short_description', 'string', $this);
				case 'AssetFlag':
					return new QQNode('asset_flag', 'boolean', $this);
				case 'InventoryFlag':
					return new QQNode('inventory_flag', 'boolean', $this);
				case 'Transaction':
					return new QQReverseReferenceNodeTransaction($this, 'transaction', 'reverse_reference', 'transaction_type_id');

				case '_PrimaryKeyNode':
					return new QQNode('transaction_type_id', 'integer', $this);
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

	class QQReverseReferenceNodeTransactionType extends QQReverseReferenceNode {
		protected $strTableName = 'transaction_type';
		protected $strPrimaryKey = 'transaction_type_id';
		protected $strClassName = 'TransactionType';
		public function __get($strName) {
			switch ($strName) {
				case 'TransactionTypeId':
					return new QQNode('transaction_type_id', 'integer', $this);
				case 'ShortDescription':
					return new QQNode('short_description', 'string', $this);
				case 'AssetFlag':
					return new QQNode('asset_flag', 'boolean', $this);
				case 'InventoryFlag':
					return new QQNode('inventory_flag', 'boolean', $this);
				case 'Transaction':
					return new QQReverseReferenceNodeTransaction($this, 'transaction', 'reverse_reference', 'transaction_type_id');

				case '_PrimaryKeyNode':
					return new QQNode('transaction_type_id', 'integer', $this);
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