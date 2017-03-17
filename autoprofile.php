<?php

class AutoProfilerInfo {

	public $gender = "";
	public $genderConfidence = 0;
	public $age = 0;
	public $ethnicity = "";
	public $ethnicityConfidence = 0;

	public function __construct($responseObj) {
		$this->gender = $responseObj["gender"]["gender"];
		$this->genderConfidence = $responseObj["gender"]["confidence"];
		$this->age = $responseObj["age"];
		$this->ethnicity = $responseObj["ethnicity"]["ethnicity"];
		$this->ethnicityConfidence = $responseObj["ethnicity"]["confidence"];
	}

}

class AutoProfiler {
	
	private $apiKey = "";

	public function __construct($key) {
		$this->apiKey = $key;
	}

	public function getProfileInformation($imageData) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->getRequestUrl());
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $imageData);

		$rawResponse = curl_exec($ch);
		$response = json_decode($rawResponse, true);

		if(count($response["people"]) != 1) {
			return null;
		}

		$person = $response["people"][0];

		if($response["result"] === "success")
			return new AutoProfilerInfo($person);
		else 
			return null;
	}

	private function getRequestUrl() {
		$format = "http://api.haystack.ai/api/image/analyze?output=json&apikey=%s&model=age&model=gender&model=ethnicity";

		return sprintf($format, $this->apiKey);
	}

}