Ext.define('XMobile.view.OffersList', {
    extend: 'Ext.dataview.List',
    requires: [
        'Ext.TitleBar',
        'Ext.Ajax',
        'Ext.dataview.List',
        'XMobile.store.OffersStore',
        'Ext.data.proxy.Rest',
        'Ext.field.Search',
        'Ext.plugin.ListPaging',
        'Ext.plugin.PullRefresh'
    ],
    xtype: 'offerslist',
    config: {
        title: 'Offers',
        iconCls: 'organize',
        //icon: '33x33.png',
        styleHtmlContent: true,
        scrollable: true,
        //infinite: true,
        store: {
            xtype:'offersstore',
            autoLoad: true
        },
        plugins: [
            {
                xclass: 'Ext.plugin.ListPaging',
                autoPaging: true,
                loadMoreText: 'Se incarca...',
                noMoreRecordsText: 'Nu mai exista rezultate'
            },
            {
                xclass: 'Ext.plugin.PullRefresh',
                pullText: 'Trage pentru a reincarca'
            }
        ],
        itemTpl: '{name} <br /> <div class="h_price_old" style="text-decoration: line-through">{old_price}.99 RON</div><div class="h_price">{price}.99 RON (-{discount} %)</div>',
        listeners: {
            select: function(view, record) {
                Ext.Msg.alert('Selectie!', 'Ai selectat ' + record.get('name'));
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
                        title: 'Offers'
                    }
                    /*,
                    {
                        xtype: 'searchfield',
                        id: 's_field',
                        width: '100%',
                        clearIcon: true,
                        onClearIconTap: function() {
                            if (!this.disabled) {
                                this.setValue(' ');
                                //var searchButton = Ext.getCmp('searchButton').fireAction('tap');
                                var s_field = Ext.getCmp('s_field').fireAction('blur');
                                this.setValue('');
                            }
                        }
                    }*//*,
                    {
                        xtype: 'button',
                        id: 'searchButton',
                        iconCls: 'search'
                    }*/
                ]
            }
        ]
    }
});