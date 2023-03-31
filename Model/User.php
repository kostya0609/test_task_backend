<?php
namespace App\Modules\TestTask\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Modules\TestTask\Factories\UserFactory;


class User extends Model {
    use HasFactory;
    protected $table = 'l_test_task_users';
    protected static function newFactory(){
        return UserFactory::new();
    }

}
