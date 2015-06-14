Ext.define('XMobile.view.Main', {
    extend: 'Ext.tab.Panel',
    xtype: 'main',
    requires: [
        'Ext.TitleBar',
        'XMobile.view.ProductSearchList',
        'XMobile.view.FiltersList',
        'XMobile.view.WishList',
        'XMobile.view.OffersList',
        'XMobile.view.BasketList',
        'XMobile.view.FiltersTreeList'
    ],
    config: {
        tabBarPosition: 'bottom',

        items: [
            {
                xtype: 'productsearchlist', //xmobile\app\view\ProductSearchList.js:1
                id: 'productSearchList'
            },
            /*{
                xtype: 'filterslist', //xmobile\app\view\FiltersList.js:1
                id: 'filtersList'
            },*/
            {
                xtype: 'filterstreelist', //xmobile\app\view\FiltersList.js:1
                id: 'filtersTreeList'
            },
            {
                xtype: 'wishlist', //xmobile\app\view\FiltersList.js:1
                id: 'wishList'
            },
            {
                xtype: 'offerslist', //xmobile\app\view\FiltersList.js:1
                id: 'offersList'
            },
            {
                xtype: 'basketlist', //xmobile\app\view\FiltersList.js:1
                id: 'basketList'
            }
            /*{
                title: 'Filters',
                iconCls: 'settings',

                items: [
                    {
                        docked: 'top',
                        xtype: 'titlebar',
                        title: 'Filters'
                    }
                ]
            },*/
            /*{
                title: 'Wish list',
                iconCls: 'favorites',

                items: [
                    {
                        docked: 'top',
                        xtype: 'titlebar',
                        title: 'Wish list'
                    }
                ]
            }*/
            /*{
                title: 'Offers',
                iconCls: 'organize',

                items: [
                    {
                        docked: 'top',
                        xtype: 'titlebar',
                        title: 'Offers'
                    }
                ]
            }*/
            /*{
                title: 'Basket',
                iconCls: 'add',

                items: [
                    {
                        docked: 'top',
                        xtype: 'titlebar',
                        title: 'Basket'
                    }
                ]
            }*/
        ]
    }
});
