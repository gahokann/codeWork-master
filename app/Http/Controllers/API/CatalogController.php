<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\CatalogResource;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Language;
use App\Models\RatingRecipe;
use App\Models\Recipe;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CatalogController extends BaseController
{
    public function showCatalog(Request $request)
    {
        $filteredLang = $request->get('lang');
        $filteredTag = $request->get('tag');

        $recipes = Recipe::whereNotNull('recipes.id');

        if (!empty($filteredLang)) {
            $recipes->whereIn("language_id", $filteredLang);
        }

        if (!empty($filteredTag)) {
            $recipes->whereHas('tags', function($q) use($filteredTag) {
                $q->whereIn('tag_id', $filteredTag);
            });
        }

        $recipes = $recipes->get();

        if(Auth::check()) {
            $user = User::find(Auth::user()->id);
        }
        else
        {
            $user = "";
        }

        $array = [
            'tag' => Tag::all(),
            'language' => Language::all(),
            'category' => Category::all(),
            'recipes' => $recipes,
            'user' => $user,
            'filteredLang' => $filteredLang,
            'filteredTag' => $filteredTag,
        ];

        return $this->sendResponse($array, '');
    }

    public function showRecipe($id) {
        $recipe = Recipe::find($id);


        if(Auth::check()) {
            $user = User::find(Auth::user()->id);
        }
        else
        {
            $user = "";
        }

        $array = [
            "comment" => Comment::where('recipe_id', $id)->get(),
            'recipe' => $recipe,
            'user' => $user,
        ];

        return $this->sendResponse($array, '');

        // return view('catalog.recipeShow', compact('recipe', 'user'), ['array' => $array]);
    }

    public function search(Request $request) {
        $validator = Validator::make($request->all(), [
            'search' => 'required|string',
        ]);

        if ($validator->fails())
        {
            return redirect()->back();
        }

        $recipes = Recipe::where('title', 'LIKE', '%'.$request->get('search').'%')->get();

        if(Auth::check()) {
            $user = User::find(Auth::user()->id);
        }
        else
        {
            $user = "";
        }


        $array = [
            'tag' => Tag::all(),
            'language' => Language::all(),
            'category' => Category::all(),
        ];

        return view('catalog.index', compact('recipes', 'user'), ['array' => $array]);
    }

    public function showTag($tag)
    {
        $tag = Tag::find($tag);
        if($tag != Null) {
            $recipes = $tag->recipes;

            $array = [
                'tag' => Tag::all(),
                'language' => Language::all(),
                'category' => Category::all(),
            ];

            if(Auth::check()) {
                $user = User::find(Auth::user()->id);
            }
            else
            {
                $user = "";
            }

            return view('catalog.index', compact('recipes', 'user'), ['array' => $array]);
        }
        else
        {
            abort(404);
        }
    }

    public function showCategory($id)
    {
        $category = Category::find($id);
        if($category != Null) {
            $recipes = $category->recipe;

            $array = [
                'tag' => Tag::all(),
                'language' => Language::all(),
                'category' => Category::all(),
            ];

            if(Auth::check()) {
                $user = User::find(Auth::user()->id);
            }
            else
            {
                $user = "";
            }

            return view('catalog.index', compact('recipes', 'user'), ['array' => $array]);
        }
        else
        {
            abort(404);
        }
    }

    public function showAuthor($id)
    {
        $users = User::find($id);
        if($users != Null) {

            $recipes = Recipe::where('author_id', $id)->get();

            $array = [
                'tag' => Tag::all(),
                'language' => Language::all(),
                'category' => Category::all(),
            ];

            if(Auth::check()) {
                $user = User::find(Auth::user()->id);
            }
            else
            {
                $user = "";
            }

            return view('catalog.index', compact('recipes', 'user'), ['array' => $array]);
        }
        else
        {
            abort(404);
        }
    }

    // ! Fucntion

    public function createComment($id, Request $request)
    {

        $validator = Validator::make($request->all(), [
            'text' => 'required|string|max:100',
        ]);

        if ($validator->fails())
        {
            return redirect()->back();
        }


        Comment::create([
            'author_id' => Auth::user()->id,
            'text' => $request->get('text'),
            'recipe_id' => $id,
        ]);

        return redirect()->route('catalog.recipe', ['id' => $id]);
    }

    public function evaluationRecipe($id, Request $request)
    {

        $validator = Validator::make($request->all(), [
            'value' => 'required',
        ]);

        if ($validator->fails())
        {
            return redirect()->back();
        }

        $currentRating = RatingRecipe::where('user_id', Auth::user()->id)
                                ->where('recipe_id', $id)->first();

        if(empty($currentRating)) {
            RatingRecipe::create([
                            'recipe_id' => $id,
                            'user_id' => Auth::user()->id,
                            'number' => $request->get('value'),
                        ]);
            return back()->with("status", "Отзыв успешно установлен");
        }
        else if($currentRating->number == $request->get('value'))
            return back();
        else if($currentRating->number != $request->get('value')) {

            RatingRecipe::where('user_id', Auth::user()->id)->where('recipe_id', $id)->update([
                            'number' => $request->get('value'),
                        ]);
            return back()->with("status", "Отзыв успешно установлен");
        }
        else
        {
            abort(404);
        }


    }
}
