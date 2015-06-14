Ext.define('XMobile.view.FiltersList', {
    extend: 'Ext.dataview.List',
    requires: [
        'Ext.TitleBar',
        'Ext.Ajax',
        'Ext.dataview.List',
        'XMobile.store.FiltersStore',
        'Ext.data.proxy.Rest',
        'Ext.field.Search',
        'Ext.plugin.ListPaging',
        'Ext.plugin.PullRefresh'
    ],
    xtype: 'filterslist',
    config: {
        title: 'Filters',
        iconCls: 'settings',
        //icon: '33x33.png',
        styleHtmlContent: true,
        scrollable: true,
        //infinite: true,
        store: {
            xtype:'filters',
            autoLoad: true
        },
        plugins: [
            {
                xclass: 'Ext.plugin.ListPaging',
                autoPaging: true,
                loadMoreText: 'Se incarca...',
                noMoreRecordsText: 'Nu mai exista rezultate'
            },
            {
                xclass: 'Ext.plugin.PullRefresh',
                pullText: 'Trage pentru a reincarca'
            }
        ],
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