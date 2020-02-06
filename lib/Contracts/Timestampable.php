<?php

namespace Lib\Contracts;

use Carbon\Carbon;

interface Timestampable
{
    public function getCreatedAt(): Carbon;

    public function getUpdatedAt(): Carbon;
}
