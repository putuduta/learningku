<x-master title="Register - Learningku">
    <x-slot name="navbar"></x-slot>
    <div class="container py-5 my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-dark text-white text-center">
                        <h5>REGISTER AS ADMIN</h5>
                    </div>
                    <div class="card-body my-2">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group row my-3">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Name') }} <span class="required">*</span></label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row my-3">
                                <label for="identityNumber"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Identity Number/NUPTK') }} <span class="required">*</span></label>

                                <div class="col-md-6">
                                    <input id="identityNumber" type="number"
                                        class="form-control @error('identityNumber') is-invalid @enderror" name="identityNumber"
                                        value="{{ old('identityNumber') }}" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==16) return false;" required autocomplete="identityNumber" autofocus>

                                    @error('identityNumber')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row my-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Email') }} <span class="required">*</span></label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row my-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Password') }} <span class="required">*</span></label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        value="{{ old('password') }}" required autocomplete="password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row my-3">
                                <label for="gender"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Gender') }} <span class="required">*</span></label>

                                <div class="col-md-6">
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="gender" value="Male" required> Male
                                        </label>
                                   </div>
                                   <div class="form-check-inline">
                                        <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="gender" value="Female" required> Female
                                        </label>
                                   </div>

                                   @error('gender')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row my-3">
                                <label for="school"
                                    class="col-md-4 col-form-label text-md-right">{{ __('School') }} <span class="required">*</span></label>

                                <div class="col-md-6">
                                    <input id="school" type="text"
                                    class="form-control @error('school') is-invalid @enderror" name="school"
                                    value="{{ old('school') }}" autocomplete="school">

                                    @error('school')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row my-3">
                                <label for="photoProfile"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Photo Profile') }}</label>

                                <div class="col-md-6">
                                    <input id="photoProfile" type="file"
                                    class="form-control @error('photoProfile') is-invalid @enderror" name="photoProfile"
                                    value="{{ old('photoProfile') }}" autocomplete="photoProfile">

                                    @error('photoProfile')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary my-2 text-white">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>

                            <div class="text-right mt-3">
                                <a class="btn btn-link" href="{{ route('login') }}">
                                    {{ __('Already have an admin account?') }}
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-master>
