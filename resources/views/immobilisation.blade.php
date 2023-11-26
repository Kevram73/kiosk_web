@extends('layout')
@section('css')
    <link rel="stylesheet" href="octopus/assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />
@endsection
@section('contenu')
    <div class="inner-wrapper">
        <section role="main" class="content-body">
            <header class="page-header">
                <h2>Immobilisation</h2>
            </header>

            <div class="row">
                <section class="panel">
                    <header class="panel-heading">
                        <div class="panel-actions">
                            <a href="#" class="fa fa-caret-down"></a>
                        </div>

                        <h1 class="panel-title">LISTES DES  IMMOBILISATIONS</h1>
                    </header>

                    <div class="panel-body">
                        <a class="modal-with-form btn btn-default mb-xs mt-xs mr-xs btn btn-default" id="btnimmo" ><i class="fa fa-plus"></i>Ajouter un article</a>
                        <div class="modal fade " id="ajout_immo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">

                                    <div class="modal-header " style="background-color: #0b93d5;border-top-left-radius: inherit;border-top-right-radius: inherit">
                                        <h4 class="modal-title-user" id="myModalLabel" style="color: white"></h4>
                                    </div>
                                    <div class="modal-body">
                                        <form id="form" action="" method="POST" class="	form-validate form-horizontal mb-lg" enctype="multipart/form-data">
                                            {{csrf_field()}}
                                            <div class="form-group mt-lg">
                                                <label class="col-sm-3 control-label">Libelle</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="libelle"  id="libelle" class="form-control" placeholder="LJ" required/>
                                                    <input type="hidden" name="idimmo" id="idimmo"/>
                                                </div>
                                            </div>
                                            <div class="form-group mt-lg">
                                                <label class="col-sm-3 control-label">Montant</label>
                                                <div class="col-sm-9">
                                                    <input type="number" name="montant" id="montant" class="form-control" placeholder="100000" min="0" required/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Date d'acquisition</label>
                                                <div class="col-sm-9">
                                                    <input type="date" name="dateacqui" id="dateacqui" class="form-control"  required/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Type d'immobilisation</label>
                                                <div class="col-md-9">
                                                    <select  name="type" id="type" class="form-control populate">
                                                        <optgroup label="Choisir un type">
                                                            @foreach($amortissement as $amor)
                                                                <option value="{{$amor->id}}">{{$amor->libelle}}</option>
                                                            @endforeach
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="col-md-12 text-right">
                                                    <button type="submit" class="btn btn-primary" id="btnadd"><i class="fa fa-check"></i> Valider</button>
                                                    <button type="button" class="mb-xs mt-xs mr-xs btn btn-default  " data-dismiss="modal"><i class="fa fa-times"></i> Annuler</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped mb-none" id="immoTable" data-swf-path="octopus/assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
                            <thead>
                            <tr>
                                <th class="center hidden-phone">Libelle</th>
                                <th class="center hidden-phone">Montant</th>
                                <th class="center hidden-phone">Date d'acquisition</th>
                                <th class="center hidden-phone">Type d'immobilisation</th>
                                <th class="center hidden-phone">Action</th>
                            </tr>
                            </thead>
                            <tbody class="center hidden-phone">


                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </section>
    </div>
    <div class="modal fade" id="detailimmo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#0b97c4;border-top-left-radius: inherit;border-top-right-radius: inherit">
                    <b>	<h4 class="modal-title" id="modal-user-title" align="center" style="color: white" ></h4></b>

                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        <li class="list-group-item">Libellé :<b> <span class="text-danger" id="sLibelle"></span> </b></li>
                        <li class="list-group-item">Montant d'acquisition :<b> <span class="text-danger" id="sMontant"></span>fcfa </b></li>
                        <li class="list-group-item">Type d'immobilisation :<b> <span class="text-danger " id="sType" ></span></b></li>
                        <li class="list-group-item">Taux d'amortissement :<b> <span class="text-danger " id="sTaux" ></span>%</b></li>
                        <li class="list-group-item">Durée de vie totale:<b> <span class="text-danger " id="sDuree" ></span> ans</b></li>
                        <li class="list-group-item">Date d'acquisition :<b> <span class="text-danger " id="sDate" ></span></b></li>
                        <li class="list-group-item">Date d'expiration :<b> <span class="text-danger " id="sExpire" ></span></b></li>

                        <li class="list-group-item">
                            Enrgistré le :<b> <span class="text-danger" id="sCreate"></span></b> </li>

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

    <script src="octopus/assets/vendor/jquery/jquery.js"></script>
    <script src="octopus/assets/vendor/bootstrap/js/bootstrap.js"></script>
    <script src="octopus/assets/vendor/nanoscroller/nanoscroller.js"></script>
    <script src="octopus/assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
    <script src="octopus/assets/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js"></script>
    <script src="octopus/assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>
    <script src="js/immobilisation.js"></script>

@endsection
