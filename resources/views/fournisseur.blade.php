@extends('layout')
@section('css')
    <link rel="stylesheet" href="public/octopus/assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />
@endsection
@section('contenu')
    <div class="inner-wrapper">
        <section role="main" class="content-body">
            <header class="page-header">
                <h2>Fournisseur</h2>
            </header>

            <div class="row">
                <section class="panel">
                    <header class="panel-heading">
                        <div class="panel-actions">
                            <a href="#" class="fa fa-caret-down"></a>
                        </div>

                        <h1 class="panel-title">LISTES DES  FOURNISSEURS</h1>
                    </header>

                    <div class="panel-body">
                        <div class="col-md-18">
                            <div class="tabs">
                                <ul class="nav nav-tabs nav-justified">
                                    <li class="active">
                                        <a href="#fournisseur" data-toggle="tab" class="text-center"><i class="fa fa-star"></i> FOURNISSEUR</a>

                                    </li>
                                    <li>
                                        <a href="#fournisseur_produit" data-toggle="tab" class="text-center">FOURNISSEUR / PRODUIT</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div id="fournisseur" class="tab-pane active">
                                        <a class="modal-with-form btn btn-default mb-xs mt-xs mr-xs btn btn-default" id="btnfournisseur"><i class="fa fa-plus"></i>Ajouter un fournisseur</a>
                                        <table class="table table-bordered table-striped mb-none" id="fournisseurTable" data-swf-path="public/octopus/assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
                                            <thead>
                                            <tr>
                                                <th class="center hidden-phone">Nom</th>
                                                <th class="center hidden-phone">Adresse</th>
                                                <th class="center hidden-phone">Email</th>
                                                <th class="center hidden-phone">Contact</th>
                                                <th class="center hidden-phone">Description</th>
                                                <th class="center hidden-phone">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody class="center hidden-phone">


                                            </tbody>
                                        </table>
                                    </div>
                                    <div id="fournisseur_produit" class="tab-pane ">
                                        <a class="modal-with-form btn btn-default mb-xs mt-xs mr-xs btn btn-default" id="btnfournisseurP"><i class="fa  fa-star-half-o"></i> Fournisseur / Produits</a>
                                        <table class="table table-bordered table-striped " id="fourniTable" >
                                            <thead>
                                            <tr>
                                                <th class="center hidden-phone">Fournisseur</th>
                                                <th class="center hidden-phone">Produit</th>
                                                <th class="center hidden-phone">Modele</th>
                                                <th class="center hidden-phone">Prix</th>
                                                <th class="center hidden-phone">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody class="center hidden-phone">


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade " id="ajout_fournisseur" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">

                                    <div class="modal-header " style="background-color: #0b93d5;border-top-left-radius: inherit;border-top-right-radius: inherit">
                                        <h4 class="modal-title-user" id="myModalLabel" style="color: white"></h4>
                                    </div>
                                    <div class="modal-body">
                                        <form id="form" action="" method="POST" class="	form-validate form-horizontal mb-lg" enctype="multipart/form-data">
                                            {{csrf_field()}}
                                            <div class="form-group mt-lg">
                                                <label class="col-sm-3 control-label">Nom/Raison Social</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="nom"  id="nom" class="form-control" placeholder="LJ" required/>
                                                    <input type="hidden" name="idfournisseur" id="idfournisseur"/>
                                                </div>
                                            </div>
                                            <div class="form-group mt-lg">
                                                <label class="col-sm-3 control-label">Adresse</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="adresse" id="adresse" class="form-control" placeholder="lome" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Email</label>
                                                <div class="col-sm-9">
                                                    <input type="email" name="email" id="email" class="form-control" placeholder="aaaa@aa.com " />
                                                </div>
                                            </div>
                                            <div class="form-group mt-lg">
                                                <label class="col-sm-3 control-label">Contact</label>
                                                <div class="col-sm-9">
                                                    <input type="integer" name="contact" id="contact" class="form-control" placeholder="92658797" />
                                                </div>
                                            </div>
                                            <div class="form-group mt-lg">
                                                <label class="col-sm-3 control-label">Description</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="description" id="description" class="form-control" placeholder="......." />
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

                        <div class="modal fade " id="ajout_fournisseurP" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document" >
                                <div class="modal-content">

                                    <div class="modal-header " style="background-color: #0b93d5;border-top-left-radius: inherit;border-top-right-radius: inherit">
                                        <h4 class="modal-title-user" id="myModalLabel" style="color: white"></h4>
                                    </div>
                                    <div class="modal-body">
                                        <form id="form" action="" method="POST" class="	form-validate form-horizontal mb-lg" enctype="multipart/form-data">
                                            {{csrf_field()}}


                                            <div class="form-group mt-lg">
                                                <label class="col-sm-3 control-label">Categorie</label>
                                                <div class="col-sm-9">
                                                    <select  name="categorie" id="categorie" class="form-control populate">
                                                        <optgroup label="Choisir la categorie">
                                                            <option value=""></option>
                                                            @foreach($categorie as $cat)
                                                                <option value="{{$cat->id}}">{{$cat->nom}}</option>
                                                            @endforeach
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group mt-lg">
                                                <label class="col-sm-3 control-label">Produit</label>
                                                <div class="col-sm-9">
                                                    <select  name="produit" id="produit" class="form-control populate">
                                                        <optgroup label="Choisir un produit">

                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group mt-lg">
                                                <label class="col-sm-3 control-label">Modele</label>
                                                <div class="col-sm-9">
                                                    <select  name="modele" id="modele" class="form-control populate">
                                                        <optgroup label="Choisir un produit">

                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group mt-lg">
                                                <label class="col-sm-3 control-label">Fournisseur</label>
                                                <div class="col-sm-9">
                                                    <input type="hidden" name="idfournisseur_produit" id="idfournisseur_produit"/>
                                                    <select  name="fournisseurP" id="fournisseurP" class="form-control populate">
                                                        <optgroup label="Choisir un fournisseur">
                                                            <option value=""></option>

                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group mt-lg">
                                                <label class="col-sm-3 control-label">Prix</label>
                                                <div class="col-sm-9">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <input type="integer" name="prix" id="prix" class="form-control" placeholder="10000" required/>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <select  name="symbole" id="symbole" class="form-control populate">
                                                                <option value="1">CFA</option>
                                                                <option value="650">€ EURO</option>
                                                                <option value="550">$ USD - Dollar américain</option>
                                                                <option value="5">¥ YEN - JAPON</option>
                                                                <option value="86">¥ YUAN - CHINE</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <input type="number" min="1" maxlength="9999" name="currency" id="currency" class="form-control" value="1" required/>
                                                        </div>
                                                    </div>
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

                    </div>
                </section>
            </div>
        </section>
    </div>



    <div class="modal fade" id="detailfournisseur" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#0b97c4;border-top-left-radius: inherit;border-top-right-radius: inherit">
                    <b>	<h4 class="modal-title" id="modal-user-title" align="center" style="color: white" ></h4></b>

                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        <li class="list-group-item">Identifiant:<b> <span class="text-danger" id="sId"></span> </b></li>
                        <li class="list-group-item">Nom :<b> <span class="text-danger" id="sNom"></span> </b></li>
                        <li class="list-group-item">Adresse :<b> <span class="text-danger" id="sAdresse"></span> </b></li>
                        <li class="list-group-item">Email :<b> <span class="text-danger " id="sEmail" ></span></b></li>
                        <li class="list-group-item">Contact :<b> <span class="text-danger " id="sContact" ></span></b></li>
                        <li class="list-group-item">Description :<b> <span class="text-danger " id="sDescription" ></span></b></li>

                        <li class="list-group-item">
                            crée le :<b> <span class="text-danger" id="sCreate"></span></b> </li>

                        <li class="list-group-item">
                            mise a jour le :<b> <span class="text-danger" id="sUpdate"></span></b> </li>
                    </ul>



                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Fermer</button>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <div class="modal fade" id="detailfourni" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#0b97c4;border-top-left-radius: inherit;border-top-right-radius: inherit">
                    <b>	<h4 class="modal-title" id="modal-user-title" align="center" style="color: white" ></h4></b>

                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        <li class="list-group-item">Fournisseur :<b> <span class="text-danger" id="sFournisseur"></span> </b></li>
                        <li class="list-group-item">Produit :<b> <span class="text-danger" id="sProduit"></span> </b></li>
                        <li class="list-group-item">Modele :<b> <span class="text-danger" id="sModele"></span> </b></li>
                        <li class="list-group-item">Prix :<b> <span class="text-danger" id="sPrix"></span> </b></li>
                        <li class="list-group-item">
                            crée le :<b> <span class="text-danger" id="Create"></span></b> </li>

                        <li class="list-group-item">
                            mise a jour le :<b> <span class="text-danger" id="Update"></span></b> </li>
                    </ul>



                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Fermer</button>
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
    <script src="public/js/fourni.js"></script>
    <script src="public/js/fournisseur.js"></script>
    <script >
        $('#symbole').on('change', function(e){
            var value = $('#symbole').val();
            $('#currency').val(value);
        });
    </script>



@endsection
