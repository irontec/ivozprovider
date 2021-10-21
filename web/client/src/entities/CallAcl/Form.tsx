import defaultEntityBehavior, { EntityFormProps, FieldsetGroups } from 'lib/entities/DefaultEntityBehavior';
import { useEffect, useState } from 'react';
import _ from 'lib/services/translations/translate';

const Form = (props: EntityFormProps): JSX.Element => {

    const DefaultEntityForm = defaultEntityBehavior.Form;

    const [fkChoices/*, setFkChoices*/] = useState<any>({});
    const [mounted, setMounted] = useState<boolean>(true);
    const [loadingFks, setLoadingFks] = useState<boolean>(true);

    useEffect(
        () => {
            if (mounted && loadingFks) {
                /*LocutionSelectOptions((options:any) => {
                    mounted && setFkChoices((fkChoices:any) => {
                        return {
                            ...fkChoices,
                            timeoutLocution: options,
                            fullLocution: options,
                            periodicAnnounceLocution: options,
                        }
                    });
                });*/

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
            legend: _('ACL data'),
            fields: [
                'name',
                'defaultPolicy',
            ]
        },
    ];

    return (<DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />);
}

export default Form;