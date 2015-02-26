@extends('tp-nomenu')

@section('content')
	<div class="container">
		<!-- row-app -->
		<div class="row row-app">
			<!-- col -->
			<!-- col-separator.box -->
			<div class="col-separator col-unscrollable box">
				<!-- col-table -->
				<div class="col-table">
					<h4 class="innerAll margin-none border-bottom text-center"><i class="fa fa-lock"></i> Login to your Account</h4>
					<!-- col-table-row -->
					<div class="col-table-row">
						<!-- col-app -->
						<div class="col-app col-unscrollable">
							<!-- col-app -->
							<div class="col-app">
								<div class="login">
									<div class="placeholder text-center"><i class="fa fa-lock"></i>
									</div>
									<div class="panel panel-default col-md-4 col-sm-6 col-sm-offset-3 col-md-offset-4">
										<div class="panel-body">

											@if (count($errors) > 0)
												<div class="alert alert-danger">
													<strong>Whoops!</strong> There were some problems with your input.<br><br>
													<ul>
														@foreach ($errors->all() as $error)
															<li>{{ $error }}</li>
														@endforeach
													</ul>
												</div>
											@endif

											<form role="form" method="post" action="<?php echo URL::to("/login");?>">
												<input type="hidden" name="_token" value="{{ csrf_token() }}">
												<div class="form-group">
													<label for="exampleInputEmail1">Username</label>
													<input type="text" class="form-control" id="exampleInputEmail1" name="username" placeholder="Enter Username">
												</div>
												<div class="form-group">
													<label for="exampleInputPassword1">Password</label>
													<input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
												</div>
												<button type="submit" class="btn btn-primary btn-block">Login</button>
											</form>
										</div>
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
							<!-- // END col-app -->
						</div>
						<!-- // END col-app.col-unscrollable -->
					</div>
					<!-- // END col-table-row -->
				</div>
				<!-- // END col-table -->
			</div>
			<!-- // END col-separator.box -->
		</div>
		<!-- // END row-app -->
	</div>
@endsection
