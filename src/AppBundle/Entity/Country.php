<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Country
 * @package AppBundle\Entity
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CountryRepository")
 * @ORM\Table(name="country")
 */
class Country {
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(type="integer")
	 */
	private $id;

	/**
	 * @ORM\Column(type="string")
	 */
	private $countryName;

	/**
	 * @return mixed
	 */
	public function getCountryName() {
		return $this->countryName;
	}

	/**
	 * @param mixed $countryName
	 */
	public function setCountryName( $countryName ) {
		$this->countryName = $countryName;
	}

	/**
	 * @return mixed
	 */
	public function getId() {
		return $this->id;
	}
}