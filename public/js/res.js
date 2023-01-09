let code = document.querySelector('#code')
let artTab = document.querySelector('#tab2')
let data;

code.addEventListener('mouseleave', function () {
    if (code.value != "") {
        artTab.disabled = false
    } else {
        artTab.disabled = true
    }
})

code.addEventListener('change', function () {
    let id = code.value
    $.ajax({
        type: 'GET',
        dataType: "json",
        data: {
            id: id
        },
        url : '/reception-commande',
        success: function(response){
            console.log(response.commandes);
            data = ""
            let i = 1
            let products = new Array()
            $.each(response.commandes, function (key, item) {
                let new_data = {
                    designation: item.designation,
                    quantite: item.pivot.quantite,
                    remise: item.pivot.remise,
                    remise_utilisateur: item.pivot.remise_utilisateur,
                    quantite_reception: item.pivot.quantite_reception
                }

                products.push(new_data)

                data += `
                    <tr>
                        <td id="id"><span class="iconAct" id="btt${i}"><i class='bx bx-label'></i></span></td>
                        <td id="id">${item.designation}</td>
                        <input type='hidden' name='des[${i - 1}]' id='des[${i - 1}]' value='${item.designation}'>
                        <td id="id">${item.pivot.quantite}</td>
                        <input type='hidden' name='q[${i - 1}]' id='q[${i - 1}]' value='${item.pivot.quantite}'>
                        <td id="id">${item.pivot.remise}</td>
                        <input type='hidden' name='ra[${i - 1}]' id='ra[${i - 1}]' value='${item.pivot.remise}'>
                        <td id="id">${item.pivot.remise_utilisateur}</td>
                        <input type='hidden' name='ru[${i - 1}]' id='ru[${i - 1}]' value='${item.pivot.remise_utilisateur}'>
                        <td style='text-align: center;' id='switch[${i - 1}]'>${item.pivot.quantite_reception}</td>
                        <input type='hidden' name='qr[${i - 1}]' id='qr[${i - 1}]' value='${item.pivot.quantite_reception}'>
                        <input type='hidden' name='pivot_id[${i - 1}]' id='pivot_id[${i - 1}]' value='${item.pivot.id}'>
                `
                i++
            })
            data += `<input type='hidden' id='size' value='${i - 1}'></tr>`
            $('#show').html(data)

            let size = document.getElementById('size').value

            for (let j = 1; j <= size; j++) {
                document.getElementById(`btt${j}`).addEventListener('click', function () {
                    let index = j;
                    des = document.getElementById(`des[${index - 1}]`).value
                    input = `<span>Quantite Reception de ${des}: </span>
                    <input id="new" name="" type="text" class="form-control" value="" placeholder="Quantite reception">
                    `

                    $('#inp').html(input)

                    document.getElementById('new').addEventListener('keypress', function (event) {
                        if (event.keyCode == 32) {
                            if (document.getElementById('new').value != "" && !isNaN(document.getElementById('new').value)) {
                                let qr = parseInt(document.getElementById('new').value)
                                $('#inp').html("")

                                let prev = products[index - 1]['quantite_reception']
                                let check = prev + qr
                                if (check <= products[index - 1]['quantite']) {
                                    products[index - 1]['quantite_reception'] += qr
                                    document.getElementById(`switch[${j - 1}]`).innerHTML = products[index - 1]['quantite_reception']
                                    document.getElementById(`qr[${j - 1}]`).value = products[index - 1]['quantite_reception']
                                }
                            }
                        }
                    })
                })
            }
        },
    });
})

$('#myModal').on('shown.bs.modal', function () {
    $('#myInput').trigger('focus')
})


