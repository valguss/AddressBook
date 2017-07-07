<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class ContactEntity
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AddressRepository")
 * @ORM\Table(name="address")
 */
class Address {
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(type="integer")
	 */
	private $id;

	/**
	 * @ORM\Column(type="string")
	 */
	private $firstLine;

	/**
	 * @ORM\Column(type="string")
	 */
	private $secondLine;

	/**
	 * @ORM\Column(type="string")
	 */
	private $city;

	/**
	 * @ORM\Column(type="string")
	 */
	private $county;

	/**
	 * @ORM\Column(type="string")
	 */
	private $postCode;

	/**
	 * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Contact", inversedBy="address")
	 */
	private $contact;

	/**
	 * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Country", cascade={})
	 */
	private $country;

	/**
	 * @return mixed
	 */
	public function getFirstLine() {
		return $this->firstLine;
	}

	/**
	 * @param mixed $firstLine
	 */
	public function setFirstLine( $firstLine ) {
		$this->firstLine = $firstLine;
	}

	/**
	 * @return mixed
	 */
	public function getSecondLine() {
		return $this->secondLine;
	}

	/**
	 * @param mixed $secondLine
	 */
	public function setSecondLine( $secondLine ) {
		$this->secondLine = $secondLine;
	}

	/**
	 * @return mixed
	 */
	public function getCity() {
		return $this->city;
	}

	/**
	 * @param mixed $city
	 */
	public function setCity( $city ) {
		$this->city = $city;
	}

	/**
	 * @return mixed
	 */
	public function getCounty() {
		return $this->county;
	}

	/**
	 * @param mixed $county
	 */
	public function setCounty( $county ) {
		$this->county = $county;
	}

	/**
	 * @return mixed
	 */
	public function getPostCode() {
		return $this->postCode;
	}

	/**
	 * @param mixed $postCode
	 */
	public function setPostCode( $postCode ) {
		$this->postCode = $postCode;
	}

	/**
	 * @return mixed
	 */
	public function getContact() {
		return $this->contact;
	}

	/**
	 * @param mixed $contact
	 */
	public function setContact( $contact ) {
		$this->contact = $contact;
	}

	/**
	 * @return mixed
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @return mixed
	 */
	public function getCountry() {
		return $this->country;
	}

	/**
	 * @param mixed $country
	 */
	public function setCountry( $country ) {
		$this->country = $country;
	}
}