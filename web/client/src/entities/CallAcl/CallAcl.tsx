import GavelIcon from '@mui/icons-material/Gavel';
import EntityInterface from 'lib/entities/EntityInterface';
import _ from 'lib/services/translations/translate';
import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import Form from './Form'
import { CallAclProperties } from './CallAclProperties';
import selectOptions from './SelectOptions';

const properties: CallAclProperties = {
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
    icon: GavelIcon,
    iden: 'CallAcl',
    title: _('Call ACLs', { count: 2 }),
    path: '/call_acls',
    properties,
    Form,
    selectOptions: (props, customProps) => { return selectOptions(props, customProps); },
};

export default CallAcl;