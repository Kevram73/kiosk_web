@extends('layout')
@section('css')
    <link rel="stylesheet" href="octopus/assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />
@endsection
@section('contenu')
    <div class="inner-wrapper">
        <section role="main" class="content-body">
            <header class="page-header">
                <h2>Facture</h2>
            </header>
                <div  id="ajout_reglement" >
                                <form id="form" action="" method="POST" class="	form-validate form-horizontal mb-lg" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <input type="hidden" name="id" id="id" value="{{ $all_vente->id }}">
                                    <div class="col-md-4 form-group">
                                        <label class="col-sm-3 control-label">Montant total</label>
                                        <div class="col-sm-9">
                                            <input type="number" name="total"  id="total" class="form-control"  value="{{ $all_vente->totaux }}"  readonly="readonly"   required/>
                                        </div>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label class="col-sm-3 control-label">Montant donné</label>
                                        <div class="col-sm-9">
                                            <input type="number" name="donne"  id="donne" class="form-control"  min="0" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label class="col-sm-3 control-label" id="te"></label>
                                        <div class="col-sm-9">
                                            <input type="number" name="restant"  id="restant" class="form-control"    readonly="readonly" required/>
                                            <input type="hidden" name="reste" id="reste"/>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-right">
                                            <a href="{{ route('ventes') }}" class="btn btn-danger" ></i> Fermer</i></a>
                                            <input type="hidden" name="typeVente" id="typeVente" value="{{$all_vente->type_vente}}"/>
                                            <button type="submit" class="btn btn-primary" id="btnadd"><i class="fa fa-check"></i> Valider et imprimer la facture <i class="fa  fa-file-pdf-o"></i></button>
                                        </div>
                                    </div>
                                </form>
                </div>
            <div class="row">
                <section class="panel">
                    <header class="panel-heading">
                        <div class="panel-actions">
                            <a href="#" class="fa fa-caret-down"></a>
                        </div>

                        <h1 class="panel-title">LISTES DES  PRODUITS DE LA  VENTE </h1>
                    </header>


                    <div class="panel-body">
                        <div class="row">
                        <ul class="list-group">
                                <li class="list-group-item">Montant total :<b> <span class="text-danger prix"  >{{ $all_vente->totaux }} FCFA</span></b></li>
                                <li class="list-group-item">Montant réduit :<b> <span class="text-danger " >{{$total_reduction}} FCFA</span></b></li>
                                <li class="list-group-item">Montant donné :<b> <span class="text-danger " id="Sdonne" > </span></b></li>
                                <li class="list-group-item">Montant Restant :<b> <span class="text-danger " id="Srestant" > </span></b></li>
                        </ul>
                        </div>
                        <table class="table table-bordered table-striped mb-none" id="afficheTable"  >
                            <thead>
                            <tr>
                                <th class="center hidden-phone">Produit</th>
                                <th class="center hidden-phone">Prix </th>
                                <th class="center hidden-phone">Quantité </th>
                                <th class="center hidden-phone">Réduction </th>
                                <th class="center hidden-phone">Prix total </th>
                            </tr>
                            </thead>
                            <tbody class="center hidden-phone">

                            @foreach($vente as $ven)

                                <tr class="gradeA">
                                    <td class="center hidden-phone">{{$ven->produit}} - {{$ven->modele}}  </td>
                                    <td class="center hidden-phone prix-n">{{$ven->prix}} fcfa</td>
                                    <td class="center hidden-phone">{{$ven->quantite}}</td>
                                    <td class="center hidden-phone">{{$ven->reduction}}</td>
                                    <td class="center hidden-phone prix">{{$ven->prixtotal}} fcfa</td>
                                </tr>

                            @endforeach

                            </tbody>
                        </table>
                        @if ($all_vente->with_tva)
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
                        @endif
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
    <script src="js/facture.js"></script>
    <script src="js/facture-paye-complet.js"></script>
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

        setNumeralHtml("prix", "0,0", "FCFA");
        setNumeralHtml("prix-n", "0,0");
    </script>

@endsection
