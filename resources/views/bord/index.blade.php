@extends('layout')
@section('contenu')
    <div class="inner-wrapper">
        <section role="main" class="content-body">
            <header class="page-header">
                <h2>Tableau de bord</h2>
            </header>
            <div class="row">
                <div class="col-md-6 col-lg-12 col-xl-6">
					@role('ADMINISTRATEUR')
						<div class="row">
                        <div class="col-md-12 col-lg-6 col-xl-6">
                            <section class="panel panel-featured-left panel-featured-dark">
                                <div class="panel-body">
                                    <div class="widget-summary">
                                        <div class="widget-summary-col widget-summary-col-icon">
                                            <div class="summary-icon bg-dark">
                                                <i class="fa   fa-suitcase"></i>
                                            </div>
                                        </div>
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <h4 class="title">CATEGORIES</h4>
                                                <div class="info">
                                                    <strong class="amount">{{$categorie}}</strong>
                                                    <span class="text"> au total</span>
                                                </div>
                                            </div>
                                            <div class="summary-footer">
                                                <a class="text-primary-muted text-uppercase" href="{{route('categories')}}">Voir la liste</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div class="col-md-12 col-lg-6 col-xl-6">
                            <section class="panel panel-featured-left panel-featured-secondary">
                                <div class="panel-body">
                                    <div class="widget-summary">
                                        <div class="widget-summary-col widget-summary-col-icon">
                                            <div class="summary-icon bg-secondary">
                                                <i class="fa  fa-cubes"></i>
                                            </div>
                                        </div>
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <h4 class="title">PRODUITS</h4>
                                                <div class="info">
                                                    <strong class="amount">{{$produit}}</strong>
                                                    <span class="text"> au total</span>
                                                </div>
                                            </div>
                                            <div class="summary-footer">
                                                <a class="text-primary-muted text-uppercase" href="{{route('modeles')}}">Voir la liste</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div class="col-md-12 col-lg-6 col-xl-6">
                            <section class="panel panel-featured-left panel-featured-warning">
                                <div class="panel-body">
                                    <div class="widget-summary">
                                        <div class="widget-summary-col widget-summary-col-icon">
                                            <div class="summary-icon bg-warning">
                                                <i class="fa fa-user"></i>
                                            </div>
                                        </div>
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <h4 class="title">CLIENTS</h4>
                                                <div class="info">
                                                    <strong class="amount">{{$client}}</strong>
                                                    <span class="text"> au total</span>
                                                </div>
                                            </div>
                                            <div class="summary-footer">
                                                <a class="text-primary-muted text-uppercase" href="{{route('clients')}}">Voir la liste</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                    </div>
                        <div class="col-md-12 col-lg-6 col-xl-6">
                            <section class="panel panel-featured-left panel-featured-success">
                                <div class="panel-body">
                                    <div class="widget-summary">
                                        <div class="widget-summary-col widget-summary-col-icon">
                                            <div class="summary-icon bg-success">
                                                <i class="fa  fa-child"></i>
                                            </div>
                                        </div>
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <h4 class="title">FOURNISSEURS</h4>
                                                <div class="info">
                                                    <strong class="amount">{{$fournisseur}}</strong>
                                                    <span class="text"> au total</span>
                                                </div>
                                            </div>
                                            <div class="summary-footer">
                                                <a class="text-primary-muted text-uppercase" href="{{route('fournisseurs')}}">Voir la liste</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div class="col-md-12 col-lg-6 col-xl-6">
                            <section class="panel panel-featured-left panel-featured-quartenary">
                                <div class="panel-body">
                                    <div class="widget-summary">
                                        <div class="widget-summary-col widget-summary-col-icon">
                                            <div class="summary-icon bg-quartenary">
                                                <i class="fa fa-users"></i>
                                            </div>
                                        </div>
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <h4 class="title">EMPLOYES</h4>
                                                <div class="info">
                                                    <strong class="amount">{{$employe}}</strong>
                                                    <span class="text">au total</span>
                                                </div>
                                            </div>
                                            <div class="summary-footer">
                                                <a class="text-primary-muted text-uppercase" href="{{route('utilisateurs')}}">Voir la liste</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div class="col-md-12 col-lg-6 col-xl-6">
                            <section class="panel panel-featured-left panel-featured-tertiary">
                                <div class="panel-body">
                                    <div class="widget-summary">
                                        <div class="widget-summary-col widget-summary-col-icon">
                                            <div class="summary-icon bg-tertiary">
                                                <i class="fa  fa-shopping-cart"></i>
                                            </div>
                                        </div>
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <h4 class="title">VENTES</h4>
                                                <div class="info">
                                                    <strong class="amount">{{$vente}}</strong>
                                                    <span class="text"> au total pour le journal en cours</span>
                                                </div>
                                            </div>
                                            <div class="summary-footer">
                                                <a class="text-primary-muted text-uppercase" href="{{route('ventes')}}">Faire une vente</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
					</div>
					@endrole
					
					@role('VENDEUR')
						<div class="row">
							<div class="col-md-12 col-lg-6 col-xl-6">
								<section class="panel panel-featured-left panel-featured-warning">
									<div class="panel-body">
										<div class="widget-summary">
											<div class="widget-summary-col widget-summary-col-icon">
												<div class="summary-icon bg-warning">
													<i class="fa fa-user"></i>
												</div>
											</div>
											<div class="widget-summary-col">
												<div class="summary">
													<h4 class="title">CLIENTS</h4>
													<div class="info">
														<strong class="amount">{{$client}}</strong>
														<span class="text"> au total</span>
													</div>
												</div>
												<div class="summary-footer">
													<a class="text-primary-muted text-uppercase" href="{{route('clients')}}">Voir la liste</a>
												</div>
											</div>
										</div>
									</div>
								</section>
						</div>
							<div class="col-md-12 col-lg-6 col-xl-6">
                            <section class="panel panel-featured-left panel-featured-tertiary">
                                <div class="panel-body">
                                    <div class="widget-summary">
                                        <div class="widget-summary-col widget-summary-col-icon">
                                            <div class="summary-icon bg-tertiary">
                                                <i class="fa  fa-shopping-cart"></i>
                                            </div>
                                        </div>
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <h4 class="title">VENTES</h4>
                                                <div class="info">
                                                    <strong class="amount">{{$vente}}</strong>
                                                    <span class="text"> au total pour le journal en cours</span>
                                                </div>
                                            </div>
                                            <div class="summary-footer">
                                                <a class="text-primary-muted text-uppercase" href="{{route('ventes')}}">Faire une vente</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
						</div>
					@endrole
					
					@role('CAISSIER')
						<div class="row">
							<div class="col-md-12 col-lg-6 col-xl-6">
								<section class="panel panel-featured-left panel-featured-warning">
									<div class="panel-body">
										<div class="widget-summary">
											<div class="widget-summary-col widget-summary-col-icon">
												<div class="summary-icon bg-warning">
													<i class="fa fa-user"></i>
												</div>
											</div>
											<div class="widget-summary-col">
												<div class="summary">
													<h4 class="title">CLIENTS</h4>
													<div class="info">
														<strong class="amount">{{$client}}</strong>
														<span class="text"> au total</span>
													</div>
												</div>
												<div class="summary-footer">
													<a class="text-primary-muted text-uppercase" href="{{route('clients')}}">Voir la liste</a>
												</div>
											</div>
										</div>
									</div>
								</section>
						</div>
							<div class="col-md-12 col-lg-6 col-xl-6">
                            <section class="panel panel-featured-left panel-featured-tertiary">
                                <div class="panel-body">
                                    <div class="widget-summary">
                                        <div class="widget-summary-col widget-summary-col-icon">
                                            <div class="summary-icon bg-tertiary">
                                                <i class="fa  fa-shopping-cart"></i>
                                            </div>
                                        </div>
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <h4 class="title">VENTES</h4>
                                                <div class="info">
                                                    <strong class="amount">{{$vente}}</strong>
                                                    <span class="text"> au total pour le journal en cours</span>
                                                </div>
                                            </div>
                                            <div class="summary-footer">
                                                <a class="text-primary-muted text-uppercase" href="{{route('ventes')}}">Faire une vente</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
						</div>
					@endrole
					
					@role('MAGASINIER')
						<div class="row">
							<div class="col-md-12 col-lg-6 col-xl-6">
								<section class="panel panel-featured-left panel-featured-warning">
									<div class="panel-body">
										<div class="widget-summary">
											<div class="widget-summary-col widget-summary-col-icon">
												<div class="summary-icon bg-warning">
													<i class="fa fa-user"></i>
												</div>
											</div>
											<div class="widget-summary-col">
												<div class="summary">
													<h4 class="title">CLIENTS</h4>
													<div class="info">
														<strong class="amount">{{$client}}</strong>
														<span class="text"> au total</span>
													</div>
												</div>
												<div class="summary-footer">
													<a class="text-primary-muted text-uppercase" href="{{route('clients')}}">Voir la liste</a>
												</div>
											</div>
										</div>
									</div>
								</section>
						</div>
							<div class="col-md-12 col-lg-6 col-xl-6">
                            <section class="panel panel-featured-left panel-featured-tertiary">
                                <div class="panel-body">
                                    <div class="widget-summary">
                                        <div class="widget-summary-col widget-summary-col-icon">
                                            <div class="summary-icon bg-tertiary">
                                                <i class="fa  fa-shopping-cart"></i>
                                            </div>
                                        </div>
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <h4 class="title">VENTES</h4>
                                                <div class="info">
                                                    <strong class="amount">{{$vente}}</strong>
                                                    <span class="text"> au total pour le journal en cours</span>
                                                </div>
                                            </div>
                                            <div class="summary-footer">
                                                <a class="text-primary-muted text-uppercase" href="{{route('ventes')}}">Faire une vente</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
						</div>
					@endrole
					
					@role('SUPER ADMINISTRATEUR')
						<div class="row">
                        <div class="col-md-12 col-lg-6 col-xl-6">
                            <section class="panel panel-featured-left panel-featured-dark">
                                <div class="panel-body">
                                    <div class="widget-summary">
                                        <div class="widget-summary-col widget-summary-col-icon">
                                            <div class="summary-icon bg-dark">
                                                <i class="fa   fa-suitcase"></i>
                                            </div>
                                        </div>
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <h4 class="title">CATEGORIES</h4>
                                                <div class="info">
                                                    <strong class="amount">{{$categorie}}</strong>
                                                    <span class="text"> au total</span>
                                                </div>
                                            </div>
                                            <div class="summary-footer">
                                                <a class="text-primary-muted text-uppercase" href="{{route('categories')}}">Voir la liste</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div class="col-md-12 col-lg-6 col-xl-6">
                            <section class="panel panel-featured-left panel-featured-secondary">
                                <div class="panel-body">
                                    <div class="widget-summary">
                                        <div class="widget-summary-col widget-summary-col-icon">
                                            <div class="summary-icon bg-secondary">
                                                <i class="fa  fa-cubes"></i>
                                            </div>
                                        </div>
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <h4 class="title">PRODUITS</h4>
                                                <div class="info">
                                                    <strong class="amount">{{$produit}}</strong>
                                                    <span class="text"> au total</span>
                                                </div>
                                            </div>
                                            <div class="summary-footer">
                                                <a class="text-primary-muted text-uppercase" href="{{route('modeles')}}">Voir la liste</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div class="col-md-12 col-lg-6 col-xl-6">
                            <section class="panel panel-featured-left panel-featured-warning">
                                <div class="panel-body">
                                    <div class="widget-summary">
                                        <div class="widget-summary-col widget-summary-col-icon">
                                            <div class="summary-icon bg-warning">
                                                <i class="fa fa-user"></i>
                                            </div>
                                        </div>
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <h4 class="title">CLIENTS</h4>
                                                <div class="info">
                                                    <strong class="amount">{{$client}}</strong>
                                                    <span class="text"> au total</span>
                                                </div>
                                            </div>
                                            <div class="summary-footer">
                                                <a class="text-primary-muted text-uppercase" href="{{route('clients')}}">Voir la liste</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                    </div>
                        <div class="col-md-12 col-lg-6 col-xl-6">
                            <section class="panel panel-featured-left panel-featured-success">
                                <div class="panel-body">
                                    <div class="widget-summary">
                                        <div class="widget-summary-col widget-summary-col-icon">
                                            <div class="summary-icon bg-success">
                                                <i class="fa  fa-child"></i>
                                            </div>
                                        </div>
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <h4 class="title">FOURNISSEURS</h4>
                                                <div class="info">
                                                    <strong class="amount">{{$fournisseur}}</strong>
                                                    <span class="text"> au total</span>
                                                </div>
                                            </div>
                                            <div class="summary-footer">
                                                <a class="text-primary-muted text-uppercase" href="{{route('fournisseurs')}}">Voir la liste</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div class="col-md-12 col-lg-6 col-xl-6">
                            <section class="panel panel-featured-left panel-featured-quartenary">
                                <div class="panel-body">
                                    <div class="widget-summary">
                                        <div class="widget-summary-col widget-summary-col-icon">
                                            <div class="summary-icon bg-quartenary">
                                                <i class="fa fa-users"></i>
                                            </div>
                                        </div>
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <h4 class="title">EMPLOYES</h4>
                                                <div class="info">
                                                    <strong class="amount">{{$employe}}</strong>
                                                    <span class="text">au total</span>
                                                </div>
                                            </div>
                                            <div class="summary-footer">
                                                <a class="text-primary-muted text-uppercase" href="{{route('utilisateurs')}}">Voir la liste</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div class="col-md-12 col-lg-6 col-xl-6">
                            <section class="panel panel-featured-left panel-featured-tertiary">
                                <div class="panel-body">
                                    <div class="widget-summary">
                                        <div class="widget-summary-col widget-summary-col-icon">
                                            <div class="summary-icon bg-tertiary">
                                                <i class="fa  fa-shopping-cart"></i>
                                            </div>
                                        </div>
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <h4 class="title">VENTES</h4>
                                                <div class="info">
                                                    <strong class="amount">{{$vente}}</strong>
                                                    <span class="text"> au total pour le journal en cours</span>
                                                </div>
                                            </div>
                                            <div class="summary-footer">
                                                <a class="text-primary-muted text-uppercase" href="{{route('ventes')}}">Faire une vente</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
					</div>
					@endrole
				</div>
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
    <script src="public/js/bord.js"></script>
    <script src="public/js/seuil.js"></script>

@endsection
