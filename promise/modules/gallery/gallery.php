<?php
$podCache = array(
	"100" => array(
		"podId" => "100",
		"atStores" =>  array("Safeway", "Kroger")
	),
	"101" => array(
		"podId" => "101",
		"atStores" => array("Safeway")
	),
	"102" => array(
		"podId" => "102",
		"atStores" => array("Meijer")
	),
	"103" => array(
		"podId" => "103",
		"atStores" => array("Kroger")
	)
);

$podTemplate =<<<HTML
	<div class="pod" data-podid="{podId}">
		<h3>Pod {podId} available at {podStores}</h3>

		<button class="add-to-card">Add To Card</button>
	</div>
HTML;

function renderPod($podData) {
	global $podTemplate;

	$search = array('/{podId}/', '/{podStores}/');
    $replace = array(
        $podData["podId"],
        implode($podData["atStores"], ", ")
    );

    $html = preg_replace($search, $replace, $podTemplate);

    return $html;
}
function renderGallery() {
	global $podCache;

	$html = '';
	foreach($podCache as $podId =>$podData) {
		$html .= renderPod($podData);
	}

	return $html;
}

function renderPodCacheAsJSON() {
	global $podCache;
	return json_encode($podCache);
}