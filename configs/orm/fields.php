<?php
return [
  'dvelum-acl' => "
                {
					xtype:'checkbox',
					name:'use_acl',
					fieldLabel:appLang.DB_USE_ACL,
					checked:false,
					listeners:{
						'change':{
							fn:function(field, newValue, oldValue, options ){
								var form = field.up('form').getForm();
								if(newValue){
									form.findField('acl').show();
								}else{
									form.findField('acl').hide();
								}

							}
						}
					}
				},{
					xtype:'combobox',
					name:'acl',
					fieldLabel:appLang.DB_ACL_ADAPTER,
					queryMode:'local',
					displayField:'title',
					forceSelection:true,
					allowBlank:true,
					valueField:'id',
					hidden:true,
					store:Ext.create('Ext.data.Store',{
                        model:'app.comboStringModel',
						autoLoad:true,
						proxy: {
							type: 'ajax',
							url: ormActionsList.listAcl,
							reader: {
								type: 'json',
								rootProperty: 'data',
								idProperty: 'id'
							}
						},
						remoteSort:false,
						sorters: [{
							property : 'id',
							direction: 'ASC'
						}]
					})
				}
  "
];