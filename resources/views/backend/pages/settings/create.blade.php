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
                    <h4 class="card-title">Site Settings</h4>

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
                            $routeLink = route('panel.setting.update',$models->id)
                        @endphp
                    @else
                        @php
                            $routeLink = route('panel.setting.store')
                        @endphp
                    @endif

                    <form action="{{ $routeLink }}" class="forms-sample" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(!empty($models->id))
                            @method('PUT')
                        @endif

                        <div class="form-group">
                            <label for="exampleInputName1">Select Type</label>
                            <select class="form-control" name="set_type" id="">
                                <option value="">Select type</option>
                                <option value="ckeditor" {{ isset( $models->set_type) ? $models->set_type == 'ckeditor' ? 'selected' : '' :''}} >Ckeditor</option>
                                <option value="number" {{isset( $models->set_type) ? $models->set_type == 'file' ? 'selected' : '' :''}}>File</option>
                                <option value="image" {{isset( $models->set_type) ? $models->set_type == 'image' ? 'selected' : '' :''}}>Image</option>
                                <option value="email" {{isset( $models->set_type) ? $models->set_type == 'email' ? 'selected' : '' :''}}>Email</option>
                                <option value="textarea" {{isset( $models->set_type) ? $models->set_type == 'textarea' ? 'selected' : '' :''}}>Textarea</option>
                            </select>
                        </div>

                        <div class="form-group">
                            @if(isset( $models->set_type) ?$models->set_type == 'image':'')
                                <img src="{{ asset($models->data) ?? ''}}" alt="">
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="exampleInputName2">Key</label>
                            <input type="text" class="form-control" id="exampleInputName2" value="{{isset($models->name) ? $models->name ?? '' : ''}}" name="name" placeholder="Key">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName1">Value</label>
                             <input type="text" class="form-control" id="exampleInputName1" value="{{isset($models->data) ? $models->data ?? '' : ''}}" name="data" placeholder="Value">

                                <div>
                                    @if(isset($models->set_type) ? $models->set_type == 'ckeditor' : '')
                                        <input class="form-control" type="text" id="editor" value="{{ $models->data }}">
                                    @elseif(isset($models->set_type) ?$models->set_type == 'textarea': '')
                                        <textarea rows="3" class="form-control">{{ $models->data }}</textarea>
                                    @elseif(isset($models->set_type) ?$models->set_type == 'email': '')
                                        <input class="form-control" type="email" value="{{ $models->data }}">
                                    @endif
                                </div>
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
