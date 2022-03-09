<?php

namespace App\DataFixtures;

use App\Entity\Arduraduna;
use App\Entity\Egoera;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $egoera = new Egoera();
        $egoera->setName('Eskuan  espedientea sortuta');
        $egoera->setNameEs('Creado el expediente en Eskua');
        $manager->persist($egoera);

        $egoera = new Egoera();
        $egoera->setName('Memoria egiten');
        $egoera->setNameEs('Elaborando memoria');
        $manager->persist($egoera);

        $egoera = new Egoera();
        $egoera->setName('Plegu teknikoak egiten');
        $egoera->setNameEs('Elaborando pliegos técnicos');
        $manager->persist($egoera);

        $egoera = new Egoera();
        $egoera->setName('Plegu administratiboak egiten');
        $egoera->setNameEs('Elaborando pliegos administrativos');
        $manager->persist($egoera);

        $egoera = new Egoera();
        $egoera->setName('Zuinketa akta');
        $egoera->setNameEs('Firmado el acta de replanteo');
        $manager->persist($egoera);

        $egoera = new Egoera();
        $egoera->setName('Argiratuta, eskaintzak aurkezteko epean');
        $egoera->setNameEs('Publicado, en plazo de presentación de ofertas');
        $manager->persist($egoera);

        $egoera = new Egoera();
        $egoera->setName('Kontratazio mahaietan');
        $egoera->setNameEs('En la mesas de contratación');
        $manager->persist($egoera);

        $egoera = new Egoera();
        $egoera->setName('Eskaintza onena esleitzeko dokumentazioa aurkezteko epean');
        $egoera->setNameEs('En plazo de presentación de la documentación para la adjudicación de la mejor oferta');
        $manager->persist($egoera);

        $egoera = new Egoera();
        $egoera->setName('Esleituta');
        $egoera->setNameEs('Adjudicado');
        $manager->persist($egoera);

        $egoera = new Egoera();
        $egoera->setName('Kontratua sinatua');
        $egoera->setNameEs('Contrato firmado');
        $manager->persist($egoera);

        $egoera = new Egoera();
        $egoera->setName('Zuinketa egiaztatzeko akta sinatuta');
        $egoera->setNameEs('Firmado el acta de comprobación de replanteo');
        $manager->persist($egoera);

        $egoera = new Egoera();
        $egoera->setName('Luzapena');
        $egoera->setNameEs('Prórroga');
        $manager->persist($egoera);

        $egoera = new Egoera();
        $egoera->setName('Amaitua');
        $egoera->setNameEs('Amaitua');
        $manager->persist($egoera);

        $arduraduna = new Arduraduna();
        $arduraduna->setName('Udala');
        $manager->persist($arduraduna);

        $arduraduna = new Arduraduna();
        $arduraduna->setName('Zentralizatua');
        $manager->persist($arduraduna);

        $manager->flush();
    }
}
