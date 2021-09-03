import defaultEntityBehavior, { FieldsetGroups } from '../DefaultEntityBehavior';
import { useEffect, useState } from 'react';
import ServiceSelectOptions from 'entities/Service/SelectOptions';

const Form = (props: any) => {

    const DefaultEntityForm = defaultEntityBehavior.Form;

    const [fkChoices, setFkChoices] = useState<any>({});
    const [, setMounted] = useState<boolean>(true);
    const [loadingFks, setLoadingFks] = useState<boolean>(true);

    useEffect(
        () => {

            if (loadingFks) {

                ServiceSelectOptions((options: any) => {
                    setFkChoices((fkChoices: any) => {
                        return {
                            ...fkChoices,
                            service: options
                        }
                    });
                });

                setLoadingFks(false);
            }

            return function umount() {
                setMounted(false);
            };
        },
        [loadingFks, fkChoices]
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

    const properties = props.properties;
    if (props.edit) {
        properties.service = {
            ...properties.service,
            readOnly: true,
        }
    }

    return (<DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} properties={properties} />);
}

export default Form;