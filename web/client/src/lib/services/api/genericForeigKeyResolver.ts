import { EntityValues } from '../entity/EntityService';
import store from 'store';
import EntityInterface from 'lib/entities/EntityInterface';
import { CancelToken } from 'axios';

interface GenericForeignKeyResolverProps {
    data: Array<EntityValues> | EntityValues,
    fkFld: string,
    entity: EntityInterface,
    addLink?: boolean,
    dataPreprocesor?: (data: Record<string, any>) => Promise<void>,
    cancelToken?: CancelToken,
}

export default async function genericForeignKeyResolver(props: GenericForeignKeyResolverProps): Promise<Array<EntityValues> | EntityValues> {

    const {
        data, fkFld, entity, addLink = true, dataPreprocesor, cancelToken
    } = props;

    const {
        path, toStr
    } = entity;

    if (typeof data !== 'object') {
        return data;
    }

    if (!Array.isArray(data) && (typeof data[fkFld] !== 'object' || data[fkFld] === null)) {
        return data;
    }

    if (!Array.isArray(data)) {
        // Just flat view's detailed model

        try {
            if (dataPreprocesor && typeof data[fkFld] === 'object') {
                await dataPreprocesor(data[fkFld] as EntityValues);
            }
        } catch { }

        data[fkFld] = toStr(data[fkFld] as EntityValues);

        return data;
    }

    const ids: Array<number> = [];
    for (const idx in data) {
        if (data[idx][fkFld]) {

            const val = data[idx][fkFld];
            const iterableValues: Array<any> = Array.isArray(val)
                ? val
                : [val];

            for (const value of iterableValues) {
                if (ids.includes(value)) {
                    continue;
                }

                ids.push(
                    value
                );
            }
        }
    }

    if (ids.length) {

        const getAction = store.getActions().api.get;

        await getAction({
            path,
            params: {
                id: ids,
                _pagination: false
            },
            cancelToken: cancelToken,
            successCallback: async (response: any) => {

                try {
                    if (dataPreprocesor) {
                        await dataPreprocesor(response);
                    }

                } catch { }

                const entityReducer = async (accumulator: any, value: any) => {

                    accumulator[value.id] = toStr(value);

                    return accumulator;
                };

                let entities: any = {};
                for (const idx in response) {
                    entities = await entityReducer(entities, response[idx]);
                }

                for (const idx in data) {
                    if (data[idx][fkFld]) {

                        const fk = data[idx][fkFld];
                        if (Array.isArray(fk)) {
                            for (const key in fk) {
                                fk[key] = entities[fk[key]];
                            }

                            data[idx][fkFld] = fk.join(', ');
                            continue;
                        }

                        const scalarFk = fk as string | number;

                        data[idx][`${fkFld}Id`] = data[idx][fkFld];
                        if (addLink) {
                            data[idx][`${fkFld}Link`] = `${path}/${scalarFk}/update`;
                        }
                        data[idx][fkFld] = entities[scalarFk];
                    }
                }
            }
        });
    }

    return data;
}

export const remapFk = (row: EntityValues, from: string, to: string): void => {
    row[to] = row[from];
    row[`${to}Id`] = row[`${from}Id`];
    row[`${to}Link`] = row[`${from}Link`];
}