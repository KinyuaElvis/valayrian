<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\TomatoPlantImage;

class AnalysisResult extends Model
{
       use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 'result_id';
    protected $fillable = [
        'image_id',         // Foreign key to the image
        'detection_status', // The field the error mentioned
        'severity_level',   // Your schema likely has this
        'confidence_score', // The ML model provides this, so you should save it
        'analysis_timestamp', // You might set this in your controller
    ];
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'analysis_results'; // Explicitly define if table name is different from 'analysis_results'

    /**
     * Get the image that this analysis result belongs to.
     */
    public function image()
{
    return $this->belongsTo(TomatoPlantImage::class, 'image_id', 'image_id');
}

    public function recommendations()
{
    return $this->hasMany(Recommendation::class, 'result_id', 'result_id');
}
}
