<?php

namespace App\DataFixtures;

use App\Entity\Politic;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $politic = new Politic();
        $politic->setName("Benoit Hamon")
               ->setParty("PS")
               ->setImage("benoit_hamon.png")
               ->setRarity(2);

        $manager->persist($politic);

        $manager->flush();

        /////////////////////////
        $politic = new Politic();
        $politic->setName("Bruno Le Maire")
               ->setParty("UMP")
               ->setImage("bruno_le_maire.png")
               ->setRarity(1);

        $manager->persist($politic);

        $manager->flush();

        /////////////////////////
        $politic = new Politic();
        $politic->setName("Christophe Castaner")
               ->setParty("EM")
               ->setImage("christophe_castaner.png")
               ->setRarity(2);

        $manager->persist($politic);

        $manager->flush();

        /////////////////////////
        $politic = new Politic();
        $politic->setName("Emmanuel Macron")
               ->setParty("EM")
               ->setImage("emmanuel_macron.png")
               ->setRarity(3);

        $manager->persist($politic);

        $manager->flush();

        /////////////////////////
        $politic = new Politic();
        $politic->setName("François Asselineau")
               ->setParty("UPR")
               ->setImage("francois_asselineau.png")
               ->setRarity(2);

        $manager->persist($politic);

        $manager->flush();

        /////////////////////////
        $politic = new Politic();
        $politic->setName("François Bayrou")
               ->setParty("Modem")
               ->setImage("francois_bayrou.png")
               ->setRarity(1);

        $manager->persist($politic);

        $manager->flush();

        /////////////////////////
        $politic = new Politic();
        $politic->setName("François De Rugy")
               ->setParty("EM")
               ->setImage("francois_de_rugy.png")
               ->setRarity(1);

        $manager->persist($politic);

        $manager->flush();

        /////////////////////////
        $politic = new Politic();
        $politic->setName("François Fillon")
               ->setParty("LR")
               ->setImage("francois_fillon.png")
               ->setRarity(2);

        $manager->persist($politic);

        $manager->flush();

        /////////////////////////
        $politic = new Politic();
        $politic->setName("François Hollande")
               ->setParty("PS")
               ->setImage("francois_hollande.png")
               ->setRarity(3);

        $manager->persist($politic);

        $manager->flush();

        /////////////////////////
        $politic = new Politic();
        $politic->setName("Jean-Luc Mélenchon")
               ->setParty("PC")
               ->setImage("hologramme_jlm.png")
               ->setRarity(3);

        $manager->persist($politic);
        
        $manager->flush();

        /////////////////////////
        $politic = new Politic();
        $politic->setName("Jacques Cheminade")
               ->setParty("SP")
               ->setImage("jacques_cheminade.png")
               ->setRarity(1);

        $manager->persist($politic);
        
        $manager->flush();

        /////////////////////////
        $politic = new Politic();
        $politic->setName("Jean Lasalle")
               ->setParty("Résistons")
               ->setImage("jean_lassalle.png")
               ->setRarity(3);

        $manager->persist($politic);
        
        $manager->flush();

        /////////////////////////
        $politic = new Politic();
        $politic->setName("Jean-Vincent Placé")
               ->setParty("EM")
               ->setImage("jean_vincent_place.png")
               ->setRarity(1);

        $manager->persist($politic);
        
        $manager->flush();

        /////////////////////////
        $politic = new Politic();
        $politic->setName("Jean-François Copé")
               ->setParty("LR")
               ->setImage("jean-francois_cope.png")
               ->setRarity(1);

        $manager->persist($politic);
        
        $manager->flush();

        /////////////////////////
        $politic = new Politic();
        $politic->setName("Jean-Luc Mélenchon")
               ->setParty("PC")
               ->setImage("jean-luc_melanchon.png")
               ->setRarity(3);

        $manager->persist($politic);
        
        $manager->flush();

        /////////////////////////
        $politic = new Politic();
        $politic->setName("Jean-Marc Ayrault")
               ->setParty("PS")
               ->setImage("jean-marc_ayrault.png")
               ->setRarity(1);

        $manager->persist($politic);
        
        $manager->flush();

        /////////////////////////
        $politic = new Politic();
        $politic->setName("Marine Le Pen")
               ->setParty("RN")
               ->setImage("marine_le_pen.png")
               ->setRarity(3);

        $manager->persist($politic);
        
        $manager->flush();

        /////////////////////////
        $politic = new Politic();
        $politic->setName("Marlène Schiappa")
               ->setParty("EM")
               ->setImage("marlene_schiappa.png")
               ->setRarity(2);

        $manager->persist($politic);
        
        $manager->flush();

        /////////////////////////
        $politic = new Politic();
        $politic->setName("Nathalie Arthaud")
               ->setParty("LO")
               ->setImage("nathalie_arthaud.png")
               ->setRarity(2);

        $manager->persist($politic);
        
        $manager->flush();

        /////////////////////////
        $politic = new Politic();
        $politic->setName("Nicolas Dupont-Aignan")
               ->setParty("DLF")
               ->setImage("nicolas_dupont-aignan.png")
               ->setRarity(2);

        $manager->persist($politic);
        
        $manager->flush();

        /////////////////////////
        $politic = new Politic();
        $politic->setName("Nicolas Hulot")
               ->setParty("Sans Parti")
               ->setImage("nicolas_hulot.png")
               ->setRarity(1);

        $manager->persist($politic);
        
        $manager->flush();

        /////////////////////////
        $politic = new Politic();
        $politic->setName("Nicolas Sarkozy")
               ->setParty("LR")
               ->setImage("nicolas_sarkozy.png")
               ->setRarity(1);

        $manager->persist($politic);
        
        $manager->flush();

        /////////////////////////
        $politic = new Politic();
        $politic->setName("Philippe Poutou")
               ->setParty("NPA")
               ->setImage("philippe_poutou.png")
               ->setRarity(1);

        $manager->persist($politic);
        
        $manager->flush();
        
    }
}
