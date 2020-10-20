<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Advertisements;

/**
 * @method static paginate(int $int)
 */
class Personal extends Model
{
    protected $fillable = [
        'civility', 'name', 'address', 'phone'
    ];
    /**
     * @var mixed
     */
    private $civility;
    /**
     * @var mixed
     */
    private $name;
    /**
     * @var mixed
     */
    private $address;
    /**
     * @var mixed
     */
    private $phone;
    /**
     * @var mixed
     */
    private $user_id;

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function advertisements(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Advertisements::class);
    }
}
