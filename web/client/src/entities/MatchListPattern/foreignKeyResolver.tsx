import { foreignKeyResolverType } from 'lib/entities/EntityInterface';
import { EntityValues } from 'lib/services/entity/EntityService';
import entities from '../index';
import genericForeignKeyResolver from 'lib/services/api/genericForeigKeyResolver';
import { CountryPropertyList } from 'entities/Country/CountryProperties';

const foreignKeyResolver: foreignKeyResolverType = async function (
    { data, cancelToken }
): Promise<EntityValues> {

    const promises: Array<Promise<unknown>> = [];

    promises.push(
        genericForeignKeyResolver({
            data,
            fkFld: 'numberCountry',
            entity: {
                ...entities.Country,
                toStr: (row: CountryPropertyList<string>) => `${row.countryCode}`,
            },
            cancelToken,
        })
    );

    await Promise.all(promises);

    return data;
}

export default foreignKeyResolver;