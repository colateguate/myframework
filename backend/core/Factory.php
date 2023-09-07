<?php

namespace backend\core;

use Illuminate\Database\Eloquent\Collection;

interface Factory
{
    public function build($raw_object);
    public function buildAll(Collection $collection);
}