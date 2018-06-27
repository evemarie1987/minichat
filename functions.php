<?php 
function age($datetime) {
	$formats = [
		'ans' => '%y',
	    'mois' => '%m',
	    'jours' => '%d',
	    'h' => '%h',
	    'min' => '%i',
	    's' => '%s'
	];
	$date = new Datetime($datetime);
    $interval = $date->diff(new Datetime());

    $searching = true;
    foreach ($formats as $duree => $format) {
    	$value = $interval->format($format);
		if($searching) {
			if (!$value == 0) {
				$age = $value.$duree;
				$searching = false;
			}
		} else {
			if (!$value == 0) {
				return $age.' '.$value.$duree;
			}
			return $age;
		}
    }
    if (!isset($age)) {
    	return '00 s';
    }
    return $age;
}