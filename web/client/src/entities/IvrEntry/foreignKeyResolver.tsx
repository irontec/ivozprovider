import { foreignKeyResolverType } from 'lib/entities/EntityInterface';
import genericForeignKeyResolver, { remapFk } from 'lib/services/api/genericForeigKeyResolver';
import entities from '../index';
import { IvrEntryPropertiesList } from './IvrEntryProperties';
import { CountryPropertyList } from 'entities/Country/CountryProperties';
import { autoForeignKeyResolver } from 'lib/entities/DefaultEntityBehavior';

const foreignKeyResolver: foreignKeyResolverType = async function (
    { data, cancelToken, entityService }
): Promise<IvrEntryPropertiesList> {

    const { Country } = entities;

    const promises = autoForeignKeyResolver({
        data,
        cancelToken,
        entityService,
        entities,
        skip: [
            'numberCountry',
            'ivr',
        ]
    });

    promises.push(
        genericForeignKeyResolver({
            data,
            fkFld: 'numberCountry',
            entity: {
                ...Country,
                toStr: (row: CountryPropertyList<string>) => row.countryCode as string,
            },
            cancelToken,
        })
    );

    await Promise.all(promises);

    for (const values of data) {
        switch (values.routeType) {
            case 'extension':
                remapFk(values, 'extension', 'target');
                break;
            case 'voicemail':
                remapFk(values, 'voicemail', 'target');
                break;
            case 'conditional':
                remapFk(values, 'conditionalRoute', 'target');
                break;
            case 'number':
                values.target = `${values.numberCountry} ${values.numberValue}`;
                break;
        }
    }

    return data;
}

export default foreignKeyResolver;