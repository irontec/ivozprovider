import defaultEntityBehavior from '../DefaultEntityBehavior';

const MatchListSelectOptions = (callback: Function) => {

    defaultEntityBehavior.fetchFks(
        '/match_lists',
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

export default MatchListSelectOptions;