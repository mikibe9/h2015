Ext.define('XMobile.model.Filter', {
    extend: 'Ext.data.Model',
    alias: 'widget.filter',
    config: {
        idProperty: 'id',
        fields: [
            { name: 'id', type: 'int' },
            { name: 'name', type: 'string' }
        ]
    }
});