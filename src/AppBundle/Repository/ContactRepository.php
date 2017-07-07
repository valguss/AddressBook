<?php
namespace AppBundle\Repository;

use AppBundle\Entity\Contact;
use Doctrine\ORM\EntityRepository;

class ContactRepository extends EntityRepository {

	/**
	 * @return Contact[]
	 */
	public function findAll() {
		return $this->findBy(array(), array('lastName' => 'ASC'));
	}
}