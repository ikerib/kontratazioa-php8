<?php

namespace App\DataFixtures;

use App\Entity\Arduraduna;
use App\Entity\Egoera;
use App\Entity\Kontaktuak;
use App\Entity\Saila;
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

        /********************************************************************************************/
        /*** KONTAKTUAK *****************************************************************************/
        /********************************************************************************************/

        // IDAZKARITZA
        $sailaIdazkaritza = $manager->getRepository(Saila::class)->findOneBy([ 'izena' =>'IDAZKARITZA']);
        $kontaktua = new Kontaktuak();
        $kontaktua->setName('Aitziber Latasa');
        $kontaktua->setEmail('altasa@pasaia.net');
        $kontaktua->setSaila($sailaIdazkaritza);
        $manager->persist($kontaktua);

        $kontaktua = new Kontaktuak();
        $kontaktua->setName('Leire Magarino');
        $kontaktua->setEmail('lmagarino@pasaia.net');
        $kontaktua->setSaila($sailaIdazkaritza);
        $manager->persist($kontaktua);

        $kontaktua = new Kontaktuak();
        $kontaktua->setName('Manex Etxeberria');
        $kontaktua->setEmail('metxeberria@pasaia.net');
        $kontaktua->setSaila($sailaIdazkaritza);
        $manager->persist($kontaktua);

        $kontaktua = new Kontaktuak();
        $kontaktua->setName('Idazkaritza taldea');
        $kontaktua->setEmail('idazkaritza@taldeak.pasaia.net');
        $kontaktua->setSaila($sailaIdazkaritza);
        $manager->persist($kontaktua);

        // GAZTERIA
        $sailaGazteria = $manager->getRepository(Saila::class)->findOneBy(['izena' => 'GAZTERIA']);
        $kontaktua = new Kontaktuak();
        $kontaktua->setName('Gazteria taldea');
        $kontaktua->setEmail('gazteria@taldeak.pasaia.net');
        $kontaktua->setSaila($sailaGazteria);
        $manager->persist($kontaktua);

        $kontaktua = new Kontaktuak();
        $kontaktua->setName('Christina Vazquez');
        $kontaktua->setEmail('cvazquez@pasaia.net');
        $kontaktua->setSaila($sailaGazteria);
        $manager->persist($kontaktua);

        // GIZARTE EKINTZA
        $gizarteEkintzaSaila = $manager->getRepository(Saila::class)->findOneBy(['izena' => 'GIZARTEKINTZA']);
        $kontaktua = new Kontaktuak();
        $kontaktua->setName('Gizarte Ekintza Taldea');
        $kontaktua->setEmail('gizartekintza@taldeak.pasaia.net');
        $kontaktua->setSaila($gizarteEkintzaSaila);
        $manager->persist($kontaktua);

        $kontaktua = new Kontaktuak();
        $kontaktua->setName('Bego de Miguel');
        $kontaktua->setEmail('bego@pasaia.net');
        $kontaktua->setSaila($gizarteEkintzaSaila);
        $manager->persist($kontaktua);

        $kontaktua = new Kontaktuak();
        $kontaktua->setName('Maje');
        $kontaktua->setEmail('maje@pasaia.net');
        $kontaktua->setSaila($gizarteEkintzaSaila);
        $manager->persist($kontaktua);

        // ZERBITZUAK
        $zerbitzuakSaila = $manager->getRepository(Saila::class)->findOneBy(['izena' => 'ZERBITUZAK']);
        $kontaktua = new Kontaktuak();
        $kontaktua->setName('Zerbitzuak taldea');
        $kontaktua->setEmail('zerbitzuak@taldeak.pasaia.net');
        $kontaktua->setSaila($zerbitzuakSaila);
        $manager->persist($kontaktua);

        $kontaktua = new Kontaktuak();
        $kontaktua->setName('Jaione Barandiaran');
        $kontaktua->setEmail('jbarandiaran@pasaia.net');
        $kontaktua->setSaila($zerbitzuakSaila);
        $manager->persist($kontaktua);

        $kontaktua = new Kontaktuak();
        $kontaktua->setName('Jose Mitxelena');
        $kontaktua->setEmail('jmitxelena@pasaia.net');
        $kontaktua->setSaila($zerbitzuakSaila);
        $manager->persist($kontaktua);

        $kontaktua = new Kontaktuak();
        $kontaktua->setName('Josu Salgado');
        $kontaktua->setEmail('jsalgado@pasaia.net');
        $kontaktua->setSaila($zerbitzuakSaila);
        $manager->persist($kontaktua);

        // KIROLAK
        $kirolakSaila = $manager->getRepository(Saila::class)->findOneBy(['izena' => 'KIROLAK']);
        $kontaktua = new Kontaktuak();
        $kontaktua->setName('Kirolak taldea');
        $kontaktua->setEmail('kirolak@taldeak.pasaia.net');
        $kontaktua->setSaila($kirolakSaila);
        $manager->persist($kontaktua);

        $kontaktua = new Kontaktuak();
        $kontaktua->setName('Ibai Saavedra');
        $kontaktua->setEmail('isaavedra@pasaia.net');
        $kontaktua->setSaila($kirolakSaila);
        $manager->persist($kontaktua);

        // HIRIGINTZA
        $hirigintzaSaila = $manager->getRepository(Saila::class)->findOneBy(['izena' => 'HIRIGINTZA']);
        $kontaktua = new Kontaktuak();
        $kontaktua->setName('Hirigintza taldea');
        $kontaktua->setEmail('hirigintza@taldeak.pasaia.net');
        $kontaktua->setSaila($hirigintzaSaila);
        $manager->persist($kontaktua);

        $kontaktua = new Kontaktuak();
        $kontaktua->setName('Andrea Salaberri');
        $kontaktua->setEmail('asalaberri@pasaia.net');
        $kontaktua->setSaila($hirigintzaSaila);
        $manager->persist($kontaktua);

        $kontaktua = new Kontaktuak();
        $kontaktua->setName('Joana Auzokoa');
        $kontaktua->setEmail('jauzokoa@pasaia.net');
        $kontaktua->setSaila($hirigintzaSaila);
        $manager->persist($kontaktua);

        // INFORMATIKA
        $informatikaSaila = $manager->getRepository(Saila::class)->findOneBy(['izena' => 'INFORMATIKA']);
        $kontaktua = new Kontaktuak();
        $kontaktua->setName('Informatika taldea');
        $kontaktua->setEmail('informatika@taldeak.pasaia.net');
        $kontaktua->setSaila($informatikaSaila);
        $manager->persist($kontaktua);

        $kontaktua = new Kontaktuak();
        $kontaktua->setName('Rafel');
        $kontaktua->setEmail('rafel@pasaia.net');
        $kontaktua->setSaila($informatikaSaila);
        $manager->persist($kontaktua);

        // PERTSONALA
        $pertsonalaSaila = $manager->getRepository(Saila::class)->findOneBy(['izena' => 'PERTSONALA']);
        $kontaktua = new Kontaktuak();
        $kontaktua->setName('Pertsonala taldea');
        $kontaktua->setEmail('pertsonala@taldeak.pasaia.net');
        $kontaktua->setSaila($pertsonalaSaila);
        $manager->persist($kontaktua);

        $kontaktua = new Kontaktuak();
        $kontaktua->setName('Ruth Gonzalez');
        $kontaktua->setEmail('rgonzalez@pasaia.net');
        $kontaktua->setSaila($pertsonalaSaila);
        $manager->persist($kontaktua);

        // UDALTZAINGOA
        $udaltzaingoaSaila = $manager->getRepository(Saila::class)->findOneBy(['izena' => 'UDALTZAINGOA']);
        $kontaktua = new Kontaktuak();
        $kontaktua->setName('Udaltzaingoa taldea');
        $kontaktua->setEmail('udaltzaingoa@taldeak.pasaia.net');
        $kontaktua->setSaila($udaltzaingoaSaila);
        $manager->persist($kontaktua);

        $kontaktua = new Kontaktuak();
        $kontaktua->setName('Faya');
        $kontaktua->setEmail('faya@pasaia.net');
        $kontaktua->setSaila($udaltzaingoaSaila);
        $manager->persist($kontaktua);

        // KULTURA
        $kulturaSaila = $manager->getRepository(Saila::class)->findOneBy(['izena' => 'KULTURA']);
        $kontaktua = new Kontaktuak();
        $kontaktua->setName('Kultura taldea');
        $kontaktua->setEmail('kultura@taldeak.pasaia.net');
        $kontaktua->setSaila($kulturaSaila);
        $manager->persist($kontaktua);

        $kontaktua = new Kontaktuak();
        $kontaktua->setName('Beatriz Caballero');
        $kontaktua->setEmail('beatriz@pasaia.net');
        $kontaktua->setSaila($kulturaSaila);
        $manager->persist($kontaktua);

        $manager->flush();
    }
}
