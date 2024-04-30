<?php

namespace Core;

class Request
{
    protected array $C_POST;
    protected array $C_GET;
    protected array $C_REQUEST;
    protected array $C_SERVER;

    public function __construct()
    {
            $this->C_POST = $this->sanitizeInput($_POST);
            $this->C_GET = $this->sanitizeInput($_GET);
            $this->C_REQUEST = $this->sanitizeInput($_REQUEST);
            $this->C_SERVER = $_SERVER;
    }

    private function sanitizeInput(array $data): array
    {
            $sanitized = [];
        foreach ($data as $key => $value) {
                // Escape special characters for HTML output (if needed)
            if (is_string($value)) {
                $sanitized[$key] = htmlspecialchars(stripslashes(trim($value)), ENT_QUOTES);
            } elseif (is_array($value)) {
                    $sanitized[$key] = $this->sanitizeInput($value);
            } else {
                    $sanitized[$key] = stripslashes(trim($value));
            }
        }

            return $sanitized;
    }

    public function post(string $key = null)
    {
        if ($key) {
                return $this->C_POST[$key] ?? null;
        }
            return $this->C_POST;
    }

    public function get(string $key = null)
    {
        if ($key) {
                return $this->C_GET[$key] ?? null;
        }
            return $this->C_GET;
    }

    public function request(string $key = null)
    {
        if ($key) {
                return $this->C_REQUEST[$key] ?? null;
        }
            return $this->C_REQUEST;
    }

    public function server(string $key = null)
    {
        if ($key) {
                return $this->C_SERVER[$key] ?? null;
        }
            return $this->C_SERVER;
    }
}
