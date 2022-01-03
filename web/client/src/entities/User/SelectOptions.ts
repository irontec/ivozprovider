import defaultEntityBehavior, { FetchFksCallback } from 'lib/entities/DefaultEntityBehavior';
import User from './User';

const UserSelectOptions = (callback: FetchFksCallback): Promise<unknown> => {

    return defaultEntityBehavior.fetchFks(
        User.path,
        ['id', 'name', 'lastname'],
        (data: any) => {
            const options: any = {};
            for (const item of data) {
                options[item.id] = `${item.name} ${item.lastname}`;
            }

            callback(options);
        }
    );
}

export default UserSelectOptions;