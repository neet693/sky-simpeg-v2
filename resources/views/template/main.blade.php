<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('template/css/template-dashboard.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>

    {{-- Data Tables --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    {{-- Trix Editor --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js"></script>


    <title>SKY SIMPEG</title>
</head>

<body>

    <div class="screen-cover d-none d-xl-none"></div>

    <div class="row">
        <div class="col-12 col-lg-3 col-navbar d-none d-xl-block">
            @include('template.navbar')
        </div>


        <div class="col-12 col-xl-9">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>

    <script>
        const navbar = document.querySelector('.col-navbar')
        const cover = document.querySelector('.screen-cover')

        const sidebar_items = document.querySelectorAll('.sidebar-item')

        function toggleNavbar() {
            navbar.classList.toggle('d-none')
            cover.classList.toggle('d-none')
        }

        function toggleActive(e) {
            sidebar_items.forEach(function(v, k) {
                v.classList.remove('active')
            })
            e.closest('.sidebar-item').classList.add('active')

        }
    </script>

    {{-- Script Table --}}
    <script>
        $(function() {
            // 1. Inisialisasi sortable untuk drag-and-drop
            $(".taskColumn").sortable({
                connectWith: ".taskColumn",
                update: function(event, ui) {
                    let tasks = [];
                    $(this).children(".task").each(function(index, element) {
                        tasks.push({
                            id: $(element).data("id"),
                            order: index,
                            status: normalizeStatus($(this).parent().attr("id").replace(
                                "Column", ""))
                        });
                    });

                    // Kirim perubahan ke server
                    $.ajax({
                        url: "/update-task-order",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            tasks: tasks
                        },
                        success: function(response) {
                            updateTaskColumns(response.updatedTasks);
                        },
                        error: function(xhr) {
                            console.error("Error updating task order and status:", xhr
                                .responseText);
                        }
                    });
                }
            });

            // 2. Edit inline untuk task dengan double-click
            $(document).on('dblclick', '.editable', function() {
                let $this = $(this);
                let originalValue = $this.text();
                let taskElement = $this.closest('.task');
                let field = $this.data('field');

                // Ganti teks dengan input field untuk diedit
                let input = $('<input>', {
                    type: 'text',
                    class: 'inline-edit',
                    value: originalValue
                });

                $this.replaceWith(input);
                input.focus();

                // Event ketika selesai edit (blur)
                input.on('blur', function() {
                    let newValue = input.val();

                    if (newValue === originalValue) {
                        input.replaceWith(
                            `<p class="font-semibold editable" data-field="${field}">${originalValue}</p>`
                        );
                        return;
                    }

                    // Kirim perubahan ke server
                    $.ajax({
                        url: '/update-task-inline',
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: taskElement.data('id'),
                            field: field,
                            value: newValue
                        },
                        success: function(response) {
                            input.replaceWith(
                                `<p class="font-semibold editable" data-field="${field}">${newValue}</p>`
                            );
                        },
                        error: function(xhr) {
                            console.error("Error updating task:", xhr.responseText);
                            input.replaceWith(
                                `<p class="font-semibold editable" data-field="${field}">${originalValue}</p>`
                            );
                        }
                    });
                });

                // Event ketika menekan Enter untuk menyimpan
                input.on('keydown', function(e) {
                    if (e.key === 'Enter') {
                        input.blur();
                    }
                });
            });

            // 3. Fungsi untuk normalisasi status
            function normalizeStatus(status) {
                if (status === "todo") {
                    return "To Do";
                } else if (status === "inProgress") {
                    return "In Progress";
                } else if (status === "done") {
                    return "Done";
                }
                return status;
            }

            // 4. Fungsi untuk memperbarui kolom task dengan data terbaru
            function updateTaskColumns(tasks) {
                $('#todoColumn').empty();
                $('#inProgressColumn').empty();
                $('#doneColumn').empty();

                let currentUserId = {{ auth()->id() }}; // Ambil ID user yang sedang login dari Blade

                tasks.forEach(function(task) {
                    let title = task.title ?? "Tambah Title";
                    let description = task.description ?? "Tambah Description";

                    // Tombol hapus hanya muncul jika user adalah pemilik task
                    let deleteButton = task.user_id === currentUserId ?
                        `<button class="text-red-600 delete-task" data-id="${task.id}">Hapus</button>` :
                        '';

                    let taskElement = `
            <div class="p-4 mb-4 bg-white rounded-lg shadow-lg task cursor-grab hover:shadow-xl ui-sortable-handle"
                 data-id="${task.id}" data-order="${task.order}" data-status="${task.status}">
                ${title !== "" ? `<p class="font-semibold editable" data-field="title">${title}</p>` : ""}
                ${description !== "" ? `<p class="font-semibold editable" data-field="description">${description}</p>` : ""}
                ${deleteButton}
            </div>`;

                    if (task.status === 'To Do') {
                        $('#todoColumn').append(taskElement);
                    } else if (task.status === 'In Progress') {
                        $('#inProgressColumn').append(taskElement);
                    } else if (task.status === 'Done') {
                        $('#doneColumn').append(taskElement);
                    }
                });
            }

        });
    </script>




</body>

</html>
