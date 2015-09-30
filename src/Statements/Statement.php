<?php

namespace Aeyoll\SymfonyPhpSpecGeneratorBundle\Statements;

abstract class Statement implements StatementInterface
{
    /**
     * @var \PhpParser\BuilderFactory
     */
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
     * @var array
     */
    protected $statements;

    /**
     * @{inheritDoc}
     *
     * @param \PhpParser\BuilderFactory $factory
     * @param string                    $entityName
     */
    public function __construct(\PhpParser\BuilderFactory $factory, string $entityName)
    {
        $this->factory    = $factory;
        $this->entityName = $entityName;

        $this->initStatements();
    }

    /**
     * @{inheritDoc}
     */
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

    /**
     * @{inheritDoc}
     */
    public function getMethodName()
    {
        return $this->methodName;
    }
}
