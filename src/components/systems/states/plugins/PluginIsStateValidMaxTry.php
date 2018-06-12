<?php
namespace tratabor\components\systems\states\plugins;

use tratabor\interfaces\systems\IState;
use tratabor\interfaces\systems\states\IStateMachine;
use tratabor\interfaces\systems\states\IStatePreventable;
use tratabor\interfaces\systems\states\machines\plugins\IPluginIsStateValid;

/**
 * Class PluginIsStateValidMaxTry
 *
 * @package tratabor\components\systems\states\machines\plugins
 * @author Funcraft <me@funcraft.ru>
 */
class PluginIsStateValidMaxTry implements IPluginIsStateValid
{
    /**
     * @param IStateMachine $machine
     * @param IState|null $state
     *
     * @return bool
     */
    public function __invoke(IStateMachine $machine, IState $state = null)
    {
        if ($state->isImplementsInterface(IStatePreventable::class)) {
            /**
             * @var $state IStatePreventable
             */
            if ($state->getMaxTry() && ($state->getTriesCount() <= $state->getMaxTry())) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param IState|null|IStatePreventable $state
     *
     * @return IState
     */
    public function onValid(IState $state = null)
    {
        $state->incTry();

        return $state;
    }

    /**
     * @param IState|null|IStatePreventable $state
     * @return mixed
     *
     */
    public function onInvalid(IState $state = null)
    {
        return $state->isImplementsInterface(IStatePreventable::class)
            ? $state->getOnTerminate()
            : false;
    }
}