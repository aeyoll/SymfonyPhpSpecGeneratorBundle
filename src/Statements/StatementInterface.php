<?php

namespace Aeyoll\SymfonyPhpSpecGeneratorBundle\Statements;

interface StatementInterface
{
    public function getMethod();

    public function initStatements();
}
