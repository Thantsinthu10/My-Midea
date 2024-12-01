@extends('admin.layouts.app')

@section('content')
<div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Trend Post List Page</h3>

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
              <th>ID</th>
              <th>Post Title</th>
              <th>Image</th>
              <th>View Count</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
           @foreach ($post as $item)
           <tr>
            <td>{{ $item['post_id'] }}</td>
            <td>{{ $item['title'] }}</td>
            <td><img class="rounded shadow" width="100px"
                @if ($item['image']==null)
                    src="{{ asset('default_image/images.jpg') }}"
                @else
                src="{{ asset('postImage/'.$item['image']) }}"
                @endif
                 alt=""></td>
            <td><i class="fa-solid fa-eye mr-1"></i>{{ $item['post_count'] }}</td>
            <td>
                <a href="{{ route('admin#trendPostDetails',$item['post_id']) }}">
                    <button class="btn btn-sm bg-dark text-white"><i class="fa-solid fa-file-lines"></i></button>
                </a>

              {{-- <button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button> --}}
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

