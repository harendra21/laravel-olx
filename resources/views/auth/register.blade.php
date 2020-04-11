@extends('layouts')
@section('content')
   	
	
	
   	<div class="container">
        <div class="row">
        	<div class="col-md-6 col-sm-8 offset-md-3 offset-sm-2">
        		<br>
        		<div class="card ">
        			<div class="text-center">
	        			<h3>Register </h3>
	        			
	        		</div>
		            <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
		            
		            <div class="card-body">
		            	<form class="form-group" action="{{ url('/') }}/do-register" method="POST">

		            		<div class="form-group">
		            			<div class="row">
		            				<div class="col">
		            					<input type="text" name="f_name" id="inputFName" class="form-control" placeholder="First name" autofocus value={{old('f_name')}}>
		            					@if ($errors->has('f_name'))
										    <div class="error">{{ $errors->first('f_name') }}</div>
										@endif
		            				</div>
		            				<div class="col">
		            					<input type="text" name="l_name" id="inputLName" class="form-control" placeholder="Last name" value={{old('l_name')}}>
		            					@if ($errors->has('l_name'))
										    <div class="error">{{ $errors->first('l_name') }}</div>
										@endif
		            				</div>
		            			</div>

		            		</div>


		            		@csrf

		            		<div class="form-group">
		            			<input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" value={{old('email')}}>
		            			@if ($errors->has('email'))
								    <div class="error">{{ $errors->first('email') }}</div>
								@endif
		            		</div>

		            		<div class="form-group">
		            			<input type="text" name="mobile" id="inputMobile" class="form-control" placeholder="Mobile No." value={{old('mobile')}}>
		            			@if ($errors->has('mobile'))
								    <div class="error">{{ $errors->first('mobile') }}</div>
								@endif
		            		</div>

		            		<div class="form-group">
		            			<input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" >
		            			@if ($errors->has('password'))
								    <div class="error">{{ $errors->first('password') }}</div>
								@endif
		            		</div>

		            		<div class="form-group">
		            			<input type="password" name="conf_password" id="inputConfPassword" class="form-control" placeholder="Confirm Password" >
		            			@if ($errors->has('conf_password'))
								    <div class="error">{{ $errors->first('conf_password') }}</div>
								@endif
		            		</div>

		            		<div class="form-group">
		            			<button class="btn btn-lg btn-primary btn-block btn-sm" type="submit">Sign up</button>
		            		</div>

		            		<div class="form-group">
		            			Already have an account ? <a href="{{ url('/') }}/login">Login Here</a>
		            		</div>
			            </form><!-- /form -->
		            </div>
		            

		        </div><!-- /card-container -->
        	</div>
        </div>	
    </div><!-- /container -->


@endsection