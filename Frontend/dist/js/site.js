/******** GENERAL HELPER FUNCTIONS ********/

function getUrlVars() {
    var vars = [],
        hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for (var i = 0; i < hashes.length; i++) {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}

Array.prototype.contains = function(element) {
    for (i in this) {
        if (this[i] === element) return true;
    }
    return false;
}

function removeFromArray(array, input) {
    return array = jQuery.grep(array, function(value) {
        return value != input;
    });
}

function qs(key) {
    key = key.replace(/[*+?^$.\[\]{}()|\\\/]/g, "\\$&"); // escape RegEx meta chars
    var match = location.search.match(new RegExp("[?&]"+key+"=([^&]+)(&|$)"));
    return match && decodeURIComponent(match[1].replace(/\+/g, " "));
}

function updateQueryStringParameter(uri, key, value) {
  var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
  var separator = uri.indexOf('?') !== -1 ? "&" : "?";
  if (uri.match(re)) {
    return uri.replace(re, '$1' + key + "=" + value + '$2');
  }
  else {
    return uri + separator + key + "=" + value;
  }
}

/******** GOOGLE MAPS ********/

var styleArray = [{
    "featureType": "water",
    "stylers": [{
        "color": "#ffffff"
    }]
}, {
    "featureType": "landscape.natural.landcover",
    "stylers": [{
        "color": "#c0c0c0"
    }]
}, {
    "featureType": "landscape.natural.terrain",
    "stylers": [{
        "color": "#c0c0c0"
    }]
}, {
    "featureType": "administrative",
    "elementType": "labels.text",
    "stylers": [{
            "color": "#c0c0c0"
        },
        {
            "visibility": "off"
        }
    ]
}, {
    "elementType": "labels.icon",
    "stylers": [{
        "visibility": "off"
    }]
}, {
    "featureType": "landscape.natural.terrain",
    "stylers": [{
        "color": "#c0c0c0"
    }]
}, {
    "featureType": "landscape",
    "stylers": [{
        "color": "#c0c0c0"
    }]
}, {
    "featureType": "poi",
    "stylers": [{
        "color": "#c0c0c0"
    }]
}, {
    "featureType": "road",
    "stylers": [{
        "visibility": "off"
    }]
}, {
    "featureType": "administrative",
    "stylers": [{
        "color": "#ffffff"
    }]
}, {
    "featureType": "water",
    "elementType": "labels.text",
    "stylers": [{
        "visibility": "off"
    }]
}, {
    "featureType": "landscape",
    "elementType": "labels.text",
    "stylers": [{
        "visibility": "off"
    }]
}, {
    "elementType": "labels.text",
    "stylers": [{
        "visibility": "off"
    }]
}, {
    "featureType": "administrative.country",
    "elementType": "labels.text.stroke",
    "stylers": [{
            "visibility": "on"
        },
        {
            "color": "#777777"
        }
    ]
}, {
    "featureType": "administrative.province",
    "elementType": "labels.text.stroke",
    "stylers": [{
            "visibility": "on"
        },
        {
            "color": "#777777"
        }
    ]
}, {
    "featureType": "administrative.locality",
    "elementType": "labels",
    "stylers": [{
            "color": "#777777"
        },
        {
            "visibility": "simplified"
        }
    ]
}, {
    "featureType": "transit.line",
    "stylers": [{
        "visibility": "off"
    }]
}, {}];

function initMap() {

    // Create a map object and specify the DOM element for display.
    var map = new google.maps.Map(document.getElementById('map-overview'), {
        /*center: {lat: 5.9657536710655235, lng: 84.7265625},*/
        center: {
            lat: 3.513421045640057,
            lng: 116.71875
        },
        scrollwheel: true,
        styles: styleArray,
        zoom: 4,
        mapTypeControl: false,
        minZoom: 3
    });

    mapOnResize();

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

    for (var i = 0; i < jsonString.length; i++) {

        //console.log(jsonString[i].title);

        /* Marker */
        markers.push(new google.maps.Marker({
            map: map,
            position: {
                lat: parseFloat(jsonString[i].lat),
                lng: parseFloat(jsonString[i].lng)
            },
            title: jsonString[i].title,
            //icon: new google.maps.MarkerImage('/Frontend/img/location-pin.svg', null, null, null, new google.maps.Size(32,32)),
            icon: new google.maps.MarkerImage('/Frontend/img/location-pin.png', null, null, null, new google.maps.Size(32, 32)),
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

            for (var i = 0; i < infobubbles.length; i++) {
                infobubbles[i].close();
            }

            var bubble = infobubbles[this.leWildIndex];

            if (!bubble.isOpen()) {
                bubble.open(map, markers[this.leWildIndex]);
            }
        });
    }

    // Open last infobubble initially
    infobubbles[infobubbles.length - 1].open(map, markers[markers.length - 1]);
}

function mapOnResize() {
    $('#map-overview').height($(window).innerHeight() - $('nav').innerHeight());
}



/******** DOC READY ********/

$(document).ready(function() {

    // -------- GOOGLE MAPS ---------
    if ($('#map-overview').length) {
        initMap();
    }

    $(window).resize(function(e){
        mapOnResize();
    });

    // -------- SCROLL TO TOP ---------

    //Check to see if the window is top if not then display button
    $(window).scroll(function() {
        if ($(this).scrollTop() > 500) {
            $('.scrollToTop').fadeIn();
        } else {
            $('.scrollToTop').fadeOut();
        }
    });

    //Click event to scroll to top
    $('.scrollToTop').click(function() {
        $('html, body').animate({
            scrollTop: 0
        }, 500);
        return false;
    });

    // Smooth scrolling posts
    if ($.inArray("scrollto", getUrlVars()) >= 0) {

        var destination = getUrlVars()["scrollto"];

        tOffset = $('#' + destination).offset().top;

        $('html,body').animate({
            scrollTop: tOffset - 140
        }, 'slow');
    }

    // -------- GALLERY ---------

    $('path').on('click', function(e) {

        var target = $(e.currentTarget);

        if(target.hasClass('has-entries')) {

            window.location.href = target.data('url');
        }
    });

    var $grid = $('.grid').masonry({
        // options
        // set itemSelector so .grid-sizer is not used in layout
        itemSelector: '.grid-item',
        // use element for option
        columnWidth: '.grid-sizer',
        percentPosition: true,
        gutter: '.gutter-sizer',
    });

    $grid.imagesLoaded().progress( function() {
        $grid.masonry('layout');
    });

    $('[data-fancybox="images"]').fancybox({
        buttons : [
            'close'
        ],
    });
});