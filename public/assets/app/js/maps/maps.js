var maps = function () {
var mapa;

    var crearMapa = function () {
        //Se crea una capa de tipo Raster(osm significa que el provedor es OpenStreetMaster)
        var capa_osm = new ol.layer.Tile({
            title: "OSM",
            name: "osm",
            type: 'base',
            visible: true,
            source: new ol.source.OSM()
        });

      mapa = new ol.Map({
            target: 'map',
            crossOriginKeyword: null,
            layers: [new ol.layer.Group({
                'title': 'Base maps',
                layers: [capa_osm]
            }),
            ],
            view: new ol.View({
                center: ol.proj.transform([-99.41, 25], 'EPSG:4326', 'EPSG:3857'),
                zoom: 5
            })
        });
        mapa.addControl(new ol.control.ZoomSlider());//Añadiendo una barra de desplazamiento al zoom
    }

	var cargarEscuelas = function () {
       
        var source = new ol.source.Vector({
            loader: function(extent, resolution, projection) {
                var url = Routing.generate('maps_index');
                $.ajax(url).then(function(response) {
                    var format = new ol.format.GeoJSON();
                    var features = format.readFeatures(response,
                        {featureProjection: projection});
                    source.addFeatures(features);
                });
            },
            strategy: ol.loadingstrategy.bbox
        });

        var geojson_vectorLayer = new ol.layer.Vector({
            source: source,
        });
		mapa.addLayer(geojson_vectorLayer);
    }
    
    var cargarColonias = function () {
       
        var source = new ol.source.Vector({
            loader: function(extent, resolution, projection) {
                var url = Routing.generate('maps_colonias');
                $.ajax(url).then(function(response) {
                    var format = new ol.format.GeoJSON();
                    var features = format.readFeatures(response,
                        {featureProjection: projection});
                    source.addFeatures(features);
                });
            },
            strategy: ol.loadingstrategy.bbox
        });

        var geojson_vectorLayer = new ol.layer.Vector({
            source: source,
        });
		mapa.addLayer(geojson_vectorLayer);
    }

	var cargarCalles = function () {
       
        var source = new ol.source.Vector({
            loader: function(extent, resolution, projection) {
                var url = Routing.generate('maps_calles');
                $.ajax(url).then(function(response) {
                    var format = new ol.format.GeoJSON();
                    var features = format.readFeatures(response,
                        {featureProjection: projection});
                    source.addFeatures(features);
                });
            },
            strategy: ol.loadingstrategy.bbox
        });

        var geojson_vectorLayer = new ol.layer.Vector({
            source: source,
        });
		mapa.addLayer(geojson_vectorLayer);
    }
    
    return {
        init: function () {
            $().ready(function () {
                    crearMapa();
                 /* cargarEscuelas();
                      cargarColonias();
                    cargarCalles();*/
                }
            );
        }
    }
}();
