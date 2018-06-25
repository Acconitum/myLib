$arr_search  = array("A","À","Á","Ä","Ç","È","É","Ì","Í","Ñ","Ò","Ó","Ö","Ù","Ú","Ü","à","á","ä","ç","è","é","ì","í","ñ","ò","ó","ö","ù","ú","ü");  
$arr_replace = array("A","A","A","A","C","E","E","I","I","N","O","O","O","U","U","U","a","a","a","c","e","e","i","i","n","o","o","o","u","u","u");

$cities = [];
// Translate 
foreach($tmp as $cityName) {

	$city = new stdClass();
	$city->englishName = $cityName;
	$city->translatedName = __($city->englishName, 'sage');
	$city->noUmlautName = str_replace( $arr_search, $arr_replace, $city->translatedName);
	$cities[] = $city;
}

usort($cities, function($city1, $city2) {
	return $city1->noUmlautName <=> $city2->noUmlautName;
});
