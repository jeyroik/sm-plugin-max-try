<?php
namespace jeyroik\extas\components\systems\states\machines\plugins;

use jeyroik\extas\components\systems\Plugin;
use jeyroik\extas\components\systems\states\plugins\PluginAfterStateBuildMaxTry;
use jeyroik\extas\interfaces\systems\IPlugin;
use jeyroik\extas\interfaces\systems\states\IStateFactory;
use jeyroik\extas\interfaces\systems\states\IStateMachine;
use jeyroik\extas\interfaces\systems\states\machines\plugins\IPluginInitStateFactory;

class PluginInitStateFactoryMaxTry extends Plugin implements IPluginInitStateFactory
{
    /**
     * @param IStateMachine $machine
     * @param IStateFactory $stateFactory
     * @return null
     */
    public function __invoke(IStateMachine $machine, $stateFactory = null)
    {
        $stateFactory::injectPlugins([
            [
                IPlugin::FIELD__VERSION => '1.0',
                IPlugin::FIELD__STAGE => IStateFactory::STAGE__AFTER_STATE_BUILD,
                IPlugin::FIELD__CLASS => PluginAfterStateBuildMaxTry::class
            ]
        ]);

        return $stateFactory;
    }
}
