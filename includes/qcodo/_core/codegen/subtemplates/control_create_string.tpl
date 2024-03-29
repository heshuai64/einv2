		// Create and Setup <%= $strControlId %>
		protected function <%= $strControlId %>_Create() {
			$this-><%= $strControlId %> = new QTextBox($this);
			$this-><%= $strControlId %>->Name = QApplication::Translate('<%= QConvertNotation::WordsFromCamelCase($objColumn->PropertyName) %>');
			$this-><%= $strControlId %>->Text = $this-><%= $strObjectName %>-><%= $objColumn->PropertyName %>;
<% if ($objColumn->NotNull) { %>
			$this-><%=$strControlId %>->Required = true;
<% } %>
<% if ($objColumn->DbType == QDatabaseFieldType::Blob) { %>
			$this-><%=$strControlId %>->TextMode = QTextMode::MultiLine;
<% } %>
<% if (($objColumn->VariableType == QType::String) && (is_numeric($objColumn->Length))) { %>
			$this-><%=$strControlId %>->MaxLength = <%= $strClassName %>::<%= $objColumn->PropertyName %>MaxLength;
<% } %>
		}