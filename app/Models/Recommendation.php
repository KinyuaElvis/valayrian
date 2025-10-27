<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
{
    //
    public function analysisResult()
{
    return $this->belongsTo(AnalysisResult::class, 'result_id', 'result_id');
}
}
