cityFields.page.Cities = function(config) {
	config = config || {};
	Ext.applyIf(config,{
		components: [{
			xtype: 'cityfields-panel-cities'
			,renderTo: 'cityfields-panel-cities-div'
		}]
	});
	cityFields.page.Cities.superclass.constructor.call(this, config);
};
Ext.extend(cityFields.page.Cities, MODx.Component);
Ext.reg('cityfields-page-cities', cityFields.page.Cities);

cityFields.panel.Cities = function(config) {
	config = config || {};
	Ext.apply(config,{
		border: false
		,baseCls: 'modx-formpanel'
		,items: [{
			html: '<h2>'+_('cityfields_page')+'</h2>'
			,border: false
			,cls: 'modx-page-header container'
		},{
			xtype: 'modx-tabs'
			,bodyStyle: 'padding: 10px'
			,defaults: { border: false ,autoHeight: true }
			,border: true
			,activeItem: 0
			,hideMode: 'offsets'
			,items: [{
				title: _('cityfields_cities')
				,items: [{
					html: _('cityfields_cities_intro')
					,border: false
					,bodyCssClass: 'panel-desc'
					,bodyStyle: 'margin-bottom: 10px'
				},{
					xtype: 'cityfields-grid-cities'
					,preventRender: true
				}]
			},{
				title: _('cityfields_fields')
				,items: [{
					html: _('cityfields_fields_intro')
					,border: false
					,bodyCssClass: 'panel-desc'
					,bodyStyle: 'margin-bottom: 10px'
				},{
					xtype: 'cityfields-grid-fields'
					,preventRender: true
				}]
			}]
		}]
	});
	cityFields.panel.Cities.superclass.constructor.call(this, config);
};
Ext.extend(cityFields.panel.Cities, MODx.Panel);
Ext.reg('cityfields-panel-cities', cityFields.panel.Cities);