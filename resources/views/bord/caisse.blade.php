@extends('layout')
@section('contenu')
    <div class="inner-wrapper">
        <section role="main" class="content-body">
            <header class="page-header">
                <h2>Tableau de bord</h2>
            </header>
            <div class="row">
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-12 col-xl-6">
                    <div class="row">
                        <div class="col-md-12 col-lg-6 col-xl-6">
                            <section class="panel panel-featured-left panel-featured-primary">
                                <div class="panel-body">
                                    <div class="widget-summary">
                                        <div class="widget-summary-col widget-summary-col-icon">
                                            <div class="summary-icon bg-primary">
                                                <i class="fa fa-shopping-cart"></i>
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
                        <div class="col-md-12 col-lg-6 col-xl-6">
                            <section class="panel panel-featured-left panel-featured-info">
                                <div class="panel-body">
                                    <div class="widget-summary">
                                        <div class="widget-summary-col widget-summary-col-icon">
                                            <div class="summary-icon bg-info">
                                                <i class="fa fa-money"></i>
                                            </div>
                                        </div>
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <h4 class="title">CHIFFRE D'AFFAIRE</h4>
                                                <div class="info">
                                                    <strong class="amount">{{$somme}}</strong>
                                                    <span class="text"> FCFA  au total pour le journal en cours</span>
                                                </div>
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
                    </div>
                </div>
        </section>
    </div>
@endsection
@section('js')
    <script src="public/js/bord.js"></script>
@endsection
