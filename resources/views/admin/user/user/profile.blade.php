@extends('admin.master')
@section('content')
@section('title','Profile')
<style>
	.panel-custom {
		background-color: #F1F1F1;
		box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
		padding: 10px 15px;
	}
	.item{
		padding: 13px 21px;
	}

</style>
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
		<div class="col-sm-12">
			<div class="panel panel-info">
				<div class="panel-heading"><i class="mdi mdi-table fa-fw"></i> Profile</div>
				<div class="panel-wrapper collapse in" aria-expanded="true">
					<div class="panel-body">
						<div class="panel-body">
							<div class="">
								<div class="col-xs-6 col-sm-6 col-md-4">
									<div id="resume">
										<p><strong>{{$employeeInfo->first_name}} {{$employeeInfo->last_name}}</strong></p>
										<p><b>E-mail :</b> {{$employeeInfo->email}}</p><p>
										</p><p class="applicant_address"> <b>Address : </b> {{$employeeInfo->address}}</p>
										<p> <b>Mobile No :</b>   +880{{$employeeInfo->phone}}</p><p>

										</p>
									</div>
								</div>
								<div class="col-md-offset-2 col-xs-6 col-sm-6 col-md-6">
									<div class="applicant_pic text-right">
                                        <?php
                                        	if($employeeInfo->photo !=''){
                                        ?>
											<img style="width: 124px;height:135px" src="{!! asset('uploads/employeePhoto/'.$employeeInfo->photo) !!}">
                                        <?php  }else{ ?>
											<img style="width: 124px;height:135px" src="{!! asset('admin_assets/img/default.png') !!}">
                                        <?php } ?>
									</div>
									<br>
								</div>



								<!----------------------
                                'ACADEMIC QUALIFICATION:
                                ------------------------>
								<div class="education_qualification">
									<section class="content">
										<div class="row">
											<div class="col-xs-12">
												<div class="panel-custom">
													<h3 class="panel-title"><i class="fa fa-graduation-cap"></i>  EDUCATION QUALIFICATION</h3>
												</div>
												<div class="box">
													<div class="box-body">
														<table id="example1" class="table table-bordered table-hover">
															<thead class="education_lable">
															<tr>
																<th>Institute</th>
																<th>Degree</th>
																<th>Board / University Name</th>
																<th>Result</th>
																<th>GPA / CGPA</th>
																<th>Passing Year</th>
															</tr>
															</thead>
															<tbody class="education_lable">
																@if(count($employeeEducation) > 0)
																	@foreach($employeeEducation as $education)
																	<tr>
																		<td>{{$education->institute}}</td>
																		<td>{{$education->degree}}</td>
																		<td>{{$education->board_university}}</td>
																		<td>{{$education->result}}</td>
																		<td>{{$education->cgpa}}</td>
																		<td>{{$education->passing_year}}</td>
																	</tr>
																	@endforeach
																	@else
																	<tr class="text-center">
																		<td>--</td>
																		<td>--</td>
																		<td>--</td>
																		<td>--</td>
																		<td>--</td>
																		<td>--</td>
																	</tr>
																@endif
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
									</section>
									<br>
								</div>

								<div class="education_qualification">
									<section class="content">
										<div class="row">
											<div class="col-xs-12">
												<div class="panel-custom">
													<h3 class="panel-title"><i class="fa fa-laptop"></i> PROFESSIONAL EXPERIENCE</h3>
												</div>
												<div class="box">
													<div class="box-body">
														<table id="example1" class="table table-bordered table-hover">
															<thead class="education_lable">
															<tr>
																<th>Organization Name</th>
																<th>Designation</th>
																<th>Duration</th>
																<th>Responsibility</th>
																<th>Skill</th>
															</tr>
															</thead>
															<tbody class="education_lable">
																@if(count($employeeExperience) > 0)
																	@foreach($employeeExperience as $experience)
																		<tr>
																			<td>{{$experience->organization_name}}</td>
																			<td>{{$experience->designation}}</td>
																			<td>{{$experience->from_date}} To {{$experience->to_date}}</td>
																			<td>{{$experience->skill}}</td>
																			<td>{{$experience->responsibility}}</td>
																		</tr>
																	@endforeach
																@else
																	<tr>
																		<td>--</td>
																		<td>--</td>
																		<td>--</td>
																		<td>--</td>
																		<td>--</td>
																	</tr>
																@endif
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
									</section>
									<br>
								</div>
								<!-------------personal info --------->

								<div class="personal_info">
									<div class="row">
										<div class="col-xs-12">
											<div class="panel-custom">
												<h3 class="panel-title"><i class="fa fa-info-circle"></i> PERSONAL INFORMATION</h3>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="personal_info">
											<div class="item">
												<div class="col-xs-2 col-sm-2 col-md-3">Name</div>
												<div class="col-xs-10 col-sm-10 col-md-9">:&nbsp;&nbsp;&nbsp;&nbsp;{{$employeeInfo->first_name}} {{$employeeInfo->last_name}}</div>
											</div>
											<div class="item">
												<div class="col-xs-2 col-sm-2 col-md-3">Email</div>
												<div class="col-xs-10 col-sm-10 col-md-9">:&nbsp;&nbsp;&nbsp;&nbsp;{{$employeeInfo->email}}</div>
											</div>
											<div class="item">
												<div class="col-xs-2 col-sm-2 col-md-3">Address</div>
												<div class="col-xs-10 col-sm-10 col-md-9">:&nbsp;&nbsp;&nbsp;&nbsp;{{$employeeInfo->address}}</div>
											</div>
											<div class="item">
												<div class="col-xs-2 col-sm-2 col-md-3">Mobile</div>
												<div class="col-xs-10 col-sm-10 col-md-9">:&nbsp;&nbsp;&nbsp;&nbsp;+880{{$employeeInfo->phone}}</div>
											</div>
											<div class="item">
												<div class="col-xs-2 col-sm-2 col-md-3">Date Of Joining</div>
												<div class="col-xs-10 col-sm-10 col-md-9">:&nbsp;&nbsp;&nbsp;&nbsp;{{dateConvertDBtoForm($employeeInfo->date_of_joining)}}</div>
											</div>
											<div class="item">
												<div class="col-xs-2 col-sm-2 col-md-3">Date Of Birth</div>
												<div class="col-xs-10 col-sm-10 col-md-9">:&nbsp;&nbsp;&nbsp;&nbsp;{{dateConvertDBtoForm($employeeInfo->date_of_birth)}}</div>
											</div>

											<div class="item">
												<div class="col-xs-2 col-sm-2 col-md-3">Gender</div>
												<div class="col-xs-10 col-sm-10 col-md-9">:&nbsp;&nbsp;&nbsp;&nbsp;{{$employeeInfo->gender}}</div>
											</div>
											<div class="item">
												<div class="col-xs-2 col-sm-2 col-md-3">Religion</div>
												<div class="col-xs-10 col-sm-10 col-md-9">:&nbsp;&nbsp;&nbsp;&nbsp;{{$employeeInfo->religion}}</div>
											</div>
											<div class="item">
												<div class="col-xs-2 col-sm-2 col-md-3">Marital Status</div>
												<div class="col-xs-10 col-sm-10 col-md-9">:&nbsp;&nbsp;&nbsp;&nbsp;{{$employeeInfo->marital_status}}</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4"></div>
									<div class="col-md-4">
										<hr>

									</div>
									<div class="col-md-4"></div>
								</div>

							</div>
						</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
