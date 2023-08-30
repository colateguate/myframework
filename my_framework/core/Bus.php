<?php

namespace my_framework\core;

interface Bus
{
    public function execute(Dto $dto, ?Response $response = null);
}