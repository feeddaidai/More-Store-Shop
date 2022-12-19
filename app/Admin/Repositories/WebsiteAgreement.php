<?php

namespace App\Admin\Repositories;

use App\Models\WebsiteAgreement as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class WebsiteAgreement extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;

}
