var cityFields = function(config) {
	config = config || {};
	cityFields.superclass.constructor.call(this,config);
};
Ext.extend(cityFields,Ext.Component,{
	page:{},window:{},grid:{},tree:{},panel:{},combo:{},config:{},view:{}
});
Ext.reg('cityfields',cityFields);
cityFields = new cityFields();
cityFields.PanelSpacer = { html: '<br />' ,border: false, cls: 'cityfields-panel-spacer' };