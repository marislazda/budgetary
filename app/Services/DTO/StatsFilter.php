<?php

namespace App\Services\DTO;

use \DateTime;

class StatsFilter {
    public DateTime $from;
    public DateTime $to;
    public ?int $typeId = null;
}
