<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


/*
 * @property string $id
 * @property string $name
 * @property string $slug
 * @property string $logo
 * @property null|string $description
 * @property boll $active
 */

#[ObservedBy([Partner::class])]
class Partner extends Model
{
    /** @use HasFactory<\Database\Factories\PartnerFactory> */
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'name',
        'slug',
        'logo',
        'description',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function articles(): HasMany
    {
        return $this->HasMany(Article::class);
    }
}
