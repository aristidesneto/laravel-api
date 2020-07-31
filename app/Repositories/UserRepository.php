<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\Contract as UserContract;
use App\Models\User;

class UserRepository extends Repository implements UserContract
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }
}
