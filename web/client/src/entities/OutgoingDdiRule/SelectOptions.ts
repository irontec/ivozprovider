import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';

const OutgoingDdiRuleSelectOptions = (callback: Function) => {

    defaultEntityBehavior.fetchFks(
        '/outgoing_ddi_rules',
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

export default OutgoingDdiRuleSelectOptions;