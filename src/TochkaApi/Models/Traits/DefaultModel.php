<?php

namespace TochkaApi\Models\Traits;


/**
 * Trait DefaultModel
 * @package TochkaApi\Models\Traits
 */
trait DefaultModel
{
    /**
     * @return bool|string
     */
    public function getModelName() {
        return substr(strrchr(get_class($this), "\\"), 1);
    }
}