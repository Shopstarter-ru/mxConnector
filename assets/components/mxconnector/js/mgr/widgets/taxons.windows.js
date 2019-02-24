mxConnector.window.CreateTaxon = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'mxconnector-taxon-window-create';
    }
    Ext.applyIf(config, {
        title: _('mxconnector_taxon_create'),
        width: 550,
        autoHeight: true,
        url: mxConnector.config.connector_url,
        action: 'mgr/taxon/create',
        fields: this.getFields(config),
        keys: [{
            key: Ext.EventObject.ENTER, shift: true, fn: function () {
                this.submit()
            }, scope: this
        }]
    });
    mxConnector.window.CreateTaxon.superclass.constructor.call(this, config);
};
Ext.extend(mxConnector.window.CreateTaxon, MODx.Window, {

    getFields: function (config) {
        return [{
            xtype: 'textfield',
            fieldLabel: _('mxconnector_taxon_name'),
            name: 'name',
            id: config.id + '-name',
            anchor: '99%',
            allowBlank: false,
        }, {
            xtype: 'textarea',
            fieldLabel: _('mxconnector_taxon_description'),
            name: 'description',
            id: config.id + '-description',
            height: 150,
            anchor: '99%'
        }, {
            xtype: 'xcheckbox',
            boxLabel: _('mxconnector_taxon_active'),
            name: 'active',
            id: config.id + '-active',
            checked: true,
        }];
    },

    loadDropZones: function () {
    }

});
Ext.reg('mxconnector-taxon-window-create', mxConnector.window.CreateTaxon);


mxConnector.window.UpdateTaxon = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'mxconnector-taxon-window-update';
    }
    Ext.applyIf(config, {
        title: _('mxconnector_taxon_update'),
        width: 550,
        autoHeight: true,
        url: mxConnector.config.connector_url,
        action: 'mgr/taxon/update',
        fields: this.getFields(config),
        keys: [{
            key: Ext.EventObject.ENTER, shift: true, fn: function () {
                this.submit()
            }, scope: this
        }]
    });
    mxConnector.window.UpdateTaxon.superclass.constructor.call(this, config);
};
Ext.extend(mxConnector.window.UpdateTaxon, MODx.Window, {

    getFields: function (config) {
        return [{
            xtype: 'hidden',
            name: 'id',
            id: config.id + '-id',
        }, {
            xtype: 'textfield',
            fieldLabel: _('mxconnector_taxon_name'),
            name: 'name',
            id: config.id + '-name',
            anchor: '99%',
            allowBlank: false,
        }, {
            xtype: 'textarea',
            fieldLabel: _('mxconnector_taxon_description'),
            name: 'description',
            id: config.id + '-description',
            anchor: '99%',
            height: 150,
        }, {
            xtype: 'xcheckbox',
            boxLabel: _('mxconnector_taxon_active'),
            name: 'active',
            id: config.id + '-active',
        }];
    },

    loadDropZones: function () {
    }

});
Ext.reg('mxconnector-taxon-window-update', mxConnector.window.UpdateTaxon);