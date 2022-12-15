@extends('layout')
@section('contenu')

    <div class="inner-wrapper">
        <section role="main" class="content-body">
            <header class="page-header">
                <h2>Tableau de bord</h2>
            </header>
            <div class="row">
                <div class="col-md-6 col-lg-12 col-xl-6">
                    <div class="row">
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
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
