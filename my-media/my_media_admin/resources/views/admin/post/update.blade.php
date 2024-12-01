@extends('admin.layouts.app')

@section('content')
    <div class="col-4">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin#postUpdate',$postDetails['post_id']) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" value="{{ old('postTitle', $postDetails['title']) }}" name="postTitle"
                            class="form-control" placeholder="Enter category name">
                        @error('postTitle')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="postDescription" id="" class="form-control" cols="20" rows="6"
                            placeholder="Enter Description">{{ old('postDescription', $postDetails['description']) }}</textarea>
                        @error('postDescription')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Image</label> <br>
                        <img width="100%" class="rounded shadow"
                        @if ($postDetails['image'] == null) src="{{ asset('default_image/images.jpg') }}"
                        @else
                        src="{{ asset('postImage/' . $postDetails['image']) }}" @endif>
                        <input type="file" name="postImage" class="form-control mt-2">
                    </div>

                    <div class="form-group">
                        <label>Category Name</label>
                        <select name="postCategory" class="form-control">
                            <option value="">Choose Category</option>
                            @foreach ($category as $item)
                                <option value="{{ $item['category_id'] }}"
                                    @if ($item['category_id'] == $postDetails['category_id']) selected @endif>{{ $item['title'] }}</option>
                            @endforeach
                        </select>
                        @error('postCategory')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-8">
        {{-- alert start --}}
        @if (Session::has('createSuccess'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('createSuccess') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        {{-- alert end --}}
        {{-- alert start --}}
        @if (Session::has('deleteSuccess'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ Session::get('deleteSuccess') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        {{-- alert end --}}
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Category List Page</h3>

                <div class="card-tools">
                    <form action="" method="post">
                        @csrf
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="categorySearch" class="form-control float-right"
                                placeholder="Search">

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
                            <th>Post ID</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($post as $p)
            <tr>
                <td>{{ $p['post_id'] }}</td>
                <td>{{ $p['title'] }}</td>
                <td><img class="rounded shadow" width="100px"
                    @if ($p['image'] == null)
                        src="{{ asset('default_image/images.jpg') }}"
                    @else
                    src="{{ asset('postImage/'.$p['image']) }}" @endif>
            </td>
                <td>
                    <a href="{{ route('admin#updatePostPage',$p['post_id']) }}">
                        <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button>
                    </a>
                  <a href="{{ route('admin#deletePost',$p['post_id']) }}">
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
