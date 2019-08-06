
{{--/**--}}
 {{--* Created by PhpStorm.--}}
 {{--* User: SERIA--}}
 {{--* Date: 1/16/2019--}}
 {{--* Time: 5:09 PM--}}
 {{--*/--}}

@extends('layouts.backend_template')
@section('title', 'Sistem Upload SHP | Users')
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
                Edit User
            </h1>

        </section>


        <!-- Main content -->
        <section class="content">

            <!-- Main row -->
            <div class="row" >
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="box box-primary">

                        <div class="box-body">
                            <br>

                            @if ($message = Session::get('warning'))
                                <div class="alert alert-warning">
                                    <p>{{$message}}</p>
                                </div>
                            @endif

                            <form class="form-horizontal" action="{{route('user.update', $user->user_id)}}" method="post" >
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                                <div class="form-group">
                                    <div class="col-sm-8">
                                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Nama</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="name" class="form-control" value="{{$user->name}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-8">
                                        <input type="email" name="email" class="form-control" value="{{$user->email}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Username</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="email" class="form-control" value="{{$user->username}}" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Password</label>
                                    <div class="col-sm-8">
                                        <input type="password" name="password" class="form-control"  value="{{$user->password}}" disabled>
                                    </div>
                                </div>

                                <div class="text-right">
                                        <a href="{{route('user.index')}}" class="btn btn-success">Back</a>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row (main row) -->

        </section>
        <!-- /.content -->

    </div>
@endsection
