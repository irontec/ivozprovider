import defaultEntityBehavior, { EntityFormProps, FieldsetGroups } from 'lib/entities/DefaultEntityBehavior';
import { useEffect, useState } from 'react';
import LocutionSelectOptions from 'entities/Locution/SelectOptions';
import CountrySelectOptions from 'entities/Country/SelectOptions';
import ExtensionSelectOptions from 'entities/Extension/SelectOptions';
import UserSelectOptions from 'entities/User/SelectOptions';
import _ from 'lib/services/translations/translate';
import MatchListSelectOptions from 'entities/MatchList/SelectOptions';
import ScheduleSelectOptions from 'entities/Schedule/SelectOptions';
import CalendarSelectOptions from 'entities/Calendar/SelectOptions';

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
                            holidayLocution: options,
                            outOfScheduleLocution: options,
                        }
                    });
                });

                CountrySelectOptions((options: any) => {
                    mounted && setFkChoices((fkChoices: any) => {
                        return {
                            ...fkChoices,
                            holidayNumberCountry: options,
                            outOfScheduleNumberCountry: options,
                        }
                    });
                });

                ExtensionSelectOptions((options: any) => {
                    mounted && setFkChoices((fkChoices: any) => {
                        return {
                            ...fkChoices,
                            holidayExtension: options,
                            outOfScheduleExtension: options,
                        }
                    });
                });

                UserSelectOptions((options: any) => {
                    mounted && setFkChoices((fkChoices: any) => {
                        return {
                            ...fkChoices,
                            holidayVoiceMailUser: options,
                            outOfScheduleVoiceMailUser: options,
                        }
                    });
                });

                MatchListSelectOptions((options: any) => {
                    mounted && setFkChoices((fkChoices: any) => {
                        return {
                            ...fkChoices,
                            whiteListIds: options,
                            blackListIds: options,
                        }
                    });
                });

                ScheduleSelectOptions((options: any) => {
                    mounted && setFkChoices((fkChoices: any) => {
                        return {
                            ...fkChoices,
                            scheduleIds: options,
                        }
                    });
                });

                CalendarSelectOptions((options: any) => {
                    mounted && setFkChoices((fkChoices: any) => {
                        return {
                            ...fkChoices,
                            calendarIds: options,
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
            legend: _('Basic Info'),
            fields: [
                'name',
                'welcomeLocution',
            ]
        },
        {
            legend: _('Filtering info'),
            fields: [
                'whiteListIds',
                'blackListIds',
            ]
        },
        {
            legend: _('Holidays configuration'),
            fields: [
                'calendarIds',
                'holidayLocution',
                'holidayTargetType',
                'holidayNumberCountry',
                'holidayNumberValue',
                'holidayExtension',
                'holidayVoiceMailUser',
            ]
        },
        {
            legend: _('Out of schedule configuration'),
            fields: [
                'scheduleIds',
                'outOfScheduleLocution',
                'outOfScheduleTargetType',
                'outOfScheduleNumberCountry',
                'outOfScheduleNumberValue',
                'outOfScheduleExtension',
                'outOfScheduleVoiceMailUser',
            ]
        },
    ];

    return (<DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />);
}

export default Form;