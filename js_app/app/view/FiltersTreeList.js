Ext.define('XMobile.view.FiltersTreeList', {
    extend: 'Ext.NestedList',
    requires: [
        'Ext.TitleBar',
        'Ext.Ajax',
        'Ext.dataview.List',
        'XMobile.store.FiltersTreeStore',
        'Ext.data.proxy.Rest'
    ],
    xtype: 'filterstreelist',
    config: {
        title: 'Filters',
        iconCls: 'settings',
        //icon: '33x33.png',
        styleHtmlContent: true,
        scrollable: true,
        //infinite: true,
        store: {
            xtype:'filtersTreeStore',
            autoLoad: true
        },
        itemTpl: '{name}',
        listeners: {
            select: function(view, record) {
                Ext.Msg.alert('Selectie!', 'Ai selectat ' + record.get('name'));
            }
        },
        items: [
            {
                docked: 'top',
                xtype: 'titlebar',
                //title: 'XMobile',
                items: [
                    {
                        docked: 'left',
                        cls: 'title-bar-emag',
                        width: '110px',
                        border: '0'
                    },
                    {
                        xtype: 'button',
                        id: 'filterListButton',
                        iconCls: 'list',
                        ui: 'plain',
                        items: [
                            {
                                xtype: 'menu',
                                id: 'filterMenu',
                                items: [
                                    {
                                        xtype: 'button',
                                        text: 'Option 1'
                                    },
                                    {
                                        xtype: 'button',
                                        text: 'Option 2'
                                    }
                                ]
                            }
                        ],
                        handler: function () {
                            var menu = Ext.getCmp('filterMenu');
                            debugger;
                            /*var menu =
                            if(menu.isHidden()){
                                menu.show();
                            }
                            else
                            {
                                menu.hide();
                            }*/
                        }

                    },
                    {
                        docked: 'right',
                        xtype: 'title',
                        title: 'CustomX Filters'
                    }
                    /*,
                    {
                        xtype: 'searchfield',
                        id: 's_field',
                        width: '100%',
                        clearIcon: true,
                        onClearIconTap: function() {
                            if (!this.disabled) {
                                this.setValue(' ');
                                //var searchButton = Ext.getCmp('searchButton').fireAction('tap');
                                var s_field = Ext.getCmp('s_field').fireAction('blur');
                                this.setValue('');
                            }
                        }
                    }*//*,
                    {
                        xtype: 'button',
                        id: 'searchButton',
                        iconCls: 'search'
                    }*/
                ]
            }
        ]
    }
});