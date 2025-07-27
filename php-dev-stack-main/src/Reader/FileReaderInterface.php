<?php

namespace Reader;

use Models\Data;

interface FileReaderInterface
{
    public function getData(): Data;
}