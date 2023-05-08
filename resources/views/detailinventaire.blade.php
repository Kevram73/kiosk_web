@extends('layout')
@section('css')
    <link rel="stylesheet" href="octopus/assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />
@endsection
@section('contenu')
    <-- Inventory debtor modal-->
    <div class="modal fade" id="addInvDebtorModal"
         tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">AJOUTER DÉBITEUR</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermé</button>
                    <button type="button" class="btn btn-primary">Valider</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Insert inventory debitor modales  end-->
    <div class="inner-wrapper">
        <section role="main" class="content-body">
            <header class="page-header">
                <h2>Detail inventaire</h2>
            </header>
            <div class="row">
                <!-- combo inventory -->
                <section class="panel">
                    <header class="panel-heading">

                        <h1 class="panel-title">LISTES DES DEBITEURS.</h1>
                        <div class="panel-actions">
                            <a href="#" class="fa fa-caret-down"></a>
                        </div>

                    </header>
                    <div class="panel-body">
                        <form action="/inventaire-debtors" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-8 form-group">
                                    <select name="inventaire_debitor" id="inventaire_debitor_id" class="form-control populate" required>
                                        <optgroup label="Choisir le débiteur">
                                            <option value=""></option>
                                            @foreach($debtors as $deb)
                                                <option value="{{$deb->id}}">{{$deb->nom}} &nbsp; {{$deb->prenom}}</option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                    <label class="col-sm-4 control-label">Montant</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="inv_montant"  id="inv_montant" class="form-control" placeholder="100"  min="1" max="{{$montant_total_maquant}}" required/>
                                    </div>
                                    <label for="inv_motif_id" class="col-sm-4 control-label">Motif</label>
                                    <div class="mb-3">
                                        <textarea class="form-control" id="inv_motif_id" rows="3" name="inv_motif" required></textarea>
                                    </div>
                                </div>
                                <input type="hidden" id="inven_id" name="inven_id" value="{{$inventaire[0]->inventaire_id}}"></input>

                                <button type="button" class="btn btn-primary"
                                        id="btnAddDebtor"
                                >
                                    <i class="fa fa-plus"></i>
                                </button>
                                <div class="col-md-12 text-right" style="margin-top: 25px;">
                                    <button type="submit" class="btn btn-primary" id="ajout"><i class="fa fa-check"></i> Ajouter</button>
                                    <button type="reset" class="mb-xs mt-xs mr-xs btn btn-default  "  id="annuler"><i class="fa fa-times"></i> Annuler</button>
                                </div>

                            </div>
                        </form>
                    </div>
                    <table class="table table-bordered table-striped mb-none"
                           id="afficheTableDebitor"
                           data-swf-path="octopus/assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf" >
                        <thead>
                        <tr>
                            <th class="center hidden-phone">N°</th>
                            <th class="center hidden-phone">Nom</th>
                            <th class="center hidden-phone" rowspan="2">Prénom</th>
                            <th class="center hidden-phone">Montant Total</th>
                            <th class="center hidden-phone">Motif</th>

                        </tr>
                        </thead>
                        <tbody class="center hidden-phone">
                        @php
                        $i=1 ;
                        @endphp

                        @foreach($detbtors_table as $ven)

                            <tr class="gradeA">
                                <td class="center hidden-phone">{{$i++}}</td>
                                <td class="center hidden-phone">{{$ven->nom}} </td>
                                <td class="center hidden-phone">{{$ven->prenom}} </td>
                                <td class="center hidden-phone">{{$ven->montant}} FCFA</td>
                                <td class="center hidden-phone">{{$ven->motif}} FCFA</td>

                            </tr>

                        @endforeach

                        </tbody>
                        <tfoot>
                        <tr>
                            <th scope="row" >
                                Montant Total
                            </th>
                            <td colspan="5" align="right">
                                {{$montant_total_debiteur_inventair}} &nbsp; FCFA
                            </td>

                        </tr>

                        </tfoot>

                    </table>
                </section>

                <!-- Pannel inventory -->
                <section class="panel">
                    <header class="panel-heading">
                        <div class="panel-actions">
                            <a href="#" class="fa fa-caret-down"></a>
                        </div>

                        <h1 class="panel-title">LISTES DES  PRODUITS DE L'INVENTAIRE    :     N*  {{$inventaire[0]->numero}}</h1>
                    </header>


                    <div class="panel-body">

                        <div class="row">
                        <ul class="list-group">
                            <li class="list-group-item">Inventaire N*:<b> <span class="text-danger" >{{$inventaire[0]->numero}}</span> </b></li>
                            <li class="list-group-item">Date de l'inventaire :<b> <span class="text-danger" >{{$inventaire[0]->date}}</span> </b></li>
                            <li class="list-group-item">Utilisateur :<b> <span class="text-danger" >{{$inventaire[0]->utilisateur}} - {{$inventaire[0]->prenom}}</span> </b></li>
                            @if ($inventaire[0] && $inventaire[0]->observation)
                            <li class="list-group-item">Observation :<b> <span class="text-danger" >{{$inventaire[0]->observatin}}</span> </b></li>
                            @endif
                        </ul>


                        </div>
                        <table class="table table-bordered table-striped mb-none"
                               id="afficheTable"
                               data-swf-path="octopus/assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf" >
                            <thead>
                            <tr>
                                <th class="center hidden-phone">N°</th>
                                <th class="center hidden-phone">Catégorie</th>
                                <th class="center hidden-phone" rowspan="2">Produit</th>
                                <th class="center hidden-phone">Quantité Manquante</th>
                                <th class="center hidden-phone">Prix Unitaire</th>
                                <th class="center hidden-phone"> Montant </th>
                            </tr>
                            </thead>
                            <tbody class="center hidden-phone">
                            @php
                            $i=1 ;
                            @endphp

                            @foreach($inventaire as $ven)

                                <tr class="gradeA">
                                    <td class="center hidden-phone">{{$i++}}</td>
                                    <td class="center hidden-phone">{{$ven->categorie}} </td>
                                    <td class="center hidden-phone">{{$ven->produit}} - {{$ven->modele}}  </td>
                                    <td class="center hidden-phone">{{$ven->quantite - $ven->quantiteR}}</td>
                                    <td class="center hidden-phone">{{$ven->prix_unitaire}} FCFA</td>
                                    <td class="center hidden-phone">{{$ven->prix_unitaire * ($ven->quantite - $ven->quantiteR)}}</td>
                                    <!--
                                    <td class="center hidden-phone">{{$ven->justify ? $ven->justify : '---' }}</td>
                                    -->
                                </tr>

                            @endforeach

                            </tbody>
                            <tfoot>
                             <tr>
                                 <th scope="row" >
                                        Montant Total
                                 </th>
                                 <td colspan="5" align="right">
                                     {{$montant_total_maquant}} &nbsp; FCFA
                                 </td>

                             </tr>

                            </tfoot>

                        </table>
                        <a class=" btn btn-lg mb-xs mt-xs mr-xs btn btn-danger"  href="{{route('inventaire')}}"><i class="fa  fa-times"></i>Fermé</a>
                        @if ($montant_total_maquant == $montant_total_debiteur_inventair)
                            <a class=" btn btn-lg mb-xs mt-xs mr-xs btn btn-success"
                           href="/detailinventaireprint-{{ $inventaire[0]->inventaire_id }}"><i class="fa  fa-print"></i>{{ '  ' }}Validé</a>

                        @endif()

                    </div>

                </section>
    </div>

        </section>
    </div>

@endsection
@section('js')

<script>
    import Select2 from "../../octopus/assets/vendor/select2/select2";
    export default {
        components: {Select2}
    }

    /**
     * $('#btnAddDebtor').on('click',function(){
        console.log("clicked");
        $('#addInvDebtorModal').show();
    }) ;
     */
</script>
    <script src="octopus/assets/vendor/jquery/jquery.js"></script>
    <script src="octopus/assets/vendor/bootstrap/js/bootstrap.js"></script>
    <script src="octopus/assets/vendor/nanoscroller/nanoscroller.js"></script>
    <script src="octopus/assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
    <script src="octopus/assets/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js"></script>
    <script src="octopus/assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>8

@endsection
