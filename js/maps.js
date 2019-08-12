function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
      mapTypeControl: false,
      center: {lat: 19.7515, lng: 75.7139},
      zoom: 7
    });
  
    new AutocompleteDirectionsHandler(map);
  }
  
  /**
   * @constructor
   */
  function AutocompleteDirectionsHandler(map) {
    this.map = map;
    this.originPlaceId = null;
    this.destinationPlaceId = null;
    this.travelMode = 'DRIVING';
    this.directionsService = new google.maps.DirectionsService;
    this.directionsDisplay = new google.maps.DirectionsRenderer;
    this.directionsDisplay.setMap(map);
  
    var originInput = document.getElementById('origin-input');
    var destinationInput = document.getElementById('destination-input');
    var modeSelector = document.getElementById('mode-selector');
  
    var originAutocomplete = new google.maps.places.Autocomplete(originInput);
    // Specify just the place data fields that you need.
    originAutocomplete.setFields(['place_id']);
  
    var destinationAutocomplete =
        new google.maps.places.Autocomplete(destinationInput);
    // Specify just the place data fields that you need.
    destinationAutocomplete.setFields(['place_id']);
  
    // this.setupClickListener('changemode-walking', 'WALKING');
    // this.setupClickListener('changemode-transit', 'TRANSIT');
    // this.setupClickListener('changemode-driving', 'DRIVING');
  
    this.setupPlaceChangedListener(originAutocomplete, 'ORIG');
    this.setupPlaceChangedListener(destinationAutocomplete, 'DEST');
  
    this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(originInput);
    this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(
        destinationInput);
    this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(modeSelector);
  }
  
  // Sets a listener on a radio button to change the filter type on Places
  // Autocomplete.
  AutocompleteDirectionsHandler.prototype.setupClickListener = function(
      id, mode) {
    var radioButton = document.getElementById(id);
    var me = this;
  
    // radioButton.addEventListener('click', function() {
    //   me.travelMode = mode;
    //   me.route();
    // });
  };
  
  AutocompleteDirectionsHandler.prototype.setupPlaceChangedListener = function(
      autocomplete, mode) {
    var me = this;
    autocomplete.bindTo('bounds', this.map);
  
    autocomplete.addListener('place_changed', function() {
      var place = autocomplete.getPlace();
  
      if (!place.place_id) {
        window.alert('Please select an option from the dropdown list.');
        return;
      }
      if (mode === 'ORIG') {
        me.originPlaceId = place.place_id;
      } else {
        me.destinationPlaceId = place.place_id;
      }
      me.route();
    });
  };
  
  AutocompleteDirectionsHandler.prototype.route = function() {
    if (!this.originPlaceId || !this.destinationPlaceId) {
      return;
    }
    var me = this;
  
    this.directionsService.route(
        {
          origin: {'placeId': this.originPlaceId},
          destination: {'placeId': this.destinationPlaceId},
          travelMode: this.travelMode,
          
        },
        function(response, status) {
          if (status === 'OK') {
            me.directionsDisplay.setDirections(response);
            console.log(response);
            document.getElementById('distance').value = response.routes[0].legs[0].distance.text;
            document.getElementById('time').value = response.routes[0].legs[0].duration.text;
            nums = response.routes[0].legs[0].duration.text.split(" ");
            
            var d = new Date();
            document.getElementById('date').value = d;
            
            if (nums[1]==='hour')
            { 
              minutes = parseInt(nums[0]) * 60 + parseInt(nums[2]);
              var a = new Date(d.getTime() + minutes*60000);
            }
            else{
              minutes = parseInt(nums[0]) * 1440 + parseInt(nums[2]) * 60;
              var a = new Date(d.getTime() + minutes*60000);
            }
            
            document.getElementById('adate').value = a;
          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });
  };


  