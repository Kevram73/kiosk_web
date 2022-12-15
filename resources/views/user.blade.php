@extends('admin.layouts.app')
@section('title')
    Utilisateurs
    @endsection

@section('active')
    {{__('Utilisateurs')}}
    @endsection

 @section('header')
     {{__('Utilisateurs')}}
     @endsection

@section('css')
    <!-- DataTables-->
    <link rel="stylesheet" href="{{asset('assets/template_admin/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/template_admin/dist/datatable/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/template_admin/plugins/iCheck/all.css')}}">

    @endsection

@section('js')


    <!-- <script src="assets/template_admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>-->
    <!-- DataTables -->
    <script src="{{asset('assets/template_admin/dist/datatable/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/template_admin/dist/datatable/dataTables.bootstrap4.min.js')}}"></script>
    <!-- SlimScroll
   /<script src="assets/template_admin/dist/datatable/jquery.slimscroll.min.js"></script>-->
    <!-- FastClick -->
    <script src="{{asset('assets/template_admin/bower_components/fastclick/lib/fastclick.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('assets/template_admin/dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('assets/template_admin/dist/js/demo.js')}}"></script>
    <script src="{{asset('assets/template_admin/dist/js/user/myUserJs.js')}}"></script>
    <script src="{{asset('assets/template_admin/plugins/iCheck/icheck.min.js')}}"></script>
    <!-- InputMask -->
    <script src="{{asset('assets/template_admin/plugins/input-mask/jquery.inputmask.js')}}"></script>
    <script src="{{asset('assets/template_admin/plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>




@endsection
@section('content')
    <div class="box box-primary">
        <div class="box-header  with-border">

            <h3 class="box-title">Les utilisateurs</h3>
            <div class="box-tools pull-right">
                <a class="btn btn-primary" id="addUser">
                    <i class="fa fa-plus"></i>
                    {{__('ajouter un utilisateur')}}
                </a>
            </div>

        </div>


        <div class="box-body">

            <table id="userTable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                    <th class="col-1">{{__('#')}}</th>
                    <th>{{__('id')}}</th>
                    <th>{{__('Nom')}}</th>
                    <th>{{__('Prenoms')}}</th>
                    <th>{{__('Sexe')}}</th>
                    <th>{{__('Username')}}</th>
                    <th>{{__('Action')}}</th>

                </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                </tfoot>
            </table>
        </div>
        <div class="box-footer "></div>
    </div>

    @include('admin.user.userModal')
    @endsection
