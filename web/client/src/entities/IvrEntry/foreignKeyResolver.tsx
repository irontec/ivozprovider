import { foreignKeyResolverType } from 'lib/entities/EntityInterface';
import genericForeignKeyResolver, { remapFk } from 'lib/services/api/genericForeigKeyResolver';
import entities from '../index';
import { IvrEntryPropertiesList } from './IvrEntryProperties';
import { CountryPropertyList } from 'entities/Country/CountryProperties';

const foreignKeyResolver: foreignKeyResolverType = async function(
    { data, cancelToken }
): Promise<IvrEntryPropertiesList> {
    const promises = [];
    const {
        Ivr, Locution, Country, Ddi, Extension, User, ConditionalRoute,
    } = entities;

    promises.push(
        genericForeignKeyResolver({
            data,
            fkFld: 'ivr',
            entity: Ivr,
            cancelToken,
        })
    );

    promises.push(
        genericForeignKeyResolver({
            data,
            fkFld: 'welcomeLocution',
            entity: Locution,
            cancelToken,
        })
    );

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

    promises.push(
        genericForeignKeyResolver({
            data,
            fkFld: 'ddi',
            entity: Ddi,
            cancelToken,
        })
    );

    promises.push(
        genericForeignKeyResolver({
            data,
            fkFld: 'extension',
            entity: Extension,
            cancelToken,
        })
    );

    promises.push(
        genericForeignKeyResolver({
            data,
            fkFld: 'voiceMailUser',
            entity: User,
            cancelToken,
        })
    );

    promises.push(
        genericForeignKeyResolver({
            data,
            fkFld: 'conditionalRoute',
            entity: ConditionalRoute,
            cancelToken,
        })
    );

    await Promise.all(promises);

    for (const values of data) {
        switch(values.routeType) {
            case 'extension':
                remapFk(values, 'extension', 'target');
                break;
            case 'voicemail':
                remapFk(values, 'voiceMailUser', 'target');
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