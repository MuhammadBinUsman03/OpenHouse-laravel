<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $table = 'locations';
    protected $primaryKey = 'location_id';
    protected $fillable = ['location_name', 'location_is_taken'];

    public function project() {
        return $this->belongsTo(Project::class);
    }
}
