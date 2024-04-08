@extends('admin.layouts.app')


@section('content')
<div class="col-4 ">
        <div class="card">
            <div class="card-body">

                @if (Session::has('successCreate'))
                <div class="alert alert-success bg-success alert-dismissible fade show" role="alert">


                    <strong>
                        {{-- Account Update Success --}}
                        {{Session('successCreate')}}
                    </strong>
                    <button type="button" class="close text-white" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                @endif
                <form action="{{route('admin#category#update')}}" method="POST">
                    @csrf
                    <input type="hidden" name="categoryId" value="{{$category->category_id}}">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Category Name Edit</label>
                      <input type="text"  value="{{old('categoryTitle',$category->title)   }}"  name="categoryTitle" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter category name">
                    @error('categoryTitle')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Description Edit</label>
                      <textarea name="categoryDescription"   id="" cols="30" rows="5" class="form-control" placeholder="Enter description">{{old('categoryDescription',$category->description)   }}</textarea>
                      @error('categoryDescription')
                      <span class="text-danger">{{$message}}</span>
                  @enderror
                    </div>

                <a href="#">
                    <button class=" btn btn-primary" disabled>Create</button>
                </a>
                    <button type="submit" class="btn btn-dark">Update</button>
                </form>
            </div>
        </div>
</div>

<div class="col-8">
    <div class="card">

        @if (Session::has('successDelete'))
        <div class="alert alert-success bg-success alert-dismissible fade show" role="alert">


            <strong>
                {{-- Account Update Success --}}
                {{Session('successDelete')}}
            </strong>
            <button type="button" class="close text-white" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif
      <div class="card-header">

        <h3 class="card-title">Category List    <strong>({{count($categories)}})</strong> </h3>

        <div class="card-tools">


            <form action="{{route('admin#category#search')}}" method="get">
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
        <table class="table table-hover text-nowrap text-center">
          <thead>
            <tr>
              <th>Category ID</th>
              <th>Title </th>
              <th>Description </th>
              <th>Created at</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($categories as  $c)
            <tr>
                <td>{{$c->category_id}}</td>
                <td>{{$c->title}}</td>
                <td>{{$c->description}}</td>
                <td>{{$c->updated_at->format('d/m/Y')}}</td>
                <td>

                    <a href="{{route('admin#category#editPage',$c->category_id)}}">
                        <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button>

                    </a>
                    <a href="{{route('admin#category#delete',$c->category_id)}}">
                        <button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button>

                    </a>
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
