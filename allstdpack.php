<!--
****	modify by Mohamad Yunus
****	on 13 June 2016
****	revise:  add button download
-->

<!doctype html>
<html>
	<title>Part Number Maintenance</title>
	
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
			white-space: normal;
		}
		.x-grid-cell {
			padding: 2px;
		}
		.x-column-header-inner .x-column-header-text {
			white-space: normal;
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
		Ext.Loader.setPath('Ext.ux', '../extjs-4.1.1/examples/ux/');
		
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
				//	json store
					Ext.define('disstdpack',{
					   extend:'Ext.data.Model',
					   fields:[ 'suppcode', 'suppname', 'partnumber', 'partname', 'stdpack', 'kategori', 'lokasi', 'replikasi'  ]
					});
				
					var datastore = Ext.create('Ext.data.JsonStore', {
						model       : 'disstdpack',
						autoLoad    : true,
						pageSize    : itemperpage,
						proxy		: {
							type	: 'ajax',
							url		: 'json/json_stdpack.php',
							reader	: {
								type			: 'json',
								root			: 'rows',
								totalProperty	: 'totalCount'
							}
						}
					});
			
					var storeupd = Ext.create('Ext.data.JsonStore', {
						proxy		: {
							type	: 'ajax',
							url		: 'json/json_spupdata.php',
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
						width			: '65%',
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
										xtype		: 'textfield',
										id			: 'valsuppcode',
										name		: 'valsuppcode',
										fieldCls	: 'biggertext',
										emptyText	: 'Suppcode',
										margins		: '0 6 0 0',
										height 		: 49,
										flex		: 1,
										listeners	: {
											change	: function(f,new_val) {
												f.setValue(new_val.toUpperCase());
											},
											specialkey : function(field, e) {
												if (e.getKey() == 13) {
													datastore.proxy.setExtraParam('valsuppcode', 	Ext.getCmp('valsuppcode').getValue());
													datastore.proxy.setExtraParam('valsuppname', 	Ext.getCmp('valsuppname').getValue());
													datastore.proxy.setExtraParam('valpartnumber', 	Ext.getCmp('valpartnumber').getValue());
													datastore.proxy.setExtraParam('vallokasi', 		Ext.getCmp('vallokasi').getValue());
													datastore.loadPage(1);
												}
											}
										}
									}, {
										xtype		: 'textfield',
										id			: 'valsuppname',
										name		: 'valsuppname',
										fieldCls	: 'biggertext',
										emptyText	: 'Suppname',
										margins		: '0 6 0 0',
										height 		: 49,
										flex		: 1,
										listeners	: {
											change	: function(f,new_val) {
												f.setValue(new_val.toUpperCase());
											},
											specialkey : function(field, e) {
												if (e.getKey() == 13) {
													datastore.proxy.setExtraParam('valsuppcode', 	Ext.getCmp('valsuppcode').getValue());
													datastore.proxy.setExtraParam('valsuppname', 	Ext.getCmp('valsuppname').getValue());
													datastore.proxy.setExtraParam('valpartnumber', 	Ext.getCmp('valpartnumber').getValue());
													datastore.proxy.setExtraParam('vallokasi', 		Ext.getCmp('vallokasi').getValue());
													datastore.loadPage(1);
												}
											}
										}
									}, {
										xtype		: 'textfield',
										id			: 'valpartnumber',
										name		: 'valpartnumber',
										fieldCls	: 'biggertext',
										emptyText	: 'Part Number',
										margins		: '0 6 0 0',
										height 		: 49,
										flex		: 1,
										listeners	: {
											change	: function(f,new_val) {
												f.setValue(new_val.toUpperCase());
											},
											specialkey : function(field, e) {
												if (e.getKey() == 13) {
													datastore.proxy.setExtraParam('valsuppcode', 	Ext.getCmp('valsuppcode').getValue());
													datastore.proxy.setExtraParam('valsuppname', 	Ext.getCmp('valsuppname').getValue());
													datastore.proxy.setExtraParam('valpartnumber', 	Ext.getCmp('valpartnumber').getValue());
													datastore.proxy.setExtraParam('vallokasi', 		Ext.getCmp('vallokasi').getValue());
													datastore.loadPage(1);
												}
											}
										}
									}, {
										xtype		: 'textfield',
										id			: 'vallokasi',
										name		: 'vallokasi',
										fieldCls	: 'biggertext',
										emptyText	: 'Location',
										margins		: '0 6 0 0',
										height 		: 49,
										flex		: 1,
										listeners	: {
											change	: function(f,new_val) {
												f.setValue(new_val.toUpperCase());
											},
											specialkey : function(field, e) {
												if (e.getKey() == 13) {
													datastore.proxy.setExtraParam('valsuppcode', 	Ext.getCmp('valsuppcode').getValue());
													datastore.proxy.setExtraParam('valsuppname', 	Ext.getCmp('valsuppname').getValue());
													datastore.proxy.setExtraParam('valpartnumber', 	Ext.getCmp('valpartnumber').getValue());
													datastore.proxy.setExtraParam('vallokasi', 		Ext.getCmp('vallokasi').getValue());
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
						title		: 'Part Number Data',
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
							{ text: 'Supplier Code', 		dataIndex: 'suppcode', 		width: 90, renderer: upsize },
							{ text: 'Supplier Name',		dataIndex: 'suppname', 		flex: 2, 	renderer: upsize },
							{ text: 'Part No', 				dataIndex: 'partnumber',	flex: 1, 	renderer: upsize },
							{ text: 'Part Name', 			dataIndex: 'partname', 		flex: 1, 	renderer: upsize },
							{ text: 'STD Pack'+required,	dataIndex: 'stdpack', 		width: 80, 	renderer: numeric,
								field: {
									xtype		: 'numberfield',
									id			: 'stdpack',
									name		: 'stdpack',
									minValue	: 0,
									maxValue	: 99999999999
								}
							},
							{ text: 'Category'+required,	dataIndex: 'kategori', 		flex: 1, 	renderer: upsize,
								field: {
									xtype		: 'textfield',
									id			: 'kategori',
									name		: 'kategori',
									maxLength	: 3
								}
							},
							{ text: 'Location'+required, 	dataIndex: 'lokasi', 		width: 120, renderer: upsize,
								field: {
									xtype		: 'textfield',
									id			: 'lokasi',
									name		: 'lokasi',
									maxLength	: 10
								}
							},
							{ text: 'Autoid', dataIndex: 'replikasi', hidden: true }
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
									Ext.getCmp('valsuppcode').reset();
									Ext.getCmp('valsuppname').reset();
									Ext.getCmp('valpartnumber').reset();
									Ext.getCmp('vallokasi').reset();
									
									datastore.proxy.setExtraParam('valsuppcode', 	'');
									datastore.proxy.setExtraParam('valsuppname', 	'');
									datastore.proxy.setExtraParam('valpartnumber', 	'');
									datastore.proxy.setExtraParam('vallokasi', 	'');
									datastore.loadPage(1);
								}
							}, {
								xtype	: 'button',
								id		: 'btn_download',
								iconCls	: 'download',
								text 	: 'Download',
								tooltip	: 'Download',
								handler : function (){									
									var suppcode 	= Ext.getCmp('valsuppcode').getValue();
									var suppname 	= Ext.getCmp('valsuppname').getValue();
									var partnumber 	= Ext.getCmp('valpartnumber').getValue();
									var lokasi 		= Ext.getCmp('vallokasi').getValue();
									
									window.open('resp/resp_down.php?valsuppcode='+suppcode+'&valsuppname='+suppname+'&valpartnumber='+partnumber+'&vallokasi='+lokasi+'');
								}
							}, 
							'->',
							{
								xtype	: 'button',
								id		: 'btn_edit',
								iconCls	: 'edit',
								text 	: 'Update Data',
								tooltip	: 'Update Data',
								handler : function (){
									Ext.Msg.confirm('Confirm', 'Are you sure want to update data ?', function(btn){
										if (btn == 'yes'){
											var record = griddata.store.getUpdatedRecords();
											
											for (var i=0; i < record.length; i++) {
												//alert(record[i].data.replikasi+' ## '+record[i].data.stdpack+' ## '+record[i].data.kategori+' ## '+record[i].data.lokasi);
											
												storeupd.proxy.setExtraParam('valreplikasi',record[i].data.replikasi);
												storeupd.proxy.setExtraParam('valstdpack', 	record[i].data.stdpack);
												storeupd.proxy.setExtraParam('valkategori',	record[i].data.kategori);
												storeupd.proxy.setExtraParam('vallokasi', 	record[i].data.lokasi);
												storeupd.loadPage(1);
											}
											datastore.loadPage(1);
										}
										else{
											datastore.loadPage(1);
										}
									});
								}
							}, 
							'-',
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

