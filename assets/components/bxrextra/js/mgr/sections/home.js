Ext.onReady(function() {
    MODx.load({ xtype: 'bxrextra-page-home'});
});

bxrextra.page.Home = function(config) {
    config = config || {};
    Ext.applyIf(config, {
        components: [{
            xtype: 'bxrextra-panel-home',
            renderTo: 'bxrextra-panel-home-div'
        }]
    });
    bxrextra.page.Home.superclass.constructor.call(this, config);
};
Ext.extend(bxrextra.page.Home, MODx.Component);
Ext.reg('bxrextra-page-home', bxrextra.page.Home);