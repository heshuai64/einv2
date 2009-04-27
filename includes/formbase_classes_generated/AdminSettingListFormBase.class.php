<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the AdminSetting class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of AdminSetting objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this AdminSettingListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class AdminSettingListFormBase extends QForm {
		protected $dtgAdminSetting;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colSettingId;
		protected $colShortDescription;
		protected $colValue;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgAdminSetting_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colSettingId = new QDataGridColumn(QApplication::Translate('Setting Id'), '<?= $_ITEM->SettingId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::AdminSetting()->SettingId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::AdminSetting()->SettingId, false)));
			$this->colShortDescription = new QDataGridColumn(QApplication::Translate('Short Description'), '<?= QString::Truncate($_ITEM->ShortDescription, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::AdminSetting()->ShortDescription), 'ReverseOrderByClause' => QQ::OrderBy(QQN::AdminSetting()->ShortDescription, false)));
			$this->colValue = new QDataGridColumn(QApplication::Translate('Value'), '<?= QString::Truncate($_ITEM->Value, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::AdminSetting()->Value), 'ReverseOrderByClause' => QQ::OrderBy(QQN::AdminSetting()->Value, false)));

			// Setup DataGrid
			$this->dtgAdminSetting = new QDataGrid($this);
			$this->dtgAdminSetting->CellSpacing = 0;
			$this->dtgAdminSetting->CellPadding = 4;
			$this->dtgAdminSetting->BorderStyle = QBorderStyle::Solid;
			$this->dtgAdminSetting->BorderWidth = 1;
			$this->dtgAdminSetting->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgAdminSetting->Paginator = new QPaginator($this->dtgAdminSetting);
			$this->dtgAdminSetting->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgAdminSetting->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgAdminSetting->SetDataBinder('dtgAdminSetting_Bind');

			$this->dtgAdminSetting->AddColumn($this->colEditLinkColumn);
			$this->dtgAdminSetting->AddColumn($this->colSettingId);
			$this->dtgAdminSetting->AddColumn($this->colShortDescription);
			$this->dtgAdminSetting->AddColumn($this->colValue);
		}
		
		public function dtgAdminSetting_EditLinkColumn_Render(AdminSetting $objAdminSetting) {
			return sprintf('<a href="admin_setting_edit.php?intSettingId=%s">%s</a>',
				$objAdminSetting->SettingId, 
				QApplication::Translate('Edit'));
		}


		protected function dtgAdminSetting_Bind() {
			// Because we want to enable pagination AND sorting, we need to setup the $objClauses array to send to LoadAll()

			// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
			$this->dtgAdminSetting->TotalItemCount = AdminSetting::CountAll();

			// Setup the $objClauses Array
			$objClauses = array();

			// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
			// the OrderByClause to the $objClauses array
			if ($objClause = $this->dtgAdminSetting->OrderByClause)
				array_push($objClauses, $objClause);

			// Add the LimitClause information, as well
			if ($objClause = $this->dtgAdminSetting->LimitClause)
				array_push($objClauses, $objClause);

			// Set the DataSource to be the array of all AdminSetting objects, given the clauses above
			$this->dtgAdminSetting->DataSource = AdminSetting::LoadAll($objClauses);
		}
	}
?>