@extends('adminlte::page')

@section('title', ucfirst(trans('app.create')))

@section('content_header')
    @include('flash::message')
    <h1>{{ ucfirst(trans('app.create')) }}</h1>
@stop

@section('content')

    {{ Form::open(['url' => 'admin/post', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'form-post']) }}

    @csrf

    <div class="form-row">
        <div class="col-md-8">
            <div class="position-relative form-group">
                {!! Form::label('title', ucwords(trans('blog.title')) . ':') !!}
                {!! Form::text('title', null, ['class' => 'form-control', 'required']) !!}
            </div>
        </div>

        <div class="col-md-8">
            <div class="position-relative form-group">
                {!! Form::label('description', ucwords(trans('blog.description')) . ':') !!}
                {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 30, 'id' => 'description', 'required']) !!}
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="col-sm-12 text-right">
        {!! Form::submit(ucwords(trans('app.save')), ['class' => 'btn btn-primary', 'name' => 'submitbutton', 'value' => 'save']) !!}
    </div>
    {!! Form::close() !!}

    <div class="clearfix"></div>
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

    </script>
@stop
