<x-master title="Register Institution - L-Man">
    <x-slot name="navbar"></x-slot>
    <div class="container py-5 my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-dark text-white text-center">
                        <h5>REGISTER NEW ACCOUNT</h5>
                    </div>
                    <div class="card-body my-2">
                        <form method="POST" action="{{ route('payment-validate') }}">
                            @csrf

                            <div class="form-group row my-3">
                                <label for="pic_name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('PIC Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('pic_name') is-invalid @enderror" name="pic_name"
                                        value="{{ old('pic_name') }}" required autocomplete="pic_name" autofocus>

                                    @error('pic_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row my-3">
                                <label for="pic_email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('PIC Email') }}</label>

                                <div class="col-md-6">
                                    <input id="pic_email" type="email"
                                        class="form-control @error('pic_email') is-invalid @enderror" name="pic_email"
                                        value="{{ old('pic_email') }}" required autocomplete="pic__email">

                                    @error('pic_email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row my-3">
                                <label for="institution_name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Institution Name') }}</label>

                                <div class="col-md-6">
                                    <input id="institution_name" type="text"
                                        class="form-control @error('institution_name') is-invalid @enderror"
                                        name="institution_name" value="{{ old('institution_name') }}" required
                                        autocomplete="institution_name">

                                    @error('institution_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row my-3">
                                <label for="institution_email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Institution Email') }}</label>

                                <div class="col-md-6">
                                    <input id="institution_email"" type=" email"
                                        class="form-control @error('institution_email"') is-invalid @enderror" name="institution_email""
                                        value="{{ old('institution_email"') }}" required autocomplete="institution_email">

                                    @error(' institution_email"') <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row my-3">
                                <label for="institution_address"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Institution Address') }}</label>

                                <div class="col-md-6">
                                    <input id="institution_address" type="text"
                                        class="form-control @error('institution_address') is-invalid @enderror"
                                        name="institution_address" value="{{ old('institution_address') }}" required
                                        autocomplete="institution_address">

                                    @error('institution_address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row my-3">
                                <label for="phone_number"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>

                                <div class="col-md-6">
                                    <input id="phone_number" type="text"
                                        class="form-control @error('phone_number') is-invalid @enderror"
                                        name="phone_number" value="{{ old('phone_number') }}" required
                                        autocomplete="phone_number">

                                    @error('phone_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn bg-color-lightblue">
                                        {{ __('Proceed to payment') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-master>
