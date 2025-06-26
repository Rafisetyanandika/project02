<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Shalat</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
        }

        .card-header {
            background: linear-gradient(45deg, #4CAF50, #2196F3);
            color: white;
            border-radius: 20px 20px 0 0 !important;
            text-align: center;
            padding: 1.5rem;
        }

        .prayer-icon {
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        .select-container {
            position: relative;
            margin-bottom: 2rem;
        }

        .custom-select {
            border: 2px solid #e3f2fd;
            border-radius: 15px;
            padding: 12px 20px;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            background: white;
        }

        .custom-select:focus {
            border-color: #4CAF50;
            box-shadow: 0 0 0 0.2rem rgba(76, 175, 80, 0.25);
            outline: none;
        }

        .table-container {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .prayer-table {
            margin-bottom: 0;
        }

        .prayer-table thead {
            background: linear-gradient(45deg, #4CAF50, #2196F3);
            color: white;
        }

        .prayer-table th {
            border: none;
            padding: 1rem;
            font-weight: 600;
            text-align: center;
        }

        .prayer-table td {
            border: none;
            padding: 1.2rem;
            text-align: center;
            vertical-align: middle;
            font-size: 1.1rem;
            font-weight: 500;
        }

        .prayer-table tbody tr {
            transition: all 0.3s ease;
        }

        .prayer-table tbody tr:hover {
            background-color: #f8f9ff;
            transform: translateX(5px);
        }

        .prayer-time {
            color: #2196F3;
            font-weight: 700;
            font-size: 1.2rem;
        }

        .loading {
            display: none;
            text-align: center;
            padding: 2rem;
        }

        .no-data {
            display: none;
            text-align: center;
            padding: 3rem;
            color: #666;
        }

        .prayer-emoji {
            font-size: 1.5rem;
            margin-right: 0.5rem;
        }

        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .current-time {
            background: linear-gradient(45deg, #FF6B6B, #4ECDC4);
            color: white;
            padding: 1rem;
            border-radius: 15px;
            text-align: center;
            margin-bottom: 1.5rem;
            font-size: 1.2rem;
            font-weight: 600;
        }

        .prayer-active {
            background: linear-gradient(45deg, #4CAF50, #8BC34A) !important;
            color: #2196F3 !important;
            transform: scale(1.02);
            box-shadow: 0 5px 15px rgba(76, 175, 80, 0.3);
        }

        .prayer-active .prayer-time {
            color: #2196F3 !important;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                opacity: 1;
            }

            50% {
                opacity: 0.7;
            }

            100% {
                opacity: 1;
            }
        }

        .adzan-notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background: linear-gradient(45deg, #4CAF50, #2196F3);
            color: white;
            padding: 1rem 1.5rem;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            z-index: 1000;
            transform: translateX(400px);
            transition: transform 0.3s ease;
        }

        .adzan-notification.show {
            transform: translateX(0);
        }

        .adzan-controls {
            margin-top: 1rem;
            text-align: center;
        }

        .adzan-controls button {
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            margin: 0 0.5rem;
            transition: all 0.3s ease;
        }

        .adzan-controls button:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-header">
                        <div class="prayer-icon">
                            <i class="fas fa-mosque"></i>
                        </div>
                        <h2 class="mb-0">Jadwal Shalat</h2>
                        <p class="mb-0 mt-2">Pilih kota untuk melihat jadwal shalat</p>
                    </div>

                    <div class="card-body p-4">
                        <!-- Current Time Display -->
                        <div class="current-time">
                            <i class="fas fa-clock me-2"></i>
                            <span id="current-time"></span>
                        </div>

                        <!-- City Selection -->
                        <div class="select-container">
                            <label for="city-select" class="form-label h5">
                                <i class="fas fa-map-marker-alt me-2"></i>Pilih Kota
                            </label>
                            <select id="city-select" class="form-select custom-select">
                                <option value="">-- Pilih Kota --</option>
                            </select>
                        </div>

                        <!-- Loading State -->
                        <div class="loading" id="loading">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <p class="mt-2">Memuat jadwal shalat...</p>
                        </div>

                        <!-- No Data State -->
                        <div class="no-data" id="no-data">
                            <i class="fas fa-info-circle fa-3x mb-3 text-muted"></i>
                            <h5>Pilih kota untuk melihat jadwal shalat</h5>
                        </div>

                        <!-- Prayer Schedule Table -->
                        <div class="table-container" id="schedule-table" style="display: none;">
                            <table class="table prayer-table">
                                <thead>
                                    <tr>
                                        <th>Waktu Shalat</th>
                                        <th>Jam</th>
                                    </tr>
                                </thead>
                                <tbody id="schedule-body">
                                    <!-- Data will be populated here -->
                                </tbody>
                            </table>
                        </div>

                        <!-- Selected City Info -->
                        <div class="mt-3 text-center" id="city-info" style="display: none;">
                            <small class="text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                Jadwal shalat untuk kota: <strong id="selected-city"></strong>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Adzan Notification -->
    <div class="adzan-notification" id="adzan-notification">
        <h5><i class="fas fa-mosque me-2"></i>Waktu Shalat</h5>
        <p class="mb-2">Telah masuk waktu <strong id="current-prayer"></strong></p>
        <div class="adzan-controls">
            <button type="button" id="stop-adzan">
                <i class="fas fa-stop me-1"></i>Stop
            </button>
            <button type="button" id="close-notification">
                <i class="fas fa-times me-1"></i>Tutup
            </button>
        </div>
    </div>

    <!-- Audio Element for Adzan -->
    <audio id="adzan-audio" preload="auto">
        <source src="" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

 <script>
    // Prayer schedule data (from backend)
    const prayerSchedules = @json($jadwal_shalat);
    const adzanData = @json($adzan_list ?? []);

    // Get unique cities
    const cities = [...new Set(prayerSchedules.map(schedule => schedule.kota))];

    let currentSelectedCity = '';
    let prayerCheckInterval = null;
    let lastCheckedMinute = -1;

    // DOM Elements
    const citySelect = document.getElementById('city-select');
    const adzanAudio = document.getElementById('adzan-audio');
    const adzanNotification = document.getElementById('adzan-notification');

    // 1. DEFINISIKAN FUNGSI updateCurrentTime DI AWAL
    // Show current time
    function updateCurrentTime() {
        const now = new Date();
        const timeString = now.toLocaleString('id-ID', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit'
        });
        document.getElementById('current-time').textContent = timeString;

        // Check prayer time if city is selected
        if (currentSelectedCity) {
            checkPrayerTime(now);
        }
    }

    // 2. DEFINISIKAN FUNGSI LAINNYA SETELAHNYA
    function checkPrayerTime(now) {
        const currentHour = now.getHours();
        const currentMinute = now.getMinutes();
        const currentTimeString = `${currentHour.toString().padStart(2, '0')}:${currentMinute.toString().padStart(2, '0')}`;

        // Only check once per minute
        if (currentMinute === lastCheckedMinute) return;
        lastCheckedMinute = currentMinute;

        const schedule = prayerSchedules.find(s => s.kota === currentSelectedCity);
        if (!schedule) return;

        const prayers = [{
                name: 'Subuh',
                time: schedule.subuh
            },
            {
                name: 'Dzuhur',
                time: schedule.dzuhur
            },
            {
                name: 'Ashar',
                time: schedule.ashar
            },
            {
                name: 'Maghrib',
                time: schedule.maghrib
            },
            {
                name: 'Isya',
                time: schedule.isya
            }
        ];

        prayers.forEach(prayer => {
            if (prayer.time === currentTimeString) {
                playAdzan(prayer.name);
            }
        });

        updateActivePrayerRow(currentTimeString, prayers);
    }

    function updateActivePrayerRow(currentTime, prayers) {
        const rows = document.querySelectorAll('#schedule-body tr');
        rows.forEach((row, index) => {
            row.classList.remove('prayer-active');
            if (prayers[index] && prayers[index].time === currentTime) {
                row.classList.add('prayer-active');
            }
        });
    }

    function playAdzan(prayerName) {
        const adzanFile = adzanData.find(adzan =>
            adzan.nama.toLowerCase().includes(prayerName.toLowerCase())
        );

        if (adzanFile) {
            adzanAudio.src = `/storage/${adzanFile.audio_path}`;
            adzanAudio.play().catch(error => {
                console.log('Auto-play prevented:', error);
                showAdzanNotification(prayerName, false);
            });
        }

        showAdzanNotification(prayerName, true);
    }

    function showAdzanNotification(prayerName, isPlaying) {
        document.getElementById('current-prayer').textContent = prayerName;
        adzanNotification.classList.add('show');

        setTimeout(() => {
            if (adzanNotification.classList.contains('show')) {
                hideAdzanNotification();
            }
        }, 30000);
    }

    function hideAdzanNotification() {
        adzanNotification.classList.remove('show');
    }

    function showLoading() {
        document.getElementById('loading').style.display = 'block';
        document.getElementById('no-data').style.display = 'none';
        document.getElementById('schedule-table').style.display = 'none';
        document.getElementById('city-info').style.display = 'none';
    }

    function showNoData() {
        document.getElementById('loading').style.display = 'none';
        document.getElementById('no-data').style.display = 'block';
        document.getElementById('schedule-table').style.display = 'none';
        document.getElementById('city-info').style.display = 'none';
        currentSelectedCity = '';
    }

    function loadPrayerScheduleFromAPI(city) {
        if (!city) {
            showNoData();
            return;
        }

        showLoading();

        setTimeout(() => {
            const schedule = prayerSchedules.find(s => s.kota === city);
            if (!schedule) {
                showNoData();
                return;
            }

            displayPrayerSchedule(schedule);
        }, 500);
    }

    function displayPrayerSchedule(schedule) {
        const prayers = [{
                name: '🌅 Subuh',
                time: schedule.subuh,
                icon: 'fas fa-sun'
            },
            {
                name: '🏞️ Dzuhur',
                time: schedule.dzuhur,
                icon: 'fas fa-sun'
            },
            {
                name: '🌇 Ashar',
                time: schedule.ashar,
                icon: 'fas fa-cloud-sun'
            },
            {
                name: '🌆 Maghrib',
                time: schedule.maghrib,
                icon: 'fas fa-moon'
            },
            {
                name: '🌃 Isya',
                time: schedule.isya,
                icon: 'fas fa-star'
            }
        ];

        const tbody = document.getElementById('schedule-body');
        tbody.innerHTML = '';

        prayers.forEach((prayer, index) => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>
                    <span class="prayer-emoji">${prayer.name.charAt(0)}</span>
                    <strong>${prayer.name.substring(2)}</strong>
                </td>
                <td>
                    <span class="prayer-time">${prayer.time}</span>
                </td>
            `;
            row.style.animationDelay = `${index * 0.1}s`;
            row.classList.add('fade-in');
            tbody.appendChild(row);
        });

        document.getElementById('selected-city').textContent = schedule.kota;

        document.getElementById('loading').style.display = 'none';
        document.getElementById('no-data').style.display = 'none';
        document.getElementById('schedule-table').style.display = 'block';
        document.getElementById('city-info').style.display = 'block';

        currentSelectedCity = schedule.kota;
        lastCheckedMinute = -1;
    }

    function detectLocationAndSelectCity() {
        console.log('Memulai deteksi lokasi...');
        
        const savedCity = localStorage.getItem('selectedCity');
        if (savedCity && cities.includes(savedCity)) {
            console.log('Menggunakan kota yang disimpan sebelumnya:', savedCity);
            citySelect.value = savedCity;
            loadPrayerScheduleFromAPI(savedCity);
            return;
        }

        if (navigator.geolocation) {
            console.log('Browser mendukung geolocation, meminta izin...');
            
            navigator.geolocation.getCurrentPosition(
                async (position) => {
                    console.log('Berhasil mendapatkan posisi:', position);
                    const { latitude, longitude } = position.coords;
                    console.log('Koordinat:', latitude, longitude);
                    
                    try {
                        console.log('Mencari informasi lokasi dari OpenStreetMap...');
                        const response = await fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}`);
                        const data = await response.json();
                        console.log('Data lokasi dari OpenStreetMap:', data);
                        
                        let detectedCity = '';
                        if (data.address) {
                            detectedCity = data.address.city || data.address.town || 
                                         data.address.village || data.address.municipality || 
                                         data.address.county || '';
                            console.log('Kota yang terdeteksi:', detectedCity);
                        }
                        
                        if (detectedCity) {
                            const matchedCity = cities.find(city => 
                                city.toLowerCase().includes(detectedCity.toLowerCase()) || 
                                detectedCity.toLowerCase().includes(city.toLowerCase())
                            );
                            
                            if (matchedCity) {
                                console.log('Kota yang cocok ditemukan:', matchedCity);
                                citySelect.value = matchedCity;
                                localStorage.setItem('selectedCity', matchedCity);
                                loadPrayerScheduleFromAPI(matchedCity);
                            } else {
                                console.log('Tidak menemukan kota yang cocok untuk:', detectedCity);
                                selectDefaultCity();
                            }
                        } else {
                            console.log('Tidak dapat mendeteksi kota dari alamat');
                            selectDefaultCity();
                        }
                    } catch (error) {
                        console.error('Error saat mendeteksi lokasi:', error);
                        selectDefaultCity();
                    }
                },
                (error) => {
                    console.error('Error geolocation:', error);
                    selectDefaultCity();
                },
                {
                    enableHighAccuracy: true,
                    timeout: 10000,
                    maximumAge: 0
                }
            );
        } else {
            console.log('Browser tidak mendukung geolocation');
            selectDefaultCity();
        }
    }

    function selectDefaultCity() {
        console.log('Memilih kota default...');
        if (cities.length > 0) {
            console.log('Menggunakan kota pertama dalam daftar:', cities[0]);
            citySelect.value = cities[0];
            loadPrayerScheduleFromAPI(cities[0]);
        } else {
            console.log('Tidak ada kota yang tersedia');
        }
    }

    function init() {
        console.log('Menginisialisasi aplikasi...');
        console.log('Daftar kota yang tersedia:', cities);
        
        initializeCityDropdown();
        
        citySelect.addEventListener('change', function() {
            const selectedCity = this.value;
            console.log('User memilih kota:', selectedCity);
            if (selectedCity) {
                localStorage.setItem('selectedCity', selectedCity);
            }
            loadPrayerScheduleFromAPI(selectedCity);
        });

        document.getElementById('stop-adzan').addEventListener('click', function() {
            adzanAudio.pause();
            adzanAudio.currentTime = 0;
            hideAdzanNotification();
        });

        document.getElementById('close-notification').addEventListener('click', function() {
            hideAdzanNotification();
        });

        if ('Notification' in window && Notification.permission === 'default') {
            Notification.requestPermission();
        }

        // 3. PANGGIL updateCurrentTime SETELAH FUNGSI TERDEFINISI
        updateCurrentTime();
        setInterval(updateCurrentTime, 1000);

        detectLocationAndSelectCity();

        setTimeout(() => {
            if (!currentSelectedCity && cities.length > 0) {
                console.log('Fallback: memilih kota default karena deteksi lokasi terlalu lama');
                selectDefaultCity();
            }
        }, 5000);
    }

    function initializeCityDropdown() {
        citySelect.innerHTML = '<option value="">-- Pilih Kota --</option>';
        cities.forEach(city => {
            const option = document.createElement('option');
            option.value = city;
            option.textContent = city;
            citySelect.appendChild(option);
        });
    }

    // 4. JALANKAN INIT DI AKHIR SETELAH SEMUA FUNGSI TERDEFINISI
    init();
</script>
</body>

</html>