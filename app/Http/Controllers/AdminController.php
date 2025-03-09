<?php

namespace App\Http\Controllers;

use App\Models\Allow;
use App\Models\Contact;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\Location;
use App\Models\PropertiesBooked;
use App\Models\Property;
use App\Models\PropertyAgent;
use App\Models\PropertyType;
use App\Models\SaleType;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{

    public function dashboard(Request $request)
    {
        $allow_reg = Allow::with('user')->first();
        return view('admin.dashboard', ['allow_reg' => $allow_reg]);
    }
    // allow_reg

    public function allow_reg(Request $request)
    {
        if ($request->isMethod('POST')) {
            $request->validate([
                'allow_reg' => 'required'
            ]);

            try {

                if ($request->id != null) {
                    $allow = Allow::find($request->id);
                    $allow->allow_reg = $request->allow_reg;
                    $allow->user_id = Auth::user()->id;
                    $allow->save();
                    return back()->withSuccess('Successful');
                } else {
                    $allow = new Allow();
                    $allow->allow_reg = $request->allow_reg;
                    $allow->user_id = Auth::user()->id;
                    $allow->save();
                    return back()->withSuccess('Successful');
                }
            } catch (\Exception $e) {
                // Log the exception message for debugging
                // \Log::error($e->getMessage());
                return back()->withErrors('Something went wrong');
            }
        }
    }

    public function locations(Request $request)
    {
        if ($request->isMethod('POST')) {
            try {
                DB::beginTransaction();
                $user_id = Auth::user()->id;
                $createLocation = Location::updateOrCreate(
                    [
                        'id' => $request->id,
                    ],
                    [
                        'user_id' => $user_id,
                        'name' => $request->name,
                    ]
                );

                DB::commit();
                return back()->withSuccess('Successful');
            } catch (\Exception $e) {
                return back()->withErrors('Something went wrong');
            }
        }
        $locations = Location::orderBy('created_at', 'desc')->get();
        return view('admin.locations', compact('locations'));
    }

    public function editLocation(Request $request)
    {
        $location =  Location::find(base64_decode($request->id));
        return view('admin.edit_location', ['location' => $location]);
    }

    public function deleteLocation(Request $request)
    {
        if ($request->id) {
            $location = Location::find(base64_decode($request->id));
            try {
                // Check if the record exists
                if (!$location) {
                    return back()->with(['error' => 'Location not found.']);
                }
                // Delete the record
                $location->delete();
                return back()->withSuccess('Successful');
            } catch (\Exception $e) {
                return back()->withErrors('Something went wrong');
            }
        }
    }

    public function categories(Request $request)
    {
        if ($request->isMethod('POST')) {
            try {
                DB::beginTransaction();
                $user_id = Auth::user()->id;
                $createSaleType = SaleType::updateOrCreate(
                    [
                        'id' => $request->id,
                    ],
                    [
                        'user_id' => $user_id,
                        'name' => $request->name,
                    ]
                );

                DB::commit();
                return back()->withSuccess('Successful');
            } catch (\Exception $e) {
                return back()->withErrors('Something went wrong');
            }
        }
        $saleTypes = SaleType::orderBy('created_at', 'desc')->get();
        return view('admin.categories', compact('saleTypes'));
    }

    public function editCategories(Request $request)
    {
        $saleType =  SaleType::find(base64_decode($request->id));
        return view('admin.edit_categories', ['saleType' => $saleType]);
    }

    public function deleteCategories(Request $request)
    {
        if ($request->id) {
            $saleType = SaleType::find(base64_decode($request->id));
            try {
                // Check if the record exists
                if (!$saleType) {
                    return back()->with(['error' => 'Categories not found.']);
                }
                // Delete the record
                $saleType->delete();
                return back()->withSuccess('Successful');
            } catch (\Exception $e) {
                return back()->withErrors('Something went wrong');
            }
        }
    }

    public function propertyTypes(Request $request)
    {
        $propertyTypes = PropertyType::orderBy('id', 'desc')->get();

        if ($request->isMethod('POST')) {
            try {
                $user_id = Auth::user()->id;
                $oldImage = $request->old_photo ?? null;
                $filename = $oldImage; // Default to old image if not changing

                if ($request->hasFile('image')) {
                    // Get the new file from the form
                    $image = $request->file('image');

                    // Generate a unique filename
                    $filename = time() . '.' . $image->getClientOriginalExtension();

                    // Resize the image using Intervention Image
                    $resizedImage = Image::make($image)->resize(500, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize(); // Prevents upsizing
                    })->encode();

                    // Define the path where the image will be saved
                    // $destinationPath = public_path('/properttypes');
                    $destinationPath = storage_path('app/public/properttypes');

                    // Create the folder if it doesn't exist
                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 0755, true);
                    }

                    // Save the resized image
                    // file_put_contents($destinationPath . '/' . $filename, $resizedImage);
                    Storage::disk('public')->put("properttypes/{$filename}", $resizedImage);

                    if ($oldImage && Storage::disk('public')->exists("properttypes/{$oldImage}")) {
                        Storage::disk('public')->delete("properttypes/{$oldImage}");
                    }
                }

                PropertyType::updateOrCreate(
                    ['id' => $request->id],
                    [
                        'user_id' => $user_id,
                        'image' => $filename,
                        'name' => $request->name,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );

                return redirect('/admin/property/types')->withSuccess('Successful');
            } catch (\Exception $e) {
                return back()->withError('Something went wrong');
            }
        }

        return view('admin.propertytypes', ['propertyTypes' => $propertyTypes]);
    }

    public function editPropertyType(Request $request)
    {

        $propertyType =  PropertyType::find(base64_decode($request->id));
        return view('admin.edit_propertytype', ['propertyType' => $propertyType]);
    }

    public function deletePropertyType(Request $request)
    {
        if ($request->id) {
            $propertyType = PropertyType::find(base64_decode($request->id));
            try {
                // Check if the record exists
                if (!$propertyType) {
                    return back()->with(['error' => 'Property Type not found.']);
                }

                // Get the image filename from the database
                $imagePath = "properttypes/{$propertyType->image}";

                // Check if the image exists and delete it
                if (Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }

                // Delete the record
                $propertyType->delete();

                return back()->withSuccess('Successful');
            } catch (\Exception $e) {
                return back()->withErrors('Something went wrong');
            }
        }
    }

    public function properties(Request $request)
    {

        $properties = Property::orderBy('id', 'desc')->get();
        $propertyTypes = PropertyType::orderBy('id', 'desc')->get();
        $locations = Location::orderBy('id', 'desc')->get();
        $saleTypes = SaleType::orderBy('id', 'desc')->get();
        if ($request->isMethod('POST')) {
            try {
                $user_id = Auth::user()->id;
                $savedImages = [];
                $oldImages = json_decode($request->old_photo, true) ?? []; // Ensure oldImages is an array

                // Remove any images marked for deletion
                $removedImages = json_decode($request->removed_images, true);
                if ($removedImages) {
                    foreach ($removedImages as $removedImage) {
                        $imagePath = "properties/{$removedImage}"; // Relative path in storage

                        // Check if the file exists in storage and delete it
                        if (Storage::disk('public')->exists($imagePath)) {
                            Storage::disk('public')->delete($imagePath);
                        }
                        // Remove the deleted image from the old images array
                        $oldImages = array_diff($oldImages, [$removedImage]);
                    }
                }

                // Check if there are images in the 'image' array input
                if ($request->has('images') && is_array($request->images)) {
                    foreach ($request->images as $key => $base64Image) {
                        if (strpos($base64Image, 'data:image') !== false) {
                            list($type, $data) = explode(';', $base64Image);
                            list(, $data) = explode(',', $data);

                            $decodedData = base64_decode($data);
                            if (!$decodedData) {
                                continue;
                            }

                            // Extract file extension
                            preg_match('/^data:image\/(\w+);base64,/', $base64Image, $matches);
                            $extension = $matches[1] ?? 'png';

                            // Generate a unique filename
                            $filename = time() . '_image_' . $key . '.' . $extension;

                            // // Save the file
                            // $destinationPath = public_path('/properties');
                            // if (!file_exists($destinationPath)) {
                            //     mkdir($destinationPath, 0755, true);
                            // }

                            // Save the file using Laravel storage
                            // file_put_contents($destinationPath . '/' . $filename, $decodedData);
                            Storage::disk('public')->put("properties/{$filename}", $decodedData);

                            // Add the saved image to the array
                            $savedImages[] = $filename;
                        }
                    }
                }
                // Merge old images and new images
                $allImages = array_merge($oldImages, $savedImages);

                Property::updateOrCreate(
                    [
                        'id' => $request->id,
                    ],
                    [
                        'user_id' => $user_id,
                        'property_type_id' => $request->property_type_id,
                        'location_id' => $request->location_id,
                        'sale_type_id' => $request->sale_type_id,
                        'name' => $request->name,
                        'price' => $request->price,
                        'address' => $request->address,
                        'square_footage' => $request->square_footage,
                        'bed' => $request->bed,
                        'bath' => $request->bath,
                        'description' => $request->description,
                        'image' => json_encode($allImages), // Store the updated images list
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
                return redirect('/admin/properties')->withSuccess('Successful');
            } catch (\Exception $e) {
                return back()->withError('Something went wrong', $e);
            }
        }

        return view('admin.properties', compact('properties', 'propertyTypes', 'locations', 'saleTypes'));
    }

    public function editProperty(Request $request)
    {
        $property =  Property::find(base64_decode($request->id));
        $propertyTypes = PropertyType::orderBy('created_at', 'desc')->get();
        $locations = Location::orderBy('created_at', 'desc')->get();
        $saleTypes = SaleType::orderBy('created_at', 'desc')->get();
        return view('admin.edit_property', compact('property', 'propertyTypes', 'locations', 'saleTypes'));
    }

    public function deleteProperty(Request $request)
    {
        if ($request->id) {
            $property = Property::find(base64_decode($request->id));
            try {
                // Check if the record exists
                if (!$property) {
                    return back()->with(['error' => 'Property not found.']);
                }

                // Decode the images stored in the property (assuming it's a JSON string)
                $images = json_decode($property->image, true) ?? [];

                // Delete each image file if it exists
                foreach ($images as $image) {
                    $imagePath = public_path('properties/' . $image);

                    // Check if the image exists in storage and delete it
                    if (Storage::disk('public')->exists($imagePath)) {
                        Storage::disk('public')->delete($imagePath);
                    }
                }

                // Delete the record
                $property->delete();
                return back()->withSuccess('Property deleted successfully.');
            } catch (\Exception $e) {
                return back()->withErrors('Something went wrong: ' . $e->getMessage());
            }
        }

        return back()->with(['error' => 'No property ID provided.']);
    }

    public function propertAgents(Request $request)
    {
        $propertyAgents = PropertyAgent::orderBy('id', 'desc')->get();

        if ($request->isMethod('POST')) {
            try {
                $user_id = Auth::user()->id;
                $oldImage = $request->old_photo ?? null;
                $filename = $oldImage; // Default to old image if not changing

                if ($request->hasFile('image')) {
                    // Get the new file from the form
                    $image = $request->file('image');

                    // Generate a unique filename
                    $filename = time() . '.' . $image->getClientOriginalExtension();

                    // Resize the image using Intervention Image
                    $resizedImage = Image::make($image)->resize(500, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize(); // Prevents upsizing
                    })->encode();

                    // Define the path where the image will be saved
                    // $destinationPath = public_path('/propertyagents');
                    $destinationPath = storage_path('app/public/propertyagents');

                    // Create the folder if it doesn't exist
                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 0755, true);
                    }

                    // Save the resized image
                    // file_put_contents($destinationPath . '/' . $filename, $resizedImage);
                    // // Delete the old image if it exists and is different from the new one
                    // if ($oldImage && file_exists($destinationPath . '/' . $oldImage)) {
                    //     unlink($destinationPath . '/' . $oldImage);
                    // }

                    Storage::disk('public')->put(
                        "propertyagents/{$filename}",
                        $resizedImage
                    );
                    if ($oldImage && Storage::disk('public')->exists("propertyagents/{$oldImage}")) {
                        Storage::disk('public')->delete("propertyagents/{$oldImage}");
                    }
                }

                PropertyAgent::updateOrCreate(
                    ['id' => $request->id],
                    [
                        'user_id' => $user_id,
                        'name' => $request->name,
                        'position' => $request->position,
                        'facebook_link' => $request->facebook_link,
                        'twitter_link' => $request->twitter_link,
                        'instagram_link' => $request->instagram_link,
                        'image' => $filename,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );

                return redirect('/admin/property/agents')->withSuccess('Successful');
            } catch (\Exception $e) {
                return back()->withError('Something went wrong');
            }
        }

        return view('admin.propertyagent', compact('propertyAgents'));
    }


    public function editPropertyAgent(Request $request)
    {
        $propertyAgent =  PropertyAgent::find(base64_decode($request->id));
        return view('admin.edit_propertyagent', compact('propertyAgent'));
    }

    public function deletePropertyAgent(Request $request)
    {
        if ($request->id) {
            $propertyAgent = PropertyAgent::find(base64_decode($request->id));
            try {
                // Check if the record exists
                if (!$propertyAgent) {
                    return back()->with(['error' => 'Property agent not found.']);
                }

                // Get the image filename from the database
                $imagePath = "propertyagents/{$propertyAgent->image}";

                // Check if the image exists and delete it
                if (Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }

                // Delete the record
                $propertyAgent->delete();
                return back()->withSuccess('Successful');
            } catch (\Exception $e) {
                return back()->withErrors('Something went wrong');
            }
        }
    }

    public function testimonials(Request $request)
    {
        $testimonials = Testimonial::orderBy('id', 'desc')->get();
        $locations = Location::orderBy('id', 'desc')->get();

        if ($request->isMethod('POST')) {
            try {
                $oldImage = $request->old_photo ?? null;
                $filename = $oldImage; // Default to old image if not changing

                if ($request->hasFile('image')) {
                    // Get the new file from the form
                    $image = $request->file('image');

                    // Generate a unique filename
                    $filename = time() . '.' . $image->getClientOriginalExtension();

                    // Resize the image using Intervention Image
                    $resizedImage = Image::make($image)->resize(500, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize(); // Prevents upsizing
                    })->encode();

                    // Define the path where the image will be saved
                    // $destinationPath = public_path('/testimonials');
                    $destinationPath = storage_path('app/public/testimonials');

                    // Create the folder if it doesn't exist
                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 0755, true);
                    }

                    // Save the new image
                    // file_put_contents($destinationPath . '/' . $filename, $resizedImage);
                    // // Delete the old image if it exists and is different from the new one
                    // if ($oldImage && file_exists($destinationPath . '/' . $oldImage)) {
                    //     unlink($destinationPath . '/' . $oldImage);
                    // }

                    Storage::disk('public')->put(
                        "testimonials/{$filename}",
                        $resizedImage
                    );
                    if ($oldImage && Storage::disk('public')->exists("testimonials/{$oldImage}")) {
                        Storage::disk('public')->delete("testimonials/{$oldImage}");
                    }
                }

                Testimonial::updateOrCreate(
                    ['id' => $request->id],
                    [
                        'client_name' => $request->client_name,
                        'profession' => $request->profession,
                        'image' => $filename,
                        'content' => $request->content,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );

                return redirect('/admin/testimonials')->withSuccess('Successful');
            } catch (\Exception $e) {
                return back()->withError('Something went wrong');
            }
        }

        return view('admin.testimonials', ['testimonials' => $testimonials, 'locations' => $locations]);
    }

    public function editTestimonail(Request $request)
    {

        $testimonial =  Testimonial::find(base64_decode($request->id));
        return view('admin.edit_testimonial', ['testimonial' => $testimonial]);
    }

    public function deleteTestimonial(Request $request)
    {
        if ($request->id) {
            $testimonials = Testimonial::find(base64_decode($request->id));
            try {
                // Check if the record exists
                if (!$testimonials) {
                    return back()->with(['error' => 'Testimonial not found.']);
                }

                // Get the image filename from the database
                $imagePath = "testimonials/{$testimonials->image}";

                // Check if the image exists and delete it
                if (Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }

                // Delete the record
                $testimonials->delete();
                return back()->withSuccess('Successful');
            } catch (\Exception $e) {
                return back()->withErrors('Something went wrong');
            }
        }
    }

    public function propertiesBooked(Request $request)
    {
        $propertiesbooked = PropertiesBooked::with('property')->paginate();
        return view('admin.propertiesbooked', ['propertiesbooked' => $propertiesbooked]);
    }

    public function transactions(Request $request)
    {
        $transactions = Transaction::with('property')->paginate();
        return view('admin.transactions', ['transactions' => $transactions]);
    }

    // contacts
    public function contacts()
    {
        $contacts = Contact::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.contacts', ['contacts' => $contacts]);
    }

    // delete contact
    public function deleteContact($id)
    {
        $contact = Contact::find(base64_decode($id));
        if ($contact) {
            $contact->delete();
            return back()->with('success', 'Message deleted successfully');
        }
        return back()->with('error', 'Message not found');
    }

    public function faqs(Request $request)
    {
        if ($request->isMethod('POST')) {
            try {
                DB::beginTransaction();
                $creatfaqs = Faq::updateOrCreate(
                    [
                        'id' => $request->id,
                    ],
                    [
                        'title' => $request->title,
                        'content' => $request->content,
                    ]
                );

                DB::commit();
                return back()->withSuccess('Successful');
            } catch (\Exception $e) {
                return back()->withErrors('Something went wrong');
            }
        }
        $faqs = Faq::get();
        // dd($services);
        return view('admin.faqs', compact('faqs'));
    }

    public function editFaqs(Request $request)
    {
        $faq =  Faq::find(base64_decode($request->id));
        return view('admin.edit_faqs', ['faq' => $faq]);
    }

    public function deletefaqs(Request $request)
    {
        if ($request->id) {
            $faq = Faq::find(base64_decode($request->id));
            try {
                // Check if the record exists
                if (!$faq) {
                    return back()->with(['error' => 'Faq not found.']);
                }
                // Delete the record
                $faq->delete();
                return back()->withSuccess('Successful');
            } catch (\Exception $e) {
                return back()->withErrors('Something went wrong');
            }
        }
    }

    public function services(Request $request)
    {
        $services = Service::all();
        $locations =  Location::all();
        if ($request->isMethod('POST')) {
            try {
                if ($request->hasFile('photo')) {

                    $folderName = 'Services';
                    $file = $request->file('photo');
                    $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                    // resize the image using the Intervention Image library
                    $resizedFile = Image::make($file)->resize(800, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->encode();
                    // save the file to the storage disk
                    Storage::disk('public')->put($folderName . '/' . $filename, $resizedFile);
                    // save the file path to the database
                    $photo = $folderName . '/' . $filename;
                }

                Service::updateOrCreate(
                    [
                        'id' => $request->id,
                    ],
                    [
                        'photo' => $photo ?? $request->old_photo,
                        'name' => $request->name,
                        'desc' => $request->desc,
                        // 'branch' => $request->branch,
                        'user_id' => auth()->user()->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
                return redirect('/admin/services')->withSuccess('Successful');
            } catch (\Exception $e) {
                return back()->withError('Something went wrong');
            }
        }

        return view('admin.services', ['services' => $services, 'locations' => $locations]);
    }

    public function edit_service(Request $request)
    {

        $edit_service =  Service::find(base64_decode($request->id));
        return view('admin.edit_service', ['edit_service' => $edit_service]);
    }


    // gallery
    public function galleries(Request $request)
    {
        $sliders = Gallery::all();
        // dd($sliders);
        return view('admin.galleries', ['sliders' => $sliders]);
    }

    // slider
    public function gallery(Request $request)
    {
        if ($request->id) {
            $photo = Gallery::find(base64_decode($request->id));
            // dd($slider);
            if ($request->isMethod('POST')) {
                try {
                    $this->add_photo($request, $photo, "Gallery");
                    return back()->withSuccess('Successful');
                } catch (\Exception $e) {
                    return back()->withErrors('Something went wrong');
                }
            }
            return view('admin.gallery', ['slider' => $photo]);
        } else {

            $new_photo = new Gallery();
            if ($request->isMethod('POST')) {
                try {
                    $this->add_photo($request, $new_photo, 'Gallery');
                    return back()->withSuccess('Successful');
                } catch (\Exception $e) {
                    return back()->withErrors('Something went wrong');
                }
            }
            return view('admin.gallery');
        }
    }

    function add_photo(Request $request, $photo, $folderName)
    {
        $request->validate([
            'photo' => 'required|image',
        ]);

        $photo->desc = $request->desc;
        $photo->user_id = Auth::user()->id;

        // image
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();

            // save the file to the storage disk
            $file->storeAs($folderName, $filename, 'public');

            // save the file path to the database
            $photo->photo = $folderName . '/' . $filename;
        }
        $photo->save();
    }

    // delete image

    public function delete_photo(Request $request)
    {
        if ($request->id) {
            $photo = Gallery::find(base64_decode($request->id));
            try {
                if ($photo->photo) {
                    // dd($photo->photo);
                    Storage::delete('public/' . $photo->photo);

                    $photo->delete();
                    return back()->withSuccess('Successful');
                }
            } catch (\Exception $e) {
                return back()->withErrors('Something went wrong');
            }
        }
    }
}
