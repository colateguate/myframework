<?php

namespace backend\core;

interface Bus
{
    public function execute(Dto $dto, ?Response $response = null);
}