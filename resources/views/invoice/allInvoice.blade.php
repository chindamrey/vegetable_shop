@extends('adminLayout')
@section('content')
    <div class="d-flex justify-content-center mb-4">
        <input type="search" class="form-control w-50 rounded" placeholder="ស្វែងរកតាមរយ:ឈ្មោះរបស់បន្លែ...">
    </div>
    <section class="show-invoice-page">

        <div class="container-fluid">
            <div class="product-display py-2">
                <table class="table table-striped my-2">
                    <thead class="table-success">
                        <th>លេខវិក័យប័ត្រ</th>
                        <th class="text-center">សរុប</th>
                        <th class="text-center">កាលបរិច្ឆេទ</th>
                        <th class="text-center pe-5">សកម្មភាព</th>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                            <tr>
                                <td>{{ $d->invoice_id}}</td>
                                <td class="text-center"><span id="invoicePrice">{{ $d->total}}
                                    </span> រៀល</td>
                                <td class="text-center">{{ $d->date }}</td>
                                <td class="text-end"><button onclick="showInvoice('{{$d->id}}')" data-bs-target="#viewInvoice"
                                        data-bs-toggle="modal" class="btn btn-outline-primary"><i
                                            class="fa-regular fa-pen-to-square"></i> មើល</button>
                                    {{-- <button class="btn btn-outline-success" onclick="getUpdateProduct({{ $d->id }})"
                                        data-bs-toggle="modal" data-bs-target="#update-item"><i
                                            class="fa-solid fa-download"></i> ទាញយក</button> --}}
                                    <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#delete-item"
                                        onclick="deleteInvoice({{ $d->id }})"><i class="fa-regular fa-trash-can"></i> លុប</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
<!-- Modal open invoice-->
<div class="modal fade " id="viewInvoice" tabindex="-1" data-bs-backdrop="static" aria-labelledby="viewInvoice-label"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content px-4 pb-5" id="full-invoice">
            <div class="modal-header">
                <h2 class="modal-title" id="delete-name">វិក័យប័ត្រ</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    onclick="closeInvoice()"></button>
            </div>
            <h4 id="dataStatus"></h4>
            <div class="print-area invoice" id="printOldInvoice">
                <!-- Header -->
                <div class="invoice-header">
                    <div class="row invoice-info">
                        <div class="col-6 text-start">
                            <span>លេខវិក័យប័ត្រ៖ <strong id="invoiceNo"></strong></span><br>
                        </div>
                        <div class="col-6 text-end">
                            <p>កាលបរិច្ឆេទ៖
                                <strong id="invoiceDate">

                                </strong>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="container-fluid modal-content">
                    <div id="viewInvoice">

                        <table class="table table-bordered">
                            <thead class="table-success">
                                <tr>
                                    <td class="text-center" scope="col">ល.រ</td>
                                    <td class="text-center" scope="col">ឈ្មោះទំនិញ</td>
                                    <td class="text-center" scope="col">តម្លៃរាយ</td>
                                    <td class="text-center" scope="col">ទម្ងន់(គ.ក)</td>
                                    <td class="text-center" scope="col">សរុប(រៀល)</td>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider" id="tblInvoice">

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-end">សរុបទឹកប្រាក់ </td>
                                    <th colspan="2" class="text-center table-success"><span id="sumPrice"
                                            class="text-danger"></span>
                                        រៀល</th>
                                </tr>
                            </tfoot>

                        </table>
                        <div class="d-flex w-100  justify-content-end download-invoice">

                            <button class="btn btn-outline-success print-invoice" id="hide-btn"
                                onclick="printContent('printOldInvoice')">ទាញយកវិក្កយបត្រ</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal delete item-->
<div class="modal fade" id="delete-item" tabindex="-1" aria-labelledby="delete-item-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="delete-name"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-danger fs-5">តើអ្នកសម្រេចថាលុបដែររឺទេ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">បោះបង់</button>
                <button type="button" class="btn btn-danger" id="" onclick="deleteProduct()"
                    data-bs-dismiss="modal">លុប</button>
            </div>
        </div>
    </div>
</div>
<script>
</script>