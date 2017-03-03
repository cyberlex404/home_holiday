/**
 * Created by Lex on 02.03.2017.
 */


(function ($, Drupal, settings) {

    "use strict";

    var map;
    var objectManager;

    // console.log(SCMap);
    Drupal.behaviors.HomeHolidayMap = {
        attach: function (context, settings) {
            //  console.log(SCMap);

            $('div#contact-map', context).once('map-processed').each(function () {

                var mapId = this.id;

                console.log(mapId);

                var mapCenter = settings.home_holiday.home;
                var jsonFC = settings.home_holiday.json;

                if (!mapId) {
                    mapId = this.id = 'contact-map';
                }



                ymaps.ready(function () {

                    var mapState = {
                        center: mapCenter,
                        zoom: 10,
                        controls: ['smallMapDefaultSet']
                    };

                    var map = new ymaps.Map(mapId, mapState);
                    map.mapId = mapId;

                    map.behaviors.disable('scrollZoom');


                    objectManager = new ymaps.ObjectManager({
                        // Чтобы метки начали кластеризоваться, выставляем опцию.
                        clusterize: true,
                        // ObjectManager принимает те же опции, что и кластеризатор.
                        gridSize: 32
                    });



                    //objectManager.objects.options.set('preset', 'islands#redGlyphIcon');
                    //objectManager.objects.options.set('iconGlyph', 'flag');
                    //objectManager.objects.options.set('iconGlyphColor', 'red');
                    //objectManager.clusters.options.set('preset', 'islands#redClusterIcons');
                    objectManager.add(jsonFC);
                    map.geoObjects.add(objectManager);

                    map.geoObjects.add(new ymaps.Placemark(settings.home_holiday.home, {
                        balloonContent: 'Усадьба'
                    }, {
                        preset: 'islands#glyphIcon',
                        iconGlyph: 'home',
                        iconGlyphColor: 'blue'
                    }))

                });

            });

        }
    };


})(jQuery, Drupal, drupalSettings);