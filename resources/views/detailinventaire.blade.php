@extends('layout')
@section('css')
    <link rel="stylesheet" href="octopus/assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />
@endsection
@section('contenu')
    <div class="inner-wrapper">
        <section role="main" class="content-body">
            <header class="page-header">
                <h2>Detail inventaire</h2>
            </header>
            <div class="row">
                <section class="panel">
                    <header class="panel-heading">
                        <div class="panel-actions">
                            <a href="#" class="fa fa-caret-down"></a>
                        </div>

                        <h1 class="panel-title">LISTES DES  PRODUITS DE L'INVENTAIRE    :     N*  {{$inventaire[0]->numero}}</h1>
                    </header>


                    <div class="panel-body">
                        <div class="row">
                        <ul class="list-group">
                            <li class="list-group-item">Inventaire N*:<b> <span class="text-danger" >{{$inventaire[0]->numero}}</span> </b></li>
                            <li class="list-group-item">Date de l'inventaire :<b> <span class="text-danger" >{{$inventaire[0]->date}}</span> </b></li>
                            <li class="list-group-item">Utilisateur :<b> <span class="text-danger" >{{$inventaire[0]->utilisateur}} - {{$inventaire[0]->prenom}}</span> </b></li>
                            @if ($inventaire[0] && $inventaire[0]->observation)
                            <li class="list-group-item">Observation :<b> <span class="text-danger" >{{$inventaire[0]->observation}}</span> </b></li>
                            @endif
                        </ul>


                        </div>
                        <table class="table table-bordered table-striped mb-none" id="afficheTable" data-swf-path="octopus/assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf" >
                            <thead>
                            <tr>
                                <th class="center hidden-phone">Catégorie</th>
                                <th class="center hidden-phone">Produit</th>
                                <th class="center hidden-phone">Quantité </th>
                                <th class="center hidden-phone">Quantité réelle </th>
                                <th class="center hidden-phone"> Justification </th>
                            </tr>
                            </thead>
                            <tbody class="center hidden-phone">

                            @foreach($inventaire as $ven)

                                <tr class="gradeA">
                                    <td class="center hidden-phone">{{$ven->categorie}} </td>
                                    <td class="center hidden-phone">{{$ven->produit}} - {{$ven->modele}}  </td>
                                    <td class="center hidden-phone">{{$ven->quantite}}</td>
                                    <td class="center hidden-phone">{{$ven->quantiteR}}</td>
                                    <td class="center hidden-phone">{{$ven->justify ? $ven->justify : '---' }}</td>
                                </tr>

                            @endforeach

                            </tbody>
                        </table>
                        <a class=" btn btn-default mb-xs mt-xs mr-xs btn btn-danger"  href="{{route('inventaire')}}"><i class="fa  fa-times"></i>Fermé</a>
                        <a class=" btn btn-default mb-xs mt-xs mr-xs btn btn-warning"  href="/inventaires/pending/{{ $inventaire[0]->pdf }}"><i class="fa  fa-print"></i>{{ '  ' }}Non Validé</a>
                        <a class=" btn btn-default mb-xs mt-xs mr-xs btn btn-success"  href="/detailinventaireprint-{{ $inventaire[0]->inventaire_id }}"><i class="fa  fa-print"></i>{{ '  ' }}Validé</a>
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
@endsection
