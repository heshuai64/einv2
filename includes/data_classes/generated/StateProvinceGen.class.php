<?php
	/**
	 * The abstract StateProvinceGen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the StateProvince subclass which
	 * extends this StateProvinceGen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the StateProvince class.
	 * 
	 * @package My Application
	 * @subpackage GeneratedDataObjects
	 * 
	 */
	class StateProvinceGen extends QBaseClass {
		///////////////////////////////
		// COMMON LOAD METHODS
		///////////////////////////////

		/**
		 * Load a StateProvince from PK Info
		 * @param integer $intStateProvinceId
		 * @return StateProvince
		 */
		public static function Load($intStateProvinceId) {
			// Use QuerySingle to Perform the Query
			return StateProvince::QuerySingle(
				QQ::Equal(QQN::StateProvince()->StateProvinceId, $intStateProvinceId)
			);
		}

		/**
		 * Load all StateProvinces
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return StateProvince[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			// Call StateProvince::QueryArray to perform the LoadAll query
			try {
				return StateProvince::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all StateProvinces
		 * @return int
		 */
		public static function CountAll() {
			// Call StateProvince::QueryCount to perform the CountAll query
			return StateProvince::QueryCount(QQ::All());
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
			$objDatabase = StateProvince::GetDatabase();

			// Create/Build out the QueryBuilder object with StateProvince-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, 'state_province');
			StateProvince::GetSelectFields($objQueryBuilder);
			$objQueryBuilder->AddFromItem('`state_province` AS `state_province`');

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
		 * Static Qcodo Query method to query for a single StateProvince object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return StateProvince the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = StateProvince::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query, Get the First Row, and Instantiate a new StateProvince object
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return StateProvince::InstantiateDbRow($objDbResult->GetNextRow());
		}

		/**
		 * Static Qcodo Query method to query for an array of StateProvince objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return StateProvince[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = StateProvince::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return StateProvince::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
		}

		/**
		 * Static Qcodo Query method to query for a count of StateProvince objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = StateProvince::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
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
			$objDatabase = StateProvince::GetDatabase();

			// Lookup the QCache for This Query Statement
			$objCache = new QCache('query', 'state_province_' . serialize($strConditions));
			if (!($strQuery = $objCache->GetData())) {
				// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with StateProvince-specific fields
				$objQueryBuilder = new QQueryBuilder($objDatabase);
				StateProvince::GetSelectFields($objQueryBuilder);
				StateProvince::GetFromFields($objQueryBuilder);

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
			return StateProvince::InstantiateDbResult($objDbResult);
		}*/

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this StateProvince
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null) {
			if ($strPrefix) {
				$strTableName = '`' . $strPrefix . '`';
				$strAliasPrefix = '`' . $strPrefix . '__';
			} else {
				$strTableName = '`state_province`';
				$strAliasPrefix = '`';
			}

			$objBuilder->AddSelectItem($strTableName . '.`state_province_id` AS ' . $strAliasPrefix . 'state_province_id`');
			$objBuilder->AddSelectItem($strTableName . '.`country_id` AS ' . $strAliasPrefix . 'country_id`');
			$objBuilder->AddSelectItem($strTableName . '.`short_description` AS ' . $strAliasPrefix . 'short_description`');
			$objBuilder->AddSelectItem($strTableName . '.`abbreviation` AS ' . $strAliasPrefix . 'abbreviation`');
		}



		///////////////////////////////
		// INSTANTIATION-RELATED METHODS
		///////////////////////////////

		/**
		 * Instantiate a StateProvince from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this StateProvince::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param DatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @return StateProvince
		*/
		public static function InstantiateDbRow($objDbRow, $strAliasPrefix = null, $strExpandAsArrayNodes = null, $objPreviousItem = null) {
			// If blank row, return null
			if (!$objDbRow)
				return null;

			// See if we're doing an array expansion on the previous item
			if (($strExpandAsArrayNodes) && ($objPreviousItem) &&
				($objPreviousItem->intStateProvinceId == $objDbRow->GetColumn($strAliasPrefix . 'state_province_id', 'Integer'))) {

				// We are.  Now, prepare to check for ExpandAsArray clauses
				$blnExpandedViaArray = false;
				if (!$strAliasPrefix)
					$strAliasPrefix = 'state_province__';


				if ((array_key_exists($strAliasPrefix . 'address__address_id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'address__address_id')))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objAddressArray)) {
						$objPreviousChildItem = $objPreviousItem->_objAddressArray[$intPreviousChildItemCount - 1];
						$objChildItem = Address::InstantiateDbRow($objDbRow, $strAliasPrefix . 'address__', $strExpandAsArrayNodes, $objPreviousChildItem);
						if ($objChildItem)
							array_push($objPreviousItem->_objAddressArray, $objChildItem);
					} else
						array_push($objPreviousItem->_objAddressArray, Address::InstantiateDbRow($objDbRow, $strAliasPrefix . 'address__', $strExpandAsArrayNodes));
					$blnExpandedViaArray = true;
				}

				if ((array_key_exists($strAliasPrefix . 'fedexshipmentasholdatlocationstate__fedex_shipment_id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'fedexshipmentasholdatlocationstate__fedex_shipment_id')))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objFedexShipmentAsHoldAtLocationStateArray)) {
						$objPreviousChildItem = $objPreviousItem->_objFedexShipmentAsHoldAtLocationStateArray[$intPreviousChildItemCount - 1];
						$objChildItem = FedexShipment::InstantiateDbRow($objDbRow, $strAliasPrefix . 'fedexshipmentasholdatlocationstate__', $strExpandAsArrayNodes, $objPreviousChildItem);
						if ($objChildItem)
							array_push($objPreviousItem->_objFedexShipmentAsHoldAtLocationStateArray, $objChildItem);
					} else
						array_push($objPreviousItem->_objFedexShipmentAsHoldAtLocationStateArray, FedexShipment::InstantiateDbRow($objDbRow, $strAliasPrefix . 'fedexshipmentasholdatlocationstate__', $strExpandAsArrayNodes));
					$blnExpandedViaArray = true;
				}

				// Either return false to signal array expansion, or check-to-reset the Alias prefix and move on
				if ($blnExpandedViaArray)
					return false;
				else if ($strAliasPrefix == 'state_province__')
					$strAliasPrefix = null;
			}

			// Create a new instance of the StateProvince object
			$objToReturn = new StateProvince();
			$objToReturn->__blnRestored = true;

			$objToReturn->intStateProvinceId = $objDbRow->GetColumn($strAliasPrefix . 'state_province_id', 'Integer');
			$objToReturn->intCountryId = $objDbRow->GetColumn($strAliasPrefix . 'country_id', 'Integer');
			$objToReturn->strShortDescription = $objDbRow->GetColumn($strAliasPrefix . 'short_description', 'VarChar');
			$objToReturn->strAbbreviation = $objDbRow->GetColumn($strAliasPrefix . 'abbreviation', 'VarChar');

			// Instantiate Virtual Attributes
			foreach ($objDbRow->GetColumnNameArray() as $strColumnName => $mixValue) {
				$strVirtualPrefix = $strAliasPrefix . '__';
				$strVirtualPrefixLength = strlen($strVirtualPrefix);
				if (substr($strColumnName, 0, $strVirtualPrefixLength) == $strVirtualPrefix)
					$objToReturn->__strVirtualAttributeArray[substr($strColumnName, $strVirtualPrefixLength)] = $mixValue;
			}

			// Prepare to Check for Early/Virtual Binding
			if (!$strAliasPrefix)
				$strAliasPrefix = 'state_province__';

			// Check for Country Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'country_id__country_id')))
				$objToReturn->objCountry = Country::InstantiateDbRow($objDbRow, $strAliasPrefix . 'country_id__', $strExpandAsArrayNodes);




			// Check for Address Virtual Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'address__address_id'))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'address__address_id', $strExpandAsArrayNodes)))
					array_push($objToReturn->_objAddressArray, Address::InstantiateDbRow($objDbRow, $strAliasPrefix . 'address__', $strExpandAsArrayNodes));
				else
					$objToReturn->_objAddress = Address::InstantiateDbRow($objDbRow, $strAliasPrefix . 'address__', $strExpandAsArrayNodes);
			}

			// Check for FedexShipmentAsHoldAtLocationState Virtual Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'fedexshipmentasholdatlocationstate__fedex_shipment_id'))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'fedexshipmentasholdatlocationstate__fedex_shipment_id', $strExpandAsArrayNodes)))
					array_push($objToReturn->_objFedexShipmentAsHoldAtLocationStateArray, FedexShipment::InstantiateDbRow($objDbRow, $strAliasPrefix . 'fedexshipmentasholdatlocationstate__', $strExpandAsArrayNodes));
				else
					$objToReturn->_objFedexShipmentAsHoldAtLocationState = FedexShipment::InstantiateDbRow($objDbRow, $strAliasPrefix . 'fedexshipmentasholdatlocationstate__', $strExpandAsArrayNodes);
			}

			return $objToReturn;
		}

		/**
		 * Instantiate an array of StateProvinces from a Database Result
		 * @param DatabaseResultBase $objDbResult
		 * @return StateProvince[]
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
					$objItem = StateProvince::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
					if ($objItem) {
						array_push($objToReturn, $objItem);
						$objLastRowItem = $objItem;
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					array_push($objToReturn, StateProvince::InstantiateDbRow($objDbRow));
			}

			return $objToReturn;
		}



		///////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Single Load and Array)
		///////////////////////////////////////////////////
			
		/**
		 * Load a single StateProvince object,
		 * by StateProvinceId Index(es)
		 * @param integer $intStateProvinceId
		 * @return StateProvince
		*/
		public static function LoadByStateProvinceId($intStateProvinceId) {
			return StateProvince::QuerySingle(
				QQ::Equal(QQN::StateProvince()->StateProvinceId, $intStateProvinceId)
			);
		}
			
		/**
		 * Load an array of StateProvince objects,
		 * by CountryId Index(es)
		 * @param integer $intCountryId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return StateProvince[]
		*/
		public static function LoadArrayByCountryId($intCountryId, $objOptionalClauses = null) {
			// Call StateProvince::QueryArray to perform the LoadArrayByCountryId query
			try {
				return StateProvince::QueryArray(
					QQ::Equal(QQN::StateProvince()->CountryId, $intCountryId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count StateProvinces
		 * by CountryId Index(es)
		 * @param integer $intCountryId
		 * @return int
		*/
		public static function CountByCountryId($intCountryId) {
			// Call StateProvince::QueryCount to perform the CountByCountryId query
			return StateProvince::QueryCount(
				QQ::Equal(QQN::StateProvince()->CountryId, $intCountryId)
			);
		}



		////////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Array via Many to Many)
		////////////////////////////////////////////////////



		//////////////////
		// SAVE AND DELETE
		//////////////////

		/**
		 * Save this StateProvince
		 * @param bool $blnForceInsert
		 * @param bool $blnForceUpdate
		 * @return int
		*/
		public function Save($blnForceInsert = false, $blnForceUpdate = false) {
			// Get the Database Object for this Class
			$objDatabase = StateProvince::GetDatabase();

			$mixToReturn = null;

			try {
				if ((!$this->__blnRestored) || ($blnForceInsert)) {
					// Perform an INSERT query
					$objDatabase->NonQuery('
						INSERT INTO `state_province` (
							`country_id`,
							`short_description`,
							`abbreviation`
						) VALUES (
							' . $objDatabase->SqlVariable($this->intCountryId) . ',
							' . $objDatabase->SqlVariable($this->strShortDescription) . ',
							' . $objDatabase->SqlVariable($this->strAbbreviation) . '
						)
					');

					// Update Identity column and return its value
					$mixToReturn = $this->intStateProvinceId = $objDatabase->InsertId('state_province', 'state_province_id');
				} else {
					// Perform an UPDATE query

					// First checking for Optimistic Locking constraints (if applicable)

					// Perform the UPDATE query
					$objDatabase->NonQuery('
						UPDATE
							`state_province`
						SET
							`country_id` = ' . $objDatabase->SqlVariable($this->intCountryId) . ',
							`short_description` = ' . $objDatabase->SqlVariable($this->strShortDescription) . ',
							`abbreviation` = ' . $objDatabase->SqlVariable($this->strAbbreviation) . '
						WHERE
							`state_province_id` = ' . $objDatabase->SqlVariable($this->intStateProvinceId) . '
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
		 * Delete this StateProvince
		 * @return void
		*/
		public function Delete() {
			if ((is_null($this->intStateProvinceId)))
				throw new QUndefinedPrimaryKeyException('Cannot delete this StateProvince with an unset primary key.');

			// Get the Database Object for this Class
			$objDatabase = StateProvince::GetDatabase();


			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`state_province`
				WHERE
					`state_province_id` = ' . $objDatabase->SqlVariable($this->intStateProvinceId) . '');
		}

		/**
		 * Delete all StateProvinces
		 * @return void
		*/
		public static function DeleteAll() {
			// Get the Database Object for this Class
			$objDatabase = StateProvince::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				DELETE FROM
					`state_province`');
		}

		/**
		 * Truncate state_province table
		 * @return void
		*/
		public static function Truncate() {
			// Get the Database Object for this Class
			$objDatabase = StateProvince::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				TRUNCATE `state_province`');
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
				case 'StateProvinceId':
					/**
					 * Gets the value for intStateProvinceId (Read-Only PK)
					 * @return integer
					 */
					return $this->intStateProvinceId;

				case 'CountryId':
					/**
					 * Gets the value for intCountryId 
					 * @return integer
					 */
					return $this->intCountryId;

				case 'ShortDescription':
					/**
					 * Gets the value for strShortDescription 
					 * @return string
					 */
					return $this->strShortDescription;

				case 'Abbreviation':
					/**
					 * Gets the value for strAbbreviation 
					 * @return string
					 */
					return $this->strAbbreviation;


				///////////////////
				// Member Objects
				///////////////////
				case 'Country':
					/**
					 * Gets the value for the Country object referenced by intCountryId 
					 * @return Country
					 */
					try {
						if ((!$this->objCountry) && (!is_null($this->intCountryId)))
							$this->objCountry = Country::Load($this->intCountryId);
						return $this->objCountry;
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}


				////////////////////////////
				// Virtual Object References (Many to Many and Reverse References)
				// (If restored via a "Many-to" expansion)
				////////////////////////////

				case '_Address':
					/**
					 * Gets the value for the private _objAddress (Read-Only)
					 * if set due to an expansion on the address.state_province_id reverse relationship
					 * @return Address
					 */
					return $this->_objAddress;

				case '_AddressArray':
					/**
					 * Gets the value for the private _objAddressArray (Read-Only)
					 * if set due to an ExpandAsArray on the address.state_province_id reverse relationship
					 * @return Address[]
					 */
					return (array) $this->_objAddressArray;

				case '_FedexShipmentAsHoldAtLocationState':
					/**
					 * Gets the value for the private _objFedexShipmentAsHoldAtLocationState (Read-Only)
					 * if set due to an expansion on the fedex_shipment.hold_at_location_state reverse relationship
					 * @return FedexShipment
					 */
					return $this->_objFedexShipmentAsHoldAtLocationState;

				case '_FedexShipmentAsHoldAtLocationStateArray':
					/**
					 * Gets the value for the private _objFedexShipmentAsHoldAtLocationStateArray (Read-Only)
					 * if set due to an ExpandAsArray on the fedex_shipment.hold_at_location_state reverse relationship
					 * @return FedexShipment[]
					 */
					return (array) $this->_objFedexShipmentAsHoldAtLocationStateArray;

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
				case 'CountryId':
					/**
					 * Sets the value for intCountryId 
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						$this->objCountry = null;
						return ($this->intCountryId = QType::Cast($mixValue, QType::Integer));
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

				case 'Abbreviation':
					/**
					 * Sets the value for strAbbreviation 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strAbbreviation = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}


				///////////////////
				// Member Objects
				///////////////////
				case 'Country':
					/**
					 * Sets the value for the Country object referenced by intCountryId 
					 * @param Country $mixValue
					 * @return Country
					 */
					if (is_null($mixValue)) {
						$this->intCountryId = null;
						$this->objCountry = null;
						return null;
					} else {
						// Make sure $mixValue actually is a Country object
						try {
							$mixValue = QType::Cast($mixValue, 'Country');
						} catch (QInvalidCastException $objExc) {
							$objExc->IncrementOffset();
							throw $objExc;
						} 

						// Make sure $mixValue is a SAVED Country object
						if (is_null($mixValue->CountryId))
							throw new QCallerException('Unable to set an unsaved Country for this StateProvince');

						// Update Local Member Variables
						$this->objCountry = $mixValue;
						$this->intCountryId = $mixValue->CountryId;

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

			
		
		// Related Objects' Methods for Address
		//-------------------------------------------------------------------

		/**
		 * Gets all associated Addresses as an array of Address objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Address[]
		*/ 
		public function GetAddressArray($objOptionalClauses = null) {
			if ((is_null($this->intStateProvinceId)))
				return array();

			try {
				return Address::LoadArrayByStateProvinceId($this->intStateProvinceId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated Addresses
		 * @return int
		*/ 
		public function CountAddresses() {
			if ((is_null($this->intStateProvinceId)))
				return 0;

			return Address::CountByStateProvinceId($this->intStateProvinceId);
		}

		/**
		 * Associates a Address
		 * @param Address $objAddress
		 * @return void
		*/ 
		public function AssociateAddress(Address $objAddress) {
			if ((is_null($this->intStateProvinceId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateAddress on this unsaved StateProvince.');
			if ((is_null($objAddress->AddressId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateAddress on this StateProvince with an unsaved Address.');

			// Get the Database Object for this Class
			$objDatabase = StateProvince::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`address`
				SET
					`state_province_id` = ' . $objDatabase->SqlVariable($this->intStateProvinceId) . '
				WHERE
					`address_id` = ' . $objDatabase->SqlVariable($objAddress->AddressId) . '
			');
		}

		/**
		 * Unassociates a Address
		 * @param Address $objAddress
		 * @return void
		*/ 
		public function UnassociateAddress(Address $objAddress) {
			if ((is_null($this->intStateProvinceId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateAddress on this unsaved StateProvince.');
			if ((is_null($objAddress->AddressId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateAddress on this StateProvince with an unsaved Address.');

			// Get the Database Object for this Class
			$objDatabase = StateProvince::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`address`
				SET
					`state_province_id` = null
				WHERE
					`address_id` = ' . $objDatabase->SqlVariable($objAddress->AddressId) . ' AND
					`state_province_id` = ' . $objDatabase->SqlVariable($this->intStateProvinceId) . '
			');
		}

		/**
		 * Unassociates all Addresses
		 * @return void
		*/ 
		public function UnassociateAllAddresses() {
			if ((is_null($this->intStateProvinceId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateAddress on this unsaved StateProvince.');

			// Get the Database Object for this Class
			$objDatabase = StateProvince::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`address`
				SET
					`state_province_id` = null
				WHERE
					`state_province_id` = ' . $objDatabase->SqlVariable($this->intStateProvinceId) . '
			');
		}

		/**
		 * Deletes an associated Address
		 * @param Address $objAddress
		 * @return void
		*/ 
		public function DeleteAssociatedAddress(Address $objAddress) {
			if ((is_null($this->intStateProvinceId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateAddress on this unsaved StateProvince.');
			if ((is_null($objAddress->AddressId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateAddress on this StateProvince with an unsaved Address.');

			// Get the Database Object for this Class
			$objDatabase = StateProvince::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`address`
				WHERE
					`address_id` = ' . $objDatabase->SqlVariable($objAddress->AddressId) . ' AND
					`state_province_id` = ' . $objDatabase->SqlVariable($this->intStateProvinceId) . '
			');
		}

		/**
		 * Deletes all associated Addresses
		 * @return void
		*/ 
		public function DeleteAllAddresses() {
			if ((is_null($this->intStateProvinceId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateAddress on this unsaved StateProvince.');

			// Get the Database Object for this Class
			$objDatabase = StateProvince::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`address`
				WHERE
					`state_province_id` = ' . $objDatabase->SqlVariable($this->intStateProvinceId) . '
			');
		}

			
		
		// Related Objects' Methods for FedexShipmentAsHoldAtLocationState
		//-------------------------------------------------------------------

		/**
		 * Gets all associated FedexShipmentsAsHoldAtLocationState as an array of FedexShipment objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return FedexShipment[]
		*/ 
		public function GetFedexShipmentAsHoldAtLocationStateArray($objOptionalClauses = null) {
			if ((is_null($this->intStateProvinceId)))
				return array();

			try {
				return FedexShipment::LoadArrayByHoldAtLocationState($this->intStateProvinceId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated FedexShipmentsAsHoldAtLocationState
		 * @return int
		*/ 
		public function CountFedexShipmentsAsHoldAtLocationState() {
			if ((is_null($this->intStateProvinceId)))
				return 0;

			return FedexShipment::CountByHoldAtLocationState($this->intStateProvinceId);
		}

		/**
		 * Associates a FedexShipmentAsHoldAtLocationState
		 * @param FedexShipment $objFedexShipment
		 * @return void
		*/ 
		public function AssociateFedexShipmentAsHoldAtLocationState(FedexShipment $objFedexShipment) {
			if ((is_null($this->intStateProvinceId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateFedexShipmentAsHoldAtLocationState on this unsaved StateProvince.');
			if ((is_null($objFedexShipment->FedexShipmentId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateFedexShipmentAsHoldAtLocationState on this StateProvince with an unsaved FedexShipment.');

			// Get the Database Object for this Class
			$objDatabase = StateProvince::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`fedex_shipment`
				SET
					`hold_at_location_state` = ' . $objDatabase->SqlVariable($this->intStateProvinceId) . '
				WHERE
					`fedex_shipment_id` = ' . $objDatabase->SqlVariable($objFedexShipment->FedexShipmentId) . '
			');
		}

		/**
		 * Unassociates a FedexShipmentAsHoldAtLocationState
		 * @param FedexShipment $objFedexShipment
		 * @return void
		*/ 
		public function UnassociateFedexShipmentAsHoldAtLocationState(FedexShipment $objFedexShipment) {
			if ((is_null($this->intStateProvinceId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateFedexShipmentAsHoldAtLocationState on this unsaved StateProvince.');
			if ((is_null($objFedexShipment->FedexShipmentId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateFedexShipmentAsHoldAtLocationState on this StateProvince with an unsaved FedexShipment.');

			// Get the Database Object for this Class
			$objDatabase = StateProvince::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`fedex_shipment`
				SET
					`hold_at_location_state` = null
				WHERE
					`fedex_shipment_id` = ' . $objDatabase->SqlVariable($objFedexShipment->FedexShipmentId) . ' AND
					`hold_at_location_state` = ' . $objDatabase->SqlVariable($this->intStateProvinceId) . '
			');
		}

		/**
		 * Unassociates all FedexShipmentsAsHoldAtLocationState
		 * @return void
		*/ 
		public function UnassociateAllFedexShipmentsAsHoldAtLocationState() {
			if ((is_null($this->intStateProvinceId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateFedexShipmentAsHoldAtLocationState on this unsaved StateProvince.');

			// Get the Database Object for this Class
			$objDatabase = StateProvince::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`fedex_shipment`
				SET
					`hold_at_location_state` = null
				WHERE
					`hold_at_location_state` = ' . $objDatabase->SqlVariable($this->intStateProvinceId) . '
			');
		}

		/**
		 * Deletes an associated FedexShipmentAsHoldAtLocationState
		 * @param FedexShipment $objFedexShipment
		 * @return void
		*/ 
		public function DeleteAssociatedFedexShipmentAsHoldAtLocationState(FedexShipment $objFedexShipment) {
			if ((is_null($this->intStateProvinceId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateFedexShipmentAsHoldAtLocationState on this unsaved StateProvince.');
			if ((is_null($objFedexShipment->FedexShipmentId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateFedexShipmentAsHoldAtLocationState on this StateProvince with an unsaved FedexShipment.');

			// Get the Database Object for this Class
			$objDatabase = StateProvince::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`fedex_shipment`
				WHERE
					`fedex_shipment_id` = ' . $objDatabase->SqlVariable($objFedexShipment->FedexShipmentId) . ' AND
					`hold_at_location_state` = ' . $objDatabase->SqlVariable($this->intStateProvinceId) . '
			');
		}

		/**
		 * Deletes all associated FedexShipmentsAsHoldAtLocationState
		 * @return void
		*/ 
		public function DeleteAllFedexShipmentsAsHoldAtLocationState() {
			if ((is_null($this->intStateProvinceId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateFedexShipmentAsHoldAtLocationState on this unsaved StateProvince.');

			// Get the Database Object for this Class
			$objDatabase = StateProvince::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`fedex_shipment`
				WHERE
					`hold_at_location_state` = ' . $objDatabase->SqlVariable($this->intStateProvinceId) . '
			');
		}




		///////////////////////////////////////////////////////////////////////
		// PROTECTED MEMBER VARIABLES and TEXT FIELD MAXLENGTHS (if applicable)
		///////////////////////////////////////////////////////////////////////
		
		/**
		 * Protected member variable that maps to the database PK Identity column state_province.state_province_id
		 * @var integer intStateProvinceId
		 */
		protected $intStateProvinceId;
		const StateProvinceIdDefault = null;


		/**
		 * Protected member variable that maps to the database column state_province.country_id
		 * @var integer intCountryId
		 */
		protected $intCountryId;
		const CountryIdDefault = null;


		/**
		 * Protected member variable that maps to the database column state_province.short_description
		 * @var string strShortDescription
		 */
		protected $strShortDescription;
		const ShortDescriptionMaxLength = 50;
		const ShortDescriptionDefault = null;


		/**
		 * Protected member variable that maps to the database column state_province.abbreviation
		 * @var string strAbbreviation
		 */
		protected $strAbbreviation;
		const AbbreviationMaxLength = 2;
		const AbbreviationDefault = null;


		/**
		 * Private member variable that stores a reference to a single Address object
		 * (of type Address), if this StateProvince object was restored with
		 * an expansion on the address association table.
		 * @var Address _objAddress;
		 */
		private $_objAddress;

		/**
		 * Private member variable that stores a reference to an array of Address objects
		 * (of type Address[]), if this StateProvince object was restored with
		 * an ExpandAsArray on the address association table.
		 * @var Address[] _objAddressArray;
		 */
		private $_objAddressArray = array();

		/**
		 * Private member variable that stores a reference to a single FedexShipmentAsHoldAtLocationState object
		 * (of type FedexShipment), if this StateProvince object was restored with
		 * an expansion on the fedex_shipment association table.
		 * @var FedexShipment _objFedexShipmentAsHoldAtLocationState;
		 */
		private $_objFedexShipmentAsHoldAtLocationState;

		/**
		 * Private member variable that stores a reference to an array of FedexShipmentAsHoldAtLocationState objects
		 * (of type FedexShipment[]), if this StateProvince object was restored with
		 * an ExpandAsArray on the fedex_shipment association table.
		 * @var FedexShipment[] _objFedexShipmentAsHoldAtLocationStateArray;
		 */
		private $_objFedexShipmentAsHoldAtLocationStateArray = array();

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
		 * in the database column state_province.country_id.
		 *
		 * NOTE: Always use the Country property getter to correctly retrieve this Country object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var Country objCountry
		 */
		protected $objCountry;






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
				$objQueryExpansion = new QQueryExpansion('StateProvince', 'state_province', $objExpansionMap);
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
				$objQueryExpansion->AddFromItem(sprintf('LEFT JOIN `state_province` AS `%s__%s` ON `%s`.`%s` = `%s__%s`.`state_province_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias, $strParentAlias, $strAlias));

				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`state_province_id` AS `%s__%s__state_province_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`country_id` AS `%s__%s__country_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`short_description` AS `%s__%s__short_description`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`abbreviation` AS `%s__%s__abbreviation`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));

				$strParentAlias = $strParentAlias . '__' . $strAlias;
			}

			if (is_array($objExpansionMap))
				foreach ($objExpansionMap as $strKey=>$objValue) {
					switch ($strKey) {
						case 'country_id':
							try {
								Country::ExpandQuery($strParentAlias, $strKey, $objValue, $objQueryExpansion);
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
		const ExpandCountry = 'country_id';




		////////////////////////////////////////
		// METHODS for WEB SERVICES
		////////////////////////////////////////

		public static function GetSoapComplexTypeXml() {
			$strToReturn = '<complexType name="StateProvince"><sequence>';
			$strToReturn .= '<element name="StateProvinceId" type="xsd:int"/>';
			$strToReturn .= '<element name="Country" type="xsd1:Country"/>';
			$strToReturn .= '<element name="ShortDescription" type="xsd:string"/>';
			$strToReturn .= '<element name="Abbreviation" type="xsd:string"/>';
			$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
			$strToReturn .= '</sequence></complexType>';
			return $strToReturn;
		}

		public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
			if (!array_key_exists('StateProvince', $strComplexTypeArray)) {
				$strComplexTypeArray['StateProvince'] = StateProvince::GetSoapComplexTypeXml();
				Country::AlterSoapComplexTypeArray($strComplexTypeArray);
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, StateProvince::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new StateProvince();
			if (property_exists($objSoapObject, 'StateProvinceId'))
				$objToReturn->intStateProvinceId = $objSoapObject->StateProvinceId;
			if ((property_exists($objSoapObject, 'Country')) &&
				($objSoapObject->Country))
				$objToReturn->Country = Country::GetObjectFromSoapObject($objSoapObject->Country);
			if (property_exists($objSoapObject, 'ShortDescription'))
				$objToReturn->strShortDescription = $objSoapObject->ShortDescription;
			if (property_exists($objSoapObject, 'Abbreviation'))
				$objToReturn->strAbbreviation = $objSoapObject->Abbreviation;
			if (property_exists($objSoapObject, '__blnRestored'))
				$objToReturn->__blnRestored = $objSoapObject->__blnRestored;
			return $objToReturn;
		}

		public static function GetSoapArrayFromArray($objArray) {
			if (!$objArray)
				return null;

			$objArrayToReturn = array();

			foreach ($objArray as $objObject)
				array_push($objArrayToReturn, StateProvince::GetSoapObjectFromObject($objObject, true));

			return unserialize(serialize($objArrayToReturn));
		}

		public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
			if ($objObject->objCountry)
				$objObject->objCountry = Country::GetSoapObjectFromObject($objObject->objCountry, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intCountryId = null;
			return $objObject;
		}
	}





	/////////////////////////////////////
	// ADDITIONAL CLASSES for QCODO QUERY
	/////////////////////////////////////

	class QQNodeStateProvince extends QQNode {
		protected $strTableName = 'state_province';
		protected $strPrimaryKey = 'state_province_id';
		protected $strClassName = 'StateProvince';
		public function __get($strName) {
			switch ($strName) {
				case 'StateProvinceId':
					return new QQNode('state_province_id', 'integer', $this);
				case 'CountryId':
					return new QQNode('country_id', 'integer', $this);
				case 'Country':
					return new QQNodeCountry('country_id', 'integer', $this);
				case 'ShortDescription':
					return new QQNode('short_description', 'string', $this);
				case 'Abbreviation':
					return new QQNode('abbreviation', 'string', $this);
				case 'Address':
					return new QQReverseReferenceNodeAddress($this, 'address', 'reverse_reference', 'state_province_id');
				case 'FedexShipmentAsHoldAtLocationState':
					return new QQReverseReferenceNodeFedexShipment($this, 'fedexshipmentasholdatlocationstate', 'reverse_reference', 'hold_at_location_state');

				case '_PrimaryKeyNode':
					return new QQNode('state_province_id', 'integer', $this);
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

	class QQReverseReferenceNodeStateProvince extends QQReverseReferenceNode {
		protected $strTableName = 'state_province';
		protected $strPrimaryKey = 'state_province_id';
		protected $strClassName = 'StateProvince';
		public function __get($strName) {
			switch ($strName) {
				case 'StateProvinceId':
					return new QQNode('state_province_id', 'integer', $this);
				case 'CountryId':
					return new QQNode('country_id', 'integer', $this);
				case 'Country':
					return new QQNodeCountry('country_id', 'integer', $this);
				case 'ShortDescription':
					return new QQNode('short_description', 'string', $this);
				case 'Abbreviation':
					return new QQNode('abbreviation', 'string', $this);
				case 'Address':
					return new QQReverseReferenceNodeAddress($this, 'address', 'reverse_reference', 'state_province_id');
				case 'FedexShipmentAsHoldAtLocationState':
					return new QQReverseReferenceNodeFedexShipment($this, 'fedexshipmentasholdatlocationstate', 'reverse_reference', 'hold_at_location_state');

				case '_PrimaryKeyNode':
					return new QQNode('state_province_id', 'integer', $this);
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