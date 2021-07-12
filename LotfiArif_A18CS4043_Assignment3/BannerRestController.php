<?php
require_once("BannerRestHandler.php");

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");

$action = "";
if(isset($_GET["action"]))
	$action = $_GET["action"];

 switch($action){

	case "all":
        $bannerRestHandler = new BannerRestHandler();
        $bannerRestHandler->getBannerLink();

		break;

    case "insert":
        $data = json_decode(file_get_contents("php://input"), true);
        $bannerRestHandler = new BannerRestHandler();
        $bannerRestHandler->insertBannerLink($data);

        break;

	case "" :
		//404 - not found;
		break;
}
?>