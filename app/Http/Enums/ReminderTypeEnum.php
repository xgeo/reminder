<?php


namespace App\Http\Enums;


class ReminderTypeEnum
{
    const ONCE          = 'ONCE';
    const EVERY         = 'EVERY';
    const WEEKLY        = 'WEEKLY';
    const MONTHLY       = 'MONTHLY';
    const YEARLY        = 'YEARLY';
    const CUSTOMIZED    = 'CUSTOMIZED';
    const DEFAULT       = 'DEFAULT';

    public function getEnumList(): array
    {
        $reflectionClass = new \ReflectionClass($this);
        return array_values($reflectionClass->getConstants());
    }
}
