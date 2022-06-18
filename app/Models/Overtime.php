<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="Overtime",
 *     description="Overtime model",
 * )
 */
class Overtime extends Model
{

    /**
     * @OA\Property(format="integer", example=1, description="employee_id", property="employee_id"),
     * @OA\Property(format="string", example="19-06-2022", description="date", property="date"),
     * @OA\Property(format="string", example="19:00", description="time_started", property="time_started"),
     * @OA\Property(format="string", example="23:45", description="time_ended", property="time_ended"),
     */

    protected $fillable = [
        'employee_id',
        'date',
        'time_started',
        'time_ended',
    ];
    protected $hidden = ['created_at', 'updated_at'];

    use HasFactory;
}
