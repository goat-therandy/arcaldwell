<?php

namespace App\Repositories;

use App\Models\Blog;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Carbon\Carbon;

class Blogs
{
	//create a blog post
	public function create(array $data, int $authorId): Blog{
		$blog = Blog::create([
			'title' => $data['title'],
			'content' => $data['content'],
			'author_id' => $authorId,
			'published_at' => isset($data['published_at']) ? Carbon::parse($data['published_at']) : null,
		]);

		return $blog;
	}

	//edit a blog post
	public function edit(int $id, array $data): Blog{
		try{
			$blog = Blog::findOrFail($id);
		} catch (ModelNotFoundException $e){
			Log::error('Blog not found for editing', ['blog_id' => $id]);
			throw $e;
		}

		$blog->update($data);

		return $blog;
	}

	//delete a blog post
	public function delete(int $id): void{
		try{
			$blog = Blog::findOrFail($id);
		} catch (ModelNotFoundException $e){
			Log::error('Blog not found for deletion', ['blog_id' => $id]);
			throw $e;
		}
		$blog->delete();
	}

	//restore a deleted blog post
	public function restore(int $id): Blog{
		try{
			$blog = Blog::withTrashed()->findOrFail($id);
		} catch (ModelNotFoundException $e){
			Log::error('Blog not found for restoration', ['blog_id' => $id]);
			throw $e;
		}
		$blog->restore();
		return $blog;
	}

	//get a blog post by id
	public function getById(int $id): Blog{
		try{
			$blog = Blog::findOrFail($id);
		} catch (ModelNotFoundException $e){
			Log::error('Blog not found', ['blog_id' => $id]);
			throw $e;
		}

		return $blog;
	}

	//get all blog posts
	public function getAll(): Collection{
		return Blog::all();	
	}

	//get all blog posts by author
	//doesn't seem necessary since I'll be the only author, but I like scalability
	public function getByAuthor(int $authorId): Collection{
		return Blog::where('author_id', $authorId)->get();	
	}


}