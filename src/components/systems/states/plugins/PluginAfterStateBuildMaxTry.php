<?php
namespace tratabor\components\systems\states\plugins;

use tratabor\components\systems\Plugin;
use tratabor\interfaces\systems\IState;
use tratabor\interfaces\systems\states\IStatePreventable;
use tratabor\interfaces\systems\states\plugins\IPluginAfterStateBuild;

/**
 * Class PluginAfterStateBuildMaxTry
 *
 * @package tratabor\components\systems\states\plugins
 * @author Funcraft <me@funcraft.ru>
 */
class PluginAfterStateBuildMaxTry extends Plugin implements IPluginAfterStateBuild
{
    /**
     * @param IState $state
     *
     * @return IState
     */
    public function __invoke(IState $state): IState
    {
        $state->registerInterface(IStatePreventable::class, new ExtensionMaxTry());

        return $state;
    }
}
