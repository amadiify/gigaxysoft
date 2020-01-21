require.config({
    shim: {
        'datatables': ['jquery','core'],
    },
    paths: {
        'datatables': phpvars.assetPath + 'plugins/datatables/datatables.min',
    }
});