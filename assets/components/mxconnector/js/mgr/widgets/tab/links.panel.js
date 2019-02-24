mxConnector.panel.Links = function (config) {
    config = config || {};

    Ext.apply(config, {
        border: false,
        baseCls: 'x-panel mxConnector',
        items: [{
            html: '<p>' + _('mxconnector_links_tab_desc') + '</p>',
            xtype: 'modx-description'
        }, {
            //title: _('mxconnector_links'),
            items: [{
                id: 'mxconnector-grid-links',
                xtype: 'mxconnector-grid-links',
                cls: 'main-wrapper mxconnector-custom', // ставим временный костыльный стиль, чтобы подправить вывод таблицы во вкладке
                record: config.record,
                //store: 0,
            }]
        }]
    });

    mxConnector.panel.Links.superclass.constructor.call(this, config);
};
Ext.extend(mxConnector.panel.Links, MODx.Panel, {});
Ext.reg('mxconnector-page', mxConnector.panel.Links);

