<?php

namespace Lib\Traits;

use Carbon\Carbon;

trait Timestampable
{
    /** @var Carbon */
    protected $createdAt;
    /** @var Carbon */
    protected $updatedAt;

    public function getCreatedAt(): Carbon
    {
        return Carbon::instance($this->createdAt);
    }

    public function getUpdatedAt(): Carbon
    {
        return Carbon::instance($this->updatedAt);
    }
}
