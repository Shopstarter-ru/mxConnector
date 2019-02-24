mxConnector.panel.Home = function (config) {
    config = config || {};
    Ext.apply(config, {
        baseCls: 'modx-formpanel',
        cls: 'container',
        layout: 'anchor',
        /*
         stateful: true,
         stateId: 'mxconnector-panel-home',
         stateEvents: ['tabchange'],
         getState:function() {return {activeTab:this.items.indexOf(this.getActiveTab())};},
         */
        hideMode: 'offsets',
        items: [{
            html: '<h2>' + _('mxconnector') + '</h2>',
            cls: '',
            style: {margin: '15px 0'}
        }, {
            xtype: 'modx-tabs',
            defaults: {border: false, autoHeight: true},
            border: true,
            hideMode: 'offsets',
            items: [{
                title: _('mxconnector_links'),
                layout: 'anchor',
                items: [{
                    html: _('mxconnector_links_intro_msg'),
                    cls: 'panel-desc',
                }, {
                    xtype: 'mxconnector-grid-links',
                    cls: 'main-wrapper',
                }]
            }, {
                title: _('mxconnector_taxons'),
                layout: 'anchor',
                items: [{
                    html: _('mxconnector_taxons_intro_msg'),
                    cls: 'panel-desc',
                }, {
                    xtype: 'mxconnector-grid-taxons',
                    cls: 'main-wrapper',
                }]
            }]
        }]
    });
    mxConnector.panel.Home.superclass.constructor.call(this, config);
};
Ext.extend(mxConnector.panel.Home, MODx.Panel);
Ext.reg('mxconnector-panel-home', mxConnector.panel.Home);
