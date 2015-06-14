Ext.define('XMobile.view.BasketList', {
    extend: 'Ext.dataview.List',
    requires: [
        'Ext.TitleBar',
        'Ext.Ajax',
        'Ext.dataview.List',
        'XMobile.store.BasketStore',
        'Ext.data.proxy.Rest',
        'Ext.field.Search'
    ],
    xtype: 'basketlist',
    config: {
        title: 'Basket',
        iconCls: 'basketIcon',
        //icon: '33x33.png',
        styleHtmlContent: true,
        scrollable: true,
        //infinite: true,
        store: {
            xtype:'basketstore',
            storeId: 'basketStore'/*,
            autoLoad: true*/
        },
        itemTpl:  new Ext.XTemplate(
            '<tpl if="totals">',
            '<b>Magic Discount</b> <p style="color:green;">{magic_discount}</p> Total Price <p style="color:darkred;"><s>{total_price}</s></p> <b>Magic Price</b> <p style="color:green"">{magic_price}</p>',
            '<tpl else>',
            '{name} | Quantity: {quantity} <br> Price: {price} | Discount: {discount} %',
            '</tpl>'
        ),
        listeners: {
            itemtap: function(view, index, target, record, event) {
                if (!popup) {
                    var popup = Ext.create('Ext.Menu', {
                        fullscreen: true,
                        id: 'menu_b',
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
                                text: 'Subtract 1',
                                iconCls: 'minus1',
                                handler: function () {
                                    //debugger;
                                    Ext.data.JsonP.request
                                    (
                                        {
                                            url: "http://192.168.12.185:8000/h2015/remove-from-basket/" + record.data.product_id,
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
                                    Ext.getCmp('menu_b').hide();
                                    Ext.getCmp('menu_b').destroy();
                                }
                            }
                        ]
                    });
                    Ext.getCmp('basketList').add(popup);
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
                        title: 'Basket'
                    }
                ]
            }
        ]
    }
});