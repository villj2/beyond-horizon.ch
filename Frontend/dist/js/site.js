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

function setFilterButtonsActive(active) {

    $('#list-countries button').each(function(e, target){

        if(active)
        {
            $(target).removeAttr('disabled');
        }
        else
        {
            $(target).attr('disabled', 'disabled');
        }

    });
}

var initDelay = 0;
var initTimeoutId;
function initUniteGalleryByClass(gallerySelector) {

    console.log("[" + new Date().getTime() + "] gallerySelector: " + gallerySelector);

    var galleryAmount = $(gallerySelector).length;
    var timeInitGallery = initDelay;

    // calculate initDelay for next gallery
    initDelay = initDelay + (galleryAmount * 100);

    var loopCount = 0;
    
    $(gallerySelector).each(function(e, target) {

        loopCount++;

        setTimeout(function(){

            //console.log("[" + new Date().getTime() + "] init gallery: " + $(target).attr('id'));

            // Init gallery here
            initUniteGallery('#' + $(target).attr('id'), true, loopCount == galleryAmount);

        }, timeInitGallery);

        timeInitGallery += 100;
    });

    // Sobald hier alles initialisiert wurde, einfach replaceImagesInInitializedGallery() aufrufen! SO VERDAMMT SIMPEL!
    console.log("[" + new Date().getTime() + "] new initDelay: " + initDelay);
    clearTimeout(initTimeoutId);
    initTimeoutId = setTimeout(function(e){

        //console.log("[" + new Date().getTime() + "] NOW ;D");

        replaceImagesInInitializedGallery();

    }, initDelay + (galleryAmount * 100) + 100);
}

function initUniteGallery(gallerySelector, forGallery, replaceImages) {

    if ($(gallerySelector).attr('gallery-initialized') == 'true') return;
    if ($(gallerySelector).length <= 0) return;

    //console.log("[" + new Date().getTime() + "] initUniteGallery with selector: " + gallerySelector);

    $(gallerySelector).attr('gallery-initialized', 'true');

    var uniteApi = jQuery(gallerySelector).unitegallery({
        tiles_space_between_cols: 10,
        tiles_space_between_cols_mobile: 6,
        tiles_exact_width: false,
        tiles_include_padding: true,
        tiles_enable_transition: false,
        tiles_max_columns: 3
    });
}

function replaceImagesInInitializedGallery() {

    console.log("[" + new Date().getTime() + "] replaceImagesInInitializedGallery");

    $('.horizon-gallery').each(function(e, target){

        if($(target).attr('gallery-initialized') == 'true' && $(target).data('images-replaced') == false) {

            var imageSources = $(target).data('image-sources').split('|');

            $(target).find('img').each(function(e, targetimg){

                $(targetimg).attr('src', imageSources[e]);
            });

            $(target).attr('data-images-replaced', 'true');
        }
    });

    setFilterButtonsActive(true);
}

$(document).ready(function() {

    /* ------ Google Maps -------- */

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

    if ($('#map-overview').length) {
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

        //console.log("destination: " + destination);
        //console.log($('#' + destination).offset().top);

        tOffset = $('#' + destination).offset().top;

        $('html,body').animate({
            scrollTop: tOffset - 140
        }, 'slow');
    }

    $('map').imageMapResize();




    // -------- UNITE GALLERY START ---------

    // Initialize gallery in post
    if ($('body').data('initgallery')) {

    	var imageSources = initUniteGallery('#horizon-gallery-1');

        setTimeout(function(){

            replaceImagesInInitializedGallery();

        }, 100);
    }

    // -------- UNITE GALLERY END ---------




    // -------- MAP FILTER START ---------

    var continentsSelected = [];
    var countriesSelected = [];

    var selectedList = [];
    /* example: 
    [{"id":"oceania", "countries":["nz", "au"]}, {"id":"asia", "countries":["hk", "jp"]}]
    [{"id":"oceania", "countries":["nz"]}, {"id":"asia", "countries":["jp"]}]
    [{"id": "asia", "countries": ["hk"]}]
    */

    var continents = $('.continent');

    mapUpdate();
    listUpdate();
    postsUpdate();

    var ios = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
    if (ios) {
        $('a').on('click touchend', function() {
            var link = $(this).attr('href');
            window.open(link, '_blank');
            return false;
        });
    }

    $('path').on('click', function(e) {

        // Modify selectedList with continents
        mapUpdateSelectedList(e);

        mapUpdate();
        listUpdate();
        postsUpdate();

        return false;
    });

    $('#list-countries button').on('click', function(e) {

        if(!$(this).hasClass('active')) {
            setFilterButtonsActive(false);
        }

        // Modify selectedList with countries
        listUpdateSelectedList(e);

        listUpdate();
        postsUpdate();

        return false;
    });

    function mapUpdateSelectedList(e) {

        var continentId = $(e.target).attr('id');

        // Don't do anything if continent has no entries
        if (!$(e.target).hasClass('has-entries')) return;

        // Add or remove selected continent
        var indexForRemoving = -1;
        for (var i = 0; i < selectedList.length; i++) {
            var selectedObj = selectedList[i];

            // Selected continent already in list -> remove
            if (selectedObj.id == continentId) {
                indexForRemoving = i;
            }
        }

        if (indexForRemoving >= 0) {
            selectedList.splice(indexForRemoving, 1);
        } else {
            selectedList.push({
                "id": continentId,
                "countries": []
            });
        }
    }

    function listUpdateSelectedList(e) {

        var continent = $(e.target).data("continent");
        var country = $(e.target).data("country");

        // Add or remove selected country
        for (var i = 0; i < selectedList.length; i++) {

            if (selectedList[i].id == continent) {

                // Add or remove selected country
                var indexForRemoving = -1;
                for (var j = 0; j < selectedList[i].countries.length; j++) {

                    // Selected continent already in list -> remove
                    if (selectedList[i].countries[j] == country) {
                        indexForRemoving = j;
                    }
                }

                if (indexForRemoving >= 0) {
                    selectedList[i].countries.splice(indexForRemoving, 1);
                } else {
                    selectedList[i].countries.push(country);
                }
            }
        }
    }

    function mapUpdate() {

        var mapContinents = $('#continent-map .continent');

        for (var i = 0; i < mapContinents.length; i++) {

            //console.log(mapContinents[i]);

            // Remove active state initially
            $(mapContinents[i]).removeClass('active');

            var continentId = $(mapContinents[i]).attr('id');

            // Add active state if in continentsSelected list
            for (var j = 0; j < selectedList.length; j++) {

                if (continentId == selectedList[j].id) {

                    //console.log("add active to: " + continentId);

                    $(mapContinents[i]).addClass('active');
                    break;
                }
            }
        }
    }

    function listUpdate() {

        //console.log("listUpdate");

        // initially hide all countries
        $('#list-countries').find('.list-country').each(function(e, target) {

            $(target).addClass('hide');
        });

        // show countries based on continents in selectedList
        for (var i = 0; i < selectedList.length; i++) {

            var continentId = selectedList[i].id;

            var entries = $('#list-countries').children('[id^="' + continentId + '"]');

            entries.each(function(e, target) {

                $(target).removeClass('hide');
            });
        }

        // set state of country based on country in selectedList
        var initGalleryAmount = 0;
        initDelay = 0;
        $('#list-countries .list-country').each(function(e, target) {

            var country = $(target).data('country');

            if (countryExistsInSelectedList(country)) {

                // init gallery here if initially blocked
                if (!$('body').data('initgallery')) {

                    // Check if already initialized
                    var gallery = $('.horizon-gallery-' + $(target).data('country'));

                    if($(gallery).attr('gallery-initialized') == "false") {

                        initGalleryAmount++;
                        initUniteGalleryByClass('.horizon-gallery-' + $(target).data('country'));
                    }
                }

                $(target).addClass('active');
            } else {

                $(target).removeClass('active');
            }

        });

        // Enable country list button if no galleries were initialized
        if(initGalleryAmount == 0) {
            setFilterButtonsActive(true);
        }
    }

    function postsUpdate() {

        $('#filtered-content .posts-country').each(function(e, target) {

            var continent = $(target).data('continent');
            var country = $(target).data('country');

            // Check if continent-goup should be active
            if (continentExistsInSelectedList(continent)) {

                $("#posts-" + continent).removeClass('hide');

                if (countryExistsInSelectedList(country)) {

                    postsShowByCountry(country);
                } else {
                    // Hide country
                    $("#posts-" + country).addClass('hide');
                }
            } else {
                // Hide continent section
                $("#posts-" + continent).addClass('hide');
            }

        });

        //console.log(selectedList);
    }

    function postsShowByCountry(country) {

        // Show country posts
        $("#posts-" + country).removeClass('hide');

        // Load pictures for posts preview
        $("#posts-" + country + " .posts-entry").each(function(e, target) {
            var post = $(target);

            post.children('img').each(function(e, target) {
                var img = $(target);
                img.attr('src', img.data('src'));
            });
        });

        //console.log("load pictures for gallery");

        // Load pictures for gallery - use this code if replacing img-src still fails. This works, but with wrong ordering.
        /*$(".horizon-gallery-" + country + " img").each(function(e, target) {

            var img = $(target);
            img.attr('src', img.data('src'));
        });*/

    }

    function continentExistsInSelectedList(continent) {

        for (var i = 0; i < selectedList.length; i++) {

            if (selectedList[i].id == continent && selectedList[i].countries.length > 0) {
                return true;
            }
        }

        return false;
    }

    function countryExistsInSelectedList(country) {

        for (var i = 0; i < selectedList.length; i++) {

            for (var j = 0; j < selectedList[i].countries.length; j++) {

                if (selectedList[i].countries[j] == country) {

                    return true;
                }
            }
        }

        return false;
    }

    // -------- MAP FILTER END ---------
});

// ----------------- Doc Ready END ------------------