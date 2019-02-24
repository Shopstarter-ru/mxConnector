mxConnector.combo.Search = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        xtype: 'twintrigger',
        ctCls: 'x-field-search',
        allowBlank: true,
        msgTarget: 'under',
        emptyText: _('search'),
        name: 'query',
        triggerAction: 'all',
        clearBtnCls: 'x-field-search-clear',
        searchBtnCls: 'x-field-search-go',
        onTrigger1Click: this._triggerSearch,
        onTrigger2Click: this._triggerClear,
    });
    mxConnector.combo.Search.superclass.constructor.call(this, config);
    this.on('render', function () {
        this.getEl().addKeyListener(Ext.EventObject.ENTER, function () {
            this._triggerSearch();
        }, this);
    });
    this.addEvents('clear', 'search');
};
Ext.extend(mxConnector.combo.Search, Ext.form.TwinTriggerField, {

    initComponent: function () {
        Ext.form.TwinTriggerField.superclass.initComponent.call(this);
        this.triggerConfig = {
            tag: 'span',
            cls: 'x-field-search-btns',
            cn: [
                {tag: 'div', cls: 'x-form-trigger ' + this.searchBtnCls},
                {tag: 'div', cls: 'x-form-trigger ' + this.clearBtnCls}
            ]
        };
    },

    _triggerSearch: function () {
        this.fireEvent('search', this);
    },

    _triggerClear: function () {
        this.fireEvent('clear', this);
    },

});
Ext.reg('mxconnector-combo-search', mxConnector.combo.Search);
Ext.reg('mxconnector-field-search', mxConnector.combo.Search);


// Custom

mxConnector.combo.Master = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        name: 'master',
        hiddenName: 'master',
        displayField: 'pagetitle',
        valueField: 'id',
        editable: true,
        fields: ['id', 'pagetitle'],
        pageSize: 20,
        emptyText: _('mxconnector_combo_resource_select'),
        hideMode: 'offsets',
        url: mxConnector.config['connector_url'],
        baseParams: {
            action: 'mgr/system/element/resource/getlist',
            combo: true
        }
    });
    mxConnector.combo.Master.superclass.constructor.call(this, config);
};
Ext.extend(mxConnector.combo.Master, MODx.combo.ComboBox);
Ext.reg('mxconnector-combo-master', mxConnector.combo.Master);

mxConnector.combo.Slave = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        name: 'slave',
        hiddenName: 'slave',
        displayField: 'pagetitle',
        valueField: 'id',
        editable: true,
        fields: ['id', 'pagetitle'],
        pageSize: 20,
        emptyText: _('mxconnector_combo_resource_select'),
        hideMode: 'offsets',
        url: mxConnector.config['connector_url'],
        baseParams: {
            action: 'mgr/system/element/resource/getlist',
            combo: true
        }
    });
    mxConnector.combo.Slave.superclass.constructor.call(this, config);
};
Ext.extend(mxConnector.combo.Slave, MODx.combo.ComboBox);
Ext.reg('mxconnector-combo-slave', mxConnector.combo.Slave);


mxConnector.combo.Taxon = function (config) {
    config = config || {};

    Ext.applyIf(config, {
        name: 'taxon',
        id: 'mxconnector-combo-taxon',
        hiddenName: 'taxon',
        displayField: 'name',
        valueField: 'id',
        fields: ['id', 'name'],
        pageSize: 10,
        editable: true,
        emptyText: _('mxconnector_combo_select'),
        url: mxConnector.config['connector_url'],
        baseParams: {
            action: 'mgr/taxon/getlist',
            combo: true
        }
    });
    mxConnector.combo.Taxon.superclass.constructor.call(this, config);
};
Ext.extend(mxConnector.combo.Taxon, MODx.combo.ComboBox);
Ext.reg('mxconnector-combo-taxon', mxConnector.combo.Taxon);