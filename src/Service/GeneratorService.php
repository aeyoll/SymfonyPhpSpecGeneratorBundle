<?php

namespace Aeyoll\SymfonyPhpSpecGeneratorBundle\Service;

use \Symfony\Component\DependencyInjection\ContainerInterface;
use \Doctrine\ORM\EntityManagerInterface;

class GeneratorService implements GeneratorServiceInterface
{
    protected $container;

    protected $entityManager;

    public function __construct(ContainerInterface $container, EntityManagerInterface $entityManager)
    {
        $this->container     = $container;
        $this->entityManager = $entityManager;
    }

    /**
     * {@inheritDoc}
     */
    public function getParser()
    {
        return new \PhpParser\Parser(new \PhpParser\Lexer\Emulative);
    }

    /**
     * {@inheritDoc}
     */
    public function getBuilderFactory()
    {
        return new \PhpParser\BuilderFactory();
    }

    /**
     * {@inheritDoc}
     */
    public function getPrettyPrinter()
    {
        return new \PhpParser\PrettyPrinter\Standard();
    }

    /**
     * {@inheritDoc}
     */
    public function getAllMetadata()
    {
        return $this->entityManager->getMetadataFactory()->getAllMetadata();
    }

    /**
     * {@inheritDoc}
     *
     * @param string $namespace
     */
    public function getEntities($namespace)
    {
        $entities = array();
        $meta     = $this->getAllMetadata();

        if (count($meta) > 0) {
            foreach ($meta as $m) {
                if (preg_match('(' . $namespace . ')', $m->getName())) {
                    $entities[] = $m;
                }
            }
        } else {
            throw new \Exception("No entities where found", 1);
        }

        return $entities;
    }
}
