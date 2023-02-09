<?php

namespace App\Service;

interface HttpClientManagerInterface
{
    public function isExist(string $urlApi) : bool;
}