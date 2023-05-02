@extends('layout')
@section('css')
<link rel="stylesheet" type="text/css" href="/public/DataTables/datatables.min.css"/>
<script type="text/javascript" src="/public/DataTables/datatables.min.js"></script>
@endsection
@section('contenu')
           <div class="inner-wrapper">
        <section role="main" class="content-body">
            <header class="page-header">
                <h2>Inventaire</h2>
            </header>
            <div class="modal fade " id="inventaire" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                        <div class="modal-header " style="background-color: #0b93d5;border-top-left-radius: inherit;border-top-right-radius: inherit">
                            <h4 class="modal-title-user" id="myModalLabel" style="color: white"></h4>
                        </div>
                        <div class="modal-body">
                            <form id="form" action="" method="POST" class="	form-validate form-horizontal mb-lg" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group mt-lg">
                                    <label class="col-sm-3 control-label">Quantité </label>
                                    <div class="col-sm-9">
                                        <input type="number" name="quantite" id="quantite" class="form-control" placeholder="100"  min="0" required/>
                                        <input type="hidden" name="id" id="id"/>

                                    </div>
                                </div>
                                <div class="form-group mt-lg">
                                    <label class="col-sm-3 control-label">Quantité réelle</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="quantiteR" id="quantiteR" class="form-control" placeholder="100"  min="0" required/>
                                    </div>
                                </div>
                                <div class="form-group mt-lg">
                                    <label class="col-sm-3 control-label">Justificatif</label>
                                    <div class="col-sm-9">
                                        <textarea name="justify" id="justify" cols="30" rows="5" class="form-control"></textarea>
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
            <div class="row"  id="inventaire">
                <input type="hidden" name="cat_id" id="cat_id" value="{{ $data->categorie_id }}">
                <input type="hidden" name="_id" id="_id" value="{{ $data->id }}">

                <section class="panel">
                    <header class="panel-heading">
                        <div class="panel-actions">
                            <a href="#" class="fa fa-caret-down"></a>
                        </div>

                        <h1 class="panel-title">LISTES DES  MODELES</h1>
                    </header>

                    <div class="panel-body">
                        <table class="table table-bordered table-striped mb-none" id="inventaireTable" data-swf-path="octopus/assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
                            <thead>
                            <tr>
                                <th class="center hidden-phone">Catégorie</th>
                                <th class="center hidden-phone">Produit</th>
                                <th class="center hidden-phone">Modele</th>
                                <th class="center hidden-phone">Quantité </th>
                                <th  class="center hidden-phone">Action</th>
                            </tr>
                            </thead>
                            <tbody class="center hidden-phone">


                            </tbody>
                        </table>
                    </div>
                    <div class="form-group mt-lg">
                        <label class="col-sm-3 control-label">Observation </label>
                        <div class="col-sm-9">
                            <textarea name="obs" id="obs" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                </section>

            </div>

            <a class=" btn btn-default mb-xs mt-xs mr-xs btn btn-danger" id="fermer" ><i class="fa "></i>Valider</a>
        </section>
    </div>
@endsection
@section('js')

    <script src="/octopus/assets/vendor/jquery/jquery.js"></script>
    <script src="/octopus/assets/vendor/bootstrap/js/bootstrap.js"></script>
    <script src="/octopus/assets/vendor/nanoscroller/nanoscroller.js"></script>
    <script src="/octopus/assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
    <script src="/octopus/assets/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js"></script>
    <script src="/octopus/assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>
    <script src="/js/newinventaire.js"></script>

@endsection
