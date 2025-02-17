<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\ListProperty;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    // storeFeedback
        public function storeFeedback(Request $request, $id){
            $property = ListProperty::find($id);

            if (!$property) {
                return response()->json(['message' => 'Property not found'], 404);
            }

            $report = new Feedback();
            $report->list_property_id = $id;
            $report->email = $request->email;
            $report->name = $request->name;
            $report->subject = $request->subject;
            $report->message = $request->message;
            $report->save();

            // return response()->json(['message' => 'Report sent successfully'], 200);
            return redirect()->back()->with('success', 'Feedback sent successfully');
        }

            // allRequest
            public function showFeedback($id)
            {
                $feedback = Feedback::where('list_property_id', $id)->get();

                if ($feedback->isEmpty()) {
                    return response()->json(['error' => 'No feedback found for this property'], 404);
                }

                return response()->json($feedback);
            }




    }
