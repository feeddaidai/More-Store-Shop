<?php

namespace App\Admin\Repositories;

use Dcat\Admin\Repositories\EloquentRepository;
use App\Models\UserInvoice as Model;
class UserInvoice extends EloquentRepository
{
    protected $eloquentClass = Model::class;
}
