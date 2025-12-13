<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>admin</title>
    <style>
        body {
            background-color: #CCD4CF;
        }
    </style>
</head>

<body>
    <main>
        <div class="container-fluid">

            <section class="admin-layout">
                <div class="row">
                    <div class="col-2">
                        <div class="menu">
                            <div class="company-logo">
                                <h3>រុន​ លក់បន្លែ</h3>
                            </div>
                            <div class="menu-button">
                                <div class="list-group ">
                                    <button class="btn-menu list-group-item list-group-item-action ps-3"><a href="#"
                                            class="text-white"></a>ចំណូល</button>
                                    <a href="#"
                                        class="btn-menu list-group-item list-group-item-action ps-3">គ្រប់គ្រងទំនិញ</a>


                                    <a href="/manageProduct/createProduct"
                                        class="{{ request()->is('manageProduct/createProduct*') ? 'active' : '' }} btn-menu list-group-item list-group-item-action ps-5">បន្ថែមទំនិញថ្មី</a>

                                    <a href="/manageProduct/allProduct"
                                        class="{{ request()->is('manageProduct/allProduct*') ? 'active' : '' }} btn-menu list-group-item list-group-item-action ps-5">ទាំងអស់</a>
                                    <a href="#"
                                        class="btn-menu list-group-item list-group-item-action ps-3">វិក្កយបត្រ</a>
                                    <a href="/invoice/allInvoice"
                                        class="{{ request()->is('invoice/allInvoice*') ? 'active' : '' }} btn-menu list-group-item list-group-item-action ps-5">វិក្កយបត្រទាំងអស់</a>
                                    <a href="/invoice/customInvoice"
                                        class="{{ request()->is('invoice/customInvoice*') ? 'active' : '' }} btn-menu list-group-item list-group-item-action ps-5">កែវិក្កយបត្រ</a>
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="col-10">
                        <div class="content p-4">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </section>
        </div>

    </main>
</body>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/script.js') }}"></script>

</html>