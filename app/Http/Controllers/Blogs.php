<?php

namespace App\Http\Controllers;

use App\Models\Blog;;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Log;
use App\Repositories\Blogs as BlogsRepository;

class Blogs extends Controller{

	protected BlogsRepository $blogsRepo;

	//constructor to inject the repository
	public function __construct(BlogsRepository $blogsRepo){

		$this->blogsRepo = $blogsRepo;

	}

	//create a blog post
	public function create(Request $request): Response{

		$validated = [];

		try{
			$validated = $request->validate([
				'title' => 'required|string|max:255',
				'content' => 'required|string',
				'published_at' => 'nullable|date',
			]);
		} catch (ValidationException $e){
			//handle validation errors
			Log::error('Blog creation validation failed', ['errors' => $e->errors()]);
			throw $e;
		}

		$blog = $this->blogsRepo->create($validated, $request->user()->id);

		return Inertia::render('Blogs/Show', ['blog' => $blog]);
	}

	//view a blog post
	public function show(int $id): Response{

		try{
			$blog = $this->blogsRepo->getById($id);
		} catch (ModelNotFoundException $e){
			Log::error('Blog not found', ['blog_id' => $id]);
			throw $e;
		}

		return Inertia::render('Blogs/Show', ['blog' => $blog]);
	}

	//edit a blog post
	public function edit(Request $request, int $id): Response{

		$validated = [];

		try{
			$validated = $request->validate([
				'title' => 'sometimes|required|string|max:255',
				'content' => 'sometimes|required|string',
				'published_at' => 'nullable|date',
			]);
		} catch (ValidationException $e){
			//handle validation errors
			Log::error('Blog editing validation failed', ['errors' => $e->errors()]);
			throw $e;
		}

		try{
			$blog = $this->blogsRepo->edit($id, $validated);
		} catch (ModelNotFoundException $e){
			Log::error('Blog not found for editing', ['blog_id' => $id]);
			throw $e;
		}

		return Inertia::render('Blogs/Show', ['blog' => $blog]);
	}

	//delete a blog post
	public function delete(int $id): Response{

		try{
			$this->blogsRepo->delete($id);
		} catch (ModelNotFoundException $e){
			Log::error('Blog not found for deletion', ['blog_id' => $id]);
			throw $e;
		}

		return Inertia::render('Blogs/Deleted', ['blog_id' => $id]);
	}

	//restore a deleted blog post
	public function restore(int $id): Response{
		try{
			$blog = $this->blogsRepo->restore($id);
		} catch (ModelNotFoundException $e){
			Log::error('Blog not found for restoration', ['blog_id' => $id]);
			throw $e;
		}

		return Inertia::render('Blogs/Show', ['blog' => $blog]);
	}
}