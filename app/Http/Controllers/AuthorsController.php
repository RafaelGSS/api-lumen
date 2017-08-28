<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Author;

/**
* 
*/
class AuthorsController extends Controller
{
	public function index()
	{
		$authors = Author::all();
		return response()->json($authors, 200);
	}

	public function show($id)
	{
		$author = Author::where('id', $id)->first();

		if (!empty($author->name))
		{
			return response()->json($author, 200);
		}

		return response()->json(['status' => 'fail'], 404);
	}

	public function store(Request $request)
	{
		$this->validate($request, [
			'name' => 'required',
			'description' => 'required'
		]);

		try {

			$author = new Author;
			$author->name = $request->name;
			$author->description = $request->description;
			$author->save();

			return response()->json(['status' => 'success'], 201);

		} catch (Exception $e) {
			return response()->json(['status' => 'fail'], 500);
		}
	}


	public function update(Request $request, $id)
	{
		$author = Author::findOrFail($id);
		$data = $request->all();

		$insert = $author->update($data);

		if($insert)
		{
			return response()->json(['status' => 'success'], 200);
		}

		return response()->json(['status' => 'fail'], 500);
	}

	public function destroy($id)
	{
		if(Author::destroy($id))
		{
			return response()->json(['status' => 'success'], 200);
		}

		return response()->json(['status' => 'fail'], 500);
	}
}