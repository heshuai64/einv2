<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the AuditScan class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of AuditScan objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this AuditScanListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class AuditScanListFormBase extends QForm {
		protected $dtgAuditScan;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colAuditScanId;
		protected $colAuditId;
		protected $colLocationId;
		protected $colEntityId;
		protected $colCount;
		protected $colSystemCount;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgAuditScan_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colAuditScanId = new QDataGridColumn(QApplication::Translate('Audit Scan Id'), '<?= $_ITEM->AuditScanId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::AuditScan()->AuditScanId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::AuditScan()->AuditScanId, false)));
			$this->colAuditId = new QDataGridColumn(QApplication::Translate('Audit Id'), '<?= $_FORM->dtgAuditScan_Audit_Render($_ITEM); ?>');
			$this->colLocationId = new QDataGridColumn(QApplication::Translate('Location Id'), '<?= $_FORM->dtgAuditScan_Location_Render($_ITEM); ?>');
			$this->colEntityId = new QDataGridColumn(QApplication::Translate('Entity Id'), '<?= $_ITEM->EntityId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::AuditScan()->EntityId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::AuditScan()->EntityId, false)));
			$this->colCount = new QDataGridColumn(QApplication::Translate('Count'), '<?= $_ITEM->Count; ?>', array('OrderByClause' => QQ::OrderBy(QQN::AuditScan()->Count), 'ReverseOrderByClause' => QQ::OrderBy(QQN::AuditScan()->Count, false)));
			$this->colSystemCount = new QDataGridColumn(QApplication::Translate('System Count'), '<?= $_ITEM->SystemCount; ?>', array('OrderByClause' => QQ::OrderBy(QQN::AuditScan()->SystemCount), 'ReverseOrderByClause' => QQ::OrderBy(QQN::AuditScan()->SystemCount, false)));

			// Setup DataGrid
			$this->dtgAuditScan = new QDataGrid($this);
			$this->dtgAuditScan->CellSpacing = 0;
			$this->dtgAuditScan->CellPadding = 4;
			$this->dtgAuditScan->BorderStyle = QBorderStyle::Solid;
			$this->dtgAuditScan->BorderWidth = 1;
			$this->dtgAuditScan->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgAuditScan->Paginator = new QPaginator($this->dtgAuditScan);
			$this->dtgAuditScan->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgAuditScan->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgAuditScan->SetDataBinder('dtgAuditScan_Bind');

			$this->dtgAuditScan->AddColumn($this->colEditLinkColumn);
			$this->dtgAuditScan->AddColumn($this->colAuditScanId);
			$this->dtgAuditScan->AddColumn($this->colAuditId);
			$this->dtgAuditScan->AddColumn($this->colLocationId);
			$this->dtgAuditScan->AddColumn($this->colEntityId);
			$this->dtgAuditScan->AddColumn($this->colCount);
			$this->dtgAuditScan->AddColumn($this->colSystemCount);
		}
		
		public function dtgAuditScan_EditLinkColumn_Render(AuditScan $objAuditScan) {
			return sprintf('<a href="audit_scan_edit.php?intAuditScanId=%s">%s</a>',
				$objAuditScan->AuditScanId, 
				QApplication::Translate('Edit'));
		}

		public function dtgAuditScan_Audit_Render(AuditScan $objAuditScan) {
			if (!is_null($objAuditScan->Audit))
				return $objAuditScan->Audit->__toString();
			else
				return null;
		}

		public function dtgAuditScan_Location_Render(AuditScan $objAuditScan) {
			if (!is_null($objAuditScan->Location))
				return $objAuditScan->Location->__toString();
			else
				return null;
		}


		protected function dtgAuditScan_Bind() {
			// Because we want to enable pagination AND sorting, we need to setup the $objClauses array to send to LoadAll()

			// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
			$this->dtgAuditScan->TotalItemCount = AuditScan::CountAll();

			// Setup the $objClauses Array
			$objClauses = array();

			// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
			// the OrderByClause to the $objClauses array
			if ($objClause = $this->dtgAuditScan->OrderByClause)
				array_push($objClauses, $objClause);

			// Add the LimitClause information, as well
			if ($objClause = $this->dtgAuditScan->LimitClause)
				array_push($objClauses, $objClause);

			// Set the DataSource to be the array of all AuditScan objects, given the clauses above
			$this->dtgAuditScan->DataSource = AuditScan::LoadAll($objClauses);
		}
	}
?>