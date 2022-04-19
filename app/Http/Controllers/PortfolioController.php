<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\CssSelector\Node\FunctionNode;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolio = Portfolio::all();
        return response()->json(compact('portfolio'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|min:3|max:20|unique:portfolios',
            'description' => 'required|min:20',
            'image' => 'required|file|image|max:1000'
        ]);

        Portfolio::insert([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $request->file('image')->store('image')
        ]);

        return response()->json(['message' => 'Portfolio added successfully']);
    }

    public function show($id)
    {
        $portfolio = Portfolio::find($id)->first();
        return response()->json(compact('portfolio'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required|min:3|max:20|unique:portfolios,name,' . $id,
            'description' => 'required|min:20',
        ]);

        if ($request->image) {
            $request->validate(['image' => 'required|file|image|max:1000']);
            Storage::delete($request->old_image);
            Portfolio::find($id)->update(['image' => $request->file('image')->store('image')]);
        }

        Portfolio::find($id)->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);


        return response()->json(['message' => 'Portfolio update successfully']);
    }

    public function destroy(Request $request, $id)
    {
        Portfolio::where('id', $id)->delete();
        Storage::delete($request->image);

        return response()->json(['message' => 'Portfolio delete successfully']);
    }
}
