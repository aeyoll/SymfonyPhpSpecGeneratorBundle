<?php

namespace Aeyoll\SymfonyPhpSpecGeneratorBundle\Service;

interface GeneratorServiceInterface
{
    /**
     * Return a PhpParser
     *
     * @return \PhpParser\Parser
     */
    public function getParser();

    /**
     * Return all the metadata from Doctrine
     *
     * @return
     */
    public function getAllMetadata();

    /**
     * Get the entities matching the specified namespace
     *
     * @param  string $namespace
     *
     * @return array
     */
    public function getEntities($namespace);
}
