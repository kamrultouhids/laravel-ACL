@extends('admin.master')
@section('content')
@section('title','Add Role Permission')
	<div class="container-fluid">
		<div class="row bg-title">
			<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
				<ol class="breadcrumb">
					<li class="active breadcrumbColor"><a href="{{ url('dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
					<li>@yield('title')</li>
				  
				</ol>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-info">
					<div class="panel-heading"><i class="mdi mdi-clipboard-text fa-fw"></i> Role Permission</div>
					<div class="panel-wrapper collapse in" aria-expanded="true">
						<div class="panel-body">
							{{ Form::open(array('route' => 'permission.store','enctype'=>'multipart/form-data','id'=>'permission')) }}
							<div class="form-body">
								<div class="row">
									<div class="col-md-8 col-sm-12">
										@if($errors->any())
											<div class="alert alert-danger alert-dismissible" role="alert">
												<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
															aria-hidden="true">×</span></button>
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
										<div class="form-group">
											<label for="role">User Role<span class="validateRq">*</span></label>
                                            @php
                                                $data[''] = '---- Select Role ----';
                                            @endphp
											{{ Form::select('role_id',$data, Input::old('role_id'), array('class' => 'form-control role_id  required','onchange'=>'getMenu(this)','id'=>'role_id')) }}
										</div>
									</div>
									<div class="col-md-4"></div>

								</div>
								<div class="row">
									<div class="form-group">
										<div class="ShowMember">

										</div>
									</div>
								</div>


							</div>
							<div class="form-actions">
								<div class="row">
									<div class="col-md-6">
										<button type="submit" id="formSubmit" disabled="disabled" class="btn btn-info btn_style"><i class="fa fa-check"></i> Update</button>
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
@section('page_scripts')
	<script>
        $(document).on('change','[data-menu]',function(event){
            if(this.checked==false){
                var getMenuId = $(this).attr('data-menu');
                $('[data-formenu="'+getMenuId+'"]').prop('checked',false);
            }
        });
        $(document).on('change','[data-formenu]',function(event){
            if(this.checked==true){
                var getMenuId = $(this).attr('data-formenu');
                $('[data-menu="'+getMenuId+'"]').prop('checked',true);
            }
        });
        $(document).on("click", '.checkAll', function (event) {
            if (this.checked) {
                $('.inputCheckbox').each(function () {
                    this.checked = true;
                });
            } else {
                $('.inputCheckbox').each(function () {
                    this.checked = false;
                });
            }
        });

        function getMenu(select) {

            var role_id = $('.role_id ').val();
            if (role_id != '') {
                $('body').find('#formSubmit').attr('disabled', false);
            } else {
                $('.inputCheckbox').each(function(){
                    this.checked = false;
                });
                $('body').find('#formSubmit').attr('disabled', true);
                $(".se-pre-con").fadeOut("slow");
                return false;
            }

            var action = "{{ URL::to('permission/get_all_menu') }}";
            $.ajax({
                type: 'POST',
                url: action,
                data: {role_id: role_id, '_token': $('input[name=_token]').val()},

                success: function (result) {
                    var subMenus,checkedValue;
                    var dataFormat = '<label class="col-md-2 col-sm-12 control-label" style="padding: 17px;">Pages permission </label>';

                    dataFormat += '<div id="area_select" class="col-md-6 col-sm-12" style="margin-top: 20px">';
                    dataFormat += '<div class="checkbox checkbox-info">';
                    dataFormat += '<input class="inputCheckbox checkAll"  type="checkbox" id="inlineCheckbox" >';
                    dataFormat += '<label for="inlineCheckbox"><strong>Select All</strong></label>';
                    dataFormat += '	</div>';
                    var sl=1;
                    $.each(result.arrayFormat, function (key, value) {
                        dataFormat += '<div class="well" style="margin-bottom:15px; padding:20px">';
                        dataFormat += '<span style="font-weight:bold; border-bottom:1px solid #000;">' + key + '</span>';
                        dataFormat += '<div class="panel-body">';

                        $.each(value, function (key1, value1) {
                            sl++;
                            checkedValue = '';
                            if (value1['hasPermission'] == 'yes') {
                                checkedValue = 'checked';
                            }
                            dataFormat += '<div class="checkbox checkbox-info">';
                            dataFormat += '<input class="inputCheckbox" data-menu="' + value1['id'] + '" type="checkbox" id="inlineCheckbox1'+sl+'" ' + checkedValue + ' name="menu_id[]" value="' + value1['id'] + '">';
                            dataFormat += '<label for="inlineCheckbox1'+sl+'">'+ value1['name'] + '</label>';
                            dataFormat += '</div>';
                            if(result.subMenu[value1['id']] !== undefined){
                                subMenus = result.subMenu[value1['id']];
                                var i=1;
                                for(var subMenuIndex in subMenus){
                                    checkedValue='';
                                    if(subMenus[subMenuIndex].hasPermission=='yes'){
                                        checkedValue='checked';
                                    }
                                    var subMenuCss = 'margin-bottom: 12px';
                                    if(i==1){
                                        subMenuCss = "margin-bottom: 12px;margin-left: 24px";
                                    }
                                    i++;
                                    dataFormat += '<div style="'+subMenuCss+'" class="checkbox checkbox-inline checkbox-primary">';
                                    dataFormat += '<input class="inputCheckbox" type="checkbox" id="inlineCheckbox'+subMenus[subMenuIndex].id+'" value="' + subMenus[subMenuIndex].id + '" data-formenu="' + value1['id'] + '" '+checkedValue+' name="menu_id[]" value="'+subMenus[subMenuIndex].id+'">';
                                    dataFormat += '<label for="inlineCheckbox'+subMenus[subMenuIndex].id+'"> '+subMenus[subMenuIndex].name+' </label>';
                                    dataFormat += '</div>';
                                }
                                i=1;
                            }

                        })

                        dataFormat += '</div>';
                        dataFormat += '</div>';

                    });
                    $('.ShowMember').html(dataFormat);
                }
            });
        }
	</script>
@endsection