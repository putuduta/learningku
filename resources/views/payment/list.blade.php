<x-app title="Payment List - L-Man">
     <x-slot name="navbar"></x-slot>

     <div id="content" class="container py-5 my-5">
          <h3 class="fw-bold">Payment List</h3>
          <hr>

          <h4>Pending Payment</h4>
          <div class="table-responsive">
               <table class="table table-hover">
                    <thead>
                         <th class="align-middle text-center">PIC Name</th>
                         <th class="align-middle text-center">PIC Email</th>
                         <th class="align-middle text-center">Phone Number</th>
                         <th class="align-middle text-center">Institution Name</th>
                         <th class="align-middle text-center">Institution Email</th>
                         <th class="align-middle text-center">Institution Address</th>
                         <th class="align-middle text-center">Action</th>
                    </thead>
                    <tbody>
                         @foreach ($pending_payments as $pending_payment)
                              <tr>
                                   <td class="align-middle text-center">{{$pending_payment->pic_name}}</td>
                                   <td class="align-middle text-center">{{$pending_payment->pic_email}}</td>
                                   <td class="align-middle text-center">{{$pending_payment->phone_number}}</td>
                                   <td class="align-middle text-center">{{$pending_payment->institution_name}}</td>
                                   <td class="align-middle text-center">{{$pending_payment->institution_email}}</td>
                                   <td class="align-middle text-center">{{$pending_payment->institution_address}}</td>

                                   <td class="align-middle text-center">
                                        <a href="/storage/payment/{{$pending_payment->transfer_proof}}" class="btn btn-primary" target="_blank">Proof</a>
                                        <a href="{{route('payment-confirm',$pending_payment->id)}}"
                                             class="btn btn-success">Confirm</a>
                                        <a href="{{route('payment-reject',$pending_payment->id)}}"
                                                  class="btn btn-danger">Reject</a>
                                   </td>
                              </tr>
                         @endforeach
                    </tbody>
               </table>
          </div>

          <h4 class="mt-5">Confirmed Payment</h4>
          <div class="table-responsive">
               <table class="table table-hover">
                    <thead>
                         <th class="align-middle text-center">PIC Name</th>
                         <th class="align-middle text-center">PIC Email</th>
                         <th class="align-middle text-center">Phone Number</th>
                         <th class="align-middle text-center">Institution Name</th>
                         <th class="align-middle text-center">Institution Email</th>
                         <th class="align-middle text-center">Institution Address</th>
                         <th class="align-middle text-center">Confirmed Time</th>
                    </thead>
                    <tbody>
                         @foreach ($confirmed_payments as $pending_payment)
                              <tr>
                                   <td class="align-middle text-center">{{$pending_payment->pic_name}}</td>
                                   <td class="align-middle text-center">{{$pending_payment->pic_email}}</td>
                                   <td class="align-middle text-center">{{$pending_payment->phone_number}}</td>
                                   <td class="align-middle text-center">{{$pending_payment->institution_name}}</td>
                                   <td class="align-middle text-center">{{$pending_payment->institution_email}}</td>
                                   <td class="align-middle text-center">{{$pending_payment->institution_address}}</td>
                                   <td class="align-middle text-center">{{$pending_payment->updated_at}}</td>
                              </tr>
                         @endforeach
                    </tbody>
               </table>
          </div>
     </div>
</x-app>