<?php

namespace spec\Aeyoll\SymfonyPhpSpecGeneratorBundle\Service;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GeneratorServiceSpec extends ObjectBehavior
{
    function let(\Symfony\Component\DependencyInjection\Container $container)
    {
        $this->beConstructedWith($container);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Aeyoll\SymfonyPhpSpecGeneratorBundle\Service\GeneratorService');
    }

    function it_should_implement_generator_service_interface()
    {
        $this->shouldImplement('Aeyoll\SymfonyPhpSpecGeneratorBundle\Service\GeneratorServiceInterface');
    }
}
