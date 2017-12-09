<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Issue;
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

    	return view('issue.view', [
    		'issue' => $issue
    	]);
    }
}
