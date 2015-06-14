Ext.define('XMobile.store.WishlistStore', {
    extend: 'Ext.data.Store',
    alias: 'widget.wishliststore',

    config: {
        autoLoad: false,
        model: 'XMobile.model.WishlistItem',
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
            //url : 'http://sercer.com/tutorials/hackathon2015/wishlist.php',
            //url : 'http://sercer.com/tutorials/hackathon2015/wishlist.php',
            url: 'http://192.168.12.185:8000/h2015/wishlist',
            reader : {
                type : 'json',
                rootProperty: 'wishlist',
                totalProperty: 'total'
            },
            callbackKey : 'callback',
            extraParams : {
                'events' : true
            }
        },
        pageSize: 50,
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