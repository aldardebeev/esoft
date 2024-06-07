<?php

namespace App\Common\Enums;

enum RegexType: string
{
    const EMAIL = '/^(.{1,64})@(.{1,249})\.(.{2,4})$/';
    const PASSWORD = '/^(?=^.{8,256}$)(?=.*[A-Z])(?=.*[0-9])([\\\\!\"#$%&\'()*+,\-.\/\:;<=>?@\[\]^_\{|}~A-Za-z0-9])+$/';
}
