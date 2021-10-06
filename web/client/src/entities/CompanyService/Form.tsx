import defaultEntityBehavior, { FieldsetGroups } from 'lib/entities/DefaultEntityBehavior';
import { useEffect, useState } from 'react';
import ServiceSelectOptions from 'entities/Service/SelectOptions';

const Form = (props: any) => {

    const DefaultEntityForm = defaultEntityBehavior.Form;

    const [fkChoices, setFkChoices] = useState<any>({});
    const [mounted, setMounted] = useState<boolean>(true);
    const [loadingFks, setLoadingFks] = useState<boolean>(true);

    useEffect(
        () => {

            if (mounted && loadingFks) {

                ServiceSelectOptions(
                    (options: any) => {
                        setFkChoices((fkChoices: any) => {
                            return {
                                ...fkChoices,
                                service: options
                            }
                        });
                    },
                    props.formik.initialValues?.service
                );

                setLoadingFks(false);
            }

            return function umount() {
                setMounted(false);
            };
        },
        [loadingFks, fkChoices, props.formik.initialValues?.service]
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