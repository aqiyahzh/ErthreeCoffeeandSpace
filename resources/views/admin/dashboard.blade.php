@extends('layouts.admin')
@section('content')
<style>
    /* ===== GLOBAL ===== */
    .card {
        background: #fff;
        border-radius: 14px;
        padding: 22px;
        box-shadow: 0 3px 12px rgba(0,0,0,0.06);
        transition: 0.2s ease;
    }
    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(0,0,0,0.10);
    }   

    .section-title {
        color: #1e3a8a;
        font-size: 2px;
        font-weight: 800;
        margin-bottom: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* ===== CALENDAR ===== */
    .calendar-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 6px;
    }
    .calendar-day-header {
        text-align: center;
        font-weight: 700;
        color: #1e3a8a;
        padding: 6px;
        font-size: 12px;
        text-transform: uppercase;
        opacity: 0.8;
    }
    .calendar-day {
        aspect-ratio: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        background: #f3f4f6;
        color: #6b7280;
        font-size: 14px;
        font-weight: 600;
        transition: 0.15s ease;
    }
    .calendar-day:hover {
        background: #e5e7eb;
    }
    .calendar-day.other-month {
        opacity: 0.4;
    }
    .calendar-day.today {
        background: #1e40af;
        color: #fff;
        font-weight: 700;
        border: none;
    }

    /* ===== BUTTONS ===== */
    .icon-btn {
        width: 34px;
        height: 34px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 17px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: 0.2s ease;
    }
    .icon-btn-add {
        background: #dbeafe;
        color: #1d4ed8;
    }
    .icon-btn-add:hover {
        background: #3b82f6;
        color: #fff;
    }
    .icon-btn-delete {
        background: #fee2e2;
        color: #b91c1c;
    }
    .icon-btn-delete:hover {
        background: #ef4444;
        color: #fff;
    }

    /* ===== MODAL ===== */
    .modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.45);
        z-index: 1000;
        align-items: center;
        justify-content: center;
    }
    .modal-overlay.active {
        display: flex;
    }
    .modal-content {
        background: #fff;
        border-radius: 14px;
        padding: 26px;
        width: 92%;
        max-width: 420px;
        box-shadow: 0 12px 45px rgba(0,0,0,0.25);
        animation: pop 0.25s ease;
    }
    @keyframes pop {
        from { transform: scale(0.94); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }
    .modal-header {
        color: #1e3a8a;
        font-size: 20px;
        font-weight: 800;
        margin-bottom: 16px;
    }

    /* INPUT */
    .form-input {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 14px;
        transition: 0.2s ease;
    }
    .form-input:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37,99,235,0.15);
        outline: none;
    }

    .btn {
        padding: 10px 16px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        border: none;
        transition: 0.2s ease;
    }
    .btn-primary {
        background: #1e40af;
        color: #fff;
    }
    .btn-primary:hover {
        background: #1d4ed8;
        transform: translateY(-1px);
    }
    .btn-secondary {
        background: #e5e7eb;
        color: #374151;
    }
    .btn-secondary:hover {
        background: #d1d5db;
    }
</style>


<div style="background: #f3f4f6; padding: 24px; border-radius: 8px;">
    
    <div style="margin-bottom: 32px;">
        <h2 style="color: #1e3a8a; margin: 0 0 8px 0; font-size: 28px; font-weight: 700;">Selamat datang kembali, Admin</h2>
        <p style="color: #6b7280; margin: 0; font-size: 14px;">Ringkasan aktivitas dan informasi penting ERTHREE di sini</p>
    </div>

    <div style="background: #1e3a8a; color: white; padding: 20px; border-radius: 10px; margin-top: 20px;">
        <p style="margin: 0; font-size: 14px;">
            <strong>💡 Tips:</strong> Gunakan sidebar untuk mengakses dan mengubah isi tampilan dari website ERTHREE.
        </p>
    </div>
</div>


<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 20px; margin-bottom: 20px;">
        
    <div style="background: white; border-radius: 10px; padding: 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border-left: 4px solid #3b82f6;">
        <h3 style="color: #1e3a8a; margin: 0 0 16px 0; font-size: 18px; font-weight: 700;">Kalender</h3>
            
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
            <button onclick="prevMonth()" style="background: #e5e7eb; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer; color: #374151; font-weight: 600;">←</button>
            <div style="text-align: center; color: #1e3a8a; font-weight: 700;">
                <span id="currentMonth">Desember 2025</span>
            </div>
            <button onclick="nextMonth()" style="background: #e5e7eb; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer; color: #374151; font-weight: 600;">→</button>
        </div>

        <div class="calendar-grid" id="calendarGrid"></div>

        <div style="margin-top: 16px; padding: 12px; background: #eff6ff; border-radius: 6px; text-align: center;">
            <div style="color: #6b7280; font-size: 12px; font-weight: 600; margin-bottom: 4px;">WAKTU KALIMANTAN TIMUR</div>
            <div style="font-size: 20px; color: #1e3a8a; font-weight: 700; margin-bottom: 4px;" id="witaTime">--:--</div>
            <div style="color: #1f2937; font-size: 13px; font-weight: 600;" id="witaDate">-</div>
        </div>
    </div>

    <div style="background: white; border-radius: 10px; padding: 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border-left: 4px solid #3b82f6;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
            <h3 style="color: #1e3a8a; margin: 0; font-size: 18px; font-weight: 700;">Jadwal Aktivitas</h3>
            <button class="icon-btn icon-btn-add" onclick="openAddScheduleModal()">+</button>
        </div>
        <div style="display: flex; flex-direction: column; gap: 12px;" id="scheduleList"></div>
    </div>
</div>


<!-- MODAL -->
<div class="modal-overlay" id="addScheduleModal">
    <div class="modal-content">
        <div class="modal-header">Tambah Jadwal Aktivitas</div>
        <form id="scheduleForm">
            @csrf
            <div class="form-group">
                <label class="form-label">Nama Aktivitas</label>
                <input type="text" id="activityName" class="form-input" placeholder="Misal: Meeting Staff" required>
            </div>
            <div class="form-group">
                <label class="form-label">Waktu (HH:MM)</label>
                <input type="time" id="activityTime" class="form-input" required>
            </div>
            <div class="form-group">
                <label class="form-label">Tipe</label>
                <select id="activityType" class="form-input" required>
                    <option value="">Pilih tipe...</option>
                    <option value="buka">Buka</option>
                    <option value="istirahat">Istirahat</option>
                    <option value="tutup">Tutup</option>
                    <option value="lainnya">Lainnya</option>
                </select>
            </div>
            <div class="btn-group">
                <button type="button" class="btn btn-secondary" onclick="closeAddScheduleModal()">Batal</button>
                <button type="button" class="btn btn-primary" onclick="saveSchedule()">Simpan</button>
            </div>
        </form>
    </div>
</div>


<script>

    let currentMonthWita = new Date();
    let customSchedules = JSON.parse(localStorage.getItem('customSchedules') || '[]');

    document.addEventListener('DOMContentLoaded', function() {
        renderCalendar();
        updateWitaTime();
        loadSchedules();
        setInterval(updateWitaTime, 1000);
    });

    /* -------------------- WITA TIME -------------------- */
    function updateWitaTime() {
        const now = new Date();
        const witaTime = new Date(now.toLocaleString('en-US', { timeZone: 'Asia/Manila' }));
        
        document.getElementById('witaTime').textContent = witaTime.toLocaleTimeString('id-ID', { 
            hour: '2-digit', minute: '2-digit', hour12: false 
        });
        
        document.getElementById('witaDate').textContent = witaTime.toLocaleDateString('id-ID', { 
            weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
        });
    }

    /* -------------------- CALENDAR -------------------- */
    function renderCalendar() {
        const year = currentMonthWita.getFullYear();
        const month = currentMonthWita.getMonth();
        
        const firstDay = new Date(year, month, 1);
        const lastDay = new Date(year, month + 1, 0);

        document.getElementById('currentMonth').textContent = 
            currentMonthWita.toLocaleDateString('id-ID', { month: 'long', year: 'numeric' });

        const grid = document.getElementById('calendarGrid');
        grid.innerHTML = '';

        const dayNames = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];
        dayNames.forEach(day => {
            const header = document.createElement('div');
            header.className = 'calendar-day-header';
            header.textContent = day;
            grid.appendChild(header);
        });

        const prevLastDay = new Date(year, month, 0);

        for (let i = prevLastDay.getDate() - firstDay.getDay() + 1; i <= prevLastDay.getDate(); i++) {
            const day = document.createElement('div');
            day.className = 'calendar-day other-month';
            day.textContent = i;
            grid.appendChild(day);
        }

        const today = new Date();
        for (let i = 1; i <= lastDay.getDate(); i++) {
            const day = document.createElement('div');
            day.className = 'calendar-day';
            day.textContent = i;
            
            if (
                i === today.getDate() &&
                month === today.getMonth() &&
                year === today.getFullYear()
            ) {
                day.classList.add('today');
            }
            
            grid.appendChild(day);
        }

        for (let i = 1; i <= (7 * 6 - lastDay.getDate() - firstDay.getDay()); i++) {
            const day = document.createElement('div');
            day.className = 'calendar-day other-month';
            day.textContent = i;
            grid.appendChild(day);
        }
    }

    function prevMonth() {
        currentMonthWita.setMonth(currentMonthWita.getMonth() - 1);
        renderCalendar();
    }

    function nextMonth() {
        currentMonthWita.setMonth(currentMonthWita.getMonth() + 1);
        renderCalendar();
    }

    /* -------------------- JADWAL AKTIVITAS -------------------- */

    function loadSchedules() {
        const scheduleList = document.getElementById('scheduleList');
        scheduleList.innerHTML = '';

        // CUSTOM (paling atas)
        customSchedules.forEach(schedule => {
            const item = document.createElement('div');
            item.style.cssText = `
                display: flex; justify-content: space-between; align-items: center;
                padding: 12px; background: #f3f4f6; border-radius: 6px;
                border-left: 3px solid #6b7280;
            `;

            item.innerHTML = `
                <div style="display: flex; gap: 12px; align-items: center; flex: 1;">
                    <div style="width: 8px; height: 8px; background: #6b7280; border-radius: 50%;"></div>
                    <div>
                        <div style="color: #1f2937; font-weight: 600; font-size: 13px;">${schedule.name}</div>
                        <div style="color: #6b7280; font-size: 12px;">${schedule.time} WITA</div>
                    </div>
                </div>
                <button class="icon-btn icon-btn-delete" onclick="deleteSchedule('${schedule.id}')">🗑</button>
            `;

            scheduleList.appendChild(item);
        });

        // DEFAULT
        const defaultSchedules = [
            { id: 'd1', name: 'Buka café', time: '09:00', color: '#eff6ff', border: '#3b82f6' },
            { id: 'd2', name: 'Istirahat siang', time: '13:00', color: '#f0fdf4', border: '#10b981' },
            { id: 'd3', name: 'Tutup café', time: '22:00', color: '#fef3c7', border: '#f59e0b' }
        ];

        defaultSchedules.forEach(s => {
            const item = document.createElement('div');
            item.style.cssText = `
                display: flex; justify-content: space-between; align-items: center;
                padding: 12px; background: ${s.color};
                border-radius: 6px; border-left: 3px solid ${s.border};
            `;

            item.innerHTML = `
                <div style="display: flex; gap: 12px; align-items: center; flex: 1;">
                    <div style="width: 8px; height: 8px; background: ${s.border}; border-radius: 50%;"></div>
                    <div>
                        <div style="color: #1f2937; font-weight: 600; font-size: 13px;">${s.name}</div>
                        <div style="color: #6b7280; font-size: 12px;">${s.time} WITA</div>
                    </div>
                </div>
            `;

            scheduleList.appendChild(item);
        });
    }


    function openAddScheduleModal() {
        document.getElementById('addScheduleModal').classList.add('active');
    }

    function closeAddScheduleModal() {
        document.getElementById('addScheduleModal').classList.remove('active');
        document.getElementById('scheduleForm').reset();
    }

    function saveSchedule() {
        const name = document.getElementById('activityName').value;
        const time = document.getElementById('activityTime').value;
        const type = document.getElementById('activityType').value;

        if (!name || !time || !type) {
            alert('Semua field harus diisi');
            return;
        }

        const newSchedule = {
            id: 'c-' + Date.now(),
            name,
            time,
            type
        };

        // MASUKKAN PALING ATAS
        customSchedules.unshift(newSchedule);

        // SIMPAN
        localStorage.setItem('customSchedules', JSON.stringify(customSchedules));

        closeAddScheduleModal();
        loadSchedules();
    }

    function deleteSchedule(id) {
        customSchedules = customSchedules.filter(s => s.id !== id);
        localStorage.setItem('customSchedules', JSON.stringify(customSchedules));
        loadSchedules();
    }

    document.getElementById('addScheduleModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeAddScheduleModal();
        }
    });

</script>

@endsection