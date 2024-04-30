<?php

namespace Core\Bonus;

class Session extends Security
{
    public function boot(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
                session_start();
        } elseif (session_status() === PHP_SESSION_DISABLED) {
                session_abort();
        }
    }
}
