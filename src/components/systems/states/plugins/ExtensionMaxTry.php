<?php
namespace jeyroik\extas\components\systems\states\plugins;

use jeyroik\extas\components\systems\states\StateExtension;
use jeyroik\extas\interfaces\systems\states\IStateExtension;
use jeyroik\extas\interfaces\systems\states\IStatePreventable;

/**
 * Class PluginMaxTry
 *
 * @package jeyroik\extas\components\systems\states\plugins
 * @author Funcraft <me@funcraft.ru>
 */
class ExtensionMaxTry extends StateExtension implements IStateExtension
{
    const STATE__ON_TERMINATE = 'on_terminate';
    const STATE__MAX_TRY = 'max_try';
    const STATE__CURRENT_TRIES_COUNT = 'current_tries_count';

    /**
     * @var int
     */
    protected $maxTry = 0;

    /**
     * @var int
     */
    protected $currentTriesCount = 0;

    /**
     * @var array
     */
    protected $methods = [
        'getMaxTry' => IStatePreventable::class,
        'getOnTerminate' => IStatePreventable::class,
        'incTry' => IStatePreventable::class,
        'getTriesCount' => IStatePreventable::class
    ];

    /**
     * @return int
     */
    public function getMaxTry(): int
    {
        return $this->state->getAdditional(static::STATE__MAX_TRY, 0);
    }

    /**
     * @return int
     */
    public function incTry(): int
    {
        $count = (int) $this->state->getAdditional(static::STATE__CURRENT_TRIES_COUNT);
        $count++;
        $this->state->setAdditional(static::STATE__CURRENT_TRIES_COUNT, $count);

        return $count;
    }

    /**
     * @return string
     */
    public function getOnTerminate(): string
    {
        return $this->state->getAdditional(static::STATE__ON_TERMINATE, '');
    }

    /**
     * @return int
     */
    public function getTriesCount(): int
    {
        return $this->state->getAdditional(static::STATE__CURRENT_TRIES_COUNT, 0);
    }
}
