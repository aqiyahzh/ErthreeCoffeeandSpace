@extends('layouts.admin')

@section('content')

<style>
    :root {
        --primary: #1A73E8;
        --primary-dark: #0d47a1;
        --bg-soft: #F4F7FE;
        --border-soft: #dce6ff;
    }

    .page-title {
        font-size: 26px;
        font-weight: 700;
        color: var(--primary-dark);
        border-left: 5px solid var(--primary);
        padding-left: 12px;
        margin-bottom: 22px;
    }

    .contact-wrapper {
        background: #fff;
        padding: 28px 30px;
        border-radius: 14px;
        border: 1px solid var(--border-soft);
        box-shadow: 0 8px 20px rgba(0,0,0,.05);
    }

    .form-label {
        font-weight: 600;
        color: var(--primary-dark);
    }

    .form-control {
        border-radius: 10px;
        border: 1px solid #c5d6f7;
        padding: 10px 14px;
        transition: .2s;
    }

    .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 .15rem rgba(26,115,232,.25);
    }

    textarea.form-control {
        min-height: 90px;
    }

    .btn-save {
        background: var(--primary);
        color: #fff;
        padding: 10px 28px;
        border-radius: 10px;
        font-weight: 600;
        border: none;
        transition: .2s;
    }

    .btn-save:hover {
        background: var(--primary-dark);
    }

    .card-section-title {
        font-size: 18px;
        font-weight: 700;
        color: var(--primary-dark);
        margin-top: 25px;
        margin-bottom: 10px;
    }

    .divider {
        height: 2px;
        width: 100%;
        background: var(--border-soft);
        margin: 10px 0 20px 0;
    }

</style>


<div class="container-fluid">

    <h3 class="page-title">Edit Contact Page</h3>

    <div class="contact-wrapper">

        <form action="{{ route('admin.contact.update') }}" method="POST">
            @csrf
            @method('PUT')

            <!-- ===================== TITLE ===================== -->
            <label class="form-label">Page Title</label>
            <input type="text" name="title" class="form-control mb-4"
                   value="{{ $contact->title ?? '' }}" required>


            <!-- ===================== OPENING DESCRIPTION ===================== -->
            <div class="card-section-title">
                <i class="fas fa-align-left me-1"></i> Deskripsi Pembuka
            </div>
            <textarea name="description" class="form-control mb-4" rows="4">
{{ $contact->description ?? '' }}
            </textarea>


            <!-- ===================== OPENING HOURS ===================== -->
            <div class="card-section-title">
                <i class="far fa-clock me-1"></i> Jam Operasional
            </div>
            <div class="divider"></div>

            <label class="form-label">Senin – Jumat</label>
            <input type="text" name="weekday_hours" class="form-control mb-3"
                   value="{{ $contact->weekday_hours ?? '' }}" placeholder="Contoh: 09.00 – 23.00">

            <label class="form-label">Sabtu – Minggu</label>
            <input type="text" name="weekend_hours" class="form-control mb-4"
                   value="{{ $contact->weekend_hours ?? '' }}" placeholder="Contoh: 09.00 – 00.00">


            <!-- ===================== SOCIAL CONTACT ===================== -->
            <div class="card-section-title">
                <i class="fas fa-hashtag me-1"></i> Media Sosial & Kontak
            </div>
            <div class="divider"></div>

            <label class="form-label">Instagram URL</label>
            <input type="text" name="instagram" class="form-control mb-3"
                   value="{{ $contact->instagram ?? '' }}"
                   placeholder="https://instagram.com/erthree.coffee">

            <label class="form-label">Nomor WhatsApp</label>
            <input type="text" name="whatsapp" class="form-control mb-3"
                   value="{{ $contact->whatsapp ?? '' }}" placeholder="+62 812-xxxx-xxxx">

            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control mb-4"
            value="{{ $contact->email ?? '' }}" placeholder="email@domain.com">


            <!-- ===================== MAP URL ===================== -->
            <div class="card-section-title">
                <i class="fas fa-map-marker-alt me-1"></i> Google Maps Embed URL
            </div>
            <textarea name="map_url" class="form-control mb-4" rows="3"
                      placeholder="https://www.google.com/maps/embed?...">
{{ $contact->map_url ?? '' }}
            </textarea>


            <!-- SAVE BUTTON -->
            <button type="submit" class="btn-save">Save</button>

        </form>

    </div>

</div>

@endsection