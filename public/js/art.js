// console.log('rrr');
let code = document.querySelector('#code')
let categorie = document.querySelector('#categorie')
let status = document.querySelector('#status')
let des = document.querySelector('#des')
let data = ""

code.addEventListener('keyup', function (event) {
    var charCode = event.keyCode;
    if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || charCode == 8 || (charCode > 47 && charCode < 58) ) {
            console.log(code.value);
            $.ajax({
                type: "GET",
                url: "/article-code",
                data: {
                    article: code.value
                },
                dataType: "json",
                success: function (response) {
                    data = ""
                    let i = 1
                    $.each(response.arts, function (key, item) { 
                        data += "<tr>" +
                            "<td id='id'><a href='/articles/"+ item.id +"'>"+ i +"</a></td>" +
                            "<td id='id'>" + item.code +"</td>" +
                            "<td id='id'>" + item.designation +"</td>" +
                            "<td id='id'>" + item.categorie +"</td>" +
                            "<td id='id'><span id='" + ((item.status == 'Actif') ? 'g' : 'r') +"'>" + item.status +"</span></td>" +
                            "<td id='id'>" + item.pv +"</td> </tr>"
                        i++
                    });
                    $('#show').html(data)
                }
            });
    }
})

des.addEventListener('keyup', function (event) {
    var charCode = event.keyCode;
    if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || charCode == 8 || (charCode > 47 && charCode < 58) ) {
            console.log(des.value);
            $.ajax({
                type: "GET",
                url: "/article-designation",
                data: {
                    des: des.value
                },
                dataType: "json",
                success: function (response) {
                    data = ""
                    let i = 1
                    $.each(response.arts, function (key, item) { 
                        data += "<tr>" +
                            "<td id='id'><a href='/articles/"+ item.id +"'>"+ i +"</a></td>" +
                            "<td>" + item.code +"</td>" +
                            "<td>" + item.designation +"</td>" +
                            "<td>" + item.categorie +"</td>" +
                            "<td id='id'><span id='" + ((item.status == 'Actif') ? 'g' : 'r') +"'>" + item.status +"</span></td>" +
                            "<td id='id'>" + item.pv +"</td> </tr>"
                        i++
                    });
                    $('#show').html(data)
                }
            });
    }
})

categorie.addEventListener('change', function () {
    if (categorie.value != "") {
        console.log(categorie.value)
        $.ajax({
            type: "get",
            url: "/article-categorie",
            data: {
                categorie: categorie.value
            },
            dataType: "json",
            success: function (response) {
                data = ""
                    let i = 1
                    $.each(response.arts, function (key, item) { 
                        data += "<tr>" +
                            "<td id='id'><a href='/articles/"+ item.id +"'>"+ i +"</a></td>" +
                            "<td>" + item.code +"</td>" +
                            "<td>" + item.designation +"</td>" +
                            "<td>" + item.categorie +"</td>" +
                            "<td id='id'><span id='" + ((item.status == 'Actif') ? 'g' : 'r') +"'>" + item.status +"</span></td>" +
                            "<td id='id'>" + item.pv +"</td> </tr>"
                        i++
                    });
                $('#show').html(data)
            }
        });
    }
})

status.addEventListener('change', function () {
    if (status.value != "") {
        console.log(categorie.value)
        $.ajax({
            type: "get",
            url: "/article-status",
            data: {
                status: status.value
            },
            dataType: "json",
            success: function (response) {
                data = ""
                    let i = 1
                    $.each(response.arts, function (key, item) { 
                        data += "<tr>" +
                            "<td id='id'><a href='/articles/"+ item.id +"'>"+ i +"</a></td>" +
                            "<td>" + item.code +"</td>" +
                            "<td>" + item.designation +"</td>" +
                            "<td>" + item.categorie +"</td>" +
                            "<td id='id'><span id='" + ((item.status == 'Actif') ? 'g' : 'r') +"'>" + item.status +"</span></td>" +
                            "<td id='id'>" + item.pv +"</td> </tr>"
                        i++
                    });
                $('#show').html(data)
            }
        });
    }
})