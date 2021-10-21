import defaultEntityBehavior, { FetchFksCallback } from 'lib/entities/DefaultEntityBehavior';

const ConferenceRoomSelectOptions = (callback: FetchFksCallback): void => {

    defaultEntityBehavior.fetchFks(
        '/conference_rooms',
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

export default ConferenceRoomSelectOptions;