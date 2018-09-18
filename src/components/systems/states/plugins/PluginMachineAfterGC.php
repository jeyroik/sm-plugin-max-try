<?php
namespace jeyroik\extas\components\systems\states\plugins;

use jeyroik\extas\components\systems\Plugin;
use jeyroik\extas\interfaces\systems\states\IStateMachine;

/**
 * Class PluginMachineAfterGC
 *
 * @package jeyroik\extas\components\systems\states\plugins
 * @author aivanov@fix.ru
 */
class PluginMachineAfterGC extends Plugin
{
    public $preDefinedStage = IStateMachine::SUBJECT . '.after';

    /**
     * @param IStateMachine $stateMachine
     */
    public function __invoke(IStateMachine $stateMachine)
    {
        PluginStateRunValidMaxTry::reset($stateMachine);
    }
}
