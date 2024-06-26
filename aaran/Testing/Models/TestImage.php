<?php

namespace Aaran\Testing\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TestImage extends Model
{
    use HasFactory;

    protected  $guarded = [];

    public function TestImage(): BelongsTo
    {
        return $this->belongsTo(TestImage::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function assign($str)
    {
        return User::find($str)->name;
    }

    public function actions(): BelongsTo
    {
        return $this->belongsTo(Actions::class);
    }

    public static function action($str)
    {
        return Actions::find($str)->vname;
    }

    public function operation(): BelongsTo
    {
        return $this->$this->belongsTo(TestOperation::class);
    }

    public function review(): HasMany
    {
        return $this->hasMany(TestReview::class);
    }

}
