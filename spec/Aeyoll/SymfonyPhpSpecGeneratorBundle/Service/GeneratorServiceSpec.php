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

        $namespace = 'Aeyoll\SymfonyPhpSpecGeneratorBundle\Service\GeneratorService';
        $this->setNamespace($namespace);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Aeyoll\SymfonyPhpSpecGeneratorBundle\Service\GeneratorService');
    }

    function it_should_implement_generator_service_interface()
    {
        $this->shouldImplement('Aeyoll\SymfonyPhpSpecGeneratorBundle\Service\GeneratorServiceInterface');
    }

    function it_should_get_a_builder_factory()
    {
        $this->getBuilderFactory()->shouldBeAnInstanceOf('\PhpParser\BuilderFactory');
    }

    function it_should_get_a_pretty_printer()
    {
        $this->getPrettyPrinter()->shouldBeAnInstanceOf('\PhpParser\PrettyPrinter\Standard');
    }

    function its_namespace_is_mutable()
    {
        $namespace = 'Aeyoll\SymfonyPhpSpecGeneratorBundle\Service\GeneratorService';
        $this->setNamespace($namespace);
        $this->getNamespace()->shouldReturn($namespace);
    }

    function it_should_return_the_correct_entity_class()
    {
        $this->getEntityClass()->shouldReturn('GeneratorService');
    }

    function it_should_return_the_correct_spec_path()
    {
        $this->getSpecPath()->shouldReturn('spec/Aeyoll/SymfonyPhpSpecGeneratorBundle/Service');
    }

    function it_should_return_the_correct_spec_class()
    {
        $this->getSpecClass()->shouldReturn('GeneratorServiceSpec');
    }

    function it_should_return_the_correct_spec_namespace()
    {
        $this->getSpecNamespace()->shouldReturn('spec\Aeyoll\SymfonyPhpSpecGeneratorBundle\Service');
    }
}
