<?php
/**
 * Country Fixtures
 */
namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use App\Entity\Country;

class CountryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        //insert 5 countries
        for ($i = 0; $i < 5; $i++) 
        {
            $country = new Country();
            $country->setName($faker->country);
            $manager->persist($country);
        }
            $this->addReference("country_id", $country);
            $manager->flush();
    }
}
