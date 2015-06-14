Ext.define('XMobile.store.FiltersStore', {
    extend: 'Ext.data.Store',
    alias: 'widget.filters',

    config: {
        autoLoad: false,
        model: 'XMobile.model.Filter',
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
            url : 'http://sercer.com/tutorials/hackathon2015/filters.php',
            reader : {
                type : 'json',
                rootProperty: 'filters',
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