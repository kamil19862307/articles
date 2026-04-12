<?php

namespace App\Enums;

enum CacheTtl: int
{
    case HOUR = 3600;
    case DAY = 86400;
}
