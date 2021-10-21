import defaultEntityBehavior, { EntityFormProps, FieldsetGroups } from 'lib/entities/DefaultEntityBehavior';
import { useEffect, useState } from 'react';
import CountrySelectOptions from 'entities/Country/SelectOptions';
import LocutionSelectOptions from 'entities/Locution/SelectOptions';
import ExtensionSelectOptions from 'entities/Extension/SelectOptions';
import UserSelectOptions from 'entities/User/SelectOptions';
import _ from 'lib/services/translations/translate';

const Form = (props: EntityFormProps): JSX.Element => {

    const DefaultEntityForm = defaultEntityBehavior.Form;

    const [fkChoices, setFkChoices] = useState<any>({});
    const [mounted, setMounted] = useState<boolean>(true);
    const [loadingFks, setLoadingFks] = useState<boolean>(true);

    useEffect(
        () => {

            if (mounted && loadingFks) {

                LocutionSelectOptions((options: any) => {
                    mounted && setFkChoices((fkChoices: any) => {
                        return {
                            ...fkChoices,
                            welcomeLocution: options,
                            noInputLocution: options,
                            errorLocution: options,
                            successLocution: options,
                        }
                    });
                });

                CountrySelectOptions((options: any) => {
                    mounted && setFkChoices((fkChoices: any) => {
                        return {
                            ...fkChoices,
                            noInputNumberCountry: options,
                            errorNumberCountry: options,
                        }
                    });
                });

                ExtensionSelectOptions((options: any) => {
                    mounted && setFkChoices((fkChoices: any) => {
                        return {
                            ...fkChoices,
                            noInputExtension: options,
                            errorExtension: options,
                            excludedExtensionIds: options,
                        }
                    });
                });

                UserSelectOptions((options: any) => {
                    mounted && setFkChoices((fkChoices: any) => {
                        return {
                            ...fkChoices,
                            noInputVoiceMailUser: options,
                            errorVoiceMailUser: options,
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