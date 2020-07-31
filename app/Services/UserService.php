<?php
declare(strict_types=1);

namespace App\Services;

use App\Contracts\UserContract;
use App\Repositories\UserRepository;

class UserService extends Service implements UserContract
{
    public function __construct(UserRepository $repo)
    {
        parent::__construct($repo);
    }
}
