<?php

namespace Aeyoll\SymfonyPhpSpecGeneratorBundle\Statements;

class ItsFieldIsMutableStatement extends Statement
{
    /**
     * {@inheritDoc}
     */
    protected $methodName = 'its_field_is_mutable';

    /**
     * {@inheritDoc}
     */
    public function initStatements()
    {
        $this->statements = array();
    }
}
