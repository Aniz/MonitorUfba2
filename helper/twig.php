<?php

function twig($path) {
	$loader = new Twig_Loader_Filesystem($path);
	$twig = new Twig_Environment($loader);

	return $twig;
}