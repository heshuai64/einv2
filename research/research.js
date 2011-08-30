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
    
    var researchStore = new Ext.data.JsonStore({
        root: 'records',
        totalProperty: 'totalCount',
        idProperty: 'id',
        autoLoad:true,
        fields: ['id', 'createdOn', 'warehouse', 'chinese_title', 'sales', 'status', 'category', 'cancel_reason', 'images'],
        url:'research.php?action=getResearchInfoList'
    });
    
    
    var researchGrid = new Ext.grid.GridPanel({
        autoHeight: true,
        store: researchStore,
        columns:[{  header: lang.ID,
                    dataIndex: 'id',
                    width: 70,
                    align: 'center',
                    sortable: true
                },{  header: lang.Created_On,
                    dataIndex: 'createdOn',
                    width: 70,
                    align: 'center',
                    sortable: true
                },{ header: lang.Warehouse,
                    dataIndex: 'warehouse',
                    width: 70,
                    align: 'center',
                    sortable: true
                },{ header: lang.Chinese_Title,
                    dataIndex: 'chinese_title',
                    width: 70,
                    align: 'center',
                    sortable: true
                },{ header: lang.Sales,
                    dataIndex: 'sales',
                    width: 70,
                    align: 'center',
                    sortable: true
                },{ header: lang.Status,
                    dataIndex: 'status',
                    width: 70,
                    align: 'center',
                    sortable: true
                },{ header: lang.Status,
                    dataIndex: 'status',
                    width: 70,
                    align: 'center',
                    sortable: true
                },{ header: lang.Category,
                    dataIndex: 'category',
                    width: 70,
                    align: 'center',
                    sortable: true
                },{ header: lang.Cancel_Reason,
                    dataIndex: 'cancel_reason',
                    width: 70,
                    align: 'center',
                    sortable: true
                },{ header: lang.Images,
                    dataIndex: 'images',
                    width: 70,
                    align: 'center',
                    sortable: true
                }],
        bbar: [{
                text: 'xx',
                handler: function(){
                    var selections = researchGrid.selModel.getSelections();
                    var id = selections[0].data.id;
                    
                    var purchaseInquiryStore = new Ext.data.JsonStore({
                        root: 'records',
                        totalProperty: 'totalCount',
                        idProperty: 'id',
                        autoLoad:true,
                        fields: ['id', 'purchaser', 'product_cost', 'product_net_weight', 'min_purchase_num', 'product_arrival_days', 'createdOn', 'remark'],
                        url:'research.php?action=getPurchseInfo&research_id='+id
                    });
                    
                    var purchaseInquiryGrid = new Ext.grid.GridPanel({
                        autoHeight: true,
                        store: purchaseInquiryStore,
                        columns:[{
                            header: lang.Purchaser,
                            dataIndex: 'purchaser',
                            width: 70,
                            align: 'center',
                            sortable: true
                        },{
                            header: lang.Product_Cost,
                            dataIndex: 'product_cost',
                            width: 70,
                            align: 'center',
                            sortable: true
                        },{
                            header: lang.Product_Net_Weight,
                            dataIndex: 'product_net_weight',
                            width: 70,
                            align: 'center',
                            sortable: true
                        },{
                            header: lang.Min_Purchase_Num,
                            dataIndex: 'min_purchase_num',
                            width: 70,
                            align: 'center',
                            sortable: true
                        },{
                            header: lang.Product_Arrival_Days,
                            dataIndex: 'product_arrival_days',
                            width: 70,
                            align: 'center',
                            sortable: true
                        },{
                            header: lang.Created_On,
                            dataIndex: 'createdOn',
                            width: 70,
                            align: 'center',
                            sortable: true
                        },{
                            header: lang.Remark,
                            dataIndex: 'remark',
                            width: 70,
                            align: 'center',
                            sortable: true
                        }]
                    })
    
                    var researchDesForm = new Ext.form.FormPanel({
                        reader:new Ext.data.JsonReader({
                            }, ['english_keyword','chinese_title','category','reference_links_1','reference_links_2','reference_links_3','reference_links_4',
                                'development_standards','marketplace_average_price','target_sales_price','target_total_cost','plans_sales_mode',
                                'specific_data','marketplace_min_price','target_month_sales','target_purchase_cost','estimated_weight','product_parameter_information']
                        ),
                        labelWidth: 100,
                        items:[{
                            layout:"column",
                            items:[{
                                columnWidth:0.5,
                                layout:"form",
                                items:[{
                                    xtype:"combo",
                                    fieldLabel:lang.Warehouse,
                                    name:"warehouse",
                                    hiddenName:"warehouse"
                                },{
                                    xtype:"combo",
                                    fieldLabel:lang.Sales,
                                    name:"sales",
                                    hiddenName:"sales"
                                }]
                                },{
                                columnWidth:0.5,
                                layout:"form",
                                items:[{
                                    xtype:"combo",
                                    fieldLabel:lang.Site,
                                    name:"site",
                                    hiddenName:"site"
                                },{
                                    xtype:"combo",
                                    fieldLabel:lang.Status,
                                    name:"status",
                                    hiddenName:"status"
                                }]
                                }
                            ]
                          },{
                            xtype:"textfield",
                            fieldLabel:lang.English_Keyword,
                            name:"english_keyword",
                            width: 380
                          },{
                            xtype:"textfield",
                            fieldLabel:lang.Chinese_Title,
                            name:"chinese_title",
                            width: 380
                          },{
                            xtype:"combo",
                            fieldLabel:lang.Category,
                            name:"cateogry",
                            hiddenName:"category"
                          },{
                            xtype:"textfield",
                            fieldLabel:lang.Reference_Links_1,
                            name:"reference_links_1",
                            width: 380
                          },{
                            xtype:"textfield",
                            fieldLabel:lang.Reference_Links_2,
                            name:"reference_links_2",
                            width: 380
                          },{
                            xtype:"textfield",
                            fieldLabel:lang.Reference_Links_3,
                            name:"reference_links_3",
                            width: 380
                          },{
                            xtype:"textfield",
                            fieldLabel:lang.Reference_Links_4,
                            name:"reference_links_4",
                            width: 380
                          },{
                            layout:"column",
                            items:[{
                                columnWidth:0.5,
                                layout:"form",
                                items:[{
                                    xtype:"combo",
                                    fieldLabel:lang.Development_Standards,
                                    name:"development_standards",
                                    hiddenName:"development_standards"
                                  },{
                                    xtype:"numberfield",
                                    fieldLabel:lang.MarketPlace_Average_Price,
                                    name:"marketplace_average_price"
                                  },{
                                    xtype:"numberfield",
                                    fieldLabel:lang.Target_Sales_Price,
                                    name:"target_sales_price"
                                  },{
                                    xtype:"numberfield",
                                    fieldLabel:lang.Target_Total_Cost,
                                    name:"target_total_cost"
                                  },{
                                    xtype:"combo",
                                    fieldLabel:lang.Plans_Sales_Mode,
                                    name:"plans_sales_mode",
                                    hiddenName:"plans_sales_mode"
                                  }]
                              },{
                                columnWidth:0.5,
                                layout:"form",
                                items:[{
                                    xtype:"textfield",
                                    fieldLabel:lang.Specific_Data,
                                    name:"specific_data"
                                  },{
                                    xtype:"numberfield",
                                    fieldLabel:lang.MarketPlace_Min_Price,
                                    name:"marketplace_min_price"
                                  },{
                                    xtype:"numberfield",
                                    fieldLabel:lang.Target_Month_Sales,
                                    name:"target_month_sales"
                                  },{
                                    xtype:"numberfield",
                                    fieldLabel:lang.Target_Purchase_Cost,
                                    name:"target_purchase_cost"
                                  },{
                                    xtype:"numberfield",
                                    fieldLabel:lang.Estimated_Weight,
                                    name:"estimated_weight"
                                  }]
                              }]
                          },{
                            xtype:"textarea",
                            fieldLabel:lang.Product_Parameter_Information,
                            name:"product_parameter_information",
                            width: 380
                          },{
                            xtype:"panel",
                            title:lang.Product_Photo_Gallery
                          },purchaseInquiryGrid]
                        }
                    )
                    
                    researchDesForm.getForm().load({url:'research.php?action=getResearchInfo&id='+id, 
                            method:'GET', 
                            params: {id: id}, 
                            waitMsg: lang.Waitting,
                            success: function(f, a){
                                //console.log(purchaseOrdersForm.get("sku_img"));
                                //purchaseOrdersForm.get("sku_img_1").body.update("<img src='" + a.result.data.sku_img + "'/>");
                            }
                        }
                    );
                    
                    var researchDesWindow = new Ext.Window({
                        title: id,
                        closable:true,
                        width: 600,
                        height: 600,
                        plain:true,
                        layout: 'fit',
                        items: researchDesForm,
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
                                                researchDesWindow.close();
                                                researchStore.reload();
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
                                researchDesWindow.close();
                            }
                        }]
                    });
                
                    researchDesWindow.show();
                }
        },'-',new Ext.PagingToolbar({
                //pageSize: 20,
                store: researchStore,
                displayInfo: true
            })
        ]
    });
    
    
    var panel = new Ext.Panel({
        title: lang.Research_System,
        items:[{
            layout:"column",
            title:lang.Search_Panel,
            items:[{
                columnWidth:0.33,
                layout:"form",
                items:[{
                    xtype:"textfield",
                    fieldLabel:lang.ID,
                    name:"textvalue"
                  },{
                    xtype:"textfield",
                    fieldLabel:lang.Chinses_Title,
                    name:"textvalue"
                  }]
              },{
                columnWidth:0.33,
                layout:"form",
                items:[{
                    xtype:"combo",
                    fieldLabel:lang.Status,
                    name:"combovalue",
                    hiddenName:"combovalue"
                  },{
                    xtype:"combo",
                    fieldLabel:lang.Sales,
                    name:"combovalue",
                    hiddenName:"combovalue"
                  }]
              },{
                columnWidth:0.33,
                layout:"form",
                items:[{
                    xtype:"datefield",
                    fieldLabel:lang.Created_On,
                    name:"textvalue",
                    format:'Y-m-d'
                  },{
                    xtype:"datefield",
                    fieldLabel:lang.Modified_On,
                    name:"textvalue",
                    format:'Y-m-d'
                  }]
              }]
          },{
                xtype:'button',
                text: lang.Search,
                handler: function(){
                    
                }
            },researchGrid],
        renderTo: Ext.getBody()
    }
);
});