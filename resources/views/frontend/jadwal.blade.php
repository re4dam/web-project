@extends('frontend.master')

@section('content')

    <div class="container jadwal">
        <div class="card jadwal">
            <div class="card-header jadwal">
                @if (auth()->user()->is_admin)
                    <h1 class="text-center">Rekapan Jadwal</h1>                
                @else
                    <h1 class="text-center">Select Jadwal</h1>                
                @endif
            </div>
            <div class="card-body jadwal">
                <table class="table table-bordered jadwal">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            @auth
                                @if (auth()->user()->is_admin)
                                    <th>Name</th>
                                @endif
                            @endauth
                            
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jadwals as $jadwal)
                            <tr>
                                <td>{{ $loop->iteration}}</td>
                                @if (auth()->user()->is_admin)
                                    <td>{{ $jadwal->user->name }}</td>
                                @endif
                                <td>{{ $jadwal->start_date }}</td>
                                <td>{{ $jadwal->end_date }}</td>
                                <td>{{ $jadwal->status }}</td>
                                <td class="text-center">
                                    <form id="jadwalForm" method="POST">
                                        @csrf
                                        <button type="button" onclick="redirectToDetail('{{ $jadwal->id }}')" class="btn btn-primary jadwal">Detail</button>
                                        @if ($jadwal->status == 'Waiting For Approval' && auth()->user()->is_admin)
                                            <button type="button" onclick="submitAction('approve', '{{ $jadwal-> id }}')" class="btn btn-success jadwal">Approve</button>
                                            <button type="button" onclick="submitAction('deny', '{{ $jadwal-> id }}')" class="btn btn-danger jadwal">Deny</button>
                                        @elseif ($jadwal->status == 'Waiting For Retrieval')
                                            <button type="button" onclick="Action('borrowed', '{{ $jadwal->id }}')" class="btn btn-primary jadwal">Pinjamkan</button>
                                        @elseif ($jadwal->status == 'Borrowed')
                                            <button type="button" onclick="Action('returned', '{{ $jadwal->id }}')" class="btn btn-primary jadwal">Kembalikan</button>
                                        @endif
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function redirectToDetail(jadwalId) {
        var form = document.getElementById('jadwalForm');
        var Url = "{{ route('detail') }}";

        const input = document.createElement('input');
        input.setAttribute("type","hidden");
        input.setAttribute("name","jadwal");
        input.setAttribute("value",jadwalId);
        
        form.appendChild(input);
        form.action = Url;
        form.submit();
    }

    function redirectToPeminjaman(jadwalId) {
        var form = document.getElementById('jadwalForm');
        var Url = "{{ route('pinjam') }}";

        const input = document.createElement('input');
        input.setAttribute("type","hidden");
        input.setAttribute("name","id_jadwal");
        input.setAttribute("value",jadwalId);
        
        form.appendChild(input);
        form.action = Url;
        form.submit();
    }

    function submitAction(action, jadwalId) {
        console.log("Jadwal ID:", jadwalId); // Log the jadwalId
        var Url = "{{ route('jadwal.action') }}";

        // Set the action value in a hidden input field
        const actionInput = document.createElement('input');
        actionInput.type = 'hidden';
        actionInput.name = 'action';
        actionInput.value = action;

        // Set the jadwalId value in a hidden input field
        const jadwalIdInput = document.createElement('input');
        jadwalIdInput.type = 'hidden';
        jadwalIdInput.name = 'id_jadwal';
        jadwalIdInput.value = jadwalId;

        // Append the action and jadwalId input fields to the form
        const form = document.getElementById('jadwalForm');
        form.appendChild(actionInput);
        form.appendChild(jadwalIdInput);

        console.log("Coba :",jadwalIdInput);
        form.action = Url;

        // Submit the form
        form.submit();
    }

    function Action(action, jadwalId){
        var Url = "{{ route('pinjam') }}";

        if(action === 'borrowed'){
            Url = "{{ route('pinjam') }}";
        }
        else if(action === 'returned'){
            
        }

        const jadwalIdInput = document.createElement('input');
        jadwalIdInput.type = 'hidden';
        jadwalIdInput.name = 'id_jadwal';
        jadwalIdInput.value = jadwalId;

        const form = document.getElementById('jadwalForm');
        form.appendChild(jadwalIdInput);

        console.log(form);

        form.action = Url;
        form.submit();
    }

</script>
@endsection