@extends('layout')
@section('css')
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>
<script>
    import Scala from "../../public/octopus/assets/vendor/codemirror/mode/clike/scala.html";
    export default {
        components: {Scala}
    }
</script>
@endsection
@section('contenu')
    <div class="inner-wrapper">
        <section role="main" class="content-body">
            <header class="page-header">
                <h2>Regularisation de l'inventaire</h2>
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

                        <h1 class="panel-title">Régularisation</h1>
                    </header>

                    <div class="panel-body">
                        <table class="table table-bordered table-striped mb-none" id="regulatedTable" data-swf-path="octopus/assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
                            <thead>
                            <tr>
                                <th class="center hidden-phone">N°</th>
                                <th class="center hidden-phone">Code Inventaire</th>
                                <th class="center hidden-phone">Nom et prénom</th>
                                <th class="center hidden-phone">Montant à rembourser</th>
                                <th class="center hidden-phone">Montant déja rembourser</th>
                                <th class="center hidden-phone">Restant à rembourser.</th>
                                <th  class="center hidden-phone">Action</th>
                            </tr>
                            </thead>
                            <tbody class="center hidden-phone">


                            </tbody>
                        </table>
                    </div>

                </section>

            </div>

            <a class=" btn btn-default mb-xs mt-xs mr-xs btn btn-danger" id="fermerRegulated" ><i class="fa "></i>Valider</a>
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

<script type="application/javascript">
    // load the data into the table.
    var regulatedTable ;
    // Load data into non regulated inventaire.
    $(function () {

        inventaireTableRegularisation =   $('#inventaireTableRegularisation').DataTable({
            processing: true,
            serverSide: true,
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': true,
            language: {
                "sProcessing": "Traitement en cours...",
                "sSearch": "Rechercher&nbsp;:",
                "sLengthMenu": "Afficher _MENU_ &eacute;l&eacute;ments",
                "sInfo": "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                "sInfoEmpty": "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
                "sInfoFiltered": "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                "sInfoPostFix": "",
                "sLoadingRecords": "Chargement en cours...",
                "sZeroRecords": "Aucun &eacute;l&eacute;ment &agrave; afficher",
                "sEmptyTable": "Aucune donn&eacute;e disponible dans le tableau",
                "oPaginate": {
                    "sFirst": "Premier",
                    "sPrevious": "Pr&eacute;c&eacute;dent",
                    "sNext": "Suivant",
                    "sLast": "Dernier"
                },
                "oAria": {
                    "sSortAscending": ": activer pour trier la colonne par ordre croissant",
                    "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
                },
                "select": {
                    "rows": {
                        _: "%d lignes séléctionnées",
                        0: "Aucune ligne séléctionnée",
                        1: "1 ligne séléctionnée"
                    }
                }
            },
            "order": [[ 0, "desc" ]],
            ajax: '/inventaire_non_regulated',
            "columns": [

                {data: "numero",name : 'numero'},
                {data: "date_inventaire",name : 'date'},
                {data: "nom",name : 'nom'},
                {data: "action", name : 'action' , orderable: false, searchable: false}
            ]

        });
    });


</script>
@endsection
