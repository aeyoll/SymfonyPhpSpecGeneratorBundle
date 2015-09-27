<?php

namespace Aeyoll\SymfonyPhpSpecGeneratorBundle\Service;

use \Symfony\Component\DependencyInjection\Container;

class GeneratorService implements GeneratorServiceInterface
{
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }
}
