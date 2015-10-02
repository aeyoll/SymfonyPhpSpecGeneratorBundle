<?php

namespace Aeyoll\SymfonyPhpSpecGeneratorBundle\Statements;

class ItsFieldIsMutableStatement extends Statement
{
    /**
     * {@inheritDoc}
     */
    protected $methodName = 'its_field_is_imutable';

    /**
     * {@inheritDoc}
     */
    public function initStatements()
    {
        $this->statements = array();
    }
}
