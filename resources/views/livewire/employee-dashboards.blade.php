<div>
    <div class="content">
        <div class="row">
            <div class="col-12">
                <h2 class="content-title">Statistics</h2>
                <h5 class="content-desc mb-4">Your business growth</h5>
            </div>

            <div class="col-12 col-md-6 col-lg-4">
                <div class="statistics-card">

                    @if ($isEmployee || $isKepala)
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex flex-column justify-content-between align-items-start">
                                <h5 class="content-desc">Rekan Kerja</h5>

                                <h3 class="statistics-value">{{ $colleaguesCount }}</h3>
                            </div>
                        </div>

                        <div class="statistics-list d-flex align-items-center">
                            @foreach ($colleagues as $colleague)
                                <div class="position-relative mx-1">
                                    <a href="{{ route('employee.show', $colleague->employee_number) }}"
                                        title="Lihat Profil {{ $colleague->name }}">
                                        <img class="statistics-image rounded-circle"
                                            src="{{ $colleague->profile_photo_path
                                                ? Storage::url($colleague->profile_photo_path)
                                                : 'https://ui-avatars.com/api/?name=' . urlencode($colleague->name) . '&color=7F9CF5&background=EBF4FF' }}"
                                            alt="{{ $colleague->name }}">
                                    </a>
                                    <span class="helper-name position-absolute text-white bg-dark p-1 rounded"
                                        style="bottom: -20px; left: 50%; transform: translateX(-50%); display: none;">
                                        {{ $colleague->name }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex flex-column justify-content-between align-items-start">
                                <h5 class="content-desc">Employees</h5>

                                <h3 class="statistics-value">18,500,000</h3>
                            </div>

                            <button class="btn-statistics">
                                <img src="{{ asset('template/assets/img/global/times.svg') }}" alt="">
                            </button>
                        </div>

                        <div class="statistics-list">
                            <div class="statistics-icon award">
                                <img src="{{ asset('template/assets/img/home/team/award.svg') }}" alt="">
                            </div>
                            <div class="statistics-icon globe">
                                <img src="{{ asset('template/assets/img/home/team/globe.svg') }}" alt="">
                            </div>
                            <div class="statistics-icon target">
                                <img src="{{ asset('template/assets/img/home/team/target.svg') }}" alt="">
                            </div>
                            <div class="statistics-icon box">
                                <img src="{{ asset('template/assets/img/home/team/box.svg') }}" alt="">
                            </div>
                        </div>
                    @endif

                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4">
                <div class="statistics-card">

                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex flex-column justify-content-between align-items-start">
                            <h5 class="content-desc">Teams</h5>

                            <h3 class="statistics-value">122,000</h3>
                        </div>

                        <button class="btn-statistics">
                            <img src="{{ asset('template/assets/img/global/times.svg') }}" alt="">
                        </button>
                    </div>

                    <div class="statistics-list">
                        <div class="statistics-icon award">
                            <img src="{{ asset('template/assets/img/home/team/award.svg') }}" alt="">
                        </div>
                        <div class="statistics-icon globe">
                            <img src="{{ asset('template/assets/img/home/team/globe.svg') }}" alt="">
                        </div>
                        <div class="statistics-icon target">
                            <img src="{{ asset('template/assets/img/home/team/target.svg') }}" alt="">
                        </div>
                        <div class="statistics-icon box">
                            <img src="{{ asset('template/assets/img/home/team/box.svg') }}" alt="">
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4">
                <div class="statistics-card">

                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex flex-column justify-content-between align-items-start">
                            <h5 class="content-desc">Projects</h5>

                            <h3 class="statistics-value">150,000,000</h3>
                        </div>

                        <button class="btn-statistics">
                            <img src="{{ asset('template/assets/img/global/times.svg') }}" alt="">
                        </button>
                    </div>

                    <div class="statistics-list">
                        <div class="statistics-icon one">
                            <span>SK</span>
                        </div>
                        <div class="statistics-icon two">
                            <span>DW</span>
                        </div>
                        <div class="statistics-icon three">
                            <span>FJ</span>
                        </div>
                        <div class="statistics-icon four">
                            <span>AP</span>
                        </div>
                        <div class="statistics-icon five">
                            <span>ML</span>
                        </div>
                        <!-- <img src="./assets/img/home/icon-1.png" alt=""><img src="./assets/img/home/icon-2.png" alt=""><img src="./assets/img/home/icon-3.png" alt=""><img src="./assets/img/home/icon-4.png" alt=""><img src="./assets/img/home/icon-5.png" alt=""> -->
                    </div>

                </div>
            </div>

        </div>

        <div class="row mt-5">
            <div class="col-12 col-lg-6">
                <h2 class="content-title">Tugas dan Rapat</h2>
                <h5 class="content-desc mb-4">List Rapat dan Tugas Anda!</h5>

                <div class="document-card">
                    @forelse ($assignments as $assignment)
                        <div class="document-item">
                            <div class="d-flex justify-content-start align-items-center">
                                <div class="d-flex flex-column justify-content-between align-items-start">
                                    <h2 class="document-title">{{ $assignment->title }}</h2>
                                    <span class="document-desc">Tanggal:
                                        {{ $assignment->assignment_date->format('d F Y') }}
                                    </span>
                                    <span class="document-desc">Jam: {{ $assignment->start_time->format('H:i') }} s/d
                                        {{ $assignment->end_time->format('H:i') }}</span>
                                    <span
                                        class="badge bg-{{ $assignment->progress == 'Ditugaskan' ? 'info' : ($assignment->progress == 'Pending' ? 'warning' : 'Selesai') }}">
                                        {{ $assignment->progress }}
                                    </span>
                                </div>
                            </div>
                            <a href="#" class="btn-statistics" title="Proses Tugas">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="navy" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 8.689c0-.864.933-1.406 1.683-.977l7.108 4.061a1.125 1.125 0 0 1 0 1.954l-7.108 4.061A1.125 1.125 0 0 1 3 16.811V8.69ZM12.75 8.689c0-.864.933-1.406 1.683-.977l7.108 4.061a1.125 1.125 0 0 1 0 1.954l-7.108 4.061a1.125 1.125 0 0 1-1.683-.977V8.69Z" />
                                </svg>
                            </a>
                        </div>
                    @empty
                        <div class="document-item">
                            <div class="d-flex justify-content-start align-items-center">
                                <div class="d-flex flex-column justify-content-between align-items-start">
                                    <h2 class="document-title">No Assignments</h2>
                                    <span class="document-desc">You have no tasks at the moment.</span>
                                </div>
                            </div>
                        </div>
                    @endforelse

                    <div class="document-item">
                        <div class="d-flex justify-content-start align-items-center">
                            <div class="document-icon globe">
                                <img src="{{ asset('template/assets/img/home/document/twitch.svg') }}"
                                    alt="">
                            </div>

                            <div class="d-flex flex-column justify-content-between align-items-start">
                                <h2 class="document-title">Twitch Record</h2>

                                <span class="document-desc">700 GB • MP4</span>
                            </div>
                        </div>

                        <button class="btn-statistics">
                            <img src="{{ asset('template/assets/img/global/download.svg') }}" alt="">
                        </button>

                    </div>

                    <div class="document-item">
                        <div class="d-flex justify-content-start align-items-center">
                            <div class="document-icon database">
                                <img src="{{ asset('template/assets/img/home/document/database.svg') }}"
                                    alt="">
                            </div>

                            <div class="d-flex flex-column justify-content-between align-items-start">
                                <h2 class="document-title">Personas Datasets</h2>

                                <span class="document-desc">11 MB • CSV</span>
                            </div>
                        </div>

                        <button class="btn-statistics">
                            <img src="{{ asset('template/assets/img/global/download.svg') }}" alt="">
                        </button>

                    </div>

                    <div class="document-item">
                        <div class="d-flex justify-content-start align-items-center">
                            <div class="document-icon target">
                                <img src="{{ asset('template/assets/img/home/document/book-open.svg') }}"
                                    alt="">
                            </div>

                            <div class="d-flex flex-column justify-content-between align-items-start">
                                <h2 class="document-title">Marketing Book</h2>

                                <span class="document-desc">891 MB • PDF</span>
                            </div>
                        </div>

                        <button class="btn-statistics">
                            <img src="{{ asset('template/assets/img/global/download.svg') }}" alt="">
                        </button>

                    </div>


                </div>
            </div>

            <div class="col-12 col-lg-6">
                <h2 class="content-title">History</h2>
                <h5 class="content-desc mb-4">Track the flow</h5>

                <div class="document-card">
                    <div class="document-item">
                        <div class="d-flex justify-content-start align-items-center">
                            <img class="document-icon"
                                src="{{ asset('template/assets/img/home/history/photo.png') }}" alt="">

                            <div class="d-flex flex-column justify-content-between align-items-start">
                                <h2 class="document-title">Amalia Syahrina</h2>

                                <span class="document-desc">Promoted to Sr. Website Designer</span>
                            </div>
                        </div>


                    </div>

                    <div class="document-item">
                        <div class="d-flex justify-content-start align-items-center">
                            <img class="document-icon"
                                src="{{ asset('template/assets/img/home/history/photo-1.png') }}" alt="">

                            <div class="d-flex flex-column justify-content-between align-items-start">
                                <h2 class="document-title">Ah Park Yo</h2>

                                <span class="document-desc">Promoted to Front-End Developer</span>
                            </div>
                        </div>
                    </div>

                    <div class="document-item">
                        <div class="d-flex justify-content-start align-items-center">
                            <img class="document-icon"
                                src="{{ asset('template/assets/img/home/history/photo-2.png') }}" alt="">

                            <div class="d-flex flex-column justify-content-between align-items-start">
                                <h2 class="document-title">Sintia Siny</h2>

                                <span class="document-desc">Promoted to Accounting Executive</span>
                            </div>
                        </div>
                    </div>

                    <div class="document-item">
                        <div class="d-flex justify-content-start align-items-center">
                            <img class="document-icon"
                                src="{{ asset('template/assets/img/home/history/photo-3.png') }}" alt="">

                            <div class="d-flex flex-column justify-content-between align-items-start">
                                <h2 class="document-title">Jerami Putu</h2>

                                <span class="document-desc">Promoted to Quality Manager</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
