import store from 'store';

type ToStringFunction = (value: any) => string;

export default async function genericForeignKeyGetter(entityEndpoint: string, fkIdenFld: string, callback?: ToStringFunction): Promise<Array<any>> {

    let entities: Array<any> = [];

    const getAction = store.getActions().api.get;
    await getAction({
        path: entityEndpoint,
        params: {
            _pagination: false
        },
        successCallback: async (response: any) => {

            entities = response.map((value: any) => {

                const label = callback
                    ? callback(value)
                    : value[fkIdenFld];

                return {
                    id: value.id,
                    label
                };
            });
        }
    });

    return entities;
}