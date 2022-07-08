<?php

namespace App\Admin\Repositories;

use App\Models\SpecType as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class SpecType extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
