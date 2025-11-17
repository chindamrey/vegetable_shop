@extends('adminLayout')
@section('content')
    <section class="create-product-page">

        <div class="container-fluid">
            <form action="">
                <div class="row p-4">
                    <div class="col">
                        <label for="" class="form-label bold"><b>ឈ្មោះបន្លែ</b></label>
                        <input type="text"  class="form-control" placeholder="សូមបញ្ចូលឈ្មោះបន្លែ">
                    </div>
                    <div class="col">
                        <label for="" class="form-label"><b>តម្លៃ(រៀល)</b></label>
                        <input type="text" class="form-control" placeholder="ឧទាហរណ៍​ ២០០០រៀល ៣៥០០រៀល ៤០០០រៀល ....">
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="align-end btn btn-success mb-4 mx-4">យល់ព្រម</button>
                </div>
            </form>
        </div>
    </section>
@endsection