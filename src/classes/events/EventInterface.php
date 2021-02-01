<?php

namespace App\WebStore\Classes\Events;

use App\WebStore\Classes\Events\Observers\ObserverInterface;

interface EventInterface
{
    public function Attach(ObserverInterface $observer): self;
    public function Detach(ObserverInterface $observer): self;
    public function Notify(): void;
}