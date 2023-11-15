$("#reset").on('click', function(){
    $("#production").val(0);
    $("#debut").val('');
    $("#fin").val('');
    $("#fournisseur").val(0);
    getSum();
});

$("#debut").on('change', function(){
    $("#fin").attr('min', $(this).val());
    getSum();
});

$("#fin").on('change', function(){
    $("#debut").attr('max', $(this).val());
    getSum();
});

function setNumeralHtml(element, format, surfix="", type="html")
{
    var prices = $("."+element);

    for(var i=0; i<prices.length; i++)
    {
        if(type=="html")
        {
            var number = numeral(prices[i].innerText);

            var string = number.format(format);
            prices[i].innerText = string+" "+surfix;
        }else if(type=="value")
        {
            var number = numeral(prices[i].value);

            var string = number.format(format);
            prices[i].value = string+" "+surfix;
        }

    }
  
}

$("#voir").on('click', function(){
    getSum();
});

 
$("#fournisseur").select2( {
    placeholder: "Choisir une boutique",
    allowClear: true
} );
    $("#production").select2( {
        placeholder: "Choisir un produit",
        allowClear: true
    } ); 


$("#production").on('change', function(){
       // alert('SOMME');

    getSum();
});

$("#modeles").select2( {
    placeholder: "Choisir un produit",
    //allowClear: true
} );

$("#categorie").select2( {
    placeholder: "Choisir la catégorie",
    //allowClear: true
} );



$('#categorie').on('change',function ( ) {
    $.ajax({
        url: '/recupererproduit-' + $('#categorie').val(),
        type: "get",
        success: function (data) {
            $('#modeles').empty();
            $('#production').empty();
            $('#modeles').append('<option value=""></option>')

            for (var i = 0; i < data.length; i++) {

                $('#modeles').append('<option value="'+data[i].id+'">'+data[i].nom+'</option>')
            }

        },
        error: function (data) {
            console.log("erreur")
        },
    })
});

$('#modeles').on('change',function ( ) {
    $.ajax({
        url: '/recuperermodele-' + $('#modeles').val(),
        type: "get",
        success: function (data) {
            $('#production').empty();
            $('#production').append('<option value=""></option>')

            for (var i = 0; i < data.length; i++) {

                $('#production').append('<option value="'+data[i].id+'">'+data[i].libelle+'</option>')
            }

        },
        error: function (data) {
            console.log("erreur")
        },
    })
})

$('#fournisseur').on('change',function ( ) {
    $.ajax({
        url: '/recuperermodeleboutiq-' + $('#fournisseur').val(),
        type: "get",
        success: function (data) {
           // alert(data);
            $('#production').empty();
            $('#production').append('<option value=""></option>')

            for (var i = 0; i < data.length; i++) {

                $('#production').append('<option value="'+data[i].id+'">'+data[i].libelle+'</option>')
            }

        },
        error: function (data) {
            console.log("erreur")
        },
    })
}) 


var achatFourniTable;

(function(){
    getTable ();
});

function getTable () {
    achatFourniTable =   $('#achatFourniTable').DataTable({
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
        ajax:{
            url: '/alllivraisonBoutiqhistorique',
            data: {
                'production' : $("#production").val(),
                'fournisseur': $("#fournisseur").val(),
                
                'debut': $("#debut").val(),
                'fin': $("#fin").val(),
            }
        },
        "columns": [
            {data: "date",name : 'date'},
            {data: "nom",name : 'nom'},
            {data: "libelle",name : 'libelle'},
            {data: "quantite",name : 'quantite'},
            {data: "price_unit",name : 'price_unit'},
            {data: "montant",name : 'montant'},
        ]
    });


}

function getSum()
{
    var production = $("#production").val();
    var debut = $("#debut").val();
    var fin = $("#fin").val();
    var fournisseur = $("#fournisseur").val();
    $.ajax({
        url : '/allLivraisonBoutiqhistoriquesum',
        type : "get",
        data: {
            'production':production,
            'fournisseur': fournisseur,
            'debut': debut,
            'fin': fin,
        },
        success : function(data) {
            $("#qteTotal").val(data.quantite);
            $("#montantTotal").val(data.montant);
            setNumeralHtml("prix", "0,0", "", 'value');
            $('#achatFourniTable').DataTable().destroy()
           // alert(data.montant);
            getTable ();
        },
        error : function(data){
            alert('erreur')
        }
    });
}