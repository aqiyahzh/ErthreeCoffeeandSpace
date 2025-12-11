@extends('layouts.admin')

@section('content')

<style>
/* ===== VARIABLES ===== */
:root {
    --primary: #1E3A8A;          /* warna utama diperbarui */
    --primary-dark: #162F6A;     /* versi lebih gelap */
    --bg-soft: #F3F4F6;          /* abu-abu lembut */
    --border-soft: #D1D5DB;      /* border abu-abu */
}

/* ===== PAGE WRAPPER ===== */
.admin-about-page {
    padding: 28px 12px;
    background: #ffffff;
}

/* ===== HEADER ===== */
.page-header h2 {
    font-size: 30px;
    font-weight: 800;
    color: var(--primary);
    margin-bottom: 4px;
}
.page-header p {
    color: #6B7280;
    font-size: 15px;
}

/* ===== CARD STYLE ===== */
.card-box {
    background: #ffffff;
    padding: 24px;
    border-radius: 14px;
    border: 1px solid var(--border-soft);
    box-shadow: 0 4px 14px rgba(0,0,0,0.06);
    margin-bottom: 28px;
    transition: 0.2s ease;
}
.card-box:hover {
    box-shadow: 0 6px 20px rgba(0,0,0,0.10);
}

/* ===== SECTION TITLE ===== */
.section-title {
    font-size: 21px;
    font-weight: 700;
    color: var(--primary);
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    gap: 10px;
}
.section-title i {
    color: var(--primary);
    font-size: 18px;
}

/* ===== INPUTS ===== */
.form-control {
    border-radius: 10px;
    border: 1px solid #BEC7D5;
    padding: 10px 12px;
    font-size: 15px;
}
.form-control:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 .15rem rgba(30,58,138,.25);
}

/* ===== EDITOR BLOCK ===== */
.editor-block {
    background: #F8FAFC;
    border-radius: 12px;
    padding: 16px;
    border: 1px solid #E5E7EB;
}

/* Hapus Bagian Button */
.remove-block {
    background: #DC2626;
    color: #fff;
    padding: 7px 14px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    border: none;
    transition: 0.2s;
}
.remove-block:hover {
    background: #B91C1C;
}

/* ===== BUTTONS ===== */
.btn-add-block {
    background: var(--primary);
    color: #fff;
    padding: 9px 18px;
    font-weight: 600;
    border-radius: 10px;
    border: none;
    transition: 0.2s;
}
.btn-add-block:hover {
    background: var(--primary-dark);
}

.btn-save {
    background: var(--primary);
    color: #fff;
    padding: 12px 28px;
    font-weight: 700;
    border-radius: 10px;
    border: none;
    font-size: 16px;
    transition: 0.2s;
}
.btn-save:hover {
    background: var(--primary-dark);
}
</style>


<div class="container-fluid admin-about-page">

    <!-- HEADER -->
    <div class="page-header mb-4">
        <h2>Edit About Page</h2>
        <p>Kelola konten halaman About yang tampil di website</p>
    </div>

    <form id="aboutForm" action="{{ route('admin.about.update') }}" method="POST">
        @csrf
        @method('PUT')

        <!-- ===================== TITLE ===================== -->
        <div class="card-box">
            <div class="section-title">
                <i class="fas fa-heading"></i> Judul Halaman
            </div>

            <label class="fw-semibold mb-1">Title</label>
            <input id="titleInput" type="text" name="title" class="form-control"
                   value="{{ $page->title }}">

            <div class="mt-3">
                <strong>Preview Judul:</strong>
                <h4 id="titlePreview" class="mt-2" style="color:var(--primary-dark); font-weight:700;">
                    {{ $page->title }}
                </h4>
            </div>
        </div>

        <!-- ===================== CONTENT BLOCKS ===================== -->
        <div class="card-box">
            <div class="section-title">
                <i class="fas fa-book"></i> Konten Halaman
            </div>

            <label class="fw-semibold mb-2">Content (HTML)</label>

            <div id="editors">
                <div class="editor-block mb-3" data-index="1">
                    <textarea id="editor-1" class="form-control editor-text" rows="10">
                        {{ $page->content }}
                    </textarea>
                    <button type="button" class="remove-block btn btn-sm mt-2" style="display:none;">
                        <i class="fas fa-trash-alt me-1"></i> Hapus Bagian
                    </button>
                </div>
            </div>

            <button id="addBlock" type="button" class="btn-add-block mt-3">
                <i class="fas fa-plus-circle me-1"></i> Tambah Bagian
            </button>

            <input type="hidden" id="content_input" name="content" value="">
        </div>

        <button class="btn-save mt-3">
            <i class="fas fa-save me-1"></i> Simpan Perubahan
        </button>
        </form>
</div>

@endsection


@section('scripts')
<script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>

<script>
let editorCount = 1;

function initCk(id) {
    if (CKEDITOR.instances[id]) {
        try { CKEDITOR.instances[id].destroy(true); } catch (e) {}
    }
    CKEDITOR.replace(id, {
        height: 300,
        removePlugins: 'elementspath',
        resize_enabled: false
    });
}

document.addEventListener('DOMContentLoaded', () => {

    /* INIT FIRST EDITOR */
    initCk('editor-1');

    /* ADD BLOCK */
    document.getElementById('addBlock').addEventListener('click', () => {
        editorCount++;
        const container = document.createElement('div');
        container.className = 'editor-block mb-3';
        container.dataset.index = editorCount;

        const textarea = document.createElement('textarea');
        textarea.id = 'editor-' + editorCount;
        textarea.className = 'form-control editor-text';
        textarea.rows = 8;

        const removeBtn = document.createElement('button');
        removeBtn.type = 'button';
        removeBtn.className = 'remove-block btn btn-sm mt-2';
        removeBtn.innerHTML = '<i class="fas fa-trash-alt me-1"></i> Hapus Bagian';
        removeBtn.addEventListener('click', function(){
            if (CKEDITOR.instances[textarea.id]) {
                CKEDITOR.instances[textarea.id].destroy(true);
            }
            container.remove();
        });

        container.appendChild(textarea);
        container.appendChild(removeBtn);
        document.getElementById('editors').appendChild(container);

        initCk(textarea.id);

        document.querySelectorAll('.remove-block').forEach(b => b.style.display = 'inline-block');
    });

    /* TITLE PREVIEW */
    const titleInput = document.getElementById('titleInput');
    const titlePreview = document.getElementById('titlePreview');
    titleInput.addEventListener('input', () => titlePreview.textContent = titleInput.value);

    /* SUBMIT MERGE CONTENT BLOCKS */
    document.getElementById('aboutForm').addEventListener('submit', function(){
        const contents = [];

        document.querySelectorAll('.editor-text').forEach(ta => {
            const id = ta.id;
            if (CKEDITOR.instances[id]) {
                contents.push(CKEDITOR.instances[id].getData());
            } else {
                contents.push(ta.value);
            }
        });

        document.getElementById('content_input').value = contents.join("\n<hr/>\n");
    });
});
</script>

@endsection