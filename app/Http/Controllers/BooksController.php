<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;

/**
* 
*/
class BooksController extends Controller
{
	
	public function index()
	{
		$books = Book::with('author')->get();
		return response()->json($books, 200);
	}

	public function show($slug)
	{
		$book = Book::where('slug', $slug)->first();
		if(!empty($book->name))
		{
			return response()->json($book, 200);
		}
		else {
			return response()->json(['status' => 'fail'], 404);
		}
	}

	public function store(Request $request)
	{
		$this->validate($request, [
			'name' => 'required',
			'description' => 'required',
			'category' => 'required',
			'author_id' => 'required',
		]);

		try{
			$book = new Book();
			$book->name = $request->name;
			$book->description = $request->description;
			$book->category = $request->category;
			$book->author_id = $request->author_id;
			$slug = explode(" ",$request->name);
			$book->slug = $slug[0];
			$book->save();

			return response()->json(['status' => 'success'], 201);
		}catch(Exception $e) {
			return response()->json(['status' => 'fail'], 500);
		}
	}

	public function update(Request $request, $id)
	{
		$book = Book::findOrFail($id);
		$data = $request->all();

		if( isset($data["name"]) )
		{
			$slug = explode(" ", $data['name']);
			$data["slug"] = $slug[0];
		}
		
		$insert = $book->update($data);
		if($insert)
		{
			return response()->json(['status' => 'success'], 200);
		}

		return response()->json(['status' => 'fail'], 500);

	}

	public function destroy($id)
	{

		if(Book::destroy($id))
		{
			return response()->json(['status' => 'success'], 200);
		}

		return response()->json(['status' => 'fail'], 500);
	}
}