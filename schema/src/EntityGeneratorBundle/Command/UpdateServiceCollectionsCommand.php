<?php

namespace EntityGeneratorBundle\Command;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateServiceCollectionsCommand extends ContainerAwareCommand
{
    /**
     * {@inheritDoc}
     */
    protected function configure()
    {
        $this
            ->setName('provider:update:service_collections')
            ->setDescription('Updates binded services of service collections');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $container = $this->getContainer();

        $containerRef = new \ReflectionClass($container);
        $aliasAccessor = $containerRef->getProperty('aliases');
        $aliasAccessor->setAccessible(true);
        $aliases = $aliasAccessor->getValue($container);

        $aliases =  array_filter(
            $aliases,
            function ($k) {

                if (strpos($k, '.lifecycle.') === false) {
                    return false;
                }

                if (strpos($k, '.service_collection') === false) {
                    return false;
                }

                return true;
            },
            ARRAY_FILTER_USE_KEY
        );

        foreach ($aliases as $serviceFqdn) {
            $output->writeln([
                'Updating <info>' . $serviceFqdn . '</info>',
            ]);
            $this->updateCollectionServices($serviceFqdn);
        }

        $output->writeln([
            '<info>Done!</info>',
        ]);
    }

    private function updateCollectionServices(string $serviceFqdn)
    {
        $container = $this->getContainer();

        $service = $container->get($serviceFqdn);
        $serviceRef = new \ReflectionClass($serviceFqdn);
        $servicesAccessor = $serviceRef->getProperty('services');
        $servicesAccessor->setAccessible(true);

        $services = $this->flattenServices(
            $servicesAccessor->getValue($service)
        );

        $addServiceMethod = $serviceRef->getMethod('addService');
        $addServiceMethodDocComment = $addServiceMethod->getDocComment();
        $docBlockLines = substr_count($addServiceMethodDocComment, "\n") + 1;

        $propertyBlockStartLine = $serviceRef->getStartLine() + 2;
        $propertyBlockEndLine = $addServiceMethod->getStartLine() - $docBlockLines - 1;

        $filePath = $serviceRef->getFileName();
        $fileContents = file_get_contents($filePath);
        $fileContentArray = explode("\n", $fileContents);

        $rest = array_splice(
            $fileContentArray,
            $propertyBlockStartLine,
            $propertyBlockEndLine,
            [$this->getBindedServices($services)]
        );

        array_splice(
            $rest,
            0,
            $propertyBlockEndLine - $propertyBlockStartLine
        );

        array_push($fileContentArray, ...$rest);
        $fileContents = implode("\n", $fileContentArray);

        file_put_contents(
            $filePath,
            $fileContents
        );
    }

    private function getBindedServices(array $services): string
    {
        foreach ($services as $event => $values) {
            foreach ($values as $class => $value) {
                if (is_numeric($class)) {
                    $services[$event][$class] = '\\' . $services[$event][$class] . '::class';
                    continue;
                }

                unset($services[$event][$class]);
                $services[$event]['\\'. $class. '::class'] = $value;
            }
            $services['"' . $event . '"'] = $services[$event];
            unset($services[$event]);
        }

        $spaces = str_repeat(' ', 4);
        $servicesStr = str_replace(
            ["=> \n", 'array (', ')', '\'', '\\\\', "  ", "\n"],
            ["=>\n", '[', ']', '', '\\', $spaces, "\n" . $spaces],
            var_export($services, true)
        );

        return
            "\n"
            . $spaces
            . 'public static $bindedBaseServices = '
            . $servicesStr
            . ";\n";
    }

    private function flattenServices(array $services)
    {
        $services = array_filter(
            $services,
            function ($services) {
                return !empty($services);
            }
        );

        $flattenServices = [];
        foreach ($services as $event => $eventServices) {
            $flattenServices[$event] = [];
            foreach ($eventServices as $eventService) {
                if (!$eventService instanceof LifecycleEventHandlerInterface) {
                    $flattenServices[$event][] = get_class($eventService);
                    continue;
                }

                $subscribedEvents = $eventService->getSubscribedEvents();
                $priority = $subscribedEvents[$event];

                $serviceClass = get_class($eventService);
                $flattenServices[$event][$serviceClass] = $priority;
            }
        }

        return $flattenServices;
    }
}
