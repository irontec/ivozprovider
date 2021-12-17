import defaultEntityBehavior, { EntityFormProps, FieldsetGroups } from 'lib/entities/DefaultEntityBehavior';
import { useEffect, useState } from 'react';
import DdiSelectOptions from 'entities/Ddi/SelectOptions';
import _ from 'lib/services/translations/translate';
import { OutgoingDdiRulePropertyList } from './OutgoingDdiRuleProperties';

export const foreignKeyGetter = async (): Promise<any> => {

    const response: OutgoingDdiRulePropertyList<Array<string | number>> = {};
    const promises: Array<Promise<unknown>> = [];

    promises[promises.length] = DdiSelectOptions((options: any) => {
        response.forcedDdi = options;
    });

    await Promise.all(promises);

    return response;
};

const Form = (props: EntityFormProps): JSX.Element => {

    const DefaultEntityForm = defaultEntityBehavior.Form;

    const [fkChoices, setFkChoices] = useState<any>({});
    const [mounted, setMounted] = useState<boolean>(true);
    const [loadingFks, setLoadingFks] = useState<boolean>(true);

    useEffect(
        () => {

            if (mounted && loadingFks) {

                foreignKeyGetter().then((options) => {
                    mounted && setFkChoices((fkChoices: any) => {
                        return {
                            ...fkChoices,
                            ...options
                        }
                    });
                });

                setLoadingFks(false);
            }

            return function umount() {
                setMounted(false);
            };
        },
        [mounted, loadingFks, fkChoices]
    );

    const groups: Array<FieldsetGroups> = [
        {
            legend: _('Basic Configuration'),
            fields: [
                'name',
            ]
        },
        {
            legend: _('Action Configuration'),
            fields: [
                'defaultAction',
                'forcedDdi',
            ]
        },
    ];

    return (<DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />);
}

export default Form;