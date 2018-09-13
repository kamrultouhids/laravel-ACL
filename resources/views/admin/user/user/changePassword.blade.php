@extends('admin.master')
@section('content')
@section('title','Change Password')

<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<ol class="breadcrumb">
				<li class="active breadcrumbColor"><a href="{{ url('dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
				<li>@yield('title')</li>

			</ol>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-info">
				<div class="panel-heading"><i class="mdi mdi-clipboard-text fa-fw"></i> Change Password</div>
				<div class="panel-wrapper collapse in" aria-expanded="true">
					<div class="panel-body">
						{{ Form::open(array('route' => array('changePassword.update',Auth::user()->user_id),'enctype'=>'multipart/form-data','id'=>'changePassword','class'=>'form-horizontal', 'method' => 'PUT')) }}
						<div class="form-body">
							<div class="row">
								<div class="col-md-offset-2 col-md-6">
									@if($errors->any())
										<div class="alert alert-danger alert-dismissible" role="alert">
											<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
											@foreach($errors->all() as $error)
												<strong>{!! $error !!}</strong><br>
											@endforeach
										</div>
									@endif
									@if(session()->has('success'))
										<div class="alert alert-success alert-dismissable">
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
											<i class="cr-icon glyphicon glyphicon-ok"></i>&nbsp;<strong>{{ session()->get('success') }}</strong>
										</div>
									@endif
									@if(session()->has('error'))
										<div class="alert alert-danger alert-dismissable">
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
											<i class="glyphicon glyphicon-remove"></i>&nbsp;<strong>{{ session()->get('error') }}</strong>
										</div>
									@endif
								</div>
							</div>
							<div class="row">
								<div class="col-md-8">
									<div class="form-group">
										<label class="control-label col-md-4">User Name<span class="validateRq">*</span></label>
										<div class="col-md-8">
											{!! Form::text('',Auth::user()->user_name, $attributes = array('class'=>'form-control user_name','id'=>'user_name','readonly'=>'readonly')) !!}
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-8">
									<div class="form-group">
										<label class="control-label col-md-4">Old password<span class="validateRq">*</span></label>
										<div class="col-md-8">
											{!! Form::password('oldPassword', $attributes = array('class'=>'form-control required oldPassword','id'=>'oldPassword','placeholder'=>'Enter old password')) !!}
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-8">
									<div class="form-group">
										<label class="control-label col-md-4">New password<span class="validateRq">*</span></label>
										<div class="col-md-8">
											{!! Form::password('password', $attributes = array('class'=>'form-control required password','id'=>'password','placeholder'=>'Enter New password')) !!}
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-8">
									<div class="form-group">
										<label class="control-label col-md-4">Confirm Password<span class="validateRq">*</span></label>
										<div class="col-md-8">
											{!! Form::password('password_confirmation', $attributes = array('class'=>'form-control required password_confirmation','id'=>'password_confirmation','placeholder'=>'Enter Confirm password')) !!}
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-actions">
							<div class="row">
								<div class="col-md-8">
									<div class="row">
										<div class="col-md-offset-4 col-md-8">
											<button type="submit" class="btn btn-info btn_style"><i class="fa fa-pencil"></i> Update </button>
										</div>
									</div>
								</div>
							</div>
						</div>
						{{ Form::close() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

