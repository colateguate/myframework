<?php

namespace my_framework\core;

class CommandBus implements Bus
{
    use BusTrait;

    public function dispatch(Dto $dto)
    {
        return $this->execute($dto);
    }
}