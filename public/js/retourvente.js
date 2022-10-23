$('#info').on('click', function(){

    $('.modal-title-user').text('LISTE DES PRODUITS A APPROVISIONNER');
    $('#infoproduit').modal('show');
});
$('#credit').on('click', function(){

    $('.modal-title-user').text('LISTE DES CREANCIERS');
    $('#infocredit').modal('show');
});

var $table2


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




$('#vente').on('change',function ( ) {
    $.ajax({
        url: '/recupererventemodele-' + $('#vente').val(),
        type: "get",
        success: function (data) {
            $('#quantite').empty();
            $('#produit').empty();
            $('#produit').append('<option value=""></option>')

            for (var i = 0; i < data.length; i++) {
                $('#produit').append('<option value="'+data[i].id+'">'+data[i].produit+"-"+data[i].modele+'</option>')
                // if (data[i].etat==true){
                //     $('#produit').append('<option value="'+data[i].id+'">'+data[i].produit+"-"+data[i].modele+'</option>')
                // }
            }
        },
        error: function (data) {
            console.log("erreur")
        },
    })
})
$('#produit').on('change',function ( ) {
    $.ajax({
        url: '/retoureventeverification-' + $('#produit').val(),
        type: "get",
        success: function (data) {
            $('#quant').val(data);
        },
        error: function (data) {
            console.log("erreur")
        },
    })
})



$(function( ) {

    'use strict';

    var datatableInit = function() {

        $table2 = $('#retourTable').DataTable({
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': false,
            select: true,
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
            data : [],
            columns: [
                { data: 'id' },
                { data: 'produit' },
                { data: 'quantite' },
                { data: 'payer' },
                { data: 'rayon' },
            ]


        });

    };

    $(function() {
        datatableInit();
    });

})
$('#ajout').on('click',function () {
    let message,quantite;

        $.ajax({
            url: '/retoureventeverification-' + $('#produit').val(),
            type: "get",
            success: function (data) {
                if($('#quantite').val().length <= 0) return;
                quantite= parseInt($('#quantite').val())-data
                if ( quantite>0){
                    message='La quantité saisie est supérieure a la celle commandée ou restante...'
                    sweetToast('warning',message);
                }
                else {
                    var dEmporte , position
                    let trouveEmporte = false;
                    for(let i = 0; i <  $table2.data().length; i++){
                        let  data = $table2.data()[i]
                        if (data.id == $('#produit').val()) {
                            trouveEmporte = true;
                            position = i;
                        }
                    }


                    if ( trouveEmporte === false) {
                        var d=document.getElementById('produit')
                        var produit=d.options[d.selectedIndex].text;
                        $table2.row.add({
                            "id":$('#produit').val(),
                            "produit": produit,
                            "quantite": $('#quantite').val(),
                            "payer": $('#payer').is(":checked") ? "OUI" : "NON",
                            "rayon": $('#rayon').is(":checked") ? "OUI" : "NON"
                        }).draw()

                        $('#quantite').val(null);

                    }else{
                        $table2.data()[position].quantite = parseInt( $('#quantite').val());
                        $table2.data()[position].payer = $('#payer').is(":checked") ? "OUI" : "NON";
                        $table2.data()[position].rayon = $('#rayon').is(":checked") ? "OUI" : "NON";

                        $table2 .row().data($table2.data()[position]).draw();

                        trouveEmporte = true;

                    }
                }
            },
            error: function (data) {
                console.log("erreur")
            },
        })


        {

        }

})
$('#annuler').on('click',function () {
  let  message='Annuler'
    sweetToast('warning',message);


    $('#quantite').val(null);
})
$('#valider').on('click',function (e) {

    e.preventDefault()

    if ($table2.data().length <= 0 ){
        let message;
        message='Impossible ... Tableau vide!!!'
        sweetToast('warning',message);
    }else{
        let content =''
        for(let i = 0; i <  $table2.data().length; i++){
            if (i!=$table2.data().length-1){
                content +=   $table2.data()[i].id+","+  $table2.data()[i].quantite+","+$table2.data()[i].payer+ ","+ $table2.data()[i].rayon+","

            }else{
                content +=  $table2.data()[i].id+","+  $table2.data()[i].quantite+","+$table2.data()[i].payer+ ","+ $table2.data()[i].rayon


            }
        }
        $('#retTable').val(content)
        $.ajax({
            url :'storeretourevente-'+$('#vente').val(),
            type : "post",
            // data : $('#modal-form-user').serialize(),
            data: new FormData($("#retform form")[0]),
            //data: new FormData($("#modal-form-user")[0]),
            contentType: false,
            processData: false,
            success : function(data) {
            let message='Retour vente enregistrée';
                sweetToast('success',message);
                window.location='/detailvente-'+$('#vente').val();
            },
            error : function(data){

            }
        });
    }

})

var index;

$('#retourTable tbody').on( 'click', 'tr', function () {
    if ( $(this).hasClass('selected') ) {
        $(this).removeClass('selected');
    }
    else {
        $table2.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');
        index=$table2.row('.selected').index()
    }
} );

$('#sup').on('click',function () {
    let  message='Supprimer'
    $table2.row('.selected').remove().draw( false );
    sweetToast('success',message);
})
