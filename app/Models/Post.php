<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  use HasFactory, SoftDeletes;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'title',
    'content',
  ];

  protected $dates = ['created_at'];

  public function tags() {
    return $this->belongsToMany(Tag::class, 'posts_tags');
  }

  public function author() {
    return $this->hasOne(User::class, 'id', 'created_by');
  }

  public function authorName() {
    return $this->author->name;
  }

  public function publishedAt() {
    return $this->created_at->format('M d, Y');
  }
}
