<?= $header ?>

<body class="loading"
    data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": {"color": "light"}, "topbar": {"color": "light"}}'>

<div id="wrapper">
    <?= $navbar ?>
    <?= $sidebar ?>

    <div class="content-page">
        <div class="content">
            <div class="container-fluid">

                <div class="row mb-3">
                    <div class="col-12 d-flex justify-content-between align-items-center">
                        <h4 class="page-title">Scan QR Code Pembayaran</h4>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card shadow border">
                            <div class="card-body text-center">
                                <div id="reader" style="width: 100%; max-width: 350px; margin: auto;"></div>
                                <p class="mt-3 text-muted">Arahkan kamera ke QR code pada struk pelanggan untuk memproses pembayaran.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <?= $footer ?>
    </div>
</div>

<?= $sidebar_kanan ?>

<!-- Script QR -->
<script src="https://unpkg.com/html5-qrcode"></script>
<script>
    function onScanSuccess(decodedText, decodedResult) {
        console.log("Kode berhasil: ", decodedText);
        window.location.href = "/kasir/transaksi/view/" + decodedText;
    }

    function onScanFailure(error) {
        console.warn("Gagal: ", error);
    }

    const html5QrCode = new Html5Qrcode("reader");

    Html5Qrcode.getCameras().then(devices => {
        if (devices && devices.length) {
            const cameraId = devices[0].id;
            html5QrCode.start(
                cameraId,
                { fps: 10, qrbox: 250 },
                onScanSuccess,
                onScanFailure
            );
        } else {
            alert("Tidak ada kamera yang terdeteksi!");
        }
    }).catch(err => {
        console.error("Gagal mengakses kamera", err);
        alert("Gagal mengakses kamera: " + err);
    });
</script>
