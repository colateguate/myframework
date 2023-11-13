<?php

namespace my_framework\core;

abstract class Handler
{
    protected $service;

    public function __construct()
    {
        //Check if command or query
        if (strpos(get_class($this), "Command") !== false) {
            $this->service = app(str_replace("CommandHandler", "Service", get_class($this)));
        } else {
            $this->service = app(str_replace("QueryHandler", "Service", get_class($this)));
        }
    }
}

