<?php

namespace App\Enums;

enum ColumnEnum: string
{
    case created_at = 'createdAt';
    case completed_at = 'completedAt';
    case priority = 'priority';

}
