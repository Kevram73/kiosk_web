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
            @if (isset($client))
                <table class="table borderless mb-none" >
                    <tr>
                        <td class="text-center">
                            <h6><strong>INFORMATIONS DU CLIENT</strong></h6>
                            <address>
                                <b>Nom : <span class="text-danger" >{{$client->nom}} </span> </b><br>
                                @if (isset($client->contact))
                                <b>Contact : <span class="text-danger" >{{$client->contact}}</span> </b><br>
                                @endif
                                @if (isset($client->adresse))
                                <b>Adresse : <span class="text-danger" >{{$client->adresse}}</span> </b><br>
                                @endif
                                {{-- <b>Montant restant : <span class="text-danger prix" >{{$vente[0]->restant}} FCFA</span> </b> --}}
                            </address>
                        </td>

                        <td class="text-center">
                            <h6><strong>INFORMATIONS DE LA VENTE</strong></h6>
                            <address>
                                <b>Vente N*: <span class="text-danger" >{{$vente->numero}}</span> </b><br>
                                <b>Date de vente : <span class="text-danger" >{{$vente->date_vente}}</span> </b><br>
                                <b>Montant total : <span class="text-danger prix" >{{ isset($tva) ? $tva['montant_ttc'] : $total }} FCFA</span> </b><br>
                                {{-- <b>Montant recu : <span class="text-danger prix" >{{$vente[0]->donne}} FCFA</span> </b> --}}
                            </address>
                        </td>

                    </tr>
                </table>
            @else
                <div class="row invoice-info">
                    {{-- <div class="col-sm-4 invoice-col">
                        <h6><strong>INFORMATIONS DU CLIENT</strong></h6>
                        <address>
                            <b> Nom : <span class="text-danger" ></span> </b><br>
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
                            <b>Vente N*: <span class="text-danger" >{{$vente->numero}}</span> </b><br>
                            <b>Date de vente : <span class="text-danger" >{{$vente->date_vente}}</span> </b><br>
                            <b>Montant total : <span class="text-danger prix" >{{ isset($tva) ? $tva['montant_ttc'] : $total }} FCFA</span> </b><br>
                        </address>
                    </div>
                    <!-- /.col -->


                    <!-- /.col -->
                </div>

            @endif


            {{-- <div class="row invoice-info">

                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 ">
                    <h6><strong>INFORMATIONS DU CLIENT</strong></h6>
                    <address>
                        <b> Nom : <span class="text-danger" >{{$vente[0]->nom}} </span> </b><br>
                        <b>Contact : <span class="text-danger" >{{$vente[0]->contact}}</span> </b><br>
                        <b>Adresse : <span class="text-danger" >{{$vente[0]->adresse}}</span> </b><br>
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




            <h5 align="center"><strong>LISTE DES PRODUITS DE LA VENTE</strong></h5>
            <br>
            <!-- Table row -->

            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-bordered table-striped mb-none" id="afficheTable" data-swf-path="octopus/assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf" >
                        <thead>
                        <tr>
                            <th class="center hidden-phone">Désignation</th>
                            <th class="center hidden-phone">Prix unitaire </th>
                            <th class="center hidden-phone">Quantité </th>
                            <th class="center hidden-phone">Prix total </th>
                        </tr>
                        </thead>
                        <tbody class="center hidden-phone">

                        @for ($i = 0; $i<count($modeles); $i++)
                        <tr class="gradeA">
                            <td class="center hidden-phone">{{$modeles[$i]->nom}} - {{$modeles[$i]->libelle}}  </td>
                            <td class="center hidden-phone prix-n">{{$lignes[$i]['prix']}}</td>
                            <td class="center hidden-phone">{{$lignes[$i]['quantite']}}</td>
                            <td class="center hidden-phone prix">{{$lignes[$i]['prixtotal']}} FCFA</td>
                        </tr>
                        @endfor

                        </tbody>
                    </table>
                    @if (!isset($tva))
                    <center><li class="list-group-item center hidden-phone" >Montant total :<b> <span class="text-danger prix"  >{{$total}} FCFA</span></b></li></center>
                    @endif
                </div>

                @if (isset($tva))
                <div>
                    <table class="table" style="width: 45%; position: absolute; right: -10px;">
                        <tr>
                            <td style="border-top-style:none;">TVA</td>
                            <td class="text-center" style="border-top-style:none;">{{ $tva['tva'] }} %</td>
                        </tr>
                        <tr>
                            <td>Montant TVA</td>
                            <td class="text-center">{{ $tva['montant_tva'] }}</td>
                        </tr>
                        <tr>
                            <td>Montant HT</td>
                            <td class="text-center">{{ $tva['montant_ht'] }}</td>
                        </tr>
                        <tr>
                            <td>Montant TTC</td>
                            <td class="text-center">{{ $tva['montant_ttc'] }} FCFA</td>
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
