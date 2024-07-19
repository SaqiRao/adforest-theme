<?php
/*SEE HOOKS FOLDER FOR FONTS REGISTERING/ENQUEUE IN BASE @path "/include/autoload/hook-vc-iconpicker-param.php"*/
add_filter( 'vc_iconpicker-type-etline', 'vc_iconpicker_type_chimp_etline' );
if(!function_exists('vc_iconpicker_type_chimp_etline')){
	function vc_iconpicker_type_chimp_etline( $icons )
	{
		$et_line	=	array(
			'Template Icons' => array(
				array('flaticon-art' => 'art' ),
			array('flaticon-beach' => 'beach' ),
			array('flaticon-broom' => 'broom' ),
			array('flaticon-bucket' => 'bucket' ),
			array('flaticon-building' => 'building' ),
			array('flaticon-buildings' => 'buildings' ),
			array('flaticon-buildings-1' => 'buildings-1' ),
			array('flaticon-buildings-2' => 'buildings-2' ),
			array('flaticon-buildings-3' => 'buildings-3' ),
			array('flaticon-carpenter' => 'carpenter' ),
			array('flaticon-carpentry' => 'carpentry' ),
			array('flaticon-caution' => 'caution' ),
			array('flaticon-circular-saw' => 'circular-saw' ),
			array('flaticon-cleaning' => 'cleaning' ),
			array('flaticon-cleaning-1' => 'cleaning-1' ),
			array('flaticon-cleaning-2' => 'cleaning-2' ),
			array('flaticon-cleaning-3' => 'cleaning-3' ),
			array('flaticon-cleaning-4' => 'cleaning-4' ),
			array('flaticon-compass' => 'compass' ),
			array('flaticon-construction' => 'construction' ),
			array('flaticon-construction-1' => 'construction-1' ),
			array('flaticon-construction-10' => 'construction-10' ),
			array('flaticon-construction-12' => 'construction-12' ),
			array('flaticon-construction-13' => 'construction-13' ),
			array('flaticon-construction-14' => 'construction-14' ),
			array('flaticon-construction-15' => 'construction-15' ),
			array('flaticon-construction-16' => 'construction-16' ),
			array('flaticon-construction-17' => 'construction-17' ),
			array('flaticon-construction-18' => 'construction-18' ),
			array('flaticon-construction-19' => 'construction-19' ),
			array('flaticon-construction-2' => 'construction-2' ),
			array('flaticon-construction-20' => 'construction-20' ),
			array('flaticon-construction-21' => 'construction-21' ),
			array('flaticon-construction-22' => 'construction-22' ),
			array('flaticon-construction-23' => 'construction-23' ),
			array('flaticon-construction-24' => 'construction-24' ),
			array('flaticon-construction-25' => 'construction-25' ),
			array('flaticon-construction-26' => 'construction-26' ),
			array('flaticon-construction-27' => 'construction-27' ),
			array('flaticon-construction-28' => 'construction-28' ),
			array('flaticon-construction-29' => 'construction-29' ),
			array('flaticon-construction-3' => 'construction-3' ),
			array('flaticon-construction-30' => 'construction-30' ),
			array('flaticon-construction-5' => 'construction-5' ),
			array('flaticon-construction-7' => 'construction-7' ),
			array('flaticon-construction-8' => 'construction-8' ),
			array('flaticon-construction-9' => 'construction-9' ),
			array('flaticon-construction-helmet' => 'construction-helmet' ),
			array('flaticon-construction-worker' => 'construction-worker' ),
			array('flaticon-constructor-hand-drawn-worker' => 'constructor-hand-drawn-worker' ),
			array('flaticon-cube' => 'cube' ),
			array('flaticon-cut' => 'cut' ),
			array('flaticon-cut-1' => 'cut-1' ),
			array('flaticon-cut-2' => 'cut-2' ),
			array('flaticon-cut-3' => 'cut-3' ),
			array('flaticon-cut-4' => 'cut-4' ),
			array('flaticon-desatascador' => 'desatascador' ),
			array('flaticon-drilling-wall' => 'drilling-wall' ),
			array('flaticon-dust' => 'dust' ),
			array('flaticon-engineer' => 'engineer' ),
			array('flaticon-front' => 'front' ),
			array('flaticon-ground-drill' => 'ground-drill' ),
			array('flaticon-hammer' => 'hammer' ),
			array('flaticon-hammer-1' => 'hammer-1' ),
			array('flaticon-improvement' => 'improvement' ),
			array('flaticon-improvement-1' => 'improvement-1' ),
			array('flaticon-improvement-2' => 'improvement-' ),
			array('flaticon-medical' => 'medical' ),
			array('flaticon-nature' => 'nature' ),
			array('flaticon-paint' => 'paint' ),
			array('flaticon-paintbrush' => 'paintbrush' ),
			array('flaticon-people' => 'people' ),
			array('flaticon-people-1' => 'people-1' ),
			array('flaticon-people-10' => 'people-10' ),
			array('flaticon-people-11' => 'people-11' ),
			array('flaticon-people-12' => 'people-12' ),
			array('flaticon-people-2' => 'people-2' ),
			array('flaticon-people-3' => 'people-3' ),
			array('flaticon-people-4' => 'people-4' ),
			array('flaticon-people-5' => 'people-5' ),
			array('flaticon-people-6' => 'people-6' ),
			array('flaticon-people-7' => 'people-7' ),
			array('flaticon-people-8' => 'people-8' ),
			array('flaticon-people-9' => 'people-9' ),
			array('flaticon-pipeline-with-wheel' => 'pipeline-with-wheel' ),
			array('flaticon-push-trolley' => 'push-trolley' ),
			array('flaticon-remove' => 'remove' ),
			array('flaticon-road' => 'road' ),
			array('flaticon-road-1' => 'road-1' ),
			array('flaticon-shovel-3' => 'shovel-3' ),
			array('flaticon-shovel-4' => 'shovel-4' ),
			array('flaticon-shovel-5' => 'shovel-5' ),
			array('flaticon-shovel-6' => 'shovel-6' ),
			array('flaticon-tool' => 'tool' ),
			array('flaticon-tool-1' => 'tool-1' ),
			array('flaticon-tool-10' => 'tool-10' ),
			array('flaticon-tool-11' => 'tool-11' ),
			array('flaticon-tool-12' => 'tool-12' ),
			array('flaticon-tool-13' => 'tool-13' ),
			array('flaticon-tool-14' => 'tool-14' ),
			array('flaticon-tool-15' => 'tool-15' ),
			array('flaticon-tool-16' => 'tool-16' ),
			array('flaticon-tool-17' => 'tool-17' ),
			array('flaticon-tool-18' => 'tool-18' ),
			array('flaticon-tool-2' => 'tool-2' ),
			array('flaticon-tool-3' => 'tool-3' ),
			array('flaticon-tool-4' => 'tool-4' ),
			array('flaticon-tool-5' => 'tool-5' ),
			array('flaticon-tool-6' => 'tool-6' ),
			array('flaticon-tool-7' => 'tool-7' ),
			array('flaticon-tool-8' => 'tool-8' ),
			array('flaticon-tool-9' => 'tool-9' ),
			array('flaticon-tools' => 'tools' ),
			array('flaticon-tractor' => 'tractor' ),
			array('flaticon-transport' => 'transport' ),
			array('flaticon-transport-1' => 'transport-1' ),
			array('flaticon-transport-10' => 'transport-10' ),
			array('flaticon-transport-11' => 'transport-11' ),
			array('flaticon-transport-12' => 'transport-12' ),
			array('flaticon-transport-13' => 'transport-13' ),
			array('flaticon-transport-14' => 'transport-14' ),
			array('flaticon-transport-15' => 'transport-15' ),
			array('flaticon-transport-16' => 'transport-16' ),
			array('flaticon-transport-17' => 'transport-17' ),
			array('flaticon-transport-2' => 'transport-2' ),
			array('flaticon-transport-3' => 'transport-3' ),
			array('flaticon-transport-5' => 'transport-5' ),
			array('flaticon-transport-7' => 'transport-7' ),
			array('flaticon-transport-8' => 'transport-8' ),
			array('flaticon-transport-9' => 'transport-9' ),
			array('flaticon-vacuum-cleaner-3' => 'vacuum-cleaner-3' ),
			array('flaticon-wall' => 'wall' ),
			array('flaticon-washing' => 'washing' ),
			array('flaticon-washing-2' => 'washing-2' ),
			array('flaticon-water' => 'water' ),
			array('flaticon-water-1' => 'water-1' ),
			array('flaticon-window' => 'window' ),
			array('flaticon-worker-of-construction-working-with-a-shovel-beside-material-pile' => 'worker-of-construction-working-with-a-shovel-beside-material-pile' ),
			array('flaticon-wrench' => 'wrench' ),

			array('flaticon-avatar' => 'avatar' ),
			array('flaticon-avatar-1' => 'avatar-1' ),
			array('flaticon-book' => 'book' ),
			array('flaticon-book-1' => 'book-1' ),
			array('flaticon-book-2' => 'book-2' ),
			array('flaticon-buildings' => 'buildings' ),
			array('flaticon-bus' => 'bus' ),
			array('flaticon-bus-1' => 'bus-1' ),
			array('flaticon-bus-2' => 'bus-2' ),
			array('flaticon-car' => 'car' ),
			array('flaticon-chemistry' => 'chemistry' ),
			array('flaticon-computer' => 'computer' ),
			array('flaticon-diploma' => 'diploma' ),
			array('flaticon-education' => 'education' ),
			array('flaticon-electric-light-bulb' => 'electric-light-bulb' ),
			array('flaticon-gas-station' => 'gas-station' ),
			array('flaticon-idea' => 'idea' ),
			array('flaticon-idea-2' => 'idea-2' ),
			array('flaticon-interface' => 'interface' ),
			array('flaticon-library' => 'library' ),
			array('flaticon-light-bulb' => 'light-bulb' ),
			array('flaticon-light-bulb-1' => 'light-bulb-1' ),
			array('flaticon-light-bulb-2' => 'light-bulb-2' ),
			array('flaticon-light-bulb-3' => 'light-bulb-3' ),
			array('flaticon-light-bulb-4' => 'light-bulb-4' ),
			array('flaticon-light-bulb-on' => 'light-bulb-on' ),
			array('flaticon-mill' => 'mill' ),
			array('flaticon-mill-2' => 'mill-1' ),
			array('flaticon-mill-2' => 'mill-2' ),
			array('flaticon-mortarboard' => 'mortarboard' ),
			array('flaticon-open-book' => 'open-book' ),
			array('flaticon-open-magazine' => 'open-magazine' ),
			array('flaticon-people' => 'people' ),
			array('flaticon-pinwheel' => 'pinwheel' ),
			array('flaticon-power' => 'power' ),
			array('flaticon-ruler' => 'ruler' ),
			array('flaticon-school' => 'school' ),
			array('flaticon-school-1' => 'school-1' ),
			array('flaticon-school-2' => 'school-2' ),
			array('flaticon-school-3' => 'school-3' ),
			array('flaticon-school-4' => 'school-4' ),
			array('flaticon-school-5' => 'school-5' ),
			array('flaticon-school-bus' => 'school-bus' ),
			array('flaticon-science' => 'science' ),
			array('flaticon-science-1' => 'science-1' ),
			array('flaticon-science-2' => 'science-2' ),
			array('flaticon-science-book' => 'science-book' ),
			array('flaticon-solar-energy' => 'solar-energy' ),
			array('flaticon-solar-energy-1' => 'solar-energy-1' ),
			array('flaticon-solar-panel-1' => 'solar-panel-1' ),
			array('flaticon-solar-panel-in-sunlight' => 'solar-panel-in-sunlight' ),
			array('flaticon-solar-panels-couple-in-sunlight' => 'solar-panels-couple-in-sunlight' ),
			array('flaticon-student-travelling-by-bus' => 'student-travelling-by-bus' ),
			array('flaticon-teacher-and-students' => 'teacher-and-students' ),
			array('flaticon-teacher-pointing-at-blackboard' => 'teacher-pointing-at-blackboard' ),
			array('flaticon-teacher-with-stick' => 'teacher-with-stick' ),
			array('flaticon-technology' => 'technology' ),
			array('flaticon-technology-1' => 'technology-1' ),
			array('flaticon-technology-2' => 'technology-2' ),
			array('flaticon-technology-3' => 'technology-3' ),
			array('flaticon-technology-4' => 'technology-4' ),
			array('flaticon-technology-5' => 'technology-5' ),
			array('flaticon-technology-6' => 'technology-6' ),
			array('flaticon-technology-8' => 'technology-8' ),
			array('flaticon-tool' => 'tool' ),
			array('flaticon-transport' => 'transport' ),
			array('flaticon-wind-mill' => 'wind-mill' ),
			array('flaticon-windmill' => 'windmill' ),
			array('flaticon-windmill-1' => 'windmill-1' ),
			array('flaticon-windmill-2' => 'windmill-2' ),
			array('flaticon-windmill-outlined-hand-drawn-rural-building' => 'windmill-outlined-hand-drawn-rural-building' ),
			array('flaticon-windmills' => 'windmills' ),
			array('flaticon-writing' => 'writing' ),


					),
					'Et Line Icons' => array(
			array('icon-mobile' => 'mobile' ),
			array('icon-laptop' => 'laptop' ),
			array('icon-desktop' => 'desktop' ),
			array('icon-tablet' => 'tablet' ),
			array('icon-phone' => 'phone' ),
			array('icon-document' => 'document' ),
			array('icon-documents' => 'documents' ),
			array('icon-search' => 'search' ),
			array('icon-clipboard' => 'clipboard' ),
			array('icon-newspaper' => 'newspaper' ),
			array('icon-notebook' => 'notebook' ),
			array('icon-book-open' => 'book-open' ),
			array('icon-browser' => 'browser' ),
			array('icon-calendar' => 'calendar' ),
			array('icon-presentation' => 'presentation' ),
			array('icon-picture' => 'picture' ),
			array('icon-pictures' => 'pictures' ),
			array('icon-video' => 'video' ),
			array('icon-camera' => 'camera' ),
			array('icon-printer' => 'printer' ),
			array('icon-toolbox' => 'toolbox' ),
			array('icon-briefcase' => 'briefcase' ),
			array('icon-wallet' => 'wallet' ),
			array('icon-gift' => 'gift' ),
			array('icon-bargraph' => 'bargraph' ),
			array('icon-grid' => 'grid' ),
			array('icon-expand' => 'expand' ),
			array('icon-focus' => 'focus' ),
			array('icon-edit' => 'edit' ),
			array('icon-adjustments' => 'adjustments' ),
			array('icon-ribbon' => 'ribbon' ),
			array('icon-hourglass' => 'hourglass' ),
			array('icon-lock' => 'lock' ),
			array('icon-megaphone' => 'megaphone' ),
			array('icon-shield' => 'shield' ),
			array('icon-trophy' => 'trophy' ),
			array('icon-flag' => 'flag' ),
			array('icon-map' => 'map' ),
			array('icon-puzzle' => 'puzzle' ),
			array('icon-basket' => 'basket' ),
			array('icon-envelope' => 'envelope' ),
			array('icon-streetsign' => 'streetsign' ),
			array('icon-telescope' => 'telescope' ),
			array('icon-gears' => 'gears' ),
			array('icon-key' => 'key' ),
			array('icon-paperclip' => 'paperclip' ),
			array('icon-attachment' => 'attachment' ),
			array('icon-pricetags' => 'pricetags' ),
			array('icon-lightbulb' => 'lightbulb' ),
			array('icon-layers' => 'layers' ),
			array('icon-pencil' => 'pencil' ),
			array('icon-tools' => 'tools' ),
			array('icon-tools-2' => 'tools-2' ),
			array('icon-scissors' => 'scissors' ),
			array('icon-paintbrush' => 'paintbrush' ),
			array('icon-magnifying-glass' => 'magnifying-glass' ),
			array('icon-circle-compass' => 'circle-compass' ),
			array('icon-linegraph' => 'linegraph' ),
			array('icon-mic' => 'mic' ),
			array('icon-strategy' => 'strategy' ),
			array('icon-beaker' => 'beaker' ),
			array('icon-caution' => 'caution' ),
			array('icon-recycle' => 'recycle' ),
			array('icon-anchor' => 'anchor' ),
			array('icon-profile-male' => 'profile-male' ),
			array('icon-profile-female' => 'profile-female' ),
			array('icon-bike' => 'bike' ),
			array('icon-wine' => 'wine' ),
			array('icon-hotairballoon' => 'hotairballoon' ),
			array('icon-glob' => 'glob' ),
			array('icon-genius' => 'genius' ),
			array('icon-map-pin' => 'map-pin' ),
			array('icon-dial' => 'dial' ),
			array('icon-chat' => 'chat' ),
			array('icon-heart' => 'heart' ),
			array('icon-cloud' => 'cloud' ),
			array('icon-upload' => 'upload' ),
			array('icon-download' => 'download' ),
			array('icon-traget' => 'traget' ),
			array('icon-hazardous' => 'hazardous' ),
			array('icon-piechart' => 'piechart' ),
			array('icon-speedometer' => 'speedometer' ),
			array('icon-global' => 'global' ),
			array('icon-compass' => 'compass' ),
			array('icon-lifesaver' => 'lifesaver' ),
			array('icon-clock' => 'clock' ),
			array('icon-aperture' => 'aperture' ),
			array('icon-quote' => 'quote' ),
			array('icon-scope' => 'scope' ),
			array('icon-alarmclock' => 'alarmclock' ),
			array('icon-refresh' => 'refresh' ),
			array('icon-happy' => 'happy' ),
			array('icon-sad' => 'sad' ),
			array('icon-facebook' => 'facebook' ),
			array('icon-twitter' => 'twitter' ),
			array('icon-googleplus' => 'googleplus' ),
			array('icon-rss' => 'rss' ),
			array('icon-tumblr' => 'tumblr' ),
			array('icon-linkedin' => 'linkedin' ),
			array('icon-dribbble' => 'dribbble' ),
	)
	);

	 return array_merge( $icons, $et_line );
	}
}
add_action( 'admin_enqueue_scripts', 'chimp_admin_scripts' );
if(function_exists('chimp_admin_scripts')){
	function chimp_admin_scripts()
	{
		wp_enqueue_style( 'etline-icons', trailingslashit( get_template_directory_uri () ) . 'css/et-line-fonts.css' );
		wp_enqueue_style( 'flat-icons', trailingslashit( get_template_directory_uri () ) . 'css/flaticon.css' );
		wp_enqueue_style( 'flat-icons-2', trailingslashit( get_template_directory_uri () ) . 'css/flaticon-2.css' );
	}
}