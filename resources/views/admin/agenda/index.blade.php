@extends('layouts.admin')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/agenda.css') }}">
@endpush

@section('content')
    <div class="card">
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Nama Kegiatan</th>
                        <th>Tanggal</th>
                        <th>Lokasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($agendas as $agenda)
                        <tr>
                            <td>{{ $agenda->nama_kegiatan }}</td>
                            <td>
                                <span class="agenda-date">
                                    <i class="fa-regular fa-calendar"></i>
                                    {{ $agenda->tanggal->translatedFormat('d M Y') }}
                                </span>
                            </td>
                            <td>{{ $agenda->lokasi }}</td>
                            <td>
                                <div class="agenda-actions">
                                    <a href="{{ route('admin.agenda.edit', $agenda->id) }}" class="btn btn-outline btn-sm">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                    <form action="{{ route('admin.agenda.destroy', $agenda->id) }}" method="POST" class="js-delete-form" data-item-name="agenda &quot;{{ $agenda->nama_kegiatan }}&quot;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm">
        <i class="fa-solid fa-trash"></i>
    </button>
</form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="text-align:center; padding: 30px 0; color:#9ca3af;">
                                Belum ada agenda.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="agenda-pagination">
            {{ $agendas->links() }}
        </div>
    </div>
@endsection