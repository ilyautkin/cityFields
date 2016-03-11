cityFields.grid.Cities = function(config) {
	config = config || {};
	this.sm = new Ext.grid.CheckboxSelectionModel();
	Ext.applyIf(config,{
		id: 'cityfields-grid-cities'
		,url: cityFields.config.connector_url
		,baseParams: {
			action: 'mgr/cities/getlist'
		}
		,save_action: 'mgr/cities/updatefromgrid'
		,autosave: true
		,fields: ['id','key','name','active']
		,autoHeight: true
		,paging: true
		,pageSize: 20
		,remoteSort: true
		,sm: this.sm
		,columns: this.getColumns()
		,tbar: [{
				text: '<i class="'+ (MODx.modx23 ? 'icon icon-list' : 'bicon-list') + '"></i> ' + _('cityfields_bulk_actions')
				,menu: [{
					text: _('cityfields_bulk_active_selected')
					,handler: this.enableItems
					,scope: this
				},{
					text: _('cityfields_bulk_deactive_selected')
					,handler: this.disableItems
					,scope: this
				},'-',{
					text: _('cityfields_bulk_remove_selected')
					,handler: this.removeItems
					,scope: this
				}]
			},{
				text: '<i class="icon icon-plus"></i>&nbsp;' + _('cityfields_bulk_create')
				,handler: this.createItem
				,scope: this
			}
		]
	});
	cityFields.grid.Cities.superclass.constructor.call(this,config);
};
Ext.extend(cityFields.grid.Cities,MODx.grid.Grid,{
	windows: {}

	,getMenu: function() {
		var m = [];
		m.push({
			text: _('cityfields_bulk_update')
			,handler: this.updateItem
		});
		m.push({
			text: _('cityfields_bulk_active')
			,handler: this.enableItem
		});
		m.push({
			text: _('cityfields_bulk_deactive')
			,handler: this.disableItem
		});
		m.push('-');
		m.push({
			text: _('cityfields_bulk_remove')
			,handler: this.removeItem
		});
		this.addContextMenuItem(m);
	}

	,getColumns: function() {
		all = {
			id: {hidden: true, sortable: true, width: 20}
			,key: {sortable: true, width: 40}
			,name: {sortable: true, width: 200}
			,active: {sortable: false, width: 40, editor: {xtype:'combo-boolean', renderer:'boolean'}}
		};
		var columns = [this.sm];
		for(var field in all) {
			Ext.applyIf(all[field], {
				header: _('cityfields_cities_' + field)
				,dataIndex: field
			});
			columns.push(all[field]);
		}
		return columns;
	}
	
	,createItem: function(btn,e) {
		if (!this.windows.createCity) {
			this.windows.createCity = MODx.load({
				xtype: 'cityfields-window-city-create'
				,listeners: {
					'success': {fn:function() { this.refresh(); },scope:this}
				}
			});
		}
		this.windows.createCity.fp.getForm().reset();
		this.windows.createCity.show(e.target);
	}

	,updateItem: function(btn,e,row) {
		if (typeof(row) != 'undefined') {this.menu.record = row.data;}
		var id = this.menu.record.id;

		MODx.Ajax.request({
			url: cityFields.config.connector_url
			,params: {
				action: 'mgr/cities/get'
				,id: id
			}
			,listeners: {
				success: {fn:function(r) {
					if (!this.windows.updateCity) {
						this.windows.updateCity = MODx.load({
							xtype: 'cityfields-window-city-update'
							,record: r
							,listeners: {
								'success': {fn:function() { this.refresh(); },scope:this}
							}
						});
					}
					this.windows.updateCity.fp.getForm().reset();
					this.windows.updateCity.fp.getForm().setValues(r.object);
					this.windows.updateCity.show(e.target);
				},scope:this}
			}
		});
	}

	,enableItem: function(btn,e) {
		if (!this.menu.record) return;

		MODx.Ajax.request({
			url: this.config.url
			,params: {
				action: 'mgr/cities/active'
				,ids: this.menu.record.id
				,active: 1
			}
			,listeners: {
				'success': {fn:function(r) { this.refresh(); },scope:this}
			}
		});
	}

	,enableItems: function(btn,e) {
		var cs = this.getSelectedAsList();
		if (cs === false) return false;

		MODx.Ajax.request({
			url: this.config.url
			,params: {
				action: 'mgr/cities/active'
				,ids: cs
				,active: 1
			}
			,listeners: {
				'success': {fn:function(r) { this.refresh(); },scope:this}
			}
		});
	}

	,disableItem: function(btn,e) {
		if (!this.menu.record) return;

		MODx.Ajax.request({
			url: this.config.url
			,params: {
				action: 'mgr/cities/active'
				,ids: this.menu.record.id
				,active: 0
			}
			,listeners: {
				'success': {fn:function(r) { this.refresh(); },scope:this}
			}
		});
	}

	,disableItems: function(btn,e) {
		var cs = this.getSelectedAsList();
		if (cs === false) return false;

		MODx.Ajax.request({
			url: this.config.url
			,params: {
				action: 'mgr/cities/active'
				,ids: cs
				,active: 0
			}
			,listeners: {
				'success': {fn:function(r) { this.refresh(); },scope:this}
			}
		});
	}

	,removeItem: function(btn,e) {
		if (!this.menu.record) return;

		MODx.msg.confirm({
			title: _('cityfields_bulk_remove')
			,text: _('cityfields_bulk_remove_confirm')
			,url: this.config.url
			,params: {
				action: 'mgr/cities/remove'
				,ids: this.menu.record.id
			}
			,listeners: {
				'success': {fn:function(r) { this.refresh(); },scope:this}
			}
		});
	}

	,removeItems: function(btn,e) {
		var cs = this.getSelectedAsList();
		if (cs === false) return false;

		MODx.msg.confirm({
			title: _('cityfields_bulk_remove_selected')
			,text: _('cityfields_bulk_remove_selected_confirm')
			,url: this.config.url
			,params: {
				action: 'mgr/cities/remove'
				,ids: cs
			}
			,listeners: {
				'success': {fn:function(r) { this.refresh(); },scope:this}
			}
		});
	}

});
Ext.reg('cityfields-grid-cities',cityFields.grid.Cities);

cityFields.window.CreateCity = function(config) {
	config = config || {};
	this.ident = config.ident || 'mecitem'+Ext.id();
	Ext.applyIf(config,{
		title: _('cityfields_cities_create')
		,id: this.ident
		,pageSize: Math.round(MODx.config.default_per_page / 2)
		,autoHeight: true
		,url: cityFields.config.connector_url
		,action: 'mgr/cities/create'
		,fields: [
			{xtype: 'textfield',fieldLabel: _('cityfields_cities_key'),name: 'key',id: 'cityfields-'+this.ident+'-key',anchor: '99%'}
			,{xtype: 'textarea',fieldLabel: _('cityfields_cities_name'),name: 'name',id: 'cityfields-'+this.ident+'-name',height: 100,anchor: '99%'}
			,{xtype: 'checkbox',fieldLabel: _('cityfields_cities_active'),name: 'active',id: 'cityfields-'+this.ident+'-active',anchor: '10%'}
		]
		,keys: [{key: Ext.EventObject.ENTER,shift: true,fn: function() {this.submit() },scope: this}]
	});
	cityFields.window.CreateCity.superclass.constructor.call(this,config);
};
Ext.extend(cityFields.window.CreateCity,MODx.Window);
Ext.reg('cityfields-window-city-create',cityFields.window.CreateCity);

cityFields.window.UpdateCity = function(config) {
	config = config || {};
	this.ident = config.ident || 'meuitem'+Ext.id();
	Ext.applyIf(config,{
		title: _('cityfields_cities_update')
		,id: this.ident
		,pageSize: Math.round(MODx.config.default_per_page / 2)
		,autoHeight: true
		,url: cityFields.config.connector_url
		,action: 'mgr/cities/update'
		,fields: [
			{xtype: 'hidden',name: 'id',id: 'cityfields-'+this.ident+'-id'}
			,{xtype: 'textfield',fieldLabel: _('cityfields_cities_key'),name: 'key',id: 'cityfields-'+this.ident+'-key',anchor: '99%'}
			,{xtype: 'textarea',fieldLabel: _('cityfields_cities_name'),name: 'name',id: 'cityfields-'+this.ident+'-name',height: 100,anchor: '99%'}
			,{xtype: 'checkbox',fieldLabel: _('cityfields_cities_active'),name: 'active',id: 'cityfields-'+this.ident+'-active',anchor: '10%'}
		]
		,keys: [{key: Ext.EventObject.ENTER,shift: true,fn: function() {this.submit() },scope: this}]
	});
	cityFields.window.UpdateCity.superclass.constructor.call(this,config);
};
Ext.extend(cityFields.window.UpdateCity,MODx.Window);
Ext.reg('cityfields-window-city-update',cityFields.window.UpdateCity);