@extends('backend.layout.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Basic Table</h4>

                    <p class="card-description">
                        <a class="btn btn-success" href="{{ route('panel.users.create') }}">Add</a>

                    </p>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Buttons</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($models as $model)

                                <tr class="item" item-id="{{ $model->id }}">

                                    <td>{{ $model->name ?? ''}}</td>
                                    <td>{{ $model->email }}</td>
                                    <td>{{ $model->phone ?? '' }}</td>
                                    <td>
{{--                                        <label class="badge badge-{{ $model->status =='1' ? 'success' : 'danger' }}">{{ $model->status =='1' ? 'Active' : 'Passive' }}--}}
{{--                                        </label>--}}

                                        <div class="checkbox">
                                            <label >
                                                <input class="status"  data-onstyle="success" data-offstyle="danger" {{ $model->status =='1' ? 'checked' : '' }} type="checkbox" data-toggle="toggle">
                                            </label>
                                        </div>
                                    </td>

                                    <td class="d-flex">
                                        <a class="btn btn-primary mr-3"  href="{{ route('panel.users.edit',$model->id) }}">Edit</a>

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
            $('.status').on('change', function(){
                var isChecked = $(this).prop('checked');
                var itemId = $(this).closest('.item').attr('item-id');

                // Send AJAX request
                $.ajax({
                    url: '{{ route('panel.users.status') }}',
                    method: 'POST',
                    data: {
                        itemId: itemId,
                        status: isChecked ? 1 : 0,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response){
                        alertify.success('Status updated')
                    },
                    error: function(xhr, status, error){
                        alertify.error('Status updated')

                    }
                });
            });


            $('.deleteBtn').on('click', function(){

                var item = $(this).closest('.item')
                id = item.attr('item-id');
                alertify.confirm('Warning',"Are you sure for delete?",
                    function(){
                        $.ajax({
                            url: '{{ route('panel.users.destroy') }}',
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
