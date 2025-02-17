@php

@endphp

<style>
    .featured-img {
        width: 370px !important;
        height: 250px !important;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .featured-container {
        margin-top: -70px;
    }

    .feat {
        margin-top: -80px;
    }

    .feat-property {
        margin-top: 120px;
    }
</style>

<style>
    .rating {
        display: flex;
        flex-direction: row;
        justify-content: center;
        color: gold;
    }
</style>

<style>
    .search-bar {
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .property-card {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
        padding: 15px;
        border-radius: 10px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        background: #fff;
        transition: transform 0.2s ease-in-out;
    }

    /* .property-card:hover {
        transform: translateY(-5px);
    } */

    .property-image {
        width: 100%;
        height: 180px;
        /* Ensures uniform height */
        overflow: hidden;
        border-radius: 8px;
    }

    .property-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .property-details {
        flex-grow: 1;
        padding: 10px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .property-details h4 {
        font-size: 1rem;
        font-weight: bold;
        color: #333;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        margin-bottom: 5px;
    }

    .property-details p {
        font-size: 0.85rem;
        color: #555;
        margin-bottom: 5px;
        flex-grow: 1;
    }

    .price {
        font-size: 1rem;
        font-weight: bold;
        color: #dc3545;
        margin-bottom: 5px;
    }

    .property-info {
        font-size: 0.85rem;
        color: #777;
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .property-info span {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .btn-group {
        display: flex;
        justify-content: space-between;
        margin-top: 10px;
    }

    .theme-btn {
        font-size: 0.85rem;
        padding: 8px 12px;
        border-radius: 5px;
        text-decoration: none;
        transition: 0.3s;
    }

    .theme-btn:hover {
        opacity: 0.8;
    }

    .btn-danger {
        background-color: #dc3545;
        color: white;
        border: none;
        cursor: pointer;
    }

    .phone-number {
        display: none;
        font-size: 0.85rem;
    }




    @media (min-width: 768px) {
        .property-card {
            flex-direction: column;
            height: 100%;
        }

        .property-details {
            flex: 1;
        }

        .btn-group {
            flex-direction: row;
            justify-content: space-between;
        }
    }
</style>



<div class="container mt-5">
    <div class="row mt-4" id="property-list">
        @foreach ($listProperties as $property)
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="property-card">
                    <div class="property-image">
                        <img src="{{ !empty($property->property_thumbnail) ? url($property->property_thumbnail) : asset('frontend/feature-4.jpg') }}"
                            alt="Property Image">
                    </div>
                    <div class="property-details">
                        <h4>{{ $property->property_title }}</h4>
                        <p class="text-danger">{{ $property->property_variant }} for {{ $property->property_status }}</p>
                        <div class="price text-success">
                            @if ($currency == 'NGN')
                                ₦ {{ number_format($property->price, 2) }}
                            @else
                                {{ $currency . ' ' . number_format($property->price_converted, 2) }}
                            @endif
                        </div>
                        <div class="property-info">
                            @if ($property->bedroom)
                                <span><i class="fa fa-bed"></i> {{ $property->bedroom }} Bed</span>
                            @endif
                            @if ($property->bathroom)
                                <span><i class="fa fa-bath"></i> {{ $property->bathroom }} Bath</span>
                            @endif
                            @if ($property->toilet)
                                <span><i class="fa fa-toilet"></i> {{ $property->toilet }} Toilet</span>
                            @endif
                            @if ($property->property_type === 'land')
                                <span><i class="fa fa-ruler-combined"></i> {{ $property->size }}</span>
                            @endif
                        </div>
                        <p class="mt-2"><i class="fa fa-map-marker-alt"></i> {{ $property->state->name }},
                            {{ $property->country->name }}</p>
                        <p class="text-muted">{{ Str::limit($property->description, 100, '...') }}</p>
                        <div class="btn-group">
                            <a href="{{ url('list-property/details/' . $property->id . '/' . $property->property_slug) }}"
                                class="theme-btn btn-one btn-primary">View Details</a>
                            <!-- Show Phone Button -->
                            <button type="button" class="theme-btn btn-danger show-phone-btn"
                            onclick="showPhoneNumber(this, '{{ $property->owner_phone }}')">
                        Show Phone
                    </button>

                    <!-- Hidden Phone Number -->
                    <span class="phone-number d-none text-dark">
                        <i class="fa fa-phone"></i> <span class="phone-text"></span>
                    </span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {!! $listProperties->links('pagination::bootstrap-5') !!}

</div>


<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>


<script>
    function showPhoneNumber(button, phoneNumber) {
       // alert("Button Clicked!"); // Confirm function execution

        let phoneSpan = button.nextElementSibling;
        console.log("Phone Span Found:", phoneSpan); // Debugging

        if (!phoneSpan) {
            console.error("Phone span not found.");
            return;
        }

        let phoneTextSpan = phoneSpan.querySelector('.phone-text');
        console.log("Phone Text Span Found:", phoneTextSpan); // Debugging

        if (!phoneTextSpan) {
            console.error("Phone text span not found.");
            return;
        }

        phoneTextSpan.innerText = phoneNumber; // Set the phone number
        phoneSpan.classList.remove('d-none'); // Remove Bootstrap's `d-none` to show it
        phoneSpan.style.display = 'inline'; // Ensure it's visible
        button.style.display = 'none'; // Hide the button
    }
</script>


<script>
    document.getElementById("show-phone").addEventListener("click", function() {
        fetch('/track-action', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    action: "phone_number_clicked"
                })
            })
            .then(response => response.json())
            .then(data => console.log("Tracked:", data))
            .catch(error => console.error("Error:", error));
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        fetch('/track-action', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // For security
            },
            body: JSON.stringify({
                action: 'page_view'
            })
        });
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('location').addEventListener('input', function() {
            const query = this.value;
            if (query.length > 2) {
                fetch(`/api/locations2?query=${query}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Suggestions:', data); // Debugging
                        const suggestionsDiv = document.getElementById('suggestions');
                        suggestionsDiv.innerHTML = ''; // Clear previous suggestions

                        if (data.length > 0) {
                            data.forEach(item => {
                                const suggestion = document.createElement('div');
                                suggestion.textContent = item.name;
                                suggestion.style.cursor = 'pointer';
                                suggestion.addEventListener('click', () => {
                                    document.getElementById('location').value = item
                                        .name;
                                    suggestionsDiv.style.display = 'none';
                                });
                                suggestionsDiv.appendChild(suggestion);
                            });
                            suggestionsDiv.style.display = 'block';
                        } else {
                            suggestionsDiv.style.display = 'none';
                        }
                    })
                    .catch(error => console.error('Fetch error:', error));
            } else {
                document.getElementById('suggestions').style.display = 'none';
            }
        });
    });
</script>
<!-- deals-style-two end -->
