import defaultEntityBehavior, { EntityFormProps, FieldsetGroups } from 'lib/entities/DefaultEntityBehavior';
import { useEffect, useState } from 'react';
import CountrySelectOptions from 'entities/Country/SelectOptions';
import LocutionSelectOptions from 'entities/Locution/SelectOptions';
import ExtensionSelectOptions from 'entities/Extension/SelectOptions';
import UserSelectOptions from 'entities/User/SelectOptions';
import _ from 'lib/services/translations/translate';
import { IvrPropertyList } from './IvrProperties';

export const foreignKeyGetter = async (): Promise<any> => {

    const response: IvrPropertyList<Array<string | number>> = {};
    const promises: Array<Promise<unknown>> = [];

    promises[promises.length] = LocutionSelectOptions((options: any) => {
        response.welcomeLocution = options;
        response.noInputLocution = options;
        response.errorLocution = options;
        response.successLocution = options;
    });

    promises[promises.length] = CountrySelectOptions((options: any) => {
        response.noInputNumberCountry = options;
        response.errorNumberCountry = options;
    });

    promises[promises.length] = ExtensionSelectOptions((options: any) => {
        response.noInputExtension = options;
        response.errorExtension = options;
        response.excludedExtensionIds = options;
    });

    promises[promises.length] = UserSelectOptions((options: any) => {
        response.noInputVoiceMailUser = options;
        response.errorVoiceMailUser = options;
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
                'timeout',
                'maxDigits',
                'welcomeLocution',
                'successLocution',
            ]
        },
        {
            legend: _('Extension dialing'),
            fields: [
                'allowExtensions',
                'excludedExtensionIds',
            ]
        },
        {
            legend: _('No input configuration'),
            fields: [
                'noInputLocution',
                'noInputRouteType',
                'noInputNumberCountry',
                'noInputNumberValue',
                'noInputExtension',
                'noInputVoiceMailUser',
            ]
        },
        {
            legend: _('Error configuration'),
            fields: [
                'errorLocution',
                'errorRouteType',
                'errorNumberCountry',
                'errorNumberValue',
                'errorExtension',
                'errorVoiceMailUser',
            ]
        },
    ];

    return (<DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />);
}

export default Form;