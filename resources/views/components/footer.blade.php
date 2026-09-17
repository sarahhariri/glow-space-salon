  @props(['settings'=> null])
  <footer class="text-white  pt-5 pb-4">
      <div class="container d-flex flex-column gap-4">
          <div class="footer-title d-flex justify-content-center">
              <h1 class="fw-bold ">Glow Space Luxury Beauty & Wellness <i class="bi bi-suit-heart" style="color: #e60073"></i></h1>
          </div>
          <div class="row  gy-4">
             <div class="col-md-4 d-flex flex-column  align-items-center ">
                  <h6 class="text-uppercase fw-semibold mb-3">Follow Us</h6>
                  <p class=" small mb-1 text-center">Follow Glow Space for beauty inspiration, latest looks and special offers.</p>
                  <div class="social-icons d-flex justify-content-center mt-3">
                       <a href="https://instagram.com/{{ ltrim($settings->instagram, '@') }}" target="_blank" rel="noopener noreferrer"><i class="bi bi-instagram "></i></a>
                        <a href="https://facebook.com/{{ ltrim($settings->facebook, '@') }}" target="_blank" rel="noopener noreferrer"><i class="bi bi-facebook "></i></a>
                        <a href="https://wa.me/{{ ltrim($settings->whatsapp, '@') }}" target="_blank" rel="noopener noreferrer"><i class="bi bi-whatsapp"></i></a>
                  </div>

              </div>
             
              <div class="col-md-4 d-flex flex-column align-items-center ">

                  <h6 class="text-uppercase fw-semibold mb-3  ">Hours</h6>

                  <div class="weeks">
                      <div class="week d-flex justify-content-start align-items-start gap-3">
                          <div class=" small">
                              <p>Monday - Saturday:
                              </p>
                          </div>
                          <div class="small">
                              <p>9:00 AM - 5:00 PM</p>
                          </div>
                      </div>
                      <div class="week  d-flex justify-content-center align-items-center gap-3">
                          <div class="small">
                              <p>Sunday:</p>
                          </div>
                          <div class="small">
                              <p>11:00 AM - 3:00 PM</p>
                          </div>
                      </div>


                  </div>
              </div>
              <div class="col-md-4 d-flex flex-column align-items-center justify-content-center">
                  <h6 class="text-uppercase fw-semibold mb-3">Contact</h6>
                  <div class="address d-flex flex-column  align-items-center justify-content-center">
                      <p class=" small  ">{{ $settings->address }}</p>
                      <p class=" small  ">{{ $settings->email }}</p>
                      <p class=" small">Call us: {{ $settings->phone }}</p>
                  </div>
              </div>
             
          </div>
          <hr class="border-secondary my-4">
          <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
              <p class="text-white-50 small mb-0">&copy; Glow Space {{ date('Y') }}. All rights reserved.</p>
             
          </div>
      </div>
  </footer>
