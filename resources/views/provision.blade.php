@extends('layout')
@section('css')
    <link rel="stylesheet" href="public/octopus/assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />
@endsection
@section('contenu')
    <div class="inner-wrapper">
        <section role="main" class="content-body">
            <header class="page-header">
                <h2>Commande</h2>
            </header>

            <div class="row">
                <section class="panel">
                    <header class="panel-heading">
                        <div class="panel-actions">
                            <a href="#" class="fa fa-caret-down"></a>
                        </div>

                        <h1 class="panel-title">LISTES DES  COMMANDES</h1>
                    </header>

                    <div class="panel-body">
                        @if (Auth::user()->boutique->settings->where('tag', 'commande_direct')->first() && Auth::user()->boutique->settings->where('tag', 'commande_direct')->first()->pivot->is_active)
                        <a class="btn btn-default mb-xs mt-xs mr-xs btn btn-default" id="btncommandedirecte" ><i class="fa fa-plus"></i>Ajouter une commande directe</a>
                        @endif
                        @if (Auth::user()->boutique->settings->where('tag', 'commande_indirect')->first() && Auth::user()->boutique->settings->where('tag', 'commande_indirect')->first()->pivot->is_active)
                        <a class="btn btn-default mb-xs mt-xs mr-xs btn btn-primary" id="btncommandeindirecte"><i class="fa fa-plus"></i>Ajouter une commande non livrée</a>
                        @endif
                        <a class="btn btn-default mb-xs mt-xs mr-xs btn btn-success" id="btnhistorique"><i class="fa fa-file-text"></i>Historiques</a>
                        <a class="btn btn-default mb-xs mt-xs mr-xs btn btn-danger" id ="btnjournalachat"><i class="fa fa-file-text"></i>Fermer le journal</a>
                        <table class="table table-bordered table-striped mb-none" id="provisionTable" data-swf-path="public/octopus/assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
                            <thead>
                            <tr>
                                <th class="center hidden-phone">Numero</th>
                                <th class="center hidden-phone">Date de commande</th>
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

    <div class="modal fade" id="detailprovision" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#0b97c4;border-top-left-radius: inherit;border-top-right-radius: inherit">
                    <b>	<h4 class="modal-title" id="modal-user-title" align="center" style="color: white" ></h4></b>

                </div>
                <div class="modal-body">




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
    <script src="public/js/commande.js"></script>

@endsection
