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
        fields: ['id', 'research_id', 'createdOn', 'chinese_title', 'product_cost', 'product_net_weight', 'min_purchase_num', 'product_arrival_days'],
        url:'research.php?action=getPurchaseInfoList',
        listeners:{load: function(t, r, o){
                Ext.Ajax.request({
                    url: 'research.php?action=getResearchStatusCount',
                    success: function(response, opts) {
                       var obj = Ext.decode(response.responseText);
                       //console.log(obj);
                       for(var i=0; i<obj.length; i++){
                            if(obj[i].status == 2 || obj[i].status == 4){
                                Ext.getCmp("status-button-"+obj[i].status).setText(lang.Status_Array[obj[i].status] + "(" + obj[i].count + ")");
                            }
                       }
                    },
                    failure: function(response, opts) {
                       console.log('server-side failure with status code ' + response.status);
                    }
                });
            }
        }
    });
    
    var purchaseGrid = new Ext.grid.GridPanel({
        autoHeight: true,
        store: purchaseStore,
        columns:[{
            header: lang.ID,
            dataIndex: 'research_id',
            width: 70,
            align: 'center',
            sortable: true
        },{
            header: lang.Created_On,
            dataIndex: 'createdOn',
            width: 110,
            align: 'center',
            sortable: true
        },{
            header: lang.Chinese_Title,
            dataIndex: 'chinese_title',
            width: 200,
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
        listeners: {'dblclick': function(e){
            var selections = purchaseGrid.selModel.getSelections();
            var id = selections[0].data.id;
            var research_id = selections[0].data.research_id;
            
            var imageTempalte = new Ext.Template('<a href="{0}"><img width="100" height="100" src="{0}"/></a><a href="{1}"><img width="100" height="100" src="{1}"/></a>',
                                                 '<a href="{2}"><img width="100" height="100" src="{2}"/></a><a href="{3}"><img width="100" height="100" src="{3}"/></a>',
                                                 '<a href="{4}"><img width="100" height="100" src="{4}"/></a>');
            imageTempalte.compile();
            
            var purchaseDesForm = new Ext.form.FormPanel({
                reader:new Ext.data.JsonReader({
                    }, ['chinese_title','product_cost','min_purchase_num','product_net_weight','product_arrival_days','remark','suppliers_info','target_purchase_cost','estimated_weight','product_parameter_information','images','status','sales_judge','continue_develop','rejected_reason']
                ),
                labelWidth: 100,
                autoScroll:true,
                items:[{
                    xtype:"textfield",
                    fieldLabel:lang.Chinese_Title,
                    name:"chinese_title",
                    width: 380,
                    //disabled:true
                    listeners: {change: function(t, n, o){
                        this.setValue(o);
                    }}
                  },{
                    xtype:"combo",
                    mode: 'local',
                    store: new Ext.data.JsonStore({
                        autoLoad: true,
                        fields: ['id', 'name'],
                        url: "research.php?action=getRCOStatus&id="+research_id
                    }),
                    valueField:'id',
                    displayField:'name',
                    triggerAction: 'all',
                    editable: false,
                    selectOnFocus:true,
                    fieldLabel: lang.Status,
                    name:"status",
                    hiddenName:"status"
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
                    fieldLabel:lang.Suppliers_Info,
                    name:"suppliers_info",
                    width: 380,
                    height: 50
                  },{
                    xtype:"textarea",
                    fieldLabel:lang.Remark,
                    name:"remark",
                    width: 380,
                    height: 50
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
                          },{
                            xtype:"combo",
                            mode: 'local',
                            store: new Ext.data.ArrayStore({
                                fields: ['id', 'name'],
                                data: [[0, lang.No], [1, lang.Yes]]
                            }),
                            valueField: 'id',
                            displayField: 'name',
                            triggerAction: 'all',
                            editable: false,
                            selectOnFocus:true,
                            fieldLabel:lang.Sales_Judge,
                            name:"sales_judge",
                            hiddenName:"sales_judge",
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
                          },{
                            xtype:"combo",
                            mode: 'local',
                            store: new Ext.data.ArrayStore({
                                fields: ['id', 'name'],
                                data: [[0, lang.No], [1, lang.Yes]]
                            }),
                            valueField: 'id',
                            displayField: 'name',
                            triggerAction: 'all',
                            editable: false,
                            selectOnFocus:true,
                            fieldLabel:lang.Continue_Develop,
                            name:"continue_develop",
                            hiddenName:"continue_develop",
                            disabled:true
                        }]
                      }]
                  },{
                    xtype:"textarea",
                    fieldLabel:lang.Product_Parameter_Information,
                    name:"product_parameter_information",
                    //disabled:true,
                    width: 380,
                    height: 50,
                    listeners: {change: function(t, n, o){
                        this.setValue(o);
                    }}
                  },{
                    xtype:"textarea",
                    fieldLabel:lang.Rejected_Reason,
                    name:"rejected_reason",
                    disabled:true,
                    width: 380,
                    height: 50
                  },{
                    id:'images-list',
                    xtype:"panel",
                    title:lang.Product_Photo_Gallery,
                    tpl:imageTempalte
                  }]
                }
            )
            
            purchaseDesForm.getForm().load({url:'research.php?action=getPurchseInfo&id='+id+'&research_id='+research_id, 
                    method:'GET',
                    waitMsg: lang.Waitting,
                    success: function(f, a){
                        //console.log(a.result.data.images);
                        imageTempalte.append('images-list', a.result.data.images);
                        $('#images-list a').lightBox();
                    }
                }
            );
            
            var purchaseDesWindow = new Ext.Window({
                title: research_id,
                closable:true,
                width: 600,
                height: 500,
                plain:true,
                layout: 'fit',
                items: purchaseDesForm,
                buttons: [{
                    text: lang.Update,
                    handler: function(){
                        purchaseDesForm.getForm().submit({
                            url: 'research.php?action=updatePurchseInfo&id='+id+'&research_id='+research_id, 
                            success: function(f, a){
                                var response = Ext.decode(a.response.responseText);
                                if(response.success){
                                    purchaseDesWindow.close();
                                    purchaseStore.reload();
                                }
                            },
                            failure: function(form, action) {
                                Ext.MessageBox.alert('Error', action.result.errors.message);  
                            },
                            waitMsg: lang.Waiting
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
        }}
    })
    
    var purchase_search = new Ext.form.FormPanel({
        items:[{
            layout:"column",
            title:lang.Search_Panel,
            items:[{
                columnWidth:0.33,
                layout:"form",
                items:[{
                    xtype:"textfield",
                    fieldLabel:lang.ID,
                    name:"id"
                  }]
              },{
                columnWidth:0.33,
                layout:"form",
                items:[{
                    xtype:"textfield",
                    fieldLabel:lang.Chinese_Title,
                    name:"chinese_title"
                  }]
              },{
                columnWidth:0.33,
                layout:"form",
                items:[{
                    xtype:"datefield",
                    fieldLabel:lang.Created_On,
                    name:"createdOn",
                    format:'Y-m-d'
                  }]
              }]
          },{
                xtype:'button',
                text: lang.Search,
                handler: function(){
                    purchaseStore.baseParams = {
                        id: purchase_search.getForm().items.items[0].getValue(),
                        chinese_title: purchase_search.getForm().items.items[1].getValue(),
                        createdOn: purchase_search.getForm().items.items[2].getValue(),
                        type: "search"
                    };
                    purchaseStore.load();
                }
            }]
    })
    
    function showResearchByStatus(status){
        purchaseStore.baseParams = {
            status: status
        };
        purchaseStore.load();
        //console.log(Ext.getCmp("status_panel").getComponent(0).setText("xx"));
    }
    
    var viewport = new Ext.Viewport({
        layout:'border',
        items:[{
                region:'north',
                xtype:"panel",
                items:purchase_search,
                height: 85
        },{
            id:'status_panel',
            region:'west',
            title: lang.Status_Panel,
            split:true,
            width: 180,
            minSize: 160,
            maxSize: 300,
            collapsible: true,
            defaults:{margins:'0 0 5 0', width: 100},
            layout: {
                type:'vbox',
                padding:'5',
                align:'stretch'
            },
            items: [{
                id:'status-button-2',
                xtype:'button',
                text: lang.Waiting_Inquiry,
                handler: function(b, e){
                    showResearchByStatus(2);
                }
            },{
                id:'status-button-4',
                xtype:'button',
                text: lang.Inquiry_Complete,
                handler: function(b, e){
                    showResearchByStatus(4);
                }
            },{
                xtype:'button',
                text: "<font color='red'>"+lang.Exit+"</font>",
                handler: function(b, e){
                    window.location = "login.php";
                }
            }]
        },{
          region:'center',
          autoScroll: true,
          items:purchaseGrid
        }]  
    })
})