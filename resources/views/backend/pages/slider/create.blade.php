@extends('backend.layout.app')


@section('content')
    <div class="row">

        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Slider</h4>

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

                    @if(!empty($slider->id))
                        @php
                            $routeLink = route('panel.slider.update',$slider->id)
                        @endphp
                    @else
                        @php
                            $routeLink = route('panel.slider.store')
                        @endphp
                    @endif

                    <form action="{{ $routeLink }}" class="forms-sample" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(!empty($slider->id))
                            @method('PUT')
                        @endif
                        <div class="form-group">
                            <label for="exampleInputName1">Name</label>
                            <input type="text" class="form-control" id="exampleInputName1" value="{{ $slider->name ?? '' }}" name="name" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail">Content</label>
                            <textarea  class="form-control" id="exampleInputEmail"  name="text" placeholder="Content">{{  $slider->content ?? ''  }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword4">Link</label>
                            <input type="text" class="form-control" value="{{ $slider->link ?? '' }}" id="exampleInputPassword4" name="link" placeholder="Link">
                        </div>



                        <div class="form-group">
                            <label>File upload</label>
                            <input type="file" name="image" class="file-upload-default">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info"  disabled placeholder="Upload Image">
                                <span class="input-group-append">
                          <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                        </span>
                            </div>
                        </div>

                        @if(!empty($slider->image))
                            <div style="margin-bottom: 20px" class="row">
                                <img style="width: 200px" src="{{ asset($slider->image) }}" alt="">
                            </div>
                        @endif

                        <div class="form-group">
                            @php
                                $status = $slider->status ?? '1'
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
