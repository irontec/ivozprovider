import defaultEntityBehavior, { EntityFormProps, FieldsetGroups } from 'lib/entities/DefaultEntityBehavior';
import { useEffect, useState } from 'react';
import LocutionSelectOptions from 'entities/Locution/SelectOptions';
import CountrySelectOptions from 'entities/Country/SelectOptions';
import ExtensionSelectOptions from 'entities/Extension/SelectOptions';
import UserSelectOptions from 'entities/User/SelectOptions';
import _ from 'lib/services/translations/translate';
import { QueuePropertyList } from './QueueProperties';


export const foreignKeyGetter = async (): Promise<any> => {

    const response: QueuePropertyList<Array<string | number>> = {};
    const promises: Array<Promise<unknown>> = [];

    promises[promises.length] = LocutionSelectOptions((options: any) => {
        response.timeoutLocution = options;
        response.fullLocution = options;
        response.periodicAnnounceLocution = options;
    });

    promises[promises.length] = CountrySelectOptions((options: any) => {
        response.timeoutNumberCountry = options;
        response.fullNumberCountry = options;
    });

    promises[promises.length] = ExtensionSelectOptions((options: any) => {
        response.timeoutExtension = options;
        response.fullExtension = options;
    });

    promises[promises.length] = UserSelectOptions((options: any) => {
        response.timeoutVoiceMailUser = options;
        response.fullVoiceMailUser = options;
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
                'weight',
                'strategy',
            ]
        },
        {
            legend: _('Announce'),
            fields: [
                'periodicAnnounceLocution',
                'periodicAnnounceFrequency',
            ]
        },
        {
            legend: _('Members configuration'),
            fields: [
                'memberCallTimeout',
                'memberCallRest',
                'preventMissedCalls',
            ]
        },
        {
            legend: _('Timeout configuration'),
            fields: [
                'maxWaitTime',
                'timeoutLocution',
                'timeoutTargetType',
                'timeoutExtension',
                'timeoutVoiceMailUser',
                'timeoutNumberCountry',
                'timeoutNumberValue',
            ]
        },
        {
            legend: _('Full Queue configuration'),
            fields: [
                'maxlen',
                'fullLocution',
                'fullTargetType',
                'fullExtension',
                'fullVoiceMailUser',
                'fullNumberCountry',
                'fullNumberValue',
            ]
        },
    ];

    return (<DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />);
}

export default Form;