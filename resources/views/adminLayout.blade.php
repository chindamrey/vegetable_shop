<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
                                    <a href="#" class="btn-menu list-group-item list-group-item-action ps-3">ចំណូល</a>
                                    <a href="#" class="btn-menu list-group-item list-group-item-action ps-3">គ្រប់គ្រងទំនិញ</a>
                                    <a href="#" class="btn-menu list-group-item list-group-item-action ps-5" >បន្ថែមទំនិញថ្មី</a>
                                    <a href="#" class="btn-menu list-group-item list-group-item-action ps-5">កែប្រែទំនិញ</a>
                                    <a href="#" class="btn-menu list-group-item list-group-item-action ps-5">លុបទំនិញ</a>
                                    <a href="#" class="btn-menu list-group-item list-group-item-action ps-3">វិក្កយបត្រ</a>
                                    <a href="#" class="btn-menu list-group-item list-group-item-action ps-5">វិក្កយបត្រទាំងអស់</a>
                                    <a href="#" class="btn-menu list-group-item list-group-item-action ps-5">កែវិក្កយបត្រ</a>
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