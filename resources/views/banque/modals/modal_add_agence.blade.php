
<div class="modal fade" id="idAddBanqueModal" tabindex="-1"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">AJOUTER Agence</h5>
                </div>
                <div class="modal-body" id="ModalAddBanque">
                    <form class="form" id="banqueModalFormId" method="" action="">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="bName">Nom de la Banque </label>
                            <input type="text" class="form-control" id="bName" name="bName" required>
                            <select  name="bName" id="bName"   class="form-control populate">
                                <optgroup label="Choisir un Banque">
                                    <option value=""></option>
                                    @foreach($boutique as $cli)
                                        <option value="{{$cli->id}}">{{$cli->nom}}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="bDesc">Nom </label>
                            <input type="text" class="form-control" id="bDesc" name="bDesc" required>
                        </div>
                        <div class="form-group">
                            <label for="ville">Ville </label>
                            <input type="text" class="form-control" id="ville" name="ville" required>
                        </div>
                        <div class="form-group">
                            <label for="quartier">Quartier </label>
                            <input type="text" class="form-control" id="quartier" name="quartier" required>
                        </div> 
                         <div class="form-group">
                            <label for="contact">Contact </label>
                            <input type="text" class="form-control" id="contact" name="contact" required>
                        </div>
                    </form>

                </div>
                <div class="modal-footer align-content-center">
                    <button type="reset" class="btn btn-danger"
                            onclick=" $('#idAddBanqueModal').modal('hide')"
                            id="btnAnnulerBanque">ANNULLER</button>
                    <button type="submit"
                            class="btn btn-success"
                            id="btnSubmitAddBanque"

                    >VALIDER</button>
                </div>
            </div>
        </div>
    </div>
