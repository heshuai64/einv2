<?php
	class QQN {
		static public function Address() {
			return new QQNodeAddress('address', null);
		}
		static public function AdminSetting() {
			return new QQNodeAdminSetting('admin_setting', null);
		}
		static public function Asset() {
			return new QQNodeAsset('asset', null);
		}
		static public function AssetModel() {
			return new QQNodeAssetModel('asset_model', null);
		}
		static public function AssetTransaction() {
			return new QQNodeAssetTransaction('asset_transaction', null);
		}
		static public function Attachment() {
			return new QQNodeAttachment('attachment', null);
		}
		static public function Audit() {
			return new QQNodeAudit('audit', null);
		}
		static public function AuditScan() {
			return new QQNodeAuditScan('audit_scan', null);
		}
		static public function Authorization() {
			return new QQNodeAuthorization('authorization', null);
		}
		static public function AuthorizationLevel() {
			return new QQNodeAuthorizationLevel('authorization_level', null);
		}
		static public function Category() {
			return new QQNodeCategory('category', null);
		}
		static public function Company() {
			return new QQNodeCompany('company', null);
		}
		static public function Contact() {
			return new QQNodeContact('contact', null);
		}
		static public function Country() {
			return new QQNodeCountry('country', null);
		}
		static public function Courier() {
			return new QQNodeCourier('courier', null);
		}
		static public function CurrencyUnit() {
			return new QQNodeCurrencyUnit('currency_unit', null);
		}
		static public function CustomField() {
			return new QQNodeCustomField('custom_field', null);
		}
		static public function CustomFieldSelection() {
			return new QQNodeCustomFieldSelection('custom_field_selection', null);
		}
		static public function CustomFieldValue() {
			return new QQNodeCustomFieldValue('custom_field_value', null);
		}
		static public function Datagrid() {
			return new QQNodeDatagrid('datagrid', null);
		}
		static public function DatagridColumnPreference() {
			return new QQNodeDatagridColumnPreference('datagrid_column_preference', null);
		}
		static public function EntityQtypeCustomField() {
			return new QQNodeEntityQtypeCustomField('entity_qtype_custom_field', null);
		}
		static public function FedexServiceType() {
			return new QQNodeFedexServiceType('fedex_service_type', null);
		}
		static public function FedexShipment() {
			return new QQNodeFedexShipment('fedex_shipment', null);
		}
		static public function InventoryLocation() {
			return new QQNodeInventoryLocation('inventory_location', null);
		}
		static public function InventoryModel() {
			return new QQNodeInventoryModel('inventory_model', null);
		}
		static public function InventoryTransaction() {
			return new QQNodeInventoryTransaction('inventory_transaction', null);
		}
		static public function LengthUnit() {
			return new QQNodeLengthUnit('length_unit', null);
		}
		static public function Location() {
			return new QQNodeLocation('location', null);
		}
		static public function Manufacturer() {
			return new QQNodeManufacturer('manufacturer', null);
		}
		static public function Module() {
			return new QQNodeModule('module', null);
		}
		static public function Notification() {
			return new QQNodeNotification('notification', null);
		}
		static public function NotificationUserAccount() {
			return new QQNodeNotificationUserAccount('notification_user_account', null);
		}
		static public function PackageType() {
			return new QQNodePackageType('package_type', null);
		}
		static public function Receipt() {
			return new QQNodeReceipt('receipt', null);
		}
		static public function Role() {
			return new QQNodeRole('role', null);
		}
		static public function RoleEntityQtypeBuiltInAuthorization() {
			return new QQNodeRoleEntityQtypeBuiltInAuthorization('role_entity_qtype_built_in_authorization', null);
		}
		static public function RoleEntityQtypeCustomFieldAuthorization() {
			return new QQNodeRoleEntityQtypeCustomFieldAuthorization('role_entity_qtype_custom_field_authorization', null);
		}
		static public function RoleModule() {
			return new QQNodeRoleModule('role_module', null);
		}
		static public function RoleModuleAuthorization() {
			return new QQNodeRoleModuleAuthorization('role_module_authorization', null);
		}
		static public function Shipment() {
			return new QQNodeShipment('shipment', null);
		}
		static public function ShippingAccount() {
			return new QQNodeShippingAccount('shipping_account', null);
		}
		static public function Shortcut() {
			return new QQNodeShortcut('shortcut', null);
		}
		static public function StateProvince() {
			return new QQNodeStateProvince('state_province', null);
		}
		static public function Transaction() {
			return new QQNodeTransaction('transaction', null);
		}
		static public function TransactionType() {
			return new QQNodeTransactionType('transaction_type', null);
		}
		static public function UserAccount() {
			return new QQNodeUserAccount('user_account', null);
		}
		static public function WeightUnit() {
			return new QQNodeWeightUnit('weight_unit', null);
		}
		static public function SkuDateQtyHistory() {
			return new QQNodeSkuDateQtyHistory('sku_date_qty_history', null);
		}
	}
?>