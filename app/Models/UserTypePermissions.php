<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTypePermissions extends Model
{
    use HasFactory;

    public function userTypeData() {
        return $this->hasOne(UserTypes::class, "no", "user_type_no");
    }
}
