<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeedbackAnswer extends Model
{
    protected $table = 'feedback_answers';

    protected $fillable = [
        'form_id',
        'question_id',
        'user_id',
        'answer_text',
        'created_by',
        'updated_by',
    ];

    public function form()
    {
        return $this->belongsTo(FeedbackForm::class, 'form_id');
    }

    public function question()
    {
        return $this->belongsTo(FeedbackQuestion::class, 'question_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
