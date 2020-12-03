<html>
<head>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css" />
</head>
<body style="margin: 0">
<div id="map" style="width: 100vw; height: 100vh"></div>
<script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/geojson/0.5.0/geojson.min.js"></script>
<script>
    const start = async () => {
        const tiles = "https://1.base.maps.api.here.com/maptile/2.1/maptile/newest/normal.day/{z}/{x}/{y}/512/png8?app_id={appId}&app_code={appCode}";
        const map = new L.Map("map", {
            center: [37, -121],
            zoom: 11,
            layers: [L.tileLayer(tiles, { appId: "HERE_APP_ID", appCode: "HERE_APP_CODE" })]
        });
        var polyline, sourceMarker, destinationMarker;
        setInterval(async () => {
            const response = await axios({
                method: "GET",
                url: "https://xyz.api.here.com/hub/spaces/" + "HERE_XYZ_SPACE_ID" + "/search",
                params: {
                    access_token: "HERE_XYZ_TOKEN"
                }
            });
            map.eachLayer(layer => {
                if(!layer._url) {
                    layer.remove();
                }
            });
            const polylineData = [];
            response.data.features.forEach(feature => {
                let position = feature.geometry.coordinates;
                polylineData.push({ lat: position[1], lng: position[0] });
            });
            polyline = new L.Polyline(polylineData, { weight: 5 });
            sourceMarker = new L.Marker(polylineData[0]);
            destinationMarker = new L.Marker(polylineData[polylineData.length - 1]);
            polyline.addTo(map);
            sourceMarker.addTo(map);
            destinationMarker.addTo(map);
            const bounds = new L.LatLngBounds(polylineData);
            map.fitBounds(bounds);
        }, 5000);
    }
    start();
</script>
</body>
</html>