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
        iconCls: 'add',
        //icon: '33x33.png',
        styleHtmlContent: true,
        scrollable: true,
        //infinite: true,
        store: {
            xtype:'basketstore',
            storeId: 'basketStore',
            autoLoad: true
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
                if(!popup) {
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
                                iconCls: 'subtract',
                                handler: function () {
                                    //debugger;
                                    Ext.Ajax.request({
                                        url: 'http://192.168.12.102:8080/h2015/remove-from-basket/' + record.data.id,
                                        method: 'GET',
                                        /*params: {
                                         product_id: record.data.id
                                         },*/
                                        headers: [
                                            {'Access-Control-Allow-Origin': 'http://localhost'},
                                            {'Access-Control-Allow-Methods': 'GET, POST, OPTIONS, PUT, PATCH, DELETE'},
                                            {'Access-Control-Allow-Headers': 'X-Requested-With,content-type'},
                                            {'Access-Control-Allow-Credentials': true}
                                        ],
                                        callback: function(options, success, response) {
                                            console.log(response.responseText);
                                        }
                                    });
                                }
                            },
                            {
                                xttype: 'button',
                                text: 'Remove',
                                iconCls: 'star'
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