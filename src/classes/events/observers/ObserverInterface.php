<?php

namespace App\WebStore\Classes\Events\Observers;

use App\WebStore\Classes\Events\EventInterface;

interface ObserverInterface
{
    public function update(): void;
}