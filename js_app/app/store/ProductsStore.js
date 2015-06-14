Ext.define('XMobile.store.ProductsStore', {
    extend: 'Ext.data.Store',
    alias: 'widget.products',

    config: {
        autoLoad: false,
        model: 'XMobile.model.Product',
        /*proxy: {

            type: 'rest',
            url : 'http://sercer.com/tutorials/hackathon2015/search.php',
            reader: {
                type: 'jsonP',
                rootProperty: 'products'
            }
        },*/
        proxy : {
            type : 'jsonp',
            //url : 'http://sercer.com/tutorials/hackathon2015/search.php',
            url : './search.php',
            //url : 'http://192.168.12.185:8000/h2015/',
            reader : {
                type : 'json',
                rootProperty: 'products',
                totalProperty: 'num_rows'
            },
            callbackKey : 'callback',
            extraParams : {
                'events' : true
            }
        },
        pageSize: 20,
        onLoad: function(a, b,c){
            alert('test');
        }
        /*
        data: [
            {name: 'Cowper'},
            {name: 'Everett'},
            {name: 'University'},
            {name: 'Forest'},
            {name: 'University'},
            {name: 'Forest'},
            {name: 'University'},
            {name: 'Forest'},
            {name: 'University'},
            {name: 'Forest'},
            {name: 'University'},
            {name: 'Forest'},
            {name: 'University'},
            {name: 'Forest'},
            {name: 'University'},
            {name: 'Forest'},
            {name: 'University'},
            {name: 'Forest'},
            {name: 'University'},
            {name: 'Forest'},
            {name: 'University'},
            {name: 'Forest'},
            {name: 'University'},
            {name: 'Forest'},
            {name: 'University'},
            {name: 'Forest'},
            {name: 'University'},
            {name: 'Forest'},
            {name: 'University'},
            {name: 'Forest'},
            {name: 'University'},
            {name: 'Forest'},
            {name: 'Forest'}
        ]*/
    }
});