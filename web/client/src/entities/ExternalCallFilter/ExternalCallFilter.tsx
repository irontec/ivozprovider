import SettingsApplications from '@mui/icons-material/SettingsApplications';
import EntityInterface from 'lib/entities/EntityInterface';
import _ from 'lib/services/translations/translate';
import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import genericForeignKeyResolver, { remapFk } from 'lib/services/api/genericForeigKeyResolver';
import entities from '../index';
import Form, { foreignKeyGetter } from './Form';
import { ExternalCallFilterProperties, ExternalCallFilterPropertiesList } from './ExternalCallFilterProperties';

const holidayFields = [
    'holidayNumberCountry',
    'holidayNumberValue',
    'holidayExtension',
    'holidayVoiceMailUser',
];

const outOfScheduleFields = [
    'outOfScheduleNumberCountry',
    'outOfScheduleNumberValue',
    'outOfScheduleExtension',
    'outOfScheduleVoiceMailUser',
];

const properties: ExternalCallFilterProperties = {
    'name': {
        label: _('Name'),
    },
    'welcomeLocution': {
        label: _('Welcome locution'),
    },
    'holidayLocution': {
        label: _('Holiday locution'),
    },
    'outOfScheduleLocution': {
        label: _('Out of schedule locution'),
    },
    'holidayTargetType': {
        label: _('Holiday target type'),
        enum: {
            'number': _("Number"),
            'extension': _('Extension'),
            'voicemail': _('Voicemail'),
        },
        null: _('Unassigned'),
        visualToggle: {
            '__null__': {
                show: [],
                hide: holidayFields,
            },
            'number': {
                show: ['holidayNumberValue', 'holidayNumberCountry'],
                hide: holidayFields,
            },
            'extension': {
                show: ['holidayExtension'],
                hide: holidayFields,
            },
            'voicemail': {
                show: ['holidayVoiceMailUser'],
                hide: holidayFields,
            },
        }
    },
    'holidayNumberCountry': {
        label: _('Country'),
    },
    'holidayNumberValue': {
        label: _('Number'),
    },
    'holidayExtension': {
        label: _('Extension'),
    },
    'holidayVoiceMailUser': {
        label: _('Voicemail'),
    },
    'outOfScheduleTargetType': {
        label: _('Out of schedule target type'),
        enum: {
            'number': _("Number"),
            'extension': _('Extension'),
            'voicemail': _('Voicemail'),
        },
        null: _('Unassigned'),
        visualToggle: {
            '__null__': {
                show: [],
                hide: outOfScheduleFields,
            },
            'number': {
                show: ['outOfScheduleNumberValue', 'outOfScheduleNumberCountry'],
                hide: outOfScheduleFields,
            },
            'extension': {
                show: ['outOfScheduleExtension'],
                hide: outOfScheduleFields,
            },
            'voicemail': {
                show: ['outOfScheduleVoiceMailUser'],
                hide: outOfScheduleFields,
            },
        }
    },
    'outOfScheduleNumberCountry': {
        label: _('Country'),
    },
    'outOfScheduleNumberValue': {
        label: _('Number'),
    },
    'outOfScheduleExtension': {
        label: _('Extension'),
    },
    'outOfScheduleVoiceMailUser': {
        label: _('Voicemail'),
    },
    'scheduleIds': {
        label: _('Schedule'),
    },
    'calendarIds': {
        label: _('Calendar'),
    },
    'whiteListIds': {
        label: _('White Lists'),
        helpText: _("Incoming numbers that match this lists will be always ACCEPTED without checking this filter configuration."),
    },
    'blackListIds': {
        label: _('Black Lists'),
        helpText: _("Incoming numbers that match this lists will be always REJECTED without checking this filter configuration."),
    },
    'holidayTarget': {
        label: _('Holiday target')
    },
    'outOfScheduleTarget': {
        label: _('Out of schedule target')
    }
};

const columns = [
    'name',
    'holidayTargetType',
    'holidayTarget',
    'outOfScheduleTargetType',
    'outOfScheduleTarget',
];

async function foreignKeyResolver(data: ExternalCallFilterPropertiesList): Promise<ExternalCallFilterPropertiesList> {

    const promises = [];
    const {
        User, Extension, Country, Locution
    } = entities;

    promises.push(
        genericForeignKeyResolver(
            data,
            'holidayLocution',
            Locution.path,
            Locution.toStr,
        )
    );

    promises.push(
        genericForeignKeyResolver(
            data,
            'holidayExtension',
            Extension.path,
            Extension.toStr
        )
    );

    promises.push(
        genericForeignKeyResolver(
            data,
            'holidayVoiceMailUser',
            User.path,
            User.toStr
        )
    );

    promises.push(
        genericForeignKeyResolver(
            data,
            'holidayNumberCountry',
            Country.path,
            Country.toStr,
        )
    );

    //////////////////

    promises.push(
        genericForeignKeyResolver(
            data,
            'outOfScheduleLocution',
            Locution.path,
            Locution.toStr,
        )
    );

    promises.push(
        genericForeignKeyResolver(
            data,
            'outOfScheduleExtension',
            Extension.path,
            Extension.toStr
        )
    );

    promises.push(
        genericForeignKeyResolver(
            data,
            'outOfScheduleVoiceMailUser',
            User.path,
            User.toStr
        )
    );

    promises.push(
        genericForeignKeyResolver(
            data,
            'outOfScheduleNumberCountry',
            Country.path,
            Country.toStr,
        )
    );

    await Promise.all(promises);

    if (!Array.isArray(data)) {
        return data;
    }

    for (const idx in data) {

        switch (data[idx].holidayTargetType) {
            case null:
                data[idx].holidayTarget = '';
                break;
            case 'extension':
                remapFk(data[idx], 'holidayExtension', 'holidayTarget');
                break;
            case 'voicemail':
                remapFk(data[idx], 'holidayVoiceMailUser', 'holidayTarget');
                break;
            case 'number':
                data[idx].holidayTarget =
                    data[idx].holidayNumberCountry
                    + ' '
                    + data[idx].holidayNumberValue;
                break;
            default:
                console.error('Unkown route type:', data[idx].holidayTargetType);
                data[idx].holidayTarget = '';
                break;
        }

        switch (data[idx].outOfScheduleTargetType) {
            case null:
                data[idx].outOfScheduleTarget = '';
                break;
            case 'extension':
                remapFk(data[idx], 'outOfScheduleExtension', 'outOfScheduleTarget');
                break;
            case 'voicemail':
                remapFk(data[idx], 'outOfScheduleVoiceMailUser', 'outOfScheduleTarget');
                break;
            case 'number':
                data[idx].outOfScheduleTarget =
                    data[idx].outOfScheduleNumberCountry
                    + ' '
                    + data[idx].outOfScheduleNumberValue;
                break;
            default:
                console.error('Unkown route type:', data[idx].outOfScheduleTargetType);
                data[idx].outOfScheduleTarget = '';
                break;
        }

        delete data[idx].holidayExtension;
        delete data[idx].holidayVoiceMailUser;
        delete data[idx].holidayNumberCountry;
        delete data[idx].holidayNumberValue;

        delete data[idx].outOfScheduleExtension;
        delete data[idx].outOfScheduleVoiceMailUser;
        delete data[idx].outOfScheduleNumberCountry;
        delete data[idx].outOfScheduleNumberValue;
    }

    return data;
}

const externalCallFilter: EntityInterface = {
    ...defaultEntityBehavior,
    icon: <SettingsApplications />,
    iden: 'ExternalCallFilter',
    title: _('External call filter', { count: 2 }),
    path: '/external_call_filters',
    toStr: (row: any) => row.name,
    properties,
    columns,
    Form,
    foreignKeyGetter,
    foreignKeyResolver
};

export default externalCallFilter;