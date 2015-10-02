<?php

namespace Aeyoll\SymfonyPhpSpecGeneratorBundle\Statements;

class ItHasNoIdByDefaultStatement extends Statement
{
    /**
     * {@inheritDoc}
     */
    protected $methodName = 'it_has_no_id_by_default';

    /**
     * {@inheritDoc}
     */
    public function initStatements()
    {
        $this->statements = array();
    }
}
