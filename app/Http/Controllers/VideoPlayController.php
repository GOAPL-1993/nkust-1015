<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VideoPlayController extends Controller
{
    public function index() {
        
        $username = "Guest";
        if (Auth::check()) {
            $user = Auth::user();
            $username = $user->name;
        }//這一段在找使用者是誰
        $titles = DB::table('video_lists')->get();
        return view('pages.index', compact('username', 'titles'));
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    public function addlist(Request $req){//Request是一個模組，把資料拿過來用
            DB::table("video_lists")->insert(['name'=>$req->title]);
            //去database的video_lists裡插入title，=>是關聯式陣列的寫法
            return redirect('/');//重新導向
    }
    
    public function delete($id){
        DB::table("video_lists")->where('id', '=', $id)->delete();
        //在資料表中找該id的對象，->delete代表delete
        return redirect('/');//重新導向
    }
    
    public function showlist($id){
        DB::tbale("videos")->where('listed', '=', $id)->get();
        return view("pages.showlist", compact('titles', 'username'));

    }
}
