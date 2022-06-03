$(function () {
    $('#modal-delete').on('hide.bs.modal', function () {
        $('#delete-form').attr('action', '');
    });

    $('#modal-permissions').on('hide.bs.modal', function () {
        $('#permissions-form').attr('action', '');
    });

    $('.year').on('keyup keydown', function (el) {
        let value = $(this).val();

        if ((el.key.match(/[\D]/) && el.key !== 'Backspace') || (value.length > 3 && el.key !== 'Backspace')) {
            return false;
        }
    });
    $('.select2').select2({
        theme: 'bootstrap4',
    });
});

const filter = (e, column) => {

    const url = `${$('meta[name=filter]').attr('content')}`;

    if (!column) {
        return location.href = url;
    }
    const text = $('#search-input').val();

    location.href = `${url}?filter[${column}]=${text}`;

}

const sort = () => {
    const column = $('#sort-columns').val();
    const direction = $('#sort-directions').val();
    let returnSort = config.prepareForSorts(column, direction);
    const url = `${$('meta[name=sort]').attr('content')}`;
    location.href = `${url}?${returnSort}`;
}

const generatePassword = (selector, len = 8) => {
    let password = "";
    const symbols = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789%?";
    for (let i = 0; i < len; i++) {
        password += symbols.charAt(Math.floor(Math.random() * symbols.length));
    }
    $(selector).val(password);
}

const setFormAction = function (id) {
    const url = $('#modal-delete').attr('data-url').replace('ID', id);
    $('#delete-form').attr('action', url);
}

const toggleInput = (e) => {
    const block = $(e).parents('.form-group');
    const select = block.children('select');
    const input = block.children('input');
    const isChecked = $(e).prop('checked');
    const id = isChecked ? select.attr('id') : input.attr('id');
    const name = isChecked ? select.attr('name') : input.attr('name');

    select.find('option').removeAttr('selected').first().attr('selected', 'selected');
    input.val('');

    if (isChecked) {
        select.removeAttr('id').removeAttr('name').removeAttr('required').attr('hidden', 'hidden');
        input.removeAttr('hidden').attr('id', id).attr('name', name).attr('required', 'required');
    } else {
        input.removeAttr('id').removeAttr('name').removeAttr('required').attr('hidden', 'hidden');
        select.removeAttr('hidden').attr('id', id).attr('name', name).attr('required', 'required');
    }
}

const removeFile = function (el) {
    const $this = $(el);
    $this.parents('form').find('#file-block').removeClass('d-none');
    $this.parents('.form-group').remove();
}

const setRolesFormAction = function (id) {
    const modal = $('#modal-permissions');
    $.ajax({
        url: `${location.origin}/users/role/${id}`, type: 'get', success({permissions, user}) {
            let checkboxes = config.users.permissions(permissions, user);
            const url = modal.attr('data-url').replace('ID', id);
            $('#permissions-form').attr('action', url);
            modal.find('form').children('.form-body').html(checkboxes);
            modal.modal('show');
        }
    })
}
