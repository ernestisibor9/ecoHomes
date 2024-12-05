<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\StatusMail;
use App\Models\SellMyProperty;
use App\Models\User;
use App\Models\UserProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SellerController extends Controller
{
    // All Seller
    public function AllSeller()
    {
        // Fetch all pending properties
        $properties = SellMyProperty::latest()->get();

        return view('admin.backend.sellers.all_sellers', compact('properties'));
    }
    // Change Status
    public function ChangeStatus($id, $status)
    {
        $statusId = SellMyProperty::findOrFail($id);

        // Validate and change the status
        $allowedStatuses = ['pending', 'approved', 'rejected'];
        if (in_array($status, $allowedStatuses)) {
            $statusId->status = $status;
        } else {
            return redirect()->back()->with('error', 'Invalid status.');
        }

        //  if($statusId->status == "approved") {
        //     $progress = UserProgress::where('user_id', $id)->firstOrFail();
        //     $progress->update(['status' => 'approved', 'current_step' => 'step2']);
        //  }

        $statusId->save();

        $notification = array(
            'message' => 'Status Changed to ' . ucfirst($statusId->status),
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    // Admin approval action
    public function AdminApprove($userId)
    {
        $progress = UserProgress::where('user_id', $userId)->firstOrFail();
        $progress->update(['status' => 'approved', 'current_step' => 'step2']);

        // Notify user
        // $user = User::findOrFail($userId);
        // Mail::to($user->email)->send(new StatusNotification([
        //     'message' => 'Your property submission has been approved. Please proceed to Step 2.',
        //     'link' => route('form.step2')
        // ]));

        $notification = array(
            'message' => 'Status Changed to ',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    // Change Status
    public function ChangeStatus2($id, $status)
    {
        // Fetch the UserProgress record and the associated user
        $statusId = UserProgress::with('user')->findOrFail($id);

        // Access the email from the related user
        $email = $statusId->user->email; // Assuming 'user' relationship is correctly defined and 'email' exists in the User model


        // Update the status
        if (in_array($status, ['pending', 'approved', 'rejected'])) {
            $statusId->status = $status;
            if ($statusId->status == 'approved') {
                $statusId->current_step = 'step2';
                $statusId->save();
            }

            $statusId->save();
        }

        if ($statusId->status == 'approved') {
            $data = [
                'Subject' => "Property Status",
                'Message' => 'Thank you for choosing EcoHomes as your trusted property platform. <br/> Your property submission has been approved. <br/> One of our expert will reach out to you soon. <br/> Please proceed to the next step.',
                'link' => route('form.step2')
            ];
            $notification = array(
                'message' => 'Property Type Created Successfully',
                'alert-type' => 'error'
            );
            if ($email) {
                Mail::to($email)->send(new StatusMail($data));
            } else {
                // Handle the error (e.g., log it or return a response)
                return redirect()->back()->with($notification);
            }
            Mail::to($email)->send(new StatusMail($data));
        }
        if ($statusId->status == 'rejected') {
            $data = [
                'Subject' => "Property Status",
                'Message' => 'Thank you for choosing EcoHomes as your trusted property platform. <br/> Your property submission has been rejected. <br/>One of our expert will reach out to you soon.',
            ];
            Mail::to($email)->send(new StatusMail($data));
        }
        if ($statusId->status == 'pending') {
            $data = [
                'Subject' => "Property Status",
                'Message' => 'Your property submission is pending.',
            ];
            Mail::to($email)->send(new StatusMail($data));
        }

        $statusId->save();

        $notification = array(
            'message' => 'Status Changed to ' .  ucfirst($statusId->status),
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    // AllSellerProgress
    public function AllSellerProgress()
    {
        // Fetch all pending properties
        $properties = UserProgress::latest()->get();

        return view('admin.backend.sellers.all_progress', compact('properties'));
    }







    // AllSellerProgress
    public function AllSellerProgress3()
    {
        // Fetch all pending properties
        $properties = UserProgress::latest()->get();

        return view('admin.backend.sellers.all_progress3', compact('properties'));
    }

    // Change Status
    public function ChangeStatus3($id, $status)
    {
        // Fetch the UserProgress record and the associated user
        $statusId = UserProgress::with('user')->findOrFail($id);

        // Access the email from the related user
        $email = $statusId->user->email; // Assuming 'user' relationship is correctly defined and 'email' exists in the User model


        // Update the status
        if (in_array($status, ['pending', 'approved', 'rejected'])) {
            $statusId->status = $status;
            if ($statusId->status == 'approved') {
                $statusId->current_step = 'step3';
                $statusId->save();
            }

            $statusId->save();
        }

        $data = [
            'Subject' => "Property Status",
            'Message' => 'Your property submission has been approved. Please proceed to Step 3.',
            'link' => route('form.step3')
        ];

        Mail::to($email)->send(new StatusMail($data));
        $statusId->save();

        $notification = array(
            'message' => 'Status Changed to ' .  ucfirst($statusId->status),
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
