<?php

namespace my_framework\core;

class QueryBus implements Bus
{
    use BusTrait;

    public function ask(Dto $dto, ?Response $response = null)
    {
        return $this->execute($dto, $response);
    }
}