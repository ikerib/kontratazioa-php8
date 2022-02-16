<?php

namespace App\Command;

use App\Entity\Kontratista;
use App\Entity\Kontratua;
use App\Entity\KontratuaLote;
use App\Entity\Mota;
use App\Entity\Prozedura;
use App\Entity\Saila;
use Carbon\Carbon;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ImportCommand extends Command
{
    protected static $defaultName = 'app:import';
    protected static $defaultDescription = 'Add a short description for your command';
    private string $projectDir;
    private EntityManagerInterface $entityManager;

    public function __construct($projectDir, EntityManagerInterface $entityManager)
    {
        $this->projectDir = $projectDir;
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('fitxategia', InputArgument::REQUIRED, 'fitxategia')
//            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $filename = $input->getArgument('fitxategia');

        $kontratuMotaRepo = $this->entityManager->getRepository(Mota::class);
        $prozeduraRepo = $this->entityManager->getRepository(Prozedura::class);
        $sailaRepo = $this->entityManager->getRepository(Saila::class);

        $kontratuak = $this->getCsvAsArray($filename);

        $progressBar = new ProgressBar($output, count($kontratuak));
        $progressBar->start();
        $aurrekoa =null;
        $aurrekoK = null;
        foreach ($kontratuak as $kontratua) {
            if ( $aurrekoa === $kontratua['ZERBITZUA'] ){
                $this->addLote($io, $kontratua, $aurrekoK);
            } else {
                $progressBar->setMessage($kontratua['ESPEDIENTEA /EXPEDIENTE']);
                $k = new Kontratua();
                $k->setEspedientea($kontratua['ESPEDIENTEA /EXPEDIENTE']);
                $k->setIzenaEus($kontratua['ZERBITZUA']);
                $aurrekoa = $kontratua['ZERBITZUA'];
                $k->setIzenaEs($kontratua['SERVICIO']);
                // Kontratu mota datu basean ez badago, sortu
                if (!$kontratuMota = $kontratuMotaRepo->findOneBy(['mota_eus' => $kontratua['KONTRATU MOTA /TIPO CONTRATO']])) {
                    $kontratuMota = new Mota();
                    $kontratuMota->setMotaEus($kontratua['KONTRATU MOTA /TIPO CONTRATO']);
                    $kontratuMota->setMotaEs($kontratua['KONTRATU MOTA /TIPO CONTRATO']);
                    $this->entityManager->persist($kontratuMota);
                    $this->entityManager->flush();
                }
                $k->setMota($kontratuMota);

                // Prozedura datu basean ez badago, sortu
                if (!$prozedura = $prozeduraRepo->findOneBy(['prozedura_eus' => $kontratua['PROZEDIURA /PROCEDIMIENTO']])) {
                    $prozedura = new Prozedura();
                    $prozedura->setProzeduraEus($kontratua['PROZEDIURA /PROCEDIMIENTO']);
                    $prozedura->setProzeduraEs($kontratua['PROZEDIURA /PROCEDIMIENTO']);
                    $this->entityManager->persist($prozedura);
                    $this->entityManager->flush();
                }
                $k->setProzedura($prozedura);
                // Saila DB-an ez badago, sortu
                if (!$saila = $sailaRepo->findOneBy(['izena' => $kontratua['SAILA / DEPARTAMENTO']])) {
                    $saila = new Saila();
                    $saila->setIzena($kontratua['SAILA / DEPARTAMENTO']);
                    $this->entityManager->persist($saila);
                    $this->entityManager->flush();
                }
                $k->setSaila($saila);
                $k->setOharrak($kontratua['OHARRAK / OBSERVACIONES']);

                $this->addLote($io, $kontratua, $k);
                $aurrekoK = $k;


                $this->entityManager->persist($k);
            }
            $progressBar->advance();
        }
        $this->entityManager->flush();
        $progressBar->finish();


        $io->success('Inportazioa amaitu da.');

        return Command::SUCCESS;
    }

    private function getCsvAsArray($filename) {
        $inputFile = $this->projectDir . '/' . $filename ;
        $decorder = new Serializer([new ObjectNormalizer()], [new CsvEncoder()]);
        return $decorder->decode(file_get_contents($inputFile), 'csv', [CsvEncoder::DELIMITER_KEY => '|']);
    }

    private function addLote($io, $kontratua, $k) {
        $kontratistaRepo = $this->entityManager->getRepository(Kontratista::class);
        $lote = new KontratuaLote();
        $lote->setKontratua($k);
        $lote->setName($kontratua['LOTE']);
        $lote->setAurrekontuaIva((float)$kontratua["OINARRIZKO AURREKONTUA / IMPORTE LICITACION (CON IVA)"]);
        $lote->setAurrekontuaIvaGabe((float)$kontratua["OINARRIZKO AURREKONTUA / IMPORTE LICITACION (SIN IVA)"]);
        $lote->setZenbatekoarenUnitatea($kontratua['ZENBATEKOAREN UNITATEA']);

        // Kontratista DB-an ez badago, sortu
        if (!$kontratista = $kontratistaRepo->findOneBy(['izena_eus' => $kontratua['KONTRATISTA / CONTRATISTA']])) {
            $kontratista = new Kontratista();
            $kontratista->setIzenaEus($kontratua['KONTRATISTA / CONTRATISTA']);
            $this->entityManager->persist($kontratista);
            $this->entityManager->flush();
        }
        $lote->setKontratista($kontratista);

        try {
            $d = new \DateTime($kontratua['KONTRATU SINADURA / FIRMA DE CONTRATO']);
        } catch (\Exception  $e) {
            $io->info($kontratua['ESPEDIENTEA /EXPEDIENTE'] . ' ' . $kontratua['ZERBITZUA'] . ' ==> sinadura data ezin izan da Datetime bihurtu.');
            exit;
        }

        $lote->setSinadura($d);
        $lote->setIraupena($kontratua['IRAUPENA / DURACION']);
        $lote->setAdjudikazioaIva((float)$kontratua['ADJUDIKAZIOAREN ZENBATEKOA / IMPORTE ADJUDICACIÓN  (CON IVA)']);
        $lote->setAdjudikazioaIvaGabe((float)$kontratua['ADJUDIKAZIOAREN ZENBATEKOA / IMPORTE ADJUDICACIÓN (SIN IVA)']);
//        $lote->setAmaitua($kontratua['KONTRATU AMAIERA /CONTRATO VENCIDO']);
        $lote->setLuzapena($kontratua['LUZAPENAK (URTEAK) / PRORROGA/AÑOS']);
        $this->entityManager->persist($lote);
    }

}
