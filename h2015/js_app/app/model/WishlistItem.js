Ext.define('XMobile.model.WishlistItem', {
    extend: 'Ext.data.Model',
    alias: 'widget.wishlistitem',
    config: {
        idProperty: 'id',
        fields: [
            { name: 'id', type: 'int' },
            { name: 'name', type: 'string' },
            { name: 'order', type: 'int' },
            { name: 'purchase_period', type: 'string' }
        ]
    }
});