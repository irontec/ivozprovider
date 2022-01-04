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
import { ForeignKeyGetterType } from 'lib/entities/EntityInterface';
import axios, { CancelToken } from 'axios';

export const foreignKeyGetter: ForeignKeyGetterType = async (token?: CancelToken): Promise<any> => {

    const response: CallCsvSchedulerPropertyList<unknown> = {};
    const promises: Array<Promise<unknown>> = [];

    promises[promises.length] = DdiSelectOptions(
        (options: any) => {
            response.ddi = options;
        },
        token
    );

    promises[promises.length] = RetailAccountSelectOptions(
        (options: any) => {
            response.retailAccount = options;
        },
        token
    );

    promises[promises.length] = ResidentialDeviceSelectOptions(
        (options: any) => {
            response.residentialDevice = options;
        },
        token
    );

    promises[promises.length] = UserSelectOptions(
        (options: any) => {
            response.user = options;
        },
        token
    );

    promises[promises.length] = FaxSelectOptions(
        (options: any) => {
            response.fax = options;
        },
        token
    );

    promises[promises.length] = FriendSelectOptions(
        (options: any) => {
            response.friend = options;
        },
        token
    );

    await Promise.all(promises);

    return response;
};

const Form = (props: EntityFormProps): JSX.Element => {

    const DefaultEntityForm = defaultEntityBehavior.Form;
    const [fkChoices, setFkChoices] = useState<any>({});

    useEffect(
        () => {

            let mounted = true;

            const CancelToken = axios.CancelToken;
            const source = CancelToken.source();

            foreignKeyGetter(source.token).then((options) => {

                if (!mounted) {
                    return;
                }

                setFkChoices((fkChoices: any) => {
                    return {
                        ...fkChoices,
                        ...options
                    }
                });
            });


            return () => {
                mounted = false;
                source.cancel();
            }
        },
        []
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