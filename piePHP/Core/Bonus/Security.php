<?php

/* PSR-12 Standard */

namespace Core\Bonus;

abstract class Security
{
    private array $security = [];
    private array $autorized = [
            CSRF::class,
            Session::class,
            Middleware::class
        ];

    abstract protected function boot(): void;

    public function __construct(string ...$load)
    {
            $this->register(...$load);
    }

    public function register(string ...$security): void
    {
        foreach ($security as $s) {
            if (in_array($s, $this->autorized)) {
                $this->security[] = $s;
            }
        }
    }

        /**
         * @param string $class
         * @return void
         */
    public function addAuthorized(string $class)
    {
            $this->autorized[] = $class;
    }

        /**
         * Execute the security class boot method
         * This will be more versatile for dev who want to use this in the future
         * @return void
         */
    public function start(): void
    {
        foreach ($this->security as $s) {
                (new $s())->boot();
        }
    }
}
