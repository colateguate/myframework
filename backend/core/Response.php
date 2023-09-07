<?php

namespace backend\core;

interface Response
{
    public function formatter($data);
}