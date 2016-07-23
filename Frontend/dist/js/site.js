$( document ).ready(function() {
  
	if($('.grid').length){

		$('.grid').masonry({
		  // set itemSelector so .grid-sizer is not used in layout
		  itemSelector: '.grid-item',
		  // use element for option
		  columnWidth: '.grid-sizer',
		  percentPosition: true
		})
	}

	/* ------ Google Maps -------- */

	var styleArray = [
	  {
	    "featureType": "water",
	    "stylers": [
	      { "color": "#ffffff" }
	    ]
	  },{
	    "featureType": "landscape.natural.landcover",
	    "stylers": [
	      { "color": "#c0c0c0" }
	    ]
	  },{
	    "featureType": "landscape.natural.terrain",
	    "stylers": [
	      { "color": "#c0c0c0" }
	    ]
	  },{
	    "featureType": "administrative",
	    "elementType": "labels.text",
	    "stylers": [
	      { "color": "#c0c0c0" },
	      { "visibility": "off" }
	    ]
	  },{
	    "elementType": "labels.icon",
	    "stylers": [
	      { "visibility": "off" }
	    ]
	  },{
	    "featureType": "landscape.natural.terrain",
	    "stylers": [
	      { "color": "#c0c0c0" }
	    ]
	  },{
	    "featureType": "landscape",
	    "stylers": [
	      { "color": "#c0c0c0" }
	    ]
	  },{
	    "featureType": "poi",
	    "stylers": [
	      { "color": "#c0c0c0" }
	    ]
	  },{
	    "featureType": "road",
	    "stylers": [
	      { "visibility": "off" }
	    ]
	  },{
	    "featureType": "administrative",
	    "stylers": [
	      { "color": "#ffffff" }
	    ]
	  },{
	    "featureType": "water",
	    "elementType": "labels.text",
	    "stylers": [
	      { "visibility": "off" }
	    ]
	  },{
	    "featureType": "landscape",
	    "elementType": "labels.text",
	    "stylers": [
	      { "visibility": "off" }
	    ]
	  },{
	    "elementType": "labels.text",
	    "stylers": [
	      { "visibility": "off" }
	    ]
	  },{
	    "featureType": "administrative.country",
	    "elementType": "labels.text.stroke",
	    "stylers": [
	      { "visibility": "on" },
	      { "color": "#777777" }
	    ]
	  },{
	    "featureType": "administrative.province",
	    "elementType": "labels.text.stroke",
	    "stylers": [
	      { "visibility": "on" },
	      { "color": "#777777" }
	    ]
	  },{
	    "featureType": "administrative.locality",
	    "elementType": "labels",
	    "stylers": [
	      { "color": "#777777" },
	      { "visibility": "simplified" }
	    ]
	  },{
	    "featureType": "transit.line",
	    "stylers": [
	      { "visibility": "off" }
	    ]
	  },{
	  }
	];

	function initMap() {
	  // Create a map object and specify the DOM element for display.
	  var map = new google.maps.Map(document.getElementById('map-overview'), {
	    /*center: {lat: 5.9657536710655235, lng: 84.7265625},*/
	    center: {lat: 3.513421045640057, lng: 116.71875},
	    scrollwheel: true,
	    styles: styleArray,
	    zoom: 3
	  });

	  google.maps.event.addListener(map, "click", function(event) {

		    var lat = event.latLng.lat();
		    var lng = event.latLng.lng();
		    var center = map.getCenter();
		    
		    console.log("lat: " + lat + ", lng: " + lng + ", zoom: " + map.getZoom() + ", center: " + center);
		});

	  	/* Marker */
	  	var myLatLng = {lat: 34.043556504127444, lng: 135.8514404296875};
	  	var marker = new google.maps.Marker({
		    map: map,
		    position: myLatLng,
		    title: 'Totoro!',
          	icon: new google.maps.MarkerImage('../img/location-pin.svg', null, null, null, new google.maps.Size(32,32)),
		  });

	  	var marker2 = new google.maps.Marker({
		    map: map,
		    position: {lat: -16.909683615558635, lng: 145.755615234375},
		    title: 'Totoro! 2',
          	icon: new google.maps.MarkerImage('../img/location-pin.svg', null, null, null, new google.maps.Size(32,32)),
		  });

	  	/* Window */
	  	/*var contentString = '<div class="map-custom-window">'+
	      '<img src="../img/cangs.jpg" />'
	      '</div>';
	  	var infowindow = new google.maps.InfoWindow({
		    content: contentString
		  });
	  	marker.addListener('click', function() {
		    infowindow.open(map, marker);
		  });*/

	  	var infoBubble = new InfoBubble({
          maxWidth: 300,
          content: '<div id="content" style="overflow: hidden;"><a href="http://www.google.ch/" target="_self"><img src="../img/cangs.jpg" /><h2>Very Schatzi</h2></div></a>',
          padding: 0,
          backgroundColor: 'rgb(230,230,230)',
          borderRadius: 0,
          arrowSize: 10,
          borderWidth: 0,
          borderColor: '#2c2c2c',
          closeSrc: '../img/maps_infowindow_close.png',
          arrowStyle: 0
        });

        var infoBubble2 = new InfoBubble({
          maxWidth: 300,
          content: '<div id="content" style="overflow: hidden;"><a href="" target="_self"><img src="../img/somesyds.jpg" /><h2>Very Schatzi syds</h2></div></a>',
          padding: 0,
          backgroundColor: 'rgb(230,230,230)',
          borderRadius: 0,
          arrowSize: 10,
          borderWidth: 0,
          borderColor: '#2c2c2c',
          closeSrc: '../img/maps_infowindow_close.png',
          arrowStyle: 0
        });

        google.maps.event.addListener(marker, 'click', function() {
          if (!infoBubble.isOpen()) {
            infoBubble.open(map, marker);
          }
        });

        google.maps.event.addListener(marker2, 'click', function() {
          if (!infoBubble2.isOpen()) {
            infoBubble2.open(map, marker2);
          }
        });
	}

	if($('#map-overview').length){
		initMap();
	}

	$(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) {
	    event.preventDefault();

	    var options = {
	    	left_arrow_class: 'glyphicon glyphicon-menu-left',
	    	right_arrow_class: 'glyphicon glyphicon-menu-right'
	    }

	    $(this).ekkoLightbox();
	}); 

	//Check to see if the window is top if not then display button
	$(window).scroll(function(){
		if ($(this).scrollTop() > 500) {
			$('.scrollToTop').fadeIn();
		} else {
			$('.scrollToTop').fadeOut();
		}
	});
	
	//Click event to scroll to top
	$('.scrollToTop').click(function(){
		$('html, body').animate({scrollTop : 0},500);
		return false;
	});

	// Smooth scrolling a-tags
	// FIXME conflict with scroll to top button
	/*$('a[href^=#]').on("click",function(e){
	    var t= $(this.hash);
	    var t=t.length&&t||$('[name='+this.hash.slice(1)+']');
	    if(t.length){
	        var tOffset=t.offset().top;
	        $('html,body').animate({scrollTop:tOffset-140},'slow');
	        e.preventDefault();
	    }
	});*/

	// Smooth scrolling area-tags
	$('area[href^=#]').on("click",function(e){
	    var t= $(this.hash);
	    var t=t.length&&t||$('[name='+this.hash.slice(1)+']');
	    if(t.length){
	        var tOffset=t.offset().top;
	        $('html,body').animate({scrollTop:tOffset-140},'slow');
	        e.preventDefault();
	    }
	});

	$('map').imageMapResize();

});