<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="card mt-2">
                    <div class="card-header text-center display-block">
                        <div class="fw-bold text-primary">Form log-in</div>
                    </div>
                    <div class="card-body">
                        <form action="/cekLogin" method="POST">
                            @csrf
                            <span class="text" id="basic-addon1">Email</span>
                            <div class="input-group mb-3">
                                <input type="email" class="form-control" name="email" aria-label="Username"
                                    aria-describedby="basic-addon1" required autocomplete="off">
                            </div>
                            <span class="text" id="basic-addon1">Password</span>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" name="password" aria-label="Username"
                                    aria-describedby="basic-addon1" required autocomplete="off">
                            </div>
                            <div class="input-group mb-3">
                                <input type="submit" value="Sign-in">
                            </div>
                            <div class="sm">Belum punya akun? <a href="/register">register</a> sekarang!</div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
