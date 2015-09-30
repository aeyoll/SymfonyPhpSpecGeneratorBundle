<?php

namespace spec\Aeyoll\SymfonyPhpSpecGeneratorBundle\Statements;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\EntityManagerInterface;

class ItIsInitializableStatementSpec extends ObjectBehavior
{
    function let(\PhpParser\BuilderFactory $factory)
    {
        $this->beConstructedWith($factory, 'entityName');
    }

    function it_has_a_correct_method_name()
    {
        $this->getMethodName()->shouldReturn('it_is_initializable');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Aeyoll\SymfonyPhpSpecGeneratorBundle\Statements\ItIsInitializableStatement');
    }

    function it_should_extend_statement_class()
    {
        $this->shouldHaveType('Aeyoll\SymfonyPhpSpecGeneratorBundle\Statements\Statement');
    }

    function it_should_implement_statement_interface()
    {
        $this->shouldImplement('Aeyoll\SymfonyPhpSpecGeneratorBundle\Statements\StatementInterface');
    }
}