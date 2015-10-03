<?php

namespace spec\Aeyoll\SymfonyPhpSpecGeneratorBundle\Statements;

use PhpSpec\ObjectBehavior;

class ItHasNoIdByDefaultStatementSpecSpec extends ObjectBehavior
{
    function let(\PhpParser\BuilderFactory $factory)
    {
        $this->beConstructedWith($factory, 'entityName');
    }

    function it_should_thrown_an_exception_if_constructed_with_incorrect_factory()
    {
        $this->beConstructedWith(null, 'entityName');
        $this->shouldThrow('\Exception');
    }

    function it_should_thrown_an_exception_if_constructed_with_incorrect_entity_name(\PhpParser\BuilderFactory $factory)
    {
        $this->beConstructedWith($factory, null);
        $this->shouldThrow('\Exception');
    }

    function it_has_a_valid_method_name()
    {
        $this->getMethodName()->shouldReturn('it_has_no_id_by_default');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Aeyoll\SymfonyPhpSpecGeneratorBundle\Statements\ItHasNoIdByDefaultStatementSpec');
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
