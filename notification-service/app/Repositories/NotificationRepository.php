<?php
namespace App\Repositories;

use App\Models\NotificationLog;

class NotificationRepository
{
    public function store($data)
    {
        return NotificationLog::create($data) ? true : false;
    }
}