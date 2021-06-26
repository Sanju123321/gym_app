@extends('Admin.Layout.app')
@section('title', 'Add'.' '.$label)
@section('content')

<section class="admin-content">
    <div class="bg-dark">
        <div class="container  m-b-30">
            <div class="row">
                <div class="col-12 text-white p-t-40 p-b-90">

                    <h4 class=""> Add {{$label}}</h4>

                </div>
            </div>
        </div>
    </div>

    <div class="container  pull-up">
        <div class="row">
            <div class="col-lg-12">

                <!--widget card begin-->
                <div class="card m-b-30">
                    <div class="card-body ">
                        <form action="{{url('admin/user/add')}}" method="post" id="add_edit_user" autocomplete="off">
                            @csrf
                            <input type="hidden" name="id" value="{{@$user['id']}}">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">User Name</label>
                                    <input type="text" class="form-control" name="user_name" id="user_name" placeholder="User Name*" required value="{{old('user_name') ?: @$user->user_name}}">
                                    @if ($errors->has('user_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('user_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Mobile Number</label>
                                    <input type="number" class="form-control" value="{{old('phone_number') ?: @$user->phone_number}}" name="phone_number" id="phone_number" placeholder="Mobile Number*" required>
                                    @if ($errors->has('phone_number'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Email</label>
                                    <input type="email" class="form-control" value="{{old('email') ?: @$user->email}}" name="email" id="email" placeholder="Email" required>
                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            @if(!@$user->id)
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password*" required>
                                    @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>      
                            @endif  
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputPassword4">Status</label>
                                    <select name="status" class="form-control js-select2" required>
                                        <option selected disabled>Select Status</option>
                                        <option value="Active" @if(@$user->status == 'Active') selected @endif>Active</option>
                                        <option value="Deactivate" @if(@$user->status == 'Deactivate') selected @endif>Deactivate</option>
                                    </select>
                                    @if ($errors->has('status'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Submit" class="btn btn-primary">
                                <a href="{{url('/admin/manage-users')}}" class="btn btn-info">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
                <!--widget card ends-->



            </div>
        </div>


    </div>
</section>
<script type="text/javascript">
    $('#add_edit_user').validate({
        ignore: [],
        rules: {
            user_name: {
                required: true,
                minlength: 2,
                maxlength: 30,
            },
            password: {
                required: true,
            },
            type: {
                required: true,
            },
        },
        errorPlacement: function(error, element) {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent()); // radio/checkbox?
            } else if (element.hasClass('js-select2')) {
                error.insertAfter(element.next('span')); // select2
            } else {
                error.insertAfter(element); // default
            }
        },
    });
</script>
@endsection