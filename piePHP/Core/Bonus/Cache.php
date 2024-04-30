<?php

/* PSR-12 Standard */

namespace Core;

class Cache
{
    private string $path;

    protected string $key;
    protected string $cacheFile;

    public function __construct(string $key)
    {
            $this->path =  $_SERVER['DOCUMENT_ROOT'] . '/src/View/Cache';
            $this->key = $key;
            $filename = pathinfo($this->key, PATHINFO_FILENAME);
            $this->cacheFile = $this->path . '/' . $filename . '.php.cache';
    }

    public function get(): string
    {
        if (file_exists($this->cacheFile)) {
                return file_get_contents($this->cacheFile);
        }
            return '';
    }

    public function set(string $value): bool
    {
        if ($this->has()) {
                $this->clear();
        }

        if (file_put_contents($this->cacheFile, $value)) {
                return true;
        } else {
                return false;
        }
    }

    public function has(): bool
    {
            return file_exists($this->cacheFile);
    }

    public function clear(): void
    {
        if (file_exists($this->cacheFile)) {
                unlink($this->cacheFile);
        }
    }

    public function clearAll(): void
    {
            $files = glob($this->path . '/*');
        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }
    }

    public function getCacheFilePath(): string
    {
            return $this->cacheFile;
    }
}
