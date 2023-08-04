<?php

namespace App\Enums;

enum TokenStatus: string
{
    case VALID = 'valid';
    case INVALID = 'invalid';
    case EXPIRED = 'expired';
}
