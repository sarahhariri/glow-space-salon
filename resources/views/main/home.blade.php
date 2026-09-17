<x-layout title="Home" :settings="$settings">
    <x-carousel :slides="$slides" />
  
    <x-about-us :aboutImages="$aboutImages"  />
   
     
      
   
   
      <x-services :services="$services" />

    
      <x-team  :team="$team"/>

     <section id="booking-app" class="booking-cta">
      <div class="booking-overlay"></div>

      <div class="booking-content text-center">
        <span class="booking-label">Your Beauty Moment Awaits</span>

        <h2>Your Luxury Beauty Experience Begins Here</h2>

        <p>
            Reserve your personalized appointment with our expert beauty specialists.
        </p>

        <a href="{{ route('appointments.create') }}" class="booking-btn">
            Book Your Appointment
            <i class="bi bi-arrow-right ms-2"></i>
        </a>
       </div>
    </section>

    <x-review :reviews="$reviews" />

       <section class="gallery py-5">
        <div class="container">

            <div class="main-heading text-center mb-4">
                <h3>Our Gallery</h3>
                <p class="main-subtitle">
                    Discover our latest beauty transformations and salon moments.
                </p>
            </div>

            <div class="row justify-content-center g-4">

                <div class="col-md-6 col-lg-4">
                    <div class="gallery-item">
                        <img src="{{ asset('assets/images/gallery/hair1.jpeg') }}" alt="Hair Styling">
                        <div class="overlay">
                            <h4>Hair Styling</h4>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="gallery-item">
                        <img src="{{ asset('assets/images/gallery/makeup1.jpeg') }}" alt="Makeup">
                        <div class="overlay">
                            <h4>Makeup</h4>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="gallery-item">
                        <img src="{{ asset('assets/images/gallery/nail1.jpeg') }}" alt="Nail Care">
                        <div class="overlay">
                            <h4>Nail Care</h4>
                        </div>
                    </div>
                </div>


                <div class="col-md-6 col-lg-4">
                    <div class="gallery-item">
                        <img src="{{ asset('assets/images/gallery/spa1.jpeg') }}" alt="Spa">
                        <div class="overlay">
                            <h4>Spa & Massage</h4>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="gallery-item">
                        <img src="{{ asset('assets/images/gallery/bride1.jpeg') }}" alt="Bridal">
                        <div class="overlay">
                            <h4>Bridal Beauty</h4>
                        </div>
                    </div>
                </div>


                

            </div>

            <div class="text-center mt-5">
                <a href="{{ route('appointments.create') }}" class="btn main-btn" >
                    Book Appointment
                </a>
            </div>

        </div>
    </section>

</x-layout>
