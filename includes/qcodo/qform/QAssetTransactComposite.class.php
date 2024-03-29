<?php
/*
 * Copyright (c)  2006, Universal Diagnostic Solutions, Inc. 
 *
 * This file is part of Tracmor.  
 *
 * Tracmor is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version. 
 *	
 * Tracmor is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Tracmor; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */
?>

<?php

class QAssetTransactComposite extends QControl {
	
	public $blnEditMode;
	public $objParentObject;
	public $strTitleVerb;
	public $objAssetArray;
	public $dtgAssetTransact;
	public $objAsset;
	
	public $blnTransactionModified;
	protected $lstLocation;
	protected $txtNote;
	protected $objAssetTransaction;	
	protected $btnSave;
	protected $btnCancel;
	protected $btnAdd;
	protected $btnRemove;
	protected $txtNewAssetCode;
	protected $objTransaction;
	protected $intTransactionTypeId;
	
	public function __construct($objParentObject, $strControlId = null) {
	    // First, call the parent to do most of the basic setup
    try {
        parent::__construct($objParentObject, $strControlId);
    } catch (QCallerException $objExc) {
        $objExc->IncrementOffset();
        throw $objExc;
    }
    
    // Assign the parent object (AssetEditForm from asset_edit.php)
    $this->objParentObject = $objParentObject;
    
    // Setup the Asset, which assigns objAsset and blnEditMode
    $this->objParentObject->SetupAsset($this);

    // Create an empty Asset Array
    $this->objAssetArray = array();
    
    $this->btnCancel_Create();
    $this->lstLocation_Create();
    $this->txtNote_Create();
    $this->txtNewAssetCode_Create();
    $this->btnAdd_Create();
    $this->btnSave_Create();
    $this->dtgAssetTransact_Create();
    
	}
  
	// This method must be declared in all composite controls
	public function ParsePostData() {
	}
	
	public function GetJavaScriptAction() {
			return "onchange";
	}
	
	public function Validate() {return true;}
	
	protected function GetControlHtml() {
		
		$strStyle = $this->GetStyleAttributes();
		if ($strStyle) {
			$strStyle = sprintf('style="%s"', $strStyle);
		}
		$strAttributes = $this->GetAttributes();
		
		// Store the Output Buffer locally
		$strAlreadyRendered = ob_get_contents();
		ob_clean();

		// Evaluate the template
		require('asset_transact_control.inc.php');
		$strTemplateEvaluated = ob_get_contents();
		ob_clean();

		// Restore the output buffer and return evaluated template
		print($strAlreadyRendered);
		
		$strToReturn =  sprintf('<span id="%s" %s%s>%s</span>',
		$this->strControlId,
		$strStyle,
		$strAttributes,
		$strTemplateEvaluated);
		
		return $strToReturn;
	}
	
	// I'm pretty sure that this is not necessary
	// Create the Asset Code label
	protected function lblAssetCode_Create() {
		$this->lblAssetCode = new QLabel($this);
		$this->lblAssetCode->Name = 'Asset Code';
		$this->lblAssetCode->Text = $this->objAsset->AssetCode;
	}
	
	// Create the Note text field
	protected function txtNote_Create() {
		$this->txtNote = new QTextBox($this);
		$this->txtNote->Name = 'Note';
		$this->txtNote->TextMode = QTextMode::MultiLine;
		$this->txtNote->Columns = 80;
		$this->txtNote->Rows = 4;
		$this->txtNote->CausesValidation = false;
	}
	
	// Create and Setup lstLocation
	protected function lstLocation_Create() {
		$this->lstLocation = new QListBox($this);
		$this->lstLocation->Name = 'Location';
		$this->lstLocation->AddItem('- Select One -', null);
		$objLocationArray = Location::LoadAllLocations(false, false, 'short_description');
		if ($objLocationArray) foreach ($objLocationArray as $objLocation) {
			$objListItem = new QListItem($objLocation->__toString(), $objLocation->LocationId);
			$this->lstLocation->AddItem($objListItem);
		}
		$this->lstLocation->CausesValidation = false;
	}
	
	// Create the text field to enter new asset codes to add to the transaction
	// Eventually this field will receive information from the AML
	protected function txtNewAssetCode_Create() {
		$this->txtNewAssetCode = new QTextBox($this);
		$this->txtNewAssetCode->Name = 'Asset Code';
		$this->txtNewAssetCode->AddAction(new QEnterKeyEvent(), new QAjaxControlAction($this, 'btnAdd_Click'));
		$this->txtNewAssetCode->AddAction(new QEnterKeyEvent(), new QTerminateAction());
		$this->txtNewAssetCode->CausesValidation = false;
	}
	
	// Create the save button
	protected function btnSave_Create() {
		$this->btnSave = new QButton($this);
		$this->btnSave->Text = 'Save';
		$this->btnSave->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnSave_Click'));
		$this->btnSave->AddAction(new QEnterKeyEvent(), new QAjaxControlAction($this, 'btnSave_Click'));
		$this->btnSave->AddAction(new QEnterKeyEvent(), new QTerminateAction());
		$this->btnSave->CausesValidation = false;
	}

	// Setup Cancel Button
	protected function btnCancel_Create() {
		$this->btnCancel = new QButton($this);
		$this->btnCancel->Text = 'Cancel';
		$this->btnCancel->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCancel_Click'));
		$this->btnCancel->AddAction(new QEnterKeyEvent(), new QAjaxControlAction($this, 'btnCancel_Click'));
		$this->btnCancel->AddAction(new QEnterKeyEvent(), new QTerminateAction());
		$this->btnCancel->CausesValidation = false;
	}

	// Setup Add Button
	protected function btnAdd_Create() {
		$this->btnAdd = new QButton($this);
		$this->btnAdd->Text = 'Add';
		$this->btnAdd->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnAdd_Click'));
		$this->btnAdd->AddAction(new QEnterKeyEvent(), new QAjaxControlAction($this, 'btnAdd_Click'));
		$this->btnAdd->AddAction(new QEnterKeyEvent(), new QTerminateAction());
		$this->btnAdd->CausesValidation = false;
	}
	
	// Setup the datagrid
	protected function dtgAssetTransact_Create() {
		
		$this->dtgAssetTransact = new QDataGrid($this);
		$this->dtgAssetTransact->CellPadding = 5;
		$this->dtgAssetTransact->CellSpacing = 0;
		$this->dtgAssetTransact->CssClass = "datagrid";
		
    // Enable AJAX - this won't work while using the DB profiler
    $this->dtgAssetTransact->UseAjax = true;

    // Enable Pagination, and set to 20 items per page
    $objPaginator = new QPaginator($this->dtgAssetTransact);
    $this->dtgAssetTransact->Paginator = $objPaginator;
    $this->dtgAssetTransact->ItemsPerPage = 20;
    
    $this->dtgAssetTransact->AddColumn(new QDataGridColumn('Asset Code', '<?= $_ITEM->__toStringWithLink("bluelink") ?>', array('OrderByClause' => QQ::OrderBy(QQN::Asset()->AssetCode), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Asset()->AssetCode, false), 'CssClass' => "dtg_column", 'HtmlEntities' => false)));
    $this->dtgAssetTransact->AddColumn(new QDataGridColumn('Model', '<?= $_ITEM->AssetModel->__toStringWithLink("bluelink") ?>', array('OrderByClause' => QQ::OrderBy(QQN::Asset()->AssetModel->ShortDescription), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Asset()->AssetModel->ShortDescription, false), 'Width' => 200, 'CssClass' => "dtg_column", 'HtmlEntities' => false)));
    $this->dtgAssetTransact->AddColumn(new QDataGridColumn('Current Location', '<?= $_ITEM->Location->__toString() ?>', array('OrderByClause' => QQ::OrderBy(QQN::Asset()->Location->ShortDescription), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Asset()->Location->ShortDescription, false), 'CssClass' => "dtg_column", 'HtmlEntities' => false)));
    $this->dtgAssetTransact->AddColumn(new QDataGridColumn('Action', '<?= $_FORM->RemoveColumn_Render($_ITEM) ?>', array('CssClass' => "dtg_column", 'HtmlEntities' => false)));

/*    $this->dtgAssetTransact->AddColumn(new QDataGridColumn('Asset Code', '<?= $_ITEM->__toStringWithLink("bluelink") ?>', 'SortByCommand="asset_code ASC"', 'ReverseSortByCommand="asset_code DESC"', 'CssClass="dtg_column"', 'HtmlEntities=false"'));
    $this->dtgAssetTransact->AddColumn(new QDataGridColumn('Model', '<?= $_ITEM->AssetModel->__toStringWithLink("bluelink") ?>', 'Width=200', 'SortByCommand="asset__asset_model_id__short_description ASC"', 'ReverseSortByCommand="asset__asset_model_id__short_description DESC"', 'CssClass="dtg_column"', 'HtmlEntities=false"'));
    $this->dtgAssetTransact->AddColumn(new QDataGridColumn('Current Location', '<?= $_ITEM->Location->__toString() ?>', 'SortByCommand="asset__location_id__short_description ASC"', 'ReverseSortByCommand="asset__location_id__short_description DESC"', 'CssClass=dtg_column', 'HtmlEntities=false"'));
    $this->dtgAssetTransact->AddColumn(new QDataGridColumn('Action', '<?= $_FORM->RemoveColumn_Render($_ITEM) ?>', 'CssClass=dtg_column', 'HtmlEntities=false"'));
*/
    $objStyle = $this->dtgAssetTransact->RowStyle;
    $objStyle->ForeColor = '#000000';
    $objStyle->BackColor = '#FFFFFF';
    $objStyle->FontSize = 12;

    $objStyle = $this->dtgAssetTransact->AlternateRowStyle;
    $objStyle->BackColor = '#EFEFEF';

    $objStyle = $this->dtgAssetTransact->HeaderRowStyle;
    $objStyle->ForeColor = '#000000';
    $objStyle->BackColor = '#EFEFEF';
    $objStyle->CssClass = 'dtg_header';
    
		$this->blnTransactionModified = true;
	}
	
	// Add Button Click
	public function btnAdd_Click($strFormId, $strControlId, $strParameter) {
		
		$strAssetCode = $this->txtNewAssetCode->Text;
		$blnDuplicate = false;
		$blnError = false;
		
		if ($strAssetCode) {
			// Begin error checking
			if ($this->objAssetArray) {
				foreach ($this->objAssetArray as $asset) {
					if ($asset && $asset->AssetCode == $strAssetCode) {
						$blnError = true;
						$this->txtNewAssetCode->Warning = "That asset has already been added.";
					}
				}
			}
			
			if (!$blnError) {
				$objNewAsset = Asset::LoadByAssetCode($this->txtNewAssetCode->Text);
				if (!($objNewAsset instanceof Asset)) {
					$blnError = true;
					$this->txtNewAssetCode->Warning = "That asset code does not exist.";
				}				
				// Cannot move, check out/in, nor reserve/unreserve any assets that have been shipped
				elseif ($objNewAsset->LocationId == 2) {
					$blnError = true;
					$this->txtNewAssetCode->Warning = "That asset has already been shipped.";
				}
				// Cannot move, check out/in, nor reserve/unreserve any assets that are scheduled to  be received
				elseif ($objNewAsset->LocationId == 5) {
					$blnError = true;
					$this->txtNewAssetCode->Warning = "That asset is currently scheduled to be received.";
				}
				elseif ($objPendingShipment = AssetTransaction::PendingShipment($objNewAsset->AssetId)) {
					$blnError = true;
					$this->txtNewAssetCode->Warning = "That asset is already in a pending shipment.";
				}
				elseif (!QApplication::AuthorizeEntityBoolean($objNewAsset, 2)) {
					$blnError = true;
					$this->txtNewAssetCode->Warning = "You do not have authorization to perform a transaction on this asset.";
				}
				// Move
				elseif ($this->intTransactionTypeId == 1) {
					if ($objNewAsset->CheckedOutFlag) {
						$blnError = true;
						$this->txtNewAssetCode->Warning = "That asset is checked out.";
					}
					elseif ($objNewAsset->ReservedFlag) {
						$blnError = true;
						$this->txtNewAssetCode->Warning = "That asset is reserved.";
					}
				}
				// Check in
				elseif ($this->intTransactionTypeId == 2) {
					if (!$objNewAsset->CheckedOutFlag) {
						$blnError = true;
						$this->txtNewAssetCode->Warning = "That asset is not checked out.";
					}
					elseif ($objNewAsset->ReservedFlag) {
						$blnError = true;
						$this->txtNewAssetCode->Warning = "That asset is reserved.";
					}
					elseif ($objNewAsset->CheckedOutFlag) {
						$objUserAccount = $objNewAsset->GetLastTransactionUser();
						if ($objUserAccount->UserAccountId != QApplication::$objUserAccount->UserAccountId) {
							$blnError = true;
							$this->txtNewAssetCode->Warning = "That asset was not checked out by the current user.";
						}
					}
				}
				elseif ($this->intTransactionTypeId ==3) {
					if ($objNewAsset->CheckedOutFlag) {
						$blnError = true;
						$this->txtNewAssetCode->Warning = "That asset is already checked out.";
					}
					elseif ($objNewAsset->ReservedFlag) {
						$blnError = true;
						$this->txtNewAssetCode->Warning = "That asset is reserved.";
					}
				}
				elseif ($this->intTransactionTypeId == 8) {
					if ($objNewAsset->ReservedFlag) {
						$blnError = true;
						$this->txtNewAssetCode->Warning = "That asset is already reserved.";
					}
					elseif ($objNewAsset->CheckedOutFlag) {
						$blnError = true;
						$this->txtNewAssetCode->Warning = "That asset is checked out.";
					}
				}
				// Unreserver
				elseif ($this->intTransactionTypeId == 9) {
					if (!$objNewAsset->ReservedFlag) {
						$blnError = true;
						$this->txtNewAssetCode->Warning = "That asset is not reserved";
					}
					elseif ($objNewAsset->CheckedOutFlag) {
						$blnError = true;
						$this->txtNewAssetCode->Warning = "That asset is checked out.";
					}
					elseif ($objNewAsset->ReservedFlag) {
						$objUserAccount = $objNewAsset->GetLastTransactionUser();
						if ($objUserAccount->UserAccountId != QApplication::$objUserAccount->UserAccountId) {
							$blnError = true;
							$this->txtNewAssetCode->Warning = "That asset was not reserved by the current user.";
						}
					}
				}
				if (!$blnError && $objNewAsset instanceof Asset)  {
					$this->objAssetArray[] = $objNewAsset;
					$this->txtNewAssetCode->Text = null;
				}
			}
		}
		else {
			$this->txtNewAssetCode->Warning = "Please enter an asset code.";
		}
	}	
	
	// Save Button Click
	public function btnSave_Click($strFormId, $strControlId, $strParameter) {
		if ($this->objAssetArray) {
			$blnError = false;
			
			foreach ($this->objAssetArray as $asset) {
				// TransactionTypeId = 1 is for moves
				if ($this->intTransactionTypeId == 1) {
					if ($asset->LocationId == $this->lstLocation->SelectedValue) {
						$this->dtgAssetTransact->Warning = 'Cannot move an asset from a location to the same location.';
						$blnError = true;
					}
				}
				
				// For all transactions except Unreserve, make sure the asset is not already reserved
				if ($this->intTransactionTypeId != 9 && $asset->ReservedFlag) {
					$this->btnCancel->Warning = sprintf('The Asset %s is reserved.',$asset->AssetCode);
					$blnError = true;
				}	
							
			}
			
			if (!$blnError) {
				
				if (($this->intTransactionTypeId == 1 || $this->intTransactionTypeId == 2) && is_null($this->lstLocation->SelectedValue)) {
					$this->lstLocation->Warning = 'Location is required.';
					$blnError = true;
				}
				elseif ($this->txtNote->Text == '') {
					$this->txtNote->Warning = 'Note is required.';
					$blnError = true;
				}
			}
			if (!$blnError) {
				
				try {
					// Get an instance of the database
					$objDatabase = QApplication::$Database[1];
					// Begin a MySQL Transaction to be either committed or rolled back
					$objDatabase->TransactionBegin();
					
					// Create the new transaction object and save it
					$this->objTransaction = new Transaction();
					// Entity Qtype is Asset
					$this->objTransaction->EntityQtypeId = EntityQtype::Asset;
					$this->objTransaction->TransactionTypeId = $this->intTransactionTypeId;
					$this->objTransaction->Note = $this->txtNote->Text;
					$this->objTransaction->Save();
					
					// Assign different source and destinations depending on transaction type
					foreach ($this->objAssetArray as $asset) {
						if ($asset instanceof Asset) {
							
							$SourceLocationId = $asset->LocationId;
							
							if ($this->intTransactionTypeId == 1) {
								$DestinationLocationId = $this->lstLocation->SelectedValue;
							}
							elseif ($this->intTransactionTypeId == 2) {
								$DestinationLocationId = $this->lstLocation->SelectedValue;
								$asset->CheckedOutFlag = false;
							}
							elseif ($this->intTransactionTypeId == 3) {
								$DestinationLocationId = 1;
								$asset->CheckedOutFlag = true;
							}
							elseif ($this->intTransactionTypeId == 8) {
								$DestinationLocationId = $asset->LocationId;
								$asset->ReservedFlag = true;
							}
							elseif ($this->intTransactionTypeId == 9) {
								$DestinationLocationId = $asset->LocationId;
								$asset->ReservedFlag = false;
							}
							$asset->LocationId = $DestinationLocationId;
							$asset->Save();
							
							// Create the new assettransaction object and save it
							$this->objAssetTransaction = new AssetTransaction();
							$this->objAssetTransaction->AssetId = $asset->AssetId;
							$this->objAssetTransaction->TransactionId = $this->objTransaction->TransactionId;
							$this->objAssetTransaction->SourceLocationId = $SourceLocationId;
							$this->objAssetTransaction->DestinationLocationId = $DestinationLocationId;
							$this->objAssetTransaction->Save();
						}
					}
					
					// Commit the above transactions to the database
					$objDatabase->TransactionCommit();
					
					QApplication::Redirect('../common/transaction_edit.php?intTransactionId='.$this->objTransaction->TransactionId);
				}
				catch (QOptimisticLockingException $objExc) {
					
					// Rollback the database
					$objDatabase->TransactionRollback();
					
					$objAsset = Asset::Load($objExc->EntityId);
					$this->objParentObject->btnRemove_Click($this->objParentObject->FormId, 'btnRemove' . $objExc->EntityId, $objExc->EntityId);
          // Lock Exception Thrown, Report the Error
          $this->btnCancel->Warning = sprintf('The Asset %s has been altered by another user and removed from the transaction. You may add the asset again or save the transaction without it.', $objAsset->AssetCode);
				}
			}
		}
	}
	
	// Cancel Button Click
	public function btnCancel_Click($strFormId, $strControlId, $strParameter) {
		
		if ($this->blnEditMode) {
			$this->objParentObject->DisplayTransaction(false);
			$this->objAssetArray = null;
			$this->txtNewAssetCode->Text = null;
			$this->txtNote->Text = null;
			$this->objParentObject->DisplayEdit(true);
			$this->objAssetArray[] = $this->objAsset;
		}
		else {
			QApplication::Redirect('asset_list.php');
		}

	}
	
	// Prepare the Transaction form display depending on transaction type
	public function SetupDisplay($intTransactionTypeId) {
		$this->intTransactionTypeId = $intTransactionTypeId;
		switch ($this->intTransactionTypeId) {
			// Move
			case 1:
				$this->lstLocation->Display = true;
				break;
			// Check In
			case 2:
				$this->lstLocation->Display = true;
				break;
			// Check Out
			case 3: 
				$this->lstLocation->Display = false;
				break;
			// Reserve
			case 8:
				$this->lstLocation->Display = false;
				break;
			// Unreserve
			case 9:
				$this->lstLocation->Display = false;
				break;
		}
		
		// Redeclare in case the asset has been edited
		$this->objAssetArray = null;
		if ($this->blnEditMode && $this->objAsset instanceof Asset) {
			$this->objAssetArray[] = Asset::Load($this->objAsset->AssetId);
		}
		
	}
	
  // And our public getter/setters
  public function __get($strName) {
	  switch ($strName) {
	  	case "objAsset": return $this->objAsset;
	  	case "objAssetArray": return $this->objAssetArray;
	  	case "dtgAssetTransact": return $this->dtgAssetTransact;
	  	case "intTransactionTypeId": return $this->intTransactionTypeId;
	  	case "blnTransactionModified": return $this->blnTransactionModified;
      default:
        try {
            return parent::__get($strName);
        } catch (QCallerException $objExc) {
            $objExc->IncrementOffset();
            throw $objExc;
        }
	  }
  }
  
	/////////////////////////
	// Public Properties: SET
	/////////////////////////
	public function __set($strName, $mixValue) {
		$this->blnModified = true;

		switch ($strName) {
	    case "objAsset": $this->objAsset = $mixValue;
	    	break;
	    case "objAssetArray": $this->objAssetArray = $mixValue;
	    	break;
	    case "strTitleVerb": $this->strTitleVerb = $mixValue;
	    	break;
	    case "blnEditMode": $this->blnEditMode = $mixValue;
	    	break;
	    case "dtgAssetTransact": $this->dtgAssetTransact = $mixValue;
	    	break;
	    case "intTransactionTypeId": $this->intTransactionTypeId = $mixValue;
	    	break;
	    case "blnTransactionModified": $this->blnTransactionModified = $mixValue;
			default:
				try {
					parent::__set($strName, $mixValue);
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}
				break;
		}
	}
	
}

?>