<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'title',
        'image',
        'description',
        'product',
        'price',
        'currency',
    ];

    public function isPaymentPage()
    {
        return $this->type === 'Payment Page';
    }
}
