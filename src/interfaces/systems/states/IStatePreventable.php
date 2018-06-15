<?php
namespace jeyroik\extas\interfaces\systems\states;

use jeyroik\extas\interfaces\systems\IState;

/**
 * Interface IStatePreventable
 *
 * @package jeyroik\extas\interfaces\systems\states
 * @author Funcraft <me@funcraft.ru>
 */
interface IStatePreventable extends IState
{
    /**
     * @return int
     */
    public function getMaxTry(): int;

    /**
     * @return string
     */
    public function getOnTerminate(): string;

    /**
     * @return int
     */
    public function incTry(): int;

    /**
     * @return int
     */
    public function getTriesCount(): int;
}
