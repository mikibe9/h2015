Ext.define('XMobile.model.BasketItem', {
    extend: 'Ext.data.Model',
    alias: 'widget.basketitem',
    config: {
        idProperty: 'id',
        fields: [
            { name: 'id', type: 'int' },
            { name: 'product_id', type: 'int' },
            { name: 'name', type: 'string' },
            { name: 'brand', type: 'string' },
            { name: 'category', type: 'string' },
            { name: 'quantity', type: 'int' },
            { name: 'old_price', type: 'string' },
            { name: 'price', type: 'string' },
            { name: 'deliveryEstimatedCost', type: 'string' },
            { name: 'discount', type: 'int' },
            { name: 'totals', type: 'boolean' },
            { name: 'magic_discount', type: 'string' },
            { name: 'total_price', type: 'string' },
            { name: 'magic_price', type: 'string' }
        ]
    }
});