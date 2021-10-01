import SettingsApplications from '@mui/icons-material/SettingsApplications';
import EntityInterface, { PropertiesList } from 'lib/entities/EntityInterface';
import _ from 'lib/services/translations/translate';
import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import Form from './Form'

const properties: PropertiesList = {
    'name': {
        label: _('Name'),
    },
    'defaultPolicy': {
        label: _('Default policy'),
        enum: {
            'allow': _('allow'),
            'deny': _('deny'),
        }
    },
    //@TODO POSPONED CallAclRelMatchLists subscreen list
};

const CallAcl: EntityInterface = {
    ...defaultEntityBehavior,
    icon: <SettingsApplications />,
    iden: 'CallAcl',
    title: _('Call ACLs', { count: 2 }),
    path: '/call_acls',
    properties,
    Form
};

export default CallAcl;