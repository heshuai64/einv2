Ext.onReady(function(){
	function showWait(){
          Ext.MessageBox.wait("please wait, thank you.");
     }
     
     function hideWait(){
          Ext.MessageBox.hide();
     }
     
     function exception(){
          Ext.Msg.alert('Failure', 'network error, please try again.');
     }
     
     Ext.Ajax.on('beforerequest', showWait);
     Ext.Ajax.on('requestcomplete', hideWait);
     Ext.Ajax.on('requestexception', exception);
     
	var availableStatusStore =  new Ext.data.ArrayStore({
        fields: ['id', 'name']
    })
     
    var skuStatusStore = new Ext.data.JsonStore({
          root: 'records',
          totalProperty: 'totalCount',
          idProperty: 'id',
          fields: ['inventory_model_id', 'inventory_model_code', 'short_description'],
          url: '../service.php?action=getSkuStatusGrid'
    })
     
    var sm = new Ext.grid.CheckboxSelectionModel();
    var skuStatusGrid = new Ext.grid.GridPanel({
        store: skuStatusStore,
        columns: [
                sm,
                {id:'inventory_model_id', hidden: true, dataIndex: 'inventory_model_id'},
                {id:'sku',header: "SKU", width: 120, dataIndex: 'inventory_model_code'},
                {id:'title', header: "Title", width: 440, dataIndex: 'short_description'}
        ],
        sm: sm,
        columnLines: true,
        width:600,
        height:500,
        frame:true,
        renderTo: "content-panel",
        listeners: {
        	rowdblclick: function(t, r, e){
        		var data = skuStatusGrid.getSelectionModel().getSelected();
        		//console.log(data.data.inventory_model_id);
        		window.open("/inventory/inventory/inventory_edit.php?intInventoryModelId="+data.data.inventory_model_id);
        	}
        },
        tbar: [{
        	xtype: 'tbtext',
        	text: 'Input SKU'
        },{
        	id: 'search-sku',
        	xtype: 'textfield'
        },{
        	text: 'Search',
        	handler: function(){
        		skuStatusStore.setBaseParam("sku", Ext.getCmp("search-sku").getValue());
				skuStatusStore.load({params: {start: 0, limit: 20}});
        	}
        },'-',{
        	xtype: 'tbtext',
        	text: 'Change the selected SKU to'
        },{
        	id:"availableStatusCombo",
        	xtype: 'combo',
            store: availableStatusStore,
            mode: 'local',
            valueField:'id',
            displayField:'name',
            triggerAction: 'all',
            editable: false,
            selectOnFocus:true
        },{
        	text: 'Submit',
        	handler: function(){
        		if(Ext.isEmpty(Ext.getCmp("availableStatusCombo").getValue())){
        			Ext.Msg.alert('Warning', 'Please select Status.');
        			return 0;
        		}
        		
			if(sm.getCount() == 0){
				Ext.Msg.alert('Warning', 'Please select SKU.');
        			return 0;
			}
			
			Ext.Msg.prompt('Reason', 'Please enter reason:', function(btn, text){
				if (btn == 'ok'){
					var ids = "";
					var skus = "";
					var selections = skuStatusGrid.selModel.getSelections();
					for(var i = 0; i< skuStatusGrid.selModel.getCount(); i++){
						ids += selections[i].data.inventory_model_id + ","
						skus += selections[i].data.inventory_model_code + ","
					}
					ids = ids.slice(0,-1);
					skus = skus.slice(0,-1);
					Ext.Ajax.request({
						url: '../service.php?action=changeStatus',
						success: function(r, o){
							skuStatusStore.load({params: {start: 0, limit: 20}});
							Ext.Ajax.request({
							url: '../service.php?action=getSkuStatusCount',
							success: function(response){
								Ext.each(Ext.decode(response.responseText), function(i){
									//console.log(i);
									Ext.Element.get(i.status).update(" ("+i.total+")");
								})
							}
							});
						},
						//failure: otherFn,
						params: { ids: ids, skus: skus, status: Ext.getCmp("availableStatusCombo").getValue(), reason: text}
					});
					return 1;
				}else{
					return 0;
				}
			});
			return 1;
        	}
        }],
        bbar: new Ext.PagingToolbar({
	          pageSize: 20,
	          store: skuStatusStore,
	          displayInfo: true
      	})
    });
    
	new Ext.Button({
		text: "New<span id='new'></span>", 
		renderTo: "new-button",
		height: 30,
		width: 160,
		listeners: {
			click: function(t, e){
				skuStatusStore.setBaseParam("status", "new");
				skuStatusStore.setBaseParam("sku", "");
				skuStatusStore.load({params: {start: 0, limit: 20}});
				Ext.getCmp("availableStatusCombo").setValue("");
				availableStatusStore.loadData([["waiting for approve", "Submit Approve"]]);
			}
		}
	})
	
	new Ext.Button({
		text: "Waiting for approve<span id='waiting-for-approve'></span>", 
		renderTo: "waiting-for-approve-button",
		height: 30,
		width: 160,
		listeners: {
			click: function(t, e){
				skuStatusStore.setBaseParam("status", "waiting for approve");
				skuStatusStore.setBaseParam("sku", "");
				skuStatusStore.load({params: {start: 0, limit: 20}});
				Ext.getCmp("availableStatusCombo").setValue("");
				availableStatusStore.loadData([["active", "Approve"], ["under review", "Not Approve"]]);
			}
		}
	})
	
	new Ext.Button({
		text: "Under review<span id='under-review'></span>", 
		renderTo: "under-review-button",
		height: 30,
		width: 160,
		listeners: {
			click: function(t, e){
				skuStatusStore.setBaseParam("status", "under review");
				skuStatusStore.setBaseParam("sku", "");
				skuStatusStore.load({params: {start: 0, limit: 20}});
				Ext.getCmp("availableStatusCombo").setValue("");
				availableStatusStore.loadData([["waiting for approve", "Re Approve"], ["inactive", "Freeze SKU"]]);
			}
		}
	})
	
	new Ext.Button({
		text: "Active<span id='active'></span>", 
		renderTo: "active-button",
		height: 30,
		width: 80,
		listeners: {
			click: function(t, e){
				skuStatusStore.setBaseParam("status", "active");
				skuStatusStore.setBaseParam("sku", "");
				skuStatusStore.load({params: {start: 0, limit: 20}});
				Ext.getCmp("availableStatusCombo").setValue("");
				availableStatusStore.loadData([["inactive", "Freeze SKU"], ["under review", "Question SKU"]]);
			}
		}
	})
	
	new Ext.Button({
		text: "InActive<span id='inactive'></span>", 
		renderTo: "inactive-button",
		height: 30,
		width: 80,
		listeners: {
			click: function(t, e){
				skuStatusStore.setBaseParam("status", "inactive");
				skuStatusStore.setBaseParam("sku", "");
				skuStatusStore.load({params: {start: 0, limit: 20}});
				Ext.getCmp("availableStatusCombo").setValue("");
				availableStatusStore.loadData([["under review", "Reactivation SKU"]]);
			}
		}
	})
	
	new Ext.Button({
		text: "Out of stock<span id='out-of-stock'></span>", 
		renderTo: "out-of-stock-button",
		height: 30,
		width: 160,
		listeners: {
			click: function(t, e){
				skuStatusStore.setBaseParam("status", "out of stock");
				skuStatusStore.setBaseParam("sku", "");
				skuStatusStore.load({params: {start: 0, limit: 20}});
				Ext.getCmp("availableStatusCombo").setValue("");
				availableStatusStore.loadData([["inactive", "Freeze SKU"]]);
			}
		}
	})

    //skuStatusStore.load({params: {start: 0, limit: 20}});
    
    Ext.Ajax.request({
    	url: '../service.php?action=getSkuStatusCount',
    	success: function(response){
    		Ext.each(Ext.decode(response.responseText), function(i){
    			//console.log(i);
    			Ext.Element.get(i.status).update(" ("+i.total+")");
    		})
    	}
    });
    
});