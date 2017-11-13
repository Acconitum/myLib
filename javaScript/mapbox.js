// first of all install mapbox.js with bower or npm
// second add a div with id map to your DOM (<div id="map" style="height: 200px;"></div>)
// needs styling for height!

(function($) {
	$map = $('#map');

        if ($map.length) {
            longitude = 7.45;
            latitude = 46.94;

            L.mapbox.accessToken = 'pk.eyJ1IjoiY3ViZXRlY2giLCJhIjoiNXNzUHdfbyJ9.tm-Kh0sz67FPbXgoKofkwQ';
            var map = L.mapbox.map('map', false, {
                zoomControl: false
            }).setView([latitude, longitude], 15); // view [lat, lng], zoom

            L.mapbox.styleLayer('mapbox://styles/cubetech/cj7ipv1pp5lkf2sozup0fycv9').addTo(map);

            // Disable drag and zoom handlers.
            map.dragging.disable();
            map.touchZoom.disable();
            map.doubleClickZoom.disable();
            map.scrollWheelZoom.disable();
            if (map.tap) {
                map.tap.disable();
            }

            var myLayer = L.mapbox.featureLayer().addTo(map);
            var markers = [];

            markers.push({
                type: 'Feature',
                geometry: {
                    type: 'Point',
                    coordinates: [longitude, latitude]
                },
            });

            myLayer.on('layeradd', function(e) {
                var marker = e.layer,
                    feature = marker.feature;

                /*marker.setIcon(
                    L.icon({
                        "iconUrl": urls.templateDir + "/dist/images/Icon_Map-01.svg",
                        "iconSize": [135, 55.5],
                        "iconAnchor": [67.5, 55.5],
                        "className": "dot"
                    })
                );*/
            });

            myLayer.setGeoJSON({
                type: 'FeatureCollection',
                features: markers
            });
        }
})(jQuery);