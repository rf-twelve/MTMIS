<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Company extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function logoUrl()
    {
        return $this->logo
            ? Storage::disk('images')->url($this->logo)
            : asset('img/lgulopezquezon.png');
    }

    public function bgUrl()
    {
        return $this->bg_image
            ? Storage::disk('images')->url($this->bg_image)
            : asset('img/dts/bg.jpg');
    }
}
