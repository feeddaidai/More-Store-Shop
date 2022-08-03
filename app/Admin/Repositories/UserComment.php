<?php

namespace App\Admin\Repositories;

use App\Models\UserComment as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class UserComment  extends EloquentRepository
{
    protected $eloquentClass = Model::class;
}
