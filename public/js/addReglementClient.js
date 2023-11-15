function sweetToast(type,text){
    return  Swal.fire({
        position: 'top-end',
        icon: type,
        title: text,
        showConfirmButton: false,
        timer: 2000,
        animation : true,
    });
}

console.log('js affiche looooooooooo pardon');

$('#client').on('change',function ( ) {
    $('#total').empty();
    $.ajax({
        url: '/restant-' + $('#client').val(),
        type: "get",
        success: function (data) {
            $('#total').empty();
            $('#idvente').empty();
            $('#total').val(data.montant_restant)
            $('#idvente').val(data.venteId)

        },
        error: function (data) {
            console.log("erreur")
        },
    })
})


$('#donne').on('value change',function ( ) {
    $('#restant').val($('#total').val()-$('#donne').val());
    if ( $('#restant').val()>0) {
        $('#te').text('Restant');
        $('#reste').val(1);

    }
    if ( $('#restant').val()<0) {
        $('#te').text('Monnaie');
        $('#restant').val(   $('#restant').val()*-1);
        $('#reste').val(0);
    }
})

var reglementTable;
var debiteurTable;



$(function () {
    debiteurTable =   $('#debiteurTable').DataTable({
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
            "sPrint": "Imprimer",
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
        ajax: '/debiteurs',
        "columns": [

            {data: "nom",name : 'nom'},
            {data: "contact",name: 'contact'},
            {data: "adresse",name: 'adresse'},
            {data :  "solde",name : 'solde'},
        ]
    });
});

$("#montantTotal").html( calTotal( $debiteurTable.data() ) );
                    setNumeralHtml("prix", "0,0");

function calTotal(table)
{
    let t = 0;
    for(let i = 0; i < table.length; i++)
    {
        t += table[i].total;
    }
    return t;
}
  
console.log('AZER');

$('#btnreglement').on('click', function(){

    $('.modal-title-user').text('ENREGISTREMENT DU REGLEMENT');
    $('#idreglement').val(null);
    $('#client').val(null);
    $('#btnadd').text('Valider');
    $('#btnadd').removeClass('btn-warning');
    $('#btnadd').addClass('btn-primary');
    $('#total').val(null);
    $('#donne').val(null);
    $('#restant').val(null);
    $('#ajout_reglement').modal('show');
    });
//post des données
$('#ajout_reglement  form').on('submit', function (e) {

    let url,message;
    if (!$('#idreglement').val()){
        url = '/storereglement'
        message = 'reglement enregistré'


    }
    else{
        url = '/updatereglement'
        message = 'reglement modifié'

    }
    e.preventDefault();
    if (e.isDefaultPrevented()){
        $.ajax({
            url : url ,
            type : "post",
            // data : $('#modal-form-user').serialize(),
            data: new FormData($("#ajout_reglement form")[0]),
            //data: new FormData($("#modal-form-user")[0]),
            contentType: false,
            processData: false,
            success : function(data) {

                $('#ajout_reglement').modal('hide');
                sweetToast('success',message);

            //    reglementTable.ajax.reload();
               window.location.reload();
            },
            error : function(data){
              alert('erreur')
            }
        });
    }
});


function editreglement(id){
    $.ajax({
        url : '/showreglement-'+id,
        type : "get",
        success : function(data) {

            $('#idreglement').val(data.id);
            $('#btnadd').text('Modifier');
            $('#btnadd').removeClass('btn-primary');
            $('#btnadd').addClass('btn-warning');
            $('#email').val(data.email);
            $('#contact').val(data.contact);
            $('#sexe').val(data.sexe);
            $('#ajout_reglement').modal('show');

        },
        error : function(data){
alert('erreur')
        }
    });
}


function deletereglement(id){
    Swal.fire({
        position: 'center',
        title: 'Vous etes sûr',
        text:"Pas de retour en arriere",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor:'#3085d6',
        cancelButtonColor:'#d33',
        confirmButtonText:'Oui effacer'
    }).then ((result)=>{
        if (result.value){
            $.ajax({
                url : '/deletereglement-'+id,
                type : "get",
                contentType: false,
                processData: false,
                success : function(data) {
                    Swal.fire('Effacé',
                        'Fichier bien effacé',
                        'success')
                    reglementTable.ajax.reload();
                },
                error : function(data){
                    Swal.fire('Erreur',
                        '...',
                        'warning')
                }
            });

        }
    });
}



