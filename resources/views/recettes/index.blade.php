@extends('layout')
@section('css')
    <link rel="stylesheet" href="public/octopus/assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />
@endsection
@section('contenu')
    <div class="inner-wrapper">
        <section role="main" class="content-body">
            <header class="page-header">
                <h2>Recette</h2>
            </header>

            <div class="row">
                <section class="panel">
                    <header class="panel-heading">
                        <div class="panel-actions">
                            <a href="#" class="fa fa-caret-down"></a>
                        </div>

                        <h1 class="panel-title">LISTES DES  RECETTES</h1>
                    </header>

                    <div class="panel-body">
                        <a class="modal-with-form btn btn-default mb-xs mt-xs mr-xs btn btn-default" id="btnclient"><i class="fa fa-plus"></i>Ajouter une recette</a>
                        <div class="modal fade " id="ajout_client" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">

                                    <div class="modal-header " style="background-color: #0b93d5;border-top-left-radius: inherit;border-top-right-radius: inherit">
                                        <h4 class="modal-title-user" id="myModalLabel" style="color: white"></h4>
                                    </div>
                                    <div class="modal-body">
                                        <form id="form" action="" method="POST" class="	form-validate form-horizontal mb-lg" enctype="multipart/form-data">
                                            {{csrf_field()}}
                                            <div class="form-group mt-lg">
                                                <label class="col-sm-3 control-label">Fournisseur *</label>
                                                <div class="col-sm-9">
                                                    <select  name="fournisseur" id="fournisseur"   class="form-control populate" required>
                                                        <optgroup label="Choisir un fournisseur">
                                                            @foreach($fournisseurs as $cli)
                                                                <option value="{{$cli->id}}">{{$cli->nom}}</option>
                                                            @endforeach
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group mt-lg">
                                                <label class="col-sm-3 control-label">Type *</label>
                                                <div class="col-sm-9">
                                                    <select  name="type" id="type"   class="form-control populate" required>
                                                        <optgroup label="Choisir un type">
                                                            @foreach($types as $cli)
                                                                <option value="{{$cli->id}}">{{$cli->label}}</option>
                                                            @endforeach
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group mt-lg">
                                                <label class="col-sm-3 control-label">Montant *</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="montant"  id="montant" class="form-control" placeholder="0.0" required/>
                                                </div>
                                            </div>
                                            <div class="form-group mt-lg">
                                                <label class="col-sm-3 control-label">Observation</label>
                                                <div class="col-sm-9">
                                                    <textarea name="observation" id="observation" cols="30" rows="5" class="form-control"></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="col-md-12 text-right">
                                                    <input type="hidden" name="recette_id" id="recette_id"/>
                                                    <button type="submit" class="btn btn-primary" id="btnadd"><i class="fa fa-check"></i> Valider</button>
                                                    <button type="button" class="mb-xs mt-xs mr-xs btn btn-default  " data-dismiss="modal"><i class="fa fa-times"></i> Annuler</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped mb-none" id="clientTable" data-swf-path="public/octopus/assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
                            <thead>
                            <tr>
                                <th class="center hidden-phone">Fournisseur</th>
                                <th class="center hidden-phone">Type</th>
                                <th class="center hidden-phone">Montant</th>
                                <th class="center hidden-phone">Date</th>
                                <th class="center hidden-phone">Observation</th>
                                <th class="center hidden-phone">Action</th>
                            </tr>
                            </thead>
                            <tbody class="center hidden-phone">


                            </tbody>
                        </table>
                    </div>
            </div>
        </section>
    </div>
    </section>
    </div>

    <div class="modal fade" id="detailClient" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#0b97c4;border-top-left-radius: inherit;border-top-right-radius: inherit">
                    <b>	<h4 class="modal-title" id="modal-user-title" align="center" style="color: white" ></h4></b>

                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        <li class="list-group-item">Identifiant:<b> <span class="text-danger" id="sId"></span> </b></li>
                        <li class="list-group-item">Montant :<b> <span class="text-danger" id="sNom"></span> </b></li>
                        <li class="list-group-item">Fournisseur :<b> <span class="text-danger" id="sPrenom"></span> </b></li>
                        <li class="list-group-item">Type :<b> <span class="text-danger " id="sEmail" ></span></b></li>
                        <li class="list-group-item">Observation :<b> <span class="text-danger " id="sContact" ></span></b></li>

                        <li class="list-group-item">
                            crée le :<b> <span class="text-danger" id="sCreate"></span></b> </li>

                        <li class="list-group-item">
                            mise a jour le :<b> <span class="text-danger" id="sUpdate"></span></b> </li>
                    </ul>



                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Fermer</button>
                    </div>
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
    <script src="public/js/recette.js"></script>

@endsection
