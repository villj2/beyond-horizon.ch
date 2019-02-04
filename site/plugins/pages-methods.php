<?php

	pages::$methods['posts'] = function($pages) {
	    return $pages->visible()->filterBy('picsonly', '!=', '1');
	};

?>