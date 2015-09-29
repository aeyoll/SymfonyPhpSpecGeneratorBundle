<?php

namespace Aeyoll\SymfonyPhpSpecGeneratorBundle\Service;

interface GeneratorServiceInterface
{
    /**
     * Return a PhpParserBuilderFactory
     *
     * @return \PhpParser\BuilderFactory
     */
    public function getBuilderFactory();

    /**
     * Return a PhpParser\PrettyPrinter
     *
     * @return \PhpParser\PrettyPrinter\Standard
     */
    public function getPrettyPrinter();

    /**
     * Return all the metadata from Doctrine
     *
     * @return
     */
    public function getAllMetadata();

    /**
     * Get the entities matching the specified bundle
     *
     * @param  string $bundle
     *
     * @return array
     */
    public function getEntities($bundle);

    /**
     * Set the namespace of the current entity
     *
     * @param  string $namespace
     *
     * @return self
     */
    public function setNamespace($namespace);

    /**
     * Get the namespace of the current entity
     *
     * @return string
     */
    public function getNamespace();

    /**
     * Return the class name of the current entity
     *
     * @return string
     */
    public function getEntityClass();

    /**
     * Return the spec file path
     *
     * @return string
     */
    public function getSpecPath();

    /**
     * Return the spec class name
     *
     * @return string
     */
    public function getSpecClass();

    /**
     * Return the spec namespace
     *
     * @return string
     */
    public function getSpecNamespace();

    /**
     * Add the "it_is_initializable" test
     */
    public function addInitializableTest();

    /**
     * Add the "it_has_no_id_by_default" test
     */
    public function addNoIdByDefaultTest();

    /**
     * Add the "its_field_is_mutable" test
     */
    public function addMutableTest();
}
