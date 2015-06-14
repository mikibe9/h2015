Ext.define('XMobile.model.Product', {
    extend: 'Ext.data.Model',
    alias: 'widget.product',
    config: {
        idProperty: 'id',
        fields: [
            { name: 'id', type: 'int' },
            { name: 'name', type: 'string' },
            { name: 'category', type: 'string' },
            { name: 'brand', type: 'string' },
            { name: 'old_price', type: 'int' },
            { name: 'price', type: 'int' },
            { name: 'discount', type: 'int' }
        ]
    }
});