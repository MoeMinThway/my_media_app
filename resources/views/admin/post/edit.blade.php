@extends('admin.layouts.app')


@section('content')
<div class="col-3 ">
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
                <form action="{{route('admin#post#update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{$post->post_id}}" name="postId" >
                    <div class="form-group">
                      <label for="exampleInputEmail1">Post Title Edit</label>
                      <input type="text" value="{{old('postTitle',$post->title)}}" name="postTitle" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter post title">
                          @error('postTitle')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Post Description Edit</label>
                      <textarea name="postDescription" id="" cols="30" rows="5" class="form-control" placeholder="Enter post description">{{old('postDescription',$post->description)}} </textarea>
                      @error('postDescription')
                      <span class="text-danger">{{$message}}</span>
                  @enderror
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1">Post Image Edit</label>
             <div class="">
                @if ($post->image == null)
                <img class="rounded shadow-sm"  src="{{asset('defaultImage/default.jpg')}}" alt="" width="240px">


                @else
                <img class="rounded shadow-sm"  src="{{asset('/postImage/'.$post->image)}}" alt="" width="240px">

                @endif
             </div>

                        <input type="file"  value="{{old('postImage',$post->image)}}" name="postImage" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter post title">
                            @error('postImage')
                              <span class="text-danger">{{$message}}</span>
                          @enderror
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Category Name Edit</label>
                        <select name="postCategory" id="" class="form-control" >
                            <option value="">Choose category</option>

                            @foreach ($categories as $c)

                            @if ($post->category_id == $c->category_id)
                               <option selected value="{{$c->category_id}}">{{$c->title}} </option>
                            @endif
                            <option  value="{{$c->category_id}}">{{$c->title}} </option>
                            @endforeach


                        </select>


                        @error('postCategory')
                              <span class="text-danger">{{$message}}</span>
                          @enderror
                      </div>


                    <a href="#">
                        <button class="btn btn-primary" disabled>Create</button>
                    </a>
                    <button type="submit" class="btn btn-dark">Update</button>



                </form>
            </div>
        </div>
</div>

<div class="col-9">
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

        <h3 class="card-title">Posts List
             {{-- <strong>({{count($pategories)}})</strong> --}}
             </h3>

        <div class="card-tools">


            {{-- <form action="{{route('admin#category#search')}}" method="get">
                @csrf

                <div class="input-group input-group-sm" style="width: 150px;">


                    <input type="text" value="{{$searchKey}}" name="searchKey" class="form-control float-right" placeholder="Search">
                <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
            </form> --}}
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap text-center">
          <thead>
            <tr>
              <th> ID</th>
              <th>Title </th>
              <th>Image </th>
              <th>Description </th>
              <th>Category </th>
              {{-- <th>Created at</th> --}}
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($posts as  $p)
            <tr >
                <td >{{$p->post_id}}</td>
                <td>{{$p->title}}</td>
                <td>
                    {{-- {{$p->image}} --}}

                    @if ($p->image == null)
                    <img class="rounded shadow-sm"  src="{{asset('defaultImage/default.jpg')}}" alt="" width="100px">


                    @else
                    <img class="rounded shadow-sm"  src="{{asset('/postImage/'.$p->image)}}" alt="" width="100px">

                    @endif


                </td>
                <td>{{$p->description}}</td>
                <td>
                    {{-- {{$p->category_id}} --}}
                    @foreach ($categories as $c)
                        @if ($p->category_id == $c->category_id)
                            {{$c->title}}
                        @endif
                    @endforeach



                </td>
                {{-- <td>{{$p->updated_at->format('d/m/Y')}}</td> --}}
                <td>

                    <a href="{{route('admin#post#editPage',$p->post_id)}}">
                        <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button>

                    </a>
                    <a href="{{route('admin#post#delete',$p->post_id)}}">
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
