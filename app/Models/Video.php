<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Video extends Model
{
    use HasFactory;

    protected $guarded = [];

    //protected $fillable = ['title','description'];
    protected  $dates = ['published_at'];

    //formatted_published_at accesor
    public function getFormattedPublishedAtAttribute()
    {
        if(!$this->published_at) return '';
        $local_date = $this->published_at->locale(config('app.locale'));
        return $local_date->day . '' . ' de ' . $local_date->monthName . ' de ' . $local_date->year;
    }

    public function getFormattedForHumansPublishedAtAttribute()
    {
        return optional($this->published_at)->diffForHumans(Carbon::now());
    }

    public function getPublishedAtTimestampAttribute()
    {
        return optional($this->published_at)->timestamp;
    }
}
