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

    // Click on widget create button
    $('.add-plan-matiere-btn').on('click', function () {
        $.ajax({
            url: Routing.generate(
                'laurentSchoolPlanMatiereCreateForm'
            ),
            type: 'GET',
            success: function (datas) {
                openFormModal(
                    "Créer un plan matière",
                    datas
                );
            }
        });
    });

$('.profListButton').on('click', function () {
    $.ajax({
        url: Routing.generate(
            'laurent_plan_matiere_list_prof'
        ),
        type: 'GET',
        success: function (datas) {
            openFormModal(
                "Ajouter Prof",
                datas
            );
        }
    });
});

    // Click on OK button of the Create Widget instance form modal
    $('body').on('click', '#form-create-planmatiere-ok-btn', function (e) {
        e.stopImmediatePropagation();
        e.preventDefault();

        var form = document.getElementById('create-planmatiere-form');
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