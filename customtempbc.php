<!--
****	create by Mohamad Yunus
****	on 3 June 2017
****	revise:  
-->

<!doctype html>
<html>
	<title>Temp BC Maintenance</title>
	
	<link rel="stylesheet" type="text/css" href="../extjs-4.2.2/resources/css/ext-all.css"/>
    <link rel="stylesheet" type="text/css" href="../extjs-4.2.2/examples/shared/example.css" />
    <script type="text/javascript" src="../extjs-4.2.2/ext-all.js"></script>
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
		.process { background-image:url(icons/process.png) !important; }
	</style>
	
	<script type="text/javascript">
		Ext.Loader.setConfig({enabled: true});
		Ext.Loader.setPath('Ext.ux', '../extjs-4.2.2/examples/ux/');
		
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
						return '<font size="2" style="font-family:sans-serif; white-space:normal; color:green; float:right;">' + val + '</font>';
					} else if (val <= 0) {
						return '<font size="2" style="font-family:sans-serif; white-space:normal; color:red; float:right;">' + val + '</font>';
					} else {
						return '<font size="2" style="font-family:sans-serif; white-space:normal; color:gray; float:right;">' + val + '</font>';
					}
					return val;
				}
				//	function required
					var required = '<span style="color:red;font-weight:bold" data-qtip="Required">*</span>';
				//	function date
					var date = new Date();
			//	----***----  //
			
			//	All about json data
			//	***
				var itemperpage = 100;
				//	json store
					Ext.define('disptmpbc',{
					   extend:'Ext.data.Model',
					   fields:[ 'jns_dok', 'dp_no', 'dp_tgl', 'bpb_no', 'bpb_tgl', 'pemasok', 'partno', 'partname', 'sat', 'jumlah', 'nilai', 'periode', 'files', 'currency', 'ponumber', 'id' ]
					});
				
					var datastore = Ext.create('Ext.data.JsonStore', {
						model       : 'disptmpbc',
						autoLoad    : true,
						pageSize    : itemperpage,
						proxy		: {
							type	: 'ajax',
							url		: 'json/json_tmpbc.php',
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
										fieldCls	: 'biggertext',
										emptyText	: 'Start Scan Date',
										format		: 'd-M-Y',
										margins		: '0 6 6 0',
										value		: Ext.Date.format(new Date(date.getFullYear(), date.getMonth(), 1), 'd-M-Y'),
										height 		: 49,
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
										fieldCls	: 'biggertext',
										emptyText	: 'End Scan Date',
										format		: 'd-M-Y',
										margins		: '0 6 0 0',
										value		: Ext.Date.format(new Date(), 'd-M-Y'),
										height 		: 49,
										flex		: 1,
										listeners	: {
											specialkey : function(field, e) {
												if (e.getKey() == 13) {
													datastore.proxy.setExtraParam('valstdate', 	Ext.Date.format(new Ext.getCmp('valstdate').getValue(), 'Ymd') );
													datastore.proxy.setExtraParam('valendate', 	Ext.Date.format(new Ext.getCmp('valendate').getValue(), 'Ymd') );
													datastore.proxy.setExtraParam('valsupp', 	Ext.getCmp('valsupp').getValue());
													datastore.proxy.setExtraParam('valpartno', 	Ext.getCmp('valpartno').getValue());
													datastore.proxy.setExtraParam('valpono', 	Ext.getCmp('valpono').getValue());
													datastore.loadPage(1);
												}
											}
										}
									}, {
										xtype		: 'textfield',
										id			: 'valsupp',
										name		: 'valsupp',
										fieldCls	: 'biggertext',
										emptyText	: 'Supplier',
										margins		: '0 6 0 0',
										height 		: 49,
										flex		: 1,
										listeners	: {
											change	: function(f,new_val) {
												f.setValue(new_val.toUpperCase());
											},
											specialkey : function(field, e) {
												if (e.getKey() == 13) {
													datastore.proxy.setExtraParam('valstdate', 	Ext.Date.format(new Ext.getCmp('valstdate').getValue(), 'Ymd') );
													datastore.proxy.setExtraParam('valendate', 	Ext.Date.format(new Ext.getCmp('valendate').getValue(), 'Ymd') );
													datastore.proxy.setExtraParam('valsupp', 	Ext.getCmp('valsupp').getValue());
													datastore.proxy.setExtraParam('valpartno', 	Ext.getCmp('valpartno').getValue());
													datastore.proxy.setExtraParam('valpono', 	Ext.getCmp('valpono').getValue());
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
										height 		: 49,
										flex		: 1,
										listeners	: {
											change	: function(f,new_val) {
												f.setValue(new_val.toUpperCase());
											},
											specialkey : function(field, e) {
												if (e.getKey() == 13) {
													datastore.proxy.setExtraParam('valstdate', 	Ext.Date.format(new Ext.getCmp('valstdate').getValue(), 'Ymd') );
													datastore.proxy.setExtraParam('valendate', 	Ext.Date.format(new Ext.getCmp('valendate').getValue(), 'Ymd') );
													datastore.proxy.setExtraParam('valsupp', 	Ext.getCmp('valsupp').getValue());
													datastore.proxy.setExtraParam('valpartno', 	Ext.getCmp('valpartno').getValue());
													datastore.proxy.setExtraParam('valpono', 	Ext.getCmp('valpono').getValue());
													datastore.loadPage(1);
												}
											}
										}
									}, {
										xtype		: 'textfield',
										id			: 'valpono',
										name		: 'valpono',
										fieldCls	: 'biggertext',
										emptyText	: 'PO Number',
										margins		: '0 6 0 0',
										height 		: 49,
										flex		: 1,
										listeners	: {
											change	: function(f,new_val) {
												f.setValue(new_val.toUpperCase());
											},
											specialkey : function(field, e) {
												if (e.getKey() == 13) {
													datastore.proxy.setExtraParam('valstdate', 	Ext.Date.format(new Ext.getCmp('valstdate').getValue(), 'Ymd') );
													datastore.proxy.setExtraParam('valendate', 	Ext.Date.format(new Ext.getCmp('valendate').getValue(), 'Ymd') );
													datastore.proxy.setExtraParam('valsupp', 	Ext.getCmp('valsupp').getValue());
													datastore.proxy.setExtraParam('valpartno', 	Ext.getCmp('valpartno').getValue());
													datastore.proxy.setExtraParam('valpono', 	Ext.getCmp('valpono').getValue());
													datastore.loadPage(1);
												}
											}
										}
									}, {
										xtype		: 'label',
										text		: '  ',
										margins		: '5 5 0 5'
									}
								]
							}
						]
					});

				//	grid
					var clock 		= Ext.create('Ext.toolbar.TextItem', {text: Ext.Date.format(new Date(), 'g:i:s A')});
					var cellEditing = Ext.create('Ext.grid.plugin.CellEditing', { clicksToEdit: 2 });
					var griddata	= Ext.create('Ext.grid.Panel', {
						renderTo	: 'panelgrid',
						title		: 'Temp BC Maintenance',
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
						//selModel: {
						//	selType: 'cellmodel'
						//},
						columns: [
							{ header: 'No.', xtype: 'rownumberer', width: 50, height: 40, sortable: false },
							{ text: 'Jenis Dokumen'+required,  	dataIndex: 'jns_dok', 	width: 100, renderer: upsize,
								field: {
									xtype		: 'textfield',
									id			: 'jns_dok_new',
									name		: 'jns_dok_new',
									maxLength	: 100,
									listeners	: {
										change	: function(f,new_val) {
											f.setValue(new_val.toUpperCase());
										},
										specialkey : function(field, e) {
											if (e.getKey() == 13) {
												var len = Ext.getCmp('jns_dok_new').getValue().toString().length;
												var selectedRecord 	= griddata.getSelectionModel().getSelection()[0];
												var row 			= griddata.store.indexOf(selectedRecord);
												var	valid			= griddata.getStore().getAt(row).get('id');
												var	valjns_dok_old	= griddata.getStore().getAt(row).get('jns_dok');
												var	valjns_dok_new	= Ext.getCmp('jns_dok_new').getValue().replace("BC", "");
												var	valdp_no		= griddata.getStore().getAt(row).get('dp_no');
												var	valfiles		= griddata.getStore().getAt(row).get('files').substring(0, 11);
												
												if(len > 100){
													Ext.Msg.show({
														title		: 'Ubah Jenis Dokumen',
														icon		: Ext.Msg.ERROR,
														msg			: 'Jumlah Karakter Melebihi 100 !!',
														buttons		: Ext.Msg.OK
													});
													Ext.Ajax.request({
														url		: 'resp/resp_tmpbc.php',
														method	: 'POST',
														params	: 'typeform=edit&desc=jnsdok&id='+valid+'&jns_dok='+valjns_dok_old+'&dp_no='+valdp_no+'&files='+valfiles,
														success	: function(obj) {
															var resp = obj.responseText;
															if (resp != 0) {
																datastore.loadPage(1);
																
															} else {
																Ext.Msg.show({
																	title		:'Edit Data',
																	icon		: Ext.Msg.ERROR,
																	msg			: resp,
																	buttons		: Ext.Msg.OK
																});
															}
														}
													});
												}
												else{
													Ext.Ajax.request({
														url		: 'resp/resp_tmpbc.php',
														method	: 'POST',
														params	: 'typeform=edit&desc=jnsdok&id='+valid+'&jns_dok='+valjns_dok_new+'&dp_no='+valdp_no+'&files='+valfiles,
														success	: function(obj) {
															var resp = obj.responseText;
															if (resp != 0) {
																datastore.loadPage(1);
																
															} else {
																Ext.Msg.show({
																	title		:'Edit Data',
																	icon		: Ext.Msg.ERROR,
																	msg			: resp,
																	buttons		: Ext.Msg.OK
																});
															}
														}
													});
												}
											}
										}
									}
								}
							},
							{
								text: 'Dokumen Pabean', width : 150,
								columns : [
									{ text: 'No.'+required, 	dataIndex: 'dp_no', 	width: 120, renderer: upsize,
										field: {
											xtype		: 'textfield',
											id			: 'dp_no_new',
											name		: 'dp_no_new',
											maxLength	: 50,
											listeners	: {
												change	: function(f,new_val) {
													f.setValue(new_val.toUpperCase());
												},
												specialkey : function(field, e) {
													if (e.getKey() == 13) {
														var len = Ext.getCmp('dp_no_new').getValue().toString().length;
														var selectedRecord 	= griddata.getSelectionModel().getSelection()[0];
														var row 			= griddata.store.indexOf(selectedRecord);
														var	valid			= griddata.getStore().getAt(row).get('id');
														var	valjns_dok		= griddata.getStore().getAt(row).get('jns_dok');
														var	valdp_no_old	= griddata.getStore().getAt(row).get('dp_no');
														var	valdp_no_new	= Ext.getCmp('dp_no_new').getValue();
														
														if(len > 50){
															Ext.Msg.show({
																title		: 'Ubah No. Dok Pabean',
																icon		: Ext.Msg.ERROR,
																msg			: 'Jumlah Karakter Melebihi 50 !!',
																buttons		: Ext.Msg.OK
															});
															Ext.Ajax.request({
																url		: 'resp/resp_tmpbc.php',
																method	: 'POST',
																params	: 'typeform=edit&desc=dpno&id='+valid+'&dp_no='+valdp_no_old+'&jns_dok='+valjns_dok,
																success	: function(obj) {
																	var resp = obj.responseText;
																	if (resp != 0) {
																		datastore.loadPage(1);
																		
																	} else {
																		Ext.Msg.show({
																			title		:'Edit Data',
																			icon		: Ext.Msg.ERROR,
																			msg			: resp,
																			buttons		: Ext.Msg.OK
																		});
																	}
																}
															});
														}
														else{
															Ext.Ajax.request({
																url		: 'resp/resp_tmpbc.php',
																method	: 'POST',
																params	: 'typeform=edit&desc=dpno&id='+valid+'&dp_no='+valdp_no_new+'&jns_dok='+valjns_dok,
																success	: function(obj) {
																	var resp = obj.responseText;
																	if (resp != 0) {
																		datastore.loadPage(1);
																		
																	} else {
																		Ext.Msg.show({
																			title		:'Edit Data',
																			icon		: Ext.Msg.ERROR,
																			msg			: resp,
																			buttons		: Ext.Msg.OK
																		});
																	}
																}
															});
														}
													}
												}
											}
										}
									},
									{ text: 'Tanggal', 	dataIndex: 'dp_tgl',	width: 100, align: 'center', renderer: upsize }
								]
							},
							{
								text: 'Bukti Penerimaan Barang', width:120,
								columns: [	
									{ text: 'No.', 		dataIndex: 'bpb_no', 	width: 120, renderer: upsize },
									{ text: 'Tanggal', 	dataIndex: 'bpb_tgl',	width: 100, align: 'center', renderer: upsize }
								]
							},
							{ text: 'PO Number', 	dataIndex: 'ponumber', 	width: 90, renderer: upsize },
							{ text: 'Pemasok',  	dataIndex: 'pemasok', 	width : 350, renderer: upsize },
							{ text: 'Partno',  		dataIndex: 'partno',	width : 125, renderer: upsize },
							{ text: 'Partname',		dataIndex: 'partname', 	width : 150, renderer: upsize },
							{ text: 'Sat', 			dataIndex: 'sat', 		width: 50, renderer: upsize },
							{ text: 'Jumlah', 		dataIndex: 'jumlah', 	width: 90, renderer: numeric },
							{ text: 'Mata Uang', 	dataIndex: 'currency', 	width: 75, renderer: upsize },
							{ text: 'Nilai', 		dataIndex: 'nilai', 	width: 90, renderer: numeric },
							{ text: 'Autoid', dataIndex: 'id', hidden: true }
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
									Ext.getCmp('valsupp').reset();
									Ext.getCmp('valpartno').reset();
									Ext.getCmp('valpono').reset();
									
									datastore.proxy.setExtraParam('valstdate', 	Ext.Date.format(new Date(date.getFullYear(), date.getMonth(), 1), 'Ymd'));
									datastore.proxy.setExtraParam('valendate', 	Ext.Date.format(new Date(), 'Ymd'));
									datastore.proxy.setExtraParam('valsupp', 	'');
									datastore.proxy.setExtraParam('valpartno', 	'');
									datastore.proxy.setExtraParam('valpono', 	'');
									datastore.loadPage(1);
								}
							}, {
								xtype	: 'button',
								id		: 'btn_process',
								iconCls	: 'process',
								text 	: 'Send to IT Inventory',
								tooltip	: 'Send to IT Inventory',
								handler : function (){
									alert('Send to IT Inventory');
								}
							}, 
							'->',
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
				<?php if (date("Y") == 2017){ ?>
				Copyright &copy; <?php echo date("Y"); ?> IT Department <br> <p align="right">All rights reserved.</p>
				<?php }else{ ?>
				Copyright &copy; 2017 - <?php echo date("Y"); ?> IT Department. <br> <p align="right">All rights reserved.</p>
				<?php } ?>
			</font>
		</div>
	</footer>
</body>
</html>

