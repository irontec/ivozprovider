import ApiClient from './Api/ApiClient';

export default async function genericForeignKeyResolver(
    data: any,
    fkFld: string,
    entityEndpoint: string,
    toStr: Function,
    addLink: boolean = true
) {
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
                        data[idx][`${fkFld}Id`] = data[idx][fkFld];
                        if (addLink) {
                            data[idx][`${fkFld}Link`] = `${entityEndpoint}/${fk}/update`;
                        }
                        data[idx][fkFld] = entities[fk];
                    }
                }
            }
        );
    }

    return data;
};

export const remapFk = (row:any, from:string, to:string) => {

    row[to] = row[from];
    row[`${to}Id`] = row[`${from}Id`];
    row[`${to}Link`] = row[`${from}Link`];
}