requirejs.config({
    //By default load any module IDs from js/lib
    baseUrl: 'js/lib',
    //except, if the module ID starts with "app",
    //load it from the js/app directory. paths
    //config is relative to the baseUrl, and
    //never includes a ".js" extension since
    //the paths config could be for a directory.
    paths: {
        bootstrap: '../../bootstrap/js/bootstrap',
        topnav:    '../../modules/topnav/topnav',
        heroBase:  '../../modules/hero/hero.base',
        heroTouch: '../../modules/hero/hero.touch',
        pod:       '../../modules/pod/pod',
        gallery:   '../../modules/gallery/gallery',
        bottomnav: '../../modules/bottomnav/bottomnav'
    },

    // Use shim for plugins that does not support ADM
    shim: {
        'bootstrap': ['jquery'], //(Modernizr.mq('only all')) ? ['jquery'] : ['jquery', 'css3-mediaqueries'],
        'jquery.event.move': ['jquery'],
        'jquery.event.swipe': ['jquery.event.move']
    }
});

// Start the main app logic.
if (Modernizr.touch) {
    requirejs(['topnav', 'heroTouch', 'pod', 'gallery', 'bottomnav']);
} else {
    requirejs(['topnav', 'heroBase', 'pod', 'gallery', 'bottomnav']);
}