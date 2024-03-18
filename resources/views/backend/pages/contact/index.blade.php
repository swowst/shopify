@extends('backend.layout.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Contact Forms</h4>

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Name Surname</th>
                                <th>E-mail</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>IP</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($models as $model)
                                <tr class="item" item-id="{{ $model->id }}">
                                    <td>{{ $model->name ?? ''}}</td>
                                    <td>
{{--                                        <label class="badge badge-{{ $model->status =='1' ? 'success' : 'danger' }}">{{ $model->status =='1' ? 'Active' : 'Passive' }}--}}
{{--                                        </label>--}}

                                        {{ $model->email ?? ''}}
                                    </td>
                                    <td>{{ $model->subject ?? ''}}</td>
                                    <td>{{ $model->message ?? ''}}</td>
                                    <td>{{ $model->ip ?? ''}}</td>



                                    <td class="d-flex">
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
                            url: '{{ route('panel.contact.destroy') }}',
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
