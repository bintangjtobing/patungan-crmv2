<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="h-screen flex flex-col items-center justify-center space-y-6 px-4"
        style="background: url('https://res.cloudinary.com/dflafxsqp/image/upload/v1731477127/bg-patunganyuk_lfv8ya.png'); background-position: center; background-size: cover">

        <!-- Top Image -->
        <img src="https://res.cloudinary.com/boxity-id/image/upload/v1720974567/2_copy_z3a91z.png" alt="Top Image" class="w-32 h-auto">

        <!-- Registration Form -->
        <div id="registrationForm" class="bg-white bg-opacity-70 rounded-3xl p-8 w-full max-w-lg shadow-lg transition-all">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">User Registration Data Form</h2>
            <form class="space-y-4" onsubmit="showSubscriptionForm(event)">
                <input type="text" placeholder="Your full name"
                    class="w-full px-4 py-4 rounded-2xl bg-white bg-opacity-80 text-gray-700 border border-white focus:outline-none focus:border-blue-500" />
                <input type="email" placeholder="Email address"
                    class="w-full px-4 py-4 rounded-2xl bg-white bg-opacity-80 text-gray-700 border border-white focus:outline-none focus:border-blue-500" />
                <input type="tel" placeholder="Number phone"
                    class="w-full px-4 py-4 rounded-2xl bg-white bg-opacity-80 text-gray-700 border border-white focus:outline-none focus:border-blue-500" />
                <button type="submit"
                    class="w-full py-3 bg-[#FFA60D] text-white font-semibold rounded-xl focus:outline-none transition duration-300">NEXT</button>
            </form>
        </div>

        <!-- Subscription Form -->
        <div id="subscriptionForm"
            class="hidden bg-white bg-opacity-70 rounded-3xl p-8 w-full max-w-lg shadow-lg transition-all">
            <h2 class="text-2xl font-bold text-gray-800 mb-1">Berlangganan</h2>
            <p class="text-gray-800 font-semibold text-sm mt-3">
                Netflix Personal Private
            </p>
            <p class="mb-6 mt-1 text-gray-500 text-sm"> Private Netflix account for personal use. Our best video quality in Ultra HD (4K) and HDR. Spatial audio
                available. Watch ad-free on any phone, tablet, computer, or TV.</p>
            <form class="space-y-4" onsubmit="showPaymentForm(event)">
                <select
                    class="w-full px-4 py-4 rounded-2xl bg-white bg-opacity-50 text-gray-700 border border-white focus:outline-none focus:border-blue-500">
                    <option>Pilih produk</option>
                    <option>Netflix Standard</option>
                    <option>Netflix Premium</option>
                </select>
                <input type="text" placeholder="Harga"
                    class="w-full px-4 py-4 rounded-2xl bg-white bg-opacity-50 text-gray-700 border border-white focus:outline-none focus:border-blue-500" />
                <button type="submit"
                    class="w-full py-3 bg-[#FFA60D] text-white font-semibold rounded-xl focus:outline-none transition duration-300">NEXT</button>
            </form>
        </div>

        <!-- Payment Form -->
        <div id="paymentForm"
            class="hidden bg-white bg-opacity-70 rounded-3xl p-8 w-full max-w-lg shadow-lg transition-all border-2 border-blue-200">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Pilih Pembayaran</h2>
            <form class="space-y-4" onsubmit="showConfirmationMessage(event)">
                <select id="paymentMethod" onchange="togglePaymentSection()"
                    class="w-full px-4 py-4 rounded-2xl bg-white bg-opacity-50 text-gray-700 border border-white focus:outline-none focus:border-blue-500">
                    <option value="">Pilih Metode Pembayaran</option>
                    <option value="qris">QRIS</option>
                    <option value="ewallet">E-Wallet</option>
                </select>

                <!-- QR Code Section -->
                <div id="qrisSection" class="space-y-4 bg-white border border-white bg-opacity-50 py-5 rounded-xl">
                    <p class="text-center text-gray-600">Untuk QRIS, kamu bisa memindai QR Code ini ya</p>
                    <div class="flex justify-center my-4">
                        <img src="https://via.placeholder.com/150" alt="QR Code" class="w-32 h-32">
                    </div>
                </div>

                <!-- E-Wallet Section (Initially Hidden) -->
                <div id="ewalletSection" class="hidden space-y-4">
                    <p class="text-center text-gray-800 font-semibold">Pembayaran Melalui E-Wallet</p>
                    <div class="grid grid-cols-2 gap-3">
                        <div class="flex flex-col">
                            <label class="text-gray-700">OVO</label>
                            <input type="text" value="081262845980"
                                class="px-4 py-2 rounded-3xl bg-gray-200 text-gray-700 border border-gray-300 bg-white bg-opacity-50"
                                readonly />
                        </div>
                        <div class="w-fit">
                            <label class="text-gray-700">Nama</label>
                            <input type="text" value="BINTANG CATO JEREMIA L TOB"
                                class="w-48 px-4 py-2 rounded-3xl bg-gray-200 text-gray-700 border border-gray-300"
                                readonly />
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div class="flex flex-col">
                            <label class="text-gray-700">Shopee</label>
                            <input type="text" value="081262845980"
                                class="px-4 py-2 rounded-3xl bg-gray-200 text-gray-700 border border-gray-300"
                                readonly />
                        </div>
                        <div class="w-fit">
                            <label class="text-gray-700">Nama</label>
                            <input type="text" value="BINTANG CATO JEREMIA L TOB"
                                class="w-48 px-4 py-2 rounded-3xl bg-gray-200 text-gray-700 border border-gray-300"
                                readonly />
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div class="flex flex-col">
                            <label class="text-gray-700">Dana</label>
                            <input type="text" value="081262845980"
                                class="px-4 py-2 rounded-3xl bg-gray-200 text-gray-700 border border-gray-300"
                                readonly />
                        </div>
                        <div class="w-fit">
                            <label class="text-gray-700">Nama</label>
                            <input type="text" value="BINTANG CATO JEREMIA L TOB"
                                class="w-48 px-4 py-2 rounded-3xl bg-gray-200 text-gray-700 border border-gray-300"
                                readonly />
                        </div>
                    </div>
                </div>

                <button type="submit"
                    class="w-full py-3 bg-[#FFA60D] text-white font-semibold rounded-xl focus:outline-none transition duration-300">SUBMIT</button>
            </form>
        </div>

        <!-- Confirmation Message -->
        <div id="confirmationMessage"
            class="hidden bg-white bg-opacity-70 rounded-3xl p-8 w-full max-w-lg shadow-lg transition-all border-2 border-blue-200">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Keren! Kamu sudah selesai!</h2>
            <p class="text-gray-600 mb-4 bg-white bg-opacity-50 rounded-xl p-4">Sekarang kamu tinggal menunggu kabar
                dari admin PatunganYukIDN untuk proses verifikasi pembayaran dan akun patungan platform kamu ya!
            </p>
            <p class="text-gray-600 text-center text-sm mb-6">Jika berkenan, follow instagram kami ya, untuk bisa dapatkan
                informasi terbaru dari kami di <span class="font-semibold">@patunganyukidn</span>.</p>
            <button onclick="resetForm()"
                class="w-full py-3 bg-[#FFA60D] text-white font-semibold rounded-xl focus:outline-none transition duration-300">OK</button>
        </div>
    </div>

    <script>
        function showSubscriptionForm(event) {
            event.preventDefault();
            document.getElementById('registrationForm').classList.add('hidden');
            document.getElementById('subscriptionForm').classList.remove('hidden');
        }

        function showPaymentForm(event) {
            event.preventDefault();
            document.getElementById('subscriptionForm').classList.add('hidden');
            document.getElementById('paymentForm').classList.remove('hidden');
        }

        function showConfirmationMessage(event) {
            event.preventDefault();
            document.getElementById('paymentForm').classList.add('hidden');
            document.getElementById('confirmationMessage').classList.remove('hidden');
        }

        function resetForm() {
            document.getElementById('confirmationMessage').classList.add('hidden');
            document.getElementById('registrationForm').classList.remove('hidden');
        }

        function togglePaymentSection() {
            const paymentMethod = document.getElementById("paymentMethod").value;
            const qrisSection = document.getElementById("qrisSection");
            const ewalletSection = document.getElementById("ewalletSection");

            if (paymentMethod === "qris") {
                qrisSection.classList.remove("hidden");
                ewalletSection.classList.add("hidden");
            } else if (paymentMethod === "ewallet") {
                ewalletSection.classList.remove("hidden");
                qrisSection.classList.add("hidden");
            } else {
                qrisSection.classList.add("hidden");
                ewalletSection.classList.add("hidden");
            }
        }
    </script>
</body>

</html>
