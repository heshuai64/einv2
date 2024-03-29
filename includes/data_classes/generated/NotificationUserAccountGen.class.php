<?php
	/**
	 * The abstract NotificationUserAccountGen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the NotificationUserAccount subclass which
	 * extends this NotificationUserAccountGen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the NotificationUserAccount class.
	 * 
	 * @package My Application
	 * @subpackage GeneratedDataObjects
	 * 
	 */
	class NotificationUserAccountGen extends QBaseClass {
		///////////////////////////////
		// COMMON LOAD METHODS
		///////////////////////////////

		/**
		 * Load a NotificationUserAccount from PK Info
		 * @param integer $intNotificationUserAccountId
		 * @return NotificationUserAccount
		 */
		public static function Load($intNotificationUserAccountId) {
			// Use QuerySingle to Perform the Query
			return NotificationUserAccount::QuerySingle(
				QQ::Equal(QQN::NotificationUserAccount()->NotificationUserAccountId, $intNotificationUserAccountId)
			);
		}

		/**
		 * Load all NotificationUserAccounts
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return NotificationUserAccount[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			// Call NotificationUserAccount::QueryArray to perform the LoadAll query
			try {
				return NotificationUserAccount::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all NotificationUserAccounts
		 * @return int
		 */
		public static function CountAll() {
			// Call NotificationUserAccount::QueryCount to perform the CountAll query
			return NotificationUserAccount::QueryCount(QQ::All());
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
			$objDatabase = NotificationUserAccount::GetDatabase();

			// Create/Build out the QueryBuilder object with NotificationUserAccount-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, 'notification_user_account');
			NotificationUserAccount::GetSelectFields($objQueryBuilder);
			$objQueryBuilder->AddFromItem('`notification_user_account` AS `notification_user_account`');

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
		 * Static Qcodo Query method to query for a single NotificationUserAccount object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return NotificationUserAccount the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = NotificationUserAccount::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query, Get the First Row, and Instantiate a new NotificationUserAccount object
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return NotificationUserAccount::InstantiateDbRow($objDbResult->GetNextRow());
		}

		/**
		 * Static Qcodo Query method to query for an array of NotificationUserAccount objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return NotificationUserAccount[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = NotificationUserAccount::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return NotificationUserAccount::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
		}

		/**
		 * Static Qcodo Query method to query for a count of NotificationUserAccount objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = NotificationUserAccount::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
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
			$objDatabase = NotificationUserAccount::GetDatabase();

			// Lookup the QCache for This Query Statement
			$objCache = new QCache('query', 'notification_user_account_' . serialize($strConditions));
			if (!($strQuery = $objCache->GetData())) {
				// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with NotificationUserAccount-specific fields
				$objQueryBuilder = new QQueryBuilder($objDatabase);
				NotificationUserAccount::GetSelectFields($objQueryBuilder);
				NotificationUserAccount::GetFromFields($objQueryBuilder);

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
			return NotificationUserAccount::InstantiateDbResult($objDbResult);
		}*/

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this NotificationUserAccount
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null) {
			if ($strPrefix) {
				$strTableName = '`' . $strPrefix . '`';
				$strAliasPrefix = '`' . $strPrefix . '__';
			} else {
				$strTableName = '`notification_user_account`';
				$strAliasPrefix = '`';
			}

			$objBuilder->AddSelectItem($strTableName . '.`notification_user_account_id` AS ' . $strAliasPrefix . 'notification_user_account_id`');
			$objBuilder->AddSelectItem($strTableName . '.`user_account_id` AS ' . $strAliasPrefix . 'user_account_id`');
			$objBuilder->AddSelectItem($strTableName . '.`notification_id` AS ' . $strAliasPrefix . 'notification_id`');
			$objBuilder->AddSelectItem($strTableName . '.`level` AS ' . $strAliasPrefix . 'level`');
		}



		///////////////////////////////
		// INSTANTIATION-RELATED METHODS
		///////////////////////////////

		/**
		 * Instantiate a NotificationUserAccount from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this NotificationUserAccount::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param DatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @return NotificationUserAccount
		*/
		public static function InstantiateDbRow($objDbRow, $strAliasPrefix = null, $strExpandAsArrayNodes = null, $objPreviousItem = null) {
			// If blank row, return null
			if (!$objDbRow)
				return null;


			// Create a new instance of the NotificationUserAccount object
			$objToReturn = new NotificationUserAccount();
			$objToReturn->__blnRestored = true;

			$objToReturn->intNotificationUserAccountId = $objDbRow->GetColumn($strAliasPrefix . 'notification_user_account_id', 'Integer');
			$objToReturn->intUserAccountId = $objDbRow->GetColumn($strAliasPrefix . 'user_account_id', 'Integer');
			$objToReturn->intNotificationId = $objDbRow->GetColumn($strAliasPrefix . 'notification_id', 'Integer');
			$objToReturn->strLevel = $objDbRow->GetColumn($strAliasPrefix . 'level', 'VarChar');

			// Instantiate Virtual Attributes
			foreach ($objDbRow->GetColumnNameArray() as $strColumnName => $mixValue) {
				$strVirtualPrefix = $strAliasPrefix . '__';
				$strVirtualPrefixLength = strlen($strVirtualPrefix);
				if (substr($strColumnName, 0, $strVirtualPrefixLength) == $strVirtualPrefix)
					$objToReturn->__strVirtualAttributeArray[substr($strColumnName, $strVirtualPrefixLength)] = $mixValue;
			}

			// Prepare to Check for Early/Virtual Binding
			if (!$strAliasPrefix)
				$strAliasPrefix = 'notification_user_account__';

			// Check for UserAccount Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'user_account_id__user_account_id')))
				$objToReturn->objUserAccount = UserAccount::InstantiateDbRow($objDbRow, $strAliasPrefix . 'user_account_id__', $strExpandAsArrayNodes);

			// Check for Notification Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'notification_id__notification_id')))
				$objToReturn->objNotification = Notification::InstantiateDbRow($objDbRow, $strAliasPrefix . 'notification_id__', $strExpandAsArrayNodes);




			return $objToReturn;
		}

		/**
		 * Instantiate an array of NotificationUserAccounts from a Database Result
		 * @param DatabaseResultBase $objDbResult
		 * @return NotificationUserAccount[]
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
					$objItem = NotificationUserAccount::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
					if ($objItem) {
						array_push($objToReturn, $objItem);
						$objLastRowItem = $objItem;
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					array_push($objToReturn, NotificationUserAccount::InstantiateDbRow($objDbRow));
			}

			return $objToReturn;
		}



		///////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Single Load and Array)
		///////////////////////////////////////////////////
			
		/**
		 * Load a single NotificationUserAccount object,
		 * by NotificationUserAccountId Index(es)
		 * @param integer $intNotificationUserAccountId
		 * @return NotificationUserAccount
		*/
		public static function LoadByNotificationUserAccountId($intNotificationUserAccountId) {
			return NotificationUserAccount::QuerySingle(
				QQ::Equal(QQN::NotificationUserAccount()->NotificationUserAccountId, $intNotificationUserAccountId)
			);
		}
			
		/**
		 * Load an array of NotificationUserAccount objects,
		 * by NotificationId Index(es)
		 * @param integer $intNotificationId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return NotificationUserAccount[]
		*/
		public static function LoadArrayByNotificationId($intNotificationId, $objOptionalClauses = null) {
			// Call NotificationUserAccount::QueryArray to perform the LoadArrayByNotificationId query
			try {
				return NotificationUserAccount::QueryArray(
					QQ::Equal(QQN::NotificationUserAccount()->NotificationId, $intNotificationId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count NotificationUserAccounts
		 * by NotificationId Index(es)
		 * @param integer $intNotificationId
		 * @return int
		*/
		public static function CountByNotificationId($intNotificationId) {
			// Call NotificationUserAccount::QueryCount to perform the CountByNotificationId query
			return NotificationUserAccount::QueryCount(
				QQ::Equal(QQN::NotificationUserAccount()->NotificationId, $intNotificationId)
			);
		}
			
		/**
		 * Load an array of NotificationUserAccount objects,
		 * by UserAccountId Index(es)
		 * @param integer $intUserAccountId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return NotificationUserAccount[]
		*/
		public static function LoadArrayByUserAccountId($intUserAccountId, $objOptionalClauses = null) {
			// Call NotificationUserAccount::QueryArray to perform the LoadArrayByUserAccountId query
			try {
				return NotificationUserAccount::QueryArray(
					QQ::Equal(QQN::NotificationUserAccount()->UserAccountId, $intUserAccountId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count NotificationUserAccounts
		 * by UserAccountId Index(es)
		 * @param integer $intUserAccountId
		 * @return int
		*/
		public static function CountByUserAccountId($intUserAccountId) {
			// Call NotificationUserAccount::QueryCount to perform the CountByUserAccountId query
			return NotificationUserAccount::QueryCount(
				QQ::Equal(QQN::NotificationUserAccount()->UserAccountId, $intUserAccountId)
			);
		}



		////////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Array via Many to Many)
		////////////////////////////////////////////////////



		//////////////////
		// SAVE AND DELETE
		//////////////////

		/**
		 * Save this NotificationUserAccount
		 * @param bool $blnForceInsert
		 * @param bool $blnForceUpdate
		 * @return int
		*/
		public function Save($blnForceInsert = false, $blnForceUpdate = false) {
			// Get the Database Object for this Class
			$objDatabase = NotificationUserAccount::GetDatabase();

			$mixToReturn = null;

			try {
				if ((!$this->__blnRestored) || ($blnForceInsert)) {
					// Perform an INSERT query
					$objDatabase->NonQuery('
						INSERT INTO `notification_user_account` (
							`user_account_id`,
							`notification_id`,
							`level`
						) VALUES (
							' . $objDatabase->SqlVariable($this->intUserAccountId) . ',
							' . $objDatabase->SqlVariable($this->intNotificationId) . ',
							' . $objDatabase->SqlVariable($this->strLevel) . '
						)
					');

					// Update Identity column and return its value
					$mixToReturn = $this->intNotificationUserAccountId = $objDatabase->InsertId('notification_user_account', 'notification_user_account_id');
				} else {
					// Perform an UPDATE query

					// First checking for Optimistic Locking constraints (if applicable)

					// Perform the UPDATE query
					$objDatabase->NonQuery('
						UPDATE
							`notification_user_account`
						SET
							`user_account_id` = ' . $objDatabase->SqlVariable($this->intUserAccountId) . ',
							`notification_id` = ' . $objDatabase->SqlVariable($this->intNotificationId) . ',
							`level` = ' . $objDatabase->SqlVariable($this->strLevel) . '
						WHERE
							`notification_user_account_id` = ' . $objDatabase->SqlVariable($this->intNotificationUserAccountId) . '
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
		 * Delete this NotificationUserAccount
		 * @return void
		*/
		public function Delete() {
			if ((is_null($this->intNotificationUserAccountId)))
				throw new QUndefinedPrimaryKeyException('Cannot delete this NotificationUserAccount with an unset primary key.');

			// Get the Database Object for this Class
			$objDatabase = NotificationUserAccount::GetDatabase();


			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`notification_user_account`
				WHERE
					`notification_user_account_id` = ' . $objDatabase->SqlVariable($this->intNotificationUserAccountId) . '');
		}

		/**
		 * Delete all NotificationUserAccounts
		 * @return void
		*/
		public static function DeleteAll() {
			// Get the Database Object for this Class
			$objDatabase = NotificationUserAccount::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				DELETE FROM
					`notification_user_account`');
		}

		/**
		 * Truncate notification_user_account table
		 * @return void
		*/
		public static function Truncate() {
			// Get the Database Object for this Class
			$objDatabase = NotificationUserAccount::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				TRUNCATE `notification_user_account`');
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
				case 'NotificationUserAccountId':
					/**
					 * Gets the value for intNotificationUserAccountId (Read-Only PK)
					 * @return integer
					 */
					return $this->intNotificationUserAccountId;

				case 'UserAccountId':
					/**
					 * Gets the value for intUserAccountId (Not Null)
					 * @return integer
					 */
					return $this->intUserAccountId;

				case 'NotificationId':
					/**
					 * Gets the value for intNotificationId (Not Null)
					 * @return integer
					 */
					return $this->intNotificationId;

				case 'Level':
					/**
					 * Gets the value for strLevel 
					 * @return string
					 */
					return $this->strLevel;


				///////////////////
				// Member Objects
				///////////////////
				case 'UserAccount':
					/**
					 * Gets the value for the UserAccount object referenced by intUserAccountId (Not Null)
					 * @return UserAccount
					 */
					try {
						if ((!$this->objUserAccount) && (!is_null($this->intUserAccountId)))
							$this->objUserAccount = UserAccount::Load($this->intUserAccountId);
						return $this->objUserAccount;
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Notification':
					/**
					 * Gets the value for the Notification object referenced by intNotificationId (Not Null)
					 * @return Notification
					 */
					try {
						if ((!$this->objNotification) && (!is_null($this->intNotificationId)))
							$this->objNotification = Notification::Load($this->intNotificationId);
						return $this->objNotification;
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
				case 'UserAccountId':
					/**
					 * Sets the value for intUserAccountId (Not Null)
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						$this->objUserAccount = null;
						return ($this->intUserAccountId = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'NotificationId':
					/**
					 * Sets the value for intNotificationId (Not Null)
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						$this->objNotification = null;
						return ($this->intNotificationId = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Level':
					/**
					 * Sets the value for strLevel 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strLevel = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}


				///////////////////
				// Member Objects
				///////////////////
				case 'UserAccount':
					/**
					 * Sets the value for the UserAccount object referenced by intUserAccountId (Not Null)
					 * @param UserAccount $mixValue
					 * @return UserAccount
					 */
					if (is_null($mixValue)) {
						$this->intUserAccountId = null;
						$this->objUserAccount = null;
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
							throw new QCallerException('Unable to set an unsaved UserAccount for this NotificationUserAccount');

						// Update Local Member Variables
						$this->objUserAccount = $mixValue;
						$this->intUserAccountId = $mixValue->UserAccountId;

						// Return $mixValue
						return $mixValue;
					}
					break;

				case 'Notification':
					/**
					 * Sets the value for the Notification object referenced by intNotificationId (Not Null)
					 * @param Notification $mixValue
					 * @return Notification
					 */
					if (is_null($mixValue)) {
						$this->intNotificationId = null;
						$this->objNotification = null;
						return null;
					} else {
						// Make sure $mixValue actually is a Notification object
						try {
							$mixValue = QType::Cast($mixValue, 'Notification');
						} catch (QInvalidCastException $objExc) {
							$objExc->IncrementOffset();
							throw $objExc;
						} 

						// Make sure $mixValue is a SAVED Notification object
						if (is_null($mixValue->NotificationId))
							throw new QCallerException('Unable to set an unsaved Notification for this NotificationUserAccount');

						// Update Local Member Variables
						$this->objNotification = $mixValue;
						$this->intNotificationId = $mixValue->NotificationId;

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
		 * Protected member variable that maps to the database PK Identity column notification_user_account.notification_user_account_id
		 * @var integer intNotificationUserAccountId
		 */
		protected $intNotificationUserAccountId;
		const NotificationUserAccountIdDefault = null;


		/**
		 * Protected member variable that maps to the database column notification_user_account.user_account_id
		 * @var integer intUserAccountId
		 */
		protected $intUserAccountId;
		const UserAccountIdDefault = null;


		/**
		 * Protected member variable that maps to the database column notification_user_account.notification_id
		 * @var integer intNotificationId
		 */
		protected $intNotificationId;
		const NotificationIdDefault = null;


		/**
		 * Protected member variable that maps to the database column notification_user_account.level
		 * @var string strLevel
		 */
		protected $strLevel;
		const LevelDefault = null;


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
		 * in the database column notification_user_account.user_account_id.
		 *
		 * NOTE: Always use the UserAccount property getter to correctly retrieve this UserAccount object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var UserAccount objUserAccount
		 */
		protected $objUserAccount;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column notification_user_account.notification_id.
		 *
		 * NOTE: Always use the Notification property getter to correctly retrieve this Notification object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var Notification objNotification
		 */
		protected $objNotification;






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
				$objQueryExpansion = new QQueryExpansion('NotificationUserAccount', 'notification_user_account', $objExpansionMap);
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
				$objQueryExpansion->AddFromItem(sprintf('LEFT JOIN `notification_user_account` AS `%s__%s` ON `%s`.`%s` = `%s__%s`.`notification_user_account_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias, $strParentAlias, $strAlias));

				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`notification_user_account_id` AS `%s__%s__notification_user_account_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`user_account_id` AS `%s__%s__user_account_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`notification_id` AS `%s__%s__notification_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`level` AS `%s__%s__level`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));

				$strParentAlias = $strParentAlias . '__' . $strAlias;
			}

			if (is_array($objExpansionMap))
				foreach ($objExpansionMap as $strKey=>$objValue) {
					switch ($strKey) {
						case 'user_account_id':
							try {
								UserAccount::ExpandQuery($strParentAlias, $strKey, $objValue, $objQueryExpansion);
								break;
							} catch (QCallerException $objExc) {
								$objExc->IncrementOffset();
								throw $objExc;
							}
						case 'notification_id':
							try {
								Notification::ExpandQuery($strParentAlias, $strKey, $objValue, $objQueryExpansion);
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
		const ExpandUserAccount = 'user_account_id';
		const ExpandNotification = 'notification_id';




		////////////////////////////////////////
		// METHODS for WEB SERVICES
		////////////////////////////////////////

		public static function GetSoapComplexTypeXml() {
			$strToReturn = '<complexType name="NotificationUserAccount"><sequence>';
			$strToReturn .= '<element name="NotificationUserAccountId" type="xsd:int"/>';
			$strToReturn .= '<element name="UserAccount" type="xsd1:UserAccount"/>';
			$strToReturn .= '<element name="Notification" type="xsd1:Notification"/>';
			$strToReturn .= '<element name="Level" type="xsd:string"/>';
			$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
			$strToReturn .= '</sequence></complexType>';
			return $strToReturn;
		}

		public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
			if (!array_key_exists('NotificationUserAccount', $strComplexTypeArray)) {
				$strComplexTypeArray['NotificationUserAccount'] = NotificationUserAccount::GetSoapComplexTypeXml();
				UserAccount::AlterSoapComplexTypeArray($strComplexTypeArray);
				Notification::AlterSoapComplexTypeArray($strComplexTypeArray);
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, NotificationUserAccount::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new NotificationUserAccount();
			if (property_exists($objSoapObject, 'NotificationUserAccountId'))
				$objToReturn->intNotificationUserAccountId = $objSoapObject->NotificationUserAccountId;
			if ((property_exists($objSoapObject, 'UserAccount')) &&
				($objSoapObject->UserAccount))
				$objToReturn->UserAccount = UserAccount::GetObjectFromSoapObject($objSoapObject->UserAccount);
			if ((property_exists($objSoapObject, 'Notification')) &&
				($objSoapObject->Notification))
				$objToReturn->Notification = Notification::GetObjectFromSoapObject($objSoapObject->Notification);
			if (property_exists($objSoapObject, 'Level'))
				$objToReturn->strLevel = $objSoapObject->Level;
			if (property_exists($objSoapObject, '__blnRestored'))
				$objToReturn->__blnRestored = $objSoapObject->__blnRestored;
			return $objToReturn;
		}

		public static function GetSoapArrayFromArray($objArray) {
			if (!$objArray)
				return null;

			$objArrayToReturn = array();

			foreach ($objArray as $objObject)
				array_push($objArrayToReturn, NotificationUserAccount::GetSoapObjectFromObject($objObject, true));

			return unserialize(serialize($objArrayToReturn));
		}

		public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
			if ($objObject->objUserAccount)
				$objObject->objUserAccount = UserAccount::GetSoapObjectFromObject($objObject->objUserAccount, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intUserAccountId = null;
			if ($objObject->objNotification)
				$objObject->objNotification = Notification::GetSoapObjectFromObject($objObject->objNotification, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intNotificationId = null;
			return $objObject;
		}
	}





	/////////////////////////////////////
	// ADDITIONAL CLASSES for QCODO QUERY
	/////////////////////////////////////

	class QQNodeNotificationUserAccount extends QQNode {
		protected $strTableName = 'notification_user_account';
		protected $strPrimaryKey = 'notification_user_account_id';
		protected $strClassName = 'NotificationUserAccount';
		public function __get($strName) {
			switch ($strName) {
				case 'NotificationUserAccountId':
					return new QQNode('notification_user_account_id', 'integer', $this);
				case 'UserAccountId':
					return new QQNode('user_account_id', 'integer', $this);
				case 'UserAccount':
					return new QQNodeUserAccount('user_account_id', 'integer', $this);
				case 'NotificationId':
					return new QQNode('notification_id', 'integer', $this);
				case 'Notification':
					return new QQNodeNotification('notification_id', 'integer', $this);
				case 'Level':
					return new QQNode('level', 'string', $this);

				case '_PrimaryKeyNode':
					return new QQNode('notification_user_account_id', 'integer', $this);
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

	class QQReverseReferenceNodeNotificationUserAccount extends QQReverseReferenceNode {
		protected $strTableName = 'notification_user_account';
		protected $strPrimaryKey = 'notification_user_account_id';
		protected $strClassName = 'NotificationUserAccount';
		public function __get($strName) {
			switch ($strName) {
				case 'NotificationUserAccountId':
					return new QQNode('notification_user_account_id', 'integer', $this);
				case 'UserAccountId':
					return new QQNode('user_account_id', 'integer', $this);
				case 'UserAccount':
					return new QQNodeUserAccount('user_account_id', 'integer', $this);
				case 'NotificationId':
					return new QQNode('notification_id', 'integer', $this);
				case 'Notification':
					return new QQNodeNotification('notification_id', 'integer', $this);
				case 'Level':
					return new QQNode('level', 'string', $this);

				case '_PrimaryKeyNode':
					return new QQNode('notification_user_account_id', 'integer', $this);
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