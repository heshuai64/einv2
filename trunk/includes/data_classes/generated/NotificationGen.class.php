<?php
	/**
	 * The abstract NotificationGen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the Notification subclass which
	 * extends this NotificationGen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the Notification class.
	 * 
	 * @package My Application
	 * @subpackage GeneratedDataObjects
	 * 
	 */
	class NotificationGen extends QBaseClass {
		///////////////////////////////
		// COMMON LOAD METHODS
		///////////////////////////////

		/**
		 * Load a Notification from PK Info
		 * @param integer $intNotificationId
		 * @return Notification
		 */
		public static function Load($intNotificationId) {
			// Use QuerySingle to Perform the Query
			return Notification::QuerySingle(
				QQ::Equal(QQN::Notification()->NotificationId, $intNotificationId)
			);
		}

		/**
		 * Load all Notifications
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Notification[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			// Call Notification::QueryArray to perform the LoadAll query
			try {
				return Notification::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all Notifications
		 * @return int
		 */
		public static function CountAll() {
			// Call Notification::QueryCount to perform the CountAll query
			return Notification::QueryCount(QQ::All());
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
			$objDatabase = Notification::GetDatabase();

			// Create/Build out the QueryBuilder object with Notification-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, 'notification');
			Notification::GetSelectFields($objQueryBuilder);
			$objQueryBuilder->AddFromItem('`notification` AS `notification`');

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
		 * Static Qcodo Query method to query for a single Notification object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return Notification the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Notification::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query, Get the First Row, and Instantiate a new Notification object
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return Notification::InstantiateDbRow($objDbResult->GetNextRow());
		}

		/**
		 * Static Qcodo Query method to query for an array of Notification objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return Notification[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Notification::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return Notification::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
		}

		/**
		 * Static Qcodo Query method to query for a count of Notification objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Notification::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
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
			$objDatabase = Notification::GetDatabase();

			// Lookup the QCache for This Query Statement
			$objCache = new QCache('query', 'notification_' . serialize($strConditions));
			if (!($strQuery = $objCache->GetData())) {
				// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with Notification-specific fields
				$objQueryBuilder = new QQueryBuilder($objDatabase);
				Notification::GetSelectFields($objQueryBuilder);
				Notification::GetFromFields($objQueryBuilder);

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
			return Notification::InstantiateDbResult($objDbResult);
		}*/

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this Notification
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null) {
			if ($strPrefix) {
				$strTableName = '`' . $strPrefix . '`';
				$strAliasPrefix = '`' . $strPrefix . '__';
			} else {
				$strTableName = '`notification`';
				$strAliasPrefix = '`';
			}

			$objBuilder->AddSelectItem($strTableName . '.`notification_id` AS ' . $strAliasPrefix . 'notification_id`');
			$objBuilder->AddSelectItem($strTableName . '.`short_description` AS ' . $strAliasPrefix . 'short_description`');
			$objBuilder->AddSelectItem($strTableName . '.`long_description` AS ' . $strAliasPrefix . 'long_description`');
			$objBuilder->AddSelectItem($strTableName . '.`criteria` AS ' . $strAliasPrefix . 'criteria`');
			$objBuilder->AddSelectItem($strTableName . '.`frequency` AS ' . $strAliasPrefix . 'frequency`');
			$objBuilder->AddSelectItem($strTableName . '.`enabled_flag` AS ' . $strAliasPrefix . 'enabled_flag`');
			$objBuilder->AddSelectItem($strTableName . '.`created_by` AS ' . $strAliasPrefix . 'created_by`');
			$objBuilder->AddSelectItem($strTableName . '.`creation_date` AS ' . $strAliasPrefix . 'creation_date`');
			$objBuilder->AddSelectItem($strTableName . '.`modified_by` AS ' . $strAliasPrefix . 'modified_by`');
			$objBuilder->AddSelectItem($strTableName . '.`modified_date` AS ' . $strAliasPrefix . 'modified_date`');
		}



		///////////////////////////////
		// INSTANTIATION-RELATED METHODS
		///////////////////////////////

		/**
		 * Instantiate a Notification from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this Notification::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param DatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @return Notification
		*/
		public static function InstantiateDbRow($objDbRow, $strAliasPrefix = null, $strExpandAsArrayNodes = null, $objPreviousItem = null) {
			// If blank row, return null
			if (!$objDbRow)
				return null;

			// See if we're doing an array expansion on the previous item
			if (($strExpandAsArrayNodes) && ($objPreviousItem) &&
				($objPreviousItem->intNotificationId == $objDbRow->GetColumn($strAliasPrefix . 'notification_id', 'Integer'))) {

				// We are.  Now, prepare to check for ExpandAsArray clauses
				$blnExpandedViaArray = false;
				if (!$strAliasPrefix)
					$strAliasPrefix = 'notification__';


				if ((array_key_exists($strAliasPrefix . 'notificationuseraccount__notification_user_account_id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'notificationuseraccount__notification_user_account_id')))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objNotificationUserAccountArray)) {
						$objPreviousChildItem = $objPreviousItem->_objNotificationUserAccountArray[$intPreviousChildItemCount - 1];
						$objChildItem = NotificationUserAccount::InstantiateDbRow($objDbRow, $strAliasPrefix . 'notificationuseraccount__', $strExpandAsArrayNodes, $objPreviousChildItem);
						if ($objChildItem)
							array_push($objPreviousItem->_objNotificationUserAccountArray, $objChildItem);
					} else
						array_push($objPreviousItem->_objNotificationUserAccountArray, NotificationUserAccount::InstantiateDbRow($objDbRow, $strAliasPrefix . 'notificationuseraccount__', $strExpandAsArrayNodes));
					$blnExpandedViaArray = true;
				}

				// Either return false to signal array expansion, or check-to-reset the Alias prefix and move on
				if ($blnExpandedViaArray)
					return false;
				else if ($strAliasPrefix == 'notification__')
					$strAliasPrefix = null;
			}

			// Create a new instance of the Notification object
			$objToReturn = new Notification();
			$objToReturn->__blnRestored = true;

			$objToReturn->intNotificationId = $objDbRow->GetColumn($strAliasPrefix . 'notification_id', 'Integer');
			$objToReturn->strShortDescription = $objDbRow->GetColumn($strAliasPrefix . 'short_description', 'VarChar');
			$objToReturn->strLongDescription = $objDbRow->GetColumn($strAliasPrefix . 'long_description', 'Blob');
			$objToReturn->strCriteria = $objDbRow->GetColumn($strAliasPrefix . 'criteria', 'VarChar');
			$objToReturn->strFrequency = $objDbRow->GetColumn($strAliasPrefix . 'frequency', 'VarChar');
			$objToReturn->blnEnabledFlag = $objDbRow->GetColumn($strAliasPrefix . 'enabled_flag', 'Bit');
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
				$strAliasPrefix = 'notification__';

			// Check for CreatedByObject Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'created_by__user_account_id')))
				$objToReturn->objCreatedByObject = UserAccount::InstantiateDbRow($objDbRow, $strAliasPrefix . 'created_by__', $strExpandAsArrayNodes);

			// Check for ModifiedByObject Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'modified_by__user_account_id')))
				$objToReturn->objModifiedByObject = UserAccount::InstantiateDbRow($objDbRow, $strAliasPrefix . 'modified_by__', $strExpandAsArrayNodes);




			// Check for NotificationUserAccount Virtual Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'notificationuseraccount__notification_user_account_id'))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'notificationuseraccount__notification_user_account_id', $strExpandAsArrayNodes)))
					array_push($objToReturn->_objNotificationUserAccountArray, NotificationUserAccount::InstantiateDbRow($objDbRow, $strAliasPrefix . 'notificationuseraccount__', $strExpandAsArrayNodes));
				else
					$objToReturn->_objNotificationUserAccount = NotificationUserAccount::InstantiateDbRow($objDbRow, $strAliasPrefix . 'notificationuseraccount__', $strExpandAsArrayNodes);
			}

			return $objToReturn;
		}

		/**
		 * Instantiate an array of Notifications from a Database Result
		 * @param DatabaseResultBase $objDbResult
		 * @return Notification[]
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
					$objItem = Notification::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
					if ($objItem) {
						array_push($objToReturn, $objItem);
						$objLastRowItem = $objItem;
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					array_push($objToReturn, Notification::InstantiateDbRow($objDbRow));
			}

			return $objToReturn;
		}



		///////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Single Load and Array)
		///////////////////////////////////////////////////
			
		/**
		 * Load a single Notification object,
		 * by NotificationId Index(es)
		 * @param integer $intNotificationId
		 * @return Notification
		*/
		public static function LoadByNotificationId($intNotificationId) {
			return Notification::QuerySingle(
				QQ::Equal(QQN::Notification()->NotificationId, $intNotificationId)
			);
		}
			
		/**
		 * Load an array of Notification objects,
		 * by CreatedBy Index(es)
		 * @param integer $intCreatedBy
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Notification[]
		*/
		public static function LoadArrayByCreatedBy($intCreatedBy, $objOptionalClauses = null) {
			// Call Notification::QueryArray to perform the LoadArrayByCreatedBy query
			try {
				return Notification::QueryArray(
					QQ::Equal(QQN::Notification()->CreatedBy, $intCreatedBy),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count Notifications
		 * by CreatedBy Index(es)
		 * @param integer $intCreatedBy
		 * @return int
		*/
		public static function CountByCreatedBy($intCreatedBy) {
			// Call Notification::QueryCount to perform the CountByCreatedBy query
			return Notification::QueryCount(
				QQ::Equal(QQN::Notification()->CreatedBy, $intCreatedBy)
			);
		}
			
		/**
		 * Load an array of Notification objects,
		 * by ModifiedBy Index(es)
		 * @param integer $intModifiedBy
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Notification[]
		*/
		public static function LoadArrayByModifiedBy($intModifiedBy, $objOptionalClauses = null) {
			// Call Notification::QueryArray to perform the LoadArrayByModifiedBy query
			try {
				return Notification::QueryArray(
					QQ::Equal(QQN::Notification()->ModifiedBy, $intModifiedBy),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count Notifications
		 * by ModifiedBy Index(es)
		 * @param integer $intModifiedBy
		 * @return int
		*/
		public static function CountByModifiedBy($intModifiedBy) {
			// Call Notification::QueryCount to perform the CountByModifiedBy query
			return Notification::QueryCount(
				QQ::Equal(QQN::Notification()->ModifiedBy, $intModifiedBy)
			);
		}



		////////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Array via Many to Many)
		////////////////////////////////////////////////////



		//////////////////
		// SAVE AND DELETE
		//////////////////

		/**
		 * Save this Notification
		 * @param bool $blnForceInsert
		 * @param bool $blnForceUpdate
		 * @return int
		*/
		public function Save($blnForceInsert = false, $blnForceUpdate = false) {
			// Get the Database Object for this Class
			$objDatabase = Notification::GetDatabase();

			$mixToReturn = null;

			try {
				if ((!$this->__blnRestored) || ($blnForceInsert)) {
					// Perform an INSERT query
					$objDatabase->NonQuery('
						INSERT INTO `notification` (
							`short_description`,
							`long_description`,
							`criteria`,
							`frequency`,
							`enabled_flag`,
							`created_by`,
							`creation_date`,
							`modified_by`
						) VALUES (
							' . $objDatabase->SqlVariable($this->strShortDescription) . ',
							' . $objDatabase->SqlVariable($this->strLongDescription) . ',
							' . $objDatabase->SqlVariable($this->strCriteria) . ',
							' . $objDatabase->SqlVariable($this->strFrequency) . ',
							' . $objDatabase->SqlVariable($this->blnEnabledFlag) . ',
							' . $objDatabase->SqlVariable($this->intCreatedBy) . ',
							' . $objDatabase->SqlVariable($this->dttCreationDate) . ',
							' . $objDatabase->SqlVariable($this->intModifiedBy) . '
						)
					');

					// Update Identity column and return its value
					$mixToReturn = $this->intNotificationId = $objDatabase->InsertId('notification', 'notification_id');
				} else {
					// Perform an UPDATE query

					// First checking for Optimistic Locking constraints (if applicable)
					if (!$blnForceUpdate) {
						// Perform the Optimistic Locking check
						$objResult = $objDatabase->Query('
							SELECT
								`modified_date`
							FROM
								`notification`
							WHERE
								`notification_id` = ' . $objDatabase->SqlVariable($this->intNotificationId) . '
						');
						
						$objRow = $objResult->FetchArray();
						if ($objRow[0] != $this->strModifiedDate)
							throw new QExtendedOptimisticLockingException('Notification', $this->intNotificationId);
					}

					// Perform the UPDATE query
					$objDatabase->NonQuery('
						UPDATE
							`notification`
						SET
							`short_description` = ' . $objDatabase->SqlVariable($this->strShortDescription) . ',
							`long_description` = ' . $objDatabase->SqlVariable($this->strLongDescription) . ',
							`criteria` = ' . $objDatabase->SqlVariable($this->strCriteria) . ',
							`frequency` = ' . $objDatabase->SqlVariable($this->strFrequency) . ',
							`enabled_flag` = ' . $objDatabase->SqlVariable($this->blnEnabledFlag) . ',
							`created_by` = ' . $objDatabase->SqlVariable($this->intCreatedBy) . ',
							`creation_date` = ' . $objDatabase->SqlVariable($this->dttCreationDate) . ',
							`modified_by` = ' . $objDatabase->SqlVariable($this->intModifiedBy) . '
						WHERE
							`notification_id` = ' . $objDatabase->SqlVariable($this->intNotificationId) . '
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
					`notification`
				WHERE
					`notification_id` = ' . $objDatabase->SqlVariable($this->intNotificationId) . '
			');
						
			$objRow = $objResult->FetchArray();
			$this->strModifiedDate = $objRow[0];

			// Return 
			return $mixToReturn;
		}

				/**
		 * Delete this Notification
		 * @return void
		*/
		public function Delete() {
			if ((is_null($this->intNotificationId)))
				throw new QUndefinedPrimaryKeyException('Cannot delete this Notification with an unset primary key.');

			// Get the Database Object for this Class
			$objDatabase = Notification::GetDatabase();


			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`notification`
				WHERE
					`notification_id` = ' . $objDatabase->SqlVariable($this->intNotificationId) . '');
		}

		/**
		 * Delete all Notifications
		 * @return void
		*/
		public static function DeleteAll() {
			// Get the Database Object for this Class
			$objDatabase = Notification::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				DELETE FROM
					`notification`');
		}

		/**
		 * Truncate notification table
		 * @return void
		*/
		public static function Truncate() {
			// Get the Database Object for this Class
			$objDatabase = Notification::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				TRUNCATE `notification`');
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
				case 'NotificationId':
					/**
					 * Gets the value for intNotificationId (Read-Only PK)
					 * @return integer
					 */
					return $this->intNotificationId;

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

				case 'Criteria':
					/**
					 * Gets the value for strCriteria 
					 * @return string
					 */
					return $this->strCriteria;

				case 'Frequency':
					/**
					 * Gets the value for strFrequency (Not Null)
					 * @return string
					 */
					return $this->strFrequency;

				case 'EnabledFlag':
					/**
					 * Gets the value for blnEnabledFlag (Not Null)
					 * @return boolean
					 */
					return $this->blnEnabledFlag;

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

				case '_NotificationUserAccount':
					/**
					 * Gets the value for the private _objNotificationUserAccount (Read-Only)
					 * if set due to an expansion on the notification_user_account.notification_id reverse relationship
					 * @return NotificationUserAccount
					 */
					return $this->_objNotificationUserAccount;

				case '_NotificationUserAccountArray':
					/**
					 * Gets the value for the private _objNotificationUserAccountArray (Read-Only)
					 * if set due to an ExpandAsArray on the notification_user_account.notification_id reverse relationship
					 * @return NotificationUserAccount[]
					 */
					return (array) $this->_objNotificationUserAccountArray;

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

				case 'Criteria':
					/**
					 * Sets the value for strCriteria 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strCriteria = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Frequency':
					/**
					 * Sets the value for strFrequency (Not Null)
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strFrequency = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'EnabledFlag':
					/**
					 * Sets the value for blnEnabledFlag (Not Null)
					 * @param boolean $mixValue
					 * @return boolean
					 */
					try {
						return ($this->blnEnabledFlag = QType::Cast($mixValue, QType::Boolean));
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
							throw new QCallerException('Unable to set an unsaved CreatedByObject for this Notification');

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
							throw new QCallerException('Unable to set an unsaved ModifiedByObject for this Notification');

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

			
		
		// Related Objects' Methods for NotificationUserAccount
		//-------------------------------------------------------------------

		/**
		 * Gets all associated NotificationUserAccounts as an array of NotificationUserAccount objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return NotificationUserAccount[]
		*/ 
		public function GetNotificationUserAccountArray($objOptionalClauses = null) {
			if ((is_null($this->intNotificationId)))
				return array();

			try {
				return NotificationUserAccount::LoadArrayByNotificationId($this->intNotificationId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated NotificationUserAccounts
		 * @return int
		*/ 
		public function CountNotificationUserAccounts() {
			if ((is_null($this->intNotificationId)))
				return 0;

			return NotificationUserAccount::CountByNotificationId($this->intNotificationId);
		}

		/**
		 * Associates a NotificationUserAccount
		 * @param NotificationUserAccount $objNotificationUserAccount
		 * @return void
		*/ 
		public function AssociateNotificationUserAccount(NotificationUserAccount $objNotificationUserAccount) {
			if ((is_null($this->intNotificationId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateNotificationUserAccount on this unsaved Notification.');
			if ((is_null($objNotificationUserAccount->NotificationUserAccountId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateNotificationUserAccount on this Notification with an unsaved NotificationUserAccount.');

			// Get the Database Object for this Class
			$objDatabase = Notification::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`notification_user_account`
				SET
					`notification_id` = ' . $objDatabase->SqlVariable($this->intNotificationId) . '
				WHERE
					`notification_user_account_id` = ' . $objDatabase->SqlVariable($objNotificationUserAccount->NotificationUserAccountId) . '
			');
		}

		/**
		 * Unassociates a NotificationUserAccount
		 * @param NotificationUserAccount $objNotificationUserAccount
		 * @return void
		*/ 
		public function UnassociateNotificationUserAccount(NotificationUserAccount $objNotificationUserAccount) {
			if ((is_null($this->intNotificationId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateNotificationUserAccount on this unsaved Notification.');
			if ((is_null($objNotificationUserAccount->NotificationUserAccountId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateNotificationUserAccount on this Notification with an unsaved NotificationUserAccount.');

			// Get the Database Object for this Class
			$objDatabase = Notification::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`notification_user_account`
				SET
					`notification_id` = null
				WHERE
					`notification_user_account_id` = ' . $objDatabase->SqlVariable($objNotificationUserAccount->NotificationUserAccountId) . ' AND
					`notification_id` = ' . $objDatabase->SqlVariable($this->intNotificationId) . '
			');
		}

		/**
		 * Unassociates all NotificationUserAccounts
		 * @return void
		*/ 
		public function UnassociateAllNotificationUserAccounts() {
			if ((is_null($this->intNotificationId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateNotificationUserAccount on this unsaved Notification.');

			// Get the Database Object for this Class
			$objDatabase = Notification::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`notification_user_account`
				SET
					`notification_id` = null
				WHERE
					`notification_id` = ' . $objDatabase->SqlVariable($this->intNotificationId) . '
			');
		}

		/**
		 * Deletes an associated NotificationUserAccount
		 * @param NotificationUserAccount $objNotificationUserAccount
		 * @return void
		*/ 
		public function DeleteAssociatedNotificationUserAccount(NotificationUserAccount $objNotificationUserAccount) {
			if ((is_null($this->intNotificationId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateNotificationUserAccount on this unsaved Notification.');
			if ((is_null($objNotificationUserAccount->NotificationUserAccountId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateNotificationUserAccount on this Notification with an unsaved NotificationUserAccount.');

			// Get the Database Object for this Class
			$objDatabase = Notification::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`notification_user_account`
				WHERE
					`notification_user_account_id` = ' . $objDatabase->SqlVariable($objNotificationUserAccount->NotificationUserAccountId) . ' AND
					`notification_id` = ' . $objDatabase->SqlVariable($this->intNotificationId) . '
			');
		}

		/**
		 * Deletes all associated NotificationUserAccounts
		 * @return void
		*/ 
		public function DeleteAllNotificationUserAccounts() {
			if ((is_null($this->intNotificationId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateNotificationUserAccount on this unsaved Notification.');

			// Get the Database Object for this Class
			$objDatabase = Notification::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`notification_user_account`
				WHERE
					`notification_id` = ' . $objDatabase->SqlVariable($this->intNotificationId) . '
			');
		}




		///////////////////////////////////////////////////////////////////////
		// PROTECTED MEMBER VARIABLES and TEXT FIELD MAXLENGTHS (if applicable)
		///////////////////////////////////////////////////////////////////////
		
		/**
		 * Protected member variable that maps to the database PK Identity column notification.notification_id
		 * @var integer intNotificationId
		 */
		protected $intNotificationId;
		const NotificationIdDefault = null;


		/**
		 * Protected member variable that maps to the database column notification.short_description
		 * @var string strShortDescription
		 */
		protected $strShortDescription;
		const ShortDescriptionMaxLength = 255;
		const ShortDescriptionDefault = null;


		/**
		 * Protected member variable that maps to the database column notification.long_description
		 * @var string strLongDescription
		 */
		protected $strLongDescription;
		const LongDescriptionDefault = null;


		/**
		 * Protected member variable that maps to the database column notification.criteria
		 * @var string strCriteria
		 */
		protected $strCriteria;
		const CriteriaMaxLength = 255;
		const CriteriaDefault = null;


		/**
		 * Protected member variable that maps to the database column notification.frequency
		 * @var string strFrequency
		 */
		protected $strFrequency;
		const FrequencyDefault = null;


		/**
		 * Protected member variable that maps to the database column notification.enabled_flag
		 * @var boolean blnEnabledFlag
		 */
		protected $blnEnabledFlag;
		const EnabledFlagDefault = null;


		/**
		 * Protected member variable that maps to the database column notification.created_by
		 * @var integer intCreatedBy
		 */
		protected $intCreatedBy;
		const CreatedByDefault = null;


		/**
		 * Protected member variable that maps to the database column notification.creation_date
		 * @var QDateTime dttCreationDate
		 */
		protected $dttCreationDate;
		const CreationDateDefault = null;


		/**
		 * Protected member variable that maps to the database column notification.modified_by
		 * @var integer intModifiedBy
		 */
		protected $intModifiedBy;
		const ModifiedByDefault = null;


		/**
		 * Protected member variable that maps to the database column notification.modified_date
		 * @var string strModifiedDate
		 */
		protected $strModifiedDate;
		const ModifiedDateDefault = null;


		/**
		 * Private member variable that stores a reference to a single NotificationUserAccount object
		 * (of type NotificationUserAccount), if this Notification object was restored with
		 * an expansion on the notification_user_account association table.
		 * @var NotificationUserAccount _objNotificationUserAccount;
		 */
		private $_objNotificationUserAccount;

		/**
		 * Private member variable that stores a reference to an array of NotificationUserAccount objects
		 * (of type NotificationUserAccount[]), if this Notification object was restored with
		 * an ExpandAsArray on the notification_user_account association table.
		 * @var NotificationUserAccount[] _objNotificationUserAccountArray;
		 */
		private $_objNotificationUserAccountArray = array();

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
		 * in the database column notification.created_by.
		 *
		 * NOTE: Always use the CreatedByObject property getter to correctly retrieve this UserAccount object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var UserAccount objCreatedByObject
		 */
		protected $objCreatedByObject;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column notification.modified_by.
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
				$objQueryExpansion = new QQueryExpansion('Notification', 'notification', $objExpansionMap);
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
				$objQueryExpansion->AddFromItem(sprintf('LEFT JOIN `notification` AS `%s__%s` ON `%s`.`%s` = `%s__%s`.`notification_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias, $strParentAlias, $strAlias));

				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`notification_id` AS `%s__%s__notification_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`short_description` AS `%s__%s__short_description`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`long_description` AS `%s__%s__long_description`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`criteria` AS `%s__%s__criteria`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`frequency` AS `%s__%s__frequency`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`enabled_flag` AS `%s__%s__enabled_flag`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
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
			$strToReturn = '<complexType name="Notification"><sequence>';
			$strToReturn .= '<element name="NotificationId" type="xsd:int"/>';
			$strToReturn .= '<element name="ShortDescription" type="xsd:string"/>';
			$strToReturn .= '<element name="LongDescription" type="xsd:string"/>';
			$strToReturn .= '<element name="Criteria" type="xsd:string"/>';
			$strToReturn .= '<element name="Frequency" type="xsd:string"/>';
			$strToReturn .= '<element name="EnabledFlag" type="xsd:boolean"/>';
			$strToReturn .= '<element name="CreatedByObject" type="xsd1:UserAccount"/>';
			$strToReturn .= '<element name="CreationDate" type="xsd:dateTime"/>';
			$strToReturn .= '<element name="ModifiedByObject" type="xsd1:UserAccount"/>';
			$strToReturn .= '<element name="ModifiedDate" type="xsd:string"/>';
			$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
			$strToReturn .= '</sequence></complexType>';
			return $strToReturn;
		}

		public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
			if (!array_key_exists('Notification', $strComplexTypeArray)) {
				$strComplexTypeArray['Notification'] = Notification::GetSoapComplexTypeXml();
				UserAccount::AlterSoapComplexTypeArray($strComplexTypeArray);
				UserAccount::AlterSoapComplexTypeArray($strComplexTypeArray);
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, Notification::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new Notification();
			if (property_exists($objSoapObject, 'NotificationId'))
				$objToReturn->intNotificationId = $objSoapObject->NotificationId;
			if (property_exists($objSoapObject, 'ShortDescription'))
				$objToReturn->strShortDescription = $objSoapObject->ShortDescription;
			if (property_exists($objSoapObject, 'LongDescription'))
				$objToReturn->strLongDescription = $objSoapObject->LongDescription;
			if (property_exists($objSoapObject, 'Criteria'))
				$objToReturn->strCriteria = $objSoapObject->Criteria;
			if (property_exists($objSoapObject, 'Frequency'))
				$objToReturn->strFrequency = $objSoapObject->Frequency;
			if (property_exists($objSoapObject, 'EnabledFlag'))
				$objToReturn->blnEnabledFlag = $objSoapObject->EnabledFlag;
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
				array_push($objArrayToReturn, Notification::GetSoapObjectFromObject($objObject, true));

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

	class QQNodeNotification extends QQNode {
		protected $strTableName = 'notification';
		protected $strPrimaryKey = 'notification_id';
		protected $strClassName = 'Notification';
		public function __get($strName) {
			switch ($strName) {
				case 'NotificationId':
					return new QQNode('notification_id', 'integer', $this);
				case 'ShortDescription':
					return new QQNode('short_description', 'string', $this);
				case 'LongDescription':
					return new QQNode('long_description', 'string', $this);
				case 'Criteria':
					return new QQNode('criteria', 'string', $this);
				case 'Frequency':
					return new QQNode('frequency', 'string', $this);
				case 'EnabledFlag':
					return new QQNode('enabled_flag', 'boolean', $this);
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
				case 'NotificationUserAccount':
					return new QQReverseReferenceNodeNotificationUserAccount($this, 'notificationuseraccount', 'reverse_reference', 'notification_id');

				case '_PrimaryKeyNode':
					return new QQNode('notification_id', 'integer', $this);
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

	class QQReverseReferenceNodeNotification extends QQReverseReferenceNode {
		protected $strTableName = 'notification';
		protected $strPrimaryKey = 'notification_id';
		protected $strClassName = 'Notification';
		public function __get($strName) {
			switch ($strName) {
				case 'NotificationId':
					return new QQNode('notification_id', 'integer', $this);
				case 'ShortDescription':
					return new QQNode('short_description', 'string', $this);
				case 'LongDescription':
					return new QQNode('long_description', 'string', $this);
				case 'Criteria':
					return new QQNode('criteria', 'string', $this);
				case 'Frequency':
					return new QQNode('frequency', 'string', $this);
				case 'EnabledFlag':
					return new QQNode('enabled_flag', 'boolean', $this);
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
				case 'NotificationUserAccount':
					return new QQReverseReferenceNodeNotificationUserAccount($this, 'notificationuseraccount', 'reverse_reference', 'notification_id');

				case '_PrimaryKeyNode':
					return new QQNode('notification_id', 'integer', $this);
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