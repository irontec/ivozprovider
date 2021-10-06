import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';

const ConferenceRoomSelectOptions = (callback: Function) => {

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