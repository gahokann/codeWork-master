<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Language;
use App\Models\Recipe;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function show($id) {
        $user = User::find($id);
        if($user != Null && $user->id == Auth::user()->id) {
            $colUser = User::count();
            $colRecipe = Recipe::count();
            $colTag = Tag::count();

            $column = [
                'user' => $colUser,
                'recipe' => $colRecipe,
                'tag' => $colTag,
            ];

            return view('admin.index', ["user" => $user], ['column' => $column]);
        }
        else
        {
            abort(404);
        }
    }

    public function users($id) {
        $user = User::find($id);
        if($user != Null && $user->id == Auth::user()->id) {
            $users = User::all();
            return view('admin.users', ["user" => $user], ['users' => $users]);
        }
        else
        {
            abort(404);
        }
    }

    public function recipes($id) {
        $user = User::find($id);
        if($user != Null && $user->id == Auth::user()->id) {
            $recipes = Recipe::all();
            return view('admin.recipes', ["user" => $user], ['recipes' => $recipes]);
        }
        else
        {
            abort(404);
        }
    }

    public function tags($id) {
        $user = User::find($id);
        if($user != Null && $user->id == Auth::user()->id) {
            $tags = Tag::all();
            return view('admin.tags', ["user" => $user], ['tags' => $tags]);
        }
        else
        {
            abort(404);
        }
    }

    public function category($id) {
        $user = User::find($id);
        if($user != Null && $user->id == Auth::user()->id) {
            $category = Category::all();
            return view('admin.category', ["user" => $user], ['category' => $category]);
        }
        else
        {
            abort(404);
        }
    }

    public function categoryCreate($id)
    {
        $user = User::find($id);
        if($user != Null && $user->id == Auth::user()->id) {

            return view('admin.categoryForm', ["user" => $user]);
        }
        else
        {
            abort(404);
        }
    }



    public function changeRecipe($id) {
        $user = User::find(Auth::user()->id);
        if($user != Null && $user->id == Auth::user()->id) {
            $recipe = Recipe::find($id);
            $language = Language::all();

            return view('admin.changeRecipe', ['recipe' => $recipe], compact('language', 'user'));
        }

    }

    public function searchUser($id, Request $request) {
        $user = User::find($id);
        if($user != Null && $user->id == Auth::user()->id) {
            $validator = Validator::make($request->all(), [
                'search' => 'required|string',
            ]);

            if ($validator->fails())
            {
                return redirect()->back();
            }

            $users = User::where('login', 'LIKE', '%'.$request->get('search').'%')
                                ->orWhere('email', 'LIKE', '%'.$request->get('search').'%')->get();

            return view('admin.users', ['users' => $users], ["user" => $user]);
        }
        else
        {
            abort(404);
        }

    }

    public function searchRecipe($id, Request $request) {
        $user = User::find($id);
        if($user != Null && $user->id == Auth::user()->id) {
            $validator = Validator::make($request->all(), [
                'search' => 'required|string',
            ]);

            if ($validator->fails())
            {
                return redirect()->back();
            }

            $recipes = Recipe::where('title', 'LIKE', '%'.$request->get('search').'%')->get();

            return view('admin.recipes', ['recipes' => $recipes], ["user" => $user]);
        }
        else
        {
            abort(404);
        }

    }

    public function searchTags($id, Request $request) {
        $user = User::find($id);
        if($user != Null && $user->id == Auth::user()->id) {
            $validator = Validator::make($request->all(), [
                'search' => 'required|string',
            ]);

            if ($validator->fails())
            {
                return redirect()->back();
            }

            $tags = Tag::where('name', 'LIKE', '%'.$request->get('search').'%')->get();

            return view('admin.tags', ['tags' => $tags], ["user" => $user]);
        }
        else
        {
            abort(404);
        }

    }

    public function searchCategory($id, Request $request) {
        $user = User::find($id);
        if($user != Null && $user->id == Auth::user()->id) {

            $validator = Validator::make($request->all(), [
                'search' => 'required|string',
            ]);

            if ($validator->fails())
            {
                return redirect()->back();
            }

            $category = Category::where('name', 'LIKE', '%'. $request->get('search').'%')->get();

            return view('admin.category', ['category' => $category], ["user" => $user]);
        }
        else
        {
            abort(404);
        }

    }



    // ! Fucntion

    public function update($id) {
        $data = request()->validate([
            'title' => ['required', 'string', 'min:8'],
            'description' => ['required', 'string', 'min:8'],
            'code' => ['required', 'string'],
        ]);


        Recipe::whereId($id)->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'code' => $data['code'],
        ]);

        return redirect()->route('catalog.recipe', ['id' => $id])->with('status', 'Пост изменен');
    }

    public function addRole($id, Request $request) {

        $validator = Validator::make($request->all(), [
            'role' => 'required',
        ]);

        if ($validator->fails())
        {
            return redirect()->back();
        }

        User::find($id)->update([
            'role_id' => $request->get('role'),
        ]);

        return redirect()->route('profile.user', ['id' => $id])->with('status', 'Роль успешно изменена');
    }

    public function destroy($id) {
        $recipes = Recipe::find($id);
        if($recipes != Null) {
            $recipes = Recipe::find($id)->delete();
            return back()->with("status", "Рецепт успешно удалён!");
        }
        else
        {
            abort(404);
        }
    }

    public function destroyComment($id)
    {
        $comment = Comment::find($id);
        if($comment != Null) {
            $comment = Comment::find($id)->delete();
            return back()->with("status", "Комменатрий успешно удалён!");
        }
        else
        {
            abort(404);
        }
    }

    public function categoryStore($id, Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50|string',
        ]);

        if ($validator->fails())
        {
            return redirect()->route('admin.categoryCreate', ['id' => Auth::user()->id])->withErrors($validator);
        }

        Category::create([
            'name' => $request->get('name'),
            'admin_id' => $id,
        ]);

        return redirect()->route('admin.category', ['id' => Auth::user()->id])->with('status', 'Категория создана');
    }

}
