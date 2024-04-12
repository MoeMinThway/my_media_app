@extends('admin.layouts.app')


@section('content')
<div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Trend Post List </h3>

        <div class="card-tools">
          <div class="input-group input-group-sm" style="width: 150px;">
            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

            <div class="input-group-append">
              <button type="submit" class="btn btn-default">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap text-center">
          <thead>
            <tr>
              <th> ID</th>
              <th>Post Title</th>
              <th>Image</th>
              <th>View Count</th>

              <th></th>
            </tr>
          </thead>
          <tbody>
           @foreach ($post as $p)
           <tr>
            <td> {{$p->actionLog_id}} </td>
            <td> {{$p->title}} </td>
            <td>

                @if ($p->image == null)
                <img class="rounded shadow-sm"  src="{{asset('defaultImage/default.jpg')}}" alt="" width="100px">


                @else
                <img class="rounded shadow-sm"  src="{{asset('/postImage/'.$p->image)}}" alt="" width="100px">

                @endif
            </td>
            <td>
                <i class="fa-solid fa-eye"></i> {{$p->post_count}}
             </td>


            <td>

                        <a href="{{ route('admin#trendPost#details',$p->post_id)}}">
                            <button class="btn btn-sm bg-dark text-white"><i class="fa-solid fa-file-lines"></i></button>

                        </a>
                </td>
          </tr>

           @endforeach
          </tbody>

        </table>
      <div class="d-flex justify-content-end  mr-5">
        {{-- {{$post->links()}} --}}
      </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
@endsection
{{--  --}}
