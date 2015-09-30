<?php

namespace Aeyoll\SymfonyPhpSpecGeneratorBundle\Statements;

use Doctrine\Common\Collections\ArrayCollection;

class ItIsInitializableStatement extends Statement
{
    /**
     * {@inheritDoc}
     */
    protected $methodName = 'it_is_initializable';

    /**
     * {@inheritDoc}
     */
    public function initStatements()
    {
        $this->statements = array(
            new \PhpParser\Node\Expr\MethodCall(
                new \PhpParser\Node\Expr\Variable('this'),
                'shouldHaveType',
                array(new \PhpParser\Node\Arg(new \PhpParser\Node\Scalar\String_($this->entityName)))
            )
        );
    }
}
