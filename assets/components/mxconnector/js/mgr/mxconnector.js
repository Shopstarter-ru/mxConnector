var mxConnector = function (config) {
    config = config || {};
    mxConnector.superclass.constructor.call(this, config);
};
Ext.extend(mxConnector, Ext.Component, {
    page: {}, window: {}, grid: {}, tree: {}, panel: {}, combo: {}, config: {}, view: {}, utils: {}
});
Ext.reg('mxconnector', mxConnector);

mxConnector = new mxConnector();