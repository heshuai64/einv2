<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the Attachment class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of Attachment objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this AttachmentListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class AttachmentListFormBase extends QForm {
		protected $dtgAttachment;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colAttachmentId;
		protected $colEntityQtypeId;
		protected $colEntityId;
		protected $colFilename;
		protected $colTmpFilename;
		protected $colFileType;
		protected $colPath;
		protected $colSize;
		protected $colCreatedBy;
		protected $colCreationDate;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgAttachment_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colAttachmentId = new QDataGridColumn(QApplication::Translate('Attachment Id'), '<?= $_ITEM->AttachmentId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Attachment()->AttachmentId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Attachment()->AttachmentId, false)));
			$this->colEntityQtypeId = new QDataGridColumn(QApplication::Translate('Entity Qtype'), '<?= $_FORM->dtgAttachment_EntityQtypeId_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Attachment()->EntityQtypeId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Attachment()->EntityQtypeId, false)));
			$this->colEntityId = new QDataGridColumn(QApplication::Translate('Entity Id'), '<?= $_ITEM->EntityId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Attachment()->EntityId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Attachment()->EntityId, false)));
			$this->colFilename = new QDataGridColumn(QApplication::Translate('Filename'), '<?= QString::Truncate($_ITEM->Filename, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Attachment()->Filename), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Attachment()->Filename, false)));
			$this->colTmpFilename = new QDataGridColumn(QApplication::Translate('Tmp Filename'), '<?= QString::Truncate($_ITEM->TmpFilename, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Attachment()->TmpFilename), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Attachment()->TmpFilename, false)));
			$this->colFileType = new QDataGridColumn(QApplication::Translate('File Type'), '<?= QString::Truncate($_ITEM->FileType, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Attachment()->FileType), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Attachment()->FileType, false)));
			$this->colPath = new QDataGridColumn(QApplication::Translate('Path'), '<?= QString::Truncate($_ITEM->Path, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Attachment()->Path), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Attachment()->Path, false)));
			$this->colSize = new QDataGridColumn(QApplication::Translate('Size'), '<?= $_ITEM->Size; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Attachment()->Size), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Attachment()->Size, false)));
			$this->colCreatedBy = new QDataGridColumn(QApplication::Translate('Created By'), '<?= $_FORM->dtgAttachment_CreatedByObject_Render($_ITEM); ?>');
			$this->colCreationDate = new QDataGridColumn(QApplication::Translate('Creation Date'), '<?= $_FORM->dtgAttachment_CreationDate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Attachment()->CreationDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Attachment()->CreationDate, false)));

			// Setup DataGrid
			$this->dtgAttachment = new QDataGrid($this);
			$this->dtgAttachment->CellSpacing = 0;
			$this->dtgAttachment->CellPadding = 4;
			$this->dtgAttachment->BorderStyle = QBorderStyle::Solid;
			$this->dtgAttachment->BorderWidth = 1;
			$this->dtgAttachment->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgAttachment->Paginator = new QPaginator($this->dtgAttachment);
			$this->dtgAttachment->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgAttachment->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgAttachment->SetDataBinder('dtgAttachment_Bind');

			$this->dtgAttachment->AddColumn($this->colEditLinkColumn);
			$this->dtgAttachment->AddColumn($this->colAttachmentId);
			$this->dtgAttachment->AddColumn($this->colEntityQtypeId);
			$this->dtgAttachment->AddColumn($this->colEntityId);
			$this->dtgAttachment->AddColumn($this->colFilename);
			$this->dtgAttachment->AddColumn($this->colTmpFilename);
			$this->dtgAttachment->AddColumn($this->colFileType);
			$this->dtgAttachment->AddColumn($this->colPath);
			$this->dtgAttachment->AddColumn($this->colSize);
			$this->dtgAttachment->AddColumn($this->colCreatedBy);
			$this->dtgAttachment->AddColumn($this->colCreationDate);
		}
		
		public function dtgAttachment_EditLinkColumn_Render(Attachment $objAttachment) {
			return sprintf('<a href="attachment_edit.php?intAttachmentId=%s">%s</a>',
				$objAttachment->AttachmentId, 
				QApplication::Translate('Edit'));
		}

		public function dtgAttachment_EntityQtypeId_Render(Attachment $objAttachment) {
			if (!is_null($objAttachment->EntityQtypeId))
				return EntityQtype::ToString($objAttachment->EntityQtypeId);
			else
				return null;
		}

		public function dtgAttachment_CreatedByObject_Render(Attachment $objAttachment) {
			if (!is_null($objAttachment->CreatedByObject))
				return $objAttachment->CreatedByObject->__toString();
			else
				return null;
		}

		public function dtgAttachment_CreationDate_Render(Attachment $objAttachment) {
			if (!is_null($objAttachment->CreationDate))
				return $objAttachment->CreationDate->__toString(QDateTime::FormatDisplayDateTime);
			else
				return null;
		}


		protected function dtgAttachment_Bind() {
			// Because we want to enable pagination AND sorting, we need to setup the $objClauses array to send to LoadAll()

			// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
			$this->dtgAttachment->TotalItemCount = Attachment::CountAll();

			// Setup the $objClauses Array
			$objClauses = array();

			// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
			// the OrderByClause to the $objClauses array
			if ($objClause = $this->dtgAttachment->OrderByClause)
				array_push($objClauses, $objClause);

			// Add the LimitClause information, as well
			if ($objClause = $this->dtgAttachment->LimitClause)
				array_push($objClauses, $objClause);

			// Set the DataSource to be the array of all Attachment objects, given the clauses above
			$this->dtgAttachment->DataSource = Attachment::LoadAll($objClauses);
		}
	}
?>