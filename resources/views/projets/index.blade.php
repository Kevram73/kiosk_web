@extends('layout')
@section('css')
    <link rel="stylesheet" href="octopus/assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css"/>
@endsection
@section('contenu')
    <div class="inner-wrapper">
        <section role="main" class="content-body">
            <header class="page-header">
                <h2>Projets</h2>
            </header>

            <div class="row">
                <section class="panel">
                    <header class="panel-heading">
                        <div class="panel-actions">
                            <a href="#" class="fa fa-caret-down"></a>
                        </div>

                        <h1 class="panel-title">LISTES DES PROJETS</h1>
                    </header>

                    <div class="panel-body">
                        <a class="modal-with-form btn btn-default mb-xs mt-xs mr-xs btn btn-default" id="btncharge"><i class="fa fa-plus"></i>Ajouter un projet</a>
                        <!-- <a class="btn btn-default mb-xs mt-xs mr-xs btn btn-success" id="btnhistorique"><i class="fa fa-file-text"></i>Historiques</a>
                        <a class="btn btn-default mb-xs mt-xs mr-xs btn btn-danger" id ="btnjournal"><i class="fa fa-file-text"></i>Fermer le journal</a> -->
                        <div class="modal fade " id="ajout_charge" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">

                                    <div class="modal-header " style="background-color: #0b93d5;border-top-left-radius: inherit;border-top-right-radius: inherit">
                                        <h4 class="modal-title-user" id="myModalLabel" style="color: white"></h4>
                                    </div>
                                    <div class="modal-body">
                                        <form id="form" action="" method="POST" class="	form-validate form-horizontal mb-lg" enctype="multipart/form-data">
                                            {{csrf_field()}}
                                            <div  class="form-group mt-lg">
                                                <label class="col-sm-3 control-label">Nom du projet *</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="name"  id="name" class="form-control" placeholder="nom du projet..." required/>
                                                    <input type="hidden" name="idcharge" id="idcharge"/>
                                                </div>
                                            </div>
                                            <div class="form-group mt-lg">
                                                <label class="col-sm-3 control-label">Date de debut *</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="debut"  id="debut" class="form-control date" required/>
                                                </div>
                                            </div>
                                            <div class="form-group mt-lg">
                                                <label class="col-sm-3 control-label">Date de fin (prévu)</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="fin" id="fin" class="form-control date" />
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
                        <table class="table table-bordered table-striped mb-none" id="chargeTable" data-swf-path="octopus/assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
                            <thead>
                            <tr>
                                <th class="center hidden-phone">Nom du Projet</th>
                                <th class="center hidden-phone">Date Début</th>
                                <th class="center hidden-phone">Date Fin</th>
                                <th class="center hidden-phone">Action </th>
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


@endsection
@section('js')

    <script src="octopus/assets/vendor/jquery/jquery.js"></script>
    <script src="octopus/assets/vendor/bootstrap/js/bootstrap.js"></script>
    <script src="octopus/assets/vendor/nanoscroller/nanoscroller.js"></script>
    <script src="octopus/assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
    <script src="octopus/assets/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js"></script>
    <script src="octopus/assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>
    <script type="text/javascript" src="vendor/daterangepicker/moment.min.js"></script>
    <script type="text/javascript" src="vendor/daterangepicker/daterangepicker.js"></script>
    <script>
        $(function() {
            $('.date').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 1901,
                maxYear: parseInt(moment().format('YYYY'),10)
            }, function(start, end, label) {
                var years = moment().diff(start, 'years');
            });
        });
    </script>
    <script src="public/js/projet.js"></script>

@endsection
