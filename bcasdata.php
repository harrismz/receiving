<!--
****	create by Mohamad Yunus
****	on 16 Jan 2017
****	revise:  -
-->

<!doctype html>
<html>
	<title>Bcas Data</title>
	
	<link rel="stylesheet" type="text/css" href="../framework/extjs-4.1.1/resources/css/ext-all.css"/>
    <link rel="stylesheet" type="text/css" href="../framework/extjs-4.1.1/examples/shared/example.css" />
    <script type="text/javascript" src="../framework/extjs-4.1.1/ext-all.js"></script>
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
			white-space: normal;
		}
		.x-grid-cell {
			padding: 2px;
		}
		.x-column-header-inner .x-column-header-text {
			white-space: normal;
		}
		.biggerdate{
			font		: 15pt arial,sans-serif;
			height		: 47px !important;
		}
		
		select:focus{ background: #cffff9; }
		input:focus{ background	: #cffff9; }
		.biggertext{ font : 14pt arial,sans-serif; } 
		
		.refresh { background-image:url(icons/refresh.png) !important; }
		.edit { background-image:url(icons/edit.png) !important; }
		.download { background-image:url(icons/download.png) !important; }
	</style>
	
	<script type="text/javascript">
		Ext.Loader.setConfig({enabled: true});
		Ext.Loader.setPath('Ext.ux', '../framework/extjs-4.1.1/examples/ux/');
		
		Ext.onReady(function(){
			Ext.QuickTips.init();
			
			//	All about function
			//	***
				//	function untuk fontsize grid
					function upsize(val) {
						return '<font size="2" style="font-family:sans-serif; white-space:normal;">' + val + '</font>';
					}
				//	function untuk numeric
					function convertToRupiah(angka)
					{
						var rupiah 		= '';
						var angkarev 	= angka.toString().split('').reverse().join('');
						for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
						return rupiah.split('',rupiah.length-1).reverse().join('');
					}
					
					function numeric(val) {
						if (val > 0) {
							if (val == 999999){
								return '<font size="2" style="font-family:sans-serif; white-space:normal; color:red; float:right;">' + val + '</font>';
							}else{
								return '<font size="2" style="font-family:sans-serif; white-space:normal; color:green; float:right;">' + convertToRupiah(val) + '</font>';
							}
						} else if (val <= 0) {
							return '<font size="2" style="font-family:sans-serif; white-space:normal; color:red; float:right;">' + convertToRupiah(val) + '</font>';
						} else {
							return '<font size="2" style="font-family:sans-serif; white-space:normal; color:gray; float:right;">' + val + '</font>';
						}
						return val;
					}
				//	function required
					var required = '<span style="color:red;font-weight:bold" data-qtip="Required">*</span>';
			//	----***----  //
			
			//	All about json data
			//	***
				var itemperpage = 100;
				var date = new Date();
				//	json store
					Ext.define('disbcas',{
					   extend:'Ext.data.Model',
					   fields:[ 'so', 'partno', 'partname', 'bom', 'reqqty', 'scanqty', 'lot', 'line', 'model', 'issdate', 'serial' ]
					});
				
					var datastore = Ext.create('Ext.data.JsonStore', {
						model       : 'disbcas',
						autoLoad    : true,
						pageSize    : itemperpage,
						proxy		: {
							type	: 'ajax',
							url		: 'json/json_bcas.php',
							extraParams: {
								valstdate: Ext.Date.format(new Date(date.getFullYear(), date.getMonth(), 1), 'Ymd'),
								valendate: Ext.Date.format(new Date(), 'Ymd')
							},
							reader	: {
								type			: 'json',
								root			: 'rows',
								totalProperty	: 'totalCount'
							}
						}
					});
			//	----***----  //
			
			//	Panel
			//	***
				//	form search
					Ext.widget('form', {
						renderTo		: 'formsearch',
						bodyPadding		: 5,
						frame			: false,
						border			: false,
						bodyStyle		: 'background:transparent;',
						width			: '100%',
						fieldDefaults	: {
							labelAlign	: 'left',
							labelStyle	: 'font-weight:bold',
							anchor		: '100%'
						},
						items: [						
							{
								xtype		: 'fieldcontainer',
								fieldLabel	: 'Search on ',
								labelWidth	: 87,
								layout		: 'hbox',
								items		: [
									{
										xtype		: 'datefield',
										id			: 'valstdate',
										name		: 'valstdate',
										fieldCls	: 'biggerdate',
										emptyText	: 'Start Scan Date',
										format		: 'd-M-Y',
										margins		: '0 6 0 0',
										value		: new Date(date.getFullYear(), date.getMonth(), 1),
										flex		: 1,
										listeners	: {
											select  : function(){
												Ext.getCmp('valendate').enable();
											},
											change	: function(f,new_val) {
												var valdate = Ext.getCmp('valstdate').getValue();
												if( valdate == null ){
													Ext.getCmp('valendate').setValue('');
													Ext.getCmp('valendate').disable();
												}
												else{
													Ext.getCmp('valendate').setValue('');
													Ext.getCmp('valendate').setMinValue( Ext.getCmp('valstdate').getValue() );
												}
											}
										}
									}, {
										xtype		: 'datefield',
										id			: 'valendate',
										name		: 'valendate',
										fieldCls	: 'biggerdate',
										emptyText	: 'End Scan Date',
										format		: 'd-M-Y',
										margins		: '0 6 0 0',
										value		: Ext.Date.format(new Date(), 'd-M-Y'),
										flex		: 1,
										listeners	: {
											specialkey : function(field, e) {
												if (e.getKey() == 13) {
													datastore.proxy.setExtraParam('valstdate', 	Ext.Date.format(new Ext.getCmp('valstdate').getValue(), 'Ymd') );
													datastore.proxy.setExtraParam('valendate', 	Ext.Date.format(new Ext.getCmp('valendate').getValue(), 'Ymd') );
													datastore.proxy.setExtraParam('valso', 		Ext.getCmp('valso').getValue());
													datastore.proxy.setExtraParam('valpartno', 	Ext.getCmp('valpartno').getValue());
													datastore.proxy.setExtraParam('vallotno', 	Ext.getCmp('vallotno').getValue());
													datastore.loadPage(1);
												}
											}
										}
									}, {
										xtype		: 'textfield',
										id			: 'valso',
										name		: 'valso',
										fieldCls	: 'biggertext',
										emptyText	: 'SO Number',
										margins		: '0 6 0 0',
										height 		: 47,
										flex		: 1,
										listeners	: {
											change	: function(f,new_val) {
												f.setValue(new_val.toUpperCase());
											},
											specialkey : function(field, e) {
												if (e.getKey() == 13) {
													datastore.proxy.setExtraParam('valstdate', 	Ext.Date.format(new Ext.getCmp('valstdate').getValue(), 'Ymd') );
													datastore.proxy.setExtraParam('valendate', 	Ext.Date.format(new Ext.getCmp('valendate').getValue(), 'Ymd') );
													datastore.proxy.setExtraParam('valso', 		Ext.getCmp('valso').getValue());
													datastore.proxy.setExtraParam('valpartno', 	Ext.getCmp('valpartno').getValue());
													datastore.proxy.setExtraParam('vallotno', 	Ext.getCmp('vallotno').getValue());
													datastore.loadPage(1);
												}
											}
										}
									}, {
										xtype		: 'textfield',
										id			: 'valpartno',
										name		: 'valpartno',
										fieldCls	: 'biggertext',
										emptyText	: 'Part Number',
										margins		: '0 6 0 0',
										height 		: 47,
										flex		: 1,
										listeners	: {
											change	: function(f,new_val) {
												f.setValue(new_val.toUpperCase());
											},
											specialkey : function(field, e) {
												if (e.getKey() == 13) {
													datastore.proxy.setExtraParam('valstdate', 	Ext.Date.format(new Ext.getCmp('valstdate').getValue(), 'Ymd') );
													datastore.proxy.setExtraParam('valendate', 	Ext.Date.format(new Ext.getCmp('valendate').getValue(), 'Ymd') );
													datastore.proxy.setExtraParam('valso', 		Ext.getCmp('valso').getValue());
													datastore.proxy.setExtraParam('valpartno', 	Ext.getCmp('valpartno').getValue());
													datastore.proxy.setExtraParam('vallotno', 	Ext.getCmp('vallotno').getValue());
													datastore.loadPage(1);
												}
											}
										}
									}, {
										xtype		: 'textfield',
										id			: 'vallotno',
										name		: 'vallotno',
										fieldCls	: 'biggertext',
										emptyText	: 'Lot No',
										margins		: '0 6 0 0',
										height 		: 47,
										flex		: 1,
										listeners	: {
											change	: function(f,new_val) {
												f.setValue(new_val.toUpperCase());
											},
											specialkey : function(field, e) {
												if (e.getKey() == 13) {
													datastore.proxy.setExtraParam('valstdate', 	Ext.Date.format(new Ext.getCmp('valstdate').getValue(), 'Ymd') );
													datastore.proxy.setExtraParam('valendate', 	Ext.Date.format(new Ext.getCmp('valendate').getValue(), 'Ymd') );
													datastore.proxy.setExtraParam('valso', 		Ext.getCmp('valso').getValue());
													datastore.proxy.setExtraParam('valpartno', 	Ext.getCmp('valpartno').getValue());
													datastore.proxy.setExtraParam('vallotno', 	Ext.getCmp('vallotno').getValue());
													datastore.loadPage(1);
												}
											}
										}
									}
								]
							}
						]
					});

				//	grid
					var clock 		= Ext.create('Ext.toolbar.TextItem', {text: Ext.Date.format(new Date(), 'g:i:s A')});
					var cellEditing = Ext.create('Ext.grid.plugin.CellEditing', { clicksToEdit: 1 });
					var griddata	= Ext.create('Ext.grid.Panel', {
						renderTo	: 'panelgrid',
						title		: 'Bcas Data',
						store		: datastore,
						height		: 450,
						autoWidth	: '100%',
						columnLines	: true,
						multiSelect	: true,
						viewConfig	: {
							stripeRows			: true,
							enableTextSelection	: true
						},
						plugins: [cellEditing],
						selModel: {
							selType: 'cellmodel'
						},
						columns: [
							{ header: 'No.', xtype: 'rownumberer', width: 50, height: 40, sortable: false },
							{ text: 'SO Number', 	dataIndex: 'so', 		width: 80, renderer: upsize },
							{ text: 'Part No', 		dataIndex: 'partno', 	flex: 1, renderer: upsize },
							{ text: 'Part Name', 	dataIndex: 'partname', 	flex: 1, renderer: upsize },
							{ text: 'BOM', 			dataIndex: 'bom', 		width: 55, renderer: numeric },
							{ text: 'Req QTY', 		dataIndex: 'reqqty', 	width: 75, renderer: numeric },
							{ text: 'Scan QTY', 	dataIndex: 'scanqty', 	width: 55, renderer: numeric },
							{ text: 'Lot', 			dataIndex: 'lot', 		width: 75, renderer: upsize },
							{ text: 'Line', 		dataIndex: 'line', 		width: 80, renderer: upsize },
							{ text: 'Model', 		dataIndex: 'model', 	flex: 1, renderer: upsize },
							{ text: 'Issue Date', 	dataIndex: 'issdate', 	width: 120, renderer: upsize, align: 'center' },
							{ text: 'Serial', 		dataIndex: 'serial', 	flex: 1, renderer: upsize }
						],
						listeners: {
							render: {
								fn: function(){
									Ext.fly(clock.getEl().parent()).addCls('x-status-text-panel').createChild({cls:'spacer'});

								 Ext.TaskManager.start({
									 run: function(){
										 Ext.fly(clock.getEl()).update(Ext.Date.format(new Date(), 'g:i:s A'));
									 },
									 interval: 1000
								 });
								},
								delay: 100
							}
						},
						tbar		: [
							{
								xtype	: 'button',
								id		: 'btn_refresh',
								iconCls	: 'refresh',
								text 	: 'Refresh',
								tooltip	: 'Refresh',
								handler : function (){
									Ext.getCmp('valstdate').reset();
									Ext.getCmp('valendate').reset();
									Ext.getCmp('valso').reset();
									Ext.getCmp('valpartno').reset();
									Ext.getCmp('vallotno').reset();
									
									datastore.proxy.setExtraParam('valstdate', 	Ext.Date.format(new Date(date.getFullYear(), date.getMonth(), 1), 'Ymd'));
									datastore.proxy.setExtraParam('valendate', 	Ext.Date.format(new Date(), 'Ymd'));
									datastore.proxy.setExtraParam('valso', 		'');
									datastore.proxy.setExtraParam('valpartno', 	'');
									datastore.proxy.setExtraParam('vallotno', 	'');
									datastore.loadPage(1);
								}
							}, {
								xtype	: 'button',
								id		: 'btn_download',
								iconCls	: 'download',
								text 	: 'Download',
								tooltip	: 'Download',
								handler : function (){									
									var stdate 	= Ext.Date.format(new Ext.getCmp('valstdate').getValue(), 'Ymd');
									var endate 	= Ext.Date.format(new Ext.getCmp('valendate').getValue(), 'Ymd');
									var so 		= Ext.getCmp('valso').getValue();
									var partno 	= Ext.getCmp('valpartno').getValue();
									var lotno 	= Ext.getCmp('vallotno').getValue();
									
									window.open('resp/resp_downbcas.php?valstdate='+stdate+'&valendate='+endate+'&valso='+so+'&valpartno='+partno+'&vallotno='+lotno+'');
								}
							}, 
							'->',
							{
								xtype		: 'label',
								text		: Ext.Date.format(new Date(), 'l, d F Y'),
								margins		: '5 5 0 5'
							}, 
							'-',
							clock
						],
						bbar		: Ext.create('Ext.PagingToolbar', {
							pageSize	: itemperpage,
							store		: datastore,
							displayInfo	: true,
							plugins		: Ext.create('Ext.ux.ProgressBarPager', {}),
							listeners	: {
								afterrender: function(cmp) {
									cmp.getComponent("refresh").hide();
								}
							}
						})
					});
			//	----***----  //
		});
	</script>
<body>
	<a href="index.php">menu</a><br /><br />

	<div id="formsearch"></div>
	<div id="panelgrid"></div>
	
	<footer>
		<div style="float:left;">
			<font size="1" color="#a3a2a2">Powered by IT Department</font>
			<br>
			<font size="1" color="#a3a2a2">PT JVC Electronics Indonesia</font>
		</div>
		
		<div style="float:right">
			<font size="1" color="#a3a2a2">
				<?php if (date("Y") == 2016){ ?>
				Copyright &copy; <?php echo date("Y"); ?> IT Department <br> <p align="right">All rights reserved.</p>
				<?php }else{ ?>
				Copyright &copy; 2016 - <?php echo date("Y"); ?> IT Department. <br> <p align="right">All rights reserved.</p>
				<?php } ?>
			</font>
		</div>
	</footer>
</body>
</html>

