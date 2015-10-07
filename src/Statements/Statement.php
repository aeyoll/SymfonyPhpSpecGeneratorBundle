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
    public function __construct(\PhpParser\BuilderFactory $factory, $entityName)
    {
        if (!$factory instanceof \PhpParser\BuilderFactory) {
            throw new \Exception('You need to pass a \PhpParser\BuilderFactory to ' . __CLASS__ . ' first argument', 1);
        }

        if (is_null($entityName) || !is_string($entityName)) {
            throw new \Exception('You need to pass a correct entity name (string) to ' . __CLASS__ . ' second argument', 1);
        }

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
