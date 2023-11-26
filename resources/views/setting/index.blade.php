@extends('layout')
@section('css')
    <link rel="stylesheet" href="public/octopus/assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />
@endsection
@section('contenu')
    <div class="inner-wrapper">
        <section role="main" class="content-body">
            <header class="page-header">
                <h2>Boutique</h2>
            </header>

            <div class="row">
                <section class="panel">
                    <header class="panel-heading">
                        <div class="panel-actions">
                            <a href="#" class="fa fa-caret-down"></a>
                        </div>

                        <h1 class="panel-title">LISTES DES PARAMETRES : {{ $boutique->nom }}</h1>
                    </header>

                    <div class="panel-body">
                        @if (\Session::has('success'))
                            <div class="alert alert-success">
                                <ul>
                                    <li>{!! \Session::get('success') !!}</li>
                                </ul>
                            </div>
                        @endif
                        <form action="/settings" method="post">
                            @csrf
                            <input type="hidden" name="boutique_id" value="{{ $boutique->id }}">
                            <div class="row">
                                @foreach ($settings as $item)
                                    <div class="col-xs-4 col-sm-4 col-md-3 col-lg-3">
                                    <div class="row">
                                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-center">
                                            <label class="form-label d-inline {{ $boutique->settings->where('id', $item->id)->first() != null ? 'text-primary' : 'text-warning' }}" for="{{ $item->tag }}"> <strong>{{ $item->name }}</strong> </label>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                            <input type="hidden" name="settings[{{ $item->id }}]" id="id_{{ $item->id }}" value="{{ $boutique->settings->where('id', $item->id)->first() ? $boutique->settings->where('id', $item->id)->first()->pivot->is_active ? 1 : 0 : 0 }}">
                                            @if ($boutique->settings->where('id', $item->id)->first() && $boutique->settings->where('id', $item->id)->first()->pivot->is_active)
                                                <input class="form-control d-inline" type="checkbox" name="tag[{{ $item->tag }}]" id="{{ $item->tag }}" onchange="setting(event,'id_{{ $item->id }}')" checked>
                                            @else
                                                <input class="form-control d-inline" type="checkbox" name="tag[{{ $item->tag }}]" id="{{ $item->tag }}" onchange="setting(event,'id_{{ $item->id }}')">
                                            @endif
                                        </div>
                                    </div>
                                    </div>
                                @endforeach
                            </div>
                            <br>
                            <div >
                                <a type="button" class="btn btn-default" href="/boutiques" >Fermer</a>
                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                            </div>
                        </form>
                    </div>
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
    <script>
        function setting(e,id)
        {
            console.log(e.target.checked);
            $('#'+id).val(e.target.checked ? 1 : 0);
        }
    </script>

@endsection
