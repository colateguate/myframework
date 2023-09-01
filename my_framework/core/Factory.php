<?php

namespace my_framework\core;

use Illuminate\Database\Eloquent\Collection;

interface Factory
{
    public function build($raw_object);
    public function buildAll(Collection $collection);
}