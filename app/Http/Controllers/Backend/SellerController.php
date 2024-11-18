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
    //
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
       public function ChangeStatus2($id){
        // Fetch the UserProgress record and the associated user
        $statusId = UserProgress::with('user')->findOrFail($id);

        // Access the email from the related user
        $email = $statusId->user->email; // Assuming 'user' relationship is correctly defined and 'email' exists in the User model

        if($statusId->status === 'pending'){
            $statusId->status = 'approved';
            $statusId->current_step = 'step2';
        }
        else{
            $statusId->status = 'pending';
        }
        $data = [
            'Message' => 'Your property submission has been approved. Please proceed to Step 2.',
            'link' => route('form.step2')
        ];

        Mail::to($email)->send(new StatusMail($data));
        $statusId->save();

        $notification = array(
            'message'=> 'Status Changed to ' .  ucfirst($statusId->status),
            'alert-type'=>'success'
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
}
