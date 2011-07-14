/*!
 * Ext JS Library 4.0
 * Author: SpARezGw, sparezgw@gmail.com
 * Date: 2011-07-12
 */

Ext.define('MyDesktop.NoticePanel', {
    extend: 'Ext.ux.desktop.Module',

    requires: [
        'Ext.grid.Panel'
    ],

    id:'notice-panel',

    init : function(){
        this.launcher = {
            text: 'Notice Panel',
            iconCls:'icon-grid',
            handler : this.createWindow,
            scope: this
        };
    },
    
    createWindow : function(){
        var desktop = this.app.getDesktop();
        var win = desktop.getWindow('notice-panel');
        
        if(!win){
        	var loginSession = Ext.create('Ext.data.Store', {
//        		autoLoad: true,
//                model: 'Notice',
                fields: ['id', 'sid', 'identify'],
                proxy: {
                    type: 'ajax',
                    url: '../oes/index.php/notice/test',
                    reader: 'json'
                }
            });
        	var userSession;
        	loginSession.load(function() {
        		userSession = loginSession.first();
        		//schooladmin,admin
                if(userSession.get('identify')>1) {
//                	actionBar.add(CreateNoticeAction);
                	win.addDocked(actionBar);
                } else {
                	//木有权限
                }
//        		console.log(userSession.get('sid'));
        	});
        	
        	if (!Ext.ModelManager.isRegistered('Notice')) {
            	Ext.define('Notice', {
                    extend: 'Ext.data.Model',
                    fields: [
                        {name:'nID', type:'int', useNull:true},
                        'nSchool', 'nTitle', 'nBody',
                        {name:'nTime', type:'date', dateFormat: 'Y-m-d H:i:s'}
                    ],
                    idProperty: 'nID'
                });
            }
            
    		// create the Data Store
            var notice_store = Ext.create('Ext.data.Store', {
                autoSync: true,
                model: 'Notice',
                storeId: 'notice.store',
                proxy: {
                    type: 'ajax',
                    api: {
                        read: 'func/index.php/notice/list_notice',
                        create: 'func/index.php/notice/add_notice',
//                        update: '../oes/index.php/school/edit_school',
//                        destroy: '../oes/index.php/school/del_school'
                    },
                    reader: {
                        type: 'json',
                        root: 'data'
                    },
                    writer: {
                        type: 'json',
                        writeAllFields: false
                    }
                }
            });

    		// create the grid
    		var grid = Ext.create('Ext.grid.Panel', {
    			store: notice_store,
                columns: [
                    {text: "ID", width: 70, dataIndex: 'nID'},
                    {text:"Title", flex:1, dataIndex: 'nTitle',
//                    	xtype:'templatecolumn', tpl:'({nSchoolID}){nTitle}',
                    	renderer: function(value, metaData, record, rowIdx, colIdx, store, view){
//                    		console.log(notice_store)
                    		var school = record.get('nSchool');
                    		if(school==0) return '<font color="red"><b>[系统公告]</b></font> ' + value;
                    		else return '<b>[' + school + ']</b> ' + value;
                    			
                    	}},
                    {text:"Date", width:100, dataIndex:'nTime', xtype:'datecolumn', format:'Y-m-d'}
                ],
                viewConfig: {
                    forceFit: true
                },
                width:480,
                border: false,
                split: true,
                region: 'west'
            });
    		
    		// create the text
    		var text = Ext.create('Ext.form.Panel', {
    	        items: {
    	        	xtype: 'textarea',
//    	        	fieldLabel: 'Message text',
//    	            hideLabel: true,
    	        	itemId: 'body',
    	            name: 'msg',
    	            style: 'margin:0', // Remove default margin
    	            fieldStyle: "padding: 5px;",
    	            readOnly: true,
    	            anchor: '100% 100%'
    	        },
//                width: 240,
                border: false,
                split: true,
                region: 'center',
            });
    		
//    		var CreateNoticeAction = Ext.create('Ext.Action', {
//    	        text: '发布新公告',
//    	        iconCls: 'add',
//    	        tooltip:'Add a new row',
//    	        handler: function(){
//    	            Ext.example.msg('Click', 'You clicked on "Action 1".');
//    	        }
//    	    });
    		
    		var actionBar = Ext.create('Ext.toolbar.Toolbar', {
    			dock: 'top',
//    			items: [CreateNoticeAction]
    		    items: [{
                    text:'发布新公告',
                    tooltip:'Add a new row',
                    iconCls:'add',
                    handler: showForm
                },'-',{
                    text:'Remove Something',
                    tooltip:'asdfasdf',
                    iconCls:'remove',
                    disabled: true,
                    itemId: 'removeButton',
                    handler: function(){
//                    	console.log(Ext.ModelManager.getModel(userSession))
        	            alert('Click', 'You clicked on "Action 1".');
        	        }
                }]
    		});
    		
            win = desktop.createWindow({
                id: 'notice-panel',
                title:'公告',
                width:740,
                height:480,
                iconCls: 'icon-grid',
                animCollapse:false,
                constrainHeader:true,
                layout: 'fit',
                items: {
                    xtype: 'panel',
                    layout: 'border',
                    items: [grid, text]
            	}
            });
            
            var newform;
            function showForm() {
                if (!newform) {
//                	alert(n);
                    var form = Ext.widget('form', {
                        layout: {
                            type: 'vbox',
                            align: 'stretch'
                        },
                        border: false,
                        bodyPadding: 10,

                        fieldDefaults: {
                            labelAlign: 'top',
                            labelWidth: 100,
                            labelStyle: 'font-weight:bold',
                            allowBlank: false
                        },
                        defaults: {
                            margins: '0 0 10 0'
                        },
                        
                        items: [{
                        	xtype: 'textfield',
                        	name: 'type',
                            fieldLabel: '公告类别',
                            labelAlign: 'left',
                            readOnly: true,
                            value: (Ext.ModelManager.getModel(userSession).get('identify')==3)?'系统公告':'学校公告'
                        }, {
                            xtype: 'textfield',
                            name: 'title',
                            fieldLabel: '公告标题'
                        }, {
                            xtype: 'textareafield',
                            name: 'body',
                            fieldLabel: '公告正文',
                            flex: 1,
                            margins: '0'
                        }],

                        buttons: [{
                            text: '取消',
                            handler: function() {
                                this.up('form').getForm().reset();
                                this.up('window').hide();
                            }
                        }, {
//                            formBind: true,
//                            disabled: true,
                            text: '发布',
                            handler: function() {
                            	var form = this.up('form').getForm();
                            	var store = Ext.data.StoreManager.lookup('notice.store');
                                if (form.isValid()) {
//                                	console.log(form.getValues().body);
                                	var r = Ext.ModelManager.create({
                                		nTitle: form.getValues().title,
                                		nBody: form.getValues().body,
                                		nSchool: 0
                                    }, 'Notice');
                                    store.insert(0, r)
                                	this.up('form').getForm().reset();
                                	this.up('window').hide();
                                	Ext.Msg.alert('Thank you!', 'Sent.');
                                }
                            }
                        }]
                    });

                    newform = Ext.widget('window', {
                        title: '发布新公告',
                        closeAction: 'hide',
                        width: 400,
                        height: 400,
                        minHeight: 400,
                        layout: 'fit',
                        resizable: true,
                        modal: true,
                        items: form
                    });
                }
                newform.show();
            }
            
            grid.getSelectionModel().on({
                selectionchange: function(selModel, selections) {
//                	var html = selections[0].get('nTitle')+' '+selections[0].get('nTime')+'\n'
                	text.down('#body').setValue(selections[0].get('nBody'));
                	actionBar.down('#removeButton').enable();
//                	alert(selections[0].get('nBody'));
//                	grid.getSelectionModel().getSelection()[0].get('company');
                }
            });
            notice_store.load();
        }
        win.show();
        return win;
    },

    statics: {
        
    }
});
