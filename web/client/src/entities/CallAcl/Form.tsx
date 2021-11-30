import defaultEntityBehavior, { EntityFormProps, FieldsetGroups } from 'lib/entities/DefaultEntityBehavior';
import { useEffect, useState } from 'react';
import _ from 'lib/services/translations/translate';
import { CallAclPropertyList } from './CallAclProperties';

export const foreignKeyGetter = async (): Promise<any> => {

    const response: CallAclPropertyList<unknown> = {};
    // const promises: Array<Promise<unknown>> = [];

    // promises[promises.length] = LocutionSelectOptions((options: any) => {
    //     response.timeoutLocution: options;
    //     response.fullLocution: options;
    //     response.periodicAnnounceLocution: options;
    // });

    // await Promise.all(promises);

    return response;
};

const Form = (props: EntityFormProps): JSX.Element => {

    const DefaultEntityForm = defaultEntityBehavior.Form;

    const [fkChoices/*, setFkChoices*/] = useState<any>({});
    const [mounted, setMounted] = useState<boolean>(true);
    const [loadingFks, setLoadingFks] = useState<boolean>(true);

    useEffect(
        () => {

            if (mounted && loadingFks) {

                // foreignKeyGetter().then((options) => {
                //     mounted && setFkChoices((fkChoices: any) => {
                //         return {
                //             ...fkChoices,
                //             ...options
                //         }
                //     });
                // });

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