
@extends('admin.layouts.app')


@section('content')
<div class="col-8 offset-3 mt-5">
    <div class="col-md-9">
      <div class="card">
        <div class="card-header p-2">
          <legend class="text-center">
            Change Password


          </legend>
        </div>
        <div class="card-body">
          <div class="tab-content">
            <div class="active tab-pane" id="activity">

                @if (Session::has('fail'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">


                    <strong>
                        {{-- Account Update Success --}}
                        {{Session('fail')}}
                    </strong>
                    <button type="button" class="close text-white" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                @endif


              <form class="form-horizontal" action="{{route('admin#changePasswordPost')}}" method="POST">
                @csrf
                {{-- <input type="hidden" name="adminId" value="{{$user->id}}"> --}}

                <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label">Old Password</label>
                        <div class="col-sm-9">
                            <input type="text" value="{{old('oldPassword')   }}"  name="oldPassword" class="form-control" id="inputName" placeholder="Old Password">
                            @error('oldPassword')
                                <div class="text-danger"> {{$message}}</div>
                            @enderror
                            </div>
                </div>

                <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label">New Password</label>
                        <div class="col-sm-9">
                            <input type="text" value="{{old('newPassword')   }}"  name="newPassword" class="form-control" id="inputName" placeholder="New Password">
                            @error('newPassword')
                                <div class="text-danger"> {{$message}}</div>
                            @enderror
                            </div>
                </div>

                <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label">Comfirm Password</label>
                        <div class="col-sm-9">
                            <input type="text" value="{{old('comfirmPassword')   }}"  name="comfirmPassword" class="form-control" id="inputName" placeholder="Confirm    Password">
                            @error('comfirmPassword')
                                <div class="text-danger"> {{$message}}</div>
                            @enderror
                            </div>
                </div>


                <div class="form-group row">
                  <div class="offset-sm-3 col-sm-8">
                    <button type="submit" class="btn bg-dark text-white">Change</button>
                  </div>
                </div>
              </form>
              <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                  <a href="{{route('dashboard')}}">Back</a>
                </div>
              </div>

            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
{{--  --}}
