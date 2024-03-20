<!DOCTYPE html>
<html>
<head>
    <title>Stadium Locations</title>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcxKPC1GOrBYFD4sFadBbrXU_2Zu00D7U&callback=initMap" async defer></script>
    <script>
        let map;

        function initMap() {
            // Initialize map
            map = new google.maps.Map(document.getElementById("map"), {
                center: { lat: 41.21782701971226, lng: 32.6489063395231 },
                zoom: 12, // Adjust zoom level as needed
            });

            // Get stadium data from your API endpoint
            fetch('http://localhost:9005/api/v1/location/search')
                .then(response => response.json())
                .then(data => {
                    console.log(data)
                    // Add markers for each stadium
                    data.forEach(stadium => {
                        const marker = new google.maps.Marker({
                            position: { lat: stadium.latitude, lng: stadium.longitude },
                            map: map,
                            title: stadium.name,
                        });
                    });
                });
        }
    </script>
    <style>
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
</head>
<body>
<h1>Stadium Locations</h1>
<div id="map"></div>
</body>
</html>
