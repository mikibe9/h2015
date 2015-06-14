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
        itemTpl: '{name} | Quantity: {quantity} <br> Price: {price} | Discount: {discount} %',
        listeners: {
            select: function(view, record) {
                Ext.Msg.alert('Selectie!', 'Ai selectat ' + record.get('name'));
            },
            show: function() {
                debugger;
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