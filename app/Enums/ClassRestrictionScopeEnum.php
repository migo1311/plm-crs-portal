<?php

namespace App\Enums;

enum ClassRestrictionScopeEnum : String {
    case block = 'Block';
    case college = 'College';
    case program = 'Program';
    case program_and_year = 'Program & Year-level';
    case user = 'User';
    case gender = 'Gender';
}