<?php

namespace Aeyoll\SymfonyPhpSpecGeneratorBundle\Statements;

class ItsFieldsAreMutableStatement extends Statement
{
    /**
     * {@inheritDoc}
     */
    protected $methodName = 'its_fields_are_mutable';

    /**
     * {@inheritDoc}
     */
    public function initStatements()
    {
        $this->statements = array();
    }
}
