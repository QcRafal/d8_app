<?php

namespace Drupal\app_rest_api\Api;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class CommandCollector
 */
class CommandCollector implements CommandDispatcherInterface
{
    /**
     * @var ArrayCollection|CommandInterface[]
     */
    private $commands;

    /**
     * CommandCollector constructor.
     */
    public function __construct()
    {
        $this->commands = new ArrayCollection();
    }

    /**
     * @param CommandInterface $command
     * @param string $module
     * @param string $action
     *
     * @return $this
     */
    public function addCommand(CommandInterface $command, $module, $action)
    {
        if ($this->commands->containsKey(self::key($module, $action))) {
//            throw new AlreadyDefinedCommand($command);
        }

        $this->commands->set(self::key($module, $action), $command);

        return $this;
    }

    /**
     * @param string $module
     * @param string $action
     * @param CommandInputInterface $params
     *
     * @return mixed
     */
    public function dispatch($module, $action, CommandInputInterface $params = null)
    {
        $command = $this->commands->get(self::key($module, $action));

        if (!$command) {
            throw new NotFoundHttpException(
                sprintf('Command for module \'%s\' and action \'%s\' Not Found', $module, $action)
            );
        }

        return $command($params);
    }

    /**
     * @param string $module
     * @param string $action
     * @return string
     */
    protected static function key($module, $action)
    {
        return sprintf('%s/%s', $module, $action);
    }
}
