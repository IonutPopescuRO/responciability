@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="header">
                <h4 class="title">Edit Profile</h4>
            </div>
            <div class="content">
                <form>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input class="form-control" placeholder="Email" type="email" value="{{ Auth::user()->email }}" disabled="">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>First Name</label>
                                <input class="form-control" placeholder="Company" value="{{ Auth::user()->name }}" type="text">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input class="form-control" placeholder="Last Name" value="{{ Auth::user()->lname }}" type="text">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Age</label>
                                <input class="form-control" placeholder="City" value="{{ Auth::user()->age }}" type="number">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Gender</label>
								<select class="form-control" name="gender">
									<option value="Male"<?php if(Auth::user()->gender=="Male") print ' selected'; ?>>Male</option>
									<option value="Female"<?php if(Auth::user()->gender=="Female") print ' selected'; ?>>Female</option>
									<option value="Other"<?php if(Auth::user()->gender=="Other") print ' selected'; ?>>Other</option>
								</select> 
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Address</label>
                                <input class="form-control" placeholder="Home Address" value="Bld Mihail Kogalniceanu, nr. 8 Bl 1, Sc 1, Ap 09" type="text">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-info btn-fill pull-right">Update Profile</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-user">
            <div class="image">
                <img src="https://ununsplash.imgix.net/photo-1431578500526-4d9613015464?fit=crop&amp;fm=jpg&amp;h=300&amp;q=75&amp;w=400" alt="...">
            </div>
            <div class="content">
                <div class="author">
                    <a href="#">
                        <img class="avatar border-gray" src="{{ \Auth::user()->avatar }}" alt="...">

                        <h4 class="title">{{ Auth::user()->name }} {{ Auth::user()->lname }}<br>
                                         <small>{{ Auth::user()->email }}</small>
                                      </h4>
                    </a>
                </div>
				</br></br></br>
				<hr>
                <p class="description text-center">
					Account created on {{ Auth::user()->created_at }}
                </p>
            </div>
        </div>
    </div>

</div>

@endsection
