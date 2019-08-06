<?php
/**
 * Created by PhpStorm.
 * User: SERIA
 * Date: 8/3/2019
 * Time: 6:03 PM
 */
?>

<?php
/**
 * Created by PhpStorm.
 * User: SERIA
 * Date: 8/3/2019
 * Time: 4:21 PM
 */
?>

@extends('Layouts.backend_template')
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
        <section class="content-header">
            <h1>
                User
            </h1>

        </section>
        <!-- Main content -->
        <section class="content">

            <!-- Main row -->
            <div class="row" >
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            {{--<div class="pull-left">--}}
                            {{--<h3 class="box-title"></h3>--}}
                            {{--</div>--}}
                            <div class="pull-right">
                                {{--route ini berdasarkan dari web pada routes yaitu route::resource user. Index disini mengarah pada Usercontroler fungsi index--}}
                                {{--                             <a class="btn btn-success" href=" {{route('user.create')}} "><i class="fa fa-user-plus"></i> Add User</a>--}}
                                <a class="btn btn-success" href="{{url('user/createUser')}}" ><i class="fa fa-user-plus"></i> Add User</a>
                            </div>
                        </div>

                        <div class="box-body">
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success">
                                    <p>{{$message}}</p>
                                </div>
                            @endif

                            <table  class="table table-bordered table-hover" id="myTable">
                                <thead>
                                <tr>
                                    <th width="50px"><b>No.</b></th>
                                    <th width="300px"><b>Nama</b></th>
                                    <th width="300px"><b>Email</b></th>
                                    <th width="300px"><b>Username</b></th>
                                    <th width="10px"><b></b></th>
                                    <th width="10px"><b></b></th>
                                    <th width="10px"><b></b></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    @if($user->role_id!=1)
                                        <tr>
                                            <td><b>{{++$i}}.</b></td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->username}}</td>
                                            <td>
                                                <a class="btn btn-primary" href="{{ url('user/show/'.$user->user_id)}}">Show</a>
                                                {{--                                            <a class="btn btn-primary" href="{{route('user.show', $user->user_id)}}">Show</a>--}}
                                                {{--<a href="" onclick="konfirmasiHapus({{$user->user_id}})" class="btn btn-danger">Delete</a>--}}
                                            </td>
                                            <td>
                                                <a class="btn btn-warning" href="{{ url('user/edit/'.$user->user_id)}}">Edit</a>
                                            </td>
                                            <td>
                                                <a href="" onclick="konfirmasiHapus({{$user->user_id}})" class="btn btn-danger">Delete</a>
                                                {{--                                            <a href="{{ url('backend/user/delete/'.$user->user_id)}}" class="btn btn-danger">Delete</a>--}}
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>

                            {{--                            {!! $users->links() !!}--}}
                            {{--<p>Hello--}}
                            {{--{{session()->get('activeUser')->name}}--}}
                            {{--</p>--}}
                            {{--<p>--}}
                            {{--Role--}}
                            {{--{{session()->get('activeUser')->role_id}}--}}
                            {{--</p>--}}
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row (main row) -->

        </section>
        <!-- /.content -->

    </div>

    <script>

        function konfirmasiHapus(id) {
            //window.location.href = "https://www.example.com";
            var konfirmasi = confirm("Apakah anda yakin ingin menghapus user ini ?");
            var text = "";
            let url = "{{url('user/delete')}}/" + id;

            if (konfirmasi == true) {
                setTimeout(function () {
                    document.location.href = url
                },100);
            } else {
                return false;
            }
        }

    </script>
@endsection


