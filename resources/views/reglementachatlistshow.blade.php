@extends('layout')
@section('css')
    <link rel="stylesheet" href="public/octopus/assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />
@endsection
@section('contenu')
    <div class="inner-wrapper">
        <section role="main" class="content-body">
            <header class="page-header">
                <h2>Reglements</h2>
            </header>
            <div class="row">
                <section class="panel">
                    <header class="panel-heading">
                        <div class="panel-actions">
                            <a href="#" class="fa fa-caret-down"></a>
                        </div> 
                        <h1 class="panel-title">FOURNISSEUR    :     {{ $fournisseur->nom.' ' }} </h1>
                        <input type="hidden" id="fournisseur_id" value="{{ $fournisseur->id }}">
                    </header>


                    <div class="panel-body">
                        <div class="row">
                            <ul class="list-group">
                                <li class="list-group-item"><center><h3>Historique des paiments</h3></center></span> </b></li>
                                @if (isset($reglementfournisseur) && isset($commandefournisseur))
                                <li class="list-group-item">Total Commande :<b> <span class="text-danger" class="prix">{{$commandefournisseur->total}}</span> </b></li>

                                    <li class="list-group-item">Total Payé :<b> <span class="text-danger" class="prix">{{$reglementfournisseur->donner}}</span> </b></li>
                                    <li class="list-group-item">Restant :<b> <span class="text-danger" class="prix">{{$commandefournisseur->total - $reglementfournisseur->donner < 1 ? '-' : $commandefournisseur->total - $reglementfournisseur->donner }}</span> </b></li>
                                @endif
                            </ul> 
                        </div>
                        <table class="table table-bordered table-striped mb-none" id="reglementTable" data-swf-path="public/octopus/assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf" >
                            <thead>
                            <tr>
                                <th class="center hidden-phone">Total</th>
                                <th class="center hidden-phone">Montant payé</th>
                                <th class="center hidden-phone">Restant</th>
                                <th class="center hidden-phone">Regler le</th>
                                <th class="center hidden-phone">Actions</th>
                            </tr>
                            </thead>
                            <tbody class="center hidden-phone">

                            </tbody>
                        </table>
                        <br>
                        <div class="row">
                            <ul class="list-group">
                                <li class="list-group-item"><center><h3>Liste Commande</h3></center></span> </b></li>
                                @if (isset($commandeClient))
                                    <li class="list-group-item">Total Commande :<b> <span class="text-danger" class="prix">{{ $commandefournisseur->total }}</span> </b></li>
                                @endif
                            </ul>
                        </div>
                        <table class="table table-bordered table-striped mb-none" id="venteTable" data-swf-path="public/octopus/assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf" >
                            <thead>
                            <tr>
                                <th class="center hidden-phone">Numero</th>
                                <th class="center hidden-phone">Montant Total</th>
                                <th class="center hidden-phone">Date de vente</th>
                                <th class="center hidden-phone">Action</th>
                            </tr>
                            </thead>
                            <tbody class="center hidden-phone">



                            </tbody>
                        </table>
                    </div>
                    <div class="modal fade " id="ajout_reglement" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">

                                <div class="modal-header " style="background-color: #0b93d5;border-top-left-radius: inherit;border-top-right-radius: inherit">
                                    <h4 class="modal-title-user" id="myModalLabel" style="color: white"></h4>
                                </div>
                                <div class="modal-body">
                                    <form id="form" action="" method="POST" class="	form-validate form-horizontal mb-lg" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        <div class="form-group mt-lg">
                                            <label class="col-sm-3 control-label">Fournisseur</label>
                                            <div class="col-sm-9">
                                                <select  name="client" id="client"   class="form-control populate">
                                                    <optgroup label="Choisir une categorie">
                                                        <option value=""></option>
                                                        @foreach($fournisseurs as $cli)
                                                            <option value="{{$cli->id}}">{{$cli->nom}}</option>
                                                        @endforeach
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group mt-lg">
                                            <label class="col-sm-3 control-label">Total a payer</label>
                                            <div class="col-sm-9">
                                                <input type="number" name="total" id="total" class="form-control"  readonly="readonly" required/>
                                                <input type="hidden" name="idreglement" id="idreglement"/>
                                                <input type="hidden" name="reste" id="reste"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Montant  payer</label>
                                            <div class="col-sm-9">
                                                <input type="number" name="donne" id="donne" class="form-control"  required/>
                                            </div>
                                        </div>
                                        <div class="form-group mt-lg">
                                            <label class="col-sm-3 control-label" id="te"></label>
                                            <div class="col-sm-9">
                                                <input type="number" name="restant" id="restant" class="form-control"  readonly="readonly" required/>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <div class="col-md-12 text-right">
                                                <button type="submit" class="btn btn-primary" id="btnadd"><i class="fa fa-check"></i> Valider</button>
                                                <button type="button" class="mb-xs mt-xs mr-xs btn btn-default  " data-dismiss="modal"><i class="fa fa-times"></i> Annuler</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
    </div>
    </section>
    </div>

@endsection
@section('js')

    <script src="public/octopus/assets/vendor/jquery/jquery.js"></script>
    <script src="public/octopus/assets/vendor/bootstrap/js/bootstrap.js"></script>
    <script src="public/octopus/assets/vendor/nanoscroller/nanoscroller.js"></script>
    <script src="public/octopus/assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
    <script src="public/octopus/assets/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js"></script>
    <script src="public/octopus/assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>
    <script src="public/js/reglement_achat_show.js"></script>
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
