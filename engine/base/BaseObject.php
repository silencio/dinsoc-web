<?php
namespace engine\base;

/**
 *
 * @author Hervé
 *        
 *        
 */

class BaseObject {

	/**
	 * Identifier
	 * @var int
	 */
	protected $id;
	
	/**
	 * Date of insert
	 * @var string (YYYY-MM-DD HH:II:SS)
	 */
	protected $dateInsert;
	
	/**
	 * Date of last update
	 * @var string (YYYY-MM-DD HH:II:SS)
	 */
	protected $dateUpdate;
	
	/**
	 * @return the $id
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param number $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @return the $dateInsert
	 */
	public function getDateInsert() {
		return $this->dateInsert;
	}

	/**
	 * @param string $dateInsert
	 */
	public function setDateInsert($dateInsert) {
		$this->dateInsert = $dateInsert;
	}

	/**
	 * @return the $dateUpdate
	 */
	public function getDateUpdate() {
		return $this->dateUpdate;
	}

	/**
	 * @param string $dateUpdate
	 */
	public function setDateUpdate($dateUpdate) {
		$this->dateUpdate = $dateUpdate;
	}

}

?>