<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\ActionLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrendPostController extends Controller
{
    //
    public function tpost(){
        $post = ActionLog::select('action_logs.*','posts.*',DB::raw('count(action_logs.post_id) as post_count'))
        ->leftJoin('posts','posts.post_id','action_logs.post_id')
        ->groupBy('action_logs.post_id') // count max min
        ->get();
        // dd($post->toArray());
        return view('admin.tpost.index',compact('post'));
    }
    public function details($id){
        // dd($id);
        $data = Post::where('post_id',$id)->first();
        // dd($data->toArray());
        return view('admin.tpost.details',compact('data'));

    }
}
