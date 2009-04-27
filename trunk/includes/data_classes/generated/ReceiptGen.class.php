<?php
	/**
	 * The abstract ReceiptGen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the Receipt subclass which
	 * extends this ReceiptGen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the Receipt class.
	 * 
	 * @package My Application
	 * @subpackage GeneratedDataObjects
	 * 
	 */
	class ReceiptGen extends QBaseClass {
		///////////////////////////////
		// COMMON LOAD METHODS
		///////////////////////////////

		/**
		 * Load a Receipt from PK Info
		 * @param integer $intReceiptId
		 * @return Receipt
		 */
		public static function Load($intReceiptId) {
			// Use QuerySingle to Perform the Query
			return Receipt::QuerySingle(
				QQ::Equal(QQN::Receipt()->ReceiptId, $intReceiptId)
			);
		}

		/**
		 * Load all Receipts
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Receipt[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			// Call Receipt::QueryArray to perform the LoadAll query
			try {
				return Receipt::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all Receipts
		 * @return int
		 */
		public static function CountAll() {
			// Call Receipt::QueryCount to perform the CountAll query
			return Receipt::QueryCount(QQ::All());
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
			$objDatabase = Receipt::GetDatabase();

			// Create/Build out the QueryBuilder object with Receipt-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, 'receipt');
			Receipt::GetSelectFields($objQueryBuilder);
			$objQueryBuilder->AddFromItem('`receipt` AS `receipt`');

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
		 * Static Qcodo Query method to query for a single Receipt object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return Receipt the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Receipt::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query, Get the First Row, and Instantiate a new Receipt object
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return Receipt::InstantiateDbRow($objDbResult->GetNextRow());
		}

		/**
		 * Static Qcodo Query method to query for an array of Receipt objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return Receipt[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Receipt::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return Receipt::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
		}

		/**
		 * Static Qcodo Query method to query for a count of Receipt objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Receipt::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
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
			$objDatabase = Receipt::GetDatabase();

			// Lookup the QCache for This Query Statement
			$objCache = new QCache('query', 'receipt_' . serialize($strConditions));
			if (!($strQuery = $objCache->GetData())) {
				// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with Receipt-specific fields
				$objQueryBuilder = new QQueryBuilder($objDatabase);
				Receipt::GetSelectFields($objQueryBuilder);
				Receipt::GetFromFields($objQueryBuilder);

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
			return Receipt::InstantiateDbResult($objDbResult);
		}*/

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this Receipt
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null) {
			if ($strPrefix) {
				$strTableName = '`' . $strPrefix . '`';
				$strAliasPrefix = '`' . $strPrefix . '__';
			} else {
				$strTableName = '`receipt`';
				$strAliasPrefix = '`';
			}

			$objBuilder->AddSelectItem($strTableName . '.`receipt_id` AS ' . $strAliasPrefix . 'receipt_id`');
			$objBuilder->AddSelectItem($strTableName . '.`transaction_id` AS ' . $strAliasPrefix . 'transaction_id`');
			$objBuilder->AddSelectItem($strTableName . '.`from_company_id` AS ' . $strAliasPrefix . 'from_company_id`');
			$objBuilder->AddSelectItem($strTableName . '.`from_contact_id` AS ' . $strAliasPrefix . 'from_contact_id`');
			$objBuilder->AddSelectItem($strTableName . '.`to_contact_id` AS ' . $strAliasPrefix . 'to_contact_id`');
			$objBuilder->AddSelectItem($strTableName . '.`to_address_id` AS ' . $strAliasPrefix . 'to_address_id`');
			$objBuilder->AddSelectItem($strTableName . '.`receipt_number` AS ' . $strAliasPrefix . 'receipt_number`');
			$objBuilder->AddSelectItem($strTableName . '.`due_date` AS ' . $strAliasPrefix . 'due_date`');
			$objBuilder->AddSelectItem($strTableName . '.`receipt_date` AS ' . $strAliasPrefix . 'receipt_date`');
			$objBuilder->AddSelectItem($strTableName . '.`received_flag` AS ' . $strAliasPrefix . 'received_flag`');
			$objBuilder->AddSelectItem($strTableName . '.`created_by` AS ' . $strAliasPrefix . 'created_by`');
			$objBuilder->AddSelectItem($strTableName . '.`creation_date` AS ' . $strAliasPrefix . 'creation_date`');
			$objBuilder->AddSelectItem($strTableName . '.`modified_by` AS ' . $strAliasPrefix . 'modified_by`');
			$objBuilder->AddSelectItem($strTableName . '.`modified_date` AS ' . $strAliasPrefix . 'modified_date`');
		}



		///////////////////////////////
		// INSTANTIATION-RELATED METHODS
		///////////////////////////////

		/**
		 * Instantiate a Receipt from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this Receipt::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param DatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @return Receipt
		*/
		public static function InstantiateDbRow($objDbRow, $strAliasPrefix = null, $strExpandAsArrayNodes = null, $objPreviousItem = null) {
			// If blank row, return null
			if (!$objDbRow)
				return null;


			// Create a new instance of the Receipt object
			$objToReturn = new Receipt();
			$objToReturn->__blnRestored = true;

			$objToReturn->intReceiptId = $objDbRow->GetColumn($strAliasPrefix . 'receipt_id', 'Integer');
			$objToReturn->intTransactionId = $objDbRow->GetColumn($strAliasPrefix . 'transaction_id', 'Integer');
			$objToReturn->intFromCompanyId = $objDbRow->GetColumn($strAliasPrefix . 'from_company_id', 'Integer');
			$objToReturn->intFromContactId = $objDbRow->GetColumn($strAliasPrefix . 'from_contact_id', 'Integer');
			$objToReturn->intToContactId = $objDbRow->GetColumn($strAliasPrefix . 'to_contact_id', 'Integer');
			$objToReturn->intToAddressId = $objDbRow->GetColumn($strAliasPrefix . 'to_address_id', 'Integer');
			$objToReturn->strReceiptNumber = $objDbRow->GetColumn($strAliasPrefix . 'receipt_number', 'VarChar');
			$objToReturn->dttDueDate = $objDbRow->GetColumn($strAliasPrefix . 'due_date', 'Date');
			$objToReturn->dttReceiptDate = $objDbRow->GetColumn($strAliasPrefix . 'receipt_date', 'Date');
			$objToReturn->blnReceivedFlag = $objDbRow->GetColumn($strAliasPrefix . 'received_flag', 'Bit');
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
				$strAliasPrefix = 'receipt__';

			// Check for Transaction Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'transaction_id__transaction_id')))
				$objToReturn->objTransaction = Transaction::InstantiateDbRow($objDbRow, $strAliasPrefix . 'transaction_id__', $strExpandAsArrayNodes);

			// Check for FromCompany Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'from_company_id__company_id')))
				$objToReturn->objFromCompany = Company::InstantiateDbRow($objDbRow, $strAliasPrefix . 'from_company_id__', $strExpandAsArrayNodes);

			// Check for FromContact Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'from_contact_id__contact_id')))
				$objToReturn->objFromContact = Contact::InstantiateDbRow($objDbRow, $strAliasPrefix . 'from_contact_id__', $strExpandAsArrayNodes);

			// Check for ToContact Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'to_contact_id__contact_id')))
				$objToReturn->objToContact = Contact::InstantiateDbRow($objDbRow, $strAliasPrefix . 'to_contact_id__', $strExpandAsArrayNodes);

			// Check for ToAddress Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'to_address_id__address_id')))
				$objToReturn->objToAddress = Address::InstantiateDbRow($objDbRow, $strAliasPrefix . 'to_address_id__', $strExpandAsArrayNodes);

			// Check for CreatedByObject Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'created_by__user_account_id')))
				$objToReturn->objCreatedByObject = UserAccount::InstantiateDbRow($objDbRow, $strAliasPrefix . 'created_by__', $strExpandAsArrayNodes);

			// Check for ModifiedByObject Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'modified_by__user_account_id')))
				$objToReturn->objModifiedByObject = UserAccount::InstantiateDbRow($objDbRow, $strAliasPrefix . 'modified_by__', $strExpandAsArrayNodes);




			return $objToReturn;
		}

		/**
		 * Instantiate an array of Receipts from a Database Result
		 * @param DatabaseResultBase $objDbResult
		 * @return Receipt[]
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
					$objItem = Receipt::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
					if ($objItem) {
						array_push($objToReturn, $objItem);
						$objLastRowItem = $objItem;
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					array_push($objToReturn, Receipt::InstantiateDbRow($objDbRow));
			}

			return $objToReturn;
		}



		///////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Single Load and Array)
		///////////////////////////////////////////////////
			
		/**
		 * Load a single Receipt object,
		 * by ReceiptId Index(es)
		 * @param integer $intReceiptId
		 * @return Receipt
		*/
		public static function LoadByReceiptId($intReceiptId) {
			return Receipt::QuerySingle(
				QQ::Equal(QQN::Receipt()->ReceiptId, $intReceiptId)
			);
		}
			
		/**
		 * Load a single Receipt object,
		 * by TransactionId Index(es)
		 * @param integer $intTransactionId
		 * @return Receipt
		*/
		public static function LoadByTransactionId($intTransactionId) {
			return Receipt::QuerySingle(
				QQ::Equal(QQN::Receipt()->TransactionId, $intTransactionId)
			);
		}
			
		/**
		 * Load a single Receipt object,
		 * by ReceiptNumber Index(es)
		 * @param string $strReceiptNumber
		 * @return Receipt
		*/
		public static function LoadByReceiptNumber($strReceiptNumber) {
			return Receipt::QuerySingle(
				QQ::Equal(QQN::Receipt()->ReceiptNumber, $strReceiptNumber)
			);
		}
			
		/**
		 * Load an array of Receipt objects,
		 * by FromCompanyId Index(es)
		 * @param integer $intFromCompanyId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Receipt[]
		*/
		public static function LoadArrayByFromCompanyId($intFromCompanyId, $objOptionalClauses = null) {
			// Call Receipt::QueryArray to perform the LoadArrayByFromCompanyId query
			try {
				return Receipt::QueryArray(
					QQ::Equal(QQN::Receipt()->FromCompanyId, $intFromCompanyId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count Receipts
		 * by FromCompanyId Index(es)
		 * @param integer $intFromCompanyId
		 * @return int
		*/
		public static function CountByFromCompanyId($intFromCompanyId) {
			// Call Receipt::QueryCount to perform the CountByFromCompanyId query
			return Receipt::QueryCount(
				QQ::Equal(QQN::Receipt()->FromCompanyId, $intFromCompanyId)
			);
		}
			
		/**
		 * Load an array of Receipt objects,
		 * by FromContactId Index(es)
		 * @param integer $intFromContactId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Receipt[]
		*/
		public static function LoadArrayByFromContactId($intFromContactId, $objOptionalClauses = null) {
			// Call Receipt::QueryArray to perform the LoadArrayByFromContactId query
			try {
				return Receipt::QueryArray(
					QQ::Equal(QQN::Receipt()->FromContactId, $intFromContactId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count Receipts
		 * by FromContactId Index(es)
		 * @param integer $intFromContactId
		 * @return int
		*/
		public static function CountByFromContactId($intFromContactId) {
			// Call Receipt::QueryCount to perform the CountByFromContactId query
			return Receipt::QueryCount(
				QQ::Equal(QQN::Receipt()->FromContactId, $intFromContactId)
			);
		}
			
		/**
		 * Load an array of Receipt objects,
		 * by ToContactId Index(es)
		 * @param integer $intToContactId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Receipt[]
		*/
		public static function LoadArrayByToContactId($intToContactId, $objOptionalClauses = null) {
			// Call Receipt::QueryArray to perform the LoadArrayByToContactId query
			try {
				return Receipt::QueryArray(
					QQ::Equal(QQN::Receipt()->ToContactId, $intToContactId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count Receipts
		 * by ToContactId Index(es)
		 * @param integer $intToContactId
		 * @return int
		*/
		public static function CountByToContactId($intToContactId) {
			// Call Receipt::QueryCount to perform the CountByToContactId query
			return Receipt::QueryCount(
				QQ::Equal(QQN::Receipt()->ToContactId, $intToContactId)
			);
		}
			
		/**
		 * Load an array of Receipt objects,
		 * by ToAddressId Index(es)
		 * @param integer $intToAddressId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Receipt[]
		*/
		public static function LoadArrayByToAddressId($intToAddressId, $objOptionalClauses = null) {
			// Call Receipt::QueryArray to perform the LoadArrayByToAddressId query
			try {
				return Receipt::QueryArray(
					QQ::Equal(QQN::Receipt()->ToAddressId, $intToAddressId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count Receipts
		 * by ToAddressId Index(es)
		 * @param integer $intToAddressId
		 * @return int
		*/
		public static function CountByToAddressId($intToAddressId) {
			// Call Receipt::QueryCount to perform the CountByToAddressId query
			return Receipt::QueryCount(
				QQ::Equal(QQN::Receipt()->ToAddressId, $intToAddressId)
			);
		}
			
		/**
		 * Load an array of Receipt objects,
		 * by CreatedBy Index(es)
		 * @param integer $intCreatedBy
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Receipt[]
		*/
		public static function LoadArrayByCreatedBy($intCreatedBy, $objOptionalClauses = null) {
			// Call Receipt::QueryArray to perform the LoadArrayByCreatedBy query
			try {
				return Receipt::QueryArray(
					QQ::Equal(QQN::Receipt()->CreatedBy, $intCreatedBy),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count Receipts
		 * by CreatedBy Index(es)
		 * @param integer $intCreatedBy
		 * @return int
		*/
		public static function CountByCreatedBy($intCreatedBy) {
			// Call Receipt::QueryCount to perform the CountByCreatedBy query
			return Receipt::QueryCount(
				QQ::Equal(QQN::Receipt()->CreatedBy, $intCreatedBy)
			);
		}
			
		/**
		 * Load an array of Receipt objects,
		 * by ModifiedBy Index(es)
		 * @param integer $intModifiedBy
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Receipt[]
		*/
		public static function LoadArrayByModifiedBy($intModifiedBy, $objOptionalClauses = null) {
			// Call Receipt::QueryArray to perform the LoadArrayByModifiedBy query
			try {
				return Receipt::QueryArray(
					QQ::Equal(QQN::Receipt()->ModifiedBy, $intModifiedBy),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count Receipts
		 * by ModifiedBy Index(es)
		 * @param integer $intModifiedBy
		 * @return int
		*/
		public static function CountByModifiedBy($intModifiedBy) {
			// Call Receipt::QueryCount to perform the CountByModifiedBy query
			return Receipt::QueryCount(
				QQ::Equal(QQN::Receipt()->ModifiedBy, $intModifiedBy)
			);
		}



		////////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Array via Many to Many)
		////////////////////////////////////////////////////



		//////////////////
		// SAVE AND DELETE
		//////////////////

		/**
		 * Save this Receipt
		 * @param bool $blnForceInsert
		 * @param bool $blnForceUpdate
		 * @return int
		*/
		public function Save($blnForceInsert = false, $blnForceUpdate = false) {
			// Get the Database Object for this Class
			$objDatabase = Receipt::GetDatabase();

			$mixToReturn = null;

			try {
				if ((!$this->__blnRestored) || ($blnForceInsert)) {
					// Perform an INSERT query
					$objDatabase->NonQuery('
						INSERT INTO `receipt` (
							`transaction_id`,
							`from_company_id`,
							`from_contact_id`,
							`to_contact_id`,
							`to_address_id`,
							`receipt_number`,
							`due_date`,
							`receipt_date`,
							`received_flag`,
							`created_by`,
							`creation_date`,
							`modified_by`
						) VALUES (
							' . $objDatabase->SqlVariable($this->intTransactionId) . ',
							' . $objDatabase->SqlVariable($this->intFromCompanyId) . ',
							' . $objDatabase->SqlVariable($this->intFromContactId) . ',
							' . $objDatabase->SqlVariable($this->intToContactId) . ',
							' . $objDatabase->SqlVariable($this->intToAddressId) . ',
							' . $objDatabase->SqlVariable($this->strReceiptNumber) . ',
							' . $objDatabase->SqlVariable($this->dttDueDate) . ',
							' . $objDatabase->SqlVariable($this->dttReceiptDate) . ',
							' . $objDatabase->SqlVariable($this->blnReceivedFlag) . ',
							' . $objDatabase->SqlVariable($this->intCreatedBy) . ',
							' . $objDatabase->SqlVariable($this->dttCreationDate) . ',
							' . $objDatabase->SqlVariable($this->intModifiedBy) . '
						)
					');

					// Update Identity column and return its value
					$mixToReturn = $this->intReceiptId = $objDatabase->InsertId('receipt', 'receipt_id');
				} else {
					// Perform an UPDATE query

					// First checking for Optimistic Locking constraints (if applicable)
					if (!$blnForceUpdate) {
						// Perform the Optimistic Locking check
						$objResult = $objDatabase->Query('
							SELECT
								`modified_date`
							FROM
								`receipt`
							WHERE
								`receipt_id` = ' . $objDatabase->SqlVariable($this->intReceiptId) . '
						');
						
						$objRow = $objResult->FetchArray();
						if ($objRow[0] != $this->strModifiedDate)
							throw new QExtendedOptimisticLockingException('Receipt', $this->intReceiptId);
					}

					// Perform the UPDATE query
					$objDatabase->NonQuery('
						UPDATE
							`receipt`
						SET
							`transaction_id` = ' . $objDatabase->SqlVariable($this->intTransactionId) . ',
							`from_company_id` = ' . $objDatabase->SqlVariable($this->intFromCompanyId) . ',
							`from_contact_id` = ' . $objDatabase->SqlVariable($this->intFromContactId) . ',
							`to_contact_id` = ' . $objDatabase->SqlVariable($this->intToContactId) . ',
							`to_address_id` = ' . $objDatabase->SqlVariable($this->intToAddressId) . ',
							`receipt_number` = ' . $objDatabase->SqlVariable($this->strReceiptNumber) . ',
							`due_date` = ' . $objDatabase->SqlVariable($this->dttDueDate) . ',
							`receipt_date` = ' . $objDatabase->SqlVariable($this->dttReceiptDate) . ',
							`received_flag` = ' . $objDatabase->SqlVariable($this->blnReceivedFlag) . ',
							`created_by` = ' . $objDatabase->SqlVariable($this->intCreatedBy) . ',
							`creation_date` = ' . $objDatabase->SqlVariable($this->dttCreationDate) . ',
							`modified_by` = ' . $objDatabase->SqlVariable($this->intModifiedBy) . '
						WHERE
							`receipt_id` = ' . $objDatabase->SqlVariable($this->intReceiptId) . '
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
					`receipt`
				WHERE
					`receipt_id` = ' . $objDatabase->SqlVariable($this->intReceiptId) . '
			');
						
			$objRow = $objResult->FetchArray();
			$this->strModifiedDate = $objRow[0];

			// Return 
			return $mixToReturn;
		}

				/**
		 * Delete this Receipt
		 * @return void
		*/
		public function Delete() {
			if ((is_null($this->intReceiptId)))
				throw new QUndefinedPrimaryKeyException('Cannot delete this Receipt with an unset primary key.');

			// Get the Database Object for this Class
			$objDatabase = Receipt::GetDatabase();


			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`receipt`
				WHERE
					`receipt_id` = ' . $objDatabase->SqlVariable($this->intReceiptId) . '');
		}

		/**
		 * Delete all Receipts
		 * @return void
		*/
		public static function DeleteAll() {
			// Get the Database Object for this Class
			$objDatabase = Receipt::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				DELETE FROM
					`receipt`');
		}

		/**
		 * Truncate receipt table
		 * @return void
		*/
		public static function Truncate() {
			// Get the Database Object for this Class
			$objDatabase = Receipt::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				TRUNCATE `receipt`');
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
				case 'ReceiptId':
					/**
					 * Gets the value for intReceiptId (Read-Only PK)
					 * @return integer
					 */
					return $this->intReceiptId;

				case 'TransactionId':
					/**
					 * Gets the value for intTransactionId (Unique)
					 * @return integer
					 */
					return $this->intTransactionId;

				case 'FromCompanyId':
					/**
					 * Gets the value for intFromCompanyId (Not Null)
					 * @return integer
					 */
					return $this->intFromCompanyId;

				case 'FromContactId':
					/**
					 * Gets the value for intFromContactId (Not Null)
					 * @return integer
					 */
					return $this->intFromContactId;

				case 'ToContactId':
					/**
					 * Gets the value for intToContactId (Not Null)
					 * @return integer
					 */
					return $this->intToContactId;

				case 'ToAddressId':
					/**
					 * Gets the value for intToAddressId (Not Null)
					 * @return integer
					 */
					return $this->intToAddressId;

				case 'ReceiptNumber':
					/**
					 * Gets the value for strReceiptNumber (Unique)
					 * @return string
					 */
					return $this->strReceiptNumber;

				case 'DueDate':
					/**
					 * Gets the value for dttDueDate 
					 * @return QDateTime
					 */
					return $this->dttDueDate;

				case 'ReceiptDate':
					/**
					 * Gets the value for dttReceiptDate 
					 * @return QDateTime
					 */
					return $this->dttReceiptDate;

				case 'ReceivedFlag':
					/**
					 * Gets the value for blnReceivedFlag 
					 * @return boolean
					 */
					return $this->blnReceivedFlag;

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
				case 'Transaction':
					/**
					 * Gets the value for the Transaction object referenced by intTransactionId (Unique)
					 * @return Transaction
					 */
					try {
						if ((!$this->objTransaction) && (!is_null($this->intTransactionId)))
							$this->objTransaction = Transaction::Load($this->intTransactionId);
						return $this->objTransaction;
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'FromCompany':
					/**
					 * Gets the value for the Company object referenced by intFromCompanyId (Not Null)
					 * @return Company
					 */
					try {
						if ((!$this->objFromCompany) && (!is_null($this->intFromCompanyId)))
							$this->objFromCompany = Company::Load($this->intFromCompanyId);
						return $this->objFromCompany;
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'FromContact':
					/**
					 * Gets the value for the Contact object referenced by intFromContactId (Not Null)
					 * @return Contact
					 */
					try {
						if ((!$this->objFromContact) && (!is_null($this->intFromContactId)))
							$this->objFromContact = Contact::Load($this->intFromContactId);
						return $this->objFromContact;
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'ToContact':
					/**
					 * Gets the value for the Contact object referenced by intToContactId (Not Null)
					 * @return Contact
					 */
					try {
						if ((!$this->objToContact) && (!is_null($this->intToContactId)))
							$this->objToContact = Contact::Load($this->intToContactId);
						return $this->objToContact;
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'ToAddress':
					/**
					 * Gets the value for the Address object referenced by intToAddressId (Not Null)
					 * @return Address
					 */
					try {
						if ((!$this->objToAddress) && (!is_null($this->intToAddressId)))
							$this->objToAddress = Address::Load($this->intToAddressId);
						return $this->objToAddress;
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
				case 'TransactionId':
					/**
					 * Sets the value for intTransactionId (Unique)
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						$this->objTransaction = null;
						return ($this->intTransactionId = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'FromCompanyId':
					/**
					 * Sets the value for intFromCompanyId (Not Null)
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						$this->objFromCompany = null;
						return ($this->intFromCompanyId = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'FromContactId':
					/**
					 * Sets the value for intFromContactId (Not Null)
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						$this->objFromContact = null;
						return ($this->intFromContactId = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'ToContactId':
					/**
					 * Sets the value for intToContactId (Not Null)
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						$this->objToContact = null;
						return ($this->intToContactId = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'ToAddressId':
					/**
					 * Sets the value for intToAddressId (Not Null)
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						$this->objToAddress = null;
						return ($this->intToAddressId = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'ReceiptNumber':
					/**
					 * Sets the value for strReceiptNumber (Unique)
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strReceiptNumber = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'DueDate':
					/**
					 * Sets the value for dttDueDate 
					 * @param QDateTime $mixValue
					 * @return QDateTime
					 */
					try {
						return ($this->dttDueDate = QType::Cast($mixValue, QType::DateTime));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'ReceiptDate':
					/**
					 * Sets the value for dttReceiptDate 
					 * @param QDateTime $mixValue
					 * @return QDateTime
					 */
					try {
						return ($this->dttReceiptDate = QType::Cast($mixValue, QType::DateTime));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'ReceivedFlag':
					/**
					 * Sets the value for blnReceivedFlag 
					 * @param boolean $mixValue
					 * @return boolean
					 */
					try {
						return ($this->blnReceivedFlag = QType::Cast($mixValue, QType::Boolean));
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
				case 'Transaction':
					/**
					 * Sets the value for the Transaction object referenced by intTransactionId (Unique)
					 * @param Transaction $mixValue
					 * @return Transaction
					 */
					if (is_null($mixValue)) {
						$this->intTransactionId = null;
						$this->objTransaction = null;
						return null;
					} else {
						// Make sure $mixValue actually is a Transaction object
						try {
							$mixValue = QType::Cast($mixValue, 'Transaction');
						} catch (QInvalidCastException $objExc) {
							$objExc->IncrementOffset();
							throw $objExc;
						} 

						// Make sure $mixValue is a SAVED Transaction object
						if (is_null($mixValue->TransactionId))
							throw new QCallerException('Unable to set an unsaved Transaction for this Receipt');

						// Update Local Member Variables
						$this->objTransaction = $mixValue;
						$this->intTransactionId = $mixValue->TransactionId;

						// Return $mixValue
						return $mixValue;
					}
					break;

				case 'FromCompany':
					/**
					 * Sets the value for the Company object referenced by intFromCompanyId (Not Null)
					 * @param Company $mixValue
					 * @return Company
					 */
					if (is_null($mixValue)) {
						$this->intFromCompanyId = null;
						$this->objFromCompany = null;
						return null;
					} else {
						// Make sure $mixValue actually is a Company object
						try {
							$mixValue = QType::Cast($mixValue, 'Company');
						} catch (QInvalidCastException $objExc) {
							$objExc->IncrementOffset();
							throw $objExc;
						} 

						// Make sure $mixValue is a SAVED Company object
						if (is_null($mixValue->CompanyId))
							throw new QCallerException('Unable to set an unsaved FromCompany for this Receipt');

						// Update Local Member Variables
						$this->objFromCompany = $mixValue;
						$this->intFromCompanyId = $mixValue->CompanyId;

						// Return $mixValue
						return $mixValue;
					}
					break;

				case 'FromContact':
					/**
					 * Sets the value for the Contact object referenced by intFromContactId (Not Null)
					 * @param Contact $mixValue
					 * @return Contact
					 */
					if (is_null($mixValue)) {
						$this->intFromContactId = null;
						$this->objFromContact = null;
						return null;
					} else {
						// Make sure $mixValue actually is a Contact object
						try {
							$mixValue = QType::Cast($mixValue, 'Contact');
						} catch (QInvalidCastException $objExc) {
							$objExc->IncrementOffset();
							throw $objExc;
						} 

						// Make sure $mixValue is a SAVED Contact object
						if (is_null($mixValue->ContactId))
							throw new QCallerException('Unable to set an unsaved FromContact for this Receipt');

						// Update Local Member Variables
						$this->objFromContact = $mixValue;
						$this->intFromContactId = $mixValue->ContactId;

						// Return $mixValue
						return $mixValue;
					}
					break;

				case 'ToContact':
					/**
					 * Sets the value for the Contact object referenced by intToContactId (Not Null)
					 * @param Contact $mixValue
					 * @return Contact
					 */
					if (is_null($mixValue)) {
						$this->intToContactId = null;
						$this->objToContact = null;
						return null;
					} else {
						// Make sure $mixValue actually is a Contact object
						try {
							$mixValue = QType::Cast($mixValue, 'Contact');
						} catch (QInvalidCastException $objExc) {
							$objExc->IncrementOffset();
							throw $objExc;
						} 

						// Make sure $mixValue is a SAVED Contact object
						if (is_null($mixValue->ContactId))
							throw new QCallerException('Unable to set an unsaved ToContact for this Receipt');

						// Update Local Member Variables
						$this->objToContact = $mixValue;
						$this->intToContactId = $mixValue->ContactId;

						// Return $mixValue
						return $mixValue;
					}
					break;

				case 'ToAddress':
					/**
					 * Sets the value for the Address object referenced by intToAddressId (Not Null)
					 * @param Address $mixValue
					 * @return Address
					 */
					if (is_null($mixValue)) {
						$this->intToAddressId = null;
						$this->objToAddress = null;
						return null;
					} else {
						// Make sure $mixValue actually is a Address object
						try {
							$mixValue = QType::Cast($mixValue, 'Address');
						} catch (QInvalidCastException $objExc) {
							$objExc->IncrementOffset();
							throw $objExc;
						} 

						// Make sure $mixValue is a SAVED Address object
						if (is_null($mixValue->AddressId))
							throw new QCallerException('Unable to set an unsaved ToAddress for this Receipt');

						// Update Local Member Variables
						$this->objToAddress = $mixValue;
						$this->intToAddressId = $mixValue->AddressId;

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
							throw new QCallerException('Unable to set an unsaved CreatedByObject for this Receipt');

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
							throw new QCallerException('Unable to set an unsaved ModifiedByObject for this Receipt');

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
		 * Protected member variable that maps to the database PK Identity column receipt.receipt_id
		 * @var integer intReceiptId
		 */
		protected $intReceiptId;
		const ReceiptIdDefault = null;


		/**
		 * Protected member variable that maps to the database column receipt.transaction_id
		 * @var integer intTransactionId
		 */
		protected $intTransactionId;
		const TransactionIdDefault = null;


		/**
		 * Protected member variable that maps to the database column receipt.from_company_id
		 * @var integer intFromCompanyId
		 */
		protected $intFromCompanyId;
		const FromCompanyIdDefault = null;


		/**
		 * Protected member variable that maps to the database column receipt.from_contact_id
		 * @var integer intFromContactId
		 */
		protected $intFromContactId;
		const FromContactIdDefault = null;


		/**
		 * Protected member variable that maps to the database column receipt.to_contact_id
		 * @var integer intToContactId
		 */
		protected $intToContactId;
		const ToContactIdDefault = null;


		/**
		 * Protected member variable that maps to the database column receipt.to_address_id
		 * @var integer intToAddressId
		 */
		protected $intToAddressId;
		const ToAddressIdDefault = null;


		/**
		 * Protected member variable that maps to the database column receipt.receipt_number
		 * @var string strReceiptNumber
		 */
		protected $strReceiptNumber;
		const ReceiptNumberMaxLength = 50;
		const ReceiptNumberDefault = null;


		/**
		 * Protected member variable that maps to the database column receipt.due_date
		 * @var QDateTime dttDueDate
		 */
		protected $dttDueDate;
		const DueDateDefault = null;


		/**
		 * Protected member variable that maps to the database column receipt.receipt_date
		 * @var QDateTime dttReceiptDate
		 */
		protected $dttReceiptDate;
		const ReceiptDateDefault = null;


		/**
		 * Protected member variable that maps to the database column receipt.received_flag
		 * @var boolean blnReceivedFlag
		 */
		protected $blnReceivedFlag;
		const ReceivedFlagDefault = null;


		/**
		 * Protected member variable that maps to the database column receipt.created_by
		 * @var integer intCreatedBy
		 */
		protected $intCreatedBy;
		const CreatedByDefault = null;


		/**
		 * Protected member variable that maps to the database column receipt.creation_date
		 * @var QDateTime dttCreationDate
		 */
		protected $dttCreationDate;
		const CreationDateDefault = null;


		/**
		 * Protected member variable that maps to the database column receipt.modified_by
		 * @var integer intModifiedBy
		 */
		protected $intModifiedBy;
		const ModifiedByDefault = null;


		/**
		 * Protected member variable that maps to the database column receipt.modified_date
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
		 * in the database column receipt.transaction_id.
		 *
		 * NOTE: Always use the Transaction property getter to correctly retrieve this Transaction object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var Transaction objTransaction
		 */
		protected $objTransaction;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column receipt.from_company_id.
		 *
		 * NOTE: Always use the FromCompany property getter to correctly retrieve this Company object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var Company objFromCompany
		 */
		protected $objFromCompany;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column receipt.from_contact_id.
		 *
		 * NOTE: Always use the FromContact property getter to correctly retrieve this Contact object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var Contact objFromContact
		 */
		protected $objFromContact;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column receipt.to_contact_id.
		 *
		 * NOTE: Always use the ToContact property getter to correctly retrieve this Contact object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var Contact objToContact
		 */
		protected $objToContact;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column receipt.to_address_id.
		 *
		 * NOTE: Always use the ToAddress property getter to correctly retrieve this Address object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var Address objToAddress
		 */
		protected $objToAddress;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column receipt.created_by.
		 *
		 * NOTE: Always use the CreatedByObject property getter to correctly retrieve this UserAccount object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var UserAccount objCreatedByObject
		 */
		protected $objCreatedByObject;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column receipt.modified_by.
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
				$objQueryExpansion = new QQueryExpansion('Receipt', 'receipt', $objExpansionMap);
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
				$objQueryExpansion->AddFromItem(sprintf('LEFT JOIN `receipt` AS `%s__%s` ON `%s`.`%s` = `%s__%s`.`receipt_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias, $strParentAlias, $strAlias));

				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`receipt_id` AS `%s__%s__receipt_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`transaction_id` AS `%s__%s__transaction_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`from_company_id` AS `%s__%s__from_company_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`from_contact_id` AS `%s__%s__from_contact_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`to_contact_id` AS `%s__%s__to_contact_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`to_address_id` AS `%s__%s__to_address_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`receipt_number` AS `%s__%s__receipt_number`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`due_date` AS `%s__%s__due_date`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`receipt_date` AS `%s__%s__receipt_date`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`received_flag` AS `%s__%s__received_flag`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`created_by` AS `%s__%s__created_by`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`creation_date` AS `%s__%s__creation_date`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`modified_by` AS `%s__%s__modified_by`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`modified_date` AS `%s__%s__modified_date`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));

				$strParentAlias = $strParentAlias . '__' . $strAlias;
			}

			if (is_array($objExpansionMap))
				foreach ($objExpansionMap as $strKey=>$objValue) {
					switch ($strKey) {
						case 'transaction_id':
							try {
								Transaction::ExpandQuery($strParentAlias, $strKey, $objValue, $objQueryExpansion);
								break;
							} catch (QCallerException $objExc) {
								$objExc->IncrementOffset();
								throw $objExc;
							}
						case 'from_company_id':
							try {
								Company::ExpandQuery($strParentAlias, $strKey, $objValue, $objQueryExpansion);
								break;
							} catch (QCallerException $objExc) {
								$objExc->IncrementOffset();
								throw $objExc;
							}
						case 'from_contact_id':
							try {
								Contact::ExpandQuery($strParentAlias, $strKey, $objValue, $objQueryExpansion);
								break;
							} catch (QCallerException $objExc) {
								$objExc->IncrementOffset();
								throw $objExc;
							}
						case 'to_contact_id':
							try {
								Contact::ExpandQuery($strParentAlias, $strKey, $objValue, $objQueryExpansion);
								break;
							} catch (QCallerException $objExc) {
								$objExc->IncrementOffset();
								throw $objExc;
							}
						case 'to_address_id':
							try {
								Address::ExpandQuery($strParentAlias, $strKey, $objValue, $objQueryExpansion);
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
		const ExpandTransaction = 'transaction_id';
		const ExpandFromCompany = 'from_company_id';
		const ExpandFromContact = 'from_contact_id';
		const ExpandToContact = 'to_contact_id';
		const ExpandToAddress = 'to_address_id';
		const ExpandCreatedByObject = 'created_by';
		const ExpandModifiedByObject = 'modified_by';




		////////////////////////////////////////
		// METHODS for WEB SERVICES
		////////////////////////////////////////

		public static function GetSoapComplexTypeXml() {
			$strToReturn = '<complexType name="Receipt"><sequence>';
			$strToReturn .= '<element name="ReceiptId" type="xsd:int"/>';
			$strToReturn .= '<element name="Transaction" type="xsd1:Transaction"/>';
			$strToReturn .= '<element name="FromCompany" type="xsd1:Company"/>';
			$strToReturn .= '<element name="FromContact" type="xsd1:Contact"/>';
			$strToReturn .= '<element name="ToContact" type="xsd1:Contact"/>';
			$strToReturn .= '<element name="ToAddress" type="xsd1:Address"/>';
			$strToReturn .= '<element name="ReceiptNumber" type="xsd:string"/>';
			$strToReturn .= '<element name="DueDate" type="xsd:dateTime"/>';
			$strToReturn .= '<element name="ReceiptDate" type="xsd:dateTime"/>';
			$strToReturn .= '<element name="ReceivedFlag" type="xsd:boolean"/>';
			$strToReturn .= '<element name="CreatedByObject" type="xsd1:UserAccount"/>';
			$strToReturn .= '<element name="CreationDate" type="xsd:dateTime"/>';
			$strToReturn .= '<element name="ModifiedByObject" type="xsd1:UserAccount"/>';
			$strToReturn .= '<element name="ModifiedDate" type="xsd:string"/>';
			$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
			$strToReturn .= '</sequence></complexType>';
			return $strToReturn;
		}

		public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
			if (!array_key_exists('Receipt', $strComplexTypeArray)) {
				$strComplexTypeArray['Receipt'] = Receipt::GetSoapComplexTypeXml();
				Transaction::AlterSoapComplexTypeArray($strComplexTypeArray);
				Company::AlterSoapComplexTypeArray($strComplexTypeArray);
				Contact::AlterSoapComplexTypeArray($strComplexTypeArray);
				Contact::AlterSoapComplexTypeArray($strComplexTypeArray);
				Address::AlterSoapComplexTypeArray($strComplexTypeArray);
				UserAccount::AlterSoapComplexTypeArray($strComplexTypeArray);
				UserAccount::AlterSoapComplexTypeArray($strComplexTypeArray);
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, Receipt::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new Receipt();
			if (property_exists($objSoapObject, 'ReceiptId'))
				$objToReturn->intReceiptId = $objSoapObject->ReceiptId;
			if ((property_exists($objSoapObject, 'Transaction')) &&
				($objSoapObject->Transaction))
				$objToReturn->Transaction = Transaction::GetObjectFromSoapObject($objSoapObject->Transaction);
			if ((property_exists($objSoapObject, 'FromCompany')) &&
				($objSoapObject->FromCompany))
				$objToReturn->FromCompany = Company::GetObjectFromSoapObject($objSoapObject->FromCompany);
			if ((property_exists($objSoapObject, 'FromContact')) &&
				($objSoapObject->FromContact))
				$objToReturn->FromContact = Contact::GetObjectFromSoapObject($objSoapObject->FromContact);
			if ((property_exists($objSoapObject, 'ToContact')) &&
				($objSoapObject->ToContact))
				$objToReturn->ToContact = Contact::GetObjectFromSoapObject($objSoapObject->ToContact);
			if ((property_exists($objSoapObject, 'ToAddress')) &&
				($objSoapObject->ToAddress))
				$objToReturn->ToAddress = Address::GetObjectFromSoapObject($objSoapObject->ToAddress);
			if (property_exists($objSoapObject, 'ReceiptNumber'))
				$objToReturn->strReceiptNumber = $objSoapObject->ReceiptNumber;
			if (property_exists($objSoapObject, 'DueDate'))
				$objToReturn->dttDueDate = new QDateTime($objSoapObject->DueDate);
			if (property_exists($objSoapObject, 'ReceiptDate'))
				$objToReturn->dttReceiptDate = new QDateTime($objSoapObject->ReceiptDate);
			if (property_exists($objSoapObject, 'ReceivedFlag'))
				$objToReturn->blnReceivedFlag = $objSoapObject->ReceivedFlag;
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
				array_push($objArrayToReturn, Receipt::GetSoapObjectFromObject($objObject, true));

			return unserialize(serialize($objArrayToReturn));
		}

		public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
			if ($objObject->objTransaction)
				$objObject->objTransaction = Transaction::GetSoapObjectFromObject($objObject->objTransaction, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intTransactionId = null;
			if ($objObject->objFromCompany)
				$objObject->objFromCompany = Company::GetSoapObjectFromObject($objObject->objFromCompany, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intFromCompanyId = null;
			if ($objObject->objFromContact)
				$objObject->objFromContact = Contact::GetSoapObjectFromObject($objObject->objFromContact, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intFromContactId = null;
			if ($objObject->objToContact)
				$objObject->objToContact = Contact::GetSoapObjectFromObject($objObject->objToContact, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intToContactId = null;
			if ($objObject->objToAddress)
				$objObject->objToAddress = Address::GetSoapObjectFromObject($objObject->objToAddress, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intToAddressId = null;
			if ($objObject->dttDueDate)
				$objObject->dttDueDate = $objObject->dttDueDate->__toString(QDateTime::FormatSoap);
			if ($objObject->dttReceiptDate)
				$objObject->dttReceiptDate = $objObject->dttReceiptDate->__toString(QDateTime::FormatSoap);
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

	class QQNodeReceipt extends QQNode {
		protected $strTableName = 'receipt';
		protected $strPrimaryKey = 'receipt_id';
		protected $strClassName = 'Receipt';
		public function __get($strName) {
			switch ($strName) {
				case 'ReceiptId':
					return new QQNode('receipt_id', 'integer', $this);
				case 'TransactionId':
					return new QQNode('transaction_id', 'integer', $this);
				case 'Transaction':
					return new QQNodeTransaction('transaction_id', 'integer', $this);
				case 'FromCompanyId':
					return new QQNode('from_company_id', 'integer', $this);
				case 'FromCompany':
					return new QQNodeCompany('from_company_id', 'integer', $this);
				case 'FromContactId':
					return new QQNode('from_contact_id', 'integer', $this);
				case 'FromContact':
					return new QQNodeContact('from_contact_id', 'integer', $this);
				case 'ToContactId':
					return new QQNode('to_contact_id', 'integer', $this);
				case 'ToContact':
					return new QQNodeContact('to_contact_id', 'integer', $this);
				case 'ToAddressId':
					return new QQNode('to_address_id', 'integer', $this);
				case 'ToAddress':
					return new QQNodeAddress('to_address_id', 'integer', $this);
				case 'ReceiptNumber':
					return new QQNode('receipt_number', 'string', $this);
				case 'DueDate':
					return new QQNode('due_date', 'QDateTime', $this);
				case 'ReceiptDate':
					return new QQNode('receipt_date', 'QDateTime', $this);
				case 'ReceivedFlag':
					return new QQNode('received_flag', 'boolean', $this);
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
					return new QQNode('receipt_id', 'integer', $this);
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

	class QQReverseReferenceNodeReceipt extends QQReverseReferenceNode {
		protected $strTableName = 'receipt';
		protected $strPrimaryKey = 'receipt_id';
		protected $strClassName = 'Receipt';
		public function __get($strName) {
			switch ($strName) {
				case 'ReceiptId':
					return new QQNode('receipt_id', 'integer', $this);
				case 'TransactionId':
					return new QQNode('transaction_id', 'integer', $this);
				case 'Transaction':
					return new QQNodeTransaction('transaction_id', 'integer', $this);
				case 'FromCompanyId':
					return new QQNode('from_company_id', 'integer', $this);
				case 'FromCompany':
					return new QQNodeCompany('from_company_id', 'integer', $this);
				case 'FromContactId':
					return new QQNode('from_contact_id', 'integer', $this);
				case 'FromContact':
					return new QQNodeContact('from_contact_id', 'integer', $this);
				case 'ToContactId':
					return new QQNode('to_contact_id', 'integer', $this);
				case 'ToContact':
					return new QQNodeContact('to_contact_id', 'integer', $this);
				case 'ToAddressId':
					return new QQNode('to_address_id', 'integer', $this);
				case 'ToAddress':
					return new QQNodeAddress('to_address_id', 'integer', $this);
				case 'ReceiptNumber':
					return new QQNode('receipt_number', 'string', $this);
				case 'DueDate':
					return new QQNode('due_date', 'QDateTime', $this);
				case 'ReceiptDate':
					return new QQNode('receipt_date', 'QDateTime', $this);
				case 'ReceivedFlag':
					return new QQNode('received_flag', 'boolean', $this);
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
					return new QQNode('receipt_id', 'integer', $this);
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