@extends('template.main-homepage')
@section('content')
    <section class="banner">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-11 col-12">
                    <div class="row">
                        <div class="col-lg-6 col-12 copywriting">
                            <p class="story">
                                Sistem Kepegawaian
                            </p>
                            <h1 class="header">
                                Kelola <span class="text-purple">Data Karyawan</span> dengan Mudah!
                            </h1>
                            <p class="support">
                                Mengelola informasi karyawan secara efisien dan terorganisir untuk mendukung operasi sekolah
                            </p>
                            <p class="cta">
                                <a href="#" class="btn btn-master btn-login">
                                    Mulai Sekarang
                                </a>
                            </p>
                        </div>
                        <div class="col-lg-6 col-12 text-center">
                            <a href="#">
                                <img src="{{ asset('app/assets/images/banner.png') }}" class="img-fluid" alt="Banner Image">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="benefits" id="Keunggulan">
        <div class="container">
            <div class="row text-center pb-70">
                <div class="col-lg-12 col-12 header-wrap">
                    <p class="story">
                        Mengapa Memilih Sistem Kepegawaian Kami?
                    </p>
                    <h2 class="primary-header">
                        Rasakan <span class="text-purple">Keunggulan</span> Kami!
                    </h2>
                </div>
            </div>
            <div class="row justify-items-center justify-content-center">
                <div class="col-lg-3 col-12">
                    <div class="item-benefit">
                        <img src="{{ asset('app/assets/images/ic-s.png') }}" class="icon" alt="Icon">
                        <h3 class="title">
                            Terintegrasi
                        </h3>
                        <p class="support">
                            Semua data karyawan terkumpul dalam satu sistem yang terintegrasi.
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-12">
                    <div class="item-benefit">
                        <img src="{{ asset('app/assets/images/ic-m.png') }}" class="icon" alt="Icon">
                        <h3 class="title">
                            Mudah Digunakan
                        </h3>
                        <p class="support">
                            Antarmuka yang intuitif dan mudah digunakan oleh semua pengguna.
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-12">
                    <div class="item-benefit">
                        <img src="{{ asset('app/assets/images/ic-a.png') }}" class="icon" alt="Icon">
                        <h3 class="title">
                            Akurat
                        </h3>
                        <p class="support">
                            Data yang akurat dan terpercaya untuk pengambilan keputusan.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row justify-items-center justify-content-center">
                <div class="col-lg-3 col-12">
                    <div class="item-benefit">
                        <img src="{{ asset('app/assets/images/ic-r.png') }}" class="icon" alt="Icon">
                        <h3 class="title">
                            Ramah Pengguna
                        </h3>
                        <p class="support">
                            Dirancang untuk memudahkan pengguna dalam mengelola data.
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-12">
                    <div class="item-benefit">
                        <img src="{{ asset('app/assets/images/ic-t.png') }}" class="icon" alt="Icon">
                        <h3 class="title">
                            Terpercaya
                        </h3>
                        <p class="support">
                            Sistem yang andal dan dapat diandalkan untuk kebutuhan Anda.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="steps">
        <div class="container">
            <div class="row text-center pb-70">
                <div class="col-lg-12 col-12 header-wrap">
                    <p class="story">
                        Langkah Mudah Menggunakan Sistem Kami
                    </p>
                    <h2 class="primary-header">
                        Bergabunglah dengan <span class="text-purple">Sistem Kepegawaian</span> Kami dengan Mudah
                    </h2>
                </div>
            </div>
            <div class="row item-step pb-70">
                <div class="col-lg-6 col-12 text-center">
                    <img src="{{ asset('app/assets/images/step1.png') }}" class="cover" alt="Step 1 Image">
                </div>
                <div class="col-lg-6 col-12 text-left copywriting">
                    <p class="story">
                        Daftarkan Karyawan
                    </p>
                    <h2 class="primary-header">
                        Daftarkan Karyawan Baru
                    </h2>
                    <p class="support">
                        Tambahkan informasi karyawan baru dengan mudah melalui form pendaftaran.
                    </p>
                    <p class="mt-5">
                        <a href="#" class="btn btn-master btn-secondary me-3">
                            Daftarkan Karyawan
                        </a>
                    </p>
                </div>
            </div>
            <div class="row item-step pb-70">
                <div class="col-lg-6 col-12 text-left copywriting pl-150">
                    <p class="story">
                        Kelola Data
                    </p>
                    <h2 class="primary-header">
                        Kelola Data Karyawan
                    </h2>
                    <p class="support">
                        Perbarui dan kelola data karyawan secara efisien dan terorganisir.
                    </p>
                    <p class="mt-5">
                        <a href="#" class="btn btn-master btn-login">
                            Kelola Data
                        </a>
                    </p>
                </div>
                <div class="col-lg-6 col-12 text-center">
                    <img src="{{ asset('app/assets/images/step2.png') }}" class="cover" alt="Step 2 Image">
                </div>
            </div>
            <div class="row item-step">
                <div class="col-lg-6 col-12 text-center">
                    <img src="{{ asset('app/assets/images/step3.png') }}" class="cover" alt="Step 3 Image">
                </div>
                <div class="col-lg-6 col-12 text-left copywriting">
                    <p class="story">
                        Konfirmasi
                    </p>
                    <h2 class="primary-header">
                        Verifikasi dan Konfirmasi
                    </h2>
                    <p class="support">
                        Verifikasi dan konfirmasi data karyawan dengan cepat dan mudah.
                    </p>
                    <p class="mt-5">
                        <a href="{{ route('login') }}" class="btn btn-master btn-secondary me-3">
                            Login ke Sistem
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="brands">
        <div class="container">
            <div class="row text-center pb-70 pt-70">
                <div class="col-lg-12 col-12 header-wrap">
                    <p class="story">
                        MITRA KAMI
                    </p>
                    <h2 class="primary-header">
                        Sistem Kepegawaian Kami Bekerja Sama dengan
                    </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-6 text-center">
                    <img src="{{ asset('app/assets/images/ovs-es.png') }}" alt="Brand 1">
                </div>
                <div class="col-lg-6 col-6 text-center">
                    <img src="{{ asset('app/assets/images/g-suite.png') }}" alt="Brand 2">
                </div>
            </div>
        </div>
    </section>

    <section class="testimonials">
        <div class="container">
            <div class="row text-center pb-70 pt-70">
                <div class="col-lg-12 col-12 header-wrap">
                    <p class="story">
                        TESTIMONI KARYAWAN
                    </p>
                    <h2 class="primary-header">
                        Kami Bangga dengan Sistem Kepegawaian Ini
                    </h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-10 col-12">
                    <div class="row">
                        <div class="col-lg-4 col-12">
                            <div class="item-review">
                                <img src="{{ asset('app/assets/images/stars.svg') }}" alt="Stars">
                                <p class="message">
                                    Sistem ini sangat membantu dalam mengelola data karyawan dengan efisien dan
                                    terorganisir.
                                </p>
                                <div class="user">
                                    <img src="{{ asset('app/assets/images/user1.png') }}" class="photo" alt="User 1">
                                    <div class="info">
                                        <h4 class="name">
                                            John Doe
                                        </h4>
                                        <p class="role">
                                            Manager HR
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="item-review">
                                <img src="{{ asset('app/assets/images/stars.svg') }}" alt="Stars">
                                <p class="message">
                                    Antarmuka yang intuitif dan mudah digunakan membuat pekerjaan menjadi lebih cepat.
                                </p>
                                <div class="user">
                                    <img src="{{ asset('app/assets/images/user2.png') }}" class="photo" alt="User 2">
                                    <div class="info">
                                        <h4 class="name">
                                            Jane Smith
                                        </h4>
                                        <p class="role">
                                            Administrator
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="item-review">
                                <img src="{{ asset('app/assets/images/stars.svg') }}" alt="Stars">
                                <p class="message">
                                    Sistem ini telah meningkatkan efisiensi dan akurasi dalam pengelolaan data karyawan.
                                </p>
                                <div class="user">
                                    <img src="{{ asset('app/assets/images/user3.png') }}" class="photo" alt="User 3">
                                    <div class="info">
                                        <h4 class="name">
                                            Michael Brown
                                        </h4>
                                        <p class="role">
                                            Staff IT
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row copyright">
                        <div class="col-lg-12 col-12">
                            <p>
                                Hak Cipta Dilindungi. Dibuat Dengan ❤️ Oleh Departemen IT Sekolah Kristen Yahya
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
