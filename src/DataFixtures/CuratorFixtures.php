<?php
/**
 * Curator Fixtures
 */
namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use App\Entity\Curator;

class CuratorFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        //insert 5 curators
        for ($i = 0; $i < 5; $i++) 
        {
            $curator = new Curator();
            $curator->setName("Curator-0".$i."");
            $curator->setPlatformMusicId($this->getReference("spotify_id"));
            $manager->persist($curator);
        }
            $this->addReference("curator_id", $curator);
            $manager->flush();
    }
}
