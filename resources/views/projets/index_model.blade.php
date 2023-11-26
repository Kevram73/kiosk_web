@extends('layout')
@section('css')
    <link rel="stylesheet" href="public/octopus/assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />
@endsection
@section('contenu')
    <div class="inner-wrapper">
        <section role="main" class="content-body">
            <header class="page-header">
                <h2>Produit</h2>
            </header>

            <div class="row">
                <section class="panel">
                    <header class="panel-heading">
                        <div class="panel-actions">
                            <a href="#" class="fa fa-caret-down"></a>
                        </div>

                        <h1 class="panel-title">LISTES DES PRODUITS</h1>
                    </header>

                    <div class="panel-body">
                        <a class="btn btn-default mb-xs mt-xs mr-xs btn btn-default" href="/add-modele-projet-{{ $projet->id }}" id="btnventesimple-"><i class="fa fa-plus"></i>Ajouter</a>
                        <input type="hidden" name="projet_id" id="projet_id" value="{{ $projet->id }}" />

                        {{--@if (Auth::user()->boutique->settings->where('tag', 'vente_credit')->first() && Auth::user()->boutique->settings->where('tag', 'vente_credit')->first()->pivot->is_active)
                            <a class="btn btn-default mb-xs mt-xs mr-xs btn btn-primary" id="btnventecredit"><i class="fa fa-plus"></i>Vente a  credit</a>
                        @endif

                        @if (Auth::user()->boutique->settings->where('tag', 'vente_livree')->first() && Auth::user()->boutique->settings->where('tag', 'vente_livree')->first()->pivot->is_active)
                            <a class="btn btn-default mb-xs mt-xs mr-xs btn btn-dark" id="btnventenonlivre"><i class="fa fa-plus"></i>Vente non livrée</a>
                        @endif
                        @role('ADMINISTRATEUR')
                        @if (Auth::user()->boutique->settings->where('tag', 'recette')->first() && Auth::user()->boutique->settings->where('tag', 'recette')->first()->pivot->is_active)
                        <a class="btn btn-default mb-xs mt-xs mr-xs btn btn-warning" id="btnrecettes"><i class="fa fa-money"></i>Recettes</a>
                        @endif
                        @endrole
                        @if (Auth::user()->boutique->settings->where('tag', 'reglement')->first() && !Auth::user()->boutique->settings->where('tag', 'reglement')->first()->pivot->is_active)
                        <a class="btn btn-default mb-xs mt-xs mr-xs btn btn-warning" id="btnreglement"><i class="fa fa-money"></i>Reglements</a>
                        @endif--}}

                        <a class="btn btn-default mb-xs mt-xs mr-xs btn btn-success" id="btnhistorique"><i class="fa fa-file-text"></i>Historiques</a>

                        <table class="table table-bordered table-striped mb-none" id="venteTable" >
                            <thead>
                            <tr>
                                <th class="center hidden-phone">Produit</th>
                                <th class="center hidden-phone">Quantité</th>
                                <th class="center hidden-phone">PU</th>
                                <th class="center hidden-phone">Montant Total</th>
                                <th class="center hidden-phone">Date ajout</th>
                                <th class="center hidden-phone">Utilisateur</th>
                                <th class="center hidden-phone">Action</th>
                            </tr>
                            </thead>
                            <tbody class="center hidden-phone">


                            </tbody>
                        </table>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <h3 class="m-0">Total: <strong id="montant_total" class="prix">{{$total}}</strong></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
    </section>

    <div class="modal fade" id="seuilModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#c4740b;border-top-left-radius: inherit;border-top-right-radius: inherit">
                    <b>	<h4 class="modal-title" id="modal-user-title" align="center" style="color: white" >QUANTITE SEUIL DEPASSEE : PASSEZ LA COMMANDE</h4></b>

                </div>
                <div class="modal-body">

                    <table class="table table-bordered table-striped mb-none" id="seuilTable" data-swf-path="public/octopus/assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
                        <thead>
                        <tr>
                            <th class="center hidden-phone">Produit</th>
                            <th class="center hidden-phone">Désignation</th>
                            <th class="center hidden-phone">Quantité</th>
                            <th class="center hidden-phone">Seuil</th>
                            <th class="center hidden-phone">Prix</th>
                        </tr>
                        </thead>
                        <tbody class="center hidden-phone">


                        </tbody>
                    </table>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                        <a href="/provisions" class="btn btn-primary" >Commander</a>
                    </div>
                </div>

            </div>

        </div>

    </div>
    </div>

@endsection
@section('js')

    <script src="public/octopus/assets/vendor/jquery/jquery.js"></script>
    <script src="public/octopus/assets/vendor/bootstrap/js/bootstrap.js"></script>
    <script src="public/octopus/assets/vendor/nanoscroller/nanoscroller.js"></script>
    <script src="public/octopus/assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
    <script src="public/octopus/assets/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js"></script>
    <script src="public/octopus/assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>
    <script src="public/js/projet_model.js"></script>
    <script src="public/js/categorie.js"></script>
    <script src="public/js/seuil.js"></script>
    <script>

        function setNumeralHtml(element, format, surfix="", type="html")
        {
            var prices = $("."+element);

            for(var i=0; i<prices.length; i++)
            {
                if(type=="html")
                {
                    var number = numeral(prices[i].innerText);

                    var string = number.format(format);
                    prices[i].innerText = string+" "+surfix;
                }else if(type=="value")
                {
                    var number = numeral(prices[i].value);

                    var string = number.format(format);
                    prices[i].value = string+" "+surfix;
                }

            }

        }

        setNumeralHtml("prix", "0,0");
    </script>
@endsection
