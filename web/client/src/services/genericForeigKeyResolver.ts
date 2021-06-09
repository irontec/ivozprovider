import ApiClient from './Api/ApiClient';

type AsyncFunction = (value: any) => Promise<string>;

export default async function genericForeignKeyResolver(data: any, fkFld: string, entityEndpoint: string, fkIdenFld: string, callback?: AsyncFunction) {
    const ids: Array<number> = [];
    for (const idx in data) {
        if (data[idx][fkFld]) {

            if (ids.includes(data[idx][fkFld])) {
                continue;
            }

            ids.push(
                data[idx][fkFld]
            );
        }
    }

    if (ids.length) {
        await ApiClient.get(
            entityEndpoint,
            {
                id: ids,
                _pagination: false
            },
            async (response: any, headers: any) => {

                const entityReducer = async (accumulator: any, value: any) => {

                    if (callback) {
                        accumulator[value.id] = await callback(value);
                    } else {
                        accumulator[value.id] = value[fkIdenFld];
                    }

                    return accumulator;
                };

                let entities: any = {};
                for (const idx in response) {
                    entities = await entityReducer(entities, response[idx]);
                }

                for (const idx in data) {
                    if (data[idx][fkFld]) {

                        const fk = data[idx][fkFld];
                        data[idx][`${fkFld}Id`] = data[idx][fkFld];
                        data[idx][`${fkFld}Link`] = `${entityEndpoint}?_criteria={"id":{"type":"eq","value":"${fk}"}}`;
                        data[idx][fkFld] = entities[fk];
                    }
                }
            }
        );
    }

    return data;
};