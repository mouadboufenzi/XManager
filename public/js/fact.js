let code = document.getElementById('code')
let mt = document.getElementById('mt')
let size = document.getElementById('size')

code.addEventListener('change', function(){
    if (code.value != "") {
        $.ajax({
            type: "GET",
            url: "/facture-total",
            data: {
                id: code.value,
            },
            dataType: "json",
            success: function (response) {
                mt.value = response.reception[0].total;
            }
        });
    }
})

if (size.value != 0) {
    for (let i = 0; i < size.value; i++) {
        document.getElementById(`fact${i}`).addEventListener('click', function () {
            document.getElementById('tab1').checked = false
            document.getElementById('tab2').checked = true

            let id_facture = document.getElementById(`id${i}`).value
            $.ajax({
                type: "get",
                url: "/create-facture",
                data: {
                    id: id_facture
                },
                dataType: "json",
                success: function (response) {
                    console.log(response.articles);

                    document.getElementById('num').innerHTML = response.num_facture
                    document.getElementById('code_rec').innerHTML = response.code_reception
                    document.getElementById('date_rec').innerHTML = response.date_reception
                    document.getElementById('code_cmd').innerHTML = response.code_commande
                    document.getElementById('date_cmd').innerHTML = response.date_commande
                    document.getElementById('code_four').innerHTML = response.code_fournisseur

                    data = ""
                    $.each(response.articles, function (key, item) {
                        data += `
                            <tr>
                                <td id='id'>${item.designation}</td>
                                <td id='id'>${item.pa} Dhs</td>
                                <td id='id'>${item.pivot.quantite}</td>
                                <td id='id'>${item.pivot.prix_net} Dhs</td>
                                <td id='id'>${item.pivot.total} Dhs</td>
                            </tr>
                        `
                    });
                    data += ``
                    $('#show').html(data)
                }
            });
        })
    }
}