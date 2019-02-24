mxConnector.page.Home = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        components: [{
            xtype: 'mxconnector-panel-home',
            renderTo: 'mxconnector-panel-home-div'
        }]
    });
    mxConnector.page.Home.superclass.constructor.call(this, config);
};
Ext.extend(mxConnector.page.Home, MODx.Component);
Ext.reg('mxconnector-page-home', mxConnector.page.Home);