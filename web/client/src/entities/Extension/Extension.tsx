import SettingsApplications from '@material-ui/icons/SettingsApplications';
import EntityInterface, { PropertiesList } from 'entities/EntityInterface';
import _ from 'services/Translations/translate';
import defaultEntityBehavior from 'entities/DefaultEntityBehavior';
import Form from './Form';

const properties:PropertiesList = {
    'number': {
        label: _('Number'),
        helpText: _('Minimal length: 2')
    },
    'routeType': {
        label:_('Route type'),
        enum: {
            '__null__': _("Unassigned"),
            'user': _('User'),
            'ivr': _('IVR'),
            'huntGroup': _('Hunt Group'),
            'conferenceRoom': _('Conference room'),
            'number': _('Number'),
            'friend': _('Friend'),
            'queue': _('Queue'),
            'conditional': _('Conditional Route'),
        }
    },
    'numberCountry': {
        label: _('Country'),
    },
    'numberValue': {
        label: _('Number'),
    },
    'ivr': {
        label: _('IVR'),
    },
    'huntGroup': {
        label: _('Hunt Group'),
    },
    'conferenceRoom': {
        label: _('Conference room'),
    },
    'user': {
        label: _('User'),
    },
    'friendValue': {
        label: _('Friend value'),
    },
    'queue': {
        label: _('Queue'),
    },
    'conditionalRoute': {
        label: _('Conditional Route'),
    },
    'target': {
        label: _('Target'),
    },
};

const extension:EntityInterface = {
    ...defaultEntityBehavior,
    icon: <SettingsApplications />,
    iden: 'Extension',
    title: _('Extension', {count: 2}),
    path: '/extensions',
    properties,
    Form
};

export default extension;