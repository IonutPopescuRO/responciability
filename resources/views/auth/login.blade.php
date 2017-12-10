@extends('layouts.app')

@section('title') Login @endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                <div class="header"><h4 class="title">Login</h4></div>
				<hr>
                <div class="content">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
								<table>
									<tr>
										<td>
											<div class="checkbox">
												<input id="checkbox" checked="" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
												<label for="checkbox"></label>
											</div>
										</td>
										<td>Remember Me</td>
									</tr>
								</table>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
					<div class="footer">
						<hr>
						<div class="stats">
							<a href="{{ url('login/facebook') }}" class="btn btn-social btn-facebook" style="background-color: #2d4373;color: #FFFFFF;border-color: #3b5998;"><i class="fa fa-facebook-square"></i> Connect with Facebook</a>
							<a href="{{ url('login/google') }}" class="btn btn-social btn-google" style="background-color:border-color: #dd4b39;background-color: #dd4b39;color: #FFFFFF;"><i class="fa fa-facebook-square"></i> Connect with Google</a>
							<a href="{{ url('login/twitter') }}" class="btn btn-social btn-twitter" style="background-color:border-color: #55acee;background-color: #55acee;color: #FFFFFF;"><i class="fa fa-facebook-square"></i> Connect with Twitter</a>
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
