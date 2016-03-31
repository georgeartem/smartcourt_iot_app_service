<?php

require_once('classes/CServices2.php'); // including service class to work with database
$oServices = new CServices();

// process actions
switch ($_GET['action']) {
    case 'get_locations':
        $oServices->getAllCourts();
        break;
    case 'get_locations_status':
        $oServices->getMyCourts();
        break;
	case 'get_favorite_locations':
		$oServices->getMyFavorites($_GET['username']);
		
}
?>