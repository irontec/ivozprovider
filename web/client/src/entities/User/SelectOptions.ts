import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';

const UserSelectOptions = (callback: Function) => {

    defaultEntityBehavior.fetchFks(
        '/users',
        ['id', 'name', 'lastname'],
        (data:any) => {
            const options:any = {};
            for (const item of data) {
                options[item.id] = `${item.name} ${item.lastname}`;
            }

            callback(options);
        }
    );
}

export default UserSelectOptions;