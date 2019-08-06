<?php
/**
 * Created by PhpStorm.
 * User: SERIA
 * Date: 8/3/2019
 * Time: 4:21 PM
 */
?>

@extends('layouts.backend_template')
@section('title', 'Sistem Upload SHP | Dashboard')
@section('menu')
    <li class="active treeview">
       <a href="{{url('dashboard')}}">
       <i class="{{'fa fa-dashboard'}}"></i>
       <span>{{'Dashboard'}}</span>
       <span class="pull-right-container"></span>
       </a>
    </li>

    <li class="treeview">
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
        <section class="content-header">
            <h1>
                Dashboard
                <small>Dashboard</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>

        <div class="jumbotron" style="padding: 10px;">

        </div>

        <!-- Main content -->
        <section class="content">

            <!-- Main row -->
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-xs-8">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"></h3>
                        </div>
                        <div class="box-body">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <div style="text-align: center">
                                <h3><strong>Welcome</strong></h3>
                                <h1><strong>{{session()->get('activeUser')->name}}</strong></h1>

                            </div>
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

