$( document ).ready(function() {
  
	/*if($('.grid').length){

		$('.grid').masonry({
		  // set itemSelector so .grid-sizer is not used in layout
		  itemSelector: '.grid-item',
		  // use element for option
		  columnWidth: '.grid-sizer',
		  percentPosition: true
		});

		masonryInitCount = 0;

		var masonryIntervalId = setInterval(function(){

			//console.log("init gallery");

			$('.grid').masonry({
			  // set itemSelector so .grid-sizer is not used in layout
			  itemSelector: '.grid-item',
			  // use element for option
			  columnWidth: '.grid-sizer',
			  percentPosition: true
			})

			if(masonryInitCount++ >= 100){

				clearInterval(masonryIntervalId);
			}

		}, 500);
	}*/

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
	    zoom: 4,
	    mapTypeControl: false,
	    minZoom: 3
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
	          maxWidth: 235,
	          maxHeight: jsonString[i].twolines == 1 ? 240 : 220,
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

	setTimeout(initUniteGallery, 100);
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

function initUniteGallery()
{
	// Unite gallery
	//console.log("init unite gallery");

	// Save all data-src info in array
	var imageSources = [];
	$('#horizon-gallery img').each(function(){

		imageSources.push($(this).data('src'));
    });

	//console.log(imageSources);

	var uniteApi = jQuery("#horizon-gallery").unitegallery({
		/*tiles_space_between_cols: 5,
		tiles_include_padding: false,
		tiles_min_columns: 2,
		tiles_max_columns: 4,
		tiles_align:"center",
		tiles_col_width: 250*/

		/*tiles_min_columns: 3,
		tiles_max_columns: 0,*/
		tiles_space_between_cols: 10,
		tiles_space_between_cols_mobile: 6,
		tiles_exact_width: false,
		tiles_include_padding: true,
		tiles_enable_transition: true
	});

	// Hide gallery during creation / arrangement
	//$('#horizon-gallery').css('visibility', 'hidden');

	$('#horizon-gallery img').each(function(){

		//console.log(this);
    	$(this).addClass("fillMePlz");
    });

	function isScrolledIntoView(elem)
	{
	    var docViewTop = $(window).scrollTop();
	    var docViewBottom = docViewTop + $(window).height();

	    var elemTop = $(elem).offset().top;
	    var elemBottom = elemTop + $(elem).height();

	    return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
	}

	function Utils() {}

	Utils.prototype = {
	    constructor: Utils,
	    isElementInView: function (element, fullyInView) {
	        var pageTop = $(window).scrollTop();
	        var pageBottom = pageTop + $(window).height();
	        var elementTop = $(element).offset().top;
	        var elementBottom = elementTop + $(element).height();

	        if (fullyInView === true) {
	            return ((pageTop < elementTop) && (pageBottom > elementBottom));
	        } else {
	            return ((elementTop <= pageBottom) && (elementBottom >= pageTop));
	        }
	    }
	};

	var Utils = new Utils();

	var okToLoad = true;

	$(window).scroll(function()
	{
		if(okToLoad){

			//console.log("okToLoad");

			okToLoad = false;
			setTimeout(function(){ okToLoad = true; }, 100);

			scrollReplaceImage(Utils, imageSources);

		}
	});

	setTimeout(function(){

		scrollReplaceImage(Utils, imageSources);

	}, 100);

	//scrollReplaceImage(Utils, imageSources);

	//window.dispatchEvent(new Event('resize'));
	//var uniteInitWidth = $('#horizon-gallery').width();

	// resize gallery in order to re-arange pictures. They are wrong initially.
	//uniteApi.resize(uniteInitWidth * 2);
	//uniteApi.resize(uniteInitWidth);

	//$('#horizon-gallery').width(200);

	/*setTimeout(function() {
		console.log("UniteInitWidth 2: " + uniteInitWidth);

		//uniteApi.resize(uniteInitWidth);
		//$('#horizon-gallery').width(uniteInitWidth);
		//window.dispatchEvent(new Event('resize'));
		//$('#horizon-gallery').css('visibility', 'visible');

	}, 1000);*/

	//$('#horizon-gallery').css('visibility', 'visible');
}

function scrollReplaceImage(Utils, imageSources)
{
	$('#horizon-gallery img.fillMePlz').each(function()
	{
		var isElementInView = Utils.isElementInView(this, false);

		if (isElementInView) {
		    //console.log('in view');
		    //console.log($(this).attr('src'));
		    $(this).removeClass('fillMePlz');

		    //console.log("image replaced");

		    // get index of img
		    //var parentEl = $(this).closest('ug-thumb-wrapper');
		    var index = $(this).parent().index();

		    // replace image
		    $(this).attr('src', imageSources[index]);

		} else {
		    //console.log('out of view');
		}
	})
}