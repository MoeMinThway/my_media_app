
@extends('admin.layouts.app')


@section('content')
<div class="col-8 offset-3 mt-5">
    <div class="col-md-9">
      <div class="card">
        <div class="card-header p-2">
          <legend class="text-center">User Profile


          </legend>
        </div>
        <div class="card-body">
          <div class="tab-content">
            <div class="active tab-pane" id="activity">

                @if (Session::has('message'))
                <div class="alert alert-success bg-success alert-dismissible fade show" role="alert">
                    <strong>

                        {{Session('message')}}
                    </strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                @endif



              <form class="form-horizontal" action="{{route('admin#update')}}" method="POST">
                @csrf
                <input type="hidden" name="adminId" value="{{$user->id}}">
                <div class="form-group row">
                  <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                  <div class="col-sm-10">
                    <input type="text" value="{{old('adminName',$user->name)   }}"  name="adminName" class="form-control" id="inputName" placeholder="Name">
                    @error('adminName')
                        <div class="text-danger"> {{$message}}</div>
                    @enderror
                </div>
                </div>

                <div class="form-group row">
                  <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-10">
                    <input type="email" name="adminEmail" value="{{old('adminEmail',$user->email)}}" class="form-control" id="inputEmail" placeholder="Email">
                    @error('adminName')
                    <div class="text-danger"> {{$message}}</div>
                @enderror
                </div>
                </div>

                <div class="form-group row">
                  <label for="inputEmail" class="col-sm-2 col-form-label">Phone</label>
                  <div class="col-sm-10">
                    <input type="number" name="adminPhone" value="{{$user->phone}}" class="form-control" id="inputEmail" placeholder="Phone">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputEmail" class="col-sm-2 col-form-label">Address</label>
                  <div class="col-sm-10">
                    {{-- <input type="email" class="form-control" id="inputEmail" placeholder="Email"> --}}
                    <textarea name="adminAddress"  id="" cols="30" rows="3" placeholder="Address" class="form-control">{{$user->address}}</textarea>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputEmail" class="col-sm-2 col-form-label">Gender</label>
                  <div class="col-sm-10">
                    <select name="adminGender" id="" class="form-control">
                       @if ( $user->gender == 'male')
                                <option value="empty">Gender</option>
                                <option value="male" selected>Male</option>
                                <option value="female">Female</option>
                        @elseif ( $user->gender == 'female')
                                <option value="empty">Gender</option>
                                <option value="male" >Male</option>
                                <option value="female" selected>Female</option>
                        @else
                                <option value="empty" selected>Gender</option>
                                <option value="male" >Male</option>
                                <option value="female">Female</option>

                       @endif

                    </select>
                  </div>
                </div>


                <div class="form-group row">
                  <div class="offset-sm-2 col-sm-10">
                    <button type="submit" class="btn bg-dark text-white">Update</button>
                  </div>
                </div>
              </form>
              <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                  <a href="{{route('admin#changePassword')}}">Change Password</a>
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
