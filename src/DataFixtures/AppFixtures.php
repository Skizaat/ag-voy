<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Owner;
use App\Entity\Region;
use App\Entity\Room;

class AppFixtures extends Fixture

{


    // /**
    //  * Generates initialization data for Owner : [firstname, familyname, address, country]
    //  * @return \\Generator
    //  */
    // private static function OwnerDataGenerator()
    // {
    // yield ["Keiji", "Akaashi", "Fukurodani Highschool", "jp"];
    // }

    // /**
    //  * Generates initialization data for Room : [summary, description, capacity, superficy, price, address]
    //  * @return \\Generator
    //  */
    // private static function RoomDataGenerator()
    // {
    // yield ["Volleyball court", "A very nice volleyball court to play volley with your friends", 30, 100, 2, "At fukurodani highschool"];
    // }

    // /**
    //  * Generates initialization data for Region : [name, presentation, country]
    //  * @return \\Generator
    //  */
    // private static function RegionDataGenerator()
    // {
    // yield ["Haikyuu", "A wonderful manga where you can find very-well written fictional characters", "jp"];
    // }

    // /**
    // * Generates initialization data for Owner rooms:
    // *  [owner_firstname, owner_familyname, owner_address, owner_country, room]
    // * @return \\Generator
    // */
    // private static function OwnerRoomsGenerator()
    // {
    // yield ["Keiji", "Akaashi", "Fukurodani Highschool", "jp", "Volleyball court"];
    // }

    // /**
    // * Generates initialization data for Region rooms:
    // *  [region_name, region_presentation, region_country, room]
    // * @return \\Generator
    // */
    // private static function RegionRoomsGenerator()
    // {
    // yield ["Haikyuu", "A wonderful manga where you can find very-well written fictional characters", "jp", "Volleyball court"];
    // }

    public function load(ObjectManager $manager)
    {   
        $owner = new Owner();
        $owner->setFirstname("Keiji");
        $owner->setFamilyname("Akaashi");
        $owner->setAddress("Fukurodani Highschool");
        $owner->setCountry("jp");
        $manager->persist($owner);

        $manager->flush();
        
        $region = new Region();
        $region->setName("Haikyuu");
        $region->setPresentation("A wonderful manga where you can find very-well written fictional characters");
        $region->setCountry("JP");
        $manager->persist($region);

        $manager->flush();

        $room = new Room();
        $room->setSummary("Volleyball court");
        $room->setDescription("A very nice volleyball court to play volley with your friends");
        $room->setCapacity(30);
        $room->setSuperficy(100);
        $room->setPrice(8);
        $room->setAddress("At fukurodani highschool");
        $room->addRegion($region);

        $owner->addRoom($room);
        $manager->persist($room);
        $manager->persist($owner);

        $manager->flush();
    }
}
