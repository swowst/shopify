@extends('backend.layout.app')


@section('content')
    <div class="row">

        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Users</h4>

                    @if(session()->has('succes'))
                        <div style="background-color: green;color: #fff; padding: 5px">
                            {{ session()->get('success') }}
                        </div>
                    @endif

                    @if(count($errors))
                        @foreach($errors->all() as $error)
                            <p style="background-color: red;color: #fff; padding: 5px">{{ $error }}</p>
                        @endforeach
                    @endif

                    @if(!empty($models->id))
                        @php
                            $routeLink = route('panel.users.update',$models->id)
                        @endphp
                    @else
                        @php
                            $routeLink = route('panel.users.store')
                        @endphp
                    @endif

                    <form action="{{ $routeLink }}" class="forms-sample" method="POST">
                        @csrf
                        @if(!empty($models->id))
                            @method('PUT')
                        @endif

                        <div class="form-group">
                            <label for="exampleInputName1">Name</label>
                            <input type="text" class="form-control" id="exampleInputName1" value="{{ $models->name ?? '' }}" name="name" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName1">Email</label>
                            <input type="email" class="form-control" id="exampleInputName1" value="{{ $models->email ?? '' }}" name="email" placeholder="Email">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputName1">Password</label>
                            <input type="text" class="form-control" id="exampleInputName1" value="{{ $models->password ?? '' }}" name="password" placeholder="Password">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputName1">Phone</label>
                            <input type="text" class="form-control" id="exampleInputName1" value="{{ $models->phone ?? '' }}" name="phone" placeholder="Phone">
                        </div>




{{--                        <div class="form-group">--}}
{{--                            <label>File upload</label>--}}
{{--                            <input type="file" name="image" class="file-upload-default">--}}
{{--                            <div class="input-group col-xs-12">--}}
{{--                                <input type="text" class="form-control file-upload-info"  disabled placeholder="Upload Image">--}}
{{--                                <span class="input-group-append">--}}
{{--                          <button class="file-upload-browse btn btn-primary" type="button">Upload</button>--}}
{{--                        </span>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        @if(!empty($models->image))--}}
{{--                            <div style="margin-bottom: 20px" class="row">--}}
{{--                                <img style="width: 200px" src="{{ asset($models->image) }}" alt="">--}}
{{--                            </div>--}}
{{--                        @endif--}}

                        <div class="form-group">
                            @php
                                $status = $models->status ?? '1'
                            @endphp
                            <label for="example">Status</label>
                            <select class="form-control" name="status" id="example">
                                <option {{ $status == '1' ? 'selected' : ''}} value="1">Active</option>
                                <option {{ $status == '0' ? 'selected' : ''}} value="0">Paasive</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <button class="btn btn-light">Cancel</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
