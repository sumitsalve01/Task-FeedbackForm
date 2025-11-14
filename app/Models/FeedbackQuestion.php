<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeedbackQuestion extends Model
{
    protected $table = 'feedback_questions';

    protected $fillable = [
        'form_id',
        'question_text',
        'type',
        'order_no',
        'created_by',
        'updated_by',
    ];

    public function form()
    {
        return $this->belongsTo(FeedbackForm::class, 'form_id');
    }

    public function answers()
    {
        return $this->hasMany(FeedbackAnswer::class, 'question_id');
    }
}
