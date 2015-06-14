Ext.define('XMobile.store.OffersStore', {
    extend: 'Ext.data.Store',
    alias: 'widget.offersstore',

    config: {
        autoLoad: false,
        model: 'XMobile.model.Product',
        /*proxy: {

            type: 'rest',
            url : 'http://sercer.com/tutorials/hackathon2015/search.php',
            reader: {
                type: 'jsonP',
                rootProperty: 'offers'
            }
        },*/
        proxy : {
            type : 'jsonp',
            //url : 'http://sercer.com/tutorials/hackathon2015/search.php',
            //url : 'http://sercer.com/tutorials/hackathon2015/offers.php',
            url : 'http://192.168.12.102:8080/h2015/offers',
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