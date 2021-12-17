import defaultEntityBehavior, { EntityFormProps, FieldsetGroups } from 'lib/entities/DefaultEntityBehavior';
import { useEffect, useState } from 'react';
import DdiSelectOptions from 'entities/Ddi/SelectOptions';
import _ from 'lib/services/translations/translate';
import { FaxPropertyList } from './FaxProperties';

export const foreignKeyGetter = async (): Promise<any> => {

    const response: FaxPropertyList<Array<string | number>> = {};
    const promises: Array<Promise<unknown>> = [];

    promises[promises.length] = DdiSelectOptions((options: any) => {
        response.outgoingDdi = options;
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
            legend: _('Outbound configuration'),
            fields: [
                'name',
                'outgoingDdi',
            ]
        },
        {
            legend: _('Inbound configuration'),
            fields: [
                'sendByEmail',
                'email',
            ]
        },
    ];

    return (<DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />);
}

export default Form;