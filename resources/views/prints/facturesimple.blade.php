@extends('layoutimprimer')
@section('contenu')
    <body onload="window.print(); fermer()">
    <div class="wrapper">
        <!-- Main content -->
        <section class="invoice">
            <!-- title row -->
            <div class="row">
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">

                    <address>
                        <b> {{Auth::user()->boutique->nom}}</b><br>
                        Adresse: {{Auth::user()->boutique->adresse}}<br>
                        Telephone:  {{Auth::user()->boutique->telephone}}
                    </address>
                </div>
            </div>
            <!-- /.row -->

            <div class="row invoice-info">
                {{-- <div class="col-sm-4 invoice-col">
                    <h6><strong>INFORMATIONS DU CLIENT</strong></h6>
                    <address>
                        <b> Nom : <span class="text-danger" ></span> </b><br>
                        <b>Prenoms : <span class="text-danger" > </span> </b><br>
                        <b>Contact : <span class="text-danger" ></span> </b><br>
                    </address>
                </div> --}}
                <!-- /.col -->
                {{-- <div class="col-sm-4 invoice-col">
                    <address>
                        <strong></strong>
                    </address>
                </div> --}}
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <h6><strong>INFORMATIONS DE LA VENTE</strong></h6>
                    <address>
                        <b>Vente N*: <span class="text-danger" >{{$vente[0]->numero}}</span> </b><br>
                        <b>Date de vente : <span class="text-danger" >{{$vente[0]->date}}</span> </b><br>
                        <b>Montant total : <span class="text-danger" >{{$total}} fcfa</span> </b><br>
                    </address>
                </div>
                <!-- /.col -->


                <!-- /.col -->
            </div>


            <h5 align="center"><strong>LISTE DES PRODUITS DE LA VENTE</strong></h5>
            <br>
            <!-- Table row -->

            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-bordered table-striped mb-none" id="afficheTable" data-swf-path="octopus/assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf" >
                        <thead>
                        <tr>
                            <th class="center hidden-phone">Produit</th>
                            <th class="center hidden-phone">Prix </th>
                            <th class="center hidden-phone">Quantité </th>
                            <th class="center hidden-phone">Prix total </th>
                        </tr>
                        </thead>
                        <tbody class="center hidden-phone">

                        @foreach($vente as $ven)

                            <tr class="gradeA">
                                <td class="center hidden-phone">{{$ven->produit}} - {{$ven->modele}}  </td>
                                <td class="center hidden-phone">{{$ven->prix}} fcfa</td>
                                <td class="center hidden-phone">{{$ven->quantite}}</td>
                                <td class="center hidden-phone">{{$ven->prixtotal}} fcfa</td>
                            </tr>

                        @endforeach

                        </tbody>
                    </table>
                    <li class="list-group-item center hidden-phone" >Montant total :<b> <span class="text-danger "  >{{$total}} fcfa</span></b></li>
                </div>
            </div>
    </div>
    </body>
@endsection
@section('js')

    <script src="octopus/assets/vendor/jquery/jquery.js"></script>
    <script src="octopus/assets/vendor/bootstrap/js/bootstrap.js"></script>
    <script src="octopus/assets/vendor/nanoscroller/nanoscroller.js"></script>
    <script src="octopus/assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
    <script src="octopus/assets/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js"></script>
    <script src="octopus/assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>
    <script src="js/facture.js"></script>

@endsection
