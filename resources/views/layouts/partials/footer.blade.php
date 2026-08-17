<footer class="site-footer">
  <div class="footer-top">

    <!-- Column 1: Profil -->
    <div class="footer-col">
      <h4>Profil</h4>
      <div style="margin-top: 24px;" class="footer-links-group">
        <a href="{{ url('/profile/tentang-kami') }}">Tentang Kami</a>
        <a href="{{ url('/profile/pimpinan') }}">Profil Pimpinan</a>
        <a href="{{ url('/profile/uptd') }}">Unit Pelayanan Terpadu</a>
      </div>
    </div>

    <!-- Column 2: Dokumen dan Publikasi -->
    <div class="footer-col">
      <h4>Dokumen dan Publikasi</h4>
      <div style="margin-top: 24px;" class="footer-links-group">
        <a href="{{ url('/dokumen') }}">Semua Dokumen</a>
      </div>
    </div>

    <!-- Column 3: PPID -->
    <div class="footer-col">
      <h4>PPID</h4>
      <div style="margin-top: 24px;" class="footer-links-group">
        <a href="{{ url('/ppid/profil') }}">Profil PPID</a>
        <a href="{{ url('/ppid/alur-permohonan') }}">Alur Permohonan Informasi</a>
      </div>
    </div>

    <!-- Column 4: Layanan -->
    <div class="footer-col">
      <h4>Layanan</h4>
      <div style="margin-top: 24px;" class="footer-links-group">
        <a href="{{ url('/layanan/sp4n-lapor') }}">SP4N Lapor</a>
        <a href="{{ url('/layanan/form-pengaduan') }}">Form Layanan Pengaduan UPTD PPA Jabar</a>
      </div>
    </div>

    <!-- Column 5: Program Dinas (Showcase Grid) -->
 <!-- Column 5: Program Dinas (Showcase Grid) -->
<!-- Column 5: Program Dinas (Showcase Grid) -->
<div class="footer-col footer-showcase">
  <h4>Program Dinas</h4>
  <div class="showcase-grid">
    @forelse ($footerPrograms as $program)
      <a href="{{ route('program.show', $program->id) }}" class="showcase-card">
        <div class="showcase-image"
             @if($program->gambar)
               style="background-image: url('{{ str_starts_with($program->gambar, 'http') ? $program->gambar : asset('storage/'.$program->gambar) }}');"
             @endif>
          @if(!$program->gambar)
            <span class="showcase-title">{{ $program->nama_program }}</span>
          @endif
        </div>
        <div class="showcase-label">Selengkapnya</div>
      </a>
    @empty
      <p style="font-size: 13px; color: #888; margin: 0;">Belum ada program yang ditambahkan.</p>
    @endforelse
  </div>
</div>
</div>

  </div>

  <!-- Bar Tengah: Kontak & Social Media (Full Width Edge-to-Edge) -->
  <div class="footer-middle-bar-outer">
    <div class="footer-middle-bar">
      <!-- Kontak di Kiri -->
      <div class="footer-contact-inline">
        <span class="contact-item">
          <svg class="contact-icon" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C7.86 2 4.5 5.36 4.5 9.5c0 5.25 6.3 11.4 6.57 11.66a1.3 1.3 0 0 0 1.86 0C13.2 20.9 19.5 14.75 19.5 9.5 19.5 5.36 16.14 2 12 2zm0 10.25a2.75 2.75 0 1 1 0-5.5 2.75 2.75 0 0 1 0 5.5z"/></svg>
          567J+HX6, Jl. Babakan, Majalengka Wetan, Kec. Majalengka, Kabupaten Majalengka, Jawa Barat 45411
        </span>
        <span class="contact-item">
          <svg class="contact-icon" viewBox="0 0 24 24" fill="currentColor"><path d="M6.6 10.8c1.5 3 3.9 5.3 6.9 6.9l2.3-2.3c.3-.3.7-.4 1-.2 1.1.4 2.3.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1C10.9 21 3 13.1 3 3.5c0-.6.4-1 1-1h3.2c.6 0 1 .4 1 1 0 1.3.2 2.5.6 3.6.1.4 0 .8-.3 1.1L6.6 10.8z"/></svg>
          (0233) 8291407
        </span>
        <span class="contact-item">
          <svg class="contact-icon" viewBox="0 0 24 24" fill="currentColor"><path d="M12.05 2C6.6 2 2.16 6.44 2.16 11.9c0 1.77.46 3.44 1.28 4.9L2 22l5.34-1.4a9.9 9.9 0 0 0 4.71 1.2h.01c5.45 0 9.9-4.44 9.9-9.9C21.96 6.44 17.5 2 12.05 2zm0 18.05h-.01a8.2 8.2 0 0 1-4.18-1.15l-.3-.18-3.17.83.85-3.09-.2-.32a8.19 8.19 0 0 1-1.26-4.34c0-4.53 3.69-8.22 8.28-8.22 2.21 0 4.28.86 5.84 2.42a8.2 8.2 0 0 1 2.42 5.83c0 4.53-3.69 8.22-8.27 8.22zm4.53-6.16c-.25-.12-1.47-.72-1.69-.81-.23-.08-.4-.12-.56.13-.17.25-.65.81-.79.97-.15.17-.29.19-.54.06-.25-.12-1.04-.38-1.98-1.22-.73-.65-1.23-1.46-1.37-1.7-.14-.25-.02-.38.11-.51.11-.11.25-.29.37-.43.12-.15.16-.25.24-.42.08-.17.04-.31-.02-.43-.06-.12-.56-1.35-.77-1.85-.2-.48-.41-.42-.56-.43h-.48c-.17 0-.44.06-.67.31-.23.25-.87.85-.87 2.08 0 1.23.89 2.42 1.02 2.58.12.17 1.75 2.67 4.24 3.74.59.26 1.05.41 1.41.52.59.19 1.13.16 1.56.1.48-.07 1.47-.6 1.67-1.18.21-.58.21-1.08.15-1.18-.06-.1-.23-.16-.48-.28z"/></svg>
          WA: +62 831-3358-8992
        </span>
        <span class="contact-item">
          <svg class="contact-icon" viewBox="0 0 24 24" fill="currentColor"><path d="M3 5.5A1.5 1.5 0 0 1 4.5 4h15A1.5 1.5 0 0 1 21 5.5v13a1.5 1.5 0 0 1-1.5 1.5h-15A1.5 1.5 0 0 1 3 18.5v-13zm2.2.5 6.3 5.1a.75.75 0 0 0 .94 0L18.8 6H5.2zM19.5 7.8l-6.3 5.1a2.25 2.25 0 0 1-2.83 0L4.5 7.8v10.7h15V7.8z"/></svg>
          <a href="mailto:dp3akb.creativeteam@gmail.com">dp3akb.creativeteam@gmail.com</a>
        </span>
      </div>

      <!-- Social Media di Kanan -->
      <div class="footer-social">
       <a href="https://www.instagram.com/dp3akbmajalengka?igsh=dWFudzV4aG1idDl5" target="_blank" rel="noopener" aria-label="Instagram">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
        <path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/>
    </svg>
</a>
        <a href="https://www.facebook.com/share/g/1LYooSsN9w/" title="Facebook"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M13.5 21v-8h2.7l.4-3.1h-3.1V8c0-.9.25-1.5 1.55-1.5H17V3.7C16.7 3.65 15.7 3.5 14.5 3.5c-2.4 0-4 1.45-4 4.1v2.3H7.8V13h2.7v8h3z"/></svg></a>
        <a href="https://youtube.com/@dp3akbkabupatenmajalengka733?si=STfZlks15IJrTjG-" title="YouTube"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M21.6 7.2s-.2-1.5-.8-2.1c-.8-.8-1.7-.8-2.1-.9C15.9 4 12 4 12 4h0s-3.9 0-6.7.2c-.4 0-1.3.1-2.1.9-.6.6-.8 2.1-.8 2.1S2.2 9 2.2 10.7v1.6c0 1.7.2 3.5.2 3.5s.2 1.5.8 2.1c.8.8 1.9.8 2.3.9 1.7.2 7.5.2 7.5.2s3.9 0 6.7-.2c.4 0 1.3-.1 2.1-.9.6-.6.8-2.1.8-2.1s.2-1.7.2-3.5v-1.6c0-1.7-.2-3.5-.2-3.5zM9.8 14.5V8.7l5.3 2.9-5.3 2.9z"/></svg></a>
        <a href="https://www.tiktok.com/@pemkabmajalengka?_r=1&_t=ZS-98vvWOtaLau" title="TikTok"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M14 3c.3 1.7 1.4 3 3.2 3.5v2.6c-1.2 0-2.3-.4-3.2-1v6.4c0 3-2.5 5.5-5.5 5.5S3 17.5 3 14.5 5.5 9 8.5 9c.3 0 .6 0 .9.1v2.6a2.9 2.9 0 1 0 2 2.8V3H14z"/></svg></a>
      </div>
    </div>
  </div>

  <!-- Bottom Bar -->
  <div class="footer-bottom">
    <p>&copy; {{ date('Y') }} Dinas Pemberdayaan Perempuan, Perlindungan Anak dan Keluarga Berencana. Seluruh Hak Dilindungi.</p>
  </div>
</footer>