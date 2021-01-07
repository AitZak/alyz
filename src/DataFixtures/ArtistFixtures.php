<?php
/**
 * Artist Fixtures
 */
namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Artist;

class ArtistFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        //insert 10 artists
        for ($i = 0; $i < 20; $i++) 
        {
            $artist = new Artist();
            $artist->setName("Artist".$i."");
            $manager->persist($artist);
        }
            $this->addReference("artist_id", $artist);
            $manager->flush();
    }
}
