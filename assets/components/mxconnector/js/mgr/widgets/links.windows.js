mxConnector.window.CreateLink = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'mxconnector-link-window-create';
    }
    Ext.applyIf(config, {
        title: _('mxconnector_link_create'),
        width: 550,
        autoHeight: true,
        url: mxConnector.config.connector_url,
        action: 'mgr/link/create',
        fields: this.getFields(config),
        keys: [{
            key: Ext.EventObject.ENTER, shift: true, fn: function () {
                this.submit()
            }, scope: this
        }]
    });
    mxConnector.window.CreateLink.superclass.constructor.call(this, config);
};
Ext.extend(mxConnector.window.CreateLink, MODx.Window, {

    getFields: function (config) {
        return [{
            xtype: 'mxconnector-combo-taxon',
            fieldLabel: _('mxconnector_link_taxon'),
            name: 'taxon',
            id: config.id + '-taxon',
            anchor: '99%',
            allowBlank: false,
        }, {
            xtype: 'mxconnector-combo-master',
            fieldLabel: _('mxconnector_link_master'),
            name: 'master',
            id: config.id + '-master',
            anchor: '99%',
            allowBlank: false,
        }, {
            xtype: 'mxconnector-combo-slave',
            fieldLabel: _('mxconnector_link_slave'),
            name: 'slave',
            id: config.id + '-slave',
            anchor: '99%',
            allowBlank: false,
        }];
    },

    loadDropZones: function () {
    }

});
Ext.reg('mxconnector-link-window-create', mxConnector.window.CreateLink);


mxConnector.window.UpdateLink = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'mxconnector-link-window-update';
    }
    Ext.applyIf(config, {
        title: _('mxconnector_link_update'),
        width: 550,
        autoHeight: true,
        url: mxConnector.config.connector_url,
        action: 'mgr/link/update',
        fields: this.getFields(config),
        keys: [{
            key: Ext.EventObject.ENTER, shift: true, fn: function () {
                this.submit()
            }, scope: this
        }]
    });
    mxConnector.window.UpdateLink.superclass.constructor.call(this, config);
};
Ext.extend(mxConnector.window.UpdateLink, MODx.Window, {

    getFields: function (config) {
        return [{
            xtype: 'hidden',
            name: 'id',
            id: config.id + '-id',
        }, {
            xtype: 'mxconnector-combo-taxon',
            fieldLabel: _('mxconnector_link_taxon'),
            name: 'taxon',
            id: config.id + '-taxon',
            anchor: '99%',
            allowBlank: false,
        }, {
            xtype: 'mxconnector-combo-master',
            fieldLabel: _('mxconnector_link_master'),
            name: 'master',
            id: config.id + '-master',
            anchor: '99%',
            allowBlank: false,
        }, {
            xtype: 'mxconnector-combo-slave',
            fieldLabel: _('mxconnector_link_slave'),
            name: 'slave',
            id: config.id + '-slave',
            anchor: '99%',
            allowBlank: false,
        }];
    },

    loadDropZones: function () {
    }

});
Ext.reg('mxconnector-link-window-update', mxConnector.window.UpdateLink);