<?php
/**
 * PlatformMusic Fixtures
 */
namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\PlatformMusic;

class APlatformMusicFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        //insert 3 streaming platforms
            $spotify = new PlatformMusic();
            $spotify->setName('Spotify');
            $manager->persist($spotify);
            $this->addReference("spotify_id", $spotify);

            $deezer = new PlatformMusic();
            $deezer->setName('Deezer');
            $manager->persist($deezer);

            $apple = new PlatformMusic();
            $apple->setName('Apple Music');
            $manager->persist($apple);

            $manager->flush();
    }
}
