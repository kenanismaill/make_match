<!DOCTYPE html>
<html>
<head>
    <title>Google Maps Autocomplete</title>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcxKPC1GOrBYFD4sFadBbrXU_2Zu00D7U&libraries=places"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <style>
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
</head>
<body>
<input id="autocomplete" placeholder="Enter your address" type="text"></input>
<div id="map"></div>

<script>
    function initMap() {
        const map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: -34.397, lng: 150.644 },
            zoom: 8,
        });

        const autocomplete = new google.maps.places.Autocomplete(
            document.getElementById("autocomplete")
        );

        autocomplete.addListener("place_changed", function() {
            const place = autocomplete.getPlace();
            const location = place.geometry.location;

            axios.get("http://localhost:9005/api/v1/autocomplete", {
                params: {
                    input: "stadium",
                    location: `${location.lat()},${location.lng()}`
                }
            })
                .then(response => {
                    const results = response.data.predictions;
                    console.log(results);

                    // Clear previous markers
                    markers.forEach(marker => {
                        marker.setMap(null);
                    });

                    // Add new markers for autocomplete results
                    results.forEach(result => {
                        const placeId = result.place_id;
                        const request = {
                            placeId: placeId,
                            fields: ['geometry', 'name']
                        };
                        const service = new google.maps.places.PlacesService(map);
                        service.getDetails(request, function(place, status) {
                            if (status === google.maps.places.PlacesServiceStatus.OK) {
                                const marker = new google.maps.Marker({
                                    map: map,
                                    position: place.geometry.location,
                                    title: place.name
                                });
                                markers.push(marker);
                            }
                        });
                    });
                })
                .catch(error => {
                    console.error("Error fetching autocomplete results:", error);
                });
        });

        const markers = [];
    }
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcxKPC1GOrBYFD4sFadBbrXU_2Zu00D7U&libraries=places&callback=initMap"></script>
</body>
</html>
