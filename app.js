/*
*    Save & Continue Edit - выполнение через AJAX для
*    динамического получения id нового пользователя
*    при его добавлении и дальнейшего редактирования
*/

$('#edit').click(function(){
    $.ajax({
        url: '/users/saveedit',
        data: {
            id: $('#id').val(),
            first_name: $('#first_name').val(),
            last_name: $('#last_name').val(),
            email: $('#email').val()
        },
        type: 'POST',
        success: function (res) {
            $('#id').val(res);
        },
        error: function (res) {
            console.log('Error!', res)
        }
    })
})

$("#checkAll").change(function () {
    $("input:checkbox").prop('checked', $(this).prop("checked"));
});

/*
Версия сортировки таблицы БЕЗ обращения к базе

function sortTable(n) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = document.getElementById("resultTable");
    switching = true;
    dir = "asc";
    while (switching) {
        switching = false;
        rows = table.getElementsByTagName("tr");
        for (i = 2; i < (rows.length - 1); i++) {
            shouldSwitch = false;
            x = rows[i].getElementsByTagName("td")[n];
            y = rows[i + 1].getElementsByTagName("td")[n];

            if (dir == "asc") {
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                }
            } else if (dir == "desc") {
                if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                }
            }
        }
        if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            switchcount ++;
        } else {
            if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
            }
        }
    }
}
*/

/*
    Загрузка данных с сортировкой через AJAX
 */
$('.sort').click(function () {
    $('.desc').not(this).toggleClass('desc');
    $(this).toggleClass('desc');
    $.ajax({
        url: '/users/sort',
        data: {
            column: $(this).data('column'),
            sort: $.trim($(this).attr('class').replace('sort', ''))
        },
        type: 'POST',
        success: function(res){
            $('#body').html(res);
        }
    })
})

$('#search').click(function () {
    $.ajax({
        url: '/users/filter',
        data: {
            where: {
                id: $('#id').val(),
                first_name: $('#first_name').val(),
                last_name: $('#last_name').val(),
                email: $('#email').val(),
            },
            date: {
                create_date: {
                    from: $('#create_date_from').val(),
                    to: $('#create_date_to').val(),
                },
                update_date: {
                    from: $('#update_date_from').val(),
                    to: $('#update_date_to').val()
                }
            }
        },
        type: 'POST',
        success: function (res) {
            if (res) {
                $('#body').html(res);
            }
        }
    })
})

$('#clear').click(function () {
    $('.search').val('');
    window.location.replace('/');
})