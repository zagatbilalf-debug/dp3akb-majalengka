<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property string $nama_kegiatan
 * @property \Illuminate\Support\Carbon $tanggal
 * @property string $lokasi
 * @property string|null $deskripsi
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Agenda newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Agenda newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Agenda query()
 * @method static \Illuminate\Database\Eloquent\Builder|Agenda whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Agenda whereDeskripsi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Agenda whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Agenda whereLokasi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Agenda whereNamaKegiatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Agenda whereTanggal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Agenda whereUpdatedAt($value)
 */
	class Agenda extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $judul
 * @property string $slug
 * @property string|null $kategori
 * @property string|null $gambar
 * @property string $konten
 * @property string $status
 * @property string|null $tanggal_terbit
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Berita newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Berita newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Berita query()
 * @method static \Illuminate\Database\Eloquent\Builder|Berita whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Berita whereGambar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Berita whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Berita whereJudul($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Berita whereKategori($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Berita whereKonten($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Berita whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Berita whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Berita whereTanggalTerbit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Berita whereUpdatedAt($value)
 */
	class Berita extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $judul
 * @property string|null $kategori
 * @property string $file
 * @property \Illuminate\Support\Carbon|null $tanggal
 * @property string|null $deskripsi
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Dokumen newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Dokumen newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Dokumen query()
 * @method static \Illuminate\Database\Eloquent\Builder|Dokumen whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dokumen whereDeskripsi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dokumen whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dokumen whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dokumen whereJudul($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dokumen whereKategori($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dokumen whereTanggal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dokumen whereUpdatedAt($value)
 */
	class Dokumen extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $judul
 * @property string $foto
 * @property string $tahun
 * @property string|null $deskripsi
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Gallery newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Gallery newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Gallery query()
 * @method static \Illuminate\Database\Eloquent\Builder|Gallery whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gallery whereDeskripsi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gallery whereFoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gallery whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gallery whereJudul($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gallery whereTahun($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gallery whereUpdatedAt($value)
 */
	class Gallery extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $nama_pelapor
 * @property string $kontak_pelapor
 * @property string $judul
 * @property string|null $kategori
 * @property string $isi_laporan
 * @property string|null $lokasi
 * @property string|null $lampiran
 * @property string $status
 * @property string|null $tanggapan
 * @property \Illuminate\Support\Carbon|null $tanggal_lapor
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Laporan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Laporan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Laporan query()
 * @method static \Illuminate\Database\Eloquent\Builder|Laporan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Laporan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Laporan whereIsiLaporan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Laporan whereJudul($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Laporan whereKategori($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Laporan whereKontakPelapor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Laporan whereLampiran($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Laporan whereLokasi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Laporan whereNamaPelapor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Laporan whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Laporan whereTanggalLapor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Laporan whereTanggapan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Laporan whereUpdatedAt($value)
 */
	class Laporan extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $nama
 * @property string $email
 * @property string $subjek
 * @property string $pesan
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Pesan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pesan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pesan query()
 * @method static \Illuminate\Database\Eloquent\Builder|Pesan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pesan whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pesan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pesan whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pesan wherePesan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pesan whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pesan whereSubjek($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pesan whereUpdatedAt($value)
 */
	class Pesan extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $nama
 * @property string|null $nip
 * @property string $jabatan
 * @property string $kategori
 * @property string $foto
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $kategori_slug
 * @method static \Illuminate\Database\Eloquent\Builder|Pimpinan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pimpinan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pimpinan query()
 * @method static \Illuminate\Database\Eloquent\Builder|Pimpinan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pimpinan whereFoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pimpinan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pimpinan whereJabatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pimpinan whereKategori($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pimpinan whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pimpinan whereNip($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pimpinan whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pimpinan whereUpdatedAt($value)
 */
	class Pimpinan extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $nama_program
 * @property string|null $gambar
 * @property string $deskripsi
 * @property string|null $link
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Program newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Program newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Program query()
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereDeskripsi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereGambar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereNamaProgram($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereUpdatedAt($value)
 */
	class Program extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $username
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUsername($value)
 */
	class User extends \Eloquent {}
}

