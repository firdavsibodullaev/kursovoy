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
        }
    },
    prepareForSorts(column, direction) {
        let sort = direction === 'asc' ? column : `-${column}`;
        return column ? `sort=${sort}` : '';
    },
    prof: {
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
