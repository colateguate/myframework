<?php

namespace my_framework\core;

trait BusTrait
{
    public function execute(Dto $dto, ?Response $response = null)
    {
        $handlerName = get_class($dto) . 'Handler';

        if (!class_exists($handlerName)) {
            throw new \Exception("Not found Handler for Dto: " . get_class($dto));
        }

        //Get instance of $handlerName
        $handler = app($handlerName);
        $data = $handler->__invoke($dto);

        return ($response) ? $response->formatter($data) : $data;
    }
}