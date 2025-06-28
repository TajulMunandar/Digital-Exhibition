<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
            /* Light background */
        }

        .login-container {
            display: flex;
            width: 100%;
            max-width: 900px;
            height: 600px;
            overflow: hidden;
            border-radius: 8px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);

        }

        .login-form {
            flex-basis: 400px;
            padding: 40px;
            background-color: #ffffff;

            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-form h2 {
            color: #333333;
        }

        .btn-primary {
            background-color: #6f42c1;
            /* Custom color */
            border: none;
        }

        .login-image {
            flex: 1;
            background: url({{ asset('/auth/bg.png') }}) center/cover no-repeat;
            position: relative;
            display: flex;
            align-items: end;
            justify-content: start;
            color: white;
            text-align: center;
        }

        .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            /* Ubah 0.4 sesuai tingkat redup */
            z-index: 1;
            border-radius: inherit;
        }

        .overlay-text {
            position: absolute;
            z-index: 2;
            padding: 20px;
            /* Optional: translucent background */
            border-radius: 10px;
        }

        .overlay-text h1 {
            font-size: 32px;
            margin-bottom: 10px;
            color: #fff;
        }

        .overlay-text p {
            font-size: 16px;
            color: #eee;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-image">
            <div class="image-overlay"></div> <!-- Layer gelap -->
            <div class="overlay-text">
                <h1>Selamat Datang</h1>
                <p>Silakan login untuk melanjutkan</p>
            </div>
        </div>
        <div class="login-form">
            <h2>Selamat Datang</h2>
            <div class="row">
                <div class="col-sm-6 col-md">
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @elseif (session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                </div>
            </div>
            <form action="{{ route('login.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Masukkan Email" required
                        name="email">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Kata Sandi</label>
                    <input type="password" class="form-control" id="password" placeholder="Masukkan Kata Sandi"
                        required name="password">
                    <small class="form-text text-muted">*Silahkan hubungi admin jika lupa kata sandi.</small>
                </div>
                <button type="submit" class="btn btn-primary d-block w-100">Masuk</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
