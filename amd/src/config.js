define([], function () {
    window.requirejs.config({
        paths: {
            'x3dom' : M.cfg.wwwroot + '/blocks/taskdisplay/js/x3dom.min'
        },
        shim: {
            'x3dom' : {exports: 'x3dom'}
        }
    });
});