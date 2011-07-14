Ext.define('MyDesktop.TestWindow', {
    extend: 'Ext.ux.desktop.Module',

    requires: [
//        'Ext.tab.Panel'
    ],

    id:'test-win',

    init : function(){
        this.launcher = {
            text: 'Test Window',
            iconCls:'tabs',
            handler : this.createWindow,
            scope: this
        }
    },

    createWindow : function(){
        var desktop = this.app.getDesktop();
        var win = desktop.getWindow('test-win');
        
        if (!Ext.ModelManager.isRegistered('Person')) {
        	Ext.define('Person', {
        	    extend: 'Ext.data.Model',
        	    fields: [{
        	        name: 'id',
        	        type: 'int',
        	        useNull: true
        	    }, 'email', 'first', 'last'],
        	    validations: [{
        	        type: 'length',
        	        field: 'email',
        	        min: 1
        	    }, {
        	        type: 'length',
        	        field: 'first',
        	        min: 1
        	    }, {
        	        type: 'length',
        	        field: 'last',
        	        min: 1
        	    }]
        	});
        }

        var store = Ext.create('Ext.data.Store', {
            autoLoad: true,
            autoSync: true,
            model: 'Person',
            proxy: {
                type: 'ajax',
                url: 'app.php/users',
                reader: {
                    type: 'json',
                    root: 'data'
                },
                writer: {
                    type: 'json'
                }
            }
        });
        
        var rowEditing = Ext.create('Ext.grid.plugin.RowEditing');
        
        if(!win){
            win = desktop.createWindow({
                id: 'test-win',
                title:'Test Window',
                width:740,
                height:480,
                iconCls: 'tabs',
                animCollapse:false,
                border:false,
                constrainHeader:true,

                layout: 'fit',
                items: [
                    {
                    	xtype: 'grid',
                	    store: store,
                	    columns: [{
                            text: 'ID',
                            width: 40,
                            sortable: true,
                            dataIndex: 'id'
                        }, {
                            text: 'Email',
                            flex: 1,
                            sortable: true,
                            dataIndex: 'email',
                            field: {
                                xtype: 'textfield'
                            }
                        }, {
                            header: 'First',
                            width: 80,
                            sortable: true,
                            dataIndex: 'first',
                            field: {
                                xtype: 'textfield'
                            }
                        }, {
                            text: 'Last',
                            width: 80,
                            sortable: true,
                            dataIndex: 'last',
                            field: {
                                xtype: 'textfield'
                            }
                        }],
                        dockedItems: [{
                            xtype: 'toolbar',
                            items: [{
                                text: 'Add',
                                iconCls: 'add',
                                handler: function(){
                                    // empty record
                                    store.insert(0, new Person());
                                    rowEditing.startEdit(0, 0);
                                }
                            }, '-', {
                                itemId: 'delete',
                                text: 'Delete',
                                iconCls: 'remove',
                                disabled: true,
                                handler: function(){
                                    var selection = grid.getView().getSelectionModel().getSelection()[0];
                                    if (selection) {
                                        store.remove(selection);
                                    }
                                }
                            }]
                        }],
//                	    selType: 'rowmodel',
                	    plugins: [rowEditing]
                    }
                ]
            });
        }
        
        	
        win.show();
        return win;
    }
});