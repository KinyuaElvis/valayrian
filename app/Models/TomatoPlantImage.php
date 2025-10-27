<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class TomatoPlantImage extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'farmer_id',    // The field the error mentioned
        'filepath',
        'status',       // e.g., 'pending', 'processed', 'failed'
    ];
        /**
     * Get the farmer that owns the image.
     */
    public function farmer()
    {
        return $this->belongsTo(User::class, 'farmer_id');
        // Assuming your User model is named Farmer. If it's User, use User::class.
    }
    /**
     * Get the analysis result associated with the image.
     */ 
    public function analysisResult()
    {
        return $this->hasOne(AnalysisResult::class, 'image_id');
    } 
    //
}
