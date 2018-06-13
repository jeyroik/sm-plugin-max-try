<?php
namespace tratabor\components\systems\states\machines\plugins;

use tratabor\components\systems\Plugin;
use tratabor\components\systems\states\plugins\PluginAfterStateBuildMaxTry;
use tratabor\interfaces\systems\IPlugin;
use tratabor\interfaces\systems\states\IStateFactory;
use tratabor\interfaces\systems\states\IStateMachine;
use tratabor\interfaces\systems\states\machines\plugins\IPluginInitStateFactory;

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
