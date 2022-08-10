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
  status: {
    label: _('Status'),
    enum: {
      waiting: _('Waiting'),
      inProgress: _('In Progress'),
      imported: _('Imported'),
      error: _('Error'),
    },
    //@TODO IvozProvider_Klear_Ghost_DestinationRateGroups::getStatus
  },
  lastExecutionError: {
    label: _('Last ExecutionError'),
  },
  deductibleConnectionFee: {
    label: _('Deductible ConnectionFee'),
    default: 0,
    enum: {
      '0': _('No'),
      '1': _('Yes'),
    },
    helpText: _(
      `Apply connect fee only if call cost does not reach connect fee (minimal cost, read documentation for further information).`
    ),
  },
  name: {
    label: _('Name'),
    maxLength: 55,
  },
  description: {
    label: _('Description'),
    maxLength: 255,
  },
  file: {
    label: _('Imported file'),
  },
  currency: {
    label: _('Currency'),
    null: _('Default currency'),
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
  selectOptions,
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default DestinationRateGroup;
