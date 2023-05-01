<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Language;
use App\Models\RatingRecipe;
use App\Models\Recipe;
use App\Models\RecipeTag;
use App\Models\Role;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($id) // Вывод view личного кабинета
    {
        $user = User::find($id);
        if($user != Null) {
            $role = Role::all();
            $recipes = Recipe::where('author_id', $id)->get();
            return view('profile.index', compact('user', 'role', 'recipes'));
        }
        else
        {
            abort(404);
        }
    }

    public function redirect() {
        if (Auth::check()) {
            return redirect()->route('profile.user', Auth::user()->id);
        }
        else {
            return redirect()->route('login');
        }
    }

    public function settingsView($id) { // Вывод view настроек личного кабинета
        $user = User::find($id);
        if($user != Null) {
            return view('profile.settings', ["user" => $user]);
        }
        else
        {
            abort(404);
        }
    }

    public function myRecipeView($id) { // Вывод view рецептов пользователя
        $user = User::find($id);
        if($user != Null) {
            $recipe = Recipe::where('author_id', $id)->get();

            return view('profile.myRecipe', ["user" => $user], ['recipe' => $recipe]);
        }
        else
        {
            abort(404);
        }
    }

    public function createRecipe($id) {
        $user = User::find($id);
        $category = Category::all();
        $language = Language::all();
        $arr = [
            'category' => $category,
            'language' => $language,
        ];
        return view('profile.createRecipe', ['user' => $user], ['arr' => $arr]);
    }




    // ! ФУНКЦИИ
    // ! =================================

    public function update(Request $request) {
        if($request->change == 'password'){ // Смена пароля
            $data = request()->validate([
                'old_password' => ['required', 'string'],
                'password' => ['required', 'string', 'min:8', 'confirmed'], // Проврека данных
            ]);

            if(!Hash::check($data['old_password'], auth()->user()->password)){ // Проверка пароля
                return back()->with("error", "Текущий пароль неверен!");
            }

            User::whereId(auth()->user()->id)->update([ // Обновление данных
                'password' => Hash::make($data['password'])
            ]);
            return back()->with("status", "Пароль успешно сменён!");
        }
        elseif($request->change == 'email') // Смена почты
        {
            $data = request()->validate([
                'current_password' => ['required', 'string', 'min:8'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            ]);

            if(!Hash::check($data['current_password'], auth()->user()->password)){
                return back()->with("error", "Текущий пароль неверен!");
            }

            User::whereId(auth()->user()->id)->update([
                'email' => $data['email']
            ]);
            return back()->with("status", "Почта успешна сменёна!");
        }
        else {
            abort('404');
        }
    }

    public function store(Request $request) {
        $data = request()->validate([
            'title' => ['required', 'string', 'min:8', 'max:150'],
            'editordata' => ['required', 'string', 'min:8', 'max:500'],
            'code' => ['required', 'string'],
            'category' => ['required', 'int'],
            'language' => ['required', 'string'],
            'tags' => [],
        ]);


        $language = Language::where('abbreviatedEdit', $data['language'])->first();

        $tags = json_decode($data['tags'], true);

        $recipe = Recipe::create([
            'title' => $data['title'],
            'description' => $data['editordata'],
            'code' => $data['code'],
            'author_id' => Auth::user()->id,
            'rating' => '0',
            'category_id' => $data['category'],
            'language_id' => $language->id,
        ]);


        foreach($tags as $value)
        {
            if(empty($value['id']))
            {
                $tag = Tag::create([
                    'name' => $value['value'],
                ]);
                RecipeTag::create([
                    'recipe_id' => $recipe['id'],
                    'tag_id' => $tag['id'],
                ]);
            }
            else
            {
                $tag = Tag::find($value['id']);
                RecipeTag::create([
                    'recipe_id' => $recipe['id'],
                    'tag_id' => $tag['id'],
                ]);
            }
        }



        return redirect()->route('profile.myRecipe', ['id' => Auth::user()->id])->with('status', 'Пост создан');
    }

    public function tags(Request $request) {
        $searchQuery = $request->get('query');

        if($searchQuery == "") {
            $tags = Tag::Select('name as value')->get();
        }
        else
        {
            $tags = Tag::Select('id', 'name as value')->where('name', 'LIKE', '%'.$searchQuery.'%')->get();
        }

        $tag = json_encode($tags);
        return $tag;
    }

    public function addImage($id, Request $request) {
        $user = User::find(Auth::user()->id);


        $data = request()->validate([
            'file' => ['required', 'image', 'dimensions:max_width=350px,max_height=350px'],
        ]);

        $imageName = time() . '.' . $data['file']->extension();

        dd($imageName);

        $data['file']->move(public_path('img/imageUser/'), $imageName);

        $file = $imageName;


        if($user->photoPath != 'defaulticon.png') {
            unlink(public_path('img/imageUser' . '/' . $user->photoPath));
        }


        User::where('id', $id)->update([
            'photoPath' => $file,
        ]);


        return back()->with("status", "Иконка успешна сменёна!");
    }
}
