<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inventaire</title>
    <link rel="stylesheet" href="public/octopus/assets/vendor/bootstrap/css/bootstrap.css" />
</head>
<body>
    <div class="wrapper">
        <!-- Main content -->
        <section class="invoice">
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
            <h5 align="center"><strong>INVENTARE</strong></h5>

            <table class="table borderless mb-none" >
                <tr>
                    <td class="">
                        <address>
                            <b>Inventaire N* : <span class="text-danger" >{{$inventaire->numero}} </span> </b><br>
                            <b>Créer le <span class="text-danger" >{{ date('d / m / Y', strtotime($inventaire->date_inventaire)) }} </span> </b><br>
                            <br>Fait le <span class="text-danger" >........ / ........ / {{ now()->format('Y') }}</span>
                        </address>
                    </td>
                    <td class="text-right">
                        <address>
                            <b><span class="text-danger" > </span> </b><br>
                            <b>Par : <span class="text-danger" >{{ '    '.$user->nom . ' ' . $user->prenom}}</span> </b><br>
                            <br>Par : <span class="text-danger" > .....................................................</span>
                        </address>
                    </td>

                </tr>
            </table>


            <h6 align="center"><strong>LISTE DES PRODUITS</strong></h6>
            <br>
            <!-- Table row -->

            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-bordered table-striped mb-none" id="afficheTable" data-swf-path="public/octopus/assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf" >
                        <thead>
                        <tr>
                            {{-- <th class="text-center hidden-phone">Categorie</th> --}}
                            <th class="text-center hidden-phone">Produit</th>
                            <th class="text-center hidden-phone">Quantité </th>
                            <th class="text-center hidden-phone">Quantité réelle</th>
                            <th class="text-center hidden-phone">Justification </th>
                        </tr>
                        </thead>
                        <tbody class="center hidden-phone">

                        @foreach($modeles as $mod)

                            <tr class="gradeA">
                                {{-- <td class="text-center hidden-phone">{{$mod->categorie}} </td> --}}
                                <td class="text-center hidden-phone">{{$mod->produit .' - '. $mod->modele}}</td>
                                <td class="text-center hidden-phone"> {{ $mod->quantite }} </td>
                                <td class="text-center hidden-phone"> </td>
                                <td class="text-center hidden-phone"> </td>
                            </tr>

                        @endforeach

                        </tbody>
                    </table>
                    {{-- <li class="list-group-item center hidden-phone" >Montant total :<b> <span class="text-danger "  >{{$total}} fcfa</span></b></li> --}}
                </div>
            </div>
        </section>
    </div>
    <script src="public/octopus/assets/vendor/jquery/jquery.js"></script>
    <script src="public/octopus/assets/vendor/bootstrap/js/bootstrap.js"></script>
</body>
</html>
