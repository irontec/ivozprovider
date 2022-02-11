import { FkChoices } from 'lib/entities/DefaultEntityBehavior';
import { useEffect, useState } from 'react';
import ServiceSelectOptions from 'entities/Service/SelectOptions';
import { CompanyServicePropertyList } from './CompanyServiceProperties';
import axios, { CancelToken } from 'axios';

type CompanyServiceForeignKeyGetterType = (cancelToken?: CancelToken, currentServiceId?: number) => Promise<any>

export const foreignKeyGetter: CompanyServiceForeignKeyGetterType = async (
    token,
    currentServiceId
): Promise<any> => {

    const response: CompanyServicePropertyList<unknown> = {};
    const promises: Array<Promise<unknown>> = [];

    promises[promises.length] = ServiceSelectOptions(
        (options: any) => {
            response.service = options;
        },
        currentServiceId,
        token
    );

    await Promise.all(promises);

    return response;
};

const useFkChoices = (currentServiceId?: number): FkChoices => {

    const [fkChoices, setFkChoices] = useState<FkChoices>({});

    useEffect(
        () => {

            let mounted = true;

            const CancelToken = axios.CancelToken;
            const source = CancelToken.source();

            foreignKeyGetter(source.token, currentServiceId).then((options) => {

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
        [currentServiceId]
    );

    return fkChoices;
}

export default useFkChoices;