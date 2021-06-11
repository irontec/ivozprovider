import defaultEntityBehavior from '../DefaultEntityBehavior';
import { useEffect, useState } from 'react';
import TerminalSelectOptions from 'entities/Terminal/SelectOptions';
import CallAclSelectOptions from 'entities/CallAcl/SelectOptions';
import LocutionSelectOptions from 'entities/Locution/SelectOptions';
import OutgoingDdiRuleSelectOptions from 'entities/OutgoingDdiRule/SelectOptions';
import DdiSelectOptions from 'entities/Ddi/SelectOptions';
import TimezoneSelectOptions from 'entities/Timezone/SelectOptions';
import ExtensionSelectOptions from 'entities/Extension/SelectOptions';
import LanguageSelectOptions from 'entities/Language/SelectOptions';
import TransformationRuleSetSelectOptions from 'entities/TransformationRuleSet/SelectOptions';
import MatchListSelectOptions from 'entities/MatchList/SelectOptions';
import UserSelectOptions from './SelectOptions';

const Form = (props:any) => {

    const DefaultEntityForm = defaultEntityBehavior.Form;

    const [fkChoices, setFkChoices] = useState<any>({});
    const [mounted, setMounted] = useState<boolean>(true);
    const [loadingFks, setLoadingFks] = useState<boolean>(true);

    useEffect(
        () => {

            if (loadingFks) {

                UserSelectOptions((options:any) => {
                    setFkChoices((fkChoices:any) => {
                        return {
                            ...fkChoices,
                            bossAssistant: options
                        }
                    });
                });

                MatchListSelectOptions((options:any) => {
                    setFkChoices((fkChoices:any) => {
                        return {
                            ...fkChoices,
                            bossAssistantWhiteList: options
                        }
                    });
                });

                TransformationRuleSetSelectOptions((options:any) => {
                    setFkChoices((fkChoices:any) => {
                        return {
                            ...fkChoices,
                            transformationRuleSet: options
                        }
                    });
                });

                LanguageSelectOptions((options:any) => {
                    setFkChoices((fkChoices:any) => {
                        return {
                            ...fkChoices,
                            language: options
                        }
                    });
                });

                ExtensionSelectOptions((options:any) => {
                    setFkChoices((fkChoices:any) => {
                        return {
                            ...fkChoices,
                            extension: options
                        }
                    });
                });

                TimezoneSelectOptions((options:any) => {
                    setFkChoices((fkChoices:any) => {
                        return {
                            ...fkChoices,
                            timezone: options
                        }
                    });
                });

                DdiSelectOptions((options:any) => {
                    setFkChoices((fkChoices:any) => {
                        return {
                            ...fkChoices,
                            outgoingDdi: options
                        }
                    });
                });

                OutgoingDdiRuleSelectOptions((options:any) => {
                    setFkChoices((fkChoices:any) => {
                        return {
                            ...fkChoices,
                            outgoingDdiRule: options
                        }
                    });
                });

                LocutionSelectOptions((options:any) => {
                    setFkChoices((fkChoices:any) => {
                        return {
                            ...fkChoices,
                            voicemailLocution: options
                        }
                    });
                });

                TerminalSelectOptions((options:any) => {
                    setFkChoices((fkChoices:any) => {
                        return {
                            ...fkChoices,
                            terminal: options
                        }
                    });
                });

                CallAclSelectOptions((options:any) => {
                    setFkChoices((fkChoices:any) => {
                        return {
                            ...fkChoices,
                            callAcl: options
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