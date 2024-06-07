<?php

namespace App\Common\Enums;

enum RoleType: string
{
    const User = 'user';
    const Admin = 'admin';
    const Moderator = 'moderator';
}
