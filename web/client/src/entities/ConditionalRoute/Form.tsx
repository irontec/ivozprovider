import defaultEntityBehavior, { FieldsetGroups } from 'lib/entities/DefaultEntityBehavior';
import { useEffect, useState } from 'react';
import LocutionSelectOptions from 'entities/Locution/SelectOptions';
import IvrSelectOptions from 'entities/Ivr/SelectOptions';
import HuntGroupSelectOptions from 'entities/HuntGroup/SelectOptions';
import UserSelectOptions from 'entities/User/SelectOptions';
import CountrySelectOptions from 'entities/Country/SelectOptions';
import QueueSelectOptions from 'entities/Queue/SelectOptions';
import ConferenceRoomSelectOptions from 'entities/ConferenceRoom/SelectOptions';
import ExtensionSelectOptions from 'entities/Extension/SelectOptions';
import _ from 'lib/services/translations/translate';

const Form = (props: any) => {

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
                            locution: options
                        }
                    });
                });

                IvrSelectOptions((options: any) => {
                    mounted && setFkChoices((fkChoices: any) => {
                        return {
                            ...fkChoices,
                            ivr: options
                        }
                    });
                });

                HuntGroupSelectOptions((options: any) => {
                    mounted && setFkChoices((fkChoices: any) => {
                        return {
                            ...fkChoices,
                            huntGroup: options
                        }
                    });
                });

                UserSelectOptions((options: any) => {
                    mounted && setFkChoices((fkChoices: any) => {
                        return {
                            ...fkChoices,
                            voicemailUser: options,
                            user: options,
                        }
                    });
                });

                CountrySelectOptions((options: any) => {
                    mounted && setFkChoices((fkChoices: any) => {
                        return {
                            ...fkChoices,
                            numberCountry: options,
                        }
                    });
                });

                QueueSelectOptions((options: any) => {
                    mounted && setFkChoices((fkChoices: any) => {
                        return {
                            ...fkChoices,
                            queue: options,
                        }
                    });
                });

                ConferenceRoomSelectOptions((options: any) => {
                    mounted && setFkChoices((fkChoices: any) => {
                        return {
                            ...fkChoices,
                            conferenceRoom: options,
                        }
                    });
                });

                ExtensionSelectOptions((options: any) => {
                    mounted && setFkChoices((fkChoices: any) => {
                        return {
                            ...fkChoices,
                            extension: options,
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
            legend: _('Basic Configuration'),
            fields: [
                'name',
            ]
        },
        {
            legend: _('No matching condition handler'),
            fields: [
                'locution',
                'routetype',
                'ivr',
                'huntGroup',
                'voicemailUser',
                'user',
                'numberCountry',
                'numbervalue',
                'friendvalue',
                'queue',
                'conferenceRoom',
                'extension',
            ]
        },
    ];

    return (<DefaultEntityForm fkChoices={fkChoices} groups={groups} {...props} />);
}

export default Form;