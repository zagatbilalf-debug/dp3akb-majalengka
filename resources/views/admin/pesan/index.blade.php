@extends('layouts.admin')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/pesan.css') }}">
@endpush

@section('content')
    <div class="card">
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>Nama</th>
                        <th>Subjek</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pesans as $pesan)
                        <tr class="{{ $pesan->status === 'belum_dibaca' ? 'pesan-row-unread' : '' }}">
                            <td>
                                @if($pesan->status === 'belum_dibaca')
                                    <span class="badge badge-info">Belum Dibaca</span>
                                @else
                                    <span class="badge badge-success">Dibaca</span>
                                @endif
                            </td>
                            <td>
                                <div class="pesan-nama">{{ $pesan->nama }}</div>
                                <div class="pesan-email">{{ $pesan->email }}</div>
                            </td>
                            <td>{{ Str::limit($pesan->subjek, 40) }}</td>
                            <td>{{ $pesan->created_at->translatedFormat('d M Y, H:i') }}</td>
                            <td>
                                <div class="pesan-actions">
                                    <a href="{{ route('admin.pesan.show', $pesan->id) }}" class="btn btn-outline btn-sm">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                  <form action="{{ route('admin.pesan.destroy', $pesan->id) }}" method="POST" class="js-delete-form" data-item-name="pesan &quot;{{ $pesan->subjek }}&quot;">
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
                            <td colspan="5" style="text-align:center; padding: 30px 0; color:#9ca3af;">
                                Belum ada pesan masuk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pesan-pagination">
            {{ $pesans->links() }}
        </div>
    </div>
@endsection