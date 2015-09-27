<?php

namespace spec\Aeyoll\SymfonyPhpSpecGeneratorBundle\Service;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\EntityManagerInterface;

class GeneratorServiceSpec extends ObjectBehavior
{
    function let(ContainerInterface $container, EntityManagerInterface $entityManager)
    {
        $this->beConstructedWith(
            $container,
            $entityManager
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Aeyoll\SymfonyPhpSpecGeneratorBundle\Service\GeneratorService');
    }

    function it_should_implement_generator_service_interface()
    {
        $this->shouldImplement('Aeyoll\SymfonyPhpSpecGeneratorBundle\Service\GeneratorServiceInterface');
    }

    function it_should_get_a_parser()
    {
        $this->getParser()->shouldBeAnInstanceOf('\PhpParser\Parser');
    }

    function it_should_get_a_builder_factory()
    {
        $this->getBuilderFactory()->shouldBeAnInstanceOf('\PhpParser\BuilderFactory');
    }

    function it_should_get_a_pretty_printer()
    {
        $this->getPrettyPrinter()->shouldBeAnInstanceOf('\PhpParser\PrettyPrinter\Standard');
    }
}
