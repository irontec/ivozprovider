import { FkChoices } from 'lib/entities/DefaultEntityBehavior';
import { useEffect, useState } from 'react';
import UnassignedServiceSelectOptions from 'entities/Service/UnassignedServiceSelectOptions';
import { CompanyServicePropertyList } from './CompanyServiceProperties';
import axios from 'axios';
import { ForeignKeyGetterTypeArgs } from 'lib/entities/EntityInterface';
import EntityService from 'lib/services/entity/EntityService';

type CompanyServiceForeignKeyGetterType = (props: ForeignKeyGetterTypeArgs, currentServiceId?: number) => Promise<any>

export const foreignKeyGetter: CompanyServiceForeignKeyGetterType = async (
    {cancelToken},
    currentServiceId
): Promise<any> => {

    const response: CompanyServicePropertyList<unknown> = {};
    const promises: Array<Promise<unknown>> = [];

    promises[promises.length] = UnassignedServiceSelectOptions(
        {
            callback: (options: any) => {
                response.service = options;
            },
            cancelToken
        },
        {
            includeId: currentServiceId,
        }
    );

    await Promise.all(promises);

    return response;
};

const useFkChoices = (entityService: EntityService, currentServiceId?: number): FkChoices => {

    const [fkChoices, setFkChoices] = useState<FkChoices>({});

    useEffect(
        () => {

            let mounted = true;

            const CancelToken = axios.CancelToken;
            const source = CancelToken.source();

            foreignKeyGetter({cancelToken: source.token, entityService}, currentServiceId).then((options) => {

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
        [currentServiceId, entityService]
    );

    return fkChoices;
}

export default useFkChoices;