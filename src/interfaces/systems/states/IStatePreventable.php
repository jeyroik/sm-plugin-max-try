<?php
namespace tratabor\interfaces\systems\states;

use tratabor\interfaces\systems\IState;

/**
 * Interface IStatePreventable
 *
 * @package tratabor\interfaces\systems\states
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
