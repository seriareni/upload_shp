<?php
/**
 * Created by PhpStorm.
 * User: SERIA
 * Date: 8/3/2019
 * Time: 6:04 PM
 */
?>


@extends('layouts.backend_template')
@section('title', 'Sistem Upload SHP | Upload ZIP')
@section('menu')
    <li class="treeview">
        <a href="{{url('dashboard')}}">
            <i class="{{'fa fa-dashboard'}}"></i>
            <span>{{'Dashboard'}}</span>
            <span class="pull-right-container"></span>
        </a>
    </li>

    <li class=" treeview">
        <a href="{{url('user')}}">
            <i class="{{'fa fa-user'}}"></i>
            <span>{{'User'}}</span>
            <span class="pull-right-container"></span>
        </a>
    </li>

    <li class=" active treeview">
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
        <section class="content-header">
            <h1>
                Upload File
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Upload File</li>
            </ol>
        </section>

        <section class="content">
            <!-- Main row -->
            <?php
            $name = session()->get('activeUser')->username;
            //        $name = session()->get('activeUser')->name;
            $schema = str_replace(" ", "_", $name);
            ?>

            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    @if ($message = Session::get('warning'))
                        <div class="alert alert-warning">
                            <p>{{$message}}</p>
                        </div>
                    @endif

                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{$message}}</p>
                        </div>
                    @endif

                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Input Data</h3>
                        </div>

                        <div class="box-body">
                            <?php echo Form::open(['url'=>'/upload','id' => 'form-upload', 'files'=>'true', 'required'=>'required']); ?>
                            <div class="row">
                                <div class="col-md-4">
                                    <p class="help-block">Upload file type .zip</p>
                                </div>

                                <div class="col-md-4" >
                                    <?php
                                    echo Form::file('zip_file', ['class' => 'btn btn-md', 'accept' => 'application/zip', 'id'=>'zip_file', 'required'=>'required']);
                                    ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <label for="exampleInputFile"></label>
                                    <p class="help-block">Choose schema : </p>
                                </div>

                                <div class="col-md-4">
                                    <br>
                                    <span class="pull-right-container"></span>

                                    {{--@foreach($schemas as $num => $data)--}}

                                    {{--ini untuk superadmin--}}
                                    <select id="data" name="data" required="required">
                                        <option disabled="disabled">Select Schema</option>
                                        @foreach($schemas as $num => $data)
                                            <option>{{$data->schema_name}}</option>
                                        @endforeach
                                    </select>

                                    {{--{{Form::radio('data', $data->schema_name)}}--}}
                                    {{--                                    {{$data->schema_name}}--}}
                                </div>
                            </div>
                            <div class="text-right">
                                <?php
                                echo Form::submit('Submit', ['class' => 'btn btn-md btn-primary', 'id' =>'submit', 'text-align' => 'right']);
                                echo Form::close();
                                ?>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </section>
    </div>

@endsection
