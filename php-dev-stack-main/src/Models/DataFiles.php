<?php

namespace Models;

class DataFiles
{
    private array $files;

    public function __construct(array $files)
    {
        $this->files = $files;
    }

    public function isSingleFile(): bool
    {
        return count($this->files) === 1;
    }

    public function getFirst(): ?Data
    {
        return $this->files[0] ?? null;
    }

    public function getAll(): array
    {
        return $this->files;
    }

    public function count(): int
    {
        return count($this->files);
    }
}