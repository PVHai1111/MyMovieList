<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
class Report extends Model
{
    use HasFactory;
    protected $fillable = ['reportable_id', 'reportable_type', 'reason'];

    public function reportable(): MorphTo
    {
        return $this->morphTo();
    }
}
