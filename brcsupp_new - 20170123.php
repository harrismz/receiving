<html>
	<title>Barcode Print Supplier Select</title>
	
	<link rel="stylesheet" type="text/css" href="../extjs-4.1.1/resources/css/ext-all.css"/>
    <link rel="stylesheet" type="text/css" href="../extjs-4.1.1/examples/shared/example.css" />
    <script type="text/javascript" src="../extjs-4.1.1/ext-all.js"></script>
	<style type="text/css">
		/* style rows on mouseover */
		.x-grid-row-over .x-grid-cell-inner {
			font-weight: bold;
		}
		/* shared styles for the ActionColumn icons */
		.x-action-col-cell img {
			cursor: pointer;
		}
		.x-grid-row-summary  .x-grid-cell-inner {
            font-weight: bold;
            font-size: 11px;
            padding-bottom: 4px;
        }
		.x-grid-row-summary {
            color:#333;
            background: #f1f2f4;
        }		
		.x-column-header-inner { 
			font-weight: bold;
			text-align: center;
		}
		.x-grid-cell {
			padding: 2px;
		}
	</style>
	
	<script type="text/javascript">
		Ext.Loader.setConfig({enabled: true});
		
		Ext.Loader.setPath('Ext.ux', '../extjs-4.1.1/examples/ux/');
		
		Ext.onReady(function(){
			Ext.QuickTips.init();
			
			var required = '<span style="color:red;font-weight:bold" data-qtip="Required">*</span>';
			
			//	All about json data
			//	***
				//	json
					Ext.define('cbx_supplier', {
						extend	: 'Ext.data.Model',
						fields	: [ 'suppcode', 'suppname' ]
					});
					var ds_cbx_supplier = Ext.create('Ext.data.Store', {
						model		: 'cbx_supplier',
						autoLoad	: true,
						fields		: [ 'suppcode', 'suppname' ],
						proxy		: {
							type	: 'ajax',
							url		: 'json/json_cbx_supplier.php',
							reader	: {
								type			: 'json',
								root			: 'rows',
								totalProperty	: 'totalCount'
							}
						}
					});
					
					
					Ext.define('cbx_partno', {
						extend	: 'Ext.data.Model',
						fields	: [ 'partno' ]
					});
					var ds_cbx_partno = Ext.create('Ext.data.Store', {
						model		: 'cbx_partno',
						autoLoad	: true,
						fields		: [ 'partno' ],
						proxy		: {
							type	: 'ajax',
							url		: 'json/json_cbx_partno.php',
							reader	: {
								type			: 'json',
								root			: 'rows',
								totalProperty	: 'totalCount'
							}
						}
					});
					
					
					Ext.define('cbx_pono', {
						extend	: 'Ext.data.Model',
						fields	: [ 'pono' ]
					});
					var ds_cbx_pono = Ext.create('Ext.data.Store', {
						model		: 'cbx_pono',
						autoLoad	: true,
						fields		: [ 'pono' ],
						proxy		: {
							type	: 'ajax',
							url		: 'json/json_cbx_pono.php',
							reader	: {
								type			: 'json',
								root			: 'rows',
								totalProperty	: 'totalCount'
							}
						}
					});
					
					
					Ext.define('qty', {
						extend	: 'Ext.data.Model',
						fields	: [ 'qty' ]
					});
					var ds_qty = Ext.create('Ext.data.Store', {
						model		: 'qty',
						autoLoad	: true,
						fields		: [ 'qty' ],
						proxy		: {
							type	: 'ajax',
							url		: 'json/json_qty.php',
							reader	: {
								type			: 'json',
								root			: 'rows',
								totalProperty	: 'totalCount'
							}
						},
						listeners: {
							load: function(store, records) {
								var record = store.getAt(0);
								Ext.getCmp("fi-form").loadRecord(record);
							}
						}
					});
				//	end of json
			//	----***----  //
			
			
			Ext.create('Ext.form.Panel', {
				renderTo	: 'fi-form',
				id			: 'fi-form',
				width		: 500,
				frame		: true,
				title		: 'Select Supplier',
				bodyPadding	: '10 10 0',

				defaults	: {
					anchor		: '100%',
					allowBlank	: false,
					msgTarget	: 'side',
					labelWidth	: 150,
					labelStyle	: 'font-weight:bold'
				},

				items: [
					{
						xtype				: 'combo',
						id					: 'suppname',
						name				: 'suppname',
						fieldLabel			: 'Supplier Name',
						queryMode			: 'local',
						displayField		: 'suppname',
						valueField			: 'suppcode',
						editable			: true,
						allowBlank			: false,
						afterLabelTextTpl	: required,
						store				: ds_cbx_supplier,
						listConfig			: {
							getInnerTpl	: function() {
								return '<div> {suppname} - {suppcode} </div>';
							}
						},
						listeners 			: {
							afterrender	: function(field) {
								field.focus(false, 1000);
							},
							change: function(f,new_val) {
								Ext.getCmp('suppcode').setValue( Ext.getCmp('suppname').getValue() );								
								
								ds_cbx_partno.proxy.setExtraParam('suppcode', Ext.getCmp('suppname').getValue() );
								ds_cbx_partno.loadPage(1);
								
								Ext.getCmp('part').setValue('');
								Ext.getCmp('po').setValue('');
								Ext.getCmp('qty').setValue('');
								Ext.getCmp('invno').setValue('');
							}
						}
					}, {
						xtype				: 'textfield',
						id					: 'suppcode',
						name				: 'suppcode',
						fieldLabel			: 'Supplier Code',
						readOnly			: true
					}, {
						xtype				: 'combo',
						id					: 'part',
						name				: 'part',
						fieldLabel			: 'Part No',
						queryMode			: 'proxy',
						displayField		: 'partno',
						valueField			: 'partno',
						editable			: true,
						allowBlank			: false,
						afterLabelTextTpl	: required,
						store				: ds_cbx_partno,
						listeners 			: {
							change: function(f,new_val) {
								ds_cbx_partno.proxy.setExtraParam('partno', Ext.getCmp('part').getValue() );
								ds_cbx_partno.loadPage(1);
								
								ds_cbx_pono.proxy.setExtraParam('suppcode', Ext.getCmp('suppname').getValue() );
								ds_cbx_pono.proxy.setExtraParam('partno', Ext.getCmp('part').getValue() );
								ds_cbx_pono.loadPage(1);
							}
						}
					}, {
						xtype				: 'combo',
						id					: 'po',
						name				: 'po',
						fieldLabel			: 'PO No',
						queryMode			: 'proxy',
						displayField		: 'pono',
						valueField			: 'pono',
						editable			: true,
						allowBlank			: false,
						afterLabelTextTpl	: required,
						store				: ds_cbx_pono,
						listeners 			: {
							change: function(f,new_val) {
								ds_cbx_pono.proxy.setExtraParam('pono', Ext.getCmp('po').getValue() );
								ds_cbx_pono.loadPage(1);
								
								ds_qty.proxy.setExtraParam('suppcode', Ext.getCmp('suppname').getValue() );
								ds_qty.proxy.setExtraParam('partno', Ext.getCmp('part').getValue() );
								ds_qty.proxy.setExtraParam('pono', Ext.getCmp('po').getValue() );
								ds_qty.loadPage(1);
							}
						}
					}, {
						xtype				: 'textfield',
						id					: 'qty',
						name				: 'qty',
						fieldLabel			: 'QTY',
						allowBlank			: false,
						afterLabelTextTpl	: required
					}, {
						xtype				: 'textfield',
						id					: 'invno',
						name				: 'invno',
						fieldLabel			: 'Invoice No',
						allowBlank			: false,
						afterLabelTextTpl	: required,
						maxlength			: 15
					}
				],

				buttons: [
					{
						text		: 'View',
						formBind	: true,
						handler		: function(){
							var part 		= Ext.getCmp('part').getValue();
							var suppcode 	= Ext.getCmp('suppcode').getValue();
							var po 			= Ext.getCmp('po').getValue();
							var qty 		= Ext.getCmp('qty').getValue();
							var invno 		= Ext.getCmp('invno').getValue();
							//location.target = "_blank";
							//location.href = 'brcview_new.php?part='+part+'&suppcode='+suppcode+'&po='+po+'&qty='+qty+'&invno='+invno+'';
							
							window.open('brcview_new.php?part='+part+'&suppcode='+suppcode+'&po='+po+'&qty='+qty+'&invno='+invno+'');
							
						}
					}
				]
			});
		});
	</script>
<body>
	<a href="index.php">menu</a><br /><br />

	<div id="fi-form"></div>
</body>
</html>

