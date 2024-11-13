@extends('dashboard.layout.index')
@section('title', 'Multi-Step Form')
@section('content')

<h4 class="fw-bold py-3 mb-4">Multi-Step Form for New Customer Transaction</h4>

<form action="{{ route('submitMultiStepForm') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="accordion" id="multiStepFormAccordion">

        <!-- Step 1: User Details -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                    aria-expanded="true" aria-controls="collapseOne">
                    Step 1: User Details
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                data-bs-parent="#multiStepFormAccordion">
                <div class="accordion-body">

                    <!-- Toggle for Existing or New Customer -->
                    <label class="form-label">Customer Type</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="customer_type" id="existingCustomer"
                            value="existing" checked>
                        <label class="form-check-label" for="existingCustomer">Existing Customer</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="customer_type" id="newCustomer" value="new">
                        <label class="form-check-label" for="newCustomer">New Customer</label>
                    </div>

                    <!-- Existing Customer Selection -->
                    <div id="existingCustomerSection" class="mt-3">
                        <label for="user_id" class="form-label">Select Existing Customer</label>
                        <select class="form-select" name="user_id">
                            <option value="">Select a customer</option>
                            @foreach($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- New Customer Input -->
                    <div id="newCustomerSection" class="mt-3" style="display: none;">
                        <label for="new_customer_name" class="form-label">Customer Name</label>
                        <input type="text" name="new_customer_name" class="form-control" placeholder="Enter name" />

                        <label for="new_customer_email" class="form-label mt-3">Customer Email</label>
                        <input type="email" name="new_customer_email" class="form-control" placeholder="Enter email"
                            required />

                        <label for="new_customer_phone" class="form-label mt-3">Phone Number</label>
                        <input type="text" name="new_customer_phone" class="form-control"
                            placeholder="Enter phone number" required />
                    </div>

                </div>
            </div>
        </div>

        <!-- Step 2: Transaction Details -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Step 2: Transaction Details
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                data-bs-parent="#multiStepFormAccordion">
                <div class="accordion-body">
                    <label for="product_uuid" class="form-label">Select Product</label>
                    <select class="form-select" name="product_uuid" id="productSelect" required>
                        <option value="">Select a product</option>
                        @foreach($products as $product)
                        <option value="{{ $product->uuid }}" data-price="{{ $product->harga_jual }}">
                            {{ $product->nama }}
                        </option>
                        @endforeach
                    </select>

                    <label for="jumlah" class="form-label mt-3">Amount (Months)</label>
                    <input type="number" name="jumlah" class="form-control" id="amountInput" min="1" required />

                    <label for="harga" class="form-label mt-3">Price</label>
                    <input type="number" name="harga" class="form-control" id="priceInput" readonly />
                </div>
            </div>
        </div>

        <!-- Step 3: Credential Details -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Step 3: Credential Details
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                data-bs-parent="#multiStepFormAccordion">
                <div class="accordion-body">
                    <label for="email_akses" class="form-label">Email Access</label>
                    <input type="email" name="email_akses" class="form-control" required />

                    <label for="profil_akes" class="form-label mt-3">Profile Access</label>
                    <input type="text" name="profil_akes" class="form-control" />

                    <label for="pin" class="form-label mt-3">PIN</label>
                    <input type="text" name="pin" class="form-control" />
                </div>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary mt-3">Complete Transaction</button>
</form>

<script>
    document.getElementById('existingCustomer').addEventListener('change', function() {
        document.getElementById('existingCustomerSection').style.display = 'block';
        document.getElementById('newCustomerSection').style.display = 'none';
    });

    document.getElementById('newCustomer').addEventListener('change', function() {
        document.getElementById('existingCustomerSection').style.display = 'none';
        document.getElementById('newCustomerSection').style.display = 'block';
    });

    const productSelect = document.getElementById('productSelect');
    const amountInput = document.getElementById('amountInput');
    const priceInput = document.getElementById('priceInput');

    // Update price based on selected product and amount
    function updatePrice() {
        const selectedProduct = productSelect.options[productSelect.selectedIndex];
        const pricePerMonth = parseFloat(selectedProduct.getAttribute('data-price')) || 0;
        const amount = parseInt(amountInput.value) || 1;
        priceInput.value = pricePerMonth * amount;
    }

    // Event listeners for product selection and amount input
    productSelect.addEventListener('change', updatePrice);
    amountInput.addEventListener('input', updatePrice);
</script>

@endsection
