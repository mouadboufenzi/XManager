let products = new Array()
let sub = document.getElementById('sub')
let des = document.getElementById('designation')
let date = document.getElementById('date').value
let data = ""

function in_array (arr, item) {
    for (let i = 0; i < arr.length; i++) {
        if (arr[i]['designation'] == item) return false
    }
    return true
}

sub.addEventListener('click', function () {  
    if (des.value != "") {
        let new_data = {
            designation: des.value,
            quantite: 0,
            date: date
        }

        console.log(in_array(products, new_data['designation']));

        if (in_array(products, new_data['designation'])) {
            products.push(new_data)
            data = ""
            products.map(product => {
                data += `
                    <tr>
                        <td id='id'>${product['designation']}</td>
                        <input id='des[]' name='des[]' type="hidden" value='${product['designation']}'>
                        <td id='id'>${product['quantite']}</td>
                        <input id='q[]' name='q[]' type="hidden" value='${product['quantite']}'>
                        <td id='id'>${product['date']}</td>
                        <input id='date[]' name='date[]' type="hidden" value='${product['date']}'>
                    </tr>
                `
            })
        }
        $('#show').html(data)
    }
})