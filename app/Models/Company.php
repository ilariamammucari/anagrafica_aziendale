<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        // 'user_id', ==> ids NEVER have to be `fillable` attributes! They can be only be filled via eloquent relationship!
        'business_name',
        'address',
        'vat',
        'tax_code',
        'employees',
        'active',
        'type'
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
