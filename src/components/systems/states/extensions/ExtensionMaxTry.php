<?php
namespace jeyroik\extas\components\systems\states\extensions;

use jeyroik\extas\components\systems\Extension;
use jeyroik\extas\components\systems\extensions\TExtendable;
use jeyroik\extas\interfaces\systems\IState;
use jeyroik\extas\interfaces\systems\states\IStatePreventable;

/**
 * Class PluginMaxTry
 *
 * @package jeyroik\extas\components\systems\states\plugins
 * @author Funcraft <me@funcraft.ru>
 */
class ExtensionMaxTry extends Extension implements IStatePreventable
{
    const STATE__ON_TERMINATE = 'on_terminate';
    const STATE__MAX_TRY = 'max_try';
    const STATE__CURRENT_TRIES_COUNT = 'current_tries_count';

    use TExtendable;

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
    public $methods = [
        'getMaxTry' => IStatePreventable::class,
        'getOnTerminate' => IStatePreventable::class,
        'incTry' => IStatePreventable::class,
        'getTriesCount' => IStatePreventable::class
    ];

    public $subject = IState::SUBJECT;

    /**
     * @param $state
     *
     * @return int
     */
    public function getMaxTry(IState &$state = null): int
    {
        return $state->getAdditional(static::STATE__MAX_TRY, 0);
    }

    /**
     * @param $state
     *
     * @return int
     */
    public function incTry(IState &$state = null): int
    {
        $count = (int) $state->getAdditional(static::STATE__CURRENT_TRIES_COUNT);
        $count++;
        $state->setAdditional(static::STATE__CURRENT_TRIES_COUNT, $count);

        return $count;
    }

    /**
     * @param $state
     *
     * @return string
     */
    public function getOnTerminate(IState &$state = null): string
    {
        return $state->getAdditional(static::STATE__ON_TERMINATE, '');
    }

    /**
     * @param $state
     *
     * @return int
     */
    public function getTriesCount(IState &$state = null): int
    {
        return $state->getAdditional(static::STATE__CURRENT_TRIES_COUNT, 0);
    }
}
