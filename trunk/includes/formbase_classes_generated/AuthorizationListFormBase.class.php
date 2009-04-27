<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the Authorization class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of Authorization objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this AuthorizationListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class AuthorizationListFormBase extends QForm {
		protected $dtgAuthorization;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colAuthorizationId;
		protected $colShortDescription;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgAuthorization_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colAuthorizationId = new QDataGridColumn(QApplication::Translate('Authorization Id'), '<?= $_ITEM->AuthorizationId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Authorization()->AuthorizationId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Authorization()->AuthorizationId, false)));
			$this->colShortDescription = new QDataGridColumn(QApplication::Translate('Short Description'), '<?= QString::Truncate($_ITEM->ShortDescription, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Authorization()->ShortDescription), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Authorization()->ShortDescription, false)));

			// Setup DataGrid
			$this->dtgAuthorization = new QDataGrid($this);
			$this->dtgAuthorization->CellSpacing = 0;
			$this->dtgAuthorization->CellPadding = 4;
			$this->dtgAuthorization->BorderStyle = QBorderStyle::Solid;
			$this->dtgAuthorization->BorderWidth = 1;
			$this->dtgAuthorization->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgAuthorization->Paginator = new QPaginator($this->dtgAuthorization);
			$this->dtgAuthorization->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgAuthorization->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgAuthorization->SetDataBinder('dtgAuthorization_Bind');

			$this->dtgAuthorization->AddColumn($this->colEditLinkColumn);
			$this->dtgAuthorization->AddColumn($this->colAuthorizationId);
			$this->dtgAuthorization->AddColumn($this->colShortDescription);
		}
		
		public function dtgAuthorization_EditLinkColumn_Render(Authorization $objAuthorization) {
			return sprintf('<a href="authorization_edit.php?intAuthorizationId=%s">%s</a>',
				$objAuthorization->AuthorizationId, 
				QApplication::Translate('Edit'));
		}


		protected function dtgAuthorization_Bind() {
			// Because we want to enable pagination AND sorting, we need to setup the $objClauses array to send to LoadAll()

			// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
			$this->dtgAuthorization->TotalItemCount = Authorization::CountAll();

			// Setup the $objClauses Array
			$objClauses = array();

			// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
			// the OrderByClause to the $objClauses array
			if ($objClause = $this->dtgAuthorization->OrderByClause)
				array_push($objClauses, $objClause);

			// Add the LimitClause information, as well
			if ($objClause = $this->dtgAuthorization->LimitClause)
				array_push($objClauses, $objClause);

			// Set the DataSource to be the array of all Authorization objects, given the clauses above
			$this->dtgAuthorization->DataSource = Authorization::LoadAll($objClauses);
		}
	}
?>