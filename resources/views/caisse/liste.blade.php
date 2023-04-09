@extends('layout')
@section('css')
    <link rel="stylesheet" href="octopus/assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />
@endsection
@section('contenu')
    <div class="inner-wrapper">
        <section role="main" class="content-body">
            <header class="page-header">
                <h2>Caisse</h2>
            </header>

            <div class="row">
                <section class="panel">
                    <header class="panel-heading"> 
                        <div class="panel-actions">
                            <a href="#" class="fa fa-caret-down"></a>
                        </div>

                        <h1 class="panel-title">LISTES DES  Caisses</h1>
                    </header>

                    <div class="panel-body">
                        <div class="tabs">

                            <div class="tab-content">
                                <div id="reglements" class="tab-pane active">
                                    <a class="modal-with-form btn btn-default mb-xs mt-xs mr-xs btn btn-default" id="btnreglement"><i class="fa fa-plus"></i>Ajouter une caisse</a>
                                    <table class="table table-bordered table-striped mb-none"  data-swf-path="octopus/assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
                                        <thead>
                                        <tr>
                                            <th class="center hidden-phone">Nom</th>
                                            <th class="center hidden-phone">Total Commande</th>
                                            <th class="center hidden-phone">Total Payé</th>
                                            <th class="center hidden-phone">Restant</th>
                                            <th class="center hidden-phone">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody class="center hidden-phone">
                                                @foreach ($caisse as $index => $item)
                                                    <tr>
                                                        <td>{{ $item->libelle .' '}}</td>
                                                        <td class="prix">{{ $item->solde }}</td>
                                                        <td class="prix">{{ $reglements[$index]->date }}</td>
                                                        <td class="prix">{{ $item->recouvrementInte }}</td>
                                                        <td><a class="btn btn-info" href="/reglementachatlist-{{ $item->id }}"> <i class="fa fa-arrow-right"></i>
                                                @endforeach
                                           
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>

                        @include('caisse.modal_add_caisse')

                    </div>
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
    <script src="js/caisse.js"></script>
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

        setNumeralHtml("prix", "0,0", "");
    </script>
@endsection
