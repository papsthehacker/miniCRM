<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Company
 * @package App\Models
 */
class Company extends Model
{
    use HasFactory;


    /**
     * @return HasMany
     */
    public function employees()
    {
        return $this->hasMany(Employee::class, 'company');
    }
}
