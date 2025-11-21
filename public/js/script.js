const { jsx } = require("react/jsx-runtime");

//============== script for order and invoice ===============
let pName;
let net;
let price;
let total;
let number = 0;
let i = 0;
let sum;
let isHave = false;
let eachPrice;
let overrideItem;
let modal;


function orderProduct(id) {
    fetch(`/product-data/${id}`)
        .then(response => response.json())
        .then(data => {
            pName = data.p_name;
            price = data.p_price;
            document.getElementById('product-title').innerText = data.p_name;
            document.getElementById('modal-body-content').innerHTML =
                `
        <p>តម្លៃ​  <strong>${data.p_price}</strong> រៀល</p>
        <label for="" class="form-label">ចំនួនគីឡូ</label>
        <input type="Number" class="form-control" id="net" placeholder="ឧទាហរណ៍ : 0.5,1,2,3,4">
        <span id="weightStatus"></span>
        `;
            modal = new bootstrap.Modal(document.getElementById('productModal'));
            modal.show();
        });

}
function getUpdateProduct(id) {
    localStorage.setItem('id',id);
    fetch(`/product-data/${id}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('itemName').value=data.p_name;
            document.getElementById('itemPrice').value=data.p_price;
       
        });

}
//------------------------------- update product 
function updateProduct(){
    let id=localStorage.getItem('id');
    let name=document.getElementById('itemName').value;
    let price=document.getElementById('itemPrice').value;
    let data={
        'p_name':name,
        'p_price':price
    }
    
    fetch(`/manageProduct/update/${id}`,{
        method: 'PUT',
        headers:{'Content-type':'application/json',
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body:JSON.stringify(data)
    })
    .then(res=>res.json())
    .then(data=>{
        // alert(data.message);
        // location.reload();
    })
}


window.onload = function () {
    generateInvoicNO();
}
function generateInvoicNO() {
    let date = new Date();
    let year = date.getFullYear().toString().slice(-2);
    let month = String(date.getMonth() + 1).padStart(2, '0');
    let day = String(date.getDate());
    let random = Math.floor(1000 + Math.random() * 9000);
    document.getElementById('invoiceNo').innerText = `${day}${month}${year}-${random}`;
}

function updateClock() {
    let now = new Date();
    let hours = String(now.getHours()).padStart(2, '0');
    let minutes = String(now.getMinutes()).padStart(2, '0');
    let second = String(now.getSeconds()).padStart(2, '0');
    let ampm = (hours >= 12) ? 'PM' : 'AM';
    hours = hours % 12;
    document.getElementById('date').innerText = `${now.getDate()}/${now.getMonth() + 1}/${now.getFullYear()}`;
    document.getElementById('clock').innerText = `${hours}:${minutes}${ampm}`;

}
setInterval(() => {
    updateClock();
}, 1000);
//---------------------- get delete 
function getDelete(id){
    localStorage.setItem('id',id);
    fetch(`/product-data/${id}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('delete-name').innerText= data.p_name;
            console.log(data.p_name);
        });
}
//-------------------- delete product 
function deleteProduct(){
    let id=localStorage.getItem('id');
    fetch(`/manageProduct/delete/${id}`,{
        method:"DELETE",
        headers:{
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(res=>res.json())
    .then(data=>{
        location.reload();
    })
}
function exportInvoice() {
    const element = document.getElementById("invoice");

    const options = {
        margin: 2,
        filename: 'invoice.pdf',
        image: {
            type: 'jpeg',
            quality: 0.98
        },
        html2canvas: {
            scale: 2
        },
        jsPDF: {
            unit: 'mm',
            format: 'a5',
            orientation: 'portrait'
        }
    };

    html2pdf().from(element).set(options).save();
}


function payment() {
    let payment = 0;
    let itemCount;
    let itemPrice;
    let table = document.getElementById('invoice');
    for (item = 1; item < table.rows.length - 1; item++) {
        itemPrice = Number(table.rows[item].cells[2].innerText);
        itemCount = Number(table.rows[item].cells[3].innerText);
        payment += Number(itemCount * itemPrice);

    }
    document.getElementById('sumPrice').innerText = Math.trunc(payment.toFixed(2));
}

function checkItem(itemInList, newItem) {
    if (itemInList == newItem) {
        return true;
    } else {
        return false;
    }

}

function addTable() {
    if (net != 0) {
        // modal = new bootstrap.Modal(document.getElementById('productModal'));
        modal.hide();
        number++;
        let table = document.getElementById('invoice').querySelector('tbody');
        let numRows = document.getElementById('invoice');
        for (s = 1; s < numRows.rows.length; s++) {
            checkItem(numRows.rows[s].cells[1].innerText, pName);
            if (numRows.rows[s].cells[1].innerText == pName) {
                number--;
                let oldNet = Number(numRows.rows[s].cells[3].innerText);
                numRows.rows[s].cells[3].innerText = net + oldNet;
                net = numRows.rows[s].cells[3].innerText;
                overrideItem = net * numRows.rows[s].cells[2].innerText;
                numRows.rows[s].cells[4].innerText = overrideItem;
                isHave = true;
                break;
            } else {
                isHave = false;
            }
        }
        if (isHave == true) {

        } else {
            let newRow = table.insertRow();
            newRow.insertCell(0).innerText = number;
            newRow.insertCell(1).innerText = pName;
            newRow.insertCell(2).innerText = price;
            newRow.insertCell(3).innerText = net;
            newRow.insertCell(4).innerText = total.toFixed(2);
        }
    }
    else {
        let wStatus = document.getElementById('weightStatus');
        wStatus.style.color = "red";
        wStatus.style.fontSize = "14px";
        wStatus.style.fontWeight = "500";
        document.getElementById('net').style.borderColor = "red";
        wStatus.innerText = "សូមធ្វើការបញ្ចូលគីឡូ";

    }

}

function comfirm() {
    net = Number(document.getElementById('net').value);
    total = price * net;
    addTable();
    payment();


}
//=====================end=========================

