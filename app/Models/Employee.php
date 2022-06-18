<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="Employee",
 *     description="Employee model",
 * )
 */

class Employee extends Model
{
    use HasFactory;

    /**
     * @OA\Property(format="string", default="tobi", description="name", property="name",minLength=2),
     * @OA\Property(format="integer", default=2000000, description="salary", property="salary",minimum=2000000,maximum=10000000),
     */

    protected $fillable = [
        'name',
        'salary',
    ];
    protected $hidden = ['created_at', 'updated_at'];

    public function overtime(){
        return $this->hasMany(Overtime::class);
    }
}
