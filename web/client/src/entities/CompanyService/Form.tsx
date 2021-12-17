import defaultEntityBehavior, { EntityFormProps, FieldsetGroups } from 'lib/entities/DefaultEntityBehavior';
import { useEffect, useState } from 'react';
import ServiceSelectOptions from 'entities/Service/SelectOptions';
import { CompanyServicePropertyList } from './CompanyServiceProperties';

export const foreignKeyGetter = async (): Promise<any> => {

    const response: CompanyServicePropertyList<unknown> = {};
    const promises: Array<Promise<unknown>> = [];

    promises[promises.length] = ServiceSelectOptions((options: any) => {
        response.service = options;
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
            legend: '',
            fields: [
                'service',
                'code',
            ]
        }
    ];

    const readOnlyProperties = {
        service: props.edit ? true : false,
    };

    return (<DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} readOnlyProperties={readOnlyProperties} />);
}

export default Form;