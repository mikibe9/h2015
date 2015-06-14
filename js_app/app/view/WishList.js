Ext.define('XMobile.view.WishList', {
    extend: 'Ext.dataview.List',
    requires: [
        'Ext.TitleBar',
        'Ext.Ajax',
        'Ext.dataview.List',
        'XMobile.store.WishlistStore',
        'Ext.data.proxy.Rest',
        'Ext.field.Search',
        'Ext.plugin.ListPaging',
        'Ext.plugin.PullRefresh'
    ],
    xtype: 'wishlist',
    config: {
        title: 'Wishlist',
        iconCls: 'favorites',
        //icon: '33x33.png',
        styleHtmlContent: true,
        scrollable: true,
        //infinite: true,
        store: {
            xtype:'wishliststore',
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
            itemtap: function(view, index, target, record, event) {
                if (!popup) {
                    var popup = Ext.create('Ext.Menu', {
                        fullscreen: true,
                        id: 'menu_w',
                        modal: true,
                        hidden: true,
                        hiddenCls: 'x-item-hidden',
                        top: 0,
                        right: 0,
                        bottom: 0,
                        left: 'auto',
                        items: [
                            {
                                xttype: 'button',
                                text: 'Remove',
                                iconCls: 'minus',
                                handler: function () {
                                    //debugger;
                                    Ext.data.JsonP.request
                                    (
                                        {
                                            url: "http://192.168.12.102:8080/h2015/wishlist-remove/" + record.data.id,
                                            callbackKey: "callback",
                                            params: {
                                                cucu: 'cucumucu'
                                            }
                                        }
                                    );
                                }
                            },
                            {
                                xttype: 'button',
                                text: 'Cancel',
                                iconCls: 'arrow_down',
                                handler: function (a, b, c) {
                                    Ext.getCmp('menu_w').hide();
                                    Ext.getCmp('menu_w').destroy();
                                }
                            }
                        ]
                    });
                    Ext.getCmp('wishList').add(popup);
                }

                popup.show();
            },
            show: function() {
                this.getStore().load();
                /*if(!this.getStore().isLoaded()){
                 this.getStore().load();
                 debugger;
                 } else {
                 debugger;
                 }*/
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
                        docked: 'right',
                        xtype: 'title',
                        title: 'Wishlist'
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