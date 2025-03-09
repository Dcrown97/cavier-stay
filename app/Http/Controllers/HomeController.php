<?php

namespace App\Http\Controllers;

use App\Mail\Messages;
use App\Models\Contact;
use App\Models\Location;
use App\Models\PropertiesBooked;
use App\Models\Property;
use App\Models\PropertyAgent;
use App\Models\PropertyType;
use App\Models\SaleType;
use App\Models\Testimonial;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $search_param = $request->search_name;
        $propertyTypeId = $request->property_type_id;
        $locationId = $request->location_id;
        $saleTypeId = $request->sale_type_id;
        $locations = Location::orderBy('created_at', 'desc')->get();
        $saleTypes = SaleType::orderBy('created_at', 'desc')->get();
        $propertyAgents = PropertyAgent::orderBy('created_at', 'desc')->get();
        $testimonials = Testimonial::orderBy('created_at', 'desc')->get();
        $propertyTypes = PropertyType::orderBy('created_at', 'desc')
            ->get();
        $properties = Property::when($search_param, function ($query, $search_param) {
            return $query->where('name', 'LIKE', '%' . $search_param . '%');
        })
            ->when($propertyTypeId, function ($query, $propertyTypeId) {
                return $query->where('property_type_id', $propertyTypeId);
            })
            ->when($locationId, function ($query, $locationId) {
                return $query->where('location_id', $locationId);
            })
            ->when($saleTypeId, function ($query, $saleTypeId) { // Add this line
                return $query->where('sale_type_id', $saleTypeId);
            })
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();
        return view('homepage.index', compact('locations', 'propertyTypes', 'propertyAgents', 'testimonials', 'properties', 'saleTypes'));
    }

    public function about()
    {
        $propertyAgents = PropertyAgent::orderBy('created_at', 'desc')->get();
        return view('homepage.about', compact('propertyAgents'));
    }

    public function contact()
    {
        $locations = Location::orderBy('created_at', 'desc')->get();
        return view('homepage.contact', compact('locations'));
    }

    public function contact_us(Request $request)
    {
        if ($request->isMethod('POST')) {
            // dd($request->all());
            $request->validate([
                'email' => 'required',
                'message' => 'required',
                // 'g-recaptcha-response' => ['required', new ReCaptcha]
            ], [
                // 'g-recaptcha-response.required' => 'Recaptcha is required'
            ]);
            try {
                DB::beginTransaction();
                $contact = new Contact();
                $contact->name = $request->name;
                $contact->email = $request->email;
                $contact->phone = $request->phone;
                $contact->location = $request->location;
                $contact->message = $request->message;
                $contact->save();
                DB::commit();

                // Send Email
                try {
                    $email = 'aisimiyuoluwadara@gmail.com';
                    $contact['subject'] = "Customer Message";
                    Mail::to($email)->send(new Messages($contact));
                } catch (\Exception $e) {
                    Log::info('Error sending email: ' . $e->getMessage());
                }
                return back()->with('success', 'Message sent successfully');
            } catch (\Exception $e) {
                return back()->with('error', 'Message sending failed');
            }
        }
    }

    public function testimonial()
    {
        $testimonials = Testimonial::orderBy('created_at', 'desc')->get();
        return view('homepage.testimonial', compact('testimonials'));
    }

    public function services()
    {
        return view('homepage.services');
    }

    public function propertyList(Request $request)
    {
        $search_param = $request->search_name;
        $propertyTypeId = $request->property_type_id;
        $locationId = $request->location_id;
        $saleTypeId = $request->sale_type_id;
        $locations = Location::orderBy('created_at', 'desc')->get();
        $saleTypes = SaleType::orderBy('created_at', 'desc')->get();
        $propertyTypes = PropertyType::orderBy('created_at', 'desc')->get();
        $properties = Property::when($search_param, function ($query, $search_param) {
            return $query->where('name', 'LIKE', '%' . $search_param . '%');
        })
            ->when($propertyTypeId, function ($query, $propertyTypeId) {
                return $query->where('property_type_id', $propertyTypeId);
            })
            ->when($locationId, function ($query, $locationId) {
                return $query->where('location_id', $locationId);
            })
            ->when($saleTypeId, function ($query, $saleTypeId) { // Add this line
                return $query->where('sale_type_id', $saleTypeId);
            })
            ->orderBy('created_at', 'desc')
            ->get();
        return view('homepage.property_list', compact('locations', 'propertyTypes', 'properties', 'saleTypes'));
    }

    public function propertyDetails($id)
    {
        $property = Property::where('id', $id)->with('propertyType', 'location', 'saleType')->first();
        return view('homepage.property_details', compact('property'));
    }

    public function propertyType()
    {
        $propertyTypes = PropertyType::orderBy('created_at', 'desc')
            ->get();
        return view('homepage.property_type', compact('propertyTypes'));
    }

    public function propertyAgent()
    {
        $propertyAgents = PropertyAgent::orderBy('created_at', 'desc')->get();
        return view('homepage.property_agent', compact('propertyAgents'));
    }

    public function buy_property($id)
    {
        $property = Property::where('id', base64_decode($id))->first();
        return view('homepage.buy_property', compact('property'));
    }

    public function save_payment(Request $request)
    {
        $paymentDetails = $request->input('response');
        $reference = $paymentDetails['reference'];

        // Verify payment
        $response = Http::withToken(env('PAYSTACK_SECRET_KEY'))
            ->get('https://api.paystack.co/transaction/verify/' . $reference);

        $paymentData = $response->json();
        // return $paymentData;

        if ($paymentData['status'] && $paymentData['data']['status'] == 'success') {
            // Payment was successful, save details to the database
            $property_id = $request->input('property_id');
            $total = $request->input('total');

            // Save to database (adjust to your actual data structure)
            $createPro = Transaction::create([
                'property_id' => $property_id,
                'amount' => $request->input('amount'),
                // 'charge' => $request->charge,
                'total' => $total,
                'trans_ref' => $reference,
                'email' => $request->input('email'),
                'full_name' => $request->input('full_name'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
                'status' => $paymentData['data']['status']
            ]);
            session()->flash('success', 'Payment successful');
            return response()->json(['success' => true, 'message' => 'Payment successful.']);
        } else {
            session()->flash('error', 'Payment failed');
            return response()->json(['error' => false, 'message' => 'Payment failed.']);
        }
    }

    public function handleWebhook(Request $request)
    {
        $event = $request->input('event');
        $data = $request->input('data');

        // Handle the webhook event
        if ($event === 'charge.success') {
            $reference = $data['reference'];
            $transaction = Transaction::where('trans_ref', $reference)->first();

            if ($transaction) {
                $transaction->update([
                    'status' => 'success',
                    // Update other fields as needed
                ]);
            }
        }
        return response()->json(['status' => 'success']);
    }

    public function bookProperties(Request $request)
    {
        if ($request->isMethod('POST')) {
            try {
                DB::beginTransaction();
                $response = PropertiesBooked::create([
                    'property_id' => $request->property_id,
                    'full_name' => $request->full_name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'amount' => $request->amount
                ]);
                DB::commit();
                session()->flash('success', 'Booked Successfully');
                $response = ["status" => "Approved", "success" => 'Booked Successfully!'];
                return  response()->json($response, 200);
            } catch (\Exception $e) {
                return back()->withErrors('Something went wrong');
            }
        }
    }

    public function error()
    {
        return view('error.404');
    }
}
