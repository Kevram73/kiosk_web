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


var inventaireTable;

$( document ).ready(function() {
    var id = $('#cat_id').val();
    console.log({cat_id:id});
    if(id != null)
    {
        if(id == 0)
        {
            $('#inventaireTable').DataTable().destroy()
            $(function () {
                inventaireTable =   $('#inventaireTable').DataTable({
                    processing: true,
                    serverSide: true,
                    select: true,
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

                    sDom: "<'text-right mb-md'T>" + $.fn.dataTable.defaults.sDom,

                    oTableTools: {
                        aButtons: [
                            {
                                sExtends: 'print',
                                sButtonText: 'Print',
                                sInfo: 'Please press CTR+P to print or ESC to quit'
                            }
                        ]
                    },
                    ajax: '/toutinventaire',
                    "columns": [

                        {data: "categorie",name : 'categorie'},
                        {data: "produit",name : 'produit'},
                        {data: "modele",name : 'modele'},
                        {data: "quantite",name : 'quantite'},
                        {data: "action", name : 'action' , orderable: false, searchable: false}

                    ]

                });
            });
        }else{
            $('#inventaireTable').DataTable().destroy()
            $(function () {
                inventaireTable =   $('#inventaireTable').DataTable({
                    processing: true,
                    serverSide: true,
                    select: true,
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

                    sDom: "<'text-right mb-md'T>" + $.fn.dataTable.defaults.sDom,

                    oTableTools: {
                        aButtons: [
                            {
                                sExtends: 'print',
                                sButtonText: 'Print',
                                sInfo: 'Please press CTR+P to print or ESC to quit'
                            }
                        ]
                    },
                    ajax: '/inventairecategorie-'+id,
                    "columns": [

                        {data: "categorie",name : 'categorie'},
                        {data: "produit",name : 'produit'},
                        {data: "modele",name : 'modele'},
                        {data: "quantite",name : 'quantite'},
                        {data: "action", name : 'action' , orderable: false, searchable: false}


                    ]

                });
            });
        }
    }
});


$('#choix').on('change',function ( ) {
    if ($('#choix').val()=="tous"){
        $('#cate').hide();
        $('#inventaireTable').DataTable().destroy()
        $(function () {
            inventaireTable =   $('#inventaireTable').DataTable({
                processing: true,
                serverSide: true,
                select: true,
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

                sDom: "<'text-right mb-md'T>" + $.fn.dataTable.defaults.sDom,

                oTableTools: {
                    aButtons: [
                        {
                            sExtends: 'print',
                            sButtonText: 'Print',
                            sInfo: 'Please press CTR+P to print or ESC to quit'
                        }
                    ]
                },
                ajax: '/toutinventaire',
                "columns": [

                    {data: "categorie",name : 'categorie'},
                    {data: "produit",name : 'produit'},
                    {data: "modele",name : 'modele'},
                    {data: "quantite",name : 'quantite'},
                    {data: "action", name : 'action' , orderable: false, searchable: false}

                ]

            });
        });
    }
    else {
        if ($('#choix').val()==""){
            $('#inventaireTable').DataTable().destroy()
            $('#cate').hide();

        }
        if ($('#choix').val()=="categorie"){
            $('#cate').show();
            $('#inventaireTable').DataTable().destroy()
            $.ajax({
                url: '/recuperercategorie' ,
                type: "get",
                success: function (data) {
                    $('#categorie').empty()
                    $('#categorie').append('<option value=""></option>')

                    for (var i = 0; i < data.length; i++) {
                        $('#categorie').append('<option value="'+data[i].id+'">'+data[i].nom+'</option>')
                    }

                },
                error: function (data) {
                    console.log("erreur")
                },
            })
        }
        $('#categorie').on('change',function ( ) {
            $('#inventaireTable').DataTable().destroy()
            $(function () {
                inventaireTable =   $('#inventaireTable').DataTable({
                    processing: true,
                    serverSide: true,
                    select: true,
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

                    sDom: "<'text-right mb-md'T>" + $.fn.dataTable.defaults.sDom,

                    oTableTools: {
                        aButtons: [
                            {
                                sExtends: 'print',
                                sButtonText: 'Print',
                                sInfo: 'Please press CTR+P to print or ESC to quit'
                            }
                        ]
                    },
                    ajax: '/inventairecategorie-'+ $('#categorie').val(),
                    "columns": [

                        {data: "categorie",name : 'categorie'},
                        {data: "produit",name : 'produit'},
                        {data: "modele",name : 'modele'},
                        {data: "quantite",name : 'quantite'},
                        {data: "action", name : 'action' , orderable: false, searchable: false}


                    ]

                });
            });
        })
    }
})


    var index ,  element=document.getElementById('inventaireTable');


                function correct(id) {
                element.rows[id].style.backgroundColor="blue";


    }

function editinventaire(id){
    $.ajax({
        url: '/showinventaire-'+id,
        type: "get",
        success : function(data) {
            $('.modal-title-user').text('ENREGISTREMENT:'+data[0].categorie+' '+data[0].produit+' '+data[0].modele);
            $('#btnadd').text('Valider');
            $('#btnadd').removeClass('btn-warning');
            $('#btnadd').addClass('btn-primary');
            $('#quantite').val(data[0].quantite);
            $('#id').val(data[0].id);
            $('#quantiteR').val(null);
            $('#inventaire').modal('show');
        },
        error : function(data){
            sweetToast('Une erreur c\'est produite. Veuillez recommancer')
        }
    })

}



    $('#inventaire  form').on('submit', function (e) {

        let url,message, id;
        id = $('#_id').val();
        url = '/updateinventaire-'+id,
            message = 'Quantité mise a jour'
        e.preventDefault();
        if (e.isDefaultPrevented()){
            $.ajax({
                url : url ,
                type : "post",
                // data : $('#modal-form-user').serialize(),
                data: new FormData($("#inventaire form")[0]),
                //data: new FormData($("#modal-form-user")[0]),
                contentType: false,
                processData: false,
                success : function(data) {
                    $('#inventaire').modal('hide');
                    sweetToast('success',message);
                    inventaireTable.ajax.reload();
                    element.rows[i].style.backgroundColor="blue";
                    },
                error : function(data){
                    alert('erreur')
                }
            });
        }

    });


for (var i=1; i<element.rows.length; i++){
}



$('#fermer').on('click', function () {
    Swal.fire({
        position: 'center',
        title: 'Voulez-vous valider et fermer  l\'inventaire ?',
        text:"",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor:'#3085d6',
        cancelButtonColor:'#d33',
        confirmButtonText:'Oui '
    }).then ((result)=>{
        var id = $('#_id').val();
        var obs = $('#obs').val();
        if (result.value){
            $.ajax({
                url : '/fermerinventaire-'+id,
                type : "get",
                data: {'obs':obs},
                success : function(data) {
                    Swal.fire('Effectué',
                    'Inventaire bien fermé');
                    window.location='/inventaire'
                },
                error : function(data){
                }
            });


        }
    });
})








