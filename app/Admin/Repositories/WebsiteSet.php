<?php

namespace App\Admin\Repositories;

use App\Models\WebsiteSet as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class WebsiteSet extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;

}
