Ext.define('XMobile.store.BasketStore', {
    extend: 'Ext.data.Store',
    alias: 'widget.basketstore',

    config: {
        autoLoad: false,
        model: 'XMobile.model.BasketItem',
        proxy : {
            type : 'jsonp',
            //url : 'http://sercer.com/tutorials/hackathon2015/search.php',
            //url : 'http://sercer.com/tutorials/hackathon2015/basket.php',
            url: 'http://192.168.12.185:8000/h2015/list-basket',
            //url : 'http://127.0.0.1:8000/h2015/',
            reader : {
                type : 'json',
                rootProperty: 'basket_items'
            },
            callbackKey : 'callback',
            extraParams : {
                'events' : true
            }
        }
    },
    getOldItems: function() {
        var reader = this.proxy.reader;

        return reader.createAccessor('total_price')(reader.rawData);
    }
});