<?php

namespace App\Enums;

enum DesignationLoadEnum : String {
    case RL = 'Regular Teaching Load';
    case EL = 'Extra Load';
    case AL = 'Administrative Load';
    case SL = 'Substitution Load';
    case OCL = 'Off-Campus Load';
    case StL = 'Study Load';
    case OTL = 'Outside Teaching Load';
    case SLW = 'Substitution Load Without Pay';
}