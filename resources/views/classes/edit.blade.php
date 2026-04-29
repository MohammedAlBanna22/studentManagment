{{-- resources/views/classes/create.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Class — </title>
   <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans..." rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --bg: #0a0a0f;
            --surface: #111118;
            --surface2: #1a1a24;
            --border: rgba(255,255,255,0.07);
            --accent: #6c63ff;
            --accent2: #ff6584;
            --accent3: #43e97b;
            --text: #f0f0f8;
            --muted: #8888aa;
            --card-shadow: 0 8px 40px rgba(0,0,0,0.5);
        }
        body {
            background: var(--bg);
            color: var(--text);
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        .container { width: 100%; max-width: 600px; }
        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--muted);
            text-decoration: none;
            font-size: 0.85rem;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            margin-bottom: 2rem;
            transition: color 0.2s;
        }
        .back-btn:hover { color: var(--text); }
        .back-btn svg { transition: transform 0.2s; }
        .back-btn:hover svg { transform: translateX(-3px); }
        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 2.5rem;
            box-shadow: var(--card-shadow);
            animation: fadeUp 0.4s ease both;
        }
        .card-header { margin-bottom: 2rem; }
        .card-header h1 { font-family: 'Syne', sans-serif; font-size: 1.6rem; font-weight: 800; letter-spacing: -0.02em; }
        .card-header p { color: var(--muted); font-size: 0.9rem; margin-top: 0.4rem; }
        .teacher-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.4rem 1rem;
            background: rgba(108,99,255,0.1);
            border: 1px solid rgba(108,99,255,0.2);
            border-radius: 99px;
            font-size: 0.82rem;
            color: var(--accent);
            margin-bottom: 1.5rem;
        }
        .teacher-badge .dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--accent);
        }
        .field-group { display: flex; flex-direction: column; gap: 1.25rem; margin-bottom: 1.5rem; }
        .field { display: flex; flex-direction: column; gap: 0.5rem; }
        .form-label { font-size: 0.82rem; color: var(--muted); text-transform: uppercase; letter-spacing: 0.08em; }
        .form-input {
            width: 100%;
            padding: 0.85rem 1rem;
            background: var(--surface2);
            border: 1px solid var(--border);
            border-radius: 12px;
            color: var(--text);
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.95rem;
            outline: none;
            transition: border-color 0.2s, background 0.2s;
        }
        .form-input:focus {
            border-color: var(--accent);
            background: rgba(108,99,255,0.05);
        }
        .preview-row {
            display: none;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            background: rgba(108,99,255,0.06);
            border: 1px solid rgba(108,99,255,0.15);
            border-radius: 10px;
            margin-top: 0.5rem;
        }
        .preview-row.visible { display: flex; }
        .preview-icon {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            background: rgba(108,99,255,0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent);
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 0.8rem;
            flex-shrink: 0;
        }
        .preview-info { flex: 1; }
        .preview-info .p-name { font-size: 0.88rem; font-weight: 500; }
        .preview-info .p-id { font-size: 0.72rem; color: var(--muted); margin-top: 1px; }
        .preview-info .p-id span { color: var(--accent); }
        .preview-check { color: var(--accent3); }
        .divider { height: 1px; background: var(--border); margin: 0.25rem 0; }
        .error-msg { color: var(--accent2); font-size: 0.82rem; margin-bottom: 1rem; padding: 0.5rem 1rem; background: rgba(255,101,132,0.08); border: 1px solid rgba(255,101,132,0.2); border-radius: 10px; }
        .success-msg { color: var(--accent3); font-size: 0.82rem; margin-bottom: 1rem; padding: 0.5rem 1rem; background: rgba(67,233,123,0.08); border: 1px solid rgba(67,233,123,0.2); border-radius: 10px; display: flex; align-items: center; gap: 0.5rem; }
        .submit-btn {
            width: 100%;
            padding: 0.9rem;
            background: linear-gradient(135deg, var(--accent), #8b5cf6);
            border: none;
            border-radius: 12px;
            color: #fff;
            font-family: 'Syne', sans-serif;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: opacity 0.2s, transform 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }
        .submit-btn:hover { opacity: 0.9; transform: translateY(-1px); }
        .submit-btn:active { transform: translateY(0); }
        @keyframes fadeUp { from { opacity: 0; transform: translateY(16px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body>
<div class="container">

  <a href="" class="back-btn">
      <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path d="M19 12H5M5 12l7-7M5 12l7 7"/>
      </svg>
      Back to
  </a>

  <div class="card">
      <div class="card-header">
          <h1>Edit Class</h1>
          <p>Edit a class to this School</p>
      </div>



      @if(session('success'))
          <div class="success-msg">
              <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                  <path d="M5 13l4 4L19 7"/>
              </svg>
              {{ session('success') }}
          </div>
      @endif

      @if(session('error'))
          <div class="error-msg">{{ session('error') }}</div>
      @endif
        @if(session('info'))
          <div class="error-msg">{{ session('info') }}</div>
      @endif

      @if($errors->any())
          <div class="error-msg">
              @foreach($errors->all() as $error)
                  {{ $error }}<br>
              @endforeach
          </div>
      @endif

      <form action="{{ route('SchoolClass.update',$class) }}" method="POST">
          @csrf
          <div class="field-group">
              <div class="field">
                  <label class="form-label">Class Name</label>
                  <input type="text"
                         name="name"
                         id="classNameInput"
                         class="form-input"
                         placeholder="Enter class name"
                         value="{{old('name', $class->name)}}"
                         oninput="updatePreview()"
                         required>
                  <div class="preview-row" id="classPreview">
                      <div class="preview-icon" id="classIcon"></div>
                      <div class="preview-info">
                          <div class="p-name" id="classPreviewName"></div>

                      </div>
                      <div class="preview-check">
                          <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                              <path d="M5 13l4 4L19 7"/>
                          </svg>
                      </div>
                  </div>
              </div>
          </div>


            <div class="field-group">
              <div class="field">
                  <label class="form-label">Class Description</label>
                  <input type="text"
                         name="description"
                         id="classNameInput"
                         class="form-input"
                         placeholder="Enter class description"
                         value="{{ old('description', $class->description) }}"
                         oninput="updatePreview()"
                         required>
                  <div class="preview-row" id="classPreview">
                      <div class="preview-icon" id="classIcon"></div>
                      <div class="preview-info">
                          <div class="p-name" id="classPreviewName"></div>

                      </div>
                      <div class="preview-check">
                          <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                              <path d="M5 13l4 4L19 7"/>
                          </svg>
                      </div>
                  </div>
              </div>
          </div>


          <button type="submit" class="submit-btn">
              <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                  <path d="M12 5v14M5 12l7 7 7-7"/>
              </svg>
              Save Class
          </button>
      </form>
  </div>
</div>

<script>
function updatePreview() {
    const input = document.getElementById('classNameInput');
    const preview = document.getElementById('classPreview');
    const icon = document.getElementById('classIcon');
    const nameEl = document.getElementById('classPreviewName');

    if (input.value.trim() !== '') {
        icon.textContent = input.value.substring(0, 2).toUpperCase();
        nameEl.textContent = input.value;
        preview.classList.add('visible');
    } else {
        preview.classList.remove('visible');
    }
}

window.addEventListener('DOMContentLoaded', updatePreview);
</script>
</body>
</html>
