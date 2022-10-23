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
            <table class="table borderless mb-none" >
                <tr>
                    <td class="text-center">
                        <h6><strong>INFORMATIONS DU CLIENT</strong></h6>
                        <address>
                            <b> Nom : <span class="text-danger" >{{$vente[0]->nom}} </span> </b><br>
                            @if (isset($vente[0]->prenom))
                            <b>Prenoms : <span class="text-danger" >{{$vente[0]->prenom}} </span> </b><br>
                            @endif
                            @if (isset($vente[0]->prenom))
                            <b>Contact : <span class="text-danger" >{{$vente[0]->contact}}</span> </b><br>
                            @endif
                            <b>Montant restant : <span class="text-danger prix" >{{$vente[0]->restant}} FCFA</span> </b>
                        </address>
                    </td>
                    <td class="text-center">
                        <h6><strong>INFORMATIONS DE LA VENTE</strong></h6>
                        <address>
                            <b>Vente N*: <span class="text-danger" >{{$vente[0]->numero}}</span> </b><br>
                            <b>Date de vente : <span class="text-danger" >{{$vente[0]->date}}</span> </b><br>
                            <b>Montant total : <span class="text-danger prix" >{{ $all_vente->totaux }} FCFA</span> </b><br>
                            <b>Montant recu : <span class="text-danger prix" >{{$vente[0]->donne}} FCFA</span> </b>
                        </address>
                    </td>

                </tr>
            </table>

            {{-- <div class="row invoice-info">

                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 ">
                    <h6><strong>INFORMATIONS DU CLIENT</strong></h6>
                    <address>
                        <b> Nom : <span class="text-danger" >{{$vente[0]->nom}} </span> </b><br>
                        <b>Prenoms : <span class="text-danger" >{{$vente[0]->prenom}} </span> </b><br>
                        <b>Contact : <span class="text-danger" >{{$vente[0]->contact}}</span> </b><br>
                        <b>Montant restant : <span class="text-danger" >{{$vente[0]->restant}} fcfa</span> </b>
                    </address>
                </div>


                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <h6><strong>INFORMATIONS DE LA VENTE</strong></h6>
                    <address>
                        <b>Vente N*: <span class="text-danger" >{{$vente[0]->numero}}</span> </b><br>
                        <b>Date de vente : <span class="text-danger" >{{$vente[0]->date}}</span> </b><br>
                        <b>Montant total : <span class="text-danger" >{{$total}} fcfa</span> </b><br>
                        <b>Montant recu : <span class="text-danger" >{{$vente[0]->donne}} fcfa</span> </b>
                    </address>
                </div>

            </div> --}}




            <h5 align="center"><strong>LISTE DES PRODUITS DE LA VENTE EN GROS</strong></h5>
            <br>
            <!-- Table row -->

            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-bordered table-striped mb-none" id="afficheTable" data-swf-path="octopus/assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf" >
                        <thead>
                        <tr>
                            <th class="center hidden-phone">Désignation</th>
                            <th class="center hidden-phone">Prix unitaire (de gros) </th>
                            <th class="center hidden-phone">Quantité </th>
                            <th class="center hidden-phone">Réduction </th>
                            <th class="center hidden-phone">Prix total </th>
                        </tr>
                        </thead>
                        <tbody class="center hidden-phone">

                        @foreach($vente as $ven)

                            <tr class="gradeA">
                                <td class="center hidden-phone">{{$ven->produit}} - {{$ven->modele}}  </td>
                                <td class="center hidden-phone prix-n">{{$ven->prix}}</td>
                                <td class="center hidden-phone">{{$ven->quantite}}</td>
                                <td class="center hidden-phone">{{$ven->reduction}}</td>
                                <td class="center hidden-phone prix">{{$ven->prixtotal}} FCFA</td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    <center><li class="list-group-item center hidden-phone" >Montant réduction :<b> <span class="prix">{{$all_vente->montant_reduction}} FCFA</span></b></li></center>
                    @if (!$all_vente->with_tva)
                    <center><li class="list-group-item center hidden-phone" >Montant total :<b> <span class="text-danger prix"  >{{$total}} FCFA</span></b></li></center>
                    @endif
                </div>

                @if ($all_vente->with_tva)
                <div>
                    <table class="table" style="width: 45%; position: absolute; right: -10px;">
                        <tr>
                            <td style="border-top-style:none;">TVA</td>
                            <td class="text-center" style="border-top-style:none;">{{ $all_vente->tva }} %</td>
                        </tr>
                        <tr>
                            <td>Montant TVA</td>
                            <td class="text-center">{{ $all_vente->montant_tva }}</td>
                        </tr>
                        <tr>
                            <td>Montant HT</td>
                            <td class="text-center">{{ $all_vente->montant_ht }}</td>
                        </tr>
                        <tr>
                            <td>Montant TTC</td>
                            <td class="text-center">{{ $all_vente->totaux }} FCFA</td>
                        </tr>
                    </table>
                </div>
                @endif
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
