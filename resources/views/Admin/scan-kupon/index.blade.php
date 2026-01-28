<x-admin-layout>
    <x-slot name="header">Scan Kupon Qurban</x-slot>
    <x-slot name="title">Scan Kupon</x-slot>

    <div class="max-w-4xl mx-auto">
        <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border border-green-100">
            <div class="p-6 text-gray-900">

                <!-- Scan QR Code Card -->
                <div class="bg-gradient-to-br from-indigo-50 to-blue-50 rounded-xl p-6 mb-6 border border-indigo-200">
                    <div class="text-center">
                        <div class="mb-4">
                            <div class="flex items-center justify-center mb-3">
                                <svg class="w-8 h-8 text-indigo-600 mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                                </svg>
                                <h3 class="text-xl font-bold text-gray-800">Scan QR Code</h3>
                            </div>
                            <p class="text-sm text-gray-600">Arahkan kamera ke QR code pada kupon qurban</p>
                        </div>

                        <!-- Camera Preview -->
                        <div class="relative mx-auto mb-4" style="max-width: 500px;">
                            <div id="qrReader" class="rounded-lg overflow-hidden border-4 border-indigo-300"></div>
                            <div id="cameraPlaceholder"
                                class="bg-white rounded-lg border-4 border-dashed border-indigo-300 flex flex-col items-center justify-center"
                                style="height: 400px;">
                                <svg class="w-24 h-24 text-indigo-400 mb-4" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <p class="text-gray-600 font-medium">Mengaktifkan kamera...</p>
                                <p class="text-gray-500 text-sm mt-1">Mohon tunggu sebentar</p>
                            </div>
                        </div>

                        <!-- Camera Controls -->
                        <div class="flex justify-center gap-4 mb-4">
                            <button id="stopScanBtn"
                                class="hidden bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-6 rounded-lg transition duration-150 ease-in-out shadow-md">
                                <svg class="inline-block w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 10a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z" />
                                </svg>
                                Hentikan Scan
                            </button>
                        </div>

                        <!-- Camera Selection -->
                        <div id="cameraSelection" class="hidden mb-4">
                            <label for="cameraSelect" class="block text-sm font-medium text-gray-700 mb-2">Pilih
                                Kamera:</label>
                            <select id="cameraSelect"
                                class="mx-auto max-w-xs w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 bg-white">
                                <option value="">Memuat kamera...</option>
                            </select>
                        </div>

                        <!-- Alert Messages -->
                        <div id="alertSuccess" class="hidden mb-4 p-4 rounded-lg bg-green-50 border border-green-200">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span id="successMessage" class="text-green-700 font-medium"></span>
                            </div>
                        </div>

                        <div id="alertError" class="hidden mb-4 p-4 rounded-lg bg-red-50 border border-red-200">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-red-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span id="errorMessage" class="text-red-700 font-medium"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Manual Input Card -->
                <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl p-6 border border-green-200">
                    <div class="max-w-md mx-auto">
                        <div class="mb-4 text-center">
                            <div class="flex items-center justify-center mb-3">
                                <svg class="w-8 h-8 text-green-600 mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                                <h3 class="text-xl font-bold text-gray-800">Input Kode Manual</h3>
                            </div>
                            <p class="text-sm text-gray-600">Masukkan kode unik kupon jika QR code tidak terdeteksi</p>
                        </div>

                        <form id="manualForm" class="space-y-4">
                            <div>
                                <label for="kuponCode" class="block text-sm font-medium text-gray-700 mb-2">Kode Unik
                                    Kupon</label>
                                <input type="text" id="kuponCode" name="kupon_code"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 text-lg text-center font-mono uppercase bg-white"
                                    placeholder="Contoh: QRB-2026-001" required autocomplete="off">
                                <p class="mt-1 text-xs text-gray-500">Kode unik terdapat pada kupon qurban</p>
                            </div>

                            <button type="submit"
                                class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-lg transition duration-150 ease-in-out shadow-md">
                                <svg class="inline-block w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Verifikasi Kupon
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Kupon Detail Modal -->
                <div id="kuponModal"
                    class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
                    <div class="relative top-20 mx-auto p-5 border w-full max-w-lg shadow-lg rounded-lg bg-white">
                        <div class="mt-3">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold text-gray-900">Detail Kupon</h3>
                                <button id="closeModal" class="text-gray-400 hover:text-gray-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                            <div id="kuponDetail" class="space-y-3">
                                <!-- Kupon details will be inserted here -->
                            </div>
                            <div class="mt-6 flex gap-3">
                                <button id="confirmBtn"
                                    class="flex-1 bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-150">
                                    <svg class="inline-block w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    Validasi Kupon
                                </button>
                                <button id="cancelBtn"
                                    class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-700 font-semibold py-2 px-4 rounded-lg transition duration-150">
                                    Batal
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @push('scripts')
        <!-- QR Code Scanner Library -->
        <script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let html5QrCode = null;
                let currentKuponData = null;

                // QR Scanner Functions
                document.getElementById('stopScanBtn').addEventListener('click', stopScanning);

                // Auto-start scanning when page loads
                startScanning();

                async function startScanning() {
                    try {
                        document.getElementById('cameraPlaceholder').style.display = 'none';
                        document.getElementById('qrReader').style.display = 'block';

                        html5QrCode = new Html5Qrcode("qrReader");

                        const cameras = await Html5Qrcode.getCameras();

                        if (cameras && cameras.length > 0) {
                            const cameraSelect = document.getElementById('cameraSelect');
                            cameraSelect.innerHTML = cameras.map(camera =>
                                '<option value="' + camera.id + '">' + (camera.label || 'Camera ' + camera.id) +
                                '</option>'
                            ).join('');

                            if (cameras.length > 1) {
                                document.getElementById('cameraSelection').classList.remove('hidden');
                            }

                            const backCamera = cameras.find(camera =>
                                camera.label.toLowerCase().includes('back') ||
                                camera.label.toLowerCase().includes('rear')
                            );
                            const cameraId = backCamera ? backCamera.id : cameras[0].id;

                            await html5QrCode.start(
                                cameraId, {
                                    fps: 10,
                                    qrbox: {
                                        width: 250,
                                        height: 250
                                    }
                                },
                                onScanSuccess,
                                onScanError
                            );

                            document.getElementById('stopScanBtn').classList.remove('hidden');
                            hideAlerts();

                            cameraSelect.addEventListener('change', async function() {
                                if (html5QrCode.isScanning) {
                                    await html5QrCode.stop();
                                    await html5QrCode.start(
                                        this.value, {
                                            fps: 10,
                                            qrbox: {
                                                width: 250,
                                                height: 250
                                            }
                                        },
                                        onScanSuccess,
                                        onScanError
                                    );
                                }
                            });
                        }
                    } catch (err) {
                        console.error('Error starting scanner:', err);
                        showError('Gagal mengakses kamera. Pastikan izin kamera telah diberikan.');
                        document.getElementById('cameraPlaceholder').style.display = 'flex';
                        document.getElementById('qrReader').style.display = 'none';
                    }
                }

                async function stopScanning() {
                    if (html5QrCode && html5QrCode.isScanning) {
                        await html5QrCode.stop();
                        html5QrCode.clear();
                        document.getElementById('qrReader').style.display = 'none';
                        document.getElementById('cameraPlaceholder').style.display = 'flex';
                        document.getElementById('stopScanBtn').classList.add('hidden');
                        document.getElementById('cameraSelection').classList.add('hidden');
                    }
                }

                function onScanSuccess(decodedText, decodedResult) {
                    console.log('QR Code detected:', decodedText);
                    verifyKupon(decodedText);
                }

                function onScanError(error) {
                    // Silent error handling
                }

                // Manual Form Submit
                document.getElementById('manualForm').addEventListener('submit', function(e) {
                    e.preventDefault();
                    const kuponCode = document.getElementById('kuponCode').value.trim().toUpperCase();
                    if (kuponCode) {
                        verifyKupon(kuponCode);
                    }
                });

                // Verify Kupon
                async function verifyKupon(code) {
                    try {
                        hideAlerts();

                        const submitBtn = document.querySelector('#manualForm button[type="submit"]');
                        const originalText = submitBtn.innerHTML;
                        submitBtn.disabled = true;
                        submitBtn.innerHTML =
                            '<svg class="animate-spin inline-block w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Memverifikasi...';

                        const response = await fetch("{{ route('scan-kupon.check') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                code: code
                            })
                        });

                        const data = await response.json();

                        submitBtn.disabled = false;
                        submitBtn.innerHTML = originalText;

                        if (data.success) {
                            currentKuponData = data.kupon;
                            showKuponModal(data.kupon);
                        } else {
                            showError(data.message || 'Kupon tidak ditemukan atau sudah digunakan');
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        showError('Terjadi kesalahan saat memverifikasi kupon');
                        const submitBtn = document.querySelector('#manualForm button[type="submit"]');
                        submitBtn.disabled = false;
                    }
                }

                // Show Kupon Modal
                function showKuponModal(kupon) {
                    const modal = document.getElementById('kuponModal');
                    const detailContainer = document.getElementById('kuponDetail');

                    const statusBadge = kupon.status === 'tersedia' ?
                        '<span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded">Tersedia</span>' :
                        '<span class="bg-red-100 text-red-800 text-xs font-semibold px-2.5 py-0.5 rounded">Sudah Digunakan</span>';

                    let html = '<div class="bg-gray-50 rounded-lg p-4 space-y-3">';
                    html +=
                        '<div class="flex justify-between items-center"><span class="text-sm text-gray-600">Kode Kupon:</span><span class="text-sm font-semibold text-gray-900 font-mono">' +
                        kupon.kode_unik + '</span></div>';
                    html +=
                        '<div class="flex justify-between items-center"><span class="text-sm text-gray-600">Nama:</span><span class="text-sm font-semibold text-gray-900">' +
                        kupon.nama + '</span></div>';
                    html +=
                        '<div class="flex justify-between items-center"><span class="text-sm text-gray-600">RT:</span><span class="text-sm font-semibold text-gray-900">' +
                        kupon.rt + '</span></div>';
                    html +=
                        '<div class="flex justify-between items-center"><span class="text-sm text-gray-600">Status:</span>' +
                        statusBadge + '</div>';

                    if (kupon.tanggal_penukaran) {
                        html +=
                            '<div class="flex justify-between items-center"><span class="text-sm text-gray-600">Tanggal Penukaran:</span><span class="text-sm font-semibold text-gray-900">' +
                            kupon.tanggal_penukaran + '</span></div>';
                    }

                    html += '</div>';
                    detailContainer.innerHTML = html;
                    modal.classList.remove('hidden');
                }

                // Modal Actions
                document.getElementById('closeModal').addEventListener('click', closeModal);
                document.getElementById('cancelBtn').addEventListener('click', closeModal);

                document.getElementById('confirmBtn').addEventListener('click', async function() {
                    if (!currentKuponData) return;

                    const confirmBtn = document.getElementById('confirmBtn');
                    const originalBtnText = confirmBtn.innerHTML;
                    confirmBtn.disabled = true;
                    confirmBtn.innerHTML =
                        '<svg class="animate-spin inline-block w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Memproses...';

                    try {
                        const response = await fetch("{{ route('scan-kupon.use') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .content,
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                kupon_id: currentKuponData.id
                            })
                        });

                        const data = await response.json();

                        confirmBtn.disabled = false;
                        confirmBtn.innerHTML = originalBtnText;

                        if (data.success) {
                            closeModal();
                            showSuccess(
                                'Kupon berhasil divalidasi! Status kupon telah berubah menjadi TERPAKAI.'
                            );
                            document.getElementById('kuponCode').value = '';
                            currentKuponData = null;
                        } else {
                            showError(data.message || 'Gagal menggunakan kupon');
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        confirmBtn.disabled = false;
                        confirmBtn.innerHTML = originalBtnText;
                        showError('Terjadi kesalahan saat memproses kupon');
                    }
                });

                function closeModal() {
                    document.getElementById('kuponModal').classList.add('hidden');
                    currentKuponData = null;
                }

                // Alert Functions
                function showSuccess(message) {
                    hideAlerts();
                    document.getElementById('successMessage').textContent = message;
                    document.getElementById('alertSuccess').classList.remove('hidden');
                    setTimeout(function() {
                        document.getElementById('alertSuccess').classList.add('hidden');
                    }, 5000);
                }

                function showError(message) {
                    hideAlerts();
                    document.getElementById('errorMessage').textContent = message;
                    document.getElementById('alertError').classList.remove('hidden');
                    setTimeout(function() {
                        document.getElementById('alertError').classList.add('hidden');
                    }, 5000);
                }

                function hideAlerts() {
                    document.getElementById('alertSuccess').classList.add('hidden');
                    document.getElementById('alertError').classList.add('hidden');
                }

                // Clean up on page unload
                window.addEventListener('beforeunload', function() {
                    if (html5QrCode && html5QrCode.isScanning) {
                        html5QrCode.stop();
                    }
                });
            });
        </script>
    @endpush
</x-admin-layout>
