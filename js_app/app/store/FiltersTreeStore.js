Ext.define('XMobile.store.FiltersTreeStore', {
    extend: 'Ext.data.TreeStore',
    alias: 'widget.filtersTreeStore',

    config: {
        model: 'XMobile.model.FilterTreeModel',
        defaultRootProperty: 'items',
        root: {
            items: [
                {
                    text: 'Filter 1',
                    items: [
                        {
                            text: 'Product 1', leaf: true
                        },
                        { text: 'Product 2', leaf: true }
                    ]
                },
                {
                    text: 'Filter 2',
                    items: [
                        { text: 'Product 4', leaf: true },
                        { text: 'Product 5', leaf: true },
                        { text: 'Product 6', leaf: true  }
                    ]
                }
            ]
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