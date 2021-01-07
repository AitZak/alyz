<?php
/**
 * User Fixtures
 */
namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    /**
     * encoder password
     *
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        //insert 10 users
        for ($i = 0; $i < 50; $i++) 
        {
            $user = new User();
            $hash = $this->encoder->encodePassword($user,"password");
            $user->setEmail("sample@example0".$i.".com");
            $user->setLastName($faker->lastName);
            $user->setFirstName($faker->firstNameFemale);
            $user->setPassword($hash);
            $manager->persist($user);
        }
            $this->addReference("user_id", $user);
            $manager->flush();
    }
}
