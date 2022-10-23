@extends('layout')
@section('css')
    <link rel="stylesheet" href="octopus/assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />
@endsection
@section('contenu')
    <div class="inner-wrapper">
        <section role="main" class="content-body">
            <header class="page-header">
                <h2>Retour produits</h2>
            </header>
            <div class="row">
                <section class="panel">
                    <header class="panel-heading">
                        <div class="panel-actions">
                            <a href="#" class="fa fa-caret-down"></a>
                        </div>

                        <h1 class="panel-title">LISTES DES  PRODUITS RETOURNE </h1>
                    </header>


                    <div class="panel-body">

                        <table class="table table-bordered table-striped mb-none" id="afficheTable" data-swf-path="octopus/assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf" >
                            <thead>
                            <tr>
                                <th class="center hidden-phone">Produit</th>
                                <th class="center hidden-phone">Quantité Retourné</th>
                                <th class="center hidden-phone">Quantité Restante</th>
                                <th class="center hidden-phone">Montant </th>
                                <th class="center hidden-phone">Payer </th>
                                <th class="center hidden-phone">Retour en Rayon </th>
                            </tr>
                            </thead>
                            <tbody class="center hidden-phone">

                            @foreach($retourLignes as $ven)

                                <tr class="gradeA">
                                    <td class="center hidden-phone">{{$ven->produit}} - {{$ven->modele}}  </td>
                                    <td class="center hidden-phone">{{$ven->quantite_retourner}}</td>
                                    <td class="center hidden-phone">{{$ven->quantite_restante}}</td>
                                    <td class="center hidden-phone prix">{{$ven->montant}}</td>
                                    <td class="center hidden-phone">{{$ven->payer == 1 ? "OUI" : "NON" }} </td>
                                    <td class="center hidden-phone">{{$ven->rayon == 1 ? "OUI" : "NON" }}</td>
                                </tr>

                            @endforeach

                            </tbody>
                        </table>
                        {{-- @if ($all_vente->with_tva)
                        <div>
                            <table class="table" style="width: 45%; position: relative; left: 55%;">
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
                        @endif --}}

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
    </script>
@endsection
