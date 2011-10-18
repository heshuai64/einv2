function deleteImage(i){
    var id = i.substr(i.indexOf("?")+1);
    
    Ext.Ajax.request({
        url: 'research.php?action=deleteImages&id='+id,
        success: function(response, opts) {
            var obj = Ext.decode(response.responseText);
            if(obj.success){
                var delete_image = document.getElementById(i);
                delete_image.src = "";
                delete_image.width = "100";
                delete_image.height = "100";
            }
        },
        failure: function(response, opts) {
           console.log('server-side failure with status code ' + response.status);
        }
    });
}
            
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
    
    var getCookie = function(c_name){
        if (document.cookie.length>0){
            c_start=document.cookie.indexOf(c_name + "=");
            if (c_start!=-1){
                c_start=c_start + c_name.length+1;
                c_end=document.cookie.indexOf(";",c_start);
                if (c_end==-1) c_end=document.cookie.length;
                return unescape(document.cookie.substring(c_start,c_end));
            }
        }
        return "";
    }
    
    var user_role = getCookie("user_role");
    //console.log(user_role);
    var user_name = getCookie("user_name");
    
    var researchStore = new Ext.data.JsonStore({
        root: 'records',
        totalProperty: 'totalCount',
        idProperty: 'id',
        autoLoad:true,
        fields: ['id', 'createdOn', 'warehouse', 'chinese_title', 'sales', 'status', 'category', 'cancel_reason', 'images'],
        url:'research.php?action=getResearchInfoList',
        listeners:{load: function(t, r, o){
                Ext.Ajax.request({
                    url: 'research.php?action=getResearchStatusCount',
                    success: function(response, opts) {
                       var obj = Ext.decode(response.responseText);
                       //console.log(obj);
                       for(var i=0; i<obj.length; i++){
                            if(!Ext.isEmpty(Ext.getCmp("status-button-"+obj[i].status))){
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
    
    function renderWarehouse(v, p, r){
        return lang.Warehouse_Array[v][1];
    }
    
    function renderCategory(v, p, r){
        return lang.Category_Array[v][1];
    }
    
    function renderYN(v, p, r){
        var x = "";
        if(v == 0){
            x = lang.No;
        }else if(v == 1){
            x = lang.Yes;
        }
        return x;
    }
    
    var researchGrid = new Ext.grid.GridPanel({
        autoHeight: true,
        store: researchStore,
        columns:[{
            header: lang.ID,
            dataIndex: 'id',
            width: 70,
            align: 'center',
            sortable: true
        },{  header: lang.Created_On,
            dataIndex: 'createdOn',
            width: 120,
            align: 'center',
            sortable: true
        },{ header: lang.Warehouse,
            dataIndex: 'warehouse',
            width: 50,
            align: 'center',
            renderer: renderWarehouse,
            sortable: true
        },{ header: lang.Chinese_Title,
            dataIndex: 'chinese_title',
            width: 150,
            align: 'center',
            sortable: true
        },{ header: lang.Sales,
            dataIndex: 'sales',
            width: 70,
            align: 'center',
            sortable: true
        },{ header: lang.Category,
            dataIndex: 'category',
            width: 120,
            align: 'center',
            renderer: renderCategory,
            sortable: true
        },{ header: lang.Cancel_Reason,
            dataIndex: 'cancel_reason',
            width: 150,
            align: 'center',
            sortable: true
        }],
        listeners: {'dblclick': function(e){
            /*
            var selections = researchGrid.selModel.getSelections();
            var id = selections[0].data.id;
            
            var imageTempalte = new Ext.Template('<div style="position:relative;text-align:center;">',
                                                 '<div style="float:left;"><a href="{0}"><img id="{0}" width="100" height="100" src="{0}"/></a><br/><button type="button" onclick="deleteImage(\'{0}\')">delete</button></div><div style="float:left;"><a href="{1}"><img id="{1}" width="100" height="100" src="{1}"/></a><br/><button type="button" onclick="deleteImage(\'{1}\')">delete</button></div>',
                                                 '<div style="float:left;"><a href="{2}"><img id="{2}" width="100" height="100" src="{2}"/></a><br/><button type="button" onclick="deleteImage(\'{2}\')">delete</button></div><div style="float:left;"><a href="{3}"><img id="{3}" width="100" height="100" src="{3}"/></a><br/><button type="button" onclick="deleteImage(\'{3}\')">delete</button></div>',
                                                 '<div style="float:left;"><a href="{4}"><img id="{4}" width="100" height="100" src="{4}"/></a><br/><button type="button" onclick="deleteImage(\'{4}\')">delete</button></div>',
                                                 '<div style="float:right;"><form><input id="file_upload" name="file_upload" type="file" /></form></div></div>');
            imageTempalte.compile();
            
            var imagesWindow = new Ext.Window({
                title: id,
                closable:true,
                width: 800,
                height: 500,
                plain:true,
                layout: 'fit',
                tpl: imageTempalte,
                buttonAlign:'center',
                buttons: [{
                    text: lang.Close,
                    handler: function(){
                        imagesWindow.close();
                    }
                }]
            });
            
            imagesWindow.show();
            */
            var selections = researchGrid.selModel.getSelections();
            var id = selections[0].data.id;
            var current_user_name = selections[0].data.sales;    
                
            var purchaseInquiryStore = new Ext.data.JsonStore({
                root: 'records',
                totalProperty: 'totalCount',
                idProperty: 'id',
                autoLoad:true,
                fields: ['id', 'purchaser', 'product_cost', 'product_net_weight', 'min_purchase_num', 'product_arrival_days', 'createdOn', 'remark', 'sales_judge', 'continue_develop', 'rejected_reason'],
                url:'research.php?action=getResearchPurchseList&research_id='+id
            });
            
            var purchaseInquiryGrid = new Ext.grid.GridPanel({
                autoHeight: true,
                store: purchaseInquiryStore,
                columns:[{
                    header: lang.ID,
                    dataIndex: 'id',
                    width: 70,
                    align: 'center',
                    sortable: true,
                    hidden:true
                },{
                    header: lang.Purchaser,
                    dataIndex: 'purchaser',
                    width: 70,
                    align: 'center',
                    sortable: true
                },{
                    header: lang.Product_Cost,
                    dataIndex: 'product_cost',
                    width: 60,
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
                    width: 60,
                    align: 'center',
                    sortable: true
                },{
                    header: lang.Product_Arrival_Days,
                    dataIndex: 'product_arrival_days',
                    width: 60,
                    align: 'center',
                    sortable: true
                },{
                    header: lang.Created_On,
                    dataIndex: 'createdOn',
                    width: 110,
                    align: 'center',
                    sortable: true
                },{
                    header: lang.Remark,
                    dataIndex: 'remark',
                    width: 150,
                    align: 'center',
                    sortable: true
                },{
                    header: lang.Sales_Judge,
                    dataIndex: 'sales_judge',
                    width: 60,
                    align: 'center',
                    sortable: true,
                    renderer: renderYN/*,
                    editor: new Ext.form.ComboBox({
                        typeAhead: true,
                        editable: false,
                        triggerAction: 'all',
                        mode: 'local',
                        store: new Ext.data.ArrayStore({
                            fields: ['id', 'name'],
                            data: [[0, lang.No], [1, lang.Yes]]
                        }),
                        valueField: 'id',
                        displayField: 'name'
                    })*/
                },{
                    header: lang.Continue_Develop,
                    dataIndex: 'continue_develop',
                    width: 60,
                    align: 'center',
                    sortable: true,
                    renderer: renderYN
                },{
                    header: lang.Rejected_Reason,
                    dataIndex: 'rejected_reason',
                    width: 150,
                    align: 'left',
                    sortable: true
                }],
                listeners: {'dblclick': function(e){
                    var selections = purchaseInquiryGrid.selModel.getSelections();
                    var id = selections[0].data.id;
                    
                    var purchaseInquiryDesForm = new Ext.form.FormPanel({
                        reader:new Ext.data.JsonReader({
                            }, ['id','sales_judge','continue_develop','rejected_reason']
                        ),
                        labelWidth: 100,
                        items:[{
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
                            hiddenName:"sales_judge"
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
                            hiddenName:"continue_develop"
                        },{
                            xtype:"textarea",
                            fieldLabel:lang.Rejected_Reason,
                            name:"rejected_reason",
                            width: 250
                        }]
                    })
                    
                    purchaseInquiryDesForm.getForm().load({url:'research.php?action=getPurchseInfo&id='+id, 
                        method:'GET',
                        waitMsg: lang.Waitting
                    })
                    
                    var purchaseInquiryDesWindow = new Ext.Window({
                        title: id,
                        closable:true,
                        width: 400,
                        height: 200,
                        plain:true,
                        layout: 'fit',
                        items: purchaseInquiryDesForm,
                        buttons: [{
                            hidden: (user_role == 1 || current_user_name == user_name)?false:true,
                            text: lang.Update,
                            handler: function(){
                                purchaseInquiryDesForm.getForm().submit({
                                    url: "research.php?action=updatePurchaseInofBySales&id="+id,
                                    success: function(f, a){
                                        var response = Ext.decode(a.response.responseText);
                                        if(response.success){
                                            purchaseInquiryDesWindow.close();
                                            purchaseInquiryStore.reload();
                                            //Ext.MessageBox.alert(lang.Message, lang.Update_Success);
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
                                purchaseInquiryDesWindow.close();
                            }
                        }]
                    });
                    
                    purchaseInquiryDesWindow.show();
                }}
            })
            
            var imageTempalte = new Ext.Template('<div style="position:relative;text-align:center;height:120px;">',
                                                 '<div style="float:left;"><a href="{0}"><img id="{0}" width="100" height="100" src="{0}"/></a><br/><button type="button" onclick="deleteImage(\'{0}\')">delete</button></div><div style="float:left;"><a href="{1}"><img id="{1}" width="100" height="100" src="{1}"/></a><br/><button type="button" onclick="deleteImage(\'{1}\')">delete</button></div>',
                                                 '<div style="float:left;"><a href="{2}"><img id="{2}" width="100" height="100" src="{2}"/></a><br/><button type="button" onclick="deleteImage(\'{2}\')">delete</button></div><div style="float:left;"><a href="{3}"><img id="{3}" width="100" height="100" src="{3}"/></a><br/><button type="button" onclick="deleteImage(\'{3}\')">delete</button></div>',
                                                 '<div style="float:left;"><a href="{4}"><img id="{4}" width="100" height="100" src="{4}"/></a><br/><button type="button" onclick="deleteImage(\'{4}\')">delete</button></div>',
                                                 '<div style="float:right;"><form><input id="file_upload" name="file_upload" type="file" /></form></div></div>');
            imageTempalte.compile();
            
            var researchDesForm = new Ext.form.FormPanel({
                reader:new Ext.data.JsonReader({
                    }, ['sales','warehouse','site','status','english_keyword','chinese_title','category','reference_links_1','reference_links_2','reference_links_3','reference_links_4',
                        'development_standards','marketplace_average_price','target_sales_price','target_total_cost','plans_sales_mode',
                        'specific_data','marketplace_min_price','target_month_sales','target_purchase_cost','estimated_weight','product_parameter_information','product_develop_no_success_reason','audit_remark','images']
                ),
                labelWidth: 90,
                autoScroll:true,
                items:[{
                    layout:"column",
                    items:[{
                        columnWidth:0.5,
                        layout:"form",
                        items:[{
                            xtype:"combo",
                            mode: 'local',
                            store: new Ext.data.ArrayStore({
                                fields: ['id','name'],
                                data: lang.Warehouse_Array
                            }),
                            valueField: 'id',
                            displayField: 'name',
                            triggerAction: 'all',
                            editable: false,
                            selectOnFocus:true,
                            fieldLabel:lang.Warehouse,
                            name:"warehouse",
                            hiddenName:"warehouse",
                            listeners: {
                                change: function(t, n, o){
                                    if(n == 0){
                                        Ext.getCmp("development-standards").getStore().loadData(lang.Development_Standards_SZ_Array);
                                    }else if(n == 1){
                                        Ext.getCmp("development-standards").getStore().loadData(lang.Development_Standards_UK_Array);
                                    }
                                    Ext.getCmp("development-standards").reset();
                                }
                            }
                        },{
                            xtype:"combo",
                            mode: 'local',
                            store: new Ext.data.ArrayStore({
                                fields: ['id','name'],
                                data: lang.Product_Develop_No_Success_Reason_Array
                            }),
                            valueField: 'id',
                            displayField: 'name',
                            triggerAction: 'all',
                            editable: false,
                            selectOnFocus:true,
                            fieldLabel:lang.Product_Develop_No_Success_Reason,
                            name:"product_develop_no_success_reason",
                            hiddenName:"product_develop_no_success_reason",
                            disabled: (user_role == 1)?false:true
                        },{
                            xtype:"textfield",
                            fieldLabel:lang.English_Keyword,
                            name:"english_keyword",
                            width: 250
                        },{
                            xtype:"textfield",
                            fieldLabel:lang.Reference_Links_1,
                            name:"reference_links_1",
                            width: 250
                        },{
                            xtype:"textfield",
                            fieldLabel:lang.Reference_Links_3,
                            name:"reference_links_3",
                            width: 250
                        }]
                    },{
                        columnWidth:0.5,
                        layout:"form",
                        items:[{
                            xtype:"combo",
                            mode: 'local',
                            store: new Ext.data.ArrayStore({
                                fields: ['id','name'],
                                data: lang.Site_Array
                            }),
                            valueField: 'id',
                            displayField: 'name',
                            triggerAction: 'all',
                            editable: false,
                            selectOnFocus:true,
                            fieldLabel:lang.Site,
                            name:"site",
                            hiddenName:"site"
                        },{
                            xtype:"combo",
                            mode: 'local',
                            store: new Ext.data.JsonStore({
                                autoLoad: true,
                                fields: ['id', 'name'],
                                url: "research.php?action=getRCOStatus&id="+id
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
                            xtype:"textfield",
                            fieldLabel:lang.Chinese_Title,
                            name:"chinese_title",
                            width: 250
                        },{
                            xtype:"textfield",
                            fieldLabel:lang.Reference_Links_2,
                            name:"reference_links_2",
                            width: 250
                        },{
                            xtype:"textfield",
                            fieldLabel:lang.Reference_Links_4,
                            name:"reference_links_4",
                            width: 250
                        }]
                        }
                    ]
                  },{
                    layout:"column",
                    items:[{
                        columnWidth:0.5,
                        layout:"form",
                        items:[{
                            id:"development-standards",
                            xtype:"combo",
                            mode: 'local',
                            store: new Ext.data.ArrayStore({
                                fields: ['id','name'],
                                data: lang.Development_Standards_Array
                            }),
                            valueField: 'id',
                            displayField: 'name',
                            triggerAction: 'all',
                            editable: false,
                            selectOnFocus:true,
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
                            id:"target_total_cost_2",
                            xtype:"numberfield",
                            fieldLabel:lang.Target_Total_Cost,
                            name:"target_total_cost",
                            readOnly:true
                          },{
                            xtype:"combo",
                            mode: 'local',
                            store: new Ext.data.ArrayStore({
                                fields: ['id','name'],
                                data: lang.Plans_Sales_Mode_Array
                            }),
                            valueField: 'id',
                            displayField: 'name',
                            triggerAction: 'all',
                            editable: false,
                            selectOnFocus:true,
                            fieldLabel:lang.Plans_Sales_Mode,
                            name:"plans_sales_mode",
                            hiddenName:"plans_sales_mode"
                          },{
                            xtype:"textarea",
                            fieldLabel:lang.Specific_Data,
                            name:"specific_data",
                            width: 250
                          }]
                      },{
                        columnWidth:0.5,
                        layout:"form",
                        items:[{
                            xtype:"combo",
                            mode: 'local',
                            store: new Ext.data.ArrayStore({
                                fields: ['id','name'],
                                data: lang.Category_Array
                            }),
                            valueField: 'id',
                            displayField: 'name',
                            triggerAction: 'all',
                            editable: false,
                            selectOnFocus:true,
                            fieldLabel:lang.Category,
                            name:"cateogry",
                            hiddenName:"category"
                          },{
                            xtype:"numberfield",
                            fieldLabel:lang.MarketPlace_Min_Price,
                            name:"marketplace_min_price",
                            listeners: {
                                blur: function(t){
                                    var target_total_cost_2 = t.getValue() /0.226 - 3.5;
                                    Ext.getCmp("target_total_cost_2").setValue(target_total_cost_2.toFixed(2));
                                }
                            }
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
                            name:"estimated_weight",
                            decimalPrecision: 3
                          },{
                            xtype:"textarea",
                            fieldLabel:lang.Product_Parameter_Information,
                            name:"product_parameter_information",
                            width: 250
                          }]
                      }]
                  },{
                    xtype:"textarea",
                    fieldLabel:lang.Audit_Remark,
                    name:"audit_remark",
                    width: 500,
                    disabled: (user_role == 1)?false:true
                  },purchaseInquiryGrid,{
                    id:'images-list',
                    xtype:"panel",
                    title:lang.Product_Photo_Gallery,
                    tpl:imageTempalte
                  },{
                    id:'images-values',
                    xtype:'hidden'
                  }]
                }
            )
            
            researchDesForm.getForm().load({url:'research.php?action=getResearchInfo&id='+id, 
                    method:'GET',
                    waitMsg: lang.Waitting,
                    success: function(f, a){
                        var images_values = a.result.data.images;
                        for(var i=0; i < images_values.length; i++){
                            Ext.getCmp("images-values").setValue(Ext.getCmp("images-values").getValue() + "," + images_values[i]);
                        }
                        imageTempalte.append('images-list', images_values);
                        $('#images-list a').lightBox();
                        $('#file_upload').uploadify({
                            'uploader'  : 'images/uploadify.swf',
                            'script'    : 'research.php?action=uploadImages',
                            'cancelImg' : 'images/cancel.png',
                            'folder'    : 'uploads',
                            'auto'      : true,
                            'multi'     : true,
                            'onComplete': function(event, ID, fileObj, response, data) {
                                var a = document.createElement('a');
                                a.id = ID;
                                a.href = response;
                                //a.text = "xx";
                                
                                /*
                                var img = new Image();
                                img.src = response;
                                img.width = "100";
                                img.height = "100";
                                */
                                var img = "<img src='" + response + "' width='100' height='100'/>";
                                //a.html(img);
                                $("#images-list").append(a);
                                $("#"+ID).html(img);
                                $('#images-list a').lightBox();
                                var images_values = Ext.getCmp("images-values");
                                images_values.setValue(images_values.getValue() + "," + response);
                            }
                        });
                    }
                }
            );
            
            //console.log(user_role + "|" + current_user_name + " -- " + user_name);
            var researchDesWindow = new Ext.Window({
                title: id,
                closable:true,
                width: 800,
                height: 500,
                plain:true,
                layout: 'fit',
                items: researchDesForm,
                buttons: [{
                    hidden: (user_role == 1 || current_user_name == user_name)?false:true,
                    text: lang.Update,
                    handler: function(){
                        researchDesForm.getForm().submit({
                            url: "research.php?action=updateResearchInfo&id="+id,
                            success: function(f, a){
                                var response = Ext.decode(a.response.responseText);
                                if(response.success){
                                    researchDesWindow.close();
                                    researchStore.reload();
                                    //Ext.MessageBox.alert(lang.Message, lang.Update_Success);
                                }
                            },
                            failure: function(form, action) {
                                if(action.result.msg == "timeout"){
                                    Ext.Msg.show({
                                        title: lang.Warning,
                                        msg: lang.Login_Timeout,
                                        buttons: Ext.Msg.OK,
                                        fn: function(){
                                            window.location = "login.php";
                                        },
                                        icon: Ext.MessageBox.WARNING
                                    });
                                }else{
                                    Ext.MessageBox.alert('Error', action.result.errors.message);
                                }
                            },
                            waitMsg: lang.Waiting
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
        },
        bbar: [{
                text: lang.Add_New_Product,
                handler: function(){
                    var now = new Date();
                    var m = now.getMinutes() + "-" + now.getSeconds();
            
                    var researchDesForm = new Ext.form.FormPanel({
                        labelWidth: 100,
                        autoScroll:true,
                        items:[{
                            layout:"column",
                            items:[{
                                columnWidth:0.5,
                                layout:"form",
                                items:[{
                                    xtype:"combo",
                                    mode: 'local',
                                    store: new Ext.data.ArrayStore({
                                        fields: ['id','name'],
                                        data: lang.Warehouse_Array
                                    }),
                                    valueField: 'id',
                                    displayField: 'name',
                                    triggerAction: 'all',
                                    editable: false,
                                    selectOnFocus:true,
                                    fieldLabel:lang.Warehouse,
                                    name:"warehouse",
                                    hiddenName:"warehouse",
                                    listeners: {
                                        change: function(t, n, o){
                                            if(n == 0){
                                                Ext.getCmp("development-standards").getStore().loadData(lang.Development_Standards_SZ_Array);
                                            }else if(n == 1){
                                                Ext.getCmp("development-standards").getStore().loadData(lang.Development_Standards_UK_Array);
                                            }
                                            Ext.getCmp("development-standards").reset();
                                        }
                                    }
                                },{
                                    xtype:"combo",
                                    fieldLabel:lang.Sales,
                                    name:"sales",
                                    hiddenName:"sales"
                                },{
                                    xtype:"textfield",
                                    fieldLabel:lang.English_Keyword,
                                    name:"english_keyword",
                                    width: 250
                                },{
                                    xtype:"textfield",
                                    fieldLabel:lang.Reference_Links_1,
                                    name:"reference_links_1",
                                    width: 250
                                },{
                                    xtype:"textfield",
                                    fieldLabel:lang.Reference_Links_3,
                                    name:"reference_links_3",
                                    width: 250
                                }]
                            },{
                                columnWidth:0.5,
                                layout:"form",
                                items:[{
                                    xtype:"combo",
                                    mode: 'local',
                                    store: new Ext.data.ArrayStore({
                                        fields: ['id','name'],
                                        data: lang.Site_Array
                                    }),
                                    valueField: 'id',
                                    displayField: 'name',
                                    triggerAction: 'all',
                                    editable: false,
                                    selectOnFocus:true,
                                    fieldLabel:lang.Site,
                                    name:"site",
                                    hiddenName:"site"
                                },{
                                    xtype:"combo",
                                    fieldLabel:lang.Status,
                                    name:"status",
                                    hiddenName:"status"
                                },{
                                    xtype:"textfield",
                                    fieldLabel:lang.Chinese_Title,
                                    name:"chinese_title",
                                    width: 250
                                },{
                                    xtype:"textfield",
                                    fieldLabel:lang.Reference_Links_2,
                                    name:"reference_links_2",
                                    width: 250
                                },{
                                    xtype:"textfield",
                                    fieldLabel:lang.Reference_Links_4,
                                    name:"reference_links_4",
                                    width: 250
                                }]
                                }
                            ]
                          },{
                            layout:"column",
                            items:[{
                                columnWidth:0.5,
                                layout:"form",
                                items:[{
                                    id:"development-standards",
                                    xtype:"combo",
                                    mode: 'local',
                                    store: new Ext.data.ArrayStore({
                                        fields: ['id','name'],
                                        data: lang.Development_Standards_Array
                                    }),
                                    valueField: 'id',
                                    displayField: 'name',
                                    triggerAction: 'all',
                                    editable: false,
                                    selectOnFocus:true,
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
                                    id:"target_total_cost",
                                    xtype:"numberfield",
                                    fieldLabel:lang.Target_Total_Cost,
                                    name:"target_total_cost",
                                    readOnly:true
                                  },{
                                    xtype:"combo",
                                    mode: 'local',
                                    store: new Ext.data.ArrayStore({
                                        fields: ['id','name'],
                                        data: lang.Plans_Sales_Mode_Array
                                    }),
                                    valueField: 'id',
                                    displayField: 'name',
                                    triggerAction: 'all',
                                    editable: false,
                                    selectOnFocus:true,
                                    fieldLabel:lang.Plans_Sales_Mode,
                                    name:"plans_sales_mode",
                                    hiddenName:"plans_sales_mode"
                                  },{
                                    xtype:"textarea",
                                    fieldLabel:lang.Specific_Data,
                                    name:"specific_data",
                                    width: 250
                                  }]
                              },{
                                columnWidth:0.5,
                                layout:"form",
                                items:[{
                                    xtype:"combo",
                                    mode: 'local',
                                    store: new Ext.data.ArrayStore({
                                        fields: ['id','name'],
                                        data: lang.Category_Array
                                    }),
                                    valueField: 'id',
                                    displayField: 'name',
                                    triggerAction: 'all',
                                    editable: false,
                                    selectOnFocus:true,
                                    fieldLabel:lang.Category,
                                    name:"cateogry",
                                    hiddenName:"category"
                                  },{
                                    xtype:"numberfield",
                                    fieldLabel:lang.MarketPlace_Min_Price,
                                    name:"marketplace_min_price",
                                    listeners: {
                                        blur: function(t){
                                            var target_total_cost = t.getValue() /0.226 - 3.5;
                                            Ext.getCmp("target_total_cost").setValue(target_total_cost.toFixed(2));
                                        }
                                    }
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
                                  },{
                                    xtype:"textarea",
                                    fieldLabel:lang.Product_Parameter_Information,
                                    name:"product_parameter_information",
                                    width: 250
                                  }]
                              }]
                          },{
                            id:'images-list',
                            xtype:"panel",
                            title:lang.Product_Photo_Gallery,
                            html:'<div id="images-block" style="float:left; height: 100px;"></div><div style="float:right; height: 100px;"><form><input id="file_upload" name="file_upload" type="file" /></form></div>'
                          },{
                            id:'images-values',
                            xtype:'hidden'
                            }]
                        }
                    )
                    
                    var researchDesWindow = new Ext.Window({
                        title: lang.Add_New_Product,
                        closable:true,
                        width: 800,
                        height: 500,
                        plain:true,
                        layout: 'fit',
                        items: researchDesForm,
                        buttons: [{
                            text: lang.Submit,
                            handler: function(){
                                    researchDesForm.getForm().submit({
                                        url: "research.php?action=addResearchInfo&m="+m,
                                        success: function(f, a){
                                            var response = Ext.decode(a.response.responseText);
                                            if(response.success){
                                                //Ext.MessageBox.alert(lang.Message, lang.Add_Success);
                                                researchDesWindow.close();
                                                researchStore.reload();
                                            }
                                        },
                                        failure: function(form, action) {
                                            if(action.result.msg == "timeout"){
                                                Ext.Msg.show({
                                                    title: lang.Warning,
                                                    msg: lang.Login_Timeout,
                                                    buttons: Ext.Msg.OK,
                                                    fn: function(){
                                                        window.location = "login.php";
                                                    },
                                                    icon: Ext.MessageBox.WARNING
                                                });
                                            }else{
                                                Ext.MessageBox.alert('Error', action.result.errors.message);
                                            }
                                        },
                                        waitMsg: lang.Waiting
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
                    
                    $('#file_upload').uploadify({
                        'uploader'  : 'images/uploadify.swf',
                        'script'    : 'research.php?action=uploadImages',
                        'cancelImg' : 'images/cancel.png',
                        'folder'    : 'uploads',
                        'auto'      : true,
                        'multi'     : true,
                        'scriptData': {'m': m},
                        'onComplete': function(event, ID, fileObj, response, data) {
                            //alert(fileObj.name + "|" + response);
                            var a = document.createElement('a');
                            a.id = ID;
                            a.href = response;
                            //a.text = "xx";
                            
                            /*
                            var img = new Image();
                            img.src = response;
                            img.width = "100";
                            img.height = "100";
                            */
                            var img = "<img src='" + response + "' width='100' height='100'/>";
                            //a.html(img);
                            $("#images-block").append(a);
                            $("#"+ID).html(img);
                            $('#images-block a').lightBox();
                            var images_values = Ext.getCmp("images-values");
                            images_values.setValue(images_values.getValue() + "," + response);
                        }
                    });
            }
        },'-',new Ext.PagingToolbar({
                //pageSize: 20,
                store: researchStore,
                displayInfo: true
            })
        ]
    });
    
    var research_search = new Ext.form.FormPanel({
        items:[{
            layout:"column",
            title:lang.Search_Panel,
            items:[{
                columnWidth:0.5,
                layout:"form",
                items:[{
                    xtype:"textfield",
                    fieldLabel:lang.ID,
                    name:"id"
                  },{
                    xtype:"textfield",
                    fieldLabel:lang.Chinese_Title,
                    name:"chinese_title"
                  }]
              },{
                columnWidth:0.5,
                layout:"form",
                items:[{
                    xtype:"combo",
                    fieldLabel:lang.Sales,
                    name:"sales",
                    hiddenName:"sales"
                  },{
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
                    researchStore.baseParams = {
                        id: research_search.getForm().items.items[0].getValue(),
                        chinese_title: research_search.getForm().items.items[1].getValue(),
                        sales: research_search.getForm().items.items[2].getValue(),
                        createdOn: research_search.getForm().items.items[3].getValue(),
                        type: "search"
                    };
                    researchStore.load();
                }
            }]
    })
    
    function showResearchByStatus(status){
        researchStore.baseParams = {
            status: status
        };
        researchStore.load();
        //console.log(Ext.getCmp("status_panel").getComponent(0).setText("xx"));
    }
    
    var viewport = new Ext.Viewport({
        layout:'border',
        items:[{
                region:'north',
                xtype:"panel",
                items:research_search,
                height: 108
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
                id:'status-button-0',
                xtype:'button',
                text: lang.New_Product,
                handler: function(b, e){
                    showResearchByStatus(0);
                }
            },{
                id:'status-button-1',
                xtype:'button',
                text: lang.Waiting_Review,
                handler: function(b, e){
                    showResearchByStatus(1);
                }
            },/*{
                id:'status-button-2',
                xtype:'button',
                text: lang.Waiting_Inquiry,
                handler: function(b, e){
                    showResearchByStatus(2);
                }
            },*/{
                id:'status-button-3',
                xtype:'button',
                text: lang.Waiting_Inquiry_Review,
                handler: function(b, e){
                    showResearchByStatus(3);
                }
            },/*{
                id:'status-button-4',
                xtype:'button',
                text: lang.Inquiry_Complete,
                handler: function(b, e){
                    showResearchByStatus(4);
                }
            },*/{
                id:'status-button-5',
                xtype:'button',
                text: lang.Take_Sample_Confirm,
                handler: function(b, e){
                    showResearchByStatus(5);
                }
            },{
                id:'status-button-6',
                xtype:'button',
                text: lang.New_Product_Develop_Success,
                handler: function(b, e){
                    showResearchByStatus(6);
                }
            },{
                id:'status-button-7',
                xtype:'button',
                text: lang.New_Product_Develop_Failure,
                handler: function(b, e){
                    showResearchByStatus(7);
                }
            },{
                id:'status-button-8',
                xtype:'button',
                text: lang.Give_Up,
                handler: function(b, e){
                    showResearchByStatus(8);
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
          items:researchGrid
        }]  
    })
});