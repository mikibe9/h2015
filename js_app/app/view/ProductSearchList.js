Ext.define('XMobile.view.ProductSearchList', {
    extend: 'Ext.dataview.List',
    alias : 'widget.productSerchList',
    requires: [
        'Ext.TitleBar',
        'Ext.Ajax',
        'Ext.dataview.List',
        'XMobile.store.ProductsStore',
        'Ext.data.proxy.Rest',
        'Ext.field.Search',
        'Ext.plugin.ListPaging',
        'Ext.plugin.PullRefresh',
        'Ext.form.Panel'
    ],
    xtype: 'productsearchlist',
    config: {
        title: 'Products',
        iconCls: 'search',
        //icon: '33x33.png',
        styleHtmlContent: true,
        scrollable: true,
        //infinite: true,
        store: {
            xtype:'products',
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
        itemTpl: '{name} <br /> <div class="h_price_old" style="text-decoration: line-through">{old_price}.99 RON</div><div class="h_price">{price}.99 RON (-{discount} %)</div>',
        listeners: {
            itemtap: function(view, index, target, record, event) {
                if(!popup) {
                    var popup = Ext.create('Ext.Menu', {
                        fullscreen: true,
                        id: 'menu_s',
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
                                text: 'Add to basket',
                                iconCls: 'add',
                                handler: function () {
                                    Ext.data.JsonP.request
                                    (
                                        {
                                            url: "http://192.168.12.185:8000/h2015/add-to-basket/" + record.data.id,
                                            callbackKey: "callback",
                                            params: {
                                                cucu: 'cucumucu'
                                            }
                                        }
                                    );

                                    /*var form = Ext.create('Ext.form.Panel', {
                                        title: 'Basic Form',
                                        renderTo: Ext.getBody(),
                                        bodyPadding: 5,
                                        width: 350,
                                        method: 'POST',
                                        // Any configuration items here will be automatically passed along to
                                        // the Ext.form.Basic instance when it gets created.

                                        // The form will submit an AJAX request to this URL when submitted
                                        url: 'http://192.168.12.185:8000/h2015/add-to-basket',

                                        items: [{
                                            fieldLabel: 'Product id',
                                            name: 'product_id',
                                            value: record.data.id
                                        }]
                                    });*/
                                    /*form.submit();*/
                                    /*debugger;
                                    Ext.Ajax.request({
                                        url: 'http://192.168.12.185:8000/h2015/add-to-basket',
                                        method: 'POST',
                                        params: {
                                            product_id: record.data.id
                                        },
                                        callback: function(options, success, response) {
                                            console.log(response.responseText);
                                        }
                                    });*/
                                }
                            },
                            {
                                xttype: 'button',
                                text: 'Add to wishlist',
                                iconCls: 'star',
                                handler: function () {
                                    Ext.data.JsonP.request
                                    (
                                        {
                                            url: "http://192.168.12.185:8000/h2015/wishlist-add/" + record.data.id,
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
                                text: 'Create filter',
                                iconCls: 'settings'
                            },
                            {
                                xttype: 'button',
                                text: 'Share to a friend',
                                iconCls: 'action'
                            },
                            {
                                xttype: 'button',
                                text: 'Cancel',
                                iconCls: 'arrow_down',
                                handler: function (a, b, c) {
                                    Ext.getCmp('menu_s').hide();
                                    Ext.getCmp('menu_s').destroy();
                                }
                            }
                        ]
                    });
                    Ext.getCmp('productSearchList').add(popup);
                }

                popup.show();
            }
            /*select: function(view, record) {
                Ext.Msg.alert('Selectie!', 'Ai selectat ' + record.get('name'));
            }*/

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
                    }
                ]
            }
        ]
    }
});