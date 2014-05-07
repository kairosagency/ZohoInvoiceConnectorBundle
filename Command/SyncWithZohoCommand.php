<?php
namespace Kairos\ZohoInvoiceConnectorBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Doctrine\ORM\Mapping\ClassMetadataInfo;

use Kairos\ZohoInvoiceConnectorBundle\Reflection\ClassAnalyzer;

class SyncWithZohoCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        parent::configure();

        $this->setName('kairos:zohoinvoiceconnector:sync')
            ->setDescription('Synchronize entities with zoho invoice')
            ->setHelp(<<<EOT
The <info>kairos:zohoinvoiceconnector:sync</info> command synchronise out of sync entities with zoho invoice

EOT
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $classAnalyzer = new ClassAnalyzer();

        $em = $this->getContainer()->get('doctrine.orm.entity_manager');
        $classes = $em->getConfiguration()->getMetadataDriverImpl()->getAllClassNames();

        foreach($classes AS $class) {
            $classMetadata = $em->getClassMetadata($class);

            if($classAnalyzer->hasTrait($classMetadata->reflClass, 'Kairos\ZohoInvoiceConnectorBundle\Model\Invoice\InvoiceConnector')) {
                $unsynced = $em->getRepository($class)->findBy(array('synced' => false));
                foreach($unsynced AS $entity) {
                    $output->writeln('<info>Found unsynced entity of class </info>' . '<comment>' . $class . '</comment>');
                    $output->writeln('<info>with id </info>' . '<comment>' . $entity->getId() . '</comment>');
                    $entity->refreshSyncedTimestamp();
                    $em->persist($entity);
                    $em->flush();
                    $output->writeln('<comment>Synching entity ...</comment>');
                }
            }

            if($classAnalyzer->hasTrait($classMetadata->reflClass, 'Kairos\ZohoInvoiceConnectorBundle\Model\Item\ItemConnector')) {
                $unsynced = $em->getRepository($class)->findBy(array('synced' => false));
                foreach($unsynced AS $entity) {
                    $output->writeln('<info>Found unsynced entity of class </info>' . '<comment>' . $class . '</comment>');
                    $output->writeln('<info>with id </info>' . '<comment>' . $entity->getId() . '</comment>');
                    $entity->refreshSyncedTimestamp();
                    $em->persist($entity);
                    $em->flush();
                    $output->writeln('<comment>Synching entity ...</comment>');
                }
            }

            if($classAnalyzer->hasTrait($classMetadata->reflClass, 'Kairos\ZohoInvoiceConnectorBundle\Model\Contact\ContactConnector')) {
                $unsynced = $em->getRepository($class)->findBy(array('synced' => false));
                foreach($unsynced AS $entity) {
                    $output->writeln('<info>Found unsynced entity of class </info>' . '<comment>' . $class . '</comment>');
                    $output->writeln('<info>with id </info>' . '<comment>' . $entity->getId() . '</comment>');
                    $entity->refreshSyncedTimestamp();
                    $em->persist($entity);
                    $em->flush();
                    $output->writeln('<comment>Synching entity ...</comment>');
                }
            }

        }
        $output->writeln('<info>Job done without issues !</info>');
        return 0;
    }
}