
bxrextra.grid.Items = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        id: 'bxrextra-grid-items',
        url: MODx.config.connector_url,
        baseParams: {
            action: 'BxrExtra\\Processors\\Item\\GetList'
        },
        save_action: 'BxrExtra\\Processors\\Item\\UpdateFromGrid',
        autosave: true,
        fields: ['id','name','description'],
        autoHeight: true,
        paging: true,
        remoteSort: true,
        ddGroup: 'bxrextraItemDDGroup',
        enableDragDrop: true,
        columns: [{
            header: _('id'),
            dataIndex: 'id',
            width: 70
        },{
            header: _('name'),
            dataIndex: 'name',
            width: 200,
            editor: { xtype: 'textfield' }
        },{
            header: _('description'),
            dataIndex: 'description',
            width: 250,
            editor: { xtype: 'textfield' }
        }],
        tbar: [{
            text: _('bxrextra.item_create'),
            handler: this.createItem,
            scope: this
        },'->',{
            xtype: 'textfield',
            id: 'bxrextra-search-filter',
            emptyText: _('bxrextra.search...'),
            listeners: {
                'change': {fn:this.search, scope:this},
                'render': {fn: function(cmp) {
                    new Ext.KeyMap(cmp.getEl(), {
                        key: Ext.EventObject.ENTER,
                        fn: function() {
                            this.fireEvent('change',this);
                            this.blur();
                            return true;
                        },
                        scope: cmp
                    });
                },scope:this}
            }
        }],
        listeners: {
            'render': function(g) {
                var ddrow = new Ext.ux.dd.GridReorderDropTarget(g, {
                    copy: false,
                    listeners: {
                        'beforerowmove': function(objThis, oldIndex, newIndex, records) {},
                        'afterrowmove': function(objThis, oldIndex, newIndex, records) {
                            MODx.Ajax.request({
                                url: MODx.config.connector_url,
                                params: {
                                    action: 'BxrExtra\\Processors\\Item\\Reorder',
                                    idItem: records.pop().id,
                                    oldIndex: oldIndex,
                                    newIndex: newIndex
                                },
                                listeners: {
                                }
                            });
                        },
                        'beforerowcopy': function(objThis, oldIndex, newIndex, records) {},
                        'afterrowcopy': function(objThis, oldIndex, newIndex, records) {}
                    }
                });
                Ext.dd.ScrollManager.register(g.getView().getEditorParent());
            },
            beforedestroy: function(g) {
                Ext.dd.ScrollManager.unregister(g.getView().getEditorParent());
            }
        }
    });
    bxrextra.grid.Items.superclass.constructor.call(this, config);
};
Ext.extend(bxrextra.grid.Items, MODx.grid.Grid,{
    windows: {},

    getMenu: function() {
        var m = [];
        m.push({
            text: _('bxrextra.item_update'),
            handler: this.updateItem
        });
        m.push('-');
        m.push({
            text: _('bxrextra.item_remove'),
            handler: this.removeItem
        });
        this.addContextMenuItem(m);
    },
    
    createItem: function(btn,e) {
        this.createUpdateItem(btn, e, false);
    },

    updateItem: function(btn,e) {
        this.createUpdateItem(btn, e, true);
    },

    createUpdateItem: function(btn, e, isUpdate) {
        var r;

        if(isUpdate){
            if (!this.menu.record || !this.menu.record.id) return false;
            r = this.menu.record;
        }else{
            r = {};
        }

        this.windows.createUpdateItem = MODx.load({
            xtype: 'bxrextra-window-item-create-update',
            isUpdate: isUpdate,
            title: (isUpdate) ? _('bxrextra.item_update') : _('bxrextra.item_create'),
            record: r,
            listeners: {
                'success': {fn:function() { this.refresh(); }, scope:this}
            }
        });

        this.windows.createUpdateItem.fp.getForm().reset();
        this.windows.createUpdateItem.fp.getForm().setValues(r);
        this.windows.createUpdateItem.show(e.target);
    },
    
    removeItem: function(btn, e) {
        if (!this.menu.record) return false;
        
        MODx.msg.confirm({
            title: _('bxrextra.item_remove'),
            text: _('bxrextra.item_remove_confirm'),
            url: this.config.url,
            params: {
                action: 'BxrExtra\\Processors\\Item\\Remove',
                id: this.menu.record.id
            },
            listeners: {
                'success': {fn:function(r) { this.refresh(); }, scope:this}
            }
        });
    },

    search: function(tf, nv, ov) {
        var s = this.getStore();
        s.baseParams.query = tf.getValue();
        this.getBottomToolbar().changePage(1);
        this.refresh();
    },

    getDragDropText: function(){
        return this.selModel.selections.items[0].data.name;
    }
});
Ext.reg('bxrextra-grid-items', bxrextra.grid.Items);

bxrextra.window.CreateUpdateItem = function(config) {
    config = config || {};
    this.ident = config.ident || 'bxrextra-mecitem'+Ext.id();
    Ext.applyIf(config,{
        id: this.ident,
        width: 475,
        closeAction: 'close',
        url: MODx.config.connector_url,
        action: (config.isUpdate)? 'BxrExtra\\Processors\\Item\\Update' : 'BxrExtra\\Processors\\Item\\Create',
        fields: [{
            xtype: 'textfield',
            name: 'id',
            id: this.ident+'-id',
            hidden: true
        },{
            xtype: 'textfield',
            fieldLabel: _('name'),
            name: 'name',
            id: this.ident+'-name',
            anchor: '100%'
        },{
            xtype: 'textarea',
            fieldLabel: _('description'),
            name: 'description',
            id: this.ident+'-description',
            anchor: '100%'
        }]
    });
    bxrextra.window.CreateUpdateItem.superclass.constructor.call(this, config);
};
Ext.extend(bxrextra.window.CreateUpdateItem, MODx.Window);
Ext.reg('bxrextra-window-item-create-update', bxrextra.window.CreateUpdateItem);

