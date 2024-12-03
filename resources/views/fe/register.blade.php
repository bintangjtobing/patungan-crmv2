<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>
        Gabung bersama temanPatungan! - PatunganYukIDN
    </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="canonical" href="https://patunganyuk.com">
    <meta name="description"
        content="PatunganYuk! adalah platform online yang memudahkan Anda mengelola data pelanggan, transaksi, dan reminder pembayaran, sekaligus berbagi biaya layanan streaming seperti Netflix, Spotify, Disney+, dan lainnya. Hemat uang sambil menikmati akses premium bersama teman atau pengguna lain.">
    <meta name="title"
        content="PatunganYuk! - Kelola Data Pelanggan, Transaksi, dan Reminder Pembayaran Sambil Berbagi Layanan Streaming">
    <meta name="keywords"
        content="PatunganYuk, layanan streaming, berbagi biaya, Netflix, Spotify, Disney+, platform online, hemat uang">
    <link rel="icon" href="https://res.cloudinary.com/boxity-id/image/upload/v1720974566/2_rpjs5h.png" type="image/png">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "Organization",
          "name": "PatunganYuk!",
          "url": "https://app.patunganyuk.com",
          "logo": "https://res.cloudinary.com/boxity-id/image/upload/v1720974567/4_ligzdg.png",
          "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "+62 819 1588 1569",
            "contactType": "customer service"
          }
        }
    </script>
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="Gabung bersama temanPatungan! - PatunganYukIDN">
    <meta property="og:description"
        content="PatunganYuk! adalah platform online yang memudahkan Anda mengelola data pelanggan, transaksi, dan reminder pembayaran, sekaligus berbagi biaya layanan streaming seperti Netflix, Spotify, Disney+, dan lainnya. Hemat uang sambil menikmati akses premium bersama teman atau pengguna lain.">
    <meta property="og:image"
        content="https://res.cloudinary.com/boxity-id/image/upload/q_65/v1723832781/cover_wa_tsgukx.png">
    <meta property="og:url" content="https://app.patunganyuk.com/">
    <meta property="og:type" content="website">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Gabung bersama temanPatungan! - PatunganYukIDN">
    <meta name="twitter:description"
        content="PatunganYuk! adalah platform online yang memudahkan Anda mengelola data pelanggan, transaksi, dan reminder pembayaran, sekaligus berbagi biaya layanan streaming seperti Netflix, Spotify, Disney+, dan lainnya. Hemat uang sambil menikmati akses premium bersama teman atau pengguna lain.">
    <meta name="twitter:image"
        content="https://res.cloudinary.com/boxity-id/image/upload/q_65/v1723832781/cover_wa_tsgukx.png">
    <link rel="alternate" href="https://app.patunganyuk.com/" hreflang="en">
    <meta name="twitter:site" content="@patunganyukidn">
    <meta name="facebook-domain-verification" content="vj8wf7ntoogonkispxmoznqie1a0zm" />
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-7WDXGYH5NZ"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-7WDXGYH5NZ');
    </script>
    <!-- Meta Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
    {
      if(f.fbq) return; n=f.fbq=function(){n.callMethod ?
      n.callMethod.apply(n,arguments) : n.queue.push(arguments)};
      if(!f._fbq) f._fbq=n; n.push=n; n.loaded=!0; n.version='2.0';
      n.queue=[]; t=b.createElement(e); t.async=!0;
      t.src=v; s=b.getElementsByTagName(e)[0];
      s.parentNode.insertBefore(t,s)
    }(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '473988542365157');
    fbq('track', 'UserRegister');
    </script>
    <noscript>
        <img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=473988542365157&ev=PageView&noscript=1" />
    </noscript>
    <!-- End Meta Pixel Code -->
    <!-- Clarity Microsoft Project -->
    <script type="text/javascript">
        (function(c,l,a,r,i,t,y){
        c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
        t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
        y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
    })(window, document, "clarity", "script", "np2tvu67ll");
    </script>
</head>

<body>
    <div class="h-screen flex flex-col items-center justify-center space-y-6 px-4"
        style="background: url('https://res.cloudinary.com/dflafxsqp/image/upload/v1731477127/bg-patunganyuk_lfv8ya.png'); background-position: center; background-size: cover">

        <!-- Top Image -->
        <img src="https://res.cloudinary.com/dflafxsqp/image/upload/v1731512505/4_euqhae.png" alt="Top Image"
            class="w-48 h-auto">

        <!-- Registration Form -->
        <div id="registrationForm"
            class="bg-white bg-opacity-70 rounded-3xl p-8 w-full max-w-lg shadow-lg transition-all">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">User Registration Data Form</h2>
            <form id="registerForm" class="space-y-4" onsubmit="showSubscriptionForm(event)">
                <input type="text" name="name" placeholder="Your full name"
                    class="w-full px-4 py-4 rounded-2xl bg-white bg-opacity-80 text-gray-700 border border-white focus:outline-none focus:border-blue-500" />
                <input type="email" name="email" placeholder="Email address"
                    class="w-full px-4 py-4 rounded-2xl bg-white bg-opacity-80 text-gray-700 border border-white focus:outline-none focus:border-blue-500" />
                <input type="tel" name="no_hp" placeholder="Number phone"
                    class="w-full px-4 py-4 rounded-2xl bg-white bg-opacity-80 text-gray-700 border border-white focus:outline-none focus:border-blue-500" />
                <button type="submit"
                    class="w-full py-3 bg-[#FFA60D] text-white font-semibold rounded-xl focus:outline-none transition duration-300">NEXT</button>
            </form>
        </div>

        <!-- Subscription Form -->
        <div id="subscriptionForm"
            class="hidden bg-white bg-opacity-70 rounded-3xl p-8 w-full max-w-lg shadow-lg transition-all">
            <h2 class="text-2xl font-bold text-gray-800 mb-1">Berlangganan</h2>
            <!-- Paragraf untuk Nama Produk -->
            <p id="productName" class="text-gray-800 font-semibold text-sm mt-3">
                Pilih produk untuk melihat detail.
            </p>
            <!-- Paragraf untuk Deskripsi Produk -->
            <p id="productDescription" class="mb-6 mt-1 text-gray-500 text-sm">
                Silakan pilih produk untuk melihat deskripsi.
            </p>
            <form class="space-y-4" onsubmit="showPaymentForm(event)">
                <select id="productSelect"
                    class="w-full px-4 py-4 rounded-2xl bg-white bg-opacity-50 text-gray-700 border border-white focus:outline-none focus:border-blue-500"
                    onchange="updateProductDetails()">
                    <option value="" data-name="Pilih produk" data-description="Silakan pilih produk" data-price="">
                        Pilih produk
                    </option>
                    @foreach ($products->unique('uuid') as $product)
                    <option value="{{ $product->uuid }}" data-description="{{ $product->description }}"
                        data-price="{{ $product->harga_jual }}">
                        {{ $product->nama }}
                    </option>
                    @endforeach
                </select>
                <input id="productPrice" type="text" placeholder="Harga"
                    class="w-full px-4 py-4 rounded-2xl bg-white bg-opacity-50 text-gray-700 border border-white focus:outline-none focus:border-blue-500"
                    readonly />
                <button type="submit"
                    class="w-full py-3 bg-[#FFA60D] text-white font-semibold rounded-xl focus:outline-none transition duration-300">NEXT</button>
            </form>
        </div>


        <!-- Payment Form -->
        <div id="paymentForm"
            class="hidden bg-white bg-opacity-70 rounded-3xl p-8 w-full max-w-lg shadow-lg transition-all border-2 border-blue-200">
            <div id="paymentInfo" class="mt-2 text-sm text-gray-700 hidden"></div>
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Pilih Pembayaran</h2>
            <form class="space-y-4" onsubmit="showConfirmationMessage(event)">
                <select id="paymentMethod" onchange="togglePaymentSection()"
                    class="w-full px-4 py-4 rounded-2xl bg-white bg-opacity-50 text-gray-700 border border-white focus:outline-none focus:border-blue-500">
                    <option value="">Pilih Metode Pembayaran</option>
                    <option value="6">QRIS</option>
                    @foreach ($rekenings->unique('id') as $rekening)
                    <option value="{{ $rekening->id }}">{{ $rekening->bank }} - {{ $rekening->no_rek }}</option>
                    @endforeach
                </select>

                <!-- QR Code Section -->
                <div id="qrisSection" class="hidden space-y-4">
                    <p class="text-center text-gray-600">Untuk QRIS, kamu bisa memindai QR Code ini ya</p>
                    <div class="flex justify-center my-4">
                        <img src="https://res.cloudinary.com/dflafxsqp/image/upload/v1732206306/rekening/yta7g9wyl0wbz1kgp9vl.png"
                            alt="QR Code" class="w-32 h-32">
                    </div>
                </div>

                <div id="ewalletSection" class="hidden space-y-4">
                    <p class="text-center text-gray-800 font-semibold">Pembayaran Melalui E-Wallet</p>
                    @foreach ($rekenings->where('type', 'emoney') as $rekening)
                    <div class="grid grid-cols-2 gap-3">
                        <div class="flex flex-col">
                            <label class="text-gray-700">{{ ucfirst($rekening->bank) }}</label>
                            <input type="text" value="{{ $rekening->no_rek }}"
                                class="px-4 py-2 rounded-3xl bg-gray-200 text-gray-700 border border-gray-300"
                                readonly />
                        </div>
                        <div class="w-fit">
                            <label class="text-gray-700">Nama</label>
                            <input type="text" value="{{ $rekening->name }}"
                                class="w-48 px-4 py-2 rounded-3xl bg-gray-200 text-gray-700 border border-gray-300"
                                readonly />
                        </div>
                    </div>
                    @endforeach
                </div>
                <!-- Upload Bukti Pembayaran -->
                <div class="space-y-4">
                    <label for="paymentProof" class="text-gray-700 font-semibold">Unggah Bukti Pembayaran:</label>
                    <input type="file" id="paymentProof" name="paymentProof"
                        class="w-full px-4 py-3 rounded-xl bg-gray-100 border border-gray-300 focus:outline-none">
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
            <p class="text-gray-600 text-center text-sm mb-6">Jika berkenan, follow instagram kami ya, untuk bisa
                dapatkan
                informasi terbaru dari kami di <span class="font-semibold">@patunganyukidn</span>.</p>
            <button onclick="resetForm()"
                class="w-full py-3 bg-[#FFA60D] text-white font-semibold rounded-xl focus:outline-none transition duration-300">OK</button>
        </div>
    </div>

    <script>
        function showSubscriptionForm(event) {
            event.preventDefault(); // Prevent page reload
            console.log("Switching to subscription form...");
            document.getElementById('registrationForm').classList.add('hidden');
            document.getElementById('subscriptionForm').classList.remove('hidden');
        }

        function showPaymentForm(event) {
            event.preventDefault();
            document.getElementById('subscriptionForm').classList.add('hidden');
            document.getElementById('paymentForm').classList.remove('hidden');
        }

        function populateDropdowns(data) {
            const productSelect = document.querySelector("#productSelect");
            const paymentMethodSelect = document.querySelector("#paymentMethod");

            // Hapus semua opsi sebelumnya (kecuali default)
            productSelect.innerHTML = `
                <option value="" data-name="Pilih produk" data-description="Silakan pilih produk untuk melihat deskripsi.">
                    Pilih produk
                </option>`;
            paymentMethodSelect.innerHTML = `<option value="">Pilih Metode Pembayaran</option>`;

            // **Tambahkan opsi "QRIS" dan "E-Wallet"**
            const optionQris = document.createElement("option");
            optionQris.value = "qris";
            optionQris.textContent = "QRIS";
            paymentMethodSelect.appendChild(optionQris);

            const optionEwallet = document.createElement("option");
            optionEwallet.value = "ewallet";
            optionEwallet.textContent = "E-Wallet";
            paymentMethodSelect.appendChild(optionEwallet);

            // Tambahkan produk baru
            data.products.forEach((product) => {
                const option = document.createElement("option");
                option.value = product.uuid;
                option.textContent = product.nama;
                option.setAttribute("data-name", product.nama);
                option.setAttribute("data-description", product.description);
                option.setAttribute("data-price", product.harga_jual);
                productSelect.appendChild(option);
            });

            // Tambahkan rekening baru
            data.rekenings.forEach((rekening) => {
                const option = document.createElement("option");
                option.value = rekening.id;
                option.textContent = `${rekening.bank} - ${rekening.no_rek}`;
                paymentMethodSelect.appendChild(option);
            });
        }
        function updateProductDetails() {
            const productSelect = document.getElementById("productSelect");
            const selectedOption = productSelect.options[productSelect.selectedIndex];

            // Ambil data dari atribut data-name, data-description, dan data-price
            const name = selectedOption.getAttribute("data-name") || "Pilih produk";
            const description = selectedOption.getAttribute("data-description") || "Silakan pilih produk untuk melihat deskripsi.";
            const price = selectedOption.getAttribute("data-price") || "";

            // Perbarui elemen nama produk, deskripsi, dan harga
            document.getElementById("productName").textContent = name;
            document.getElementById("productDescription").textContent = description;
            document.getElementById("productPrice").value = price ? `Rp ${Number(price).toLocaleString('id-ID')}` : "";
        }

        function togglePaymentSection() {
            const paymentMethod = document.getElementById("paymentMethod").value;
            const qrisSection = document.getElementById("qrisSection");
            const ewalletSection = document.getElementById("ewalletSection");
            const paymentInfo = document.getElementById("paymentInfo");

            if (paymentMethod === "qris") {
                qrisSection.classList.remove("hidden");
                ewalletSection.classList.add("hidden");
                paymentInfo.textContent = "Anda memilih pembayaran menggunakan QRIS.";
                paymentInfo.classList.remove("hidden");
            } else if (!isNaN(paymentMethod)) {
                qrisSection.classList.add("hidden");
                ewalletSection.classList.add("hidden");
                paymentInfo.textContent = `Anda memilih metode pembayaran: ${paymentMethod}`;
                paymentInfo.classList.remove("hidden");
            } else {
                qrisSection.classList.add("hidden");
                ewalletSection.classList.add("hidden");
                paymentInfo.textContent = "";
                paymentInfo.classList.add("hidden");
            }
        }
        async function uploadPaymentProof(paymentProof) {
            const formData = new FormData();
            formData.append("paymentProof", paymentProof);

            // Ambil CSRF token dari meta tag jika ada
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute("content");

            try {
                const response = await fetch("/upload-payment-proof", {
                    method: "POST",
                    headers: {
                        ...(csrfToken && { "X-CSRF-TOKEN": csrfToken }),
                    },
                    body: formData,
                });

                if (!response.ok) {
                    const result = await response.json();
                    throw new Error(result.message || "Gagal mengunggah bukti pembayaran.");
                }

                const result = await response.json();
                return result.path; // Mengembalikan path file bukti pembayaran
            } catch (error) {
                console.error("Error uploading payment proof:", error);
                throw error;
            }
        }

        async function showConfirmationMessage(event) {
            event.preventDefault();

            try {
                const paymentProof = document.getElementById("paymentProof").files[0];
                if (!paymentProof) {
                    alert("Harap unggah bukti pembayaran sebelum melanjutkan.");
                    return;
                }

                const formData = new FormData();
                formData.append("paymentProof", paymentProof);

                // Step 1: Upload payment proof
                const uploadResponse = await fetch("/upload-payment-proof", {
                    method: "POST",
                    body: formData,
                });

                const uploadResult = await uploadResponse.json();
                if (!uploadResponse.ok) {
                    console.error("Upload Error:", uploadResult);
                    throw new Error(uploadResult.message || "Gagal mengunggah bukti pembayaran.");
                }

                const buktiTransaksiUrl = uploadResult.path;

                // Step 2: Send transaction data
                const payload = {
                    name: document.querySelector('input[name="name"]').value,
                    email: document.querySelector('input[name="email"]').value,
                    no_hp: document.querySelector('input[name="no_hp"]').value,
                    product_uuid: document.querySelector('#productSelect').value,
                    bukti_transaksi: buktiTransaksiUrl,
                };

                const transactionResponse = await fetch("/customer/transaction/create", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify(payload),
                });

                const transactionResult = await transactionResponse.json();
                console.log("Transaction Response:", transactionResult);

                if (!transactionResponse.ok) {
                    throw new Error(transactionResult.message || "Gagal membuat transaksi.");
                }

                // alert("Transaksi berhasil disimpan!");
                document.getElementById("paymentForm").classList.add("hidden");
                document.getElementById("confirmationMessage").classList.remove("hidden");
            } catch (error) {
                console.error("Error creating transaction:", error);
                alert(`Terjadi kesalahan: ${error.message}`);
            }
        }

        function resetForm() {
            if (confirm("Kunjungi halaman Instagram @patunganyukidn dan ikuti kami untuk mendapatkan informasi terbaru. Apakah Anda ingin melanjutkan?")) {
                window.location.href = "https://www.instagram.com/patunganyukidn";
            }
        }

        function validateFileUpload() {
            const paymentProof = document.getElementById("paymentProof").files[0];
            const allowedExtensions = ["image/jpeg", "image/png"];
            const maxFileSize = 2 * 1024 * 1024; // 2 MB

            if (!paymentProof) {
                alert("Harap unggah bukti pembayaran.");
                return false;
            }

            if (!allowedExtensions.includes(paymentProof.type)) {
                alert("Format file tidak didukung. Gunakan file JPEG atau PNG.");
                return false;
            }

            if (paymentProof.size > maxFileSize) {
                alert("Ukuran file terlalu besar. Maksimal 2 MB.");
                return false;
            }

            return true;
        }



        document.addEventListener("DOMContentLoaded", () => {
        fetch("/api/payment-data")
            .then((response) => response.json())
            .then((data) => {
                console.log("Data Produk:", data.products);
                console.log("Data Rekening:", data.rekenings);

                populateDropdowns(data);
            })
            .catch((error) => console.error("Error fetching data:", error));
    });
    </script>
</body>

</html>
