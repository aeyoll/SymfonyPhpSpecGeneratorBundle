<?php

namespace Aeyoll\SymfonyPhpSpecGeneratorBundle\Statements;

class ItInitializesFieldCollectionByDefaultStatement extends Statement
{
    /**
     * {@inheritDoc}
     */
    protected $methodName = 'it_initializes_field_collection_by_default';

    /**
     * {@inheritDoc}
     */
    public function initStatements()
    {
        $this->statements = array();
    }
}
