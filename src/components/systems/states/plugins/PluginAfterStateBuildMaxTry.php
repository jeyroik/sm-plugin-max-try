<?php
namespace jeyroik\extas\components\systems\states\plugins;

use jeyroik\extas\components\systems\Plugin;
use jeyroik\extas\interfaces\systems\IState;
use jeyroik\extas\interfaces\systems\states\IStatePreventable;
use jeyroik\extas\interfaces\systems\states\plugins\IPluginAfterStateBuild;

/**
 * Class PluginAfterStateBuildMaxTry
 *
 * @package jeyroik\extas\components\systems\states\plugins
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
