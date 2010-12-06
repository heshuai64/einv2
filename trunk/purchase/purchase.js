Ext.onReady(function(){
    function showWait(){
        Ext.MessageBox.wait(lang.Waitting);
    }
    
    function hideWait(){
        Ext.MessageBox.hide();
    }
    
    function exception(){
        Ext.Msg.alert(lang.Failure, lang.Network_Error);
    }
    
    Ext.Ajax.on('beforerequest', showWait);
    Ext.Ajax.on('requestcomplete', hideWait);
    Ext.Ajax.on('requestexception', exception);
     
    var purchasePlannedStore = new Ext.data.JsonStore({
            root: 'records',
            totalProperty: 'totalCount',
            idProperty: 'id',
            autoLoad:true,
            fields: ['id', 'sku','title', 'min_purchase_num', 'purchase_in_the_way', 'suggest_purchase_num', 'stock', 'virtual_stock', 'stock_days', 'three_day_flow', 'week_flow_1', 'week_flow_2', 'week_flow_3', 'purchase_status', 'purchase_type'],
            url:'purchase.php?action=getPurchasePlanned'
    });
    
    var sm1 = new Ext.grid.CheckboxSelectionModel();
    var purchasePlannedGrid = new Ext.grid.GridPanel({
            autoHeight: true,
            store: purchasePlannedStore,
            selModel: sm1,
            columns:[sm1,
            {
                header: lang.SKU,
                dataIndex: 'sku',
                width: 70,
                align: 'center',
                sortable: true
            },{
                header: lang.Title,
                dataIndex: 'title',
                width: 130,
                align: 'center'
            },{
                header: lang.Min_Purchase_Num,
                dataIndex: 'min_purchase_num',
                width: 65,
                align: 'center',
                sortable: true
            },{
                header: lang.Purchase_In_The_Way,
                dataIndex: 'purchase_in_the_way',
                width: 65,
                align: 'center',
                sortable: true
            },{
                header: lang.Suggest_Purchase_Num,
                dataIndex: 'suggest_purchase_num',
                width: 70,
                align: 'center',
                sortable: true
            },{
                header: lang.Stock,
                dataIndex: 'stock',
                width: 40,
                align: 'center',
                sortable: true
            },{
                header: lang.Virtual_Stock,
                dataIndex: 'virtual_stock',
                width: 60,
                align: 'center',
                sortable: true
            },{
                header: lang.Stock_Days,
                dataIndex: 'stock_days',
                width: 60,
                align: 'center',
                sortable: true
            },{
                header: lang.Three_Day_Flow,
                dataIndex: 'three_day_flow',
                width: 60,
                align: 'center',
                sortable: true
            },{
                header: lang.One_Week_Flow,
                dataIndex: 'week_flow_1',
                width: 70,
                align: 'center',
                sortable: true
            },{
                header: lang.Two_Week_Flow,
                dataIndex: 'week_flow_2',
                width: 70,
                align: 'center',
                sortable: true
            },{
                header: lang.Three_Week_Flow,
                dataIndex: 'week_flow_3',
                width: 70,
                align: 'center',
                sortable: true
            },{
                header: lang.Purchase_Planned_Type,
                dataIndex: 'purchase_type',
                width: 80,
                align: 'center',
                sortable: true
            }],
            tbar: [
                lang.Purchase_Planned_Type,{
                    xtype:"combo",
                    width: 80,
                    mode: 'local',
                    store: new Ext.data.ArrayStore({
                        fields: [
                            'id',
                            'name'
                        ],
                        data: [['2', lang.Purchase_Planned_Type_Enum.all], ['1', lang.Purchase_Planned_Type_Enum.normal], ['0', lang.Purchase_Planned_Type_Enum.manual]]
                    }),
                    valueField: 'id',
                    displayField: 'name',
                    triggerAction: 'all',
                    editable: false,
                    selectOnFocus:true
                },'-',lang.Purchase_Planned_Generate_Time,{
                    xtype:"datefield",
                    format:"Y-m-d"
                },'-',{
                    text:lang.Search,
                    handler: function(){
                        //console.log("test");
                        purchasePlannedStore.baseParams = {
                            date: purchasePlannedGrid.getTopToolbar().get(4).getValue(),
                            type: purchasePlannedGrid.getTopToolbar().get(1).getValue()
                        };
                        purchasePlannedStore.load();
                    }
                }    
            ],
            bbar: [{
                    text: lang.Add_Purchase_Planned,
                    handler: function(){
                        
                    }
                },'-',{
                    text: lang.Create_Purchase_Orders,
                    handler: function(){
                        var selections = purchasePlannedGrid.selModel.getSelections();
                        var ids = "";
                        for(i = 0; i< purchasePlannedGrid.selModel.getCount(); i++){
                                ids += selections[i].data.id + ","
                        }
                        ids = ids.slice(0, -1);
                        //console.log(ids);
                        Ext.Ajax.request({
                            waitMsg: 'Please wait...',
                            url: 'purchase.php?action=createPOFromPP',
                            params: {
                                ids: ids
                            },
                            success: function(response){
                                var result = eval(response.responseText);
                                switch (result) {
                                    case 1:
                                        purchasePlannedStore.reload();
                                        break;
                                    default:
                                        Ext.MessageBox.alert('Uh uh...', 'We couldn\'t save him...');
                                        break;
                                }
                            },
                            failure: function(response){
                                var result = response.responseText;
                                Ext.MessageBox.alert('error', 'could not connect to the database. retry later');
                            }
                        });		
                    }
            }]
    })
    
    /*
    var purchaseOrdersDetailGrid = new Ext.grid.EditorGridPanel({
            autoHeight: true,
            //store: orderDetailGridStore,
            selModel: new Ext.grid.RowSelectionModel({}),
            columns:[{
                header: "SKU",
                dataIndex: 'itemId',
                width: 100,
                align: 'center',
                editor: new Ext.form.TextField({}),
                sortable: true
            },{
                header: "Chinese Title",
                dataIndex: 'itemTitle',
                width: 100,
                editor: new Ext.form.TextField({}),
                align: 'center'
            },{
                header: "Stock",
                dataIndex: 'skuId',
                width: 80,
                align: 'center',
                sortable: true
            },{
                header: "Purchase In The Way",
                dataIndex: 'skuId',
                width: 120,
                align: 'center',
                sortable: true
            },{
                header: "Lowest Purchase Quantity",
                dataIndex: 'quantity',
                width: 140,
                align: 'center',
                sortable: true
            },{
                header: "Suggest Purchase Quantity",
                dataIndex: 'skuStock',
                width: 140,
                align: 'center',
                sortable: true
            }]
    })
    
    var purchaseOrders = new Ext.FormPanel({
            autoScroll:true,
            reader:new Ext.data.JsonReader({
                }, ['id','createdBy','createdOn','modifiedBy','modifiedOn','sellerId','buyerId','ebayName','ebayEmail','ebayAddress1','ebayAddress2','ebayCity','ebayStateOrProvince',
                    'ebayPostalCode','ebayCountry','ebayPhone','paypalName','paypalEmail','paypalAddress1','paypalAddress2',
                    'paypalCity','paypalStateOrProvince','paypalPostalCode','paypalCountry','paypalPhone','status','grandTotalCurrency','grandTotalValue',
                    'remarks','shippingMethod','shippingFeeCurrency','shippingFeeValue','insuranceCurrency','insuranceValue','discountCurrency','discountValue'
            ]),
            items:[{
                    xtype:"panel",
                    title: "Create Purchase Order",
                    layout:"form",
                    items:[{
                            layout:"column",
                            items:[{
                                columnWidth:0.5,
                                layout:"form",
                                items:[{
                                    xtype:"textfield",
                                    fieldLabel:"Subject",
                                    name:"textvalue"
                                  },{
                                    xtype:"combo",
                                    fieldLabel:"Vendors",
                                    name:"combovalue",
                                    hiddenName:"combovalue"
                                  }]
                            },{
                                columnWidth:0.5,
                                layout:"form",
                                items:[{
                                    xtype:"textfield",
                                    fieldLabel:"POID",
                                    name:"textvalue"
                                  },{
                                    xtype:"combo",
                                    fieldLabel:"Person in charge",
                                    name:"textvalue"
                                  }]
                            }]
                    },{
                            xtype:"textarea",
                            fieldLabel:"Remark",
                            name:"textvalue",
                            width: 600
                    },{
                            xtype: 'panel',
                            title: "Purchase Order Detail",
                            items: purchaseOrdersDetailGrid
                    }]
            }]
    })
    
    */
    function renderPurchaseOrdersStatus(v, p, r){
        return lang.Purchase_Orders_Status_Array[v-1];
    }
         
    function renderPurchaseOrdersType(v, p, r){
        return lang.Purchase_Orders_Type_Array[v];
    }
    
    function renderPurchaseOrdersOldPurchasePrice(v, p, r){
        if(r.data.sku_old_price == 0){
            return r.data.sku_price;
        }else{
            return v;
        }
    }
    
    function renderPurchaseOrdersPurchasePrice(v, p, r){
        if(r.data.sku_old_price == 0 || r.data.sku_old_price == r.data.sku_price){
            return v;
        }else{
            return '<font color="red">'+v+'</font>';
        }
    }
    
    function renderPurchaseOrdersOldPurchaseQty(v, p, r){
        if(r.data.sku_old_purchase_qty == 0){
            return r.data.sku_purchase_qty;
        }else{
            return v;
        }
    }
    
    function renderPurchaseOrdersPurchaseQty(v, p, r){
        if(r.data.sku_old_purchase_qty == 0 || r.data.sku_old_purchase_qty == r.data.sku_purchase_qty){
            return v;
        }else{
            return '<font color="red">'+v+'</font>';
        }
    }
    
    var purchaseOrdersStore = new Ext.data.JsonStore({
            root: 'records',
            totalProperty: 'totalCount',
            idProperty: 'id',
            autoLoad:true,
            fields: ['id', 'purchase_type','purchaser', 'vendors', 'vendors_phone', 'vendors_fax', 'purchase_status', 'generate_date', 'approval_pass_date', 'sku', 'sku_status', 'sku_title', 'sku_stock', 'sku_virtual_stock', 'sku_purchase_in_transit', 'sku_purchase_qty', 'sku_old_purchase_qty', 'sku_price', 'sku_old_price', 'sku_total_price', 'sku_defective_qty', 'sku_rework_qty', 'sku_purchase_cycle', 'sku_three_day_flow', 'sku_week_flow', 'expected_arrival_date', 'created_by', 'created_on'],
            url:'purchase.php?action=getPurchaseOrders'
    });
    
    var sm2 = new Ext.grid.CheckboxSelectionModel();
    var purchaseOrdersGrid = new Ext.grid.GridPanel({
        autoHeight: true,
        //height: 600,
        store: purchaseOrdersStore,
        selModel: sm2,
        columns:[sm2,
        {
            header: lang.Purchase_Orders_Id,
            dataIndex: 'id',
            width: 100,
            align: 'center',
            sortable: true
        },{
            header: lang.Purchase_Orders_Type,
            dataIndex: 'purchase_type',
            width: 75,
            align: 'center',
            renderer: renderPurchaseOrdersType,
            sortable: true
        },{
            header: lang.Vendors,
            dataIndex: 'vendors',
            width: 140,
            align: 'center',
            sortable: true
        },/*{
            header: lang.Vendors_Phone,
            dataIndex: 'vendors_phone',
            width: 70,
            align: 'center',
            sortable: true
        },{
            header: lang.Vendors_Fax,
            dataIndex: 'vendors_fax',
            width: 70,
            align: 'center',
            sortable: true
        },*/{
            header: lang.Purchase_Status,
            dataIndex: 'purchase_status',
            width: 65,
            align: 'center',
            renderer: renderPurchaseOrdersStatus,
            sortable: true
        },{
            header: lang.Generate_Purchase_Orders_Date,
            dataIndex: 'generate_date',
            width: 70,
            align: 'center',
            sortable: true
        },{
            header: lang.Approval_Pass_Date,
            dataIndex: 'approval_pass_date',
            width: 70,
            align: 'center',
            sortable: true
        },{
            header: lang.Expected_Arrival_Date,
            dataIndex: 'expected_arrival_date',
            width: 70,
            align: 'center',
            sortable: true
        },{
            header: lang.Sku,
            dataIndex: 'sku',
            width: 70,
            align: 'center',
            sortable: true
        },{
            header: lang.Sku_Status,
            dataIndex: 'sku_status',
            width: 60,
            align: 'center',
            sortable: true
        },{
            header: lang.Sku_Title,
            dataIndex: 'sku_title',
            width: 70,
            align: 'center',
            sortable: true
        },{
            header: lang.Sku_Stock,
            dataIndex: 'sku_stock',
            width: 60,
            align: 'center',
            sortable: true
        },{
            header: lang.Sku_Virtual_Stock,
            dataIndex: 'sku_virtual_stock',
            width: 75,
            align: 'center',
            sortable: true
        },{
            header: lang.Sku_Purchase_In_Transit,
            dataIndex: 'sku_purchase_in_transit',
            width: 75,
            align: 'center',
            sortable: true
        },{
            header: lang.Sku_Old_Price,
            dataIndex: 'sku_old_price',
            width: 65,
            align: 'center',
            renderer: renderPurchaseOrdersOldPurchasePrice,
            sortable: true
        },{
            header: lang.Sku_Price,
            dataIndex: 'sku_price',
            width: 60,
            align: 'center',
            renderer: renderPurchaseOrdersPurchasePrice,
            sortable: true
        },{
            header: lang.Sku_Old_Purchase_Qty,
            dataIndex: 'sku_old_purchase_qty',
            width: 85,
            align: 'center',
            renderer: renderPurchaseOrdersOldPurchaseQty,
            sortable: true
        },{
            header: lang.Sku_Purchase_Qty,
            dataIndex: 'sku_purchase_qty',
            width: 75,
            align: 'center',
            renderer: renderPurchaseOrdersPurchaseQty,
            sortable: true
        },{
            header: lang.Sku_Total_Price,
            dataIndex: 'sku_total_price',
            width: 60,
            align: 'center',
            sortable: true
        },{
            header: lang.SKU_Purchase_Cycle,
            dataIndex: 'sku_purchase_cycle',
            width: 75,
            align: 'center',
            sortable: true
        },{
            header: lang.SKU_Three_Day_Flow,
            dataIndex: 'sku_three_day_flow',
            width: 75,
            align: 'center',
            sortable: true
        },{
            header: lang.SKU_Week_Flow,
            dataIndex: 'sku_week_flow',
            width: 75,
            align: 'center',
            sortable: true
        },{
            header: lang.Sku_Defective_Qty,
            dataIndex: 'sku_defective_qty',
            width: 75,
            align: 'center',
            sortable: true
        },{
            header: lang.Sku_Rework_Qty,
            dataIndex: 'sku_rework_qty',
            width: 70,
            align: 'center',
            sortable: true
        },{
            header: lang.Created_By,
            dataIndex: 'created_by',
            width: 70,
            align: 'center',
            sortable: true
        }/*,{
            header: lang.Created_On,
            dataIndex: 'created_on',
            width: 100,
            align: 'center',
            sortable: true
        }*/],
        listeners: {'dblclick': function(e){
                var selections = purchaseOrdersGrid.selModel.getSelections();
                var purchase_orders_id = selections[0].data.id;
                
                var vendorsForm = new Ext.FormPanel({
                    autoScroll:true,
                    reader:new Ext.data.JsonReader({
                        }, ['vendors_id','contact_id','phone_office','phone_mobile','payment_method','receive_account','address']
                    ),
                    items: {
                        layout:"column",
                        items:[{
                            layout:"form",
                            columnWidth:0.5,
                            items:[{
                                xtype:"combo",
                                mode: 'local',
                                store: new Ext.data.JsonStore({
                                    autoLoad: true,
                                    fields: ['id', 'name'],
                                    url: "purchase.php?action=getVendors"
                                }),
                                valueField:'id',
                                displayField:'name',
                                triggerAction: 'all',
                                editable: false,
                                selectOnFocus:true,
                                fieldLabel: lang.Vendors,
                                name:"vendors_id",
                                hiddenName:"vendors_id",
                                listeners: {
                                    select: function(c, r, i){
                                        //alert(r.id);
                                        vendorsForm.getForm().items.items[1].store.baseParams = {company_id: r.id};
                                        vendorsForm.getForm().items.items[1].store.reload();
                                    }
                                }
                              },{
                                xtype:"combo",
                                mode: 'local',
                                store: new Ext.data.JsonStore({
                                    autoLoad: true,
                                    fields: ['id', 'name'],
                                    url: "purchase.php?action=getContact"
                                }),
                                valueField:'id',
                                displayField:'name',
                                triggerAction: 'all',
                                editable: false,
                                selectOnFocus:true,
                                fieldLabel:lang.Contacts,
                                name:"contact_id",
                                hiddenName:"contact_id"
                              },{
                                xtype:"textfield",
                                fieldLabel:lang.Office_Phone,
                                width: 150,
                                name:"phone_office"
                              },{
                                xtype:"textfield",
                                fieldLabel:lang.Mobile_Phone,
                                width: 150,
                                name:"phone_mobile"
                              }]
                        },{
                            layout:"form",
                            columnWidth:0.5,
                            items:[{
                                xtype:"combo",
                                mode: 'local',
                                store: new Ext.data.ArrayStore({
                                    fields: [
                                        'id',
                                        'name'
                                    ],
                                    data: [['advance_payment', lang.Payment_method_Enum.advance_payment ], ['express_collection', lang.Payment_method_Enum.express_collection], ['delivery_payment', lang.Payment_method_Enum.delivery_payment], ['weekly', lang.Payment_method_Enum.weekly], ['a_half_monthly', lang.Payment_method_Enum.a_half_monthly], ['monthly', lang.Payment_method_Enum.monthly]]
                                }),
                                valueField: 'id',
                                displayField: 'name',
                                triggerAction: 'all',
                                editable: false,
                                selectOnFocus:true,
                                fieldLabel: lang.Payment_Method,
                                name:"payment_method",
                                hiddenName:"payment_method"
                              },{
                                xtype:"textfield",
                                fieldLabel: lang.Receive_Accounts,
                                width: 150,
                                name:"receive_account"
                              },{
                                xtype:"textarea",
                                fieldLabel: lang.Address,
                                width: 150,
                                name:"address"
                              }]
                        }]
                    }
                })
                                                
                var vendorsWindow = new Ext.Window({
                        title: purchase_orders_id + lang.Vendors,
                        closable:true,
                        width: 660,
                        height: 300,
                        plain:true,
                        layout: 'fit',
                        items: vendorsForm,
                        listeners: {
                            'show': function(){
                                vendorsForm.getForm().load({url:'purchase.php?action=getPurchaseOrdersVendors', 
                                    method:'GET', 
                                    params: {id: purchase_orders_id}, 
                                    waitMsg:'Please wait...'
                                }
                            )
                            }
                        },
                        buttons: [{
                            text: lang.Update,
                            handler: function(){
                                Ext.Ajax.request({
                                    waitMsg: 'Please wait...',
                                    url: 'purchase.php?action=updatePurchaseOrdersVendors',
                                    params: {
                                        id: purchase_orders_id,
                                        vendors_id: vendorsForm.getForm().items.items[0].getValue(),
                                        contact_id: vendorsForm.getForm().items.items[1].getValue(),
                                        phone_office: vendorsForm.getForm().items.items[2].getValue(),
                                        phone_mobile: vendorsForm.getForm().items.items[3].getValue(),
                                        payment_method: vendorsForm.getForm().items.items[4].getValue(),
                                        receive_account: vendorsForm.getForm().items.items[5].getValue(),
                                        address: vendorsForm.getForm().items.items[6].getValue()
                                    },
                                    success: function(response){
                                        var result = eval(response.responseText);
                                        switch (result) {
                                            case 1:
                                                vendorsWindow.close();
                                                purchaseOrdersStore.reload();
                                                break;
                                            default:
                                                Ext.MessageBox.alert('Uh uh...', 'We couldn\'t save him...');
                                                break;
                                        }
                                    },
                                    failure: function(response){
                                        var result = response.responseText;
                                        Ext.MessageBox.alert('error', 'could not connect to the database. retry later');
                                    }
                                });
                            }
                        },{
                            text: lang.Close,
                            handler: function(){
                                vendorsWindow.close();
                            }
                        }]
                    });
                
                    vendorsWindow.show();
            }
        },
        bbar:[{
                id: 'create-purchase-orders',
                text: lang.Create_Purchase_Orders,
                handler: function(){
                    var purchaseOrdersForm = new Ext.FormPanel({
                        autoScroll:true,
                        items:[{                        
                            layout:"column",
                            items:[{
                                columnWidth:0.5,
                                layout:"form",
                                title:"SKU",
                                items:[{
                                    xtype:"textfield",
                                    fieldLabel: lang.Sku,
                                    allowBlank: false,
                                    name:"sku"
                                  },{
                                    xtype:"numberfield",
                                    fieldLabel: lang.Sku_Price,
                                    allowBlank: false,
                                    name:"sku_price"
                                  },{
                                    xtype:"numberfield",
                                    fieldLabel: lang.Sku_Purchase_Qty,
                                    allowBlank: false,
                                    name:"sku_purchase_qty"
                                  }]
                                },{
                                columnWidth:0.5,
                                layout:"form",
                                title:"Vendors",
                                items:[{
                                    xtype:"combo",
                                    width: 100,
                                    listWith: 130,
                                    mode: 'local',
                                    store: new Ext.data.JsonStore({
                                        autoLoad: true,
                                        fields: ['id', 'name'],
                                        url: "purchase.php?action=getVendors"
                                    }),
                                    valueField:'id',
                                    displayField:'name',
                                    triggerAction: 'all',
                                    editable: false,
                                    selectOnFocus:true,
                                    fieldLabel: lang.Vendors,
                                    allowBlank: false,
                                    name:"vendors_id",
                                    hiddenName:"vendors_id",
                                    listeners: {
                                        select: function(c, r, i){
                                            //alert(r.id);
                                            purchaseOrdersForm.getForm().items.items[4].store.baseParams = {company_id: r.id};
                                            purchaseOrdersForm.getForm().items.items[4].store.reload();
                                        }
                                    }
                                  },{
                                    xtype:"combo",
                                    width: 100,
                                    listWith: 130,
                                    mode: 'local',
                                    store: new Ext.data.JsonStore({
                                        autoLoad: true,
                                        fields: ['id', 'name'],
                                        url: "purchase.php?action=getContact"
                                    }),
                                    valueField:'id',
                                    displayField:'name',
                                    triggerAction: 'all',
                                    editable: false,
                                    selectOnFocus:true,
                                    fieldLabel: lang.Contacts,
                                    allowBlank: false,
                                    name:"contact_id",
                                    hiddenName:"contact_id"
                                  }]
                            }]
                        }]
                    })
                    
                    var purchaseOrdersWindow = new Ext.Window({
                        title: lang.Create_Purchase_Orders,
                        closable:true,
                        width: 500,
                        height: 300,
                        plain:true,
                        layout: 'fit',
                        items: purchaseOrdersForm,
                        buttons: [{
                            text: lang.Create,
                            handler: function(){
                                purchaseOrdersForm.getForm().submit({
                                    url: "purchase.php?action=createPurchaseOrders",
                                    success: function(f, a){
                                        var response = Ext.decode(a.response.responseText);
                                        if(response.success){
                                            purchaseOrdersWindow.close();
                                            purchaseOrdersStore.reload();
                                        }
                                    },
                                    waitMsg: lang.Waitting
                                });
                                /*
                                if(Ext.isEmpty(purchaseOrdersForm.getForm().items.items[3].getValue()) || Ext.isEmpty(purchaseOrdersForm.getForm().items.items[4].getValue())){
                                    Ext.MessageBox.alert(lang.Warning, lang.Vendors_Or_Contact_Can_Not_Empty);
                                    return 0;
                                }
                                Ext.Ajax.request({
                                    waitMsg: 'Please wait...',
                                    url: 'purchase.php?action=createPurchaseOrders',
                                    params: {
                                        sku: purchaseOrdersForm.getForm().items.items[0].getValue(),
                                        sku_price: purchaseOrdersForm.getForm().items.items[1].getValue(),
                                        sku_purchase_qty: purchaseOrdersForm.getForm().items.items[2].getValue(),
                                        vendors_id: purchaseOrdersForm.getForm().items.items[3].getValue(),
                                        contact_id: purchaseOrdersForm.getForm().items.items[4].getValue()
                                    },
                                    success: function(response){
                                        var result = eval(response.responseText);
                                        switch (result) {
                                            case 1:
                                                purchaseOrdersWindow.close();
                                                purchaseOrdersStore.reload();
                                                break;
                                            default:
                                                Ext.MessageBox.alert('Uh uh...', 'We couldn\'t save him...');
                                                break;
                                        }
                                    },
                                    failure: function(response){
                                        var result = response.responseText;
                                        Ext.MessageBox.alert('error', 'could not connect to the database. retry later');
                                    }
                                });
                                */
                            }
                        },{
                            text: lang.Close,
                            handler: function(){
                                purchaseOrdersWindow.close();
                            }
                        }]
                    });
                    purchaseOrdersWindow.show();
                }
            },'-',{
                id: 'edit-purchase-orders',
                text: lang.Edit_Purchase_Orders,
                handler: function(){
                    var selections = purchaseOrdersGrid.selModel.getSelections();
                    var purchase_orders_id = selections[0].data.id;
                    
                    var purchaseOrdersForm = new Ext.FormPanel({
                        autoScroll:true,
                        reader:new Ext.data.JsonReader({
                            }, ['sku_old_price','sku_purchase_qty','sku_old_purchase_qty','sku_purchase_qty_remark','sku_price','sku_price_remark']
                        ),
                        items:[{                        
                            layout:"column",
                            items:[{
                                columnWidth:0.5,
                                layout:"form",
                                title:"Price",
                                items:[{
                                    xtype:"numberfield",
                                    disabled: true,
                                    fieldLabel: lang.Sku_Old_Price,
                                    name:"sku_old_price"
                                  },{
                                    xtype:"numberfield",
                                    fieldLabel: lang.Sku_Price,
                                    name:"sku_price",
                                    listeners: {
                                        change: function(){
                                            purchaseOrdersForm.getForm().items.items[2].allowBlank = false;
                                        }
                                    }
                                  },{
                                    xtype:"textarea",
                                    fieldLabel: lang.Sku_Price_Remark,
                                    name:"sku_price_remark",
                                    //allowBlank: false,
                                    width: 200, 
                                    height: 100
                                  }]
                                },{
                                columnWidth:0.5,
                                layout:"form",
                                title:"Quantity",
                                items:[{
                                    xtype:"numberfield",
                                    disabled: true,
                                    fieldLabel: lang.Sku_Old_Purchase_Qty,
                                    name:"sku_old_purchase_qty"
                                  },{
                                    xtype:"numberfield",
                                    fieldLabel: lang.Sku_Purchase_Qty,
                                    name:"sku_purchase_qty",
                                    listeners: {
                                        change: function(){
                                            purchaseOrdersForm.getForm().items.items[5].allowBlank = false;
                                        }
                                    }
                                  },{
                                    xtype:"textarea",
                                    fieldLabel: lang.Sku_Purchase_Qty_Remark,
                                    name:"sku_purchase_qty_remark",
                                    //allowBlank: false,
                                    width: 200, 
                                    height: 100
                                  }]
                            }]
                        },{
                            xtype:"hidden",
                            name:"id",
                            value: purchase_orders_id
                        }]
                    })
                    
                    purchaseOrdersForm.getForm().load({url:'purchase.php?action=getPurchaseOrdersById', 
                            method:'GET', 
                            params: {id: purchase_orders_id}, 
                            waitMsg:'Please wait...'
                        }
                    );
                    
                    var purchaseOrdersWindow = new Ext.Window({
                        title: purchase_orders_id ,
                        closable:true,
                        width: 660,
                        height: 300,
                        plain:true,
                        layout: 'fit',
                        items: purchaseOrdersForm,
                        buttons: [{
                            text: lang.Update,
                            handler: function(){
                                purchaseOrdersForm.getForm().submit({
                                    url: "purchase.php?action=updatePurchaseOrders",
                                    success: function(f, a){
                                        var response = Ext.decode(a.response.responseText);
                                        if(response.success){
                                            purchaseOrdersWindow.close();
                                            purchaseOrdersStore.reload();
                                        }
                                    },
                                    waitMsg: lang.Waitting
                                });
                                
                                /*
                                Ext.Ajax.request({
                                    waitMsg: 'Please wait...',
                                    url: 'purchase.php?action=updatePurchaseOrders',
                                    params: {
                                        id: purchase_orders_id,
                                        sku_price: purchaseOrdersForm.getForm().items.items[1].getValue(),
                                        sku_price_remark: purchaseOrdersForm.getForm().items.items[2].getValue(),
                                        sku_purchase_qty: purchaseOrdersForm.getForm().items.items[4].getValue(),
                                        sku_purchase_qty_remark: purchaseOrdersForm.getForm().items.items[5].getValue()
                                    },
                                    success: function(response){
                                        var result = eval(response.responseText);
                                        switch (result) {
                                            case 1:
                                                purchaseOrdersWindow.close();
                                                purchaseOrdersStore.reload();
                                                break;
                                            default:
                                                Ext.MessageBox.alert('Uh uh...', 'We couldn\'t save him...');
                                                break;
                                        }
                                    },
                                    failure: function(response){
                                        var result = response.responseText;
                                        Ext.MessageBox.alert('error', 'could not connect to the database. retry later');
                                    }
                                });
                                */
                            }
                        },{
                            text: lang.Close,
                            handler: function(){
                                purchaseOrdersWindow.close();
                            }
                        }]
                    });
                    purchaseOrdersWindow.show();
                }
            },'-',{
                id: 'submit-purchase-orders',
                text: lang.Submit_Purchase_Orders,
                handler: function(){
                    var selections = purchaseOrdersGrid.selModel.getSelections();
                    var ids = "";
                    for(i = 0; i< purchaseOrdersGrid.selModel.getCount(); i++){
                            ids += selections[i].data.id + ","
                    }
                    ids = ids.slice(0, -1);
                    //console.log(ids);
                    Ext.Ajax.request({
                        waitMsg: 'Please wait...',
                        url: 'purchase.php?action=submitPurchaseOrders',
                        params: {
                            ids: ids
                        },
                        success: function(response){
                            var result = eval(response.responseText);
                            switch (result) {
                                case 1:
                                    purchaseOrdersStore.reload();
                                    break;
                                default:
                                    Ext.MessageBox.alert('Uh uh...', 'We couldn\'t save him...');
                                    break;
                            }
                        },
                        failure: function(response){
                            var result = response.responseText;
                            Ext.MessageBox.alert('error', 'could not connect to the database. retry later');
                        }
                    });	
                }
            }, '-',{
                id: 'purchase-orders-inquiry-complete',
                text: lang.Purchase_Orders_Inquiry_Complete,
                handler: function(){
                    var selections = purchaseOrdersGrid.selModel.getSelections();
                    var ids = "";
                    for(i = 0; i< purchaseOrdersGrid.selModel.getCount(); i++){
                            ids += selections[i].data.id + ","
                    }
                    ids = ids.slice(0, -1);
                    //console.log(ids);
                    Ext.Ajax.request({
                        waitMsg: 'Please wait...',
                        url: 'purchase.php?action=purchaseOrdersInquiryComplete',
                        params: {
                            ids: ids
                        },
                        success: function(response){
                            var result = eval(response.responseText);
                            switch (result) {
                                case 1:
                                    purchaseOrdersStore.reload();
                                    break;
                                default:
                                    Ext.MessageBox.alert('Uh uh...', 'We couldn\'t save him...');
                                    break;
                            }
                        },
                        failure: function(response){
                            var result = response.responseText;
                            Ext.MessageBox.alert('error', 'could not connect to the database. retry later');
                        }
                    });	
                }
            },'-',{
                id: 'purchase-orders-approval-not-pass',
                text: lang.Purchase_Orders_Approval_Not_Pass,
                handler: function(){
                    var selections = purchaseOrdersGrid.selModel.getSelections();
                    var ids = "";
                    for(i = 0; i< purchaseOrdersGrid.selModel.getCount(); i++){
                            ids += selections[i].data.id + ","
                    }
                    ids = ids.slice(0, -1);
                    //console.log(ids);
                    Ext.Ajax.request({
                        waitMsg: 'Please wait...',
                        url: 'purchase.php?action=approvalPurchaseOrdersNotPass',
                        params: {
                            ids: ids
                        },
                        success: function(response){
                            var result = eval(response.responseText);
                            switch (result) {
                                case 1:
                                    purchaseOrdersStore.reload();
                                    break;
                                default:
                                    Ext.MessageBox.alert('Uh uh...', 'We couldn\'t save him...');
                                    break;
                            }
                        },
                        failure: function(response){
                            var result = response.responseText;
                            Ext.MessageBox.alert('error', 'could not connect to the database. retry later');
                        }
                    });	
                }
            },'-',{
                id: 'purchase-orders-approval-pass',
                text: lang.Purchase_Orders_Approval_Pass,
                handler: function(){
                    var selections = purchaseOrdersGrid.selModel.getSelections();
                    var ids = "";
                    for(i = 0; i< purchaseOrdersGrid.selModel.getCount(); i++){
                            ids += selections[i].data.id + ","
                    }
                    ids = ids.slice(0, -1);
                    //console.log(ids);
                    Ext.Ajax.request({
                        waitMsg: 'Please wait...',
                        url: 'purchase.php?action=approvalPurchaseOrdersPass',
                        params: {
                            ids: ids
                        },
                        success: function(response){
                            var result = eval(response.responseText);
                            switch (result) {
                                case 1:
                                    purchaseOrdersStore.reload();
                                    break;
                                default:
                                    Ext.MessageBox.alert('Uh uh...', 'We couldn\'t save him...');
                                    break;
                            }
                        },
                        failure: function(response){
                            var result = response.responseText;
                            Ext.MessageBox.alert('error', 'could not connect to the database. retry later');
                        }
                    });	
                }
            },'-',{
                id: 'purchase-orders-return-approval',
                text: lang.Purchase_Orders_Return_Approval,
                handler: function(){
                    var selections = purchaseOrdersGrid.selModel.getSelections();
                    var ids = "";
                    for(i = 0; i< purchaseOrdersGrid.selModel.getCount(); i++){
                            ids += selections[i].data.id + ","
                    }
                    ids = ids.slice(0, -1);
                    //console.log(ids);
                    Ext.Ajax.request({
                        waitMsg: 'Please wait...',
                        url: 'purchase.php?action=purchaseOrdersReturnApproval',
                        params: {
                            ids: ids
                        },
                        success: function(response){
                            var result = eval(response.responseText);
                            switch (result) {
                                case 1:
                                    purchaseOrdersStore.reload();
                                    break;
                                default:
                                    Ext.MessageBox.alert('Uh uh...', 'We couldn\'t save him...');
                                    break;
                            }
                        },
                        failure: function(response){
                            var result = response.responseText;
                            Ext.MessageBox.alert('error', 'could not connect to the database. retry later');
                        }
                    });	
                }
            },'-',{
                id: 'delete-purchase-orders',
                text: lang.Delete_Purchase_Orders,
                handler: function(){
                    Ext.MessageBox.confirm(lang.Confirmation, lang.Delete_selected_Purchase_Orders, function(){
                            var selections = purchaseOrdersGrid.selModel.getSelections();
                            var ids = "";
                            for(i = 0; i< purchaseOrdersGrid.selModel.getCount(); i++){
                                    ids += selections[i].data.id + ","
                            }
                            ids = ids.slice(0, -1);
                            //console.log(ids);
                            Ext.Ajax.request({
                                waitMsg: 'Please wait...',
                                url: 'purchase.php?action=deletePurchaseOrders',
                                params: {
                                    ids: ids
                                },
                                success: function(response){
                                    var result = eval(response.responseText);
                                    switch (result) {
                                        case 1:
                                            purchaseOrdersStore.reload();
                                            break;
                                        default:
                                            Ext.MessageBox.alert('Uh uh...', 'We couldn\'t save him...');
                                            break;
                                    }
                                },
                                failure: function(response){
                                    var result = response.responseText;
                                    Ext.MessageBox.alert('error', 'could not connect to the database. retry later');
                                }
                            });	
                        }
                    );
                }
            },'-',{
                id: 'purchase-orders-to-go-inventory-orders',
                text: lang.Purchase_Orders_To_Go_Inventory_Orders,
                handler: function(){
                    var selections = purchaseOrdersGrid.selModel.getSelections();
                    var ids = "";
                    if(purchaseOrdersGrid.selModel.getCount() == 1){
                        Ext.Msg.prompt(lang.Prompt, lang.Please_Type_Num, function(btn, text){
                            if (btn == 'ok'){
                                Ext.Ajax.request({
                                    waitMsg: 'Please wait...',
                                    url: 'purchase.php?action=changePO2GIO',
                                    params: {
                                        id: selections[0].data.id,
                                        quantity: text,
                                        price: selections[0].data.sku_price,
                                        total_quantity: selections[0].data.sku_purchase_qty
                                    },
                                    success: function(response){
                                        var result = eval(response.responseText);
                                        switch (result) {
                                            case 1:
                                                purchaseOrdersStore.reload();
                                                break;
                                            default:
                                                Ext.MessageBox.alert('Uh uh...', 'We couldn\'t save him...');
                                                break;
                                        }
                                    },
                                    failure: function(response){
                                        var result = response.responseText;
                                        Ext.MessageBox.alert('error', 'could not connect to the database. retry later');
                                    }
                                });	
                            }
                        });
                    }
                    /*
                    for(i = 0; i< purchaseOrdersGrid.selModel.getCount(); i++){
                        ids += selections[i].data.id + ","
                    }
                    */
                }
            },'-',{
                id: 'go-inventory-orders-to-inventory',
                text: lang.Go_Inventory_Orders_To_Inventory,
                handler: function(){
                    //alert(lang.Close);    
                    //return 0;
                
                    var selections = purchaseOrdersGrid.selModel.getSelections();
                    var ids = "";
                    for(i = 0; i< purchaseOrdersGrid.selModel.getCount(); i++){
                            ids += selections[i].data.id + ","
                    }
                    ids = ids.slice(0, -1);
                    //console.log(ids);
                    Ext.Ajax.request({
                        waitMsg: 'Please wait...',
                        url: 'purchase.php?action=GIOToInventory',
                        params: {
                            ids: ids
                        },
                        success: function(response){
                            var result = eval(response.responseText);
                            switch (result) {
                                case 1:
                                    purchaseOrdersStore.reload();
                                    break;
                                default:
                                    Ext.MessageBox.alert('Uh uh...', 'We couldn\'t save him...');
                                    break;
                            }
                        },
                        failure: function(response){
                            var result = response.responseText;
                            Ext.MessageBox.alert('error', 'could not connect to the database. retry later');
                        }
                    });	
                }
            },'-',new Ext.PagingToolbar({
                //pageSize: 20,
                store: purchaseOrdersStore,
                displayMsg: lang.Total_Record + ' {2}',
                displayInfo: true
            })
        ],
        tbar: /*
            lang.Vendors, '',
            '-',
            lang.SKU, '',
            '-',*/
        {
            id:"purchase-orders-search-form",
            xtype:"form",
            labelWidth: 80,
            items:[{
                layout:"column",
                items:[{
                    columnWidth:0.18,
                    layout:"form",
                    defaults:{
                      width:120
                    },
                    items:[{
                        xtype:"combo",
                        mode: 'local',
                        store: new Ext.data.JsonStore({
                            autoLoad: true,
                            fields: ['id', 'name'],
                            url: "purchase.php?action=getVendors"
                        }),
                        valueField:'id',
                        displayField:'name',
                        fieldLabel: lang.Vendors,
                        triggerAction: 'all',
                        editable: false,
                        listWidth: 200,
                        selectOnFocus:true,
                        name:"combovalue",
                        hiddenName:"combovalue"
                      },{
                        xtype:"textfield",
                        fieldLabel: lang.Sku,
                        name:"textvalue"
                      }]
                  },{
                    columnWidth:0.18,
                    layout:"form",
                    defaults:{
                      width:120
                    },
                    items:[{
                        xtype:"combo",
                        fieldLabel: lang.Purchase_Orders_Type,
                        width: 80,
                        mode: 'local',
                        store: new Ext.data.ArrayStore({
                            fields: [
                                'id',
                                'name'
                            ],
                            data: [['3', lang.Purchase_Planned_Type_Enum.all], ['2', lang.Purchase_Planned_Type_Enum.manual], ['1', lang.Purchase_Planned_Type_Enum.normal]]
                        }),
                        valueField: 'id',
                        displayField: 'name',
                        triggerAction: 'all',
                        editable: false,
                        selectOnFocus:true
                    
                      },{
                        xtype:"combo",
                        fieldLabel: lang.Purchase_Orders_Status,
                        width: 80,
                        mode: 'local',
                        store: new Ext.data.ArrayStore({
                            fields: [
                                'id',
                                'name'
                            ],
                            data: [['1', lang.Purchase_Orders_Status_Enum.draft ], ['2', lang.Purchase_Orders_Status_Enum.waiting_inquiry], ['3', lang.Purchase_Orders_Status_Enum.waiting_approval], ['4', lang.Purchase_Orders_Status_Enum.approval_not_pass], ['5', lang.Purchase_Orders_Status_Enum.approval_pass], ['6', lang.Purchase_Orders_Status_Enum.in_transit]]
                        }),
                        valueField: 'id',
                        displayField: 'name',
                        triggerAction: 'all',
                        editable: false,
                        selectOnFocus:true
                    }]
                  },{
                    columnWidth:0.18,
                    layout:"form",
                    defaults:{
                      width:120
                    },
                    items:[{
                        xtype:"combo",
                        mode: 'local',
                        store: new Ext.data.JsonStore({
                            autoLoad: true,
                            fields: ['id', 'name'],
                            url: "purchase.php?action=getPurchaser"
                        }),
                        valueField:'id',
                        displayField:'name',
                        fieldLabel: lang.Vendors,
                        triggerAction: 'all',
                        editable: false,
                        selectOnFocus:true,
                        fieldLabel: lang.Purchaser,
                        name:"combovalue",
                        hiddenName:"combovalue"
                    },{
                        xtype:"combo",
                        fieldLabel: lang.Category,
                        name:"combovalue",
                        hiddenName:"combovalue"
                    }]
                }]
            }],
            buttonAlign: 'center',
            buttons: [{
                text: lang.Search,
                handler: function(){
                    purchaseOrdersStore.baseParams = {
                        vendors: Ext.getCmp("purchase-orders-search-form").getForm().items.items[0].getValue(),
                        sku: Ext.getCmp("purchase-orders-search-form").getForm().items.items[1].getValue(),
                        purchase_type: Ext.getCmp("purchase-orders-search-form").getForm().items.items[2].getValue(),
                        purchase_status: Ext.getCmp("purchase-orders-search-form").getForm().items.items[3].getValue(),
                        purchaser: Ext.getCmp("purchase-orders-search-form").getForm().items.items[4].getValue()
                    };
                    purchaseOrdersStore.load();
                }
            }]
        }
    })
    
    var purchasePlannedPanel = new Ext.Panel({
        id: 'purchase-planned',
        autoScroll: true,
        width: 1024,
        //hidden: true,
        items: purchasePlannedGrid,
        renderTo: 'purchase-planned-panel'
    });
    
    var purchaseOrdersPanel = new Ext.Panel({
        id: 'purchase-orders',
        autoScroll: true,
        width: 1820,
        hidden: true,
        items: purchaseOrdersGrid,
        renderTo: 'purchase-orders-panel'
    });
    
    Ext.EventManager.addListener("view-purchase-planned", "click", function(){
        purchasePlannedPanel.show();
        purchaseOrdersPanel.hide();
    })
    
    var purchaseOrdersUI = function(status){
        switch(status){
            case 1:
                Ext.getCmp("create-purchase-orders").enable();
                Ext.getCmp("edit-purchase-orders").enable();
                Ext.getCmp("submit-purchase-orders").enable();
                Ext.getCmp("purchase-orders-inquiry-complete").disable();
                Ext.getCmp("purchase-orders-approval-not-pass").disable();
                Ext.getCmp("purchase-orders-approval-pass").disable();
                Ext.getCmp("purchase-orders-return-approval").disable();
                Ext.getCmp("delete-purchase-orders").disable();
                Ext.getCmp("purchase-orders-to-go-inventory-orders").disable();
                Ext.getCmp("go-inventory-orders-to-inventory").disable();
            break;
        
            case 2:
                Ext.getCmp("create-purchase-orders").disable();
                Ext.getCmp("edit-purchase-orders").enable();
                Ext.getCmp("submit-purchase-orders").disable();
                Ext.getCmp("purchase-orders-inquiry-complete").enable();
                Ext.getCmp("purchase-orders-approval-not-pass").disable();
                Ext.getCmp("purchase-orders-approval-pass").disable();
                Ext.getCmp("purchase-orders-return-approval").disable();
                Ext.getCmp("delete-purchase-orders").disable();
                Ext.getCmp("purchase-orders-to-go-inventory-orders").disable();
                Ext.getCmp("go-inventory-orders-to-inventory").disable();
            break;
        
            case 3:
                Ext.getCmp("create-purchase-orders").disable();
                Ext.getCmp("edit-purchase-orders").disable();
                Ext.getCmp("submit-purchase-orders").disable();
                Ext.getCmp("purchase-orders-inquiry-complete").disable();
                Ext.getCmp("purchase-orders-approval-not-pass").enable();
                Ext.getCmp("purchase-orders-approval-pass").enable();
                Ext.getCmp("purchase-orders-return-approval").disable();
                Ext.getCmp("delete-purchase-orders").disable();
                Ext.getCmp("purchase-orders-to-go-inventory-orders").disable();
                Ext.getCmp("go-inventory-orders-to-inventory").disable();
            break;
        
            case 5:
                Ext.getCmp("create-purchase-orders").disable();
                Ext.getCmp("edit-purchase-orders").disable();
                Ext.getCmp("submit-purchase-orders").disable();
                Ext.getCmp("purchase-orders-inquiry-complete").disable();
                Ext.getCmp("purchase-orders-approval-not-pass").disable();
                Ext.getCmp("purchase-orders-approval-pass").disable();
                Ext.getCmp("purchase-orders-return-approval").enable();
                Ext.getCmp("delete-purchase-orders").enable();
                Ext.getCmp("purchase-orders-to-go-inventory-orders").enable();
                Ext.getCmp("go-inventory-orders-to-inventory").disable();
            break;
        
            case 6:
                Ext.getCmp("create-purchase-orders").disable();
                Ext.getCmp("edit-purchase-orders").disable();
                Ext.getCmp("submit-purchase-orders").disable();
                Ext.getCmp("purchase-orders-inquiry-complete").disable();
                Ext.getCmp("purchase-orders-approval-not-pass").disable();
                Ext.getCmp("purchase-orders-approval-pass").disable();
                Ext.getCmp("purchase-orders-return-approval").disable();
                Ext.getCmp("delete-purchase-orders").disable();
                Ext.getCmp("purchase-orders-to-go-inventory-orders").disable();
                Ext.getCmp("go-inventory-orders-to-inventory").enable();
            break;
        }
        
        purchaseOrdersPanel.show();
        purchasePlannedPanel.hide();
        purchaseOrdersStore.baseParams = {
            purchase_status: status
        };
        purchaseOrdersStore.load();
    }
    
    Ext.EventManager.addListener("view-purchase-orders", "click", function(){
        purchaseOrdersUI(1);
    })
    
    Ext.EventManager.addListener("inquiry-purchase-orders", "click", function(){
        purchaseOrdersUI(2);
    })
    
    Ext.EventManager.addListener("approval-purchase-orders", "click", function(){
        purchaseOrdersUI(3);
    })
    Ext.EventManager.addListener("purchase-in-transit", "click", function(){
        purchaseOrdersUI(5);
    })
    Ext.EventManager.addListener("go-inventory-orders", "click", function(){
        purchaseOrdersUI(6);
    })
})