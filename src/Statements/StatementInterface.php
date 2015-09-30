<?php

namespace Aeyoll\SymfonyPhpSpecGeneratorBundle\Statements;

interface StatementInterface
{
    /**
     * Return the builded content of the test method
     *
     * @return \PhpParser\Builder\Method
     */
    public function getMethod();

    /**
     * Return the name of the test method
     *
     * @return string
     */
    public function getMethodName();

    /**
     * Init the statements of the test
     */
    public function initStatements();
}
