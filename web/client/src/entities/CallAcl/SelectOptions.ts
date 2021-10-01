import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';

const CallAclSelectOptions = (callback: Function) => {

    defaultEntityBehavior.fetchFks(
        '/call_acls',
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

export default CallAclSelectOptions;