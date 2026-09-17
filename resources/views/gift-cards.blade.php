<x-layout title="Gift Cards" :settings="$settings">
  


 <section class="gift-hero py-5">

    <div class="container">

        <div class="main-heading text-center mb-5">
            <h3>Luxury Gift Cards</h3>

            <p class="main-subtitle">
                Treat someone special to a luxurious beauty experience with one of our exclusive gift cards.
            </p>
        </div>

        <div class="row g-4">

            <!-- Silver -->
            <div class="col-lg-4 h-100 d-flex flex-column">
                <div class="gift-card silver-card d-flex flex-column">

                    <span class="gift-type">Silver</span>

                    <h2>$50</h2>

                    <p>
                       A perfect introduction to luxury beauty.
                    </p>

                    <ul class="list-unstyled my-3">
                        <li><i class="fas fa-check"></i> Makeup</li>
                        <li><i class="fas fa-check"></i> Hair Styling</li>
                        <li><i class="fas fa-check"></i> Nail Care</li>
                    </ul>

                    <button class="btn main-btn purchase-gift-btn mt-auto" data-type="Silver" data-amount="50">
                        Purchase Gift Card
                    </button>

                </div>
            </div>

            <!-- Gold -->
            <div class="col-lg-4 h-100 d-flex flex-column">
                <div class="gift-card gold-card d-flex flex-column ">

                    <span class="popular-badge">
                        Most Popular
                    </span>

                    <span class="gift-type">Gold</span>

                    <h2>$100</h2>

                    <p>
                       Our most loved gift card for every occasion.
                    </p>

                    <ul class="list-unstyled my-3">
                        <li><i class="fas fa-check"></i> Makeup</li>
                        <li><i class="fas fa-check"></i> Hair Styling</li>
                        <li><i class="fas fa-check"></i> Nail Care</li>
                        <li><i class="fas fa-check"></i> Spa & Massage</li>
                        
                    </ul>

                    <button class="btn main-btn purchase-gift-btn mt-auto" data-type="Gold" data-amount="100">
                        Purchase Gift Card
                    </button >

                </div>
            </div>

            <!-- Platinum -->
            <div class="col-lg-4 h-100 d-flex flex-column">
                <div class="gift-card platinum-card d-flex flex-column" >

                    <span class="gift-type">Platinum</span>

                    <h2>$200</h2>

                    <p>
                        The ultimate luxury beauty experience.
                    </p>

                    <ul class="list-unstyled my-3">
                        <li><i class="fas fa-check"></i> Includes all Gold benefits</li>
                       
                        <li><i class="fas fa-check"></i>Complimentary Luxury Gift</li>
                        <li><i class="fas fa-check"></i>Exclusive VIP Experience</li>
                        
                    </ul>

                    <button class="btn main-btn purchase-gift-btn mt-auto" data-type="Platinum" data-amount="200">
                        Purchase Gift Card
                    </button>

                </div>
            </div>

        </div>

    </div>



</section>
@if (session('success'))
    <div class="container mt-3">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Close"
            ></button>
        </div>
    </div>
@endif
<section id="gift-card-form-section" class="gift-form-section py-5 d-none">
    <div class="container">

        <div class="gift-form-card">

            <div class="main-heading text-center mb-4">
                <h3>Purchase Your Gift Card</h3>

                <p class="main-subtitle">
                    Complete the details below to send someone a luxurious beauty experience.
                </p>
            </div>

            <form
                action="{{ route('giftCards.store') }}"  method="POST"  >
                

                <div class="row g-4">

                    <div class="col-md-6">
                        <label class="form-label">Selected Gift Card</label>

                        <input  type="text"  id="selected_type_display"   class="form-control" readonly  >

                        <input  type="hidden"  name="type"  id="selected_type"  >
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Amount</label>

                        <input  type="text"  id="selected_amount_display"  class="form-control"    readonly  >

                        <input type="hidden" name="amount" id="selected_amount" >
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Sender Name</label>

                        <input
                            type="text"
                            name="sender_name"
                            class="form-control"
                            value="{{ old('sender_name') }}"
                            required
                        >
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Recipient Name</label>

                        <input
                            type="text"
                            name="recipient_name"
                            class="form-control"
                            value="{{ old('recipient_name') }}"
                            required
                        >
                    </div>

                    <div class="col-12">
                        <label class="form-label">Recipient Email</label>

                        <input
                            type="email"
                            name="recipient_email"
                            class="form-control"
                            value="{{ old('recipient_email') }}"
                            required
                        >
                    </div>

                    <div class="col-12">
                        <label class="form-label">Personal Message</label>

                        <textarea
                            name="message"
                            class="form-control"
                            rows="4"
                            placeholder="Write a special message..."
                        >{{ old('message') }}</textarea>
                    </div>

                    <div class="col-12 text-center">
                        <button type="submit" class="btn gift-submit-btn">
                            <i class="bi bi-gift me-2"></i>
                            Complete Purchase
                        </button>
                    </div>

                </div>
            </form>
            @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        </div>
    </div>
</section>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const buttons = document.querySelectorAll('.purchase-gift-btn');
        const formSection = document.getElementById('gift-card-form-section');

        const typeInput = document.getElementById('selected_type');
        const typeDisplay = document.getElementById('selected_type_display');

        const amountInput = document.getElementById('selected_amount');
        const amountDisplay = document.getElementById('selected_amount_display');

        buttons.forEach(function (button) {
            button.addEventListener('click', function () {
                const type = this.dataset.type;
                const amount = this.dataset.amount;

                typeInput.value = type;
                typeDisplay.value = type;

                amountInput.value = amount;
                amountDisplay.value = '$' + amount;

                formSection.classList.remove('d-none');

                formSection.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            });
        });
    });
</script>
</x-layout>