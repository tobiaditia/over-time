<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="Setting",
 *     description="Setting model",
 * )
 */
class Setting extends Model
{
    use HasFactory;

    /**
     * @OA\Property(format="key", example="overtime_method", description="key", property="key"),
     * @OA\Property(format="value", example=1, description="value", property="value"),
     */

    protected $fillable = [
        'key',
        'value',
    ];
    protected $hidden = ['created_at', 'updated_at'];
}
