@extends('backend.layout.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Site Settings</h4>

                    <p class="card-description">
                        <a class="btn btn-success" href="{{ route('panel.setting.create') }}">Add</a>
                    </p>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Image (optional)</th>
                                <th>Key</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Buttons</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($models as $model)

                                <tr class="item" item-id="{{ $model->id }}">
                                    <td class="py-1">
                                        @if($model->set_type == 'image')
                                           <img src="{{ asset($model->image) ?? ''}}" alt="">
                                        @endif
                                    </td>

                                    <td>{{ $model->name ?? ''}}</td>
                                    <td>
                                        {{ $model->data ?? ''}}
                                    </td>

                                    <td>
                                        {{ $model->set_type ?? ''}}
                                    </td>

                                    <td class="d-flex">
                                        <a class="btn btn-primary mr-3"  href="{{ route('panel.setting.edit',$model->id) }}">Edit</a>

{{--                                        <form action="{{ route('panel.slider.destroy', $model->id) }}" method="POST">--}}
{{--                                            @method('DELETE')--}}
{{--                                            @csrf--}}

{{--                                        </form>--}}

                                        <button class="btn deleteBtn btn-danger">Delete</button>
                                    </td>
                                </tr>
                            @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('customJs')
    <script>
        $(document).ready(function(){
            {{--$('.status').on('change', function(){--}}
            {{--    var isChecked = $(this).prop('checked');--}}
            {{--    var itemId = $(this).closest('.item').attr('item-id');--}}

            {{--    // Send AJAX request--}}
            {{--    $.ajax({--}}
            {{--        url: '{{ route('panel.category.status') }}',--}}
            {{--        method: 'POST',--}}
            {{--        data: {--}}
            {{--            itemId: itemId,--}}
            {{--            status: isChecked ? 1 : 0,--}}
            {{--            _token: '{{ csrf_token() }}'--}}
            {{--        },--}}
            {{--        success: function(response){--}}
            {{--            alertify.success('Status updated')--}}
            {{--        },--}}
            {{--        error: function(xhr, status, error){--}}
            {{--            alertify.error('Status updated')--}}

            {{--        }--}}
            {{--    });--}}
            {{--});--}}


            $('.deleteBtn').on('click', function(){

                var item = $(this).closest('.item')
                id = item.attr('item-id');
                alertify.confirm('Warning',"Are you sure for delete?",
                    function(){
                        $.ajax({
                            url: '{{ route('panel.setting.destroy') }}',
                            method: 'DELETE',
                            data: {
                                id: id,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response){
                              if (response.error == false){
                                item.remove();
                                alertify.success(response.message)
                              }else {
                                  alertify.error('Something wrong')
                              }
                            },

                        });

                    },
                    function(){
                        alertify.error('Cancel');
                    });
            });

        });
    </script>
@endsection
