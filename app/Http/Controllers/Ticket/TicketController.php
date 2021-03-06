<?php

namespace App\Http\Controllers\Ticket;

use Illuminate\Http\Request;
use DB;
use Redirect, Input,Session;
use \View;
use App\Ticket;
use App\Wcuser;
use App\Comment;
use App\Pcer;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;

class TicketController extends Controller
{
    public function index($openid){

        $wcuser_id = Wcuser::where('openid',$openid)->first()->id;
        $tickets = Ticket::where('wcuser_id',$wcuser_id)
                              ->with('pcer')->get();

        return view('Ticket.ticketList',compact('tickets'));
    }


    public function show($id)
    {

        $ticket = Ticket::where('id',$id)
                              ->with('pcer')->first();

        $comments = Comment::where('ticket_id',$id)
                        ->with(['wcuser'=>function($query){
                            $query->with('pcer');
                        }])->get();
            
    
        return view('Ticket.ticketData',compact('ticket','comments'));
    }

    public function edit(Request $request)
    {
        $temp_url = "http://120.27.104.83/mytickets/{$request->ticket_id}/show";
        $validation = Validator::make($request->all(),[
                'text' => 'required',
            ]);
        if ($validation->fails()) {

         return Redirect::to($temp_url)->withInput()->withErrors('亲(づ￣3￣)づ╭❤～内容要填写喔！');
        }
            $comment = new Comment;
            $comment->ticket_id = $request->ticket_id;
            $comment->from = $request->from;
            $comment->wcuser_id = $request->wcuser_id;
            $comment->text = $request->text;
            $res = $comment->save();
            if ($res) {
		
                return Redirect::to($temp_url);
            } else {
                return Redirect::to($temp_url)->withInput()->withErrors(['test'=>'网络问题，提交失败，请重新提交(づ￣ 3￣)づ']);
            }  
    }

    public function update(Request $request)
    {

        $res = Ticket::where('id',$request->ticket_id)
              ->update(['assess'=>$request->assess,'suggestion'=>$request->suggestion]);

        if ($res) {
            return Redirect::back();
        } else {
             return Redirect::back()->withInput()->withErrors('网络问题，提交失败，请重新提交(づ￣ 3￣)づ');
        }
        
    }

}
