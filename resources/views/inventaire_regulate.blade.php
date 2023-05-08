@extends('layout')
@section('css')
<link rel="stylesheet" type="text/css"
      href="DataTables/datatables.min.css"/>
<script>
    /**

     import Scala from "../../octopus/assets/vendor/codemirror/mode/clike/scala.html";
     export default {
        components: {Scala}
    }

     */


</script>
<script src="https://unpkg.com/htmx.org@1.8.5"></script>
@endsection

@section('contenu')

    <div class="inner-wrapper">
        <section role="main" class="content-body">
            <header class="page-header">
                <h2>Regularisation de l'inventaire</h2>
            </header>
            <div class="modal fade " id="inventaireRegulateModal"
                 tabindex="-1"
                 role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">

                        <div class="modal-header " style="background-color: #0b93d5;border-top-left-radius: inherit;border-top-right-radius: inherit">
                            <h4 class="modal-title-user" id="myModalLabel" style="color: white">
                                    FORMULAIRE DE REGULARISATION.
                            </h4>
                        </div>
                        <div class="modal-body">
                            <form
                                id="form"
                                  action="/inventaire_pay"
                                  method="POST"
                                  class="form-validate form-horizontal mb-lg"
                                enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group mt-lg">
                                    <label class="col-sm-3 control-label"
                                           for="idDebiteur">Nom débiteurs.</label>
                                    <div class="col-sm-9">

                                        <select
                                            name="debtor_id"
                                            id="idDebiteur"
                                            class="form-control"
                                            hx-get="/debtor_inv_amount?inv_id={{$result[0]->id}}"

                                            hx-indicator=".htmx-indicator"
                                            hx-target="#montantId.value"
                                        >
                                            <optgroup label="Débiteurs">
                                                <option value="">Selectionner débiteur</option>

                                                @foreach($result as $re)
                                                    <option value="{{$re->debtor_id}}">
                                                        {{$re->nom}} {{$re->prenom}}
                                                    </option>
                                                @endforeach
                                            </optgroup>

                                        </select>

                                    </div>
                                </div>
                                <input type="hidden" value="{{$result[0]->id}}" name="inv_id"/>
                                <div class="form-group mt-lg">
                                    <label class="col-sm-3 control-label">Montant a rembourser</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="montant" id="montantId" class="form-control"
                                               placeholder="100"  min="0"

                                               required/>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="col-md-12 text-right">
                                        <button type="submit" class="btn btn-primary" id="btnadd"
                                          hx-confirm="Confirmer ?"
                                        ><i class="fa fa-check"></i> Valider</button>
                                        <button type="button" class="mb-xs mt-xs mr-xs btn btn-danger  " data-dismiss="modal"><i class="fa fa-times"></i> Annuler</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row"  id="inventaire">
                <input type="hidden" name="cat_id" id="cat_id" value="{{ $data->categorie_id }}">
                <input type="hidden" name="_id" id="_id" value="{{ $data->id }}">

                <section class="panel">
                    <header class="panel-heading">
                        <div class="panel-actions">
                            <a href="#" class="fa fa-caret-down"></a>
                        </div>

                        <h1 class="panel-title">Régularisations</h1>
                    </header>

                    <div class="panel-body">
                        <table class="table table-bordered table-striped mb-none" id="regulatedTable" data-swf-path="octopus/assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
                            <thead>
                            <tr>
                                <th class="center hidden-phone">N°</th>
                                <th class="center hidden-phone">Code Inventaire</th>
                                <th class="center hidden-phone">Nom et prénom</th>
                                <th class="center hidden-phone">Montant à rembourser</th>
                                <th class="center hidden-phone">Montant déja rembourser</th>
                                <th class="center hidden-phone">Restant à rembourser.</th>
                                <th  class="center hidden-phone">Action</th>
                            </tr>
                            </thead>
                            <tbody class="center hidden-phone">
                            @php
                            $i = 1 ;
                            @endphp
                            @foreach($result as $re)
                                <tr>

                                    <td>{{$i++}}</td>
                                    <td>
                                        {{$re->code_inventaire}}
                                    </td>
                                    <td>
                                        {{$re->nom}} {{$re->prenom}}
                                    </td>
                                    <td>
                                        {{$re->montant_a_rembourser}}
                                    </td>
                                    <td>
                                        @if($re->montant_rembourser == null)
                                             0 FCFA

                                        @endif


                                    </td>
                                    <td>
                                        {{$re->montant_a_rembourser - $re->montant_rembourser}}
                                    </td>
                                    <td>
                                        <a type="button" class="btn btn-lg" data-toggle="modal" data-target="#inventaireRegulateModal"> Modifier</a>
                                    </td>

                                </tr>
                            @endforeach



                            </tbody>
                        </table>
                    </div>

                </section>

            </div>

            <a class=" btn btn-default mb-xs mt-xs mr-xs btn btn-danger"
               onclick="history.back()"
               ><i class="fa fa-step-backward"></i> &nbsp; Retour</a>
        </section>
    </div>
@endsection
@section('js')
    <script src="/octopus/assets/vendor/jquery/jquery.js"></script>
    <script src="/octopus/assets/vendor/bootstrap/js/bootstrap.js"></script>
    <script src="/octopus/assets/vendor/nanoscroller/nanoscroller.js"></script>
    <script src="/octopus/assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
    <script src="/octopus/assets/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js"></script>
    <script src="/octopus/assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>
<script type="application/javascript">



</script>
@endsection
