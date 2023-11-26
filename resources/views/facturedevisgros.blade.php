@extends('layoutimprimer')
@section('contenu')
    <body onload="window.print(); fermer()">
    <div class="wrapper">
        <!-- Main content -->
        <section class="invoice">

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
                <div class="col-sm-4 invoice-col">
                    <h6><strong>INFORMATIONS DU CLIENT</strong></h6>
                    <address>
                        <b> Nom : <span class="text-danger" >{{$client->nom}}</span> </b><br>
                        <b>Contact : <span class="text-danger" >{{$client->contact}}</span> </b><br>
                        <b>Adresse : <span class="text-danger" >{{$client->adresse}}</span> </b><br>
                    </address>
                </div>
                <!-- /.col -->
                {{-- <div class="col-sm-4 invoice-col">
                    <address>
                        <strong></strong>
                    </address>
                </div> --}}
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <h6><strong>INFORMATIONS DU DEVIS</strong></h6>
                    <address>
                        <b>Devis N*: <span class="text-danger" >{{$devis->numero}}</span> </b><br>
                        <b>Date du devis : <span class="text-danger" >{{$devis->date_devis}}</span> </b><br>
                        <b>Montant total : <span class="text-danger prix" >{{ $devis->totaux }} FCFA</span> </b><br>
                    </address>
                </div>
                <!-- /.col -->


                <!-- /.col -->
            </div>


            <h5 align="center"><strong>LISTE DES PRODUITS DU DEVIS DE VENTE EN GROS</strong></h5>
            <br>
            <!-- Table row -->

            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-bordered table-striped mb-none" id="afficheTable" data-swf-path="octopus/assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf" >
                        <thead>
                        <tr>
                            <th class="center hidden-phone">Désignation</th>
                            <th class="center hidden-phone">Prix unitaire (de gros)</th>
                            <th class="center hidden-phone">Quantité </th>
                            <th class="center hidden-phone">Réduction </th>
                            <th class="center hidden-phone">Prix total </th>
                        </tr>
                        </thead>
                        <tbody class="center hidden-phone">

                        @foreach($devislignes as $devisligne)

                            <tr class="gradeA">
                                <td class="center hidden-phone">{{$devisligne->produit}} - {{$devisligne->modele}}  </td>
                                <td class="center hidden-phone prix-n">{{$devisligne->prix}}</td>
                                <td class="center hidden-phone">{{$devisligne->quantite}}</td>
                                <td class="center hidden-phone">{{$devisligne->reduction}} FCFA</td>
                                <td class="center hidden-phone prix">{{$devisligne->prixtotal}} FCFA</td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                    <center><li class="list-group-item center hidden-phone" >Montant réduction :<b> <span class="prix">{{$devis->montant_reduction}} FCFA</span></b></li></center>
                    @if (!$devis->with_tva)
                    <center><li class="list-group-item center hidden-phone" >Montant total :<b> <span class="text-danger prix"  id="prixTotal">{{$devis->totaux}} FCFA</span></b></li></center>
                    @endif
                </div>
                @if ($devis->with_tva)
                <div>
                    <table class="table" style="width: 45%; position: absolute; right: -10px;">
                        <tr>
                            <td style="border-top-style:none;">TVA</td>
                            <td class="text-center" style="border-top-style:none;">{{ $devis->tva }} %</td>
                        </tr>
                        <tr>
                            <td>Montant TVA</td>
                            <td class="text-center">{{ $devis->montant_tva }}</td>
                        </tr>
                        <tr>
                            <td>Montant HT</td>
                            <td class="text-center">{{ $devis->montant_ht }}</td>
                        </tr>
                        <tr>
                            <td>Montant TTC</td>
                            <td class="text-center">{{ $devis->totaux }} FCFA</td>
                        </tr>
                    </table>
                </div>
                @endif
            </div>
    </div>
    </body>
@endsection
@section('js')
<script>

    function setNumeralHtml(element, format, surfix="")
    {
        var prices = $("."+element);

        for(var i=0; i<prices.length; i++)
        {
            var number = numeral(prices[i].innerText);

            var string = number.format(format);
            prices[i].innerText = string+" "+surfix;
        }

    }

    setNumeralHtml("prix", "0,0", "FCFA");
    setNumeralHtml("prix-n", "0,0");
</script>
@endsection
