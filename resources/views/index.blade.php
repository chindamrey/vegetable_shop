<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link
        href="https://fonts.googleapis.com/css2?family=Battambang:wght@100;300;400;700;900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <title>Order Page</title>

</head>

<body>
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-xl-6">
                    <div class="product-list pt-3">
                        <div class="row g-3">
                            @foreach ($data as $d)

                                <div class="col-4">
                                    <div class="card product-card p-3">

                                        <h5 class="text-truncate prouct-title">{{ $d->p_name }}</h5>
                                        <p>តម្លៃ: <b>{{ $d->p_price }}</b> រៀល</p>
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                            data-bs-target="#productModal"
                                            onclick="orderProduct({{ $d->id }})">កម្មង់</button>
                                    </div>
                                </div>
                            @endforeach

                        </div>

                    </div>
                </div>
                <div class="col-12 col-xl-6 pt-3">
                    <div class="print-area ">
                        <div class="invoice print-area" id="full-invoice">
                            <!-- Header -->
                            <div class="invoice-header">
                                <div class="shop-name" id="invoiceTitle"></div>
                                <div class="shop-info d-flex justify-content-center">
                                    <p class="w-75 pt-1 fs-6" id="invoiceDescription"></p>
    
                                </div>
    
                                <!-- Contact & Invoice Info -->
                                <div class="row invoice-info">
                                    <div class="col-6 text-start">
    
                                        <p>លេខទូរស័ព្ទ៖ <strong id="invoicePhoneNumber"></strong></p>
                                        <span>លេខវិក័យប័ត្រ៖ <strong id="invoiceNo"></strong></span><br>
                                    </div>
                                    <div class="col-6 text-end">
                                        <p>កាលបរិច្ឆេទ៖
                                            <strong id="date">
    
                                            </strong>
                                            <b id="clock"></b>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="container-fluid">
                                <table id="invoice" class="table table-bordered">
                                    <thead class="table-success">
                                        <tr>
                                            <td class="text-center" scope="col">ល.រ</td>
                                            <td class="text-center" scope="col">ឈ្មោះទំនិញ</td>
                                            <td class="text-center" scope="col">តម្លៃរាយ</td>
                                            <td class="text-center" scope="col">ទម្ងន់(គ.ក)</td>
                                            <td class="text-center" scope="col">សរុប(រៀល)</td>
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider">
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3" class="text-end">សរុបទឹកប្រាក់ </td>
                                            <th colspan="2" class="text-center table-success"><span id="sumPrice"></span>
                                                រៀល</th>
                                        </tr>
                                    </tfoot>
    
                                </table>
                                <button class="btn btn-success print-invoice" 
                                    onclick="printContent('full-invoice'),generateInvoicNO()">ទាញយកវិក្កយបត្រ</button>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal order product -->
    <div class="modal fade" id="productModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success-subtle">
                    <h3 class="modal-title text-center w-100" id="product-title"></h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="modal-body-content">
                    <p>តម្លៃ​ <strong id="productPrice"></strong> រៀល</p>
                    <label for="" class="form-label">ចំនួនគីឡូ</label>
                    <input type="Number" class="form-control" id="net" placeholder="ឧទាហរណ៍ : 0.5,1,2,3,4">
                    <span id="weightStatus"></span>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn " data-bs-dismiss="modal">បោះបង់</button>
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal"
                        onclick="comfirm()">យល់ព្រម</button>

                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script>
        let lastInvoice;
        //---------------------------- get all invoice --------------------------------
        fetch(`/index/all`)
            .then(res => res.json())
            .then(data => {
                lastInvoice = data.data.invoice_id;
                localStorage.setItem('invoiceId', data.data.id+1);
                console.log(data);
                const year = new Date().getFullYear();
                
                const lastNumber = parseInt(lastInvoice.slice(-4), 10);
                const nextNumber = lastNumber + 1;
                
                // Pad with zeros
                const padded = nextNumber.toString().padStart(4, '0');
                lastInvoice=`INV${year}-${padded}`;
                localStorage.setItem('invoiceNumber',lastInvoice);
                document.getElementById('invoiceNo').innerText=lastInvoice;
            })
    </script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>