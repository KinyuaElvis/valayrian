<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
{
    public $timestamps = false;

    protected $fillable = [
    'recommendation_text',
    'recommendation_type',
    'result_id',
];

    public function analysisResult()
    {
        return $this->belongsTo(AnalysisResult::class, 'result_id');
    }
}
