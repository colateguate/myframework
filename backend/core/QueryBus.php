<?php

namespace backend\core;

class QueryBus implements Bus
{
    use BusTrait;

    public function ask(Dto $dto, ?Response $response = null)
    {
        return $this->execute($dto, $response);
    }
}