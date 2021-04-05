@extends('adminlte::page')
@section('css')
    <style>
        .button_new {
            font-size: 25px;
        }

    </style>

@stop

@section('title', 'Post')

@section('content_header')
    @include('flash::message')
    <h1>Posts</h1>

    <div class="page-title-actions" style="float:right">
        <a href="{{ url('admin/post/create') }}" class='btn btn-grey button_new'><i class="fa fa-fw fa-plus-square"></i>
            {{ strtoupper(trans('app.new')) }}</a>
    </div>
@stop

@section('content')

    <div class="main-card mb-3 card">
        <div class="card-body">
            <table id="data-post" class="table table-hover table-striped table-bordered responsive">
                <thead>
                    <tr>
                        <th>{{ ucfirst(trans('blog.title')) }}</th>
                        <th>{{ ucfirst(trans('blog.publication_date')) }}</th>
                        <th>{{ ucfirst(trans('blog.description')) }}</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

@stop



@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                }
            });



        }); // End document ready


        var ruta = "{{ route('admin.post.getPostsDatatable') }}";
        var post_table = $('#data-post').DataTable({

            ajax: {
                url: ruta,
                type: "GET",
                data: function(d) {

                },
            },
            columns: [{
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'publication_date',
                    name: 'publication_date'
                },
                {
                    data: 'description',
                    name: 'description'
                }
            ],
            order: [2, 'DESC'],
            language: {
                "url": "http://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
            },


        });

    </script>
@stop
