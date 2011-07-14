/*!
 * Ext JS Library 4.0
 * Author: SpARezGw, sparezgw@gmail.com
 * Date: 2011-07-12
 */

Ext.define('MyDesktop.SchoolPanel', {
    extend: 'Ext.ux.desktop.Module',

    requires: [
//        'Ext.data.ArrayStore',
//        'Ext.util.Format',
//        'Ext.grid.Panel',
//        'Ext.grid.plugin.RowEditing',
//        'Ext.grid.RowNumberer',
//        'Ext.grid.*',
//        'Ext.data.*',
//        'Ext.util.*',
//        'Ext.state.*',
//        'Ext.form.*'
    ],

    id:'school-panel',

    init : function(){
        this.launcher = {
            text: '学校列表',
            iconCls:'icon-grid',
            handler : this.createWindow,
            scope: this
        };
    },
    
    
    
    createWindow : function(){
        var desktop = this.app.getDesktop();
        var win = desktop.getWindow('school-panel');
        
        // define the Data Model
        if (!Ext.ModelManager.isRegistered('School')) {
        	Ext.define('School', {
                extend: 'Ext.data.Model',
                fields: [
                    {name: 'sID',   type: 'int', useNull: true},
                    {name: 'sName', type: 'string'}
                ],
                idProperty: 'sID',
                validations: [
                    {type: 'length', field: 'sName', min: 2}
                ]
            });
        }
        
        // create the Data Store
        var school_store = Ext.create('Ext.data.Store', {
            autoSync: true,
//            autoLoad: true,
            model: 'School',
            proxy: {
                type: 'ajax',
                api: {
                    read: 'func/index.php/school/list_school',
                    create: 'func/index.php/school/add_school',
                    update: 'func/index.php/school/edit_school',
                    destroy: 'func/index.php/school/del_school'
                },
                reader: {
                    type: 'json',
                    root: 'data'
                },
                writer: {
                    type: 'json',
                    writeAllFields: false
                }
//            },
//            listeners: {
//                write: function(proxy, operation){
//                    Ext.MessageBox.alert(operation.action, operation.records[0].getId());
//                }
            }
        });
        
        var rowEditing = Ext.create('Ext.grid.plugin.RowEditing', {
            clicksToMoveEditor: 1,
            autoCancel: true
        });
        
        if(!win){
            win = desktop.createWindow({
                id: 'school-panel',
                title:'学校列表',
                width:300,
                height:480,
                iconCls: 'icon-grid',
                animCollapse:false,
                constrainHeader:true,
                layout: 'fit',
                items: [{
                    xtype: 'grid',
                    id: 'schoolgrid',
                    store: school_store,
//                    selType: 'rowmodel',
                    columns: [{
                        text: "ID", width: 65, dataIndex: 'sID',
                        sortable: false,
                    }, {
                        text: "学校名称", flex: 1, dataIndex: 'sName',
                        sortable: true,
                        field: {
                        	xtype: 'textfield'
                        }
                    }],
                    plugins: [rowEditing],
                }],
                tbar:[{
                    text:'新建学校',
                    tooltip:'添加一所新的学校',
                    iconCls:'add',
                    handler : function() {
                    	rowEditing.cancelEdit();
                    	Ext.Msg.prompt('添加学校', '输入学校名称:', function(btn, text){
                    	    if (btn == 'ok'){
                    	    	var r = Ext.ModelManager.create({
                                    sName: text
                                }, 'School');
                    	    	school_store.insert(0, r);
                    	    }
                    	});
                    }
                },'-',{
                    text:'删除学校',
                    tooltip:'删除一所学校',
                    iconCls:'remove',
                    handler:function() {
                    	var selection = win.getComponent('schoolgrid').getView().getSelectionModel().getSelection()[0];
                        if (selection) {
                        	school_store.remove(selection);
                        }
                    }
                }, '-', {
                    text:'选项',
                    tooltip:'预留',
                    iconCls:'option'
                }]
                
//                listeners: {
//                    'selectionchange': function(view, records) {
//                        grid.down('#removeEmployee').setDisabled(!records.length);
//                    }
//                },
//	            bbar: Ext.create('Ext.PagingToolbar', {
//	                pageSize: 5,
//	                store: store,
//	                displayInfo: true
//	            })
            });
        }
        win.show();
        school_store.load();
        return win;
    }
});


