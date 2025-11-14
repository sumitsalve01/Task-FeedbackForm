<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'roles';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name',
        'alias',
        'is_active',
        'is_delete',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_delete' => 'boolean',
    ];
    
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
