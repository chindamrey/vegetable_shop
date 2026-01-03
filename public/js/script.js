// const { default: axios } = require("axios");

// const { default: axios } = require("axios");

let pName;
let productId;
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
let pay;
let itemSale = [];
let invoice = [];

//------------------------------------- load invoice info -------------------------------
fetch(`/invoiceInfo`)
    .then(res => res.json())
    .then(data => {
        data.forEach(element => {
            document.getElementById('invoiceTitle').innerText = element.name;
            document.getElementById('invoiceDescription').innerText = element.description;
            document.getElementById('invoicePhoneNumber').innerText = element.phone_number;
        });
    })
//-------------------------------------- get all invoice --------------------------------

function orderProduct(id) {
    fetch(`/product-data/${id}`)
        .then(response => response.json())
        .then(data => {
            pName = data.p_name;
            price = data.p_price;
            productId = data.id;
            document.getElementById('product-title').innerText = data.p_name;
            document.getElementById('productPrice').innerHTML = data.p_price;
        });

}
//---------------------------------------- create product --------------------------------
async function createProduct() {
    loadingToast();
    // alert();
    event.preventDefault();
    let data = {
        p_name: document.getElementById('pName').value,
        p_price: document.getElementById('pPrice').value
    }
    console.log(data);
    await fetch(`/manageProduct/create`, {
        method: "post",
        headers: {
            'Content-type': 'application/json',
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(data)
    })
        .then(res => res.json())
        .then(data => {
            document.getElementById('pName').value=null;
            document.getElementById('pPrice').value=null;
            Swal.close();
            toastSuccess(data.message);
            
            // console.log(data.message);
        })
}
//------------------------------ get update product id ---------------------------------
async function getUpdateProduct(id) {

    localStorage.setItem('id', id);
    await fetch(`/product-data/${id}`)
        .then(response => response.json())
        .then(data => {

            document.getElementById('itemName').value = data.p_name;
            document.getElementById('itemPrice').value = data.p_price;

        });

}
//------------------------------- update product ----------------------------------------
async function updateProduct() {
    loadingToast();
    let id = localStorage.getItem('id');
    let name = document.getElementById('itemName').value;
    let price = document.getElementById('itemPrice').value;
    let data = {
        'p_name': name,
        'p_price': price
    }

    await fetch(`/manageProduct/update/${id}`, {
        method: 'PUT',
        headers: {
            'Content-type': 'application/json',
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(data)
    })
        .then(res => res.json())
        .then(data => {
            Swal.close();
            toastSuccess(data.message);
            // alert(data.message);
            // location.reload();
        })
}
//------------------------------------------ sale product -----------------------------------
function saleProduct() {
    fetch('/index/sale', {
        method: "post",
        headers: {
            'Content-Type': 'application/json',
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(itemSale)
    })
        .then(res => res.json())
        .then(data => {
            alert();
            console.log(data);
            invoiceHeader(pay);
        })
}
//----------------------------------------- data and time ------------------------------------
function dateTime() {
    let now = new Date();
    let hours = String(now.getHours()).padStart(2, '0');
    let minutes = String(now.getMinutes()).padStart(2, '0');
    let ampm = (hours >= 12) ? 'រសៀល' : 'ព្រឹក';
    hours = hours % 12;
    return `${now.getDate()}/${now.getMonth() + 1}/${now.getFullYear()} ${hours}:${minutes} ${ampm}`;
}
//-----------------------------------------update time come to current time -------------------
document.getElementById('time').innerHTML = (`${dateTime()}`);
setInterval(() => {
    document.getElementById('time').innerHTML = (`${dateTime()}`);
}, 60000);
//----------------------------------------------- get delete -----------------------------------
async function getDelete(id) {

    localStorage.setItem('id', id);
    await fetch(`/product-data/${id}`)
        .then(response => response.json())
        .then(data => {

            document.getElementById('delete-name').innerText = data.p_name;
            console.log(data.p_name);
        });
}
//--------------------------------------------- delete product ----------------------------------
async function deleteProduct() {
    loadingToast();
    let id = localStorage.getItem('id');
    await fetch(`/manageProduct/delete/${id}`, {
        method: "DELETE",
        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
        .then(res => res.json())
        .then(data => {
            getAllProduct();
            Swal.close();
            toastSuccess(data.message);
        })
}
//---------------------------------------------- custom invoice ----------------------------------
function customInvoice() {
    let data = {
        name: document.getElementById('name').value,
        description: document.getElementById('description').value,
        phone_number: document.getElementById('phone_number').value,
    }
    fetch(`/invoice/update/${document.getElementById('id').innerText}`, {
        method: 'PUT',
        headers: {
            'Content-type': 'application/json',
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(data)
    })
        .then(res => res.json())
        .then(data => {
            console.log(data);
        })
}
//----------------------- find the total money for each product on row ----------------------------
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
    pay = document.getElementById('sumPrice').innerText = Math.trunc(payment.toFixed(2));
}
//----------------------------------------- check product before add if it exits just increase amount no need to add new but same product -----------------------------
function checkItem(itemInList, newItem) {
    if (itemInList == newItem) {
        return true;
    } else {
        return false;
    }

}
//--------------------------------------- add product to table after comfirm -----------------------------
function addTable() {
    if (net != 0) {

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
//--------------------------------------- array object data -------------------------------------------
function dataObj(productId, weight, pay) {
    let now = new Date();
    let date = `${now.getFullYear()}-${now.getMonth() + 1}-${now.getDate()}`
}
//------------------------------- make sure for add product to invoice --------------------------------
function comfirm() {

    net = Number(document.getElementById('net').value);

    total = price * net;
    addTable();
    payment();
    let newItem = { 'id': productId, 'weight': document.getElementById('net').value };
    const item = itemSale.find(i => i.product_id === newItem.id);
    item ? item.weight = Number(newItem.weight) + Number(item.weight) : itemSale.push({ 'invoice_id': localStorage.getItem('invoiceId'), 'product_id': productId, 'weight': document.getElementById('net').value });
    console.log(itemSale);
}
//-------------------------------------- insert invoice header ----------------------------------------
function invoiceHeader(total) {
    let data = {
        'invoice_id': localStorage.getItem('invoiceNumber'),
        'total': total,
        'date': dateTime()
    };
    fetch(`/invoice/headerCreate`, {
        method: "post",
        headers: {
            'Content-Type': 'application/json',
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(data)
    })
        .then(res => res.json())
        .then(data => {
            console.log(data);
        })
}
//---------------------------------------- show invoice ----------------------------------------------
function showInvoice(data) {
    fetch(`/invoice/openInvoie/${data}`, {
    })
        .then(res => res.json())
        .then(data => {
            if (data.data.length == 0) {
                document.getElementById('dataStatus').style.cssText = `text-align:center;color:grey; padding: 30px`;
                document.getElementById('dataStatus').innerText = "គ្មានទិន្នន័យ...";
                document.getElementById('printOldInvoice').style.display = "none";
            }
            else {
                document.getElementById('dataStatus').style.cssText = '';
                document.getElementById('dataStatus').innerText = "";
                document.getElementById('printOldInvoice').style.display = "block";
                console.log(data);
                let total;
                data.data.forEach(element => {
                    document.getElementById('sumPrice').innerText = Math.trunc(element.total);
                    document.getElementById('invoiceDate').innerText = element.date;
                    document.getElementById('invoiceNo').innerText = element.invoice_id;
                    document.getElementById('tblInvoice').innerHTML +=
                        `<tr>
                        <td>${element.invoice_id}</td>
                        <td>${element.p_name}</td>
                        <td>${element.p_price}</td>
                        <td>${element.weight}<span class="text-end"> kg</span></td>
                        <td class="text-end">${element.p_price * element.weight}</td>
                    </tr>`;
                });
            }
        })
}
//--------------------------------------------------- clear invoice when close modal --------------------------------------------
function closeInvoice() {
    document.getElementById('tblInvoice').innerText = '';
}
//--------------------------------------------------- print content Invoice  on modal -------------------------------------------
function printContent(id) {
    document
        .querySelectorAll('.print-area')
        .forEach(el => el.classList.remove('print-active'));
    document.getElementById(id).classList.add('print-active');
    window.print();
    document.getElementById(id).classList.remove('print-active');
}
//----------------------------------------------------------delete invoice-------------------------------------------------------
function deleteInvoice(id) {
    fetch(`/invoice/delete/${id}`, {
        method: "DELETE",
        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
        .then(res => res.json())
        .then(data => {
            console.log(data.message);
        })
}
//---------------------------------------------------------Search Product---------------------------------------------------------
let productList = document.getElementById('product-list');

function searchProduct() {
    let search = document.getElementById('searchProduct');
    axios.get('/manageProduct/search', {
        params: {
            q: search.value
        }
    })
        .then(res => {
            console.log(res.data);
            productList.innerHTML = '';
            console.log(res.data.data.length);
            if (res.data.data.length == 0) {
                document.getElementById('searchProductStatus').innerHTML = `<h1 class="text-center pt-5 mt-5" style="color:gray">គ្មានទិន្នន័យ</h1>`;
            }
            res.data.data.forEach(element => {

                productList.innerHTML +=
                    `<tr>
                <td>${element.p_name}</td>
                <td class="text-center">${element.p_price} <span> រៀល</span></td>
                <td class="text-end">
                    <button class="btn btn-outline-primary" onclick="getUpdateProduct(${element.id})" data-bs-toggle="modal"
                            data-bs-target="#update-item"><i class="fa-regular fa-pen-to-square"></i> កែ
                    </button>
                    <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#delete-item" onclick="getDelete(${element.id})">
                        <i class="fa-regular fa-trash-can"></i> លុប
                    </button>
                </td>
            </tr>`;
            });
        }
        )
};
//--------------------------------------------------get all product----------------------------------------------------
const getAllProduct = (async () => {
    await axios.get('manage-product/product-list')
        .then(res => {
            res.data.data.forEach(element => {
                productList.innerHTML +=
                    `<tr>
                <td>${element.p_name}</td>
                <td class="text-center">${element.p_price} <span> រៀល</span></td>
                <td class="text-end">
                    <button class="btn btn-outline-primary" onclick="getUpdateProduct(${element.id})" data-bs-toggle="modal"
                            data-bs-target="#update-item"><i class="fa-regular fa-pen-to-square"></i> កែ
                    </button>
                    <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#delete-item" onclick="getDelete(${element.id})">
                        <i class="fa-regular fa-trash-can"></i> លុប
                    </button>
                </td>
            </tr>`;
            })
        })

})
let invoiceList = document.getElementById('invoice-list');
//--------------------------------------------------search invoice-----------------------------------------------------
function searchInvoice() {
    let searchValue = document.getElementById('searchInvoice').value;
    axios.get('/invoice/all-invoice/search', {
        params: { q: searchValue }
    })
        .then(res => {
            invoiceList.innerHTML = '';
            if (res.data.data.length == 0) {
                document.getElementById('searchInvoiceStatus').innerHTML = `<h1 class="text-center pt-5 mt-5" style="color:gray">គ្មានទិន្នន័យ</h1>`;
            }
            console.log('clear');
            console.log(res.data)
            res.data.data.forEach(element => {
                invoiceList.innerHTML +=
                    `<tr>
                    <td>${element.invoice_id}</td>
                    <td class="text-center"><span id="invoicePrice">${element.total}
                                    </span> រៀល</td>
                    <td class="text-center">${element.date}</td>
                    <td class="text-end"><button onclick="showInvoice(${element.id})" data-bs-target="#viewInvoice"
                                        data-bs-toggle="modal" class="btn btn-outline-primary"><i
                                            class="fa-regular fa-pen-to-square"></i> មើល</button>
                                   
                                    <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#delete-item"
                                        onclick="deleteInvoice(${element.id})"><i class="fa-regular fa-trash-can"></i> លុប</button>
                    </td>
                </tr>`
            })
        })
}
//---------------------------------------------------toast loading ------------------------------------------------------
function loadingToast() {
    Swal.fire({
        title: 'កំពុងដំណើរការ...',
        text: 'សូមរង់ចាំ...',

        // showComfirmFunctionButton:false,
        // allowOutsideClick:false,

        didOpen: () => Swal.showLoading()
    });
}
function toastSuccess(title,icon,textVal) {
    Swal.fire({
        title: title==null ? 'ជោគជ័យ' : title,
        text: textVal,
        icon: icon==null ? 'success' : icon
    });
}