<?php

namespace App\Command;

use App\Entity\Notification;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class CheckNotifyCommand extends Command
{
    protected static $defaultName = 'app:check-notify';
    protected static $defaultDescription = 'Jakinerazpenik dagoen begiratu, baldin badago bidali.';
    private EntityManagerInterface $entityManager;
    private MailerInterface $mailer;

    public function __construct(EntityManagerInterface $entityManager, MailerInterface $mailer)
    {
        $this->entityManager = $entityManager;
        $this->mailer = $mailer;

        parent::__construct();
    }


    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('arg1');

        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }

        if ($input->getOption('option1')) {
            // ...
        }

        $notifications = $this->entityManager->getRepository(Notification::class)->getAllUnEmailedNotifications();
        $rows = [];
        /** @var Notification $notification */
        foreach ($notifications as $notification) {
            $fetxa = $notification->getNoiz()->format('Y-m-d');
            $kontratuIzena = $notification->getLote()->getKontratua()->getIzenaEus();
            $kontratuLote = $notification->getLote()->getName();
            $curr = date('Y-m-d');
            if ( $fetxa === $curr ) {
                $io->writeln($notification->getLote() . ' ==> ' . $fetxa);
                $row = [$notification->getLote(), $fetxa];
                $rows[] = $row;
                $email = (new Email())
                    ->from('iibarguren@pasaia.net')
                    ->to('iibarguren@pasaia.net')
                    ->subject('Jakinarazpen berria. Oroigarria')
                    ->text('Kaixo! Abixu berria duzu ondoko Kontratuarentzat:')
                    ->html("
                        <p>Kontratua: $kontratuIzena</p>
                        <p>Lotea: $kontratuLote</p>
                    ");

                $this->mailer->send($email);
                $notification->setEmailed(1);
                $this->entityManager->persist($notification);
                $this->entityManager->flush();
            }
        }


        $io->table(['Lote', 'Fetxa'], $rows);

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
