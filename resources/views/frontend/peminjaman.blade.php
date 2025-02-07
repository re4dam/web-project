@extends('frontend.master')

@section('content')
    <div class="container mt-5" style="background-color:white; border-radius: 15px; padding: 20px">
        @if ($jadwal->status == 'Waiting For Retrieval')        
            <h1>Form Penyerahan</h1>
            @if (auth()->user()->is_admin)
                <form id="adminForm" action="{{ route('jadwal.action') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_jadwal" id="id_jadwal" value="{{ $jadwal->id }}">
                    
                    <div class="image-preview mt-2" id="imagePreview">
                        <img src="{{ asset($jadwal->buktiSerah) }}" alt="Bukti Serah Image" id="imageElement" class="img-thumbnail" style="max-width: 500px; @if(!$jadwal->buktiSerah) display:none; @endif">
                        <span id="placeholderText" @if($jadwal->buktiSerah) style="display:none;" @endif>No image selected</span>
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <a href="{{ route('jadwal') }}" class="btn btn-primary">Back to Schedules</a>
                        <div>
                            <button type="button" onclick="submitForm('borrowed')" class="btn btn-success">Approve</button>
                            <button type="button" onclick="submitForm('deny')" class="btn btn-danger">Deny</button>
                        </div>
                    </div>
                    <input type="hidden" name="action" id="action">
                </form>
            @else
                <form action="{{ route('jadwal.serahkembali') }}" method="POST" enctype="multipart/form-data" class="mt-3">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="id_jadwal" id="id_jadwal" value="{{ $jadwal->id }}">
                    <div class="form-group">
                        <label for="buktiSerah">Bukti Penerimaan</label>
                        <input type="file" name="buktiSerah" id="imageInput" class="form-control-file" accept="image/*">
                        <div class="image-preview mt-2" id="imagePreview">
                            <img src="{{ asset($jadwal->buktiSerah) }}" alt="Bukti Serah Image" id="imageElement" class="img-thumbnail" style="max-width: 200px; @if(!$jadwal->buktiSerah) display:none; @endif">
                            <span id="placeholderText" @if($jadwal->buktiSerah) style="display:none;" @endif>No image selected</span>
                        </div>
                        @if ($jadwal->buktiSerah)
                            <p class="mt-2">Current file: <strong>{{ basename($jadwal->buktiSerah) }}</strong></p>
                        @endif
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('jadwal') }}" class="btn btn-primary">Back to Schedules</a>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            @endif
        @elseif($jadwal->status == 'Borrowed')
            <h1>Form Pengembalian</h1>
            @if (auth()->user()->is_admin)
                <form id="adminForm" action="{{ route('jadwal.action') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_jadwal" id="id_jadwal" value="{{ $jadwal->id }}">
                    
                    <div class="image-preview mt-2" id="imagePreview">
                        <img src="{{ asset($jadwal->buktiKembali) }}" alt="Bukti Serah Image" id="imageElement" class="img-thumbnail" style="max-width: 500px; @if(!$jadwal->buktiKembali) display:none; @endif">
                        <span id="placeholderText" @if($jadwal->buktiKembali) style="display:none;" @endif>No image selected</span>
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <a href="{{ route('jadwal') }}" class="btn btn-primary">Back to Schedules</a>
                        <div>
                            <button type="button" onclick="submitForm('returned')" class="btn btn-success">Approve</button>
                            <button type="button" onclick="submitForm('deny')" class="btn btn-danger">Deny</button>
                        </div>
                    </div>
                    <input type="hidden" name="action" id="action">
                </form>
            @else
                <form action="{{ route('jadwal.serahkembali') }}" method="POST" enctype="multipart/form-data" class="mt-3">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="id_jadwal" id="id_jadwal" value="{{ $jadwal->id }}" readonly>
                    <div class="form-group">
                        <label for="buktiKembali">Bukti Pengembalian</label>
                        <input type="file" name="buktiKembali" id="imageInput" class="form-control-file" accept="image/*">
                        <div class="image-preview mt-2" id="imagePreview">
                            <img src="{{ asset($jadwal->buktiKembali) }}" alt="Bukti Serah Image" id="imageElement" class="img-thumbnail" style="max-width: 200px; @if(!$jadwal->buktiKembali) display:none; @endif">
                            <span id="placeholderText" @if($jadwal->buktiKembali) style="display:none;" @endif>No image selected</span>
                        </div>
                        @if ($jadwal->buktiKembali)
                            <p class="mt-2">Current file: <strong>{{ basename($jadwal->buktiKembali) }}</strong></p>
                        @endif
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('jadwal') }}" class="btn btn-primary">Back to Schedules</a>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            @endif
        @endif
    </div>
</div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const imageInput = document.getElementById('imageInput');
            if (imageInput) {
                const imagePreview = document.getElementById('imagePreview');
                const imageElement = document.getElementById('imageElement');
                const placeholderText = document.getElementById('placeholderText');

                // Function to show the selected image
                function showImage(file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imageElement.src = e.target.result;
                        imageElement.style.display = 'block';
                        placeholderText.style.display = 'none';
                    }
                    reader.readAsDataURL(file);
                }

                // Event listener for file input change
                imageInput.addEventListener('change', function() {
                    const file = this.files[0];
                    if (file) {
                        showImage(file);
                    } else {
                        imageElement.style.display = 'none';
                        placeholderText.style.display = 'block';
                    }
                });
            }
        });

        function submitForm(action) {
            const form = document.getElementById('adminForm');
            document.getElementById('action').value = action;

            form.submit();
        }
    </script>
@endsection
