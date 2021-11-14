<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Question extends Model
{
    use HasFactory;

    protected static function boot(){
        parent::boot();

        static::creating(function($question){
            $question->slug = Str::slug($question->title);
        });
    }

    protected $with = ['replies'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected $fillable = ['title', 'body', 'user_id', 'category_id', 'slug'];

    public function user() {
       return $this->belongsTo(User::class);
    }

    public function replies(){
       return $this->hasMany(Reply::class);
    }

    public function category() {
       return $this->belongsTo(Category::class);
    }

    public function getPathAttribute(){
       return "/questions/{$this->slug}";
    }
}
