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
    
    var position_management_panel = new Ext.Panel({
        width: 600,
        items: {
            xtype:"panel",
            title:lang.Position_Management,
            items:[{
                layout:"column",
                items:[{
                    layout:"form",
                    columnWidth:0.5,
                    items:[{
                        xtype:"textfield",
                        fieldLabel:lang.SKU,
                        id:"sku",
                        name:"sku",
                        listeners: {
                            specialkey: function(t, e){
                                if(e.getKey() == 13){
                                    Ext.Ajax.request({
                                        waitMsg: 'Please wait...',
                                        url: 'warehouse.php?action=getSkuPosition',
                                        params: {
                                            sku: Ext.getCmp("sku").getValue()
                                        },
                                        success: function(response){
                                            var result = Ext.decode(response.responseText);
                                            //console.log(result);
                                            Ext.getCmp("position").setValue(result.position);
                                        },
                                        failure: function(response){
                                            var result = response.responseText;
                                            Ext.MessageBox.alert('error', 'could not connect to the database. retry later');
                                        }
                                    });
                                }
                            }
                        }
                      }]
                  },{
                    layout:"form",
                    columnWidth:0.5,
                    items:[{
                        xtype:"textfield",
                        fieldLabel:lang.Position,
                        id:"position",
                        name:"position"
                      }]
                  }]
            }]
        },
        buttonAlign:'center',
        buttons: [{
            text: lang.Search,
            handler: function(){
                Ext.Ajax.request({
                    waitMsg: 'Please wait...',
                    url: 'warehouse.php?action=getSkuPosition',
                    params: {
                        sku: Ext.getCmp("sku").getValue()
                    },
                    success: function(response){
                        var result = Ext.decode(response.responseText);
                        //console.log(result);
                        Ext.getCmp("position").setValue(result.position);
                    },
                    failure: function(response){
                        var result = response.responseText;
                        Ext.MessageBox.alert('error', 'could not connect to the database. retry later');
                    }
                });
            }
        },{
            text: lang.Save,
            handler: function(){
                var sku = Ext.getCmp("sku").getValue();
                if(Ext.isEmpty(sku)){
                    Ext.MessageBox.alert(lang.Warning, lang.SKU_Is_Empty);
                }else{
                    Ext.Ajax.request({
                        waitMsg: 'Please wait...',
                        url: 'warehouse.php?action=updateSkuPosition',
                        params: {
                            sku: sku,
                            position: Ext.getCmp("position").getValue()
                        },
                        success: function(response){
                            var result = eval(response.responseText);
                            switch (result) {
                                case 1:
                                    
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
            }
        }],
        hidden: true,
        renderTo: 'position-management-panel'    
    });
    
    var sku_form = new Ext.form.FormPanel({
        width: 900,
        layout:"column",
        reader:new Ext.data.JsonReader({},
                                       ['title','status','weight','accessories','image','stock','position','pmno','pmtitle','pmqty',
                                        'product_parameters','envelope','bar_cotton','bar_cotton_number','massive_cotton','massive_cotton_number']
                                       ),
        items:[{
            columnWidth:0.4,
            layout:"form",
            labelWidth:60,
            items:[{
                layout:"column",
                items:[{
                    columnWidth:0.5,
                    layout:"form",
                    labelWidth:60,
                    border:false,
                    items:[{
                        xtype:"textfield",
                        fieldLabel:lang.SKU,
                        //id:"sku",
                        name:"sku",
                        listeners: {
                            specialkey: function(t, e){
                                if(e.getKey() == 13){
                                    sku_form.getForm().load({
                                        url:'warehouse.php?action=getSkuInfo', 
                                        method:'GET', 
                                        params: {sku: sku_form.getForm().findField('sku').getValue()}, 
                                        waitMsg:'Please wait...',
                                        success: function(f, a){
                                            document.getElementById("sku_image").src = a.result.data.image;
                                            document.getElementById("sku_image_link").href = a.result.data.image;
                                        }
                                    })
                                }
                            }
                        }
                      }]
                  },{
                    columnWidth:0.5,
                    border:false,
                    items:[{
                        xtype:"button",
                        text:lang.Search,
                        handler: function(){
                            sku_form.getForm().load({
                                url:'warehouse.php?action=getSkuInfo', 
                                method:'GET', 
                                params: {sku: sku_form.getForm().findField('sku').getValue()}, 
                                waitMsg:'Please wait...',
                                success: function(f, a){
                                    document.getElementById("sku_image").src = a.result.data.image;
                                    document.getElementById("sku_image_link").href = a.result.data.image;
                                }
                            })
                        }
                      }]
                  }]
              },{
                xtype:"textfield",
                fieldLabel:lang.Title,
                id:"title",
                name:"title",
                //disabled:true,
                width:250
              },{
                xtype:"textfield",
                fieldLabel:lang.Envelope,
                id:"envelope",
                name:"envelope",
                //disabled:true,
                width:250
              },{
                layout:"column",
                items:[{
                    columnWidth:0.5,
                    layout:"form",
                    labelWidth:60,
                    items:[{
                        xtype:"textfield",
                        fieldLabel:lang.Status,
                        //disabled:true,
                        id:"status",
                        name:"status"
                      }]
                  },{
                    columnWidth:0.5,
                    layout:"form",
                    labelWidth:60,
                    items:[{
                        xtype:"numberfield",
                        fieldLabel:lang.Weight,
                        //disabled:true,
                        id:"weight",
                        name:"weight"
                      }]
                  }]
              },{
                layout:"column",
                items:[{
                    columnWidth:0.5,
                    layout:"form",
                    labelWidth:60,
                    items:[{
                        xtype:"numberfield",
                        fieldLabel:lang.Stock,
                        //disabled:true,
                        id:"stock",
                        name:"stock"
                      }]
                  },{
                    columnWidth:0.5,
                    layout:"form",
                    labelWidth:60,
                    items:[{
                        xtype:"textfield",
                        fieldLabel:lang.Position,
                        //disabled:true,
                        name:"position"
                      }]
                  }]
              },{
                layout:"column",
                items:[{
                    columnWidth:0.5,
                    layout:"form",
                    labelWidth:60,
                    items:[{
                        xtype:"textfield",
                        fieldLabel:lang.Bar_Cotton,
                        //disabled:true,
                        name:"bar_cotton"
                      }]
                  },{
                    columnWidth:0.5,
                    layout:"form",
                    labelWidth:70,
                    items:[{
                        xtype:"textfield",
                        fieldLabel:lang.Bar_Cotton_Number,
                        //disabled:true,
                        name:"bar_cotton_number"
                      }]
                  }]
              },{
                layout:"column",
                items:[{
                    columnWidth:0.5,
                    layout:"form",
                    labelWidth:60,
                    items:[{
                        xtype:"textfield",
                        fieldLabel:lang.Massive_Cotton,
                        //disabled:true,
                        name:"massive_cotton"
                      }]
                  },{
                    columnWidth:0.5,
                    layout:"form",
                    labelWidth:70,
                    items:[{
                        xtype:"textfield",
                        fieldLabel:lang.Massive_Cotton_Number,
                        //disabled:true,
                        name:"massive_cotton_number"
                      }]
                  }]
              },{
                xtype:"textarea",
                fieldLabel:lang.Product_Parameters,
                //disabled:true,
                id:"product_parameters",
                name:"product_parameters",
                width:250
                },{
                xtype:"textarea",
                fieldLabel:lang.Accessories,
                //disabled:true,
                id:"accessories",
                name:"accessories",
                width:250
                }]
          },{
            columnWidth:0.6,
            layout:"form",
            items:[{
                xtype:"panel",
                title:lang.Image,
                //id:"image",
                html:"<img id='sku_image' width='500' height='375' src=''/>"
              }/*,{
                layout:"column",
                title:lang.Packaging_Materials,
                items:[{
                    columnWidth:0.3,
                    layout:"form",
                    labelAlign:'top',
                    items:[{
                        xtype:"textfield",
                        fieldLabel:lang.No,
                        disabled:true,
                        id:"pmno",
                        name:"pmno",
                        width:100
                      }]
                  },{
                    columnWidth:0.5,
                    layout:"form",
                    labelAlign:'top',
                    items:[{
                        xtype:"textfield",
                        fieldLabel:lang.Title,
                        disabled:true,
                        id:"pmtitle",
                        name:"pmtitle",
                        width:180
                      }]
                  },{
                    columnWidth:0.2,
                    layout:"form",
                    labelAlign:'top',
                    items:[{
                        xtype:"numberfield",
                        fieldLabel:lang.Qty,
                        disabled:true,
                        id:"pmqty",
                        name:"pmqty",
                        width:60
                      }]
                  }]
              }*/]
        }],
        hidden: true,
        renderTo: 'sku-management-panel'    
    });

    var skuStocStore = new Ext.data.JsonStore({
            root: 'records',
            totalProperty: 'totalCount',
            idProperty: 'id',
            //autoLoad:true,
            fields: ['sku', 'title', 'locator', 'stock', 'virtual_stock', 'good_products_warehouse', 'bad_products_warehouse', 'repair_warehouse', 'sample_warehouse'],
            url:'warehouse.php?action=getSkuWarehouseStock'
    });

    var skuStockGrid = new Ext.grid.GridPanel({
        autoHeight: true,
        //height: 600,
        store: skuStocStore,
        columns:[{
            header: lang.SKU,
            dataIndex: 'sku',
            width: 100,
            align: 'center',
            sortable: true
        },{
            header: lang.Title,
            dataIndex: 'title',
            width: 250,
            align: 'center',
            sortable: true
        },{
            header: lang.Locator,
            dataIndex: 'locator',
            width: 70,
            align: 'center',
            sortable: true
        },{
            header: lang.Stock,
            dataIndex: 'stock',
            width: 70,
            align: 'center',
            sortable: true
        },{
            header: lang.Virtual_Stock,
            dataIndex: 'virtual_stock',
            width: 70,
            align: 'center',
            sortable: true
        },{
            header: lang.Good_Products_Warehouse,
            dataIndex: 'good_products_warehouse',
            width: 70,
            align: 'center',
            sortable: true
        },{
            header: lang.Bad_Products_Warehouse,
            dataIndex: 'bad_products_warehouse',
            width: 70,
            align: 'center',
            sortable: true
        },{
            header: lang.Repair_Warehouse,
            dataIndex: 'repair_warehouse',
            width: 70,
            align: 'center',
            sortable: true
        },{
            header: lang.Sample_Warehouse,
            dataIndex: 'sample_warehouse',
            width: 70,
            align: 'center',
            sortable: true
        }],
        bbar: new Ext.PagingToolbar({
              pageSize: 50,
              store: skuStocStore,
              displayInfo: true
        }),
        tbar:{
            id:"sku-sotck-search-form",
            xtype:"form",
            labelWidth: 80,
            items:[{
                layout:"column",
                items:[{
                    columnWidth:0.5,
                    layout:"form",
                    defaults:{
                      width:120
                    },
                    items:[{
                        xtype:"textfield",
                        fieldLabel: lang.SKU,
                        name:"textvalue"
                      }]
                  },{
                    columnWidth:0.5,
                    layout:"form",
                    defaults:{
                      width:120
                    },
                    items:[{
                        xtype:"textfield",
                        fieldLabel: lang.Title,
                        name:"textvalue"
                      }]
                }]
            }],
            buttonAlign: 'center',
            buttons: [{
                text: lang.Search,
                handler: function(){
                    skuStocStore.baseParams = {
                        sku: Ext.getCmp("sku-sotck-search-form").getForm().items.items[0].getValue(),
                        title: Ext.getCmp("sku-sotck-search-form").getForm().items.items[1].getValue()
                    };
                    skuStocStore.load();
                }
            },{
                text: lang.Export,
                handler: function(){
                    window.open("warehouse.php?action=getSkuWarehouseStock&type=xls&"
                                +Ext.urlEncode({'sku': Ext.getCmp("sku-sotck-search-form").getForm().items.items[0].getValue(),
                                                'title': Ext.getCmp("sku-sotck-search-form").getForm().items.items[1].getValue()}),
                                "_blank","toolbar=no, location=yes, directories=no, status=no, menubar=yes, scrollbars=yes, resizable=no, copyhistory=yes, width=100, height=100");  
                }
            }]
        },
        hidden: true,
        renderTo: 'sku-stock-panel'   
    })
    
    Ext.EventManager.addListener("position-management", "click", function(){
        sku_form.hide();
        skuStockGrid.hide();
        position_management_panel.show();
    })
    
    Ext.EventManager.addListener("sku-info-search", "click", function(){
        position_management_panel.hide();
        skuStockGrid.hide();
        sku_form.show();
    })
    
    Ext.EventManager.addListener("sku-stock-search", "click", function(){
        sku_form.hide();
        position_management_panel.hide();
        skuStockGrid.show();
    })
})