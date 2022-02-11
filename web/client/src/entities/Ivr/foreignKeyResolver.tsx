import { foreignKeyResolverType } from 'lib/entities/EntityInterface';
import genericForeignKeyResolver, { remapFk } from 'lib/services/api/genericForeigKeyResolver';
import entities from '../index';
import { IvrPropertiesList } from './IvrProperties';

const foreignKeyResolver: foreignKeyResolverType = async function(
    { data, cancelToken }
): Promise<IvrPropertiesList> {

    const promises = [];
    const {
        Extension, User, Country,
    } = entities;

    promises.push(
        genericForeignKeyResolver({
            data,
            fkFld: 'noInputExtension',
            entity: Extension,
            cancelToken,
        })
    );

    promises.push(
        genericForeignKeyResolver({
            data,
            fkFld: 'noInputVoiceMailUser',
            entity: User,
            cancelToken,
        })
    );

    promises.push(
        genericForeignKeyResolver({
            data,
            fkFld: 'noInputNumberCountry',
            entity: {
                ...Country,
                toStr: (row: any) => `${row.countryCode}`
            },
            cancelToken,
        })
    );

    promises.push(
        genericForeignKeyResolver({
            data,
            fkFld: 'errorExtension',
            entity: Extension,
            cancelToken,
        })
    );

    promises.push(
        genericForeignKeyResolver({
            data,
            fkFld: 'errorVoiceMailUser',
            entity: User,
            cancelToken,
        })
    );

    promises.push(
        genericForeignKeyResolver({
            data,
            fkFld: 'errorNumberCountry',
            entity: {
                ...Country,
                toStr: (row: any) => `${row.countryCode}`
            },
            cancelToken,
        })
    );

    await Promise.all(promises);

    if (!Array.isArray(data)) {
        return data;
    }

    for (const idx in data) {

        switch (data[idx].noInputRouteType) {
            case 'number':
                data[idx].errorTarget =
                    data[idx].noInputNumberCountry
                    + ' '
                    + data[idx].noInputNumberValue;
                break;
            case 'extension':
                remapFk(data[idx], 'noInputExtension', 'noInputTarget');
                break;
            case 'voicemail':
                remapFk(data[idx], 'noInputVoiceMailUser', 'noInputTarget');
                break;
            default:
                console.error('Unkown route type ' + data[idx].noInputRouteType);
                data[idx].noInputTarget = '';
                break;
        }

        switch (data[idx].errorRouteType) {
            case 'number':
                data[idx].errorTarget =
                    data[idx].errorNumberCountry
                    + ' '
                    + data[idx].errorNumberValue;
                break;
            case 'extension':
                remapFk(data[idx], 'errorExtension', 'errorTarget');
                break;
            case 'voicemail':
                remapFk(data[idx], 'errorVoiceMailUser', 'errorTarget');
                break;
            default:
                console.error('Unkown route type ' + data[idx].errorRouteType);
                data[idx].errorTarget = '';
                break;
        }

        delete (data[idx] as any).noInputNumberCountryId;
        delete (data[idx] as any).noInputNumberValue;
        delete (data[idx] as any).noInputExtensionId;
        delete (data[idx] as any).noInputVoiceMailUserId;

        delete (data[idx] as any).errorNumberCountryId;
        delete (data[idx] as any).errorNumberValue;
        delete (data[idx] as any).errorExtensionId;
        delete (data[idx] as any).errorVoiceMailUserId;
    }

    return data;
}

export default foreignKeyResolver;