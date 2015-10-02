<?php

namespace Aeyoll\SymfonyPhpSpecGeneratorBundle\Statements;

class ItsFieldsAreMutableStatement extends Statement
{
    /**
     * {@inheritDoc}
     */
    protected $methodName = 'its_fields_are_imutable';

    /**
     * {@inheritDoc}
     */
    public function initStatements()
    {
        $this->statements = array();
    }
}
