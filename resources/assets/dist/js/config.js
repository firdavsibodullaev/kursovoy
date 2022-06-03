const config = {
    users: {
        tableList(users) {
            let users_l = '';

            for (let i = 0; i < users.length; i++) {
                users_l += this.tableRow(users[i]);
            }

            return users_l;
        }, tableRow(user) {
            return `
                <tr>
                    <td>${user.id}</td>
                    <td>${user.full_name_string}</td>
                    <td></td>
                    <td>${user.phone ? user.phone : ''}</td>
                </tr>`;
        }, permissions(permissions, user) {
            let checkboxes = '';
            for (let permission of permissions) {
                let exists = user.permissions.filter((item) => item.name === permission.name).length !== 0;
                let permissionsByRole = user.post.permissions.filter((item) => item.name === permission.name);
                permissionsByRole = permissionsByRole.length !== 0 ? permissionsByRole[0].key : '';
                checkboxes += `
                        <div class="form-group clearfix"><div class="icheck-primary d-inline"><input type="checkbox" name="permissions[]" value="${permission.key}" ${permissionsByRole === permission.key ? 'disabled' : ''} id="permission-${permission.id}" ${(exists ? 'checked' : '')}><label for="permission-${permission.id}">${permission.name}</label></div></div>`;
            }
            return checkboxes;
        }
    }, prepareForSorts(column, direction) {
        let sort = direction === 'asc' ? column : `-${column}`;
        return column ? `sort=${sort}` : '';
    }, prof: {
        departmentOptions(departments) {
            let departmentsList = "";
            const locale = $('[lang]').attr('lang');
            for (let department of departments) {
                departmentsList += `<option value="${department.id}">${department.full_name[locale]}</option>`;
            }

            return departmentsList;
        }
    }
}
