let code = document.getElementById('code')
let nom = document.getElementById('nom')
let status = document.getElementById('status')
let data = ""

code.addEventListener('keyup', function (event) {
    var charCode = event.keyCode;
    if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || charCode == 8 || (charCode > 47 && charCode < 58) ) {
        console.log(code.value);
        $.ajax({
            type: "GET",
            url: "/fournisseur-code",
            data: {
                fournisseur: code.value
            },
            dataType: "json",
            success: function (response) {
                console.log(response.fournisseurs);
                data = ""
                let i = 1
                $.each(response.fournisseurs, function (key, item) { 
                    data += "<tr>" +
                        "<td id='id'><a href='/fournisseurs/"+ item.id +"'>"+ i +"</a></td>" +
                        "<td id='id'>" + item.code +"</td>" +
                        "<td id='id'>" + item.nom +"</td>" +
                        "<td id='id'><span id='" + ((item.status == 'Actif') ? 'g' : 'r') +"'>" + item.status +"</span></td>" +
                    i++
                });
                $('#show').html(data)
            }
        });
    }
})

nom.addEventListener('keyup', function (event) {
    var charCode = event.keyCode;
    if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || charCode == 8 || (charCode > 47 && charCode < 58) ) {
            console.log(nom.value);
            $.ajax({
                type: "GET",
                url: "/fournisseur-nom",
                data: {
                    nom: nom.value
                },
                dataType: "json",
                success: function (response) {
                    console.log(response.fournisseurs);
                    data = ""
                    let i = 1
                    $.each(response.fournisseurs, function (key, item) { 
                        data += "<tr>" +
                            "<td id='id'><a href='/fournisseurs/"+ item.id +"'>"+ i +"</a></td>" +
                            "<td>" + item.code +"</td>" +
                            "<td>" + item.nom +"</td>" +
                            "<td id='id'><span id='" + ((item.status == 'Actif') ? 'g' : 'r') +"'>" + item.status +"</span></td>" +
                        i++
                    });
                    $('#show').html(data)
                }
            });
    }
})

status.addEventListener('change', function () {
    if (status.value != "") {
        $.ajax({
            type: "get",
            url: "/fournisseur-status",
            data: {
                status: status.value
            },
            dataType: "json",
            success: function (response) {
                    data = ""
                    let i = 1
                    $.each(response.fournisseurs, function (key, item) { 
                        data += "<tr>" +
                            "<td id='id'><a href='/clients/"+ item.id +"'>"+ i +"</a></td>" +
                            "<td>" + item.code +"</td>" +
                            "<td>" + item.nom +"</td>" +
                            "<td id='id'><span id='" + ((item.status == 'Actif') ? 'g' : 'r') +"'>" + item.status +"</span></td>" +
                        i++
                    });
                    $('#show').html(data)
                }
        });
    }
})