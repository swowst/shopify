@extends('backend.layout.app')

@section('customCss')
    <style>
        .ck-content{
            height: 150px!important;
        }
    </style>
@endsection

@section('content')
    <div class="row">

        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">ABOUT</h4>

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
                            $routeLink = route('panel.about.update',$models->id)
                        @endphp
                    @else
                        @php
                            $routeLink = route('panel.about.store')
                        @endphp
                    @endif

                    <form action="{{ $routeLink }}" class="forms-sample" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(!empty($models->id))
                            @method('PUT')
                        @endif

                        <div class="form-group">
                            <label for="exampleInputName1">Name</label>
                            <input type="text" class="form-control" id="exampleInputName1" value="{{ $models->name ?? '' }}" name="name" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail">Content</label>
                            <textarea id="editor" class="form-control" id="exampleInputEmail"  name="text" placeholder="Content">{{  $models->content ?? ''  }}</textarea>
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

                        @if(!empty($models->image))
                            <div style="margin-bottom: 20px" class="row">
                                <img style="width: 200px" src="{{ asset($models->image) }}" alt="">
                            </div>
                        @endif


                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <button class="btn btn-light">Cancel</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('customJs')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.2.0/classic/ckeditor.js"></script>

    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection
