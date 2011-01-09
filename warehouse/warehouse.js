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
        width: 800,
        layout:"column",
        reader:new Ext.data.JsonReader({},
                                       ['title','status','weight','accessories','image','stock','position','pmno','pmtitle','pmqty']
                                       ),
        items:[{
            columnWidth:0.5,
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
                disabled:true,
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
                        disabled:true,
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
                        disabled:true,
                        id:"weight",
                        name:"weight"
                      }]
                  }]
              },{
                xtype:"textarea",
                fieldLabel:lang.Accessories,
                disabled:true,
                id:"accessories",
                name:"accessories",
                width:250
                }]
          },{
            columnWidth:0.5,
            layout:"form",
            items:[{
                xtype:"panel",
                title:lang.Image,
                //id:"image",
                html:"<a id='sku_image_link' target='_blank' href=''><img id='sku_image' width='200' height='100' src=''/></a>"
              },{
                layout:"column",
                items:[{
                    columnWidth:0.5,
                    layout:"form",
                    labelWidth:60,
                    items:[{
                        xtype:"numberfield",
                        fieldLabel:lang.Stock,
                        disabled:true,
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
                        disabled:true,
                        name:"position"
                      }]
                  }]
              },{
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
              }]
        }],
        hidden: true,
        renderTo: 'sku-management-panel'    
    });
    
    Ext.EventManager.addListener("position-management", "click", function(){
        sku_form.hide();
        position_management_panel.show();
    })
    
    Ext.EventManager.addListener("sku-info-search", "click", function(){
        position_management_panel.hide();
        sku_form.show();
    })
})