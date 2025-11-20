@extends('adminLayout')
@section('content')
    <div class="d-flex justify-content-center mb-4">
        <input type="search" class="form-control w-50 rounded" placeholder="ស្វែងរកតាមរយ:ឈ្មោះរបស់បន្លែ...">
    </div>
    <section class="show-product-page">

        <div class="container-fluid">
            <div class="product-display py-2">
                <table class="table table-striped my-2">
                    <thead class="table-success">
                        <th>ឈ្មោះបន្លែ</th>
                        <th>តម្លៃ</th>
                        <th class="text-end pe-4">សកម្មភាព</th>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                            <tr>
                                <td>{{ $d->p_name}}</td>
                                <td><span class="text-success fw-bold">{{ $d->p_price }} </span> រៀល</td>
                                <td class="text-end"><button class="btn btn-outline-warning" onclick="getUpdateProduct({{ $d->id }})" data-bs-toggle="modal"
                                        data-bs-target="#update-item"><i class="fa-regular fa-pen-to-square"></i> កែ</button>
                                    <button class="btn btn-outline-danger"><i class="fa-regular fa-trash-can"></i> លុប</button>
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
<div class="modal fade " id="update-item" tabindex="-1" aria-labelledby="update-item" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-3 text-success" id="update-item">កែប្រែឈ្មោះនិងតម្លៃរបស់បន្លែ</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="d-flex">
                        <div class="pe-3">
                            <label for="" class="form-label">កែប្រែឈ្មោះបន្លែទីនេះ</label>
                            <input type="text" class="form-control" id="itemName" name="proName">
                        </div>
                        <div class="ps-3">
                            <label for="" class="form-label">កែប្រែតម្លៃបន្លែទីនេះ</label>
                            <input type="text" class="form-control" id="itemPrice" name="proPrice">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">បោះបង់</button>
                <button type="button" class="btn btn-success" id="saveUpdate" onclick="updateProduct()" data-bs-dismiss="modal">រក្សាទុក</button>
            </div>
        </div>
    </div>
</div>