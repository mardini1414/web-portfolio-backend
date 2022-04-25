<?php

namespace App\Http\Controllers;

use App\Http\Resources\PortfolioResource;
use App\Models\Portfolio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    public function index()
    {
        return PortfolioResource::collection(Portfolio::all());
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|min:3|max:20|unique:portfolios',
            'link' => 'required|min:5',
            'github' => 'required|min:5',
            'description' => 'required|min:20',
            'image' => 'required|file|image|max:1000'
        ]);

        Portfolio::insert([
            'name' => $request->name,
            'link' => $request->link,
            'github' => $request->github,
            'description' => $request->description,
            'image' => $request->file('image')->store('image')
        ]);

        return response()->json(['message' => 'Portfolio added successfully']);
    }

    public function show($id)
    {
        return new PortfolioResource(Portfolio::find($id)->first());
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required|min:3|max:20|unique:portfolios,name,' . $id,
            'link' => 'required|min:5',
            'github' => 'required|min:5',
            'description' => 'required|min:20',
        ]);

        $portfolio = Portfolio::find($id)->first();

        if ($request->image) {
            $request->validate(['image' => 'required|file|image|max:1000']);
            Storage::delete($portfolio->image);
            $portfolio->update(['image' => $request->file('image')->store('image')]);
        }

        Portfolio::find($id)->update([
            'name' => $request->name,
            'link' => $request->link,
            'github' => $request->github,
            'description' => $request->description,
        ]);


        return response()->json(['message' => 'Portfolio update successfully']);
    }

    public function destroy($id)
    {
        $portfolio =  Portfolio::find($id)->first();
        $portfolio->delete();
        Storage::delete($portfolio->image);

        return response()->json(['message' => 'Portfolio delete successfully']);
    }
}
