@extends('layouts/app')
@section('content')
    <section class="register" id="register">
        <div class="d-flex justify-content-center mt-4 pt-5">
            <div class="col-lg-9 col-md-12 mb-3">
                <div class="row guru_register-form bg-light rounded shadow">
                    <div class="col-lg-5 col-md-6 p-0 m-0 gambar-guru_register d-flex align-items-center justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" width="100%" height="100%" viewBox="0 0 676 676" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M938,450a337.45265,337.45265,0,0,1-17.85,108.68q-1.02008,3-2.09,5.98a338.39278,338.39278,0,0,1-53.77,96.05q-10.32,12.945-21.87,24.82-11.55,11.895-24.25,22.63a336.248,336.248,0,0,1-165.78,75.8h-.01q-11.7,1.815-23.63,2.83Q614.545,787.99,600,788A336.94,336.94,0,0,1,358.09,686.05q-3.315-3.39-6.53-6.88-8.01-8.685-15.41-17.91-4.155-5.19-8.11-10.54a336.714,336.714,0,0,1-40.24-70.98,332.25383,332.25383,0,0,1-11.7-32.84c-.24-.79-.47-1.57995-.7-2.37q-.75-2.55-1.45-5.13A338.38,338.38,0,0,1,262,450c0-186.67,151.33-338,338-338S938,263.33,938,450Z" transform="translate(-262 -112)" fill="#f2f2f2"/><path d="M405.34786,314.03191a22.02562,22.02562,0,0,0,22.026,25.603l53.95432,156.9927,34.42683-23.66L449.29637,315.7305a22.145,22.145,0,0,0-43.94851-1.69859Z" transform="translate(-262 -112)" fill="#a0616a"/><path d="M686.95533,367.15c-23.96,27.26-83.04,75.3-131.71,108.38-10.52,7.15-20.56,13.59-29.65,18.98-6.14,3.64-11.85,6.79-16.99,9.36a27.99469,27.99469,0,0,1-38.41-14.5l-33.7-81.53,11.66-7.73005,28.75-19.07,6.53-4.32,26.96,64.21,28.43-22.82,17.65-14.17,80.46-64.57,6.94-2.06,16.19,15.8,11.44995,11.18,10.77,1.87C683.89533,366.43994,685.45533,366.77,686.95533,367.15Z" transform="translate(-262 -112)" fill="#6c63ff"/><path d="M901.92,591.16222c1.67,2.12,3.4,4.23,5.13,6.35a335.12127,335.12127,0,0,1-20.06,35.52q-.825-.58492-1.65-1.17a2.12042,2.12042,0,0,1-.25-.16c-2.05-1.46-4.11005-2.9-6.16-4.36v-.01a70.003,70.003,0,0,1-2.81-17.7,5.288,5.288,0,0,0,1.23-9.86005c-.27-.47-.46-.81-.73-1.29.01-.12.03-.25.04-.37C878.23,585.62224,894.15,581.26225,901.92,591.16222Z" transform="translate(-262 -112)" fill="#fff"/><path d="M919.87,548.36223q1.8,4.95,3.28,10.01-1.02008,3-2.09,5.98-.405-1.575-.84-3.15a161.95685,161.95685,0,0,0-5.85-17.2q-2.79-6.915-6.18-13.54a170.35651,170.35651,0,0,0-51.96-60.5,45.35,45.35,0,0,1-23.43-13.78,34.85779,34.85779,0,0,1-5.57-8.26c.92-.13,1.84-.31,2.74-.5.28-.06.57-.13.85-.19l.11-.02a5.24141,5.24141,0,0,0,1.85-9.37994c-.51-.37006-1.03-.73-1.54-1.09-.78-.57-1.57-1.11-2.36-1.67a2.49231,2.49231,0,0,1-.24-.17c-.9-.64-1.8-1.26-2.69-1.91a15.19516,15.19516,0,0,1,3.49-5.96c5.59-5.77,15.57-5.63995,22.09-.94,6.53,4.7,9.81,12.93,10.23,20.95.37,6.87-1.11,13.67-3.06,20.3.49.36,1,.7,1.49,1.07a171.32688,171.32688,0,0,1,24.86,22.51c-4.35-10.32-5.93-23.78-4.8-33.05,1.29-10.56,6.42-20.59,10.62-30.58,5.03-12,22.19-12.16,27.03-.08.05.12006.1.23.14.35q-1.215,1.215-2.34,2.52a7.175,7.175,0,0,0,6.29,11.8l.15-.02a72.09554,72.09554,0,0,1,1.06,10.79,73.50777,73.50777,0,0,1-22.88,54.2c-.48.45-.95.89-1.44,1.32a170.65691,170.65691,0,0,1,12.45,20.67A172.4434,172.4434,0,0,1,919.87,548.36223Z" transform="translate(-262 -112)" fill="#fff"/><path d="M727.18537,454.54993l-3.02,207.41-243.96-7,38.96-86c-.28-2.76,17.1-22.13,17-25-.3-8.41,5.98-16.2,7-25,2.08-18.15-9.83-86.69-4.34-100.85a96.26746,96.26746,0,0,1,8.94-18.07995c3.12-4.72,6.32-7.9,9.38-9.05l9.02-21.02,8-12,62.77-18.59,6.94-2.06,16.19,15.8,11.44995,11.18,10.77,1.87c1.61.28,3.17.61,4.67.99a47.44209,47.44209,0,0,1,19.66,9.74C725.41535,392.85992,727.60536,422.9,727.18537,454.54993Z" transform="translate(-262 -112)" fill="#6c63ff"/><path d="M867.29,660.40221q-10.32,12.945-21.87,24.82l-26.38.02-141.87.16-25.54.03-16.98.02-25.26.02-19.43.02-35.89.04-21.17.03-44.58.04-21.28.03-58.97.06-37.04.04-9.94.01q-3.315-3.39-6.53-6.88-8.01-8.685-15.41-17.91l20.58-.02,14.02-.01,32.46-.04,62.64-.06,21.17-.02,8.56-.01h.03l6.72-.01,3.01-.01,7.71-.01h3.26l22.86-.02,49.31-.06,21.7-.02,20.78-.02,19.48-.02,27.95-.03,149.28-.15Z" transform="translate(-262 -112)" fill="#ccc"/><path id="bfd9c2c3-21db-4bc8-8976-94586a21de42-380" data-name="Path 9" d="M529.76568,348.972l-.05423.00519a10.92438,10.92438,0,0,1-11.88954-9.86522l-5.68685-60.69949a81.4729,81.4729,0,0,1,3.43327-32.25755,82.78683,82.78683,0,0,1,39.2298-47.5915,81.52038,81.52038,0,0,1,31.25114-9.55739c44.81954-4.27,61.19851,5.06459,88.88453,73.42136s5.69552,60.792,5.69552,60.792a10.9425,10.9425,0,0,1-.46267,4.3394,11.12143,11.12143,0,0,1-5.28534,6.39312,10.97834,10.97834,0,0,1-4.17872,1.27664C617.71622,348.697,564.251,362.87424,529.75665,348.9728Z" transform="translate(-262 -112)" fill="#2f2e41"/><path id="acce586e-6e96-4eff-b112-6c9d74172e69-381" data-name="Ellipse 1" d="M628.38742,246.52082A60.09533,60.09533,0,0,1,567.2748,339.1912a59.3953,59.3953,0,0,1-38.24149-25.1652,60.09533,60.09533,0,0,1,61.06736-92.64339,59.39528,59.39528,0,0,1,38.287,25.14046Z" transform="translate(-262 -112)" fill="#9e616a"/><path id="af1db401-16c9-4940-bbbf-8b9ef63e1952-382" data-name="Path 10" d="M493.34592,285.156a64.45,64.45,0,0,1,2.71593-25.51192c.60421-20.14719,6.44962-38.39572,31.02261-37.62977a64.479,64.479,0,0,1,24.55165-7.53375l12.14321-1.19912q.20457-.02036.40925-.0394A64.34091,64.34091,0,0,1,634.215,271.3438l.11391,1.21579-25.69113,2.51164-11.057-23.66179.54556,24.69437-13.269,1.30231-5.57605-11.93793.27223,12.45078c-19.7014,17.3515-49.57632,18.261-86.08219,8.454Z" transform="translate(-262 -112)" fill="#2f2e41"/><path id="a1e66597-148d-4736-b39c-00184f281162-383" data-name="Path 13" d="M575.525,342.75525a10.75,10.75,0,0,0,1.00164,5.83369,10.99444,10.99444,0,0,0,1.68713,2.56109,11.12123,11.12123,0,0,0,1.95644,1.744,10.906,10.906,0,0,0,7.29595,1.90363q.24116-.02487.48144-.05876t.47954-.079q.24171-.04313.4799-.09957t.47778-.12213l8.96651-2.51251,10.04915-28.01931,2.30348,24.58657,40.77284-11.35169-9.775-104.335-69.49455,6.84762,1.90583,1.83522a48.02908,48.02908,0,0,1,13.03169,22.51654,78.292,78.292,0,0,1,1.98341,26.56205,141.18475,141.18475,0,0,1-4.977,26.58842,208.08,208.08,0,0,1-7.85514,22.63256A10.97921,10.97921,0,0,0,575.525,342.75525Z" transform="translate(-262 -112)" fill="#2f2e41"/><path d="M584.79172,671.70909a8.06043,8.06043,0,0,1-3.45355-.78079l-192.51981,4.91161a8.07967,8.07967,0,0,1,1.15008-15.04471l125.95184-37.55507a8.07907,8.07907,0,0,1,4.016-.15366L714.7624,646.8327a8.07944,8.07944,0,0,1,.9262,15.53535l-128.25875,8.89657A8.09091,8.09091,0,0,1,584.79172,671.70909Z" transform="translate(-262 -112)" fill="#3f3d56"/><path d="M591.8725,658.30727a5.08458,5.08458,0,0,1-2.48316-.64626L433.0352,664.96557a5.06832,5.06832,0,0,1,1.2833-9.34574l56.60364-13.73834a5.08357,5.08357,0,0,1,2.67737.07847l145.35352-.17464a5.06856,5.06856,0,0,1,.034,9.68272l-45.60237,6.60842A5.05818,5.05818,0,0,1,591.8725,658.30727Z" transform="translate(-262 -112)" fill="#2f2e41"/><path d="M575.4148,649.97366a22.0256,22.0256,0,0,0,32.255-10.0137l165.49554,13-8-41-170.69748-1.62639a22.145,22.145,0,0,0-19.05307,39.64009Z" transform="translate(-262 -112)" fill="#a0616a"/><path d="M673.16535,382.96s25-20,55,16c20.23163,24.27795,59.25937,171.04436,62.49515,231.86245a27.98225,27.98225,0,0,1-28.58436,29.46048l-88.21089-1.53521-9.86388-55.45,69.64346.82467Z" transform="translate(-262 -112)" fill="#6c63ff"/><path d="M574.084,671.73152a22.73939,22.73939,0,0,1-8.81026-1.78381l-178.442,4.07146a22.67533,22.67533,0,0,1-13.651-24.58235l-6.63053-156.71135a22.64167,22.64167,0,0,1,23.9351-19.07363l165.66312,6.871a22.73879,22.73879,0,0,1,20.9224,26.54357L596.48026,652.835A22.77479,22.77479,0,0,1,574.084,671.73152Z" transform="translate(-262 -112)" fill="#3f3d56"/><path d="M438.58534,205.16992l-74.47-.21a7.54113,7.54113,0,0,0-7.55,7.51l-.27,98.61a7.52409,7.52409,0,0,0,7.5,7.54l41.31.12,33.17.09a7.52625,7.52625,0,0,0,7.54-7.51l.02-5.83.26-92.77A7.53481,7.53481,0,0,0,438.58534,205.16992Z" transform="translate(-262 -112)" fill="#e6e6e6"/><path d="M433.33534,211.05994l-64-.18a7.06116,7.06116,0,0,0-7.07,7.03l-.18,63.4a31.44293,31.44293,0,0,0,31.32,31.49l12.16.03,27.49.08a7.05471,7.05471,0,0,0,7.07-7.03l.01995-6.38.22-81.37A7.05467,7.05467,0,0,0,433.33534,211.05994Z" transform="translate(-262 -112)" fill="#fff"/><path d="M426.14533,254.37994h-49.9a2.995,2.995,0,1,0,0,5.99h49.9a2.995,2.995,0,0,0,0-5.99Z" transform="translate(-262 -112)" fill="#6c63ff"/><path d="M387.21534,237.96h-10.97a2.995,2.995,0,1,0,0,5.99h10.97a2.995,2.995,0,1,0,0-5.99Z" transform="translate(-262 -112)" fill="#6c63ff"/><path d="M426.14533,280.71h-49.9a2.995,2.995,0,1,0,0,5.99h49.9a2.995,2.995,0,0,0,0-5.99Z" transform="translate(-262 -112)" fill="#6c63ff"/><path d="M426.14533,267.54993h-49.9a2.99,2.99,0,1,0,0,5.98h49.9a2.99,2.99,0,0,0,0-5.98Z" transform="translate(-262 -112)" fill="#6c63ff"/><path d="M416.449,248.55039a17.71641,17.71641,0,1,1,17.7164-17.71641A17.7366,17.7366,0,0,1,416.449,248.55039Zm0-34.20164A16.48524,16.48524,0,1,0,432.93418,230.834,16.504,16.504,0,0,0,416.449,214.34875Z" transform="translate(-262 -112)" fill="#6c63ff"/><path d="M423.8894,237.69619a45.54536,45.54536,0,0,0-7.47817-17.56611.93517.93517,0,0,0-1.59461,0,48.64681,48.64681,0,0,0-6.06688,18.33571c-.14352,1.177,1.70451,1.16666,1.84676,0a45.51962,45.51962,0,0,1,1.21062-6.2,1.05464,1.05464,0,0,0,.20631-.06316,13.45936,13.45936,0,0,1,7.94981-1.29459c.02367.00353.04652-.00162.07019.00068a44.28492,44.28492,0,0,1,2.07519,7.27843C422.33387,239.35283,424.11416,238.85928,423.8894,237.69619ZM412.47185,230.001a46.74284,46.74284,0,0,1,3.22475-7.61812,44.26573,44.26573,0,0,1,3.56581,6.61182A15.57647,15.57647,0,0,0,412.47185,230.001Z" transform="translate(-262 -112)" fill="#6c63ff"/></svg>
                    </div>
                    <div class="col-lg-7 col-md-6 p-4">
                        @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        @if (session()->has('registerError'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('registerError') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        @include('layouts/flash')
                        <main class="form-register">
                            <h1 class="h3 mb-sm-3 mb-lg-4 fw-normal text-center heading">Registrasi Guru</h1>
                            <form action="/registerGuru" method="post">
                                @csrf
                                <div class="row justify-content-center align-items-center">
                                    <div class="col-md-10">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-sm mt-3">
                                                    <input type="text" name = "nama" class="form-control @error ('nama') is-invalid @enderror" id="nama" placeholder="Nama" autofocus required value="{{ old('nama') }}">
                                                    @error('nama')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-sm mt-3">
                                                    <input type="text" name = "username" class="form-control @error ('username') is-invalid @enderror" id="username" placeholder="Username" autofocus required value="{{ old('username') }}">
                                                    @error('username')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-11 col-md-12">
                                            <div class="form-sm my-3">
                                                <input type="text" name="nip" class="form-control @error ('nip') is-invalid @enderror" id="nip" placeholder="NIP" required value="{{ old('nip') }}">
                                                @error('nip')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div> 
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-11 col-md-12">
                                            <div class="form-sm my-3">
                                                <input type="email" name="email" class="form-control @error ('email') is-invalid @enderror" id="email" placeholder="Alamat Email" required value="{{ old('email') }}">
                                                @error('email')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div> 
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-sm mb-3">
                                                    <input type="password" name="password" class="form-control active @error ('password') is-invalid @enderror" id="password" placeholder="Password" required autocomplete="new-password">
                                                    <span class="icon-area">
                                                        <i id="icon" class="fa-solid fa-eye-slash text-secondary"></i>
                                                    </span>
                                                    @error('password')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div> 
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-sm mb-3">
                                                    <input type="password" name="password_confirmation" class="form-control active" id="password-confirm" placeholder="Ulangi Password" required autocomplete="new-password">
                                                    <span class="icon-area">
                                                        <i id="iconConfirm" class="fa-solid fa-eye-slash text-secondary"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-sm">
                                            <p id="peringatan" class="p-2 text-danger bg-danger bg-opacity-25 rounded-5">Peringatan: Capslock Aktif</p>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-12">
                                                <a href="/register_sebagai" class="w-100 btn btn-sm btn-secondary mt-3 button-kembali subheading"><i class="fa-solid fa-circle-arrow-left"></i> Kembali</a>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <button class="w-100 btn btn-sm btn-primary button-register mt-3 subheading" type="submit"><i class="fa-solid fa-file-pen"></i> Register</button>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                </div>
                            </form>
                            <small class="d-block text-center subheading"><a href="{{ route('password.request') }}">Lupa Password?</a></small>
                            <small class="d-block text-center mt-3 subheading">Sudah terdaftar? <a href="/login">Masuk</a></small>
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection