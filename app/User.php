<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @method static paginate(int $int)
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'email', 'password',
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
    /**
     * @var mixed
     */
    private $name;
    public $messages;

    public static function getAllUsers()
    {
        return self::all();
    }

    public function personals(): BelongsToMany
    {
        return $this->belongsToMany(Personal::class, 'personal_id');
    }

    public function Companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class, 'company_id');
    }

    public function register(): BelongsTo
    {
        return $this->belongsTo(Register::class, 'id');
    }


public function messages() {
    return $this->hasMany(Message::class);
    }
}
