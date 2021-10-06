import defaultEntityBehavior, { FetchFksCallback } from 'lib/entities/DefaultEntityBehavior';

const OutgoingDdiRuleSelectOptions = (callback: FetchFksCallback) => {

    defaultEntityBehavior.fetchFks(
        '/outgoing_ddi_rules',
        ['id', 'name'],
        (data: any) => {

            const options: any = {};
            for (const item of data) {
                options[item.id] = item.name;
            }

            callback(options);
        }
    );
}

export default OutgoingDdiRuleSelectOptions;