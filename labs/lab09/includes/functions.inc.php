<?php

function buildMenu() {
	$menu = array(
		'index' => 'actors',
		'movies' => 'movies',
		'movies-actors' => 'movies &amp; actors'
	);
	$menuOutput = '<ul id="menu">';
	foreach ($menu as $key => $value) {
		if($_SERVER['PHP_SELF'] == "/$key.php") {
			$selected = ' class="selected"';
		} else {
			$selected = '';
		}
		$menuOutput .= '<li' . $selected . '><a href="' . $key . '.php" title="' . $value . '">' . $value . '</a></li>';
	}
	$menuOutput .= '</ul>';
  return $menuOutput;
}

?>
