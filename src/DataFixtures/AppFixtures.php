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
        $owner->setAddress("Acad??mie Fukurodani");
        $owner->setCountry("JP");
        $manager->persist($owner);

        $owner1 = new Owner();
        $owner1->setFirstname("Levi");
        $owner1->setFamilyname("Ackerman");
        $owner1->setAddress("Quartier g??n??ral du bataillon d'exploration");
        $owner1->setCountry("GE");
        $manager->persist($owner1);

        $owner2 = new Owner();
        $owner2->setFirstname("Satoru");
        $owner2->setFamilyname("Gojo");
        $owner2->setAddress("Acad??mie d'exorcisme de Tokyo");
        $owner2->setCountry("JP");
        $manager->persist($owner2);

        $manager->flush();
        
        $region = new Region();
        $region->setName("Haikyuu");
        $region->setPresentation("Un anime incroyable rempli de personnages tr??s int??ressants et tr??s bien ??crits");
        $region->setCountry("JP");
        $manager->persist($region);

        $region1 = new Region();
        $region1->setName("L'attaque des titans");
        $region1->setPresentation("Un univers tellement bien construit que les foreshadowings sont monnaie courante ");
        $region1->setCountry("GE");
        $manager->persist($region1);

        $region2 = new Region();
        $region2->setName("Jujutsu Kaisen");
        $region2->setPresentation("Un anime tr??s int??ressant mais dont les m??chants manquent encore de profondeur");
        $region2->setCountry("JP");
        $manager->persist($region2);

        $region3 = new Region();
        $region3->setName("My hero academia");
        $region3->setPresentation("Un anime sympa sans prise de t??te");
        $region3->setCountry("US");
        $manager->persist($region3);

        $manager->flush();

        $room = new Room();
        $room->setSummary("Terrain de vollayball");
        $room->setDescription("Un terrain de volley ball tr??s agr??able pour jouer avec des amis");
        $room->setCapacity(30);
        $room->setSuperficy(100);
        $room->setPrice(8);
        $room->setAddress("?? l'Acad??mie Fukurodani");
        $room->addRegion($region);

        $owner->addRoom($room);

        $room1 = new Room();
        $room1->setSummary("Batiment de l'acad??mie Fukurodani");
        $room1->setDescription("Universit?? tr??s prestigieuse, et b??timent tr??s large pouvant acceuillir beaucoup de personnes");
        $room1->setCapacity(200);
        $room1->setSuperficy(1000);
        $room1->setPrice(750);
        $room1->setAddress("?? l'Acad??mie Fukurodani");
        $room1->addRegion($region);

        $owner->addRoom($room1);

        $room2 = new Room();
        $room2->setSummary("Cave tr??s pr??cieuse");
        $room2->setDescription("Une cave renfermant beaucoup de secrets, mais maintenant qu'on les connait, autant se servir de l'endroit comme dortoir");
        $room2->setCapacity(5);
        $room2->setSuperficy(20);
        $room2->setPrice(83);
        $room2->setAddress("Shinganshina");
        $room2->addRegion($region1);

        $owner1->addRoom($room2);







        $manager->persist($room);
        $manager->persist($room1);
        $manager->persist($owner);
        $manager->persist($room2);
        $manager->persist($owner1);

        $manager->flush();
    }
}
