@extends('layout')
@section('css')
    <link rel="stylesheet" href="octopus/assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />
@endsection
@section('contenu')
    <div class="inner-wrapper">
        <section role="main" class="content-body">
            <header class="page-header">
                <h2>Detail commande</h2>
            </header>

            <div class="row">
                <section class="panel">
                    <header class="panel-heading">
                        <div class="panel-actions">
                            <a href="#" class="fa fa-caret-down"></a>
                        </div>

                        <h1 class="panel-title">LISTES DES  PRODUITS DE LA  COMMANDE  :     N* {{$commande[0]->numero}}  </h1>
                    </header>

                    <div class="panel-body">
                        <div class="row" " >
                        <ul class="list-group">
                            <li class="list-group-item">Commande N*:<b> <span class="text-danger" id="sId"> {{$commande[0]->numero}}</span> </b></li>
                            <li class="list-group-item">Date de commande :<b> <span class="text-danger" id="sNom">{{$commande[0]->date}}</span> </b></li>
                        </ul>


                    </div>
                        <table class="table table-bordered table-striped mb-none" id="afficheTable" data-swf-path="octopus/assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf" >
                            <thead>
                            <tr>

                                <th class="center hidden-phone">Produit</th>
                                <th class="center hidden-phone">Quantite</th>
                                <th class="center hidden-phone">Prix unitaire</th>
                                <th class="center hidden-phone">Prix total</th>
                            </tr>
                            </thead>
                            <tbody class="center hidden-phone">

                            @foreach($commande as $com)

                                <tr class="gradeA">
                                    <td class="center hidden-phone">{{$com->produit}} - {{$com->modele}}  </td>
                                    <td class="center hidden-phone">{{$com->quantite}}</td>
                                    <td class="center hidden-phone">{{$com->prix}} fcfa</td>
                                    <td class="center hidden-phone">{{$com->prix*$com->quantite}}  fcfa</td>


                                </tr>

                            @endforeach

                            </tbody>
                        </table>
                    </div>
            <a class=" btn btn-default mb-xs mt-xs mr-xs btn btn-danger"  href="javascript:history.go(-1)"><i class="fa  fa-times"></i>Fermé</a>

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
@endsection
