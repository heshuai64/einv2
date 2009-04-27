<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the AuthorizationLevel class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of AuthorizationLevel objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this AuthorizationLevelListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class AuthorizationLevelListFormBase extends QForm {
		protected $dtgAuthorizationLevel;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colAuthorizationLevelId;
		protected $colShortDescription;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgAuthorizationLevel_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colAuthorizationLevelId = new QDataGridColumn(QApplication::Translate('Authorization Level Id'), '<?= $_ITEM->AuthorizationLevelId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::AuthorizationLevel()->AuthorizationLevelId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::AuthorizationLevel()->AuthorizationLevelId, false)));
			$this->colShortDescription = new QDataGridColumn(QApplication::Translate('Short Description'), '<?= QString::Truncate($_ITEM->ShortDescription, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::AuthorizationLevel()->ShortDescription), 'ReverseOrderByClause' => QQ::OrderBy(QQN::AuthorizationLevel()->ShortDescription, false)));

			// Setup DataGrid
			$this->dtgAuthorizationLevel = new QDataGrid($this);
			$this->dtgAuthorizationLevel->CellSpacing = 0;
			$this->dtgAuthorizationLevel->CellPadding = 4;
			$this->dtgAuthorizationLevel->BorderStyle = QBorderStyle::Solid;
			$this->dtgAuthorizationLevel->BorderWidth = 1;
			$this->dtgAuthorizationLevel->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgAuthorizationLevel->Paginator = new QPaginator($this->dtgAuthorizationLevel);
			$this->dtgAuthorizationLevel->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgAuthorizationLevel->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgAuthorizationLevel->SetDataBinder('dtgAuthorizationLevel_Bind');

			$this->dtgAuthorizationLevel->AddColumn($this->colEditLinkColumn);
			$this->dtgAuthorizationLevel->AddColumn($this->colAuthorizationLevelId);
			$this->dtgAuthorizationLevel->AddColumn($this->colShortDescription);
		}
		
		public function dtgAuthorizationLevel_EditLinkColumn_Render(AuthorizationLevel $objAuthorizationLevel) {
			return sprintf('<a href="authorization_level_edit.php?intAuthorizationLevelId=%s">%s</a>',
				$objAuthorizationLevel->AuthorizationLevelId, 
				QApplication::Translate('Edit'));
		}


		protected function dtgAuthorizationLevel_Bind() {
			// Because we want to enable pagination AND sorting, we need to setup the $objClauses array to send to LoadAll()

			// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
			$this->dtgAuthorizationLevel->TotalItemCount = AuthorizationLevel::CountAll();

			// Setup the $objClauses Array
			$objClauses = array();

			// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
			// the OrderByClause to the $objClauses array
			if ($objClause = $this->dtgAuthorizationLevel->OrderByClause)
				array_push($objClauses, $objClause);

			// Add the LimitClause information, as well
			if ($objClause = $this->dtgAuthorizationLevel->LimitClause)
				array_push($objClauses, $objClause);

			// Set the DataSource to be the array of all AuthorizationLevel objects, given the clauses above
			$this->dtgAuthorizationLevel->DataSource = AuthorizationLevel::LoadAll($objClauses);
		}
	}
?>