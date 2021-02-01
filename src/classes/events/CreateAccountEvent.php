<?php

namespace App\WebStore\Classes\Events;

use App\WebStore\Classes\Events\Observers\ObserverInterface;

class CreateAccountEvent implements EventInterface
{

    private $observers;

    public function __construct() {
        $this->observers = [];
    }

    public function Attach(ObserverInterface $observer): self
    {
        $this->observers[] = $observer;
        return $this;
    }

    public function Detach(ObserverInterface $observer): self
    {
        unset($this->observers[$observer]);
        return $this;
    }

    public function Notify(): void
    {
        foreach ($this->observers as $observer)
        {
            $observer->update();
        }
    }

}