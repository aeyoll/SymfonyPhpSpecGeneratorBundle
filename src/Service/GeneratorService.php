<?php

namespace Aeyoll\SymfonyPhpSpecGeneratorBundle\Service;

use \Symfony\Component\DependencyInjection\ContainerInterface;
use \Doctrine\ORM\EntityManagerInterface;

class GeneratorService implements GeneratorServiceInterface
{
    protected $container;

    protected $entityManager;

    protected $namespace;

    protected $entityClass;

    protected $specClass;

    protected $specPath;

    protected $specNamespace;

    public function __construct(ContainerInterface $container, EntityManagerInterface $entityManager)
    {
        $this->container     = $container;
        $this->entityManager = $entityManager;
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
     * @param string $bundle
     */
    public function getEntities($bundle)
    {
        $entities = array();
        $meta     = $this->getAllMetadata();

        if (count($meta) > 0) {
            foreach ($meta as $m) {
                if (preg_match('(' . $bundle . ')', $m->getName())) {
                    $entities[] = $m;
                }
            }
        } else {
            throw new \Exception("No entities where found", 1);
        }

        return $entities;
    }

    /**
     * {@inheritDoc}
     *
     * @param  string $namespace
     */
    public function setNamespace($namespace)
    {
        $this->namespace = $namespace;

        $relativePathname      = str_replace('\\', '/', $this->namespace);
        $relativePathnameArray = explode('/', $relativePathname);

        $this->entityClass = end($relativePathnameArray);

        array_pop($relativePathnameArray);
        $path = implode('/', $relativePathnameArray);

        $this->specPath      = 'spec/' . $path;
        $this->specClass     = $this->entityClass . 'Spec';
        $this->specNamespace = str_replace('/', '\\', $this->specPath);
    }

    /**
     * {@inheritDoc}
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * {@inheritDoc}
     */
    public function getEntityClass()
    {
        return $this->entityClass;
    }

    /**
     * {@inheritDoc}
     */
    public function getSpecPath()
    {
        return $this->specPath;
    }

    /**
     * {@inheritDoc}
     */
    public function getSpecClass()
    {
        return $this->specClass;
    }

    /**
     * {@inheritDoc}
     */
    public function getSpecNamespace()
    {
        return $this->specNamespace;
    }
}
