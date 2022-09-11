<x-master title="Create Payment - L-Man">
    <x-slot name="navbar"></x-slot>

    <div class="container py-5 my-5">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-dark text-white text-center">
                <h5>INVOICE</h5>
            </div>
            <div class="card-body my-3">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="fw-bold">Account Detail</h5>
                        <p>PIC Name: {{ $request->pic_name }} <br>
                            PIC Email: {{ $request->pic_email }} <br>
                            Institution Name: {{ $request->institution_name }} <br>
                            Institution Email: {{ $request->institution_email }} <br>
                            Institution Address: {{ $request->institution_address }} <br>
                            Phone Number: {{ $request->phone_number }}
                        </p>
                    </div>
                    <div class="col-md-6">
                        <h5 class="fw-bold">Transaction Detail</h5>
                        <ul>
                            <li>Package A (100 Teacher & 500 Student): Rp500.000</li>
                            <li>Tax (10%): Rp50.0000</li>
                            <li>Administration Fee: Rp25.000</li>
                        </ul>
                    </div>
                </div>
                <h5 class="text-end me-4 fw-bold">Total Transaction: Rp575.000</h5>
            </div>
        </div>
        <div class="card shadow-sm border-0 mt-3">
            <div class="card-header bg-dark text-white text-center">
                <h5>CONFIRM YOUR PAYMENT</h5>
            </div>
            <div class="card-body my-3">
                <form action="{{ route('payment-create') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" value="{{ $request->pic_name }}" name="pic_name">
                    <input type="hidden" value="{{ $request->pic_email }}" name="pic_email">
                    <input type="hidden" value="{{ $request->institution_name }}" name="institution_name">
                    <input type="hidden" value="{{ $request->institution_address }}" name="institution_address">
                    <input type="hidden" value="{{ $request->institution_email }}" name="institution_email">
                    <input type="hidden" value="{{ $request->phone_number }}" name="phone_number">

                    <div class="row">
                        <div class="col-md-6 my-3">
                            <h5 class="fw-bold">Transfer via BCA</h5>
                            <ul>
                                <li>Bank Account Number: 5782394432</li>
                                <li>Bank Account Name: L-Man</li>
                                <li>Nominal: Rp575.000</li>
                            </ul>
                            <div class="alert alert-info">
                                After you submit the payment and confirmed by our system, the admin
                                account email &
                                password will be send to registered PIC email
                            </div>
                        </div>
                        <div class="col-md-6 my-3">
                            <h5 class="fw-bold">Upload your transfer proof below</h5>
                            <div class="my-3">
                                <label for="proof">Transfer Proof
                                    <br>
                                    <small>Format: JPG,PNG,JPEG | Max Size: 1MB</small>
                                </label>
                                <input type="file" class="form-control" name="transfer_proof">
                            </div>
                        </div>
                    </div>
                    <div class="d-grid mt-2">
                        <button class="btn bg-color-lightblue">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-master>
