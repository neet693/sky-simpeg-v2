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
            $(".taskColumn").sortable({
                connectWith: ".taskColumn",
                update: function(event, ui) {
                    let tasks = [];
                    $(this).children(".task").each(function(index, element) {
                        tasks.push({
                            id: $(element).data("id"),
                            order: index,
                            status: normalizeStatus($(this).parent().attr("id").replace(
                                "Column", "")) // Status berdasarkan kolom
                        });
                    });

                    // Debug: pastikan data yang dikirim sesuai
                    console.log(tasks);

                    $.ajax({
                        url: "/update-task-order",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            tasks: tasks
                        },
                        success: function(response) {
                            console.log("Task order and status updated successfully.");
                            updateTaskColumns(response.updatedTasks);
                        },
                        // error: function(xhr) {
                        //     console.error("Error updating task order and status:", xhr
                        //         .responseText);
                        // }
                    });
                }
            });
        });

        // Fungsi untuk normalisasi status
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

        // Fungsi untuk memperbarui kolom task dengan data terbaru
        function updateTaskColumns(tasks) {
            // Kosongkan kolom sebelum memperbarui
            $('#todoColumn').empty();
            $('#inProgressColumn').empty();
            $('#doneColumn').empty();

            // Pastikan task ditambahkan berdasarkan status yang benar
            tasks.forEach(function(task) {
                let taskElement = `<div class="task bg-white p-4 mb-4 rounded-lg shadow-lg cursor-grab hover:shadow-xl ui-sortable-handle"
                                   data-id="${task.id}" data-order="${task.order}" data-status="${task.status}">
                                    <p class="font-semibold">${task.title}</p>
                                </div>`;

                // Menambahkan task ke kolom yang sesuai berdasarkan status
                if (task.status === 'To Do') {
                    $('#todoColumn').append(taskElement);
                } else if (task.status === 'In Progress') {
                    $('#inProgressColumn').append(taskElement);
                } else if (task.status === 'Done') {
                    $('#doneColumn').append(taskElement);
                }
            });
        }
    </script>


</body>

</html>
