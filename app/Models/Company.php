<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'businessName', 'address', 'vat', 'taxCode', 'employees', 'active', 'type'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
