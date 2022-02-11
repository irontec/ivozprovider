import { CallForwardSettingPropertiesList } from './CallForwardSettingProperties';
import entities from '../index';
import genericForeignKeyResolver, { remapFk } from 'lib/services/api/genericForeigKeyResolver';
import { CountryPropertyList } from 'entities/Country/CountryProperties';
import { foreignKeyResolverType } from 'lib/entities/EntityInterface';

const foreignKeyResolver: foreignKeyResolverType = async function(
    { data, cancelToken }
): Promise<CallForwardSettingPropertiesList> {
    const promises = [];
    const { User, Extension, Ddi, RetailAccount, ResidentialDevice, Country } = entities;

    promises.push(
        genericForeignKeyResolver({
            data,
            fkFld: 'user',
            entity: User,
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
            fkFld: 'extension',
            entity: Extension,
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
            fkFld: 'retailAccount',
            entity: RetailAccount,
            cancelToken,
        })
    );

    promises.push(
        genericForeignKeyResolver({
            data,
            fkFld: 'residentialDevice',
            entity: ResidentialDevice,
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
            fkFld: 'cfwToRetailAccount',
            entity: RetailAccount,
            cancelToken,
        })
    );

    await Promise.all(promises);

    for (const values of data) {
        switch(values.targetType) {
            case 'extension':
                remapFk(values, 'extension', 'targetTypeValue');
                break;
            case 'voicemail':
                remapFk(values, 'voiceMailUser', 'targetTypeValue');
                break;
            case 'retail':
                remapFk(values, 'cfwToretailAccount', 'targetTypeValue');
                break;
            case 'number':
                values.targetTypeValue = `${values.numberCountry} ${values.numberValue}`;
                break;
        }
    }

    return data;
}

export default foreignKeyResolver;