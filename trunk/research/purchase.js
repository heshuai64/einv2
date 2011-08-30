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
    
    var purchaseStore = new Ext.data.JsonStore({
        root: 'records',
        totalProperty: 'totalCount',
        idProperty: 'id',
        autoLoad:true,
        fields: ['id', 'createdOn', 'chinese_title', 'product_cost', 'product_net_weight', 'min_purchase_num', 'product_arrival_days'],
        url:'research.php?action=getPurchaseInfoList'
    });
    
    var purchaseGrid = new Ext.grid.GridPanel({
        autoHeight: true,
        store: purchaseStore,
        columns:[{
            header: lang.ID,
            dataIndex: 'id',
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
            header: lang.Chinese_Title,
            dataIndex: 'chinese_title',
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
        }],
        bbar: [{
                text: 'xx',
                handler: function(){
                    var selections = purchaseGrid.selModel.getSelections();
                    var id = selections[0].data.id;
                    
                    var purchaseDesForm = new Ext.form.FormPanel({
                        reader:new Ext.data.JsonReader({
                            }, ['chinese_title','product_cost','min_purchase_num','product_net_weight','product_arrival_days','remark','target_purchase_cost','estimated_weight','product_parameter_information']
                        ),
                        labelWidth: 100,
                        items:[{
                            xtype:"textfield",
                            fieldLabel:lang.Chinese_Title,
                            name:"chinese_title",
                            width: 380,
                            disabled:true
                          },{
                            layout:"column",
                            items:[{
                                columnWidth:0.5,
                                layout:"form",
                                items:[{
                                    xtype:"numberfield",
                                    fieldLabel:lang.Product_Cost,
                                    name:"product_cost"
                                },{
                                    xtype:"numberfield",
                                    fieldLabel:lang.Min_Purchase_Num,
                                    name:"min_purchase_num"
                                  }]
                                },{
                                columnWidth:0.5,
                                layout:"form",
                                items:[{
                                    xtype:"numberfield",
                                    fieldLabel:lang.Product_Net_Weight,
                                    name:"product_net_weight"
                                  },{
                                    xtype:"numberfield",
                                    fieldLabel:lang.Product_Arrival_Days,
                                    name:"product_arrival_days"
                                  }]
                                }
                            ]
                          },{
                            xtype:"textarea",
                            fieldLabel:lang.Remark,
                            name:"remark",
                            width: 380
                          },{
                            layout:"column",
                            items:[{
                                columnWidth:0.5,
                                layout:"form",
                                items:[{
                                    xtype:"numberfield",
                                    fieldLabel:lang.Target_Purchase_Cost,
                                    name:"target_purchase_cost",
                                    disabled:true
                                  }]
                              },{
                                columnWidth:0.5,
                                layout:"form",
                                items:[{
                                    xtype:"numberfield",
                                    fieldLabel:lang.Estimated_Weight,
                                    name:"estimated_weight",
                                    disabled:true
                                  }]
                              }]
                          },{
                            xtype:"textarea",
                            fieldLabel:lang.Product_Parameter_Information,
                            name:"product_parameter_information",
                            disabled:true,
                            width: 380
                          },{
                            xtype:"panel",
                            title:lang.Product_Photo_Gallery
                          }]
                        }
                    )
                    
                    purchaseDesForm.getForm().load({url:'research.php?action=getResearchInfo&id='+id, 
                            method:'GET', 
                            params: {id: id}, 
                            waitMsg: lang.Waitting,
                            success: function(f, a){
                                //console.log(purchaseOrdersForm.get("sku_img"));
                                //purchaseOrdersForm.get("sku_img_1").body.update("<img src='" + a.result.data.sku_img + "'/>");
                            }
                        }
                    );
                    
                    var purchaseDesWindow = new Ext.Window({
                        title: id,
                        closable:true,
                        width: 600,
                        height: 600,
                        plain:true,
                        layout: 'fit',
                        items: purchaseDesForm,
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
                                                purchaseDesWindow.close();
                                                purchaseStore.reload();
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
                                purchaseDesWindow.close();
                            }
                        }]
                    });
                
                    purchaseDesWindow.show();
                }
        }]
    })
    
    var purchase_search = new Ext.Panel({
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
                    fieldLabel:lang.Chinese_Title,
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
            }]
    })
    
    var viewport = new Ext.Viewport({
        layout:'border',
        items:[{
                region:'north',
                xtype:"panel",
                items:purchase_search,
                height: 130
        },{
            region:'west',
            title:'Function Palette',
            split:true,
            width: 180,
            minSize: 160,
            maxSize: 300,
            collapsible: true,
            margins:'0 0 0 5',
            items: [{}]
        },{
          region:'center',
          autoScroll: true,
          items:purchaseGrid
        }]  
    })
})