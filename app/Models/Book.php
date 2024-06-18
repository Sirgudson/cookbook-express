<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'isbn',
        'published_at',
        'employee_id',
    ];

    public function publications()
    {
        return $this->hasMany(Publication::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
