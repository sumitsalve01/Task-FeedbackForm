<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeedbackForm extends Model
{
    protected $table = 'feedback_forms';

    protected $fillable = [
        'title',
        'description',
        'status',
        'created_by',
        'updated_by',
    ];

    public function questions()
    {
        return $this->hasMany(FeedbackQuestion::class, 'form_id');
    }

    public function answers()
    {
        return $this->hasMany(FeedbackAnswer::class, 'form_id');
    }
}
