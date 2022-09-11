<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmPayment;
use App\Models\Institution;
use App\Models\RegistrationPayment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegistrationPaymentController extends Controller
{
    public function viewList()
    {
        return view('payment.list', [
            'pending_payments' =>  RegistrationPayment::where('is_confirmed', 0)->get(),
            'confirmed_payments' => RegistrationPayment::where('is_confirmed', 1)->get(),
        ]);
    }

    public function validateData(Request $request)
    {
        $request->validate([
            'pic_name' => 'required|string',
            'pic_email' => 'required|email|unique:registration_payments,pic_email',
            'institution_name' => 'required|string',
            'institution_email' => 'required|email|unique:registration_payments,pic_email',
            'institution_address' => 'required|string',
            'phone_number' => 'required|numeric|unique:registration_payments,pic_email'
        ]);

        return view('payment.create', [
            'request' => $request,
        ]);
    }

    public function create(Request $request)
    {

        $request->validate([
            'transfer_proof' => 'required|image|mimes:png,jpg,jpeg|max:999'
        ]);

        if ($request->hasFile('transfer_proof')) {
            $extension = $request->file('transfer_proof')->getClientOriginalExtension();
            $file_name = $request->institution_name . '_' . time() . '.' . $extension;
            $request->file('transfer_proof')->storeAs('public/payment', $file_name);
        } else {
            $file_name = NULL;
        }

        RegistrationPayment::create([
            'pic_name' => $request->pic_name,
            'pic_email' => $request->pic_email,
            'institution_name' => $request->institution_name,
            'institution_email' => $request->institution_email,
            'institution_address' => $request->institution_address,
            'phone_number' => $request->phone_number,
            'transfer_proof' => $file_name
        ]);

        return redirect()->route('home')->with('success', 'Payment Submitted, Please check your email for the update for us');
    }

    public function confirm(RegistrationPayment $payment)
    {

        if ($payment->is_confirmed == 0) {
            $payment->update([
                'is_confirmed' => 1,
            ]);

            Institution::create([
                'name' => $payment->institution_name,
                'email' => $payment->institution_email,
                'address' => $payment->institution_address,
                'phone_number' => $payment->phone_number,
            ]);

            $institution = Institution::where('name', $payment->institution_name)->first();

            User::create([
                'name' => $payment->pic_name,
                'email' => $payment->pic_email,
                'phone_number' => $payment->phone_number,
                'reg_number' => '0',
                'role_id' => 1,
                'institution_id' => $institution->id,
                'password' => Hash::make('ADMIN' . $institution->id),
            ]);

            Mail::to($payment->pic_email)->send(new ConfirmPayment($payment->pic_email, 'ADMIN' . $institution->id));
        }
        return redirect()->back()->with('success', 'Payment confirmed, PIC Account created');
    }

    public function reject()
    {
    }
}
