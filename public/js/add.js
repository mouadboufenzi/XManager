let products = new Array()
let data = "";
let up_products = new Array()
let code = document.getElementById('code')
let rm = document.getElementById('rm')


code.addEventListener('change', function () {
    if (code.value != "") {
        $.ajax({
            type: "get",
            url: "/get-remise",
            data: {
                code: code.value
            },
            dataType: "json",
            success: function (response) {
                console.log()
                $.each(response.fournisseur, function (key, item) {
                    data = ""
                    data = `<option value="${item.remise_1}">${item.remise_1}</option>`
                    if (item.remise_2 != null) data += `<option value="${item.remise_2}">${item.remise_2}</option>`
                    if (item.remise_3 != null) data += `<option value="${item.remise_3}">${item.remise_3}</option>`
                    rm.value = item.remise_1
                });
                $('#rm').html(data)
            }
        });
    }
})

if (document.getElementById('size') != null) {
    let size = document.getElementById('size').value
    for (let j = 0; j < size; j++) {
        let up_data = {
            "id" : document.getElementById(`des${j}`).value,
            "quantite" : document.getElementById(`q${j}`).value,
            "remise_article" : document.getElementById(`ra${j}`).value,
            "remise_utilisateur" : document.getElementById(`ru${j}`).value,
        }
        up_products.push(up_data);
    }
}

document.querySelector("#tab3").addEventListener('click', function () {
    if (document.getElementById('rm').value == "") {
        document.getElementById('remise_article').value = 0
    } else {
        document.getElementById('remise_article').value = document.getElementById('rm').value
    }
})

function validation(id, quantite, ru, rm) {
    return id != "" && quantite != "" && !isNaN(quantite)
        && ru != "" && !isNaN(ru)
        && rm != "" && !isNaN(rm)
}

document.querySelector("#sub").addEventListener('click', function () {
    let id = document.getElementById('designation').value
    let quantite = document.getElementById('quantite').value
    let remise_article = document.getElementById('remise_article').value
    let remise_utilisateur = document.getElementById('remise_utilisateur').value

    if (validation(id, quantite, remise_utilisateur, remise_article)) {
        let new_data = {
            "id" : id,
            "quantite" : quantite,
            "remise_article" : remise_article,
            "remise_utilisateur" : remise_utilisateur,
        }
    
        products.push(new_data)
    
        data = ""
        let i = 0;
    
        products.map(product => {
            console.log(product);
            data += `
                <tr>
                    <td id="id" >${product['id']}</td>
                    <input id="des[]" type="hidden" name='d[]' value="${product['id']}">
                    <td id="id" >${product['quantite']}</td>
                    <input id="quantite[]" type="hidden" name='q[]' value="${product['quantite']}">
                    <td id="id" >${product['remise_article']}</td>
                    <input id="ra[]" type="hidden" name='ra[]' value="${product['remise_article']}">
                    <td id="id" >${product['remise_utilisateur']}</td>
                    <input id="ru[]" type="hidden" name='ru[]' value="${product['remise_utilisateur']}">
                    <td id="id"><span onclick='del(${i})' class="iconAct"><i class='bx bxs-trash'></i></span></td>
                </tr>
            `;
            i++
        })
        
        document.getElementById('show').innerHTML = "";
        document.getElementById('show').innerHTML = data;
    
        document.getElementById('id').value = document.getElementById('quantite').value = ""
        document.getElementById('remise_utilisateur').value = "";
    } else {
        alert('Empty or Incorrect format !')
    }
})

function delUp(index) {
    up_products.splice(index)
    console.log(up_products);

    data = ""
    let i = 0;

    up_products.map(product => {
        data += `
        <tr>
            <td id="id" >${product['id']}</td>
            <input id="des${i}" type="hidden" name='d[]' value="${product['id']}">
            <td id="id" >${product['quantite']}</td>
            <input id="q${i}" type="hidden" name='q[]' value="${product['quantite']}">
            <td id="id" >${product['remise_article']}</td>
            <input id="ra${i}" type="hidden" name='ra[]' value="${product['remise_article']}">
            <td id="id" >${product['remise_utilisateur']}</td>
            <input id="ru${i}" type="hidden" name='ru[]' value="${product['remise_utilisateur']}">
            <td id="id"><span onclick='delUp(${i})' class="iconAct"><i class='bx bxs-trash'></i></span></td>
        </tr>
        `;
        i++
    })
    data += `<input type="hidden" id="size" value="${i}"></input>`
    
    document.getElementById('show').innerHTML = "";
    document.getElementById('show').innerHTML = data;
}


function del(index) {
    products.splice(index)

    data = ""
    let i = 0;

    products.map(product => {
        console.log(product);
        data += `
            <tr>
                <td id="id" >${product['id']}</td>
                <input type="hidden" name='designation[]' value="${product['id']}">
                <td id="id" >${product['quantite']}</td>
                <input type="hidden" name='quantite[]' value="${product['quantite']}">
                <td id="id" >${product['remise_article']}</td>
                <input type="hidden" name='remise_article[]' value="${product['remise_article']}">
                <td id="id" >${product['remise_utilisateur']}</td>
                <input type="hidden" name='remise_utilisateur[]' value="${product['remise_utilisateur']}">
                <td id="id" id="id"><span onclick='del(${i})' class="iconAct"><i class='bx bxs-trash'></i></span></td>
            </tr>
        `;
        i++
    })
    
    document.getElementById('show').innerHTML = "";
    document.getElementById('show').innerHTML = data;
}
