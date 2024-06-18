<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'rg',
        'admission_date',
        'demission_date',
        'salary',
        'fantasy_name',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function experiences()
    {
        return $this->hasMany(Employee_experience::class, 'employee_id', 'id');
    }

    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }

    public function tastings()
    {
        return $this->hasMany(Tasting::class);
    }
}
