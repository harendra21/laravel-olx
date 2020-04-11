@extends('layouts')
@section('content')
   	

   	<div class="container">
        <div class="row">
        	<div class="col-md-4 col-sm-6 offset-md-4 offset-sm-3">
        		<br>
        		<div class="card ">
        			<div class="text-center">
	        			<h3>Login</h3>
	        			
	        		</div>
		            <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
		            
		            <div class="card-body">
		            	<form class="form-group" action="{{ url('/') }}/do-login" method="POST">

		            		<div class="form-group">
		            			<input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" autofocus value={{old('email')}}>
		            			@if ($errors->has('email'))
								    <div class="error">{{ $errors->first('email') }}</div>
								@endif
		            		</div>
		            		@csrf

		            		<div class="form-group">
		            			<input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password">
		            			@if ($errors->has('password'))
								    <div class="error">{{ $errors->first('password') }}</div>
								@endif
		            		</div>
		            		@if (Session::has('error'))
								<div class="error">
									 {{ Session::get('error') }}
								</div>
							@endif

		            		<div class="form-group">
		            			<button class="btn btn-lg btn-primary btn-block btn-sm" type="submit">Sign in</button>
		            		</div>

		            		<div class="form-group">
		            			Don't have an account ? <a href="{{ url('/') }}/register">Register Here</a>
		            		</div>
			            </form><!-- /form -->
		            </div>
		            

		        </div><!-- /card-container -->
        	</div>
        </div>	
    </div><!-- /container -->


@endsection