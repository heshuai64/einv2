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
    
    
    var skuCmplaintsStore = new Ext.data.JsonStore({
        root: 'records',
        totalProperty: 'totalCount',
        idProperty: 'id',
        //autoLoad:true,
        fields: ['sku', 'content', 'time'],
        url:'report.php?action=getSkuComplaints'
    });
    
    var skuCmplaintsGrid = new Ext.grid.GridPanel({
        autoHeight: true,
        //height: 600,
        store: skuCmplaintsStore,
        columns:[{
            header: lang.SKU,
            dataIndex: 'sku',
            width: 100,
            align: 'center',
            sortable: true
        },{
            header: lang.Content,
            dataIndex: 'content',
            width: 650,
            align: 'center',
            sortable: true
        },{
            header: lang.Time,
            dataIndex: 'time',
            width: 130,
            align: 'center',
            sortable: true    
        }],/*
        bbar: new Ext.PagingToolbar({
              pageSize: 50,
              store: skuCmplaintsStore,
              displayInfo: true
        }),*/
        tbar:{
            id:"sku-cmplaints-search-form",
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
                        xtype:"datefield",
                        fieldLabel: lang.Start_Date,
                        format:"Y-m-d"
                      }]
                  },{
                    columnWidth:0.5,
                    layout:"form",
                    defaults:{
                      width:120
                    },
                    items:[{
                        xtype:"datefield",
                        fieldLabel: lang.End_Date,
                        format:"Y-m-d"
                      }]
                }]
            }],
            buttonAlign: 'center',
            buttons: [{
                text: lang.Search,
                handler: function(){
                    skuCmplaintsStore.baseParams = {
                        start_date: Ext.getCmp("sku-cmplaints-search-form").getForm().items.items[0].getValue().format("Y-m-d"),
                        end_date: Ext.getCmp("sku-cmplaints-search-form").getForm().items.items[1].getValue().format("Y-m-d")
                    };
                    skuCmplaintsStore.load();
                }
            },{
                text: lang.Export,
                handler: function(){
                    window.open("report.php?action=getSkuComplaints&type=xls&"
                                +Ext.urlEncode({'start_date': Ext.getCmp("sku-cmplaints-search-form").getForm().items.items[0].getValue().format("Y-m-d"),
                                                'end_date': Ext.getCmp("sku-cmplaints-search-form").getForm().items.items[1].getValue().format("Y-m-d")}),
                                "_blank","toolbar=no, location=yes, directories=no, status=no, menubar=yes, scrollbars=yes, resizable=no, copyhistory=yes, width=100, height=100");  
                }
            }]
        },
        hidden: true,
        renderTo: 'sku-complaints-Panel'   
    })
    
    
    Ext.EventManager.addListener("sku-complaints", "click", function(){
        skuCmplaintsGrid.show();
    })
})