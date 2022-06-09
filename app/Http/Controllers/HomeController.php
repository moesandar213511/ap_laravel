<?php

namespace App\Http\Controllers;

use App\Events\PostCreatedEvent;
use App\Test;
use App\Models\Post;
use App\Models\User;
use App\Mail\PostStored;
use App\Models\Category;
use App\Mail\PostCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Notification;
use App\Notifications\PostCreatedNotification;

class HomeController extends Controller
{
    public function testroot(){ // for named routing
        dd('root file');
        // $data = Post::orderByDesc('id')->get();// output data using eloquent model
        // return view('home',compact('data'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // for Notification
        $user = User::find(Auth::user()->id);// send noti directly using user model // user တစ်ယောက်ထဲကိုပဲ ပို့မယ်ဆိုရင် သုံးသင့်။
        $user->notify((new PostCreatedNotification()));

        // Notification::send(User::find(Auth::user()->id), new PostCreatedNotification()); //send noti using facades // loop ပတ်ပို့စရာ ရှိရင် သုံးသင့်။

        // for laravel mail demo purpose/ mail testing
        // Mail::raw('Hello World',function($msg){
        //     $msg->to('moesandar213511@gmail.com')->subject('laravel mail demo');
        // });

        // for core config
        // dd(config('mail.from.address'));
        // dd(config('aprogrammer.info.third'));
        // config folder>mail.php>from => address => Mail from address
        // https://laravel.com/docs/8.x/helpers#method-config

        // dd(auth()->id());
        // auth()->id() == auth()->user()->id
        $data = Post::where('user_id',auth()->id())->orderByDesc('id')->get();

        // output data using eloquent model
        // $data = Post::all();
        // dd($data);

        // $collection = ['moelay', 'soelay', 'sulay']; // collections example
        // dd($collection);

        return view('home',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        return view('create',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(StorePostRequest $request)
    // {
    //     // dd($request->all());
    //     // Retrieve the validated input data...
    //     $validated = $request->validated();
    //     // $validated = $request->validate([
    //     //     'name' => 'required|unique:posts|max:255', // name or email ထည့်တာ unique ဖြစ်/မတူရ။
    //     //     'description' => 'required|max:255',
    //     // ]);// validatedစစ်ပြီးသား data တွေကို $validated ထဲကိုထည့်။
    //     $post = new Post();
    //     $post->name = $request->name;
    //     $post->description = $request->description;
    //     $post->category_id = $request->category_id;

    //     $post->save();
    //     return redirect('/posts');
    // }

    public function store(StorePostRequest $request)
    {
        //Retrieve the validated input data...
        $validated = $request->validated();
        // dd($validated);
        $post = Post::create($validated + ['user_id' => Auth::user()->id]);

        PostCreatedEvent::dispatch($post);
        // event(new PostCreatedEvent($post));

        // Post::create([ // need to insert fillable in Post model to solve mass assignment
        //     'name' => $request->name,
        //     'description' => $request->description,
        //     'category_id' => $request->category_id,
        // ]);

        // Mail::to('moesandar213511@gmail.com')->send(new PostCreated());
        return redirect('/posts')->with('status', 'Post was created successful!');
        // https://laravel.com/docs/8.x/responses#redirecting-with-flashed-session-data
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post, Test $test)// no need to write findOrFail() fun because auto check findOrFail() using Post model class if use route model binding
    {
        dd($test);
        // dd($id);
        // $post = Post::findOrFail($id);

        // user id 1 က 2 create လုပ်ခဲ့တဲ့ Post ကို လှမ်းaccess လုပ်လို့မရအောင်လုပ်။ manually authorization filter လုပ်။
        // if($post->user_id != auth()->id()){
        //     abort(403);
        // }

        $this->authorize('view', $post); //do authorization filter using policy
        return view('show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        // $post = Post::findOrFail($id);

        // user id 1 က 2 create လုပ်ခဲ့တဲ့ Post ကို လှမ်းaccess လုပ်လို့မရအောင်လုပ်။ manually authorization filter လုပ်။
        if($post->user_id != auth()->id()){
            abort(403);
        }
        $category = Category::all();
        return view('edit',compact('post','category'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Post $post)
    {
        // $post = Post::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'category_id' => 'required',
        ]);// validatedစစ်ပြီးသား data တွေကို $validated ထဲကိုထည့်။
        // dd($validated);
        $post->update($validated);

        // $post->name = $request->name;
        // $post->description = $request->description;
        // $post->save();

        // $post->update([ // need to insert fillable in Post model to solve mass assignment
        //     'name' => $request->name,
        //     'description' => $request->description,
        //     'category_id' => $request->category_id,
        // ]);
        return redirect('/posts')->with('status', config('aprogrammer.message.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // Post::findOrFail($id)->delete();
        $post->delete();
        return redirect('/posts');
    }
}
