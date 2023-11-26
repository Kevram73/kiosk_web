@extends('layout')
@section('css')
    <link rel="stylesheet" href="public/octopus/assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />
@endsection
@section('contenu')
    <div class="inner-wrapper">
        <section role="main" class="content-body">
            <header class="page-header">
                <h2>Mon compte</h2>
            </header>

            <div class="row">
                <section class="panel">
                    <header class="panel-heading">
                        <div class="panel-actions">
                            <a href="#" class="fa fa-caret-down"></a>
                        </div>

                        <h1 class="panel-title">MES INFORMATIONS</h1>
                    </header>

                    <div class="panel-body">
                        <a class="btn btn-success" onclick="editUser()"><i class="fa fa-pencil"></i>Changer mon mot de passe</a>
                        <a class="btn btn-danger" role="menuitem" tabindex="-1" href="{{ route('logout') }}"  onclick="event.preventDefault();
                                                                 document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i> Deconnexion
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                             <ul class="list-group">
                                 <li class="list-group-item">Nom :<b> <span class="text-danger" id="sNom">{{Auth::user()->nom}}</span> </b></li>
                                  <li class="list-group-item">Prenoms :<b> <span class="text-danger" id="sPrenom">{{Auth::user()->prenom}}</span> </b></li>
                                  <li class="list-group-item">Sexe :<b> <span class="text-danger " id="sSexe" >{{Auth::user()->sexe}}</span></b></li>
                                  <li class="list-group-item">Email :<b> <span class="text-danger " id="sEmail" >{{Auth::user()->email}}</span></b></li>
                                   <li class="list-group-item">Contact :<b> <span class="text-danger " id="sContact" >{{Auth::user()->contact}}</span></b></li>
                             </ul>
                     </div>
            </div>
        </section>
    </div>


    <div class="modal fade " id="modal-form-user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header " style="background-color: #0b93d5;border-top-left-radius: inherit;border-top-right-radius: inherit">
                    <h4 class="modal-title-user" id="myModalLabel" style="color: white"></h4>
                </div>
                <div class="modal-body">
                    <form id="form" action="" method="POST" class="	form-validate form-horizontal mb-lg" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group mt-lg">
                            <label class="col-sm-3 control-label">Ancien mot de passe</label>
                            <div class="col-sm-6">
                                <input type="password" name="ancien"  id="ancien" class="form-control" placeholder="########" required/>
                            </div>
                        </div>
                        <div class="form-group mt-lg">
                            <label class="col-sm-3 control-label">Nouveau mot de passe</label>
                            <div class="col-sm-6">
                                <input type="password" name="new" id="new" class="form-control" placeholder="#########" required/>
                            </div>
                        </div>
                        <div class="form-group mt-lg">
                            <label class="col-sm-3 control-label">Confirmation</label>
                            <div class="col-sm-6">
                                <input type="password" name="confirm" id="confirm" class="form-control" placeholder="#########" required/>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="col-md-9 text-right">
                                <button type="submit" class="btn btn-primary" id="store_user"><i class="fa fa-check"></i> Valider</button>
                                <button type="button" class="mb-xs mt-xs mr-xs btn btn-default  " data-dismiss="modal"><i class="fa fa-times"></i> Annuler</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')

    <script src="public/octopus/assets/vendor/jquery/jquery.js"></script>
    <script src="public/octopus/assets/vendor/bootstrap/js/bootstrap.js"></script>
    <script src="public/octopus/assets/vendor/nanoscroller/nanoscroller.js"></script>
    <script src="public/octopus/assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
    <script src="public/octopus/assets/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js"></script>
    <script src="public/octopus/assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>
    <script src="public/js/compte.js"></script>

@endsection
