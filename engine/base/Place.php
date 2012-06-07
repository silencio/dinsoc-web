<?php
namespace engine\base;

use engine\base\BaseObject;
/**
 *
 * @author Hervé
 *        
 *        
 */

class Place extends BaseObject {

	/**
	 * Name
	 * @var string
	 */
	protected $name;
	
	/**
	 * Latitude
	 * @var float
	 */
	protected $lat;	
	
	/**
	 * Longitude
	 * @var float
	 */
	protected $lng;
		
	/**
	 * Street address
	 * @var string
	 */
	protected $streetAddress;
	
	/**
	 * Zip code
	 * @var integer
	 */
	protected $zipCode;
	
	/**
	 * City
	 * @var string
	 */
	protected $city;
	
	/**
	 * Country
	 * @var string
	 */
	protected $country;
	
	/**
	 * @return the $name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param string $name
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * @return the $lat
	 */
	public function getLat() {
		return $this->lat;
	}

	/**
	 * @param number $lat
	 */
	public function setLat($lat) {
		$this->lat = $lat;
	}

	/**
	 * @return the $lng
	 */
	public function getLng() {
		return $this->lng;
	}

	/**
	 * @param number $lng
	 */
	public function setLng($lng) {
		$this->lng = $lng;
	}

	/**
	 * @return the $streetAddress
	 */
	public function getStreetAddress() {
		return $this->streetAddress;
	}

	/**
	 * @param string $streetAddress
	 */
	public function setStreetAddress($streetAddress) {
		$this->streetAddress = $streetAddress;
	}

	/**
	 * @return the $zip_code
	 */
	public function getZipCode() {
		return $this->zipCode;
	}

	/**
	 * @param number $zip_code
	 */
	public function setZipCode($zipCode) {
		$this->zipCode = $zipCode;
	}

	/**
	 * @return the $city
	 */
	public function getCity() {
		return $this->city;
	}

	/**
	 * @param string $city
	 */
	public function setCity($city) {
		$this->city = $city;
	}

	/**
	 * @return the $country
	 */
	public function getCountry() {
		return $this->country;
	}

	/**
	 * @param string $country
	 */
	public function setCountry($country) {
		$this->country = $country;
	}

	
	
	
	
}

?>