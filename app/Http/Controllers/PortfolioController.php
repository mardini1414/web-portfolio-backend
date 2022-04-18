<?php

namespace App\Http\Controllers;

use App\Http\Requests\PortfolioRequest;
use App\Models\Portfolio;
use App\Models\User;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\CssSelector\Node\FunctionNode;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolio = Portfolio::all();
        return response()->json(compact('portfolio'));
    }

    public function store(PortfolioRequest $request)
    {
        Portfolio::insert([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'image' => $request->file('image')->store('image')
        ]);
        return response()->json(['message' => 'Portfolio added successfully']);
    }

    public function update(Request $request, $id)
    {
        Portfolio::find($id)->update([
            'name' => $request->getRequestTarget('nameKw'),
            // 'description' => $request->get('description')
        ]);
        return response()->json(['message' => 'Portfolio update successfully']);
    }

    public function destroy($id)
    {
        Portfolio::where('id', $id)->delete();
        return response()->json(['message' => 'Portfolio delete successfully']);
    }
}
