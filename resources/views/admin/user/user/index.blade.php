@extends('admin.master')
@section('content')
@section('title','User List')
<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
		   <ol class="breadcrumb">
				<li class="active breadcrumbColor"><a href="{{ url('dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
				<li>@yield('title')</li>
			</ol>
		</div>	
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<a href="{{ route('user.create') }}"  class="btn btn-success pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light"> <i class="fa fa-plus-circle" aria-hidden="true"></i> Add User</a>
		</div>	
	</div>
                
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-info">
				<div class="panel-heading"><i class="mdi mdi-table fa-fw"></i> @yield('title')</div>
				<div class="panel-wrapper collapse in" aria-expanded="true">
					<div class="panel-body">
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
						<div class="table-responsive">
							<table id="myTable" class="table table-bordered">
								<thead class="tr_header">
									<tr>
										<th>S/L</th>
										<th>Role</th>
										<th>User Name</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									{!! $sl=null !!}
									@foreach($data AS $value)
										<tr class="{!! $value->user_id !!}">
											<td style="width: 100px;">{!! ++$sl !!}</td>
											<td>@if(isset($value->role->role_name)){!!  $value->role->role_name  !!}@endif</td>
											<td>{!! $value->user_name !!}</td>
											<td  style="width: 100px;">
												<span class="label label-{{ $value->status==2 ? 'warning' : 'success' }}">{{ $value->status==2 ? 'Inactive' : 'Active' }}</span>
											</td>
											<td style="width: 100px;">
												<a href="{!! route('user.edit',$value->user_id) !!}"  class="btn btn-success btn-xs btnColor">
													<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
												</a>
												<a href="{!!route('user.destroy',$value->user_id )!!}" class="delete btn btn-danger btn-xs deleteBtn btnColor"  data-token="{!! csrf_token() !!}" data-id="{!! $value->user_id !!}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
