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

                        <h1 class="panel-title">RETOUR PRODUITS : {{ $vente->numero }}</h1>
                    </header>

                    <div class="panel-body">


                        <div class="row" >
                                            <input type="hidden" name="vente" id="vente" value="{{ $vente->id }}">

                                            <div class="col-md-4 form-group">
                                                <label class="col-sm-4 control-label">Produit</label>
                                                <div class="col-md-9 form-group">
                                                    <select  name="produit" id="produit"   class="form-control populate">
                                                        <optgroup label="Choisir le produit">
                                                            <option value=""></option>
                                                            @foreach ($commande as $item)
                                                            <option value="{{ $item->id }}">{{ $item->produit }} - {{ $item->modele }}</option>
                                                            @endforeach
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <label class="col-sm-6 control-label">Quantité vendu</label>
                                                <div class="col-sm-9">
                                                    <input type="number" name="quant"  id="quant" class="form-control" readonly="readonly" />
                                                </div>
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <label class="col-sm-6 control-label">Quantité retourner</label>
                                                <div class="col-sm-9">
                                                    <input type="number" name="quantite"  id="quantite" class="form-control" placeholder="100" min="1"  required/>
                                                </div>
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <label class="col-sm-6 control-label">Payer</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control d-inline mr-5" type="checkbox" name="payer" id="payer" checked required>
                                                </div>
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <label class="col-sm-6 control-label">Retour Rayon</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control d-inline mr-5" type="checkbox" name="rayon" id="rayon" checked required>
                                                </div>
                                            </div>

                        </div>
                                                <div class="col-md-12 text-right">
                                                    <button type="button" class="btn btn-primary" id="ajout"><i class="fa fa-check"></i> Ajouter</button>
                                                    <button type="button" class="mb-xs mt-xs mr-xs btn btn-default  "  id="annuler"><i class="fa fa-times"></i> Annuler</button>
                                                </div>

                    <div id="retform">
                        <form  method="POST" class="	form-validate form-horizontal mb-lg" >
                            {{csrf_field()}}
                        <input type="hidden"  name="retTable" id="retTable">
                        </form>
                    </div>
                    <table class="table table-bordered table-striped mb-none" id="retourTable" data-swf-path="octopus/assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
                        <thead>
                        <tr>
                            <th class="center hidden-phone">Numero</th>
                            <th class="center hidden-phone">Produit</th>
                            <th class="center hidden-phone">Quantité </th>
                            <th class="center hidden-phone">Payer </th>
                            <th class="center hidden-phone">Retour en Rayon </th>
                        </tr>
                        </thead>
                        <tbody class="center hidden-phone">

                        </tbody>
                    </table>
                    <a class="btn btn-danger" id="sup" ><i class="fa fa-trash-o" ></i>Supprimer</a>
                    <div class="col-md-12 text-right">
                        <button type="button" class="btn btn-primary" id="valider"><i class="fa fa-check"></i> Valider</button>
                        <button type="button" class="mb-xs mt-xs mr-xs btn btn-default  "  id="annuler"><i class="fa fa-times"></i> Annuler</button>
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
    <script src="js/retourvente.js"></script>

@endsection
