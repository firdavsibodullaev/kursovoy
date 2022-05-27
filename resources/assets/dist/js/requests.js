const requests = {
    prof: {
        getDepartments(el) {
            const id = $(el).val();
            $('#department_id').html(`<option value="">Выберите кафедру</option>`);
            if (!id) {
                return;
            }

            $.ajax({
                url: `${location.origin}/api/v1/faculty/${id}`,
                type: 'get',
                success({data}) {
                    const html = config.prof.departmentOptions(data.departments)
                    $('#department_id').append(html);
                }
            });
        }
    }
};
