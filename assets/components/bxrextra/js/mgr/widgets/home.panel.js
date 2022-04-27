bxrextra.panel.Home = function(config) {
    config = config || {};
    Ext.apply(config,
    {
        border: false,
        baseCls: 'modx-formpanel',
        cls: 'container',
        items: [
            {
                html: '<h2>' + _('bxrextra') + '</h2>',
                border: false,
                cls: 'modx-page-header'
            },
            {
                xtype: 'modx-tabs',
                defaults: { border: false ,autoHeight: true },
                border: true,
                activeTab: 0,
                hideMode: 'offsets',
                items: [{
                    title: _('bxrextra.items'),
                    layout: 'form',
                    items: [
                        {
                            html: '<p>' + _('bxrextra.intro_msg') + '</p>',
                            border: false,
                            bodyCssClass: 'panel-desc'
                        },{
                            xtype: 'bxrextra-grid-items',
                            preventRender: true,
                            cls: 'main-wrapper'
                        }
                    ]
                }]
            }
        ]
    });
    bxrextra.panel.Home.superclass.constructor.call(this, config);
};
Ext.extend(bxrextra.panel.Home, MODx.Panel);
Ext.reg('bxrextra-panel-home', bxrextra.panel.Home);
