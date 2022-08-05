import AccountTreeIcon from '@mui/icons-material/AccountTree';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { DestinationRateGroupProperties } from './DestinationRateGroupProperties';
import foreignKeyResolver from './ForeignKeyResolver';

const properties: DestinationRateGroupProperties = {
  'status': {
    label: _('Status'),
    enum: {
      'waiting' : _('Waiting'),
      'inProgress' : _('In Progress'),
      'imported' : _('Imported'),
      'error' : _('Error'),
    },
  },
  'lastExecutionError': {
    label: _('Last ExecutionError'),
  },
  'deductibleConnectionFee': {
    label: _('Deductible ConnectionFee'),
  },
  'id': {
    label: _('Id'),
  },
  'name': {
    label: _('Name'),
  },
  'description': {
    label: _('Description'),
  },
  'file': {
    label: _('File'),
  },
  'currency': {
    label: _('Currency'),
  },
};

const DestinationRateGroup: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'DestinationRateGroup',
  title: _('DestinationRateGroup', { count: 2 }),
  path: '/DestinationRateGroups',
  toStr: (row: any) => row.id,
  properties,
  selectOptions: (props, customProps) => { return selectOptions(props, customProps); },
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default DestinationRateGroup;