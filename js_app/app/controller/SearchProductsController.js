Ext.define('XMobile.controller.SearchProductsController', {
    extend:'Ext.app.Controller',
    alias: 'controller.maincontroller',
    config:{
        refs:{
            //myButton:'#searchButton',
            cancelSearchX: '#s_field clear[class=x-clear-icon]',
            myList:'#productSearchList',
            searchField: '#s_field',
            basketStore: '#basketStore'
        },
        control:{
            /*myButton:{
                tap:'callForStore'
            },*/
            cancelSearchX:{
                tap:'resetSearch'
            },
            searchField: {
                blur:'callForStore'
            },
            productSerchList: {
                itemtap: 'searchItemTap'
            },
            basketStore: {
                load: 'basketStoreLoad'
            }
        }
    },
    resetSearch: function() {
        debugger;
    },
    callForStore:function () {
        var mySearchParameter = Ext.getCmp('s_field').getValue();
        if(mySearchParameter != ''){
            //debugger;
            //a good practice is to display a loading screen in
            //order to notify the user that something goes on.
            Ext.Viewport.setMasked({
                xtype:'loadmask',
                fullscreen: true
            });
            //create your store, because in this example we do not
            //define the store in a component, but create and load it as we go
            var sto = Ext.create('XMobile.store.ProductsStore');
            //mySearchParameter will be set up to be the property by
            //which we tell the server to query the data. in this case all
            // objects that have the property 'orange' for example.


            sto.load({
                //define the parameters of the store:
                params:{
                    s:mySearchParameter
                },
                scope:this,
                callback:function (records, operation, success) {
                    //debugger;
                    Ext.Viewport.setMasked(false); // hide the load screen
                    //console.log('JSON returned:::::::::::::');
                    //console.log(records);
                    //console.log(operation);
                    // add the store to the list
                    var thelist = this.getMyList();
                    thelist.setStore(sto);
                }
            });
        }
    },
    searchItemTap: function(view, index, target, record, event) {
        /*console.log('Search Item tapped:');
        console.log(view, index, target, record, event);
        //Ext.Msg.alert('', 'Produs selectat: ' + record.get('name'));
        var popup = Ext.create('Ext.Menu', {
            hideOnMaskTap: true,
            fullscreen: true,
            modal: true,
            items: [
                {
                    xttype: 'button',
                    text: 'Add to basket',
                    iconCls: 'add'
                },
                {
                    xttype: 'button',
                    text: 'Add to wishlist',
                    iconCls: 'star'
                },
                {
                    xttype: 'button',
                    text: 'Create filter',
                    iconCls: 'settings'
                },
                {
                    xttype: 'button',
                    text: 'Share to a friend',
                    iconCls: 'user'
                }
            ]
        });
        popup.show();*/
    },
    basketStoreLoad: function(a,b,c,d,e,h) {
        debugger;
    }
});