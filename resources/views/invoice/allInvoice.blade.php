
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
                                <td class="text-center"><span class="text-success fw-bold">{{ $d->total }} </span> រៀល</td>
                                <td class="text-center fw-bold">{{ $d->date }}</td>
                                <td class="text-end"><button class="btn btn-outline-primary" onclick="getUpdateProduct({{ $d->id }})" data-bs-toggle="modal"
                                        data-bs-target="#viewInvoice"><i class="fa-regular fa-pen-to-square"></i> មើល</button>
                                        <button class="btn btn-outline-success" onclick="getUpdateProduct({{ $d->id }})" data-bs-toggle="modal"
                                        data-bs-target="#update-item"><i class="fa-solid fa-download"></i> ទាញយក</button>
                                    <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#delete-item" onclick="getDelete({{ $d->id }})"><i class="fa-regular fa-trash-can"></i> លុប</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
<!-- Modal edit item-->
<div class="modal fade " id="viewInvoice" tabindex="-1" aria-labelledby="viewInvoice-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-3 text-success" id="update-name">កែប្រែឈ្មោះបន្លែនិងតម្លៃនៅទីនេះ</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form onsubmit="updateProduct()">
                    <div class="modal-body">
                    <div class="d-flex">
                        <div class="pe-3">
                            <label for="" class="form-label">កែប្រែឈ្មោះបន្លែទីនេះ</label>
                            <input type="text" class="form-control fw-bold" id="itemName" name="proName" required>
                        </div>
                        <div class="ps-3">
                            <label for="" class="form-label">កែប្រែតម្លៃបន្លែទីនេះ</label>
                            <input type="number" class="form-control fw-bold" id="itemPrice" name="proPrice" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">បោះបង់</button>
                    <button type="submit" class="btn btn-success" id="saveUpdate" data-bs-dismiss="">រក្សាទុក</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal delete item-->
<div class="modal fade" id="delete-item" tabindex="-1" aria-labelledby="delete-item-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
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
                <button type="button" class="btn btn-danger" id="" onclick="deleteProduct()" data-bs-dismiss="modal">លុប</button>
            </div>
        </div>
    </div>
</div>