<?php
/**
 * Chart Fixtures
 */
namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use App\Entity\Chart;
use App\Entity\Country;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\Validator\Constraints\Count;

class ChartFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {


        $chart = new Chart();
        $chart->setName("top".strval(rand(49,201)));
        $chart->setCountryId($this->getReference("iso_fr"));
        $chart->setPlatformMusicId($this->getReference("spotify_id"));
        $manager->persist($chart);

        $this->addReference("chart_id", $chart);
        $manager->flush();

    }

    public function getDependencies()
    {
        return array(
            CountryFixtures::class,
        );
    }

}