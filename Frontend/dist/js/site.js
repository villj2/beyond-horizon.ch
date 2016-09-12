$( document ).ready(function() {
  
	if($('.grid').length){

		$('.grid').masonry({
		  // set itemSelector so .grid-sizer is not used in layout
		  itemSelector: '.grid-item',
		  // use element for option
		  columnWidth: '.grid-sizer',
		  percentPosition: true
		});

		masonryInitCount = 0;

		var masonryIntervalId = setInterval(function(){

			$('.grid').masonry({
			  // set itemSelector so .grid-sizer is not used in layout
			  itemSelector: '.grid-item',
			  // use element for option
			  columnWidth: '.grid-sizer',
			  percentPosition: true
			})

			if(masonryInitCount++ >= 3){

				clearInterval(masonryIntervalId);
			}

		}, 500);
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
	    zoom: 3,
	    mapTypeControl: false
	  });

	  google.maps.event.addListener(map, "click", function(event) {

		    var lat = event.latLng.lat();
		    var lng = event.latLng.lng();
		    var center = map.getCenter();
		    
		    console.log("lat: " + lat + ", lng: " + lng + ", zoom: " + map.getZoom() + ", center: " + center);
		});

	  	// Read JSON
	  	var jsonString = $('#container-map-posts').data('pins');
	  	var markers = [];
	  	var infobubbles = [];

	  	for(var i = 0; i < jsonString.length; i++) {

	  		//console.log(jsonString[i].title);

	  		/* Marker */
	  		markers.push(new google.maps.Marker({
			    map: map,
			    position: {lat: parseFloat(jsonString[i].lat), lng: parseFloat(jsonString[i].lng)},
			    title: jsonString[i].title,
	          	//icon: new google.maps.MarkerImage('/Frontend/img/location-pin.svg', null, null, null, new google.maps.Size(32,32)),
	          	icon: new google.maps.MarkerImage('/Frontend/img/location-pin.png', null, null, null, new google.maps.Size(32,32)),
	          	leWildIndex: i
			  }));

	  		/* Infobubbles */
	  		infobubbles.push(new InfoBubble({
	          maxWidth: 300,
	          maxHeight: 220,
	          content: '<div class="infobubble" style="overflow: hidden;"><a href="' + jsonString[i].url + '" target="_self"><img src="' + jsonString[i].img + '" /><h2>' + jsonString[i].title + '</h2><p>' + jsonString[i].date + '</p></div></a>',
	          padding: 0,
	          backgroundColor: 'rgb(230,230,230)',
	          borderRadius: 0,
	          arrowSize: 10,
	          borderWidth: 0,
	          borderColor: '#2c2c2c',
	          closeSrc: '/Frontend/img/maps_infowindow_close.png',
	          arrowStyle: 0,
	          leWildIndex: i
	        }));

	        google.maps.event.addListener(markers[i], 'click', function(e) {

	        	for(var i = 0; i < infobubbles.length; i++){
	        		infobubbles[i].close();
	        	}

	        	var bubble = infobubbles[this.leWildIndex];

	          	if (!bubble.isOpen()) {
	            	bubble.open(map, markers[this.leWildIndex]);
	          	}
        	});
	  	}

	  	// Open last infobubble initially
	  	infobubbles[infobubbles.length - 1].open(map, markers[markers.length -1]);
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

	//console.log("hihi: " + $.inArray("scrollto", getUrlVars()));

	// Smooth scrolling posts
	if($.inArray("scrollto", getUrlVars()) >= 0){
		
		var destination = getUrlVars()["scrollto"];

		//console.log("destination: " + destination);
		//console.log($('#' + destination).offset().top);

		tOffset = $('#' + destination).offset().top;

		$('html,body').animate({scrollTop:tOffset-140},'slow');
	}

	$('map').imageMapResize();
});

function getUrlVars()
{
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}