@extends('layouts.backend_template')
@section('title', 'Sistem Upload SHP | Create User')
@section('menu')
    <li class="treeview">
        <a href="{{url('dashboard')}}">
            <i class="{{'fa fa-dashboard'}}"></i>
            <span>{{'Dashboard'}}</span>
            <span class="pull-right-container"></span>
        </a>
    </li>

    <li class=" active treeview">
        <a href="{{url('user')}}">
            <i class="{{'fa fa-user'}}"></i>
            <span>{{'User'}}</span>
            <span class="pull-right-container"></span>
        </a>
    </li>

    <li class="treeview">
        <a href="{{url('upload_data')}}">
            <i class="{{'fa fa-upload'}}"></i>
            <span>{{'Upload ZIP'}}</span>
            <span class="pull-right-container"></span>
        </a>
    </li>

@endsection
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header" >
            <h1 class="col-lg-pull-6">
                Add User
            </h1>
            <br>
            <br>

        </section>


        <!-- Main content -->
        <section class="content">

            <!-- Main row -->
            <div class="row" >
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="box box-primary">
                        <div class="box-header with-border">

                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <Strong>Try input again</Strong>
                                <ul>
                                @foreach($errors as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="box-body">
                            @if ($message = Session::get('warning'))
                                <div class="alert alert-warning">
                                    <p>{{$message}}</p>
                                </div>
                            @endif

                            <!-- {{--<form method="post" class="form-horizontal">--}} -->
{{--                            <form action="{{route('user.store')}}" method="post" class="form-horizontal">--}}
                            <form action="{{route('user.store')}}" method="post" class="form-horizontal">

<!-- {{--                            <form action="{{url('backend/user/store')}}" method="post" class="form-horizontal">--}}
{{--                                {{!!@csrf_field()}}--}}

                                {{--<div class="row">--}} -->
                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Nama </label>
                                    <div class="col-sm-8">
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Nama" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Email</label>
                                    <div class="col-sm-8">
                                        <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Username</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="username" id="username" class="form-control" placeholder="Username" onkeyup="this.value = this.value.toLowerCase();">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Password </label>
                                    <div class="col-sm-8">
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                                    </div>
                                </div>

                                    <div class="text-right">
                                        <a href="{{url('user')}}" class="btn btn-success">Back</a>
{{--                                        <a href="{{route('user.index')}}" class="btn btn-success">Back</a>--}}
                                        <button type="submit" class="btn btn-primary" >Submit</button>
                                        {{--<a href="{{route('user.store')}}" class="btn btn-primary">Submit</a>--}}
                                    </div>
                                    {{--<div class="text-right">--}}
                                        {{----}}
                                    {{--</div>--}}

                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
            <!-- /.row (main row) -->

        </section>
        <!-- /.content -->

    </div>
@endsection
