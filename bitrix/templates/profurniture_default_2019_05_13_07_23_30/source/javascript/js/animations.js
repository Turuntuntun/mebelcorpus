function rsGoProWavesAttach() {
    // buttons
    Waves.attach('.btn-primary', null);
    Waves.attach('.btn-default', null);
    // search
    Waves.attach('.js-search-btn', null);
    Waves.attach('.js-show-search-bar', null);
    // menu and dropdown
    Waves.attach('.dropdown-toggle', null);
    Waves.attach('.dropdown-menu > li > a', null);
    Waves.attach('.dropdown > .other-link', null);
    Waves.attach('.menu-sidebar a', null);
    // sorter
    Waves.attach('.b-sorter__dropdown-in > .js-sorter__a', null);
    Waves.attach('.b-sorter__template > .js-sorter__a', null);
    // fly header menu button
    Waves.attach('.js-fly-menu', null);
    // personal menu
    Waves.attach('.pmenu a', null);
    // inbasket
    Waves.attach('.js-inbasket', null);
    // quantity
    Waves.attach('.js-minus', null);
    Waves.attach('.js-plus', null);
    // smart filter
    // Waves.attach('.filtren .showchild', null);
    // easycart tabs
    // Waves.attach('.rs_easycart .rsec_orlink', null);
}

$(document).on('rsGoPro.document.ready', function(){

    Waves.init();
    rsGoProWavesAttach();

});
