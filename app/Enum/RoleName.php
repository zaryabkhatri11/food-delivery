<?php

namespace App\Enum;


enum  RoleName: string

{
    case  ADMIN = 'admin';
    case VENDOR = 'vendor';
    case STAFF = 'staff';
    case CUSTOMER = 'customer';
}
