var bxrextra = function(config) {
    config = config || {};
    bxrextra.superclass.constructor.call(this, config);
};
Ext.extend(bxrextra, Ext.Component,{
    page:{}, window:{}, grid:{}, tree:{}, panel:{}, combo:{}, config: {}
});
Ext.reg('bxrextra', bxrextra);
bxrextra = new bxrextra();