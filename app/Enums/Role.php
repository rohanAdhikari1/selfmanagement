<?php

namespace App\Enums;

enum Role: string
{
    case SUPER_ADMIN = 'super_admin';
    case ADMIN = 'admin';
    case CLEANER = 'cleaner';
    case COMPANY_USER = 'company_user';
    case SITE_USER = 'site_user';
}
