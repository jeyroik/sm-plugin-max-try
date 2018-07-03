<?php
namespace jeyroik\extas\components\systems\states\plugins;

use jeyroik\extas\components\systems\Plugin;
use jeyroik\extas\interfaces\systems\IState;
use jeyroik\extas\interfaces\systems\states\IStateMachine;
use jeyroik\extas\interfaces\systems\states\IStatePreventable;
use jeyroik\extas\interfaces\systems\states\machines\plugins\IPluginStateRunValid;

/**
 * Class PluginIsStateValidMaxTry
 *
 * @package jeyroik\extas\components\systems\states\machines\plugins
 * @author Funcraft <me@funcraft.ru>
 */
class PluginStateRunValidMaxTry extends Plugin implements IPluginStateRunValid
{
    public $preDefinedStage = IStateMachine::STAGE__STATE_RUN_IS_VALID;

    protected static $statesTries = [];

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
                if (!isset(static::$statesTries[$state->getId()])) {
                    static::$statesTries[$state->getId()] = 0;
                }

                if (static::$statesTries[$state->getId()] >= $state->getMaxTry()) {
                    return false;
                }

                static::$statesTries[$state->getId()]++;

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
