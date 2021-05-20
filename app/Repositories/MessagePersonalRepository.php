<?php

namespace App\Repositories;

use App\Models\MessagePersonal;

class MessagePersonalRepository extends Repository
{
    public function __construct(MessagePersonal $messagePersonal)
    {
        $this->model = $messagePersonal;
    }
}
