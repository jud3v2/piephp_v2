<?php

namespace Core\Bonus;

class SecurityFacade extends Security
{
    public function __construct(string ...$load)
    {
            parent::__construct(...$load);
    }

    protected function boot(): void
    {
            $this->start();
    }
}
