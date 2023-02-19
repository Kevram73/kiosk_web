
<div class="modal fade" id="idAddBanqueModal" tabindex="-1"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">AJOUTER BANQUE</h5>
                </div>
                <div class="modal-body" id="ModalAddBanque">
                    <form class="form" id="banqueModalFormId" method="" action="">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="bName">Nom de la banque </label>
                            <input type="text" class="form-control" id="bName" name="bName" required>
                        </div>
                        <div class="form-group">
                            <label for="bDesc">Description banques </label>
                            <input type="text" class="form-control" id="bDesc" name="bDesc" required>
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
