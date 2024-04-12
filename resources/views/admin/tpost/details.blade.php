@extends('admin.layouts.app')


@section('content')
<div class="col-10 offset-1 mt-5">

  <div class="card">
<div class="mt-3">
    <a href="{{route('admin#trendPost')}}" class="btn btn-danger bg-danger ml-3"> <i class="fa-solid fa-arrow-left "></i>  Back</a>

</div>

          <div class="d-flex justify-content-center">
            @if ($data->image == null)
            <img class="rounded p-5 mp5 shadow-sm"  src="{{asset('defaultImage/default.jpg')}}" alt="" width="70%">


            @else
            <img class="rounded p-5 mp5 shadow-sm"  src="{{asset('/postImage/'.$data->image)}}" alt="" width="70%">

            @endif
          </div>

     <div class="row">
        <div class="col-8 offset-2">
            <div class="row">
                {{-- <div class="col">
                    <div class="h1">Title :</div>
                    <div class="h1">Description :</div>
                    <div class="h1">Category :</div>
                </div> --}}
                <div class="col text-center">
                    <div class="h1">{{$data->title}} </div>
                    <div class="h1">{{$data->description}} </div>
                    <div class="h1">{{$data->category_id}} </div>
                </div>

            </div>

        </div>
     </div>
  </div>
  </div>
@endsection
{{--  --}}
