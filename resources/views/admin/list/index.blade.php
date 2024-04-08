@extends('admin.layouts.app')


@section('content')
<div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Admin List   <strong>({{count($users)}})</strong> </h3>
        @if ($searchKey  != null)
        <span class=" h5"  style="margin-left:  700px"> {{$searchKey}}</span>
     @endif
        <div class="card-tools">

                <form action="{{route('admin#search')}}" method="POST">
                    @csrf

                    <div class="input-group input-group-sm" style="width: 150px;">


                        <input type="text" value="{{$searchKey}}" name="searchKey" class="form-control float-right" placeholder="Search">
                    <div class="input-group-append">
                          <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                          </button>
                        </div>
                      </div>
                </form>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">

        @if (Session::has('success'))
        <div class="alert alert-success bg-success alert-dismissible fade show" role="alert">
            <strong>

                {{Session('success')}}
            </strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif

        <table class="table table-hover text-nowrap text-center">
          <thead>
            <tr>
                <th>Id</th>
              <th>User Name</th>
              <th>Email </th>
              <th>Phone </th>
              <th>Address </th>
              <th>Gender</th>
              <th></th>
            </tr>
          </thead>
          <tbody>

          @foreach ($users as  $u)

            <tr>
                <td>{{$u->id}}</td>
                <td>{{$u->name}}</td>
                <td>{{$u->email}}</td>
                <td>{{$u->phone}}</td>
                <td>{{$u->address}}</td>
                <td>{{$u->gender}}</td>
                <td>
                   @if (Auth::user()->id != $u->id)
                        <a href="{{route('admin#delete',$u->id)}}">
                            <button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button>
                        </a>
                    @else
                    <a href="#">
                        <button disabled class=" btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button>
                    </a>

                   @endif
                </td>
            </tr>
          @endforeach

          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
@endsection
{{--  --}}
