<section class="about-us py-5" id="about-us">

    <div class="main-heading text-center mb-4">
        <span class="aboutus-label">About Glow Space</span>
        <h3 >Welcome to Glow Space</h3>
        <p class="main-subtitle">For Your Vanity & Sanity</p>
    </div>

    <div class="aboutus-description mx-auto text-center">
        <p>
          Glow is salon of choice for everything hair, beauty,
                nails, bridal and massage. 
                with a stellar team of stylists and technicians
                providing you the one stop salon for all your needs.
                Glo is a hip, contemporary and vivacious space offering an extensive
                selection of good grooming staples.
        </p>
    </div>

    <div class="aboutus-images">
        @foreach ($aboutImages as $image)
        <div class="aboutus-image-card">
            <img
                src="{{ asset('assets/images/about/' . $image->image) }}"
                alt="Glow Space salon" >
        </div>
        @endforeach
    </div>
   
</section>
 <section class="why-choose py-5">

      <div class="container ">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Why Choose Glow Space?</h2>
                <p class="text-muted">
                    We are committed to making every visit a relaxing and beautiful experience.
                </p>
            </div>
            <div class="row g-4">
                <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
                    <div class="choose-card text-center">
                        <i class="bi bi-scissors"></i>
                        <h5>Expert Stylists</h5>
                        <p>Professional beauty specialists with years of experience.</p>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
                    <div class="choose-card text-center">
                        <i class="bi bi-stars"></i>
                        <h5>Premium Products</h5>
                        <p>Only high-quality products for healthy hair and glowing skin.</p>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
                    <div class="choose-card text-center">
                        <i class="bi bi-heart"></i>
                        <h5>Personalized Care</h5>
                        <p>Every service is customized to suit your unique beauty needs.</p>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
                    <div class="choose-card text-center">
                        <i class="bi bi-flower1"></i>
                        <h5>Relaxing Atmosphere</h5>
                        <p>A luxurious space where beauty meets comfort.</p>
                    </div>
                </div>

            </div>

        </div>
    </section>