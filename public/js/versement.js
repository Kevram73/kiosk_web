$('#credit').on('click', function(){

    $('.modal-title-user').text('LISTE DES CREANCIERS');
    $('#infocredit').modal('show');
});
function sweetToast(type,text){
    return  Swal.fire({
        position: 'top-end',
        icon: type,
        title: text,
        showConfirmButton: false,
        timer: 1500,
        animation : true,
    });
}

$('#btnhistorique').on('click',function (e) {
    window.location='/historiquedepenses'
});

var versementTable;




$(function () {

    versementTable =   $('#versementTable').DataTable({
        processing: true,
        serverSide: true,
        'paging': true,
        'lengthChange': true,
        'searching': true,
        'ordering': true,
        'info': true,
        'autoWidth': true,
        language: {
            "sProcessing": "Traitement en cours...",
            "sSearch": "Rechercher&nbsp;:",
            "sLengthMenu": "Afficher _MENU_ &eacute;l&eacute;ments",
            "sInfo": "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
            "sInfoEmpty": "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
            "sInfoFiltered": "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
            "sInfoPostFix": "",
            "sLoadingRecords": "Chargement en cours...",
            "sZeroRecords": "Aucun &eacute;l&eacute;ment &agrave; afficher",
            "sEmptyTable": "Aucune donn&eacute;e disponible dans le tableau",
            "oPaginate": {
                "sFirst": "Premier",
                "sPrevious": "Pr&eacute;c&eacute;dent",
                "sNext": "Suivant",
                "sLast": "Dernier"
            },
            "oAria": {
                "sSortAscending": ": activer pour trier la colonne par ordre croissant",
                "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
            },
            "select": {
                "rows": {
                    _: "%d lignes séléctionnées",
                    0: "Aucune ligne séléctionnée",
                    1: "1 ligne séléctionnée"
                }
            }
        },

        ajax: '/versements',
        "columns": [

            {data: "nature",name : 'nature'},
            {data: "montant",name : 'montant'},
            {data: "date",name : 'date'},
            {data: "description",name : 'description'},
            {
                data: "statut",
                render : function (data, type, row) {
                    if(data == 1)
                    {
                        return "<strong ><span class='badge badge-success'>O U I</span></strong>";
                    }else{
                        return "<strong ><span class='badge badge-danger'>N O N</span></strong>";
                    }
                }
            },
            {data: "action", name : 'action' , orderable: false, searchable: false}


        ]

    });
});

$('#btndepot').on('click', function(){

    $.ajax({
        url : '/depotversement',
        type : "get",
                });
       
    });





//post des données
$('#ajout_charge  form').on('submit', function (e) {

    let url,message;
    if (!$('#idcharge').val()){
        url = '/ajouterdepense'
        message = 'Dépense enregisetré'


    }
    else{
        url = '/updatedepense'
        message = 'Dépense modifiée'

    }
    e.preventDefault();
    if (e.isDefaultPrevented()){
        $.ajax({
            url : url ,
            type : "post",
            // data : $('#modal-form-user').serialize(),
            data: new FormData($("#ajout_charge form")[0]),
            //data: new FormData($("#modal-form-user")[0]),
            contentType: false,
            processData: false,
            success : function(data) {
                if(data)
                {
                    console.log(data['montant']);
                // $('#sold').html(data['montant']);
                    $('#ajout_charge').modal('hide');
                    sweetToast('success',message);
                    versementTable.ajax.reload();
                    setNumeralHtml("prix", "0,0");
                }
                
            },
            error : function(data){
                alert('erreur')
            }
        });
    }

});

function editcharge(id){
    $.ajax({
        url : '/showdepense-'+id,
        type : "get",
        success : function(data) {

            $('#idcharge').val(data.id);
            $('#name').val(data.name);
            $('#montant').val(data.montant);
            $('#date').val(data.date_dep);
            $('#motif').val(data.motif);
            $('#btnadd').text('Modifier');
            $('#btnadd').removeClass('btn-primary');
            $('#btnadd').addClass('btn-warning');
            $('.modal-title-user').text('Modifier les informations');
            $('#ajout_charge').modal('show');

        },
        error : function(data){
            alert('erreur')
        }
    });
}

function deletecharge(id){
    Swal.fire({
        position: 'center',
        title: 'Vous etes sûr',
        text:"Les produits enregistrés sur la commande seront supprimé aussi",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor:'#3085d6',
        cancelButtonColor:'#d33',
        confirmButtonText:'Oui effacer'
    }).then ((result)=>{
        if (result.value){
            $.ajax({
                url : '/deletedepense-'+id,
                type : "get",

                contentType: false,
                processData: false,
                success : function(data) {
                    Swal.fire('Effacé',
                        'La Dépense a été supprimer',
                        'success')
                        $('#sold').html(data['montant']);
                        versementTable.ajax.reload();
                        setNumeralHtml("prix", "0,0");
                },
                error : function(data){
                    Swal.fire('Erreur',
                        'Suppression de la dépense',
                        'danger')
                }
            });

        }
    });
}




var ValidationVersementTable;




$(function () {

    ValidationVersementTable =   $('#ValidationVersementTable').DataTable({
        processing: true,
        serverSide: true,
        'paging': true,
        'lengthChange': true,
        'searching': true,
        'ordering': true,
        'info': true,
        'autoWidth': true,
        language: {
            "sProcessing": "Traitement en cours...",
            "sSearch": "Rechercher&nbsp;:",
            "sLengthMenu": "Afficher _MENU_ &eacute;l&eacute;ments",
            "sInfo": "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
            "sInfoEmpty": "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
            "sInfoFiltered": "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
            "sInfoPostFix": "",
            "sLoadingRecords": "Chargement en cours...",
            "sZeroRecords": "Aucun &eacute;l&eacute;ment &agrave; afficher",
            "sEmptyTable": "Aucune donn&eacute;e disponible dans le tableau",
            "oPaginate": {
                "sFirst": "Premier",
                "sPrevious": "Pr&eacute;c&eacute;dent",
                "sNext": "Suivant",
                "sLast": "Dernier"
            },
            "oAria": {
                "sSortAscending": ": activer pour trier la colonne par ordre croissant",
                "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
            },
            "select": {
                "rows": {
                    _: "%d lignes séléctionnées",
                    0: "Aucune ligne séléctionnée",
                    1: "1 ligne séléctionnée"
                }
            }
        },

        ajax: '/validationversement',
        "columns": [

            {data: "date",name : 'date'},
            {data: "compte",name : 'compte'},

            {data: "montant",name : 'montant'},
            {data: "utilisateur",name : 'utilisateur'}, 
            {data: "nature",name : 'nature'},
            {data: "description",name : 'description'},
            {
                data: "statut",
                render : function (data, type, row) {
                    if(data == 1)
                    {
                        return "<strong ><span class='badge badge-success'>O U I</span></strong>";
                    }else{
                        return "<strong ><span class='badge badge-danger'>N O N</span></strong>";
                    }
                }
            },
            {data: "action", name : 'action' , orderable: false, searchable: false}


        ]

    });
});
console.log('versemennnnnnnnnnnnnnnnnt');


var TotalVersementTable;




$(function () {

    TotalVersementTable =   $('#TotalVersementTable').DataTable({
        processing: true,
        serverSide: true,
        'paging': true,
        'lengthChange': true,
        'searching': true,
        'ordering': true,
        'info': true,
        'autoWidth': true,
        language: {
            "sProcessing": "Traitement en cours...",
            "sSearch": "Rechercher&nbsp;:",
            "sLengthMenu": "Afficher _MENU_ &eacute;l&eacute;ments",
            "sInfo": "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
            "sInfoEmpty": "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
            "sInfoFiltered": "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
            "sInfoPostFix": "",
            "sLoadingRecords": "Chargement en cours...",
            "sZeroRecords": "Aucun &eacute;l&eacute;ment &agrave; afficher",
            "sEmptyTable": "Aucune donn&eacute;e disponible dans le tableau",
            "oPaginate": {
                "sFirst": "Premier",
                "sPrevious": "Pr&eacute;c&eacute;dent",
                "sNext": "Suivant",
                "sLast": "Dernier"
            },
            "oAria": {
                "sSortAscending": ": activer pour trier la colonne par ordre croissant",
                "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
            },
            "select": {
                "rows": {
                    _: "%d lignes séléctionnées",
                    0: "Aucune ligne séléctionnée",
                    1: "1 ligne séléctionnée"
                }
            }
        },

        ajax: '/listemontantcollecte',
        "columns": [

            {data: "date",name : 'date'},
            {data: "boutique",name : 'boutique'},
            {data: "montantcollecte",name : 'montantcollecte'},
            {data: "boutiquier",name : 'boutiquier'},


        ]

    });
});
