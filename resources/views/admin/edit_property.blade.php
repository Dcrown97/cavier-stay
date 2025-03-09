@extends('layout.new')

<style>
    #preview-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        /* Adds space between images */
    }

    .image-preview {
        position: relative;
        display: inline-block;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    .image-preview img {
        max-height: 120px;
        border-radius: 8px;
        display: block;
    }

    .remove-btn {
        position: absolute;
        top: 5px;
        right: 5px;
        background: rgba(255, 0, 0, 0.8);
        color: white;
        border: none;
        border-radius: 50%;
        width: 24px;
        height: 24px;
        font-size: 14px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: 0.3s;
    }

    .remove-btn:hover {
        background: red;
    }
</style>

@section('contents')
    @include('flash.flash')

    <div class="container">
        <div class="bg-white row">
            <div class="col-md-12">
                <legend>Edit Property</legend>
                <form method="POST" action="/admin/properties" enctype="multipart/form-data">
                    @csrf
                    {{-- {{dd($property)}} --}}
                    <input type="hidden" name="id" value="{{ $property->id }}">
                    <input type="hidden" name="old_photo" value="{{ $property->image }}">
                    {{-- <input type="hidden" name="removed_images" id="removed_images" value=""> --}}
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" name="name" value="{{ $property->name ?? '' }}"
                                    placeholder="e.g ECG" class="form-control" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="inputEmail">Property Type</label>
                                <select class="form-control" name="property_type_id" required>
                                    <option value="">Select</option>
                                    @forelse ($propertyTypes as $propertyType)
                                        <option value="{{ $propertyType->id }}"
                                            {{ $property->property_type_id == $propertyType->id ? 'selected' : '' }}>
                                            {{ $propertyType->name }}</option>
                                    @empty
                                        <option value="others">No Property Type</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Location</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="location_id" required>
                                    <option value="">Select</option>
                                    @forelse ($locations as $location)
                                        <option value="{{ $location->id }}"
                                            {{ $property->location_id == $location->id ? 'selected' : '' }}>
                                            {{ $location->name }}
                                        </option>
                                    @empty
                                        <option value="others">No Location</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Sale Type</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="sale_type_id"
                                    id="" required>
                                    <option value="">Select</option>
                                    @forelse ($saleTypes as $saleType)
                                        <option value="{{ $saleType->id }}"
                                            {{ $property->sale_type_id == $saleType->id ? 'selected' : '' }}>
                                            {{ $saleType->name ?? 'None' }}
                                        </option>
                                    @empty
                                        <option value="others">No Sale Type</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Price</label>
                                <input type="number" name="price" value="{{ $property->price ?? '' }}"
                                    placeholder="Enter price" class="form-control">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Address</label>
                                <input type="text" name="address" value="{{ $property->address ?? '' }}"
                                    placeholder="Enter property address" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Square Footage</label>
                                <input type="text" name="square_footage" value="{{ $property->square_footage ?? '' }}"
                                    placeholder="e.g 1000 Sqft" class="form-control">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Bedrooms</label>
                                <input type="number" name="bed" value="{{ $property->bed ?? '' }}"
                                    placeholder="Enter number of bedrooms" class="form-control">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Bath</label>
                                <input type="number" name="bath" value="{{ $property->bath ?? '' }}"
                                    placeholder="Enter number of bathrooms & toilets" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Property Description</label>
                                <textarea name="description" id="summernote" cols="30" rows="10">{{ $property->description ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Dynamic Image Upload Section -->
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Images</label>
                                <!-- Add More Images -->
                                <div class="mt-2 mb-2">
                                    <input type="file" id="image-input" name="images[]" class="form-control" multiple
                                        accept="image/*" onchange="Array.from(this.files).some(file => file.size > 2097152) ? (alert('Each file must be less than 2MB!'), this.value='') : handleNewImages(event);">
                                </div>
                                <div id="preview-container">
                                    <!-- Existing Images -->
                                    @foreach (json_decode($property->image) as $key => $image)
                                        <div class="image-preview" id="image-row-{{ $key }}">
                                            <img src="{{ asset('storage/properties/' . $image) }}">
                                            <button type="button" class="remove-btn"
                                                onclick="removeImage({{ $key }}, '{{ $image }}')">×</button>
                                            <input type="hidden" name="existing_images[]" value="{{ $image }}">
                                        </div>
                                    @endforeach
                                </div>

                                <input type="hidden" name="removed_images" id="removed_images">
                            </div>
                        </div>
                    </div>

                    <a class="btn btn-warning" href="{{ url()->previous() }}">Back</a>
                    <button class="btn btn-primary" type="submit">Save</button>
                    <hr>
                    <hr>
                </form>
            </div>

        </div>
    </div>

    <script src="/assets2/js/lib/jquery.min.js"></script>
    <script>
        let removedImages = [];

        function removeImage(index, imageName = null) {
            if (imageName) {
                removedImages.push(imageName); // Track removed images
                document.getElementById('removed_images').value = JSON.stringify(removedImages);
            }
            document.getElementById(`image-row-${index}`).remove();
        }

        function handleNewImages(event) {
            const files = event.target.files;
            const previewContainer = document.getElementById('preview-container');

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                
                // Validate file size (2MB = 2097152 bytes)
                if (file.size > 2097152) {
                    alert(`"${file.name}" is too large! Each file must be less than 2MB.`);
                    continue; // Skip this file
                }
                
                const reader = new FileReader();

                reader.onload = function(e) {
                    const base64String = e.target.result; // Get base64 string
                    const index = Date.now(); // Unique ID for new images

                    const imageField = document.createElement("div");
                    imageField.classList.add("image-preview");
                    imageField.setAttribute("id", `image-row-${index}`);

                    imageField.innerHTML = `
                    <img src="${base64String}">
                    <button type="button" class="remove-btn" onclick="removeImage(${index})">×</button>
                    <input type="hidden" name="images[]" value="${base64String}">
                `;

                    previewContainer.appendChild(imageField);
                };

                reader.readAsDataURL(file); // Convert file to base64
            }

            event.target.value = ""; // Reset input field
        }
    </script>
@endsection
