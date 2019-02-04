<?php

	pages::$methods['posts'] = function($pages, $includePicsOnly = false) {

		if($includePicsOnly)
		{
			return $pages->visible()->filterBy('template', 'post');
		}
		else
		{
			return $pages->visible()->filterBy('template', 'post')->filterBy('picsonly', '!=', '1');
		}

	};

?>