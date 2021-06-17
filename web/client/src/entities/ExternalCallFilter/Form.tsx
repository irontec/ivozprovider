import defaultEntityBehavior from '../DefaultEntityBehavior';
import { useEffect, useState } from 'react';
import LocutionSelectOptions from 'entities/Locution/SelectOptions';
import CountrySelectOptions from 'entities/Country/SelectOptions';
import ExtensionSelectOptions from 'entities/Extension/SelectOptions';
import UserSelectOptions from 'entities/User/SelectOptions';
const Form = (props:any) => {

    const DefaultEntityForm = defaultEntityBehavior.Form;

    const [fkChoices, setFkChoices] = useState<any>({});
    const [, setMounted] = useState<boolean>(true);
    const [loadingFks, setLoadingFks] = useState<boolean>(true);

    useEffect(
        () => {
            if (loadingFks) {

                //@TODO schedules
                //@TODO calendars
                //@TODO whiteLists
                //@TODO blackLists

                LocutionSelectOptions((options:any) => {
                    setFkChoices((fkChoices:any) => {
                        return {
                            ...fkChoices,
                            welcomeLocution: options,
                            holidayLocution: options,
                            outOfScheduleLocution: options,
                        }
                    });
                });

                CountrySelectOptions((options:any) => {
                    setFkChoices((fkChoices:any) => {
                        return {
                            ...fkChoices,
                            holidayNumberCountry: options,
                            outOfScheduleNumberCountry: options,
                        }
                    });
                });

                ExtensionSelectOptions((options:any) => {
                    setFkChoices((fkChoices:any) => {
                        return {
                            ...fkChoices,
                            holidayExtension: options,
                            outOfScheduleExtension: options,
                        }
                    });
                });

                UserSelectOptions((options:any) => {
                    setFkChoices((fkChoices:any) => {
                        return {
                            ...fkChoices,
                            holidayVoiceMailUser: options,
                            outOfScheduleVoiceMailUser: options,
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

    return (<DefaultEntityForm fkChoices={fkChoices} {...props}  />);
}

export default Form;