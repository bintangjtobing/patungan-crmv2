<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Template Email</title>
</head>

<body style="font-family: 'Questrial', sans-serif; margin: 0; padding: 0; background-color: #f4f4f4;">

    <div class="email-container"
        style="max-width: 600px; margin: 15px auto; background-color: #fff; border-radius: 10px; overflow: hidden;">
        <!-- Gambar Banner -->
        <img src="https://res.cloudinary.com/dflafxsqp/image/upload/v1732372083/thankyou-pty_waqmlw.png" alt="Banner"
            class="banner" style="width: 100%; height: auto;">

        <!-- Konten -->
        <div class="content" style="padding: 20px; color: #333;">
            @yield('content')

            <p>Jika Anda memiliki pertanyaan atau membutuhkan bantuan lebih lanjut, jangan ragu untuk membalas email
                ini.</p>
            <p>Terima kasih atas kepercayaan Anda pada PatunganYuk IDN! Kami berharap transaksi ini memberikan nilai
                tambah bagi Anda. Mohon berikan feedback Anda melalui tautan berikut: <a
                    href="https://g.page/r/CSM658ow_9wxEBM/review">Berikan Ulasan</a> ⭐<br><br>- Tim PatunganYuk IDN</p>

            <!-- Tombol Ajakan -->
            <h4 style="text-align: center;">Kunjungi PatunganYuk IDN untuk lebih banyak tawaran!</h4>
            <div class="cta-button" style="text-align: center; margin: 20px 0 15px 0;">
                <a href="https://patunganyukidn.com"
                    style="background-color: #126DFF; color: white; padding: 10px 20px; border-radius: 25px; text-decoration: none; font-size: 16px;">Kunjungi
                    Situs Kami</a>
            </div>

            <p>Lebih hemat menggunakan PatunganYuk IDN!<br>Salam,<br><br><br>Tim PatunganYuk IDN</p>
        </div>

        <!-- Footer -->
        <div class="footer"
            style="padding: 20px; text-align: left; background-color: #f4f4f4; font-size: 12px; color: #666;">
            <div class="assistance"
                style="font-size: 14px; text-align: center; margin-bottom: 10px; padding-bottom: 10px; border-bottom: 1px solid #ddd;">
                <p><strong>Butuh Bantuan?</strong><br>Untuk pertanyaan lebih lanjut, tim <a
                        href="https://wa.me/6285195922910" style="color: #126DFF; text-decoration: none;">dukungan
                        kami</a> siap membantu Anda!</p>
            </div>

            <div class="social-section" style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div class="social-icons" style="text-align: left;">
                    <h4 style="color: #000; margin-bottom: 5px;">Ikuti kami di</h4>
                    <!-- Social Media Icons Here -->
                    <a href="https://www.facebook.com/patunganyukidn"><img
                            src="https://res.cloudinary.com/dnsekavtx/image/upload/v1728462784/facebookblacksocialbuttoncircle_79771_hlzt9p.png"
                            alt="Facebook" style="width: 24px; margin-right:5px;"></a>
                    <a href="https://www.instagram.com/patunganyukidn/"><img
                            src="https://res.cloudinary.com/dnsekavtx/image/upload/v1728462788/instagram-with-circle-icon-2048x2048-21sdb59c_rbnq9w.png"
                            alt="Instagram" style="width: 24px; margin-right: 5px;"></a>
                    <a href="https://wa.me/6285195922910"><img
                            src="https://res.cloudinary.com/dnsekavtx/image/upload/v1728462785/3669725_l9zrbh.png"
                            alt="Whatsapp" style="width: 24px; margin-left: 0; margin-right: 5px;"></a>

                </div>
            </div>

            <p class="disclaimer" style="text-align: center; font-size: 12px; color: #666; line-height: 1.5;">
                <strong>PatunganYuk IDN</strong> adalah platform online yang memungkinkan Anda untuk berbagi biaya
                layanan streaming favorit Anda seperti Netflix, Spotify, Disney+, dan banyak lagi. Dengan
                <strong>PatunganYuk IDN</strong>, menikmati hiburan premium menjadi lebih terjangkau dan menyenangkan.
                Kunjungi <a href="https://patunganyukidn.com" style="color: #126DFF; text-decoration: none;">situs
                    kami</a> untuk bergabung dengan komunitas dan mulai berhemat hari ini.
            </p>
            <!-- Review Link -->
            <div
                style="border: 1px solid #d7e2eb; padding: 10px; border-radius: 5px; text-align: center; width: 250px; background-color:#fff;">
                <a href="https://www.trustpilot.com/review/www.duhanicapital.com" target="_blank" rel="noopener"
                    style="text-decoration: none; font-family: Arial, sans-serif; font-size: 16px; color: #333; display: inline-block;">
                    ⭐ Review us on
                    <span style="color: #00b67a; font-weight: bold; font-family: Arial, sans-serif;">Google</span>
                </a>
            </div>
        </div>
    </div>
</body>

</html>
