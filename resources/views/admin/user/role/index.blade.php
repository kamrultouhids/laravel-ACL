@extends('admin.master')
@section('content')
@section('title','Role List')
<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
		   <ol class="breadcrumb">
				<li class="active breadcrumbColor"><a href="{{ url('dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
				<li>@yield('title')</li>
			</ol>
		</div>
        @php
			$permissionCheck = permissionCheck();
        @endphp
		@if (in_array('add-role.create',array_column($permissionCheck, 'menu_url')))
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<a href="{{ route('add-role.create') }}"  class="btn btn-success pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light"> <i class="fa fa-plus-circle" aria-hidden="true"></i> Add Role</a>
			</div>
		@endif
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
                       <thead>
                            <tr class="tr_header">
                               <th>S/L</th>
                               <th>Name</th>
                               <th style="text-align: center;">Action</th>
                           </tr>
                       </thead>
                       <tbody>
                           {!! $sl=null !!}
                           @foreach($data AS $value)
                               <tr class="{!! $value->role_id !!}">
                                   <td style="width: 300px;">{!! ++$sl !!}</td>
                                   <td>{!! $value->role_name !!}</td>
                                   <td style="width: 100px;">
									   @if (in_array('add-role.edit',array_column($permissionCheck, 'menu_url')))
										   <a href="{!! route('add-role.edit',$value->role_id) !!}"  class="btn btn-success btn-md btnColor">
											   <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
										   </a>
									   @endif
									   @if (in_array('add-role.destroy',array_column($permissionCheck, 'menu_url')))
									   		<a href="{!!route('add-role.destroy',$value->role_id )!!}" data-token="{!! csrf_token() !!}" data-id="{!! $value->role_id!!}"
											   class="delete btn btn-danger btn-md deleteBtn btnColor"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
										@endif
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
