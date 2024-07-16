<?php
namespace App\Services;

use Illuminate\Support\Facades\Auth;

class AuthenticatedUser
{
    protected $userId;

    public function __construct()
    {
        $this->userId = Auth::check() ? Auth::id() : null;
    }

    public function getUserId()
    {
        return $this->userId;
    }
}
