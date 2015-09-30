<?php

namespace Aeyoll\SymfonyPhpSpecGeneratorBundle\Statements;

use Doctrine\Common\Collections\ArrayCollection;

abstract class Statement implements StatementInterface
{
    protected $factory;

    /**
     * @var string
     */
    protected $methodName;

    /**
     * @var string
     */
    protected $entityName;

    /**
     * @var ArrayCollection
     */
    protected $statements;

    public function __construct($factory, $entityName)
    {
        $this->factory    = $factory;
        $this->entityName = $entityName;

        $this->initStatements();
    }

    public function getMethod()
    {
        $method = $this->factory->method($this->methodName);

        if (count($this->statements) > 0) {
            foreach ($this->statements as $statement) {
                $method->addStmt($statement);
            }
        }

        return $method;
    }
}
