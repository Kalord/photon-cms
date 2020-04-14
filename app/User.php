<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use App\Models\Rule;

/**
 * Class User
 *
 * @property $name
 * @property $login
 * @property $password
 * @property $avatar
 * @property $status
 *
 * @package App\Models
 */
class User extends Authenticatable
{
    use Notifiable;

    const STATUS_ACTIVE = 3;

    /**
     * Current table
     * @var string
     */
    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'login', 'email', 'password', 'id_rule', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getRuleTitle()
    {
        return Rule::find($this->id_rule)->first()->title;
    }

    /**
     * @param string $login
     * @return User|null
     */
    public static function findByLogin($login)
    {
        return self::where('login', $login)->first();
    }

    /**
     * Создание пользователя
     *
     * @param array $data
     * @return User|null
     */
    public static function createUser(Array $data)
    {
        $data['password'] = Hash::make($data['password']);
        $data['id_rule']  = Rule::findRuleByTitle('User')->id; //Fix  

        return self::create($data);
    }
}
