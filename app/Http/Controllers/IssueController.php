<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

use App\Issue;
use App\Vote;
use Auth;

class IssueController extends Controller
{	
	private $image;

    public function show()
    {
    	return view('issue.add');
    }

    public function create(Request $request)
    {
    	$request->validate([
    		'title'=>'required|max:35|unique:issues',
    		'description' => 'required|max:3000',
    		'location' => 'required',
    		'image' => 'required|image'
    	]);

    	$input = $request->all();

    	$v = explode(';' , $input['location']);

        $ulat = $v[0];
        $ulng = $v[1];

        $issue = Issue::create([
        	'title' => $input['title'],
        	'description' => $input['description'],
        	'lat' => $ulat,
        	'lng' => $ulng,
        	'user_id' => Auth::user()->id,
        	'image' => ''
        ]);

        if($request->hasFile('image')) {
            $this->image = $request->file('image');
        }

        if($request->hasFile('image')) {
                $imageName = 'p_' .$issue->id . '.' . $this->image->getClientOriginalExtension();
                $this->image->move('issues/'.$issue->id , $imageName);
                $issue->image = '../issues/'.$issue->id.'/' . $imageName;
                $issue->save();
        }

        return redirect()->route('listIssues');
    }

    public function list()
    {	
    	$issues = Auth::user()->issues;

    	return view('issue.list', [
    		'issues' => $issues
    	]);
    }

    public function view($id)
    {
    	$issue = Issue::find($id);

        $check = Vote::where(['user_id' => Auth::user()->id, 'issue_id' => $id])->get();

        if(!count($check))
            $status='neutral';
        else if($check[0]->type==1)
            $status='liked';
        else $status='disliked';

    	return view('issue.view', [
    		'issue' => $issue,
            'status' => $status
    	]);
    }

    public function upvote(Request $request, $id)
    {       
        $user = Auth::user();

        $check = Vote::where(['user_id' => $user->id, 'issue_id' => $id])->get();

        $issue=Issue::find($id);

        if(!count($check))
        {
            
            $issueLike = new Vote();
            $issueLike->user_id = $user->id;
            $issueLike->issue_id = $issue->id;
            $issueLike->type = 1;
            $issueLike->save();

        } else {
            $vote = $check[0];
            if($vote->type=='0')
            {
                $vote->type = 1;
                $vote->save();
            }
        }

        return Response::json([
                'code' => 200,
                'status' => 'upvoted',
            ], 200); 
        
    }

    public function downvote(Request $request, $id)
    {
        $user = Auth::user();

        $check = Vote::where(['user_id' => $user->id, 'issue_id' => $id])->get();

        $issue=Issue::find($id);

        if(!count($check))
        {
            
            $issueLike = new Vote();
            $issueLike->user_id = $user->id;
            $issueLike->issue_id = $issue->id;
            $issueLike->type = 0;
            $issueLike->save();

        } else {
            $vote = $check[0];
            if($vote->type=='1')
            {
                $vote->type = 0;
                $vote->save();
            }
        }

        return Response::json([
                'code' => 200,
                'status' => 'downvoted',
            ], 200); 
    }

}
