<?php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Contact;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nelmio\Alice\Fixtures;

class LoadContactData implements FixtureInterface {

	public function load(ObjectManager $manager) {
		$objects = Fixtures::load(
			__DIR__ . '/fixtures.yml',
			$manager,
			[
				'providers' => [$this]
			]
		);
	}
}