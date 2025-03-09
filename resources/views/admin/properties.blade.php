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
                <legend>Properties</legend>
                <form method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" name="name" value="" placeholder="Enter property name"
                                    class="form-control" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="inputEmail">Property Type</label>
                                <select class="form-control" name="property_type_id" required>
                                    <option value="">Select</option>
                                    @forelse ($propertyTypes as $propertyType)
                                        <option value="{{ $propertyType->id }}">{{ $propertyType->name }}</option>
                                    @empty
                                        <option value="others">No Property Type</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Location</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="location_id"
                                    id="" required>
                                    <option value="">Select</option>
                                    @forelse ($locations as $location)
                                        <option value="{{ $location->id ?? 'None' }}">{{ $location->name ?? 'None' }}
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
                                        <option value="{{ $saleType->id ?? 'None' }}">{{ $saleType->name ?? 'None' }}
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
                                <input type="number" name="price" value="" placeholder="Enter price"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Address</label>
                                <input type="text" name="address" value="" placeholder="Enter property address"
                                    class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Square Footage</label>
                                <input type="text" name="square_footage" value="" placeholder="e.g 1000 Sqft"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Bedrooms</label>
                                <input type="number" name="bed" value="" placeholder="Enter number of bedrooms"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Bath</label>
                                <input type="number" name="bath" value=""
                                    placeholder="Enter number of bathrooms & toilets" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Property Description</label>
                                <textarea name="description" id="summernote" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Images</label>
                                <input type="file" id="image-input" class="form-control" name="images[]"
                                    accept="image/*" multiple
                                    onchange="Array.from(this.files).some(file => file.size > 2097152) ? (alert('Each file must be less than 2MB!'), this.value='') : previewImages(event);">
                                <div id="preview-container" class="mt-2"></div>
                            </div>
                        </div>
                    </div>

                    <a class="btn btn-warning" href="{{ url()->previous() }}">Back</a>
                    <button class="btn btn-primary" type="submit">Save</button>
                    <hr>
                    <hr>
                </form>
            </div>

            <div class="row col-lg-12">
                @forelse ($properties as $property)
                    <div class="card m-2" style="width: 18rem;">
                        @php
                            // Decode the JSON-encoded images to get an array of filenames
                            $images = json_decode($property->image);
                            $firstImage = $images[0] ?? null; // Get the first image if available
                        @endphp
                        <img class="card-img-top"
                            src="{{ $firstImage ? asset('storage/properties/' . $firstImage) : '' }}" alt="">
                        {{-- <img class="card-img-top" src="{{ asset('properties' . '/' . $property->image) ?? '' }}" alt=""> --}}
                        <div class="card-body">
                            <p class="card-text"><b>Title:</b> <small>{{ Str::limit($property->name, 50) ?? '-' }} </small>
                            </p>
                            <div class="row">
                                <div class="d-flex">
                                    <a class="btn btn-primary mx-2 btn-sm"
                                        href="/admin/edit/property?id={{ base64_encode($property->id) ?? '' }}">
                                        <i class="fa fa-edit"></i> Edit</a>

                                    <a class="btn btn-danger mx-2 btn-sm"
                                        href="/admin/delete/property?id={{ base64_encode($property->id) ?? '' }}"
                                        onclick="return confirm('Are you sure you want to delete this property?')">
                                        <i class="fa fa-trash"></i> Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>

                @empty
                    <p>No result found</p>
                @endforelse

            </div>
        </div>
    </div>

    </div>
    </div>
    </div>

    <script src="/assets2/js/lib/jquery.min.js"></script>
    <script>
        let selectedImages = [];

        function previewImages(event) {
            const files = event.target.files;
            const previewContainer = document.getElementById("preview-container");

            Array.from(files).forEach((file, index) => {

                // Validate file size (2MB = 2097152 bytes)
                if (file.size > 2097152) {
                    alert(`"${file.name}" is too large! Each file must be less than 2MB.`);
                    return; // Skip this file
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    const imageId = `image-${selectedImages.length}`;
                    selectedImages.push(file);

                    const imagePreview = document.createElement("div");
                    imagePreview.classList.add("image-preview");
                    imagePreview.setAttribute("id", imageId);

                    imagePreview.innerHTML = `
                    <img src="${e.target.result}">
                    <button type="button" class="remove-btn" onclick="removeImage('${imageId}')">✕</button>
                    <input type="hidden" name="images[]" value="${e.target.result}">
                `;

                    previewContainer.appendChild(imagePreview);
                };
                reader.readAsDataURL(file);
            });

            event.target.value = "";
        }

        function removeImage(imageId) {
            document.getElementById(imageId).remove();
            selectedImages = selectedImages.filter((_, index) => `image-${index}` !== imageId);
        }
    </script>
@endsection
