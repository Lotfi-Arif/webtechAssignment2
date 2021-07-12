<?php
require_once("SimpleRest.php");
require_once("Banner.php");


class BannerRestHandler extends SimpleRest{

    public function getBannerLink(){

        $banner = new Banner();
        $rawData = $banner->getBannerLink();

		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('error' => 'No banner Image found!');
		} else {
			$statusCode = 200;
		}

        // Select format type JSON, HTML or XML
        // $requestContentType='application/json'; //we set it as json format
        $requestContentType='application/json'; //we set it as json format
		// Content-Type: text/html; charset=UTF-8
		// Content-Type: multipart/form-data; boundary=something

		$this ->setHttpHeaders($requestContentType, $statusCode); //to complete the requets and responds we need the header 

		if(strpos($requestContentType,'application/json') !== false){
			$response = $this->encodeJson($rawData);
			echo $response;
			
		} else if(strpos($requestContentType,'text/html') !== false){
			$response = $this->encodeHtml($rawData);
			echo $response;
		} else if(strpos($requestContentType,'application/xml') !== false){
			$response = $this->encodeXml($rawData);
			echo $response;
		}
    }


    public function insertBannerLink($datas){
        $banner = new Banner();
        $rawData = $banner->insertBannerLink($datas);

		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('error' => 'No banner Image found!');
		} else {
			$statusCode = 200;
		}

        // Select format type JSON, HTML or XML
        $requestContentType='application/json'; //we set it as json format


		$this ->setHttpHeaders($requestContentType, $statusCode); //to complete the requets and responds we need the header 

		if(strpos($requestContentType,'application/json') !== false){
			$response = $this->encodeJson($rawData);
			echo $response;
			
		} else if(strpos($requestContentType,'text/html') !== false){
			$response = $this->encodeHtml($rawData);
			echo $response;
		} else if(strpos($requestContentType,'application/xml') !== false){
			$response = $this->encodeXml($rawData);
			echo $response;
		}
    }

    public function encodeHtml($responseData) {

		$htmlResponse = "<table border='1'>";
		foreach($responseData as $key=>$value) {
    			$htmlResponse .= "<tr><td>". $key. "</td><td>". $value. "</td></tr>";
		}
		$htmlResponse .= "</table>";
		return $htmlResponse;
	}

	public function encodeJson($responseData) {
		$jsonResponse = json_encode($responseData);
		return $jsonResponse;
	}

	public function encodeXml($responseData) {

		// creating object of SimpleXMLElement

		 $xml = new SimpleXMLElement('<?xml version="1.0"?><Banner> </Banner>');


		  foreach($responseData as $key=>$value) {
		     $xml->addChild('key', $key);
		 	 $xml->addChild('value', $value);

		  }
         return $xml->asXML();
	}

}

?>