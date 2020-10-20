<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Company;
use App\Category;
use App\Personal;

/**
 * @method static paginate(int $int)
 */
class Advertisements extends Model
{
    protected $fillable = [
        'name', 'description', 'image', 'is_available'
    ];
    /**
     * @var mixed
     */
    private $name;

    public function personal(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Personal::class);
    }

    public function Company(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function categories(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
