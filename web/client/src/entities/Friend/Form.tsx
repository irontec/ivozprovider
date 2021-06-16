import defaultEntityBehavior from '../DefaultEntityBehavior';
import { useEffect, useState } from 'react';
import LocutionSelectOptions from 'entities/Locution/SelectOptions';
import CallAclSelectOptions from 'entities/CallAcl/SelectOptions';
import TransformationRuleSetSelectOptions from 'entities/TransformationRuleSet/SelectOptions';
import DdiSelectOptions from 'entities/Ddi/SelectOptions';
import LanguageSelectOptions from 'entities/Language/SelectOptions';
const Form = (props:any) => {

    const DefaultEntityForm = defaultEntityBehavior.Form;

    const [fkChoices, setFkChoices] = useState<any>({});
    const [, setMounted] = useState<boolean>(true);
    const [loadingFks, setLoadingFks] = useState<boolean>(true);

    useEffect(
        () => {
            if (loadingFks) {

                //@TODO domain
                //@TODO interCompany

                CallAclSelectOptions((options:any) => {
                    setFkChoices((fkChoices:any) => {
                        return {
                            ...fkChoices,
                            callACL: options,
                        }
                    });
                });

                TransformationRuleSetSelectOptions((options:any) => {
                    setFkChoices((fkChoices:any) => {
                        return {
                            ...fkChoices,
                            transformationRuleSet: options,
                        }
                    });
                });

                DdiSelectOptions((options:any) => {
                    setFkChoices((fkChoices:any) => {
                        return {
                            ...fkChoices,
                            outgoingDdi: options,
                        }
                    });
                });

                LanguageSelectOptions((options:any) => {
                    setFkChoices((fkChoices:any) => {
                        return {
                            ...fkChoices,
                            language: options,
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