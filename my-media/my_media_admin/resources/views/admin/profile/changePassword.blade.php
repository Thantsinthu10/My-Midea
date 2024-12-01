@extends('admin.layouts.app')

@section('content')
    <div class="col-8 offset-3 mt-5">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <legend class="text-center">Change Password</legend>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            {{-- alert start --}}
                            @if (Session::has('lengthError'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ Session::get('lengthError') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            {{-- alert end --}}
                             {{-- alert start --}}
                             @if (Session::has('fail'))
                             <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                 {{ Session::get('fail') }}
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                                 </button>
                             </div>
                         @endif
                         {{-- alert end --}}
                            <form class="form-horizontal ps-5" method="post" action="{{ route('admin#changePassword') }}">
                                @csrf
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-3 col-form-label">Old Password</label>
                                    <div class="col-6">
                                        <input type="password" class="form-control" name="oldPassword" id="oldPassword"
                                            placeholder="Enter Old Password" value="">
                                        @error('oldPassword')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-3 col-form-label">New Password</label>
                                    <div class="col-6">
                                        <input type="password" class="form-control" name="newPassword" id="inputEmail"
                                            placeholder="Enter New Password" value="">
                                        @error('newPassword')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPhone" class="col-sm-3 col-form-label">Confirm Password</label>
                                    <div class="col-6">
                                        <input type="password" class="form-control" name="confirmPassword" id="inputPhone"
                                            placeholder="Enter Confirm Password" value="">
                                            @error('confirmPassword')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="offset-sm-3 col-sm-10">
                                        <button type="submit" class="btn bg-dark text-white">Change Password</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
