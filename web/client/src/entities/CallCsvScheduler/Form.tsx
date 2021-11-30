import defaultEntityBehavior, { EntityFormProps, FieldsetGroups } from 'lib/entities/DefaultEntityBehavior';
import { useEffect, useState } from 'react';
import DdiSelectOptions from 'entities/Ddi/SelectOptions';
import RetailAccountSelectOptions from 'entities/RetailAccount/SelectOptions';
import ResidentialDeviceSelectOptions from 'entities/ResidentialDevice/SelectOptions';
import UserSelectOptions from 'entities/User/SelectOptions';
import FaxSelectOptions from 'entities/Fax/SelectOptions';
import FriendSelectOptions from 'entities/Friend/SelectOptions';
import _ from 'lib/services/translations/translate';
import { CallCsvSchedulerPropertyList } from './CallCsvSchedulerProperties';

export const foreignKeyGetter = async (): Promise<any> => {

    const response: CallCsvSchedulerPropertyList<unknown> = {};
    const promises: Array<Promise<unknown>> = [];

    promises[promises.length] = DdiSelectOptions((options: any) => {
        response.ddi = options;
    });

    promises[promises.length] = RetailAccountSelectOptions((options: any) => {
        response.retailAccount = options;
    });

    promises[promises.length] = ResidentialDeviceSelectOptions((options: any) => {
        response.residentialDevice = options;
    });

    promises[promises.length] = UserSelectOptions((options: any) => {
        response.user = options;
    });

    promises[promises.length] = FaxSelectOptions((options: any) => {
        response.fax = options;
    });

    promises[promises.length] = FriendSelectOptions((options: any) => {
        response.friend = options;
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
            legend: _('Basic Information'),
            fields: [
                'name',
                'email',
            ]
        },
        {
            legend: _('Time Information'),
            fields: [
                'frequency',
                'unit',
                'nextExecution',
                'lastExecution',
            ]
        },
        {
            legend: _('Filters'),
            fields: [
                'callDirection',
                'ddi',
                'retailAccount',
                'residentialDevice',
                'endpointType',
                'user',
                'fax',
                'friend',
            ]
        },
    ];

    return (<DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />);
}

export default Form;