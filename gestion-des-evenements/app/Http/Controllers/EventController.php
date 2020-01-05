<?php

namespace App\Http\Controllers;

use App\Category;
use App\Event;
use App\User;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        Carbon::setLocale('fr');
        $events= Event::latest()->paginate(8);
        foreach($events as $event){
            $event->setAttribute('user',$event->user);
            $event->setAttribute('category',$event->category->name);
            $event->setAttribute('added',Carbon::parse($event->created_at)->diffForHumans());
            $event->setAttribute('path','/event/'.$event->title);
        }
        return response()->json($events);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $name=null;
        if($request->hasFile('image')){
            $name = time(). '.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('images',$name));

        }
        $url = explode('/',url()->current());
        Event::create([
            'title' => $request->title,
            'description' => $request->description,
            'photo' => $url[0].'/images/'.$name,
            'localisation' => $request->localisation,
            'user_id' => $request->user_id,
            'category_id' => $request->category_id,

        ]);
        return response()->json(['message'=>'Evenement ajouter']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
        Carbon::setLocale('fr');
        return response()->json([
            'id' => $event->id,
            'title' => $event->title,
            'photo' => $event->photo,
            'localisation' =>$event->localisation,
            'description' => $event->description,
            'created_at' => $event->created_at->diffForHumans(),
            'user' => $event->user->name,
            'category' => $event->category->name,
            'comments_count' => $event->comments->count(),
            'comments' => $this->commentsArray($event->comments),
            

        ]);
    }
    public function commentsArray($comments){
        $jsonComments = [];
        foreach($comments as $comment){
            array_push($jsonComments,[
                'id' => $comment->id,
                'body' => $comment->body,
                'created_at' => $comment->created_at->diffForHumans(),
                'user' => $comment->user->name,

            ]);
        }
        return $jsonComments;
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }
    public function category($name){
        Carbon::setLocale('fr');
        $categorie = Category::where('name',$name)-> first();
        $events = Event::where('category_id',$categorie->id)->get();  
        foreach($events as $event){
            $event->setAttribute('user',$event->user);
            $event->setAttribute('added',Carbon::parse($event->created_at)->diffForHumans());
            $event->setAttribute('path','/event/'.$event->title);
        }
        return response()->json($events);      
    }
}
