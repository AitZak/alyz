<?php
/**
 * Chart Fixtures
 */
namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use App\Entity\Chart;

class ChartFixtures extends Fixture
{
    
    public function load(ObjectManager $manager)
    {
        
        $faker = Faker\Factory::create('fr_FR');

        //insert 5 charts
        for ($i = 0; $i < 5; $i++) 
        {
            $chart = new Chart();
            $chart->setPlatformMusicId($this->getReference("spotify_id"));
            $manager->persist($chart);
        }
            $this->addReference("chart_id", $chart);
            $manager->flush();
            
    }
    
}
