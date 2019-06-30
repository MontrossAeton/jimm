
$(document).ready(function() {
    var map, infoWindow;
    var map = new google.maps.Map(document.getElementById('map'), {
     zoom: 7,
     gestureHandling: 'cooperative'
    });
    infoWindow = new google.maps.InfoWindow;
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
        var pos = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };

        infoWindow.setPosition(pos);
        infoWindow.setContent('Location found.');
        infoWindow.open(map);
        map.setCenter(pos);
      }, function() {
        handleLocationError(true, infoWindow, map.getCenter());
      });
    } else {
      // Browser doesn't support Geolocation
      handleLocationError(false, infoWindow, map.getCenter());
    }

    $('.search-list-input').on('input', _.debounce(function(){
        axios.post('/maps/search', {
            search: $(this).val()
        })
        .then(res => {
            $('.map-list-container').empty()
            _.map(res.data, function(value) {
                $('.map-list-container').append(
                    `<div data-lat=${value.lat} data-long=${value.long} class="map-search-row">
                       ${value.name} 
                    </div>`
                )
            })
            $('.map-search-row').on('click', function() {
                let lat = $(this).data('lat')
                let long = $(this).data('long')
                map.setCenter(new google.maps.LatLng(lat, long));
                map.setZoom(14);
            })
        }).catch(err => {
            console.dir(err)
        })  
    }, 500));


    const initMap = function(locations) {

       var bounds = new google.maps.LatLngBounds();

       $.each( locations, function( index, value ){

           var point = new google.maps.LatLng(parseFloat(value.lat),parseFloat(value.long));
           bounds.extend(point)

            var marker = new google.maps.Marker({
                position: point,
                map: map,
                animation: google.maps.Animation.DROP,
            });
            
            var infoWindow = new google.maps.InfoWindow({
                content: `
                    <div>
                        <h1>${value.name}</h1><br/>
                        <a href="/gyms/${value.id}" target="_blank">Click me to check profile</a>!
                    </div>`
            });

            const toggleBounce = function() {
                if (marker.getAnimation() !== null) {
                marker.setAnimation(null);
                } else {
                marker.setAnimation(google.maps.Animation.BOUNCE);
                }
            };

            marker.addListener('click', function() {
                map.setZoom(15);
                map.setCenter(marker.getPosition());
                infoWindow.open(map, marker);
                toggleBounce()
                console.log(map.getZoom())
            });
       });

       map.fitBounds(bounds)

    }

    const get_locations = function() {
        axios.get('/maps/getLocations')
        .then(res => {
            console.log(res)
            initMap(res.data)
        }).catch(err => {
            console.dir(err)
        })  
    }
    get_locations();

})
