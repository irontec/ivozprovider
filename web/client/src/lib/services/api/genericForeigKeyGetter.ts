import ApiClient from './ApiClient';

type ToStringFunction = (value: any) => string;

export default async function genericForeignKeyGetter(entityEndpoint: string, fkIdenFld: string, callback?: ToStringFunction): Promise<Array<any>> {

    let entities: Array<any> = [];
    await ApiClient.get(
        entityEndpoint,
        {
            _pagination: false
        },
        async (response: any) => {

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
    );

    return entities;
}