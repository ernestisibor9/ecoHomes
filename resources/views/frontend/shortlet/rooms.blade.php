@extends('frontend.master')

@section('home')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <style>
        .see {
            display: block !important;
        }
    </style>

    <style>
        /* Style the preview container to display images in a row */
        .preview-container {
            display: flex;
            gap: 10px;
            /* Add spacing between the images */
            flex-wrap: wrap;
            /* Allow the images to wrap if there's not enough space */
        }

        /* Style the images to have a fixed size */
        .preview-container img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            /* Maintain aspect ratio while filling the box */
        }
    </style>

    @include('components.progress-tracker', ['step' => 1])


    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow p-2">
                    <div class="card-body">
                        <h3 class="card-title text-center">Step 3: Add Room</h3>
                        <form action="{{ route('shortlet.store.rooms', $shortlet->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="inputEmail4" class="form-label">Room Name</label>
                                    <input type="text" class="form-control" id="" name="room_name">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputEmail4" class="form-label">Number of Guest</label>
                                    <input type="number" class="form-control" id="" name="number_of_guest">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="inputState" class="form-label">Is smoking allowed?</label>
                                    <select id="inputState" class="form-select" name="smoking">
                                        <option selected>Choose...</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputState" class="form-label">Is the bathroom private?</label>
                                    <select id="inputState" class="form-select" name="bathroom_status">
                                        <option selected>Choose...</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No, it's shared</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">What can guests use in this room</label>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="wifi"
                                                name="guest_facilities[]" value="WiFi">
                                            <label class="form-check-label" for="wifi">WiFi</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="parking"
                                                name="guest_facilities[]" value="Parking">
                                            <label class="form-check-label" for="parking">Parking</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="pool"
                                                name="guest_facilities[]" value="Swimming Pool">
                                            <label class="form-check-label" for="pool">Swimming Pool</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="gym"
                                                name="guest_facilities[]" value="Gym">
                                            <label class="form-check-label" for="gym">Gym</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="spa"
                                                name="guest_facilities[]" value="Spa">
                                            <label class="form-check-label" for="spa">Spa</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="restaurant"
                                                name="guest_facilities[]" value="Restaurant">
                                            <label class="form-check-label" for="restaurant">Restaurant</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="wifi"
                                                name="guest_facilities[]" value="Room service">
                                            <label class="form-check-label" for="room service">Room service</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="wifi"
                                                name="guest_facilities[]" value="Bar">
                                            <label class="form-check-label" for="bar">Bar</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="wifi"
                                                name="guest_facilities[]" value="Fitness center">
                                            <label class="form-check-label" for="fitness center">Fitness center</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="wifi"
                                                name="guest_facilities[]" value="Air conditioning">
                                            <label class="form-check-label" for="fitness center">Air conditioning</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="wifi"
                                                name="guest_facilities[]" value="Swimming pool">
                                            <label class="form-check-label" for="fitness center">Swimming pool</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="wifi"
                                                name="guest_facilities[]" value="Family rooms">
                                            <label class="form-check-label" for="fitness center">Family rooms</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-6">
                                    <label for="inputState" class="form-label">Bed type</label>
                                    <select id="inputState" class="form-select" name="bed_type"
                                        onchange="showBedDetails(this.value)">
                                        <option selected>Choose...</option>
                                        <option value="King Bed">King Bed</option>
                                        <option value="Queen Bed">Queen Bed</option>
                                        <option value="Twin Bed">Twin Bed</option>
                                        <option value="Sofa Bed">Sofa Bed</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputState" class="form-label">How many rooms of this type do you
                                        have?</label>
                                    <input type="number" class="form-control" id="" name="number_of_rooms">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label for="inputState" class="form-label">Describe the room</label>
                                    <textarea class="form-control" id="description" rows="3" name="description" required></textarea>
                                </div>
                            </div>

                            <div id="room-container">
                                <!-- Initial Room Group -->
                                <div class="room-group mb-3" id="room-template">
                                    <label>Room Type</label>
                                    <select name="rooms[0][room_type]" class="form-control">
                                        <option value="Single">Single</option>
                                        <option value="Double">Double</option>
                                        <option value="Suite">Suite</option>
                                        <option value="Twin">Twin</option>
                                        <option value="Twin/Double">Twin/Double</option>
                                        <option value="Triple">Triple</option>
                                        <option value="Quad">Quad</option>
                                        <option value="Family">Family</option>
                                        <option value="Studio">Studio</option>
                                        <option value="Apartment">Apartment</option>
                                    </select>
                                    <br><br>
                                    <label>Room Capacity</label>
                                    <select name="rooms[0][room_capacity]" class="form-control">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                    </select>
                                    <br><br>
                                    <label>Price Per Night</label>
                                    <input type="number" name="rooms[0][price_per_night]"
                                        class="form-control price-per-night" placeholder="Enter price per night"
                                        oninput="calculatePercentage(this)">

                                    <div class="row mt-3 percentage-row" style="display: none;">
                                        <div class="col-md-12">
                                            <label for="calculated_percentage" class="form-label">15% EcoHomes
                                                Commission</label>
                                            <input type="text" class="form-control calculated-percentage" readonly>
                                        </div>
                                    </div>
                                    <br><br>
                                    <!-- Image Upload Fields -->
                                    <label>Upload Images</label>
                                    <div class="image-inputs">
                                        <input type="file" name="rooms[0][images][]" class="form-control multiImg"
                                            multiple onchange="handleImageUpload(this, 'preview_img_0')">
                                    </div>
                                    <div class="row preview-container" id="preview_img_0"></div>
                                    <hr>
                                </div>
                            </div>

                            <!-- Add Room Button -->
                            <button type="button" id="add-room" class="btn btn-secondary">Add Another Room</button>

                            <!-- Navigation Buttons -->
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('shortlet.facilities', ['shortlet' => $shortlet->id]) }}"
                                    class="theme-btn btn-one bg-danger text-decoration-none mr-5" id="backButton">Back</a>
                                <button class="theme-btn btn-one" type="submit" id="nextButton">Next</button>
                            </div>

                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>


    <script>
        // Handle the calculation of the 15% commission
        function calculatePercentage(input) {
            const price = parseFloat(input.value);
            const commissionRow = input.closest('.room-group').querySelector('.percentage-row');
            const commissionInput = commissionRow.querySelector('.calculated-percentage');

            if (price && !isNaN(price)) {
                const commission = (price * 0.15).toFixed(2); // 15% commission
                commissionInput.value = `$${commission}`;
                commissionRow.style.display = 'block'; // Show the commission row
            } else {
                commissionRow.style.display = 'none'; // Hide if price is not entered
            }
        }

        // Add event listeners for images in newly added rooms
        let roomCount = 1; // Start at 1 since the first room is already there
        document.getElementById('add-room').addEventListener('click', function() {
            const roomTemplate = document.getElementById('room-template');
            const newRoom = roomTemplate.cloneNode(true);

            // Update name attributes with the new room count
            newRoom.innerHTML = newRoom.innerHTML.replace(/\[0\]/g, `[${roomCount}]`);

            // Clear values of input fields in the cloned room
            newRoom.querySelector('.price-per-night').value = '';
            newRoom.querySelector('.multiImg').value = ''; // Clear the file input

            // Generate a unique ID for the preview container
            const previewContainer = newRoom.querySelector('.preview-container');
            previewContainer.id = `preview_img_${roomCount}`;

            // Add event listener for image input in the cloned room
            const imageInput = newRoom.querySelector('.multiImg');
            imageInput.addEventListener('change', function() {
                handleImageUpload(this, previewContainer.id);
            });

            // Append the cloned room to the room container
            document.getElementById('room-container').appendChild(newRoom);
            roomCount++;
        });

        // Handle image upload and preview for each room
        function handleImageUpload(input, previewContainerId) {
            const data = input.files;
            const previewContainer = document.getElementById(previewContainerId);
            previewContainer.innerHTML = ''; // Clear previous previews

            Array.from(data).forEach(file => {
                if (/(\.|\/)(gif|jpeg|png|webp)$/i.test(file.type)) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.classList.add('thumb');
                        img.src = e.target.result;
                        img.width = 150;
                        img.height = 130;
                        previewContainer.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                }
            });
        }
    </script>
@endsection
