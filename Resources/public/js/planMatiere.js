function openFormModal(title, content)
{
    $('#form-modal-title').html(title);
    $('#form-modal-body').html(content);
    $('#form-modal-box').modal('show');
}

function closeFormModal()
{
    $('#form-modal-box').modal('hide');
    $('#form-modal-title').empty();
    $('#form-modal-body').empty();
}

    // Click on  create button
    $('.add-plan-matiere-chap-btn').on('click', function () {
        var plId = $('.panel-heading').data('pl-id');
        $.ajax({
            url: Routing.generate(
                'laurentSchoolPlanMatiereChapCreate',
                {'planMatiere': plId}
            ),
            type: 'POST',
            success: function (datas) {
                openFormModal(
                    "Ajouter un chapitre",
                    datas
                );
            }
        });
    });

    // Click on OK button of the Create Widget instance form modal
    $('body').on('click', '#form-create-chap-ok-btn', function (e) {
        e.stopImmediatePropagation();
        e.preventDefault();

        var form = document.getElementById('create-chap-form');
        var action = form.getAttribute('action');
        var formData = new FormData(form);

        $.ajax({
            url: action,
            data: formData,
            type: 'POST',
            processData: false,
            contentType: false,
            success: function(datas, textStatus, jqXHR) {
                switch (jqXHR.status) {
                    case 201:
                        closeFormModal();
                        window.location.reload();
                        break;
                    default:
                        $('#form-modal-body').html(jqXHR.responseText);
                }
            }
        });
    });

// Click on point matiere create button
$('.add-point-matiere-btn').on('click', function () {
    var chap = $(this).data('chap-id');
    $.ajax({
        url: Routing.generate(
            'laurentSchoolPlanMatierePMCreate',
            {'chap': chap}
        ),
        type: 'POST',
        success: function (datas) {
            openFormModal(
                "Ajouter un point matière",
                datas
            );
        }
    });
});

// Click on OK button of the Create point matiere instance form modal
$('body').on('click', '#form-create-pm-ok-btn', function (e) {
    e.stopImmediatePropagation();
    e.preventDefault();

    var form = document.getElementById('create-pm-form');
    var action = form.getAttribute('action');
    var formData = new FormData(form);

    $.ajax({
        url: action,
        data: formData,
        type: 'POST',
        processData: false,
        contentType: false,
        success: function(datas, textStatus, jqXHR) {
            switch (jqXHR.status) {
                case 201:
                    closeFormModal();
                    window.location.reload();
                    break;
                default:
                    $('#form-modal-body').html(jqXHR.responseText);
            }
        }
    });
});