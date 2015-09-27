<?php

namespace Aeyoll\SymfonyPhpSpecGeneratorBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

const SRC_PATH              = 'src/';
const SPEC_PATH             = 'spec/';
const SPEC_NAMESPACE_PREFIX = 'spec\\';
const SPEC_CLASS_SUFFIX     = 'Spec';
const ARRAY_COLLECTION      = 'Doctrine\Common\Collections\ArrayCollection';

class PhpSpecCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('phpspec:generate')
            ->setDescription('Generate some default specs for a specific namespace')
            ->addArgument('namespace', InputArgument::REQUIRED, 'The namespace (eg: Acme)')
            ->addOption('force', null, InputOption::VALUE_NONE, 'Use to really write the files');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $generatorService = $this
            ->getContainer()
            ->get('aeyoll_symfony_php_spec_generator.service.generator');

        // Init the entities
        $entities = $generatorService->getEntities($input->getArgument('namespace'));

        // Init the factory
        $factory       = $generatorService->getBuilderFactory();
        $prettyPrinter = $generatorService->getPrettyPrinter();

        // Init the progress bar
        $progress = new ProgressBar($output, count($entities));

        // Parse each class
        foreach ($entities as $entity) {
            if ($input->getOption('verbose')) {
                echo $entity->name . "\n";
            }

            // Paths
            $relativePathname      = str_replace('\\', '/', $entity->name);
            $relativePathnameArray = explode('/', $relativePathname);

            $class = end($relativePathnameArray);

            array_pop($relativePathnameArray);

            $path     = implode('/', $relativePathnameArray);
            $specPath = SPEC_PATH . $path;

            // Namespaces
            $namespace     = $entity->name;
            $specNamespace = SPEC_NAMESPACE_PREFIX . $namespace;
            $specNamespace = explode('\\', $specNamespace);
            array_pop($specNamespace);
            $specNamespace = implode('\\', $specNamespace);

            $explodedNamespace = explode('\\', $namespace);

            // Classes
            $class     = end($explodedNamespace);
            $specClass = $class . SPEC_CLASS_SUFFIX;

            // Default factory
            $factoryThis  = new \PhpParser\Node\Expr\Variable('this');
            $factoryClass = $factory
                ->class($specClass)
                ->extend('ObjectBehavior')
                ->addStmt($factory
                    ->method('it_is_initializable')
                    ->addStmt(new \PhpParser\Node\Expr\MethodCall(
                        $factoryThis,
                        'shouldHaveType',
                        array(new \PhpParser\Node\Arg(new \PhpParser\Node\Scalar\String_($namespace)))
                    )))
                ->addStmt($factory
                    ->method('it_has_no_id_by_default')
                    ->addStmt(new \PhpParser\Node\Expr\MethodCall(
                        new \PhpParser\Node\Expr\MethodCall($factoryThis, 'getId'),
                        'shouldReturn',
                        array(new \PhpParser\Node\Arg(new \PhpParser\Node\Expr\ConstFetch(new \PhpParser\Node\Name('null'))))
                    )));

            foreach ($entity->fieldMappings as $name => $field) {
                if ($name !== 'id' && $name !== 'uuid') {
                    switch ($field['type']) {
                        case 'integer':
                            $value = new \PhpParser\Node\Scalar\LNumber(3);
                            break;

                        case 'string':
                        case 'text':
                        case 'guid':
                            $value = new \PhpParser\Node\Scalar\String_('A string');
                            break;

                        case 'boolean':
                            $value = new \PhpParser\Node\Expr\ConstFetch(new \PhpParser\Node\Name('true'));
                            break;

                        case 'datetime':
                            $value = new \PhpParser\Node\Expr\New_(new \PhpParser\Node\Name('\DateTime'));
                            break;

                        default:
                            $value = null;
                            break;
                    }

                    if (!is_null($value)) {
                        $factoryClass = $factoryClass
                            ->addStmt($factory
                                ->method('its_' . $name . '_is_mutable')
                                ->addStmt(new \PhpParser\Node\Expr\Assign(new \PhpParser\Node\Expr\Variable('value'), $value))
                                ->addStmt(new \PhpParser\Node\Expr\MethodCall(
                                    $factoryThis,
                                    'set' . ucfirst($name),
                                    array(new \PhpParser\Node\Arg(new \PhpParser\Node\Expr\Variable('value')))
                                ))
                                ->addStmt(new \PhpParser\Node\Expr\MethodCall(
                                    new \PhpParser\Node\Expr\MethodCall($factoryThis, 'get' . ucfirst($name)),
                                    'shouldReturn',
                                    array(new \PhpParser\Node\Arg(new \PhpParser\Node\Expr\Variable('value')))
                                )));
                    }
                }
            }

            foreach ($entity->associationMappings as $name => $association) {
                if (!is_null($association['mappedBy'])) {
                    $factoryClass = $factoryClass
                        ->addStmt($factory
                            ->method('its_' . $name . '_are_mutable')
                            ->addStmt(new \PhpParser\Node\Expr\Assign(new \PhpParser\Node\Expr\Variable('collection'), new \PhpParser\Node\Expr\New_(new \PhpParser\Node\Name('\\' . ARRAY_COLLECTION))))
                            ->addStmt(new \PhpParser\Node\Expr\MethodCall(
                                $factoryThis,
                                'set' . ucfirst($name),
                                array(new \PhpParser\Node\Arg(new \PhpParser\Node\Expr\Variable('collection')))
                            ))

                            ->addStmt(new \PhpParser\Node\Expr\MethodCall(
                                new \PhpParser\Node\Expr\MethodCall($factoryThis, 'get' . ucfirst($name)),
                                'shouldReturn',
                                array(new \PhpParser\Node\Arg(new \PhpParser\Node\Expr\Variable('collection')))
                            )));

                    $factoryClass = $factoryClass
                        ->addStmt($factory->method('it_initializes_' . $name . '_collection_by_default')
                            ->addStmt(new \PhpParser\Node\Expr\MethodCall(
                                new \PhpParser\Node\Expr\MethodCall($factoryThis, 'get' . ucfirst($name)),
                                'shouldHaveType',
                                array(new \PhpParser\Node\Arg(new \PhpParser\Node\Scalar\String_(ARRAY_COLLECTION)))
                            )));
                }
            }

            $node = $factory->namespace($specNamespace)
                ->addStmt($factory->use('PhpSpec\ObjectBehavior'))
                ->addStmt($factory->use(ARRAY_COLLECTION))
                ->addStmt($factoryClass)
                ->getNode();

            $specStmts = array($node);


            if ($input->getOption('verbose')) {
                echo $prettyPrinter->prettyPrintFile($specStmts);
            }

            if ($input->getOption('force')) {
                $fullSpecPath = $specPath . '/' . $class . 'Spec.php';

                if (!is_dir($specPath)) {
                    mkdir($specPath, 0755, true);
                }

                file_put_contents($fullSpecPath, $prettyPrinter->prettyPrintFile($specStmts));
            }

            $progress->advance();
        }

        $progress->finish();
    }
}
