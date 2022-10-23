var $table
var $table2
$('.marque2').on('change',function ( ) {
    $.ajax({
        url: '/recuperer_modele-' + $('.marque2').val(),
        type: "get",
        success: function (data) {
            $('.modele2').empty();
            $('.piece').empty();

            for (var i = 0; i < data.length; i++) {

                $('.modele2').append('<option value="'+data[i].id+'">'+data[i].nom+'</option>')
            }

        },
        error: function (data) {
            console.log("erreur")
        },
    })
})



$('.modele2').on('change',function ( ) {
    $.ajax({
        url: '/recuperer_magasinPiece-' + $('.modele2').val(),
        type: "get",
        success: function (data) {
            $('.piece').empty();
            for (var i = 0; i < data.length; i++) {

                $('.piece').append('<option value="'+data[i].id+'">'+data[i].nom+'</option>')
            }

        },
        error: function (data) {
        },
    })
})
$('.piece').on('change',function ( ) {
    $('.prixPiece').val(null)
    $('.prixPiece').empty()
    if ($('.piece').val() == ''){
        return null
    } else {

        $.ajax({
            url: '/recupePrix/' + $('.piece').val(),
            type: "get",
            success: function (data) {

                $('.prixPiece').val(data.prix)

            },
            error: function (data) {
                console.log("erreur")
            },
        })
    }
})


 $(function( ) {

	'use strict';

	var datatableInit = function() {

        $table2 = $('.prevente_table').DataTable({
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': false,
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
                { data: 'piece' },
                { data: 'prix' },
                { data: 'quantite' },
                { data: 'total' },
                {data:'action', orderable: false, searchable: false}
            ]


		});

	};

	$(function() {
		datatableInit();
	});

})

$('.ajout').on('click',function () {
    if($('.piece').val()  ===''  ||  $('.prixPiece').val() ==null  ||  $('.quantite').val() <= 0 || $('.quantite').val()  ==''  ){
        return null

    }else{

        var dEmporte , position
        let trouveEmporte = false;
        for(let i = 0; i <  $table2.data().length; i++){
            let  data = $table2.data()[i]
            if (data.id == $('.piece').val()) {
                trouveEmporte = true;
                position = i;
            }
        }

        if ( trouveEmporte === false) {
var d=document.getElementById('piece')
            var texte=d.options[d.selectedIndex].text;
            $table2.row.add({
                "id": $('.piece').val(),
                "piece": texte,
                "prix": $('.prixPiece').val(),
                "quantite": $('.quantite').val(),
                "total": $('.prixPiece').val() * $('.quantite').val(),
                "action": '<a><i class="fa fa-minus"  id="supp"></i></a>'
        }).draw()

        }else{
            $table2.data()[position].quantite = parseInt( $table2.data()[position].quantite) + parseInt( $('.quantite').val()) ;

            $table2.data()[position].total = $table2.data()[position].quantite * $table2.data()[position] .prix;

            $table2 .row().data($table2.data()[position]).draw();

            trouveEmporte = true;
        }

        {

        }
    }
})

$('.valider').on('click',function (e) {

    e.preventDefault()

    if ($table2.data().length <= 0 ){
        return null;
    }else{
        let content =''
        for(let i = 0; i <  $table2.data().length; i++){
            if (i!=$table2.data().length-1){
                content += $table2.data()[i].id+","+ $table2.data()[i].quantite+","+ $table2.data()[i].total+","
            }else{
                content += $table2.data()[i].id+","+ $table2.data()[i].quantite+","+ $table2.data()[i].total
            }
        }

        $('.preventeTable').val(content)

        $.ajax({
            url :'storeVente',
            type : "post",
            // data : $('#modal-form-user').serialize(),
            data: new FormData($("#ajout_quartier form")[0]),
            //data: new FormData($("#modal-form-user")[0]),
            contentType: false,
            processData: false,
            success : function(data) {


            },
            error : function(data){


            }
        });

    }

})



$('.marque').on('change',function ( ) {
        $.ajax({
            url: '/recuperer_modele-' + $('.marque').val(),
            type: "get",
            success: function (data) {
                $('.modele').empty();
                $('.piece').empty();

                for (var i = 0; i < data.length; i++) {
                    $('.modele').append('<option value="'+data[i].id+'">'+data[i].nom+'</option>')
                }

            },
            error: function (data) {
                console.log("erreur")
            },
        })
})

$('.modele').on('change',function ( ) {
    $.ajax({
        url: '/recuperer_piece-' + $('.modele').val(),
        type: "get",
        success: function (data) {
            $('.piece').empty();
            for (var i = 0; i < data.length; i++) {

                $('.piece').append('<option value="'+data[i].id+'">'+data[i].nom+'</option>')
            }

        },
        error: function (data) {
            console.log("erreur")
        },
    })
})



$('.service').on('change',function ( ) {
    $('.prix').val(null)
    if ($('.service').val() == ''){
        return null
    } else {

        $.ajax({
            url: '/recupePrix-' + $('.service').val(),
            type: "get",
            success: function (data) {

                $('.prix').val(data.prix)

            },
            error: function (data) {
                console.log("erreur")
            },
        })
    }
})

$(function( ) {

    'use strict';

    var datatableInit = function() {

        $table = $('.prestation_table').DataTable({
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': false,
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
                { data: 'service' },
                { data: 'prix' },
                { data: 'employer' },
                {data:'action', orderable: false, searchable: false}
            ]


        });

    };

    $(function() {
        datatableInit();
    });

})
$('.ajouter').on('click',function () {
    if($('.service').val()  ===''  ||  $('.prix').val() ==null  ||  $('.employer').val() <= 0  ){
        return null
    }else{

        var dEmporte , position
        let trouveEmporte = false;
        for(let i = 0; i <  $table.data().length; i++){
            let  data = $table.data()[i]
            if (data.id == $('.service').val()) {
                trouveEmporte = true;
                position = i;
            }
        }

        if ( trouveEmporte === false) {
            var d=document.getElementById('service')
            var b=document.getElementById('employe')
            var texte=d.options[d.selectedIndex].text;
            var emp=b.options[b.selectedIndex].text;

            $table.row.add({
                "id": $('.service').val(),
                "idEmp":$('.employer').val(),
                "service":texte,
                "prix": $('.prix').val(),
                "employer": emp,
                "action": '<a><i class="fa fa-minus"  id="supp"></i></a>'
            }).draw()

        }
    }

})

$('.valide').on('click',function (e) {

    e.preventDefault()

    if ($table.data().length <= 0 ){
        return null;
    }else{
        let content =''
        for(let i = 0; i <  $table.data().length; i++){
            if (i!=$table.data().length-1){
                content +=   $table.data()[i].id+","+ $table.data()[i].prix+","+ $table.data()[i].idEmp+","
            }else{
                content +=  $table.data()[i].id+","+ $table.data()[i].prix+","+ $table.data()[i].idEmp+","
            }
        }
        $('.prestationTable').val(content)
        $.ajax({
            url :'storePrestation',
            type : "post",
            // data : $('#modal-form-user').serialize(),
            data: new FormData($("#ajout_prestation form")[0]),
            //data: new FormData($("#modal-form-user")[0]),
            contentType: false,
            processData: false,
            success : function(data) {

            },
            error : function(data){

            }
        });

    }

})




