<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the DatagridColumnPreference class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of DatagridColumnPreference objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this DatagridColumnPreferenceListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class DatagridColumnPreferenceListFormBase extends QForm {
		protected $dtgDatagridColumnPreference;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colDatagridColumnPreferenceId;
		protected $colDatagridId;
		protected $colColumnName;
		protected $colUserAccountId;
		protected $colDisplayFlag;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgDatagridColumnPreference_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colDatagridColumnPreferenceId = new QDataGridColumn(QApplication::Translate('Datagrid Column Preference Id'), '<?= $_ITEM->DatagridColumnPreferenceId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::DatagridColumnPreference()->DatagridColumnPreferenceId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::DatagridColumnPreference()->DatagridColumnPreferenceId, false)));
			$this->colDatagridId = new QDataGridColumn(QApplication::Translate('Datagrid Id'), '<?= $_FORM->dtgDatagridColumnPreference_Datagrid_Render($_ITEM); ?>');
			$this->colColumnName = new QDataGridColumn(QApplication::Translate('Column Name'), '<?= QString::Truncate($_ITEM->ColumnName, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::DatagridColumnPreference()->ColumnName), 'ReverseOrderByClause' => QQ::OrderBy(QQN::DatagridColumnPreference()->ColumnName, false)));
			$this->colUserAccountId = new QDataGridColumn(QApplication::Translate('User Account Id'), '<?= $_FORM->dtgDatagridColumnPreference_UserAccount_Render($_ITEM); ?>');
			$this->colDisplayFlag = new QDataGridColumn(QApplication::Translate('Display Flag'), '<?= ($_ITEM->DisplayFlag) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::DatagridColumnPreference()->DisplayFlag), 'ReverseOrderByClause' => QQ::OrderBy(QQN::DatagridColumnPreference()->DisplayFlag, false)));

			// Setup DataGrid
			$this->dtgDatagridColumnPreference = new QDataGrid($this);
			$this->dtgDatagridColumnPreference->CellSpacing = 0;
			$this->dtgDatagridColumnPreference->CellPadding = 4;
			$this->dtgDatagridColumnPreference->BorderStyle = QBorderStyle::Solid;
			$this->dtgDatagridColumnPreference->BorderWidth = 1;
			$this->dtgDatagridColumnPreference->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgDatagridColumnPreference->Paginator = new QPaginator($this->dtgDatagridColumnPreference);
			$this->dtgDatagridColumnPreference->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgDatagridColumnPreference->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgDatagridColumnPreference->SetDataBinder('dtgDatagridColumnPreference_Bind');

			$this->dtgDatagridColumnPreference->AddColumn($this->colEditLinkColumn);
			$this->dtgDatagridColumnPreference->AddColumn($this->colDatagridColumnPreferenceId);
			$this->dtgDatagridColumnPreference->AddColumn($this->colDatagridId);
			$this->dtgDatagridColumnPreference->AddColumn($this->colColumnName);
			$this->dtgDatagridColumnPreference->AddColumn($this->colUserAccountId);
			$this->dtgDatagridColumnPreference->AddColumn($this->colDisplayFlag);
		}
		
		public function dtgDatagridColumnPreference_EditLinkColumn_Render(DatagridColumnPreference $objDatagridColumnPreference) {
			return sprintf('<a href="datagrid_column_preference_edit.php?intDatagridColumnPreferenceId=%s">%s</a>',
				$objDatagridColumnPreference->DatagridColumnPreferenceId, 
				QApplication::Translate('Edit'));
		}

		public function dtgDatagridColumnPreference_Datagrid_Render(DatagridColumnPreference $objDatagridColumnPreference) {
			if (!is_null($objDatagridColumnPreference->Datagrid))
				return $objDatagridColumnPreference->Datagrid->__toString();
			else
				return null;
		}

		public function dtgDatagridColumnPreference_UserAccount_Render(DatagridColumnPreference $objDatagridColumnPreference) {
			if (!is_null($objDatagridColumnPreference->UserAccount))
				return $objDatagridColumnPreference->UserAccount->__toString();
			else
				return null;
		}


		protected function dtgDatagridColumnPreference_Bind() {
			// Because we want to enable pagination AND sorting, we need to setup the $objClauses array to send to LoadAll()

			// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
			$this->dtgDatagridColumnPreference->TotalItemCount = DatagridColumnPreference::CountAll();

			// Setup the $objClauses Array
			$objClauses = array();

			// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
			// the OrderByClause to the $objClauses array
			if ($objClause = $this->dtgDatagridColumnPreference->OrderByClause)
				array_push($objClauses, $objClause);

			// Add the LimitClause information, as well
			if ($objClause = $this->dtgDatagridColumnPreference->LimitClause)
				array_push($objClauses, $objClause);

			// Set the DataSource to be the array of all DatagridColumnPreference objects, given the clauses above
			$this->dtgDatagridColumnPreference->DataSource = DatagridColumnPreference::LoadAll($objClauses);
		}
	}
?>