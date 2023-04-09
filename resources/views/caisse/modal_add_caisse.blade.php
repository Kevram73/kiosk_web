<div class="modal fade " id="ajout_reglement" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header " style="background-color: #0b93d5;border-top-left-radius: inherit;border-top-right-radius: inherit">
                <h4 class="modal-title-user" id="myModalLabel" style="color: white"></h4>
            </div>
            <div class="modal-body">
                <form id="form" action="" method="POST" class="	form-validate form-horizontal mb-lg" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group mt-lg">
                        <label class="col-sm-3 control-label">Boutique</label>
                        <div class="col-sm-9">
                            <select  name="fournisseur" id="fournisseur"   class="form-control populate">
                                <optgroup label="Choisir un fournisseur">
                                    <option value=""></option>
                                    @foreach($boutique as $cli)
                                        <option value="{{$cli->id}}">{{$cli->nom}}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>
                    </div>
                 
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Libelle  </label>
                        <div class="col-sm-9">
                            <input type="text" name="libelle" id="libelle" class="form-control"  required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Montant  </label>
                        <div class="col-sm-9">
                            <input type="number" name="donne" id="donne" class="form-control"  required/>
                        </div>
                    </div>

                    <div class="form-group mt-lg">
                        <label class="col-sm-3 control-label">Date * </label>
                        <div class="col-sm-9">
                            <input type="text" name="date"  id="date" class="form-control date" placeholder="" required/>
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
