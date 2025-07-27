<?php

namespace Writer;

use Models\Data;

interface FileWriterInterface
{
    public function writeRows(Data $data): void;
    public function close(): void;
} 