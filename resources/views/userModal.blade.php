<div class="modal fade " id="modal-form-user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header " style="background-color: #0b93d5;border-top-left-radius: inherit;border-top-right-radius: inherit">
                <h4 class="modal-title-user" id="myModalLabel" style="color: white"></h4>
            </div>
            <form method="post" id="userForm" data-toogle="validator">
              @csrf {{ method_field('POST') }}
            <div class="modal-body">

                    <div class="form-group">

                        <input type="hidden" name="id" id="id">
                        <label for="nom" >Nom</label>
                        <input type="text" class="form-control" name="nom" id="nom" placeholder="Ex : my" required="" autofocus="">
                    </div>

                    <div class="form-group">
                        <label for="prenom">Prenoms</label>
                        <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Ex : Resto" required="" autofocus="">
                    </div>

                    <div class="form-group " >

                    <div class="form-group col-md-6">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Ex : login" required="" autofocus="">
                    </div>
                        <div class="form-group col-md-6">
                            <label for="sexe">Sexe</label>
                            <select  class="form-control" name="sexe" id="sexe"  required="" autofocus="">
                                <option value="M">{{__('Masculin')}}</option>
                                <option value="F">{{__('Féminin')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                    <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Ex : email@gmail.com" required="" autofocus="">

                    </div>



                    <div class="form-group col-md-6">
                        <label for="contact">Contact</label>
                        <input type="text" class="form-control" name="contact" id="contact" data-inputmask='"mask": "(999) 99-99-99-99"' data-mask required="" autofocus="">
                    </div>
                    </div>
                        <div class="form-group ">
                            <label for="exampleInputEmail1">Profil</label>
                            <select class="form-control" name="profil" id="profil" required="" autofocus="">
                                @foreach($Roles as $Role)
                                    <option value="{{$Role->id}}">{{__($Role->name)}}</option>
                                    @endforeach

                            </select>
                        </div>





                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary" id="store-user"></button>
                    </div>




            </div>
        </form>


        </div>
    </div>
</div>


<div class="modal fade" id="single-data-user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#0b97c4;border-top-left-radius: inherit;border-top-right-radius: inherit">
                <b>	<h4 class="modal-title" id="modal-user-title" align="center" style="color: white" ></h4></b>

            </div>
            <div class="modal-body">
                <ul class="list-group">

                    <li class="list-group-item" style="align-content:  center">
                        <img alt=""  name="sTof" id="sTof" width="100px" class=""  src=""  >
                    </li>

                    <li class="list-group-item">Identifiant:<b> <span class="text-danger" id="sId"></span> </b></li>
                    <li class="list-group-item">Nom et prenoms :<b> <span class="text-danger" id="sNom_Prenom"></span> </b></li>
                    <li class="list-group-item">Sexe :<b> <span class="text-danger " id="sSexe" ></span></b></li>
                    <li class="list-group-item">Username :<b> <span class="text-danger " id="sUsername" ></span></b></li>
                    <li class="list-group-item">Email :<b> <span class="text-danger " id="sEmail" ></span></b></li>
                    <li class="list-group-item">Contact :<b> <span class="text-danger " id="sContact" ></span></b></li>

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
