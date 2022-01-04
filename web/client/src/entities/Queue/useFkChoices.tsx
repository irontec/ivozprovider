import { FkChoices } from 'lib/entities/DefaultEntityBehavior';
import { useEffect, useState } from 'react';
import LocutionSelectOptions from 'entities/Locution/SelectOptions';
import CountrySelectOptions from 'entities/Country/SelectOptions';
import ExtensionSelectOptions from 'entities/Extension/SelectOptions';
import UserSelectOptions from 'entities/User/SelectOptions';
import { QueuePropertyList } from './QueueProperties';
import axios, { CancelToken } from 'axios';
import { ForeignKeyGetterType } from 'lib/entities/EntityInterface';

export const foreignKeyGetter: ForeignKeyGetterType = async (token?: CancelToken): Promise<any> => {

    const response: QueuePropertyList<Array<string | number>> = {};
    const promises: Array<Promise<unknown>> = [];

    promises[promises.length] = LocutionSelectOptions(
        (options: any) => {
            response.timeoutLocution = options;
            response.fullLocution = options;
            response.periodicAnnounceLocution = options;
        },
        token
    );

    promises[promises.length] = CountrySelectOptions(
        (options: any) => {
            response.timeoutNumberCountry = options;
            response.fullNumberCountry = options;
        },
        token
    );

    promises[promises.length] = ExtensionSelectOptions(
        (options: any) => {
            response.timeoutExtension = options;
            response.fullExtension = options;
        },
        token
    );

    promises[promises.length] = UserSelectOptions(
        (options: any) => {
            response.timeoutVoiceMailUser = options;
            response.fullVoiceMailUser = options;
        },
        token
    );

    await Promise.all(promises);

    return response;
};

const useFkChoices = (): FkChoices => {

    const [fkChoices, setFkChoices] = useState<FkChoices>({});

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

    return fkChoices;
}

export default useFkChoices;