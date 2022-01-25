import SettingsApplications from '@mui/icons-material/SettingsApplications';
import EntityInterface from 'lib/entities/EntityInterface';
import _ from 'lib/services/translations/translate';
import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import Form from './Form';
import { LocutionProperties } from './LocutionProperties';
import RecordingExtension from './Field/RecordingExtension';
import { EntityValues } from 'lib/services/entity/EntityService';

const properties: LocutionProperties = {
    'name': {
        label: _('Name'),
    },
    'originalFile': {
        label: _('Uploaded file'),
        type: 'file'
    },
    recordingExtension: {
        label: _('Recording extension'),
        helpText: _("You can call this extension from any company terminal to record this locution"),
        component: RecordingExtension,
    },
    'status': {
        label: _('Status'),
        readOnly: true,
        enum: {
            'pending': _('pending'),
            'encoding': _('encoding'),
            'ready': _('ready'),
            'error': _('error'),
        }
    }
};

const locution: EntityInterface = {
    ...defaultEntityBehavior,
    icon: <SettingsApplications />,
    iden: 'Locution',
    title: _('Locution', { count: 2 }),
    path: '/locutions',
    properties,
    columns: [
        'name',
        'originalFile',
        'recordingExtension',
        'status',
    ],
    Form,
    toStr: (row: EntityValues) => row.name as string,
};

export default locution;