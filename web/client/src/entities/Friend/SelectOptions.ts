import defaultEntityBehavior, { FetchFksCallback } from 'lib/entities/DefaultEntityBehavior';

const FriendSelectOptions = (callback: FetchFksCallback) => {

    defaultEntityBehavior.fetchFks(
        '/friends',
        ['id', 'name'],
        (data:any) => {
            const options:any = {};
            for (const item of data) {
                options[item.id] = item.name;
            }

            callback(options);
        }
    );
}

export default FriendSelectOptions;