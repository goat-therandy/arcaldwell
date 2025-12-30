<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
	use SoftDeletes;

	protected $table = 'blogs';

	protected $fillable = [
		'title',
		'content',
		'author_id',
		'published_at',
	];

	/**
	 * Get the author of the blog post.
	 */
	public function author(){
		return $this->belongsTo(User::class, 'author_id');
	}
}