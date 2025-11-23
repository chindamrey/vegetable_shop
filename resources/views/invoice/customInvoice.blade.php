@extends('adminLayout')
@section('content')
    <section class="custom-invoice-page">
        <div class="invoice" id="full-invoice">
            <!-- Header -->


            <div class="invoice-header">
               
                    <div class="shop-name d-flex justify-content-center" id="">
                        @foreach ($data as $d )
                        <p class="d-none" id="id">{{ $d->id }}</p>
                        <input type="text" class="form-control w-50 fs-3 text-center text-primary" id="name" value="{{ $d->name }}">
                        
                    </div>
                    <div class="shop-info d-flex justify-content-center">
                        {{-- <p class="w-75 pt-1 fs-6" id="invoiceDescription"></p> --}}
                        <textarea class="form-control mt-3 w-75" name="" id="description" value="hee">{{ $d->description }}</textarea>

                    </div>

                    <!-- Contact & Invoice Info -->
                    <div class="row invoice-info">
                        <div class="col-8 text-start">
                            <div class="d-flex align-items-center mb-3">
                                <label for="" class="from-label me-4">លេខទូរស័ព្ទ៖</label>
                                <input type="text" id="phone_number" class="form-control w-50" value="{{ $d->phone_number }}">
                            </div>
                            @endforeach
                            <span>លេខវិក័យប័ត្រ៖ <strong id="invoiceNo"></strong></span><br>
                        </div>
                        <div class="col-4 text-end">
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
                <div class="d-flex justify-content-end">
                    <button class="btn btn-success print-invoice" onclick="customInvoice()"><i class="fa-regular fa-floppy-disk"></i>
                        រក្សាទុក</button>
                </div>
            </div>
        </div>
    </section>
@endsection