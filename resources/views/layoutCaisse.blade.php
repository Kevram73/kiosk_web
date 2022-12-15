
@section('layoutCaisse')
    <span class="separator"></span>
    <ul class="notifications">
        <li>
            <a class="modal-with-form  notification-icon" id="credit">
                <i class="fa fa-user"></i>
                <span class="badge">{{$cre}}</span>
            </a>
            <div class="modal fade " id="infocredit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                        <div class="modal-header " style="background-color: #0b93d5;border-top-left-radius: inherit;border-top-right-radius: inherit">
                            <h4 class="modal-title-user" id="myModalLabel" style="color: white"></h4>
                        </div>
                        <div class="modal-body" style="display: inline">
                            <table class="table table-bordered table-striped mb-none" id="datatable-tabletools" >
                                <thead>
                                <tr>
                                    <th class="center hidden-phone">Client</th>
                                    @foreach($clients as $client)
                                        <td class="center hidden-phone">{{$client->nom}}-{{$client->prenom}}</td>
                                    @endforeach
                                </tr>
                                </thead>
                                <thead>
                                <tr>
                                    <th class="center hidden-phone">Montant total restant</th>
                                    @foreach($credit as $cred)
                                        <td class="center hidden-phone">{{$cred}} FCFA</td>
                                    @endforeach
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <li>
            <a class="modal-with-form  notification-icon" id="info">
                <i class="fa  fa-cubes"></i>
                <span class="badge">{{$mod}}</span>
            </a>
            <div class="modal fade " id="infoproduit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                        <div class="modal-header " style="background-color: #0b93d5;border-top-left-radius: inherit;border-top-right-radius: inherit">
                            <h4 class="modal-title-user" id="myModalLabel" style="color: white"></h4>
                        </div>
                        <div class="modal-body">
                            <table class="table table-bordered table-striped mb-none" id="datatable-tabletools" >
                                <thead>
                                <tr>
                                    <th class="center hidden-phone">Produit</th>
                                    <th class="center hidden-phone">Quantité restante</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($modele2 as $modeles)
                                    <tr class="gradeA">
                                        <td class="center hidden-phone">{{$modeles->nom}}-{{$modeles->libelle}}</td>
                                        <td class="center hidden-phone">{{$modeles->quantite}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    </ul>
@endsection

